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
            <i class="fa fa-group"></i> <? echo $page_title; ?></h1>
    </div>
    <!-- END HEADER -->

    <? echo $this->breadcrumb->output()."\n"; ?>

    <div class="wrap clearfix">
        <div class="fluid">

            <div class="widget grid12">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-list"></i> <? echo lang('index_subheading'); ?>
                    </div>
                    <div class="widget-controls">
                        <div class="widget-config">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="return false;"><i class="fa fa-gear"></i></a>
                            <ul class="dropdown-menu pull-right">
                                <li><? echo anchor('auth/create_user', '<i class="fa fa-user"></i> '.lang('index_create_user_link')); ?></li>
                                <li><? echo anchor('auth/create_group', '<i class="fa fa-group"></i> '.lang('index_create_group_link')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content table-responsive">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th><? echo lang('index_lname_th'); ?></th>
                            <th><? echo lang('index_fname_th'); ?></th>
                            <th><? echo lang('index_email_th'); ?></th>
                            <th><? echo lang('index_phone_th'); ?></th>
                            <th><? echo lang('index_groups_th'); ?></th>
                            <th><? echo lang('index_status_th'); ?></th>
                            <th><? echo lang('index_action_th'); ?></th>
                        </tr>
                        <? foreach($users as $user) { ?>
                        <tr>
                            <td><? echo $user->last_name; ?></td>
                            <td><? echo $user->first_name; ?></td>
                            <td><? echo mailto($user->email, $user->email); ?></td>
                            <td><? echo format_phone($user->phone); ?></td>
                            <td>
                                <?php
                                foreach($user->groups as $group) {
                                    echo anchor('auth/edit_group/'.$group->id, $group->name).'<br />';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($user->active) {
                                    echo anchor('auth/deactivate/'.$user->id, '<button class="btn btn-mini btn-green" title="Deactivate User" data-placement="left">'.lang('index_active_link').'</button>');
                                } else {
                                    echo anchor('auth/activate/'.$user->id, '<button class="btn btn-mini btn-red" title="Activate User" data-placement="left">'.lang('index_inactive_link').'</button>');
                                }
                                ?>
                            </td>
                            <td><? echo anchor('auth/edit_user/'.$user->id, '<button class="btn btn-mini btn-grey" title="Edit User" data-placement="left"><i class="fa fa-pencil"></i> Edit</button>'); ?></td>
                        </tr>
                        <? } ?>
                    </table>

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