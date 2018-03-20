$( function() {
	$('#wid_magage_product_id_contact').focus(function(){
		$( "#wid_magage_product_id_contact" ).autocomplete({
			  source: 'search/manage_company_contact_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_contact_hidden').val(ui.item.client_id);
				}
		});
	})
  });