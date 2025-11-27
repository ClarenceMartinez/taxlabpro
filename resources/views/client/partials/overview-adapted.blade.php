<style>
    .profile-card {
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        font-family: 'Inter', sans-serif; /* Un font más moderno, puedes cambiarlo */
    }

    .profile-header {
        background: linear-gradient(135deg, var(--bs-primary), var(--bs-info));
        color: #fff;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .profile-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .profile-info h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .profile-info p {
        margin: 0;
        font-size: 0.85rem;
        opacity: 0.9;
    }

    .profile-body {
        padding: 1.5rem;
    }
    
    .profile-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0 2rem; /* Sin gap vertical, 2rem horizontal */
    }

    .profile-column .column-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--bs-primary);
        margin-top: 0;
        margin-bottom: 0.8rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--bs-primary-bg-subtle);
    }

    .profile-field-item {
        position: relative;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s ease-in-out;
    }
    .profile-field-item:hover {
        background-color: #f8f9fa;
    }
    .profile-field-item:last-child {
        border-bottom: none;
    }

    .profile-field-item label {
        display: block;
        font-size: 0.7rem;
        font-weight: 500;
        color: #8895a7;
        margin-bottom: 0.2rem;
        text-transform: uppercase;
    }

    .field-view-state {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        min-height: 24px;
    }
    
    .field-icon {
        font-size: 1.1rem;
        color: #6c757d;
        width: 20px;
        text-align: center;
    }

    .field-view-state .value-display {
        font-size: 0.875rem;
        color: #343a40;
        line-height: 1.4;
        word-break: break-word;
        flex-grow: 1;
    }
    .field-view-state .value-na {
        color: #adb5bd;
        font-style: italic;
    }

    .field-actions {
        position: absolute;
        top: 50%;
        right: 0.5rem;
        transform: translateY(-50%);
        display: flex;
        gap: 0.25rem;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
    }
    .profile-field-item:hover .field-actions {
        opacity: 1;
        visibility: visible;
    }
    
    .field-edit-state { display: none; }
    .profile-field-item.editing .field-view-state { display: none; }
    .profile-field-item.editing .field-edit-state { display: block; }
    .profile-field-item.editing .field-actions { display: none !important; }

    .field-actions .btn { padding: 0.1rem 0.4rem; font-size: 0.8rem; }
    .value-display a { color: var(--bs-link-color); text-decoration: none; font-weight: 500; }
    .value-display a:hover { text-decoration: underline; }
    .ssn-toggle-icon { cursor: pointer; margin-left: 0.4rem; color: #6c757d; }
    
    /* Responsive adjustment for smaller screens */
    @media (max-width: 992px) {
        .profile-content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem 0;
        }
    }
</style>

