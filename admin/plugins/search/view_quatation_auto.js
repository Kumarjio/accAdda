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
	$('#qutation_no').focus(function(){
		$( "#qutation_no" ).autocomplete({
			  source: 'search/view_quatation_no.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
				}
		});
	})
  });