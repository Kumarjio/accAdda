$( function() {
	$('#wid_magage_product_id').focus(function(){
		$( "#wid_magage_product_id" ).autocomplete({
			  source: 'search/wid_manage_project_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_hidden').val(ui.item.product_id);
				}
		});
	})
  });
  
  $( function() {
	$('#wid_magage_product_id_mail').focus(function(){
		$( "#wid_magage_product_id_mail" ).autocomplete({
			  source: 'search/manage_project_email_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_email_hidden').val(ui.item.project_id);
				}
		});
	})
  });