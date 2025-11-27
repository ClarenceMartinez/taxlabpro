@extends('components.layout')
@section('content')
  <div class="row g-6 mb-12">
    <div class="col-12">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token" >
      <!-- Role Table -->
      <div class="card">
          <!-- DataTable with Buttons -->
          <div class="card border-none">
            <div class="card-datatable table-responsive pt-0">
              <table class="datatables-basic table table-bordered">
                
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
      <!--/ Role Table -->
    </div>
  </div>
</div>
@endsection

@include('company.modal.new')
@include('company.modal.edit')

@section('scripts')
    @include('company.js-company-datatables')

      @section('scripts')
          @include('company.js-company-datatables')
      @endsection
@endsection