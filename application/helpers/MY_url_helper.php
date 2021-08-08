<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * asset_url
 * CDN'ized content.
 */

function theme_url()
{
   $CI =& get_instance();
   return $CI->config->item('theme_url').'/';
}

function upload_url()
{
   $CI =& get_instance();
   return $CI->config->item('upload_url').'/';
}

function base_url_images()
{
   $CI =& get_instance();
   return $CI->config->item('base_url_images').'/';
}
