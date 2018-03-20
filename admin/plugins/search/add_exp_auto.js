$( function() {
	$('#acc_name_exp').focus(function(){
		$( "#acc_name_exp" ).autocomplete({
			  source: 'search/add_expen_auto.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#acc_name_hidd_exp').val(ui.item.client_id);
					
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
			  source: 'search/add_ex_bank.php',
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
});