$( function() {
	$('#wid_magage_product_id').focus(function(){
		$( "#wid_magage_product_id" ).autocomplete({
			  source: 'search/wid_manage_product_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#product_name_id_hidden').val(ui.item.product_id);
				}
		});
	})
  });
  
	