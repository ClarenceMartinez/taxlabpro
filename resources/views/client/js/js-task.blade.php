<script>
	//list-client-card
jQuery(document).on('click', '.open-modal-task',function(e)
{
	const $parentCard = $(this).closest('.list-client-card');

    // Opcional: obtener un data-id o cualquier atributo
    const clientId = $parentCard.data('id'); // si usas <div class="list-client-card" data-id="123">

    // console.log('Contenedor padre:', $parentCard);
    // console.log('ID del cliente:', clientId);

    // Puedes ahora usar clientId para pasarlo al modal
    $('#frmnewTask input[name="client_id"]').val(clientId); // por ejemplo



})
jQuery(document).on('click', '#btnSaveTask',function(e)
{
    var _thisButton = $(this);
          _thisButton.html('Prosesing...');
          _thisButton.attr('disabled','disabled');

    var form  = 'frmnewTask'; //$(this).attr('data-form');
      var id    = $("#"+form).find("#client_id").val();


          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('task.store') }}", 
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {

                _thisButton.html('Save');
                _thisButton.removeAttr('disabled');
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  setTimeout(function(){
                      // window.location.reload();
                      profileClient(id);
                    }, 2000);



                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.msg, 'error', "Aviso");

                _thisButton.html('Save');
                _thisButton.removeAttr('disabled');
            },
        });

})


jQuery(document).on('click', '.btnEditTask',function(e)
{
	var _this 	= $(this);
	var id 		= _this.attr('data-task');
	var form 	= $("#frmUpdateTask");



	$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('task.edit', ':id') }}".replace(':id', id), 
            type: 'put',
            success: function (r) {

                if (r.status == true)
                {
                  // console.log("hola");
                  var data = r.data;
                  form.find('#idx').val(data.id);
                  form.find('#client_id').val(data.client_id);
                  form.find('[name="preset_id"]').val(data.preset_id);
                  form.find('[name="dueDate"]').val(data.due_date);
                  editor2.setHTML(data.description || '');



                }
                // toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.msg, 'error', "Aviso");

            },
        });



})



jQuery(document).on('click', '#btnUpdateTask',function(e)
{
    var _thisButton = $(this);
          _thisButton.html('Prosesing...');
          _thisButton.attr('disabled','disabled');

    var form  = 'frmUpdateTask'; //$(this).attr('data-form');
      var id    = $("#"+form).find("#client_id").val();


          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('task.update') }}", 
            type: 'post',
            data: $("#"+form).serialize(),
            success: function (r) {

                _thisButton.html('Save');
                _thisButton.removeAttr('disabled');
                if (r.status == true)
                {
                  $('#'+form)[0].reset();
                  $(".btn-close").click();
                  setTimeout(function(){
                      // window.location.reload();
                      profileClient(id);
                    }, 2000);



                }
                toast_msg(r.msg, r.type, r.title);

            },
            error: function (error) {
              var responseJSON = error.responseJSON;
                toast_msg(responseJSON.msg, 'error', "Aviso");

                _thisButton.html('Save');
                _thisButton.removeAttr('disabled');
            },
        });

})
</script>