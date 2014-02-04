<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';
?>
	<div style="padding-top:25px;">
		<table>
			<tbody>
				<tr><td colspan="2"><?php echo config_item('company'); ?></td></tr>
				<tr><td colspan="2"><?php echo config_item('address'); ?></td></tr>
				<tr><td colspan="2"><?php echo config_item('city_state_zip'); ?></td></tr>
				<tr><td colspan="2"><?php echo format_phone(config_item('phone')); ?></td></tr>
				<tr><td colspan="2" class="print-solid"><strong>REPAIR TICKET</strong></td></tr>
				<tr><td colspan="2" style="text-align:left;">Employee Name: <?php echo $row->drop_off_employee; ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" class="print-dotted">Repair Contract:</td></tr>
				<tr>
					<td colspan="2" class="print-dotted">
						<p><?php echo nl2br(config_item('repair_contract')); ?></p>
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo $this->lang->line('common_ticket_number'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo $row->ticket_id; ?></td>
				</tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo ($row->repair_type == 'disc') ? $this->lang->line('common_game') : $this->lang->line('common_console_type'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo $row->system; ?></td>
				</tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo ($row->repair_type == 'disc') ? $this->lang->line('common_system') : $this->lang->line('common_serial_number'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo $row->serial_number; ?></td>
				</tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo $this->lang->line('common_name'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo $row->customer_first.' '.$row->customer_last; ?></td>
				</tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo $this->lang->line('common_phone_number'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo format_phone($row->phone_number); ?></td>
				</tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo $this->lang->line('common_date_of_drop_off'); ?>:</td>
					<td class="width50" style="text-align:right;"><?php echo standard_date('DATE_HUMAN', strtotime($row->drop_off_date)); ?></td>
				</tr>
				<tr><td colspan="2" style="text-align:left;"><?php echo $this->lang->line('common_problem'); ?>:</td></tr>
				<tr><td colspan="2" class="pad-sides" style="text-align:left;"><?php echo $row->problem; ?></td></tr>
				<tr>
					<td class="width50" style="text-align:left;"><?php echo $this->lang->line('common_estimate'); ?>:</td>
					<td class="width50" style="text-align:right;">$<?php echo $row->price; ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:left;">
						<br />______________________________________
						<br />Customer Signature
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:left;">
						<br />______________________________________
						<br /><?php echo config_item('company'); ?> Signature
					</td>
				</tr>
				<tr>
					<td colspan="2" class="print-dashed">
						<p style="text-align:center;">
							To check the status of your repair, please visit<br />
							<?php echo base_url(); ?><br />
							Enter your login information as follows:<br />
							- Login Email: email address provided<br />
							- Password: 10-digit phone number provided
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<br />
	</div>