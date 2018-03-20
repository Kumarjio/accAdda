$( function() {
	$('#view_acc_name').focus(function(){
		$( "#view_acc_name" ).autocomplete({
			  source: 'search/new_ver_auto.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#hid_id').val(ui.item.client_id);
					$.ajax({
							method : "POST",
							url : "search/verf_date.php",
							data : "id="+ui.item.client_id,
							success:function( out ){
								$.each(JSON.parse(out), function (key,value) {
									$("#invoice_id_sel_change").append( value );
								});
							}
						});
					
				}
		});
	})
  });
  
 