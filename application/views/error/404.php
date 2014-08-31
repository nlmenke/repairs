<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';

echo doctype('html5')."\n";
?>

<html lang="en">
<head>
    <? echo meta('robots', 'none'); ?>
    <? echo meta('Content-type', 'text/html;charset='.config_item('charset'), 'equiv'); ?>
    <? echo meta('viewport', 'width=device-width, initial-scale=1.0'); ?>
    <title><? echo '404: Page Not Found | '.config_item('company'); ?></title>
    <? echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>
    <? foreach(get_css_files() as $css_file) { ?>
    <? echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
    <? } ?>
    <? foreach(get_js_files() as $js_file) { ?>
    <? echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
    <? } ?>
</head>
<body>
    <div id="wrapper">

        <? echo $this->load->view('partial/topbar')."\n" ?>

        <div id="footer" class="footerror no-sidebar">

            <h1>404</h1>

            <h3><? echo $message; ?></h3>

            <? //echo anchor('report/bug', '<i class="fa fa-bug"></i> Report'); ?>

        </div>
        <!-- END FOOTER -->

    </div>
    <!-- END WRAPPER -->
</body>
</html>