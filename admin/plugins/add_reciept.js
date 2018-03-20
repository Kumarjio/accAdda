$(document).ready(function(){
	$("#pay_mode").change(function(){
		if($(this).val() === 'bank')
		{
			$('#bank_payment').fadeIn();
			
		}
		else{
			$('#bank_payment').fadeOut();
		}
		
	});
	$("#tds_payment").blur(function(){
		var amount= parseFloat($('#amount_payment').val());
		var tds=parseFloat($(this).val());
		if(amount && tds){
		$("#total_payment").val(amount+tds);
		}
		else{
			$("#total_payment").val(amount);
		}
	});
	
	$("#amount_payment").blur(function(){
		var amount= parseFloat($('#tds_payment').val());
		var tds=parseFloat($(this).val());
		if(amount && tds){
		$("#total_payment").val(amount+tds);
		}
		else{
			$("#total_payment").val(tds);
		}
	});
});