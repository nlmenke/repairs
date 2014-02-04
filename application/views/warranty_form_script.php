<?php
$cssUrl = base_url().'assets/css/';
$imgUrl = base_url().'assets/images/';
$jsUrl = base_url().'assets/js/';
?>
<script>
$(function() {
	$('#date_drop').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_repair').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_test_1').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_test_2').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_called_1').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_called_2').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_called_3').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	$('#date_pick').datepicker({
		showOn: 'button',
		buttonImage: '<?php echo $imgUrl; ?>jqueryui/calendar.png',
		buttonImageOnly: true
	});
	
	var moveLeft = 20;
	var moveDown = 10;
	$('span#email-help').hover(function(e) {
		$('div#pop-email').show();
	}, function() {
		$('div#pop-email').hide();
	});
	$('span#email-help').mousemove(function(e) {
		$("div#pop-email").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
	});
	$('span#serial-help').hover(function(e) {
		$('div#pop-serial').show();
	}, function() {
		$('div#pop-serial').hide();
	});
	$('span#serial-help').mousemove(function(e) {
		$("div#pop-serial").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
	});
	$('span#required').hover(function(e) {
		$('div#pop-required').show();
	}, function() {
		$('div#pop-required').hide();
	});
	$('span#required').mousemove(function(e) {
		$("div#pop-required").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
	});
});
</script>