<script>
	jQuery(document).on('click', '.btn-modal-services',function(event){
		var _this 	= $(this);
		var id 		= _this.attr('data-idx');
		$("#client_service_id").val(id);

		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clientService.client', ':id')}}".replace(':id', id), 
	            type: 'get',
	            success: function (r) {
	            	toast_msg(r.msg, r.type, r.title);
	            	if (r.status)
	            	{
	            		var table = ``;
	            		$.each(r.data, function( index, value ) {
	            			var checked = (value.activo == 1) ? 'checked' : '';
						  	table += `<tr>
					        				<td><input type="checkbox" class="form-check-input service-list"  name="service_id[]" id="service_id" value="`+value.id+`" `+checked+`   ></td>
					        				<td>`+value.service_name+`</td>
					        			</tr>`;
						});

						$("#catalog-service table tbody").html(table);
	            	}
	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });



	})

	jQuery(document).on('click', '.btn-modal-asign-user-to-client',function(event)
	{
		var _this 		= $(this);
		var client_id 	= _this.attr('data-client');
		var user_id 	= _this.attr('data-user');

		$(".user-list").prop('checked', false);

		$("#modal-user-to-client").find("#client_idxt").val(client_id);

		$(".user-list").each(function(index){
			if ($(this).val() == user_id) {
	            $(this).prop('checked', true);
	        } else {
	            $(this).prop('checked', false);
	        }

		});
	})

	jQuery(document).on('click', '#btnSaveServiceClient',function(event){
		var id = $("#client_service_id").val();
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clientService.update', ':id')}}".replace(':id', id), 
	            type: 'put',
	            data: $("#frmServicesClient").serialize(),
	            success: function (r) {
	            	toast_msg(r.msg, r.type, r.title);
	            	$('#catalog-service').modal('hide');

	            	initializeDatatable();
	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
	})


	jQuery(document).on('click', '#btnSaveUserToClient',function(event){
		var client_id = $("#client_idxt").val();
		var user_idxt = $('input[name="user_idxt"]:checked').val();
		$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.asigment_to_user')}}",
	            type: 'post',
	            data: $("#frmAsignClientToUser").serialize(),
	            // data: {user:user_idxt, client:client_id},
	            success: function (r) {
	            	toast_msg(r.msg, r.type, r.title);
	            	$('#modal-user-to-client').modal('hide');

	            	initializeDatatable();
	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
	})
</script>