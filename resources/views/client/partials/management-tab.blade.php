{{-- Styles for the new sidebar, resizer, and chat components --}}
<style>
    /* MODIFIED: sidebar-right is now the default and only layout */
    #management-tab-wrapper.sidebar-right {
        flex-direction: row-reverse;
    }

    #task-list-sidebar {
        width: 380px; /* Increased default width */
        min-width: 300px;
        max-width: 600px;
        flex-shrink: 0;
        height: calc(100vh - 120px);
        overflow-y: auto;
        transition: none;
        display: flex;
        flex-direction: column;
        position: relative;
        background-color: var(--bs-light-bg-subtle);
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: var(--bs-border-radius);
        margin: 5px;
    }
    
    #main-task-content {
        flex-grow: 1;
        height: calc(100vh - 120px);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        margin: 5px;
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: var(--bs-border-radius);
    }
    
    #resize-handle {
        width: 8px;
        height: 100%;
        position: absolute;
        top: 0;
        cursor: col-resize;
        z-index: 10;
        left: -4px;
    }
    
    /* NEW: Styles for task filters and headers */
    .sidebar-header {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--bs-border-color-translucent);
        flex-shrink: 0;
    }

    .task-list-container {
        padding: 0 0.5rem;
        list-style: none;
    }
    /* MODIFIED: Task item style adapted to modal style (more padding) */
    .task-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem; /* Increased padding */
        border-bottom: 1px solid var(--bs-border-color-translucent);
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    .task-item:last-child { border-bottom: none; }
    .task-item:hover, .task-item.active {
        background-color: var(--bs-body-bg);
        border-radius: var(--bs-border-radius);
    }
    .task-item .task-content {
        flex-grow: 1;
        font-size: 0.9rem; /* Slightly larger base font */
        line-height: 1.4;
    }
    /* NEW: Priority and Due Date styles */
    .task-priority { font-size: 0.9rem; margin-right: 0.25rem; }
    .priority-high { color: var(--bs-danger); }
    .priority-medium { color: var(--bs-warning); }
    .priority-low { color: var(--bs-secondary); }
    .task-due-date { font-size: 0.75rem; color: var(--bs-secondary-color); background-color: var(--bs-tertiary-bg); padding: 0.1rem 0.4rem; border-radius: var(--bs-border-radius-sm); }
    .task-due-date.is-overdue { background-color: var(--bs-danger-bg-subtle); color: var(--bs-danger-text); font-weight: 500; }
    
    .task-item .task-assignee-avatar { display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 50%; background-color: #696cff; color: white; font-size: 0.65rem; font-weight: 600; margin-top: 0.25rem; }
    .task-item .form-check-input { width: 1.25em; height: 1.25em; margin-top: 0.15rem; }
    .progress-ring { width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative; flex-shrink: 0; }
    .progress-ring::before { content: ''; position: absolute; width: 20px; height: 20px; background: var(--bs-light-bg-subtle); border-radius: 50%; }
    .task-item:hover .progress-ring::before { background: var(--bs-body-bg); }
    .subtask-list { list-style: none; padding-left: 2rem; margin-top: 0.5rem; }
    .subtask-item { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.5rem 0; font-size: 0.8rem; }
    
    /* Styles for Chat Interface */
    .chat-header { padding: 0.75rem 1rem; border-bottom: 1px solid var(--bs-border-color); flex-shrink: 0; }
    .chat-timeline { flex-grow: 1; overflow-y: auto; padding: 1rem; }
    .chat-message { display: flex; margin-bottom: 1.25rem; gap: 0.75rem; }
    /* NEW: Internal note styling */
    .chat-message.internal-note .message-bubble { background-color: var(--bs-warning-bg-subtle); border-color: var(--bs-warning-border-subtle); }
    .chat-message.internal-note .message-header .author { color: var(--bs-warning-text); }
    .chat-message.internal-note::before {
        content: "INTERNAL";
        font-size: 0.6rem;
        font-weight: 700;
        color: var(--bs-warning-text-emphasis);
        position: absolute;
        left: 52px; /* avatar width + gap */
        top: -10px;
    }
    
    .message-content { display: flex; flex-direction: column; width: 100%; position: relative; }
    .message-header { font-size: 0.8rem; margin-bottom: 0.25rem; }
    .message-header .author { font-weight: 600; color: var(--bs-heading-color); }
    .message-header .timestamp { color: var(--bs-secondary-color); margin-left: 0.5rem; }
    .message-bubble { padding: 0.6rem 0.9rem; background-color: var(--bs-tertiary-bg); border: 1px solid var(--bs-border-color-translucent); border-radius: 12px; max-width: 100%; word-wrap: break-word; }
    .message-bubble.has-attachment { padding: 0.5rem; background-color: transparent; border: none; }
    .message-bubble blockquote { font-size: 0.85em; border-left: 3px solid var(--bs-border-color); padding-left: 0.75rem; margin: 0.5rem 0 0 0; opacity: 0.8; }
    .system-message { text-align: center; font-size: 0.75rem; color: var(--bs-secondary-color); margin: 1rem 0; }
    .chat-attachment { display: flex; align-items: center; padding: 0.5rem; border: 1px solid var(--bs-border-color-translucent); border-radius: 8px; background-color: var(--bs-tertiary-bg); }
    .chat-attachment-img { max-width: 250px; border-radius: 8px; border: 1px solid var(--bs-border-color-translucent); }
    
    /* NEW: Pinned message style */
    .pinned-message {
        padding: 0.5rem 1rem;
        background-color: var(--bs-info-bg-subtle);
        border-bottom: 1px solid var(--bs-info-border-subtle);
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-shrink: 0;
    }

    .chat-input-area { padding: 0.75rem; border-top: 1px solid var(--bs-border-color); background-color: var(--bs-body-bg); }
    .chat-input-wrapper { position: relative; }
    .chat-input-wrapper textarea { min-height: 40px; resize: vertical; max-height: 200px; padding-right: 3rem; }
    .chat-input-wrapper .btn-send { position: absolute; right: 5px; top: 5px; }
    /* NEW: Style for internal note mode */
    .chat-input-area.internal-note-mode { background-color: var(--bs-warning-bg-subtle); }
    .chat-input-area.internal-note-mode .form-control { border-color: var(--bs-warning-border-subtle); }
    
    .chat-toolbar button { color: var(--bs-secondary-color); }
    .chat-toolbar button:hover { color: var(--bs-primary); background-color: var(--bs-tertiary-bg); }

    /* NEW: Styles for File Manager & Case Details */
    .file-item { display: flex; align-items: center; gap: 0.75rem; padding: 0.5rem; border-radius: var(--bs-border-radius-sm); }
    .file-item:hover { background-color: var(--bs-body-bg); }
    .case-detail-item { display: flex; justify-content: space-between; padding: 0.4rem 0; font-size: 0.875rem; border-bottom: 1px solid var(--bs-border-color-translucent); }
    
    /* NEW: Styles for Create Task Modal Checklist */
    .checklist-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem;
        border-radius: var(--bs-border-radius-sm);
    }
    .checklist-item:hover {
        background-color: var(--bs-tertiary-bg);
    }
    .checklist-item .form-control {
        border: none;
        padding: 0.25rem 0.5rem;
        background: transparent;
    }
    .checklist-item .form-control:focus {
        box-shadow: none;
        background-color: var(--bs-body-bg);
    }

    /* ============================================== */
    /* NEW: STYLES FOR TASK CARD DISPLAYED IN CHAT    */
    /* ============================================== */
    .chat-message.task-creation .message-bubble {
        background-color: transparent;
        border: none;
        padding: 0;
        max-width: 100%;
    }

    .task-card-in-chat {
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: var(--bs-border-radius-lg);
        padding: 1rem 1.25rem;
        box-shadow: var(--bs-box-shadow-sm);
        width: 100%;
    }

    .task-card-in-chat .task-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--bs-border-color-translucent);
    }
    .task-card-in-chat .task-header .task-icon {
        font-size: 1.25rem;
        color: var(--bs-primary);
    }
    .task-card-in-chat .task-header .task-title {
        font-size: 1.1rem;
        font-weight: 600;
        flex-grow: 1;
        margin-bottom: 0;
    }
    .task-card-in-chat .task-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    .task-card-in-chat .meta-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }
    .task-card-in-chat .meta-item .meta-label {
        font-size: 0.75rem;
        color: var(--bs-secondary-color);
        text-transform: uppercase;
        font-weight: 500;
    }
    .task-card-in-chat .meta-item .meta-value {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }
    .task-card-in-chat .meta-item .avatar-stack .avatar {
        width: 28px;
        height: 28px;
    }
    .task-card-in-chat .checklist-progress {
        margin-bottom: 1rem;
    }
    .task-card-in-chat .checklist-progress .progress-info {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
        color: var(--bs-secondary-color);
    }
    .task-card-in-chat .checklist-items {
        max-height: 150px;
        overflow-y: auto;
        padding-right: 0.5rem; /* for scrollbar */
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: var(--bs-border-radius);
        padding: 0.5rem;
        background-color: var(--bs-light-bg-subtle);
    }
    .task-card-in-chat .checklist-item-in-chat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0;
        font-size: 0.85rem;
    }
    .task-card-in-chat .checklist-item-in-chat .form-check-input {
        margin-top: 0;
    }
