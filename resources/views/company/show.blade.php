@extends('components.layout')
@section('content')



  <div class="container-fluid">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-lg-3 mb-4">
      <div class="card">
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action active">
            Personal Info 
          </a>
          <a href="#" class="list-group-item list-group-item-action">Working Status</a>
          <a href="#" class="list-group-item list-group-item-action">Notifications</a>
          <a href="#" class="list-group-item list-group-item-action">Language & Region</a>
          <a href="#" class="list-group-item list-group-item-action">Password</a>
          <a href="#" class="list-group-item list-group-item-action">Session History</a>
        </div>
      </div>
    </div>

    {{-- Main profile card --}}
    <div class="col-lg-9">
      <div class="card mb-4">
        <div class="row g-0 align-items-center">
          {{-- Avatar --}}
          <div class="col-md-2 text-center p-4">
            <img src="{{ $company->logo_url ?? asset('images/default-company.png') }}"
                 class="rounded-circle img-fluid" alt="Logo">
          </div>
          {{-- Name y badge --}}
          <div class="col-md-5">
            <div class="card-body">
              <h3 class="card-title">{{ $company->name }}</h3>
              <span class="badge bg-primary">Admin</span>
            </div>
          </div>
          {{-- Contact info --}}
          <div class="col-md-5">
            <div class="card-body">
              <p class="mb-2"><i class="bi bi-envelope"></i> {{ $company->email }}</p>
              <p class="mb-2"><i class="bi bi-telephone"></i> {{ $company->phone }}</p>
              <p class="mb-2"><i class="bi bi-phone"></i> {{ $company->mobile }}</p>
              <p class="mb-0"><i class="bi bi-geo-alt"></i> {{ $company->city }}</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Secondary cards --}}
      <div class="row gx-3">
        {{-- Izquierda: detalles extra --}}
        <div class="col-md-6 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-skype"></i> Skype</h5>
              <p class="text-muted">Add a Skype</p>
              <hr>
              <h5 class="card-title"><i class="bi bi-calendar"></i> Birthday</h5>
              <p class="text-muted">Add a birthday</p>
              <hr>
              <h5 class="card-title"><i class="bi bi-calendar-check"></i> Work anniversary</h5>
              <p class="text-muted">Add a work anniversary</p>
            </div>
          </div>
        </div>

        {{-- Derecha: CTA --}}
        <div class="col-md-6 mb-3">
          <div class="card h-100 text-center">
            <div class="card-body d-flex flex-column justify-content-center">
              <img src="{{ asset('images/teambuilding-illustration.svg') }}"
                   class="img-fluid mb-3" alt="Create & join teams">
              <h5 class="card-title">Create and join teams</h5>
              <p class="card-text text-muted">
                Collaborate better with teammates and keep track of projects you’re interested in.
              </p>
              <a href="#" class="btn btn-outline-primary mt-auto">Explore teams</a>
            </div>
          </div>
        </div>
      </div> {{-- /row --}}
    </div> {{-- /col-lg-9 --}}
  </div> {{-- /row --}}
</div>
@endsection