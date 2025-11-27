<div class="offcanvas offcanvas-end bg-white" id="add-new-record">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title" id="exampleModalLabel">New Client</h5>
      <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
      <form class="add-new-record pt-0 row g-3" method="post" name="form-add-new-record" id="form-add-new-record" onsubmit="return false">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" id="id" value="0">

        <div class="col-12 col-md-5">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="first_name"
              name="first_name"
              class="form-control"
              value=""
              placeholder="" />
            <label for="first_name">First Name</label>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="mi"
              name="mi"
              class="form-control"
              value=""
              placeholder="" />
            <label for="mi">MI</label>
          </div>
        </div>
        <div class="col-12 col-md-5">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="last_name"
              name="last_name"
              class="form-control"
              value=""
              placeholder="" />
            <label for="last_name">Last Name</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="ssn"
              name="ssn"
              class="form-control"
              value=""
              placeholder="" />
            <label for="ssn">SSN/TIN</label>
          </div>
        </div>

        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
            <input
              type="date"
              id="date_birth"
              name="date_birth"
              class="form-control"
              value=""
              placeholder="" />
            <label for="date_birth">Date Birdth</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="dl"
              name="dl"
              class="form-control"
              value=""
              placeholder="" />
            <label for="dl">DL #</label>
          </div>
        </div>

        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
              <select
              id="dl_state"
              name="dl_state"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Active</option>
              <option value="2">Inactive</option>
              <option value="3">Suspended</option>
            </select>
            <label for="dl_state">DL State</label>
          </div>
        </div>

        <div class="col-12 col-md-5">
          <div class="form-floating form-floating-outline">
              <select
              id="has_passport"
              name="has_passport"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Active</option>
              <option value="2">Inactive</option>
              <option value="3">Suspended</option>
            </select>
            <label for="has_passport">Has Passport</label>
          </div>
        </div>
        <div class="col-12 col-md-7">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="client_reference"
              name="client_reference"
              class="form-control"
              value=""
              placeholder="" />
            <label for="client_reference">Client Reference / ID</label>
          </div>
        </div>

        <div class="col-12 col-md-6 d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="saludation_for_letter"
              name="saludation_for_letter"
              class="form-control"
              value="-"
              placeholder="" />
            <label for="saludation_for_letter">Saludation for Letters</label>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="form-floating form-floating-outline">
            <select class="form-select" name="form_type" id="form_type">
              <option value="">Select</option>
              <option value="433A">433A</option>
              <option value="433A OIC">433A OIC</option>
              <option value="433B">433B</option>
              <option value="433B OIC">433B OIC</option>
            </select>
            <label for="form_type">Form Type</label>
          </div>
        </div>

        <div class="col-12">
          <div class="">
            <span for="editBillingAddress" class="text-heading">Link to Sole Proprietorship Business</span>
            <p>
              <a href="javascript:;">MLF Landscaping</a>
              <a href="javascript:;" class="btn btn-primary waves-effect waves-light">Unlink</a>
            </p>
          </div>
        </div>
        <hr>
        <div class="col-12">
          <div class="row">
            <div class="col-4">
              <span class="h5">Home Address</span>
              
            </div>
              <div class="col-8">
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="type_address" class="form-check-input" type="radio" value="1" id="type_address-home" checked="">
                        <label class="form-check-label" for="type_address-home">Domestic</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="type_address" class="form-check-input" type="radio" value="2" id="type_address-office">
                        <label class="form-check-label" for="type_address-office">
                          International
                        </label>
                      </div>
                    </div>
              </div>
          </div>
        </div>
          


        <div class="col-12 col-md-12">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="address_1"
              name="address_1"
              class="form-control"
              value=""
              placeholder="" />
            <label for="address_1">Address 1</label>
          </div>
        </div>
        <div class="col-12 col-md-12">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="address_2"
              name="address_2"
              class="form-control"
              value=""
              placeholder="" />
            <label for="address_2">Address 2</label>
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="city"
              name="city"
              class="form-control modal-edit-tax-id"
              placeholder="123 456 7890" />
            <label for="city">City</label>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
            <select
              id="state"
              name="state"
              class="form-select"
              aria-label="Default select example">
              <option value="0" selected="">Select</option>
              @foreach($states_of_america as $state)
                <option value="{{$state->id}}">{{$state->abrev}}</option>
              @endforeach
            </select>
            <label for="state">State</label>
          </div>
        </div>

        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="zipcode"
              name="zipcode"
              class="form-control modal-edit-tax-id"
              placeholder="123 456 7890" />
            <label for="zipcode">ZipCode</label>
          </div>
        </div>

        <div class="col-12 col-md-2">
          <div class="form-floating form-floating-outline">
            <select
              id="country"
              name="country"
              class="form-select"
              aria-label="Default select example">
              <option value="0" selected> -- </option>
              <option value="1">United States of America</option>
            </select>
            <label for="country">Country</label>
          </div>
        </div>

        <hr class="d-none">
        <div class="col-12 d-none">
          <div class="row">
            <div class="col-12">
              <span class="h5">Mailing Address (If Different)</span>
            </div>
          </div>
        </div>
          
        <div class="col-12 col-md-12 d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="m_address_1"
              name="m_address_1"
              class="form-control"
              value=""
              placeholder="" />
            <label for="m_address_1">Address 1</label>
          </div>
        </div>
        <div class="col-12 col-md-12 d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="m_address_2"
              name="m_address_2"
              class="form-control"
              value=""
              placeholder="" />
            <label for="m_address_2">Address 2</label>
          </div>
        </div>
        <div class="col-12 col-md-3 d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="m_city"
              name="m_city"
              class="form-control modal-edit-tax-id"
              placeholder="123 456 7890" />
            <label for="m_city">City</label>
          </div>
        </div>
        <div class="col-12 col-md-2 d-none">
          <div class="form-floating form-floating-outline">
            <select
              id="m_state"
              name="m_state"
              class="form-select"
              aria-label="Default select example">
              <option value="0">Select</option>
              @foreach($states_of_america as $state)
                <option value="{{$state->id}}">{{$state->abrev}}</option>
              @endforeach
            </select>
            <label for="m_state">State</label>
          </div>
        </div>

        <div class="col-12 col-md-2 d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="m_zipcode"
              name="m_zipcode"
              class="form-control modal-edit-tax-id"
              placeholder="123 456 7890" />
            <label for="m_zipcode">ZipCode</label>
          </div>
        </div>


        <hr>
        <div class="col-12">
          <div class="row">
            <div class="col-4">
              <span class="h5">Marital Status</span>
              
            </div>
              <div class="col-8">
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="marital_status" class="form-check-input is_married" type="radio" value="1" id="marital_status-married">
                        <label class="form-check-label" for="marital_status-married">Married</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="marital_status" class="form-check-input is_married" type="radio" value="2" id="marital_status-unmarried"  checked="">
                        <label class="form-check-label" for="marital_status-unmarried">
                          UnMarried
                        </label>
                      </div>
                    </div>
              </div>
          </div>
        </div>
        <div class="col-12 col-md-4 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="date"
              id="marital_date"
              name="marital_date"
              class="form-control"
              value=""
              placeholder="" />
            <label for="marital_date">Marriage Date</label>
          </div>
        </div>

        <hr class="info-content-married d-none">
        <div class="col-12 info-content-married d-none">
          <div class="row">
            <div class="col-12">
              <span class="h5">Spouse's Info</span>
            </div>
          </div>
              
        </div>

        <div class="col-12 col-md-5 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="spouse_first_name"
              name="spouse_first_name"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_first_name">First Name</label>
          </div>
        </div>
        <div class="col-12 col-md-2 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="spouse_mi"
              name="spouse_mi"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_mi">MI</label>
          </div>
        </div>
        <div class="col-12 col-md-5 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="spouse_last_name"
              name="spouse_last_name"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_last_name">Last Name</label>
          </div>
        </div>

        <div class="col-12 col-md-4 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="spouse_ssn"
              name="spouse_ssn"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_ssn">SSN/TIN</label>
          </div>
        </div>

        <div class="col-12 col-md-2 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="date"
              id="spouse_date_birdth"
              name="spouse_date_birdth"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_date_birdth">Date Birdth</label>
          </div>
        </div>

        <div class="col-12 col-md-4 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="text"
              id="spouse_dl"
              name="spouse_dl"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_dl">DL #</label>
          </div>
        </div>

        <div class="col-12 col-md-2 info-content-married d-none">
          <div class="form-floating form-floating-outline">
              <select
              id="spouse_dl_state"
              name="spouse_dl_state"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Active</option>
              <option value="2">Inactive</option>
              <option value="3">Suspended</option>
            </select>
            <label for="spouse_dl_state">DL State</label>
          </div>
        </div>

        <div class="col-12 col-md-5 info-content-married d-none">
          <div class="form-floating form-floating-outline">
              <select
              id="spouse_has_passport"
              name="spouse_has_passport"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Active</option>
              <option value="2">Inactive</option>
              <option value="3">Suspended</option>
            </select>
            <label for="spouse_has_passport">Has Passport</label>
          </div>
        </div>


        <div class="col-12 col-md-12 d-none info-content-married d-none">
          <div class="form-floating form-floating-outline d-none">
            <input
              type="text"
              id="spouse_saludation_for_letter"
              name="spouse_saludation_for_letter"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_saludation_for_letter">Saludation for Letters</label>
          </div>
        </div>
        <div class="col-12 d-none">
          <div class="row">
            <div class="col-sm-8 col-6">
              <span for="editBillingAddress" class="text-heading">Link to Sole Proprietorship Business</span>
              <input
                type="text"
                id="link"
                name="link"
                class="form-control"
                value=""
                placeholder="" style="width: 70%" />
            </div>

            <div class="col-sm-2 col-4 mt-2">
              <button class="btn btn-primary waves-effect waves-light">Link</button>
            </div>
            
          </div>
        </div>

          <hr class="info-content-married d-none">
        <div class="col-12">
          <div class="row">
            <div class="col-12">
              <span class="h5">Contact Information</span>
            </div>
          </div>
              
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="phone_home"
              name="phone_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="phone_home">Home Phone</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="cell_home"
              name="cell_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="cell_home">Cell</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="fax_home"
              name="fax_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="fax_home">Fax</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="phone_work"
              name="phone_work"
              class="form-control"
              value=""
              placeholder="" />
            <label for="phone_work">Work Phone</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="cell_work"
              name="cell_work"
              class="form-control"
              value=""
              placeholder="" />
            <label for="cell_work">Work Cell</label>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="preferred"
              name="preferred"
              class="form-control"
              value=""
              placeholder="" />
            <label for="preferred">Preferred</label>
          </div>
        </div>


        <div class="col-12 col-md-4 info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_phone_home"
              name="spouse_phone_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_phone_home">Spouse Home</label>
          </div>
        </div>

        <div class="col-12 col-md-4  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_cell_home"
              name="spouse_cell_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_cell_home">Spouse Cell</label>
          </div>
        </div>

        <div class="col-12 col-md-4  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_fax_home"
              name="spouse_fax_home"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_fax_home">Spouse Fax</label>
          </div>
        </div>


        <div class="col-12 col-md-4  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_phone_work"
              name="spouse_phone_work"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_phone_work">Spouse Phone</label>
          </div>
        </div>

        <div class="col-12 col-md-4  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_cell_work"
              name="spouse_cell_work"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_cell_work">Spouse Cell</label>
          </div>
        </div>

        <div class="col-12 col-md-4  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_preferred"
              name="spouse_preferred"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_preferred">Spouse Preferred</label>
          </div>
        </div>
        <div class="col-12 col-md-12">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="tax_payer_email"
              name="tax_payer_email"
              class="form-control"
              value=""
              placeholder="" />
            <label for="tax_payer_email">TaxPayer Email</label>
          </div>
        </div>

        <div class="col-12 col-md-12  info-content-married d-none">
          <div class="form-floating form-floating-outline">
            <input
              type="tel"
              id="spouse_email"
              name="spouse_email"
              class="form-control"
              value=""
              placeholder="" />
            <label for="spouse_email">Spouse Email</label>
          </div>
        </div>
        <div class="col-sm-12" id="footer-button">
          <button type="submit" id="btn-save" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </form>
    </div>
</div>


<style type="text/css">
   #add-new-record.offcanvas {
    --bs-offcanvas-width: 50%;
  }
  /* En móviles (<768px): fullscreen */
  @media (max-width: 767.98px) {
    #add-new-record.offcanvas {
      --bs-offcanvas-width: 100%;
    }
  }
  /* Para que sólo el body haga scroll si el contenido excede la altura */
  #add-new-record .offcanvas-body {
    overflow-y: auto;
  }
</style>