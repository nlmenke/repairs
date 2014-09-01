<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>

<? echo $this->load->view('partial/header')."\n" ?>

<? echo $this->load->view('partial/sidebar')."\n" ?>

<div id="content" class="clearfix">

    <div class="header">
        <h1 class="page-title">
            <i class="fa fa-comments"></i> <? echo $page_title; ?>
        </h1>
    </div>
    <!-- END HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">

        <? if(APP_STATUS == 'alpha' || APP_STATUS == 'beta') { ?>

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
                        <i class="fa fa-phone"></i> <? echo lang('messages_people_to_call'); ?>
                    </div>
                    <div class="widget-controls">
                        <div class="badge msg-badge">
                            <? echo count($calls); ?>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <? if(count($calls) > 0) { ?>

                <? foreach($calls as $call) { ?>

                <div class="comment">
                    <div class="comment-body">

                        <? echo $call->title; ?>

                        <div class="comment-info">

                            From:
                            <span><? echo ($call->from_id == '0') ? 'System' : $this->ion_auth->user($call->from_id)->row()->first_name.' '.$this->ion_auth->user($call->from_id)->row()->last_name; ?></span>
                            Sent:
                            <span><? echo date('m/d/y g:i a', strtotime($call->sent)); ?></span>

                            <? if($call->completed != null) { ?>

                            Completed:
                            <span><?php echo date('m/d/y g:i a', strtotime($call->completed)); ?></span>

                            <? } ?>

                        </div>

                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

                <? } else { ?>

                <div class="comment">
                    <div class="comment-body">
                        <? echo lang('messages_no_calls'); ?>
                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

            </div>
            <!-- END WIDGET -->

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-wrench"></i> <? echo lang('messages_consoles_to_fix'); ?>
                    </div>
                    <div class="widget-controls">
                        <div class="badge msg-badge">
                            <? echo count($fixes); ?>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <? if(count($fixes) > 0) { ?>

                <? foreach($fixes as $fix) { ?>

                <div class="comment">
                    <div class="comment-body">

                        <? echo $fix->title; ?><br />

                        <div class="comment-info">

                            From:
                            <span><? echo ($fix->from_id == '0') ? 'System' : $this->ion_auth->user($fix->from_id)->row()->first_name.' '.$this->ion_auth->user($fix->from_id)->row()->last_name; ?></span>
                            Sent:
                            <span><? echo date('m/d/y g:i a', strtotime($fix->sent)); ?></span>

                            <? if($fix->completed != null) { ?>

                            Completed:
                            <span><? echo date('m/d/y g:i a', strtotime($fix->completed)); ?></span>

                            <? } ?>

                        </div>

                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

                <? } else { ?>

                <div class="comment">
                    <div class="comment-body">
                        <? echo lang('messages_no_repairs'); ?>
                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

            </div>
            <!-- END WIDGET -->

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-comments-o"></i> <? echo lang('messages_misc'); ?>
                    </div>
                    <div class="widget-controls">
                        <div class="badge msg-badge">
                            <? echo count($miscs); ?>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <? if(count($miscs) > 0) { ?>

                <? foreach($miscs as $misc) { ?>

                <div class="comment">
                    <div class="comment-body">

                        <? echo $misc->title; ?><br />

                        <div class="comment-info">

                            From:
                            <span><? echo ($misc->from_id == '0') ? 'System' : $this->ion_auth->user($misc->from_id)->row()->first_name.' '.$this->ion_auth->user($misc->from_id)->row()->last_name; ?></span>
                            Sent:
                            <span><? echo date('m/d/y g:i a', strtotime($misc->sent)); ?></span>

                            <? if($misc->completed != null) { ?>

                            Completed:
                            <span><? echo date('m/d/y g:i a', strtotime($misc->completed)); ?></span>

                            <? } ?>

                        </div>

                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

                <? } else { ?>

                <div class="comment">
                    <div class="comment-body">
                        <? echo lang('messages_no_misc'); ?>
                    </div>
                </div>
                <!-- END COMMENT -->

                <? } ?>

            </div>
            <!-- /widget -->

        </div>
        <!-- /fluid -->
    </div>
    <!-- /wrap -->

    <? if($this->ion_auth->is_admin()) { ?>

    <span class="rendered"><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?></span>

    <? } ?>

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>