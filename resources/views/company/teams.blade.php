@extends('components.layout')
@section('content')
    <div class="row g-6 mb-12">
      <div class="col-12">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token" >
        <input type="hidden" name="company_reference_id" value="{{$company->id}}" id="company_reference_id" >
        <!-- Role Table -->
          <div class="container-xxl flex-grow-1 container-p-y">



	          	<div class="row">
	                <div class="col-md-12">


			          	<div class="nav-align-top">
				            <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
				              <li class="nav-item">
				                <a class="nav-link" href="{{route('company.account', ['hash' => $hash])}}"
				                  ><i class="ri-group-line me-2"></i>Account</a
				                >
				              </li>
				              <li class="nav-item">
				                <a class="nav-link active" href="{{route('company.teams', ['hash' => $hash])}}"
				                  ><i class="ri-bookmark-line me-2"></i>Teams</a
				                >
				              </li>
				              <!-- <li class="nav-item">
				                <a class="nav-link" href="{{route('company.bills', ['hash' => $hash])}}"
				                  ><i class="ri-bookmark-line me-2"></i>Billing & Plans</a
				                >
				              </li>
				              <li class="nav-item">
				                <a class="nav-link" href="{{route('company.notifications', ['hash' => $hash])}}"
				                  ><i class="ri-notification-4-line me-2"></i>Notifications</a
				                >
				              </li>
				              <li class="nav-item">
				                <a class="nav-link" href="{{route('company.connections', ['hash' => $hash])}}"
				                  ><i class="ri-link-m me-2"></i>Connections</a
				                >
				              </li> -->
				            </ul>
				        </div>

				        <div class="row g-6 mb-6">
                      <div class="col-sm-6 col-xl-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="me-1">
                                <p class="text-heading mb-1">Session</p>
                                <div class="d-flex align-items-center">
                                  <h4 class="mb-1 me-2">21,459</h4>
                                  <p class="text-success mb-1">(+29%)</p>
                                </div>
                                <small class="mb-0">Total Users</small>
                              </div>
                              <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                  <div class="ri-group-line ri-26px"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xl-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="me-1">
                                <p class="text-heading mb-1">Paid Users</p>
                                <div class="d-flex align-items-center">
                                  <h4 class="mb-1 me-1">4,567</h4>
                                  <p class="text-success mb-1">(+18%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                              </div>
                              <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded-3">
                                  <div class="ri-user-add-line ri-26px"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xl-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="me-1">
                                <p class="text-heading mb-1">Active Users</p>
                                <div class="d-flex align-items-center">
                                  <h4 class="mb-1 me-1">19,860</h4>
                                  <p class="text-danger mb-1">(-14%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                              </div>
                              <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded-3">
                                  <div class="ri-user-follow-line ri-26px"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xl-3">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <div class="me-1">
                                <p class="text-heading mb-1">Pending Users</p>
                                <div class="d-flex align-items-center">
                                  <h4 class="mb-1 me-1">237</h4>
                                  <p class="text-success mb-1">(+42%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                              </div>
                              <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded-3">
                                  <div class="ri-user-search-line ri-26px"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

				        	<div class="card">
				        		
				        	
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
			        </div>
			    </div>

          </div>
          <!--/ Role Table -->
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