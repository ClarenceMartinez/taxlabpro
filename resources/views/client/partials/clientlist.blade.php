<style>
/* --- VISTA DE CLIENTE REDIMENSIONABLE Y RESPONSIVA --- */
.taxlab-page-container { display: flex; height: 100vh; overflow: hidden; }
#taxlab-client-sidebar { width: 380px; min-width: 50px; max-width: 800px; flex-shrink: 0; background-color: var(--theme-bg-card); height: 100%; display: flex; flex-direction: column; z-index: 1040; position: relative; container-type: inline-size; container-name: client-sidebar; transition: width 0.3s ease-in-out, min-width 0.3s ease-in-out; }
.sidebar-resizer { width: 5px; height: 100%; background-color: transparent; cursor: col-resize; flex-shrink: 0; z-index: 1041; transition: background-color 0.2s ease, display 0s 0.3s; }
#taxlab-main-content { flex-grow: 1; height: 100%; overflow-y: auto; position: relative; }
.sidebar-header { padding: 0.5rem 0.6rem; border-bottom: 1px solid var(--theme-border-soft); flex-shrink: 0; }
.sidebar-title { font-size: 0.8rem; font-weight: 600; color: var(--theme-text-dark); margin-bottom: 0; white-space: nowrap; }

/* --- CONTENEDOR DE LISTA Y CABECERA (STICKY) --- */
.client-list-container { flex-grow: 1; overflow: auto; }
.client-list-header { display: flex; align-items: stretch; padding: 0; border-bottom: 2px solid var(--theme-border-soft); background-color: var(--theme-bg-card-alt); font-size: 0.58rem; font-weight: 600; color: var(--theme-text-medium); flex-shrink: 0; position: sticky; top: 0; z-index: 10; }
.client-list-header, .client-list-item { min-width: 1400px; }
.client-list-header .sort-header { cursor: pointer; display: flex; align-items: center; gap: 0.2rem; white-space: nowrap; user-select: none; padding: 0.4rem 0.3rem; border-right: 1px solid var(--theme-border-soft); }
.client-list-header .sort-header:hover { background-color: var(--theme-bg-card); }
.client-list-header .sort-icon { font-size: 1rem; color: var(--theme-text-light); }
.client-list-header .sort-header[data-direction="asc"] .sort-icon, .client-list-header .sort-header[data-direction="desc"] .sort-icon { color: var(--theme-primary); }

/* --- DISEÑO COMPACTO Y ORDEN DE COLUMNAS --- */
/* [MODIFIED] Header status column remains for sorting, but item column is hidden. */
.client-list-header .col-status { flex: 0 0 18px; min-width: 15px;padding: 0 !important; }
.client-list-item .col-status { display: none; }
/* [REMOVED] .status-indicator is no longer used. */
.col-client { flex: 0 0 188px; /* Increased width to reclaim space */ display: flex; align-items: center; gap: 0.4rem; overflow: hidden; }
.col-owed, .col-deal { flex: 0 0 80px; text-align: right; }
.col-updated { flex: 0 0 90px; }
.col-ssn { flex: 0 0 100px; }
/* [MODIFIED] New column order reflected in flex-basis */
.col-tax_payer_email { flex: 0 0 100px; min-width: 100px; }
.col-phone_home, .col-cell_home { flex: 0 0 110px; }
.col-city { flex: 0 0 110px; }
.col-marital_status { flex: 0 0 80px; }


