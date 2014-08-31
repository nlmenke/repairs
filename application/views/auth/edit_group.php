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
            <i class="fa fa-group"></i> <? echo $page_title; ?>
        </h1>
    </div>
    <!-- END HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">
        <div class="fluid">

            <div class="widget grid3">
                <div class="widget-content">

                    <p style="text-align:center;"><? echo lang('edit_group_subheading'); ?></p>

                    <? echo form_open(current_url())."\n"; ?>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-group icon"></i></span>
                            <? echo form_input($group_name, '', 'class="form-control" placeholder="'.lang('edit_group_name_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-info icon"></i></span>
                            <? echo form_input($group_description, '', 'class="form-control" placeholder="'.lang('edit_group_desc_label').'"')."\n"; ?>
                        </div>

                        <? echo form_button(array(
                            'type'    => 'submit',
                            'name'    => 'submit',
                            'class'   => 'btn btn-green pull-right',
                            'content' => lang('edit_group_submit_btn')
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