$(document).ready(function() {
    var max_fields      = 1000; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_sales"); //Fields wrapper
    var add_button      = $("#add_field_button_sales"); //Add button ID
    var id_e = "#sales_total";
	
    var x = 1; //initlal text box count
    $(document).on('click', '#add_field_button_sales',function(e){ //on add input button click
		$.ajax({
			method : "POST",
			url : "search/unit_serach_sales.php",
			data : "id="+x,
			success:function( data ){
				$('#unit_Add'+x).html( data );
			}
		});
		
	 var tr = $('#table >tbody >tr').length; 
    e.preventDefault();
        if(tr < max_fields){ //max input box allowed
            x++; //text box increment
			var newtr = '<tr id="'+x+'"><td>'+x+'</td><td><input id="sales_detail'+x+'" name="product_name[]" type="text" style="width:120px;"/></td><td><textarea name="discription[]" id="sales_detail'+x+'_desc" style="width:100px;"></textarea></td><td id="unit_Add'+x+'"></td><td><input type="text" id="sales_total'+x+'_quentity" name="quntity[]" style="width:70px;"/></td><td><input type="text" name="price[]" id="sales_total'+x+'" style="width:70px;"/></td><td><input type="text" name="total_price[]"  value="0" id="sales_total'+x+'_Toprice" style="width:70px;" readonly/></td><td><textarea name="remarks_detail[]" style="width:70px;"></textarea></td><td><a href="javascript:;" class="'+x+'" id="remove_field">Remove</a></td></tr>';
            $('#table tbody').append(newtr); //add input box
			$('#sales_detail'+x+'').autocomplete( autocomp_opt );
			$('#sales_total'+x+'').blur( Toprice );
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
		var minus = parseFloat($('#sales_total'+this.className+'_Toprice').val());
		var outtotal = parseFloat($('#allPrice').text());
		var out = outtotal - minus;
		$('#allPrice').html( out ).trigger("change");
		$('#t_price_without_tax_sales').val( out );
		$('#totalpricewith_tax_sales').val( out + parseFloat($('#freight').val()) );
		e.preventDefault(); $(this).closest('tr').remove();
    })
	
	var autocomp_opt={
		source: 'search/sales_detail.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#'+this.id+'_desc').val(ui.item.discription);
					$('#'+this.id+'_unit option').filter(function() { 
						return ($(this).text() == ui.item.unit); 
					}).prop('selected', true);
				}
	};
	
	function Toprice(){
		var que = parseFloat( $('#'+this.id+'_quentity').val() );
		var price = parseFloat( $(this).val() );
		if(price && que){
			$('#'+this.id+'_Toprice').val( que * price );
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
function totalPriceAll( ida ) {
		var out = 0;
		var av = 0;
		while(out < ida){
			out++;
			var total = parseFloat($('#sales_total'+out+'_Toprice').val());
			if(!total)
			{
				total = 0;
			}
			var av = av + total;
		}
		$('#allPrice').html( av ).trigger("change");
		$('#t_price_without_tax_sales').val( av );
		
		if(!$('#tax_select_sales').val())
		{
		$('#totalpricewith_tax_sales').val( av + parseFloat($('#freight').val())  );
		}
}

$('#allPrice').change(function(){
		var total_amo = parseFloat($('#allPrice').text()) + parseFloat($('#freight').val());
						var price_with_tax_sales = total_amo ;
						$('#totalpricewith_tax_sales').val( price_with_tax_sales );
});
		
$('#sales_detail').focus(function(){
		$( "#sales_detail" ).autocomplete({
			  source: 'search/sales_detail.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#product_desc_sales').val(ui.item.discription);
					$('#product_unit_sales option').filter(function() { 
						return ($(this).text() == ui.item.unit);	
					}).prop('selected', true);
				}
		});
	});

$('#sales_total1').blur( Toprice );
$('#sales_total1_quentity').blur( Toprice1 );
		function Toprice1(){
		var que = parseFloat( $('#'+this.id+'_quentity').val() );
		var price = parseFloat( $(this).val() );
		if(price && que){
			$('#'+this.id+'_Toprice').val( que * price );
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};

	$('#freight').blur(function(){
		var freight = parseFloat($(this).val());

			var total_amo = parseFloat($('#allPrice').text()) + parseFloat($('#freight').val());
			$('#totalpricewith_tax_sales').val( total_amo );
		
		
		
	});
	
});