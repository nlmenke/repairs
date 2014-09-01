$(function() {
    $('#date_repair').datepicker({
        autoclose: true
    });
    $('#date_test').datepicker({
        autoclose: true
    });
    $('#date_called').datepicker({
        autoclose: true
    });
    $('#date_customer').datepicker({
        autoclose: true
    });
    $('#date_pick').datepicker({
        autoclose: true
    });

    if($('#repair_type').val() == 'game') {
        $('#item_game').show();
        $('#item_mod').hide();
        $('#item_repair').hide();

        $('#description_mod').hide();
        $('#description_problem').show();

        $('#serial_serial').hide();
        $('#serial_system').show();

        $('#game_inside_check').hide();
    } else if($('#repair_type').val() == 'modification') {
        $('#item_game').hide();
        $('#item_mod').show();
        $('#item_repair').hide();

        $('#description_mod').show();
        $('#description_problem').hide();

        $('#serial_serial').show();
        $('#serial_system').hide();

        $('#game_inside_check').show();
    } else {
        $('#item_game').hide();
        $('#item_mod').hide();
        $('#item_repair').show();

        $('#description_mod').hide();
        $('#description_problem').show();

        $('#serial_serial').show();
        $('#serial_system').hide();

        $('#game_inside_check').show();
    }
    $('#repair_type').change(function() {
        if($(this).val() == 'game') {
            $('#item_game').show();
            $('#item_mod').hide();
            $('#item_repair').hide();

            $('#description_mod').hide();
            $('#description_problem').show();

            $('#serial_serial').hide();
            $('#serial_system').show();

            $('#game_inside_check').fadeOut('slow');
        } else if($(this).val() == 'modification') {
            $('#item_game').hide();
            $('#item_mod').show();
            $('#item_repair').hide();

            $('#description_mod').show();
            $('#description_problem').hide();

            $('#serial_serial').show();
            $('#serial_system').hide();

            $('#game_inside_check').fadeIn('slow');
        } else {
            $('#item_game').hide();
            $('#item_mod').hide();
            $('#item_repair').show();

            $('#description_mod').hide();
            $('#description_problem').show();

            $('#serial_serial').show();
            $('#serial_system').hide();

            $('#game_inside_check').fadeIn('slow');
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