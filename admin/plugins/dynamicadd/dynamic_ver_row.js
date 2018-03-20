$(function() {
    var maz1_fields      = 1000; 
    var wrapper         = $(".input_email_row");
	
    var z1 = 1; 
    $(document).on('click', '#add_verification_button',function(e){ 
	 var tr = $('#table >tbody >tr').length; 
    e.preventDefault();
        if(tr < maz1_fields){ 
		if( $('#ver_date'+z1).val() != '' )
		{
			if( $('#ver_product_name'+z1).val() != '' )
			{
				if( $('#ver_product_name'+z1+'_desc').val() != '' )
				{
					if( $('#ver_quen'+z1).val() != '' )
					{
						$("#pr_name").html('');
						z1++; 
						var newtr = '<tr id="'+z1+'"><td>'+z1+'</td><td><input type="text" id="ver_date'+z1+'" name="ver_date[]" style="width:120px;" required/></td><td><input type="text" id="ver_product_name'+z1+'" name="ver_product_name[]" style="width:120px;" required/></td><td><textarea style="width:100px;" name="ver_discription[]" id="ver_product_name'+z1+'_desc" required></textarea></td><td><select name="ver_side[]" style="width:100px;"><option value="0">Select Side</option><option value="L.H.S">L.H.S</option><option value="R.H.S">R.H.S</option><option value="Center">Center</option></select></td><td><input type="text" style="width:100px;" name="ver_change[]" id="ver_change"/></td><td><input type="text" style="width:100px;" name="ver_remark[]" id="ver_quen'+z1+'" required/></td><td><textarea style="width:120px;" name="remarks_detail[]"></textarea></td><td><a href="javascript:;" class="'+z1+'" id="remove_field">Remove</a></td></tr>';
						$(wrapper).append(newtr);
					}
					else
					{
						$("#pr_name").html('Please Fill All Fields To Add Row');
						return false;
					}
				}
				else
				{
					$("#pr_name").html('Please Fill All Fields To Add Row');
					return false;
				}
			}
			else
			{
				$("#pr_name").html('Please Fill All Fields To Add Row');
				return false;
			}
		}
		else
		{
			$("#pr_name").html('Please Fill All Fields To Add Row');
			return false;
		}
			$('#ver_date'+z1).datepicker( date );
			$('#ver_product_name'+z1+'').autocomplete( autocomp_opt );
			$('#ver_quen'+z1).keyup( toprice );
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove tez1t
		var minus = parseFloat($('#ver_quen'+this.className).val());
		var outtotal = parseFloat($('#allPrice').text());
		var out = outtotal - minus;
		$('#allPrice').html( out );
		$('#all_price').val( out );
		e.preventDefault(); $(this).closest('tr').remove();
    })
	
	var date = {
				autoclose: true,
				format: 'dd/mm/yyyy',
            };
			
	var autocomp_opt={
		source: 'search/purchase_ver_detail.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#'+this.id+'_desc').val(ui.item.discription);
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}		
	};		
	
	
	function toprice (){
		var ida = $('#table tbody>tr:last').attr('id');
		var out = 0;
		var av = 0;
		while(out < ida){
			out++;
			if($('#ver_quen'+out).val()){
			var total = parseFloat($('#ver_quen'+out).val());
			av = av + total;
			}
		}
		$('#allPrice').html( av );
		$('#all_price').val( av );
	};
			
			$('#ver_quen1').keyup( toprice );
			$('#ver_product_name').autocomplete( autocomp_opt );
			$('#ver_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
});