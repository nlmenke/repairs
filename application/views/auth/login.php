<?php
$cssUrl = base_url().'assets/css/';

echo doctype('html5')."\n";
?>
<html lang="<?php echo $this->lang->line('common_lang'); ?>">
<head>
	<?php echo meta('robots', 'none'); ?>
	<?php echo meta('Content-type', 'text/html;charset='.config_item('charset'), 'equiv'); ?>
	<title><?php echo $this->lang->line('auth_login_title').' | '.config_item('company'); ?></title>
	<?php echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>
	<?php foreach(get_css_files() as $css_file): ?>
	<?php echo link_tag($css_file['path'].'?'.app_version(), 'stylesheet', 'text/css', '', $css_file['media'])."\n"; ?>
	<?php endforeach; ?>
	<?php foreach(get_js_files() as $js_file): ?>
	<?php echo script_tag($js_file['path'].'?'.app_version())."\n"; ?>
	<?php endforeach; ?>
</head>
<body id="login">
	<div id="wrapper">
		<fieldset>
			<legend align="center"><?php echo $this->lang->line('auth_login_title'); ?></legend>
			<div class="maininfo">
				<div id="infomessage"><?php echo $message; ?></div>
				<?php echo form_open('auth/login')."\n"; ?>
					<label for="identity"><?php echo ucfirst($this->config->item('identity', 'ion_auth')); ?></label>
					<br />
					<?php echo form_input($identity)."\n"; ?>
					<br /><br />
					<label for="password">Password</label>
					<br />
					<?php echo form_input($password)."\n"; ?>
					<br /><br />
					<?php echo form_submit('submit', $this->lang->line('auth_login'), 'style="float:right;"')."\n"; ?>
				<?php echo form_close()."\n"; ?>
			</div>
		</fieldset>
	</div>
</body>
</html>