$( function() {
	$('#sales_return_id').focus(function(){
		$( "#sales_return_id" ).autocomplete({
			  source: 'search/manage_salesr_invoce_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#sales_return_id_hidden').val(ui.item.client_id);
				}
		});
	})
  });
  
  $( function() {
	$('#sales_return_invoice').focus(function(){
		$( "#sales_return_invoice" ).autocomplete({
			  source: 'search/manage_sales_return_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
				}
		});
	})
  });