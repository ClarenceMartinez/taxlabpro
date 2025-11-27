<script>
	jQuery(document).on('keydown blur change', '.input-433b-financial-payroll-service-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-financial-payroll-service");
	    let employer_id = row.find("input[name='payrollServiceProvider_id']").val();

	    update433b_financial_payrollservice($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur change', '.input-433b-financial-related-parties-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-financial-related-parties");
	    let employer_id = row.find("input[name='relatedPartiesOweBusines_id']").val();

	    update433b_financial_relatedParties($(this).attr('id'), value_attr, employer_id);

	})

	
	jQuery(document).on('click', '.input-433b-item-check-taxpayer-party-lawsuit',function(event){

		let row = $(this).closest(".item-lawsuit-financial");
	    updateInfoPartyLawsuit_otherFinancial(
	        $(this).attr('name'),
	        $(this).val(),

	        row.find("input[name='lawsuit_id']").val()
	    );

	})

	jQuery(document).on('keydown blur', '.input-433b-party-lawsuit-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-lawsuit-financial");
	    let employer_id = row.find("input[name='lawsuit_id']").val();

	    updateInfoPartyLawsuit_otherFinancial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-433b-tax-payer-lawsuit-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-tax-payer-lawsuit");
	    let employer_id = row.find("input[name='taxpayerLawsuitsIrs_id']").val();

	    update433b_financial_taxpayer_lawsuit($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-433b-taxpayer-bankruptcy-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-taxpayer-bankruptcy");
	    let employer_id = row.find("input[name='bankruptcy_id']").val();

	    update433bInfoTaxPayer_bankruptcy_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-433b-business-asset-transfer',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-business-asset-transfer");
	    let employer_id = row.find("input[name='businessAssetTransfer_id']").val();

	    update433bInfo_businessAssetTransferer($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur change', '.input-433b-real-state-transfer-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-financial-transfer");
	    let employer_id = row.find("input[name='realEstateTransfer_id']").val();

	    updateInfoRealStateTransferer_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})


	jQuery(document).on('keydown blur change', '.input-433b-income-change-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-incomechange");
	    let employer_id = row.find("input[name='incomeChanges_id']").val();

	    update433binfo_incomechange($(this).attr('id'), value_attr, employer_id);

	})


	jQuery(document).on('keydown blur change', '.input-433b-financial-safe',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-financial-safe");
	    let employer_id = row.find("input[name='safe_id']").val();

	    update433binfo_financialsafe($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur change', '.input-433b-trustfund-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-trust-fund");
	    let employer_id = row.find("input[name='trustFunds_id']").val();

	    update433binfo_financialTrust($(this).attr('id'), value_attr, employer_id);

	})

	function update433b_financial_payrollservice(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('payrollService.update', ':id')}}".replace(':id', id), 
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

	function update433b_financial_relatedParties(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('relatedPartyOwe.update', ':id')}}".replace(':id', id), 
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



	function updateInfoPartyLawsuit_otherFinancial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('lawsuit.update', ':id')}}".replace(':id', id), 
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


	function update433b_financial_taxpayer_lawsuit(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('taxpayerLawsuit.update', ':id')}}".replace(':id', id), 
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


	function update433bInfoTaxPayer_bankruptcy_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('bankruptcies.update', ':id')}}".replace(':id', id), 
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


	function update433bInfo_businessAssetTransferer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('businessAssetTransfer.update', ':id')}}".replace(':id', id), 
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

	function updateInfoRealStateTransferer_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('realStateTransfers.update', ':id')}}".replace(':id', id), 
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

	function update433binfo_incomechange(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('incomeChange.update', ':id')}}".replace(':id', id), 
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

	function update433binfo_financialsafe(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('safe.update', ':id')}}".replace(':id', id), 
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

	function update433binfo_financialTrust(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('trustFund.update', ':id')}}".replace(':id', id), 
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