<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="card shadow-sm" id="fileManagerContainer">
    <div class="card-body p-0">

        <!-- Toolbar Section -->
        <div class="fm-toolbar p-2 border-bottom bg-light">
            <div class="row g-2 align-items-center">
                <div> {{-- Contenedor para el selector de carpetas --}}
                    <div class="input-group input-group-sm">
                        <label class="input-group-text" for="fm-upload-target-directory-select" title="Current Folder / Upload Target">
                            <i class="fas fa-folder-open fa-fw"></i>
                        </label>
                        <select class="form-select" id="fm-upload-target-directory-select" aria-label="Select folder to navigate or for new content" size="1">
                            {{-- Opciones dinámicas --}}
                        </select>
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="fm-folder-actions-dropdown-trigger" data-bs-toggle="dropdown" aria-expanded="false" title="Folder Actions">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="fm-folder-actions-dropdown-trigger">
                            <li>
                                <a class="dropdown-item" href="#" id="fm-action-create-folder-in-selected">
                                    <i class="fas fa-folder-plus fa-fw me-2"></i>Create Folder Here
                                </a>
                            </li>
                             {{-- Eliminamos "Upload Files Here" ya que el dropzone será siempre visible
                             <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" id="fm-action-upload-files-current-folder">
                                    <i class="fas fa-cloud-upload-alt fa-fw me-2"></i>Upload Files Here
                                </a>
                            </li>
                            --}}
                        </ul>
                    </div>
                </div>
                <div> {{-- Contenedor para los botones de la derecha --}}
                     <button class="btn btn-sm btn-outline-secondary py-1 px-2 me-2" id="fm-reload-btn" title="Reload File List">
                        <i class="fas fa-sync-alt fa-fw"></i>
                    </button>
                    <div class="btn-group btn-group-sm me-2" role="group" aria-label="View toggle">
                        <button type="button" class="btn btn-outline-primary active" id="fm-view-list-btn" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="fm-view-grid-btn" title="Grid View">
                            <i class="fas fa-th"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Breadcrumbs Section -->
        <div class="fm-breadcrumbs-bar p-2 border-bottom" style="font-size: 0.85rem;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb fm-breadcrumb bg-transparent border-0 rounded p-0 m-0" id="fm-breadcrumbs">
                    {{-- Breadcrumbs dinámicos --}}
                </ol>
            </nav>
        </div>

        <!-- File List Area -->
        <div class="fm-file-list-area p-2" style="max-height: 350px; overflow-y: auto;">
            <!-- List View Container -->
            <div id="fm-list-view-container">
                <div class="table-responsive">
                    <table class="table table-hover table-sm fm-table" id="fm-file-list-table">
                        <thead class="table-light sticky-top" style="font-size: 0.8rem; top: -1px; z-index:10;">
                            <tr>
                                <th style="width: 30px;" class="text-center"><i class="fas fa-hashtag"></i></th>
                                <th>Name</th>
                                <th style="width: 80px;" class="text-end">Size</th>
                                <th style="width: 120px;">By</th>
                                <th style="width: 130px;">Date</th>
                                <th style="width: 100px;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="fm-file-list-body" style="font-size: 0.85rem;">
                            {{-- Contenido dinámico para vista de lista --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Grid View Container -->
            <div id="fm-grid-view-container" style="display: none;">
                {{-- Contenido dinámico para vista de cuadrícula --}}
            </div>

            <div id="fm-loader" class="text-center p-3" style="display: none;">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                <span class="ms-2 text-muted small">Loading...</span>
            </div>
            <div id="fm-empty-folder" class="text-center p-3 border rounded bg-light" style="display: none;">
                <i class="fas fa-folder-open fa-3x text-muted mb-2"></i>
                <p class="mb-0 fs-6">This folder is empty.</p>
            </div>
            <div id="fm-error-loading" class="alert alert-danger text-center p-2" style="display: none; font-size: 0.85rem;">
                <i class="fas fa-exclamation-triangle me-1"></i>
                <span class="fw-bold">Could not load.</span>
                <small id="fm-error-message-details" class="d-block"></small>
            </div>
        </div>

        <!-- Área de Subida Siempre Visible -->
        <div class="fm-upload-area-section p-2 border-top" id="fm-upload-section-container">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label id="fm-upload-label" class="form-label fw-semibold small mb-0">Upload to: <span id="fm-current-folder-name-upload" class="text-success">Root</span></label>
                {{-- El botón de cerrar ya no es necesario si siempre está visible, o puede usarse para colapsar si se desea
                <button type="button" class="btn-close btn-sm" aria-label="Close Upload Area" id="fm-close-upload-area"></button> 
                --}}
            </div>
            <form action="{{ route('clients.files_post') }}" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="fileManagerDropzone">
                @csrf
                <input type="hidden" name="client_id" id="fm_client_id" value="{{ $client->id }}">
                <input type="hidden" name="target_directory" id="fm_target_directory" value="">
                <div class="dz-message needsclick small py-3">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted"></i><br>
                    Drag files here or click to browse
                    <span class="note needsclick d-block text-muted" style="font-size: 0.7rem;">(Max 10MB per file. Allowed: jpg, png, pdf, zip, doc, xls, ppt, txt, html)</span>
                </div>
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    /* --- Container Query Setup --- */
    #fileManagerContainer {
        container-type: inline-size;
        container-name: fm-container;
    }

    /* Estilos generales para compactar */
    #fileManagerContainer .form-label.small { font-size: 0.78rem; }
    #fileManagerContainer .input-group-sm .form-select,
    #fileManagerContainer .input-group-sm .btn { font-size: 0.8rem; padding-top: 0.25rem; padding-bottom: 0.25rem;}

    .fm-breadcrumb { margin-bottom: 0 !important; }
    .fm-breadcrumb .breadcrumb-item a { cursor: pointer; color: var(--bs-primary); text-decoration: none; }
    .fm-breadcrumb .breadcrumb-item a:hover { text-decoration: underline; }
    .fm-breadcrumb .breadcrumb-item.active { color: var(--bs-secondary); }

    .fm-table thead.table-light th { padding-top: 0.4rem; padding-bottom: 0.4rem; vertical-align: middle;}
    #fm-file-list-body tr td { padding-top: 0.5rem; padding-bottom: 0.5rem; vertical-align: middle; }

    .fm-table .file-list-icon, .fm-grid-item .file-grid-icon { font-size: 1.1rem; vertical-align: middle; }
    .fm-table .folder-link, .fm-grid-item .folder-link { cursor: pointer; font-weight: 500; color: var(--bs-primary); text-decoration: none; }
    .fm-table .folder-link:hover, .fm-grid-item .folder-link:hover { color: var(--bs-dark); text-decoration: underline; }
    
    #fileManagerDropzone { border: 2px dashed var(--bs-gray-400); border-radius: .25rem; background: var(--bs-light); min-height: 70px; padding:0.5rem;}
    #fileManagerDropzone .dz-message { margin: 0.25rem 0; }
    #fileManagerDropzone.dz-drag-hover { border-color: var(--bs-success); }

    #fileManagerContainer #fm-current-folder-name-upload { color: #28a745 !important; }
    
    /* Estilo para el select de carpetas tipo explorador */
    #fm-upload-target-directory-select {
        font-family: Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; /* Monospaced font */
        font-size: 0.85rem; /* Un poco más grande para legibilidad de indentación */
    }
    /* Para que las opciones indentadas se vean mejor si el select se expande (size > 1) */
    #fm-upload-target-directory-select option {
        padding-left: 5px; /* Espacio base para todas las opciones */
    }


    .dropdown-item .fa-fw { width: 1.25em; }
    .fm-swal-image-preview .swal2-image { max-width: 90vw; max-height: 80vh; margin: 1em auto; }

    /* --- Toolbar Adaptability --- */
    .fm-toolbar > .row { 
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    .fm-toolbar > .row > div:nth-child(1) { 
        flex-basis: 300px;
        flex-grow: 1;     
        min-width: 240px; 
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
        margin-bottom: var(--bs-gutter-y); 
    }
    .fm-toolbar > .row > div:nth-child(2) {
        flex-basis: 200px;
        flex-grow: 1;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left: calc(var(--bs-gutter-x) * .5);
        margin-bottom: var(--bs-gutter-y);
    }

    @container fm-container (max-width: 580px) {
        .fm-toolbar > .row > div:nth-child(1),
        .fm-toolbar > .row > div:nth-child(2) {
            flex-basis: 100%;
        }
        .fm-toolbar > .row > div:nth-child(2) {
            justify-content: flex-start;
        }
    }
    
    /* Grid View Specific Styles */
    #fm-grid-view-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 0.5rem;
        user-select: none;
    }

    .fm-grid-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0.5rem 0.3rem;
        border: 1px solid var(--bs-gray-300);
        border-radius: 0.25rem;
        background-color: #fff;
        position: relative;
        transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        cursor: default;
        overflow: visible; /* Para que el dropdown no se corte */
    }
    .fm-grid-item:hover {
        background-color: var(--bs-light);
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
    }
    .fm-grid-item .file-grid-icon.fa-folder { color: var(--bs-warning); }
    /* ... otros estilos de iconos ... */

    .fm-grid-item .item-name {
        font-size: 0.75rem;
        font-weight: 500;
        word-break: break-all;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.25;
        min-height: calc(0.75rem * 1.25 * 2);
        margin-bottom: 0.15rem;
        width: 100%;
    }
    .fm-grid-item .item-details {
        font-size: 0.7rem;
        color: var(--bs-gray-600);
    }
    .fm-grid-item .item-actions { /* Contenedor del botón dropdown */
        position: absolute;
        top: 3px;
        right: 3px;
        z-index: 10; /* Asegurar que esté por encima de otros elementos del grid */
    }
    .fm-grid-item .item-actions .btn { /* Botón que dispara el dropdown */
        padding: 0.1rem 0.3rem;
        font-size: 0.7rem;
        background-color: rgba(255,255,255,0.7); /* Fondo semi-transparente para mejor visibilidad */
    }
    .fm-grid-item .dropdown-menu { /* El menú desplegable */
        font-size: 0.8rem;
        /* min-width: 160px; Ajustar si es necesario */
    }

    .fm-grid-item .grid-thumbnail-wrapper {
        width: 36px;
        height: 36px;
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 0.2rem;
        background-color: var(--bs-gray-200);
    }
    .fm-grid-item .grid-thumbnail-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    .fm-grid-item .grid-thumbnail-wrapper .file-grid-icon {
        font-size: 1.8rem;
        margin-bottom: 0;
        color: var(--bs-secondary);
    }
    .fm-grid-item .grid-thumbnail-wrapper .fa-folder { color: var(--bs-warning); }

    .fm-toolbar .btn-outline-primary.active {
        background-color: var(--bs-primary);
        color: white;
    }

    /* --- List View Table Column Hiding --- */
    @container fm-container (max-width: 500px) { 
        #fm-file-list-table th:nth-child(4), 
        #fm-file-list-table td:nth-child(4) {
            display: none;
        }
    }
    @container fm-container (max-width: 420px) {
        #fm-file-list-table th:nth-child(3), 
        #fm-file-list-table td:nth-child(3) {
            display: none;
        }
    }
    @container fm-container (max-width: 350px) {
        #fm-file-list-table th:nth-child(5), 
        #fm-file-list-table td:nth-child(5) {
            display: none;
        }
    }
