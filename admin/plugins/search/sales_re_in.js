$( function() {
	$('#account_name_sales').focus(function(){
		$( "#account_name_sales" ).autocomplete({
			  source: 'search/sales_re_account_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#client_id').val(ui.item.client_id);
					$('#client_address_sales').val(ui.item.address);
					$('#client_tin_sales').val(ui.item.tin);
					$('#client_cst_sales').val(ui.item.cst);
					
					$.ajax({
							method : "POST",
							url : "search/sales_invoice_id.php",
							data : "id="+ui.item.client_id,
							success:function( out ){
								$("#invoice_id_sel option").each(function() {
									$(this).remove();
								});
								$.each(JSON.parse(out), function (key,value) {
									$("#invoice_id_sel").append( value );
								});
							}
						});
				}
		});
	})
  });
  $('#invoice_id_sel').change(function(){
		var id = $(this).val();
		if(id)
		{
			$.ajax({
				method : "POST",
				url : "search/sales_re_invoice_ch.php",
				data : "id="+id,
				success:function( out ){
					var outj = $.parseJSON(out);
					$('#chalan_no').val(outj.ch_no);
					$('#returnsales_chalan_date').val(outj.ch_date);
					$('#re_sales_invoice_pro').val( outj.prj_id ); 
					$('#trans_return_invoice').val( outj.transport );
					$('#sales_re_agnst').val( outj.agnst );
					$('#returnsales_due_date').val( outj.due_date );
				}
			});
		}
  });
  
  