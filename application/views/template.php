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
    <? echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>

    <? foreach(get_css_files() as $css_file) { ?>
    <? echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
    <? } ?>

    <script type="text/javascript">
    var SITE_URL = '<? echo site_url(); ?>';
    </script>

    <? foreach(get_js_files() as $js_file) { ?>
    <? echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
    <? } ?>
</head>
<body>
    <div id="wrapper">

        <? echo $this->load->view('partial/topbar')."\n" ?>

        <? echo $this->load->view('partial/sidebar')."\n" ?>

        <div id="content" class="clearfix">

            <div class="header">
                <h1 class="page-title">
                    <?php
                    if(isset($page_icon)) echo '<i class="fa fa-'.$page_icon.'"></i> ';
                    echo $page_title;
                    ?>
                </h1>
            </div>
            <!-- END HEADER -->

            <div class="breadcrumbs">
                <i class="fa fa-home"></i> Home
                <i class="fa fa-caret-right"></i> Repairs
                <i class="fa fa-caret-right"></i> Archive
            </div>
            <!-- END BREADCRUMBS -->

            <div class="wrap clearfix">
                <? echo $this->load->view($content)."\n"; ?>
            </div>

        </div>
        <!-- END CONTENT -->

        <footer class="footer">

            <span class="copyright"><? echo copyright('2012'); ?></span>
			<span class="version">

				<? if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) { ?>

                <span><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?>.</span>

                <? } ?>

                <? if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) { ?>

                Version <? echo app_version('full').' '.lang('common_by').' '.anchor('https://github.com/nlmenke', 'N.L.Menke'); ?>.

                <? } else { ?>

                Version <? echo app_version(); ?>.

                <? } ?>

			</span>

        </footer>
        <!-- END FOOTER -->

    </div>
    <!-- END WRAPPER -->

    <? if(isset($message) && $message != '') { ?>
    <script type="text/javascript">
    $(window).load(function() {
        toastr.options = {
            'positionClass': 'toast-bottom-right',
            'timeOut': 0
        };
        <? $message = array_reverse(explode("\n", $message)); ?>

        <? foreach($message as $msg) { ?>
        <? if($msg != '') { ?>
        toastr.error('<? echo str_replace(array('<p>', '</p>'), '', $msg); ?>', 'Authentication');
        <? } ?>
        <? } ?>

    });
    </script>
    <? } ?>
</body>
</html>