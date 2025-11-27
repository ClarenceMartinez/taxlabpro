<div class="card-body">
  <div class="notes-list-container perfect-scrollbar mb-3 pt-2">
      {{-- Note items --}}
      
      
  </div>
  <div class="chat-input-group input-group input-group-sm">
    <form id="frm-add-notes" name="frm-add-notes" method="post"  style="display: inline-flex;width: 100%;">
      <input type="hidden" name="client_id" id="client_id" value="0">
      <!-- <input type="text" class="form-control fs-xs" id="note" name="note" placeholder="Add a note..."> -->
      <textarea name="note" id="note" class="form-control fs-xs noteTextarea" placeholder="Add a note..."></textarea>
      <button class="btn btn-primary" id="btnNewNote" type="button" title="Add Note"> <i class="ri-send-plane-2-line ri-small"></i> </button>
      
    </form>
  </div>
</div>


<style>
/* --- Notes Section General Styling --- */

/* Opcional: Si .card-body necesita padding general */
/* .card-body { padding: 20px; background-color: #fdfdfd; } */

/* Container for the list of notes */
.notes-list-container {
    max-height: 450px; /* Ajusta según la altura deseada para el scroll */
    overflow-y: auto;
    padding-right: 5px; /* Pequeño espacio para la barra de scroll */
}

/* Individual note item styling */
.note-item {
    position: relative;
    padding: 15px;
    margin-bottom: 12px; /* Esto crea el espacio que antes daba border-bottom */
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    background-color: #fff;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}

.note-item:last-child {
    margin-bottom: 0;
}

.note-item:hover {
    background-color: #f8ce83; /* Tu color de hover especificado */
    box-shadow: 0 2px 5px rgba(0,0,0,0.08);
}

/* Note content paragraph - este es el contenedor del HTML renderizado */
.note-item p {
    margin-bottom: 0; /* Ya lo tenías, es bueno */
    line-height: 1.65; /* Legibilidad mejorada */
    color: #333;
    word-wrap: break-word; /* Para evitar desbordamientos de palabras largas */
}

/* --- Markdown Content Styling (dentro de .note-item p) --- */
.note-item p h1,
.note-item p h2,
.note-item p h3,
.note-item p h4,
.note-item p h5,
.note-item p h6 {
    margin-top: 1em; /* Más espacio antes de los encabezados */
    margin-bottom: 0.5em;
    font-weight: 600;
    line-height: 1.3;
    color: #2c3e50; /* Azul oscuro desaturado para encabezados */
}
.note-item p h1 { font-size: 1.7em; }
.note-item p h2 { font-size: 1.5em; }
.note-item p h3 { font-size: 1.3em; }

.note-item p strong, .note-item p b {
    font-weight: 600;
}
.note-item p em, .note-item p i {
    font-style: italic;
}
.note-item p del, .note-item p s, .note-item p strike { /* Para texto tachado */
    text-decoration: line-through;
}

.note-item p code {
    background-color: #f0f2f5;
    padding: 0.2em 0.5em;
    border-radius: 4px;
    font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
    font-size: 0.9em;
    color: #c0392b; /* Color distintivo para código en línea */
    word-break: break-all; /* Para URLs largas en code */
}

.note-item p pre {
    background-color: #2d3748; /* Fondo oscuro para bloques de código */
    color: #e2e8f0; /* Color de texto claro para fondo oscuro */
    border: 1px solid #2d3748;
    border-radius: 6px;
    padding: 16px;
    overflow-x: auto; /* Scroll horizontal para bloques de código largos */
    font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
    font-size: 0.9em;
    line-height: 1.5;
    margin: 15px 0;
}
.note-item p pre code { /* Reset para 'code' dentro de 'pre' */
    background-color: transparent;
    padding: 0;
    border: none;
    font-size: 1em; /* Hereda tamaño de 'pre' */
    color: inherit; /* Hereda color de 'pre' */
    word-break: normal; /* Normal para bloques de código */
}

.note-item p a {
    color: #7e57c2; /* Morado para coincidir con tema UI */
    text-decoration: none;
    font-weight: 500;
}
.note-item p a:hover {
    text-decoration: underline;
    color: #5e35b1; /* Morado más oscuro al pasar el mouse */
}

.note-item p ul,
.note-item p ol {
    margin-top: 0.5em;
    margin-bottom: 1em; /* Más espacio después de las listas */
    padding-left: 25px; /* Indentación estándar */
}
.note-item p li {
    margin-bottom: 0.5em;
}
.note-item p ul li::marker { /* Estilo de viñetas (navegadores modernos) */
    color: #7e57c2;
}
.note-item p ol {
    list-style-type: decimal;
}
.note-item p ol li::marker {
    color: #7e57c2;
}


.note-item p blockquote {
    border-left: 4px solid #9575cd; /* Acento morado para citas */
    padding-left: 15px;
    margin: 1em 0;
    color: #555;
    font-style: italic;
}
.note-item p blockquote p { /* Párrafos dentro de blockquotes */
    margin-bottom: 0.5em;
    color: inherit; /* Heredar el color #555 de la blockquote */
}


.note-item p img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-top: 8px;
    margin-bottom: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: block; /* Para que margin auto funcione si se quiere centrar */
}

