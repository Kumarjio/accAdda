$( function() {
	$('#wid_magage_product_id').focus(function(){
		$( "#wid_magage_product_id" ).autocomplete({
			  source: 'search/wid_manage_company_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_hidden').val(ui.item.company_id);
					console.log(ui.item);
				}
		});
	})
  });