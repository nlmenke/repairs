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
            <i class="fa fa-lock"></i> <? echo $page_title; ?>
        </h1>
    </div>
    <!-- END HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">
        <div class="fluid">

            <div class="widget grid2">
                <div class="widget-content">

                    <p style="text-align:center;"><? echo sprintf(lang('deactivate_subheading'), $user->username); ?></p>

                    <? echo form_open('auth/deactivate/'.$user->id)."\n"; ?>

                        <div class="custom-input" style="width:100%;">
                            <? echo form_radio(array(
                                'name'    => 'confirm',
                                'id'      => 'yes',
                                'value'   => 'yes',
                                'checked' => false
                            )).' '.lang('deactivate_confirm_y_label', 'yes'); ?>

                            <? echo form_radio(array(
                                'name'    => 'confirm',
                                'id'      => 'no',
                                'value'   => 'no',
                                'checked' => true
                            )).' '.lang('deactivate_confirm_n_label', 'no'); ?>
                        </div>

                        <? echo form_hidden($csrf); ?>

                        <? echo form_hidden(array('id' => $user->id)); ?>

                        <? echo form_button(array(
                            'type'    => 'submit',
                            'name'    => 'submit',
                            'class'   => 'btn btn-green pull-right',
                            'content' => lang('deactivate_submit_btn')
                        ))."\n"; ?>

                    <? echo form_close()."\n"; ?>

                </div>
                <!-- END WIDGET-CONTENT -->
            </div>
            <!-- END WIDGET -->

        </div>
        <!-- END FLUID -->
    </div>
    <!-- END WRAP -->

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>