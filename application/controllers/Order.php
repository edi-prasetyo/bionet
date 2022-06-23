<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        $this->load->library('midtrans');
        $this->midtrans->config($params);
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
        );
        $this->load->view('front/order/index', $data);
    }


    public function token()
    {

        $gross_amount = $this->input->post('gross_amount');
        $amount = $this->input->post('amount');
        $name = $this->input->post('name');
        $first_name = $this->input->post('first_name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $gross_amount, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $amount,
            'quantity' => 1,
            'name' => $name
        );



        // Optional
        $item_details = array($item1_details);



        // Optional
        $customer_details = array(
            'first_name'    => $first_name,
            'last_name'     => "TESR",
            'email'         => $email,
            'phone'         => $phone,
            // 'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 2
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->input->post('result_data'));

        $data = array(
            'title'       => 'Halaman',
            'deskripsi'   => 'Berita - ',
            'keywords'    => 'Berita - ',
            'result'    => $result,
            'content'     => 'front/order/finish'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}
