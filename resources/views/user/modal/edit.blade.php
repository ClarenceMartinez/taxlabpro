<style>
   #edit-user.offcanvas {
    --bs-offcanvas-width: 50%;
  }
  /* En móviles (<768px): fullscreen */
  @media (max-width: 767.98px) {
    #edit-user.offcanvas {
      --bs-offcanvas-width: 100%;
    }
  }
  /* Para que sólo el body haga scroll si el contenido excede la altura */
  #edit-user .offcanvas-body {
    overflow-y: auto;
  }
</style>
<div class="offcanvas offcanvas-end bg-white" tabindex="-1" id="edit-user">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="exampleModalLabel">Edit User</h5>
              <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
              <form class="update-user-form pt-0 row g-3" method="post" name="form-update-user" id="form-update-user" onsubmit="return false">
               
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_id" id="_id" value="">

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="name"
                      name="name"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="name">Name</label>
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      readonly=""
                      type="text"
                      id="email"
                      name="email"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="email">Email</label>
                  </div>
                  <div id="xmail" class="d-none"><h6 class="text-danger">Ingresa un email valido</h6></div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="password"
                      id="password"
                      name="password"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="password">Password</label>
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="address"
                      name="address"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="address">Address</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="telephone"
                      name="telephone"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="telephone">Telephone</label>
                  </div>
                </div>

                @if(Auth::user()->type == 1)
                  <div class="col-12 col-md-6">
                    <div class="form-floating form-floating-outline">
                      <select id="company_id"
                        name="company_id"
                        class="form-select"
                        aria-label="Default select example">
                        <option value="0">Seleccione</option>
                        @foreach($companies as $company)
                          <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                      </select>
                      <label for="company_id">Company</label>
                    </div>
                  </div>
                @else
                  <input type="hidden" name="company_id" id="company_id" value="{{Auth::user()->company_id}}">
                @endif

                <div class="col-12 col-md-6">
                  <div class="form-floating form-floating-outline">
                    <select id="type"
                      name="type"
                      class="form-select"
                      aria-label="Default select example">
                      <option value="0">Seleccione</option>
                      <option value="1">Superadmin</option>
                      <option value="2">Admin</option>
                      <option value="3">User Staff</option>
                      <option value="4">Client</option>
                    </select>
                    <label for="type">Type</label>
                  </div>
                </div>

                

                <div class="col-12 col-md-6">
                  <div class="form-floating form-floating-outline">
                    <select id="status"
                      name="status"
                      class="form-select"
                      aria-label="Default select example">
                      <option value="0">Seleccione</option>
                      <option value="1">Activo</option>
                      <option value="2">Pending</option>
                    </select>
                    <label for="status">Status</label>
                  </div>
                </div>





                {{-- Time Zone --}}
                @php
                    // Obtiene sólo zonas de EE.UU.
                    $usTimezones = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, 'US');
                @endphp
                <div class="mb-3">
                  <label for="timezone" class="form-label">Time Zone</label>
                  <select name="timezone" id="timezone" class="form-select select2">
                    @foreach($usTimezones as $tz)
                      <option value="{{ $tz }}"
                        {{ old('timezone', $user->timezone ?? '') === $tz ? 'selected' : '' }}>
                        {{ $tz }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- Email Signature --}}
                <div class="mb-3">
                  <label for="email_signature" class="form-label">Email Signature</label>
                  <textarea name="email_signature" id="email_signature"
                    class="form-control" rows="3">{{ old('email_signature', $user->email_signature ?? '') }}</textarea>
                </div>









                {{-- ─── Sección: Tax & Licensing Fields ─── --}}
                <div class="row mb-4">
                  <div class="col-md-4 mb-3">
                    <label for="firm_ein" class="form-label">Firm EIN</label>
                    <input type="text" class="form-control" id="firm_ein" name="firm_ein"
                           value="{{ old('firm_ein', $user->firm_ein ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="caf_no" class="form-label">CAF No.</label>
                    <input type="text" class="form-control" id="caf_no" name="caf_no"
                           value="{{ old('caf_no', $user->caf_no ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="ptin" class="form-label">PTIN</label>
                    <input type="text" class="form-control" id="ptin" name="ptin"
                           value="{{ old('ptin', $user->ptin ?? '') }}">
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-md-4 mb-3">
                    <label for="ctec" class="form-label">CTEC</label>
                    <input type="text" class="form-control" id="ctec" name="ctec"
                           value="{{ old('ctec', $user->ctec ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="ny_tprin" class="form-label">NYTPRIN</label>
                    <input type="text" class="form-control" id="ny_tprin" name="ny_tprin"
                           value="{{ old('ny_tprin', $user->ny_tprin ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="designation" class="form-label">Designation</label>
                    <select class="form-select" id="designation" name="designation">
                      <option value="">– Seleccione –</option>
                      
                      @foreach($designations as $option)
                        <option value="{{ $option->code }}">
                          {{ $option->description }}
                        </option>
                      @endforeach
                      {{-- otras opciones aquí --}}
                    </select>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-4 mb-3">
                    <label for="licensing_jurisdiction" class="form-label">Licensing/Jurisdiction</label>
                    <input type="text" class="form-control" id="licensing_jurisdiction" name="licensing_jurisdiction"
                           value="{{ old('licensing_jurisdiction', $user->licensing_jurisdiction ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="license_no" class="form-label">License No.</label>
                    <input type="text" class="form-control" id="license_no" name="license_no"
                           value="{{ old('license_no', $user->license_no ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="a2a" class="form-label">A2A Full User ID</label>
                    <input type="text" class="form-control" id="a2a" name="a2a"
                           value="{{ old('a2a', $user->a2a ?? '') }}">
                  </div>
                </div>
                {{-- ────────────────────────────────────────── --}}

                <h6 class="mt-4">Power of Attorney Defaults For Individuals</h6>

                {{-- Primer set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa1_description" class="form-label">Description</label>
                    <input type="text" name="poa1_description" id="poa1_description"
                      class="form-control"
                      value="{{ old('poa1_description', $user->poa1_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa1_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa1_form_number" id="poa1_form_number"
                      class="form-control"
                      value="{{ old('poa1_form_number', $user->poa1_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa1_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa1_period" id="poa1_period"
                      class="form-control"
                      value="{{ old('poa1_period', $user->poa1_period ?? '') }}">
                  </div>
                </div>

                {{-- Segundo set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa2_description" class="form-label">Description</label>
                    <input type="text" name="poa2_description" id="poa2_description"
                      class="form-control"
                      value="{{ old('poa2_description', $user->poa2_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa2_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa2_form_number" id="poa2_form_number"
                      class="form-control"
                      value="{{ old('poa2_form_number', $user->poa2_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa2_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa2_period" id="poa2_period"
                      class="form-control"
                      value="{{ old('poa2_period', $user->poa2_period ?? '') }}">
                  </div>
                </div>

                {{-- tercer set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa3_description" class="form-label">Description</label>
                    <input type="text" name="poa3_description" id="poa3_description"
                      class="form-control"
                      value="{{ old('poa3_description', $user->poa3_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa3_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa3_form_number" id="poa3_form_number"
                      class="form-control"
                      value="{{ old('poa3_form_number', $user->poa3_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa3_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa3_period" id="poa3_period"
                      class="form-control"
                      value="{{ old('poa3_period', $user->poa3_period ?? '') }}">
                  </div>
                </div>







                <h6 class="mt-4">Power of Attorney Defaults For Businesses</h6>

                {{-- Primer set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus1_description" class="form-label">Description</label>
                    <input type="text" name="poa_bus1_description" id="poa_bus1_description"
                      class="form-control"
                      value="{{ old('poa_bus1_description', $user->poa_bus1_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus1_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa_bus1_form_number" id="poa_bus1_form_number"
                      class="form-control"
                      value="{{ old('poa_bus1_form_number', $user->poa_bus1_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus1_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa_bus1_period" id="poa_bus1_period"
                      class="form-control"
                      value="{{ old('poa_bus1_period', $user->poa_bus1_period ?? '') }}">
                  </div>
                </div>

                {{-- Segundo set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus2_description" class="form-label">Description</label>
                    <input type="text" name="poa_bus2_description" id="poa_bus2_description"
                      class="form-control"
                      value="{{ old('poa_bus2_description', $user->poa_bus2_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus2_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa_bus2_form_number" id="poa_bus2_form_number"
                      class="form-control"
                      value="{{ old('poa_bus2_form_number', $user->poa_bus2_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus2_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa_bus2_period" id="poa_bus2_period"
                      class="form-control"
                      value="{{ old('poa_bus2_period', $user->poa_bus2_period ?? '') }}">
                  </div>
                </div>

                {{-- tercer set --}}
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus3_description" class="form-label">Description</label>
                    <input type="text" name="poa_bus3_description" id="poa_bus3_description"
                      class="form-control"
                      value="{{ old('poa_bus3_description', $user->poa_bus3_description ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus3_form_number" class="form-label">Tax Form Number</label>
                    <input type="text" name="poa_bus3_form_number" id="poa_bus3_form_number"
                      class="form-control"
                      value="{{ old('poa_bus3_form_number', $user->poa_bus3_form_number ?? '') }}">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="poa_bus3_period" class="form-label">Year(s) or Period(s)</label>
                    <input type="text" name="poa_bus3_period" id="poa_bus3_period"
                      class="form-control"
                      value="{{ old('poa_bus3_period', $user->poa_bus3_period ?? '') }}">
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" id="btn-save" data-form="form-update-user" class="btn btn-primary data-submit me-sm-4 me-1">Update</button>
                  <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
              </form>
              </div>
            </div>
          </div>