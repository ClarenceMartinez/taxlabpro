<script>
	$(".profile-item-user").trigger('click');


	jQuery(document).on('click', '#frm-add-activity .btn-save',function(e)
	{
		e.preventDefault();
		var form 	= $(this).attr('data-form');
		var id 		= $("#"+form).find("#client_id").val();
		$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('clients.activities_post')}}",
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {
                	if (r.status == false)
                	{
                		toast_msg(r.msg, r.type, r.title);
                		return;
                	}
                		toast_msg(r.msg, r.type, r.title);
                		profileClient(id);
                		$('#'+form)[0].reset();
                		$("#"+form).find("#client_id").attr('value', id);

                	

            },
            error: function (error) {
                console.log("error");
            },
        });
	});
	jQuery(document).on('blur', '#frm-add-notes #note',function(e)
	{
		e.preventDefault();
		var _this = $(this).val();

		if ($.trim(_this) != "")
		{
			var form 	= 'frm-add-notes';
			var id 		= $("#"+form).find("#client_id").val();
			$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.notes_post')}}",
	            type: 'post',
	            data: $("#"+form).serialize(),
	            success: function (r) {
	                	if (r.status == false)
	                	{
	                		toast_msg(r.msg, r.type, r.title);
	                		return;
	                	}
	                		toast_msg(r.msg, r.type, r.title);
	                		profileClient(id);
	                		// $('#'+form)[0].reset();
	                		$("#"+form).find('#note').val("");
	                		$("#"+form).find("#client_id").attr('value', id);

	                	

	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
		}
	})


	jQuery(document).on('click', '#btnNewNote',function(e)
	{
		e.preventDefault();
		var _this = $(this).val();

		if ($.trim(_this) != "")
		{
			var form 	= 'frm-add-notes';
			var id 		= $("#"+form).find("#client_id").val();
			$.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.notes_post')}}",
	            type: 'post',
	            data: $("#"+form).serialize(),
	            success: function (r) {
	                	if (r.status == false)
	                	{
	                		toast_msg(r.msg, r.type, r.title);
	                		return;
	                	}
	                		toast_msg(r.msg, r.type, r.title);
	                		profileClient(id);
	                		// $('#'+form)[0].reset();
	                		$("#"+form).find('#note').val("");
	                		$("#"+form).find("#client_id").attr('value', id);

	                	

	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
		}
	})

	Dropzone.options.myDropzone = {
		init: function() {
				this.on("complete", function(file) {
				this.removeFile(file);
				console.log(file);
				// console.log("file pdff");
			})
		},
		success: function(resp){
			const r = JSON.parse(resp.xhr.response);
			var id = $("#my-dropzone").find("#client_id").val();
			// console.log("******");
			if (r.status == false)
        	{
        		toast_msg(r.msg, r.type, r.title);
        		return;
        	}
        	// console.log("holaaaaa");
        		toast_msg(r.msg, r.type, r.title);

        		profileClient(id);
        		// $("#my-dropzone").find("#client_id").attr('value', id);
		}
	}
loadProfileCLient();

function loadProfileCLient() {
	var id = $("#client_idx").val()

      

      $(".btn-asigment").attr('data-client', id);
      $("#frm-add-activity").find("#client_id").val(id);
      $("#frm-add-notes").find("#client_id").val(id);
      $("#my-dropzone").find("#client_id").val(id);
      getUserToClient(id);
      profileClient(id);
}




function getUserToClient(client_id)
{

	console.log("client: "+client_id);
	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('users.list')}}",
            data: {id: client_id},
            type: 'post',
            success: function (r) {
                if (r.status)
                {
                	var list = '';
                	$.each(r.data, function( index, value )
                  	{
                                  //client_idx
                     var btn_disabled 	= (value.client_idx == client_id) ? 'disabled' : '';
                     var btn 			= (value.client_idx == client_id) ? 'btn-primary' : 'btn-outline-primary';
                     var user_icon 		= (value.client_idx == client_id) ? 'ri-user-3-line' : 'ri-user-add-line';
                	 list += `<li class="mb-4">
                                <div class="d-flex align-items-center">
                                  <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                      <img src="../../assets/img/avatars/`+value.avatar+`.png" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div class="me-2">
                                      <h6 class="mb-1">`+value.name+`</h6>
                                      <small>`+value.company_name+`</small>
                                    </div>
                                  </div>
                                  <div class="ms-auto">

                                    <button class="btn `+btn+` btn-icon waves-effect btn-asigment `+btn_disabled+`" data-user="`+value.id+`" data-client="`+client_id+`">
                                      <i class="`+user_icon+` ri-22px"></i>
                                    </button>
                                  </div>
                                </div>
                              </li>`;
                    })

                    $("#listUserAsignClient").html(list);

                }
            },
            error: function (error) {
                console.log("error");
            }
	})

	
}

