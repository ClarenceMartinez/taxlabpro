<script>

	jQuery(document).on('click', '#btn-show-form',function(e){
    	e.preventDefault();
    	var _this 		= $(this);
    	var formType 	= _this.attr('data-form-type');
    		_this.addClass('d-none');
    		$("#btn-show-profile").removeClass('d-none');
    		$("#tabprofileclient").addClass('d-none'); 	

    		if (formType == '433A')
    		{
    			$("#tabform433a").removeClass('d-none'); 	

    		}  else if (formType == '433B')
    		{
    			$("#tabform433b").removeClass('d-none'); 	
    		}


	})

	
	jQuery(document).on('click', '#btn-show-profile',function(e){
    	e.preventDefault();
    	var _this 		= $(this);
    	var formType 	= _this.attr('data-form-type');
    		_this.addClass('d-none');
    		$("#btn-show-form").removeClass('d-none');  
    		$("#tabprofileclient").removeClass('d-none'); 

    		if (formType == '433A')
    		{
    			$("#tabform433a").addClass('d-none'); 	

    		}  else if (formType == '433B')
    		{
    			$("#tabform433b").addClass('d-none'); 	
    		}	  	
	})






jQuery(document).on('blur', '.blur-form-user-update',function(e)
{
  var _this = $(this);
  var client_id = $("#form-add-new-record").find('#id').val(); 
  var name      = _this.attr('name'); 
  var _value    = _this.val(); 

  var id = $("#client_idx").val();
    $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{route('clients.update_info_question', ':id')}}".replace(':id', client_id), 
          type: 'put',
          data: {name:name, value : _value},
          success: function (r) {
            toast_msg(r.msg, r.type, r.title);
            initializeDatatable();
          },
          error: function (error) {
              // console.log(error.responseJSON.message);
              toast_msg(error.responseJSON.message, "error", "Warning");
          },
      });
})


jQuery(document).on('click', '.edit-client',function(e){

var _this = $(this);
    var id  = _this.attr('data-idx');
    // dt_basic.row($(this).parents('tr')).remove().draw();
    const formAddNewRecord = document.getElementById('form-add-new-record');

      setTimeout(() => {
          const editClient = document.querySelector('.edit-client'),
          offCanvasElement = document.querySelector('#add-new-record');

        var form = $("#form-add-new-record");
        $("#add-new-record").find('.offcanvas-header h5').html('Update Client');
        form.find('button[type="submit"]').text('Update');
        form.find('button[type="submit"]').attr('id', 'btn-update');

        form.find('input').addClass('blur-form-user-update');
        form.find('select').addClass('blur-form-user-update');

        form.find("#footer-button").addClass('d-none');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
          url: "{{ route('clients.edit', ':id') }}".replace(':id', id), 
            type: 'put',
            data: {},
            success: function (r) {
                if (r.status == true)
                {
                  var data = r.data;
                  form.find("#id").val(data.id);
                  form.find("#first_name").val(data.first_name);
                  form.find("#mi").val(data.mi);
                  form.find("#last_name").val(data.last_name);
                  form.find("#ssn").val(data.ssn);
                  form.find("#date_birth").val(data.date_birdth);
                  form.find("#dl").val(data.dl);
                  form.find("#dl_state").val(data.dl_state); //select
                  form.find("#has_passport").val(data.has_passport); //select
                  form.find("#client_reference").val(data.client_reference);
                  form.find("#saludation_for_letter").val(data.saludation_for_letter);
                  form.find("#type_address-home").val(data.type_address);
                  form.find("#address_1").val(data.address_1);
                  form.find("#address_2").val(data.address_2);
                  form.find("#city").val(data.city);
                  form.find("#state").val(data.state);
                  form.find("#zipcode").val(data.zipcode);
                  form.find("#country").val(data.country);
                  form.find("#m_address_1").val(data.state);
                  form.find("#m_address_2").val(data.state);
                  form.find("select#form_type").val(data.form_type).change();
                  form.find("#spouse_first_name").val(data.spouse_first_name);
                  form.find("#spouse_mi").val(data.spouse_mi);
                  form.find("#spouse_last_name").val(data.spouse_last_name);
                  form.find("#spouse_ssn").val(data.spouse_ssn);
                  form.find("#spouse_date_birdth").val(data.spouse_date_birdth);
                  form.find("#spouse_dl").val(data.spouse_dl);
                  form.find("select#spouse_dl_state").val(data.spouse_dl_state).change();
                  form.find("select#spouse_has_passport").val(data.spouse_has_passport).change();
                  form.find("#spouse_saludation_for_letter").val(data.spouse_saludation_for_letter);
                  form.find("#phone_home").val(data.phone_home);
                  form.find("#cell_home").val(data.cell_home);
                  form.find("#preferred").val(data.fax_work);
                  form.find("#fax_home").val(data.fax_home);
                  form.find("#phone_work").val(data.phone_work);
                  form.find("#spouse_phone_home").val(data.spouse_phone_home);
                  form.find("#spouse_cell_home").val(data.spouse_cell_home);
                  form.find("#spouse_fax_home").val(data.spouse_fax_home);
                  form.find("#spouse_phone_work").val(data.spouse_phone_work);
                  form.find("#spouse_cell_work").val(data.spouse_cell_work);
                  form.find("#spouse_preferred").val(data.spouse_fax_work);
                  form.find("#cell_work").val(data.cell_work);
                  form.find("#tax_payer_email").val(data.tax_payer_email);
                  form.find("#spouse_email").val(data.spouse_email);
                  form.find('input[name="marital_status"]').prop('checked', false);

                  form.find('input[name="marital_status"][value="' + data.marital_status + '"]')
                      .prop('checked', true)
                      .trigger('click');

                }
                // toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                // console.log("error");
                // toast_msg(responseJSON.message, 'error', "Aviso");
            },
        });
            console.log("editClient: "+editClient);
          // To open offCanvas, to add new record
          if (editClient) {
              offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
              offCanvasEl.show();
            // });
          }

        }, 200);


})



jQuery(document).on('click', '.is_married',function(e)
{ 
  var _this   = $(this);
  var value   = _this.val();
  var content = $(".info-content-married");

  //1 = married; 2=unmarried
  if (value == 1)
  {
    content.removeClass('d-none').hide()
      .stop(true, true)
      .slideDown(300);
  } else 
  {
    content.stop(true, true)
      .slideUp(300, function() {
        $(this).addClass('d-none');
        });
  }

})



jQuery(document).on('click', '#form-add-new-record #btn-update',function(e)
{
      var _thisButton = $(this);
          _thisButton.html('Prosesing...');
          _thisButton.attr('disabled','disabled');


      var form  = 'form-add-new-record'; //$(this).attr('data-form');
      var id    = $("#"+form).find("#id").val();
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('clients.update', ':id') }}".replace(':id', id), 
            type: 'put',
            data: $("#"+form).serialize(),
            success: function (r) {

                _thisButton.html('Update');
                _thisButton.removeAttr('disabled');
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  setTimeout(function(){
                      window.location.reload();
                    }, 2000);

                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.message, 'error', "Aviso");

                _thisButton.html('Update');
                _thisButton.removeAttr('disabled');
            },
        });
})


    

</script>