@php
    if (!function_exists('formatValue')) { function formatValue($value, $default = 'N/A') { if (is_null($value) || (is_string($value) && trim($value) === '')) { return "<span class='value-na'>{$default}</span>"; } return e($value); } }
    if (!function_exists('formatBoolean')) { function formatBoolean($value, $yes = 'Yes', $no = 'No', $na = 'N/A') { if (is_null($value) || $value === '') { return "<span class='value-na'>{$na}</span>"; } return $value ? $yes : $no; } }
    if (!function_exists('formatEnum')) { function formatEnum($value, $map = [], $na = 'N/A') { if (is_null($value) || (is_string($value) && trim($value) === '')) { return "<span class='value-na'>{$na}</span>"; } $lowerValue = is_string($value) ? strtolower($value) : (string)$value; $standardMap = [ 'yes' => 'Yes', 'no' => 'No', 'unknown' => 'Unknown', '1' => 'Yes', '0' => 'No' ]; $finalMap = array_merge($standardMap, array_change_key_case($map, CASE_LOWER)); if (isset($finalMap[$lowerValue])) { return e($finalMap[$lowerValue]); } return e(ucfirst(str_replace('_', ' ', strval($value)))); } }
    if (!function_exists('formatCurrency')) { function formatCurrency($value, $currency = '$', $decimals = 2, $na = 'N/A') { if (is_null($value) || $value === '' || !is_numeric($value)) { return "<span class='value-na'>{$na}</span>"; } return $currency . number_format(floatval($value), $decimals); } }
    if (!function_exists('formatDateValue')) { function formatDateValue($dateValue, $format = 'm/d/Y', $na = 'N/A') { if (empty($dateValue)) return "<span class='value-na'>{$na}</span>"; try { return \Carbon\Carbon::parse($dateValue)->format($format); } catch (\Exception $e) { return "<span class='value-na'>Invalid Date</span>"; } } }
    if (!function_exists('formatSsn')) { function formatSsn($ssn, $na = 'N/A') { if (empty($ssn)) return "<span class='value-na'>{$na}</span>"; $maskedSsn = '***-**-'.substr($ssn, -4); $fullSsnAttr = "data-full-ssn='" . e($ssn) . "'"; $iconHtml = "<i class='ri-eye-line ssn-toggle-icon' onclick='toggleSSN(this)'></i>"; return "<span class='ssn-mask' {$fullSsnAttr}>".e($maskedSsn)."</span>{$iconHtml}"; } }
    if (!function_exists('formatPhoneLink')) { function formatPhoneLink($phone, $na = 'N/A') { if (empty($phone)) return "<span class='value-na'>{$na}</span>"; return "<a href='tel:" . e(preg_replace('/[^0-9+]/', '', $phone)) . "'>" . e($phone) . "</a>"; } }
    if (!function_exists('formatEmailLink')) { function formatEmailLink($email, $na = 'N/A') { if (empty($email)) return "<span class='value-na'>{$na}</span>"; return "<a href='mailto:" . e($email) . "'>" . e($email) . "</a>"; } }
    if (!function_exists('renderYesNoUnknownSelect')) { function renderYesNoUnknownSelect($fieldName, $currentValue) { $options = ['unknown' => 'Unknown', 'yes' => 'Yes', 'no' => 'No']; $html = "<select class='form-select form-select-sm' id='".e($fieldName)."'>"; foreach ($options as $value => $label) { $selected = ($currentValue == $value) ? 'selected' : ''; $html .= "<option value='".e($value)."' {$selected}>".e($label)."</option>"; } $html .= "</select>"; return $html; } }
    

    if (!function_exists('render_editable_field')) {
        function render_editable_field($client, $fieldName, $label, $iconClass = 'ri-question-mark', $type = 'text', $options = []) {
            $fieldId = "editable-field-{$fieldName}";
            $currentValue = $client->$fieldName ?? null;
            $isDisabled = isset($options['disabled']) && $options['disabled'] === true;

            $displayValue = '';
            switch ($type) {
                case 'currency': $displayValue = formatCurrency($currentValue); break;
                case 'date': $displayValue = formatDateValue($currentValue); break;
                case 'ssn': $displayValue = formatSsn($currentValue); break;
                case 'phone': $displayValue = formatPhoneLink($currentValue); break;
                case 'email': $displayValue = formatEmailLink($currentValue); break;
                case 'boolean': $displayValue = formatBoolean($currentValue, 'Active', 'Inactive'); break;
                case 'enum_yes_no': $displayValue = formatEnum($currentValue); break;
                case 'enum': $displayValue = formatEnum($currentValue, $options['map'] ?? []); break;
                default: $displayValue = formatValue($currentValue);
            }

            $inputHtml = '';
            $safeCurrentValue = e($currentValue ?? '');
            switch ($type) {
                case 'currency': $inputHtml = "<span class='input-group-text'>$</span><input type='number' class='form-control form-control-sm' id='{$fieldName}' value='{$safeCurrentValue}' step='0.01'>"; break;
                case 'date': $dateValue = $currentValue ? \Carbon\Carbon::parse($currentValue)->format('Y-m-d') : ''; $inputHtml = "<input type='date' class='form-control form-control-sm' id='{$fieldName}' value='{$dateValue}'>"; break;
                case 'textarea': $inputHtml = "<textarea class='form-control form-control-sm' id='{$fieldName}' rows='2'>{$safeCurrentValue}</textarea>"; break;
                case 'boolean': $selected1 = $currentValue == 1 ? 'selected' : ''; $selected0 = $currentValue == 0 ? 'selected' : ''; $inputHtml = "<select class='form-select form-select-sm' id='{$fieldName}'><option value='1' {$selected1}>Active</option><option value='0' {$selected0}>Inactive</option></select>"; break;
                case 'enum_yes_no': $inputHtml = renderYesNoUnknownSelect($fieldName, $currentValue); break;
                case 'enum': $selectOptions = ''; if (isset($options['map'])) { foreach($options['map'] as $key => $val) { $selected = ($currentValue == $key) ? 'selected' : ''; $selectOptions .= "<option value='" . e($key) . "' {$selected}>" . e($val) . "</option>"; } } $inputHtml = "<select class='form-select form-select-sm' id='{$fieldName}'>{$selectOptions}</select>"; break;
                default: $inputType = e($type); $inputHtml = "<input type='{$inputType}' class='form-control form-control-sm' id='{$fieldName}' value='{$safeCurrentValue}'>";
            }

            $iconHtml = "<i class='field-icon {$iconClass}'></i>";

            $html = "<div id='".e($fieldId)."' class='profile-field-item' data-field-name='".e($fieldName)."' data-field-type='".e($type)."'>";
            $html .= "<label for='".e($fieldName)."'>".e($label)."</label>";
            $html .= "<div class='field-view-state'>{$iconHtml}<div class='value-display'>{$displayValue}</div>";
            if (!$isDisabled) {
                $html .= "<div class='field-actions'><button class='btn btn-soft-primary btn-sm btn-edit' onclick=\"editField('".e($fieldName)."')\"><i class='ri-pencil-fill'></i></button></div>";
            }
            $html .= "</div>";
            if (!$isDisabled) {
                $html .= "<div class='field-edit-state'><div class='input-group input-group-sm'>";
                $html .= $inputHtml;
                $html .= "<button class='btn btn-success' onclick=\"saveField('".e($fieldName)."', '".e($client->id)."')\"><i class='ri-check-line'></i></button>";
                $html .= "<button class='btn btn-danger' onclick=\"cancelEdit('".e($fieldName)."')\"><i class='ri-close-line'></i></button>";
                $html .= "</div></div>";
            }
            $html .= "</div>";
            return $html;
        }
    }
