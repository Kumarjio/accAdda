$(function () {
            $('#today').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			$("#today").datepicker("setDate", new Date());
			$('#product_chalan_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			$('#product_due_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			
			$('#today_ret').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			$("#today_ret").datepicker("setDate", new Date());
			
			$('#returnpurchase_due_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
			$('#returnpurchase_chalan_date').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy',
            });
});