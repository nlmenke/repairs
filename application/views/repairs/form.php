<?php $imgUrl = base_url().'assets/images/'; ?>
<div id="wrapper">
	<?php echo form_open('repairs/save/'.$repair_info->ticket_id, 'class="grid"')."\n"; ?>
		<center class="required" style="font-style:italic;"><?php echo $this->lang->line('repairs_required_field'); ?>.</center>
		<fieldset id="customer_info">
			<legend align="center"><?php echo $this->lang->line('repairs_info_customer'); ?></legend>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_name').':', 'name', array('class' => 'required')); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'customer_first',
						'value'	=> $repair_info->customer_first,
						'title'	=> $this->lang->line('repairs_first_name'),
						'style'	=> 'margin-bottom:14px;'
					)).'<br />'.form_input(array(
						'name'	=> 'customer_last',
						'value'	=> $repair_info->customer_last,
						'title'	=> $this->lang->line('repairs_last_name')
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_phone_number').':', 'phone', array('class' => 'required')); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'phone_number',
						'value'	=> format_phone($repair_info->phone_number)
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_email_address').':', 'email'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'email_address',
						'value'	=> $repair_info->email_address
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix" style="width:96%;">
				<div class="form_field" style="width:100%;">
					<hr style="width:100%;" />
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_drop_off_employee').':', 'drop_off_employee'); ?>
				<div class="form_field">
					<?php if($ticket_id == -1): ?>
					<?php echo form_input(array(
						'name'	=> 'drop_off_employee',
						'value'	=> $user->first_name
					)); ?>
					<?php else: ?>
					<div class="form_static">
						<?php echo $repair_info->drop_off_employee; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_drop_off_date').':', 'drop_off_date'); ?>
				<div class="form_static">
					<?php echo $repair_info->drop_off_date ? standard_date('DATE_HUMAN', strtotime($repair_info->drop_off_date)) : date('m/d/Y'); ?>
				</div>
			</div>
		</fieldset>
		<fieldset id="problem_info">
			<legend align="center"><?php echo $this->lang->line('repairs_info_problem'); ?></legend>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_repair_type').':', 'repair_type', array('class' => 'required')); ?>
				<div class="form_field">
					<?php foreach($repair_type as $type => $typetext) {
						echo form_radio(array(
							'name'		=> 'repair_type',
							'value'		=> $type,
							'checked'	=> ($ticket_id == -1 && $type == 'console') ? TRUE : (($repair_info->repair_type == $type) ? TRUE : FALSE)
						)).' '.$typetext.'<br />';
					} ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_item_game').':', 'item', array('id' => 'item_game', 'class' => 'required')); ?>
				<?php echo form_label($this->lang->line('repairs_item_mod').':', 'item', array('id' => 'item_mod', 'class' => 'required')); ?>
				<?php echo form_label($this->lang->line('repairs_item_repair').':', 'item', array('id' => 'item_repair', 'class' => 'required')); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'item',
						'value'	=> $repair_info->item
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_description_mod').':', 'problem', array('id' => 'description_mod', 'class' => 'wide')); ?>
				<?php echo form_label($this->lang->line('repairs_description_problem').':', 'problem', array('id' => 'description_problem', 'class' => 'wide')); ?>
				<div class="form_field">
					<?php echo form_textarea(array(
						'name'	=> 'problem',
						'value'	=> $repair_info->problem,
						'rows'	=> '5',
						'cols'	=> '27'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_price').':', 'price'); ?>
				<div class="form_field">
					$<?php echo form_input(array(
						'name'	=> 'price',
						'value'	=> $repair_info->price,
						'style'	=> 'width:50px;'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_game_inside').'?:', 'game_inside', 'id="game_inside"'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'		=> 'game_inside',
						'value'		=> 1,
						'checked'	=> ($ticket_id == -1) ? 0 : (($repair_info->game_inside) ? 1 : 0)
					)); ?>
				</div>
			</div>
			<div id="game_in_system" class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_game_in_system').':', 'game_in_system'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'game_in_system',
						'value'	=> $repair_info->game_in_system
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_serial_number').':', 'serial_number', array('id' => 'serial_serial'))."\n"; ?>
				<?php echo form_label($this->lang->line('repairs_system').':', 'serial_number', array('id' => 'serial_system'))."\n"; ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'serial_number',
						'value'	=> $repair_info->serial_number,
						'id'	=> 'serial_number'
					)); ?>
				</div>
			</div>
		</fieldset>
		<fieldset id="repair_info">
			<legend align="center"><?php echo $this->lang->line('repairs_info_repair'); ?></legend>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_confirmed').'?:', 'confirmed'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'		=> 'confirmed',
						'value'		=> 1,
						'checked'	=> ($ticket_id == -1) ? 1 : (($repair_info->confirmed) ? 1 : 0)
					)); ?>
				</div>
			</div>
			<br />
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_refix').'?:', 'refix'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'		=> 'refix',
						'value'		=> 1,
						'checked'	=> ($repair_info->refix == 1) ? 1 : 0
					)); ?>
				</div>
			</div>
			<br />
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_cnbf').'?:', 'cnbf'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'		=> 'cnbf',
						'value'		=> 1,
						'checked'	=> ($repair_info->cnbf == 1) ? 1 : 0
					)); ?>
				</div>
			</div>
			<br />
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_replaced').'?:', 'replaced'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'		=> 'replaced',
						'value'		=> 1,
						'checked'	=> ($repair_info->replaced == 1) ? 1 : 0
					)); ?>
				</div>
			</div>
			<div id="new_serial" class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_new_serial').':', 'new_serial')."\n"; ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'new_serial',
						'value'	=> $repair_info->new_serial
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_repaired_by').':', 'repair_employee'); ?>
				<div class="form_field">
					<?php echo form_dropdown('repair_employee', $employees, ($repair_info->repair_employee) ? $repair_info->repair_employee : ''); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_date_repaired').':', 'repair_date'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'repair_date',
						'value'	=> $repair_info->repair_date ? standard_date('DATE_HUMAN', strtotime($repair_info->repair_date)) : '',
						'id'	=> 'date_repair',
						'size'	=> '17'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_notes_tech').' ('.$this->lang->line('repairs_cannot_see').' '.$this->lang->line('repairs_by_customer').'):', 'tech_notes', array('class' => 'wide')); ?>
				<div class="form_field">
					<?php echo form_textarea(array(
						'name'	=> 'tech_notes',
						'value'	=> $repair_info->tech_notes,
						'rows'	=> '5',
						'cols'	=> '27'
					)); ?>
				</div>
			</div>
		</fieldset>
		<fieldset id="test_call_info">
			<legend align="center"><?php echo $this->lang->line('repairs_info_test_call'); ?></legend>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_tested_last_date').':', 'last_test_date'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'last_test_date',
						'value'	=> $repair_info->last_test_date ? standard_date('DATE_HUMAN', strtotime($repair_info->last_test_date)) : '',
						'id'	=> 'date_test',
						'size'	=> '17'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_tested_times').':', 'times_tested'); ?>
				<div class="form_static">
					<?php echo $repair_info->times_tested ? $repair_info->times_tested : 'N/A'; ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_called_last_date').':', 'last_date_called'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'last_called_date',
						'value'	=> $repair_info->last_called_date ? standard_date('DATE_HUMAN', strtotime($repair_info->last_called_date)) : '',
						'id'	=> 'date_called',
						'size'	=> '17'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_called_times').':', 'times_called'); ?>
				<div class="form_static">
					<?php echo $repair_info->times_called ? $repair_info->times_called : 'N/A'; ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_they_last_call').':', 'last_customer_call'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'last_customer_call',
						'value'	=> $repair_info->last_customer_call ? standard_date('DATE_HUMAN', strtotime($repair_info->last_customer_call)) : '',
						'id'	=> 'date_customer',
						'size'	=> '17'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_they_times_call').':', 'times_customer_call'); ?>
				<div class="form_static">
					<?php echo $repair_info->times_customer_call ? $repair_info->times_customer_call : 'N/A'; ?>
				</div>
			</div>
			<br />
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_test_failed').'?:', 'test_failed'); ?>
				<div class="form_field">
					<?php echo form_checkbox(array(
						'name'	=> 'test_failed',
						'value'	=> 1
					)); ?>
					<?php echo $repair_info->fail_date ? standard_date('DATE_HUMAN', strtotime($repair_info->fail_date)) : ''; ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_notes_call').' ('.$this->lang->line('repairs_notes_call_desc').' '.$this->lang->line('repairs_cannot_see').'):', 'call_notes', array('class' => 'wide')); ?>
				<div class="form_field">
					<?php echo form_textarea(array(
						'name'	=> 'call_notes',
						'value'	=> $repair_info->call_notes,
						'rows'	=> '5',
						'cols'	=> '27'
					)); ?>
				</div>
			</div>
		</fieldset>
		<fieldset id="warranty_info">
			<legend align="center"><?php echo $this->lang->line('repairs_info_warranty'); ?></legend>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_warranty_number').':', 'warranty_number'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'warranty_number',
						'value'	=> $repair_info->warranty_number,
						'size'	=> '5'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_pick_up_date').':', 'pick_up_date'); ?>
				<div class="form_field">
					<?php echo form_input(array(
						'name'	=> 'pick_up_date',
						'value'	=> $repair_info->pick_up_date ? standard_date('DATE_HUMAN', strtotime($repair_info->pick_up_date)) : '',
						'id'	=> 'date_pick',
						'size'	=> '17'
					)); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_warranty_type').':', 'warranty_type'); ?>
				<div class="form_field">
					<?php echo form_dropdown('warranty_type', $warranty_type, ($repair_info->warranty_type != '----') ? $repair_info->warranty_type : ''); ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_expires').':', 'expire'); ?>
				<div class="form_static">
					<?php echo $repair_info->expire ? standard_date('DATE_HUMAN', strtotime($repair_info->expire)) : 'N/A'; ?>
				</div>
			</div>
			<div class="field_row clearfix">
				<?php echo form_label($this->lang->line('repairs_notes_additional').' ('.$this->lang->line('repairs_can_see').' '.$this->lang->line('repairs_by_customer').'):', 'additional_notes', array('class' => 'wide')); ?>
				<div class="form_field">
					<?php echo form_textarea(array(
						'name'	=> 'additional_notes',
						'value'	=> $repair_info->additional_notes,
						'rows'	=> '5',
						'cols'	=> '27'
					)); ?>
				</div>
			</div>
		</fieldset>
		<?php echo form_submit('submit', $this->lang->line('common_submit'), 'style="float:right;"'); ?>
	<?php echo form_close()."\n"; ?>
</div>