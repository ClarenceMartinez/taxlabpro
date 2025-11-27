{{--
    File: resources/views/client/sections/user-dashboard.blade.php
    Purpose: Main dashboard view for the user. (V3 - Compact Layout)
--}}

{{-- Se añaden estilos específicos para esta vista del dashboard --}}
<style>
    /* -- ESTILOS PARA LA VERSIÓN COMPACTA -- */
    .dashboard-container {
        padding: 1rem; /* Padding reducido */
        height: 100%;
        overflow-y: auto;
        background-color: var(--theme-bg-main);
    }
    
    .dashboard-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    .user-avatar {
        width: 40px; /* Avatar más pequeño */
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--theme-primary-light);
        margin-right: 0.75rem;
    }
    .dashboard-header .header-info h5 {
        font-size: 1rem; /* Título más pequeño */
        font-weight: 600;
        color: var(--theme-text-dark);
        margin-bottom: 0;
    }
    .dashboard-header .header-info p {
        font-size: 0.7rem; /* Subtítulo más pequeño */
        color: var(--theme-text-medium);
        margin-bottom: 0;
    }
    .dashboard-header .header-actions {
        margin-left: auto;
    }

    .dashboard-grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: minmax(0, auto); /* Filas se adaptan al contenido */
        gap: 0.75rem; /* Espaciado de grid reducido */
    }
    .grid-item .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .grid-item .card .card-body {
        flex-grow: 1;
    }
    .grid-item .card .card-header {
        padding: 0.3rem 0.6rem; /* Header de tarjeta más compacto */
    }
    .grid-item .card .card-header .card-title {
        font-size: 0.7rem; /* Título de tarjeta más pequeño */
    }
     .grid-item .card .card-header .card-title-icon {
        font-size: 0.8rem;
        margin-right: 0.25rem;
    }

    @media (max-width: 1200px) { .dashboard-grid-container { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .dashboard-grid-container { grid-template-columns: 1fr; } }

    /* Rediseño de Stat Cards para ser horizontales y compactas */
    .stat-card .card-body {
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem; /* Padding muy reducido */
    }
    .stat-card .stat-icon {
        font-size: 1.3rem; /* Icono más pequeño */
        padding: 0.5rem;
        border-radius: var(--theme-border-radius-md);
        margin-right: 0.75rem;
        color: var(--theme-primary);
        background-color: var(--theme-primary-light);
    }
    .stat-card .stat-info {
        line-height: 1.2;
    }
    .stat-card .stat-value {
        font-size: 1rem; /* Valor más pequeño */
        font-weight: 600;
        color: var(--theme-text-dark);
        margin-bottom: 0;
    }
    .stat-card .stat-label {
        font-size: 0.6rem; /* Etiqueta más pequeña */
        color: var(--theme-text-medium);
        margin-bottom: 0;
        text-transform: uppercase;
    }

    /* Listas y Timelines ultra compactos */
    .timeline-scroll-container {
        position: relative;
        height: calc(100% - 35px); /* Ajuste para header compacto */
        overflow-y: hidden;
    }
    .timeline-item {
        display: flex;
        padding-bottom: 0.6rem; /* Espaciado vertical reducido */
        position: relative;
    }
    .timeline-item:not(:last-child)::before {
        content: ''; position: absolute; left: 6px; top: 10px;
        bottom: -2px; width: 1px; background-color: var(--theme-border-soft);
    }
    .timeline-marker {
        width: 10px; height: 10px; /* Marcador más pequeño */
        border-radius: 50%; border: 2px solid var(--theme-bg-card);
        z-index: 1; position: absolute; left: 1px; top: 2px; flex-shrink: 0;
    }
    .timeline-marker.primary { background-color: var(--theme-primary); }
    .timeline-marker.success { background-color: var(--theme-success); }
    .timeline-marker.warning { background-color: var(--theme-warning); }
    .timeline-marker.info { background-color: var(--theme-info); }

    .timeline-content { padding-left: 20px; flex-grow: 1; }
    .timeline-content .item-title {
        font-size: 0.7rem; /* Texto más pequeño */
        font-weight: 500; color: var(--theme-text-dark); margin-bottom: 0; line-height: 1.2;
    }
    .timeline-content .item-meta {
        font-size: 0.65rem; /* Texto más pequeño */
        margin-bottom: 0; color: var(--theme-text-medium);
    }
    .timeline-content .item-meta i { font-size: 0.7rem; }
    .timeline-content .item-time {
        font-size: 0.6rem; color: var(--theme-text-light); float: right;
    }

    /* Tablas y listas de grupo compactas */
    .table-sm > :not(caption) > * > * {
        padding: 0.25rem 0.5rem; /* Padding de tabla reducido */
        font-size: 0.68rem;
    }
    .list-group-item {
        padding: 0.3rem 0.5rem; /* Padding de lista reducido */
        font-size: 0.7rem;
    }
    .form-check-input {
        width: 0.8em; height: 0.8em; margin-top: 0.25em;
    }

    /* BG Helpers */
    .bg-soft-warning { background-color: rgba(245, 158, 11, 0.1); }
    .text-warning { color: var(--theme-warning) !important; }
    .bg-soft-danger { background-color: rgba(239, 68, 68, 0.1); }
    .text-danger { color: var(--theme-danger) !important; }
    .bg-soft-primary { background-color: rgba(var(--theme-primary-rgb), 0.1); }
    .text-primary { color: var(--theme-primary) !important; }
</style>

<div class="dashboard-container">

    <!-- Encabezado Compacto -->
    <div class="dashboard-header">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=E0E7FF&color=4F46E5&bold=true" 
             alt="User Avatar" class="user-avatar">
        <div class="header-info">
            <h5 class="mb-0">Bienvenido, {{ Str::words(Auth::user()->name, 1, '') ?? 'Usuario' }}!</h5>
            <p>Resumen del día.</p>
        </div>
        <div class="header-actions">
            <div class="btn-group">
                <button class="btn btn-primary btn-sm"><i class="ri-add-line me-1"></i> Nueva Tarea</button>
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false"></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="ri-mail-send-line me-2"></i>Enviar Email</a></li>
                    <li><a class="dropdown-item" href="#"><i class="ri-upload-cloud-2-line me-2"></i>Subir Archivo</a></li>
                    <li><a class="dropdown-item" href="#"><i class="ri-sticky-note-add-line me-2"></i>Agregar Nota</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Grid Layout Compacto -->
    <div class="dashboard-grid-container">

        <!-- Fila 1: Estadísticas Horizontales -->
        <div class="grid-item grid-col-span-1"><div class="card stat-card"><div class="card-body">
            <div class="stat-icon"><i class="ri-briefcase-4-line"></i></div>
            <div class="stat-info"><div class="stat-value">{{ $stats['deals_closed'] ?? '12' }}</div><div class="stat-label">Deals Cerrados</div></div>
        </div></div></div>
        <div class="grid-item grid-col-span-1"><div class="card stat-card"><div class="card-body">
            <div class="stat-icon"><i class="ri-task-line"></i></div>
            <div class="stat-info"><div class="stat-value">{{ $stats['pending_tasks'] ?? '34' }}</div><div class="stat-label">Tareas Pendientes</div></div>
        </div></div></div>
        <div class="grid-item grid-col-span-1"><div class="card stat-card"><div class="card-body">
            <div class="stat-icon"><i class="ri-group-2-line"></i></div>
            <div class="stat-info"><div class="stat-value">{{ $stats['clients_worked_on'] ?? '21' }}</div><div class="stat-label">Clientes Activos</div></div>
        </div></div></div>
        <div class="grid-item grid-col-span-1"><div class="card stat-card"><div class="card-body">
            <div class="stat-icon"><i class="ri-line-chart-line"></i></div>
            <div class="stat-info"><div class="stat-value">{{ $stats['case_close_rate'] ?? '85' }}%</div><div class="stat-label">% Cierre Casos</div></div>
        </div></div></div>

        <!-- Col 2: Agenda del Día (Tarjeta alta) -->
        <div class="grid-item grid-col-span-2 grid-row-span-2">
            <div class="card">
                <div class="card-header"><i class="ri-calendar-todo-line card-title-icon"></i><h5 class="card-title">Agenda del Día</h5></div>
                <div class="card-body p-2">
                    <div id="agenda-scroll-container" class="timeline-scroll-container">
                        <ul class="list-unstyled m-0 py-1 px-2">
                            <li class="timeline-item"><div class="timeline-marker primary"></div><div class="timeline-content"><div class="item-title">Llamada con John Doe <span class="item-time">09:00</span></div><p class="item-meta">Discutir Plan de Pagos</p></div></li>
                            <li class="timeline-item"><div class="timeline-marker warning"></div><div class="timeline-content"><div class="item-title">Preparar documentos <span class="item-time">10:30</span></div><p class="item-meta">Caso de Jane Smith - OIC</p></div></li>
                            <li class="timeline-item"><div class="timeline-marker success"></div><div class="timeline-content"><div class="item-title">Reunión de equipo <span class="item-time">14:00</span></div><p class="item-meta">Revisión semanal de casos</p></div></li>
                            <li class="timeline-item"><div class="timeline-marker primary"></div><div class="timeline-content"><div class="item-title">Seguimiento con IRS <span class="item-time">16:00</span></div><p class="item-meta">Caso de Michael Brown</p></div></li>
                             <li class="timeline-item"><div class="timeline-marker"></div><div class="timeline-content"><div class="item-title">Revisar propuesta <span class="item-time">17:30</span></div><p class="item-meta">Propuesta para nuevo cliente</p></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Col 3: Actividad Reciente (Tarjeta alta) -->
        <div class="grid-item grid-col-span-2 grid-row-span-2">
            <div class="card">
                <div class="card-header"><i class="ri-pulse-line card-title-icon"></i><h5 class="card-title">Actividad Reciente</h5></div>
                <div class="card-body p-2">
                    <div id="activity-scroll-container" class="timeline-scroll-container">
                        <ul class="list-unstyled m-0 py-1 px-2">
                             <li class="timeline-item"><div class="timeline-marker info"></div><div class="timeline-content"><div class="item-title">Nuevo cliente añadido <span class="item-time">5m</span></div><p class="item-meta"><a href="#">Carlos Vega</a> fue añadido.</p></div></li>
                             <li class="timeline-item"><div class="timeline-marker success"></div><div class="timeline-content"><div class="item-title">Tarea completada <span class="item-time">25m</span></div><p class="item-meta">"Enviar OIC" para <a href="#">S. Wilson</a>.</p></div></li>
                             <li class="timeline-item"><div class="timeline-marker warning"></div><div class="timeline-content"><div class="item-title">Alerta IRS recibida <span class="item-time">1h</span></div><p class="item-meta">CP504 para <a href="#">Jane Smith</a>.</p></div></li>
                             <li class="timeline-item"><div class="timeline-marker"></div><div class="timeline-content"><div class="item-title">Archivo subido <span class="item-time">3h</span></div><p class="item-meta"><a href="#">John Doe</a> subió "Statements.pdf".</p></div></li>
                             <li class="timeline-item"><div class="timeline-marker info"></div><div class="timeline-content"><div class="item-title">Portal de cliente activado<span class="item-time">5h</span></div><p class="item-meta">Se envió invitación a <a href="#">E. Rogers</a>.</p></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Col 4: Alertas IRS -->
        <div class="grid-item grid-col-span-2">
            <div class="card">
                <div class="card-header bg-soft-warning"><h5 class="card-title mb-0 text-warning"><i class="ri-alert-fill me-2"></i>Alertas del IRS</h5></div>
                <div class="card-body p-0">
                    <div class="table-responsive"><table class="table table-hover table-sm mb-0"><tbody>
                        <tr><td><strong>John Doe</strong></td><td><span class="badge bg-light text-dark">CP2000</span></td><td class="text-end"><button class="btn btn-xs btn-warning">Notificar</button></td></tr>
                        <tr><td><strong>Jane Smith</strong></td><td><span class="badge bg-light text-dark">CP504</span></td><td class="text-end"><button class="btn btn-xs btn-warning">Notificar</button></td></tr>
                    </tbody></table></div>
                </div>
            </div>
        </div>
        
        <!-- Col 5: Tareas Pendientes -->
        <div class="grid-item grid-col-span-2">
            <div class="card">
                <div class="card-header"><i class="ri-file-list-3-line card-title-icon"></i><h5 class="card-title">Tareas por Expirar</h5></div>
                <div class="card-body p-0">
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center"><div><input class="form-check-input me-2" type="checkbox"> <strong>Preparar 8821</strong> para <a href="#">M. Garcia</a></div><span class="badge bg-soft-danger text-danger">Hoy</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center"><div><input class="form-check-input me-2" type="checkbox"> <strong>Llamar al IRS</strong> por <a href="#">D. Chen</a></div><span class="badge bg-soft-warning text-warning">3d</span></li>
                         <li class="list-group-item d-flex justify-content-between align-items-center"><div><input class="form-check-input me-2" type="checkbox"> Revisar docs de <a href="#">E. Rogers</a></div><span class="badge bg-soft-primary text-primary">1s</span></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Col 6: Graficas y lista -->
    </div>
    <div class="grid-item grid-col-span-4 my-3">
            <div class="col-span-2 card">
                                <div class="card-header"><i class="ri-file-list-3-line card-title-icon"></i><h5 class="card-title">Tareas por Expirar</h5></div>
                <ul class="list-group list-group-flush bg-white">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="ri-bar-chart-2-line me-2"></i> Casos Activos</div>
                        <span class="badge bg-soft-primary text-primary">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="ri-bar-chart-2-line me-2"></i> Casos Activos</div>
                        <span class="badge bg-soft-primary text-primary">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="ri-bar-chart-2-line me-2"></i> Casos Activos</div>
                        <span class="badge bg-soft-primary text-primary">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="ri-bar-chart-2-line me-2"></i> Casos Activos</div>
                        <span class="badge bg-soft-primary text-primary">12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div><i class="ri-bar-chart-2-line me-2"></i> Casos Activos</div>
                        <span class="badge bg-soft-primary text-primary">12</span>
                    </li>
            </div>
            <div class="col-span-2">
                <canvas id="taxReturnBalanceTrendChart2"></canvas>
            </div>
        </div>
        <div class="grid-item grid-col-span-2">
            <div class="card">
                <div  id="viewHtml"></div>
                
            </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function initializeScrollbar(containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            new PerfectScrollbar(container, {
                wheelPropagation: false,
                suppressScrollX: true
            });
        }
    }

    initializeScrollbar('agenda-scroll-container');
    initializeScrollbar('activity-scroll-container');
    if (window.Chart && window.Chart.register && window.ChartDataLabels) {
        Chart.register(window.ChartDataLabels);
    }

    const ctx = document.getElementById('taxReturnBalanceTrendChart2').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Balance de Devoluciones',
                data: [1200, 1500, 1100, 1700, 1400, 1800, 1600],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99,102,241,0.1)',
                tension: 0.4,
                pointRadius: 3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { display: true, title: { display: false } },
                y: { display: true, title: { display: false }, beginAtZero: true }
            }
        }
    });
});

</script>