<?php

class Image_uploader
{

var $CI;
var $config=array();
	function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->library('image_lib'); 
		$this->config['image_library'] = 'gd2';
		$this->config['create_thumb'] = false;
		$this->config['thumb_marker'] = 'None';
		$this->config['maintain_ratio'] = TRUE;
		$this->config['master_dim'] = 'width';

	}
	
	function create_images($width,$height,$sImg,$dImg){
			/*$destImg='./'.$dImg.basename($sImg);
			$srcImg='./'.$sImg;*/
			
			//$srcImg='./uploaded/'.strtolower($section).'/';
			//echo 'source image'.$sImg.'<br>';
			//echo 'd image'.$dImg.'<br>';
			$destImg='./'.$dImg.basename($sImg);
			$srcImg='./'.$sImg;
			
			if(!file_exists($dImg)){
				 $this->mkdir_p($dImg);
			}
			//echo $destImg;
			//$img=$destImage.basename($sourceImg);
			if(!is_file($destImg)){
				$this->config['source_image'] = $srcImg;
				$this->config['new_image'] = $destImg;
				$this->config['width'] = $width;
				$this->config['height'] = $height;
				
				$this->CI->image_lib->initialize($this->config); 
				if ( ! $this->CI->image_lib->resize())
				{
					echo $this->CI->image_lib->display_errors();
					//print_r($this->config);
				}
			}
			
	}
	
	function create_thumb_images($section,$source,$destination){
						$imagesSize=$this->CI->config->item('image_managment');
						$pics_sizes=$imagesSize['pics_sizes'][$section];
						foreach($pics_sizes as $key=>$val){
						$dest=	$destination.$key;
							if(!file_exists($dest)){
								 $this->mkdir_p($dest);
							}
							
							$this->config['source_image'] = $source;
							$this->config['new_image'] = $dest;
							$this->config['width'] = $val['width'];
							$this->config['height'] =  $val['height'];
							$this->CI->image_lib->initialize($this->config); 
							if (!$this->CI->image_lib->resize())
							{
								echo $this->CI->image_lib->display_errors();
							}else{
								
								$this->CI->image_lib->clear();
							}
						}
			
	}
	
	function mkdir_p($target)
		{
			if (is_dir($target)||empty($target)) return 1; // best case check first
			//if (file_exists($target) && !is_dir($target)) return 0;
			//if ($this->mkdir_p(substr($target,0,strrpos($target,'/'))))
			//echo 'asdasd'.$target.'<br />';
			return mkdir($target); // crawl back up & create dir tree
			return 0;
		}
}
?>