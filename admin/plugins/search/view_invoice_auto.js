$( function() {
	$('#view_invoice_name').focus(function(){
		$( "#view_invoice_name" ).autocomplete({
			  source: 'search/view_invoice_auto.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#view_invoice_hidden').val(ui.item.client_id);
					
				}
		});
	})
  });