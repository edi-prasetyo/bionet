<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //list Product
    public function get_product()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('product.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function product_monthly()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_type', 'monthly');
        $this->db->order_by('product.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Detail Product
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product.id', $id);
        $this->db->order_by('product.id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }
    //tambah / Insert Data
    public function create($data)
    {
        $this->db->insert('product', $data);
    }

    //Edit Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('product', $data);
    }

    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('product', $data);
    }

    //Read Product Front End
    public function read($product_slug)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where(array(
            'product.product_slug'        =>  $product_slug
        ));
        $query = $this->db->get();
        return $query->row();
    }
    public function order($product_id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where(array(
            'md5(product.id)'        =>  $product_id
        ));
        $query = $this->db->get();
        return $query->row();
    }
    // GET AUTOFILL
    public function get_autofill($id)
    {

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }
}
