$(function() {
    var max_fields      = 20;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $("#add_field_button"); 
    var x = 1;
    $(document).on('click', '#add_field_button',function(e){
		
	 var tr = $('table >tbody >tr').length; 
    e.preventDefault();
        if(tr < max_fields){
			if( $('#type'+x).val() == 'By')
			{
				
				if( $('#particular'+x).val() != '' )
				{
					if( $('#type'+x+'debit').val() != '' )
					{
						x++;
						var newtr = '<tr id="'+x+'"><td>'+x+'</td><td><select id="type'+x+'" name="type[]" style="width:50px;"><option value="By">By</option><option value="Cr">Cr</option></select></td><td><input type="text" id="particular'+x+'" name="particular[]" style="width:200px;"/><input type="hidden" id="particular'+x+'h" name="hiddenId[]" /></td><td><input type="text" id="type'+x+'debit" name="debit[]" style="width:120px;"/></td><td><input type="text" id="type'+x+'credit" name="credit[]" style="width:120px; display:none;"/></td><td><a href="javascript:;" class="'+x+'" id="remove_field">Remove</a></td></tr>';
						$('table tbody').append(newtr);
					}
					else
					{
						$("#pr_name").html('Please Fill Debit Or Credit Amount To Add New Row');
						return false;
					}
					
				}
				else
				{
					$("#pr_name").html('Please Fill Particular Fields To Add New Row');
					return false;
				}
			}
			else if( $('#type'+x).val() == 'Cr')
			{
				if( $('#particular'+x).val() != '' )
				{
					if( $('#type'+x+'credit').val() != '' )
					{
						x++;
						var newtr = '<tr id="'+x+'"><td>'+x+'</td><td><select id="type'+x+'" name="type[]" style="width:50px;"><option value="By">By</option><option value="Cr">Cr</option></select></td><td><input type="text" id="particular'+x+'" name="particular[]" style="width:200px;"/><input type="hidden" id="particular'+x+'h" name="hiddenId[]" /></td><td><input type="text" id="type'+x+'debit" name="debit[]" style="width:120px;"/></td><td><input type="text" id="type'+x+'credit" name="credit[]" style="width:120px; display:none;"/></td><td><a href="javascript:;" class="'+x+'" id="remove_field">Remove</a></td></tr>';
						$('table tbody').append(newtr);
					}
					else
					{
						$("#pr_name").html('Please Fill Debit Or Credit Amount To Add New Row');
						return false;
					}
				}
				else
				{
					$("#pr_name").html('Please Fill Particular Fields To Add New Row');
					return false;
				}
			}
			
				$('#type'+x).change( credit );
				$('#particular'+x).autocomplete( autocomp_opt );
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){
		e.preventDefault(); $(this).closest('tr').remove();
    })
	function credit(){
		if($(this).val() == 'By')
			{
			$('#'+this.id+'credit').fadeOut();
			$('#'+this.id+'credit').val('');
			$('#'+this.id+'debit').show();
			}
			else
			{
			$('#'+this.id+'debit').fadeOut();
			$('#'+this.id+'debit').val('');
			$('#'+this.id+'credit').show();
			}
	}
	
	var autocomp_opt={
		source: 'search/auto_jurnal_custom.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#'+this.id+'h').val(ui.item.client_id);
				},
				change: function( event, ui ) {
					if(ui.item==null)
					{
						this.value='';
					}
				}
	};
	
});