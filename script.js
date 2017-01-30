jQuery(
	function($)
	{
		var numAddresses = 1;
		var numNotes = 1;

		$('#step1').validate({
			submitHandler: function()
			{
				$('form').addClass('hide').filter('#step2').removeClass('hide');
			},
			rules: {
				fname: {
					required: true,
					minlength: 5
				}
				},
			messages: {
				fname: {
					required: "Please enter your name!",
					minlength: "Your name must consist of at least 5 characters!"
				}
			}
		});

		$('#step2').validate({
			submitHandler: function()
			{
				$('form').addClass('hide').filter('#step3').removeClass('hide');
			},
			rules: {
				addr1: {
					required: true,
					minlength: 5
				}
				},
			messages: {
				addr1: {
					required: "Please enter your address!",
					minlength: "Your address must consist of at least 5 characters!"
				}
			},
			invalidHandler: function(event, validator)
			{
				alert('Invalid data!');
			}
		});

		$('#step3').validate({
			submitHandler: function()
			{
				var data_ = $('#step1').serialize() + "&" + $('#step2').serialize() + "&" + $('#step3').serialize();
			
				jQuery.ajax({
				type: "POST",
				url: "my.php",
				dataType:"text",
				data:data_,
					success:function(response){
						$('form').addClass('hide').filter('#step4').removeClass('hide');
						$("#responds").append(response);
					},
				});
			},
			invalidHandler: function(event, validator)
			{
				alert('Invalid data!');
			}
		});

		$('.add-address').on(
			'click',
			function(e)
			{
				e.preventDefault();

				var $html = $($('#additional-address').clone().html());

				$html.find('input').each(function()
				{
					$(this).attr('name', $(this).attr('name') + "_" + numAddresses);
				});

				$('#step2 .before-here').before($html);

				numAddresses++;
			}
		);

		$('.add-note').on(
			'click',
			function(e)
			{
				e.preventDefault();

				var $html = $($('#additional-note').clone().html());

				$html.find("textarea").each(function()
				{
					$(this).attr('name', $(this).attr('name') + "_" + numNotes);
				});

				$('#step3 .before-here').before($html);

				numNotes++;
			}
		);		

		$('.backto-form-2').on(
			'click',
			function(e)
			{
				e.preventDefault();

				$('form').addClass('hide').filter('#step2').removeClass('hide');
			}
		);

		$('.backto-form-1').on(
			'click',
			function(e)
			{
				e.preventDefault();

				$('form').addClass('hide').filter('#step1').removeClass('hide');
			}
		);
	}
);