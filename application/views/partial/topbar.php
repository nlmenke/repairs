<?php
$css_url = base_url().'assets/styles/';
$js_url = base_url().'assets/scripts/';
$img_url = base_url().'assets/images/';
?>

<div id="top">

    <div class="main-logo">
        <? echo anchor('', img($img_url.'logo.png'))."\n"; ?>
    </div>

    <div class="m-nav">
        <i class="fa fa-bars"></i>
    </div>

    <div class="profile-nav">
        <ul>

            <? if($this->ion_auth->logged_in()) { ?>

            <li class="profile-user-info"><a class="disabled"><i class="fa fa-user"></i> <b><? echo lang('common_welcome'); ?>,</b> <span><? echo $user->first_name.' '.$user->last_name; ?></span></a></li>

            <? if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')) { ?>

            <li>
                <? echo anchor('messages', '<i class="fa fa-comments"></i> Messages', 'class="profile-badge-info"')."\n"; ?>

                <? echo (isset($messages) && (count($messages) != 0)) ? '<span class="badge profile-badge green">'.count($messages).'</span>'."\n" : ''."\n"; ?>
            </li>

            <? } ?>

            <? } ?>

            <? if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) { ?>

            <li><? echo anchor('settings', '<i class="fa fa-cogs"></i> Settings'); ?></li>

            <? } ?>

            <li><a class="disabled"><i class="fa fa-clock-o"></i> <time datetime="<? echo date('Y-m-d'); ?>"><? echo date('l, F j, Y'); ?></time></a></li>

            <? if($this->ion_auth->logged_in()) { ?>

            <li><? echo anchor('auth/logout', '<i class="fa fa-sign-out"></i> '.lang('login_logout_btn')); ?></li>

            <? } ?>

        </ul>
    </div>
    <!-- END PROFILE-NAV -->

</div>
<!-- END TOP -->