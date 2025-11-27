
<style>
    /* --- THEME VARIABLES (Dependencia para los estilos de la vista) --- */
    :root {
        --theme-font-family: 'Poppins', sans-serif;
        --theme-primary: #6366F1;
        --theme-primary-hover: #4F46E5;
        --theme-primary-light: #E0E7FF;
        --theme-primary-dark: #3730A3;
        --theme-primary-text-on-light: #4338CA;
        --theme-accent: #14B8A6;
        --theme-accent-hover: #0D9488;
        --theme-accent-light: #F0FDFA;
        --theme-bg-main: #F1F5F9;
        --theme-bg-card: #FFFFFF;
        --theme-bg-card-alt: #F8FAFC;
        --theme-text-dark: #1E293B;
        --theme-text-medium: #475569;
        --theme-text-light: #94A3B8;
        --theme-text-inverted: #FFFFFF;
        --theme-border-strong: #CBD5E1;
        --theme-border-soft: #E2E8F0;
        --theme-border-interactive: var(--theme-primary);
        --theme-success: #22C55E;
        --theme-warning: #F59E0B;
        --theme-danger: #EF4444;
        --theme-info: #3B82F6;
        --theme-border-radius-sm: 0.15rem;
        --theme-border-radius-md: 0.25rem;
        --theme-border-radius-lg: 0.4rem;
        --theme-shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        --theme-shadow-card: 0 2px 4px -1px rgba(0, 0, 0, 0.05), 0 1px 2px -2px rgba(0, 0, 0, 0.05);
        --theme-shadow-interactive: 0 0 0 2px rgba(var(--theme-primary-rgb), 0.2);
        --theme-primary-rgb: 99, 102, 241;
        /* Se mantienen variables de Bootstrap por si son usadas por JS o componentes no visibles */
        --bs-primary: var(--theme-primary);
        --bs-primary-rgb: var(--theme-primary-rgb);
        --bs-secondary: var(--theme-text-medium);
        --bs-success: var(--theme-success);
        --bs-info: var(--theme-info);
        --bs-warning: var(--theme-warning);
        --bs-danger: var(--theme-danger);
        --bs-light: var(--theme-bg-card-alt);
        --bs-dark: var(--theme-text-dark);
        --bs-body-color: var(--theme-text-medium);
        --bs-body-bg: var(--theme-bg-main);
        --bs-border-color: var(--theme-border-soft);
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.5rem;
    }

    /* --- ESTILOS GENERALES Y DE COMPONENTES USADOS EN LA VISTA --- */
    a { color: var(--theme-primary); text-decoration: none; }
    a:hover { color: var(--theme-primary-hover); }

    .card {
        border: 1px solid var(--theme-border-soft);
        box-shadow: var(--theme-shadow-card);
        background-color: var(--theme-bg-card);
        border-radius: var(--theme-border-radius-md);
    }
    .card-body { padding: 0.6rem; font-size: 0.65rem; color: var(--theme-text-medium); }

    .client-profile-header .card-body { padding: 0.6rem; }
    .client-profile-header .client-avatar img {
        width: 40px; height: 40px; border-radius: 50%;
        border: 2px solid var(--theme-primary-light);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .client-profile-header .client-info-main h4 { font-size: 1rem; font-weight: 600; color: var(--theme-text-dark); }
    .client-profile-header .client-contact-info {
        font-size: 0.65rem; color: var(--theme-text-medium); margin-top: 0.1rem; flex-wrap: wrap;
    }
    .client-profile-header .client-contact-info > span,
    .client-profile-header .client-contact-info > a {
        display: inline-flex; align-items: center; margin-right: 0.5rem; margin-bottom: 0.1rem;
    }
    .client-profile-header .client-contact-info i { color: var(--theme-primary); font-size: 0.75rem; }
    .case-status-indicator-header {
        border: 1px solid var(--theme-border-soft); padding: 0.15rem 0.5rem; border-radius: 1rem;
        background-color: var(--theme-bg-card-alt); flex-shrink: 0;
    }
    .case-status-indicator-header .status-dot { width: 7px; height: 7px; border-radius: 50%; }
    .case-status-indicator-header h5 { font-size: 0.65rem; font-weight: 600; margin-bottom: 0; }
    .case-status-indicator-header .dropdown-toggle { width: 18px; height: 18px; }
    .client-profile-header .client-stats-bar { gap: 1.5rem; flex-wrap: wrap; text-align: center; }
    .client-profile-header .client-stats-bar .header-stat-item,
    .client-profile-header .client-stats-bar .tax-owed-info {
        display: flex; flex-direction: column; align-items: center;
    }
    .client-profile-header .client-stats-bar p {
        font-size: 0.55rem; color: var(--theme-text-light); margin-bottom: 0;
        text-transform: uppercase; font-weight: 500;
    }
    .client-profile-header .client-stats-bar h5 {
        font-size: 0.9rem; font-weight: 600; color: var(--theme-text-dark); margin-bottom: 0;
    }
    .client-profile-header .tax-owed-info h5.value-unknown { color: var(--theme-text-light); font-style: italic; font-weight: 500; }
    .status-dot { width: 7px; height: 7px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
    .bg-success, .status-open .status-dot { background-color: var(--theme-success) !important; }
    .bg-danger, .status-closed .status-dot { background-color: var(--theme-danger) !important; }
    .bg-info, .status-in-progress .status-dot { background-color: var(--theme-info) !important; }
    .bg-warning, .status-on-hold .status-dot { background-color: var(--theme-warning) !important; }
    .bg-secondary, .status-unknown .status-dot { background-color: var(--theme-text-light) !important; }
    .status-open h5 { color: var(--theme-success); }
    .status-closed h5 { color: var(--theme-danger); }
    .status-in-progress h5 { color: var(--theme-info); }
    .status-on-hold h5 { color: var(--theme-warning); }

    #clientProfileTabs {
        border: 1px solid var(--theme-border-soft); border-bottom: none; background-color: #e0e7ff;
        padding: 0.1rem 0.2rem 0; border-top-left-radius: var(--theme-border-radius-md); border-top-right-radius: var(--theme-border-radius-md);
    }
    #clientProfileTabs .nav-link {
        color: var(--theme-text-medium); font-size: 0.68rem; font-weight: 500;
        padding: 0.3rem 0.6rem; border: none; border-bottom: 2px solid transparent; margin-bottom: -1px;
    }
    #clientProfileTabs .nav-link:hover,
    #clientProfileTabs .nav-link:focus { color: var(--theme-primary); border-bottom-color: var(--theme-primary-light); }
    #clientProfileTabs .nav-link.active {
        color: var(--theme-primary-dark); background-color: var(--theme-bg-card);
        border-bottom-color: var(--theme-primary); font-weight: 600;
    }
    #clientProfileTabsContent {
        background-color: var(--theme-bg-card); border: 1px solid var(--theme-border-soft); border-top: none;
        padding: 0 0.2rem; border-bottom-left-radius: var(--theme-border-radius-md); border-bottom-right-radius: var(--theme-border-radius-md);
        min-height: 220px;
    }
    .tab-pane-title { font-size: 0.8rem; font-weight: 600; color: var(--theme-text-dark); margin-bottom: 0.5rem; }

    .btn { font-size: 0.65rem; font-weight: 500; border-radius: var(--theme-border-radius-sm); padding: 0.2rem 0.45rem; letter-spacing: 0.01em; box-shadow: var(--theme-shadow-subtle); transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; }
    .btn:hover { box-shadow: var(--theme-shadow-card); }
    .btn-xs { padding: 0.1rem 0.3rem; font-size: 0.55rem; }
    .btn-icon { display: inline-flex; align-items: center; justify-content: center; padding: 0; width: 22px; height: 22px; }

    .form-control, .form-select { font-size: 0.65rem; border-radius: var(--theme-border-radius-sm); border: 1px solid var(--theme-border-strong); padding: 0.2rem 0.4rem; background-color: var(--theme-bg-card); color: var(--theme-text-medium); }
    .form-control:focus, .form-select:focus { border-color: var(--theme-primary); box-shadow: var(--theme-shadow-interactive); }

    /* Style for the empty state card */
    .empty-state-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding: 1rem;
    }
    .empty-state-card {
        text-align: center;
        max-width: 450px;
    }
     .empty-state-card .card-body {
        padding: 2rem;
     }
    .empty-state-card i {
        font-size: 3rem;
        color: var(--theme-primary-light);
        margin-bottom: 1rem;
    }
    .empty-state-card h4 {
        color: var(--theme-text-dark);
        font-weight: 600;
    }
     .empty-state-card p {
        color: var(--theme-text-medium);
     }
    
    /* Estilos para el modal */
    .modal-body .form-label {
        font-size: 0.6rem;
        text-transform: uppercase;
        font-weight: 600;
        color: var(--theme-text-medium);
        margin-bottom: 0.1rem;
    }
    .modal-body h6 {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--theme-primary-dark);
        margin-top: 0.8rem;
        margin-bottom: 0.5rem;
        padding-bottom: 0.2rem;
        border-bottom: 1px solid var(--theme-border-soft);
    }

    /* --- NUEVAS CLASES PARA LA TRANSICIÓN DE CONTENIDO --- */
    .main-content-area {
        position: relative; /* Necesario para el loader */
        transition: opacity 0.25s ease-out;
        opacity: 1;
    }

    .main-content-area.loading {
        opacity: 0.3;
        pointer-events: none; /* Evita clics mientras se carga */
    }

    /* Opcional: Un spinner de carga bonito que puedes mostrar */
    .main-content-area .content-loader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }

    .main-content-area.loading .content-loader {
        opacity: 1;
        visibility: visible;
    }
