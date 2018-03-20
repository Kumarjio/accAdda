$( function() {
	$('#wid_magage_product_id').focus(function(){
		$( "#wid_magage_product_id" ).autocomplete({
			  source: 'search/wid_manage_user_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#wid_magage_product_id_hidden').val(ui.item.client_id);
				}
		});
	})
  });
  
  $( function() {
	$('#username_user').focus(function(){
		$( "#username_user" ).autocomplete({
			  source: 'search/wid_manage_username.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
				}
		});
	})
  });