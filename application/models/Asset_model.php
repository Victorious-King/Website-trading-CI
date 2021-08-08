<?php

class Asset_model extends CI_Model {

    var $dt;

    function __construct() {
        parent::__construct();
        $this->dt = date('Y-m-d H:i:s');
        $this->load->library('image_uploader');
    }

    /*public function getImage($name, $size) {

        $arr = explode("/", $name);
        //$arr[count($arr) - 1] = $size . '/' . $arr[count($arr) - 1];
        $arr[count($arr) - 1] = $arr[count($arr) - 1];
        $image = implode("/", $arr);
        return $image;
    }*/

     public function getImage($name, $size) {

        $arr = explode("/", $name);
        $arr[count($arr) - 1] = $size . '/' . $arr[count($arr) - 1];
        $image = implode("/", $arr);
        return $image;
    }
    

    public function addAsset($id, $section, $fileTag = 'files', $ast_state = 1) {
        $this->load->library('upload');
        $this->load->library('image_uploader');
        $new_files_names = array();
        $dirPath = './posted_images/' . strtolower($section) . '/';
        // print_r($_FILES['files']);die;
        
        //pre pare data
        for ($i = 0; $i < count($_FILES[$fileTag]['name']); $i++) {
            // print_r($_FILES['files']['name'][$i]);die;
            if ($_FILES[$fileTag]['name'][$i] <> '') {
                $ext = strtolower(substr(strrchr($_FILES[$fileTag]['name'][$i], '.'), 1));
                $new_files_names[] = 'post_' . date('is') . $i . '_' . $id . '.' . $ext;
                $img = $dirPath . 'post_' . date('is') . $i . '_' . $id . '.' . $ext;

                //insert data
                $data = array(
                    //'type' => 'image',
                    'section' => $section,
                    'section_id' => $id,                    
                    'image' => $img,
                    'state' => $ast_state,
                    'front_image' => 1
                );

                $this->db->insert('assets', $data);

            }
        }

        //exit;
        $this->upload->initialize(array(
            "file_name" => $new_files_names,
            "upload_path" => $dirPath,
            "allowed_types" => 'gif|jpg|jpeg|png|png',
            "max_size" => '0'
        ));

        //if($this->upload->do_multi_upload("files")){
        $this->upload->do_multi_upload($fileTag);
        //print_r($this->upload->display_errors());
        //echo '<br>'.$new_files_names.'<br>';
        //print_r($new_files_names);
        //thumbs
        //die();
        $uploaded = $this->upload->get_multi_upload_data();

        foreach ($uploaded as $thumb) {
            $this->image_uploader->create_thumb_images($section, $thumb['full_path'], $dirPath);
        }
        return $new_files_names;
    }

    public function addAssetLogo($id, $section, $fileTag = 'logoimg', $ast_state = 1) {
        $this->load->library('upload');
        $this->load->library('image_uploader');
        $new_files_names = array();
        $dirPath = './posted_images/' . strtolower($section) . '/';

        
        //pre pare data
        for ($i = 0; $i < count($_FILES[$fileTag]['name']); $i++) {
            if ($_FILES[$fileTag]['name'][$i] <> '') {
                $ext = strtolower(substr(strrchr($_FILES[$fileTag]['name'][$i], '.'), 1));
                $new_files_names[] = 'post_' . date('is') . $i . '_' . $id . '.' . $ext;
                $img = $dirPath . 'post_' . date('is') . $i . '_' . $id . '.' . $ext;

                //insert data
                $data = array(
                    'type' => 'image',
                    'section' => $section,
                    'section_id' => $id,                    
                    'image' => $img,
                    'state' => $ast_state,
                    'front_image' => 1
                );

                $this->db->insert('assets_logo', $data);

            }
        }

        //exit;
        $this->upload->initialize(array(
            "file_name" => $new_files_names,
            "upload_path" => $dirPath,
            "allowed_types" => 'gif|jpg|jpeg|png|png',
            "max_size" => '0'
        ));

        //if($this->upload->do_multi_upload("files")){
        $this->upload->do_multi_upload($fileTag);
        //print_r($this->upload->display_errors());
        //echo '<br>'.$new_files_names.'<br>';
        //print_r($new_files_names);
        //thumbs
        //die();
        $uploaded = $this->upload->get_multi_upload_data();

        foreach ($uploaded as $thumb) {
            $this->image_uploader->create_thumb_images($section, $thumb['full_path'], $dirPath);
        }
        return $new_files_names;
    }

