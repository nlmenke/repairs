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

                        <div id="ticket_info" style="margin-top:15px;margin-bottom:15px;">

                            <table id="receipt_items" style="position:relative;border-collapse:collapse;width:100%;">
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_ticket_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo $row->ticket_id; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_name'); ?>:</td>
                                    <td style="font-size:18px;text-align:right;width:50%;"><? echo $row->customer_first.' '.$row->customer_last; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_phone_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo format_phone($row->phone_number); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_date_of_drop_off'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo standard_date('DATE_HUMAN', strtotime($row->drop_off_date)); ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo ($row->repair_type == 'game') ? $this->lang->line('repairs_item_game') : $this->lang->line('repairs_console_type'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo $row->item; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo ($row->repair_type == 'game') ? $this->lang->line('repairs_system') : $this->lang->line('repairs_serial_number'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo $row->serial_number; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:left;"><? echo ($row->repair_type == 'modification') ? $this->lang->line('repairs_description_mod') : $this->lang->line('repairs_description_problem'); ?>:</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:right;"><? echo $row->problem.(($row->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : ''); ?></td>
                                </tr>

                                <?php if($row->game_inside) { ?>

                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_game_in_system'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo strtoupper($row->game_in_system); ?></td>
                                </tr>

                                <?php } ?>

                                <tr>
                                    <td style="text-align:left;width:50%;"><? echo $this->lang->line('repairs_estimate'); ?>:</td>
                                    <td style="text-align:right;width:50%;"><? echo is_numeric($row->price) ? to_currency($row->price) : '$'.$row->price; ?></td>
                                </tr>
                            </table>

                        </div>
                        <!-- END TICKET_INFO -->

                    </div>
                    <!-- END RECEIPT_WRAPPER -->

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