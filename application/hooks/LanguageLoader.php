<?php

class LanguageLoader {

    function initialize() {
        $ci = & get_instance();
        $ci->load->helper('language');

        if ($ci->uri->segment(1) == 'ar') {
            $ci->lang->load('arabic', 'arabic');
        } else if ($ci->uri->segment(1) == 'cn') {
            $ci->lang->load('chinese', 'chinese');
        } else {
            $ci->lang->load('english', 'english');
        }

        //$ci->output->enable_profiler(TRUE);
    }

}
