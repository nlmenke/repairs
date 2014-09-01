<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>

<? echo $this->load->view('partial/header')."\n" ?>

<div id="content" class="c-login clearfix">

    <div class="header"></div>

    <? echo $this->breadcrumb->output(); ?>

    <div class="widget-content">

        <p style="text-align:center;"><? echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

        <? echo form_open('auth/forgot_password')."\n"; ?>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o icon"></i></span>
                <? echo form_input($email, '', 'class="form-control" placeholder="'.sprintf(lang('forgot_password_email_label'), $identity_label).'"')."\n"; ?>
            </div>

            <? echo form_button(array(
                'type'    => 'submit',
                'name'    => 'submit',
                'class'   => 'btn btn-green pull-right',
                'content' => lang('forgot_password_submit_btn')
            ))."\n"; ?>

        <? echo form_close()."\n"; ?>

    </div>
    <!-- END WIDGET-CONTENT -->

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>