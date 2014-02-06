<?php $imgUrl = base_url().'assets/images/'; ?>
<div style="padding-top:25px;">
	<div id="receipt_wrapper">
		<div id="receipt_header">
			<div id="company_name"><?php echo config_item('company'); ?></div>
			<div id="company_address"><?php echo nl2br(config_item('address')); ?></div>
			<div id="company_phone"><?php echo format_phone(config_item('phone')); ?></div>
			<div id="repair_receipt"><?php echo $this->lang->line('repairs_repair_ticket'); ?></div>
		</div>
		<div id="receipt_general_info">
			<div id="employee"><?php echo $this->lang->line('common_employee_name'); ?>: <?php echo $row->drop_off_employee; ?></div>
		</div>
		<div id="repair_contract">
			<div class="title"><?php echo $this->lang->line('repairs_repair_contract'); ?></div>
			<div class="pad-sides"><?php echo nl2br($this->config->item('repair_contract')); ?></div>
		</div>
		<div id="ticket_info">
			<table id="receipt_items">
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_ticket_number'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo $row->ticket_id; ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_name'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo $row->customer_first.' '.$row->customer_last; ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_phone_number'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo format_phone($row->phone_number); ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_date_of_drop_off'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo standard_date('DATE_HUMAN', strtotime($row->drop_off_date)); ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo ($row->repair_type == 'game') ? $this->lang->line('repairs_item_game') : $this->lang->line('repairs_console_type'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo $row->item; ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo ($row->repair_type == 'game') ? $this->lang->line('repairs_system') : $this->lang->line('repairs_serial_number'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo $row->serial_number; ?></td>
				</tr>
				<tr><td colspan="2" style="text-align:left;"><?php echo ($row->repair_type == 'modification') ? $this->lang->line('repairs_description_mod') : $this->lang->line('repairs_description_problem'); ?>:</td></tr>
				<tr><td colspan="2" style="text-align:right;"><?php echo $row->problem; echo ($row->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : ''; ?></td></tr>
				<?php if($row->game_inside): ?>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_game_in_system'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo strtoupper($row->game_in_system); ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_estimate'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo is_numeric($row->price) ? to_currency($row->price) : '$'.$row->price; ?></td>
				</tr>
			</table>
		</div>
		<div class="signature"></div>
		<?php echo $this->lang->line('common_customer').' '.$this->lang->line('common_signature'); ?>
		<div class="signature"></div>
		<?php echo config_item('company').' '.$this->lang->line('common_signature'); ?>
		<?php if($row->email_address): ?>
		<div id="receipt_footer">
			To check the status of your repair, please visit<br />
			<?php echo base_url(); ?><br />
			Enter your login information as follows:<br />
			- Login Email: email address provided<br />
			- Password: 10-digit phone number provided
		</div>
		<?php endif; ?>
	</div>
</div>