.note-item p hr { /* Línea horizontal */
    border: 0;
    height: 1px;
    background-color: #e0e0e0;
    margin: 20px 0;
}

/* Timestamp and author information */
.note-item small {
    display: block;
    margin-top: 12px;
    color: #888;
    font-size: 0.875em;
}

/* Delete button styling */
.note-item .btn.text-danger {
    font-size: 0.9rem;
    padding: 0.2rem 0.4rem;
    line-height: 1;
    transition: color 0.2s ease, transform 0.2s ease, background-color 0.2s ease;
    border-radius: 4px;
}
.note-item .btn.text-danger:hover {
    color: #fff !important;
    background-color: #e74c3c !important;
    transform: scale(1.05);
}
.note-item .btn.text-danger i {
    vertical-align: middle;
}


/* --- Chat Input Area Styling --- */
.chat-input-group {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
}

.chat-input-group #frm-add-notes {
    display: flex;
    width: 100%;
    align-items: stretch;
}

.chat-input-group textarea.noteTextarea {
    flex-grow: 1;
    border: 1px solid #ccc;
    border-right: none;
    border-radius: 5px 0 0 5px;
    padding: 10px 12px;
    font-size: 1rem;
    min-height: 42px;
    resize: vertical;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    box-shadow: none;
}
.chat-input-group textarea.noteTextarea::placeholder {
    color: #aaa;
}
.chat-input-group textarea.noteTextarea:focus {
    border-color: #7e57c2;
    box-shadow: 0 0 0 0.2rem rgba(126, 87, 194, 0.2);
    outline: 0;
    z-index: 2;
}

.chat-input-group button#btnNewNote {
    background-color: #7e57c2;
    border: 1px solid #7e57c2;
    color: white;
    border-radius: 0 5px 5px 0;
    padding: 0 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s ease, border-color 0.2s ease;
    flex-shrink: 0;
    cursor: pointer;
}
.chat-input-group button#btnNewNote:hover {
    background-color: #673ab7;
    border-color: #673ab7;
}
.chat-input-group button#btnNewNote i {
    font-size: 1.3em;
    line-height: 1;
}

/* --- Mention Styling (from your existing CSS, slightly enhanced) --- */
.mention { /* Si usas mentions con tribute.js */
    color: #0077b5;
    font-weight: bold;
    background-color: #e0f2f7;
    padding: 0.15em 0.35em;
    border-radius: 4px;
}

/* --- Perfect Scrollbar Customization (basic) --- */
/* Asumiendo que tu contenedor tiene la clase perfect-scrollbar */
.perfect-scrollbar .ps__rail-y {
    background-color: transparent;
    opacity: 0;
    width: 10px;
    transition: opacity 0.2s ease;
}
.perfect-scrollbar:hover .ps__rail-y,
.perfect-scrollbar.ps--scrolling-y .ps__rail-y { /* Mostrar también durante el scroll */
    opacity: 1;
}
.perfect-scrollbar .ps__thumb-y {
    background-color: #b0b0b0;
    border-radius: 5px;
    width: 6px;
    right: 2px;
}
.perfect-scrollbar .ps__rail-y:hover .ps__thumb-y,
.perfect-scrollbar .ps__rail-y.ps--clicking .ps__thumb-y {
    background-color: #888;
    width: 8px;
    right: 1px;
}
</style>