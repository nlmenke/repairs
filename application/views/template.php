<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';

echo doctype('html5')."\n";
?>
<html lang="<?php echo $this->lang->line('common_lang'); ?>">
<head>
	<?php echo meta('robots', 'none'); ?>
	<?php echo meta('Content-type', 'text/html; charset='.config_item('charset').'', 'equiv'); ?>
	<title><?php echo $page_title; ?> | <?php echo config_item('company'); ?></title>
	<?php echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>
	<?php echo link_tag($cssUrl.'style.css', 'stylesheet', 'text/css', '', 'all')."\n"; ?>
	<?php echo link_tag($cssUrl.'print.css', 'stylesheet', 'text/css', '', 'print')."\n"; ?>
	<?php echo isset($extra_head) ? $this->load->view($extra_head)."\n" : '';?>
	<?php echo isset($script) ? $this->load->view($script)."\n" : '';?>
</head>
<body<?php echo ' id="'.$body_id.'"'; ?>>
	<div class="toolbar">
		<span style="float:left;">
			<?php if($this->ion_auth->logged_in()): // user is logged in ?>
			<?php echo $this->lang->line('common_logged_in_as'); ?> <strong><?php echo $user['first_name'].' '.$user['last_name']; ?></strong> <small><?php echo anchor('auth/logout', '['.$this->lang->line('auth_logout').']'); ?></small>
			<?php else: // not logged in ?>
			<?php echo $this->lang->line('common_not_logged_in'); ?> <small><?php echo anchor('auth/login', '['.$this->lang->line('auth_login').']'); ?></small>
			<?php endif; ?>
		</span>
		<strong><?php echo anchor('', config_item('company').' '.$this->lang->line('common_repairs')); ?></strong>
		<span style="float:right;">
			<time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('l, F j, Y'); ?></time>
		</span>
	</div>
	<?php echo $this->load->view($content)."\n"; ?>
	<p class="footer">
		<?php if($this->ion_auth->is_admin() || $this->ion_auth->is_group('employee')): ?>
		<span>Script executed in <strong>{elapsed_time}</strong> seconds with <strong><?php echo $this->db->total_queries(); ?></strong> <?php echo $this->db->total_queries() == 1 ? 'query' : 'queries'; ?>.</span>
		Version <?php echo config_item('application_version'); ?> by <?php echo anchor('https://github.com/nlmenke', 'N.L.Menke'); ?>.
		<?php else: ?>
		Version <?php echo config_item('application_version'); ?>.
		<?php endif; ?>
	</p>
</body>
</html>