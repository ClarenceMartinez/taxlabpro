<div class="card text-center mb-4 d-none" id="tabform433a">
  <div class="card-header taby p-0">
    <div class="nav-align-top">
      <ul class="nav nav-tabs" role="tablist">
        

        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-home-card" aria-controls="navs-home-card" aria-selected="true">
            <i class="ri-user-settings-line"></i> Personal & Emp
          </button>

        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profile-card" aria-controls="navs-profile-card" aria-selected="false" tabindex="-1">
            <i class="ri-money-dollar-circle-line"></i> Other Financial
          </button>

          
        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-messages-card" aria-controls="navs-messages-card" aria-selected="false" tabindex="-1">
            <i class="ri-bank-line"></i> Bank & Investment
          </button>

        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-real-state-card" aria-controls="navs-real-state-card" aria-selected="false" tabindex="-1">
            <i class="ri-community-line"></i> Real Estate & Auto
          </button>

        </li>
        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-self-employed-card" aria-controls="navs-self-employed-card" aria-selected="false" tabindex="-1">
            <i class="ri-shake-hands-fill"></i> Self Employed
          </button>

        </li>

        <li class="nav-item" role="presentation">
          <button type="button" class="nav-link d-flex flex-column gap-1 waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-encome-expense-card" aria-controls="navs-encome-expense-card" aria-selected="false" tabindex="-1">
            <i class="ri-scales-line"></i> Encome & Expense
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
      
      @include('client.partials.personal-emp')
      @include('client.partials.other-financial')
      @include('client.partials.bank-investment')
      @include('client.partials.real-state')
      @include('client.partials.self-employed')
      @include('client.partials.encome-expense')
    </div>
  </div>
</div>