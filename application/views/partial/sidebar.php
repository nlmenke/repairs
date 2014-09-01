<div id="sidebar">


    <? echo form_open('repairs/search', array('class' => 'search'))."\n"; ?>

        <? echo form_input('search', '', 'placeholder="Search repairs..."'); ?> <i class="fa fa-search"></i>

    <? echo form_close()."\n"; ?>


    <ul class="main-nav">

        <? if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) { ?>

        <li class="collapsible<? if($this->uri->segment(1) == 'repairs') echo ' open'; ?>">

            <? echo anchor('#', '<i class="fa fa-wrench"></i> '.lang('common_repair_log'), 'onclick="return false;"'); ?>

            <ul class="sub-menu">

                <li<? if($this->uri->segment(2) == 'archive') echo ' class="active"'; ?>><? echo anchor('repairs/archive', '<i class="fa fa-archive"></i> '.lang('repairs_archive')); ?></li>
                <li<? if($this->uri->segment(2) == 'edit' && $this->uri->segment(3) == '-1') echo ' class="active"'; ?>><? echo anchor('repairs/edit/-1', '<i class="fa fa-plus"></i> '.lang('repairs_new')); ?></li>
                <li<? if($this->uri->segment(2) == 'edit' && $this->uri->segment(3) != '-1') echo ' class="active"'; ?>><? echo anchor('repairs/edit/', '<i class="fa fa-pencil"></i> '.lang('repairs_edit')); ?></li>

            </ul>
        </li>

        <? if(config_item('url_point_of_sale') != '') { ?>

        <li><? echo anchor(config_item('url_point_of_sale'), '<i class="fa fa-shopping-cart"></i> '.lang('common_point_of_sale')); ?></li>

        <? } ?>

        <? } else { ?>

        <li<? if($this->uri->segment(1) == 'repairs' || $this->uri->segment(1) == '') echo ' class="active"'; ?>><? echo anchor('repairs', '<i class="fa fa-wrench"></i> '.lang('common_repair_log')); ?></li>

        <? } ?>

        <? if($this->ion_auth->is_admin()) { ?>

        <li<? if($this->uri->segment(1) == 'auth') echo ' class="active"'; ?>><? echo anchor('auth', '<i class="fa fa-users"></i> '.lang('common_users')); ?></li>

        <? } ?>
    </ul>
    <!-- END MAIN-NAV -->

    <div class="version">

        <? if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) { ?>

        <? echo lang('common_version').' '.app_version('full')."\n"; ?>

        <? } else { ?>

        <? echo lang('common_version').' '.app_version()."\n"; ?>

        <? } ?>

    </div>
</div>
<!-- END SIDEBAR -->