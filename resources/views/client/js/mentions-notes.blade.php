<script>
	const tribute = new Tribute({
        values: function (text, cb) {
            fetch(`/users/user_mentions?q=${encodeURIComponent(text)}`)
                .then(res => res.json())
                .then(data => cb(data));
        },
        selectTemplate: function (item) {
            return '@' + item.original.value;
            // return `@[[${item.original.value}|${item.original.id}]]`;
        },
        displayTemplate: function (item) {
	        return `@${item.original.value}`; // Vista amigable
	    },
    });

    document.querySelectorAll('.noteTextarea').forEach(el => tribute.attach(el));

</script>