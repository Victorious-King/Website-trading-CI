<?php 

class Admin_tagsdesc_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    

    public function insertTagsdesc($data)
    {
        $this->db->insert('tags_desc', $data);
        return $this->db->insert_id();
    }
    

    public function listTagsdesc($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $where ='c.state=1';

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM tags_desc c where '.$where.''); 
        $qr='select c.id,c.make_id,c.model_id,c.desc,c.type,c.created_dt,c.created_by,mk.make,md.model
                from tags_desc c 
                left join make mk on (c.make_id=mk.id)
                left join model md on (c.model_id=md.id)                         
                where '.$where.'
                group by c.id
                order by id desc
                limit '.$offset.' ,'.$limit.'
                ';         
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editTagsdesc($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('tags_desc', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateTagsdesc($id)
    {
        $email=$this->session->userdata('email');
        $date = date('Y-m-d H:i:s');

        $title=$this->input->post('title');
        $title_slug = $this->common_model->create_slug($title); 

        $update_data=array(
               'type' => $this->input->post('type'),                
                'make_id' => $this->input->post('make_id'),
                'model_id' => $this->input->post('model_id'),                
                'desc' => $this->input->post('desc'),
                'desc_ar' => $this->input->post('desc_ar'),

                'h1_tag' => $this->input->post('h1_tag'),
                'h1_tag_ar' => $this->input->post('h1_tag_ar'),

                'edited_dt' => $email,
                'edited_by' => $email,
                'state' => 1
                                
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('tags_desc', $update_data);
        }
        return $id;
    }

    public function deleteTagsdesc($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('tags_desc', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }



    

    

}  







