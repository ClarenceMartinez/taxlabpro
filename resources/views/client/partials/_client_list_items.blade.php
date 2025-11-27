{{-- resources/views/client/partials/_client_list_items.blade.php --}}
@forelse($clients as $client_item)
    @php
        $statusMap = [
            1 => ['text' => 'Unknown', 'class' => 'bg-secondary', 'slug' => 'unknown', 'bg_class' => 'status-bg-unknown'],
            2 => ['text' => 'Open', 'class' => 'bg-success', 'slug' => 'open', 'bg_class' => 'status-bg-open'],
            3 => ['text' => 'Closed', 'class' => 'bg-dark', 'slug' => 'closed', 'bg_class' => 'status-bg-closed'],
            4 => ['text' => 'In Progress', 'class' => 'bg-info', 'slug' => 'in-progress', 'bg_class' => 'status-bg-in-progress'],
            5 => ['text' => 'On Hold', 'class' => 'bg-warning', 'slug' => 'on-hold', 'bg_class' => 'status-bg-on-hold'],
        ];
        $statusKey = (int)($client_item->case_status ?? 1);
        $statusInfo = $statusMap[$statusKey] ?? $statusMap[1];

        // [MODIFIED] Build a detailed, formatted HTML tooltip
        $tooltipContent = "<div class='text-start p-1'>"
            . "<strong>" . e($client_item->first_name) . " " . e($client_item->last_name) . "</strong>"
            . "<hr class='my-1 border-secondary'>"
            . "<div><span class='fw-semibold'>Status:</span> " . e($statusInfo['text']) . "</div>"
            . "<div><span class='fw-semibold'>Updated:</span> " . e($client_item->updated_at->diffForHumans()) . "</div>"
            . "<div><span class='fw-semibold'>Form:</span> " . e($client_item->form_type ?? 'N/A') . "</div>"
            . "<div><span class='fw-semibold'>Deal:</span> $" . number_format($client_item->deal ?? 0, 0) . "</div>"
            . "<div><span class='fw-semibold'>Owed:</span> $" . number_format($client_item->owed ?? 0, 0) . "</div>"
            . "</div>";
    @endphp

    <!-- [MODIFIED] The container now has data-bs-html="true" and the new formatted title -->
    <div class="client-list-item {{ ($client_id_active == $client_item->id) ? 'active' : '' }} {{ $statusInfo['bg_class'] }}"
         data-client-id="{{ $client_item->id }}"
         data-bs-toggle="tooltip"
         data-bs-placement="right"
         data-bs-html="true"
         data-bs-title="{{ $tooltipContent }}">

        <!-- 1. Status Column (Visually hidden in item, kept for structure) -->
        <div class="col-status"></div>

        <!-- 2. Client Info -->
        <div class="col-client">
            <a href="{{ route('clients.index', ['id' => $client_item->id]) }}"
               class="client-link-action d-flex align-items-center gap-3 text-decoration-none"
               data-client-id="{{ $client_item->id }}">
                
                <img src="/assets/img/avatars/{{ $client_item->avatar ?? '3' }}.png"
                     alt="{{ $client_item->first_name }}" class="client-list-item-avatar">
                
                <div class="client-list-item-info">
                    <h6>{{ $client_item->first_name }} {{ $client_item->last_name }}</h6>
                    <p class="client-list-item-type">{{ $client_item->form_type ?? 'N/A' }}</p>
                    <p class="client-list-item-state-simple">
                        {{ $client_item->form_type ?? 'N/A' }} • {{ $client_item->updated_at->diffForHumans() }} 
                    </p>
                </div>
            </a>
        </div>

        <!-- 3. Financial Columns -->
        <div class="col-owed" data-value="{{ $client_item->owed ?? 0 }}"><span>${{ number_format($client_item->owed ?? 0, 0) }}</span></div>
        <div class="col-deal" data-value="{{ $client_item->deal ?? 0 }}"><span>${{ number_format($client_item->deal ?? 0, 0) }}</span></div>
        <div class="col-updated"><span>{{ $client_item->updated_at->diffForHumans() }}</span></div>

        <!-- 4. Data Columns (Reordered) -->
        <div class="col-ssn"><span>{{ $client_item->ssn ?? 'N/A' }}</span></div>

        <!-- [MOVED] Email now comes after SSN -->
        <div class="col-tax_payer_email">
            @if($client_item->tax_payer_email)
                <a href="mailto:{{ $client_item->tax_payer_email }}">{{ $client_item->tax_payer_email }}</a>
            @else
                <span>N/A</span>
            @endif
        </div>
        
        <div class="col-phone_home">
            @if($client_item->phone_home)
                <a href="tel:{{ $client_item->phone_home }}">{{ $client_item->phone_home }}</a>
            @else
                <span>N/A</span>
            @endif
        </div>
        
        <div class="col-cell_home">
            @if($client_item->cell_home)
                <a href="tel:{{ $client_item->cell_home }}">{{ $client_item->cell_home }}</a>
            @else
                <span>N/A</span>
            @endif
        </div>

        <div class="col-city"><span>{{ $client_item->city ?? 'N/A' }}</span></div>
        <div class="col-marital_status"><span>{{ $client_item->marital_status ?? 'N/A' }}</span></div>
    </div>
@empty
    <div class="p-4 text-center text-muted">
        <i class="ri-user-search-line fs-3 d-block mb-2"></i>
        <p class="mb-0">No clients found for this user.</p>
    </div>
@endforelse