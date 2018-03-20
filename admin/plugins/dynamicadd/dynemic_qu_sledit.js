$(document).ready(function() {
    var max_fields      = 1000; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_sales"); //Fields wrapper
    var add_button      = $("#add_field_button_sales"); //Add button ID
    var id_e = "#sales_total";
	
    var x = $('#table tbody>tr:last').attr('id');; //initlal text box count
    $(document).on('click', '#add_field_button_sales',function(e){ //on add input button click
		
		
	 var tr = $('#table >tbody >tr').length; 
    e.preventDefault();
        if(tr < max_fields){ 
            if( $('#sales_total'+x+'_quentity').val() != '' &&  $('#sales_total'+x+'').val() != '' )
			{
				if( $('#sales_total'+x+'_quentity').val() != '0' &&  $('#sales_total'+x+'').val() != '0' )
				{
					$("#pr_name").html('');
					$.ajax({
			method : "POST",
			url : "search/unit_serach_sales.php",
			data : "id="+x,
			success:function( data ){
				$('#unit_Add'+x).html( data );
			}
		});
			
			x++;
			var newtr = '<tr id="'+x+'"><td>'+x+'<input type="hidden" name="sr_no_product[]" /></td><td><input type="hidden" id="sales_detail'+x+'_grate" /><input type="hidden" name="id[]" id="sales_detail'+x+'_id" /><input id="sales_detail'+x+'" class="'+x+'d" name="product_name[]" type="text" style="width:120px;" required /></td><td><input type="text" id="sales_detail'+x+'_hsn" name="hsn[]" style="width:100px;" readonly/></td><td><textarea name="discription[]" id="sales_detail'+x+'_desc" style="width:100px;"></textarea></td><td><input type="text" style="width:70px;" name="gst_rate[]" id="sales_detail'+x+'_rate" readonly/></td><td id="unit_Add'+x+'"></td><td><input type="number" min="0" id="sales_total'+x+'_quentity" name="quntity[]" class="'+x+'" style="width:80px;" required/></td><td><input type="number" min="0" name="price[]" id="sales_total'+x+'" style="width:70px;" required/></td><td><input type="text" name="total_price[]"  value="0" id="sales_total'+x+'_Toprice" style="width:70px;" readonly/></td><td><input type="text" style="width:70px;" value="0" name="" id="sales_total'+x+'cgst" readonly/></td><td><input type="text" style="width:70px;" value="0" name="" id="sales_total'+x+'sgst" readonly/></td><td><input type="text" style="width:70px;" value="0" name="" id="sales_total'+x+'igst" readonly/></td><td><textarea name="remarks_detail[]" style="width:70px;"></textarea></td><td><a href="javascript:;" class="'+x+'" id="remove_field">Remove</a></td></tr>';
            $('.input_fields_wrap_sales').append(newtr);
			
			}
				else
				{
					$("#pr_name").html('Please Fill All Fields');
					return false;
				}
			}
			else
			{
				$("#pr_name").html('Please Fill All Fields');
				return false;
			}
			
			
			$('#sales_detail'+x+'').autocomplete( autocomp_opt );
			$('#sales_total'+x+'').keyup( Toprice );
			$('#sales_total'+x+'_quentity').keyup( Toprice1 );
			$('#sales_total'+x+'_quentity').focus( check );
			$('#sales_total'+x).focus( function(){
				if( $('.'+x+'d').val() == '' )
				{
					$("#qty_nm").html('Please Select Product Name');
				}
				else
				{
					$("#qty_nm").html('');
				}
			});
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
		var minus = parseFloat($('#sales_total'+this.className+'_Toprice').val());
		var grate = parseFloat( $('#sales_detail'+this.className+'_grate').val() );
		var tax = minus * grate / 100;
		tax = minus + tax;
		var outtotal = parseFloat($('#allPrice').text());
		var out = outtotal - minus;
		$('#allPrice').html( out ).trigger("change");
		if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' ){ tac = minus * grate / 100 / 2; cgst =  $('#cgstPrice').text(); $('#cgstPrice').html( cgst - tac ); $('#sgstPrice').html( cgst - tac ); }
		 if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' ){ tac = minus * grate / 100; cgst =  $('#igstPrice').text(); $('#igstPrice').html( cgst - tac ); }
		$('#t_price_without_tax_sales').val( out );
		var totalPriceAll = $('#totalpricewith_tax_sales').val();
		$('#totalpricewith_tax_sales').val( totalPriceAll - tax );
		e.preventDefault(); $(this).closest('tr').remove();
    })
	
	var autocomp_opt={
		source: 'search/sales_detail.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#'+this.id+'_desc').val(ui.item.discription);
					$('#'+this.id+'_rate').val(ui.item.gst+" %");
					$('#'+this.id+'_id').val(ui.item.id);
					$('#'+this.id+'_grate').val(ui.item.gst);
					$('#'+this.id+'_hsn').val(ui.item.hsn);
					$('#'+this.id+'_unit option').filter(function() { 
						return ($(this).text() == ui.item.unit); 
					}).prop('selected', true);
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}
	};
	
	function Toprice(){
		var que = parseFloat( $('#'+this.id+'_quentity').val() );
		var price = parseFloat( $(this).val() );
		if(price && que){
			$('#'+this.id+'_Toprice').val( que * price );
			var asdf = parseFloat($('#'+this.id.replace('sales_total','sales_detail')+'_grate').val());
			if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#'+this.id+'cgst').val( que * price * asdf / 100 / 2 );
				$('#'+this.id+'sgst').val( que * price * asdf / 100 / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#'+this.id+'igst').val( que * price * asdf / 100  );
			}
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
	function Toprice1(){
		var que = parseFloat( $('#sales_total'+this.className).val() );
		var price = parseFloat( $(this).val() );
		if(price && que){
			$('#sales_total'+this.className+'_Toprice').val( que * price );
			var asdf = parseFloat($('#sales_detail'+this.className+'_grate').val());
			if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#sales_total'+this.className+'cgst').val( que * price * asdf / 100 / 2 );
				$('#sales_total'+this.className+'sgst').val( que * price * asdf / 100 / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#sales_total'+this.className+'igst').val( que * price * asdf / 100  );
			}
			var ida = $('#table tbody>tr:last').attr('id');
			totalPriceAll( ida );
		}
	};
	
function totalPriceAll( ida ) {
		var out = 0;
		var av = 0;
		var totaltax = 0;
		while(out < ida){
			out++;
			var id = parseFloat($('#sales_detail'+out+'_grate').val());
			var total = parseFloat($('#sales_total'+out+'_Toprice').val());
			if(!total)
			{
				total = 0;
			}
			var av = av + total;
			if(total != 0)
			{
			totaltax += total * id / 100; 
			}
		}
		$('#allPrice').html( av ).trigger("change");
		$('#t_price_without_tax_sales').val( av );
		$('#totalpricewith_tax_sales').val( av + totaltax  );
		if( $('#tax_type').val() == '2' || $('#tax_type').val() == '1' )
			{
				$('#cgstPrice').html( parseFloat(totaltax) / 2 );
				$('#sgstPrice').html( parseFloat(totaltax) / 2 );
			}
			else if( $('#tax_type').val() == '3' || $('#tax_type').val() == '4' )
			{
				$('#igstPrice').html( parseFloat(totaltax) );
			}
		
		
}
		
function check()
	{
		if( $('.'+this.className+'d').val() == '' )
		{
			$("#qty_nm").html('Please Select Product Name');
		}
		else
		{
			$("#qty_nm").html('');
		}
	}
		
	
});