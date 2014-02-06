<?php $imgUrl = base_url().'assets/images/';
$img_flag = array(
	'src'		=> $imgUrl.'icon/flag.png',
	'class'		=> 'icon icon-flag',
	'alt'		=> 'flag',
	'title'		=> 'flag',
	'width'		=> '16',
	'height'	=> '16'
);
$img_edit = array(
	'src'		=> $imgUrl.'icon/edit.png',
	'class'		=> 'icon icon-edit',
	'alt'		=> 'edit',
	'title'		=> 'Edit Repair',
	'width'		=> '16',
	'height'	=> '16'
);
$img_fixed = array(
	'src'		=> $imgUrl.'icon/fixed.png',
	'class'		=> 'icon icon-fixed',
	'alt'		=> 'fixed',
	'title'		=> 'Set as Fixed',
	'width'		=> '16',
	'height'	=> '16'
);
$img_pickup = array(
	'src'		=> $imgUrl.'icon/pickup.png',
	'class'		=> 'icon icon-pickup',
	'alt'		=> 'pickup',
	'title'		=> 'Set as Picked Up',
	'width'		=> '16',
	'height'	=> '16'
);
$img_ticket = array(
	'src'		=> $imgUrl.'icon/ticket.png',
	'class'		=> 'icon icon-ticket',
	'alt'		=> 'ticket',
	'title'		=> 'Reprint Ticket',
	'width'		=> '16',
	'height'	=> '16'
);
$img_report = array(
	'src'		=> $imgUrl.'icon/report.png',
	'class'		=> 'icon icon-report',
	'alt'		=> 'report',
	'title'		=> 'Print Report',
	'width'		=> '16',
	'height'	=> '16'
);
?>
<div class="toolbar">
	<div class="lists">
		<?php echo $this->pagination->create_links()."\n"; ?>
		<span class="totals">
			<?php echo (isset($total) ? sprintf($this->lang->line('repairs_total'), $total, $in_house, $refixes, $unrepairable, $replaced) : sprintf($this->lang->line('repairs_search_total'), $search_total))."\n"; ?>
		</span>
	</div>
	<div class="new-repair">
		<?php echo anchor('repairs/edit/-1', $this->lang->line('repairs_new'), 'class="button"'); ?>
	</div>
</div>
<div style="padding-top:25px;">
	<div class="category">
		<div class="cat_wrap">
			<div class="cat_head">
				<div class="h2wrap">
					<div class="h2left"></div>
					<div class="h2right"></div>
					<div class="h2center">
						<?php echo $this->lang->line('repairs_list'); ?>
						<?php echo form_open('repairs/search', array('class' => 'search')); ?>
							<?php echo form_input('search'); ?>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<table cellspacing="0">
				<thead>
					<tr>
						<!--<th>&nbsp;</th>-->
						<th><?php echo $this->lang->line('repairs_customer'); ?></th>
						<th><?php echo $this->lang->line('repairs_item'); ?></th>
						<th><?php echo $this->lang->line('repairs_problem'); ?></th>
						<th><?php echo $this->lang->line('repairs_price'); ?></th>
						<th><?php echo $this->lang->line('repairs_repaired'); ?></th>
						<th><?php echo $this->lang->line('repairs_date_tested_called'); ?></th>
						<th><?php echo $this->lang->line('repairs_expires'); ?></th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($results) > 0): ?>
					<?php foreach($results as $row): ?>
					<tr<?php echo ($row->replaced == 1) ? ' class="replaced"' : ''; echo ($row->cnbf == 1) ? ' class="cnbf"' : ''; echo ($row->refix == 1) ? ' class="refix"' : ''; ?>>
						<!--<td class="flag"><?php
						//echo ($row->pick_up_date == NULL && time() > strtotime($row->last_update.' +1 week')) ? img($img_flag) : '';
						
						//if($row->pick_up_date == NULL) {
						//	if($row->last_called_date == NULL && time() > strtotime($row->last_called_date.' +1 week')) {
						//		echo 'call date';
						//	} elseif($row->last_customer_call == NULL && time() > strtotime($row->last_customer_call.' +1 week')) {
						//		echo 'customer call date';
						//	} elseif($row->last_test_date == NULL && time() > strtotime($row->last_test_date.' +1 week')) {
						//		echo 'test date';
						//	} elseif($row->repair_date == NULL && time() > strtotime($row->repair_date.' +1 week')) {
						//		echo 'repair date';
						//	}
						//}
						?></td>-->
						<td class="name"><?php echo $row->customer_first.' '.$row->customer_last; ?><br /><?php echo format_phone($row->phone_number); ?></td>
						<td class="item"><?php echo $row->item; ?><br /><?php echo $row->serial_number; ?></td>
						<td class="problem"><?php echo $row->problem;
						echo ($row->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : '';
						
						echo (($row->cnbf == 1) || ($row->replaced == 1)) ? '<br />' : '';
						echo ($row->cnbf == 1) ? strtoupper($this->lang->line('repairs_cnbf')) : '';
						echo (($row->cnbf == 1) && ($row->replaced == 1)) ? ', ' : '';
						echo ($row->replaced == 1) ? strtoupper($this->lang->line('repairs_replaced')).(($row->new_serial != NULL) ? ' ('.$row->new_serial.')' : '') : '';
						?></td>
						<td class="quote">$<?php echo $row->price; ?></td>
						<td class="repair-employee"><?php echo ($row->repair_date == NULL) ? '' : standard_date('DATE_HUMAN', strtotime($row->repair_date)); ?><br /><?php echo $row->repair_employee; ?></td>
						<td class="tested"><?php
						echo ($row->last_test_date != NULL) ? standard_date('DATE_HUMAN', strtotime($row->last_test_date)).' ('.$row->times_tested.')' : '';
						echo (($row->last_test_date != NULL) && ($row->last_called_date != NULL)) ? ' /<br />' : '';
						echo ($row->last_called_date != NULL) ? standard_date('DATE_HUMAN', strtotime($row->last_called_date)).' ('.$row->times_called.')' : '';
						?></td>
						<td class="expire<?php echo ($row->expire != NULL && time() > strtotime($row->expire)) ? ' expired' : ''; ?>">
							<?php
							echo ($row->expire != NULL) ? standard_date('DATE_HUMAN', strtotime($row->expire)) : '';
							echo ($row->warranty_number != NULL) ? '<br />'.$row->warranty_number : '';
							?>
						</td>
						<td class="edit">
							<?php echo anchor('repairs/edit/'.$row->ticket_id, img($img_edit)); ?>
							<?php echo anchor('repairs/fixed/'.$row->ticket_id, img($img_fixed)); ?>
							<?php echo anchor('repairs/pickup/'.$row->ticket_id, img($img_pickup)); ?>
							<?php echo anchor('repairs/ticket/'.$row->ticket_id, img($img_ticket)); ?>
							<?php echo anchor('repairs/report/'.$row->ticket_id, img($img_report)); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr><td colspan="12">No repairs on file.</td></tr>
					<?php endif; ?>
				</tbody>
				<tfoot>
					<tr>
						<!--<th>&nbsp;</th>-->
						<th><?php echo $this->lang->line('repairs_customer'); ?></th>
						<th><?php echo $this->lang->line('repairs_item'); ?></th>
						<th><?php echo $this->lang->line('repairs_problem'); ?></th>
						<th><?php echo $this->lang->line('repairs_price'); ?></th>
						<th><?php echo $this->lang->line('repairs_repaired'); ?></th>
						<th><?php echo $this->lang->line('repairs_date_tested_called'); ?></th>
						<th><?php echo $this->lang->line('repairs_expires'); ?></th>
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