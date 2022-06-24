<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('transaction_model');
        $this->load->model('customer_model');
        $this->load->model('product_model');
        $this->load->model('bank_model');
        $this->load->library('pagination');
    }
    public function index()
    {
        $config['base_url']         = base_url('admin/transaction/index/');
        $config['total_rows']       = count($this->transaction_model->total_row());
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;

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

        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;

        $this->pagination->initialize($config);
        $transaction = $this->transaction_model->get_transaction($limit, $start);
        $data = [
            'title'                         => 'Transaksi',
            'transaction'                   => $transaction,
            'pagination'                    => $this->pagination->create_links(),
            'content'                       => 'admin/transaction/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function detail($id)
    {
        $transaction = $this->transaction_model->detail($id);
        $data = [
            'title'                   => "Detail Penjualan",
            'transaction'             => $transaction,
            'content'                 => 'admin/transaction/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function invoice($id)
    {
        $bank           = $this->bank_model->get_allbank();
        $transaction = $this->transaction_model->detail($id);
        $data = [
            'title'                   => "Invoice",
            'transaction'             => $transaction,
            'bank'                    => $bank,
            'content'                 => 'admin/transaction/invoice'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function print_invoice($id)
    {
        $transaction = $this->transaction_model->detail($id);
        $data = [
            'title'                   => "Invoice",
            'transaction'             => $transaction,
        ];
        $this->load->view('admin/transaction/print_invoice', $data, FALSE);
    }
    public function delivery($id)
    {
        $transaction = $this->transaction_model->detail($id);
        $data = [
            'title'                   => "Surat Jalan",
            'transaction'             => $transaction,
            'content'                 => 'admin/transaction/delivery'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function cancel($id)
    {
        is_login();
        $data = [
            'id'                        => $id,
            'status'                    => 0,
        ];
        $this->transaction_model->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Transaksi telah di cancel</div>');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function delete($id)
    {
        is_login();
        $transaction = $this->transaction_model->detail($id);
        $data = array('id'   => $transaction->id);
        $this->transaction_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect(base_url('admin/transaction'), 'refresh');
    }
}
