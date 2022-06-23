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
        // Midtrans Payment gateway
        $params = array('server_key' => 'SB-Mid-server-mtHK4r-ldx88P5K7TkOhcj0R', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('url');

        $this->output->enable_profiler(FALSE);
        $this->load->model('product_model');
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->library('pagination');
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
                'id'                 => 'item1',
                'price'         => $amount,
                'quantity'     => 1,
                'name'             => $name
            ),

        ];



        // Populate customer's Info
        $customer_details = array(
            'first_name'             => $first_name,
            'last_name'             => "",
            'email'                     => $email,
            'phone'                     => $phone,

        );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type'             => 'vtweb',
            'vtweb'                         => array(
                //'enabled_payments' 	=> ['credit_card'],
                'credit_card_3d_secure' => true
            ),
            'transaction_details' => $transaction_details,
            'item_details'              => $items,
            'customer_details'      => $customer_details
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
        $data  = [
            'id'                    => $transaksi_id,
            'payment_url'           => $vtweb_url,
            'order_id'              => $order_id

        ];
        $this->transaction_model->update($data);
    }

    public function notification()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if ($result) {
            $notif = $this->veritrans->status($result->order_id);
        }

        error_log(print_r($result, TRUE));

        //notification handler sample

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }
    }
}
