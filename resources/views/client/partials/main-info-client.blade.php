 <!-- Client Header -->
        <div class="client-profile-header card">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between w-100">
                    <!-- Left Side: Avatar & Info -->
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div class="flex-shrink-0 me-4 client-avatar">
                            <img src="{{ $client->avatar_url ?? asset('assets/img/avatars/1.png') }}" alt="Client Avatar" class="d-block">
                        </div>
                        <div>
                             @php
                                $currentStatus = $client->case_status ?? 2;
                                $statusMap = [ 1 => 'Unknown', 2 => 'Open', 3 => 'Closed', 4 => 'In Progress', 5 => 'On Hold' ];
                                $statusClassMap = [ 1 => 'status-unknown', 2 => 'status-open', 3 => 'status-closed', 4 => 'status-in-progress', 5 => 'status-on-hold' ];
                                $statusText = $statusMap[$currentStatus] ?? 'Unknown';
                                $statusClass = $statusClassMap[$currentStatus] ?? 'status-unknown';
                            @endphp
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                <h4 class="mb-0 client-info-main">
                                    {{ $client->first_name ?? 'Name_error' }} {{ $client->last_name ?? 'LName_error' }}
                                </h4>
                                <a href="javascript:void(0);" class="item-edit edit-client text-primary" data-bs-toggle="tooltip" title="Edit Client">
                                   <i class="ri-pencil-fill ri-lg"></i>
                                </a>
                                <div class="d-flex align-items-center case-status-indicator-header {{ $statusClass }}">
                                    <span class="status-dot me-2"></span>
                                    <h5 class="me-2">{{ $statusText }}</h5>
                                    <div class="btn-group">
                                        <style>
                                            #headerChangeStatusDropdown.dropdown-toggle::after { display: none !important; }
                                        </style>
                                        <button class="btn btn-xs btn-icon btn-outline-secondary rounded-circle dropdown-toggle d-flex align-items-center justify-content-center p-0" type="button" id="headerChangeStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Change Status" style="width: 20px; height: 20px; margin-left: 6px; display: flex; align-items: center; justify-content: center; position: relative;">
                                            <i class="ri-arrow-down-s-line" style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerChangeStatusDropdown">
                                            @foreach($statusMap as $code => $text)
                                                <li><a class="dropdown-item change-case-status fs-xs" href="javascript:;" data-idx="{{ $client->id }}" data-case="{{ $code }}">Set to {{ $text }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="client-contact-info d-flex flex-wrap align-items-center">
                                <span id="header-email"><i class="ri-mail-line me-1"></i>{{ $client->tax_payer_email ?? 'unknown' }}</span>
                                <span id="header-phone" class="ms-md-2"><i class="ri-phone-line me-1"></i>{{ $client->phone_home ?? ($client->cell_home ?? 'unknown') }}</span>
                                <span class="ms-md-2"><i class="ri-refresh-line me-1"></i>{{ $client->updated_at ? \Carbon\Carbon::parse($client->updated_at)->diffForHumans() : 'unknown' }}</span>
                                <span class="ms-md-2" id="ssn-container">
                                    <i class="ri-fingerprint-line me-1"></i>
                                    <span class="ssn-masked">***-**-****</span>
                                    <span class="ssn-revealed" style="display: none;">{{ $client->ssn ?? 'unknown' }}</span>
                                    <i class="ri-eye-line ms-1" id="ssn-toggle" style="cursor: pointer;" data-bs-toggle="tooltip" title="Show/Hide SSN"></i>
                                </span>
                                @php
                                    $addressParts = array_filter([$client->address_1, $client->city, $client->state, $client->zipcode]);
                                    $fullAddress = !empty($addressParts) ? implode(', ', $addressParts) : 'unknown';
                                    $mapsQuery = urlencode($fullAddress);
                                @endphp
                                <a id="header-address" href="https://www.google.com/maps/search/?api=1&query={{ $mapsQuery }}" target="_blank" class="text-muted ms-md-2">
                                    <i class="ri-map-pin-line me-1"></i>{{ $fullAddress }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Stats Bar -->
                    <div class="client-stats-bar d-flex flex-wrap justify-content-lg-end align-items-center">
                        <div class="header-stat-item"><p>Pending Tasks</p><h5>{{ $pendingTasksCount ?? 0 }}</h5></div>
                        <div class="header-stat-item"><p>Deal</p><h5>${{ number_format($dealAmount ?? 0, 2) }}</h5></div>
                        <div class="tax-owed-info">
                            <p>Total Amount Owed</p>
                            @php
                                $summary = ['account_balance_plus_accruals' => 298772.12];
                                if (isset($accountTranscripts) && is_array($accountTranscripts)) {
                                    $summary['account_balance_plus_accruals'] = 0;
                                    foreach($accountTranscripts as $t) {
                                        if (isset($t['account_balance_plus_accruals']) && $t['account_balance_plus_accruals'] > 0) {
                                            $summary['account_balance_plus_accruals'] += $t['account_balance_plus_accruals'];
                                        }
                                    }
                                }
                            @endphp
                            <h5 class="{{ !$summary['account_balance_plus_accruals'] ? 'value-unknown' : ''}}">
                                {{ $summary['account_balance_plus_accruals'] ? '$' . number_format($summary['account_balance_plus_accruals'], 2) : 'Unknown' }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="client_idx" id="client_idx" value="{{$client->id}}">

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="clientProfileTabs" role="tablist">
             <li class="nav-item" role="presentation"><button class="nav-link active" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="true"><i class="ri-briefcase-4-line me-1"></i>Management</button></li>
             <li class="nav-item" role="presentation"><button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-tab-pane" type="button" role="tab" aria-controls="calendar-tab-pane" aria-selected="false"><i class="ri-calendar-2-line me-1"></i>Calendar</button></li>
             <li class="nav-item" role="presentation"><button class="nav-link" id="financials-placeholder-tab" data-bs-toggle="tab" data-bs-target="#financials-placeholder-tab-pane" type="button" role="tab" aria-controls="financials-placeholder-tab-pane" aria-selected="false"><i class="ri-bank-card-line me-1"></i>Financials</button></li>
             <li class="nav-item" role="presentation"><button class="nav-link" id="transcripts-tab" data-bs-toggle="tab" data-bs-target="#transcripts-tab-pane" type="button" role="tab" aria-controls="transcripts-tab-pane" aria-selected="false"><i class="ri-money-dollar-circle-line me-1"></i>Transcripts</button></li>
             <li class="nav-item" role="presentation"><button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-tab-pane" type="button" role="tab" aria-controls="documents-tab-pane" aria-selected="false"><i class="ri-folder-open-line me-1"></i>Documents</button></li>
        </ul>

        <!-- Tab Content Panes -->
        <div class="tab-content" id="clientProfileTabsContent">
            <div class="tab-pane fade show active" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">@include('client.partials.management-tab')</div>
            <div class="tab-pane fade" id="calendar-tab-pane" role="tabpanel" aria-labelledby="calendar-tab" tabindex="0"><h5 class="tab-pane-title">Calendar</h5><p>Calendar content will go here.</p></div>
            <div class="tab-pane fade" id="financials-placeholder-tab-pane" role="tabpanel" aria-labelledby="financials-placeholder-tab" tabindex="0"><h5 class="tab-pane-title">Financials</h5><p>Financials content will go here.</p></div>
            <div class="tab-pane fade" id="transcripts-tab-pane" role="tabpanel" aria-labelledby="transcripts-tab" tabindex="0">@include('client.partials.transcripts')</div>
            <div class="tab-pane fade" id="documents-tab-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">@include('client.partials.files')</div>
        </div>
      </div>


      <!-- =================================================================== -->
      <!-- ================   INICIO DEL MODAL DE EDICIÓN   ================== -->
      <!-- =================================================================== -->
      <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editClientModalLabel">Edit Client Profile</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="editClientForm">
                <!-- Campo oculto para el ID del cliente y token CSRF -->
                <input type="hidden" name="client_id" value="{{ $client->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                  <!-- Columna 1 -->
                  <div class="col-md-4">

                    <h6>Personal Information</h6>
                    <div class="mb-2">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $client->first_name ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="mi" class="form-label">Middle Initial (MI)</label>
                        <input type="text" class="form-control" id="mi" name="mi" value="{{ $client->mi ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $client->last_name ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="ssn" class="form-label">SSN</label>
                        <input type="text" class="form-control" id="ssn" name="ssn" value="{{ $client->ssn ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="date_birdth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_birdth" name="date_birdth" value="{{ $client->date_birdth ? \Carbon\Carbon::parse($client->date_birdth)->format('Y-m-d') : '' }}">
                    </div>
                    
                    
                    <h6>Physical Address</h6>
                     <div class="mb-2">
                        <label for="address_1" class="form-label">Address 1</label>
                        <input type="text" class="form-control" id="address_1" name="address_1" value="{{ $client->address_1 ?? '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ $client->city ?? '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{ $client->state ?? '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $client->zipcode ?? '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $client->country ?? '' }}">
                    </div>
                  </div>

                  <div class="col-md-4">

                                
                    <h6>Contact Information</h6>
                    <div class="mb-2">
                        <label for="phone_home" class="form-label">Phone Home</label>
                        <input type="tel" class="form-control" id="phone_home" name="phone_home" value="{{ $client->phone_home ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="cell_home" class="form-label">Cell Phone</label>
                        <input type="tel" class="form-control" id="cell_home" name="cell_home" value="{{ $client->cell_home ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="tax_payer_email" class="form-label">Tax Payer Email</label>
                        <input type="email" class="form-control" id="tax_payer_email" name="tax_payer_email" value="{{ $client->tax_payer_email ?? '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags" value="{{ $client->tags ?? '' }}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <h6>Marital & Spouse Information</h6>
                    <div class="mb-2">
                        <label for="marital_status" class="form-label">Marital Status</label>
                        <select class="form-select" id="marital_status" name="marital_status">
                            <option value="">Select Status</option>
                            <option value="1" {{ ($client->marital_status ?? '') == '1' ? 'selected' : '' }}>Single</option>
                            <option value="2" {{ ($client->marital_status ?? '') == '2' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="marital_date" class="form-label">Marital Date</label>
                        <input type="date" class="form-control" id="marital_date" name="marital_date" value="{{ $client->marital_date ? \Carbon\Carbon::parse($client->marital_date)->format('Y-m-d') : '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="spouse_first_name" class="form-label">Spouse First Name</label>
                        <input type="text" class="form-control" id="spouse_first_name" name="spouse_first_name" value="{{ $client->spouse_first_name ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="spouse_last_name" class="form-label">Spouse Last Name</label>
                        <input type="text" class="form-control" id="spouse_last_name" name="spouse_last_name" value="{{ $client->spouse_last_name ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="spouse_ssn" class="form-label">Spouse SSN</label>
                        <input type="text" class="form-control" id="spouse_ssn" name="spouse_ssn" value="{{ $client->spouse_ssn ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label for="spouse_date_birdth" class="form-label">Spouse Date of Birth</label>
                        <input type="date" class="form-control" id="spouse_date_birdth" name="spouse_date_birdth" value="{{ $client->spouse_date_birdth ? \Carbon\Carbon::parse($client->spouse_date_birdth)->format('Y-m-d') : '' }}">
                    </div>
                     <div class="mb-2">
                        <label for="spouse_email" class="form-label">Spouse Email</label>
                        <input type="email" class="form-control" id="spouse_email" name="spouse_email" value="{{ $client->spouse_email ?? '' }}">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" form="editClientForm" class="btn btn-primary" id="saveClientButton">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Save Changes
              </button>
            </div>
          </div>
        </div>
