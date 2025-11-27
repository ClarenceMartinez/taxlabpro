<style>
        :root {
            --bs-body-bg-darker: #f5f5f9; /* Un fondo ligeramente más oscuro para el wrapper */
            --bs-light-bg-subtle: #fafafa;
            --bs-primary-bg-subtle-hover: #e7e7ff;
            --bs-border-color-translucent: rgba(0,0,0, .075);
            --bs-chat-sent-bg: #696cff;
            --bs-chat-sent-text: #ffffff;
            --bs-chat-received-bg: #f0f0f5;
            --bs-chat-received-text: #333;
            --bs-status-online: #28c76f;
            --bs-status-offline: #8a8d93;
            --bs-futuristic-glow: 0 0 8px rgba(105, 108, 255, 0.3);
        }

        #chat-inbox-wrapper {
            display: flex;
            height: 100vh; /* Altura completa menos un poco de margen */
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color-translucent);
            border-radius: var(--bs-border-radius-lg);
            overflow: hidden;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, .1);
        }

        /* ============================================== */
        /* PANEL IZQUIERDO: LISTA DE CONVERSACIONES */
        /* ============================================== */
        #chat-list-sidebar {
            width: 360px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--bs-border-color-translucent);
            background-color: var(--bs-light-bg-subtle);
        }

        .sidebar-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--bs-border-color-translucent);
            flex-shrink: 0;
        }

        #chat-list-container {
            flex-grow: 1;
            overflow-y: auto;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Estilo para cada item en la lista de chat */
        .chat-list-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--bs-border-color-translucent);
            cursor: pointer;
            transition: background-color 0.2s ease, border-left-color 0.2s ease;
            border-left: 4px solid transparent;
        }
        
        .chat-list-item:hover {
            background-color: var(--bs-primary-bg-subtle-hover);
        }

        .chat-list-item.active {
            background-color: var(--bs-primary-bg-subtle);
            border-left-color: var(--bs-primary);
        }
        .chat-list-item.active:hover {
            background-color: var(--bs-primary-bg-subtle);
        }

        .avatar-container {
            position: relative;
            flex-shrink: 0;
        }
        
        .avatar {
            width: 48px;
            height: 48px;
            object-fit: cover;
        }

        .status-dot {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid var(--bs-light-bg-subtle);
        }
        .status-dot.online { background-color: var(--bs-status-online); }
        .status-dot.offline { background-color: var(--bs-status-offline); }

        .chat-item-info {
            flex-grow: 1;
            overflow: hidden; /* para que elipsis funcione */
        }
        
        .chat-item-info .name {
            font-weight: 600;
            color: var(--bs-heading-color);
            margin-bottom: 0.15rem;
        }

        .chat-item-info .last-message {
            font-size: 0.875rem;
            color: var(--bs-secondary-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-item-meta {
            flex-shrink: 0;
            text-align: right;
            font-size: 0.75rem;
            color: var(--bs-secondary-color);
        }

        .unread-badge {
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 0.25rem;
        }

        /* ============================================== */
        /* PANEL DERECHO: VENTANA DE CONVERSACIÓN */
        /* ============================================== */
        #conversation-window {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: var(--bs-body-bg);
        }

        .conversation-header {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            border-bottom: 1px solid var(--bs-border-color-translucent);
            background-color: var(--bs-body-bg);
            flex-shrink: 0;
        }
        
        .conversation-header .user-info .name { font-weight: 600; }
        .conversation-header .user-info .status { font-size: 0.8rem; color: var(--bs-secondary-color); }
        .conversation-header .user-info .status.online { color: var(--bs-status-online); }
        .conversation-header .header-actions .btn { color: var(--bs-secondary-color); }
        .conversation-header .header-actions .btn:hover { color: var(--bs-primary); background-color: var(--bs-tertiary-bg); }

        .conversation-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .chat-message-group {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .chat-message-group .message-bubble {
            padding: 0.75rem 1rem;
            border-radius: var(--bs-border-radius-lg);
            max-width: 70%;
            word-wrap: break-word;
            line-height: 1.5;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .chat-message-group .message-time {
            font-size: 0.75rem;
            color: var(--bs-secondary-color);
            margin-top: 0.25rem;
        }
        
        /* Mensajes Recibidos (default) */
        .chat-message-group.received .message-bubble {
            background-color: var(--bs-chat-received-bg);
            color: var(--bs-chat-received-text);
            border-bottom-left-radius: var(--bs-border-radius-sm);
        }
        .chat-message-group.received .message-time { text-align: left; }

        /* Mensajes Enviados */
        .chat-message-group.sent {
            flex-direction: row-reverse;
        }
        .chat-message-group.sent .message-bubble {
            background-color: var(--bs-chat-sent-bg);
            color: var(--bs-chat-sent-text);
            border-bottom-right-radius: var(--bs-border-radius-sm);
        }
        .chat-message-group.sent .message-time { text-align: right; }
        
        .system-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
        }
        .system-divider::before, .system-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--bs-border-color-translucent);
        }
        .system-divider-text {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--bs-secondary-color);
            padding: 0 1rem;
        }

        .conversation-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--bs-border-color-translucent);
            background-color: var(--bs-light-bg-subtle);
            flex-shrink: 0;
        }
        .chat-input-wrapper {
            position: relative;
        }
        .chat-input-wrapper .form-control {
            padding-left: 3rem;
            padding-right: 3.5rem;
            border-radius: var(--bs-border-radius-pill);
            background-color: var(--bs-body-bg);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        .chat-input-wrapper .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: var(--bs-futuristic-glow);
        }
        
        .chat-input-wrapper .btn-actions {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
        }

        .chat-input-wrapper .btn-send {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
        }
        .chat-input-wrapper .btn-icon {
            color: var(--bs-secondary-color);
            background: transparent;
            border: none;
        }
         .chat-input-wrapper .btn-icon:hover {
            color: var(--bs-primary);
        }
        
    </style>

    <div id="chat-inbox-wrapper">
        <!-- ============================================== -->
        <!-- PANEL IZQUIERDO: LISTA DE CONVERSACIONES       -->
        <!-- ============================================== -->
        <div id="chat-list-sidebar">
            <div class="sidebar-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">Inbox</h5>
                    <button class="btn btn-primary btn-sm btn-icon rounded-circle" title="Nuevo Mensaje">
                        <i class="ri-edit-2-line"></i>
                    </button>
                </div>
                <div class="input-group input-group-sm mt-3">
                    <span class="input-group-text bg-transparent"><i class="ri-search-line"></i></span>
                    <input type="text" class="form-control border-start-0" placeholder="Buscar cliente o mensaje...">
                </div>
            </div>

            <ul id="chat-list-container">
                <!-- Los items se cargarán con JavaScript, este es un ejemplo -->
                <li class="chat-list-item active" data-user-id="1">
                    <div class="avatar-container">
                        <img src="https://i.pravatar.cc/150?u=user1" alt="Elena Rodriguez" class="avatar rounded-circle">
                        <span class="status-dot online"></span>
                    </div>
                    <div class="chat-item-info">
                        <div class="name">Elena Rodriguez</div>
                        <div class="last-message">¡Perfecto! Lo reviso y te confirmo.</div>
                    </div>
                    <div class="chat-item-meta">
                        <div class="time">10:45 AM</div>
                        <span class="badge rounded-pill bg-primary unread-badge">2</span>
                    </div>
                </li>

                <li class="chat-list-item" data-user-id="2">
                    <div class="avatar-container">
                        <img src="https://i.pravatar.cc/150?u=user2" alt="Carlos Gomez" class="avatar rounded-circle">
                        <span class="status-dot online"></span>
                    </div>
                    <div class="chat-item-info">
                        <div class="name">Carlos Gómez</div>
                        <div class="last-message">Ya envié los documentos solicitados.</div>
                    </div>
                    <div class="chat-item-meta">
                        <div class="time">Ayer</div>
                    </div>
                </li>

                <li class="chat-list-item" data-user-id="3">
                    <div class="avatar-container">
                        <img src="https://i.pravatar.cc/150?u=user3" alt="Ana Torres" class="avatar rounded-circle">
                        <span class="status-dot offline"></span>
                    </div>
                    <div class="chat-item-info">
                        <div class="name">Ana Torres</div>
                        <div class="last-message">Gracias por la rápida respuesta.</div>
                    </div>
                    <div class="chat-item-meta">
                        <div class="time">2d</div>
                    </div>
                </li>
                 <li class="chat-list-item" data-user-id="4">
                    <div class="avatar-container">
                        <img src="https://i.pravatar.cc/150?u=user4" alt="Javier Peña" class="avatar rounded-circle">
                        <span class="status-dot offline"></span>
                    </div>
                    <div class="chat-item-info">
                        <div class="name">Javier Peña</div>
                        <div class="last-message">Tengo una duda sobre la factura...</div>
                    </div>
                    <div class="chat-item-meta">
                        <div class="time">5d</div>
                         <span class="badge rounded-pill bg-primary unread-badge">1</span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- ============================================== -->
        <!-- PANEL DERECHO: VENTANA DE CONVERSACIÓN         -->
        <!-- ============================================== -->
        <div id="conversation-window">
            <!-- El header se cargará con JS -->
            <div class="conversation-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-container">
                        <img id="conversation-avatar" src="https://i.pravatar.cc/150?u=user1" alt="Avatar" class="avatar rounded-circle">
                    </div>
                    <div class="user-info">
                        <div id="conversation-name" class="name">Elena Rodriguez</div>
                        <div id="conversation-status" class="status online">En línea</div>
                    </div>
                </div>
                <div class="header-actions ms-auto d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-icon rounded-circle" title="Buscar en Chat"><i class="ri-search-line ri-lg"></i></button>
                    <button class="btn btn-sm btn-icon rounded-circle" title="Ver Detalles del Cliente"><i class="ri-information-line ri-lg"></i></button>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-icon rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Más Opciones">
                           <i class="ri-more-2-fill ri-lg"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li><a class="dropdown-item" href="#">Archivar Chat</a></li>
                          <li><a class="dropdown-item" href="#">Silenciar Notificaciones</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item text-danger" href="#">Bloquear Cliente</a></li>
                        </ul>
                      </div>
                </div>
            </div>

            <!-- El cuerpo de la conversación se cargará con JS -->
            <div id="conversation-body" class="conversation-body">
                <!-- Los mensajes se insertarán aquí -->
            </div>
            
            <!-- Footer para escribir mensajes -->
            <div class="conversation-footer">
                <div class="chat-input-wrapper">
                     <div class="btn-actions">
                        <button class="btn btn-icon rounded-circle" title="Adjuntar Archivo"><i class="ri-attachment-2 ri-xl"></i></button>
                    </div>
                    <textarea class="form-control" rows="1" placeholder="Escribe un mensaje..."></textarea>
                    <button class="btn btn-primary btn-icon rounded-circle btn-send" title="Enviar Mensaje"><i class="ri-send-plane-fill"></i></button>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- DATOS DE EJEMPLO ---
        const conversationsData = {
            '1': {
                name: 'Elena Rodriguez',
                avatar: 'https://i.pravatar.cc/150?u=user1',
                status: { text: 'En línea', class: 'online' },
                messages: [
                    { type: 'system', text: 'Hoy' },
                    { type: 'received', text: 'Hola, ¿recibiste el borrador del contrato que te envié?', time: '10:42 AM' },
                    { type: 'sent', text: '¡Hola Elena! Sí, lo recibí. Lo estoy revisando ahora mismo, te doy mis comentarios en un momento.', time: '10:43 AM' },
                    { type: 'received', text: '¡Perfecto! Lo reviso y te confirmo.', time: '10:45 AM' },
                ]
            },
            '2': {
                name: 'Carlos Gómez',
                avatar: 'https://i.pravatar.cc/150?u=user2',
                status: { text: 'En línea', class: 'online' },
                messages: [
                     { type: 'system', text: 'Ayer' },
                    { type: 'received', text: 'Buenas tardes, una consulta rápida sobre el proyecto.', time: '3:15 PM' },
                    { type: 'sent', text: '¡Hola Carlos! Claro, dime.', time: '3:16 PM' },
                    { type: 'received', text: 'Ya envié los documentos solicitados. ¿Me confirmas de recibido?', time: '3:20 PM' },
                    { type: 'sent', text: 'Confirmado, Carlos. Ya los tengo, gracias.', time: '3:21 PM' },
                ]
            },
            '3': {
                name: 'Ana Torres',
                avatar: 'https://i.pravatar.cc/150?u=user3',
                status: { text: 'Últ. vez hace 2 horas', class: 'offline' },
                messages: [
                     { type: 'system', text: 'Martes' },
                    { type: 'sent', text: 'Hola Ana, te adjunto la propuesta actualizada. Quedo a tu disposición.', time: '11:00 AM' },
                    { type: 'received', text: 'Gracias por la rápida respuesta. La revisaré con mi equipo.', time: '11:05 AM' },
                ]
            },
             '4': {
                name: 'Javier Peña',
                avatar: 'https://i.pravatar.cc/150?u=user4',
                status: { text: 'Desconectado', class: 'offline' },
                messages: [
                     { type: 'system', text: 'Hace 5 días' },
                    { type: 'received', text: 'Tengo una duda sobre la factura del mes pasado, ¿podemos revisarla?', time: '09:30 AM' },
                ]
            },
        };

        // --- REFERENCIAS A ELEMENTOS DEL DOM ---
        const chatListContainer = document.getElementById('chat-list-container');
        const conversationAvatar = document.getElementById('conversation-avatar');
        const conversationName = document.getElementById('conversation-name');
        const conversationStatus = document.getElementById('conversation-status');
        const conversationBody = document.getElementById('conversation-body');

        /**
         * Renderiza la conversación seleccionada en la ventana de chat.
         * @param {string} userId - El ID del usuario cuya conversación se va a mostrar.
         */
        function renderConversation(userId) {
            const userData = conversationsData[userId];
            if (!userData) {
                console.error('No se encontraron datos para el usuario:', userId);
                return;
            }

            // 1. Actualizar el header de la conversación
            conversationAvatar.src = userData.avatar;
            conversationAvatar.alt = userData.name;
            conversationName.textContent = userData.name;
            conversationStatus.textContent = userData.status.text;
            conversationStatus.className = `status ${userData.status.class}`;
            
            // 2. Limpiar y renderizar los mensajes
            conversationBody.innerHTML = '';
            userData.messages.forEach(msg => {
                let messageHtml = '';
                if (msg.type === 'system') {
                    messageHtml = `
                        <div class="system-divider">
                           <span class="system-divider-text">${msg.text}</span>
                        </div>
                    `;
                } else {
                    const avatarHtml = msg.type === 'received' 
                        ? `<img src="${userData.avatar}" alt="${userData.name}" class="avatar rounded-circle" style="width: 36px; height: 36px;">` 
                        : '';
                    
                    messageHtml = `
                        <div class="chat-message-group ${msg.type}">
                            ${avatarHtml}
                            <div class="d-flex flex-column">
                                <div class="message-bubble">${msg.text}</div>
                                <div class="message-time">${msg.time}</div>
                            </div>
                        </div>
                    `;
                }
                conversationBody.innerHTML += messageHtml;
            });

            // 3. Hacer scroll hasta el final
            conversationBody.scrollTop = conversationBody.scrollHeight;
        }

        // --- EVENT LISTENER PARA CAMBIAR DE CHAT ---
        chatListContainer.addEventListener('click', function(e) {
            const clickedItem = e.target.closest('.chat-list-item');
            if (!clickedItem) return;

            const currentActive = chatListContainer.querySelector('.chat-list-item.active');
            if (currentActive) {
                currentActive.classList.remove('active');
            }

            clickedItem.classList.add('active');
            
            const userId = clickedItem.dataset.userId;
            renderConversation(userId);
        });

        // --- CARGA INICIAL ---
        // Al cargar la página, renderizar la conversación del primer usuario activo
        const initialActiveUser = chatListContainer.querySelector('.chat-list-item.active');
        if (initialActiveUser) {
            renderConversation(initialActiveUser.dataset.userId);
        }
    });
    </script>