</style>

{{-- ================================================= --}}
{{-- NEW: STYLES FOR REDESIGNED CREATE TASK MODAL      --}}
{{-- ================================================= --}}
<style>
    #createTaskModal .modal-content, #taskDetailModal .modal-content {
        border: none;
        border-radius: var(--bs-border-radius-lg);
    }
    #createTaskModal .modal-header, #taskDetailModal .modal-header {
        border-bottom: 1px solid var(--bs-border-color-translucent);
        padding: 1rem 1.5rem;
    }
    #createTaskModal .modal-body, #taskDetailModal .modal-body {
        padding: 1.5rem;
    }
    #createTaskModal .modal-footer, #taskDetailModal .modal-footer {
        padding: 1rem 1.5rem;
        background-color: var(--bs-tertiary-bg);
        border-top: 1px solid var(--bs-border-color-translucent);
    }

    /* Big Task Title Input */
    #createTaskTitle, #taskDetailTitle {
        font-size: 1.25rem;
        font-weight: 600;
        border: none;
        padding-left: 0;
        padding-right: 0;
        flex-grow: 1;
    }
    #createTaskTitle:focus, #taskDetailTitle:focus {
        box-shadow: none;
        border-bottom: 2px solid var(--bs-primary);
    }

    /* NEW: Task Stage Indicator */
    .task-stage-indicator {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        flex-shrink: 0;
        background-color: var(--bs-tertiary-bg); /* Default background */
        border: 1px solid var(--bs-border-color-translucent);
        transition: background 0.3s ease;
    }

    /* Assignee Stack */
    .assignee-stack {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .avatar-stack {
        display: flex;
    }
    .avatar-stack .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid var(--bs-modal-bg);
        margin-left: -10px;
        transition: margin 0.2s ease;
        object-fit: cover;
    }
    .avatar-stack:hover .avatar {
        margin-left: -4px;
    }
    .avatar-stack .avatar:first-child {
        margin-left: 0;
    }
    .avatar-add-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px dashed var(--bs-secondary-color);
        color: var(--bs-secondary-color);
        background-color: transparent;
        transition: all 0.2s ease;
    }
    .avatar-add-btn:hover {
        background-color: var(--bs-primary-bg-subtle);
        border-color: var(--bs-primary);
        color: var(--bs-primary);
    }

    /* Priority Dropdown */
    .priority-dropdown .dropdown-toggle {
      display: flex;
      align-items: center;
    }
    .priority-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Due Date with Time */
    .due-date-wrapper {
        display: flex;
        align-items: center;
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        overflow: hidden;
    }
    .due-date-wrapper input {
        border: none;
        background-color: transparent;
    }
    .due-date-wrapper input:focus {
        box-shadow: none;
    }
    .due-date-wrapper .date-divider {
        color: var(--bs-secondary-color);
    }

    /* Description Rich Editor */
    .description-wrapper {
        border: 1px solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        overflow: hidden; /* Ensures child radius matches */
    }
    .editor-toolbar {
        padding: 0.5rem;
        background-color: var(--bs-tertiary-bg);
        border-bottom: 1px solid var(--bs-border-color);
    }
    .editor-toolbar .btn {
        color: var(--bs-secondary-color);
    }
    .editor-toolbar .btn:hover {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
    }
    #createTaskDescription, #taskDetailDescription {
        border: none;
        min-height: 120px;
    }
    #createTaskDescription:focus, #taskDetailDescription:focus {
        box-shadow: none;
    }

    /* Checklist "Note" Style */
    .checklist-wrapper {
        background-color: var(--bs-light-bg-subtle);
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: var(--bs-border-radius-lg);
        padding: 1rem 1rem 0.5rem;
    }
    .checklist-wrapper .checklist-item {
        padding: 0.5rem;
    }
    .checklist-wrapper .checklist-item input[type="text"] {
        font-size: 0.9rem;
    }
</style>

