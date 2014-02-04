<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';
?>
	<div style="padding-top:25px;">
		<fieldset style="width:250px">
			<legend align="center"><?php echo $this->lang->line('common_repair_info'); ?></legend>
			<center style="color:red;font-style:italic;padding-bottom:10px;">* <?php echo $this->lang->line('common_indecates_required_field'); ?>.</center>
			<div id="pop-required">
				<p><?php echo $this->lang->line('common_required') ?></p>
			</div>
			<?php echo form_open('repairs/save/'.$repair_info->ticket_id)."\n"; ?>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_name').': <span id="required">*</span>', 'name'); ?>
					<div class="form_field"><?php echo form_input('customer_first', $repair_info->customer_first, 'class="drop-off" placeholder="first"').'<br />'.form_input('customer_last', $repair_info->customer_last, 'class="drop-off" placeholder="last"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_phone_number').': <span id="required">*</span>', 'phone'); ?>
					<div class="form_field"><?php echo form_input('phone_number', format_phone($repair_info->phone_number), 'class="drop-off"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_email_address').': <span id="required">*</span>', 'email'); ?>
					<div class="form_field"><?php echo form_input('email_address', $repair_info->email_address, 'class="drop-off" size="17"'); ?> <span id="email-help">(?)</span></div>
				</div>
				<div id="pop-email">
					<p><?php echo $this->lang->line('common_email_help') ?></p>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_system').' / Game: <span id="required">*</span>', 'system'); ?>
					<div class="form_field"><?php echo form_input('system', $repair_info->system, 'class="drop-off"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_serial_number').':', 'serial'); ?>
					<div class="form_field"><?php echo form_input('serial_number', $repair_info->serial_number, 'class="drop-off" size="17"'); ?> <span id="serial-help">(?)</span></div>
				</div>
				<div id="pop-serial">
					<p><?php echo $this->lang->line('common_serial_help') ?></p>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_repair_type').': <span id="required">*</span>', 'repair_type'); ?>
					<div class="form_field"><?php foreach($repair_type as $type) {
						echo form_radio(array(
							'name'		=> 'repair_type',
							'value'		=> $type,
							'checked'	=> ($repair_info->repair_type == $type) ? TRUE : FALSE,
							'class'		=> 'drop-off'
						)).' '.ucfirst($type).'<br />';
					} ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_problem').':', 'problem', array('class' => 'wide')); ?>
					<div class="form_field"><?php echo form_input('problem', $repair_info->problem, 'class="drop-off" size="37"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_refix').'?:', 'refix'); ?>
					<div class="form_field"><?php echo form_checkbox(array(
						'name'		=> 'refix',
						'value'		=> 1,
						'checked'	=> ($repair_info->refix == 1) ? 1 : 0
					)); ?></div>
				</div>
				<br />
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_cnbf').'?:', 'cnbf'); ?>
					<div class="form_field"><?php echo form_checkbox(array(
						'name'		=> 'cnbf',
						'value'		=> 1,
						'checked'	=> ($repair_info->cnbf == 1) ? 1 : 0
					)); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_price').':', 'price'); ?>
					<div class="form_field">$<?php echo form_input('price', $repair_info->price, 'class="drop-off" size="5"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_drop_off_employee').':', 'drop_off_employee'); ?>
					<div class="form_field"><?php echo form_input('drop_off_employee', $repair_info->drop_off_employee ? $repair_info->drop_off_employee : $user['first_name'], 'class="drop-off"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_drop_off_date').':', 'drop_off_date'); ?>
					<div class="form_field"><?php echo form_input('drop_off_date', $repair_info->drop_off_date ? standard_date('DATE_HUMAN', strtotime($repair_info->drop_off_date)) : date('m/d/Y'), 'id="date_drop" class="drop-off" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_confirmed').'?:', 'confirmed'); ?>
					<div class="form_field"><?php echo form_checkbox(array(
						'name'		=> 'confirmed',
						'value'		=> 1,
						'checked'	=> ($ticket_id == -1) ? 1 : (($repair_info->confirmed) ? 1 : 0)
					)); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_repaired_by').':', 'repair_employee'); ?>
					<div class="form_field"><?php echo form_input('repair_employee', $repair_info->repair_employee, 'class="repaired"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_repaired').':', 'repair_date'); ?>
					<div class="form_field"><?php echo form_input('repair_date', $repair_info->repair_date ? standard_date('DATE_HUMAN', strtotime($repair_info->repair_date)) : '', 'id="date_repair" class="repaired" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_test_1').':', 'test_1_date'); ?>
					<div class="form_field"><?php echo form_input('test_1_date', $repair_info->test_1_date ? standard_date('DATE_HUMAN', strtotime($repair_info->test_1_date)) : '', 'id="date_test_1" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_test_2').':', 'test_2_date'); ?>
					<div class="form_field"><?php echo form_input('test_2_date', $repair_info->test_2_date ? standard_date('DATE_HUMAN', strtotime($repair_info->test_2_date)) : '', 'id="date_test_2" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_called_1').':', 'called_1_date'); ?>
					<div class="form_field"><?php echo form_input('called_1_date', $repair_info->called_1_date ? standard_date('DATE_HUMAN', strtotime($repair_info->called_1_date)) : '', 'id="date_called_1" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_called_2').':', 'called_1_date'); ?>
					<div class="form_field"><?php echo form_input('called_2_date', $repair_info->called_2_date ? standard_date('DATE_HUMAN', strtotime($repair_info->called_2_date)) : '', 'id="date_called_2" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_date_called_3').':', 'called_1_date'); ?>
					<div class="form_field"><?php echo form_input('called_3_date', $repair_info->called_3_date ? standard_date('DATE_HUMAN', strtotime($repair_info->called_3_date)) : '', 'id="date_called_3" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_pick_up_date').':', 'pick_up_date'); ?>
					<div class="form_field"><?php echo form_input('pick_up_date', $repair_info->pick_up_date ? standard_date('DATE_HUMAN', strtotime($repair_info->pick_up_date)) : '', 'id="date_pick" size="17"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_warranty_number').':', 'warranty_id'); ?>
					<div class="form_field"><?php echo form_input('warranty_number', $repair_info->warranty_number, 'size="5"'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_expires').':', 'expire'); ?>
					<div class="form_field"><?php echo form_input('expire', $repair_info->expire ? standard_date('DATE_HUMAN', strtotime($repair_info->expire)) : '', 'disabled'); ?></div>
				</div>
				<div class="field_row clearfix">
					<?php echo form_label($this->lang->line('common_additional_notes').' ('.$this->lang->line('common_customer_sees').'):', 'notes', array('class' => 'wide')); ?>
					<div class="form_field"><?php echo form_textarea(array(
						'name'	=> 'notes',
						'value'	=> $repair_info->notes,
						'rows'	=> '5',
						'cols'	=> '27'
					)); ?></div>
				</div>
				<?php echo form_submit('submit', $this->lang->line('common_submit'), 'style="float:right;"'); ?>
			<?php echo form_close()."\n"; ?>
		</fieldset>
	</div>