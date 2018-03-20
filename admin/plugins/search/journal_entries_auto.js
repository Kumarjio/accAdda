$( function() {
	$('#acc_name_journal_report').focus(function(){
		$( "#acc_name_journal_report" ).autocomplete({
			  source: 'search/journal_entry_s.php',
				select:function(e, ui){
					e.preventDefault();
					$(this).val(ui.item.label);
					$('#journal_report_hidden_client_id').val(ui.item.client_id);
				}
		});
	})
  });