<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>

<? echo $this->load->view('partial/header')."\n" ?>

<div id="content" class="c-login clearfix">

    <div class="header"></div>

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="widget-content">

        <? echo form_open('auth/login')."\n"; ?>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o icon"></i></span>
                <? echo form_input($identity, '', 'class="form-control" placeholder="'.lang('login_identity_label').'"')."\n"; ?>
            </div>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                <? echo form_input($password, '', 'class="form-control" placeholder="'.lang('login_password_label').'"')."\n"; ?>
            </div>

            <? echo form_button(array(
                'type'    => 'submit',
                'name'    => 'submit',
                'class'   => 'btn btn-green pull-right',
                'content' => '<i class="fa fa-sign-in"></i> '.lang('login_submit_btn')
            ))."\n"; ?>

        <? echo form_close()."\n"; ?>

    </div>
    <!-- END WIDGET-CONTENT -->

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>