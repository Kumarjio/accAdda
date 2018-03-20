$(function(){
	$('#form').submit(function(){
		var user = $('#user').val();
		var pass = $('#pass').val();
		$.ajax({
			method : "POST",
			url : "login.php",
			data : "user="+user+"&pass="+pass,
			success:function( out ){
				if(out == 'true')
				{
					$('#fade').fadeOut();
					$('#Panel1').fadeOut();
					$('#Panel2').fadeIn();
				}else
				{
					$('#fade').fadeIn(function(){
						$('#fade').html(out);
					});
				}
			}
		});
		return false;
	});
	$('#but').click(function(){
		var user = $('#user').val();
		var pass = $('#pass').val();
		$.ajax({
			method : "POST",
			url : "login.php",
			data : "user="+user+"&pass="+pass,
			success:function( out ){
				if(out == 'true')
				{
					$('#fade').fadeOut();
					$('#Panel1').fadeOut();
					$('#Panel2').fadeIn();
				}else
				{
					$('#fade').fadeIn(function(){
						$('#fade').html(out);
					});
				}
			}
		});
		return false;
	});
	$('#Button2').click(function(){
		var company = $('#company').val();
		var year = $('#year').val();
		$.ajax({
			method : "POST",
			url : "login.php",
			data : "company="+company+"&year="+year,
			success:function( out ){
				$('#button').hide();
				$('#Button2').prop('disabled', true);
				$('#Button2').css('opacity','1');
				$('#load').show();
				setTimeout(function(){
					window.location = 'admin/'; }, 2000
				);
			}
		});
		return false;
	});
});