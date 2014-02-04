<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';

echo doctype('html5')."\n";
?>
<html lang="<?php echo $this->lang->line('common_lang'); ?>">
<head>
	<?php echo meta('robots', 'none'); ?>
	<?php echo meta('Content-type', 'text/html; charset='.config_item('charset'), 'equiv'); ?>
	<title><?php echo $this->lang->line('auth_login'); ?> | <?php echo config_item('company'); ?></title>
	<?php echo link_tag(base_url().'favicon.ico', 'shortcut icon', 'image/ico')."\n"; ?>
	<?php echo link_tag($cssUrl.'style.css', 'stylesheet', 'text/css', '', 'all')."\n"; ?>
</head>
<body id="login">
	<div style="padding-top:25px;">
		<fieldset style="width:150px">
			<legend align="center"><?php echo $this->lang->line('auth_login'); ?></legend>
			<div class="mainInfo">
				<div id="infoMessage"><?php echo $message; ?></div>
				<?php echo form_open('auth/login')."\n"; ?>
					<label for="email">Email:</label><br />
					<?php echo form_input($email)."\n"; ?>
					<br /><br />
					<label for="password">Password:</label><br />
					<?php echo form_input($password)."\n"; ?>
					<br /><br />
					<label for="remember">Remember Me:</label>
					<?php echo form_checkbox('remember', '1', FALSE)."\n"; ?>
					<br /><br />
					<?php echo form_submit('submit', $this->lang->line('auth_login'), 'style="float:right;"')."\n"; ?>
				<?php echo form_close()."\n"; ?>
			</div>
		</fieldset>
	</div>
</body>
</html>