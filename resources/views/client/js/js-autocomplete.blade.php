<script>
	jQuery(document).on('keydown', '#client_search',function(event)
	{	
		var _this = $(this);
		// console.log(_this.val());
	})

	$(function() {
	    $("#client_search").autocomplete({
	      source: function(request, response) {
	        $.ajax({
	          url: "{{ route('clients.search') }}",
	          data: {
	            term: request.term
	          },
	          success: function(data) {
	            // data debería ser un array de strings o de objetos con 'label' y 'value'
	            response(data);
	          }
	        });
	      },
	      minLength: 2,
	      appendTo: "#profileUser", // Agrega el menú dentro del modal
	      select: function(event, ui) {
	      	event.preventDefault();

		    // Limpia el campo
		    $(this).val('');

	        // Lógica al seleccionar un cliente
	        // window.location.href = "/clients/detail/" + ui.item.value;
	        let url = "{{ route('clients.detail', ':id') }}";
			  url = url.replace(':id', ui.item.value);

			  window.open(url, '_blank');
	      }
	    });
	  });


	jQuery(document).on('click', '.change-form-type-client',function(e)
	{
	  var _this = $(this);
	  var client_id = _this.attr('data-idx'); 
	  var _value    = _this.attr('data-type'); 

	  var id = $("#client_idx").val();
	    $.ajax({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          },
	          url: "{{route('clients.update_info_question', ':id')}}".replace(':id', client_id), 
	          type: 'put',
	          data: {name:'form_type', value : _value},
	          success: function (r) {
	            toast_msg(r.msg, r.type, r.title);
	            location.reload();
	          },
	          error: function (error) {
	              // console.log(error.responseJSON.message);
	              toast_msg(error.responseJSON.message, "error", "Warning");
	          },
	      });
	})
</script>