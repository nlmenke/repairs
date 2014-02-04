<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';

echo link_tag($cssUrl.'jquery.ui.all.css', 'stylesheet', 'text/css', '', 'screen')."\n";
echo script_tag($jsUrl.'jquery-1.8.0.js')."\n";
echo script_tag($jsUrl.'ui/jquery.ui.core.js')."\n";
echo script_tag($jsUrl.'ui/jquery.ui.widget.js')."\n";
echo script_tag($jsUrl.'ui/jquery.ui.datepicker.js')."\n";