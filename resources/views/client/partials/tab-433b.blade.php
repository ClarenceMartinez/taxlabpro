<div class="card text-center mb-4 d-none" id="tabform433b">
  <div class="card-header p-0">
    <div class="nav-align-top">
      <ul class="nav nav-tabs" role="tablist">
        
        
          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#433b-navs-home-card" aria-controls="433b-navs-home-card" aria-selected="true">
              <i class="ri-user-settings-line"></i> Business Info
            </button>

          </li>
          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#433b-navs-financial-info" aria-controls="433b-navs-financial-info" aria-selected="false" tabindex="-1">
              <i class="ri-money-dollar-circle-line"></i> Financial Info
            </button>

            
          </li>
          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#433b-navs-assets-liabilities" aria-controls="433b-navs-assets-liabilities" aria-selected="false" tabindex="-1">
              <i class="ri-bank-line"></i> Assets & Liabilities
            </button>

          </li>
         
          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#433b-navs-income-expenses" aria-controls="433b-navs-income-expenses" aria-selected="false" tabindex="-1">
              <i class="ri-scales-line"></i> Income & Expense
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sumary-card" aria-controls="navs-sumary-card" aria-selected="false" tabindex="-1">
              <i class="ri-list-check-3"></i> Sumary
            </button>
          </li>
      
      <span class="tab-slider" style="left: 184.609px; width: 121.328px; bottom: 0px;"></span></ul>
    </div>
  </div>
  <div class="card-body">
    <div class="tab-content pb-0 pt-0">
      
      @include('client.partials.433b-business-information')
      @include('client.partials.433b-financial-information')
      @include('client.partials.433b-assets-libiliaties')
      @include('client.partials.433b-income-expense')
    </div>
  </div>
</div>