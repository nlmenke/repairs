<?php $imgUrl = base_url().'assets/images/'; ?>
<div style="padding-top:30px;">
	<div id="list" class="category">
		<div class="cat_wrap">
			<div class="cat_head">
				<div class="h2wrap">
					<div class="h2left"></div>
					<div class="h2right"></div>
					<div class="h2center">Customer Information</div>
				</div>
			</div>
			<table cellspacing="0">
				<tr><td style="text-align:left;">Customer Name:</td><td style="text-align:right;"><?php echo $user->first_name.' '.$user->last_name; ?></td></tr>
				<tr><td style="text-align:left;">Phone Number:</td><td style="text-align:right;"><?php echo format_phone(substr_replace($user->phone, str_repeat('*', strlen($user->phone) - 4), 0, -4)); ?></td></tr>
			</table>
			<div class="cat_foot">
				<div class="cat_foot_left"></div>
				<div class="cat_foot_right"></div>
			</div>
		</div>
	</div>
	<br />
	<?php foreach($repair_type as $type): ?>
	<?php if(count($repairs[$type]) > 0): ?>
	<div id="list" class="category">
		<div class="cat_wrap">
			<div class="cat_head">
				<div class="h2wrap">
					<div class="h2left"></div>
					<div class="h2right"></div>
					<div class="h2center"><?php if($type != 'modification') echo ucfirst($type.' Repairs'); else echo ucfirst($type.'s'); ?></div>
				</div>
			</div>
			<table cellspacing="0">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('repairs_item'); ?></th>
						<th><?php echo $this->lang->line('repairs_problem'); ?></th>
						<th><?php echo $this->lang->line('repairs_price'); ?></th>
						<th><?php echo $this->lang->line('repairs_drop_off_date'); ?></th>
						<th><?php echo $this->lang->line('repairs_date_repaired'); ?></th>
						<th><?php echo $this->lang->line('repairs_expires'); ?></th>
						<th><?php echo $this->lang->line('repairs_notes'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($repairs[$type] as $console): ?>
					<tr<?php echo ($console->replaced == 1) ? ' class="replaced"' : ''; echo ($console->cnbf == 1) ? ' class="cnbf"' : ''; echo ($console->refix == 1) ? ' class="refix"' : ''; ?>>
						<td class="item"><?php echo $console->item; ?><br /><?php echo $console->serial_number; ?></td>
						<td class="problem"><?php echo $console->problem;
						echo ($console->refix == 1) ? ' ['.strtoupper($this->lang->line('repairs_refix')).']' : '';
						
						echo (($console->cnbf == 1) || ($console->replaced == 1)) ? '<br />' : '';
						echo ($console->cnbf == 1) ? strtoupper($this->lang->line('repairs_cannot_be_fixed')) : '';
						echo (($console->cnbf == 1) && ($console->replaced == 1)) ? ', ' : '';
						echo ($console->replaced == 1) ? strtoupper($this->lang->line('repairs_replaced')).(($console->new_serial != NULL) ? ' ('.$console->new_serial.')' : '') : '';
						?></td>
						<td class="quote">$<?php echo $console->price; ?></td>
						<td class="drop-off-date"><?php
						$date_time = standard_date('DATE_HUMAN', strtotime($console->drop_off_date));
						if(date('H:i:s', strtotime($console->drop_off_date)) != '00:00:00') {
							$date_time .= '<br />'.date('g:i a', strtotime($console->drop_off_date));
						}
						echo $date_time;
						?></td>
						<td class="repair-date"><?php
						if($console->pick_up_date == NULL || $console->pick_up_date == '0000-00-00') {
							if($console->cnbf != 1) {
								if($console->repair_date != NULL && $console->repair_date != '0000-00-00') {
									if($console->last_test_date != NULL && $console->last_test_date != '0000-00-00') {
										echo 'Needs to be tested.';
									} else {
										echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date));
									}
								} else {
									echo 'Our tech is working diligently to get to<br />your '.$console->repair_type.'. Thank you for your patience.';
								}
							} else {
								echo 'Unfortunately, this system cannot be fixed.<br />You may pick it up at any time.';
							}
							if($console->last_called_date != NULL && $console->last_called_date != '0000-00-00' && $console->times_called != '0') {
								echo '<br />You have been called '.$console->times_called.' time(s).<br />Last called: '.standard_date('DATE_HUMAN', strtotime($console->last_called_date));
							}
						} else {
							echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date)).'<br />Picked up: '.standard_date('DATE_HUMAN', strtotime($console->pick_up_date));
						} ?></td>
						<td class="expire<?php echo ($console->expire != NULL && time() > strtotime($console->expire)) ? ' expired' : ''; ?>">
							<?php
							echo ($console->expire != NULL) ? standard_date('DATE_HUMAN', strtotime($console->expire)) : '';
							echo ($console->warranty_number != NULL) ? '<br />'.$console->warranty_number : '';
							?>
						</td>
						<td class="notes"><?php echo $console->additional_notes == NULL ? '' : $console->additional_notes; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="cat_foot">
				<div class="cat_foot_left"></div>
				<div class="cat_foot_right"></div>
			</div>
		</div>
	</div>
	<br />
	<?php endif; ?>
	<?php endforeach; ?>
</div>