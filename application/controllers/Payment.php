<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    //Load Model
    public function __construct()
    {
        parent::__construct();


        $this->output->enable_profiler(FALSE);
        $this->load->model('product_model');
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->model('pengaturan_model');
        $this->load->library('pagination');

        $sender = $this->pengaturan_model->sender();
        $server_key = $sender->midtrans_server_key;
        $payment_environment = $sender->midtrans_environment;

        // var_dump($whatsapp_api);
        // die;

        // Midtrans Payment gateway
        $params = array('server_key' =>  $server_key, 'production' => $payment_environment);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('url');
    }
    public function index()
    {
        $insert_id = $this->input->get('id');
        $transaction        = $this->transaction_model->payment($insert_id);
        // Desktop View
        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => 'keywords',
            'transaction'                 => $transaction,
            'content'                     => 'front/payment/index'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function vtweb_checkout()
    {
        $transaksi_id = $this->input->post('transaksi_id');
        $gross_amount = $this->input->post('gross_amount');
        $amount = $this->input->post('amount');
        $name = $this->input->post('name');
        $first_name = $this->input->post('first_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        $transaction_details = array(
            'order_id'             => uniqid(),
            'gross_amount'     => $gross_amount
        );

        // Populate items
        $items = [
            array(
                'id'                => 'item1',
                'price'             => $amount,
                'quantity'          => 1,
                'name'              => $name
            ),

        ];

        // Populate customer's Info
        $customer_details = array(
            'first_name'                => $first_name,
            'last_name'                 => "",
            'email'                     => $email,
            'phone'                     => $phone,

        );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type'              => 'vtweb',
            'vtweb'                     => array(
                //'enabled_payments' 	=> ['credit_card'],
                'credit_card_3d_secure' => true
            ),
            'transaction_details'       => $transaction_details,
            'item_details'              => $items,
            'customer_details'          => $customer_details
        );
        $order_id = $transaction_details['order_id'];
        try {
            $vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
            header('Location: ' . $vtweb_url);
            $this->insert_payment($vtweb_url, $transaksi_id, $order_id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function insert_payment($vtweb_url, $transaksi_id, $order_id)
    {
        $insert_id = $transaksi_id;
        $data  = [
            'id'                    => $transaksi_id,
            'payment_url'           => $vtweb_url,
            'order_id'              => $order_id

        ];
        $this->transaction_model->update($data);
        $this->sendWhatsapp($insert_id);
    }

    public function sendWhatsapp($insert_id)
    {
        $sender = $this->pengaturan_model->sender();
        $whatsapp_api = $sender->whatsapp_api;
        /* Transaction Detail */
        $transaction = $this->transaction_model->detail($insert_id);

        $apikey = $whatsapp_api;
        $tujuan = $transaction->whatsapp;
        $pesan = "
        Terima kasih telah 
        melakukan pembelian
        paket di bionet
        -------------------------------------
        Nomor Invoice Anda :
        *" . $transaction->invoice_number . "*
        Produk yang di beli :
        *Paket* *" . $transaction->product_name . "*
        Nilai Transaksi : 
        *Rp.* *" . number_format($transaction->total_amount, 0, ",", ".") . "*
        -------------------------------------
        Info akun
        -------------------------------------
        Nama   : *" . $transaction->fullname . "*
        No. WA : *" . $transaction->whatsapp . "*
        Email  : *" . $transaction->email . "*
        -------‐-----------------------------
        Klik link di bawah ini untuk
        Melakukan pembayaran
        " . base_url('payment?id=' . md5($transaction->id))  . "
        ‐--------‐---------------------------
        Terima kasih telah menggunakan layanan 
        bionet untuk informasi lebih lanjut 
        hubungi kami di 0812334688";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://starsender.online/api/sendText?message=' . rawurlencode($pesan) . '&tujuan=' . rawurlencode($tujuan . '@s.whatsapp.net'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'apikey: ' . $apikey
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response;
    }

    public function notification()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, 'true');


        $order_id = $result['order_id'];
        if ($result['payment_type'] == 'bank_transfer') {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'payment_type'            => $result['payment_type'],
                'gross_amount'            => $result['gross_amount'],
                'bank'                    => $result['va_numbers'][0]['bank'],
                'va_number'                => $result['va_numbers'][0]['va_number']
            ];
            $this->transaction_model->update_notif($data);
        } elseif ($result['payment_type'] == 'cstore') {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'payment_type'            => $result['payment_type'],
                'gross_amount'            => $result['gross_amount'],
                'payment_code'            => $result['payment_code'],
            ];
            $this->transaction_model->update_notif($data);
        } else {
            $data = [
                'order_id'                => $order_id,
                'status_code'            => $result['status_code'],
                'gross_amount'            => $result['gross_amount'],
                'payment_type'            => $result['payment_type'],
            ];
            $this->transaction_model->update_notif($data);
        }
    }

    public function finish()
    {

        echo 'Finish';
    }
    public function unfinish()
    {

        echo 'Unfinish';
    }
    public function error()
    {

        echo 'Error';
    }
    public function handling()
    {

        echo 'handling';
    }
}
