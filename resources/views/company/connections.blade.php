@extends('components.layout')
@section('content')
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
                        <a class="nav-link" href="{{route('company.teams', ['hash' => $hash])}}"
                          ><i class="ri-bookmark-line me-2"></i>Teams</a
                        >
                      </li>
                      <li class="nav-item">
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
                        <a class="nav-link active" href="{{route('company.connections', ['hash' => $hash])}}"
                          ><i class="ri-link-m me-2"></i>Connections</a
                        >
                      </li>
                    </ul>
                  </div>
                  

                  <div class="card">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="card-header mb-1">
                          <h5 class="mb-1">Connected Accounts</h5>
                          <p class="mb-0 card-subtitle mt-0">
                            Display content from your connected accounts on your site
                          </p>
                        </div>
                        <!-- Connections -->
                        <div class="card-body">
                          <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                              <img
                                src="../../assets/img/icons/brands/gcalendar.png"
                                alt="google"
                                class="me-4"
                                height="32" />
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                              <div class="mb-sm-0 mb-2">
                                <h6 class="mb-0">Google Calendar</h6>
                                <small>Calendar and contacts</small>
                              </div>
                              <div class="text-end">
                                <div class="form-check form-switch mb-0">
                                  <input type="checkbox" class="form-check-input" checked />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                              <img
                                src="../../assets/img/icons/brands/gmail.png"
                                alt="google"
                                class="me-4"
                                height="32" />
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                              <div class="mb-sm-0 mb-2">
                                <h6 class="mb-0">Google Gmail</h6>
                                <small>Google Login, Gmail and contacts</small>
                              </div>
                              <div class="text-end">
                                <div class="form-check form-switch mb-0">
                                  <input type="checkbox" class="form-check-input" checked />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                              <img
                                src="../../assets/img/icons/brands/gmaps.png"
                                alt="google"
                                class="me-4"
                                height="32" />
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                              <div class="mb-sm-0 mb-2">
                                <h6 class="mb-0">Google Maps</h6>
                                <small>Maps & ubications</small>
                              </div>
                              <div class="text-end">
                                <div class="form-check form-switch mb-0">
                                  <input type="checkbox" class="form-check-input" checked />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex mb-4 align-items-center">
                            <div class="flex-shrink-0">
                              <img
                                src="../../assets/img/icons/brands/microsoft-login.png"
                                alt="google"
                                class="me-4"
                                height="32" />
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                              <div class="mb-sm-0 mb-2">
                                <h6 class="mb-0">Microsoft Outlook</h6>
                                <small>Login & Calendar</small>
                              </div>
                              <div class="text-end">
                                <div class="form-check form-switch mb-0">
                                  <input type="checkbox" class="form-check-input" checked />
                                </div>
                              </div>
                            </div>
                          </div>

                          

                        </div>
                      </div>
                      
                    </div>
                  </div>



                </div>
              </div>
            </div> 
@endsection

@section('scripts')
    @include('company.js-company-datatables')

      @section('scripts')
          @include('company.js-company-datatables')
      @endsection
@endsection