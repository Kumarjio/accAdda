$( function() {
	$('#acc_name_manage_reciept').focus(function(){
		$( "#acc_name_manage_reciept" ).autocomplete({
			  source: 'search/manage_reciept_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#manage_reciept_client_id').val(ui.item.client_id);
					
				}
		});
	})
  });