<!-- Main Wrapper for Sidebar and Content -->
<div id="management-tab-wrapper" class="d-flex sidebar-right">

    <!-- =================================================
    SIDEBAR: Client Hub & Tasks
    ================================================= -->
    <div id="task-list-sidebar">
        <!-- Resize Handle -->
        <div id="resize-handle"></div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs nav-fill p-2" id="sidebar-tabs" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tasks-tab-pane" type="button" role="tab" title="Tasks"><i class="ri-task-line"></i></button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#files-tab-pane" type="button" role="tab" title="File Manager"><i class="ri-folder-2-line"></i></button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" title="Case Details"><i class="ri-information-line"></i></button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#actions-tab-pane" type="button" role="tab" title="Quick Actions"><i class="ri-flashlight-line"></i></button></li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content flex-grow-1" id="sidebar-tabs-content" style="overflow-y: auto;">
            <!-- Tasks Tab Pane -->
            <div class="tab-pane fade show active" id="tasks-tab-pane" role="tabpanel">
                <div class="sidebar-header d-flex flex-column gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="taskSearchInput" class="form-control form-control-sm" placeholder="Search tasks...">
                        {{-- NEW: Create Task Button --}}
                        <button class="btn btn-sm btn-primary flex-shrink-0" type="button" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                            <i class="ri-add-line"></i>
                        </button>
                    </div>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm">
                            <option selected>All Statuses</option>
                            <option value="1">To Do</option>
                            <option value="2">In Progress</option>
                            <option value="3">Pending Client</option>
                            <option value="4">Completed</option>
                        </select>
                        <button class="btn btn-sm btn-light" title="Sort"><i class="ri-sort-asc"></i></button>
                    </div>
                </div>
                {{-- MODIFIED: Removed data-bs-toggle from task items. Clicks are now handled by JS to show task in chat. --}}
                <ul class="task-list-container ps-0 mb-0">
                    <li class="task-item">
                        <input class="form-check-input" type="checkbox" value="" onclick="event.stopPropagation();">
                        <div class="task-content">
                            <i class="ri-flag-fill priority-high" title="High Priority"></i>
                            Revisar notificación del IRS CP504
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="task-due-date is-overdue">Due: Yesterday</span>
                                <div class="task-assignee-avatar" title="Javier Romero">JR</div>
                            </div>
                        </div>
                        <div class="progress-ring" style="background: conic-gradient(var(--bs-primary) 75%, var(--bs-light) 0);" data-bs-toggle="tooltip" title="75%"></div>
                    </li>
                    <li class="task-item">
                        <input class="form-check-input" type="checkbox" value="" checked onclick="event.stopPropagation();">
                        <div class="task-content">
                            <span class="text-decoration-line-through text-muted">
                                <i class="ri-flag-line priority-low" title="Low Priority"></i>
                                Enviar Engagement Letter para firma
                            </span>
                             <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="task-due-date">Due: Sep 18</span>
                            </div>
                        </div>
                        <div class="progress-ring" style="background: conic-gradient(var(--bs-success) 100%, var(--bs-light) 0);" data-bs-toggle="tooltip" title="100%"></div>
                    </li>
                    <li class="task-item">
                        <input class="form-check-input" type="checkbox" value="" onclick="event.stopPropagation();">
                        <div class="task-content">
                             <i class="ri-flag-fill priority-medium" title="Medium Priority"></i>
                            <span class="fw-medium">Recopilar documentación para OIC</span>
                             <ul class="subtask-list ps-0">
                                <li class="subtask-item"><input class="form-check-input" type="checkbox" value="" checked onclick="event.stopPropagation();"><span class="text-muted text-decoration-line-through">Verificar Formulario 433-A</span></li>
                                <li class="subtask-item"><input class="form-check-input" type="checkbox" value="" onclick="event.stopPropagation();"><span>Confirmar estados de cuenta bancarios</span></li>
                            </ul>
                        </div>
                        <div class="progress-ring" style="background: conic-gradient(var(--bs-primary) 50%, var(--bs-light) 0);" data-bs-toggle="tooltip" title="50%"></div>
                    </li>
                     <li class="task-item">
                        <input class="form-check-input" type="checkbox" value="" onclick="event.stopPropagation();">
                        <div class="task-content">
                            <i class="ri-flag-line priority-low" title="Low Priority"></i>
                            @client, please date and sign whenever possible.
                            <div class="d-flex align-items-center gap-2 mt-1">
                               <div class="task-assignee-avatar" style="background-color: #fd7e14;" title="Ana Perez">AP</div>
                           </div>
                        </div>
                        <div class="progress-ring" style="background: conic-gradient(var(--bs-warning) 0%, var(--bs-light) 0);" data-bs-toggle="tooltip" title="0% - Pending Client"></div>
                    </li>
                </ul>
            </div>
             <!-- NEW: File Manager Tab Pane -->
            <div class="tab-pane fade p-3" id="files-tab-pane" role="tabpanel">
                <h6 class="text-muted fs-xs text-uppercase mb-3">Case Files</h6>
                <ul class="list-unstyled">
                    <li class="file-item"><i class="ri-file-pdf-2-line ri-lg text-danger"></i> <div class="fs-sm">IRS_Notice_CP504.pdf</div><button class="btn btn-xs btn-light ms-auto"><i class="ri-download-2-line"></i></button></li>
                    <li class="file-item"><i class="ri-file-excel-2-line ri-lg text-success"></i> <div class="fs-sm">Financial_Statement.xlsx</div><button class="btn btn-xs btn-light ms-auto"><i class="ri-download-2-line"></i></button></li>
                    <li class="file-item"><i class="ri-file-word-2-line ri-lg text-primary"></i> <div class="fs-sm">Client_Notes.docx</div><button class="btn btn-xs btn-light ms-auto"><i class="ri-download-2-line"></i></button></li>
                    <li class="file-item"><i class="ri-image-line ri-lg text-info"></i> <div class="fs-sm">Receipt_Expense_01.jpg</div><button class="btn btn-xs btn-light ms-auto"><i class="ri-download-2-line"></i></button></li>
                </ul>
            </div>
            <!-- NEW: Case Details Tab Pane -->
            <div class="tab-pane fade p-3" id="details-tab-pane" role="tabpanel">
                 <h6 class="text-muted fs-xs text-uppercase mb-3">Case Details</h6>
                 <div class="case-detail-item"><span>Case ID:</span> <span class="fw-medium">TR-2023-0815</span></div>
                 <div class="case-detail-item"><span>Case Type:</span> <span class="fw-medium">Offer in Compromise</span></div>
                 <div class="case-detail-item"><span>Case Status:</span> <span class="badge bg-label-info">Investigation</span></div>
                 <div class="case-detail-item"><span>Total Debt:</span> <span class="fw-medium">$45,280.50</span></div>

                 <h6 class="text-muted fs-xs text-uppercase my-3">Team Assigned</h6>
                 <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-2"><img src="{{ asset('assets/img/avatars/1.png') }}" alt="Javier Romero" class="rounded-circle me-2" width="32" height="32"><div><div class="fw-medium">Javier Romero</div><div class="text-muted fs-xs">Lead Enrolled Agent</div></div></li>
                    <li class="d-flex align-items-center"><img src="{{ asset('assets/img/avatars/5.png') }}" alt="Ana Perez" class="rounded-circle me-2" width="32" height="32"><div><div class="fw-medium">Ana Perez</div><div class="text-muted fs-xs">Case Manager</div></div></li>
                 </ul>
            </div>
            <!-- Quick Actions Tab Pane -->
            <div class="tab-pane fade p-3 fs-sm" id="actions-tab-pane" role="tabpanel">
                <h6 class="text-muted fs-xs text-uppercase mb-3">Quick Actions</h6>
                <div class="d-grid gap-2">
                    {{-- MODIFIED: This button now also opens the create modal --}}
                    <button class="btn btn-sm btn-primary text-start" data-bs-toggle="modal" data-bs-target="#createTaskModal"><i class="ri-add-line me-2"></i>Create New Task</button>
                    <button class="btn btn-sm btn-outline-secondary text-start"><i class="ri-mail-send-line me-2"></i>Send Client Message</button>
                    <button class="btn btn-sm btn-outline-secondary text-start"><i class="ri-file-upload-line me-2"></i>Request a Document</button>
                    <button class="btn btn-sm btn-outline-secondary text-start"><i class="ri-calendar-event-line me-2"></i>Schedule a Meeting</button>
                    <button class="btn btn-sm btn-outline-info text-start"><i class="ri-quill-pen-line me-2"></i>Request e-Signature</button>
                </div>
            </div>
        </div>
    </div>


    <!-- =================================================
    MAIN CONTENT: Case File & Communication
    ================================================= -->
    <div id="main-task-content">
        <!-- Chat Header -->
        <div class="chat-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="flex-grow-1 me-2"><input type="text" id="chatSearchInput" class="form-control form-control-sm" placeholder="Search in this case file..."></div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-light me-1" title="Add to Favorites"><i class="ri-star-line"></i></button>
                    <button class="btn btn-sm btn-light" title="Case Settings"><i class="ri-settings-3-line"></i></button>
                </div>
            </div>
        </div>

        <!-- NEW: Pinned Message -->
        <div class="pinned-message">
            <i class="ri-pushpin-2-fill text-info"></i>
            <div><strong>IRS Notice:</strong> CP504 - Intent to Levy. Respond by <strong>Oct 15, 2023</strong>.</div>
            <button class="btn btn-xs btn-text text-info ms-auto" title="Unpin"><i class="ri-close-line"></i></button>
        </div>

        <!-- Chat Timeline -->
        <div class="chat-timeline">
            {{-- MODIFIED: Added new example messages and task card visualization --}}
            <div class="system-message"><strong>Javier Romero</strong> created this case 5 days ago</div>
            
            <div class="chat-message">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-header"><span class="author">Javier Romero</span><span class="timestamp">5 days ago</span></div>
                    <div class="message-bubble"><h6 class="fs-sm fw-bold">Case Opened: Offer in Compromise</h6><p class="fs-sm mb-0">Client has received an IRS notice CP504. Starting the process for an Offer in Compromise. First step: gather all financial documentation.</p></div>
                </div>
            </div>

            <div class="chat-message">
                <img src="{{ asset('assets/img/avatars/2.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-header"><span class="author">Client Name</span><span class="timestamp">4 days ago</span></div>
                    <div class="message-bubble"><p class="fs-sm mb-0">I've uploaded the files you requested. Please let me know if you need anything else! 😊</p></div>
                </div>
            </div>
            
            <div class="system-message"><strong>Client Name</strong> attached 2 files 4 days ago</div>
            
            <div class="chat-message internal-note">
                <img src="{{ asset('assets/img/avatars/5.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-header"><span class="author">Ana Perez</span><span class="timestamp">3 days ago</span></div>
                    <div class="message-bubble">
                        <p class="fs-sm mb-0">Heads up @Javier Romero, client's bank statements show a recent large deposit. Might be a gift. We need to ask about the source before submitting Form 433-A.</p>
                    </div>
                </div>
            </div>
            
            <div class="system-message"><strong>Javier Romero</strong> created a new task 2 hours ago</div>

            <!-- NEW: EXAMPLE OF A TASK CARD IN THE CHAT -->
            <div class="chat-message task-creation">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="task-card-in-chat">
                            <div class="task-header">
                                <i class="ri-task-line task-icon"></i>
                                <h6 class="task-title">Recopilar documentación para OIC</h6>
                                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#taskDetailModal">View Details</button>
                            </div>
                            
                            <div class="task-meta-grid">
                                <div class="meta-item">
                                    <span class="meta-label">Assignees</span>
                                    <div class="meta-value">
                                        <div class="avatar-stack">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Javier Romero" class="avatar" data-bs-toggle="tooltip" title="Javier Romero">
                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Ana Perez" class="avatar" data-bs-toggle="tooltip" title="Ana Perez">
                                        </div>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Due Date</span>
                                    <div class="meta-value">
                                        <span class="task-due-date">Due: in 3 days</span>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Priority</span>
                                    <div class="meta-value">
                                        <i class="ri-flag-fill priority-medium me-1"></i> Medium
                                    </div>
                                </div>
                            </div>

                            <div class="checklist-progress">
                                <div class="progress-info">
                                    <strong>Checklist</strong>
                                    <span>1 of 2 completed</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="checklist-items">
                                <div class="checklist-item-in-chat">
                                    <input class="form-check-input" type="checkbox" value="" checked disabled>
                                    <span class="text-muted text-decoration-line-through">Verificar Formulario 433-A</span>
                                </div>
                                <div class="checklist-item-in-chat">
                                    <input class="form-check-input" type="checkbox" value="" disabled>
                                    <span>Confirmar estados de cuenta bancarios</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chat-message">
                <img src="{{ asset('assets/img/avatars/5.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-header"><span class="author">Ana Perez</span><span class="timestamp">1 hour ago</span></div>
                    <div class="message-bubble"><p class="fs-sm mb-0">Perfect, I've checked off the first item. I will follow up with the client for the bank statements. @Client Name, could you please provide your last 3 bank statements?</p></div>
                </div>
            </div>

        </div>

        <!-- Chat Input Area -->
        <div id="chat-input-area" class="chat-input-area flex-shrink-0">
            {{-- Chat input remains the same --}}
            <div id="canned-response-container" class="list-group position-absolute bottom-100 start-0 w-100 mb-1 shadow-sm" style="display: none; max-height: 250px; overflow-y: auto;">
                <a href="#" class="list-group-item list-group-item-action canned-item" data-value="Hello, could you please upload your most recent bank statements to our secure portal? Thank you.">Request Bank Statements</a>
                <a href="#" class="list-group-item list-group-item-action canned-item" data-value="We have received your documents. Our team will review them and get back to you within 2-3 business days.">Acknowledge Document Receipt</a>
                <a href="#" class="list-group-item list-group-item-action canned-item" data-value="Please find the attached document for your review. Let us know if you have any questions.">Share Document</a>
            </div>
            <div class="chat-input-wrapper mb-1">
                 <textarea id="chat-input-textarea" class="form-control form-control-sm" rows="1" placeholder="Type a message to the client..."></textarea>
                 <button id="chat-send-btn" class="btn btn-primary btn-sm btn-icon rounded-circle btn-send" title="Send Message"><i class="ri-send-plane-fill"></i></button>
            </div>
            <div class="chat-toolbar d-flex align-items-center">
                <button class="btn btn-xs btn-text" title="Attach file"><i class="ri-attachment-2"></i></button>
                <button class="btn btn-xs btn-text" title="Emoji"><i class="ri-emotion-happy-line"></i></button>
                <button id="mention-btn" class="btn btn-xs btn-text" title="Mention user"><i class="ri-at-line"></i></button>
                <button id="canned-response-btn" class="btn btn-xs btn-text" title="Canned Responses"><i class="ri-file-list-2-line"></i></button>
                <div class="ms-auto d-flex align-items-center">
                    <div class="form-check form-switch me-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="internal-note-toggle">
                        <label class="form-check-label fs-xs text-muted" for="internal-note-toggle">Internal Note</label>
                    </div>
                    <div class="fs-xs text-muted">Press <kbd>Enter</kbd> to send</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =================================================
