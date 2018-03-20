$(function() {
    var max1_fields      = 1000; 
    var wrapper         = $(".input_email_wrap");
	
    var x1 = 1; 
    $(document).on('click', '#add_email_button',function(e){ 
	 var tr = $('#table_email >tbody >tr').length; 
    e.preventDefault();
        if(tr < max1_fields){ //max1 input box1 allowed
			if( $('#em'+x1).val() != '' )
			{
			   x1++;
				var newtr = '<tr id="'+x1+'"><td>'+x1+'</td><td><input name="ver_email[]" class="form-control" id="em"'+x1+'" type="email" required/></td><td><a href="javascript:;" class="'+x1+'" id="remove_field">Remove</a></td></tr>';
				$(wrapper).append(newtr);
			}
			else
			{
				$("#pr_na").html('Please Email To Add Row');
				return false;
			}
		}
		
    });
	
	
    $(wrapper).on("click","#remove_field", function(e){ 
		e.preventDefault(); $(this).closest('tr').remove();
    })
	
	
});