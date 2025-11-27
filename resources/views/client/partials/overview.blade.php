{{-- resources/views/client/partials/overview-card.blade.php --}}
<style>
    /* --- START: Client Overview Card Specific Styles --- */
    #card-client-overview .card-body-compact {
        padding: 0.75rem;
    }

    /* Hacemos que el contenedor principal del contenido colapsable sea un "query container" */
    #collapseClientOverview {
        container-type: inline-size; /* Basado en el ancho disponible */
        /* container-name: overview-container; /* Opcional: nombre para @container rules más específicas */
    }

    /* Contenedor principal para las columnas (el .row) */
    #card-client-overview .client-overview-grid > .row { /* Seleccionamos el .row directo */
        display: flex;
        flex-wrap: wrap;
        /* Usamos las variables de gutter de Bootstrap para el espaciado */
        --bs-gutter-x: 0.75rem;
        --bs-gutter-y: 0.75rem; /* Esto se usará para el margin-bottom de las columnas */

        /* Replicamos el comportamiento de los gutters negativos de .row de Bootstrap */
        margin-right: calc(-0.5 * var(--bs-gutter-x));
        margin-left: calc(-0.5 * var(--bs-gutter-x));
    }

    /* Estilo para cada "columna" principal (Client-Primary, Spouse-Primary, Client-Assets) */
    #card-client-overview .overview-column {
        flex-grow: 1; /* Permitir que crezca para llenar el espacio */
        /* Establece un ancho base. Si el contenedor es más ancho, cabrán más columnas.
           Ajusta este valor según el contenido y el diseño deseado.
           Por ejemplo, 320px podría ser un buen mínimo para una columna de este tipo. */
        flex-basis: 320px;

        /* Aplicamos padding para el espaciado interno, usando la variable de gutter */
        padding-right: calc(0.5 * var(--bs-gutter-x));
        padding-left: calc(0.5 * var(--bs-gutter-x));

        /* mb-3 (clase de Bootstrap) se usa para el margen inferior,
           lo cual es consistente con --bs-gutter-y si las columnas se apilan.
           Si no usas la clase mb-3 en el HTML, podrías añadir:
           margin-bottom: var(--bs-gutter-y); */
    }

    /* Contenedor para los bloques <dl> DENTRO de una overview-column.
       Sus hijos (los div que contienen h6 y dl) se apilarán verticalmente. */
    #card-client-overview .overview-section-container {
        display: flex;
        flex-direction: column;
        gap: 0.8rem; /* Espacio entre secciones de datos (div > h6 + dl) */
    }

    #card-client-overview .overview-section-title {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--bs-primary);
        margin-bottom: 0.4rem;
        padding-bottom: 0.2rem;
        border-bottom: 1px solid #eee;
    }

    #card-client-overview .dl-compact {
        display: grid;
        grid-template-columns: auto 1fr; /* Label auto, Value toma el resto */
        gap: 0.1rem 0.4rem;
        margin-bottom: 0;
        font-size: 0.7rem;
        line-height: 1.3;
    }

    #card-client-overview .dl-compact dt {
        font-weight: 500;
        white-space: nowrap;
        color: #495057;
        padding-right: 0.5em;
        text-align: left;
    }

    #card-client-overview .dl-compact dd {
        margin-left: 0;
        word-break: break-word;
        color: #212529;
    }

    #card-client-overview .dl-compact dd a {
        font-size: inherit;
        color: var(--bs-link-color);
        text-decoration: none;
    }
    #card-client-overview .dl-compact dd a:hover {
        text-decoration: underline;
    }

    #card-client-overview .dl-compact dd .value-unknown,
    #card-client-overview .dl-compact dd .value-na {
        color: #a8b0b9;
        font-style: italic;
    }

    #card-client-overview .dl-compact dd .ssn-mask {
        font-family: monospace;
    }
    #card-client-overview .dl-compact dd .ri-tiny {
        font-size: 0.9em;
        vertical-align: middle;
        cursor: pointer;
    }