    public function addAssetBoat($id, $section, $fileTag = 'files', $ast_state = 1) {
        $this->load->library('upload');
        $this->load->library('image_uploader');
        $new_files_names = array();
        $dirPath = './posted_images/' . strtolower($section) . '/';

        
        //pre pare data
        for ($i = 0; $i < count($_FILES[$fileTag]['name']); $i++) {
            if ($_FILES[$fileTag]['name'][$i] <> '') {
                $ext = strtolower(substr(strrchr($_FILES[$fileTag]['name'][$i], '.'), 1));
                $new_files_names[] = 'post_' . date('is') . $i . '_' . $id . '.' . $ext;
                $img = $dirPath . 'post_' . date('is') . $i . '_' . $id . '.' . $ext;

                //insert data
                $data = array(
                    'type' => 'image',
                    'section' => $section,
                    'section_id' => $id,                    
                    'image' => $img,
                    'state' => $ast_state,
                    'front_image' => 1
                );

                $this->db->insert('assets_boat', $data);

            }
        }

        //exit;
        $this->upload->initialize(array(
            "file_name" => $new_files_names,
            "upload_path" => $dirPath,
            "allowed_types" => 'gif|jpg|jpeg|png|png',
            "max_size" => '0'
        ));

        //if($this->upload->do_multi_upload("files")){
        $this->upload->do_multi_upload($fileTag);
        //print_r($this->upload->display_errors());
        //echo '<br>'.$new_files_names.'<br>';
        //print_r($new_files_names);
        //thumbs
        //die();
        $uploaded = $this->upload->get_multi_upload_data();

        foreach ($uploaded as $thumb) {
            $this->image_uploader->create_thumb_images($section, $thumb['full_path'], $dirPath);
        }
        return $new_files_names;
    }

    public function addAssetBike($id, $section, $fileTag = 'files', $ast_state = 1) {
        $this->load->library('upload');
        $this->load->library('image_uploader');
        $new_files_names = array();
        $dirPath = './posted_images/' . strtolower($section) . '/';

        
        //pre pare data
        for ($i = 0; $i < count($_FILES[$fileTag]['name']); $i++) {
            if ($_FILES[$fileTag]['name'][$i] <> '') {
                $ext = strtolower(substr(strrchr($_FILES[$fileTag]['name'][$i], '.'), 1));
                $new_files_names[] = 'post_' . date('is') . $i . '_' . $id . '.' . $ext;
                $img = $dirPath . 'post_' . date('is') . $i . '_' . $id . '.' . $ext;

                //insert data
                $data = array(
                    'type' => 'image',
                    'section' => $section,
                    'section_id' => $id,                    
                    'image' => $img,
                    'state' => $ast_state,
                    'front_image' => 1
                );

                $this->db->insert('assets_bike', $data);

            }
        }

        //exit;
        $this->upload->initialize(array(
            "file_name" => $new_files_names,
            "upload_path" => $dirPath,
            "allowed_types" => 'gif|jpg|jpeg|png|png',
            "max_size" => '0'
        ));

        //if($this->upload->do_multi_upload("files")){
        $this->upload->do_multi_upload($fileTag);
        //print_r($this->upload->display_errors());
        //echo '<br>'.$new_files_names.'<br>';
        //print_r($new_files_names);
        //thumbs
        //die();
        $uploaded = $this->upload->get_multi_upload_data();

        foreach ($uploaded as $thumb) {
            $this->image_uploader->create_thumb_images($section, $thumb['full_path'], $dirPath);
        }
        return $new_files_names;
    }


