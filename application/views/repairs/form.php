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
            <i class="fa fa-wrench"></i> <? echo $page_title; ?>
        </h1>
    </div>
    <!-- END HEADER -->

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

        <div id="alert">
            <div class="alert alert-info">
                <p class="alert-message"><? echo lang('common_fields_required'); ?></p>
            </div>
        </div>
        <!-- END ALERT -->

        <? echo form_open('repairs/save/'.$repair_info->ticket_id, array(
            'id'    => 'form_repair',
            'class' => 'fluid'
        ))."\n"; ?>

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-user"></i> <? echo lang('repairs_info_customer')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_first_name').':', 'customer_first', array('class' => 'required')); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'customer_first',
                                'value' => $repair_info->customer_first
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_last_name').':', 'customer_last', array('class' => 'required')); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'customer_last',
                                'value' => $repair_info->customer_last
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_phone_number').':', 'phone_number', array('class' => 'required')); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'phone_number',
                                'value' => format_phone($repair_info->phone_number),
                                'class' => 'phone'
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_email_address').':', 'email_address'); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'email_address',
                                'value' => $repair_info->email_address
                            )); ?>
                        </div>
                    </div>

                    <hr />

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_drop_off_employee').':', 'drop_off_employee'); ?>

                        <? if($ticket_id == -1) { ?>

                        <div class="form_field dropdown">
                            <?php
                            $employee_list = array_slice($employees, 1);
                            echo form_dropdown('drop_off_employee', $employee_list, ($repair_info->drop_off_employee) ? $repair_info->drop_off_employee : $user->first_name, 'class="dropdown-select"');
                            ?>
                        </div>

                        <? } else { ?>

                        <div class="form_static">
                            <? echo $repair_info->drop_off_employee; ?>
                        </div>

                        <? } ?>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_drop_off_date').':', 'drop_off_date'); ?>

                        <div class="form_field input-group date">
                            <? echo form_input(array(
                                'name'     => 'drop_off_date',
                                'class'    => 'form-control',
                                'value'    => $repair_info->repair_date ? date('m/d/Y g:ia', strtotime($repair_info->drop_off_date)) : date('m/d/Y g:ia'),
                                'readonly' => 'readonly'
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-quote-left"></i> <? echo lang('repairs_info_problem')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_repair_type').':', 'repair_type'); ?>

                        <div class="form_field dropdown">
                            <? echo form_dropdown('repair_type', $repair_type, ($repair_info->repair_type) ? $repair_info->repair_type : 'console', 'id="repair_type" class="dropdown-select"')."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">

                        <? echo form_label(lang('repairs_item_game').':', 'item', array(
                            'id'    => 'item_game',
                            'class' => 'required'
                        )); ?>

                        <? echo form_label(lang('repairs_item_mod').':', 'item', array(
                            'id'    => 'item_mod',
                            'class' => 'required'
                        )); ?>

                        <? echo form_label(lang('repairs_item_repair').':', 'item', array(
                            'id'    => 'item_repair',
                            'class' => 'required'
                        )); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'item',
                                'value' => $repair_info->item
                            )); ?>
                        </div>

                    </div>

                    <div class="field_row clearfix">

                        <? echo form_label(lang('repairs_description_mod').':', 'problem', array(
                            'id'    => 'description_mod',
                            'class' => 'required'
                        )); ?>

                        <? echo form_label(lang('repairs_description_problem').':', 'problem', array(
                            'id'    => 'description_problem',
                            'class' => 'required'
                        )); ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'problem',
                                'value' => $repair_info->problem
                            )); ?>
                        </div>

                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_price').':', 'price', array('class' => 'required')); ?>

                        <div class="form_field input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <? echo form_input(array(
                                'name'  => 'price',
                                'class' => 'form-control',
                                'value' => $repair_info->price
                            )); ?>
                            <span class="input-group-addon" style="font-weight:bold;">.00</span>
                        </div>
                    </div>

                    <div id="game_inside_check" class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'    => 'game_inside',
                                'id'      => 'game_inside',
                                'value'   => '1',
                                'checked' => ($ticket_id == -1) ? false : (($repair_info->game_inside) ? true : false)
                            )).' '.form_label(lang('repairs_game_inside').'?', 'game_inside', 'id="game_inside" class="checkbox"'); ?>
                        </div>
                    </div>

                    <div id="game_in_system" class="field_row clearfix">
                        <? echo form_label(lang('repairs_game_in_system').':', 'game_in_system', array('class' => 'required')); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'game_in_system',
                                'value' => $repair_info->game_in_system
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">

                        <? echo form_label(lang('repairs_serial_number').':', 'serial_number', array(
                            'id'    => 'serial_serial',
                            'class' => 'required'
                        ))."\n"; ?>

                        <? echo form_label(lang('repairs_system').':', 'serial_number', array(
                            'id'    => 'serial_system',
                            'class' => 'required'
                        ))."\n"; ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'serial_number',
                                'value' => $repair_info->serial_number
                            )); ?>
                        </div>

                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-wrench"></i> <? echo lang('repairs_info_repair')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'    => 'confirmed',
                                'id'      => 'confirmed',
                                'value'   => '1',
                                'checked' => ($ticket_id == -1) ? true : (($repair_info->confirmed) ? true : false)
                            )).' '.form_label(lang('repairs_confirmed').'?', 'confirmed', 'class="checkbox"'); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'    => 'refix',
                                'id'      => 'refix',
                                'value'   => '1',
                                'checked' => ($repair_info->refix == 1) ? true : false
                            )).' '.form_label(lang('repairs_refix').'?', 'refix', 'class="checkbox"'); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'    => 'cnbf',
                                'id'      => 'cnbf',
                                'value'   => '1',
                                'checked' => ($repair_info->cnbf == 1) ? true : false
                            )).' '.form_label(lang('repairs_cnbf').'?', 'cnbf', 'class="checkbox"'); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'    => 'replaced',
                                'id'      => 'replaced',
                                'value'   => '1',
                                'checked' => ($repair_info->replaced == 1) ? true : false
                            )).' '.form_label(lang('repairs_replaced').'?', 'replaced', 'class="checkbox"'); ?>
                        </div>
                    </div>

                    <div id="new_serial" class="field_row clearfix">
                        <? echo form_label(lang('repairs_new_serial').':', 'new_serial')."\n"; ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'new_serial',
                                'value' => $repair_info->new_serial
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_repaired_by').':', 'repair_employee'); ?>

                        <div class="form_field dropdown">
                            <? echo form_dropdown('repair_employee', $employees, ($repair_info->repair_employee) ? $repair_info->repair_employee : '', 'class="dropdown-select"'); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_date_repaired').':', 'repair_date'); ?>

                        <div id="date_repair" class="form_field input-group input-append date">
                            <? echo form_input(array(
                                'name'  => 'repair_date',
                                'class' => 'form-control',
                                'value' => $repair_info->repair_date ? standard_date('DATE_HUMAN', strtotime($repair_info->repair_date)) : ''
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_notes_tech').' ('.lang('repairs_cannot_see').' '.lang('repairs_by_customer').'):', 'tech_notes', array('class' => 'wide')); ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'tech_notes',
                                'value' => $repair_info->tech_notes
                            )); ?>
                        </div>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- /END WIDGET -->

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-phone"></i> <? echo lang('repairs_info_test_call')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_date_tested').':', 'date_tested'); ?>

                        <div id="date_test" class="form_field input-group input-append date">
                            <? echo form_input(array(
                                'name'  => 'date_tested',
                                'class' => 'form-control',
                                'value' => $repair_info->last_test_date ? standard_date('DATE_HUMAN', strtotime($repair_info->last_test_date)) : ''
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_date_called').':', 'date_called'); ?>

                        <div id="date_called" class="form_field input-group input-append date">
                            <? echo form_input(array(
                                'name'  => 'date_called',
                                'class' => 'form-control',
                                'value' => $repair_info->last_called_date ? standard_date('DATE_HUMAN', strtotime($repair_info->last_called_date)) : ''
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_date_they_called').':', 'date_they_called'); ?>

                        <div id="date_customer" class="form_field input-group input-append date">
                            <? echo form_input(array(
                                'name'  => 'date_they_called',
                                'class' => 'form-control',
                                'value' => $repair_info->last_customer_call ? standard_date('DATE_HUMAN', strtotime($repair_info->last_customer_call)) : ''
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <div class="form_field custom-input">
                            <? echo form_checkbox(array(
                                'name'  => 'test_failed',
                                'value' => '1'
                            )).' '.form_label(lang('repairs_test_failed').'?', 'test_failed', 'class="checkbox"'); ?>

                            <? echo $repair_info->fail_date ? standard_date('DATE_HUMAN', strtotime($repair_info->fail_date)) : ''; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_notes_call').' ('.lang('repairs_notes_call_desc').' '.lang('repairs_can_see').'):', 'call_notes', array('class' => 'wide')); ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'call_notes',
                                'value' => $repair_info->call_notes,
                                'rows'  => '5',
                                'cols'  => '27'
                            )); ?>
                        </div>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-gavel"></i> <? echo lang('repairs_info_warranty')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_warranty_number').':', 'warranty_number'); ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'warranty_number',
                                'value' => $repair_info->warranty_number,
                                'size'  => '5'
                            )); ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_pick_up_date').':', 'pick_up_date'); ?>

                        <div id="date_pick" class="form_field input-group input-append date">
                            <? echo form_input(array(
                                'name'  => 'pick_up_date',
                                'class' => 'form-control',
                                'value' => $repair_info->pick_up_date ? standard_date('DATE_HUMAN', strtotime($repair_info->pick_up_date)) : ''
                            )); ?>
                            <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_expires').':', 'expire'); ?>

                        <div class="form_static">
                            <? echo $repair_info->expire ? standard_date('DATE_HUMAN', strtotime($repair_info->expire)) : 'N/A'; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_notes_additional').' ('.lang('repairs_can_see').' '.lang('repairs_by_customer').'):', 'additional_notes', array('class' => 'wide')); ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'additional_notes',
                                'value' => $repair_info->additional_notes,
                                'rows'  => '5',
                                'cols'  => '27'
                            )); ?>
                        </div>
                    </div>

                    <? echo form_button(array(
                        'type'    => 'submit',
                        'name'    => 'submit',
                        'class'   => 'btn btn-green pull-right',
                        'style'   => 'margin-bottom:15px',
                        'content' => lang('common_submit')
                    ))."\n"; ?>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid2">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-clipboard"></i> <? echo lang('repairs_info_history')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <? if(isset($history) && $history != '') { ?>
                    <? echo $history; ?>
                    <? } else { ?>
                    No repair history for this device.
                    <? } ?>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

        <? echo form_close()."\n"; ?>
        <!-- END FLUID -->

    </div>
    <!-- END WRAP -->

    <? if($this->ion_auth->is_admin()) { ?>

    <span class="rendered"><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?></span>

    <? } ?>