</style>

<div class="taxlab-page-container">
    
    @include('client.partials.clientlist')

    <!-- Manejador para redimensionar (simulado) -->
    <div id="sidebar-resizer" class="sidebar-resizer"></div>

    <!-- Main Content -->
    <main id="taxlab-main-content">

    @if(isset($client))

      <div class="main-content-area">
        @include('client.partials.main-info-client')
      </div>
      <!-- =================================================================== -->
      <!-- ==================   FIN DEL MODAL DE EDICIÓN   =================== -->
      <!-- =================================================================== -->


    @else

      <div class="main-content-area empty-state-container">
          <div class="card empty-state-card">
              <div class="card-body">
                  <i class="ri-user-search-line"></i>
                  <h4>No Client Selected</h4>
                  <p>Please select a client from the list on the left to view their profile details.</p>
              </div>
          </div>
      </div>

    @endif
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- ELEMENTOS Y VARIABLES GLOBALES ---
    const clientListContainer = document.getElementById('client-list-items-wrapper');
    // Usamos el contenedor estático principal para la delegación de eventos
    const mainContentContainer = document.getElementById('taxlab-main-content'); 

    // --- RUTAS GENERADAS POR LARAVEL (SEGURAS Y FIABLES) ---
    const clientDetailUrl = '{{ route("clients.details.ajax") }}';
    const clientHeaderUrl = '{{ route("clients.header.ajax") }}';
    const clientUpdateUrlTemplate = '{{ route("clients.update.ajax", ["client" => "CLIENT_ID_PLACEHOLDER"]) }}';
    // Plantilla de URL para la actualización de estado (SIN model binding)
    const clientStatusUpdateUrlTemplate = '{{ route("clients.status.update", ["clientId" => "CLIENT_ID_PLACEHOLDER"]) }}';
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const authUserId = {{ Auth::id() ?? 'null' }};

    // --- FUNCIONES PRINCIPALES ---

    /**
     * Obtiene el ID del cliente que se está viendo actualmente en la página.
     * @returns {number|null}
     */
    function getCurrentClientId() {
        const mainContentArea = mainContentContainer.querySelector('.main-content-area');
        if (!mainContentArea) return null;
        const clientIdxInput = mainContentArea.querySelector('#client_idx');
        return clientIdxInput ? parseInt(clientIdxInput.value, 10) : null;
    }

    /**
     * Carga el panel completo de un cliente vía AJAX. Se usa al hacer clic en un nuevo cliente.
     * @param {number} clientId - El ID del cliente a cargar.
     */
    async function loadClientDetails(clientId) {
        const mainContentArea = mainContentContainer.querySelector('.main-content-area');
        if (!mainContentArea) return;
        mainContentArea.classList.add('loading');
        
        try {
            const postData = new FormData();
            postData.append('client_id', clientId);

            const response = await fetch(clientDetailUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: postData
            });
            const data = await response.json();
            if (!data.success) throw new Error(data.message || 'Failed to load client details.');

            mainContentArea.innerHTML = data.html;
            updateActiveClientInList(clientId);
            history.pushState({ clientId: clientId }, '', window.location.pathname);
            
            // ¡CRÍTICO! Volver a inicializar todos los scripts para el nuevo contenido.
            initializeMainContentScripts();
            
        } catch (error) {
            console.error('Error in loadClientDetails:', error);
            alert('Could not load client profile.');
        } finally {
            mainContentArea.classList.remove('loading');
        }
    }

    /**
     * Refresca solo el panel del cliente (header y tabs) vía AJAX. Se usa para actualizaciones en tiempo real.
     * @param {number} clientId - El ID del cliente a refrescar.
     */
    async function refreshClientPanel(clientId) {
        const mainContentArea = mainContentContainer.querySelector('.main-content-area');
        if (!mainContentArea) return;
        
        // No se aplica feedback de opacidad aquí, porque la actualización debe ser instantánea y sin parpadeo
        
        try {
            const postData = new FormData();
            postData.append('client_id', clientId);

            const response = await fetch(clientDetailUrl, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: postData
            });
            const data = await response.json();
            if (!data.success) throw new Error(data.message || 'Failed to refresh client panel.');

            mainContentArea.innerHTML = data.html;
            
            // ¡CRÍTICO! Volver a inicializar todos los scripts para el nuevo contenido.
            initializeMainContentScripts();
            
        } catch (error) {
            console.error('Error in refreshClientPanel:', error);
        }
    }

    /**
     * Marca el cliente activo en la lista de la izquierda.
     * @param {number} clientId 
     */
    function updateActiveClientInList(clientId) {
        if (!clientListContainer) return;
        const currentActive = clientListContainer.querySelector('.client-list-item.active');
        if (currentActive) currentActive.classList.remove('active');
        const newActive = clientListContainer.querySelector(`.client-list-item[data-client-id="${clientId}"]`);
        if (newActive) newActive.classList.add('active');
    }

    /**
     * Esta es la función clave. Inicializa todos los scripts interactivos dentro del panel del cliente.
     * Se debe llamar CADA VEZ que el contenido de `main-content-area` se reemplaza.
     */
    function initializeMainContentScripts() {
        console.log("Attempting to initialize main content scripts...");
        
        // Se apunta a mainContentContainer para buscar dentro del contenido recién cargado
        const mainContentArea = mainContentContainer.querySelector('.main-content-area');
        if (!mainContentArea) return;

        const editClientButton = mainContentArea.querySelector('.edit-client');
        const editClientModalEl = document.getElementById('editClientModal');

        if (!editClientButton || !editClientModalEl) {
            console.warn("Could not find 'edit-client' button or 'editClientModal' element. Modal functionality will be disabled for this view.");
            // No detenemos la ejecución, otros scripts podrían inicializarse
        } else {
            console.log("Modal elements found. Initializing...");

            const editClientForm = document.getElementById('editClientForm');
            const saveButton = document.getElementById('saveClientButton');
            const clientModal = new bootstrap.Modal(editClientModalEl);

            editClientButton.onclick = () => clientModal.show();

            if (editClientForm && saveButton) {
                editClientForm.onsubmit = function(event) {
                    event.preventDefault();
                    const spinner = saveButton.querySelector('.spinner-border');
                    saveButton.disabled = true;
                    if(spinner) spinner.classList.remove('d-none');

                    const formData = new FormData(editClientForm);
                    formData.append('_method', 'PUT');

                    const clientId = formData.get('client_id');
                    const updateUrl = clientUpdateUrlTemplate.replace('CLIENT_ID_PLACEHOLDER', clientId);

                    fetch(updateUrl, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) return response.json().then(err => Promise.reject(err));
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            // En lugar de un alert, podrías usar una notificación no bloqueante (Toast)
                            console.log('Client updated successfully! UI will refresh via Echo.');
                            clientModal.hide();
                        }
                    })
                    .catch(error => {
                        console.error('Update operation failed:', error);
                        let msg = error.message || 'An unexpected error occurred.';
                        if(error.errors) msg = 'Validation failed:\n' + Object.values(error.errors).flat().join('\n');
                        alert(msg);
                    })
                    .finally(() => {
                        saveButton.disabled = false;
                        if(spinner) spinner.classList.add('d-none');
                    });
                };
            }
        }
        
        // Inicializar otros componentes como el toggle de SSN y los tooltips de Bootstrap
        const ssnToggle = mainContentArea.querySelector('#ssn-toggle');
        if (ssnToggle) {
            ssnToggle.onclick = function() {
                const ssnMasked = mainContentArea.querySelector('.ssn-masked');
                const ssnRevealed = mainContentArea.querySelector('.ssn-revealed');
                const isHidden = ssnRevealed.style.display === 'none';
                ssnMasked.style.display = isHidden ? 'none' : 'inline';
                ssnRevealed.style.display = isHidden ? 'inline' : 'none';
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            };
        }
        const tooltipTriggerList = [].slice.call(mainContentArea.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // --- EVENT LISTENERS (Se adjuntan una sola vez a elementos estáticos) ---

    // 1. Listener para clics en la lista de clientes
    if (clientListContainer) {
        clientListContainer.addEventListener('click', function(event) {
            const clientLink = event.target.closest('.client-link-action');
            if (!clientLink) return;
            event.preventDefault();
            const clientId = parseInt(clientLink.dataset.clientId, 10);
            if (clientId !== getCurrentClientId()) {
                loadClientDetails(clientId);
            }
        });
    }
    
    // 2. Listener para acciones dentro del panel de contenido principal (usando delegación de eventos)
    if (mainContentContainer) {
        mainContentContainer.addEventListener('click', async function(event) {
            // Manejador para el cambio de estado del caso
            const statusLink = event.target.closest('.change-case-status');
            if (statusLink) {
                event.preventDefault();

                const clientId = statusLink.dataset.idx;
                const newStatus = statusLink.dataset.case;
                const headerCard = mainContentContainer.querySelector('.client-profile-header');
                
                // Feedback visual inmediato
                if (headerCard) headerCard.style.opacity = '0.5';

                try {
                    const updateUrl = clientStatusUpdateUrlTemplate.replace('CLIENT_ID_PLACEHOLDER', clientId);

                    const response = await fetch(updateUrl, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ case_status: newStatus })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to update status.');
                    }

                    // ÉXITO: No se hace nada en la UI. Se espera el evento de Echo.
                    console.log('Status update request sent. Waiting for Echo event to refresh UI.');

                } catch (error) {
                    console.error('Error updating client status:', error);
                    alert('Could not update client status: ' + error.message);
                    // Si falla, restauramos la UI
                    if (headerCard) headerCard.style.opacity = '1';
                }
            }
            // Aquí se podrían añadir otros manejadores de eventos delegados si es necesario
        });
    }

    // 3. Listener para eventos de WebSocket (Echo/Reverb)
    @if(Auth::user() && Auth::user()->company_id)
        const companyId = {{ Auth::user()->company_id }};
        window.Echo.private(`company.${companyId}.clients`)
            .listen('.client.list.updated', (e) => {
                console.log('[Echo] List update event received.', e);
                // Aquí podrías implementar la lógica para refrescar la lista de clientes
            })
            .listen('.client.profile.updated', (e) => {
                console.log(`[Echo] Profile update event for client ${e.clientId} received.`);
                // Si estamos viendo el cliente que se actualizó, refrescamos su panel completo.
                if (e.clientId === getCurrentClientId()) {
                    console.log(`Refreshing panel for client ${e.clientId}...`);
                    refreshClientPanel(e.clientId);
                }
            });
    @endif

    // --- LLAMADA INICIAL AL CARGAR LA PÁGINA ---
    // Esto asegura que el modal y otros scripts funcionen para el primer cliente que se carga con la página.
    initializeMainContentScripts();

});
</script>