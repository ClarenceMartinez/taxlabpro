<script>
const editor = new toastui.Editor({
        el: document.querySelector('#descriptionEditor'),
        height: '300px',
        initialEditType: 'wysiwyg', // o 'markdown'
        previewStyle: 'vertical',
        toolbarItems: [
            ['heading', 'bold', 'italic', 'strike'],
            ['hr', 'quote'],
            ['ul', 'ol', 'task'],
            ['link', 'code'],
            ['scrollSync']
        ]
    });

    // Al enviar el formulario, pasa el contenido al input hidden
    document.querySelector('#btnSaveTask').addEventListener('click', function () {
        document.querySelector('#descriptionInput').value = editor.getHTML(); // o getMarkdown()
    });


    const editor2 = new toastui.Editor({
        el: document.querySelector('#descriptionEditor2'),
        height: '300px',
        initialEditType: 'wysiwyg', // o 'markdown'
        previewStyle: 'vertical',
        toolbarItems: [
            ['heading', 'bold', 'italic', 'strike'],
            ['hr', 'quote'],
            ['ul', 'ol', 'task'],
            ['link', 'code'],
            ['scrollSync']
        ]
    });

    // Al enviar el formulario, pasa el contenido al input hidden
    document.querySelector('#btnUpdateTask').addEventListener('click', function () {
        document.querySelector('#descriptionInput2').value = editor2.getHTML(); // o getMarkdown()
    });
</script>