MODIFIED: CREATE TASK MODAL WITH NEW DESIGN
================================================= -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createTaskModalLabel">Create New Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="createTaskForm">
          <!-- Task Title & Stage Indicator -->
          <div class="d-flex align-items-center gap-3 mb-4">
            <input type="text" class="form-control" id="createTaskTitle" placeholder="Task Title (e.g., Follow up with client...)" required>
            <div id="create-task-stage-indicator" class="task-stage-indicator" data-bs-toggle="tooltip" title="Task Stages"></div>
          </div>

          <!-- Assignees, Due Date, Priority, and Internal Switch -->
          <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
              <!-- Assignees -->
              <div>
                  <label class="form-label fs-xs text-muted mb-1">Assignees</label>
                  <div class="assignee-stack">
                      <div class="avatar-stack" data-bs-toggle="tooltip" title="Current Assignees: Javier Romero, Ana Perez">
                          <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Javier Romero" class="avatar">
                          <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Ana Perez" class="avatar">
                      </div>
                      <button class="btn btn-icon rounded-circle avatar-add-btn" type="button" title="Add Assignee"><i class="ri-add-line"></i></button>
                  </div>
              </div>

              <!-- Due Date & Time -->
              <div>
                  <label for="createTaskDueDate" class="form-label fs-xs text-muted mb-1">Due Date & Time</label>
                  <div class="due-date-wrapper">
                      <input type="date" class="form-control" id="createTaskDueDate" value="{{ now()->addDays(3)->format('Y-m-d') }}">
                      <span class="date-divider px-1"><i class="ri-time-line ri-sm"></i></span>
                      <input type="time" class="form-control" id="createTaskDueTime" value="09:00">
                  </div>
              </div>

              <!-- Priority -->
              <div class="priority-dropdown">
                  <label class="form-label fs-xs text-muted mb-1">Priority</label>
                  <div class="dropdown">
                      <button class="btn btn-light dropdown-toggle" type="button" id="priorityDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="ri-flag-fill text-warning me-1"></i> Medium
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="priorityDropdownButton">
                          <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-danger"></i> High</a></li>
                          <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-warning"></i> Medium</a></li>
                          <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-secondary"></i> Low</a></li>
                          <li><a class="dropdown-item" href="#"><i class="ri-flag-line text-muted"></i> None</a></li>
                      </ul>
                  </div>
              </div>
              
              <!-- Internal Task Switch -->
              <div>
                  <label class="form-label fs-xs text-muted mb-1">Visibility</label>
                  <div class="form-check form-switch pt-2">
                      <input class="form-check-input" type="checkbox" role="switch" id="createTaskInternal">
                      <label class="form-check-label small" for="createTaskInternal">Internal Task</label>
                  </div>
              </div>
          </div>

          <!-- Description -->
          <div class="mb-4">
            <label class="form-label fs-sm fw-medium">Description</label>
            <div class="description-wrapper">
              <div class="editor-toolbar">
                  <div class="btn-group btn-group-sm">
                      <button type="button" class="btn" title="Bold"><i class="ri-bold"></i></button>
                      <button type="button" class="btn" title="Italic"><i class="ri-italic"></i></button>
                      <button type="button" class="btn" title="Underline"><i class="ri-underline"></i></button>
                  </div>
                  <div class="btn-group btn-group-sm ms-2">
                      <button type="button" class="btn" title="Bulleted List"><i class="ri-list-ul"></i></button>
                      <button type="button" class="btn" title="Numbered List"><i class="ri-list-ol"></i></button>
                      <button type="button" class="btn" title="Link"><i class="ri-links-line"></i></button>
                  </div>
                   <div class="btn-group btn-group-sm ms-2">
                      <button type="button" class="btn" title="Attach File" onclick="document.getElementById('taskAttachmentsInput').click();"><i class="ri-attachment-2"></i></button>
                  </div>
              </div>
              <textarea class="form-control" id="createTaskDescription" rows="5" placeholder="Add a more detailed description, @mention team members..."></textarea>
            </div>
          </div>

          <!-- Checklist -->
          <div class="mb-4">
              <label class="form-label fs-sm fw-medium mb-2">Checklist</label>
              <div class="checklist-wrapper">
                  <div id="create-task-checklist-container">
                    <!-- Sub-tasks will be dynamically added here by JS -->
                  </div>
                  <button type="button" class="btn btn-sm btn-link px-0 text-decoration-none" id="add-checklist-item-btn"><i class="ri-add-line me-1"></i>Add an item</button>
              </div>
          </div>
          
          <!-- Attachments (Hidden input and preview area) -->
          <div>
              <input type="file" id="taskAttachmentsInput" multiple class="d-none">
              <!-- Container for attached file previews -->
              <div id="task-attachments-preview" class="mt-2"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Create Task</button>
      </div>
    </div>
  </div>
