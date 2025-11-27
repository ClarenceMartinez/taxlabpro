<script>
	jQuery(document).on('keydown blur change', '.input-433b-income-expense-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-income-expense");
	    let employer_id = row.find("input[name='income_expense_id']").val();

	    update433b_income_expense($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('change', '.input-433b-income-expense-check',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-income-expense");
	    let employer_id = row.find("input[name='income_expense_id']").val();

	    update433b_income_expense($(this).attr('id'), value_attr, employer_id);

	})



	function update433b_income_expense(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('monthlyFinancial.update', ':id')}}".replace(':id', id), 
	            type: 'put',
	            data: {name:id_attr, value : value_attr},
	            success: function (r) {
	            	toast_msg(r.msg, r.type, r.title);
	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
	}

</script>