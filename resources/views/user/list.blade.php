@extends('components.layout')
@section('content')
    <div class="row g-6 mb-12">
      <div class="col-12">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token" >
        <!-- Role Table -->
        <div class="card">
          <div class="container-xxl flex-grow-1 container-p-y">
            <!-- DataTable with Buttons -->
            <div class="card border-none">
              <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Company</th>
                      <th>Email</th>
                      <th>Type</th>
                      <th>Fecha Registro</th>
                      <th>Action</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!--/ Role Table -->
        </div>
      </div>
    </div>
@endsection

@include('user.modal.new')
@include('user.modal.edit')

@section('scripts')
    @include('user.js-users-datatables')

      @section('scripts')
          @include('user.js-users-datatables')
      @endsection
@endsection
<!-- <script src="{{ asset('assets/js/users/js-users.datatables.js') }}"></script> -->