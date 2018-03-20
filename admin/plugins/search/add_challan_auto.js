$( function() {
	$('#account_name').focus(function(){
		$( "#account_name" ).autocomplete({
			  source: 'search/account_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#client_id').val(ui.item.client_id);
					$('#client_address').val(ui.item.address);
					$('#client_tin').val(ui.item.tin);
					$('#client_cst').val(ui.item.cst);
				}
		});
	})
  });
  $( function() {
	$('#tax_select').focus(function(){
		$( "#tax_select" ).autocomplete({
			  source: 'search/vat_search.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#gst_persent').html(ui.item.gst_persent);
					$('#cst_persent').html(ui.item.cst_persent);
					$('#vat_persent').html(ui.item.vat_persent);
					$('#st_persent').html(ui.item.st_persent);
					$('#add_tax_persent').html(ui.item.add_tax_persent);
					var total_amo = parseFloat($('#allPrice').text()) + parseFloat($('#freight').val());
					if(total_amo > 0)
					{
						var st = parseFloat(ui.item.st_persent) * total_amo / 100;
						var cst = parseFloat(ui.item.cst_persent) * total_amo / 100;
						var add_tax = parseFloat(ui.item.add_tax_persent) * total_amo / 100;
						var vat = parseFloat(ui.item.vat_persent) * total_amo / 100;
						var gst = parseFloat(ui.item.gst_persent) * total_amo / 100;
						var price_with_tax = st + cst + add_tax + vat + total_amo;
						$('#totalpricewith_tax').val( price_with_tax );
						$('#st_price').html( st );
						$('#cst_price').html( cst );
						$('#vat_price').html( vat );
						$('#gst_price').html( gst );
						$('#add_tax_price').html( add_tax );
						$('#st_tax_tax').val( st );
						$('#vat_tax_tax').val( vat );
						$('#cst_tax_tax').val( cst );
						$('#add_tax_tax').val( add_tax );
					}
					
				}
		});
	})
	
  });
  
  