</style>

<script>
// Ensure Bootstrap 5 JS is loaded for dropdowns to work
// Ensure SweetAlert2 and Toastify are loaded

const initialDefaultStructure = @json($defaultDirectoryStructure ?? []);
const initialClientId = @json($client->id ?? null);

document.addEventListener('DOMContentLoaded', function () {
    const fm = {
        container: document.getElementById('fileManagerContainer'),
        clientId: initialClientId,
        breadcrumbs: document.getElementById('fm-breadcrumbs'),
        
        listViewContainer: document.getElementById('fm-list-view-container'),
        gridViewContainer: document.getElementById('fm-grid-view-container'),
        fileListBody: document.getElementById('fm-file-list-body'),
        fileGridBody: document.getElementById('fm-grid-view-container'), 

        viewListBtn: document.getElementById('fm-view-list-btn'),
        viewGridBtn: document.getElementById('fm-view-grid-btn'),
        currentView: 'list',

        uploadLabelSpan: document.getElementById('fm-current-folder-name-upload'),
        uploadTargetInput: document.getElementById('fm_target_directory'),
        uploadTargetSelect: document.getElementById('fm-upload-target-directory-select'),
        uploadSectionContainer: document.getElementById('fm-upload-section-container'),
        // uploadActionBtn: document.getElementById('fm-action-upload-files-current-folder'), // Ya no se usa para mostrar/ocultar
        // closeUploadAreaBtn: document.getElementById('fm-close-upload-area'), // Ya no se usa

        emptyFolderMsg: document.getElementById('fm-empty-folder'),
        loaderMsg: document.getElementById('fm-loader'),
        errorLoadingMsg: document.getElementById('fm-error-loading'),
        errorLoadingDetails: document.getElementById('fm-error-message-details'),
        reloadBtn: document.getElementById('fm-reload-btn'),
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]')?.value,
        currentPath: '',
        dropzoneInstance: null,
        defaultDirStructure: initialDefaultStructure,
        defaultLoadPath: 'Recent Uploads', 
    };

    if (!fm.container || !fm.clientId) {
        console.error('File Manager: Container or Client ID not found.');
        if(fm.container) fm.container.style.display = 'none';
        return;
    }
    if (typeof Dropzone === 'undefined') { console.error("Dropzone library is not loaded!"); return; }
    Dropzone.autoDiscover = false;
    if (typeof Swal === 'undefined') { console.error("SweetAlert2 library is not loaded!"); return; }
    if (typeof Toastify === 'undefined') { console.warn("Toastify library is not loaded, notifications will fallback to alerts."); }
    
    function showToast(message, type = 'info') {
        // ... (sin cambios)
        if (typeof Toastify === 'undefined') {
            alert(message); return;
        }
        const colors = {
            info: "linear-gradient(to right, #0dcaf0, #0dcaf0)",
            success: "linear-gradient(to right, #198754, #198754)",
            error: "linear-gradient(to right, #dc3545, #dc3545)",
            warning: "linear-gradient(to right, #ffc107, #ffc107)"
        };
        Toastify({
            text: message, duration: 3000, gravity: "top", position: "right",
            backgroundColor: colors[type] || colors.info, className: `toastify-${type}`
        }).showToast();
    }

    function formatBytes(bytes, decimals = 2) {
        // ... (sin cambios)
        if (!bytes || bytes === 0) return '0 B';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    function populateDirectorySelect(currentStructure, currentViewPath = '') {
        fm.uploadTargetSelect.innerHTML = ''; // Clear existing options
        const rootOption = document.createElement('option');
        rootOption.value = "";
        rootOption.textContent = "📁 Client Root"; // Icono para la raíz
        fm.uploadTargetSelect.appendChild(rootOption);

        let pathFoundInSelect = (currentViewPath === "");

        function addOptions(structure, prefix = '', level = 0) {
            const entries = Array.isArray(structure) 
                ? structure.map(item => ({ name: item, sub: null }))
                : Object.entries(structure).map(([name, sub]) => ({ name, sub }));

            for (const entry of entries) {
                let folderName = entry.name;
                let subItems = entry.sub;
                
                // Usar espacios   para indentación en lugar de caracteres de caja
                let indentPrefix = '';
                for (let j = 0; j < level; j++) {
                    indentPrefix += '\u00A0\u00A0\u00A0\u00A0'; // 4 non-breaking spaces
                }
                // Podríamos usar un carácter de flecha o nada si la indentación es suficiente
                 indentPrefix += (level > 0 ? '↳ ' : ''); // Opcional: flecha para subcarpetas

                const fullPath = prefix ? `${prefix}/${folderName}` : folderName;
                const option = document.createElement('option');
                option.value = fullPath;
                option.innerHTML = `${indentPrefix}📁 ${folderName}`; // innerHTML para renderizar  
                
                fm.uploadTargetSelect.appendChild(option);

                if (fullPath === currentViewPath) {
                    option.selected = true;
                    pathFoundInSelect = true;
                }

                if (subItems && (typeof subItems === 'object' || Array.isArray(subItems)) && Object.keys(subItems).length > 0) {
                    addOptions(subItems, fullPath, level + 1);
                }
            }
        }
        
        addOptions(currentStructure, '', 0);
        
        if (currentViewPath && pathFoundInSelect) {
            fm.uploadTargetSelect.value = currentViewPath;
        } else {
             fm.uploadTargetSelect.value = ""; // Default to root if current path not found or is empty
        }
        fm.uploadTargetInput.value = fm.uploadTargetSelect.value;
        syncUploadLabel();
    }

    function syncUploadLabel() {
        // ... (sin cambios)
        const selectedOption = fm.uploadTargetSelect.options[fm.uploadTargetSelect.selectedIndex];
        let selectedText = 'Client Root'; // Default
        if (selectedOption && selectedOption.value !== "") {
            // Extraer el nombre de la carpeta del texto del option, quitando la indentación y el icono
            selectedText = selectedOption.textContent.replace(/^[\s\u00A0]*📁\s*/, '').trim();
             if (!selectedText && selectedOption.value) { // Fallback si el texto está vacío pero hay valor
                selectedText = selectedOption.value.split('/').pop();
            }
        } else if (selectedOption && selectedOption.value === "") {
            selectedText = 'Client Root';
        }
        fm.uploadLabelSpan.textContent = selectedText || 'Client Root';
    }

    function renderBreadcrumbs(breadcrumbsData) {
        // ... (sin cambios)
        fm.breadcrumbs.innerHTML = '';
        if (!breadcrumbsData || breadcrumbsData.length === 0) {
            const liRoot = document.createElement('li');
            liRoot.classList.add('breadcrumb-item', 'active');
            liRoot.setAttribute('aria-current', 'page');
            liRoot.textContent = 'Root'; 
            if (fm.currentPath === fm.defaultLoadPath && fm.defaultLoadPath !== '' && fm.defaultLoadPath !=='Root') { 
                 liRoot.textContent = fm.defaultLoadPath;
            } else if (fm.currentPath === '') {
                 liRoot.textContent = 'Root';
            }
            fm.breadcrumbs.appendChild(liRoot);
            return;
        }
        breadcrumbsData.forEach((crumb, index) => {
            const li = document.createElement('li');
            li.classList.add('breadcrumb-item');
            if (index === breadcrumbsData.length - 1) {
                li.classList.add('active');
                li.setAttribute('aria-current', 'page');
                li.textContent = crumb.name;
            } else {
                const a = document.createElement('a');
                a.href = '#';
                a.textContent = crumb.name;
                a.dataset.path = crumb.path;
                a.addEventListener('click', (e) => { e.preventDefault(); loadFiles(a.dataset.path); });
                li.appendChild(a);
            }
            fm.breadcrumbs.appendChild(li);
        });
    }

    function getItemActionsDropdown(item, isFile, viewMode = 'list') { // viewMode puede ser 'list' o 'grid'
        const uniqueID = `actionsDropdown-${isFile ? 'file' : 'folder'}-${item.id || item.name.replace(/\W+/g, '-')}-${Math.random().toString(36).substring(2,7)}`;
        let actionsHtml = '';

        if (isFile) {
            if (viewMode === 'list') {
                actionsHtml = `
                    <li><a class="dropdown-item view-file-btn" href="${item.view_url}" target="_blank" data-filename="${item.original_name || item.name}" data-file-icon="${item.icon || 'fa-file'}"><i class="fas fa-eye fa-fw me-2"></i>View in Tab</a></li>
                    <li><a class="dropdown-item copy-link-btn" href="#" data-fileurl="${item.download_url}" data-filename="${item.original_name || item.name}"><i class="fas fa-link fa-fw me-2"></i>Copy Download Link</a></li>
                    <li><a class="dropdown-item rename-file-btn" href="#" data-fileid="${item.id}" data-filename="${item.name}" data-originalname="${item.original_name || item.name}"><i class="fas fa-pencil-alt fa-fw me-2"></i>Rename Stored File</a></li>
                    <li><a class="dropdown-item download-file-link" href="${item.download_url}" download="${item.original_name || item.name}"><i class="fas fa-download fa-fw me-2"></i>Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item delete-file-btn text-danger" href="#" data-fileid="${item.id}" data-filename="${item.original_name || item.name}"><i class="fas fa-trash-alt fa-fw me-2"></i>Delete</a></li>
                `;
            } else { // Grid View - Reduced Actions
                actionsHtml = `
                    <li><a class="dropdown-item view-file-btn" href="${item.view_url}" target="_blank" data-filename="${item.original_name || item.name}"><i class="fas fa-eye fa-fw me-2"></i>View</a></li>
                    <li><a class="dropdown-item download-file-link" href="${item.download_url}" download="${item.original_name || item.name}"><i class="fas fa-download fa-fw me-2"></i>Download</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item rename-file-btn" href="#" data-fileid="${item.id}" data-filename="${item.name}" data-originalname="${item.original_name || item.name}"><i class="fas fa-pencil-alt fa-fw me-2"></i>Rename</a></li>
                    <li><a class="dropdown-item delete-file-btn text-danger" href="#" data-fileid="${item.id}" data-filename="${item.original_name || item.name}"><i class="fas fa-trash-alt fa-fw me-2"></i>Delete</a></li>
                `;
            }
        } else { // Folder (mismas acciones para list y grid por ahora)
             actionsHtml = `
                <li><a class="dropdown-item open-folder-link" href="#" data-path="${item.path}" data-name="${item.name}"><i class="fas fa-folder-open fa-fw me-2"></i>Open</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item delete-folder-btn text-danger" href="#" data-path="${item.path}" data-name="${item.name}"><i class="fas fa-trash-alt fa-fw me-2"></i>Delete Folder</a></li>
            `;
        }

        return `
            <div class="dropdown item-actions">
                <button class="btn btn-sm btn${viewMode === 'grid' ? '-light border' : '-outline-secondary'} dropdown-toggle" type="button" id="${uniqueID}" data-bs-toggle="dropdown" aria-expanded="false" title="Actions for ${item.name}">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="${uniqueID}">
                    ${actionsHtml}
                </ul>
            </div>
        `;
    }
    
    function getFileIconClass(fileName, mimeType = '') {
        // ... (sin cambios)
        const extension = fileName.slice(fileName.lastIndexOf('.') + 1).toLowerCase();
        if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'].includes(extension)) return 'fa-file-image text-info';
        if (extension === 'pdf') return 'fa-file-pdf text-danger';
        if (['zip', 'rar', 'tar', 'gz'].includes(extension)) return 'fa-file-archive text-warning';
        if (['doc', 'docx'].includes(extension)) return 'fa-file-word text-primary';
        if (['xls', 'xlsx', 'csv'].includes(extension)) return 'fa-file-excel text-success';
        if (['ppt', 'pptx'].includes(extension)) return 'fa-file-powerpoint text-warning';
        if (['mp4', 'mov', 'avi', 'mkv'].includes(extension)) return 'fa-file-video text-primary';
        if (['mp3', 'wav', 'ogg'].includes(extension)) return 'fa-file-audio text-info';
        if (['txt', 'md', 'log'].includes(extension)) return 'fa-file-alt text-secondary';
        if (['js', 'json', 'css', 'php', 'py', 'java', 'c', 'cpp'].includes(extension)) return 'fa-file-code text-dark';
        if (extension === 'html' || extension === 'htm') return 'fa-file-code text-info';
        return 'fa-file text-muted';
    }

    function renderFileList(folders, files) {
        fm.fileListBody.innerHTML = '';
        fm.fileGridBody.innerHTML = ''; 

        let parentPath = null;
        if (fm.currentPath && fm.currentPath !== '') {
            const pathParts = fm.currentPath.split('/');
            if (pathParts.length > 0) {
                pathParts.pop();
                parentPath = pathParts.join('/');
            }
        }
        
        fm.emptyFolderMsg.style.display = (folders.length === 0 && files.length === 0) ? 'block' : 'none';

        if (fm.currentView === 'list') {
            fm.listViewContainer.style.display = 'block';
            fm.gridViewContainer.style.display = 'none';

            if (parentPath !== null) {
                const tr = document.createElement('tr');
                tr.classList.add('fm-parent-dir-item');
                tr.innerHTML = `
                    <td class="text-center"><i class="fas fa-level-up-alt fa-fw file-list-icon text-secondary"></i></td>
                    <td><a href="#" class="folder-link parent-folder-link" data-path="${parentPath}" title="Go to parent folder">..</a></td>
                    <td class="text-muted text-end" colspan="3"><small>-</small></td>
                    <td></td>
                `;
                tr.querySelector('.parent-folder-link').addEventListener('click', (e) => { e.preventDefault(); loadFiles(parentPath); });
                fm.fileListBody.appendChild(tr);
            }

            folders.forEach(folder => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="text-center"><i class="fas fa-folder fa-fw file-list-icon text-warning"></i></td>
                    <td><a href="#" class="folder-link" data-path="${folder.path}" title="Open ${folder.name}">${folder.name}</a></td>
                    <td class="text-muted text-end" colspan="3"><small>-</small></td>
                    <td class="text-end">${getItemActionsDropdown(folder, false, 'list')}</td>
                `;
                tr.querySelector('.folder-link:not(.parent-folder-link)')?.addEventListener('click', (e) => { e.preventDefault(); loadFiles(folder.path); });
                fm.fileListBody.appendChild(tr);
            });

            files.forEach(file => {
                const tr = document.createElement('tr');
                const iconClass = file.icon || getFileIconClass(file.name);
                tr.innerHTML = `
                    <td class="text-center"><i class="fas ${iconClass} fa-fw file-list-icon"></i></td>
                    <td title="${file.original_name || file.name}">${file.name} <small class="text-muted d-block" style="font-size:0.8em;">(${file.original_name || file.name})</small></td>
                    <td class="text-end">${formatBytes(file.size)}</td>
                    <td><small>${file.uploaded_by || '-'}</small></td>
                    <td><small>${file.uploaded_at || '-'}</small></td>
                    <td class="text-end">${getItemActionsDropdown(file, true, 'list')}</td>
                `;
                fm.fileListBody.appendChild(tr);
            });

        } else { // Grid View
            fm.listViewContainer.style.display = 'none';
            fm.gridViewContainer.style.display = ''; 

            if (parentPath !== null) {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'fm-grid-item h-100 fm-parent-dir-item'; 
                itemDiv.innerHTML = `
                    <div class="grid-thumbnail-wrapper">
                        <i class="fas fa-level-up-alt fa-fw file-grid-icon text-secondary"></i>
                    </div>
                    <div class="item-name folder-link parent-folder-link" data-path="${parentPath}" title="Go to parent folder">..</div>
                    <div class="item-details">Parent</div>
                `;
                itemDiv.querySelector('.parent-folder-link').addEventListener('click', (e) => { e.preventDefault(); loadFiles(parentPath); });
                fm.fileGridBody.appendChild(itemDiv);
            }

            folders.forEach(folder => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'fm-grid-item h-100';
                itemDiv.innerHTML = `
                    <div class="grid-thumbnail-wrapper">
                        <i class="fas fa-folder fa-fw file-grid-icon"></i>
                    </div>
                    <div class="item-name folder-link" data-path="${folder.path}" title="Open ${folder.name}">${folder.name}</div>
                    <div class="item-details">Folder</div>
                    ${getItemActionsDropdown(folder, false, 'grid')}
                `;
                itemDiv.querySelector('.folder-link:not(.parent-folder-link)')?.addEventListener('click', (e) => { e.preventDefault(); loadFiles(folder.path); });
                fm.fileGridBody.appendChild(itemDiv);
            });

            files.forEach(file => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'fm-grid-item h-100';
                const iconClass = file.icon || getFileIconClass(file.name);
                const isImage = iconClass.includes('fa-file-image');
                
                itemDiv.innerHTML = `
                    <div class="grid-thumbnail-wrapper">
                        ${isImage ? `<img src="${file.view_url}" alt="${file.original_name || file.name}" class="view-file-inline-btn" data-fileurl="${file.view_url}" data-filename="${file.original_name || file.name}" data-file-icon="${iconClass}" style="cursor:pointer;">` 
                                  : `<i class="fas ${iconClass} fa-fw file-grid-icon"></i>`}
                    </div>
                    <div class="item-name" title="${file.original_name || file.name}">${file.name}</div>
                    <div class="item-details">${formatBytes(file.size)}</div>
                    ${getItemActionsDropdown(file, true, 'grid')}
                `;
                fm.fileGridBody.appendChild(itemDiv);
            });
        }
        
        var dropdownTriggerList = [].slice.call(fm.container.querySelectorAll('[data-bs-toggle="dropdown"]'))
        var dropdownList = dropdownTriggerList.map(function (dropdownTriggerEl) {
            if (!bootstrap.Dropdown.getInstance(dropdownTriggerEl)) {
                return new bootstrap.Dropdown(dropdownTriggerEl);
            }
            return bootstrap.Dropdown.getInstance(dropdownTriggerEl);
        });
    }

    async function loadFiles(path = '') {
        // ... (sin cambios)
        fm.currentPath = path;
        fm.loaderMsg.style.display = 'flex';
        fm.fileListBody.innerHTML = '';
        fm.fileGridBody.innerHTML = '';
        fm.emptyFolderMsg.style.display = 'none';
        fm.errorLoadingMsg.style.display = 'none';
        
        let pathExistsInSelect = Array.from(fm.uploadTargetSelect.options).some(opt => opt.value === path);
        if (pathExistsInSelect) {
            fm.uploadTargetSelect.value = path;
        } else {
            fm.uploadTargetSelect.value = '';
        }
        fm.uploadTargetInput.value = path;
        syncUploadLabel();

        try {
            const response = await fetch(`/clients/${fm.clientId}/files-ajax?path=${encodeURIComponent(path)}`, {
                method: 'GET', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': fm.csrfToken }
            });
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({ msg: `HTTP error ${response.status}` }));
                throw new Error(errorData.msg || `Error! Status: ${response.status}`);
            }
            const data = await response.json();
            populateDirectorySelect(data.default_dir_structure || fm.defaultDirStructure, fm.currentPath);
            renderBreadcrumbs(data.breadcrumbs);
            renderFileList(data.structure.folders, data.structure.files);
        } catch (error) {
            console.error('Error loading files:', error);
            fm.errorLoadingMsg.style.display = 'block';
            fm.errorLoadingDetails.textContent = error.message;
            renderBreadcrumbs([{name: 'Error loading content', path: fm.currentPath}]);
        } finally {
            fm.loaderMsg.style.display = 'none';
        }
    }

    function initializeDropzone() {
        // ... (sin cambios en la inicialización de Dropzone, la lógica de "addedfile" y "sending" se mantiene)
        const dzElement = document.getElementById('fileManagerDropzone');
        if (!dzElement) {
            console.error("Dropzone element #fileManagerDropzone not found.");
            return;
        }
        if (fm.dropzoneInstance) fm.dropzoneInstance.destroy();
        
        const allowedExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.pdf', '.zip', '.rar', '.doc', '.docx', '.xls', '.xlsx', '.ppt', '.pptx', '.txt', '.html'];
        const disallowedExecutableExtensions = ['.exe', '.bat', '.sh', '.msi', '.com', '.cmd', '.scr', '.pif', '.vbs', '.jar', '.app', '.dmg', '.iso'];


        fm.dropzoneInstance = new Dropzone(dzElement, {
            url: dzElement.getAttribute('action'),
            paramName: "file", maxFilesize: 10, addRemoveLinks: true,
            dictRemoveFile: "Remove", dictCancelUpload: "Cancel",
            dictDefaultMessage: dzElement.querySelector('.dz-message').innerHTML,
            timeout: 120000, headers: { 'X-CSRF-TOKEN': fm.csrfToken },
            autoProcessQueue: true, // Para que suba inmediatamente después de la confirmación (si la hay)
            acceptedFiles: allowedExtensions.join(','),

            init: function() {
                const dropzone = this;
                dropzone.on("addedfile", function(file) {
                    const fileNameLower = file.name.toLowerCase();
                    const fileExt = '.' + fileNameLower.split('.').pop();

                    if (!allowedExtensions.includes(fileExt) || disallowedExecutableExtensions.some(ext => fileNameLower.endsWith(ext))) {
                        showToast(`File type not allowed: ${file.name}`, "error");
                        dropzone.removeFile(file);
                        return;
                    }
                    // No Swal confirmation here if autoProcessQueue is true and we want immediate upload
                    // If confirmation is needed, autoProcessQueue should be false, and call dropzone.processFile(file) in Swal's .then()
                });
                dropzone.on("sending", function(file, xhr, formData) {
                    formData.append("client_id", fm.clientId);
                    formData.append("target_directory", fm.uploadTargetInput.value);
                });
                dropzone.on("success", function(file, response) {
                    if (response.status) {
                        showToast(response.msg || "File uploaded!", "success");
                        loadFiles(fm.uploadTargetInput.value); // Recargar la carpeta actual
                    } else {
                        showToast(response.msg || "Upload failed.", "error");
                    }
                    dropzone.removeFile(file);
                });
                dropzone.on("error", function(file, errorMessage, xhr) {
                    let msg = "Upload error.";
                    if (typeof errorMessage === 'string') {
                        msg = errorMessage;
                    } else if (errorMessage && errorMessage.errors && errorMessage.errors.file && errorMessage.errors.file.length > 0) {
                        msg = errorMessage.errors.file[0];
                    } else if (errorMessage && errorMessage.message) {
                        msg = errorMessage.message;
                    } else if (xhr && xhr.response) {
                        try {
                            const jsonResponse = JSON.parse(xhr.response);
                            if (jsonResponse.msg) msg = jsonResponse.msg;
                            else if(jsonResponse.message) msg = jsonResponse.message;
                        } catch (e) { /* Ignore parsing error */ }
                    }
                    showToast(`${file.name}: ${msg}`, "error");
                    dropzone.removeFile(file);
                });
            }
        });
    }

    fm.uploadTargetSelect.addEventListener('change', () => {
        const selectedPath = fm.uploadTargetSelect.value;
        loadFiles(selectedPath); // Navegar a la carpeta seleccionada
        // La etiqueta de "Upload to:" se actualiza dentro de loadFiles y populateDirectorySelect
    });

    document.getElementById('fm-action-create-folder-in-selected').addEventListener('click', async (e) => {
        // ... (sin cambios)
        e.preventDefault();
        const targetFolderForNew = fm.uploadTargetSelect.value;
        const selectedOption = fm.uploadTargetSelect.options[fm.uploadTargetSelect.selectedIndex];
        let targetFolderTextDisplay = 'Client Root';
         if (selectedOption) {
            if (selectedOption.value === "") targetFolderTextDisplay = 'Client Root';
            else {
                targetFolderTextDisplay = selectedOption.textContent.replace(/^[\s\u00A0]*📁\s*/, '').trim();
                if (!targetFolderTextDisplay && selectedOption.value) targetFolderTextDisplay = selectedOption.value.split('/').pop();
                if (!targetFolderTextDisplay) targetFolderTextDisplay = selectedOption.value;
            }
        }
        if (!targetFolderTextDisplay) targetFolderTextDisplay = targetFolderForNew || 'Selected Folder';

        const { value: folderName } = await Swal.fire({
            title: 'Create New Folder',
            html: `Enter name for new folder in: <br><b>${targetFolderTextDisplay}</b>`,
            input: 'text', inputPlaceholder: 'Folder Name', showCancelButton: true,
            confirmButtonText: '<i class="fas fa-plus-circle me-1"></i>Create', confirmButtonColor: '#28a745',
            inputValidator: (value) => {
                if (!value || value.trim() === '') return 'Folder name cannot be empty!';
                if (!/^[a-zA-Z0-9\s._-]+$/.test(value)) return 'Invalid characters. Use letters, numbers, spaces, ., _, -.';
                return null;
            }
        });

        if (folderName && folderName.trim() !== "") {
            try {
                const response = await fetch(`/clients/${fm.clientId}/create-folder`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': fm.csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ current_view_path: targetFolderForNew, new_folder_name: folderName.trim() })
                });
                const result = await response.json();
                if (result.status) {
                   showToast(result.msg, "success");
                   loadFiles(targetFolderForNew); 
                } else {
                   showToast(result.msg || "Failed to create folder.", "error");
                }
            } catch (error) {
                showToast("Client-side error creating folder.", "error");
                console.error("Create folder error:", error);
            }
        }
    });
    
    fm.container.addEventListener('click', async (event) => {
        // ... (sin cambios en la lógica de botones, excepto la llamada a getItemActionsDropdown que ahora pasa viewMode)
        const target = event.target;
        const viewFileBtnInline = target.closest('.view-file-inline-btn'); 
        const viewFileBtnTab = target.closest('.view-file-btn'); 
        const deleteFileBtn = target.closest('.delete-file-btn');
        const renameFileBtn = target.closest('.rename-file-btn');
        const copyLinkBtn = target.closest('.copy-link-btn');
        const deleteFolderBtn = target.closest('.delete-folder-btn');
        const openFolderLink = target.closest('.open-folder-link');

        if (openFolderLink && !openFolderLink.classList.contains('parent-folder-link')) {
             event.preventDefault();
             const folderPath = openFolderLink.dataset.path;
             loadFiles(folderPath);
             return;
        }
        
        if (viewFileBtnInline) { 
            event.preventDefault();
            const fileUrl = viewFileBtnInline.dataset.fileurl;
            const fileName = viewFileBtnInline.dataset.filename;
            Swal.fire({
                title: fileName, imageUrl: fileUrl, imageAlt: fileName,
                showCloseButton: true, showConfirmButton: false,
                customClass: { popup: 'fm-swal-image-preview', image: 'fm-swal-image' },
            });
        } else if (viewFileBtnTab) { 
            // Default link behavior
        } else if (deleteFileBtn) {
            event.preventDefault();
            const fileId = deleteFileBtn.dataset.fileid;
            const fileName = deleteFileBtn.dataset.filename;
            Swal.fire({
                title: 'Confirm Delete', html: `Delete file: <br><b>${fileName}</b>?`, icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Yes, delete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`/clients/files/${fileId}/delete`, {
                            method: 'DELETE', headers: { 'X-CSRF-TOKEN': fm.csrfToken, 'Accept': 'application/json' }
                        });
                        const resData = await response.json();
                        if (resData.status) {
                            showToast(resData.msg || 'File deleted!', "success");
                            loadFiles(fm.currentPath);
                        } else { showToast(resData.msg || "Failed to delete file.", "error"); }
                    } catch (error) { showToast("Client-side error deleting file.", "error");}
                }
            });
        } else if (deleteFolderBtn) { 
            event.preventDefault();
            const folderPath = deleteFolderBtn.dataset.path;
            const folderName = deleteFolderBtn.dataset.name;
            Swal.fire({
                title: 'Confirm Delete Folder',
                html: `Delete folder: <br><b>${folderName}</b>?<br><small class="text-danger">All contents will be permanently deleted.</small>`,
                icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Yes, delete folder!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                     try {
                        const response = await fetch(`/clients/${fm.clientId}/delete-folder`, {
                            method: 'DELETE',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': fm.csrfToken, 'Accept': 'application/json' },
                            body: JSON.stringify({ folder_path_to_delete: folderPath })
                        });
                        const resData = await response.json();
                        if (resData.status) {
                            showToast(resData.msg || 'Folder deleted!', "success");
                            if (fm.currentPath === folderPath || fm.currentPath.startsWith(folderPath + '/')) {
                                const parentPath = folderPath.includes('/') ? folderPath.substring(0, folderPath.lastIndexOf('/')) : '';
                                loadFiles(parentPath);
                            } else { 
                                loadFiles(fm.currentPath);
                            }
                        } else { showToast(resData.msg || "Failed to delete folder.", "error"); }
                    } catch (error) { showToast("Client-side error deleting folder.", "error"); }
                }
            });
        } else if (renameFileBtn) {
            event.preventDefault();
            const fileId = renameFileBtn.dataset.fileid;
            const currentStoredFileName = renameFileBtn.dataset.filename; 
            const originalUploadedName = renameFileBtn.dataset.originalname;

            const nameParts = currentStoredFileName.match(/^(\d+)_([a-zA-Z0-9_]+)\.(.+)$/);
            let currentNamePart = '';
            if (nameParts && nameParts.length === 4) {
                currentNamePart = nameParts[2];
            } else {
                const withoutTimestamp = currentStoredFileName.startsWith(Date.now().toString().substring(0,5)) ? currentStoredFileName.substring(currentStoredFileName.indexOf('_') + 1) : currentStoredFileName;
                currentNamePart = withoutTimestamp.substring(0, withoutTimestamp.lastIndexOf('.'));
                 if (!/^[a-zA-Z0-9_]+$/.test(currentNamePart) || currentNamePart.length > 100) { 
                    currentNamePart = 'current_name'; 
                 }
            }

            Swal.fire({
                title: 'Rename Stored File Part',
                html: `Original uploaded name: <b>${originalUploadedName}</b><br>Current stored name part: <b>${currentNamePart}</b><br><br>Enter new "name" part (letters, numbers, underscore only):`,
                input: 'text',
                inputValue: currentNamePart,
                inputPlaceholder: 'New name part (e.g., my_document)',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-save me-1"></i>Rename',
                confirmButtonColor: '#007bff',
                inputValidator: (value) => {
                    if (!value || value.trim() === '') return '"Name" part cannot be empty!';
                    if (!/^[a-zA-Z0-9_]+$/.test(value)) return 'Only letters, numbers, and underscore are allowed.';
                    if (value.length > 100) return 'Name part is too long (max 100 chars).';
                    if (value.trim() === currentNamePart) return 'New name part must be different.';
                    return null;
                }
            }).then(async (result) => {
                if (result.isConfirmed && result.value) {
                    const newNamePart = result.value.trim();
                    try {
                        const response = await fetch(`/clients/files/${fileId}/rename`, { 
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': fm.csrfToken, 'Accept': 'application/json' },
                            body: JSON.stringify({ new_name_part: newNamePart }) 
                        });
                        const resData = await response.json();
                        if (resData.status) {
                            showToast(resData.msg || 'File part renamed!', 'success');
                            loadFiles(fm.currentPath);
                        } else {
                            let errorMsg = resData.msg || 'Failed to rename file part.';
                            if (resData.errors && resData.errors.new_name_part) {
                                errorMsg += ` ${resData.errors.new_name_part[0]}`;
                            }
                            showToast(errorMsg, 'error');
                        }
                    } catch (error) { showToast('Client-side error renaming file part.', 'error'); console.error(error); }
                }
            });
        } else if (copyLinkBtn) {
            event.preventDefault();
            const fileUrl = copyLinkBtn.dataset.fileurl;
            const fileName = copyLinkBtn.dataset.filename;
            navigator.clipboard.writeText(fileUrl).then(() => {
                showToast(`Download link for "${fileName}" copied!`, 'success');
            }).catch(err => {
                console.error('Failed to copy link: ', err);
                showToast('Failed to copy link. Try manually.', 'error');
            });
        }
    });
    
    fm.reloadBtn.addEventListener('click', () => {
        loadFiles(fm.currentPath);
    });

    function switchView(newView) {
        // ... (sin cambios)
        if (fm.currentView === newView) return;
        fm.currentView = newView;
        if (newView === 'list') {
            fm.viewListBtn.classList.add('active');
            fm.viewGridBtn.classList.remove('active');
            fm.listViewContainer.style.display = 'block';
            fm.gridViewContainer.style.display = 'none';
        } else {
            fm.viewGridBtn.classList.add('active');
            fm.viewListBtn.classList.remove('active');
            fm.gridViewContainer.style.display = '';
            fm.listViewContainer.style.display = 'none';
        }
        loadFiles(fm.currentPath);
    }

    fm.viewListBtn.addEventListener('click', () => switchView('list'));
    fm.viewGridBtn.addEventListener('click', () => switchView('grid'));

    // --- Dropzone siempre visible ---
    // No se necesita la lógica de fm.uploadActionBtn y fm.closeUploadAreaBtn para mostrar/ocultar
    // El contenedor fm.uploadSectionContainer ahora es visible por defecto (eliminado display:none de su HTML/CSS inicial)
    // Asegúrate de que fm_target_directory se actualice correctamente cuando cambia la carpeta actual
    // Esto ya se hace en loadFiles()


    // --- Initial Load ---
    populateDirectorySelect(fm.defaultDirStructure, ''); 
    let initialLoadPath = fm.defaultLoadPath || '';
    const defaultLoadOption = Array.from(fm.uploadTargetSelect.options).find(opt => opt.value === initialLoadPath);
    if (defaultLoadOption) { 
        fm.uploadTargetSelect.value = initialLoadPath;
    } else { 
        initialLoadPath = fm.currentPath || ''; 
        fm.uploadTargetSelect.value = initialLoadPath;
    }
    fm.uploadTargetInput.value = initialLoadPath; // Asegurar que el input oculto también se inicialice
    syncUploadLabel(); // Sincronizar la etiqueta "Upload to:"
    loadFiles(initialLoadPath); 
    initializeDropzone();
});
</script>