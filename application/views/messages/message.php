<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>

<?php echo $this->load->view('partial/header')."\n" ?>

<?php echo $this->load->view('partial/sidebar')."\n" ?>

<div id="content" class="clearfix">

    <div class="header">
        <h1 class="page-title">
            <i class="fa fa-comment"></i> <?php echo $page_title; ?>
        </h1>
    </div>
    <!-- ENd HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">

        <? if(APP_STATUS == 'dev') { ?>

        <div id="alert">
            <div class="alert alert-warning">
                <p class="alert-message"><? echo lang('common_site_dev_msg'); ?></p>
            </div>
        </div>
        <!-- END ALERT -->

        <? } elseif(APP_STATUS == 'alpha' || APP_STATUS == 'beta') { ?>

        <div id="alert">
            <div class="alert alert-info">
                <p class="alert-message"><? echo (config_item('email') != '') ? sprintf(lang('common_site_test_msg'), config_item('email')) : lang('common_site_test_msg_no_mail'); ?></p>
            </div>
        </div>
        <!-- END ALERT -->

        <? } ?>

        <div class="fluid">

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-inbox"></i> <? echo lang(''); ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="comment">
                    <div class="comment-body">

                        <? echo $message_info->title; ?>

                        <div class="comment-info">

                            From:
                            <span><? echo ($message_info->from_id == '0') ? 'System' : $this->ion_auth->user($message_info->from_id)->row()->first_name.' '.$this->ion_auth->user($message_info->from_id)->row()->last_name; ?></span>
                            Sent:
                            <span><? echo date('m/d/y g:i a', strtotime($message_info->sent)); ?></span>

                            <? if($message_info->completed != null) { ?>

                            Completed:
                            <span><? echo date('m/d/y g:i a', strtotime($message_info->completed)); ?></span>

                            <? } ?>

                        </div>

                        <? echo $message_info->body; ?><br />

                        <button class="btn btn-mini btn-green">Complete</button>

                    </div>
                </div>
                <!-- END COMMENT -->

            </div>
            <!-- END WIDGET -->

        </div>
        <!-- END FLUID -->
    </div>
    <!-- END WRAP -->

    <? if($this->ion_auth->is_admin()) { ?>

    <span class="rendered"><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?></span>

    <? } ?>

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>