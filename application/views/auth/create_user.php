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
            <i class="fa fa-user"></i> <? echo $page_title; ?>
        </h1>
    </div>
    <!-- END HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">
        <div class="fluid">

            <div class="widget grid3">
                <div class="widget-content">

                    <p><? echo lang('create_user_subheading'); ?></p>

                    <? echo form_open('auth/create_user')."\n"; ?>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user icon"></i></span>
                            <? echo form_input($first_name, '', 'class="form-control" placeholder="'.lang('create_user_fname_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user icon"></i></span>
                            <? echo form_input($last_name, '', 'class="form-control" placeholder="'.lang('create_user_lname_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o icon"></i></span>
                            <? echo form_input($company, '', 'class="form-control" placeholder="'.lang('create_user_company_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o icon"></i></span>
                            <? echo form_input($email, '', 'class="form-control" placeholder="'.lang('create_user_email_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone icon"></i></span>
                            <? echo form_input($phone, '', 'class="form-control" placeholder="'.lang('create_user_phone_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                            <? echo form_input($password, '', 'class="form-control" placeholder="'.lang('create_user_password_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                            <? echo form_input($password_confirm, '', 'class="form-control" placeholder="'.lang('create_user_password_confirm_label').'"')."\n"; ?>
                        </div>

                        <? echo form_button(array(
                            'type'    => 'submit',
                            'name'    => 'submit',
                            'class'   => 'btn btn-green pull-right',
                            'content' => lang('create_user_submit_btn')
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