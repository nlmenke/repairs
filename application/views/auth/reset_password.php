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

        <? echo form_open('auth/reset_password/'.$code)."\n"; ?>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                <? echo form_input($new_password, '', 'class="form-control" placeholder="'.sprintf(lang('reset_password_new_password_label'), $min_password_length).'"')."\n"; ?>
            </div>

            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                <? echo form_input($new_password_confirm, '', 'class="form-control" placeholder="'.lang('reset_password_new_password_confirm_label').'"')."\n"; ?>
            </div>

            <? echo form_input($user_id); ?>

            <? echo form_hidden($csrf); ?>

            <? echo form_button(array(
                'type'    => 'submit',
                'name'    => 'submit',
                'class'   => 'btn btn-green pull-right',
                'content' => lang('reset_password_submit_btn')
            ))."\n"; ?>

        <?php echo form_close()."\n"; ?>

    </div>
    <!-- END WIDGET-CONTENT -->

</div>
<!-- END CONTENT -->

<?php echo $this->load->view('partial/footer')."\n" ?>