</div>


<!-- =================================================
MODIFIED: TASK DETAIL MODAL WITH NEW DESIGN
================================================= -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="taskDetailModalLabel">Task Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Task Title & Stage Indicator -->
        <div class="d-flex align-items-center gap-3 mb-4">
            <input type="text" class="form-control" id="taskDetailTitle" value="Revisar notificación del IRS CP504">
            <div id="detail-task-stage-indicator" class="task-stage-indicator" data-bs-toggle="tooltip" title="Task Stages"></div>
        </div>

        <!-- Assignees, Due Date, Priority, and Internal Switch -->
        <div class="d-flex flex-wrap align-items-center gap-4 mb-4">
            <!-- Assignees -->
            <div>
                <label class="form-label fs-xs text-muted mb-1">Assignees</label>
                <div class="assignee-stack">
                    <div class="avatar-stack" data-bs-toggle="tooltip" title="Current Assignee: Javier Romero">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Javier Romero" class="avatar">
                    </div>
                    <button class="btn btn-icon rounded-circle avatar-add-btn" type="button" title="Add Assignee"><i class="ri-add-line"></i></button>
                </div>
            </div>

            <!-- Due Date & Time -->
            <div>
                <label for="taskDetailDueDate" class="form-label fs-xs text-muted mb-1">Due Date & Time</label>
                <div class="due-date-wrapper">
                    <input type="date" class="form-control" id="taskDetailDueDate" value="{{ now()->addDays(5)->format('Y-m-d') }}">
                    <span class="date-divider px-1"><i class="ri-time-line ri-sm"></i></span>
                    <input type="time" class="form-control" id="taskDetailDueTime" value="17:00">
                </div>
            </div>

            <!-- Priority -->
            <div class="priority-dropdown">
                <label class="form-label fs-xs text-muted mb-1">Priority</label>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="detailPriorityDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-flag-fill text-danger me-1"></i> High
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="detailPriorityDropdownButton">
                        <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-danger"></i> High</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-warning"></i> Medium</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ri-flag-fill text-secondary"></i> Low</a></li>
                        <li><a class="dropdown-item" href="#"><i class="ri-flag-line text-muted"></i> None</a></li>
                    </ul>
                </div>
            </div>

            <!-- Internal Task Switch -->
            <div>
                <label class="form-label fs-xs text-muted mb-1">Visibility</label>
                <div class="form-check form-switch pt-2">
                    <input class="form-check-input" type="checkbox" role="switch" id="taskDetailInternal">
                    <label class="form-check-label small" for="taskDetailInternal">Internal Task</label>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label class="form-label fs-sm fw-medium">Description</label>
          <div class="description-wrapper">
            <div class="editor-toolbar">
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn" title="Bold"><i class="ri-bold"></i></button>
                    <button type="button" class="btn" title="Italic"><i class="ri-italic"></i></button>
                    <button type="button" class="btn" title="Underline"><i class="ri-underline"></i></button>
                </div>
                <div class="btn-group btn-group-sm ms-2">
                    <button type="button" class="btn" title="Bulleted List"><i class="ri-list-ul"></i></button>
                    <button type="button" class="btn" title="Numbered List"><i class="ri-list-ol"></i></button>
                    <button type="button" class="btn" title="Link"><i class="ri-links-line"></i></button>
                </div>
                 <div class="btn-group btn-group-sm ms-2">
                    <button type="button" class="btn" title="Attach File"><i class="ri-attachment-2"></i></button>
                </div>
            </div>
            <textarea class="form-control" id="taskDetailDescription" rows="4" placeholder="Add a more detailed description...">The client has received an IRS notice CP504 regarding intent to levy. We must respond before the deadline to avoid further action. Need to prepare Form 433-A and gather all supporting financial documents.</textarea>
          </div>
        </div>

        <!-- Checklist -->
        <div class="mb-4">
            <label class="form-label fs-sm fw-medium mb-2">Checklist</label>
            <div class="checklist-wrapper">
                <div id="detail-task-checklist-container">
                    <div class="checklist-item mb-1"><input class="form-check-input" type="checkbox" checked><input type="text" class="form-control form-control-sm" value="Verificar Formulario 433-A"><button type="button" class="btn btn-sm btn-text text-danger remove-checklist-item-btn" title="Remove item"><i class="ri-close-line"></i></button></div>
                    <div class="checklist-item mb-1"><input class="form-check-input" type="checkbox"><input type="text" class="form-control form-control-sm" value="Confirmar estados de cuenta bancarios"><button type="button" class="btn btn-sm btn-text text-danger remove-checklist-item-btn" title="Remove item"><i class="ri-close-line"></i></button></div>
                    <div class="checklist-item mb-1"><input class="form-check-input" type="checkbox"><input type="text" class="form-control form-control-sm" value="Solicitar talones de pago recientes"><button type="button" class="btn btn-sm btn-text text-danger remove-checklist-item-btn" title="Remove item"><i class="ri-close-line"></i></button></div>
                </div>
                <button type="button" class="btn btn-sm btn-link px-0 text-decoration-none" id="detail-add-checklist-item-btn"><i class="ri-add-line me-1"></i>Add an item</button>
            </div>
        </div>
        
        <!-- Attachments -->
        <div class="mb-3">
            <label class="form-label fs-sm fw-medium">Attachments</label>
            <div id="detail-task-attachments-preview">
                <div class="d-flex align-items-center p-2 mt-1 border rounded fs-sm bg-light">
                    <i class="ri-file-pdf-2-line ri-lg me-2 text-danger"></i>
                    <span class="text-truncate">IRS_Notice_CP504.pdf</span>
                    <button class="btn btn-xs btn-text-danger ms-auto"><i class="ri-close-line"></i></button>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-secondary mt-2"><i class="ri-attachment-2 me-1"></i>Attach File</button>
        </div>
      </div>
      <div class="modal-footer">
        <span class="fs-xs text-muted me-auto">Last updated 3 hours ago</span>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>


