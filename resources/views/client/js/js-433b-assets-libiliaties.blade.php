<script>
	jQuery(document).on('keydown blur change', '.input-433b-bank-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-bank-account");
	    let employer_id = row.find("input[name='bankAccount_id']").val();

	    update433bAsset_bankAccount($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur', '.input-433b-receivable-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-receivable");
	    let employer_id = row.find("input[name='receivable_id']").val();

	    update433bAsset_receivable($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('change', '.input-433b-receivable-check',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-receivable");
	    let employer_id = row.find("input[name='receivable_id']").val();

	    update433bAsset_receivable($(this).attr('name'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-investment-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-investment-account");
	    let employer_id = row.find("input[name='investmentAccount_id']").val();
	    

	    update433bAsset_investment_account($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('change', '.input-433b-investment-account-check',function(event){

		let value_attr = $(this).is(':checked') ? 1 : 0;
	    let row = $(this).closest(".item-433b-investment-account");
	    let employer_id = row.find("input[name='investmentAccount_id']").val();

	    update433bAsset_investment_account($(this).attr('id'), value_attr, employer_id);

	});


	jQuery(document).on('keydown blur change', '.input-433b-asset-credit-line-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-credit-line");
	    let employer_id = row.find("input[name='creditLine_id']").val();
	    

	    update433bAsset_creditLine($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-properties-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-properties");
	    let employer_id = row.find("input[name='property_id']").val();
	    

	    update433bAsset_propertyReal($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-propertysale-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let employer_id = $("#propertysale_id").val();
	    

	    update433bAsset_propertySale($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-foreignproperty-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let employer_id = $("#foreignProperty_id").val();	    

	    update433bAsset_foreignproperty($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-vehicles-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-vehicles");
	    let employer_id = row.find("input[name='vehicle_id']").val();

	    update433bAsset_vehicles($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-companytool-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-companytool");
	    let employer_id = row.find("input[name='companyToolEquipment_id']").val();

	    update433bAsset_companyTool($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-intangible-asset-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-intangible-asset");
	    let employer_id = row.find("input[name='intangibleAsset_id']").val();

	    update433bAsset_intangibleAsset($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('keydown blur change', '.input-433b-asset-businessLiabilities-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-businessLiabilities");
	    let employer_id = row.find("input[name='businessLiabilities_id']").val();

	    update433bAsset_businessLiabilities($(this).attr('id'), value_attr, employer_id);

	});

	jQuery(document).on('change', '.input-433b-asset-businessLiabilities-check',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433b-asset-businessLiabilities");
	    let employer_id = row.find("input[name='businessLiabilities_id']").val();

	    update433bAsset_businessLiabilities($(this).attr('id'), value_attr, employer_id);

	});


	function update433bAsset_bankAccount(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('bankAccounts.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_receivable(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('receivable.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_investment_account(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('investmentAccounts.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_creditLine(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('creditLine.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_propertyReal(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('property.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_propertySale(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('propertySale.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_foreignproperty(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('foreignProperty.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_vehicles(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('vehicles.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_companyTool(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('companyToolEquipment.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_intangibleAsset(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('intangibleAsset.update', ':id')}}".replace(':id', id), 
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

	function update433bAsset_businessLiabilities(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('businessLiability.update', ':id')}}".replace(':id', id), 
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