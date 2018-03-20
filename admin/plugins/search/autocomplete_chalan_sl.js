$( function() {
	$('#account_name_sales').focus(function(){
		$( "#account_name_sales" ).autocomplete({
			  source: 'search/chalan_account_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$("#account_name_sales").attr("readonly", true);
					$('#client_id').val(ui.item.client_id);
					$('#client_address_sales').val(ui.item.address);
					$('#client_tin_sales').val(ui.item.gst);
					$.ajax({
						type: 'POST',
						url: 'search/seles_type.php',
						data: "sel="+ui.item.state+"&gst="+ui.item.gst,
						success: function (html) {
							$('#client_cst_sales').val(html);
							$('#tax_type').val(html);
						}
					});
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}		
				});
		});
  
  $('#account_name_sales').click(function(){
		$("#account_name_sales").removeAttr('readonly');
		$("#account_name_sales").val('');
		$('#client_id').val('');
		$('#client_address_sales').val('');
		$('#client_tin_sales').val('');
		$('#client_cst_sales').val('');
  });
  
  
  
  
  });
  
  
  