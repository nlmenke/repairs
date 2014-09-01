$(function() {
	$('#date_repair').datepicker({
		showOn: 'button',
		buttonImage: SITE_URL + 'assets/images/jquery/calendar.png',
		buttonImageOnly: true
	});
	$('#date_test').datepicker({
		showOn: 'button',
		buttonImage: SITE_URL + 'assets/images/jquery/calendar.png',
		buttonImageOnly: true
	});
	$('#date_called').datepicker({
		showOn: 'button',
		buttonImage: SITE_URL + 'assets/images/jquery/calendar.png',
		buttonImageOnly: true
	});
	$('#date_customer').datepicker({
		showOn: 'button',
		buttonImage: SITE_URL + 'assets/images/jquery/calendar.png',
		buttonImageOnly: true
	});
	$('#date_pick').datepicker({
		showOn: 'button',
		buttonImage: SITE_URL + 'assets/images/jquery/calendar.png',
		buttonImageOnly: true
	});
	
	$(':input').tooltip({
		position: {
			my: 'left+10 middle',
			at: 'right middle',
			collision: 'flipfit flip'
		},
	});
	
	if($('input[name="repair_type"]:checked').val() == 'game') {
		$('#item_game').show();
		$('#item_mod').hide();
		$('#item_repair').hide();
		
		$('#description_mod').hide();
		$('#description_problem').show();
		
		$('#serial_serial').hide();
		$('#serial_system').show();
	} else if($('input[name="repair_type"]:checked').val() == 'modification') {
		$('#item_game').hide();
		$('#item_mod').show();
		$('#item_repair').hide();
		
		$('#description_mod').show();
		$('#description_problem').hide();
		
		$('#serial_serial').show();
		$('#serial_system').hide();
	} else {
		$('#item_game').hide();
		$('#item_mod').hide();
		$('#item_repair').show();
		
		$('#description_mod').hide();
		$('#description_problem').show();
		
		$('#serial_serial').show();
		$('#serial_system').hide();
	}
	$('input[name="repair_type"]').click(function() {
		if($(this).val() == 'game') {
			$('#item_game').show();
			$('#item_mod').hide();
			$('#item_repair').hide();
			
			$('#description_mod').hide();
			$('#description_problem').show();
			
			$('#serial_serial').hide();
			$('#serial_system').show();
		} else if($(this).val() == 'modification') {
			$('#item_game').hide();
			$('#item_mod').show();
			$('#item_repair').hide();
			
			$('#description_mod').show();
			$('#description_problem').hide();
			
			$('#serial_serial').show();
			$('#serial_system').hide();
		} else {
			$('#item_game').hide();
			$('#item_mod').hide();
			$('#item_repair').show();
			
			$('#description_mod').hide();
			$('#description_problem').show();
			
			$('#serial_serial').show();
			$('#serial_system').hide();
		}
	});
	
	if($('input[name="game_inside"]').is(':checked')) {
		$('#game_in_system').show();
	} else {
		$('#game_in_system').hide();
	}
	$('input[name="game_inside"]').change(function() {
		if($(this).is(':checked')) {
			$('#game_in_system').fadeIn('slow');
		} else {
			$('#game_in_system').fadeOut('slow');
		}
	});
	
	if($('input[name="replaced"]').is(':checked')) {
		$('#new_serial').show();
	} else {
		$('#new_serial').hide();
	}
	$('input[name="replaced"]').change(function() {
		if($(this).is(':checked')) {
			$('#new_serial').fadeIn('slow');
		} else {
			$('#new_serial').fadeOut('slow');
		}
	});
});