/* --- ESTILO DE ITEMS DE LISTA (COMPACTO) --- */
.client-list-item { display: flex; align-items: stretch; padding: 0; border-bottom: 1px solid var(--theme-border-soft); cursor: default; transition: background-color 0.2s ease; }
.client-list-item > div[class*="col-"] { display: flex; align-items: center; font-size: 0.68rem; font-weight: 500; color: var(--theme-text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 0.3rem; border-right: 1px solid var(--theme-border-soft); }
.client-list-item > div[class*="col-"] a { color: inherit; text-decoration: none; }
.client-list-item > div[class*="col-"] a:hover { color: var(--theme-primary); text-decoration: underline; }
.client-list-item:hover { background-color: var(--theme-bg-card-alt); }
.client-list-item.active { background-color: var(--theme-primary-light); }
.client-list-item.active .col-status .status-indicator { background-color: var(--theme-primary) !important; }

/* [MODIFIED] Avatar is now the primary status indicator in ALL views */
.client-list-item-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    border-width: 3px;
    border-style: solid;
    border-color: transparent; /* Default state */
}

/* [MODIFIED] Status ring colors are now globally applied */
.status-bg-unknown .client-list-item-avatar { border-color: var(--bs-secondary); }
.status-bg-open .client-list-item-avatar { border-color: var(--bs-success); }
.status-bg-in-progress .client-list-item-avatar { border-color: var(--bs-info); }
.status-bg-on-hold .client-list-item-avatar { border-color: var(--bs-warning); }
.status-bg-closed .client-list-item-avatar { border-color: var(--bs-dark); }
.client-list-item.active .client-list-item-avatar { box-shadow: 0 0 0 2px var(--theme-primary); }


