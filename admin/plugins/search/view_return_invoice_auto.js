$( function() {
	$('#wid_magage_product_id').focus(function(){
		$( "#wid_magage_product_id" ).autocomplete({
			  source: 'search/manage_purchase_invoice_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_hidden').val(ui.item.client_id);
				}
		});
	})
  });
  
  $( function() {
	$('#acc_name_payment').focus(function(){
		$( "#acc_name_payment" ).autocomplete({
			  source: 'search/pu_ret_in_ser.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
				}
		});
	})
  });