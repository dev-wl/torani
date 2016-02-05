$(document).ready(function() {
	$('.contact-us a.contact').click(function(e) {
		e.preventDefault();
		name = $('#username').val();
		email = $('#email').val();
		msg = $('#message').val();

		if(name == '' || email == '' || msg == '') {
			$('<p class="popup-response">Please fill in all fields!</p>').insertBefore('.popup_form .controls');
			$('p.popup-response').delay(2000).fadeTo('slow', 0, function() {
				$('p.popup-response').remove();
			});
			return;
		}

		$('.popup_form input, .popup_form textarea').attr('disabled', true);
		$('.popup_form .contact-us a.contact').addClass('inactive');
		$('.popup_form .preloader').css('display', 'block');

		$.post(ajaxurl, {
				action: 'send',
				name: name,
				email: email,
				msg: msg
			}, function (response) {
			    if(response == "0") {
			    	$('#email').css('border', '1px solid #f00');
			    } else if(response == "1"){
			    	$('<p class="popup-response">Thank you for contacting us, your message was sent successfully!</p>').insertBefore('.popup_form .controls');
			    	$('#email').css('border', '2px solid #EEE');
			    	setTimeout(function(){
				    	$('#wlpopup-wrap').css('display', 'none');
				        $('.overlay').css('display', 'none');
				        $('p.popup-response').remove();
				        $('#username').val('');
						$('#email').val('');
						$('#message').val('');
				    }, 2000);
			    } else {
			    	$('<p class="popup-response>Error. Sorry! Your email cannot be sent</p>').insertBefore('.popup_form .controls');
			    }

			    $('.popup_form input, .popup_form textarea').attr('disabled', false);
				$('.popup_form .contact-us a.contact').removeClass('inactive');
				$('.popup_form .preloader').css('display', 'none');
			}
		);

	});
});