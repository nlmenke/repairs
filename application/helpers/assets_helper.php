<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:         Assets
| Category:     Helpers
| Author:       N.L.Menke
|               n.menke@ubreakifix.com
|               @NLMenke
| Location:     http://repairs.gamersorlando.com/
| Created:      10/26/2012
| Description:  Holds the list of CSS and JS files used on various pages.
*/

$ci =& get_instance();
$ci->load->helper('javascript');

if(!function_exists('get_form_css_files')) {
    /**
     * @return array
     */
    function get_css_files() {
        $css_url = base_url().'assets/styles/';

        if(!defined('ENVIRONMENT') || ENVIRONMENT == 'development') {
            $dev = '.dev';
        } else {
            $dev = '';
        }

        return array(
            array('path'  => $css_url.'bootstrap'.$dev.'.css',
                  'media' => 'all'
            ),
            array(
                'path'  => $css_url.'bootstrap-datepicker'.$dev.'.css',
                'media' => 'all'
            ),
            array(
                'path'  => $css_url.'font-awesome'.$dev.'.css',
                'media' => 'all'
            ),
            array(
                'path'  => $css_url.'jquery-ui'.$dev.'.css',
                'media' => 'all'
            ),
            array(
                'path'  => $css_url.'style'.$dev.'.css',
                'media' => 'all'
            ),
            array(
                'path'  => $css_url.'toastr'.$dev.'.css',
                'media' => 'all'
            ),
        );
    }
}

if(!function_exists('get_form_js_files')) {
    /**
     * @return array
     */
    function get_js_files() {
        $js_url = base_url().'assets/scripts/';

        if(!defined('ENVIRONMENT') || ENVIRONMENT == 'development') {
            $dev = '';
        } else {
            $dev = '.min';
        }

        return array(
            array('path' => $js_url.'prefixfree.min.js'),
            array('path' => $js_url.'jquery-1.10.2'.$dev.'.js'),
            array('path' => $js_url.'jquery-ui'.$dev.'.js'),
            array('path' => $js_url.'bootstrap'.$dev.'.js'),
            array('path' => $js_url.'bootstrap-datepicker'.$dev.'.js'),
            array('path' => $js_url.'excanvas.min.js'),
            array('path' => $js_url.'jquery.validate'.$dev.'.js'),
            array('path' => $js_url.'jquery.maskedinput'.$dev.'.js'),
            array('path' => $js_url.'jquery.flot.js'),
            array('path' => $js_url.'jquery.flot.resize.js'),
            array('path' => $js_url.'jquery.flot.categories.js'),
            array('path' => $js_url.'jquery.flot.fillbetween.js'),
            array('path' => $js_url.'jquery.flot.stack.js'),
            array('path' => $js_url.'jquery.flot.crosshair.js'),
            array('path' => $js_url.'jquery.sparkline.min.js'),
            array('path' => $js_url.'jquery.hashchange.min.js'),
            array('path' => $js_url.'jquery.easytabs.min.js'),
            array('path' => $js_url.'toastr'.$dev.'.js'),
            array('path' => $js_url.'common'.$dev.'.js'),
        );
    }
}

/* End of file assets_helper.php */
/* Location: ./application/helpers/assets_helper.php */