<?php $imgUrl = base_url().'assets/images/'; ?>
<div style="padding-top:25px;">
	<div id="receipt_wrapper">
		<div id="ticket_info">
			<table id="receipt_items">
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_ticket_number'); ?>:</td>
					<td style="text-align:right;width:50%;"><?php echo $row->ticket_id; ?></td>
				</tr>
				<tr>
					<td style="text-align:left;width:50%;"><?php echo $this->lang->line('repairs_name'); ?>:</td>
					<td style="font-size:18px;text-align:right;width:50%;"><?php echo $row->customer_first.' '.$row->customer_last; ?></td>
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
	</div>
</div>