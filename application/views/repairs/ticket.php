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

        <?php if(APP_STATUS == 'dev') { ?>

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

            <div class="widget grid12">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-list"></i> <? echo lang('repairs_list_of')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div id="receipt_wrapper" style="margin:auto;width:100%;">
                        <div id="receipt_header" style="text-align:center;">

                            <div id="company_name" style="font-size:150%;font-weight:bold;">
                                <? echo config_item('company'); ?>
                            </div>

                            <div id="company_address">
                                <? echo nl2br(config_item('address')); ?>
                            </div>

                            <div id="company_phone" style="margin-bottom:15px;">
                                <? echo format_phone(config_item('phone')); ?>
                            </div>

                            <div id="repair_receipt" style="text-transform:uppercase;">
                                <? echo $this->lang->line('repairs_repair_ticket'); ?>
                            </div>

                        </div>

                        <div id="receipt_general_info" style="margin-bottom:5px;">
                            <div id="employee">
                                <? echo $this->lang->line('common_employee'); ?>: <? echo $row->drop_off_employee; ?>
                            </div>
                        </div>

                        <div id="repair_contract" style="width:100%;margin:0 auto;text-align:justify;">
                            <div class="title" style="text-align:center;margin-bottom:10px;border-top:1px dotted #969E96;border-bottom:1px dotted #969E96;">
                                <? echo $this->lang->line('repairs_repair_contract'); ?>
                            </div>
                            <div class="contract" style="width:90%;margin:auto;">
                                <? echo nl2br($this->config->item('repair_contract')); ?>
                            </div>
                        </div>

                        <div id="ticket_info" style="border-top:1px dashed #969E96;border-bottom:1px dashed #969E96;margin-top:15px;margin-bottom:15px;">

                            <table id="receipt_items" style="position:relative;border-collapse:collapse;width:100%;">
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_ticket_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo $row->ticket_id; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_name'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo $row->customer_first.' '.$row->customer_last; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_phone_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo format_phone($row->phone_number); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_date_of_drop_off'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo standard_date('DATE_HUMAN', strtotime($row->drop_off_date)); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo ($row->repair_type == 'game') ? $this->lang->line('repairs_item_game') : $this->lang->line('repairs_console_type'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo $row->item; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo ($row->repair_type == 'game') ? $this->lang->line('repairs_system') : $this->lang->line('repairs_serial_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo $row->serial_number; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:left;position:relative;padding:3px;"><? echo ($row->repair_type == 'modification') ? $this->lang->line('repairs_description_mod') : $this->lang->line('repairs_description_problem'); ?>:</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;position:relative;padding:3px;"><? echo $row->problem.(($row->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : ''); ?></td>
                                </tr>

                                <?php if($row->game_inside) { ?>

                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_game_in_system'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo strtoupper($row->game_in_system); ?></td>
                                </tr>

                                <? } ?>

                                <tr>
                                    <td style="text-align:left;width:50%;position:relative;padding:3px;"><? echo $this->lang->line('repairs_estimate'); ?>:</td>
                                    <td style="text-align:right;width:50%;position:relative;padding:3px;"><? echo is_numeric($row->price) ? to_currency($row->price) : '$'.$row->price; ?></td>
                                </tr>

                            </table>

                        </div>

                        <div class="signature" style="margin-top:35px;border-top:1px solid #969E96;border-bottom:none;"></div>

                        <? echo $this->lang->line('common_customer').' '.$this->lang->line('common_signature'); ?>

                        <div class="signature" style="margin-top:35px;border-top:1px solid #969E96;border-bottom:none;"></div>

                        <? echo config_item('company').' '.$this->lang->line('common_signature'); ?>

                        <? if(config_item('url_repair_log') && $row->email_address) { ?>

                        <div id="receipt_footer" style="text-align:center;border-top:1px dotted #969E96;border-bottom:1px dotted #969E96;margin-top:5px;">
                            <? echo sprintf(lang('repairs_check_status'), config_item('url_repair_log')); ?>
                        </div>

                        <? } ?>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

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