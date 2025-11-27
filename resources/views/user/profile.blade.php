@extends('components.layout')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/toastr/toastr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">

<!-- Page CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endsection
@section('content')

  <div class="row g-6 mb-12">
                <div class="col-12">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token" >
                    <div class="card mb-6">
                      <div class="user-profile-header-banner">
                        <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                      </div>
                      <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-5">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                          <img
                            src="../../assets/img/avatars/{{$info->image}}"
                            alt="user image"
                            class="d-block h-auto ms-0 ms-sm-5 rounded-4 user-profile-img" />
                        </div>
                        <div class="flex-grow-1 mt-4 mt-sm-12">
                          <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-6">
                            <div class="user-profile-info">
                              <h4 class="mb-2">{{$info->name;}}</h4>
                              <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4">
                                <li class="list-inline-item">
                                  <i class="ri-palette-line me-2 ri-24px"></i><span class="fw-medium">UX Designer</span>
                                </li>
                                <li class="list-inline-item">
                                  <i class="ri-map-pin-line me-2 ri-24px"></i><span class="fw-medium">Vatican City</span>
                                </li>
                                <li class="list-inline-item">
                                  <i class="ri-calendar-line me-2 ri-24px"></i
                                  ><span class="fw-medium"> Joined April 2021</span>
                                </li>
                              </ul>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary">
                              <i class="ri-user-follow-line ri-16px me-2"></i>Connected
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

              <!--/ Navbar pills -->

              <!-- User Profile Content -->
              <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5">
                  <!-- About User -->
                  <div class="card mb-6">
                    <div class="card-body">
                      <small class="card-text text-uppercase text-muted small">About</small>
                      <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Full Name:</span>
                          <span>John Doe</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-check-line ri-24px"></i><span class="fw-medium mx-2">Status:</span>
                          <span>Active</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-star-smile-line ri-24px"></i><span class="fw-medium mx-2">Role:</span>
                          <span>Developer</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-flag-2-line ri-24px"></i><span class="fw-medium mx-2">Country:</span>
                          <span>USA</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <i class="ri-translate-2 ri-24px"></i><span class="fw-medium mx-2">Languages:</span>
                          <span>English</span>
                        </li>
                      </ul>
                      <small class="card-text text-uppercase text-muted small">Contacts</small>
                      <ul class="list-unstyled my-3 py-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-phone-line ri-24px"></i><span class="fw-medium mx-2">Contact:</span>
                          <span>(123) 456-7890</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-wechat-line ri-24px"></i><span class="fw-medium mx-2">Skype:</span>
                          <span>john.doe</span>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <i class="ri-mail-open-line ri-24px"></i><span class="fw-medium mx-2">Email:</span>
                          <span>john.doe@example.com</span>
                        </li>
                      </ul>
                      <small class="card-text text-uppercase text-muted small">Teams</small>
                      <ul class="list-unstyled mb-0 mt-3 pt-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-github-line ri-24px text-body me-2"></i>
                          <div class="d-flex flex-wrap">
                            <span class="fw-medium me-2">Backend Developer</span><span>(126 Members)</span>
                          </div>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class="ri-reactjs-line ri-24px text-body me-2"></i>
                          <div class="d-flex flex-wrap">
                            <span class="fw-medium me-2">React Developer</span><span>(98 Members)</span>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!--/ About User -->
                  <!-- Profile Overview -->
                  <div class="card mb-6">
                    <div class="card-body">
                      <small class="card-text text-uppercase text-muted small">Overview</small>
                      <ul class="list-unstyled mb-0 mt-3 pt-1">
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-check-line ri-24px"></i><span class="fw-medium mx-2">Task Compiled:</span>
                          <span>13.5k</span>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                          <i class="ri-user-3-line ri-24px"></i><span class="fw-medium mx-2">Projects Compiled:</span>
                          <span>146</span>
                        </li>
                        <li class="d-flex align-items-center">
                          <i class="ri-star-smile-line ri-24px"></i><span class="fw-medium mx-2">Connections:</span>
                          <span>897</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!--/ Profile Overview -->
                </div>
                <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="row g-6">
                          @foreach($clients as $client)
                          <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="card">
                              <div class="card-body text-center">
                                <div class="dropdown btn-pinned">
                                  <button type="button" class="btn dropdown-toggle hide-arrow p-4" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-line ri-22px text-muted"></i>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item waves-effect" href="{{route('clients.detail', $client->client_id)}}">Show Detail</a></li>
                                    
                                  </ul>
                                </div>
                                <div class="mx-auto my-6">
                                  <img src="../../assets/img/avatars/{{$client->image}}" alt="Avatar Image" class="rounded-circle w-px-100">
                                </div>
                                <h5 class="mb-0 card-title">{{$client->client_full_name}}</h5>
                                <span>{{$client->city}}</span>
                                <hr class="dropdown-divider">
                                

                                <div class="d-flex align-items-center justify-content-around mb-6 my-6 gap-2">
                                  <div>
                                    <h5 class="mb-0">{{$client->total_files}}</h5>
                                    <span>Files</span>
                                  </div>
                                  <div>
                                    <h5 class="mb-0">{{$client->total_notes}}</h5>
                                    <span>Notes</span>
                                  </div>
                                  <div>
                                    <h5 class="mb-0">{{$client->total_activities}}</h5>
                                    <span>Activities</span>
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                          </div>

                          @endforeach
                        </div>



                </div>
              </div>




            </div>
@endsection



<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/forms-file-upload.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
<script src="{{asset('assets/vendor/libs/toastr/toastr.js')}}"></script>

@section('scripts')
    <!-- @include('client.js-client-datatable') -->

<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src="{{asset('assets/js/pages-profile-user.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sortablejs/sortable.js')}}"></script><!-- 
<script src="{{asset('assets/js/cards-actions.js')}}"></script> -->
  @include('client.js-cards-actions')

@endsection
