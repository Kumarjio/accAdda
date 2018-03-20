$( function() {
	$('#acc_name_manage_pay').focus(function(){
		$( "#acc_name_manage_pay" ).autocomplete({
			  source: 'search/manage_payment_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#manage_pay_client_id').val(ui.item.client_id);
					
				}
		});
	})
  });