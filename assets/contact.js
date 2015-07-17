$(document).ready(function() {

    $('#contactform-send').show();
    $('#contactform-sent').hide();
    $('#contactform-sending').hide();

	$('#contactform').submit(function(e) {

		e.preventDefault();

		// Change button to submitting
		$('#contactform-send-button').attr('disabled', 'disabled');
		$('#contactform-send').hide();
        $('#contactform-sent').hide();
		$('#contactform-sending').show();

		$.ajax({
			type: "POST",
			data: $('#contactform').serialize(),
			url: "api/forms/contact",
			success: function(data) {
                $('#contactform-send').hide();
                $('#contactform-sent').show();
        		$('#contactform-sending').hide();
                $('#contactform-send-button').removeAttr('disabled');
                $('#contactform-send-button').removeClass('btn-primary');
                $('#contactform-send-button').addClass('btn-success');
			},
			error: function(error) {

                $('#contactform-send').show();
                $('#contactform-sent').hide();
        		$('#contactform-sending').hide();
                $('#contactform-send-button').removeAttr('disabled');

                $('#contactform-error').text(errors);
                $('#contactform-error').show();
				setTimeout(function() {
					$('#contactform-error').fadeOut();
				}, 3000);
			}
		});
	});
});