@endphp

{{-- MAIN VIEW BODY - Con diseño de perfil y llamadas a función actualizadas --}}
<div class="profile-card">
    <div class="profile-body">
        <div class="profile-content-grid">
            
            <div class="profile-column">
                {!! render_editable_field($client, 'first_name', 'First Name', 'ri-user-line') !!}
                {!! render_editable_field($client, 'mi', 'MI', 'ri-user-line') !!}
                {!! render_editable_field($client, 'last_name', 'Last Name', 'ri-user-line') !!}
                {!! render_editable_field($client, 'ssn', 'SSN', 'ri-fingerprint-line', 'ssn') !!}
                {!! render_editable_field($client, 'date_birdth', 'Date of Birth', 'ri-calendar-2-line', 'date') !!}
                {!! render_editable_field($client, 'tax_payer_email', 'Email', 'ri-mail-line', 'email') !!}
                {!! render_editable_field($client, 'phone_home', 'Phone (Home)', 'ri-phone-line', 'phone') !!}
                {!! render_editable_field($client, 'cell_home', 'Cell (Home)', 'ri-smartphone-line', 'phone') !!}
                {!! render_editable_field($client, 'phone_work', 'Phone (Work)', 'ri-building-line', 'phone') !!}
                {!! render_editable_field($client, 'dl', 'DL #', 'ri-bank-card-line') !!}
                {!! render_editable_field($client, 'dl_state', 'DL State', 'ri-bank-card-line') !!}
                {!! render_editable_field($client, 'has_passport', 'Has Passport', 'ri-passport-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'client_reference', 'Client Ref.', 'ri-user-shared-line') !!}
                {!! render_editable_field($client, 'address_1', 'Address 1', 'ri-map-pin-line') !!}
                {!! render_editable_field($client, 'address_2', 'Address 2', 'ri-map-pin-2-line') !!}
                {!! render_editable_field($client, 'city', 'City', 'ri-map-pin-2-line') !!}
                {!! render_editable_field($client, 'state', 'State', 'ri-map-pin-2-line') !!}
                {!! render_editable_field($client, 'zipcode', 'Zipcode', 'ri-map-pin-2-line') !!}
                {!! render_editable_field($client, 'country', 'Country', 'ri-earth-line') !!}
                {!! render_editable_field($client, 'marital_status', 'Marital Status', 'ri-group-line', 'enum', ['map' => ['1' => 'Single', '2' => 'Married']]) !!}
                {!! render_editable_field($client, 'marital_date', 'Marital Date', 'ri-calendar-event-line', 'date') !!}
                
                @if((string)$client->marital_status === '2')
                    <h5 class="column-title mt-3">Información del Cónyuge</h5>
                    {!! render_editable_field($client, 'spouse_first_name', 'Spouse First Name', 'ri-user-heart-line') !!}
                    {!! render_editable_field($client, 'spouse_mi', 'Spouse MI', 'ri-user-heart-line') !!}
                    {!! render_editable_field($client, 'spouse_last_name', 'Spouse Last Name', 'ri-user-heart-line') !!}
                    {!! render_editable_field($client, 'spouse_ssn', 'Spouse SSN', 'ri-fingerprint-line', 'ssn') !!}
                    {!! render_editable_field($client, 'spouse_date_birdth', 'Spouse DOB', 'ri-calendar-2-line', 'date') !!}
                    {!! render_editable_field($client, 'spouse_email', 'Spouse Email', 'ri-mail-line', 'email') !!}
                    {!! render_editable_field($client, 'spouse_phone_home', 'Spouse Phone', 'ri-phone-line', 'phone') !!}
                @endif
            </div>

            <div class="profile-column">
                {!! render_editable_field($client, 'deal', 'Deal Amount', 'ri-money-dollar-circle-line', 'currency') !!}
                {!! render_editable_field($client, 'deal_pay', 'Deal Paid', 'ri-hand-coin-line', 'currency') !!}
                {!! render_editable_field($client, 'owed', 'Amount Owed', 'ri-scales-3-line', 'currency') !!}
                {!! render_editable_field($client, 'form_type', 'Form Type', 'ri-file-list-3-line', 'enum', ['map' => ['433A' => '433-A', '433A OIC' => '433-A (OIC)', '433B' => '433-B', '433B OIC' => '433-B (OIC)']]) !!}
                {!! render_editable_field($client, 'case_status', 'Case Status', 'ri-folder-shield-2-line') !!}
                {!! render_editable_field($client, 'estatus', 'Record Status', 'ri-toggle-line', 'boolean') !!}
                {!! render_editable_field($client, 'tags', 'Tags', 'ri-price-tag-3-line') !!}
                {!! render_editable_field($client, 'business_interest', 'Has Business Interest', 'ri-briefcase-line', 'enum_yes_no') !!}
                @if($client->business_interest == 'yes' || !empty($client->business_name))
                    {!! render_editable_field($client, 'business_name', 'Business Name', 'ri-briefcase-4-line') !!}
                    {!! render_editable_field($client, 'business_ein', 'EIN', 'ri-barcode-box-line') !!}
                    {!! render_editable_field($client, 'type_of_business', 'Type', 'ri-store-2-line') !!}
                    {!! render_editable_field($client, 'business_phone', 'Bus. Phone', 'ri-building-line', 'phone') !!}
                    {!! render_editable_field($client, 'total_number_of_employees', 'Employees', 'ri-team-line', 'number') !!}
                    {!! render_editable_field($client, 'business_liabilities', 'Bus. Has Liabilities', 'ri-file-warning-line', 'enum_yes_no') !!}
                @endif
                {!! render_editable_field($client, 'household_dependents', 'Has Dependents', 'ri-parent-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'taxpayer_employed', 'Is Taxpayer Employed', 'ri-user-settings-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'bankruptcy_status', 'Currently in Bankruptcy', 'ri-auction-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'filed_bankruptcy', 'Ever Filed Bankruptcy', 'ri-history-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'lawsuit_party', 'Party to a Lawsuit', 'ri-scales-3-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'foreign_assets', 'Has Foreign Assets', 'ri-plane-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'income_increase_decrease', 'Income Change Expected', 'ri-line-chart-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'owns_real_property', 'Owns Real Property', 'ri-home-4-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'own_vehicles', 'Owns Vehicles', 'ri-roadster-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'personal_bank_accounts', 'Has Bank Accounts', 'ri-bank-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'retirement_accounts', 'Has Retirement Accounts', 'ri-safe-2-line', 'enum_yes_no') !!}
                {!! render_editable_field($client, 'id', 'Client ID', 'ri-barcode-line', 'text', ['disabled' => true]) !!}
                {!! render_editable_field($client, 'updated_at', 'Last Updated', 'ri-time-line', 'text', ['disabled' => true]) !!}
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT COMPLETO Y CORREGIDO (No requiere cambios, funciona con la nueva estructura) --}}
<script>
    function toggleSSN(iconElement) {
        const valueDisplayDiv = iconElement.closest('.value-display');
        if (!valueDisplayDiv) return;
        const ssnSpan = valueDisplayDiv.querySelector('.ssn-mask');
        if (!ssnSpan) return;

        const fullSSN = ssnSpan.dataset.fullSsn;
        const isMasked = ssnSpan.textContent.startsWith('***');
        
        if (isMasked) {
            ssnSpan.textContent = fullSSN;
            iconElement.classList.replace('ri-eye-line', 'ri-eye-off-line');
        } else {
            const maskedSsn = '***-**-' + fullSSN.slice(-4);
            ssnSpan.textContent = maskedSsn;
            iconElement.classList.replace('ri-eye-off-line', 'ri-eye-line');
        }
    }

    function editField(fieldKey) {
        const container = document.getElementById(`editable-field-${fieldKey}`);
        if (!container) return;
        
        // Cierra cualquier otro campo que esté abierto
        document.querySelectorAll('.profile-field-item.editing').forEach(openField => {
            if (openField.id !== container.id) {
                openField.classList.remove('editing');
            }
        });

        container.classList.add('editing');
        const input = container.querySelector('input, select, textarea');
        if (input) {
            input.focus();
            // Mueve el cursor al final del texto en los inputs de texto
            if (typeof input.selectionStart == "number") {
                input.selectionStart = input.selectionEnd = input.value.length;
            }
        }
    }

    function cancelEdit(fieldKey) {
        const container = document.getElementById(`editable-field-${fieldKey}`);
        if (container) {
            container.classList.remove('editing');
        }
    }

    async function saveField(fieldKey, clientId) {
        const container = document.getElementById(`editable-field-${fieldKey}`);
        if (!container) return;
        
        const input = container.querySelector(`#${fieldKey}`);
        const newValue = input.value;
        const saveButton = container.querySelector('.btn-success');
        
        // Mostrar spinner y deshabilitar botones
        saveButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        saveButton.disabled = true;
        container.querySelector('.btn-danger').disabled = true;

        try {
            console.log(`Simulating save... Client: ${clientId}, Field: ${fieldKey}, Value: ${newValue}`);
            // Aquí iría la llamada real con axios u otra librería:
            // const response = await axios.patch(`/clients/${clientId}/update-field`, { field: fieldKey, value: newValue });
            
            // Simulación de la espera de la red
            await new Promise(resolve => setTimeout(resolve, 600)); 
            
            updateDisplayValue(container, newValue); 
            cancelEdit(fieldKey); 
            
        } catch (error) {
            console.error('Error saving field:', error);
            // Idealmente, mostrar un mensaje de error al usuario (ej. con un toast)
            alert('An error occurred while saving. Please check the console.');
        } finally {
            // Restaurar botones a su estado original
            saveButton.innerHTML = '<i class="ri-check-line"></i>';
            saveButton.disabled = false;
            container.querySelector('.btn-danger').disabled = false;
        }
    }

    function updateDisplayValue(container, newValue) {
        const viewDisplayDiv = container.querySelector('.value-display');
        if (!viewDisplayDiv) return;

        const fieldType = container.dataset.fieldType;
        const input = container.querySelector('input, select, textarea');
        
        // Limpiar el contenido actual del display
        viewDisplayDiv.innerHTML = ''; 

        if (!newValue || (typeof newValue === 'string' && newValue.trim() === '')) {
            const naSpan = document.createElement('span');
            naSpan.className = 'value-na';
            naSpan.textContent = 'N/A';
            viewDisplayDiv.appendChild(naSpan);
            return;
        }

        let content;
        switch (fieldType) {
            case 'currency':
                content = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(parseFloat(newValue) || 0);
                break;
            case 'date':
                const date = new Date(newValue);
                // Ajuste para evitar problemas de zona horaria que restan un día
                const timeZoneOffset = date.getTimezoneOffset() * 60000;
                content = new Date(date.getTime() + timeZoneOffset).toLocaleDateString('en-US');
                break;
            case 'phone':
                const phoneLink = document.createElement('a');
                phoneLink.href = `tel:${newValue.replace(/[^0-9+]/g, '')}`;
                phoneLink.textContent = newValue;
                viewDisplayDiv.appendChild(phoneLink);
                return; // Salimos porque ya manipulamos el DOM
            case 'email':
                const emailLink = document.createElement('a');
                emailLink.href = `mailto:${newValue}`;
                emailLink.textContent = newValue;
                viewDisplayDiv.appendChild(emailLink);
                return; // Salimos porque ya manipulamos el DOM
            case 'boolean':
                content = (newValue == '1' || String(newValue).toLowerCase() === 'active') ? 'Active' : 'Inactive';
                break;
            case 'enum_yes_no':
            case 'enum':
                if (input && input.tagName === 'SELECT') {
                    content = input.options[input.selectedIndex].text;
                } else {
                    // Fallback por si no es un select
                    content = newValue.charAt(0).toUpperCase() + newValue.slice(1);
                }
                break;
            default:
                content = newValue;
        }
        
        viewDisplayDiv.textContent = content;
    }
</script>