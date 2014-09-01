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

        <? if(APP_STATUS == 'alpha' || APP_STATUS == 'beta') { ?>

        <div id="alert">
            <div class="alert alert-info">
                <p class="alert-message"><? echo (config_item('email') != '') ? sprintf(lang('common_site_test_msg'), config_item('email')) : lang('common_site_test_msg_no_mail'); ?></p>
            </div>
        </div>
        <!-- END ALERT -->

        <? } ?>

        <? foreach($repair_type as $type) { ?>

        <? if(count($repairs[$type]) > 0) { ?>

        <div class="fluid">

            <div class="widget grid12">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-list"></i> <? if($type != 'modification') echo ucfirst($type.' Repairs'); else echo ucfirst($type.'s')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content table-responsive">

                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th><? echo $this->lang->line('repairs_item'); ?></th>
                                <th><? echo $this->lang->line('repairs_problem'); ?></th>
                                <th><? echo $this->lang->line('repairs_price'); ?></th>
                                <th><? echo $this->lang->line('repairs_drop_off_date'); ?></th>
                                <th><? echo $this->lang->line('repairs_date_repaired'); ?></th>
                                <th><? echo $this->lang->line('repairs_expires'); ?></th>
                                <th><? echo $this->lang->line('repairs_notes'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                            <? foreach($repairs[$type] as $console) { ?>

                            <tr<?php
                            echo ($console->replaced == 1) ? ' class="replaced"' : '';
                            echo ($console->cnbf == 1) ? ' class="cnbf"' : '';
                            echo ($console->refix == 1) ? ' class="refix"' : '';
                            ?>>
                                <td class="item">
                                    <? echo $console->item; ?><br />
                                    <? echo $console->serial_number; ?>
                                </td>
                                <td class="problem">
                                    <?php
                                    echo $console->problem;
                                    echo ($console->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : '';
                                    echo (($console->cnbf == 1) || ($console->replaced == 1)) ? '<br />' : '';
                                    echo ($console->cnbf == 1) ? strtoupper($this->lang->line('repairs_cannot_be_fixed')) : '';
                                    echo (($console->cnbf == 1) && ($console->replaced == 1)) ? ', ' : '';
                                    echo ($console->replaced == 1) ? strtoupper($this->lang->line('repairs_replaced')).(($console->new_serial != null) ? ' ('.$console->new_serial.')' : '') : '';
                                    ?>
                                </td>
                                <td class="quote">$<? echo $console->price; ?></td>
                                <td class="drop-off-date">
                                    <?php
                                    $date_time = standard_date('DATE_HUMAN', strtotime($console->drop_off_date));
                                    if(date('H:i:s', strtotime($console->drop_off_date)) != '00:00:00') {
                                        $date_time .= '<br />'.date('g:i a', strtotime($console->drop_off_date));
                                    }
                                    echo $date_time;
                                    ?>
                                </td>
                                <td class="repair-date">
                                    <?php
                                    if($console->pick_up_date == null || $console->pick_up_date == '0000-00-00') {
                                        if($console->cnbf != 1) {
                                            if($console->repair_date != null && $console->repair_date != '0000-00-00') {
                                                if($console->date_tested != null && $console->date_tested != '0000-00-00') {
                                                    echo 'Needs to be tested.';
                                                } else {
                                                    echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date));
                                                }
                                            } else {
                                                echo 'Our techs are working diligently to get to<br />your '.$console->repair_type.'. Thank you for your patience.';
                                            }
                                        } else {
                                            echo 'Unfortunately, this system cannot be fixed.<br />You may pick it up at any time.';
                                        }
                                        if($console->date_called != null && $console->date_called != '0000-00-00') {
                                            echo '<br />You have been called.<br />Date called: '.standard_date('DATE_HUMAN', strtotime($console->date_called));
                                        }
                                    } else {
                                        echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date)).'<br />Picked up: '.standard_date('DATE_HUMAN', strtotime($console->pick_up_date));
                                    }
                                    ?>
                                </td>
                                <td class="expire<? echo ($console->expire != null && time() > strtotime($console->expire)) ? ' expired' : ''; ?>">
                                    <?php
                                    echo ($console->expire != null) ? standard_date('DATE_HUMAN', strtotime($console->expire)) : '';
                                    echo ($console->warranty_number != null) ? '<br />'.$console->warranty_number : '';
                                    ?>
                                </td>
                                <td class="notes"><? echo $console->additional_notes == null ? '' : $console->additional_notes; ?></td>
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

        <? } ?>

        <? } ?>

    </div>
    <!-- END WRAP -->

    <? if($this->ion_auth->is_admin()) { ?>

    <span class="rendered"><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?></span>

    <? } ?>

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>