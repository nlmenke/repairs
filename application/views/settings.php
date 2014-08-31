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
            <i class="fa fa-cogs"></i> <? echo $page_title; ?>
        </h1>

        <div class="buttons">
            <? echo anchor('settings/backup', '<button class="btn btn-green"><i class="fa fa-cloud-download"></i> '.lang('settings_backup_database').'</button>', array('id' => 'dbBackup'))."\n"; ?>
            <? echo anchor('settings/optimize', '<button class="btn btn-green"><i class="fa fa-cloud"></i> '.lang('settings_optimize_database').'</button>', array('id' => 'dbOptimize'))."\n"; ?>
            <!-- <span id="optimize_loading"><i class="fa fa-spinner fa-spin"></i> loading...</span> -->
        </div>
        <!-- /stats -->

    </div>
    <!-- /header -->

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

        <? echo form_open_multipart('settings/save/', array('class' => 'fluid'))."\n"; ?>

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-building-o"></i> <? echo lang('settings_company_info')."\n"; ?>
                    </div>
                </div>
                <!-- /widget-header -->

                <div class="widget-content">

                    <div class="form_field clearfix">
                        <? echo form_label(lang('settings_company_name').':', 'company', array('class' => 'required'))."\n"; ?>

                        <? echo form_input(array(
                            'name'  => 'company',
                            'id'    => 'company',
                            'value' => config_item('company')
                        ))."\n"; ?>
                    </div>

                    <div class="form_field clearfix">
                        <? echo form_label(lang('settings_address').':', 'address', array('class' => 'required'))."\n"; ?>

                        <? echo form_textarea(array(
                            'name'  => 'address',
                            'id'    => 'address',
                            'rows'  => '4',
                            'cols'  => '30',
                            'value' => config_item('address')
                        ))."\n"; ?>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_phone').':', 'phone', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'phone',
                                'id'    => 'phone',
                                'value' => format_phone(config_item('phone'))
                            ))."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_fax').':', 'fax')."\n"; ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'fax',
                                'id'    => 'fax',
                                'value' => format_phone(config_item('fax'))
                            ))."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_email').':', 'email')."\n"; ?>

                        <div class="form_field">
                            <? echo form_input(array(
                                'name'  => 'email',
                                'id'    => 'email',
                                'value' => config_item('email')
                            ))."\n"; ?>
                        </div>
                    </div>

                    <hr />

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_website').':', 'website')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'website',
                                'id'    => 'website',
                                'value' => config_item('website')
                            ))."\n"; ?>
                            <? echo form_checkbox(array(
                                'id'      => 'website_on_receipt',
                                'name'    => 'website_on_receipt',
                                'value'   => '1',
                                'checked' => config_item('website_on_receipt') ? true : false
                            )).' '.lang('common_show_on_receipt').': '.form_label('<i></i>', 'website_on_receipt', array('class' => 'switch green pull-right'))."\n"; ?>
                        </div>
                    </div>

                    <hr />

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_facebook').':', 'facebook')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'facebook',
                                'id'    => 'facebook',
                                'value' => config_item('facebook')
                            ))."\n"; ?>
                            <? echo form_checkbox(array(
                                'id'      => 'facebook_on_receipt',
                                'name'    => 'facebook_on_receipt',
                                'value'   => '1',
                                'checked' => config_item('facebook_on_receipt') ? true : false
                            )).' '.lang('common_show_on_receipt').': '.form_label('<i></i>', 'facebook_on_receipt', array('class' => 'switch blue pull-right'))."\n"; ?>
                        </div>
                    </div>

                    <hr />

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_google_plus').':', 'google_plus')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'google_plus',
                                'id'    => 'google_plus',
                                'value' => $this->config->item('google_plus')
                            ))."\n"; ?>
                            <? echo form_checkbox(array(
                                'id'      => 'google_plus_on_receipt',
                                'name'    => 'google_plus_on_receipt',
                                'value'   => '1',
                                'checked' => config_item('google_plus_on_receipt') ? true : false
                            )).' '.lang('common_show_on_receipt').': '.form_label('<i></i>', 'google_plus_on_receipt', array('class' => 'switch red pull-right'))."\n"; ?>
                        </div>
                    </div>

                    <hr />

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_twitter').':', 'twitter')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'twitter',
                                'id'    => 'twitter',
                                'value' => $this->config->item('twitter')
                            ))."\n"; ?>
                            <? echo form_checkbox(array(
                                'id'      => 'twitter_on_receipt',
                                'name'    => 'twitter_on_receipt',
                                'value'   => '1',
                                'checked' => config_item('twitter_on_receipt') ? true : false
                            )).' '.lang('common_show_on_receipt').': '.form_label('<i></i>', 'twitter_on_receipt', array('class' => 'switch aqua pull-right'))."\n"; ?>
                        </div>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-globe"></i> <? echo lang('settings_site_settings')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_url_repair_log').': <span>('.lang('settings_url_repair_log_desc').')</span>', 'url_repair_log')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'url_repair_log',
                                'id'    => 'url_repair_log',
                                'value' => $this->config->item('url_repair_log')
                            ))."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_url_point_of_sale').': <span>('.lang('settings_url_point_of_sale_desc').')</span>', 'url_point_of_sale')."\n"; ?>

                        <div class="form_field w-switches">
                            <? echo form_input(array(
                                'name'  => 'url_point_of_sale',
                                'id'    => 'url_point_of_sale',
                                'value' => $this->config->item('url_point_of_sale')
                            ))."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_language').':', 'language', array('class' => 'required'))."\n"; ?>

                        <div class="form_field dropdown">
                            <? echo form_dropdown('language', array(
                                'english' => 'English'
                            ), $this->config->item('language'), 'class="dropdown-select"')."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_timezone').':', 'timezone', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <div class="dropdown">
                                <? echo form_dropdown('timezone', array(
                                    'Pacific/Midway'                 => '(GMT-11:00) Midway Island, Samoa',
                                    'America/Adak'                   => '(GMT-10:00) Hawaii-Aleutian',
                                    'Etc/GMT+10'                     => '(GMT-10:00) Hawaii',
                                    'Pacific/Marquesas'              => '(GMT-09:30) Marquesas Islands',
                                    'Pacific/Gambier'                => '(GMT-09:00) Gambier Islands',
                                    'America/Anchorage'              => '(GMT-09:00) Alaska',
                                    'America/Ensenada'               => '(GMT-08:00) Tijuana, Baja California',
                                    'Etc/GMT+8'                      => '(GMT-08:00) Pitcairn Islands',
                                    'America/Los_Angeles'            => '(GMT-08:00) Pacific Time (US & Canada)',
                                    'America/Denver'                 => '(GMT-07:00) Mountain Time (US & Canada)',
                                    'America/Chihuahua'              => '(GMT-07:00) Chihuahua, La Paz, Mazatlan',
                                    'America/Dawson_Creek'           => '(GMT-07:00) Arizona',
                                    'America/Belize'                 => '(GMT-06:00) Saskatchewan, Central America',
                                    'America/Cancun'                 => '(GMT-06:00) Guadalajara, Mexico City, Monterrey',
                                    'Chile/EasterIsland'             => '(GMT-06:00) Easter Island',
                                    'America/Chicago'                => '(GMT-06:00) Central Time (US & Canada)',
                                    'America/New_York'               => '(GMT-05:00) Eastern Time (US & Canada)',
                                    'America/Havana'                 => '(GMT-05:00) Cuba',
                                    'America/Bogota'                 => '(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
                                    'America/Caracas'                => '(GMT-04:30) Caracas',
                                    'America/Santiago'               => '(GMT-04:00) Santiago',
                                    'America/La_Paz'                 => '(GMT-04:00) La Paz',
                                    'Atlantic/Stanley'               => '(GMT-04:00) Faukland Islands',
                                    'America/Campo_Grande'           => '(GMT-04:00) Brazil',
                                    'America/Goose_Bay'              => '(GMT-04:00) Atlantic Time (Goose Bay)',
                                    'America/Glace_Bay'              => '(GMT-04:00) Atlantic Time (Canada)',
                                    'America/St_Johns'               => '(GMT-03:30) Newfoundland',
                                    'America/Araguaina'              => '(GMT-03:00) UTC-3',
                                    'America/Montevideo'             => '(GMT-03:00) Montevideo',
                                    'America/Miquelon'               => '(GMT-03:00) Miquelon, St. Pierre',
                                    'America/Godthab'                => '(GMT-03:00) Greenland',
                                    'America/Argentina/Buenos_Aires' => '(GMT-03:00) Buenos Aires',
                                    'America/Sao_Paulo'              => '(GMT-03:00) Brasilia',
                                    'America/Noronha'                => '(GMT-02:00) Mid-Atlantic',
                                    'Atlantic/Cape_Verde'            => '(GMT-01:00) Cape Verde Is.',
                                    'Atlantic/Azores'                => '(GMT-01:00) Azores',
                                    'Europe/Belfast'                 => '(GMT) Greenwich Mean Time: Belfast',
                                    'Europe/Dublin'                  => '(GMT) Greenwich Mean Time: Dublin',
                                    'Europe/Lisbon'                  => '(GMT) Greenwich Mean Time: Lisbon',
                                    'Europe/London'                  => '(GMT) Greenwich Mean Time: London',
                                    'Africa/Abidjan'                 => '(GMT) Monrovia, Reykjavik',
                                    'Europe/Amsterdam'               => '(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
                                    'Europe/Belgrade'                => '(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague',
                                    'Europe/Brussels'                => '(GMT+01:00) Brussels, Copenhagen, Madrid, Paris',
                                    'Africa/Algiers'                 => '(GMT+01:00) West Central Africa',
                                    'Africa/Windhoek'                => '(GMT+01:00) Windhoek',
                                    'Asia/Beirut'                    => '(GMT+02:00) Beirut',
                                    'Africa/Cairo'                   => '(GMT+02:00) Cairo',
                                    'Asia/Gaza'                      => '(GMT+02:00) Gaza',
                                    'Africa/Blantyre'                => '(GMT+02:00) Harare, Pretoria',
                                    'Asia/Jerusalem'                 => '(GMT+02:00) Jerusalem',
                                    'Europe/Minsk'                   => '(GMT+02:00) Minsk',
                                    'Asia/Damascus'                  => '(GMT+02:00) Syria',
                                    'Europe/Moscow'                  => '(GMT+03:00) Moscow, St. Petersburg, Volgograd',
                                    'Africa/Addis_Ababa'             => '(GMT+03:00) Nairobi',
                                    'Asia/Tehran'                    => '(GMT+03:30) Tehran',
                                    'Asia/Dubai'                     => '(GMT+04:00) Abu Dhabi, Muscat',
                                    'Asia/Yerevan'                   => '(GMT+04:00) Yerevan',
                                    'Asia/Kabul'                     => '(GMT+04:30) Kabul',
                                    'Asia/Yekaterinburg'             => '(GMT+05:00) Ekaterinburg',
                                    'Asia/Tashkent'                  => '(GMT+05:00) Tashkent',
                                    'Asia/Calcutta'                  => '(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi',
                                    'Asia/Katmandu'                  => '(GMT+05:45) Kathmandu',
                                    'Asia/Dhaka'                     => '(GMT+06:00) Astana, Dhaka',
                                    'Asia/Novosibirsk'               => '(GMT+06:00) Novosibirsk',
                                    'Asia/Rangoon'                   => '(GMT+06:30) Yangon (Rangoon)',
                                    'Asia/Bangkok'                   => '(GMT+07:00) Bangkok, Hanoi, Jakarta',
                                    'Asia/Krasnoyarsk'               => '(GMT+07:00) Krasnoyarsk',
                                    'Asia/Hong_Kong'                 => '(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi',
                                    'Asia/Irkutsk'                   => '(GMT+08:00) Irkutsk, Ulaan Bataar',
                                    'Australia/Perth'                => '(GMT+08:00) Perth',
                                    'Australia/Eucla'                => '(GMT+08:45) Eucla',
                                    'Asia/Tokyo'                     => '(GMT+09:00) Osaka, Sapporo, Tokyo',
                                    'Asia/Seoul'                     => '(GMT+09:00) Seoul',
                                    'Asia/Yakutsk'                   => '(GMT+09:00) Yakutsk',
                                    'Australia/Adelaide'             => '(GMT+09:30) Adelaide',
                                    'Australia/Darwin'               => '(GMT+09:30) Darwin',
                                    'Australia/Brisbane'             => '(GMT+10:00) Brisbane',
                                    'Australia/Hobart'               => '(GMT+10:00) Hobart',
                                    'Asia/Vladivostok'               => '(GMT+10:00) Vladivostok',
                                    'Australia/Lord_Howe'            => '(GMT+10:30) Lord Howe Island',
                                    'Etc/GMT-11'                     => '(GMT+11:00) Solomon Is., New Caledonia',
                                    'Asia/Magadan'                   => '(GMT+11:00) Magadan',
                                    'Pacific/Norfolk'                => '(GMT+11:30) Norfolk Island',
                                    'Asia/Anadyr'                    => '(GMT+12:00) Anadyr, Kamchatka',
                                    'Pacific/Auckland'               => '(GMT+12:00) Auckland, Wellington',
                                    'Etc/GMT-12'                     => '(GMT+12:00) Fiji, Kamchatka, Marshall Is.',
                                    'Pacific/Chatham'                => '(GMT+12:45) Chatham Islands',
                                    'Pacific/Tongatapu'              => '(GMT+13:00) Nuku\'alofa',
                                    'Pacific/Kiritimati'             => '(GMT+14:00) Kiritimati'
                                ), $this->config->item('timezone') ? $this->config->item('timezone') : date_default_timezone_get(), 'class="dropdown-select"')."\n"; ?>
                            </div>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_date_format').':', 'date_format', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <div class="dropdown">
                                <? echo form_dropdown('date_format', array(
                                    'middle_endian' => '8/26/2012',
                                    'little_endian' => '26-08-2012',
                                    'big_endian'    => '2012-08-26'
                                ), $this->config->item('date_format'), 'class="dropdown-select"')."\n"; ?>
                            </div>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_time_format').':', 'time_format', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <div class="dropdown">
                                <? echo form_dropdown('time_format', array(
                                    '12_hour' => '1:00 PM',
                                    '24_hour' => '13:00'
                                ), $this->config->item('time_format'), 'class="dropdown-select"')."\n"; ?>
                            </div>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_repairs_per_page').':', 'repairs_per_page', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <div class="dropdown">
                                <? echo form_dropdown('repairs_per_page', array(
                                    '20'  => '20',
                                    '50'  => '50',
                                    '100' => '100'
                                ), $this->config->item('repairs_per_page') ? $this->config->item('repairs_per_page') : '20', 'class="dropdown-select"')."\n"; ?>
                            </div>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('settings_warranty_type').':', 'warranty_type', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <div class="dropdown">
                                <? echo form_dropdown('warranty_type', array(
                                    '1 month'  => '30 Days',
                                    '2 months' => '60 Days',
                                    '3 months' => '90 Days'
                                ), $this->config->item('warranty_type') ? $this->config->item('warranty_type') : '20', 'class="dropdown-select"')."\n"; ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END WIDGET-CONTENT -->

            </div>
            <!-- END WIDGET -->

            <div class="widget grid4">

                <div class="widget-header">
                    <div class="widget-title">
                        <i class="fa fa-clipboard"></i> <? echo lang('settings_contract')."\n"; ?>
                    </div>
                </div>
                <!-- END WIDGET-HEADER -->

                <div class="widget-content">
                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_contract').':', 'repair_contract', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'repair_contract',
                                'id'    => 'repair_contract',
                                'rows'  => '50',
                                'value' => $this->config->item('repair_contract')
                            ))."\n"; ?>
                        </div>
                    </div>

                    <div class="field_row clearfix">
                        <? echo form_label(lang('repairs_contract_full').':', 'repair_contract_full', array('class' => 'required'))."\n"; ?>

                        <div class="form_field">
                            <? echo form_textarea(array(
                                'name'  => 'repair_contract_full',
                                'id'    => 'repair_contract_full',
                                'cols'  => '50',
                                'value' => $this->config->item('repair_contract_full')
                            ))."\n"; ?>
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

        <? echo form_close(); ?>
        <!-- END FLUID -->

        <script type="text/javascript">
        // validation and submit handling
        $(document).ready(function() {
            $('#dbOptimize .dbOptimize').click(function(event) {
                event.preventDefault();
                $('#optimize_loading').show();

                $.getJSON($(this).attr('href'), function(response) {
                    alert(response.message);
                    $('#optimize_loading').hide();
                });
            });

            var submitting = false;

            $('#config_form').validate({
                submitHandler: function(form) {
                    if(submitting) return;
                    submitting = true;
                    $(form).ajaxSubmit({
                        success: function(response) {
                            if(response.success) {
                                set_feedback(response.message, 'success_message', false);
                            } else {
                                set_feedback(response.message, 'error_message', true);
                            }
                            submitting = false;
                        },
                        dataType: 'json'
                    });
                },
                errorLabelContainer: '#error_message_box',
                wrapper: 'li',
                rules: {
                    company: 'required',
                    address: 'required',
                    phone: 'required',
                    email: 'email',
                    repair_contract: 'required'
                },
                messages: {
                    company: <? echo json_encode(lang('config_company_required')); ?>,
                    address: <? echo json_encode(lang('config_address_required')); ?>,
                    phone: <? echo json_encode(lang('config_phone_required')); ?>,
                    email: <? echo json_encode(lang('common_email_invalid_format')); ?>,
                    repair_contract: <? echo json_encode(lang('config_repair_contract_required')); ?>
                }
            });
        });
        </script>

    </div>
    <!-- /wrap -->

    <? if($this->ion_auth->is_admin()) { ?>

    <span class="rendered"><? echo sprintf(lang('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? lang('common_query') : lang('common_queries')); ?></span>
    <? } ?>

</div>
<!-- END CONTENT -->

<? echo $this->load->view('partial/footer')."\n" ?>