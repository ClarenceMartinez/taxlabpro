@php
// Helper function to generate unique IDs for copy targets (NO CHANGE)
if (!function_exists('generate_copy_id')) {
    function generate_copy_id($prefix) {
        static $counters = [];
        if (!isset($counters[$prefix])) {
            $counters[$prefix] = 0;
        }
        return $prefix . '-' . ($counters[$prefix]++); // Increment after use
    }
}
@endphp

@extends('components.layout')
@section('title', 'Developer Dashboard')

@section('styles')
{{-- Estilos específicos para esta página --}}
<style>
    /* --- ESTILOS ORIGINALES (SIN CAMBIOS) --- */
    .nav-tabs .nav-link.active {
        font-weight: bold;
    }
    .laravel-info-card .card-body { padding-top: 0.5rem; padding-bottom: 0.5rem; }
    .laravel-info-card dt { display: none; }
    .laravel-info-card dd { text-align: center; margin-bottom: 0.5rem; padding-left: 0; font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 0.9em; word-break: break-all; }
    .laravel-info-card dd .badge { display: block; margin: 0 auto; width: fit-content; }
    @media (min-width: 768px) {
        .laravel-info-card dt { display: block; font-weight: 600; text-align: right; padding-right: 0.5rem; flex: 0 0 auto; width: 120px; }
        .laravel-info-card dd { text-align: left; margin-bottom: 0.3rem; padding-left: 0.5rem; flex-basis: 0; flex-grow: 1; max-width: 100%; }
        .laravel-info-card .row > * { padding-right: calc(var(--bs-gutter-x) * .5); padding-left: calc(var(--bs-gutter-x) * .5); margin-top: var(--bs-gutter-y); }
        .laravel-info-card dd .badge { display: inline-block; margin: 0; width: auto; }
    }
    .a2a-config-list dt { font-weight: 600; word-break: keep-all; }
    .a2a-config-list dd { display: flex; align-items: center; margin-bottom: 0.5rem; min-width: 0; }
    .config-value-code { background-color: #e9ecef; border: 1px solid #ced4da; border-radius: 0.2rem; padding: 0.2em 0.5em; font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; font-size: 0.85em; color: #343a40; word-break: break-all; white-space: normal; display: inline-block; max-width: calc(100% - 40px); vertical-align: middle; flex-grow: 1; }
    .btn-copy { padding: 0.1rem 0.4rem; font-size: 0.8em; line-height: 1; margin-left: 0.5rem; vertical-align: middle; flex-shrink: 0; }
    .btn-copy .ri-check-line { color: var(--bs-success); }
    .invalid-feedback { display: none; width: 100%; margin-top: 0.25rem; font-size: .875em; color: var(--bs-danger); }
    .was-validated :invalid ~ .invalid-feedback, .was-validated :invalid.form-control { display: block; }
    .was-validated .form-control:invalid, .was-validated .form-select:invalid { border-color: var(--bs-danger); }

    /* --- NUEVOS ESTILOS --- */
    /* Fondo ligeramente más oscuro para los bloques de código de solicitud/respuesta */
    pre code.code-block {
        background-color: #e9ecef; /* Gris claro estándar */
        color: #333; /* Color de texto oscuro para contraste */
        display: block; /* Asegura que ocupe el ancho */
        padding: 1rem; /* Añade padding */
        border-radius: 0.25rem; /* Bordes redondeados */
        white-space: pre-wrap; /* Mantiene el formato pero ajusta línea */
        word-break: break-all; /* Rompe palabras largas si es necesario */
    }
</style>
@endsection

@section('content')

{{-- SECCIÓN 1: Información del Entorno Laravel (NO CHANGE) --}}
<div class="card mb-4 laravel-info-card">
    {{-- ... content ... --}}
    <h5 class="card-header d-flex justify-content-between align-items-center">
        <span>Laravel Environment</span>
        @php
            $env = config('app.env', '-');
            $badgeClass = 'bg-label-secondary';
            if ($env === 'production') $badgeClass = 'bg-label-danger';
            elseif (in_array($env, ['staging', 'testing'])) $badgeClass = 'bg-label-warning';
            elseif (in_array($env, ['local', 'development'])) $badgeClass = 'bg-label-info';
        @endphp
        <span class="badge {{ $badgeClass }}">{{ $env }}</span>
    </h5>
    <div class="card-body">
        <dl class="row mb-0">
            <dt>App Name:</dt>
            <dd>{{ config('app.name', '-') }}</dd>
            <dt>App URL:</dt>
            <dd>{{ config('app.url', '-') }}</dd>
            <dt>Timezone:</dt>
            <dd>{{ config('app.timezone', '-') }}</dd>
             <dt>Debug Mode:</dt>
             <dd>
                 @if(config('app.debug'))
                     <span class="badge bg-label-danger">Debug ON</span>
                 @else
                     <span class="badge bg-label-success">Debug OFF</span>
                 @endif
             </dd>
        </dl>
    </div>
</div>


{{-- SECCIÓN 2: Debug y Testing IRS A2A --}}
<div class="card">
    <h5 class="card-header">IRS A2A Communication Debug & Testing</h5>
    <div class="card-body">

        {{-- Tabs (NO CHANGE) --}}
        <ul class="nav nav-tabs nav-fill" id="irsA2aTabs" role="tablist">
             <li class="nav-item" role="presentation">
                <button class="nav-link active" id="production-tab" data-bs-toggle="tab" data-bs-target="#production-content" type="button" role="tab" aria-controls="production-content" aria-selected="true">
                    <i class="ri-settings-3-line me-1"></i> Production Mode
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="testing-tab" data-bs-toggle="tab" data-bs-target="#testing-content" type="button" role="tab" aria-controls="testing-content" aria-selected="false">
                    <i class="ri-flask-line me-1"></i> Testing Mode
                </button>
            </li>
        </ul>

        {{-- Contenido de los Tabs --}}
        <div class="tab-content pt-4" id="irsA2aTabsContent">

            {{-- Panel de Producción --}}
            <div class="tab-pane fade show active" id="production-content" role="tabpanel" aria-labelledby="production-tab">
                <h6 class="mb-3">Production Configuration</h6>
                {{-- Config display (NO CHANGE HERE, los <code> no son editables) --}}
                <dl class="row mb-4 a2a-config-list">
                    @php $mode = 'prod'; $key = 'client_id'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Client ID:</dt>
                    <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    {{-- ... other prod config items ... --}}
                     @php $key = 'user_id'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">User ID:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                     @php $key = 'your_transmitter_tcc'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Transmitter TCC:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                     @php $key = 'token_url'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Token URL:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'api_base_url'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">API Base URL:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'private_key_path'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                     <dt class="col-sm-4 col-md-3">Private Key Path:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'private_key_id'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                     <dt class="col-sm-4 col-md-3">Private Key ID:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                </dl>

                <h6 class="mb-3">Test Request (Production Mode)</h6>
                {{-- Use 'prod' consistently for IDs related to this form/section --}}
                <form id="test-form-production" class="needs-validation" novalidate onsubmit="return false;">
                    <div class="row g-3">
                         <div class="col-md-12">
                            <div class="form-floating form-floating-outline">
                                {{-- Use mode 'production' for ID consistency with JS --}}
                                <input type="url" class="form-control" id="endpoint-production" name="endpoint" value="{{ ($config['api_base_url'] ?? '') ? rtrim($config['api_base_url'], '/') . '' : '' }}" placeholder="Enter API Endpoint" required>
                                <label for="endpoint-production">Target Endpoint URL</label>
                                <div class="invalid-feedback">Please provide a valid endpoint URL.</div>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                {{-- MODIFICADO: Añadido readonly --}}
                                <input type="text" class="form-control" id="client-id-production" name="client_id" value="{{ $config['client_id'] ?? '' }}" placeholder="Client ID" readonly>
                                <label for="client-id-production">Client ID (Override)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating form-floating-outline">
                                {{-- MODIFICADO: Añadido readonly --}}
                                <input type="text" class="form-control" id="user-id-production" name="user_id" value="{{ $config['user_id'] ?? '' }}" placeholder="User ID" readonly>
                                <label for="user-id-production">User ID (Override)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            {{-- MODIFICADO: Cambiado btn-primary a btn-success --}}
                             <button type="button" id="btn-test-production" class="btn btn-dark waves-effect waves-light">
                                <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                Test Production Connection
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row mt-4">
                    <div class="col-12 mb-3">
                        <h6>Request Details</h6>
                        {{-- Use mode 'production' for ID consistency with JS --}}
                        <pre><code class="code-block" id="request-details-production">Click 'Test Connection' to see request details.</code></pre>
                    </div>
                    <div class="col-12">
                        <h6>Response</h6>
                         {{-- Use mode 'production' for ID consistency with JS --}}
                        <pre><code class="code-block" id="response-details-production">Response will appear here...</code></pre>
                    </div>
                </div>
            </div>

            {{-- Panel de Testing --}}
            <div class="tab-pane fade" id="testing-content" role="tabpanel" aria-labelledby="testing-tab">
                 <h6 class="mb-3">Testing Configuration</h6>
                 {{-- Config display (NO CHANGE HERE, los <code> no son editables) --}}
                 <dl class="row mb-4 a2a-config-list">
                     @php $mode = 'test'; $key = 'client_id_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Client ID (Test):</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    {{-- ... other test config items ... --}}
                    @php $key = 'user_id_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">User ID (Test):</dt>
                    <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'your_transmitter_tcc_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Transmitter TCC (Test):</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'token_url_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">Token URL (Test):</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'api_base_url_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                    <dt class="col-sm-4 col-md-3">API Base URL (Test):</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'private_key_path_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                     <dt class="col-sm-4 col-md-3">Private Key Path (Test):</dt>
                      <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                    @php $key = 'private_key_id_test'; $configValue = $config[$key] ?? '-'; $configId = generate_copy_id("code-config-$mode-$key"); @endphp
                     <dt class="col-sm-4 col-md-3">Private Key ID (Test):</dt>
                      <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1" id="{{ $configId }}">{{ $configValue }}</code>
                        <button class="btn btn-sm btn-outline-secondary btn-copy waves-effect ms-2" data-copy-target="#{{ $configId }}" title="Copy"><i class="ri-file-copy-line"></i></button>
                    </dd>
                      <dt class="col-sm-4 col-md-3">Test User IDs:</dt>
                     <dd class="col-sm-8 col-md-9">
                        <code class="config-value-code flex-grow-1">
                            @if(!empty($config['test_user_ids']) && is_array($config['test_user_ids']))
                                {{ implode(', ', $config['test_user_ids']) }}
                            @else
                                -
                            @endif
                        </code>
                     </dd>
                </dl>

                <h6 class="mb-3">Test Request (Testing Mode)</h6>
                 {{-- Use 'testing' consistently for IDs related to this form/section --}}
                 <form id="test-form-testing" class="needs-validation" novalidate onsubmit="return false;">
                     <div class="row g-3">
                         <div class="col-md-12">
                             <div class="form-floating form-floating-outline">
                                {{-- Use mode 'testing' for ID consistency with JS --}}
                                 <input type="url" class="form-control" id="endpoint-testing" name="endpoint" value="{{ ($config['api_base_url_test'] ?? '') ? rtrim($config['api_base_url_test'], '/') . '' : '' }}" placeholder="Enter API Endpoint" required>
                                 <label for="endpoint-testing">Target Endpoint URL</label>
                                 <div class="invalid-feedback">Please provide a valid endpoint URL.</div>
                             </div>
                         </div>
                          <div class="col-md-6">
                             <div class="form-floating form-floating-outline">
                                {{-- MODIFICADO: Añadido readonly --}}
                                 <input type="text" class="form-control" id="client-id-testing" name="client_id" value="{{ $config['client_id_test'] ?? '' }}" placeholder="Client ID" readonly>
                                 <label for="client-id-testing">Client ID (Override)</label>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-floating form-floating-outline">
                                {{-- MODIFICADO: Añadido readonly --}}
                                 <input type="text" class="form-control" id="user-id-testing" name="user_id" value="{{ $config['user_id_test'] ?? '' }}" placeholder="User ID" readonly>
                                 <label for="user-id-testing">User ID (Override)</label>
                             </div>
                         </div>
                         <div class="col-12">
                            {{-- MODIFICADO: Cambiado btn-info a btn-warning --}}
                             <button type="button" id="btn-test-testing" class="btn btn-warning waves-effect waves-light">
                                 <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                 Test Testing Connection
                             </button>
                         </div>
                     </div>
                 </form>

                 <div class="row mt-4">
                     <div class="col-12 mb-3">
                         <h6>Request Details</h6>
                          {{-- Use mode 'testing' for ID consistency with JS --}}
                         <pre><code class="code-block" id="request-details-testing">Click 'Test Connection' to see request details.</code></pre>
                     </div>
                     <div class="col-12">
                         <h6>Response</h6>
                         {{-- Use mode 'testing' for ID consistency with JS --}}
                         <pre><code class="code-block" id="response-details-testing">Response will appear here...</code></pre>
                     </div>
                 </div>
            </div>

        </div> {{-- End Tab Content --}}

    </div> {{-- End Card Body --}}
</div> {{-- End Card --}}

@endsection

@section('scripts')
{{-- Asegúrate de que jQuery esté cargado antes de este script --}}
{{-- Opcional: <script src="/path/to/jquery.min.js"></script> --}}
{{-- Opcional: <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script> --}}
{{-- Opcional: <script src="{{ asset('assets/js/ui-toasts.js') }}"></script> --}}

<script>
$(function () { // Usar el atajo DOM ready de jQuery
    // --- Setup ---
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const baseUrl = $('meta[name="base-url"]').attr('content');
    const testEndpointUrl = `${baseUrl}/dev/call`; // Ruta del backend

    // Configurar jQuery AJAX para incluir el token CSRF automáticamente
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json' // Encabezado Accept por defecto
        }
    });

    // --- Función Copiar --- (Usando jQuery para delegación de eventos)
    const copyToClipboard = (buttonEl) => {
        const $button = $(buttonEl);
        const targetSelector = $button.data('copy-target');
        const $targetElement = $(targetSelector);

        if (!$targetElement.length) {
            console.error('Copy target not found:', targetSelector);
            if (typeof toastr !== 'undefined') toastr.warning('Target element not found.', 'Warning');
            return;
        }

        const textToCopy = $targetElement.text().trim();
        navigator.clipboard.writeText(textToCopy).then(() => {
            const originalIconHTML = $button.html(); // Guardar HTML original (icono)
            $button.html('<i class="ri-check-line"></i>') // Cambiar a icono de check
                   .removeClass('btn-outline-secondary')
                   .addClass('btn-outline-success'); // Cambiar apariencia

            if (typeof toastr !== 'undefined') toastr.success('Copied!', '', { timeOut: 1500, closeButton: false, progressBar: false });

            setTimeout(() => {
                $button.html(originalIconHTML) // Restaurar icono original
                       .removeClass('btn-outline-success')
                       .addClass('btn-outline-secondary'); // Restaurar apariencia
            }, 1500);
        }).catch(err => {
            console.error('Error copying text: ', err);
            if (typeof toastr !== 'undefined') toastr.error('Could not copy text.', 'Error');
        });
    };

    // Usar delegación de eventos para los botones de copiar
    $(document).on('click', '.btn-copy', function() {
        copyToClipboard(this);
    });


    // --- Función Test A2A (Simplificada con jQuery AJAX) ---
    const performA2ATest = (mode) => { // mode debe ser 'production' o 'testing'
        // Usar selectores jQuery
        const $form = $(`#test-form-${mode}`);
        const $button = $(`#btn-test-${mode}`);
        const $endpointInput = $(`#endpoint-${mode}`);
        // Los inputs readonly aún pueden leerse con .val()
        const $clientIdInput = $(`#client-id-${mode}`);
        const $userIdInput = $(`#user-id-${mode}`);
        const $requestDetailsEl = $(`#request-details-${mode}`);
        const $responseDetailsEl = $(`#response-details-${mode}`);
        const $spinner = $button.find('.spinner-border');

        // Verificar si existen los elementos esenciales (jQuery devuelve colección vacía si no se encuentran)
        if (!$form.length || !$button.length || !$endpointInput.length || !$requestDetailsEl.length || !$responseDetailsEl.length) {
            console.error(`Error: Missing essential DOM elements for mode '${mode}'. Check IDs: test-form-${mode}, btn-test-${mode}, endpoint-${mode}, request-details-${mode}, response-details-${mode}`);
            if (typeof toastr !== 'undefined') toastr.error('Internal page error. Please contact support.', 'Error');
            return;
        }

        // Resetear UI
        $form.removeClass('was-validated');
        // Resetear color de texto en bloques de código al default (heredado o del estilo CSS)
        $requestDetailsEl.text('Preparing request...').css('color', '');
        $responseDetailsEl.text('Waiting for response...').css('color', '');

        // --- Validación Bootstrap 5 ---
        // Se debe usar el método nativo checkValidity() en el elemento form
        if (!$form[0].checkValidity()) {
            $form.addClass('was-validated');
            if (typeof toastr !== 'undefined') toastr.error('Please provide a valid Endpoint URL.', 'Validation Error');
            // Enfocar el primer campo inválido (usando la propiedad de elementos nativos del form)
            const firstInvalid = $form.find(':invalid').first();
            if (firstInvalid.length) {
                firstInvalid[0].focus(); // Usar focus nativo
            }
            return; // Detener si la validación falla
        }
        // --- Fin Validación ---

        // Obtener valores del formulario
        const endpoint = $endpointInput.val().trim();
        // Usar .val() que devuelve '' si el elemento no existe o está vacío
        const clientId = $clientIdInput.val() ? $clientIdInput.val().trim() : '';
        const userId = $userIdInput.val() ? $userIdInput.val().trim() : '';

        // Preparar payload de datos para el backend
        const requestData = {
            mode: mode, // 'production' o 'testing'
            endpoint: endpoint,
            // Enviar aunque estén vacíos (los inputs son readonly, así que enviarán el valor pre-cargado)
            // El backend puede decidir si usar estos o los defaults de configuración
            client_id: clientId,
            user_id: userId
        };

        // Mostrar detalles de la solicitud antes de enviar
        const requestDetailsText = `Mode: ${mode}\nEndpoint: ${endpoint}\nClient ID: ${clientId || '(Default)'}\nUser ID: ${userId || '(Default)'}\nMethod: POST\nPayload (to backend):\n${JSON.stringify(requestData, null, 2)}`;
        $requestDetailsEl.text(requestDetailsText);

        // Hacer la llamada AJAX usando jQuery
        $.ajax({
            url: testEndpointUrl,
            method: 'POST',
            contentType: 'application/json', // Estamos enviando JSON
            data: JSON.stringify(requestData), // Convertir a string el objeto de datos
            beforeSend: function() {
                // Deshabilitar botón y mostrar spinner
                $button.prop('disabled', true);
                if($spinner.length) $spinner.removeClass('d-none'); // Verificar si el spinner existe
            }
        })
        .done(function(data, textStatus, jqXHR) {
            // Éxito (código de estado 2xx)
            let formattedResponse = data; // Asumir que los datos ya están parseados si el servidor envió el Content-Type correcto
            if (typeof data !== 'string') {
                formattedResponse = JSON.stringify(data, null, 2); // Re-convertir a string para mostrar
            }
            // else: Si vino como string, mostrar tal cual.

            const responseText = `Status: ${jqXHR.status} ${jqXHR.statusText}\n\nHeaders:\n${jqXHR.getAllResponseHeaders()}\n\nBody:\n${formattedResponse}`;
            // Usar color de texto específico para éxito o dejar el default del CSS
            $responseDetailsEl.text(responseText).css('color', 'darkgreen'); // Verde oscuro para éxito
            if (typeof toastr !== 'undefined') toastr.success(`Request OK (Status ${jqXHR.status}).`, 'Test OK');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Error (código de estado no-2xx, error de red, etc.)
            let responseBody = jqXHR.responseText; // Obtener texto crudo de la respuesta
            let formattedError = responseBody;
             try {
                 // Intentar parsear si es JSON, para mejor visualización
                 const jsonData = JSON.parse(responseBody);
                 formattedError = JSON.stringify(jsonData, null, 2);
             } catch (e) {
                 // Mantener texto crudo si no es JSON
             }

            const errorText = `Error: ${jqXHR.status} ${jqXHR.statusText}\nStatus: ${textStatus}\nError Thrown: ${errorThrown}\n\nResponse Body:\n${formattedError}`;
             // Usar color de texto específico para error
            $responseDetailsEl.text(errorText).css('color', 'darkred'); // Rojo oscuro para error
            if (typeof toastr !== 'undefined') toastr.error(`Request failed (Status ${jqXHR.status}). ${errorThrown || 'Check response.'}`, 'Test Failed');
        })
        .always(function() {
            // Siempre se ejecuta después de éxito o fallo
            // Rehabilitar botón y ocultar spinner
            $button.prop('disabled', false);
            if($spinner.length) $spinner.addClass('d-none'); // Verificar si el spinner existe
        });
    };

    // --- Adjuntar Event Listeners ---
    // Usar los nombres de modo que coincidan con los IDs actualizados en el HTML ('production', 'testing')
    $('#btn-test-production').on('click', () => performA2ATest('production'));
    $('#btn-test-testing').on('click', () => performA2ATest('testing'));

}); // Fin DOM ready
</script>
@endsection