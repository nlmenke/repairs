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

        <div class="fluid">

            <div class="widget grid12">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-list"></i> <? echo lang('repairs_list_of')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><? echo $this->lang->line('repairs_customer'); ?></th>
                                <th><? echo $this->lang->line('repairs_item'); ?></th>
                                <th><? echo $this->lang->line('repairs_problem'); ?></th>
                                <th><? echo $this->lang->line('repairs_price'); ?></th>
                                <th><? echo $this->lang->line('repairs_repaired'); ?></th>
                                <th><? echo $this->lang->line('repairs_date_tested_called'); ?></th>
                                <th><? echo $this->lang->line('repairs_expires'); ?></th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                            <? if(count($results) > 0) { ?>

                            <? foreach($results as $row) { ?>

                            <tr<?php
                            echo ($row->replaced == 1) ? ' class="info"' : '';
                            echo ($row->cnbf == 1) ? ' class="warning"' : '';
                            echo ($row->refix == 1) ? ' class="danger"' : '';
                            ?>>
                                <td class="name">
                                    <? echo $row->customer_first.' '.$row->customer_last; ?><br />
                                    <? echo format_phone($row->phone_number); ?>
                                </td>
                                <td class="item">
                                    <? echo $row->item; ?><br />
                                    <? echo $row->serial_number; ?>
                                </td>
                                <td class="problem">
                                    <?php
                                    echo $row->problem;
                                    echo ($row->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : '';
                                    echo (($row->cnbf == 1) || ($row->replaced == 1)) ? '<br />' : '';
                                    echo ($row->cnbf == 1) ? strtoupper($this->lang->line('repairs_cnbf')) : '';
                                    echo (($row->cnbf == 1) && ($row->replaced == 1)) ? ', ' : '';
                                    echo ($row->replaced == 1) ? strtoupper($this->lang->line('repairs_replaced')).(($row->new_serial != null) ? ' ('.$row->new_serial.')' : '') : '';
                                    ?>
                                </td>
                                <td class="quote">$<? echo $row->price; ?></td>
                                <td class="repair-employee">
                                    <? echo ($row->repair_date == null) ? '' : standard_date('DATE_HUMAN', strtotime($row->repair_date)); ?><br />
                                    <? echo $row->repair_employee; ?>
                                </td>
                                <td class="tested">
                                    <?php
                                    echo ($row->last_test_date != null) ? standard_date('DATE_HUMAN', strtotime($row->last_test_date)) : '';
                                    echo (($row->last_test_date != null) && ($row->last_called_date != null)) ? ' /<br />' : '';
                                    echo ($row->last_called_date != null) ? standard_date('DATE_HUMAN', strtotime($row->last_called_date)) : '';
                                    ?>
                                </td>
                                <td class="expire<? echo ($row->expire != null && time() > strtotime($row->expire)) ? ' expired' : ''; ?>">
                                    <?php
                                    echo ($row->expire != null) ? standard_date('DATE_HUMAN', strtotime($row->expire)) : '';
                                    echo ($row->warranty_number != null) ? '<br />'.$row->warranty_number : '';
                                    ?>
                                </td>
                                <td class="edit">
                                    <? echo anchor('repairs/edit/'.$row->ticket_id, '<button class="btn btn-mini btn-grey" title="Edit Repair"><i class="fa fa-pencil"></i></button>'); ?>
                                    <? echo anchor('repairs/fixed/'.$row->ticket_id, '<button class="btn btn-mini btn-grey" title="Set as Fixed"><i class="fa fa-wrench"></i></button>'); ?>
                                    <? echo anchor('repairs/pickup/'.$row->ticket_id, '<button class="btn btn-mini btn-grey" title="Set as Picked Up"><i class="fa fa-upload"></i></button>'); ?>
                                    <? echo anchor('repairs/ticket/'.$row->ticket_id, '<button class="btn btn-mini btn-grey" title="Reprint Ticket"><i class="fa fa-ticket"></i></button>'); ?>
                                    <? echo anchor('repairs/stub/'.$row->ticket_id, '<button class="btn btn-mini btn-grey" title="Print Stub"><i class="fa fa-print"></i></button>'); ?>
                                </td>
                            </tr>

                            <? } ?>

                            <? } else { ?>

                            <tr>
                                <td colspan="12">No repairs on file.</td>
                            </tr>

                            <? } ?>

                        </tbody>
                    </table>

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