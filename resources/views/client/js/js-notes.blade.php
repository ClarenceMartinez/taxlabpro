<script>
	function deleteNote(id, client_id) {
    if (confirm('¿Eliminar esta nota?')) {
        $.ajax({
            url: "{{ route('clients.delete_notes', ':id') }}".replace(':id', id), 
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            datatype:'json',
            success: function(r) {
                $('#note-' + id).remove();
                toast_msg(r.message, 'success'); // opcional
                	if (r.status)
                	{
	                 	var notesList = '';
						$.each(r.data, function( index, value )
						{
						 	notesList += value;
						});
						$("#notes-list").html(notesList);
						$(".notes-list-container").html(notesList);

						profileClient(client_id);
                	}
            },
            error: function() {
                alert('Error al eliminar la nota');
            }
        });
    }
}
</script>