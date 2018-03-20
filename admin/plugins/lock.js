$(function(){
	$('#but').click(function(){
		var pass = $('#Lpass').val();
		$.ajax({
			method : "POST",
			url : "lockpro.php",
			data : "Lpass="+pass,
			success:function( out ){
				if(out == 'true')
				{
					$('#err').fadeOut('fast');
					setTimeout(function(){
						window.location = 'admin/'; }, 500
					);
				}else
				{
					$('#hide').fadeOut('fast');
					$('#err').fadeIn();
					$('#err').html(out);
				}
			}
		});
		return false;
	});
	$('#butn').submit(function(){
		var pass = $('#Lpass').val();
		$.ajax({
			method : "POST",
			url : "lockpro.php",
			data : "Lpass="+pass,
			success:function( out ){
				if(out == 'true')
				{
					$('#err').fadeOut('fast');
					setTimeout(function(){
						window.location = 'admin/'; }, 500
					);
				}else
				{
					$('#hide').fadeOut('fast');
					$('#err').fadeIn();
					$('#err').html(out);
				}
			}
		});
		return false;
	});
});