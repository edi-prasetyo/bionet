<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltransaction()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.status', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function new_transaction()
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('transaction.status', 1);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaction($limit, $start)
    {
        $this->db->select('transaction.*, product.product_type');
        $this->db->from('transaction');
        // Join
        $this->db->join('product', 'product.id = transaction.product_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function total_row()
    {
        $this->db->select('transaction.*, user.user_name');
        $this->db->from('transaction');
        // Join
        $this->db->join('user', 'user.id = transaction.customer_id', 'LEFT');
        //End Join
        $this->db->where('transaction.status', 1);
        $this->db->order_by('transaction.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id)
    {
        $this->db->select('transaction.*, product.product_type');
        $this->db->from('transaction');
        // Join
        $this->db->join('product', 'product.id = transaction.product_id', 'LEFT');
        //End Join
        $this->db->where(['transaction.id' => $id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function payment($insert_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where(['md5(transaction.id)' => $insert_id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function last_detail($insert_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where(['transaction.id' => $insert_id, 'transaction.status'   => 1]);
        $query = $this->db->get();
        return $query->row();
    }



    //Create
    public function create($data)
    {
        $this->db->insert('transaction', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaction', $data);
    }
    //Update Notif Midtrans
    public function update_notif($data)
    {
        $this->db->where('order_id', $data['order_id']);
        $this->db->update('transaction', $data);
    }
    public function update_paid($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaction', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaction', $data);
    }
}
