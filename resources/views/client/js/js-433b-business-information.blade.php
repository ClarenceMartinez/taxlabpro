<script type="text/javascript">
jQuery(document).on('keydown blur change', '.input-433b-information-client-blur',function(e){
	let _this 		= $(this);
	let value_attr 	= $.trim(_this.val());

	// console.log(_this.attr('type'));
	if (_this.attr('type') == 'checkbox')
	{
    	value_attr = $(this).is(':checked') ? 1 : 0;
	}
	    
    if (value_attr === "") return; // Si el valor está vacío, no hacer nada

    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
    if (event.type === 'keydown' && event.which !== 13) return;


    updateConditionQuestionByClient(value_attr, _this.attr('name'));
})



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




//input-433b-ecommerceprocesor-blur
jQuery(document).on('keydown blur', '.input-433b-ecommerceprocesor-blur',function(e){
	let _this 		= $(this);
	let value_attr 	= $.trim(_this.val());
	    
    if (value_attr === "") return; // Si el valor está vacío, no hacer nada
    // Si es un evento "keydown", solo ejecutar si presionaron "Enter"
    if (event.type === 'keydown' && event.which !== 13) return;

    var row 		= $(this).closest(".item-433b-ecommerceprocesor");      
    var dependentId = row.find("input[name='ecommerceProcessor_id']").val(); 
    update433b_businessinfo_ecommerceprocesor(value_attr, _this.attr('name'), dependentId);
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


jQuery(document).on('blur keydown change', '.input-433b-partner-office-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-433b-partners_officers");        
        var dependentId = row.find("input[name='partnersOfficer_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
        // console.log("Dependent ID:", dependentId);
		update433b_businessinfo_partnerOffice(id_attr, value_attr, dependentId);  
	})



jQuery(document).on('blur keydown change', '.input-433b-other-business-affiliation-blur',function(event){

		var _this 		= $(this);
		var id_attr 	= _this.attr('id');
		var value_attr 	= _this.val(); 
		var row 		= $(this).closest(".item-433b-other-business-affiliation");        
        var dependentId = row.find("input[name='businessAffiliation_id']").val(); // Buscar el input hidden con name="dependent_id" dentro de ese bloque
		update433b_businessinfo_OtherBusiness(id_attr, value_attr, dependentId);  
	})





function update433b_businessinfo_ecommerceprocesor(_value, _name, id) {
	// var id = $("#client_idx").val();
	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ecommerceprocessor.update', ':id')}}".replace(':id', id), 
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




function update433b_businessinfo_partnerOffice(id_attr, value_attr,id) {
	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('partnerOffice.update', ':id')}}".replace(':id', id), 
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

function update433b_businessinfo_OtherBusiness(id_attr, value_attr,id) {
	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('businessAffiliation.update', ':id')}}".replace(':id', id), 
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