jQuery(document).on('click', '.btn-asigment',function(e)
{
  var _this   = $(this);

  if (!_this.hasClass('disabled'))
  {
    var user    = _this.attr('data-user');
    var client  = _this.attr('data-client');

      $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "{{route('clients.asigment_to_user')}}",
              type: 'post',
              // data: {user:user, client:client, _token : $("#_token").val()},
              data: $("#frmAsignClientToUser").serialize(),
              success: function (r) {
                  if (r.status)
                  {
                    var htmlx = _this.html('<i class="ri-user-3-line ri-22px"></i>');
                                _this.removeClass('btn-outline-primary');
                                _this.addClass('btn-primary');
                                _this.addClass('disabled');
                  }
                  toast_msg(r.msg, r.type, r.title);
                  getUserToClient(client);

              },
              error: function (error) {
                  console.log("error");
              },
          });
  }

})
function profileClient(id)
{
	
	  $.ajax({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{route('clients.info')}}",
	            type: 'post',
	            data: {id:id},
	            success: function (r) {
	                if (r.status)
	                {
	                  var info        = r.data.info;
	                  var activities  = r.data.activities;
	                  var notes       = r.data.notes;
	                  var files       = r.data.files;
	                  var activityLog = r.data.activityLog;
	                  var tasks 	  = r.data.tasks;
	                  if (info != null)
	                  {
		                  $("#title-client").find('#name_client').html(info.first_name+' '+info.last_name);
		                  $(".info-name").html(info.first_name+' '+info.last_name);
		                  $(".info-ssn").html(info.ssn);	                  	
		                    status = 'Inactive';
		                  if (info.estatus)
		                  {
		                    status = 'Active';
		                  }
		                  $(".info-status").html(status);
		                  $(".info-address").html(info.address_1);
		                  $(".info-cell-home").html(info.cell_home);
		                  $(".info-country").html(info.flag);
		                  $(".info-tax-payer-email").html(info.tax_payer_email);
		                  $(".info-spouse-name").html(info.spouse_first_name+' '+info.spouse_last_name);
		                  $(".info-spouse-cell").html(info.spouse_cell_home);
	                  }


	                  
	                  var activitiesList = '';
	                  $.each(activities, function( index, value )
	                  {
	                     activitiesList += value;
	                  });
	                  $("#activities-list").html(activitiesList);

	                  var notesList = '';
	                  $.each(notes, function( index, value )
	                  {
	                     notesList += value;
	                  });
	                  $("#notes-list").html(notesList);


	                  $(".notes-list-container").html(notesList);

	                  var filesList = '';
	                  $.each(files, function( index, value )
	                  {
	                     filesList += value;
	                  });
	                  $("#files-list").html(filesList);


	                  var activityLogs = '';
  	                  $.each(activityLog, function( index, value )
	                  {
	                     activityLogs += value;
	                  });
	                  $("#content-timeline-activity-log ul").html(activityLogs);


	                  var notesList = '';
  	                  $.each(tasks, function( index, value )
	                  {
	                     notesList += value;
	                  });
	                  // $("#navs-justified-tasks .list-group").html(notesList);
	                  $("#table-task-content tbody").html(notesList);



	                }

	            },
	            error: function (error) {
	                console.log("error");
	            },
	        });
	
}

//
</script>