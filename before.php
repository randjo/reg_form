<!DOCTYPE html>
<html>
<head>
	<title>Before Test</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
</head>
<body>
<p class="before">This is first row.</p>
<p id="row_1">This is second row.</p>
<div>
	<form id="step1" action="" method="get">
		<label>Name</label>
		<input type="text" name="name" />
		<input type="submit" value="Send" id="send" />
	</form>
</div>
<div id="from_ajax"></div>
<script>
	$(".before").before($("#row_1"));

	$('#step1').submit(function(event){
		var data_ = $('#step1').serialize();	
		jQuery.ajax({
		type: "POST",
		url: "testbefore.php",
		dataType:"text",
		data:data_,
			success:function(response){
				$("#from_ajax").html(response);
			},
		});
		event.preventDefault();
	});
</script>
</body>
</html>