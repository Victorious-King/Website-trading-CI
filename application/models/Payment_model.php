<?php 

class Payment_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    public function getProduct($id) {
        $query = 'SELECT id,name,price FROM product WHERE state=1 and id = '.$id.' ';
        $qr = $this->db->query($query);
        $result = $qr->row_array();
        return $result;
    }

    public function insertOrder($data)
    {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function select_single($table, $where) {
        $q = $this->db
                ->where($where)
                ->get($table);
        return $q->row_array();
    }

}  







