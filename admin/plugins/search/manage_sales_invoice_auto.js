$( function() {
	$('#magage_sales_id').focus(function(){
		$( "#magage_sales_id" ).autocomplete({
			  source: 'search/manage_sales_invoce_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#manage_sales_id_hidden').val(ui.item.client_id);
				}
		});
	})
  });
  
  $( function() {
	$('#sales_qo_no').focus(function(){
		$( "#sales_qo_no" ).autocomplete({
			  source: 'search/manage_sales_invoice_id_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#add_pay_client_id').val(ui.item.client_id);
				}
		});
	})
  });
  