</div>
<!-- END CONTENT -->

<script type="text/javascript">
$(document).ready(function() {
    // Special rule for phone number validation
    $.validator.addMethod('numCount', function(value, element, params) {
        var typedNums = jQuery.trim(value).replace(/-| |\/|\(|\)/g, '').length;

        if(typedNums == params[0] || typedNums == params[1]) {
            return true;
        }
    }, jQuery.format('<? echo lang('repairs_error_phone_numbers'); ?>'));

    $('#form_repair').validate({
        // Rules for form validation
        rules: {
            customer_first: {
                required: true
            },
            customer_last: {
                required: true
            },
            phone_number: {
                required: true,
                numCount: [10, 20]
            },
            email_address: {
                email: true
            },
            item: {
                required: true
            },
            problem: {
                required: true
            },
            price: {
                required: true
            },
            game_in_system: {
                required: function(element) {
                    if($('input[name="game_inside"]').is(':checked')) {
                        return true
                    } else {
                        return false
                    }
                }
            },
            serial_number: {
                required: true
            }
        },
        // Messages for form validation
        messages: {
            customer_first: {
                required: '<? echo lang('repairs_error_customer_first'); ?>'
            },
            customer_last: {
                required: '<? echo lang('repairs_error_customer_last'); ?>'
            },
            phone_number: {
                required: '<? echo lang('repairs_error_phone_number'); ?>'
            },
            email_address: {
                email: '<? echo lang('repairs_error_valid_email'); ?>'
            },
            item: {
                required: '<? echo lang('repairs_error_item'); ?>'
            },
            problem: {
                required: '<? echo lang('repairs_error_problem'); ?>'
            },
            price: {
                required: '<? echo lang('repairs_error_price'); ?>'
            },
            game_in_system: {
                required: '<? echo lang('repairs_error_game'); ?>'
            },
            serial_number: {
                required: '<? echo lang('repairs_error_serial_number'); ?>'
            }
        },
        // Placement of validation errors
        errorPlacement: function(error, element) {
            error.insertBefore(element.parent());
        },
        errorElement: 'em',
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.input-group').removeClass('valid').addClass('error');
            $(element).removeClass('valid').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.input-group').removeClass('error').addClass('valid');
            $(element).removeClass('error').addClass('valid');
        }
    });
});
</script>

<? echo $this->load->view('partial/footer')."\n" ?>