.client-list-item-info { min-width: 0; }
.client-list-item-info h6 { margin-bottom: 0; font-size: 0.7rem; font-weight: 600; color: var(--theme-text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.client-list-item.active .client-link-action { color: var(--theme-text-dark) !important; }
.client-list-item-info p { margin-bottom: -2px; font-size: 0.6rem; color: var(--theme-text-medium); white-space: nowrap; }
.client-list-item .col-updated, .client-list-item .col-client .client-list-item-info p { color: var(--theme-text-light); }

/* --- VISTA SIMPLE REDISEÑADA --- */
.client-list-item-state-simple { display: none; }
#taxlab-client-sidebar.view-simple .client-list-header,
#taxlab-client-sidebar.view-simple .client-list-item { min-width: 100%; }
#taxlab-client-sidebar.view-simple .client-list-item-type { display: none; }
#taxlab-client-sidebar.view-simple .client-list-item-state-simple { display: block; }
#taxlab-client-sidebar.view-simple .client-list-item > div[class*="col-"]:not(.col-status):not(.col-client) { display: none; }
#taxlab-client-sidebar.view-simple .client-list-header .sort-header:not(.col-status):not(.col-client) { display: none; }
#taxlab-client-sidebar.view-simple .col-client { border-right: none !important; }

/* --- VISTA COLAPSADA MEJORADA --- */
#taxlab-client-sidebar.sidebar-collapsed { width: 60px !important; min-width: 60px !important; }
#taxlab-client-sidebar.sidebar-collapsed + .sidebar-resizer { display: none; }

/* [NEW] Center the header content (the buttons) when collapsed */
#taxlab-client-sidebar.sidebar-collapsed .sidebar-header > .d-flex {
    justify-content: center !important;
}
#taxlab-client-sidebar.sidebar-collapsed .sidebar-header-controls { flex-direction: column; align-items: center; gap: 0.5rem; }
#taxlab-client-sidebar.sidebar-collapsed .sidebar-title,
#taxlab-client-sidebar.sidebar-collapsed #sidebar-search-input,
#taxlab-client-sidebar.sidebar-collapsed .client-list-header,
#taxlab-client-sidebar.sidebar-collapsed .client-list-item-info { display: none; }
#taxlab-client-sidebar.sidebar-collapsed .client-list-item > div[class*="col-"] { display: none; }
#taxlab-client-sidebar.sidebar-collapsed .client-list-item { min-width: 100%; padding: 0.4rem 0; display: flex; justify-content: center; align-items: center; position: relative; height: 52px; }
#taxlab-client-sidebar.sidebar-collapsed .col-client { display: flex !important; flex-grow: 1; justify-content: center; border: none !important; padding: 0 !important; }
#taxlab-client-sidebar.sidebar-collapsed .col-client .client-link-action { padding: 0; }

/* --- Media Queries y Container Queries (sin cambios) --- */
@media (max-width: 991.98px) {
  .taxlab-page-container { flex-direction: column; height: auto; overflow: visible; }
  #taxlab-client-sidebar, #taxlab-main-content { width: 100% !important; height: auto; position: static; overflow-y: visible; border-right: none; min-width: unset; max-width: unset; }
  .sidebar-resizer { display: none; }
  .client-list-header, .client-list-item { min-width: 100%; }
}
</style>
<aside id="taxlab-client-sidebar">
    <div class="sidebar-header">
         <div class="d-flex justify-content-between align-items-center w-100">
             <h5 class="sidebar-title">Clients ({{ $clients->count() }})</h5>
             <div class="d-flex align-items-center gap-2 sidebar-header-controls">
                 <button id="add-client-btn" class="btn btn-primary btn-xs btn-icon" title="Add New Client" data-bs-toggle="modal" data-bs-target="#addClientModal"><i class="ri-user-add-line"></i></button>
                 <button id="toggle-view-btn" class="btn btn-outline-secondary btn-xs btn-icon" title="Toggle simplified view" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="ri-list-check-2"></i></button>
                 <button id="toggle-collapse-btn" class="btn btn-outline-secondary btn-xs btn-icon" title="Collapse sidebar" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="ri-menu-fold-line"></i></button>
             </div>
         </div>
         <div class="mt-2">
             <input type="text" id="sidebar-search-input" class="form-control form-control-sm" placeholder="Search clients...">
         </div>
    </div>

    <div class="client-list-container">
        <!-- [MODIFIED] Header reordered -->
        <div class="client-list-header">
             <div class="sort-header col-status" data-sort="status" data-direction="none"><i class="ri-flag-line"></i></div>
             <div class="sort-header col-client" data-sort="name" data-direction="none">Client <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-owed" data-sort="owed" data-direction="none">Owed ($) <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-deal" data-sort="deal" data-direction="none">Deal ($) <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-updated" data-sort="updated" data-direction="desc">Updated <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-ssn" data-sort="ssn" data-direction="none">SSN <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-tax_payer_email" data-sort="email" data-direction="none">Email <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-phone_home" data-sort="phone" data-direction="none">Phone <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-cell_home" data-sort="cell" data-direction="none">Cell <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-city" data-sort="city" data-direction="none">City <i class="sort-icon ri-arrow-up-down-line"></i></div>
             <div class="sort-header col-marital_status" data-sort="marital" data-direction="none">Marital <i class="sort-icon ri-arrow-up-down-line"></i></div>
        </div>
        <div id="client-list-items-wrapper">
            @include('client.partials._client_list_items', [
                'clients' => $clients,
                'client_id_active' => $client->id ?? null
            ])
        </div>
    </div>
</aside>
<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addClientForm">
                @csrf
                <div class="modal-body">
                    <div id="addClientErrors" class="alert alert-danger d-none"></div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ssn" class="form-label">SSN (Optional)</label>
                            <input type="text" class="form-control" id="ssn" name="ssn">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_birth" class="form-label">Date of Birth (Optional)</label>
                            <input type="date" class="form-control" id="date_birth" name="date_birth">
                        </div>
                    </div>
                     <small class="text-muted">More details can be added later from the client's profile.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveClientBtn">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===================================================
    // 0. HELPERS Y ESTADO GLOBAL
    // ===================================================
    let lastMousePosition = { x: 0, y: 0 };
    document.addEventListener('mousemove', function(e) {
        lastMousePosition = { x: e.pageX, y: e.pageY };
    }, { passive: true });

    function positionTooltipByCursor(e) {
        const sidebar = document.getElementById('taxlab-client-sidebar');
        if (!sidebar || !sidebar.classList.contains('sidebar-collapsed')) {
            return;
        }
        const tooltip = bootstrap.Tooltip.getInstance(e.target);
        if (!tooltip) return;
        setTimeout(() => {
            const tipEl = tooltip.getTipElement();
            if (tipEl) {
                tipEl.style.transform = 'none';
                tipEl.style.top = '0';
                tipEl.style.left = '0';
                const offsetX = 15;
                const offsetY = 10;
                tipEl.style.left = `${lastMousePosition.x + offsetX}px`;
                tipEl.style.top = `${lastMousePosition.y + offsetY}px`;
            }
        }, 0);
    }

    // ===================================================
    // 1. CACHÉ DE ELEMENTOS DEL DOM
    // ===================================================
    const sidebar = document.getElementById('taxlab-client-sidebar');
    const resizer = document.querySelector('.sidebar-resizer');
    const clientListContainer = document.querySelector('.client-list-container');
    const clientListHeader = document.querySelector('.client-list-header');
    const clientCountElement = document.querySelector('.sidebar-title');
    const clientItemsWrapper = document.getElementById('client-list-items-wrapper');
    const toggleCollapseBtn = document.getElementById('toggle-collapse-btn');
    const toggleViewBtn = document.getElementById('toggle-view-btn');

    // ===================================================
    // 2.5. PERSISTENCIA DE ESTADO (LOCALSTORAGE)
    // ===================================================
    const STORAGE_KEYS = {
        VIEW_MODE: 'taxlab_sidebar_view_mode',
        IS_COLLAPSED: 'taxlab_sidebar_is_collapsed',
        WIDTH: 'taxlab_sidebar_width'
    };

    function applySavedSettings() {
        if (!sidebar) return;
        const savedViewMode = localStorage.getItem(STORAGE_KEYS.VIEW_MODE);
        if (savedViewMode === 'simple' && toggleViewBtn) {
            sidebar.classList.add('view-simple');
            const icon = toggleViewBtn.querySelector('i');
            icon.className = 'ri-list-unordered';
            const newTitle = 'Show detailed view';
            toggleViewBtn.setAttribute('title', newTitle);
            const tooltip = bootstrap.Tooltip.getInstance(toggleViewBtn);
            if (tooltip) tooltip.setContent({ '.tooltip-inner': newTitle });
        }

        const isCollapsed = localStorage.getItem(STORAGE_KEYS.IS_COLLAPSED) === 'true';
        if (isCollapsed && toggleCollapseBtn) {
            sidebar.classList.add('sidebar-collapsed');
            const icon = toggleCollapseBtn.querySelector('i');
            icon.className = 'ri-menu-unfold-line';
            const newTitle = 'Expand sidebar';
            toggleCollapseBtn.setAttribute('title', newTitle);
            const tooltip = bootstrap.Tooltip.getInstance(toggleCollapseBtn);
            if (tooltip) tooltip.setContent({ '.tooltip-inner': newTitle });
        }

        const savedWidth = localStorage.getItem(STORAGE_KEYS.WIDTH);
        if (savedWidth && !sidebar.classList.contains('sidebar-collapsed')) {
            sidebar.style.width = savedWidth;
        }
        updateTooltipsForViewState();
    }

    // ===================================================
    // 2. LÓGICA DE FUNCIONALIDAD DEL SIDEBAR (UI)
    // ===================================================
    function updateTooltipsForViewState() {
        const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
        const clientItems = document.querySelectorAll('.client-list-item[data-bs-toggle="tooltip"]');
        clientItems.forEach(item => {
            let tooltip = bootstrap.Tooltip.getInstance(item);
            if (!tooltip) {
                tooltip = new bootstrap.Tooltip(item, {
                    boundary: 'window',
                    fallbackPlacements: ['right', 'left', 'top', 'bottom']
                });
            }
            isCollapsed ? tooltip.enable() : tooltip.disable();
        });
    }

    if (toggleCollapseBtn && sidebar) {
        toggleCollapseBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
            const icon = toggleCollapseBtn.querySelector('i');
            icon.className = isCollapsed ? 'ri-menu-unfold-line' : 'ri-menu-fold-line';
            const newTitle = isCollapsed ? 'Expand sidebar' : 'Collapse sidebar';
            toggleCollapseBtn.setAttribute('title', newTitle);
            const tooltip = bootstrap.Tooltip.getInstance(toggleCollapseBtn);
            if (tooltip) tooltip.setContent({ '.tooltip-inner': newTitle });
            localStorage.setItem(STORAGE_KEYS.IS_COLLAPSED, isCollapsed);
            updateTooltipsForViewState();
        });
    }

    if (toggleViewBtn && sidebar) {
        toggleViewBtn.addEventListener('click', () => {
            sidebar.classList.toggle('view-simple');
            const isSimpleView = sidebar.classList.contains('view-simple');
            const icon = toggleViewBtn.querySelector('i');
            icon.className = isSimpleView ? 'ri-list-unordered' : 'ri-list-check-2';
            const newTitle = isSimpleView ? 'Show detailed view' : 'Show simplified view';
            toggleViewBtn.setAttribute('title', newTitle);
            const tooltip = bootstrap.Tooltip.getInstance(toggleViewBtn);
            if (tooltip) tooltip.setContent({ '.tooltip-inner': newTitle });
            localStorage.setItem(STORAGE_KEYS.VIEW_MODE, isSimpleView ? 'simple' : 'detailed');
        });
    }

    let isResizing = false;
    if (resizer && sidebar) {
        resizer.addEventListener('mousedown', function (e) {
            if (sidebar.classList.contains('sidebar-collapsed')) return;
            e.preventDefault();
            isResizing = true;
            document.body.style.cursor = 'col-resize';
            document.body.style.userSelect = 'none';
            document.addEventListener('mousemove', handleMouseMove);
            document.addEventListener('mouseup', stopResize, { once: true });
        });
    }

    function handleMouseMove(e) {
        if (!isResizing) return;
        const containerOffsetLeft = document.querySelector('.taxlab-page-container').offsetLeft;
        let newWidth = e.clientX - containerOffsetLeft;
        const minWidth = 180;
        const maxWidth = 800;
        if (newWidth < minWidth) newWidth = minWidth;
        if (newWidth > maxWidth) newWidth = maxWidth;
        sidebar.style.width = newWidth + 'px';
    }

    function stopResize() {
        if (!isResizing) return;
        isResizing = false;
        document.body.style.cursor = 'default';
        document.body.style.userSelect = 'auto';
        document.removeEventListener('mousemove', handleMouseMove);
        if (!sidebar.classList.contains('sidebar-collapsed')) {
            localStorage.setItem(STORAGE_KEYS.WIDTH, sidebar.style.width);
        }
    }

    // ===================================================
    // 3. LÓGICA ENCAPSULADA DE LA LISTA (ORDENAR, BUSCAR, ETC.)
    // ===================================================
    function initializeSorting() {
        if (!clientListHeader || !clientItemsWrapper) return;

        clientListHeader.addEventListener('click', (e) => {
            const header = e.target.closest('.sort-header');
            if (!header) return;

            const sortKey = header.dataset.sort;
            if (!sortKey || sortKey === 'status') return;

            const currentDirection = header.dataset.direction;
            let newDirection;

            if (clientListHeader.querySelector('.sort-header[data-direction="asc"], .sort-header[data-direction="desc"]') !== header) {
                newDirection = (sortKey === 'updated') ? 'desc' : 'asc';
            } else {
                newDirection = (currentDirection === 'asc') ? 'desc' : 'asc';
            }

            clientListHeader.querySelectorAll('.sort-header').forEach(th => th.dataset.direction = 'none');
            header.dataset.direction = newDirection;

            const items = Array.from(clientItemsWrapper.querySelectorAll('.client-list-item'));
            
            items.sort((a, b) => {
                let valA, valB;
                switch(sortKey) {
                    case 'name':
                        valA = a.querySelector('.col-client h6').textContent.trim().toLowerCase();
                        valB = b.querySelector('.col-client h6').textContent.trim().toLowerCase();
                        return valA.localeCompare(valB);
                    case 'owed':
                    case 'deal':
                        valA = parseFloat(a.querySelector(`.col-${sortKey}`).textContent.replace(/[$,]/g, '')) || 0;
                        valB = parseFloat(b.querySelector(`.col-${sortKey}`).textContent.replace(/[$,]/g, '')) || 0;
                        return valA - valB;
                    case 'updated':
                        const dateA = a.querySelector('.col-updated').textContent.trim().split('/');
                        const dateB = b.querySelector('.col-updated').textContent.trim().split('/');
                        valA = new Date(`${dateA[2]}-${dateA[0]}-${dateA[1]}`);
                        valB = new Date(`${dateB[2]}-${dateB[0]}-${dateB[1]}`);
                        return valA - valB;
                    default:
                        valA = (a.querySelector(`.col-${sortKey}`)?.textContent || '').trim().toLowerCase();
                        valB = (b.querySelector(`.col-${sortKey}`)?.textContent || '').trim().toLowerCase();
                        return valA.localeCompare(valB);
                }
            });

            if (newDirection === 'desc') {
                items.reverse();
            }

            clientItemsWrapper.innerHTML = '';
            const fragment = document.createDocumentFragment();
            items.forEach(item => fragment.appendChild(item));
            clientItemsWrapper.appendChild(fragment);
        });
    }

    function initializeClientListFunctionality() {
        updateTooltipsForViewState();
        
        const controlTooltips = document.querySelectorAll('.sidebar-header-controls [data-bs-toggle="tooltip"]');
        controlTooltips.forEach(el => {
            if (!bootstrap.Tooltip.getInstance(el)) new bootstrap.Tooltip(el);
        });

        const searchInput = document.getElementById('sidebar-search-input');
        if (searchInput) {
            searchInput.addEventListener('keyup', () => {
                const filter = searchInput.value.toUpperCase();
                clientItemsWrapper.querySelectorAll('.client-list-item').forEach(item => {
                    const clientName = item.querySelector('.client-list-item-info h6')?.textContent.toUpperCase();
                    item.style.display = (clientName && clientName.includes(filter)) ? "flex" : "none";
                });
            });
        }
        
        clientListContainer.addEventListener('click', function(event) {
            const clientLink = event.target.closest('.client-link-action');
            if (clientLink) {
                event.preventDefault(); 
                const clientId = clientLink.dataset.clientId;
                const clientNameElement = clientLink.querySelector('h6');
                const clientName = clientNameElement ? clientNameElement.textContent.trim() : 'Unknown Client';
                const clientListItem = clientLink.closest('.client-list-item');
                console.log(`Acción de cliente disparada para: ${clientName} (ID: ${clientId})`);
                const currentlyActive = clientListContainer.querySelector('.client-list-item.active');
                if (currentlyActive) {
                    currentlyActive.classList.remove('active');
                }
                if (clientListItem) {
                    clientListItem.classList.add('active');
                }
            }
        });
        
        clientListContainer.removeEventListener('show.bs.tooltip', positionTooltipByCursor);
        clientListContainer.addEventListener('show.bs.tooltip', positionTooltipByCursor);
        
        initializeSorting();
    }

    // ===================================================
    // 4. LÓGICA DEL MODAL PARA AÑADIR CLIENTE 
    // ===================================================
    const addClientModalEl = document.getElementById('addClientModal');
    if (addClientModalEl) {
        const addClientModal = new bootstrap.Modal(addClientModalEl);
        const addClientForm = document.getElementById('addClientForm');
        const saveClientBtn = document.getElementById('saveClientBtn');
        const errorContainer = document.getElementById('addClientErrors');
        const spinner = saveClientBtn.querySelector('.spinner-border');

        addClientForm.addEventListener('submit', function (e) {
            e.preventDefault();
            saveClientBtn.disabled = true;
            spinner.classList.remove('d-none');
            errorContainer.classList.add('d-none');
            errorContainer.innerHTML = '';
            const formData = new FormData(addClientForm);
            
            fetch('{{ route("clients.quick.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => { throw errorData; });
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    addClientModal.hide();
                    addClientForm.reset();
                    if (clientItemsWrapper && data.new_html) {
                        clientItemsWrapper.innerHTML = data.new_html;
                    }
                    if (clientCountElement && typeof data.new_count !== 'undefined') {
                        clientCountElement.textContent = `Clients (${data.new_count})`;
                    }
                    initializeClientListFunctionality();
                }
            })
            .catch(error => {
                let errorMessage = 'An unexpected error occurred. Please try again.';
                if (error && error.errors) {
                    let errorList = '<ul>';
                    for (const key in error.errors) {
                        errorList += `<li>${error.errors[key][0]}</li>`;
                    }
                    errorList += '</ul>';
                    errorMessage = errorList;
                } else if (error && error.msg) {
                    errorMessage = error.msg;
                }
                errorContainer.innerHTML = errorMessage;
                errorContainer.classList.remove('d-none');
            })
            .finally(() => {
                saveClientBtn.disabled = false;
                spinner.classList.add('d-none');
            });
        });
        addClientModalEl.addEventListener('hidden.bs.modal', function () {
            addClientForm.reset();
            errorContainer.classList.add('d-none');
            errorContainer.innerHTML = '';
        });
    }

    // ===================================================
    // 5. LÓGICA DE LARAVEL ECHO Y REVERB
    // ===================================================
     @auth
        const userCompanyId = {{ auth()->user()->company_id ?? 'null' }};
        const currentUserId = {{ auth()->id() }};

        if (userCompanyId && window.Echo) {
            console.log(`[Reverb] Subscribing to private channel: company.${userCompanyId}.clients`);
            window.Echo.private(`company.${userCompanyId}.clients`)
                .listen('.client.list.updated', (e) => {
                    console.log('[Reverb] Event "client.list.updated" received:', e);
                    
                    if (clientCountElement && typeof e.clientCount !== 'undefined') {
                        clientCountElement.textContent = `Clients (${e.clientCount})`;
                        console.log(`[UI] Client count updated to ${e.clientCount}.`);
                    }
                    
                    console.log('[Fetch] Requesting new client list HTML from server...');
                    const activeClientItem = clientListContainer.querySelector('.client-list-item.active');
                    const activeClientId = activeClientItem ? activeClientItem.dataset.clientId : null;
                    let fetchUrl = '{{ route("clients.list.html") }}';
                    if (activeClientId) {
                        fetchUrl += `?active_client_id=${activeClientId}`;
                    }
                    
                    fetch(fetchUrl)
                        .then(response => {
                            if (!response.ok) throw new Error(`Network response was not ok (status: ${response.status})`);
                            return response.text();
                        })
                        .then(html => {
                            if (clientItemsWrapper) {
                                clientItemsWrapper.innerHTML = html;
                                console.log('[UI] Client list HTML has been replaced correctly.');
                            }
                            initializeClientListFunctionality();
                            console.log('[JS] Client list functionality has been re-initialized.');
                        })
                        .catch(error => {
                            console.error('[Fetch] Error fetching or updating client list:', error);
                        });
                })
                .error((error) => {
                    console.error('[Reverb] Subscription to channel failed:', error);
                });
        }
    @endauth
    
    // ===================================================
    // 6. LLAMADA INICIAL
    // ===================================================
    applySavedSettings();
    initializeClientListFunctionality();
});
</script>
