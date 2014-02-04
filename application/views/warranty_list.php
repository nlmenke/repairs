<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';
?>
<div style="padding-top:25px;">
	<div class="lists">
		<?php echo anchor('', 'Full List', 'class="button"') ?>
		<?php echo anchor('repairs/in_house', 'In House', 'class="button"') ?>
		<?php echo anchor('repairs/under_warranty', 'Under Warranty', 'class="button"') ?>
		<?php echo anchor('repairs/expired', 'Expired', 'class="button"') ?>
		<span class="totals">
			<?php echo 'Total Repairs: <b>'.$total.'</b> (<b>'.$in_house.'</b> currently in house, <b>'.$refixes.'</b> have been refixes, <b>'.$unrepairable.'</b> were deemed unrepairable)'; ?>
		</span>
	</div>
	<div class="new-repair"><?php echo anchor('repairs/view/-1', 'New Repair', 'class="button"'); ?></div>
	<div id="list" class="category">
		<div class="cat_wrap">
			<div class="cat_head">
				<div class="h2wrap">
					<div class="h2left"></div>
					<div class="h2right"></div>
					<div class="h2center">Repair List</div>
				</div>
			</div>
			<table cellspacing="0">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('common_customer'); ?></th>
						<th><?php echo $this->lang->line('common_system'); ?></th>
						<th><?php echo $this->lang->line('common_problem'); ?></th>
						<th><?php echo $this->lang->line('common_price'); ?></th>
						<th><?php echo $this->lang->line('common_confirmed'); ?>?</th>
						<th><?php echo $this->lang->line('common_repaired'); ?></th>
						<th><?php echo $this->lang->line('common_last_date_tested').' (#)'; ?></th>
						<th><?php echo $this->lang->line('common_last_date_called').' (#)'; ?></th>
						<th><?php echo $this->lang->line('common_expires'); ?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($results) > 0): ?>
					<?php foreach($results as $row): ?>
					<tr<?php echo ($row->cnbf == 1) ? ' class="cnbf"' : ''; echo ($row->refix == 1) ? ' class="refix"' : ''; echo strstr($row->problem, 'PURCHASED') ? ' class="purchase"' : ''; ?>>
						<td class="name"><?php echo $row->customer_first.' '.$row->customer_last; ?><br /><?php echo format_phone($row->phone_number); ?></td>
						<td class="system"><?php echo $row->system; ?><br /><?php echo $row->serial_number; ?></td>
						<td class="problem"><?php echo $row->problem;
						if(($row->cnbf == 1) && ($row->refix == 1)) {
							echo ' ('.strtoupper($this->lang->line('common_cnbf').', '.$this->lang->line('common_refix')).')';
						} else if($row->cnbf == 1) {
							echo ' ('.strtoupper($this->lang->line('common_cnbf')).')';
						} else if($row->refix == 1) {
							echo ' ('.strtoupper($this->lang->line('common_refix')).')';
						} ?></td>
						<td class="quote">$<?php echo $row->price; ?></td>
						<td class="confirmed"><?php echo ($row->confirmed == 1) ? 'Yes' : 'No'; ?></td>
						<td class="repair-employee"><?php echo ($row->repair_date == NULL) ? '' : standard_date('DATE_HUMAN', strtotime($row->repair_date)); ?><br /><?php echo $row->repair_employee; ?></td>
						<td class="tested"><?php if($row->test_2_date != NULL) {
							echo standard_date('DATE_HUMAN', strtotime($row->test_2_date)).' (2)';
						} else if($row->test_1_date != NULL) {
							echo standard_date('DATE_HUMAN', strtotime($row->test_1_date)).' (1)';
						} else {
							echo '';
						} ?></td>
						<td class="called"><?php if($row->called_3_date != NULL) {
							echo standard_date('DATE_HUMAN', strtotime($row->called_3_date)).' (3)';
						} else if($row->called_2_date != NULL) {
							echo standard_date('DATE_HUMAN', strtotime($row->called_2_date)).' (2)';
						} else if($row->called_1_date != NULL) {
							echo standard_date('DATE_HUMAN', strtotime($row->called_1_date)).' (1)';
						} else {
							echo '';
						} ?></td>
						<td class="expire<?php if($row->expire != NULL && time() > strtotime($row->expire)) echo ' expired'; ?>"><?php echo ($row->expire == NULL) ? '' : standard_date('DATE_HUMAN', strtotime($row->expire)); ?></td>
						<td class="edit">
							<?php echo anchor('repairs/view/'.$row->ticket_id, '['.$this->lang->line('common_edit').']'); ?> /
							<?php echo anchor('repairs/ticket/'.$row->ticket_id, '['.$this->lang->line('common_ticket').']'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="12">No repairs on file.</td></tr>
					<?php endif; ?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php echo $this->lang->line('common_customer'); ?></th>
						<th><?php echo $this->lang->line('common_system'); ?></th>
						<th><?php echo $this->lang->line('common_problem'); ?></th>
						<th><?php echo $this->lang->line('common_price'); ?></th>
						<th><?php echo $this->lang->line('common_confirmed'); ?>?</th>
						<th><?php echo $this->lang->line('common_repaired'); ?></th>
						<th><?php echo $this->lang->line('common_last_date_tested').' (#)'; ?></th>
						<th><?php echo $this->lang->line('common_last_date_called').' (#)'; ?></th>
						<th><?php echo $this->lang->line('common_expires'); ?></th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			<div class="cat_foot">
				<div class="cat_foot_left"></div>
				<div class="cat_foot_right"></div>
			</div>
		</div>
	</div>
</div>