<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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
        // $params = array('server_key' => 'Server Key', 'production' => false);
        // $this->load->library('midtrans');
        // $this->midtrans->config($params);
        // $this->load->helper('url');

        $this->output->enable_profiler(FALSE);
        $this->load->model('product_model');
        $this->load->model('meta_model');
        $this->load->model('transaction_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $meta                           = $this->meta_model->get_meta();

        $this->load->library('pagination');
        $config['base_url']             = base_url('product/index/');
        $config['total_rows']           = count($this->product_model->total());
        $config['per_page']             = 6;
        $config['uri_segment']          = 3;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $limit                          = $config['per_page'];
        $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $this->pagination->initialize($config);
        $product = $this->product_model->product($limit, $start);

        if (!$this->agent->is_mobile()) {
            // Desktop View
            $data = array(
                'title'                       => 'Product - ' . $meta->title,
                'deskripsi'                   => 'Product - ' . $meta->description,
                'keywords'                    => 'Product - ' . $meta->keywords,
                'product'                      => $product,
                'paginasi'                    => $this->pagination->create_links(),
                'content'                     => 'front/product/index_product'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            // Mobile View
            $data = array(
                'title'                       => 'Product - ' . $meta->title,
                'deskripsi'                   => 'Product - ' . $meta->description,
                'keywords'                    => 'Product - ' . $meta->keywords,
                'paginasi'                    => $this->pagination->create_links(),
                'product'                      => $product,
                'content'                     => 'mobile/product/index'
            );
            $this->load->view('mobile/layout/wrapp', $data, FALSE);
        }
    }
    public function detail($product_slug = NULL)
    {
        if (!empty($product_slug)) {
            $product_slug;
        } else {
            redirect(base_url('product'));
        }
        $product                         = $this->product_model->read($product_slug);

        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => $product->product_keywords,
            'product'                      => $product,
            'content'                     => 'front/product/detail'
        );

        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function order($product_id = NULL)
    {
        if (!empty($product_id)) {
            $product_id;
        } else {
            redirect(base_url('product'));
        }
        $product                         = $this->product_model->order($product_id);
        // var_dump($product);
        // die;

        $this->form_validation->set_rules(
            'product_name',
            'Nama Produk',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {

            $data                           = array(
                'title'                       => 'Product',
                'deskripsi'                   => 'Product',
                'keywords'                    => $product->product_name,
                'product'                      => $product,
                'content'                     => 'front/product/order'
            );

            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {

            $order_code = strtoupper(random_string('alnum', 5));

            $whatsapp = $this->input->post('whatsapp');
            $phone = str_replace(' ', '', $whatsapp);
            $phone = str_replace('-', '', $whatsapp);

            // Ubah 0 menjadi 62
            // kadang ada penulisan no hp 0811 239 345
            $phone = str_replace(" ", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace("(", "", $phone);
            // kadang ada penulisan no hp (0274) 778787
            $phone = str_replace(")", "", $phone);
            // kadang ada penulisan no hp 0811.239.345
            $phone = str_replace(".", "", $phone);

            // cek apakah no hp mengandung karakter + dan 0-9
            if (!preg_match('/[^+0-9]/', trim($phone))) {
                // cek apakah no hp karakter 1-3 adalah +62
                if (substr(trim($phone), 0, 3) == '62') {
                    $hp = trim($phone);
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif (substr(trim($phone), 0, 1) == '0') {
                    $hp = '62' . substr(trim($phone), 1);
                }
            }

            $data  = [
                'order_code'                => $order_code,
                'product_id'                => $this->input->post('product_id'),
                'product_name'              => $this->input->post('product_name'),
                'fullname'                  => $this->input->post('fullname'),
                'email'                     => $this->input->post('email'),
                'whatsapp'                  => $hp,
                'address'                   => $this->input->post('address'),
                'status'                    => 0,
                'amount'                    => $this->input->post('amount'),
                'total_amount'              => $this->input->post('total_amount'),
                'payment_status'            => 'pending',
                'created_at'                => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaction_model->create($data);
            $this->create_incoice_number($insert_id);
            $this->sendWhatsapp($insert_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('product/payment/' . md5($insert_id)), 'refresh');
        }
    }
    public function create_incoice_number($insert_id)
    {
        $invoice_number = str_pad($insert_id, 8, '0', STR_PAD_LEFT);
        $data = [
            'id'                    => $insert_id,
            'invoice_number'        => 'INV-' . $invoice_number,
        ];
        $this->transaction_model->update($data);
    }
    public function payment($insert_id = NULL)
    {
        $transaction                         = $this->transaction_model->payment($insert_id);



        // // Required
        // $transaction_details = array(
        //     'order_id' => rand(),
        //     'gross_amount' => 94000, // no decimal allowed for creditcard
        // );

        // // Optional
        // $item1_details = array(
        //     'id' => 'a1',
        //     'price' => 18000,
        //     'quantity' => 3,
        //     'name' => "Apple"
        // );

        // // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 20000,
        //     'quantity' => 2,
        //     'name' => "Orange"
        // );

        // // Optional
        // $item_details = array($item1_details, $item2_details);

        // // Optional
        // $billing_address = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'address'       => "Mangga 20",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16602",
        //     'phone'         => "081122334455",
        //     'country_code'  => 'IDN'
        // );

        // // Optional
        // $shipping_address = array(
        //     'first_name'    => "Obet",
        //     'last_name'     => "Supriadi",
        //     'address'       => "Manggis 90",
        //     'city'          => "Jakarta",
        //     'postal_code'   => "16601",
        //     'phone'         => "08113366345",
        //     'country_code'  => 'IDN'
        // );

        // // Optional
        // $customer_details = array(
        //     'first_name'    => "Andri",
        //     'last_name'     => "Litani",
        //     'email'         => "andri@litani.com",
        //     'phone'         => "081122334455",
        //     'billing_address'  => $billing_address,
        //     'shipping_address' => $shipping_address
        // );

        // // Data yang akan dikirim untuk request redirect_url.
        // $credit_card['secure'] = true;
        // //ser save_card true to enable oneclick or 2click
        // //$credit_card['save_card'] = true;

        // $time = time();
        // $custom_expiry = array(
        //     'start_time' => date("Y-m-d H:i:s O", $time),
        //     'unit' => 'minute',
        //     'duration'  => 2
        // );

        // $transaction_data = array(
        //     'transaction_details' => $transaction_details,
        //     'item_details'       => $item_details,
        //     'customer_details'   => $customer_details,
        //     'credit_card'        => $credit_card,
        //     'expiry'             => $custom_expiry
        // );

        // error_log(json_encode($transaction_data));
        // $snapToken = $this->midtrans->getSnapToken($transaction_data);
        // error_log($snapToken);
        // echo $snapToken;


        $data                           = array(
            'title'                       => 'Product',
            'deskripsi'                   => 'Product',
            'keywords'                    => $transaction->product_name,
            'transaction'                      => $transaction,
            'content'                     => 'front/product/payment'
        );

        $this->load->view('front/product/payment', $data, FALSE);
    }

    public function sendWhatsapp($insert_id)
    {
        /* Transaction Detail */
        $transaction = $this->transaction_model->detail($insert_id);

        $apikey = "ef37dd40b5b8f7291602a881f1b176848083af8a";
        $tujuan = $transaction->whatsapp;
        $pesan = "Terima kasih telah 
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
        " . base_url('product/payment/' . md5($transaction->id))  . "
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
}