</style>
<div class="card-body card-body-compact client-overview-grid">
        @php
            // ... (tus funciones PHP helper sin cambios) ...
            if (!function_exists('formatValue')) {
                function formatValue($value, $default = 'N/A') {
                    if (is_null($value) || (is_string($value) && trim($value) === '')) {
                        return "<span class='value-na'>{$default}</span>";
                    }
                    return e($value);
                }
            }

            if (!function_exists('formatBoolean')) {
                function formatBoolean($value, $yes = 'Yes', $no = 'No', $na = 'N/A') {
                    if (is_null($value) || $value === '') {
                        return "<span class='value-na'>{$na}</span>";
                    }
                    return $value ? $yes : $no;
                }
            }

            if (!function_exists('formatEnum')) {
                function formatEnum($value, $map = [], $na = 'N/A') {
                    if (is_null($value) || (is_string($value) && trim($value) === '')) {
                        return "<span class='value-na'>{$na}</span>";
                    }
                    $lowerValue = is_string($value) ? strtolower($value) : $value;
                    $standardMap = [
                        'yes' => 'Yes',
                        'no' => 'No',
                        'unknown' => 'Unknown',
                    ];
                    $finalMap = array_merge($standardMap, array_change_key_case($map, CASE_LOWER));

                    if (isset($finalMap[$lowerValue])) {
                        return e($finalMap[$lowerValue]);
                    }
                    return e(ucfirst(strval($value)));
                }
            }

            if (!function_exists('formatCurrency')) {
                function formatCurrency($value, $currency = '$', $decimals = 2, $na = 'N/A') {
                    if (is_null($value) || $value === '' || !is_numeric($value)) {
                        return "<span class='value-na'>{$na}</span>";
                    }
                    return $currency . number_format(floatval($value), $decimals);
                }
            }

            if (!function_exists('formatDateValue')) {
                function formatDateValue($dateValue, $format = 'm/d/Y', $na = 'N/A') {
                    if (empty($dateValue)) return "<span class='value-na'>{$na}</span>";
                    try {
                        return \Carbon\Carbon::parse($dateValue)->format($format);
                    } catch (\Exception $e) {
                        return "<span class='value-na'>Invalid Date</span>";
                    }
                }
            }

            if (!function_exists('formatSsn')) {
                function formatSsn($ssn, $na = 'N/A', $elementId = null) {
                    if (empty($ssn)) return "<span class='value-na'>{$na}</span>";
                    $maskedSsn = '***-**-'.substr($ssn, -4);
                    $fullSsnAttr = $elementId ? "data-full-ssn='" . e($ssn) . "'" : "";
                    $iconHtml = $elementId ? "<i class='ri-eye-line cursor-pointer ms-1 ri-tiny' onclick='toggleSSNTableOverview(\"" . e($elementId) . "\", this)'></i>" : "";
                    return "<span class='ssn-mask' " . ($elementId ? "id='" . e($elementId) . "'" : "") . " {$fullSsnAttr}>{$maskedSsn}</span>{$iconHtml}";
                }
            }
            if (!function_exists('formatPhoneLink')) {
                function formatPhoneLink($phone, $na = 'N/A') {
                    if (empty($phone)) return "<span class='value-na'>{$na}</span>";
                    return "<a href='tel:" . e($phone) . "'>" . e($phone) . "</a>";
                }
            }

            if (!function_exists('formatEmailLink')) {
                function formatEmailLink($email, $na = 'N/A') {
                    if (empty($email)) return "<span class='value-na'>{$na}</span>";
                    return "<a href='mailto:" . e($email) . "'>" . e($email) . "</a>";
                }
            }

            $formTypeMap = [
                '433A' => '433-A', '433A OIC' => '433-A (OIC)',
                '433B' => '433-B', '433B OIC' => '433-B (OIC)'
            ];
            $typeAddressMap = ['1' => 'Physical', '2' => 'Mailing'];
            $maritalStatusMap = ['1' => 'Single', '2' => 'Married'];
            $yesNoUnknownMap = ['yes' => 'Yes', 'no' => 'No', 'unknown' => 'Unknown'];
        @endphp

        <div class="row"> {{-- Este .row es ahora el contenedor flex principal para las overview-column --}}
            {{-- COLUMNA PRINCIPAL 1 --}}
            {{-- Se eliminan las clases col-12 col-md-6 col-lg-4 de aquí --}}
            <div class="overview-column mb-3">
                <div class="overview-section-container">


                    <div>
                        <h6 class="overview-section-title">Case & System</h6>
                        <dl class="dl-compact">
                            <dt>Form Type:</dt>
                            <dd>{!! formatEnum($client->form_type, $formTypeMap) !!}</dd>
                            <dt>Slug:</dt>
                            <dd>{!! formatValue($client->slug) !!}</dd>
                             <dt>Storage Path:</dt>
                            <dd style="word-break: break-all;">{!! formatValue($client->storage_path) !!}</dd>
                            <dt>Status (Estatus):</dt>
                            <dd>{!! formatBoolean($client->estatus, 'Active', 'Inactive') !!}</dd>
                            <dt>Tags:</dt>
                            <dd>{!! formatValue($client->tags) !!}</dd>
                            <dt>Monitor:</dt>
                            <dd>{!! formatValue($client->monitor) !!}</dd>
                            <dt>Type:</dt>
                            <dd>{!! formatValue($client->type) !!}</dd>
                            <dt>Avatar:</dt>
                            <dd>{!! formatValue($client->avatar) !!}</dd>
                            <dt>Company ID:</dt>
                            <dd>{!! formatValue($client->company_id) !!}</dd>
                            <dt>Case Status:</dt>
                            <dd>{!! formatValue($client->case_status) !!}</dd>
                            <dt>Created:</dt>
                            <dd>{!! formatDateValue($client->created_at, 'm/d/y H:i') !!}</dd>
                            <dt>Updated:</dt>
                            <dd>{!! formatDateValue($client->updated_at, 'm/d/y H:i') !!}</dd>
                             <dt>Deleted:</dt>
                            <dd>{!! formatDateValue($client->deleted_at, 'm/d/y H:i') !!}</dd>
                        </dl>
                    </div>

                    <div>
                        <h6 class="overview-section-title">Client - Primary</h6>
                        <dl class="dl-compact">
                            <dt>ID:</dt>
                            <dd>{!! formatValue($client->id) !!}</dd>
                            <dt>Name:</dt>
                            <dd>{!! formatValue(trim(($client->first_name ?? '') . ' ' . ($client->mi ?? '') . ' ' . ($client->last_name ?? ''))) !!}</dd>
                            <dt>Salutation:</dt>
                            <dd>{!! formatValue($client->saludation_for_letter) !!}</dd>
                            <dt>SSN:</dt>
                            <dd>{!! formatSsn($client->ssn, 'N/A', 'ssn-overview-client') !!}</dd>
                            <dt>DOB:</dt>
                            <dd>{!! formatDateValue($client->date_birdth) !!}</dd>
                            <dt>DL:</dt>
                            <dd>{!! formatValue($client->dl) !!}</dd>
                            <dt>DL State:</dt>
                            <dd>{!! formatValue($client->dl_state) !!}</dd>
                            <dt>Passport:</dt>
                            <dd>{!! formatEnum($client->has_passport, $yesNoUnknownMap) !!}</dd>
                            <dt>Reference:</dt>
                            <dd>{!! formatValue($client->client_reference) !!}</dd>
                        </dl>
                    </div>

                    <div>
                        <h6 class="overview-section-title">Client - Contact</h6>
                        <dl class="dl-compact">
                            <dt>Email:</dt>
                            <dd>{!! formatEmailLink($client->tax_payer_email) !!}</dd>
                            <dt>Phone (Home):</dt>
                            <dd>{!! formatPhoneLink($client->phone_home) !!}</dd>
                            <dt>Cell (Home):</dt>
                            <dd>{!! formatPhoneLink($client->cell_home) !!}</dd>
                            <dt>Fax (Home):</dt>
                            <dd>{!! formatValue($client->fax_home) !!}</dd>
                            <dt>Phone (Work):</dt>
                            <dd>{!! formatPhoneLink($client->phone_work) !!}</dd>
                            <dt>Cell (Work):</dt>
                            <dd>{!! formatPhoneLink($client->cell_work) !!}</dd>
                            <dt>Fax (Work):</dt>
                            <dd>{!! formatValue($client->fax_work) !!}</dd>
                        </dl>
                    </div>

                    <div>
                        <h6 class="overview-section-title">Client - Addresses</h6>
                        <dl class="dl-compact">
                            <dt>Physical Type:</dt>
                            <dd>{!! formatEnum($client->type_address, $typeAddressMap) !!}</dd>
                            <dt>Physical Addr:</dt>
                            @php
                                $address_parts = array_filter([$client->address_1, $client->address_2, $client->city, $client->state, $client->zipcode, $client->country]);
                                $full_address = implode(', ', $address_parts);
                            @endphp
                            <dd>{!! formatValue($full_address) !!}</dd>
                            <dt>Mailing Addr:</dt>
                            @php
                                $m_address_parts = array_filter([$client->m_address_1, $client->m_address_2, $client->m_city, $client->m_state, $client->m_zipcode]);
                                $full_m_address = implode(', ', $m_address_parts);
                            @endphp
                            <dd>{!! formatValue($full_m_address) !!}</dd>
                        </dl>
                    </div>

                    <div>
                        <h6 class="overview-section-title">Client - Marital</h6>
                        <dl class="dl-compact">
                            <dt>Status:</dt>
                            <dd>{!! formatEnum($client->marital_status, $maritalStatusMap) !!}</dd>
                            <dt>Date:</dt>
                            <dd>{!! formatDateValue($client->marital_date) !!}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- COLUMNA PRINCIPAL 2 --}}
            <div class="overview-column mb-3">
                <div class="overview-section-container">
                    @php
                        $isMarriedOverview = isset($client->marital_status) && (string)$client->marital_status === '2';
                    @endphp
                    @if($isMarriedOverview || !empty($client->spouse_first_name) || !empty($client->spouse_last_name))
                        <div>
                            <h6 class="overview-section-title">Spouse - Primary</h6>
                            <dl class="dl-compact">
                                <dt>Name:</dt>
                                <dd>{!! formatValue(trim(($client->spouse_first_name ?? '') . ' ' . ($client->spouse_mi ?? '') . ' ' . ($client->spouse_last_name ?? ''))) !!}</dd>
                                <dt>Salutation:</dt>
                                <dd>{!! formatValue($client->spouse_saludation_for_letter) !!}</dd>
                                <dt>SSN:</dt>
                                <dd>{!! formatSsn($client->spouse_ssn, 'N/A', 'ssn-overview-spouse') !!}</dd>
                                <dt>DOB:</dt>
                                <dd>{!! formatDateValue($client->spouse_date_birdth) !!}</dd>
                                <dt>DL:</dt>
                                <dd>{!! formatValue($client->spouse_dl) !!}</dd>
                                <dt>DL State:</dt>
                                <dd>{!! formatValue($client->spouse_dl_state) !!}</dd>
                                <dt>Passport:</dt>
                                <dd>{!! formatEnum($client->spouse_has_passport, $yesNoUnknownMap) !!}</dd>
                            </dl>
                        </div>
                        <div>
                            <h6 class="overview-section-title">Spouse - Contact</h6>
                            <dl class="dl-compact">
                                <dt>Email:</dt>
                                <dd>{!! formatEmailLink($client->spouse_email) !!}</dd>
                                <dt>Phone (Home):</dt>
                                <dd>{!! formatPhoneLink($client->spouse_phone_home) !!}</dd>
                                <dt>Cell (Home):</dt>
                                <dd>{!! formatPhoneLink($client->spouse_cell_home) !!}</dd>
                                <dt>Fax (Home):</dt>
                                <dd>{!! formatValue($client->spouse_fax_home) !!}</dd>
                                <dt>Phone (Work):</dt>
                                <dd>{!! formatPhoneLink($client->spouse_phone_work) !!}</dd>
                                 <dt>Cell (Work):</dt>
                                <dd>{!! formatPhoneLink($client->spouse_cell_work) !!}</dd>
                                <dt>Fax (Work):</dt>
                                <dd>{!! formatValue($client->spouse_fax_work) !!}</dd>
                            </dl>
                        </div>
                    @endif

                    <div>
                        <h6 class="overview-section-title {{ ($isMarriedOverview || !empty($client->spouse_first_name) || !empty($client->spouse_last_name)) ? '' : 'mt-0' }}">Client - Declarations</h6>
                        <dl class="dl-compact">
                            <dt>Dependents:</dt>
                            <dd>{!! formatEnum($client->household_dependents) !!}</dd>
                            <dt>Taxpayer Empl.:</dt>
                            <dd>{!! formatEnum($client->taxpayer_employed) !!}</dd>
                            <dt>Spouse Empl.:</dt>
                            <dd>{!! formatEnum($client->spouse_employed) !!}</dd>
                            <dt>Business Int.:</dt>
                            <dd>{!! formatEnum($client->business_interest) !!}</dd>
                            <dt>Lawsuit Party:</dt>
                            <dd>{!! formatEnum($client->lawsuit_party) !!}</dd>
                            <dt>IRS Lawsuit:</dt>
                            <dd>{!! formatEnum($client->taxpayer_party_lawsuit_irs) !!}</dd>
                            <dt>Bankruptcy:</dt>
                            <dd>{!! formatEnum($client->bankruptcy_status) !!}</dd>
                            <dt>Filed Bankruptcy:</dt>
                            <dd>{!! formatEnum($client->filed_bankruptcy) !!}</dd>
                            <dt>Trust Beneficiary:</dt>
                            <dd>{!! formatEnum($client->trust_beneficiary) !!}</dd>
                            <dt>Funds in Trust:</dt>
                            <dd>{!! formatEnum($client->funds_held_in_trust) !!}</dd>
                            <dt>Trustee/Fiduc.:</dt>
                            <dd>{!! formatEnum($client->trustee_fiduciary_contributor) !!}</dd>
                            <dt>Safe Deposit Box:</dt>
                            <dd>{!! formatEnum($client->safe_deposit_box) !!}</dd>
                            <dt>Safe on Prem.:</dt>
                            <dd>{!! formatEnum($client->safe_on_premises) !!}</dd>
                            <dt>Outside US (6mo):</dt>
                            <dd>{!! formatEnum($client->lived_outside_us) !!}</dd>
                            <dt>Foreign Assets:</dt>
                            <dd>{!! formatEnum($client->foreign_assets) !!}</dd>
                            <dt>Assets Transf. (10y):</dt>
                            <dd>{!! formatEnum($client->assets_transferred_10_years) !!}</dd>
                            <dt>Real Est. Transf. (3y):</dt>
                            <dd>{!! formatEnum($client->real_estate_transferred_3_years) !!}</dd>
                             <dt>Income +/- Exp.:</dt>
                            <dd>{!! formatEnum($client->income_increase_decrease) !!}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- COLUMNA PRINCIPAL 3 --}}
            <div class="overview-column mb-3">
                 <div class="overview-section-container">
                    <div>
                        <h6 class="overview-section-title">Client - Assets</h6>
                         <dl class="dl-compact">
                            <dt>Owns Real Prop.:</dt>
                            <dd>{!! formatEnum($client->owns_real_property) !!}</dd>
                            <dt>Prop. for Sale:</dt>
                            <dd>{!! formatEnum($client->real_property_for_sale) !!}</dd>
                            <dt>Listing Price:</dt>
                            <dd>{!! formatValue($client->listing_price) !!}</dd>
                            <dt>Own Vehicles:</dt>
                            <dd>{!! formatEnum($client->own_vehicles) !!}</dd>
                            <dt>Vehicles Leased/Loan:</dt>
                            <dd>{!! formatEnum($client->vehicles_leased_purchased) !!}</dd>
                            <dt>Other Assets:</dt>
                            <dd>{!! formatEnum($client->other_valuable_assets) !!}</dd>
                            <dt>Bank Accounts:</dt>
                            <dd>{!! formatEnum($client->personal_bank_accounts) !!}</dd>
                            <dt>Invest. Accts:</dt>
                            <dd>{!! formatEnum($client->investment_accounts) !!}</dd>
                            <dt>Accts/Notes Rec.:</dt>
                            <dd>{!! formatEnum($client->accounts_notes_receivable) !!}</dd>
                            <dt>Digital Assets:</dt>
                            <dd>{!! formatEnum($client->digital_assets) !!}</dd>
                            <dt>Retire. Accts:</dt>
                            <dd>{!! formatEnum($client->retirement_accounts) !!}</dd>
                            <dt>Avail. Credit:</dt>
                            <dd>{!! formatEnum($client->available_credit) !!}</dd>
                            <dt>Life Ins. Cash Val.:</dt>
                            <dd>{!! formatEnum($client->life_insurance_cash_value) !!}</dd>
                            <dt>Intangible Assets:</dt>
                            <dd>{!! formatEnum($client->intangible_assets) !!}</dd>
                             <dt>Outside US Assets Desc:</dt>
                            <dd>{!! formatValue($client->outside_us_assets_description) !!}</dd>
                        </dl>
                    </div>

                    @if(!empty($client->business_name) || !empty($client->business_ein) || !empty($client->type_of_business))
                        <div>
                            <h6 class="overview-section-title">Business - General</h6>
                            <dl class="dl-compact">
                                <dt>Name:</dt>
                                <dd>{!! formatValue($client->business_name) !!}</dd>
                                <dt>Trade Name:</dt>
                                <dd>{!! formatValue($client->trade_name) !!}</dd>
                                <dt>EIN:</dt>
                                <dd>{!! formatValue($client->business_ein) !!}</dd>
                                <dt>Type:</dt>
                                <dd>{!! formatValue($client->type_of_business) !!}</dd>
                                <dt>Entity:</dt>
                                <dd>{!! formatValue($client->type_of_entity) !!}</dd>
                                <dt>Established:</dt>
                                <dd>{!! formatDateValue($client->date_established) !!}</dd>
                                <dt>Sole Prop.:</dt>
                                <dd>{!! formatBoolean($client->sole_proprietorship) !!}</dd>
                                <dt>Fed. Contractor:</dt>
                                <dd>{!! formatBoolean($client->federal_contractor) !!}</dd>
                                <dt>Employees:</dt>
                                <dd>{!! formatValue($client->total_number_of_employees) !!}</dd>
                                <dt>Avg Payroll:</dt>
                                <dd>{!! formatCurrency($client->average_gross_monthly_payroll) !!}</dd>
                                <dt>Tax Deposits:</dt>
                                <dd>{!! formatValue($client->frequency_tax_deposits) !!}</dd>
                                <dt>Cash on Hand:</dt>
                                <dd>{!! formatCurrency($client->cash_on_hand) !!}</dd>
                                <dt>Website:</dt>
                                <dd>{!! formatValue($client->business_website) !!}</dd>
                                <dt>E-commerce:</dt>
                                <dd>{!! formatEnum($client->engage_ecommerce) !!}</dd>
                                <dt>Accepts CC:</dt>
                                <dd>{!! formatEnum($client->accept_credit_cards) !!}</dd>
                                 <dt>Enrolled EFTPS:</dt>
                                <dd>{!! formatEnum($client->enrolled_eftps) !!}</dd>
                                <dt>Partners/Officers:</dt>
                                <dd>{!! formatEnum($client->partners_officers) !!}</dd>
                                <dt>Other Affiliations:</dt>
                                <dd>{!! formatEnum($client->other_business_affiliations) !!}</dd>
                                <dt>Payroll Provider:</dt>
                                <dd>{!! formatEnum($client->payroll_service_provider) !!}</dd>
                                <dt>Related Parties Owe:</dt>
                                <dd>{!! formatEnum($client->related_parties_owe_business) !!}</dd>
                                <dt>Business Lawsuit:</dt>
                                <dd>{!! formatEnum($client->business_party_lawsuit) !!}</dd>
                                <dt>Business Bankrupt:</dt>
                                <dd>{!! formatEnum($client->business_currently_bankrupt) !!}</dd>
                                <dt>Business Filed Bankrupt:</dt>
                                <dd>{!! formatEnum($client->business_ever_filed_bankruptcy) !!}</dd>
                                <dt>Assets Transferred Less Val:</dt>
                                <dd>{!! formatEnum($client->assets_transferred_less_value) !!}</dd>
                                <dt>Business Liabilities:</dt>
                                <dd>{!! formatEnum($client->business_liabilities) !!}</dd>
                            </dl>
                        </div>
                    @endif
                    
                 </div>
            </div>
        </div>

        <script>
            if (typeof toggleSSNTableOverview !== 'function') {
                function toggleSSNTableOverview(elementId, iconElement) {
                    const ssnDisplayElement = document.getElementById(elementId);
                    if (!ssnDisplayElement) return;
                    const fullSSN = ssnDisplayElement.dataset.fullSsn;
                    if (!fullSSN) return;

                    const icon = $(iconElement);
                    if (icon.hasClass('ri-eye-line')) {
                        ssnDisplayElement.firstChild.textContent = fullSSN;
                        icon.removeClass('ri-eye-line').addClass('ri-eye-off-line');
                    } else {
                        ssnDisplayElement.firstChild.textContent = '***-**-' + fullSSN.substr(-4);
                        icon.removeClass('ri-eye-off-line').addClass('ri-eye-line');
                    }
                }
            }
        </script>
    </div>
