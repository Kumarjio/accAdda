$( function() {
	$('#acc_name_payment').focus(function(){
		$( "#acc_name_payment" ).autocomplete({
			  source: 'search/add_payment_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#add_pay_client_id').val(ui.item.client_id);
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
						$('#row_pur_in').fadeOut();
					}
				}	
		});
	})
  });
  
  $( function() {
	$('#pay_bank').focus(function(){
		$( "#pay_bank" ).autocomplete({
			  source: 'search/add_payment_bank.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#pay_bank_id').val(ui.item.client_id);
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}	
		});
	})
  });