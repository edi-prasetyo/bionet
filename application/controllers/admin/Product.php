<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {
        $product = $this->product_model->get_product();
        $data = array(
            'title'         => 'Data Product (' . count($product) . ')',
            'product'       => $product,
            'content'       => 'admin/product/index'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function create()
    {
        $this->form_validation->set_rules(
            'product_name',
            'Nama Produk',
            'required',
            array(
                'required'         => '%s Harus Diisi'
            )
        );

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Buat Produk',
                'deskripsi'         => 'Deskripsi',
                'keywords'          => 'Keywords',
                'content'           => 'admin/product/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $slugcode = random_string('numeric', 5);
            $product_slug  = url_title($this->input->post('product_name'), 'dash', TRUE);
            $data  = [
                'product_type'              => $this->input->post('product_type'),
                'product_slug'              =>  $product_slug . '-' . $slugcode,
                'product_name'              => $this->input->post('product_name'),
                'description'               => $this->input->post('description'),
                'kuota'                     => $this->input->post('kuota'),
                'speed'                     => $this->input->post('speed'),
                'speed_download'            => $this->input->post('speed_download'),
                'speed_upload'              => $this->input->post('speed_upload'),
                'price'                     => $this->input->post('price'),
                'created_at'                => date('Y-m-d H:i:s')
            ];
            $this->product_model->create($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah ditambahkan</div>');
            redirect(base_url('admin/product'), 'refresh');
        }
    }

    public function update($id)
    {
        $product = $this->product_model->detail($id);

        $this->form_validation->set_rules(
            'product_name',
            'Nama Produk',
            'required',
            array('required'         => '%s Harus Diisi')
        );

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Edit Produk',
                'product'              => $product,
                'content'           => 'admin/product/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'id'                        => $id,
                'product_type'              => $this->input->post('product_type'),
                'product_name'              => $this->input->post('product_name'),
                'description'               => $this->input->post('description'),
                'kuota'                     => $this->input->post('kuota'),
                'speed'                     => $this->input->post('speed'),
                'speed_download'            => $this->input->post('speed_download'),
                'speed_upload'              => $this->input->post('speed_upload'),
                'price'                     => $this->input->post('price'),
                'updated_at'                => date('Y-m-d H:i:s')
            ];
            $this->product_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Data telah di Update</div>');
            redirect(base_url('admin/product'), 'refresh');
        }
    }

    public function delete($id)
    {
        is_login();

        $product = $this->product_model->detail($id);
        $data = ['id'   => $product->id];
        $this->product_model->delete($data);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data telah di Hapus</div>');
        redirect(base_url('admin/product'), 'refresh');
    }
}
