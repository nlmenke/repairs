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

            <div class="widget grid3">
                <div class="widget-content">

                    <? echo form_open('auth/change_password')."\n"; ?>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-unlock icon"></i></span>
                            <? echo form_input($old_password, '', 'class="form-control" placeholder="'.lang('change_password_old_password_label').'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                            <? echo form_input($new_password, '', 'class="form-control" placeholder="'.sprintf(lang('change_password_new_password_label'), $min_password_length).'"')."\n"; ?>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key icon"></i></span>
                            <? echo form_input($new_password_confirm, '', 'class="form-control" placeholder="'.lang('change_password_new_password_confirm_label').'"')."\n"; ?>
                        </div>

                        <? echo form_input($user_id)."\n"; ?>

                        <? echo form_button(array(
                            'type'    => 'submit',
                            'name'    => 'submit',
                            'class'   => 'btn btn-green pull-right',
                            'content' => lang('change_password_submit_btn')
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

<?php echo $this->load->view('partial/footer')."\n" ?>