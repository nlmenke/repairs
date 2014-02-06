<?php
$imgUrl = base_url().'assets/images/';

echo doctype('html5')."\n";
?>
<html lang="<?php echo $this->lang->line('common_lang'); ?>">
<head>
	<?php echo meta('robots', 'none'); ?>
	<?php echo meta('Content-type', 'text/html;charset='.config_item('charset'), 'equiv'); ?>
	<base href="<?php echo base_url(); ?>" />
	<title><?php echo $page_title; ?> | <?php echo config_item('company'); ?></title>
	<?php echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>
	<?php if(isset($form) && $form === TRUE): ?>
	<?php foreach(get_form_css_files() as $css_file): ?>
	<?php echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
	<?php endforeach; ?>
	<script type="text/javascript">
		var SITE_URL = '<?php echo site_url(); ?>';
	</script>
	<?php foreach(get_form_js_files() as $js_file): ?>
	<?php echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
	<?php endforeach; ?>
	<?php else: ?>
	<?php foreach(get_css_files() as $css_file): ?>
	<?php echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
	<?php endforeach; ?>
	<?php foreach(get_js_files() as $js_file): ?>
	<?php echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
	<?php endforeach; ?>
	<?php endif; ?>
</head>
<body <?php echo 'id="'.$body_id.'"'; ?>>
	<div class="topbar">
		<span style="float:left;">
			<?php if($this->ion_auth->logged_in()): // user is logged in ?>
			<?php echo $this->lang->line('common_logged_in_as'); ?> <strong><?php echo $user->first_name.' '.$user->last_name; ?></strong> <small><?php echo anchor('auth/logout', '['.$this->lang->line('auth_logout').']'); ?></small>
			<?php else: // not logged in ?>
			<?php echo $this->lang->line('common_not_logged_in'); ?> <small><?php echo anchor('auth/login', '['.$this->lang->line('auth_login').']'); ?></small>
			<?php endif; ?>
		</span>
		<strong><?php echo anchor('', config_item('company').' '.$this->lang->line('repairs_repairs')); ?></strong>
		<span style="float:right;">
			<time datetime="<?php echo date('Y-m-d'); ?>"><?php echo date('l, F j, Y'); ?></time>
		</span>
	</div>
	<?php echo $this->load->view($content)."\n"; ?>
	<div class="footer">
		<span class="copyright"><?php echo copyright('2012'); ?></span>
		<span class="version">
			<?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')): ?>
			<span><?php echo sprintf($this->lang->line('common_rendered'), $this->db->total_queries(), $this->db->total_queries() == 1 ? $this->lang->line('common_query') : $this->lang->line('common_queries')); ?>.</span>
			<?php endif; ?>
			<?php if($this->ion_auth->is_admin() || $this->ion_auth->in_group('employee')): ?>
			Version <?php echo app_version('full'); ?> by <?php echo anchor('https://github.com/nlmenke', 'N.L.Menke'); ?>.
			<?php else: ?>
			Version <?php echo app_version(); ?>.
			<?php endif; ?>
		</span>
	</div>
</body>
</html>