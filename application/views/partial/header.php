<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';

echo doctype('html5')."\n";
?>

<html lang="<? echo lang('common_lang'); ?>">
<head>
    <? echo meta('robots', 'none'); ?>
    <? echo meta('Content-type', 'text/html;charset='.config_item('charset'), 'equiv'); ?>
    <? echo meta('viewport', 'width=device-width, initial-scale=1.0'); ?>
    <base href="<? echo base_url(); ?>" />
    <title><? echo $page_title.' | '.config_item('company'); ?></title>
    <? echo link_tag(base_url().'assets/favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>

    <? foreach(get_css_files() as $css_file) { ?>
    <? echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
    <? } ?>

    <script type="text/javascript">
    var SITE_URL = '<? echo site_url(); ?>';
    </script>
</head>
<body>
    <div id="wrapper">

        <? echo $this->load->view('partial/topbar')."\n" ?>