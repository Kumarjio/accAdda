$( function() {
	$('#acc_name_view_quatation').focus(function(){
		$( "#acc_name_view_quatation" ).autocomplete({
			  source: 'search/view_quatation_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#view_quatation_client_id').val(ui.item.client_id);
					
				}
		});
	})
  });
  
  $( function() {
	$('#chalan_no_auto').focus(function(){
		$( "#chalan_no_auto" ).autocomplete({
			  source: 'search/view_quatation_chalan_php.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					console.log(ui.item);
				}
		});
	})
  });