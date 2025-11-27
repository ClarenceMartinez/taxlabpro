<script>

	function getPeriods(classx)
	{
		return new Promise((resolve, reject) => {
	        $.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{ route('utils.payperiods') }}",
	            type: "GET",
	            success: function (response) {
	            	if (response.total > 0)
	            	{
	            		let html = populateComboBox(response.LIST, classx); // Generar HTML del select
                    				resolve(html);
	            	}
	            },
	            error: function () {
	                reject("Error al obtener los períodos de pago");
	            }
	        });
	    });
	}
	
	function populateComboBox(periods, classx) {
	    var html = `<select class="form-control form-control-sm `+classx+` select2 form-select" id="pay_period">`;
	    	html += `<option value="0">Select</option>`;

		    periods.forEach(period => {
		        html += `<option value="${period.id}">${period.name}</option>`;
		    });


	    	html += '</select>';
	    	html += '<label for="pay_period">Pay period</label>';

	    return html;
	}

	function getTypeAccount(classx, idx)
	{
		return new Promise((resolve, reject) => {
	        $.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{ route('utils.bankAccountType') }}",
	            type: "GET",
	            success: function (response) {
	            	if (response.total > 0)
	            	{
	            		let html = typeAccountComboBox(response.LIST, classx, idx); // Generar HTML del select
                    				resolve(html);
	            	}
	            },
	            error: function () {
	                reject("Error al obtener los períodos de pago");
	            }
	        });
	    });
	}

	function typeAccountComboBox(periods, classx, idx) {

		var _id = (idx == "") ? 'type_of_account' : idx;
	    // var html = `<select class="form-control form-control-sm `+classx+` select2 form-select" id="pay_period">`;
	    var classxt = (classx  == "") ? 'input-bank-account-blur' :classx; 
	    var html = `<select class="form-control form-control-sm select2 form-select `+classx+` " id="`+_id+`">`;
	    	html += `<option value="0">Select</option>`;

		    periods.forEach(period => {
		        html += `<option value="${period.id}">${period.name}</option>`;
		    });


	    	html += '</select>';
	    	html += '<label for="'+_id+'">Type of Account</label>';
	    	// console.log(html);
	    return html;
	}

	function getTypeBusiness(classx, idx)
	{
		return new Promise((resolve, reject) => {
	        $.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{ route('utils.businessType') }}",
	            type: "GET",
	            success: function (response) {
	            	if (response.total > 0)
	            	{
	            		let html = typeBusinessComboBox(response.LIST, classx, idx); // Generar HTML del select
                    				resolve(html);
	            	}
	            },
	            error: function () {
	                reject("Error al obtener los períodos de pago");
	            }
	        });
	    });
	}

	function typeBusinessComboBox(periods, classx, idx) {

		var _id = (idx == "") ? 'type_of_business' : idx;
	    // var html = `<select class="form-control form-control-sm `+classx+` select2 form-select" id="pay_period">`;
	    var html = `<select class="form-control form-control-sm select2 form-select input-bank-account-blur `+classx+` " id="`+_id+`">`;
	    	html += `<option value="0">Select</option>`;

		    periods.forEach(period => {
		        html += `<option value="${period.id}">${period.name}</option>`;
		    });


	    	html += '</select>';
	    	html += '<label for="'+_id+'">Type of Business</label>';

	    return html;
	}

	$(".date-simple").flatpickr({
		dateFormat: "Y-d-m",
	});
	$(".select2").select2({
        placeholder: 'Select value',
      });


	

	jQuery(document).on('change', '.input-check-other-member',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-other-member");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-employed',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-employed");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-individual-spouse-employed',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-individual-spouse-employed");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})
	
	jQuery(document).on('change', '.input-check-other-bussiness',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-other-bussiness");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	/*clarence*/

	jQuery(document).on('change', '.input-check-taxpayer-party-lawsuit',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-party-lawsuit");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-party-lawsuit-involving',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-party-lawsuit-involving");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-currently-bankruptcy',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-spouse-bankruptcy");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-ever-field',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-ever-field");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-beneficiary-trust',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-trust");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-have-any-founds',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-have-any-founds");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-a-truste',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-a-truste");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-have-safe-deposit',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-have-safe-deposit");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-taxpayer-lived-outside',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-lived-outside");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})


	jQuery(document).on('change', '.input-check-property-outside',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-taxpayer-property-outside");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})
	
	jQuery(document).on('change', '.input-check-retirement-account',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-retirement-account");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-available-credit',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-question-available-credit");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-life-insurance',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-life-insurance");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})


	jQuery(document).on('change', '.input-check-then-year-have-any',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-then-year-have-any");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-personal-bank-account',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-personal-bank-account");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	
	jQuery(document).on('change', '.input-check-investment-account',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-investment-account");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-digital-assets',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-digital-assets");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	jQuery(document).on('change', '.input-check-three-year-any-property',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));

    	var content = $("#content-three-year-any-property");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	
	jQuery(document).on('change', '.input-check-own-any-real-property',function(e){
    	e.preventDefault();
    	var _this = $(this);
    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));
    	var content = $("#content-own-any-real-property");
    	if (_this.val() == 'yes')
    	{
    		content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		content.addClass('d-none');
	})

	
	jQuery(document).on('change', '.input-check-toogle',function(e){
    	e.preventDefault();
    	var _this = $(this);

    	updateConditionQuestionByClient(_this.val(), _this.attr('name'));
    	if (_this.val() == 'yes')
    	{
    		_this.parent().parent().next().removeClass('d-none').slideDown('slow');
    		// content.removeClass('d-none').slideDown('slow');
    		return;
    	}
    		_this.parent().parent().next().addClass('d-none');
	})

	jQuery(document).on('keydown', '.autocomplete-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-dependent");        
        var dependentId = row.find("input[name='dependent_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);




		if ($.trim(value_attr) != ""  && event.which == 13)
		{
				
			updateInfoClient(id_attr, value_attr, dependentId);
		}

	})

	jQuery(document).on('blur', '.autocomplete-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-dependent");        
        var dependentId = row.find("input[name='dependent_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updateInfoClient(id_attr, value_attr, dependentId);
		}

	})

	jQuery(document).on('click', '.check-dependent-claimed',function(event){

		let itemDependent 	= $(this).closest(".item-dependent");
		let id_attr 		= 'claimed_as_dependent';
		let value_attr 		= $(this).val();

        // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        let dependentId = itemDependent.find("input[name='dependent_id']").val();

        updateInfoClient(id_attr, value_attr, dependentId);

	})

	jQuery(document).on('click', '.check-dependent-income',function(event){

		let itemDependent 	= $(this).closest(".item-dependent");
		let id_attr 		= 'contributes_income';
		let value_attr 		= $(this).val();

        // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        let dependentId = itemDependent.find("input[name='dependent_id']").val();

        updateInfoClient(id_attr, value_attr, dependentId);

	})

	function updateInfoClient(id_attr, value_attr,id)
	{
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('dependents.update', ':id')}}".replace(':id', id), 
	            type: 'put',
	            data: {name:id_attr, value : value_attr},
	            success: function (r) {
	            	// toast_msg(r.msg, r.type, r.title);
	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
	}

	jQuery(document).on('click', '#add-more-dependent',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('dependents.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{
					var content = $("#content-other-member").find('.card');
					var dependentBlock = `
									<div class="row item-dependent dependent-block">
										<input type="hidden" name="dependent_id" class="dependent_id" value="`+response.data.id+`">
										<div class="col-md-4">
											<div class="form-floating form-floating-outline">
												<input type="text" class="form-control form-control-sm autocomplete-blur dependent-input" id="name"  data-field="name" placeholder=""/>
												<label>Name</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-floating form-floating-outline">
												<input type="text" class="form-control form-control-sm autocomplete-blur dependent-input"  id="age" data-field="age" placeholder=""/>
												<label>Age</label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-floating form-floating-outline">
												<input type="text" class="form-control form-control-sm autocomplete-blur dependent-input" id="relationship" data-field="relationship" placeholder=""/>
												<label>Relationship</label>
											</div>
										</div>
										<div class="col-md-10 mt-2">
											<div class="row">
												<label class="col-sm-7 form-check-label">Claimed as dependent on Form 1040?</label>
												<div class="col mt-2 col-sm-5">
													<div class="form-check form-check-inline">
														<input class="form-check-input dependent-radio check-dependent-claimed" type="radio" data-field="claimed_as_dependent`+response.data.id+`" name="claimed_as_dependent`+response.data.id+`" value="0" checked>
														<label class="form-check-label">No</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input dependent-radio check-dependent-claimed" type="radio" data-field="claimed_as_dependent`+response.data.id+`" name="claimed_as_dependent`+response.data.id+`" value="1">
														<label class="form-check-label">Yes</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-10">
											<div class="row">
												<label class="col-sm-7 form-check-label">Contributes to household income?</label>
												<div class="col mt-2 col-sm-5">
													<div class="form-check form-check-inline">
														<input class="form-check-input dependent-radio check-dependent-income" type="radio" data-field="contributes_income`+response.data.id+`" name="contributes_income`+response.data.id+`" value="0" checked>
														<label class="form-check-label">No</label>
													</div>
													<div class="form-check form-check-inline">
														<input class="form-check-input dependent-radio check-dependent-income" type="radio" data-field="contributes_income`+response.data.id+`" name="contributes_income`+response.data.id+`" value="1">
														<label class="form-check-label">Yes</label>
													</div>
												</div>
											</div>
										</div>
									</div>`;

					content.append(dependentBlock);
				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
		
	})

	jQuery(document).on('click', '#add-more-employer',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('employments.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{	
					var content = $("#content-taxpayer-employed").find('.card');
					var dependentBlock = `
									<div class="row item-employed mt-3 border-top border-2 pt-5">
			                            <input type="hidden" name="employer_id" id="employer_id" value="`+response.data.id+`">
			                            <div class="col-md-6">
			                              <div class="row">
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="employer" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="employer">Employer</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="street" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="street">Street</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="city" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="city">City</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="state" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="state">State</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="zip_code" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="zip_code">ZIP Code</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="work_phone" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="work_phone">Work Phone</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-8 mt-2">
			                                  <div class="mb-4">
			                                    <label class="form-check m-0">
			                                      <input type="checkbox" class="form-check-input check-employer" id="contact_at_work_allowed" value="1">
			                                      <span class="form-check-label">Contact at work allowed</span>
			                                    </label>
			                                  </div>
			                                </div>
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-blur" id="occupation" placeholder="" />
			                                    <label for="occupation">Occupation</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-blur" id="employer_year" placeholder="" />
			                                    <label for="employer_year">Employed Years</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-blur" id="employer_month" placeholder="" />
			                                    <label for="employer_month">Employed Month</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <select class="form-control form-control-sm employer-blur select2 form-select" id="business_interest">
			                                      <option>1</option>
			                                      <option>2</option>
			                                      <option>3</option>
			                                    </select>
			                                    <label for="business_interest">Bussiness Interest</label>
			                                  </div>
			                                </div>
			                              </div>
			                            </div>
			                            <div class="col-md-6">
			                              <div class="row">
			                                <div class="col-md-6 mt-2">
			                                  <div class="form-floating form-floating-outline pay_period_`+response.data.id+`">
			                                  <select name="" id="" class="form-control form-control-sm employer-blur select2 form-select">
			                                  	<option value=""></option>
			                                  </select>
			                                  <label for="gross_wage">Pay period</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-6 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="gross_wage" class="form-control form-control-sm employer-blur" placeholder="" />
			                                    <label for="gross_wage">Gross Wage</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="federal_tax" class="form-control form-control-sm employer-blur" placeholder="" value="">
			                                    <label for="federal_tax">Federal Tax</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="state_tax" class="form-control form-control-sm employer-blur" placeholder="" value="">
			                                    <label for="state_tax">State Tax</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="local_tax" class="form-control form-control-sm employer-blur" placeholder="" value="">
			                                    <label for="local_tax">Local Tax</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <textarea name="" id="" class="form-control h-px-100"></textarea>
			                                    <label for="multicol-username">Pay Stub Item</label>
			                                  </div>

			                                  <div class="col-md-12 mt-3">
			                                    <a href="javascript:;"><i class="ri-add-circle-fill"></i> Add item</a>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="does_claimed_form" class="form-control form-control-sm employer-blur" placeholder=""  />
			                                    <label for="does_claimed_form">Exemptions (Number of withholding claimed on Form W-4)</label>
			                                  </div>
			                                </div>

			                                <div class="mb-4">
			                                  <label class="form-check m-0">
			                                    <input type="checkbox" class="form-check-input check-employer" id="does_not_withhold_social_security" value="1">
			                                    <span class="form-check-label">Does not withhold Social Security</span>
			                                  </label>
			                                </div>

			                                <div class="mb-4">
			                                  <label class="form-check m-0">
			                                    <input type="checkbox" class="form-check-input check-employer" id="does_not_withhold_medicare" value="1">
			                                    <span class="form-check-label">Does not withhold Medicare</span>
			                                  </label>
			                                </div>
			                              </div>
			                            </div>
			                          </div>`;

					content.append(dependentBlock);
					getPeriods('employer-blur')
				        .then(html => {
				            content.find("."+'pay_period_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });


				        
				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
	})
	
	jQuery(document).on('click', '#add-more-spouse-employer',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('employments_spouse.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{

					
					// getPeriods =  getPeriods();
					// console.log(getPeriods);



					var content = $("#content-individual-spouse-employed").find('.card');
					var dependentBlock = `
									<div class="row item-employed-spouse mt-3 border-top border-2 pt-5">

			                            <input type="hidden" name="employer_spouse_id" id="employer_spouse_id" value="`+response.data.id+`">
			                            <div class="col-md-6">
			                              <div class="row">
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="employer" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="employer">Employer</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="street" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="street">Street</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="city" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="city">City</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="state" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="state">State</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="zip_code" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="zip_code">ZIP Code</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="work_phone" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="work_phone">Work Phone</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-8 mt-2">
			                                  <div class="mb-4">
			                                    <label class="form-check m-0">
			                                      <input type="checkbox" class="form-check-input check-employer-spouse" id="contact_at_work_allowed" value="1">
			                                      <span class="form-check-label">Contact at work allowed</span>
			                                    </label>
			                                  </div>
			                                </div>
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="occupation" placeholder="" />
			                                    <label for="occupation">Occupation</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="employer_year" placeholder="" />
			                                    <label for="employer_year">Employed Years</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="employer_month" placeholder="" />
			                                    <label for="employer_month">Employed Month</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <select class="form-control form-control-sm employer-spouse-blur select2 form-select" id="business_interest">
			                                      <option>1</option>
			                                      <option>2</option>
			                                      <option>3</option>
			                                    </select>
			                                    <label for="business_interest">Bussiness Interest</label>
			                                  </div>
			                                </div>
			                              </div>
			                            </div>
			                            <div class="col-md-6">
			                              <div class="row">
			                                <div class="col-md-6 mt-2">
			                                  <div class="form-floating form-floating-outline pay_period_`+response.data.id+`"">
			                                    <select class="form-control form-control-sm employer-spouse-blur select2 form-select" id="pay_period">
			                                      <option>1</option>
			                                    </select>
			                                    <label for="pay_period">Pay period</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-6 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="gross_wage" class="form-control form-control-sm employer-spouse-blur" placeholder="" />
			                                    <label for="gross_wage">Gross Wage</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                  	<input type="tex" name="federal_tax" id="federal_tax" class="form-control form-control-sm employer-spouse-blur" />
			                                    <label for="federal_tax">Federal Tax</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="tex" name="state_tax" id="state_tax" class="form-control form-control-sm employer-spouse-blur" />
			                                    <label for="state_tax">State Tax</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-4 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="tex" name="local_tax" id="local_tax" class="form-control form-control-sm employer-spouse-blur" />
			                                    <label for="local_tax">Local Tax</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <textarea name="" id="" class="form-control h-px-100"></textarea>
			                                    <label for="multicol-username">Pay Stub Item</label>
			                                  </div>

			                                  <div class="col-md-12 mt-3">
			                                    <a href="javascript:;"><i class="ri-add-circle-fill"></i> Add item</a>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="does_claimed_form" class="form-control form-control-sm employer-spouse-blur" placeholder=""  />
			                                    <label for="does_claimed_form">Exemptions (Number of withholding claimed on Form W-4)</label>
			                                  </div>
			                                </div>

			                                <div class="mb-4">
			                                  <label class="form-check m-0">
			                                    <input type="checkbox" class="form-check-input check-employer-spouse" id="does_not_withhold_social_security" value="1">
			                                    <span class="form-check-label">Does not withhold Social Security</span>
			                                  </label>
			                                </div>

			                                <div class="mb-4">
			                                  <label class="form-check m-0">
			                                    <input type="checkbox" class="form-check-input check-employer-spouse" id="does_not_withhold_medicare" value="1">
			                                    <span class="form-check-label">Does not withhold Medicare</span>
			                                  </label>
			                                </div>
			                              </div>
			                            </div>
			                          </div>`;

					content.append(dependentBlock);
					getPeriods('employer-spouse-blur')
				        .then(html => {
				            content.find("."+'pay_period_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });
				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
	})
	
	jQuery(document).on('click', '#add-more-other-business',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('business_interests.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{
					var content = $("#content-other-bussiness").find('.card');
					var dependentBlock = `
									<div class="row item-other-bussines mt-3 border-top border-2 pt-5">
			                            <input type="hidden" name="business_interest_id" id="business_interest_id" value="`+response.data.id+`">
			                            <div class="col-md-6">
			                              <div class="row">
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="business_name" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="business_name">Business Name</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="business_address" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="business_address">Bussiness Address</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="city_state_zip" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="city_state_zip">City, State, ZIP</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="phone" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="phone">Phone</label>
			                                  </div>
			                                </div>
			                              </div>
			                            </div>
			                            <div class="col-md-6">
			                              <div class="row">

			                                <div class="col-md-7 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <select id="type" class="form-control form-control-sm other-business-blur select2 form-select">
			                                      <option></option>
			                                    </select>
			                                    <label for="multicol-username">Type of Bussiness</label>
			                                  </div>
			                                </div>
			                                <div class="col-md-5 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="ownership" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="ownership">% Ownership</label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="title" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="title">Title </label>
			                                  </div>
			                                </div>

			                                <div class="col-md-12 mt-2">
			                                  <div class="form-floating form-floating-outline">
			                                    <input type="text" id="ein" class="form-control form-control-sm other-business-blur" placeholder="" />
			                                    <label for="ein">EIN </label>
			                                  </div>
			                                </div>

			                              </div>
			                            </div>
			                          </div>`;

					content.append(dependentBlock);
				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
	})

	jQuery(document).on('click', '#add-item-bank-account',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('bankAccounts.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-personal-bank-account").find('.card');
					    var dependentBlock = `<div class="row item-bank-account  item-bank-account-`+response.data.id+`    mt-3 border-top border-2 pt-5">
					                            <input type="hidden" name="bankAccount_id" id="bankAccount_id" value="`+response.data.id+`">
					                            <div class="col-md-12">
					                              <div class="row">
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline type_account_`+response.data.id+`">
					                                    <select class="form-control form-control-sm form-select input-bank-account-blur " id="type_of_account">
					                                      <option value="0">Select</option>
					                                      
					                                    </select>
					                                    <label for="type_of_account">Type of Account</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="bank_name" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="bank_name">Bank Name</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="address" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="address">Address</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="account_number" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="account_number">Account Number</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="current_value">Current Value</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="statement_date" class="form-control form-control-sm input-bank-account-blur" placeholder="" value=""/>
					                                    <label for="statement_date">Statement Date</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                          </div>`;

					content.append(dependentBlock);
					//item-bank-account-

					getTypeAccount('input-bank-account-blur')
				        .then(html => {
				            content.find("."+'type_account_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });
					}
				}
			})
	})
	
	
	jQuery(document).on('click', '#add-item-investment-account',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('investmentAccounts.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-personal-bank-account").find('.card');
					    
					 	var dependentBlock = `<div class="row item-investment-account mt-3 border-top border-2 pt-5 item-bank-account-`+response.data.id+`">
					                            <input type="hidden" name="investmentAccount_id" id="investmentAccount_id" value="`+response.data.id+`">
					                            <div class="col-md-12">
					                              <div class="row">
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline type_account_`+response.data.id+`">
					                                    <select class="form-control form-control-sm form-select input-investment-account-blur" id="type_of_account">
					                                      <option value="0">Select</option>
					                                     
					                                    </select>
					                                    <label for="type_of_account">Type of Account</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="company_name" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="company_name">Company Name</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="address" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="address">Address</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="account_number" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="account_number">Account Number</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="company_phone" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="company_phone">Company Phone</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="""/>
					                                    <label for="current_value">Current Value</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="loan_balance">Loan Balance</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="statement_date" class="form-control form-control-sm input-investment-account-blur" placeholder="" value=""/>
					                                    <label for="statement_date">Statement Date</label>
					                                  </div>
					                                </div>

					                                <div class="mb-4 mt-2">
					                                  <label class="form-check m-0">
					                                    <input type="checkbox" class="form-check-input check-investment-account-blur" name="used_as_collateral" value="1">
					                                    <span class="form-check-label">Used as Collateral on loan</span>
					                                  </label>
					                                </div>


					                              </div>
					                            </div>
					                          </div>`;

					content.append(dependentBlock);
					//item-bank-account-

					getTypeAccount('input-investment-account-blur')
				        .then(html => {
				            content.find("."+'type_account_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });
					}
				}
			})
	})
	
	
	jQuery(document).on('click', '#add-item-digital-assets',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('digitalAssets.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-digital-assets").find('.card');
					    
					    var dependentBlock = `<div class="row item-digital-assets mt-3 border-top border-2 pt-5 item-digital-assets-`+response.data.id+`">
					                            <input type="hidden" name="digitalAsset_id" id="digitalAsset_id" value="`+response.data.id+`">

					                            <div class="col-md-12">
					                              <div class="row">
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="description" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="" />
					                                    <label for="description">Type/Description of assets</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="email" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="" />
					                                    <label for="email">Email address used to setup asset</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="asset_name" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value=""/>
					                                    <label for="asset_name">Name of asset(Virtual Wallet, DCE, etc)</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="account_number" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value=""/>
					                                    <label for="account_number">Account # for assets held by broker</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="units" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="" />
					                                    <label for="units">Number of units</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="digital_address" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="" />
					                                    <label for="digital_address">Digital address  for self-hosted assets</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="location" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value=""/>
					                                    <label for="location">Location(s)</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value=""/>
					                                    <label for="current_value">Current Value</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                          </div>`;
					content.append(dependentBlock);
					}
				}
			})
	})
	

	jQuery(document).on('click', '#add-item-retirement-account',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('retirementAccounts.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-retirement-account").find('.card');
					    var dependentBlock = `<div class="row item-retirement-account mt-3 border-top border-2 pt-5 item-retirement-account-`+response.data.id+`">
					                              <input type="hidden" name="retirementAccount_id" id="retirementAccount_id" value="`+response.data.id+`">
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline type_account_`+response.data.id+`">
					                                  <select class="form-control form-control-sm form-select input-retirement-account-blur" id="account_type">
					                                    <option value="0">Select</option>
					                                  </select>
					                                  <label for="account_type">Type of account</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="account_number" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="account_number">Account Number</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="company_name" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="company_name">Company Name</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="address" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="address">Address</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="city_state_zip">City, State, ZIP</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="company_phone" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="company_phone">Company Phone</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="current_value">Current Value</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="loan_balance" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value=""/>
					                                  <label for="loan_balance">Loan Balance</label>
					                                </div>
					                              </div>

					                              
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="statement_date" class="form-control form-control-sm input-retirement-account-blur date-simple flatpickr-input" placeholder="YYYY-MM-DD" value=""/>
					                                  <label for="statement_date">Statement Date</label>
					                                </div>
					                              </div>
					                              <div class="col-md-12 mt-2">
					                                  <label class="form-check m-0">
					                                    <input type="checkbox" class="form-check-input check-retirement-account-change" name="used_as_collateral"  id="used_as_collateral" value="1" >
					                                    <span class="form-check-label">Used as collateral on loan</span>
					                                  </label>
					                                  <br>
					                                  <label class="form-check m-0">
					                                    <input type="checkbox" class="form-check-input check-retirement-account-change" id="custom_quick_sale" value="1" name="custom_quick_sale" >
					                                    <span class="form-check-label">Used custom Quick Sale % instead of 0.8</span>
					                                  </label>
					                              </div>

					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="fed_tax_rate" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value=""/>
					                                  <label for="fed_tax_rate">Fed Tax Rate (%)</label>
					                                </div>
					                              </div>
					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="fed_penalty" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value=""/>
					                                  <label for="fed_penalty">Fed Penalty (%)</label>
					                                </div>
					                              </div>

					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="state_tax_rate" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value="" />
					                                  <label for="state_tax_rate">State Tax Rate (%)</label>
					                                </div>
					                              </div>

					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="state_penalty" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value=""/>
					                                  <label for="state_penalty">State Penalty (%)</label>
					                                </div>
					                              </div>
					                          </div>`;

					content.append(dependentBlock);

					getTypeAccount('input-retirement-account-blur','account_type')
				        .then(html => {
				            content.find("."+'type_account_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });
					}
				}
			})
	})
	

	jQuery(document).on('click', '#add-item-question-available-credit',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('creditAccounts.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-question-available-credit").find('.card');
					    
					    var dependentBlock = `<div class="row item-credit-account mt-3 border-top border-2 pt-5 item-credit-account-`+response.data.id+`">
						                            <input type="hidden" name="creditAccount_id" id="creditAccount_id" value="`+response.data.id+`">
						                            <div class="col-md-12">
						                              <div class="row">
						                                <div class="col-md-6 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="bank_name" class="form-control form-control-sm input-credit-account-blur" placeholder="" value=""/>
						                                    <label for="bank_name">Bank Name</label>
						                                  </div>
						                                </div>
						                                <div class="col-md-6 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="bank_address" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="bank_address">Bank Address</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="city" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="city">City</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="city_state_zip">City, State, ZIP</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="property_security" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="property_security">Property / Security</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="account_number" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="account_number">Account Number</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="credit_limit" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="credit_limit">Credit Limit</label>
						                                  </div>
						                                </div>
						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="loan_balance">Loan Balance</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="num" id="employed_years" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="employed_years">Employed Years</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="text" id="minimum_monthly_payment" class="form-control form-control-sm input-credit-account-blur" placeholder=""  value=""/>
						                                    <label for="minimum_monthly_payment">Minimun Mounthly pmt</label>
						                                  </div>
						                                </div>

						                                <div class="col-md-4 mt-2">
						                                  <div class="form-floating form-floating-outline">
						                                    <input type="date" id="statement_date" class="form-control form-control-sm input-credit-account-blur date-simple flatpickr-input" placeholder="YYYY-MM-DD"  value="" />
						                                    <label for="statement_date">Statement Date</label>
						                                  </div>
						                                </div>
						                              </div>
						                            </div>
						                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})
	


	jQuery(document).on('click', '#add-item-life-insurance',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('lifeInsurances.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-life-insurance").find('.card');
					    
						var dependentBlock = `<div class="row item-life-insurance mt-3 border-top border-2 pt-5 item-life-insurance-`+response.data.id+`">
					                            <input type="hidden" name="lifeInsurance_id" id="lifeInsurance_id" value="`+response.data.id+`">
					                            <div class="col-md-12">
					                              <div class="row">
					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="company_name" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="" />
					                                    <label for="company_name">Company Name</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="company_address" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="" />
					                                    <label for="company_address">Company Address</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="" />
					                                    <label for="city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="policy_number" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="" />
					                                    <label for="policy_number">Policy Number(s)</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="policy_owner" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value=""/>
					                                    <label for="policy_owner">Policiy Owner</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="num" id="current_cash_value" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value=""/>
					                                    <label for="current_cash_value">Current  Cash Value</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-4 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="outstanding_loan_balance" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value=""/>
					                                    <label for="outstanding_loan_balance">Outstanding  Loan Balance</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})


	jQuery(document).on('click', '#add-item-then-year-have-any',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('assetTransfers.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-then-year-have-any").find('.card');
					    
						var dependentBlock = `<div class="row item-asset-transfer mt-3 border-top border-2 pt-5 item-asset-transfer-`+response.data.id+`">
					                            <input type="hidden" name="assetTransfer_id" id="assetTransfer_id" value="`+response.data.id+`">
					                            <div class="col-md-6">
					                              <div class="row">
					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="business_name" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="business_name">Business Name</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="business_address" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="business_address">Business Address</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="phone" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="phone">Phone</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                            <div class="col-md-6">
					                              <div class="row">

					                                <div class="col-md-7 mt-2">
					                                  <div class="form-floating form-floating-outline type_of_business_`+response.data.id+`">
					                                    <select class="form-control form-control-sm form-select input-asset-transfer-blur" name="type_of_business" id="type_of_business">
					                                      <option value="0">Select</option>
					                                    </select>
					                                    <label for="type_of_business">Type of Bussiness</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-5 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="ownership_percentage" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="ownership_percentage">% Ownership</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="title" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="title">Title </label>
					                                  </div>
					                                </div>

					                                <div class="col-md-12 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="ein" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value=""/>
					                                    <label for="ein">EIN </label>
					                                  </div>
					                                </div>

					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);


						getTypeBusiness('input-asset-transfer-blur','type_of_business')
				        .then(html => {
				            content.find("."+'type_of_business_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });


					}
				}
			})
	})
	
	jQuery(document).on('click', '#add-item-three-year-any-property',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('realStateTransfers.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-three-year-any-property").find('.card');
					    
						var dependentBlock = `<div class="row item-real-state-transfer mt-3 border-top border-2 pt-5">
					                            <input type="hidden" name="realEstateTransfer_id" id="realEstateTransfer_id" value="`+response.data.id+`">
					                            <div class="col-md-6">
					                              <div class="row">
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="assets" class="form-control form-control-sm input-real-state-transfer-blur" placeholder="" value=""/>
					                                    <label for="assets">Assets</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="date_transferred" class="form-control form-control-sm input-real-state-transfer-blur" placeholder="" value=""/>
					                                    <label for="date_transferred">Date Transferred</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})
	
	jQuery(document).on('click', '#add-item-own-any-real-property',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('property.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content = $("#content-own-any-real-property").find('.card');
					    
						var dependentBlock = `<div class="row item-property-real mt-3 border-top border-2 pt-5">
					                            <div class="col-md-12">
					                              <div class="row">
					                                <input type="hidden" name="property_id" id="property_id" value="`+response.data.id+`">
					                                <div class="mb-4 mt-2">
					                                  <label class="form-check m-0">
					                                    <input type="checkbox" class="form-check-input" check-property-real-change" id="is_primary" name="is_primary" value="1">
					                                    <span class="form-check-label">Primary Residence</span>
					                                  </label>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" class="form-control form-control-sm input-property-real-blur" name="street_address" id="street_address" value=""/>
					                                    <label for="street_address">Street Address</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="country" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="country">Country</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="description" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="description">Description</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="title_held" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="title_held">How title is Held</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="purchase_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="purchase_date">Purchase Date</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="purchase_price" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="purchase_price">Purchase Price</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="statement_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="statement_date">Statement Date</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="refinance_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="refinance_date">Refinance Date</label>
					                                  </div>
					                                </div>
					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="refinance_amount" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="refinance_amount">Refinance Amount</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="current_value">Current Value</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="loan_balance">Current loan balance</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="monthly_payment" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="monthly_payment">Monthly payment</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="date" id="final_payment_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="final_payment_date">Date of final payment</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="lender_name" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="lender_name">Lender</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="lender_address" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="lender_address">Lender address</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="lender_city_state_zip">City, State, ZIP</label>
					                                  </div>
					                                </div>

					                                <div class="col-md-6 mt-2">
					                                  <div class="form-floating form-floating-outline">
					                                    <input type="text" id="lender_phone" class="form-control form-control-sm input-property-real-blur" placeholder="" value=""/>
					                                    <label for="lender_phone">Lender Phone</label>
					                                  </div>
					                                </div>
					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})
	
	jQuery(document).on('click', '#add-item-have-any-cars-boats-motorcycle',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('vehicles.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-have-any-cars-boats-motorcycle").find('.card');
						var dependentBlock 	= `<div class="row item-any-vehicle mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="vehicle_id" id="vehicle_id" value="`+response.data.id+`">
					                              <label class="form-check-label">Primary vehicle for? </label>
					                              <div class="col-md-12 mt-2">
					                                  <div class="form-check form-check-inline">
					                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="taxpayer" id="primary_vehicle_for">
					                                    <label class="form-check-label" for="primary_vehicle_for">Taxpayer</label>
					                                  </div>
					                                  <div class="form-check form-check-inline">
					                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="spouse" id="primary_vehicle_for">
					                                    <label class="form-check-label" for="primary_vehicle_for">
					                                      Spouse
					                                    </label>
					                                  </div>
					                                  <div class="form-check form-check-inline">
					                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="neither" id="primary_vehicle_for">
					                                    <label class="form-check-label" for="primary_vehicle_for" >
					                                      Neither
					                                    </label>
					                                  </div>
					                                  
					                                </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="num" id="year" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="year">Year</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="make" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="make">Make</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="model" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="model">Model</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="mileage" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="mileage">Mileage</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="license" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="license">License</label>
					                                </div>
					                              </div>
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="vin" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="vin">VIN</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="purchase_date">Purchase Date</label>
					                                </div>
					                              </div>

					                              
					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="current_value">Current Value</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="current_loan_balance">Current loan balance</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="monthly_payment">Monthly payment</label>
					                                </div>
					                              </div>

					                              <div class="col-md-4 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="date_of_final_payment" class="form-control form-control-sm date-simple flatpickr-input input-any-vehicle-blur" placeholder="YYYY-MM-DD" value=""/>
					                                  <label for="date_of_final_payment">Date of final payment</label>
					                                </div>
					                              </div>
					                              


					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_name" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="lender_name">Lender Name</label>
					                                </div>
					                              </div>
					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_address" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="lender_address">lender Address</label>
					                                </div>
					                              </div>

					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="lender_city_state_zip">City, State, ZIP</label>
					                                </div>
					                              </div>

					                              <div class="col-md-3 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value=""/>
					                                  <label for="lender_phone">Lender Phone</label>
					                                </div>
					                              </div>

					                              <div class="mb-4">
					                                <label class="form-check m-0">
					                                  <input type="checkbox" class="form-check-input input-any-vehicle-check" name="is_loan" id="is_loan" value="1">
					                                  <span class="form-check-label">Loan/Own</span>
					                                </label>

					                                <label class="form-check m-0">
					                                  <input type="checkbox" class="form-check-input input-any-vehicle-check"  name="is_lease" id="is_lease" value="1">
					                                  <span class="form-check-label">Lease</span>
					                                </label>
					                              </div>
					                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})
	
	jQuery(document).on('click', '#add-item-any-other-assets',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('otherAssets.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-any-other-assets").find('.card');
					    var dependentBlock 	= `<div class="row item-other-asset mt-3 border-top border-2 pt-5">
						                            <input type="hidden" name="other_asset_id" id="other_asset_id" value="`+response.data.id+`">
						                            <label class="form-check-label">Type? </label>
						                            <div class="col-md-12 mt-2">
						                              <div class="form-check form-check-inline">
						                                <input name="type" class="form-check-input check-other-asset-blur" type="radio" value="tangible" id="type">
						                                <label class="form-check-label" for="type-home">Tangible</label>
						                              </div>
						                              <div class="form-check form-check-inline">
						                                <input name="type" class="form-check-input check-other-asset-blur" type="radio" value="intangible" id="type">
						                                <label class="form-check-label" for="type-office">
						                                  Intangible
						                                </label>
						                              </div>                                  
						                            </div>

						                            <div class="col-md-4 mt-2">
						                              <div class="form-floating form-floating-outline">
						                                <input type="text" id="description" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="" />
						                                <label for="description">Description</label>
						                              </div>
						                            </div>

						                            <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="street_address" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="street_address">Street Address</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="city_state_zip">City, State, ZIP</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="county" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="county">County</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="purchase_date">Puchase Date</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="current_value">Current Value</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="current_loan_balance">Current loan balance</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="monthly_payment">Montly payment</label>
						                                </div>
						                              </div>

						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="date" id="date_of_final_payment" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="date_of_final_payment">Date of final payment</label>
						                                </div>
						                              </div>
						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="lender" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="lender">Lender</label>
						                                </div>
						                              </div>
						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="lender_address" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="lender_address">Lender Address</label>
						                                </div>
						                              </div>
						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="lender_city_state_zip">City, State, ZIP</label>
						                                </div>
						                              </div>
						                              <div class="col-md-4 mt-2">
						                                <div class="form-floating form-floating-outline">
						                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-other-asset-blur" placeholder="" value=""/>
						                                  <label for="lender_phone">Lender Phone</label>
						                                </div>
						                              </div>
						                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})
	

	jQuery(document).on('click', '#add-item-business-engage-e-commerce',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('paymentProcessor.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-engage-e-commerce").find('.card');
					    var dependentBlock 	= `<div class="row item-business-engage-e-commerce mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="paymentProcessor_id" id="paymentProcessor_id" value="`+response.data.id+`">
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="processor_name" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="" />
					                                  <label for="processor_name">Processor Name</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="street_address" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="" />
					                                  <label for="street_address">Street Address</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="" />
					                                  <label for="city_state_zip">City, State, ZIP</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="account_number" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="" />
					                                  <label for="account_number">Account Number</label>
					                                </div>
					                              </div>
					                            </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})

	jQuery(document).on('click', '#add-item-business-accept-credit-card',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('creditCards.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-accept-credit-card").find('.card');
					    
					    var dependentBlock 	= `<div class="row item-business-accept-credit-card mt-3 border-top border-2 pt-5">
					                            <input type="hidden" name="creditCard_id" id="creditCard_id" value="`+response.data.id+`">
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="card_type" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="card_type">Card Type</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="name_on_account" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="name_on_account">Name on Account</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="merchant_account_number" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="merchant_account_number">Merchant Account Number</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="issuing_bank" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="issuing_bank">Issuing Bank</label>
					                              </div>
					                            </div>

					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="street_address" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="street_address">Street Address</label>
					                              </div>
					                            </div>

					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="city_state_zip">City, State, ZIP</label>
					                              </div>
					                            </div>

					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="phone" class="form-control form-control-sm input-business-accept-credit-card-blur" value="" />
					                                <label for="phone">Phone</label>
					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);
					}
				}
			})
	})

	jQuery(document).on('click', '#add-item-business-have-any-bank',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('businessBanksAccount.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-have-any-bank").find('.card');
					    var dependentBlock 	= `<div class="row item-business-have-any-bank mt-3 border-top border-2 pt-5">
					                            <input type="hidden" name="businessBankAccount_id" id="businessBankAccount_id" value="`+response.data.id+`">
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline type_of_account_`+response.data.id+`">
					                                <select class="form-control form-control-sm form-select input-business-have-any-bank-blur" name="type_of_account" id="type_of_account">
					                                  <option value="0">Select</option>
					                                  
					                                </select>
					                                <label for="type_of_account">Type of Account</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="bank_name" class="form-control form-control-sm input-business-have-any-bank-blur" value="" />
					                                <label for="bank_name">Bank Name</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="bank_address" class="form-control form-control-sm input-business-have-any-bank-blur" value="" />
					                                <label for="bank_address">Bank Address</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-bank-blur" value="" />
					                                <label for="city_state_zip">City, State, ZIP</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="text" id="account_number" class="form-control form-control-sm input-business-have-any-bank-blur" value="" />
					                                <label for="account_number">Account Number</label>
					                              </div>
					                            </div>
					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-bank-blur" value=""/>
					                                <label for="current_value">Current Value</label>
					                              </div>
					                            </div>

					                            <div class="col-md-6 mt-2">
					                              <div class="form-floating form-floating-outline">
					                                <input type="date" id="statement_date" class="form-control form-control-sm input-business-have-any-bank-blur" value="" />
					                                <label for="statement_date">Statement Date</label>
					                              </div>
					                            </div>
					                          </div>`;
						content.append(dependentBlock);

						getTypeAccount('input-business-have-any-bank-blur','type_of_account')
				        .then(html => {
				            content.find("."+'type_of_account_'+response.data.id).html(html);
				        })
				        .catch(error => {
				            // console.error(error); // Manejar errores si ocurren
				        });


					}
				}
			})
	})

	jQuery(document).on('click', '#add-item-business-own-any-digital-assets',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('companyDigitalAssets.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-own-any-digital-assets").find('.card');
					    var dependentBlock 	= `<div class="row  item-business-own-any-digital-assets mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="companyDigitalAsset_id" id="companyDigitalAsset_id" value="`+response.data.id+`">
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="description" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="description">Description</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="account_number" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="account_number">Account # for assets held by broker</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="number_of_units" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="number_of_units">Number of units</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="digital_address" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="digital_address">Digital address for  self-hosted assets</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="location" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="location">Location(s)</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="" />
					                                  <label for="current_value">Current Value</label>
					                                </div>
					                              </div>
					                            </div>`;
						content.append(dependentBlock);


					}
				}
			})
	})

	jQuery(document).on('click', '#add-item-business-have-any-account-notes',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('companyAccountReceivable.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-have-any-account-notes").find('.card');
					    var dependentBlock 	= `<div class="row item-business-have-any-account-notes mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="companyAccountReceivable_id" id="companyAccountReceivable_id" value="`+response.data.id+`">
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="account_description" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="account_description">Account descrription</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="address" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="address">Address</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="city_state_zip">City, State,ZIP</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="contact" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="contact">Contact</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="phone" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="phone">Phone</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="status" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="status">Status</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="due_date" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="due_date">Due Date</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="invoice_no" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="invoice_no">Invoice No</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" id="amount_due" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="" />
					                                  <label for="amount_due">Amount Due</label>
					                                </div>
					                              </div>
					                            </div>`;
						content.append(dependentBlock);


					}
				}
			})
	})
		
	jQuery(document).on('click', '#add-item-business-have-any-tools-equiment',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('companyToolEquipment.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-have-any-tools-equiment").find('.card');
						var dependentBlock 	= `<div class="row item-business-have-any-tools-equiment mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="companyToolEquipments_id" id="companyToolEquipments_id" value="`+response.data.id+`">
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="description" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="description">Description</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="street_address" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="street_address">Street Address</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="city_state_zip">City, State,ZIP</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="purchase_date">Purchase Date</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="current_value">Current Value</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="status" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="status">Status</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="current_loan_balance">Current loan Balance</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="monthly_payment">Monthly payment</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="date_of_final_payment" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="date_of_final_payment">Date of final payment</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="lender">Lender</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_address" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="lender_address">Lender address</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="lender_city_state_zip">City, State, ZIP</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="" />
					                                  <label for="lender_phone">Lender Phone</label>
					                                </div>
					                              </div>
					                              <div class="mb-4">
					                                <label class="form-check m-0">
					                                  <input type="checkbox" class="form-check-input check-business-have-any-tools-equiment-blur" name="is_leased_or_income_generating" id="is_leased_or_income_generating" value="1" >
					                                  <span class="form-check-label">Asset is leased or used to generate income</span>
					                                </label>
					                              </div>
					                            </div>`;
						content.append(dependentBlock);


					}
				}
			})
	})

	jQuery(document).on('click', '#add-item-business-have-any-intangible-assets',function(event){
		var id = $("#client_idx").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
				url: "{{ route('companyIntangibleAssets.store') }}",
				type: "POST",
				data: {client_id: id},
				success: function (response)
				{
					if(response.status)
					{
						var content 		= $("#content-business-have-any-intangible-assets").find('.card');
						var dependentBlock 	= `<div class="row item-business-have-any-intangible-assets mt-3 border-top border-2 pt-5">
					                              <input type="hidden" name="companyIntangibleAsset_id" id="companyIntangibleAsset_id" value="`+response.data.id+`">
					                              <div class="col-md-12 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="text" id="description" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="" />
					                                  <label for="description">Description</label>
					                                </div>
					                              </div>
					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="" />
					                                  <label for="current_value">Current Value</label>
					                                </div>
					                              </div>

					                              <div class="col-md-6 mt-2">
					                                <div class="form-floating form-floating-outline">
					                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="" />
					                                  <label for="purchase_date">Purchase Date</label>
					                                </div>
					                              </div>
					                            </div>`;
						content.append(dependentBlock);


					}
				}
			})
	})



	/*TAB OTHER FINANCIAL*/
	/*LAWSUIT*/


	jQuery(document).on('click', '#add-more-lawsuit-financial',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('lawsuit.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{
					var content = $("#content-taxpayer-party-lawsuit").find('.card');
					var dependentBlock = `
											<div class="row item-lawsuit-financial mt-3 border-top border-2 pt-5">
							                    <input type="hidden" name="lawsuit_id" id="lawsuit_id" value="`+response.data.id+`">
							                    <div class="col-md-6">
							                      <div class="row">
							                        <div class="col-md-12 mt-2">
							                          <div class="form-check form-check-inline">
							                            <input name="role`+response.data.id+`" class="form-check-input input-item-check-taxpayer-party-lawsuit" type="radio" value="plaintiff" id="role" >
							                            <label class="form-check-label" for="role">
							                              Plaintiff
							                            </label>
							                          </div>
							                          <div class="form-check form-check-inline">
							                            <input name="role`+response.data.id+`" class="form-check-input input-item-check-taxpayer-party-lawsuit" type="radio" value="defendant" id="role">
							                            <label class="form-check-label" for="role">
							                              Defendant
							                            </label>
							                          </div>
							                        </div>

							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="subject_of_suit" class="form-control form-control-sm party-lawsuit-blur" placeholder="" value=""/>
							                            <label for="subject_of_suit">Subject of Suit</label>
							                          </div>
							                        </div>


							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="location_of_filing" class="form-control form-control-sm party-lawsuit-blur" placeholder=""   value="""/>
							                            <label for="location_of_filing">Location of Filing</label>
							                          </div>
							                        </div>

							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="city" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value=""/>
							                            <label for="city">City</label>
							                          </div>
							                        </div>

							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="represented_by" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value=""/>
							                            <label for="represented_by">Represented by</label>
							                          </div>
							                        </div>

							                        
							                      </div>
							                    </div>
							                    <div class="col-md-6">
							                      <div class="row">
							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <select id="amount_of_suit" class="form-control form-control-sm party-lawsuit-blur select2 form-select">
							                              <option></option>
							                            </select>
							                            <label for="amount_of_suit">Amount of Suit</label>
							                          </div>
							                        </div>
							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="docket_case_number" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value=""/>
							                            <label for="docket_case_number">Docker/Case No.</label>
							                          </div>
							                        </div>

							                        <div class="col-md-12 mt-2">
							                          <div class="form-floating form-floating-outline">
							                            <input type="text" id="possible_completion_date" class="form-control form-control-sm party-lawsuit-blur  date-simple flatpickr-input" placeholder="YYYY-MM-DD" />
							                            <label for="possible_completion_date">Possible Completion Date</label>
							                          </div>
							                        </div>

							                      </div>
							                    </div>
							                  </div>`;

					content.append(dependentBlock);
					$(".date-simple").flatpickr({
						dateFormat: "Y-d-m",
					});

						$(".select2").select2({
					        placeholder: 'Select value',
					      });

				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
	})


	jQuery(document).on('click', '#add-more-lawsuit-irs',function(event){
		var id = $("#client_idx").val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			url: "{{ route('lawsuit_irs.store') }}",
			type: "POST",
			data: {client_id: id},
			success: function (response) {
				// console.log(response.data);
				if(response.status)
				{
					var content = $("#content-taxpayer-party-lawsuit-involving").find('.card');
					var dependentBlock = `
										<div class="row item-lawsuit-irs mt-3 border-top border-2 pt-5">
						                    <input type="hidden" name="lawsuit_irs_id" id="lawsuit_irs_id" value="`+response.data.id+`">
						                    <div class="col-md-12">
						                      <div class="row">
						                        <div class="col-md-12 mt-2">
						                          <div class="form-floating form-floating-outline">
						                            <input type="text" id="name" class="form-control form-control-sm input-lawsuit-irs-blur" placeholder=""  value="" />
						                            <label for="name">If the suit included tax debit, provide the types of tax and periods involved</label>
						                          </div>
						                        </div>
						                      </div>
						                    </div>
						                  </div>`;
					content.append(dependentBlock);

				}
				
			},
			error: function (error) {
				// console.error("Error saving:", error);
			}
		});
	})

	jQuery(document).on('keydown', '.employer-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-employed");        
        var employer_id = row.find("input[name='employer_id']").val(); // Buscar el input hidden con name="employer_id" dentro de ese bloque

		if ($.trim(value_attr) != ""  && event.which == 13)
		{
				console.log(employer_id);
			updateInfoEmployerClient(id_attr, value_attr, employer_id);
		}

	})


	jQuery(document).on('blur', '.employer-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-employed");        
        var employer_id = row.find("input[name='employer_id']").val(); // Buscar el input hidden con name="employer_id" dentro de ese bloque

		if ($.trim(value_attr) != "")
		{
				
			updateInfoEmployerClient(id_attr, value_attr, employer_id);
		}

	})

	jQuery(document).on('click', '.check-employer',function(event){

		let row = $(this).closest(".item-employed");
	    updateInfoEmployerClient(
	        $(this).attr('id'),
	        $(this).is(':checked') ? 1 : 0,
	        row.find("input[name='employer_id']").val()
	    );

	})

	jQuery(document).on('click', '.input-item-check-taxpayer-party-lawsuit',function(event){

		let row = $(this).closest(".item-lawsuit-financial");
	    updateInfoPartyLawsuit_otherFinancial(
	        $(this).attr('id'),
	        $(this).val(),

	        row.find("input[name='lawsuit_id']").val()
	    );

	})

	jQuery(document).on('keydown blur change', '.employer-spouse-blur', function(event) {
	    let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-employed-spouse");
	    let employer_id = row.find("input[name='employer_spouse_id']").val();

	    updateInfoEmployerSpouseClient($(this).attr('id'), value_attr, employer_id);
	});


	jQuery(document).on('click', '.check-employer-spouse',function(event){

		let row = $(this).closest(".item-employed-spouse");


	    updateInfoEmployerSpouseClient(
	        $(this).attr('id'),
	        $(this).is(':checked') ? 1 : 0,
	        row.find("input[name='employer_spouse_id']").val()
	    );

	})

	/*EVENTO KEY BLUR OTHER BUSINESS*/

	jQuery(document).on('keydown blur', '.other-business-blur', function(event) {
	    let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-other-bussines");
	    let employer_id = row.find("input[name='business_interest_id']").val();

	    updateInfoOtherBusinessClient_personalEmp($(this).attr('id'), value_attr, employer_id);
	});

	/**/

	jQuery(document).on('keydown blur', '.party-lawsuit-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-lawsuit-financial");
	    let employer_id = row.find("input[name='lawsuit_id']").val();

	    updateInfoPartyLawsuit_otherFinancial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-lawsuit-irs-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-lawsuit-irs");
	    let employer_id = row.find("input[name='lawsuit_irs_id']").val();

	    updateInfoLawsuit_irs_otherFinancial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-taxpayer-bankruptcy-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-taxpayer-bankruptcy");
	    let employer_id = row.find("input[name='bankruptcy_id']").val();

	    updateInfoTaxPayer_bankruptcy_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-taxpayer-beneficiary-trust-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-taxpayer-beneficiary-trust");
	    let employer_id = row.find("input[name='beneficiaryInsurance_id']").val();

	    updateInfoTaxPayer_bankruptcyBeneficiaryTrust_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-trust-fund-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-trust-fund");
	    let employer_id = row.find("input[name='trustfund_id']").val();

	    updateInfoTrustFund_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-trusteer-fiduciary-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-trusteer-fiduciary");
	    let employer_id = row.find("input[name='trustee_id']").val();

	    updateInfoTrusteFiduciary_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-safe-deposit-box-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-safe-deposit-box");
	    let employer_id = row.find("input[name='safedeposit_id']").val();

	    updateInfoSafeDeposit_Financial($(this).attr('id'), value_attr, employer_id);

	})


	jQuery(document).on('change', '.input-live-abroad-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-live-abroad");
	    let employer_id = row.find("input[name='liveabroad_id']").val();

	    updateInfoTaxPayerLiveOutside6_Financial($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-asset-abroad-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-asset-abroad");
	    let employer_id = row.find("input[name='assetAbroad_id']").val();

	    updateInfoAssetAbrooad_Financial($(this).attr('id'), value_attr, employer_id);

	})


	//BLOQUE 3
	//banck account
	jQuery(document).on('keydown blur', '.input-bank-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-bank-account");
	    let employer_id = row.find("input[name='bankAccount_id']").val();

	    updateInfoBanckAccount_BanckInvestment($(this).attr('id'), value_attr, employer_id);

	});

	//investmentAccount 
	jQuery(document).on('keydown blur', '.input-investment-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-investment-account");
	    let employer_id = row.find("input[name='investmentAccount_id']").val();

	    updateInfoInvestmentAccount_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//investmentAccount 
	jQuery(document).on('click', '.check-investment-account-blur',function(event){

		// let value_attr = $.trim($(this).val());
		let value_attr = $(this).is(':checked') ? 1 : 0;
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-investment-account");
	    let employer_id = row.find("input[name='investmentAccount_id']").val();

	    updateInfoInvestmentAccount_BankInvestment($(this).attr('name'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-digital-assets-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-digital-assets");
	    let employer_id = row.find("input[name='digitalAsset_id']").val();

	    updateInfoDigitalAssets_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//retiremet
	jQuery(document).on('keydown blur change', '.input-retirement-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-retirement-account");
	    let employer_id = row.find("input[name='retirementAccount_id']").val();

	    updateInfoRetirementAccount_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//retiremet
	jQuery(document).on('keydown blur change', '.check-retirement-account-change',function(event){

		// let value_attr = $.trim($(this).val());
		let value_attr = $(this).is(':checked') ? 1 : 0;
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-retirement-account");
	    let employer_id = row.find("input[name='retirementAccount_id']").val();

	    updateInfoRetirementAccount_BankInvestment($(this).attr('name'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur', '.input-credit-account-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-credit-account");
	    let employer_id = row.find("input[name='creditAccount_id']").val();

	    updateInfoCreditAccount_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//life insurance
	jQuery(document).on('keydown blur', '.input-life-insurance-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-life-insurance");
	    let employer_id = row.find("input[name='lifeInsurance_id']").val();

	    updateInfoLifeInsurance_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//Assets TRansferer
	jQuery(document).on('keydown blur', '.input-asset-transfer-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-asset-transfer");
	    let employer_id = row.find("input[name='assetTransfer_id']").val();

	    updateInfoAssetTransfer_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	//Assets TRansferer
	jQuery(document).on('keydown blur change', '.input-real-state-transfer-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-real-state-transfer");
	    let employer_id = row.find("input[name='realEstateTransfer_id']").val();

	    updateInfoRealStateTransferer_BankInvestment($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur change', '.input-property-real-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-property-real");
	    let employer_id = row.find("input[name='property_id']").val();

	    updateInfoPropertyReal_RealState($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('click', '.check-property-real-change',function(event){

		// let value_attr = $.trim($(this).val());
		let value_attr = $(this).is(':checked') ? 1 : 0;
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-property-real");
	    let employer_id = row.find("input[name='property_id']").val();

	    updateInfoPropertyReal_RealState($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('keydown blur change', '.input-listing-price-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-property-sales");
	    let employer_id = row.find("input[name='property_sales_id']").val();

	    updateInfoPropertySales_RealState($(this).attr('id'), value_attr, employer_id);

	})


	jQuery(document).on('keydown blur change', '.input-any-vehicle-blur',function(event){

		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-any-vehicle");
	    let employer_id = row.find("input[name='vehicle_id']").val();

	    updateInfoAnyVehicles_RealState($(this).attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('change', '.input-any-vehicle-check',function(event){
		let _this = $(this);
		// let value_attr = $.trim(_this.val());

		let value_attr = _this.is(':checked') ? 1 : 0;
	    
	    // if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row 		= _this.closest(".item-any-vehicle");
	    let employer_id = row.find("input[name='vehicle_id']").val();

	    updateInfoAnyVehicles_RealState(_this.attr('id'), value_attr, employer_id);

	})


	jQuery(document).on('keydown blur change', '.input-other-asset-blur',function(event){
		let _this = $(this);
		let value_attr = $.trim(_this.val());
	    
	    // if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row 		= _this.closest(".item-other-asset");
	    let employer_id = row.find("input[name='other_asset_id']").val();

	    updateInfoOtherAsset_RealState(_this.attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('change', '.check-other-asset-blur',function(event){
		let _this = $(this);
		let value_attr = $.trim(_this.val());
		// let value_attr = _this.is(':checked') ? 1 : 0;
	    
	    // if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row 		= _this.closest(".item-other-asset");
	    let employer_id = row.find("input[name='other_asset_id']").val();

	    updateInfoOtherAsset_RealState(_this.attr('id'), value_attr, employer_id);

	})

	jQuery(document).on('blur keydown change', '.input-business-engage-e-commerce-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-engage-e-commerce");        
        var dependentId = row.find("input[name='paymentProcessor_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatePaymentProcessor_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur keydown change', '.input-business-accept-credit-card-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-accept-credit-card");        
        var dependentId = row.find("input[name='creditCard_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updateCreditCard_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur keydown change', '.input-business-have-any-bank-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-have-any-bank");        
        var dependentId = row.find("input[name='businessBankAccount_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updateBusinessBank_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur keydown change', '.input-business-own-any-digital-assets-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-own-any-digital-assets");        
        var dependentId = row.find("input[name='companyDigitalAsset_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updateCompanyAssets_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur keydown change', '.input-business-have-any-account-notes-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-have-any-account-notes");        
        var dependentId = row.find("input[name='companyAccountReceivable_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyAccountReceivable_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})
	
	jQuery(document).on('blur keydown change', '.input-business-have-any-tools-equiment-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-have-any-tools-equiment");        
        var dependentId = row.find("input[name='companyToolEquipments_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyToolsEquiment_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur keydown change', '.check-business-have-any-tools-equiment-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= $(this).is(':checked') ? 1 : 0
		var row 		= $(this).closest(".item-business-have-any-tools-equiment");        
        var dependentId = row.find("input[name='companyToolEquipments_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyToolsEquiment_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})
	

	jQuery(document).on('blur keydown change', '.input-business-have-any-intangible-assets-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-business-have-any-intangible-assets");        
        var dependentId = row.find("input[name='companyIntangibleAsset_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyIntamgibleAsset_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})
	//

	jQuery(document).on('blur change', '.change-income-expense-period-check',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		// var value_attr 	= _this.val(); 
		var value_attr 	= $(this).is(':checked') ? 1 : 0
		// var row 		= $(this).closest(".item-business-have-any-intangible-assets");        
        var dependentId = $("input[name='incomeExpensePeriods_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyIncomeExpense_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})


	jQuery(document).on('blur change', '.input-income-expense-period-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		// var row 		= $(this).closest(".item-business-have-any-intangible-assets");        
        var dependentId = $("input[name='incomeExpensePeriods_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);

		if ($.trim(value_attr) != "")
		{
				
			updatecompanyIncomeExpense_SelfEmployer(id_attr, value_attr, dependentId);  
		}

	})

	jQuery(document).on('blur change', '.input-433a-self-employed-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
        var dependentId = $("input[name='bussines_client_id']").val(); 

		if ($.trim(value_attr) != "")
		{
			updateBusinessClient_self(id_attr, value_attr, dependentId);  
		}
	})

	jQuery(document).on('blur change', '.input-433a-self-employed-check',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		
		var value_attr 	= $(this).is(':checked') ? 1 : 0
        var dependentId = $("input[name='bussines_client_id']").val(); 

		if ($.trim(value_attr) != "")
		{
			updateBusinessClient_self(id_attr, value_attr, dependentId);  
		}
	})
	jQuery(document).on('blur change keydown', '.input-433a-income-expense-blur',function(event)
	{
		let value_attr = $.trim($(this).val());
	    
	    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

	    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
	    if (event.type === 'keydown' && event.which !== 13) return;

	    let row = $(this).closest(".item-433a-income-expense");
	    let employer_id = row.find("input[name='income_expense_id']").val();

	    update433a_income_expense($(this).attr('name'), value_attr, employer_id);
	})

	/* UPDATE INFO EMPLOYER*/
	function updateInfoEmployerClient(id_attr, value_attr,id)
	{
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('employments.update', ':id')}}".replace(':id', id), 
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

	/* UPDATE INFO EMPLOYER SPOUSE*/
	function updateInfoEmployerSpouseClient(id_attr, value_attr,id)
	{
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('employments_spouse.update', ':id')}}".replace(':id', id), 
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

	/*UPDATE INFO OTHER BUSINESS PERSO-EMP*/
	function updateInfoOtherBusinessClient_personalEmp(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('business_interests.update', ':id')}}".replace(':id', id), 
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

	/*UPDATE INFO PARTY LAWSUIT PERSONAL FINANCIAL*/
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

	function updateInfoLawsuit_irs_otherFinancial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('lawsuit_irs.update', ':id')}}".replace(':id', id), 
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

	function updateInfoTaxPayer_bankruptcy_Financial(id_attr, value_attr,id) {
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

	function updateInfoTaxPayer_bankruptcyBeneficiaryTrust_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('beneficiaryinsurance.update', ':id')}}".replace(':id', id), 
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

	function updateInfoTrustFund_Financial(id_attr, value_attr,id) {
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

	function updateInfoTrusteFiduciary_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('trusteer.update', ':id')}}".replace(':id', id), 
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

	function updateInfoSafeDeposit_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('SafeDepositBox.update', ':id')}}".replace(':id', id), 
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

	function updateInfoTaxPayerLiveOutside6_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('livedAbroad.update', ':id')}}".replace(':id', id), 
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

	function updateInfoAssetAbrooad_Financial(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('assetAbroad.update', ':id')}}".replace(':id', id), 
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


	function updateInfoBanckAccount_BanckInvestment(id_attr, value_attr,id) {
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


	function updateInfoInvestmentAccount_BankInvestment(id_attr, value_attr,id) {
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
	
	function updateInfoDigitalAssets_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('digitalAssets.update', ':id')}}".replace(':id', id), 
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


	function updateInfoRetirementAccount_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('retirementAccounts.update', ':id')}}".replace(':id', id), 
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

	function updateInfoCreditAccount_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('creditAccounts.update', ':id')}}".replace(':id', id), 
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


	function updateInfoLifeInsurance_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('lifeInsurances.update', ':id')}}".replace(':id', id), 
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

	function updateInfoAssetTransfer_BankInvestment(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('assetTransfers.update', ':id')}}".replace(':id', id), 
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

	function updateInfoPropertyReal_RealState(id_attr, value_attr,id) {
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

	function updateInfoPropertySales_RealState(id_attr, value_attr,id) {
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

	function updateInfoAnyVehicles_RealState(id_attr, value_attr,id) {
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

	function updateInfoOtherAsset_RealState(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('otherAssets.update', ':id')}}".replace(':id', id), 
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

	function updateConditionQuestionByClient(_value, _name) {
		var id = $("#client_idx").val();
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.update_info_question', ':id')}}".replace(':id', id), 
	            type: 'put',
	            data: {name:_name, value : _value},
	            success: function (r) {
	            	toast_msg(r.msg, r.type, r.title);
	            },
	            error: function (error) {
	                // console.log(error.responseJSON.message);
	                toast_msg(error.responseJSON.message, "error", "Warning");
	            },
	        });
	}

	function updatePaymentProcessor_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('paymentProcessor.update', ':id')}}".replace(':id', id), 
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

	function updateCreditCard_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('creditCards.update', ':id')}}".replace(':id', id), 
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

	function updateBusinessBank_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('businessBanksAccount.update', ':id')}}".replace(':id', id), 
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

	function updateCompanyAssets_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('companyDigitalAssets.update', ':id')}}".replace(':id', id), 
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

	function updatecompanyAccountReceivable_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('companyAccountReceivable.update', ':id')}}".replace(':id', id), 
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

	function updatecompanyToolsEquiment_SelfEmployer(id_attr, value_attr,id) {
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

	function updatecompanyIntamgibleAsset_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('companyIntangibleAssets.update', ':id')}}".replace(':id', id), 
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

	function updatecompanyIncomeExpense_SelfEmployer(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('incomeExpensePeriod.update', ':id')}}".replace(':id', id), 
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

	function updateBusinessClient_self(id_attr, value_attr,id) {
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.update_info_question', ':id')}}".replace(':id', id), 
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

	function update433a_income_expense(id_attr, value_attr,id) {
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



	

	jQuery(document).on('keyup', '.income-calculate',function(event){
			incomeCalculate();  
	})

	jQuery(document).on('keyup', '.expense-calculate',function(event){
			expenseCalculate();  
	})


	jQuery(document).on('keyup', '.calculate-food',function(event){
			calculateTotal('calculate-food','item-35');  
	})

	jQuery(document).on('keyup', '.calculate-housing',function(event){
			calculateTotal('calculate-housing','item-36');  
	})

	jQuery(document).on('keyup', '.calculate-vehicle-owe',function(event){
			calculateTotal('calculate-vehicle-owe','item-37');  
	})

	jQuery(document).on('keyup', '.calculate-vehicle-operating',function(event){
			calculateTotal('calculate-vehicle-operating','item-38');  
	})

	jQuery(document).on('keyup', '.calculate-public-transport',function(event){
			calculateTotal('calculate-public-transport','item-39');  
	})

	jQuery(document).on('keyup', '.calculate-health-insurance',function(event){
			calculateTotal('calculate-health-insurance','item-40');  
	})

	jQuery(document).on('keyup', '.calculate-out-of-pocket',function(event){
			calculateTotal('calculate-out-of-pocket','item-41');  
	})

	jQuery(document).on('keyup', '.calculate-court-ordered-pay',function(event){
			calculateTotal('calculate-court-ordered-pay','item-42');  
	})

	jQuery(document).on('keyup', '.calculate-child-dependend',function(event){
			calculateTotal('calculate-child-dependend','item-43');  
	})

	jQuery(document).on('keyup', '.calculate-life-insurance',function(event){
			calculateTotal('calculate-life-insurance','item-44');  
	})

	jQuery(document).on('keyup', '.calculate-current-year',function(event){
			calculateTotal('calculate-current-year','item-45');  
	})

	jQuery(document).on('keyup', '.calculate-secured-deb',function(event){
			calculateTotal('calculate-secured-deb','item-46');  
	})

	jQuery(document).on('keyup', '.calculate-delinquent-tax',function(event){
			calculateTotal('calculate-delinquent-tax','item-47');  
	})

	jQuery(document).on('keyup', '.calculate-other-expense',function(event){
			
			calculateTotal('calculate-other-expense','item-48');  
	})


	function calculateTotal(class_input, class_parent)
	{	var total = 0;
		$("."+class_input).each(function( index )
		{
		  	total += ( $( this ).val() == "") ? 0 :  parseFloat($( this ).val());
		});

		
		$("."+class_parent).find('button .text-end').html(total.toFixed(2));
	}


	function incomeCalculate()
	{
		var total = 0;
		$(".income-calculate").each(function( index )
		{
		  	total += ( $( this ).val() == "") ? 0 :  parseFloat($( this ).val());
		});
		$("#total_income_nn").val(total);
		calculateTableTotal();
	}

	function expenseCalculate()
	{
		var total = 0;
		$(".expense-calculate").each(function( index )
		{
		  	total += ( $( this ).val() == "") ? 0 :  parseFloat($( this ).val());
		});

		console.log("expense: "+total);
		$("#total_expense_nn").val(total);
		calculateTableTotal();
	}




	calculateTableTotal();

	function calculateTableTotal()
	{
		let incomeVal  = $("#total_income_nn").val().replace(/[^0-9.-]+/g, '');
		let expenseVal = $("#total_expense_nn").val().replace(/[^0-9.-]+/g, '');

		let total_income_nn = parseFloat(incomeVal) || 0;
		let total_expense_nn = parseFloat(expenseVal) || 0;
		let diff = total_income_nn - total_expense_nn;

		$(".txt-income-total").text(total_income_nn.toFixed(2));
		$(".total_income_span").text(total_income_nn.toFixed(2));
		$(".txt-expense-total").text(total_expense_nn.toFixed(2));
		$(".txt-net-monthly").text(diff.toFixed(2))
	}
	
</script>