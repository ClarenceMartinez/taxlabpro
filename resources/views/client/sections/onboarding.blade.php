<style>
    :root {
        --script-bg: var(--bs-body-bg);
        --script-border-color: var(--bs-border-color-translucent);
        --script-header-bg: var(--bs-tertiary-bg);
        --agent-script-bg: #eef2ff;
        --agent-script-border: #6366f1;
        --agent-script-color: #4338ca;
        --info-note-bg: #fefce8;
        --info-note-border: #facc15;
        --info-note-color: #713f12;
        --json-output-bg: #f8f9fa;
        --star-color: #e5e7eb;
        --star-color-filled: #f59e0b;
        --progress-bar-glow-color: rgba(139, 92, 246, 0.7);
        --progress-bar-bg: linear-gradient(90deg, #818cf8 0%, #a78bfa 100%);
        --progress-bar-completed-bg: linear-gradient(90deg, #22c55e 0%, #4ade80 100%);
    }
    [data-bs-theme="dark"] {
        --agent-script-bg: #312e81;
        --agent-script-border: #818cf8;
        --agent-script-color: #c7d2fe;
        --info-note-bg: #424031;
        --info-note-border: #a16207;
        --info-note-color: #fef08a;
        --json-output-bg: #212529;
        --star-color: #4b5563;
        --star-color-filled: #f59e0b;
        --progress-bar-glow-color: rgba(196, 181, 253, 0.6);
    }
    /* MODIFICACIÓN: Aumento del tamaño del script */
    #call-script-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background-color: var(--script-bg); border: 1px solid var(--script-border-color);
        border-radius: var(--bs-border-radius-xl); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        overflow: hidden; display: flex; flex-direction: column;
        height: 100vh; max-height: 1300px; /* Tamaño aumentado */
    }
    .script-header {
        padding: 0.25rem 0.6rem;
        border-bottom: 1px solid var(--script-border-color);
        display: flex; justify-content: space-between; align-items: center; flex-shrink: 0;
    }
    .script-header h3 { font-size: 1.25rem; margin: 0;}
    #script-progress-container { background-color: var(--bs-tertiary-bg); height: 8px; flex-shrink: 0; overflow: hidden;}
    #script-progress-bar {
        width: 0%; height: 100%; background: var(--progress-bar-bg);
        transition: width 0.5s ease-in-out, background 0.5s ease; position: relative; overflow: hidden;
    }
    #script-progress-bar:not(.completed)::after {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background-image: linear-gradient( -45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent );
        z-index: 1; background-size: 50px 50px; animation: move 2s linear infinite; border-radius: inherit;
    }
    #script-progress-bar.completed { background: var(--progress-bar-completed-bg); }
    @keyframes move { 0% { background-position: 0 0; } 100% { background-position: 50px 50px; } }

    /* MODIFICACIÓN: Aumento del padding para más espacio */
    #script-content-wrapper { flex-grow: 1; overflow-y: auto; padding: 1.5rem 3rem; }
    .script-section { padding: 2rem 0; border-bottom: 1px dashed var(--bs-border-color-translucent); }
    .script-section:last-child { border-bottom: none; }
    .section-title { font-weight: 700; font-size: 1rem; margin-bottom: 0.1rem; }
    .section-description { color: var(--bs-secondary-color); margin-bottom: 1.5rem; font-size: 1rem; }
    .agent-script { background-color: var(--agent-script-bg); border-left: 4px solid var(--agent-script-border); padding: 1rem 1.25rem; margin: 1.5rem 0; border-radius: var(--bs-border-radius); font-size: 1.1rem; line-height: 1.6; color: var(--agent-script-color); font-style: italic; }
    .agent-script i { margin-right: 0.5rem; vertical-align: -3px; font-size: 1.2rem; }
    .form-label-enhanced { display: block; font-weight: 600; font-size: 1.05rem; margin-bottom: 0.5rem; }
    #floating-timers-container { position: fixed; bottom: 20px; right: 20px; z-index: 1050; display: flex; flex-direction: column; gap: 10px; }
    .minimal-timer { background-color: var(--bs-tertiary-bg); border: 1px solid var(--script-border-color); border-radius: var(--bs-border-radius-pill); padding: 5px 12px; display: flex; align-items: center; gap: 8px; font-family: 'Courier New', Courier, monospace; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.2s ease-in-out; }
    .minimal-timer i.timer-icon { font-size: 1.1rem; color: var(--bs-secondary-color); }
    .minimal-timer .timer-display { font-size: 1.1rem; font-weight: 700; color: var(--bs-body-color); }
    .minimal-timer .timer-controls { display: none; }
    .minimal-timer:hover .timer-controls { display: flex; gap: 5px; margin-left: 5px; }
    .minimal-timer .btn-timer-control { width: 28px; height: 28px; padding: 0; font-size: 0.9rem; line-height: 1; border-radius: 50%; }
    .collapsible-title { cursor: pointer; display: flex; justify-content: space-between; align-items: center; text-decoration: none; color: inherit; }
    .collapsible-title:hover { color: var(--bs-primary); }
    .star-rating-widget { display: flex; gap: 0.25rem; font-size: 1.75rem; }
    .star-rating-widget .star { cursor: pointer; color: var(--star-color); transition: color 0.2s; }
    .star-rating-widget .star.filled, .star-rating-widget:hover .star:hover, .star-rating-widget:hover .star:hover ~ .star { color: var(--star-color); }
    .star-rating-widget:hover .star:hover, .star-rating-widget .star.filled { color: var(--star-color-filled); }
    .card-body .small { font-size: 1rem; }
    .client-profile-card { background-color: var(--bs-tertiary-bg); padding: 1.5rem; border-radius: var(--bs-border-radius-lg); }
    .profile-section { margin-bottom: 1.5rem; }
    .profile-section h5 { font-weight: 600; border-bottom: 1px solid var(--bs-border-color); padding-bottom: 0.5rem; margin-bottom: 1rem; }
    .profile-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem; font-size: 0.95rem; }
    .profile-item .label { color: var(--bs-secondary-color); }
    .profile-item .value { font-weight: 500; text-align: right; }
    .info-note { background-color: var(--info-note-bg); border: 1px solid var(--info-note-border); padding: 1rem 1.25rem; margin: 1.5rem 0; border-radius: var(--bs-border-radius); color: var(--info-note-color); display: flex; align-items: flex-start; gap: 0.75rem; font-size: 1.1rem; }
    .info-note i { font-size: 1.2rem; margin-top: 0.15rem; }
    .info-note strong { margin-right: 0.3rem; }
    .script-section[data-step="4"] .list-group-item { font-size: 1.05rem; }
    .payment-processor-widget { border: 1px solid var(--bs-border-color-translucent); border-radius: var(--bs-border-radius-lg); padding: 1.5rem; background-color: var(--bs-tertiary-bg); }
    .payment-header { text-align: center; margin-bottom: 1.5rem; }
    .payment-amount-input { font-size: 1.8rem !important; font-weight: 700 !important; color: var(--bs-primary) !important; line-height: 1 !important; text-align: center !important; border: none !important; background-color: transparent !important; box-shadow: none !important; padding: 0 !important; }
    .payment-amount-input:focus { background-color: var(--bs-body-bg) !important; border-radius: var(--bs-border-radius-sm) !important; }
    .payment-description { font-size: 0.9rem; color: var(--bs-secondary-color); }
    #card-number-input { letter-spacing: 3px; font-family: 'Courier New', Courier, monospace; }
    .btn-check:checked + .btn-outline-secondary { background-color: var(--bs-primary)!important; color: var(--bs-white)!important; border-color: var(--bs-primary)!important; }
    #success-screen { display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%; }
    #success-screen i { font-size: 5rem; color: var(--bs-success); }
    
    /* --- INICIO: ESTILOS DIFERENCIABLES PARA EL PARCIAL --- */
    /* MODIFICACIÓN: Inputs con texto y padding más grandes */
    #call-script-container .form-control, 
    #call-script-container .form-select {
        font-size: 1.05rem; /* Aumenta el tamaño del texto */
        padding-top: 0.6rem;
        padding-bottom: 0.6rem;
        height: auto;
    }
    /* Evita que el input de monto de pago se haga más grande */
    #call-script-container .payment-amount-input {
        font-size: 1.8rem !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
    /* Estilo para el nuevo botón de exportación para diferenciarlo */
    #export-csv-btn {
        font-weight: 500;
    }
    /* --- FIN: ESTILOS DIFERENCIABLES PARA EL PARCIAL --- */