    public function addAssetMarker($id, $section, $fileTag = 'logomarker', $ast_state = 1) {
        $this->load->library('upload');
        $this->load->library('image_uploader');
        $new_files_names = array();
        $dirPath = './posted_images/' . strtolower($section) . '/';

        
        //pre pare data
        for ($i = 0; $i < count($_FILES[$fileTag]['name']); $i++) {
            if ($_FILES[$fileTag]['name'][$i] <> '') {
                $ext = strtolower(substr(strrchr($_FILES[$fileTag]['name'][$i], '.'), 1));
                $new_files_names[] = 'post_' . date('is') . $i . '_' . $id . '.' . $ext;
                $img = $dirPath . 'post_' . date('is') . $i . '_' . $id . '.' . $ext;

                //insert data
                $data = array(
                    //'type' => 'image',
                    'section' => $section,
                    'section_id' => $id,                    
                    'image' => $img,
                    'state' => $ast_state,
                    'front_image' => 1
                );

                $this->db->insert('assets', $data);

            }
        }

        //exit;
        $this->upload->initialize(array(
            "file_name" => $new_files_names,
            "upload_path" => $dirPath,
            "allowed_types" => 'gif|jpg|jpeg|png|png',
            "max_size" => '0'
        ));

        //if($this->upload->do_multi_upload("files")){
        $this->upload->do_multi_upload($fileTag);
        //print_r($this->upload->display_errors());
        //echo '<br>'.$new_files_names.'<br>';
        //print_r($new_files_names);
        //thumbs
        //die();
        $uploaded = $this->upload->get_multi_upload_data();

        foreach ($uploaded as $thumb) {
            $this->image_uploader->create_thumb_images($section, $thumb['full_path'], $dirPath);
        }
        return $new_files_names;
    }

    public function getAssets($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsBoat($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets_boat WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsBike($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets_bike WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsMyads($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND (state=1 or state=2) order by id ASC';       
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsMyadsBoat($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets_boat WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND (state=1 or state=2) order by id ASC';       
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsMyadsBike($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets_bike WHERE section_id="' . $section_id . '" AND section="' . $section . '" AND (state=1 or state=2) order by id ASC';       
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsCover($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets WHERE section_id="' . $section_id . '" AND section="Cover" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsLogo($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets_logo WHERE section_id="' . $section_id . '" AND section="Logo" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsBrand($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets WHERE section_id="' . $section_id . '" AND section="Brand" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAssetsMarker($section, $section_id) {
        $query = 'SELECT id,image,front_image,section_id FROM assets WHERE section_id="' . $section_id . '" AND section="Marker" AND state=1 order by id ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function removeAsset($id) {
        $data = array('state' => '0');
        $this->db->update('assets', $data, 'id = "' . $id . '"');
    }

    public function removeAssetBoat($id) {
        $data = array('state' => '0');
        $this->db->update('assets_boat', $data, 'id = "' . $id . '"');
    }

    public function removeAssetBike($id) {
        $data = array('state' => '0');
        $this->db->update('assets_bike', $data, 'id = "' . $id . '"');
    }

    public function removeAssetLogo($id) {
        $data = array('state' => '0');
        $this->db->update('assets_logo', $data, 'id = "' . $id . '"');
    }

    public function approveAsset($id, $type = "", $section_id="") {
       
        $query = 'UPDATE assets SET state=1 WHERE id = ' . $id . ' AND section = "' . $type . '" ';
        $this->db->query($query);  
        
    }

    public function approveCkImages($ids, $type = "") {
        if (!empty($ids)) {
            $ids2 = implode(",", $ids);            
            $query = 'UPDATE assets SET state=1 WHERE section_id in (' . $ids2 . ') AND section = "' . $type . '" AND state=2 ';
            $this->db->query($query);
            //$this->approve_by($ids2,$type);

        }
    }


    

    
}
?>