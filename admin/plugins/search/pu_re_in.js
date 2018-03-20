$( function() {
	$('#account_name').focus(function(){
		$( "#account_name" ).autocomplete({
			  source: 'search/pu_re_account_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#client_id').val(ui.item.client_id);
					$('#client_address').val(ui.item.address);
					$('#client_tin').val(ui.item.tin);
					$('#client_cst').val(ui.item.cst);
					
						$.ajax({
							method : "POST",
							url : "search/purchase_invoice_id.php",
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
  
  $('#invoice_id_sel_change').change(function(){
		var id = $(this).val();
		if(id)
		{
			$.ajax({
				method : "POST",
				url : "search/pu_re_invoice_ch.php",
				data : "id="+id,
				success:function( out ){
					var outj = $.parseJSON(out);
					$('#chalan_no').val(outj.ch_no);
					$('#returnpurchase_chalan_date').val(outj.ch_date);
					$('#re_pu_invoice_pro').val( outj.prj_id ); 
					$('#trans_return_invoice').val( outj.transport );
					$('#pu_re_agnst').val( outj.agnst );
					$('#returnpurchase_due_date').val( outj.due_date );
				}
			});
		}
  });
  
  
	
  
  