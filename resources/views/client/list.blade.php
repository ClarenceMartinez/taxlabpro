@section('styles')
<style type="text/css">
  #table-list-client{}
  #table-list-client th, #table-list-client td{padding: 5px;}
</style>
@endsection
@extends('components.layout')
@section('content')



    <!-- Invoice List Table -->
              <div class="card">
                <div class="card-datatable table-responsive p-2">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token" >
                  <table class="datatables-basic table" id="table-list-client">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Company Name</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Service Offered</th>
                          <th>City</th>
                          <th>Phone</th>
                          <th>Form Type</th>
                          <th>Asign To</th>
                          <th>Status</th>
                          <th>Case Status</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                </div>
              </div>


  
@endsection
@include('client.modal.new')
@include('client.modal.profile')
@include('client.modal.catalog-services')
@include('client.modal.asign-user-to-client')

@section('scripts')
    @include('client.js-client-datatable')
    @include('client.js-profile')
    @include('client.js.js-update-service-client')
@endsection
