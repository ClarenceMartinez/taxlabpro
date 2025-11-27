<script>
	$(document).ready(function() {
    $('.input-433b-check-toogle').change(function() {
      	console.log("accionar");
      const $contenedor = $(this).closest('.mb-3').find('.contenedor');
      if ($(this).val().toLowerCase() === 'yes') {
      	console.log("accionar yes");
        $contenedor.removeClass('d-none');
      } else {
        $contenedor.addClass('d-none');
      }

      var _this = $(this);
      updateConditionQuestionByClient433b(_this.val(), _this.attr('name'));

    });
  });


	function updateConditionQuestionByClient433b(_value, _name) {
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
</script>