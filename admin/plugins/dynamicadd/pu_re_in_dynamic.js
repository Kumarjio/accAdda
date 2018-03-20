$(function() {
    var max_fields      = 1000; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
   var id_e = "#purchase_total";
	
    var x = 1; //initlal text box count
    $(document).on('click', '#add_field_button',function(e){ //on add input button click
		$.ajax({
			method : "POST",
			url : "search/unit_search.php",
			data : "id="+x,
			success:function( data ){
				$('#unit_Add'+x).html( data );
			}
		});
		
	 var tr = $('#table >tbody >tr').length; 
    e.preventDefault();
        if(tr < max_fields){ //max input box allowed
            x++; //text box increment
			var newtr = '<tr id="'+x+'"><td>'+x+'</td><td><input id="purchase_detail'+x+'" name="product_name[]" type="text" style="width:120px;"/></td><td><textarea id="purchase_detail'+x+'_desc" name="discription[]" style="width:100px;"></textarea></td><td id="unit_Add'+x+'"></td><td><input type="text" name="quntity[]" id="purchase_total'+x+'_quentity" style="width:70px;"/></td><td><input name="price[]" type="text" id="purchase_total'+x+'" style="width:70px;"/></td><td><input type="text" value="0" name="total_price[]" id="purchase_total'+x+'_Toprice" style="width:70px;" readonly/></td><td><textarea name="remarks_detail[]" style="width:70px;"></textarea></td><td><a href="javascript:;" class="'+x+'" id="remove_field">Remove</a></td></tr>';
            $('#table tbody').append(newtr); //add input box
			$('#purchase_detail'+x+'').autocomplete( autocomp_opt );
			$('#purchase_total'+x+'').blur( Toprice );
		
			
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
		var minus = parseFloat($('#purchase_total'+this.className+'_Toprice').val());
		var outtotal = parseFloat($('#allPrice').text());
		var out = outtotal - minus;
		$('#allPrice').html( out ).trigger("change");
		$('#t_price_without_tax').val( out );
		$('#totalpricewith_tax').val( out + parseFloat($('#freight').val()) );
		e.preventDefault(); $(this).closest('tr').remove();
    })
	
	var autocomp_opt={
		source: 'search/purchase_detail.php',
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
			var total = parseFloat($('#purchase_total'+out+'_Toprice').val());
			if(!total)
			{
				total = 0;
			}
			var av = av + total;
		}
		$('#allPrice').html( av ).trigger("change");
		$('#t_price_without_tax').val( av );
		
		if(!$('#tax_select').val())
		{
			$('#totalpricewith_tax').val( av + parseFloat($('#freight').val()) );
		}
}

$('#allPrice').change(function(){
		var total_amo = parseFloat($('#allPrice').text()) + parseFloat($('#freight').val());
						var price_with_tax = total_amo ;
						$('#totalpricewith_tax').val( price_with_tax );
});
		
	$('#purchase_detail').focus(function(){
		$( "#purchase_detail" ).autocomplete({
			  source: 'search/purchase_detail.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#product_desc').val(ui.item.discription);
					$('#product_unit option').filter(function() { 
						return ($(this).text() == ui.item.unit);	
					}).prop('selected', true);
				}
		});
	});

	$('#purchase_total1').blur( Toprice );
	$('#purchase_total1_quentity').blur( Toprice1 );
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
			$('#totalpricewith_tax').val( total_amo );
		
		
		
	});
	
});