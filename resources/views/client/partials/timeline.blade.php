<style>
/* --- CSS para un historial de actividad ULTRA COMPACTO --- */

/* Contenedor principal del timeline */
#content-timeline-activity-log {
    padding-top: 0.5rem !important; /* Reducir padding superior general */
    padding-bottom: 0.5rem !important;
}

/* Lista del timeline */
#content-timeline-activity-log .timeline.card-timeline {
    padding-left: 0.8rem; /* Espacio justo para la línea y el punto */
    margin-bottom: 0 !important;
}

/* Cada item del timeline */
#content-timeline-activity-log .timeline-item {
    position: relative;
    padding-left: 1.2rem; /* Espacio mínimo para el punto y un poco de margen */
    padding-bottom: 0.3rem; /* Espacio mínimo debajo de cada item */
    margin-bottom: 0.15rem; /* Espacio mínimo entre items */
}

/* La línea vertical del timeline */
#content-timeline-activity-log .timeline-item::before {
    content: '';
    position: absolute;
    left: 0.2rem; /* Alinea con el centro del punto más pequeño */
    top: 0.1rem; /* Comienzo de la línea, alineado con el texto superior */
    bottom: -0.15rem; /* Extiende la línea mínimamente */
    width: 1px; /* Línea más delgada */
    background-color: #e0e0e0; /* Color de la línea, muy sutil */
}

#content-timeline-activity-log .timeline-item:last-child::before {
    height: 0.7rem; /* Para que no se extienda innecesariamente */
}

/* El punto indicador */
#content-timeline-activity-log .timeline-point {
    width: 0.4rem; /* Punto muy pequeño */
    height: 0.4rem; /* Punto muy pequeño */
    position: absolute;
    left: 0;
    top: 0.2rem; /* Alineación vertical con la primera línea de texto (h6) */
    border-radius: 50%;
    z-index: 1;
    border: 1px solid #fff; /* Borde blanco para destacar sobre la línea si son del mismo color */
}
/* Ajustar color del punto si es necesario, por ejemplo: */
#content-timeline-activity-log .timeline-point.timeline-point-success {
    background-color: #28a745; /* Mantener el color de éxito o ajustarlo */
}


/* Contenedor del evento/texto */
#content-timeline-activity-log .timeline-event {
    /* No se necesitan muchos cambios aquí */
}

/* Cabecera del evento (título y fecha) */
#content-timeline-activity-log .timeline-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Cambio a flex-start por si la fecha es más pequeña */
    margin-bottom: 0.05rem !important; /* Espacio casi nulo bajo la cabecera */
    line-height: 1.2; /* Ajuste global para la cabecera */
}

/* Título del evento (h6) */
#content-timeline-activity-log .timeline-header h6 {
    font-size: 0.7rem; /* Fuente principal de la acción, más pequeña */
    font-weight: 500; /* Un poco de énfasis, semi-bold */
    margin-bottom: 0 !important;
    color: #212529; /* Color oscuro principal para la acción */
    flex-grow: 1; /* Permitir que el título ocupe espacio disponible */
    margin-right: 0.25rem; /* Pequeño espacio antes de la fecha */
}

/* Usuario dentro del título */
#content-timeline-activity-log .timeline-header h6 small {
    font-weight: 400; /* Normal, menos énfasis que la acción */
    font-size: 0.9em; /* Relativo al h6 */
    color: #495057; /* Un gris más oscuro que la fecha, pero menos que la acción */
}

/* Fecha y hora */
#content-timeline-activity-log .timeline-header small.text-muted {
    font-size: 0.6rem; /* Fuente muy pequeña para la fecha */
    white-space: nowrap;
    color: #868e96; /* Color gris claro para la fecha */
    padding-top: 0.05rem; /* Micro ajuste vertical si es necesario */
}

/* Contenedor de la descripción (el div.d-flex) */
#content-timeline-activity-log .timeline-event .d-flex {
    margin-bottom: 0 !important;
}

/* Descripción del evento (p) */
#content-timeline-activity-log .timeline-event p {
    font-size: 0.68rem; /* Fuente pequeña para la descripción */
    margin-bottom: 0 !important;
    line-height: 1.25; /* Espacio entre líneas ajustado */
    color: #6c757d; /* Color de texto estándar para la descripción */
}

/* Opcional: Si quieres que los nombres de archivo en la descripción se destaquen un poco */
#content-timeline-activity-log .timeline-event p strong,
#content-timeline-activity-log .timeline-event p b,
#content-timeline-activity-log .timeline-event p code { /* Si usas code para nombres de archivo */
    font-weight: 500;
    color: #495057;
}
</style>
<div class="card-body pt-4" id="content-timeline-activity-log">
    <ul class="timeline card-timeline mb-0"></ul>
</div>