<?php 

class Admin_brands_model extends CI_Model{
 
    function __construct(){
        parent::__construct();
    }
    
    
    //Make
    public function insertMake($data)
    {
        $this->db->insert('make', $data);
        return $this->db->insert_id();
    }

    public function listMakes($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT id FROM make where state=1'); 
        $qr='select id,make,make_ar,logo from make where state=1 ORDER BY make limit '.$offset.' ,'.$limit.'';      
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function editMake($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('make', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateMake($id)
    {
        $update_data=array(
                'make' => $this->input->post('make'),
                'make_ar' => $this->input->post('make_ar')
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('make', $update_data);
        }
        return $id;
    }

    public function deleteMake($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('make', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }

    

    //Models

    public function listModels($limit,$offset) 
    {   
        $pg=$this->input->get('page');             
        $offset = ($pg == '') ? 0 : ($pg * $limit)-$limit;

        $make_id=$this->input->get('make_id');

        $where ='and md.state=1';

        $where.=($make_id <> '' ? ' and md.make_id=' . $this->db->escape($make_id) . '' : '');

        $dt['totalRows']=$this->common_model->getNumberOfRows('SELECT md.id FROM model md where md.make_id > 0 '.$where.''); 
        $qr='select
                        md.id,
                        md.model,
                        md.model_ar,
                        md.make_id,
                        mk.make
                    from
                        model md
                    left join make mk on(md.make_id=mk.id)
                    where                       
                    md.make_id > 0 '.$where.'
                    ORDER BY
                        make_id limit '.$offset.' ,'.$limit.'';      
        $rs = $this->db->query($qr);
        $dt['search_result']=$rs->result_array();

        $rs->free_result();
        return $dt;
    }

    public function insertModel($data)
    {
        $this->db->insert('model', $data);
        return $this->db->insert_id();
    }

    public function editModel($id) {
        if($id != FALSE) {
            $query = $this->db->get_where('model', array('id' => $id));
            return $query->row_array();
        }
        else {
            return FALSE;
        }
    }

    public function updateModel($id)
    {
        $update_data=array(
                'make_id' => $this->input->post('make_id'), 
                'model' => $this->input->post('model'),             
                'model_ar' => $this->input->post('model_ar'),   
                );
    
        if($id>0){
            $this->db->where('id', $id);
            $this->db->update('model', $update_data);
        }
        return $id;
    }

    public function deleteModel($id) 
    {           
        if($id != FALSE) {
            $this->db->where('id', $id);
            $this->db->update('model', array('state' => 0));
            return $id;
        } else {
            return FALSE;
        }        
    }



}  



