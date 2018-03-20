$( function() {
	$('#wid_magage_product_id_mail').focus(function(){
		$( "#wid_magage_product_id_mail" ).autocomplete({
			  source: 'search/manage_company_email_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_email_hidden').val(ui.item.client_id);
				}
		});
	})
  });