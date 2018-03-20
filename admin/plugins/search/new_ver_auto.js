$( function() {
	$('#account_name_newver').focus(function(){
		$('#p_name').fadeOut("slow");

		$( "#account_name_newver" ).autocomplete({
			  source: 'search/new_ver_auto.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#name_hidden_ver').val(ui.item.client_id);
					
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}		
		});
	})
  });