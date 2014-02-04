<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';
?>
	<div style="padding-top:50px;">
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
					<tr><td style="text-align:left;">Customer Name:</td><td style="text-align:right;"><?php echo $user['first_name'].' '.$user['last_name']; ?></td></tr>
					<tr><td style="text-align:left;">Phone Number:</td><td style="text-align:right;"><?php echo format_phone(substr_replace($user['phone'], str_repeat('*', strlen($user['phone']) - 4), 0, -4)); ?></td></tr>
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
					<tr>
						<th><?php echo $this->lang->line('common_system'); ?></th>
						<th><?php echo $this->lang->line('common_serial_number'); ?></th>
						<th><?php echo $this->lang->line('common_problem'); ?></th>
						<th><?php echo $this->lang->line('common_price'); ?></th>
						<th><?php echo $this->lang->line('common_drop_off_date'); ?></th>
						<th><?php echo $this->lang->line('common_date_repaired'); ?></th>
						<th><?php echo $this->lang->line('common_expires'); ?></th>
						<th><?php echo $this->lang->line('common_notes'); ?></th>
					</tr>
					<?php foreach($repairs[$type] as $console): ?>
					<tr<?php echo ($console->cnbf == 1) ? ' class="cnbf"' : ''; echo ($console->refix == 1) ? ' class="refix"' : ''; echo strstr($console->problem, 'PURCHASED') ? ' class="purchase"' : ''; ?>>
						<td class="system"><?php echo $console->system; ?></td>
						<td class="serial"><?php echo $console->serial_number; ?></td>
						<td class="problem"><?php echo $console->problem; ?></td>
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
									if($console->test_2_date != NULL && $console->test_2_date != '0000-00-00') {
										echo 'Needs to be tested 1 more time';
									} elseif($console->test_1_date != NULL && $console->test_1_date != '0000-00-00') {
										echo 'Needs to be tested 2 more times';
									} else {
										echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date));
									}
								} else {
									echo 'Our tech is working diligently to get to<br />your '.$console->repair_type.'. Thank you for your patience.';
								}
							} else {
								echo 'Unfortunately, this system cannot be fixed.';
							}
							if($console->called_1_date != NULL && $console->called_1_date != '0000-00-00') {
								echo '<br />You have been called ';
								if($console->called_3_date != NULL && $console->called_3_date != '0000-00-00') {
									echo 'thrice (3 times).<br />Last called: '.standard_date('DATE_HUMAN', strtotime($console->called_3_date));
								} elseif($console->called_2_date != NULL && $console->called_2_date != '0000-00-00') {
									echo 'twice (2 times).<br />Last called: '.standard_date('DATE_HUMAN', strtotime($console->called_2_date));
								} else {
									echo 'once (1 time).<br />Last called: '.standard_date('DATE_HUMAN', strtotime($console->called_1_date));
								}
							}
						} else {
							echo 'Repaired: '.standard_date('DATE_HUMAN', strtotime($console->repair_date)).'<br />Picked up: '.standard_date('DATE_HUMAN', strtotime($console->pick_up_date));
						} ?></td>
						<td class="expire<?php if($console->expire != NULL && standard_date('DATE_HUMAN', strtotime($console->expire)) < date('Y-m-d')) echo ' expired'; ?>"><?php echo ($console->expire == NULL) ? '' : standard_date('DATE_HUMAN', strtotime($console->expire)); ?></td>
						<td class="notes"><?php echo $console->notes == NULL ? '' : $console->notes; ?></td>
					</tr>
					<?php endforeach; ?>
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