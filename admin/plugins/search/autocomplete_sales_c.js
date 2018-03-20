$( function() {
	$('#account_name_sales').focus(function(){
		$( "#account_name_sales" ).autocomplete({
			  source: 'search/account_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#client_id').val(ui.item.client_id);
					$('#client_address_sales').val(ui.item.address);
					$('#client_tin_sales').val(ui.item.tin);
					$('#client_cst_sales').val(ui.item.cst);
					$.ajax({
							method : "POST",
							url : "search/sales_chalan.php",
							data : "id="+ui.item.client_id,
							success:function( out ){
								$("#invoice_id_sel_change").empty();
								if(out)
								{
									$('#chalan_id').fadeIn();
									$('#hide_in').val(Object.keys(JSON.parse(out)).length);
									$.each(JSON.parse(out), function (key,value) {
										$("#invoice_id_sel_change").append( value );
									});
								}
							}
						});
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
						$('#chalan_id').fadeOut();
					}
				}	
		});
	})
  });
  