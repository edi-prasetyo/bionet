<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sender extends CI_Controller
{
    /**
     * Development By Edi Prasetyo
     * edikomputer@gmail.com
     * 0812 3333 5523
     * https://edikomputer.com
     * https://grahastudio.com
     */
    //Load Data Konfigurasi
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pengaturan_model');
    }
    public function index()
    {
        $sender                       = $this->pengaturan_model->sender();
        // var_dump($sender);
        // die;
        $data                       = [
            'title'                   => 'Profile Web',
            'sender'                    => $sender,
            'content'                 => 'admin/sender/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function update($id)
    {
        $sender = $this->pengaturan_model->sender($id);

        $this->form_validation->set_rules(
            'whatsapp_notif',
            'Nama',
            'required',
            array('required'            => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                   => 'Update Profile Web',
                'sender'                    => $sender,
                'content'                 => 'admin/sender/index'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                            => $sender->id,
                'whatsapp_notif'                => $this->input->post('whatsapp_notif'),
                'whatsapp_api'                  => $this->input->post('whatsapp_api'),
                'midtrans_server_key'           => $this->input->post('midtrans_server_key'),
                'midtrans_client_key'           => $this->input->post('midtrans_client_key'),
                'midtrans_environment'          => $this->input->post('midtrans_environment'),
                'updated_at'                    => date('Y-m-d H:i:s')
            ];
            $this->pengaturan_model->update_sender($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di ubah</div>');
            redirect(base_url('admin/sender'), 'refresh');
        }
    }
}