</style>


        <div id="success-screen" style="display: none;">
            <div class="text-center p-5">
                <i class="ri-checkbox-circle-line mb-4"></i>
                <h2 class="mb-3" data-translate-key="successTitle">Llamada Finalizada con Éxito</h2>
                <p class="text-muted mb-4" data-translate-key="successMessage">El resumen de la llamada ha sido guardado.</p>
                <button id="start-new-call-btn" class="btn btn-primary btn-lg">
                    <i class="ri-phone-line me-2"></i><span data-translate-key="btnNewCall">Comenzar Nueva Llamada</span>
                </button>
            </div>
        </div>

        <div id="call-script-container">
            <div class="script-header">
                <h3 id="script-title" data-translate-key="scriptTitle" style="font-size: 0.9rem; margin: 0;"></h3>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="lang-btn-es">ES</button>
                    <button type="button" class="btn btn-outline-primary" id="lang-btn-en">EN</button>
                </div>
            </div>
            <div id="script-progress-container"><div id="script-progress-bar"></div></div>
            <div id="script-content-wrapper">
                <section class="script-section" data-step="1"> <h2 class="section-title" data-translate-key="step1Title"></h2> <blockquote class="agent-script"><i class="ri-customer-service-2-line"></i><span data-translate-key="step1Greeting"></span></blockquote> </section>
                <section class="script-section" data-step="2"> <h2 class="section-title" data-translate-key="step2Title"></h2> <blockquote class="agent-script"><i class="ri-questionnaire-line"></i><span data-translate-key="step2Intro"></span></blockquote> <div class="row g-4 mt-2"> <div class="col-md-6"><label for="info-agency" class="form-label-enhanced"><span class="label-text" data-translate-key="labelAgency"></span><span class="label-description" data-translate-key="descAgency"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-government-line"></i></span><select id="info-agency" class="form-select"><option value="" data-translate-key="selectOption">Seleccione...</option><option data-translate-key="optionIRS">IRS</option><option data-translate-key="optionState">Estado</option><option data-translate-key="optionBoth">Ambos</option></select></div></div> 
                
                <div class="col-md-6">
                    <div id="debt-years-container">
                        <label class="form-label-enhanced">
                            <span class="label-text" data-translate-key="labelDebtYears"></span>
                            <span class="label-description" data-translate-key="descDebtYears"></span>
                        </label>
                        <div id="debt-years-checkboxes" class="d-flex flex-wrap gap-2">
                            <!-- Los checkboxes se generarán con JavaScript -->
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6"><label for="info-recent-notices" class="form-label-enhanced"><span class="label-text" data-translate-key="labelNotices"></span><span class="label-description" data-translate-key="descNotices"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-mail-warning-line"></i></span><select id="info-recent-notices" class="form-select"><option value="" data-translate-key="selectOption">Seleccione...</option><option data-translate-key="optionYes">Sí</option><option data-translate-key="optionNo">No</option></select></div></div> <div class="col-md-6"><label for="info-business" class="form-label-enhanced"><span class="label-text" data-translate-key="labelBusiness"></span><span class="label-description" data-translate-key="descBusiness"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-briefcase-4-line"></i></span><select id="info-business" class="form-select"><option value="" data-translate-key="selectOption">Seleccione...</option><option data-translate-key="optionYes">Sí</option><option data-translate-key="optionNo">No</option></select></div></div> <div class="col-md-6"><label for="info-debt-amount" class="form-label-enhanced"><span class="label-text" data-translate-key="labelDebtAmount"></span><span class="label-description" data-translate-key="descDebtAmount"></span></label><div class="input-group"><span class="input-group-text">$</span><input type="number" class="form-control" id="info-debt-amount" placeholder="50000"></div></div> <div class="col-md-6"><label for="info-income" class="form-label-enhanced"><span class="label-text" data-translate-key="labelIncome"></span><span class="label-description" data-translate-key="descIncome"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-wallet-3-line"></i></span><select id="info-income" class="form-select"><option value="" data-translate-key="selectOption">Seleccione...</option><option data-translate-key="optionYes">Sí</option><option data-translate-key="optionNo">No</option></select></div></div> <div class="col-12"><label for="info-desired-action" class="form-label-enhanced"><span class="label-text" data-translate-key="labelGoal"></span><span class="label-description" data-translate-key="descGoal"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-focus-3-line"></i></span><input type="text" class="form-control" id="info-desired-action" data-translate-key="placeholderGoal"></div></div> </div> </section>
                <section class="script-section" data-step="3"> <h2 class="section-title" data-translate-key="step3Title"></h2> <blockquote class="agent-script"><i class="ri-calculator-line"></i><span data-translate-key="step3Intro"></span></blockquote> <div class="alert alert-primary text-center" id="calc-result" style="display: none; font-size: 1.2rem;"></div> <blockquote class="agent-script"><i class="ri-question-answer-line"></i> <span data-translate-key="step3QuestionPart1"></span> <strong id="calculated-payment-display" class="text-primary fw-bold">$[MONTO]</strong> <span data-translate-key="step3QuestionPart2"></span> </blockquote> <div class="row g-4 mt-2"> <div class="col-md-6"> <label for="info-can-pay" class="form-label-enhanced"><span class="label-text" data-translate-key="labelCanPay"></span></label> <select id="info-can-pay" class="form-select"><option value="" data-translate-key="selectOption">Seleccione...</option><option data-translate-key="optionYes">Sí</option><option data-translate-key="optionNo">No</option></select> </div> <div class="col-md-6"> <label for="info-affordable-payment" class="form-label-enhanced"><span class="label-text" data-translate-key="labelAffordable"></span></label> <div class="input-group"><span class="input-group-text">$</span><input type="number" class="form-control" id="info-affordable-payment" placeholder="300"></div> </div> </div> </section>
                <section class="script-section" data-step="4"> <h2 class="section-title" data-translate-key="step4Title"></h2> <blockquote class="agent-script"><i class="ri-lightbulb-flash-line"></i><span data-translate-key="step4Intro"></span></blockquote> <ul class="list-group list-group-flush mt-3 mb-3"> <li class="list-group-item"><i class="ri-search-eye-line text-primary me-2"></i><span data-translate-key="step4Point1"></span></li> <li class="list-group-item"><i class="ri-file-text-line text-primary me-2"></i><span data-translate-key="step4Point2"></span></li> <li class="list-group-item"><i class="ri-file-copy-2-line text-primary me-2"></i><span data-translate-key="step4Point3"></span></li> <li class="list-group-item"><i class="ri-road-map-line text-primary me-2"></i><span data-translate-key="step4Point4"></span></li> <li class="list-group-item"><i class="ri-shield-user-line text-primary me-2"></i><span data-translate-key="step4Point5"></span></li> </ul> <blockquote class="agent-script"><i class="ri-line-chart-line"></i><span data-translate-key="step4Resolution"></span></blockquote> <div class="info-note"> <i class="ri-information-line"></i><strong data-translate-key="importantNoteTitle"></strong><span data-translate-key="importantNoteText"></span> </div> <div class="info-note" id="business-deduction-note" style="display: none;"> <i class="ri-briefcase-line"></i><strong data-translate-key="businessNoteTitle"></strong><span data-translate-key="businessNoteText"></span> </div> </section>
                <section class="script-section" data-step="5"> <h2 class="section-title" data-translate-key="step5Title"></h2> <blockquote class="agent-script"><i class="ri-file-edit-line"></i><span data-translate-key="step5Intro"></span></blockquote> <div class="row g-4 mt-2"> <div class="col-md-6"><label for="client-name" class="form-label-enhanced"><span class="label-text" data-translate-key="labelFullName"></span><span class="label-description" data-translate-key="descFullName"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-user-line"></i></span><input type="text" class="form-control" id="client-name" data-translate-key="placeholderFullName"></div></div> <div class="col-md-6"><label for="client-email" class="form-label-enhanced"><span class="label-text" data-translate-key="labelEmail"></span><span class="label-description" data-translate-key="descEmail"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-mail-line"></i></span><input type="email" class="form-control" id="client-email" data-translate-key="placeholderEmail"></div></div> <div class="col-12"><label for="client-address" class="form-label-enhanced"><span class="label-text" data-translate-key="labelAddress"></span><span class="label-description" data-translate-key="descAddress"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-map-pin-line"></i></span><input type="text" class="form-control" id="client-address" data-translate-key="placeholderAddress"></div></div> <div class="col-md-6"><label for="client-id" class="form-label-enhanced"><span class="label-text" data-translate-key="labelTaxId"></span><span class="label-description" data-translate-key="descTaxId"></span></label><div class="input-group"><span class="input-group-text"><i class="ri-fingerprint-line"></i></span><input type="text" class="form-control" id="client-id"></div></div> 
                
                <div class="col-12">
                     <label class="form-label-enhanced">
                        <span class="label-text" data-translate-key="labelCard"></span>
                        <span class="label-description" data-translate-key="descCard"></span>
                    </label>
                    <div class="payment-processor-widget">
                        <div class="payment-header">
                            <div class="payment-description" data-translate-key="paymentFor">Cuota de Investigación</div>
                            <div class="input-group">
                                <span class="input-group-text" style="font-size: 1.8rem; font-weight: 700; border: none; background: transparent; padding-right: 0;">$</span>
                                <input type="number" class="form-control payment-amount-input" id="payment-amount-input" value="750" step="1">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="card-holder-name" class="form-label" data-translate-key="labelCardName">Nombre en la Tarjeta</label>
                                <input type="text" class="form-control" id="card-holder-name" data-translate-key="placeholderFullName">
                            </div>
                            <div class="col-12">
                                <label for="card-number-input" class="form-label" data-translate-key="labelCardNumber">Número de Tarjeta</label>
                                 <div class="input-group">
                                    <span class="input-group-text"><i class="ri-bank-card-2-line"></i></span>
                                    <input type="text" class="form-control" id="card-number-input" placeholder="0000 0000 0000 0000" maxlength="19">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="card-expiry" class="form-label" data-translate-key="labelCardExpiry">Expiración (MM/AA)</label>
                                 <div class="input-group">
                                     <span class="input-group-text"><i class="ri-calendar-line"></i></span>
                                    <input type="text" class="form-control" id="card-expiry" placeholder="MM/AA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="card-cvc" class="form-label" data-translate-key="labelCardCVC">CVC</label>
                                <div class="input-group">
                                     <span class="input-group-text"><i class="ri-lock-password-line"></i></span>
                                    <input type="text" class="form-control" id="card-cvc" placeholder="123">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="save-card-info">
                                  <label class="form-check-label" for="save-card-info" data-translate-key="labelSaveCard">
                                    Guardar datos
                                  </label>
                                </div>
                                <button type="button" class="btn btn-primary" id="make-payment-btn">
                                    <i class="ri-secure-payment-line me-1"></i> <span data-translate-key="btnMakePayment"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                </div> <blockquote class="agent-script mt-4"><i class="ri-send-plane-line"></i><span data-translate-key="step5Closing"></span></blockquote> </section>
                <section class="script-section" data-step="6"> <h2 class="section-title" data-translate-key="step6Title"></h2> <blockquote class="agent-script"><i class="ri-psychotherapy-line"></i><span data-translate-key="step6Intro"></span></blockquote> <div class="decision-buttons"> <button class="btn btn-success"><i class="ri-phone-find-line me-2"></i><span data-translate-key="btnConnectEA"></span></button> <button class="btn btn-secondary"><i class="ri-calendar-schedule-line me-2"></i><span data-translate-key="btnScheduleCall"></span></button> </div> </section>
                <section class="script-section" data-step="7"> <a href="#agentResourcesCollapse" data-bs-toggle="collapse" class="section-title collapsible-title" aria-expanded="false" aria-controls="agentResourcesCollapse"> <span data-translate-key="agentResourcesTitle"></span> <i class="ri-arrow-down-s-line fs-4"></i> </a> <div class="collapse" id="agentResourcesCollapse"> <div class="card mt-3 mb-3"> <div class="card-header fw-bold" data-translate-key="example1Title"></div> <div class="card-body"> <p class="card-text small" data-translate-key="example1Text"></p> </div> </div> <div class="card"> <div class="card-header fw-bold" data-translate-key="example2Title"></div> <div class="card-body"> <p class="card-text small"> <strong data-translate-key="caseLabel"></strong> <span data-translate-key="caseText"></span><br> <strong data-translate-key="calculationLabel"></strong> <code>$20,000 / 72 = $277.77</code><br> <strong data-translate-key="paymentLabel"></strong> <span data-translate-key="paymentText"></span><br> <strong data-translate-key="costLabel"></strong> <span data-translate-key="costText"></span> </p> </div> </div> </div> </section>
                <section class="script-section" data-step="8"> <h2 class="section-title" data-translate-key="step8Title"></h2> <div class="row g-4 mt-2"> <div class="col-12"> <label for="final-notes" class="form-label-enhanced"><span class="label-text" data-translate-key="labelNotes"></span></label> <textarea id="final-notes" class="form-control" rows="3" data-translate-key="placeholderNotes"></textarea> </div> <div class="col-md-6"> <label for="lead-status" class="form-label-enhanced"><span class="label-text" data-translate-key="labelLeadStatus"></span></label> <select id="lead-status" class="form-select"> <option value="new" data-translate-key="statusNew"></option> <option value="qualified" data-translate-key="statusQualified"></option> <option value="appointment_set" data-translate-key="statusAppointment"></option> <option value="closed_won" data-translate-key="statusWon"></option> <option value="closed_lost" data-translate-key="statusLost"></option> </select> </div> <div class="col-md-6"> <label class="form-label-enhanced"><span class="label-text" data-translate-key="labelRating"></span></label> <div id="star-rating" class="star-rating-widget" data-rating="0"> <i class="ri-star-line star" data-value="1"></i><i class="ri-star-line star" data-value="2"></i><i class="ri-star-line star" data-value="3"></i><i class="ri-star-line star" data-value="4"></i><i class="ri-star-line star" data-value="5"></i> </div> </div> </div> </section>
                
                <section class="script-section" data-step="9">
                    <h2 class="section-title" data-translate-key="step9Title"></h2>
                    <p class="section-description" data-translate-key="step9Desc"></p>
                    <button class="btn btn-primary btn-lg w-100" id="finalize-call-btn">
                        <i class="ri-file-code-line me-2"></i><span data-translate-key="btnGenerateJSON"></span>
                    </button>
                    <div id="json-output-container" style="display: none; margin-top: 1rem;">
                        <h5 data-translate-key="jsonOutputLabel"></h5>
                        <pre><code id="json-output" class="language-json" style="border-radius: var(--bs-border-radius); background-color: var(--json-output-bg);"></code></pre>
                    </div>
                </section>
            </div>
        </div>

        <div id="floating-timers-container">
            <div id="call-timer-widget" class="minimal-timer"><i class="ri-phone-line timer-icon"></i><span id="call-timer-display" class="timer-display">00:00</span><div class="timer-controls"><button id="call-timer-start-pause" class="btn btn-success btn-sm btn-timer-control"><i class="ri-play-fill"></i></button><button id="call-timer-reset" class="btn btn-outline-secondary btn-sm btn-timer-control"><i class="ri-refresh-line"></i></button></div></div>
            <div id="hold-timer-widget" class="minimal-timer"><i class="ri-pause-circle-line timer-icon"></i><span id="hold-timer-display" class="timer-display">00:00</span><div class="timer-controls"><button id="hold-timer-start-pause" class="btn btn-warning btn-sm btn-timer-control"><i class="ri-play-fill"></i></button><button id="hold-timer-reset" class="btn btn-outline-secondary btn-sm btn-timer-control"><i class="ri-refresh-line"></i></button></div></div>
        </div>

        <div class="modal fade" id="summary-modal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="summaryModalLabel" data-translate-key="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="client-profile-card">
                            <div id="modal-client-data" class="profile-section">
                                <h5 data-translate-key="step5Title"></h5>
                            </div>
                             <div id="modal-intake-info" class="profile-section">
                                <h5 data-translate-key="step2Title"></h5>
                            </div>
                            <div id="modal-financial-analysis" class="profile-section">
                                <h5 data-translate-key="step3Title"></h5>
                            </div>
                            <div class="profile-section">
                                <h5 data-translate-key="step8Title"></h5>
                                <div class="mb-3">
                                   <label for="modal-final-notes" class="form-label-enhanced"><span data-translate-key="labelNotes"></span></label>
                                   <textarea id="modal-final-notes" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="modal-lead-status" class="form-label-enhanced"><span data-translate-key="labelLeadStatus"></span></label>
                                        <select id="modal-lead-status" class="form-select"></select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-enhanced"><span data-translate-key="labelRating"></span></label>
                                        <div id="modal-star-rating" class="star-rating-widget fs-2" data-rating="0">
                                            <i class="ri-star-line star" data-value="1"></i><i class="ri-star-line star" data-value="2"></i><i class="ri-star-line star" data-value="3"></i><i class="ri-star-line star" data-value="4"></i><i class="ri-star-line star" data-value="5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODIFICACIÓN: Modal footer con el nuevo botón de exportación -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-translate-key="btnCancel"></button>
                        <button type="button" class="btn btn-success" id="export-csv-btn">
                            <i class="ri-file-excel-2-line me-1"></i> <span data-translate-key="btnExportCSV"></span>
                        </button>
                        <button type="button" class="btn btn-primary" id="modal-continue-btn"><i class="ri-check-double-line me-1"></i> <span data-translate-key="btnContinue"></span></button>
                    </div>
                </div>
            </div>
        </div>

    
    <script>
    window.initializeCallScript = function() {
        if (window.isCallScriptInitialized) return;
        window.isCallScriptInitialized = true;

        const scriptContainer = document.getElementById('call-script-container');
        if (!scriptContainer) return;

        const currentUserName = @json($userName ?? 'Agent');
        const currentCompanyName = @json($companyName ?? 'Our Company');

        const translations = {
            scriptTitle: { es: "Guion: Intake Inicial de Cliente", en: "Script: Incoming Client Call" },
            step1Title: { es: "Paso 1: Saludo e Introducción", en: "Step 1: Greeting & Introduction" },
            step1Greeting: { 
                es: '"Hola, gracias por llamar a ' + currentCompanyName + '. Habla ' + currentUserName + ', ¿en qué le puedo ayudar hoy?"', 
                en: '"Hi, thank you for calling ' + currentCompanyName + ' — this is ' + currentUserName + '. How can I help you today?"' 
            },
            step2Title: { es: "Paso 2: Recopilación de Información", en: "Step 2: Information Gathering" },
            step2Intro: { es: '"Perfecto, para entender mejor su situación, le haré unas preguntas rápidas:"', en: '"To make sure we point you in the right direction, can I ask a few quick questions?"' },
            labelAgency: { es: "Agencia del problema", en: "Problem Agency" },
            descAgency: { es: "¿El problema es con el IRS, el estado, o los dos?", en: "Are you dealing with the IRS, state, or both?" },
            selectOption: { es: "Seleccione...", en: "Select..." },
            optionIRS: { es: "IRS", en: "IRS" },
            optionState: { es: "Estado", en: "State" },
            optionBoth: { es: "Ambos", en: "Both" },
            labelDebtYears: { es: "Años de la deuda", en: "Debt Years" },
            descDebtYears: { es: "¿Sabe de qué años es la deuda?", en: "Do you know which tax years this involves?" },
            placeholderDebtYears: { es: "Ej: 2020, 2021", en: "Ex: 2020, 2021" },
            labelNotices: { es: "Notificaciones recientes", en: "Recent Notices" },
            descNotices: { es: "¿Ha recibido cartas o notificaciones de embargos?", en: "Have you received any recent letters or notices?" },
            optionYes: { es: "Sí", en: "Yes" },
            optionNo: { es: "No", en: "No" },
            labelBusiness: { es: "¿Tiene negocio?", en: "Own a Business?" },
            descBusiness: { es: "Preguntar si es propietario de un negocio.", en: "Ask if they are a business owner." },
            labelDebtAmount: { es: "Monto de la deuda (Aprox.)", en: "Approximate Debt Amount" },
            descDebtAmount: { es: "¿Aproximadamente cuánto debe?", en: "Approximately how much do you owe?" },
            labelIncome: { es: "¿Tiene ingresos?", en: "Currently have income?" },
            descIncome: { es: "¿Está trabajando o recibiendo ingresos?", en: "Are you currently working or receiving income?" },
            labelGoal: { es: "Objetivo del cliente", en: "Client's Goal" },
            descGoal: { es: "Perfecto, ¿y usted qué quiere hacer?", en: "Perfect, and what would you like to do?" },
            placeholderGoal: { es: "Ej: Pagarla, reducirla, entender mis opciones", en: "Ex: Pay it off, reduce it, understand my options" },
            step3Title: { es: "Paso 3: Análisis Financiero", en: "Step 3: Financial Analysis" },
            step3Intro: { es: '"Bueno, normalmente el IRS quiere su pago en 72 meses. Basado en su deuda, eso sería..."', en: '"Okay, typically the IRS wants the payment over 72 months. Based on your debt, that would be..."' },
            calcResultText: { es: 'Pago mensual estándar (72 meses): {amount}', en: 'Standard monthly payment (72 months): {amount}' },
            step3QuestionPart1: { es: '¿Usted podría pagar los ', en: 'Would you be able to pay the ' },
            step3QuestionPart2: { es: ' mensuales?', en: ' monthly?' },
            labelCanPay: { es: "¿Puede pagar el monto?", en: "Can pay the amount?" },
            labelAffordable: { es: "Si no, ¿cuánto puede pagar?", en: "If not, what can you afford?" },
            step4Title: { es: "Paso 4: Explicando Nuestro Proceso", en: "Step 4: Explaining Our Process" },
            step4Intro: { es: '"Aquí es cómo le podemos ayudar. Comenzamos con una Fase de Investigación de $750, en la cual:"', en: '"Here’s how we help. We begin with a $750 Investigation Phase, where we:"' },
            step4Point1: { es: "Vemos la urgencia y si el IRS está siendo agresivo.", en: "We assess the urgency and if the IRS is being aggressive." },
            step4Point2: { es: "Solicitamos sus registros y transcritos del IRS para ver la deuda real y declaraciones pendientes.", en: "Pull your IRS records and transcripts to see the real debt and pending returns." },
            step4Point3: { es: "Recreamos 1099s o W-2s reportados a su SSN/ITIN/EIN si es necesario.", en: "Recreate any reported 1099s or W-2s linked to your SSN/ITIN/EIN if needed." },
            step4Point4: { es: "Diseñamos un plan de juego a su medida para saldar la deuda.", en: "Build a custom game plan tailored to resolve your situation." },
            step4Point5: { es: "Y nos encargamos de TODA la comunicación con el IRS.", en: "And take over ALL communication with the IRS." },
            step4Resolution: { es: '"Después de eso, le explicamos cuál es la mejor estrategia de resolución, como un Plan de Pagos, una Oferta de Compromiso (OIC), o declararlo en estado de insolvencia."', en: '"After that, we’ll walk you through the best resolution strategy — like a Payment Plan, Offer in Compromise (OIC), or Currently Not Collectible status."' },
            importantNoteTitle: { es: "Nota Importante: ", en: "Important Note: " },
            importantNoteText: { es: "Los $750 se acreditan al costo total del caso si decide seguir con nosotros, no es un costo extra.", en: "The $750 is credited toward the total resolution fee if you decide to move forward with us, so it’s not an extra cost." },
            businessNoteTitle: { es: "Para Negocios: ", en: "For Businesses: " },
            businessNoteText: { es: "Si tiene negocio, esta cuota es deducible de impuestos, lo cual le ayuda a reducir lo que paga en impuestos este año.", en: "If you have a business, this fee is tax-deductible, which helps reduce your tax bill this year." },
            step5Title: { es: "Paso 5: Datos del Cliente", en: "Step 5: Client Data" },
            step5Intro: { es: '"Perfecto. Para comenzar, vamos a enviarle los formularios de autorización (8821 y 2848) para poder representarlo. ¿Me puede confirmar su información?"', en: '"Great. To start, we will send you the authorization forms (8821 & 2848) so we can represent you. Can you confirm your information?"' },
            labelFullName: { es: "Nombre completo", en: "Full Name" },
            descFullName: { es: "Como aparece en su última declaración de impuestos.", en: "As it appears on your last tax return." },
            placeholderFullName: { es: "Nombre Apellido", en: "First Last Name" },
            labelEmail: { es: "Correo electrónico", en: "Email Address" },
            descEmail: { es: "Para enviar los formularios de autorización.", en: "To send the authorization forms." },
            placeholderEmail: { es: "ejemplo@correo.com", en: "example@email.com" },
            labelAddress: { es: "Dirección", en: "Address" },
            descAddress: { es: "Como aparece en su última declaración de impuestos.", en: "As it appears on your last tax return." },
            placeholderAddress: { es: "Calle, Ciudad, Estado, CP", en: "Street, City, State, ZIP" },
            labelTaxId: { es: "SSN / ITIN / EIN", en: "SSN / ITIN / EIN" },
            descTaxId: { es: "Número de identificación fiscal.", en: "Tax identification number." },
            labelCard: { es: "Tarjeta para la cuota inicial", en: "Card for Initial Fee" },
            descCard: { es: "¿Qué tarjeta quiere usar para el pago?", en: "Which card would you like to use for the payment?" },
            paymentFor: { es: "Cuota de Investigación", en: "Investigation Fee" },
            labelCardName: { es: "Nombre en la Tarjeta", en: "Name on Card" },
            labelCardNumber: { es: "Número de Tarjeta", en: "Card Number" },
            labelCardExpiry: { es: "Expiración (MM/AA)", en: "Expiration (MM/YY)" },
            labelCardCVC: { es: "CVC", en: "CVC" },
            labelSaveCard: { es: "Guardar datos", en: "Save data" },
            btnMakePayment: { es: "Realizar Pago", en: "Make Payment" },
            paymentSuccess: { es: "Pago Realizado ✓", en: "Payment Made ✓" },
            step5Closing: { es: '"Recibirá un correo para firmar los formularios. Asegúrese de dibujar su firma donde se indica. Por favor, envíenos también cualquier carta reciente del IRS que tenga."', en: '"You will receive an email to sign the forms. Please be sure to draw your signature where indicated. Also, please send us any recent IRS letters you may have."' },
            step6Title: { es: "Paso 6: Manejo de Dudas", en: "Step 6: Handling Hesitation" },
            step6Intro: { es: '"Entiendo completamente si quiere pensarlo, pero antes de colgar, ¿le ayudaría si le conecto ahora mismo con uno de nuestros Agentes Autorizados (EA)? Son expertos y pueden responder cualquier duda."', en: '"I totally understand if you want to think about it — but before you go, would it help if I connected you with one of our licensed Enrolled Agents (EA) right now? They’re experts and can answer any questions."' },
            btnConnectEA: { es: "Sí, conectar con un EA", en: "Yes, connect with an EA" },
            btnScheduleCall: { es: "No, pero agendar llamada", en: "No, but schedule a call" },
            agentResourcesTitle: { es: "Recursos y Ejemplos para el Agente", en: "Agent Resources & Examples" },
            example1Title: { es: "Ejemplo: Estado de Insolvencia", en: "Example: Currently Not Collectible Status" },
            example1Text: { es: 'Si un cliente gana $3000/mes y sus gastos son $2900-$3200, su pago mensual al IRS sería entre $100 y $0 (insolvencia). La deuda sigue acumulando interés, pero el IRS no es agresivo.', en: 'If a client earns $3000/mo and their expenses are $2900-$3200, their IRS monthly payment would be between $100 and $0 (uncollectible). The debt still accrues interest, but the IRS is not aggressive.' },
            example2Title: { es: "Ejemplo: Cálculo Rápido", en: "Example: Quick Calculation" },
            caseLabel: { es: "Caso:", en: "Case:" },
            caseText: { es: "Deuda de $20,000, 3 años sin declarar.", en: "Debt of $20,000, 3 unfiled years." },
            calculationLabel: { es: "Cálculo:", en: "Calculation:" },
            paymentLabel: { es: "Pago Mensual Propuesto:", en: "Proposed Monthly Payment:" },
            paymentText: { es: "Entre $250 - $350", en: "Between $250 - $350" },
            costLabel: { es: "Costo del Servicio (aprox):", en: "Service Cost (approx):" },
            costText: { es: "Entre $3000 - $4500, o comenzar con $750 de investigación.", en: "Between $3000 - $4500, or start with the $750 investigation." },
            step8Title: { es: "Paso 8: Finalización y Notas", en: "Step 8: Finalization & Notes" },
            labelNotes: { es: "Notas Adicionales", en: "Additional Notes" },
            placeholderNotes: { es: "Añadir cualquier detalle importante de la conversación...", en: "Add any important details from the conversation..." },
            labelLeadStatus: { es: "Estado del Prospecto", en: "Lead Status" },
            statusNew: { es: "Nuevo", en: "New" },
            statusQualified: { es: "Calificado", en: "Qualified" },
            statusAppointment: { es: "Cita Agendada", en: "Appointment Set" },
            statusWon: { es: "Cerrado - Ganado", en: "Closed - Won" },
            statusLost: { es: "Cerrado - Perdido", en: "Closed - Lost" },
            labelRating: { es: "Calificación de la Llamada", en: "Call Rating" },
            step9Title: { es: "Paso 9: Finalizar Llamada", en: "Step 9: End Call" },
            step9Desc: { es: "Al completar todos los pasos, haz clic para generar el resumen y finalizar la llamada.", en: "Once all steps are complete, click to generate the summary and end the call." },
            btnGenerateJSON: { es: "Generar Resumen y Finalizar", en: "Generate Summary & Finalize" },
            btnEndCall: { es: "Terminar Llamada", en: "End Call" },
            jsonOutputLabel: { es: "Resumen Final (JSON):", en: "Final Summary (JSON):" },
            modalTitle: { es: "Resumen de la Llamada", en: "Call Summary" },
            btnCancel: { es: "Cancelar", en: "Cancel" },
            btnContinue: { es: "Continuar", en: "Continue" },
            // MODIFICACIÓN: Añadida la traducción para el nuevo botón
            btnExportCSV: { es: "Exportar a Tabla", en: "Export to Table" },
            successTitle: { es: "Llamada Finalizada con Éxito", en: "Call Ended Successfully" },
            successMessage: { es: "El resumen de la llamada ha sido guardado.", en: "The call summary has been saved." },
            btnNewCall: { es: "Comenzar Nueva Llamada", en: "Start New Call" }
        };
        
        const UIElements = {
            mainContainer: document.getElementById('call-script-container'),
            successScreen: document.getElementById('success-screen'),
            contentWrapper: scriptContainer.querySelector('#script-content-wrapper'),
            progressBar: scriptContainer.querySelector('#script-progress-bar'),
            sections: Array.from(scriptContainer.querySelectorAll('.script-section[data-step]')),
            finalizeBtn: scriptContainer.querySelector('#finalize-call-btn'),
            startNewCallBtn: document.getElementById('start-new-call-btn'),
            summaryModalEl: document.getElementById('summary-modal'),
            modalContinueBtn: document.getElementById('modal-continue-btn'),
            // MODIFICACIÓN: Referencia al nuevo botón de exportación
            exportCsvBtn: document.getElementById('export-csv-btn'),
            debtYearsCheckboxes: document.getElementById('debt-years-checkboxes'),
            formElements: Array.from(scriptContainer.querySelectorAll('input, select, textarea')),
            callTimerResetBtn: document.getElementById('call-timer-reset'),
            holdTimerResetBtn: document.getElementById('hold-timer-reset'),
            makePaymentBtn: document.getElementById('make-payment-btn'),
            paymentAmountInput: document.getElementById('payment-amount-input')
        };
        
        let summaryModalInstance = null;
        const totalSteps = UIElements.sections.length;
        let currentLang = '';

        const updateProgressOnScroll = () => {
            let currentSection = UIElements.sections[0];
            const wrapperRect = UIElements.contentWrapper.getBoundingClientRect();
            
            for (const section of UIElements.sections) {
                const sectionRect = section.getBoundingClientRect();
                if (sectionRect.top < wrapperRect.top + (wrapperRect.height / 3)) {
                    currentSection = section;
                } else {
                    break;
                }
            }
            
            const currentStep = parseInt(currentSection.dataset.step);
            const percentage = ((currentStep - 1) / totalSteps) * 100;
            
            if (UIElements.progressBar && !UIElements.progressBar.classList.contains('completed')) {
                 UIElements.progressBar.style.width = `${percentage}%`;
            }
        };
        
        const switchLanguage = (lang) => {
            if (currentLang === lang || !['es', 'en'].includes(lang)) return;
            currentLang = lang;
            document.documentElement.lang = lang;
            document.querySelectorAll('[data-translate-key]').forEach(el => {
                const key = el.dataset.translateKey;
                const text = translations[key]?.[currentLang];
                if (text !== undefined) {
                    if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') { el.placeholder = text; } 
                    else { 
                        const icon = el.querySelector('i');
                        if (icon && el.childNodes.length > 1) { // Asegura no sobreescribir botones que solo tienen icono
                            el.innerHTML = icon.outerHTML + " " + text;
                        } else {
                            el.innerHTML = text;
                        }
                    }
                }
            });
            updateCalculation();
            scriptContainer.querySelector('#lang-btn-es').classList.toggle('active', lang === 'es');
            scriptContainer.querySelector('#lang-btn-en').classList.toggle('active', lang === 'en');
            populateSelectOptions(document.getElementById('modal-lead-status'), 'status');
        };

        const populateSelectOptions = (selectElement, prefix) => {
            const selectedValue = selectElement.value;
            selectElement.innerHTML = '';
            Object.keys(translations).forEach(key => {
                if (key.startsWith(prefix)) {
                    const option = document.createElement('option');
                    option.value = key.replace(prefix, '').toLowerCase();
                    option.textContent = translations[key][currentLang];
                    selectElement.appendChild(option);
                }
            });
            selectElement.value = selectedValue;
        };

        const setupStarRating = (widget) => {
            if (!widget) return;
            const stars = widget.querySelectorAll('.star');
            const setRating = (value) => {
                const ratingValue = parseInt(value) || 0;
                widget.dataset.rating = ratingValue;
                stars.forEach(star => {
                    const starValue = parseInt(star.dataset.value);
                    star.classList.toggle('filled', starValue <= ratingValue);
                    star.classList.toggle('ri-star-fill', starValue <= ratingValue);
                    star.classList.toggle('ri-star-line', starValue > ratingValue);
                });
            };
            stars.forEach(star => {
                star.addEventListener('click', () => setRating(star.dataset.value));
            });
            widget.setRating = setRating;
        };
        
        const collectFormData = () => {
            const debtAmount = parseFloat(document.getElementById('info-debt-amount').value) || 0;
            const calculatedMonthlyPayment = debtAmount > 0 ? (debtAmount / 72) : 0;
            const selectedDebtYears = Array.from(UIElements.debtYearsCheckboxes.querySelectorAll('input:checked')).map(cb => cb.value).join(', ');
            
            return {
                intakeInfo: { agency: document.getElementById('info-agency').value, debtYears: selectedDebtYears, recentNotices: document.getElementById('info-recent-notices').value, hasBusiness: document.getElementById('info-business').value, debtAmount: debtAmount, hasIncome: document.getElementById('info-income').value, clientGoal: document.getElementById('info-desired-action').value, },
                financialAnalysis: { calculatedMonthlyPayment: parseFloat(calculatedMonthlyPayment.toFixed(2)), canPayStandard: document.getElementById('info-can-pay').value, affordablePayment: parseFloat(document.getElementById('info-affordable-payment').value) || 0, },
                clientData: { 
                    fullName: document.getElementById('client-name').value,
                    email: document.getElementById('client-email').value,
                    address: document.getElementById('client-address').value,
                    taxId: document.getElementById('client-id').value, 
                    paymentDetails: {
                        amount: parseFloat(UIElements.paymentAmountInput.value) || 0,
                        cardHolder: document.getElementById('card-holder-name').value,
                        cardNumberLast4: document.getElementById('card-number-input').value.replace(/ /g, '').slice(-4),
                        cardExpiry: document.getElementById('card-expiry').value,
                        saveCard: document.getElementById('save-card-info').checked,
                        paymentMade: UIElements.makePaymentBtn.disabled
                    }
                },
                finalization: { notes: document.getElementById('final-notes').value, leadStatus: document.getElementById('lead-status').value, rating: parseInt(document.getElementById('star-rating').dataset.rating) || 0, },
                callTimers: { callDuration: document.getElementById('call-timer-display').textContent, holdDuration: document.getElementById('hold-timer-display').textContent, },
                timestamp: new Date().toISOString()
            };
        };
        
        // MODIFICACIÓN: Nueva función para exportar los datos a CSV
        const exportToCSV = () => {
            const data = collectFormData();
            
            const fields = [
                { headerKey: 'labelFullName', path: 'clientData.fullName' },
                { headerKey: 'labelEmail', path: 'clientData.email' },
                { headerKey: 'labelAddress', path: 'clientData.address' },
                { headerKey: 'labelTaxId', path: 'clientData.taxId' },
                { headerKey: 'labelAgency', path: 'intakeInfo.agency' },
                { headerKey: 'labelDebtYears', path: 'intakeInfo.debtYears' },
                { headerKey: 'labelDebtAmount', path: 'intakeInfo.debtAmount' },
                { headerKey: 'labelNotices', path: 'intakeInfo.recentNotices' },
                { headerKey: 'labelBusiness', path: 'intakeInfo.hasBusiness' },
                { headerKey: 'labelIncome', path: 'intakeInfo.hasIncome' },
                { headerKey: 'labelCanPay', path: 'financialAnalysis.canPayStandard' },
                { headerKey: 'labelAffordable', path: 'financialAnalysis.affordablePayment' },
                { headerKey: 'labelLeadStatus', path: 'finalization.leadStatus' },
                { headerKey: 'labelRating', path: 'finalization.rating' },
                { headerKey: 'labelNotes', path: 'finalization.notes' },
                { headerKey: 'Timestamp', path: 'timestamp' },
                { headerKey: 'Call Duration', path: 'callTimers.callDuration' },
                { headerKey: 'Hold Duration', path: 'callTimers.holdDuration' }
            ];
            
            const getNestedValue = (obj, path) => path.split('.').reduce((o, k) => (o && o[k] !== undefined) ? o[k] : '', obj);
            
            const escapeCSV = (str) => {
                if (str === null || str === undefined) return '';
                let result = String(str).replace(/"/g, '""');
                if (/[",\n\r]/.test(result)) {
                    result = `"${result}"`;
                }
                return result;
            };

            const headerRow = fields.map(f => {
                const headerText = translations[f.headerKey]?.[currentLang] || f.headerKey;
                return escapeCSV(headerText);
            }).join(',');

            const dataRow = fields.map(f => {
                const value = getNestedValue(data, f.path);
                return escapeCSV(value);
            }).join(',');
            
            const csvContent = [headerRow, dataRow].join('\r\n');
            const blob = new Blob([new Uint8Array([0xEF, 0xBB, 0xBF]), csvContent], { type: 'text/csv;charset=utf-8;' });

            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            const clientName = (data.clientData.fullName || 'cliente').replace(/[\s/\\?%*:|"<>]/g, '_');
            const date = new Date().toISOString().slice(0, 10);
            link.setAttribute("download", `resumen_llamada_${clientName}_${date}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        const populateSummaryModal = (data) => {
            document.querySelectorAll('#summary-modal .profile-item').forEach(item => item.remove());

            const createProfileItem = (labelKey, value) => {
                if (!value && value !== 0 && typeof value !== 'boolean') return '';
                const label = translations[labelKey] ? translations[labelKey][currentLang] : labelKey;
                let displayValue = value;
                if (typeof value === 'boolean') {
                    displayValue = value ? translations.optionYes[currentLang] : translations.optionNo[currentLang];
                }
                return `<div class="profile-item"><span class="label">${label}</span><span class="value">${displayValue}</span></div>`;
            };
            
            const paymentSummary = data.clientData.paymentDetails.paymentMade 
                ? `$${data.clientData.paymentDetails.amount} (**** ${data.clientData.paymentDetails.cardNumberLast4})` 
                : 'N/A';

            const clientDataHtml = createProfileItem('labelFullName', data.clientData.fullName) + createProfileItem('labelEmail', data.clientData.email) + createProfileItem('labelAddress', data.clientData.address) + createProfileItem('labelTaxId', data.clientData.taxId) + createProfileItem('btnMakePayment', paymentSummary);
            document.getElementById('modal-client-data').insertAdjacentHTML('beforeend', clientDataHtml);

            const intakeInfoHtml = createProfileItem('labelAgency', data.intakeInfo.agency) + createProfileItem('labelDebtYears', data.intakeInfo.debtYears) + createProfileItem('labelNotices', data.intakeInfo.recentNotices) + createProfileItem('labelBusiness', data.intakeInfo.hasBusiness) + createProfileItem('labelDebtAmount', `$${data.intakeInfo.debtAmount.toLocaleString()}`) + createProfileItem('labelIncome', data.intakeInfo.hasIncome) + createProfileItem('labelGoal', data.intakeInfo.clientGoal);
            document.getElementById('modal-intake-info').insertAdjacentHTML('beforeend', intakeInfoHtml);

            const financialHtml = createProfileItem('calcResultText', `$${data.financialAnalysis.calculatedMonthlyPayment.toLocaleString()}`) + createProfileItem('labelCanPay', data.financialAnalysis.canPayStandard) + createProfileItem('labelAffordable', `$${data.financialAnalysis.affordablePayment.toLocaleString()}`);
            document.getElementById('modal-financial-analysis').insertAdjacentHTML('beforeend', financialHtml);

            document.getElementById('modal-final-notes').value = data.finalization.notes;
            const modalLeadStatus = document.getElementById('modal-lead-status');
            populateSelectOptions(modalLeadStatus, 'status');
            modalLeadStatus.value = data.finalization.leadStatus;

            const modalStarRating = document.getElementById('modal-star-rating');
            setupStarRating(modalStarRating);
            modalStarRating.setRating(data.finalization.rating);
        };

        const finalizeCall = () => {
            const formData = collectFormData();
            populateSummaryModal(formData);
            
            if (!summaryModalInstance) {
                summaryModalInstance = new bootstrap.Modal(UIElements.summaryModalEl);
            }
            summaryModalInstance.show();
        };
        
        const handleContinueFromModal = () => {
            document.getElementById('final-notes').value = document.getElementById('modal-final-notes').value;
            document.getElementById('lead-status').value = document.getElementById('modal-lead-status').value;
            const newRating = document.getElementById('modal-star-rating').dataset.rating;
            document.getElementById('star-rating').setRating(newRating);

            const finalData = collectFormData();
            const jsonOutput = document.getElementById('json-output');
            jsonOutput.textContent = JSON.stringify(finalData, null, 2);
            if (typeof hljs !== 'undefined') { hljs.highlightElement(jsonOutput); }
            
            UIElements.progressBar.style.width = '100%';
            UIElements.progressBar.classList.add('completed');
            
            summaryModalInstance.hide();
            
            UIElements.mainContainer.style.display = 'none';
            UIElements.successScreen.style.display = 'flex';
        };

        const resetScript = () => {
            UIElements.formElements.forEach(el => {
                if (el.type === 'checkbox' || el.type === 'radio') {
                    el.checked = false;
                } else if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else {
                    el.value = '';
                }
            });

            document.getElementById('star-rating').setRating(0);
            UIElements.progressBar.style.width = '0%';
            UIElements.progressBar.classList.remove('completed');
            document.getElementById('calc-result').style.display = 'none';
            document.getElementById('json-output-container').style.display = 'none';
            document.getElementById('business-deduction-note').style.display = 'none';
            
            UIElements.callTimerResetBtn.click();
            UIElements.holdTimerResetBtn.click();

            UIElements.finalizeBtn.disabled = false;
            
            UIElements.paymentAmountInput.value = '750';
            UIElements.makePaymentBtn.disabled = false;
            UIElements.makePaymentBtn.classList.remove('btn-success');
            UIElements.makePaymentBtn.classList.add('btn-primary');
            const paymentBtnSpan = UIElements.makePaymentBtn.querySelector('span');
            if (paymentBtnSpan) paymentBtnSpan.textContent = translations.btnMakePayment[currentLang];

            UIElements.successScreen.style.display = 'none';
            UIElements.mainContainer.style.display = 'flex';
            updateProgressOnScroll();
            window.scrollTo(0, 0);
            UIElements.contentWrapper.scrollTop = 0;
        };

        const generateDebtYearCheckboxes = () => {
            const currentYear = new Date().getFullYear();
            UIElements.debtYearsCheckboxes.innerHTML = '';
            for (let i = 0; i < 10; i++) {
                const year = currentYear - i;
                const checkboxId = `year-${year}`;
                const checkboxHTML = `
                    <input type="checkbox" class="btn-check" id="${checkboxId}" value="${year}" autocomplete="off">
                    <label class="btn btn-sm btn-outline-secondary" for="${checkboxId}">${year}</label>
                `;
                UIElements.debtYearsCheckboxes.insertAdjacentHTML('beforeend', checkboxHTML);
            }
        };
        
        const setupPaymentForm = () => {
            const cardNumberInput = document.getElementById('card-number-input');
            const cardExpiryInput = document.getElementById('card-expiry');
            const cardCvcInput = document.getElementById('card-cvc');

            cardNumberInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
            });

            cardExpiryInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/[^\d/]/g, '');
                if (value.length > 2 && value.charAt(2) !== '/') {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                if (value.length > 5) {
                    value = value.slice(0, 5);
                }
                e.target.value = value;
            });

            cardCvcInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
            });
        };
        
        const handleMakePayment = () => {
            UIElements.makePaymentBtn.disabled = true;
            UIElements.makePaymentBtn.classList.remove('btn-primary');
            UIElements.makePaymentBtn.classList.add('btn-success');
            const span = UIElements.makePaymentBtn.querySelector('span');
            if(span) span.textContent = translations.paymentSuccess[currentLang];
        };

        const updateCalculation = () => {
            const debtInput = scriptContainer.querySelector('#info-debt-amount');
            const resultDiv = scriptContainer.querySelector('#calc-result');
            const paymentDisplay = scriptContainer.querySelector('#calculated-payment-display');
            if (!debtInput || !resultDiv || !paymentDisplay) return;
            const debtAmount = parseFloat(debtInput.value);
            if (isNaN(debtAmount) || debtAmount <= 0) { resultDiv.style.display = 'none'; paymentDisplay.textContent = "$[MONTO]"; return; }
            const monthlyPayment = (debtAmount / 72).toFixed(2);
            const currencyFormatter = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' });
            const textTemplate = translations.calcResultText[currentLang] || '';
            const resultText = textTemplate.replace('{amount}', `<strong class="text-dark">${currencyFormatter.format(monthlyPayment)}</strong>`);
            resultDiv.innerHTML = resultText; resultDiv.style.display = 'block'; paymentDisplay.textContent = currencyFormatter.format(monthlyPayment);
        };

        const setupTimer = (timerId) => {
            const display = document.getElementById(`${timerId}-display`);
            const startPauseBtn = document.getElementById(`${timerId}-start-pause`);
            if (!display || !startPauseBtn) return;
            const resetBtn = document.getElementById(`${timerId}-reset`);
            const startPauseIcon = startPauseBtn.querySelector('i');
            let seconds = 0, interval = null, isRunning = false;
            const formatTime = (sec) => `${Math.floor(sec / 60).toString().padStart(2, '0')}:${(sec % 60).toString().padStart(2, '0')}`;
            const start = () => { if (!isRunning) { isRunning = true; startPauseIcon.className = 'ri-pause-fill'; interval = setInterval(() => display.textContent = formatTime(++seconds), 1000); } };
            const pause = () => { if (isRunning) { isRunning = false; startPauseIcon.className = 'ri-play-fill'; clearInterval(interval); } };
            const reset = () => { pause(); seconds = 0; display.textContent = formatTime(seconds); };
            startPauseBtn.addEventListener('click', () => isRunning ? pause() : start());
            resetBtn.addEventListener('click', reset);
        };

        // --- Asignación de Eventos ---
        UIElements.contentWrapper.addEventListener('scroll', updateProgressOnScroll);
        UIElements.finalizeBtn.addEventListener('click', finalizeCall);
        UIElements.modalContinueBtn.addEventListener('click', handleContinueFromModal);
        UIElements.startNewCallBtn.addEventListener('click', resetScript); 
        UIElements.makePaymentBtn.addEventListener('click', handleMakePayment);
        // MODIFICACIÓN: Event listener para el botón de exportación
        UIElements.exportCsvBtn.addEventListener('click', exportToCSV);
        
        scriptContainer.querySelector('#info-debt-amount').addEventListener('input', updateCalculation);
        scriptContainer.querySelector('#info-business').addEventListener('change', (e) => {
            const note = document.getElementById('business-deduction-note');
            if(note) note.style.display = e.target.value === 'Sí' ? 'block' : 'none';
        });
        scriptContainer.querySelector('#lang-btn-es').addEventListener('click', () => switchLanguage('es'));
        scriptContainer.querySelector('#lang-btn-en').addEventListener('click', () => switchLanguage('en'));
        
        // --- Inicialización Final ---
        setupTimer('call-timer');
        setupTimer('hold-timer');
        setupStarRating(document.getElementById('star-rating'));
        generateDebtYearCheckboxes();
        setupPaymentForm();
        updateProgressOnScroll();
        document.getElementById('business-deduction-note').style.display = 'none';
        switchLanguage('es');
    };

    document.addEventListener('DOMContentLoaded', () => {
        if (typeof bootstrap !== 'undefined' && typeof hljs !== 'undefined') {
            window.initializeCallScript();
        } else {
            // Un pequeño retraso para asegurar que las librerías se carguen si se insertan al final del body
            setTimeout(() => {
                if (typeof bootstrap !== 'undefined' && typeof hljs !== 'undefined') {
                     window.initializeCallScript();
                } else {
                    console.error("Bootstrap or Highlight.js not found. Call script could not be initialized.");
                }
            }, 500);
        }
    });
    </script>