{{-- Scripts for interactivity --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- INITIALIZATION ---
    // Initialize all tooltips on the page
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl); });

    // --- RESIZABLE SIDEBAR ---
    const sidebar = document.getElementById('task-list-sidebar');
    const resizeHandle = document.getElementById('resize-handle');
    if (sidebar && resizeHandle) {
        let isResizing = false;
        resizeHandle.addEventListener('mousedown', function(e) {
            isResizing = true;
            document.body.style.cursor = 'col-resize';
            document.body.style.userSelect = 'none';
            document.addEventListener('mouseup', stopResizing);
            document.addEventListener('mousemove', resize);
        });
        function resize(e) {
            if (!isResizing) return;
            const newWidth = document.body.clientWidth - e.clientX;
            const minWidth = parseInt(getComputedStyle(sidebar).minWidth);
            const maxWidth = parseInt(getComputedStyle(sidebar).maxWidth);
            if (newWidth > minWidth && newWidth < maxWidth) { sidebar.style.width = newWidth + 'px'; }
        }
        function stopResizing() {
            isResizing = false;
            document.body.style.cursor = 'default';
            document.body.style.userSelect = 'auto';
            document.removeEventListener('mouseup', stopResizing);
            document.removeEventListener('mousemove', resize);
        }
    }

    // --- SEARCH FILTERS ---
    const taskSearchInput = document.getElementById('taskSearchInput');
    const taskItems = document.querySelectorAll('#tasks-tab-pane .task-item');
    if (taskSearchInput && taskItems.length) {
        taskSearchInput.addEventListener('keyup', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            taskItems.forEach(item => {
                item.style.display = item.textContent.toLowerCase().includes(searchTerm) ? 'flex' : 'none';
            });
        });
    }

    const chatSearchInput = document.getElementById('chatSearchInput');
    const chatTimeline = document.querySelector('.chat-timeline');
    const allChatMessages = chatTimeline ? chatTimeline.querySelectorAll('.chat-message, .system-message') : [];
    if (chatSearchInput && allChatMessages.length) {
        chatSearchInput.addEventListener('keyup', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            allChatMessages.forEach(msg => {
                if (searchTerm.length < 2) {
                    msg.style.display = (msg.classList.contains('chat-message')) ? 'flex' : 'block';
                } else {
                    msg.style.display = msg.textContent.toLowerCase().includes(searchTerm) ? 
                        ((msg.classList.contains('chat-message')) ? 'flex' : 'block') : 'none';
                }
            });
        });
    }
    
    // =================================================
    // NEW: SHOW TASK IN CHAT FROM SIDEBAR CLICK
    // =================================================
    const taskListForChat = document.querySelector('.task-list-container');
    const chatTimelineForTask = document.querySelector('.chat-timeline');

    if (taskListForChat && chatTimelineForTask) {
        taskListForChat.addEventListener('click', function(e) {
            const clickedTaskItem = e.target.closest('.task-item');
            
            // Ignore click if it's on an interactive element like a checkbox
            if (!clickedTaskItem || e.target.matches('input, a, button, .form-check-input')) {
                return;
            }

            // Remove active class from other items and add to the clicked one
            this.querySelectorAll('.task-item.active').forEach(item => item.classList.remove('active'));
            clickedTaskItem.classList.add('active');

            // For this static demo, we'll create a predefined HTML block.
            // In a real app, you would fetch task data via AJAX.
            const taskTitle = clickedTaskItem.querySelector('.task-content').innerText.split('\n')[0].trim();

            const taskCardHtml = `
            <div class="system-message">Task <strong>"${taskTitle}"</strong> selected</div>
            <div class="chat-message task-creation">
                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="User" class="avatar rounded-circle" width="32" height="32">
                <div class="message-content">
                    <div class="message-bubble">
                        <div class="task-card-in-chat">
                            <div class="task-header">
                                <i class="ri-task-line task-icon"></i>
                                <h6 class="task-title">${taskTitle}</h6>
                                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#taskDetailModal">View Details</button>
                            </div>
                            <div class="task-meta-grid">
                                <div class="meta-item">
                                    <span class="meta-label">Assignees</span>
                                    <div class="meta-value">
                                        <div class="avatar-stack">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Javier Romero" class="avatar" data-bs-toggle="tooltip" title="Javier Romero">
                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Ana Perez" class="avatar" data-bs-toggle="tooltip" title="Ana Perez">
                                        </div>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Due Date</span>
                                    <div class="meta-value">
                                        <span class="task-due-date is-overdue">Due: Yesterday</span>
                                    </div>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Priority</span>
                                    <div class="meta-value">
                                        <i class="ri-flag-fill priority-high me-1"></i> High
                                    </div>
                                </div>
                            </div>
                            <div class="checklist-progress">
                                <div class="progress-info">
                                    <strong>Checklist</strong>
                                    <span>2 of 3 completed</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="checklist-items">
                                <div class="checklist-item-in-chat"><input class="form-check-input" type="checkbox" value="" checked disabled><span class="text-muted text-decoration-line-through">Verificar Formulario 433-A</span></div>
                                <div class="checklist-item-in-chat"><input class="form-check-input" type="checkbox" value="" checked disabled><span class="text-muted text-decoration-line-through">Confirmar estados de cuenta bancarios</span></div>
                                <div class="checklist-item-in-chat"><input class="form-check-input" type="checkbox" value="" disabled><span>Solicitar talones de pago</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            
            chatTimelineForTask.insertAdjacentHTML('beforeend', taskCardHtml);
            
            // Scroll to the new message
            chatTimelineForTask.scrollTop = chatTimelineForTask.scrollHeight;

            // Re-initialize tooltips for the new elements added to the DOM
            const newTooltips = chatTimelineForTask.querySelectorAll('.task-card-in-chat [data-bs-toggle="tooltip"]');
            newTooltips.forEach(el => {
                if (!bootstrap.Tooltip.getInstance(el)) {
                    new bootstrap.Tooltip(el);
                }
            });
        });
    }

    // =================================================
    // MODAL HELPER FUNCTIONS
    // =================================================
    // Function to update the conic gradient for the stage indicator
    const updateStageIndicator = (indicatorEl, checklistContainerEl) => {
        if (!indicatorEl || !checklistContainerEl) return;
        const itemCount = checklistContainerEl.children.length;
        const indicatorTooltip = bootstrap.Tooltip.getInstance(indicatorEl);

        if (itemCount <= 1) {
            indicatorEl.style.background = 'var(--bs-tertiary-bg)';
            if (indicatorTooltip) {
                indicatorTooltip.setContent({ '.tooltip-inner': itemCount === 0 ? 'No Stages' : '1 Stage' });
            }
            return;
        }

        const segmentAngle = 360 / itemCount;
        let gradient = 'conic-gradient(';
        const color1 = 'var(--bs-primary)';
        const color2 = 'var(--bs-secondary-bg)';

        for (let i = 0; i < itemCount; i++) {
            const startAngle = i * segmentAngle;
            const endAngle = (i + 1) * segmentAngle;
            const color = i % 2 === 0 ? color1 : color2;
            gradient += `${color} ${startAngle}deg ${endAngle}deg`;
            if (i < itemCount - 1) {
                gradient += ', ';
            }
        }
        gradient += ')';

        indicatorEl.style.background = gradient;
        if (indicatorTooltip) {
            indicatorTooltip.setContent({ '.tooltip-inner': `${itemCount} Stages` });
        }
    };


    // =================================================
    // CREATE TASK MODAL INTERACTIVITY
    // =================================================
    const createTaskModalEl = document.getElementById('createTaskModal');
    if(createTaskModalEl) {
        const checklistContainer = document.getElementById('create-task-checklist-container');
        const addChecklistItemBtn = document.getElementById('add-checklist-item-btn');
        const taskAttachmentsInput = document.getElementById('taskAttachmentsInput');
        const taskAttachmentsPreview = document.getElementById('task-attachments-preview');
        const stageIndicator = document.getElementById('create-task-stage-indicator');

        // Function to add a new checklist item
        const addChecklistItem = () => {
            const newItemWrapper = document.createElement('div');
            newItemWrapper.className = 'checklist-item mb-1';
            newItemWrapper.innerHTML = `
                <input class="form-check-input" type="checkbox">
                <input type="text" class="form-control form-control-sm" placeholder="Add an item...">
                <button type="button" class="btn btn-sm btn-text text-danger remove-checklist-item-btn" title="Remove item"><i class="ri-close-line"></i></button>
            `;
            checklistContainer.appendChild(newItemWrapper);
            newItemWrapper.querySelector('input[type="text"]').focus();
            updateStageIndicator(stageIndicator, checklistContainer);
        };

        addChecklistItemBtn.addEventListener('click', addChecklistItem);

        checklistContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-checklist-item-btn')) {
                e.target.closest('.checklist-item').remove();
                updateStageIndicator(stageIndicator, checklistContainer);
            }
        });
        
        taskAttachmentsInput.addEventListener('change', (e) => {
            taskAttachmentsPreview.innerHTML = '';
            if(e.target.files.length > 0) {
                taskAttachmentsPreview.innerHTML = Array.from(e.target.files).map(file => `
                    <div class="d-flex align-items-center p-2 mt-1 border rounded fs-sm bg-light">
                        <i class="ri-file-line ri-lg me-2"></i>
                        <span class="text-truncate">${file.name}</span>
                        <span class="text-muted ms-auto ps-2">${(file.size / 1024).toFixed(1)} KB</span>
                    </div>
                `).join('');
            }
        });
        
        const priorityDropdown = createTaskModalEl.querySelector('.priority-dropdown');
        if (priorityDropdown) {
            priorityDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    priorityDropdown.querySelector('.dropdown-toggle').innerHTML = this.innerHTML;
                });
            });
        }

        createTaskModalEl.addEventListener('hidden.bs.modal', function () {
            document.getElementById('createTaskForm').reset();
            checklistContainer.innerHTML = '';
            taskAttachmentsPreview.innerHTML = '';
            priorityDropdown.querySelector('.dropdown-toggle').innerHTML = '<i class="ri-flag-fill text-warning me-1"></i> Medium';
            updateStageIndicator(stageIndicator, checklistContainer);
        });

        createTaskModalEl.addEventListener('shown.bs.modal', function () {
            if(checklistContainer.children.length === 0) { addChecklistItem(); }
            else { updateStageIndicator(stageIndicator, checklistContainer); }
            document.getElementById('createTaskTitle').focus();
        });
    }
    
    // =================================================
    // TASK DETAIL MODAL INTERACTIVITY
    // =================================================
    const taskDetailModalEl = document.getElementById('taskDetailModal');
    if (taskDetailModalEl) {
        // NOTE: The modal is now primarily opened from the "View Details" button in the chat task card.
        // We keep the rest of its internal logic.
        const detailChecklistContainer = document.getElementById('detail-task-checklist-container');
        const detailAddChecklistItemBtn = document.getElementById('detail-add-checklist-item-btn');
        const detailStageIndicator = document.getElementById('detail-task-stage-indicator');

        const addDetailChecklistItem = () => {
            const newItemWrapper = document.createElement('div');
            newItemWrapper.className = 'checklist-item mb-1';
            newItemWrapper.innerHTML = `
                <input class="form-check-input" type="checkbox">
                <input type="text" class="form-control form-control-sm" placeholder="Add an item...">
                <button type="button" class="btn btn-sm btn-text text-danger remove-checklist-item-btn" title="Remove item"><i class="ri-close-line"></i></button>
            `;
            detailChecklistContainer.appendChild(newItemWrapper);
            newItemWrapper.querySelector('input[type="text"]').focus();
            updateStageIndicator(detailStageIndicator, detailChecklistContainer);
        };

        if(detailAddChecklistItemBtn) detailAddChecklistItemBtn.addEventListener('click', addDetailChecklistItem);

        if(detailChecklistContainer) {
            detailChecklistContainer.addEventListener('click', (e) => {
                if (e.target.closest('.remove-checklist-item-btn')) {
                    e.target.closest('.checklist-item').remove();
                    updateStageIndicator(detailStageIndicator, detailChecklistContainer);
                }
            });
        }

        const detailPriorityDropdown = taskDetailModalEl.querySelector('.priority-dropdown');
        if (detailPriorityDropdown) {
             detailPriorityDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    detailPriorityDropdown.querySelector('.dropdown-toggle').innerHTML = this.innerHTML;
                });
            });
        }

        taskDetailModalEl.addEventListener('shown.bs.modal', function () {
            updateStageIndicator(detailStageIndicator, detailChecklistContainer);
            const modalTooltips = taskDetailModalEl.querySelectorAll('[data-bs-toggle="tooltip"]');
            modalTooltips.forEach(el => { if (!bootstrap.Tooltip.getInstance(el)) new bootstrap.Tooltip(el); });
        });
    }

    // =================================================
    // CHAT INTERACTIVITY SCRIPT (Existing logic)
    // =================================================
    const chatInputArea = document.getElementById('chat-input-area');
    const chatTextarea = document.getElementById('chat-input-textarea');
    const sendBtn = document.getElementById('chat-send-btn');
    const internalNoteToggle = document.getElementById('internal-note-toggle');
    const mentionBtn = document.getElementById('mention-btn');
    const cannedResponseBtn = document.getElementById('canned-response-btn');
    const cannedResponseContainer = document.getElementById('canned-response-container');

    function addChatMessage(data) {
        const { author, avatar, text, isInternal = false } = data;
        if (!text.trim()) return; 
        const messageEl = document.createElement('div');
        messageEl.classList.add('chat-message');
        if (isInternal) { messageEl.classList.add('internal-note'); }
        const timestamp = new Date().toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
        messageEl.innerHTML = `<img src="${avatar}" alt="${author}" class="avatar rounded-circle" width="32" height="32"><div class="message-content"><div class="message-header"><span class="author">${author}</span><span class="timestamp">${timestamp}</span></div><div class="message-bubble">${text.replace(/\n/g, '<br>')}</div></div>`;
        chatTimeline.appendChild(messageEl);
        chatTimeline.scrollTop = chatTimeline.scrollHeight;
        chatTextarea.value = '';
        chatTextarea.style.height = 'auto';
        chatTextarea.focus();
    }

    if(sendBtn) {
        sendBtn.addEventListener('click', () => {
            const isInternal = internalNoteToggle.checked;
            const currentUser = isInternal 
                ? { name: 'Ana Perez', avatar: '{{ asset('assets/img/avatars/5.png') }}' }
                : { name: 'Javier Romero', avatar: '{{ asset('assets/img/avatars/1.png') }}' };
            addChatMessage({ author: currentUser.name, avatar: currentUser.avatar, text: chatTextarea.value, isInternal: isInternal });
        });
    }

    if(chatTextarea){
        chatTextarea.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendBtn.click(); }
        });
        chatTextarea.addEventListener('input', () => {
            chatTextarea.style.height = 'auto';
            chatTextarea.style.height = (chatTextarea.scrollHeight) + 'px';
        });
    }

    if(internalNoteToggle){
        internalNoteToggle.addEventListener('change', () => {
            if (internalNoteToggle.checked) {
                chatInputArea.classList.add('internal-note-mode');
                chatTextarea.placeholder = 'Type an internal note (visible to team only)...';
            } else {
                chatInputArea.classList.remove('internal-note-mode');
                chatTextarea.placeholder = 'Type a message to the client...';
            }
            chatTextarea.focus();
        });
    }

    if(mentionBtn) {
        mentionBtn.addEventListener('click', () => { chatTextarea.value += '@'; chatTextarea.focus(); });
    }

    if(cannedResponseBtn) {
        cannedResponseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            cannedResponseContainer.style.display = cannedResponseContainer.style.display === 'none' ? 'block' : 'none';
        });
        document.addEventListener('click', () => {
            if(cannedResponseContainer) cannedResponseContainer.style.display = 'none';
        });
        cannedResponseContainer.addEventListener('click', (e) => {
           e.stopPropagation();
           if (e.target.classList.contains('canned-item')) {
               e.preventDefault();
               chatTextarea.value = e.target.dataset.value;
               cannedResponseContainer.style.display = 'none';
               chatTextarea.focus();
               chatTextarea.dispatchEvent(new Event('input'));
           }
        });
    }
});
</script>