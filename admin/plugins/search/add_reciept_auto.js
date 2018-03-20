$( function() {
	$('#account_name_add_reciept').focus(function(){
		$( "#account_name_add_reciept" ).autocomplete({
			  source: 'search/add_new_reciept_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#add_reciept_client_id').val(ui.item.client_id);
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
  $( function() {
	$('#pay_bank').focus(function(){
		$( "#pay_bank" ).autocomplete({
			  source: 'search/add_receipt_bank.php',
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