<div class="tab-pane fade" id="navs-real-state-card" role="tabpanel" style="text-align: left;">
          <div class="card-body pt-3">
            <form>
              <div class="row g-6">

                <div class="col-md-12">
                  <label class="form-check-label">Primary Residence status? </label>
                  <div class="col mt-2">
                      <input type="hidden" name="type_residence_id" id="type_residence_id" value="{{ isset($client->typeResidence[0]) ?  $client->typeResidence[0]->id : '' }}">
                      <div class="form-check form-check-inline">
                        <input type="radio" name="status" class="form-check-input input-check-primary-residence"  value="own" {{ isset($client->typeResidence[0]) && $client->typeResidence[0]->status == 'own' ? 'checked' : '' }}>

                        <label class="form-check-label" for="is-primary-residence-home">Own their home</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input type="radio" name="status" class="form-check-input input-check-primary-residence"  value="rent" {{ isset($client->typeResidence[0]) && $client->typeResidence[0]->status == 'rent' ? 'checked' : '' }}>
                        <label class="form-check-label" for="is-primary-residence-office">
                          Rents
                        </label>
                        <input type="text" class="form-control form-control-sm" name="monthly_rent" placeholder="Monthly Rent" value="{{ isset($client->typeResidence[0]) ? $client->typeResidence[0]->monthly_rent : ''}}">
                      </div>
                      <div class="form-check form-check-inline">
                        <input type="radio" name="status" class="form-check-input input-check-primary-residence"  value="other" {{ isset($client->typeResidence[0]) && $client->typeResidence[0]->status == 'other' ? 'checked' : '' }}>
                        <label class="form-check-label" for="is-primary-residence-office">
                          Other
                        </label>
                        <input type="text" class="form-control form-control-sm" name="other_description" value="{{ isset($client->typeResidence[0]) ? $client->typeResidence[0]->other_description : ''}}">
                      </div>
                      
                    </div>
                    
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Own any real property? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="own_real_property" class="form-check-input input-check-own-any-real-property" type="radio" value="unknown" {{($client->own_real_property == 'unknown') ? 'checked' : '' }}  id="is-own-any-real-property-home">
                        <label class="form-check-label" for="is-own-any-real-property-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="own_real_property" class="form-check-input input-check-own-any-real-property" type="radio" value="no" {{($client->own_real_property == 'no') ? 'checked' : '' }}  id="is-own-any-real-property-office">
                        <label class="form-check-label" for="is-own-any-real-property-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="own_real_property" class="form-check-input input-check-own-any-real-property" type="radio" value="yes" {{($client->own_real_property == 'yes') ? 'checked' : '' }} id="is-own-any-real-property-office">
                        <label class="form-check-label" for="is-own-any-real-property-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->own_real_property == 'yes') ? '' : 'd-none' }}" id="content-own-any-real-property">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->properties as $property)
                          <div class="row item-property-real {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">

                            <div class="col-md-12">
                              <div class="row">
                                <input type="hidden" name="property_id" id="property_id" value="{{$property->id}}">
                                <div class="mb-4 mt-2">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-property-real-change" {{ ($property->is_primary == 1) ? 'checked' : ''}}  id="is_primary" name="is_primary" value="1">
                                    <span class="form-check-label">Primary Residence</span>
                                  </label>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm input-property-real-blur" name="street_address" id="street_address" value="{{$property->street_address}}"/>
                                    <label for="street_address">Street Address</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->city_state_zip}}"/>
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="country" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->country}}"/>
                                    <label for="country">Country</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="description" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->description}}"/>
                                    <label for="description">Description</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="title_held" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->title_held}}"/>
                                    <label for="title_held">How title is Held</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="purchase_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->purchase_date}}"/>
                                    <label for="purchase_date">Purchase Date</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="purchase_price" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->purchase_price}}"/>
                                    <label for="purchase_price">Purchase Price</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="statement_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->statement_date}}"/>
                                    <label for="statement_date">Statement Date</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="refinance_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->refinance_date}}"/>
                                    <label for="refinance_date">Refinance Date</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="refinance_amount" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->refinance_amount}}"/>
                                    <label for="refinance_amount">Refinance Amount</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->current_value}}"/>
                                    <label for="current_value">Current Value</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->loan_balance}}"/>
                                    <label for="loan_balance">Current loan balance</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="monthly_payment" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->monthly_payment}}"/>
                                    <label for="monthly_payment">Monthly payment</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="final_payment_date" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->final_payment_date}}"/>
                                    <label for="final_payment_date">Date of final payment</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="lender_name" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->lender_name}}"/>
                                    <label for="lender_name">Lender</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="lender_address" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->lender_address}}"/>
                                    <label for="lender_address">Lender address</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->lender_city_state_zip}}"/>
                                    <label for="lender_city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="lender_phone" class="form-control form-control-sm input-property-real-blur" placeholder="" value="{{$property->lender_phone}}"/>
                                    <label for="lender_phone">Lender Phone</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-own-any-real-property"><i class="ri-add-circle-fill"></i> Add Property</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Is real property currently for saleor anticipate selling to fund the offer amount? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="real_property_for_sale" class="form-check-input input-check-toogle input-check-real-property-currently" type="radio" value="unknown" {{($client->real_property_for_sale == 'unknown') ? 'checked' : '' }}  id="is-real-property-currently-home">
                        <label class="form-check-label" for="is-real-property-currently-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="real_property_for_sale" class="form-check-input input-check-toogle input-check-real-property-currently" type="radio" value="no" {{($client->real_property_for_sale == 'no') ? 'checked' : '' }}  id="is-real-property-currently-office">
                        <label class="form-check-label" for="is-real-property-currently-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="real_property_for_sale" class="form-check-input input-check-toogle  input-check-real-property-currently" type="radio" value="yes" {{($client->real_property_for_sale == 'yes') ? 'checked' : '' }}  id="is-real-property-currently-office">
                        <label class="form-check-label" for="is-real-property-currently-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->real_property_for_sale == 'yes') ? '' : 'd-none' }}" id="content-real-property-currently">
                        <div class="col-md-12 p-5 card">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="row item-property-sales">
                                <input type="hidden" name="property_sales_id" id="property_sales_id" value="{{ isset($client->propertySales[0]) ? $client->propertySales[0]->id : ''}}" >
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="listing_price" class="form-control form-control-sm input-listing-price-blur" placeholder="" value="{{ isset($client->propertySales[0]) ? $client->propertySales[0]->listing_price : ''}}" />
                                    <label for="listing_price">Listing Price</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Have any Cars, boats, motorcycles? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="own_vehicles" class="form-check-input input-check-toogle input-check-have-any-cars-boats-motorcycle" type="radio" value="unknown" {{($client->own_vehicles == 'unknown') ? 'checked' : '' }}   id="is-have-any-cars-boats-motorcycle-home">
                        <label class="form-check-label" for="is-have-any-cars-boats-motorcycle-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="own_vehicles" class="form-check-input input-check-toogle input-check-have-any-cars-boats-motorcycle" type="radio" value="no" {{($client->own_vehicles == 'no') ? 'checked' : '' }}   id="is-have-any-cars-boats-motorcycle-office">
                        <label class="form-check-label" for="is-have-any-cars-boats-motorcycle-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="own_vehicles" class="form-check-input input-check-toogle input-check-have-any-cars-boats-motorcycle" type="radio" value="yes" {{($client->own_vehicles == 'yes') ? 'checked' : '' }}   id="is-have-any-cars-boats-motorcycle-office">
                        <label class="form-check-label" for="is-have-any-cars-boats-motorcycle-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->own_vehicles == 'yes') ? '' : 'd-none' }}" id="content-have-any-cars-boats-motorcycle">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->vehicles as $vehicle)
                          <div class="row item-any-vehicle {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{ $vehicle->id}}">
                              <label class="form-check-label">Primary vehicle for? </label>
                              <div class="col-md-12 mt-2">
                                  <div class="form-check form-check-inline">
                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="taxpayer" id="primary_vehicle_for" {{ $vehicle->primary_vehicle_for == 'taxpayer' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="primary_vehicle_for">Taxpayer</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="spouse" id="primary_vehicle_for" {{ $vehicle->primary_vehicle_for == 'spouse' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="primary_vehicle_for">
                                      Spouse
                                    </label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input name="primary_vehicle_for" class="form-check-input input-any-vehicle-blur" type="radio" value="neither" id="primary_vehicle_for" {{ $vehicle->primary_vehicle_for == 'neither' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="primary_vehicle_for" >
                                      Neither
                                    </label>
                                  </div>
                                  
                                </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="num" id="year" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->year}}"/>
                                  <label for="year">Year</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="make" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->make}}"/>
                                  <label for="make">Make</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="model" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->model}}"/>
                                  <label for="model">Model</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="mileage" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->mileage}}"/>
                                  <label for="mileage">Mileage</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="license" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->license}}"/>
                                  <label for="license">License</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="vin" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->vin}}"/>
                                  <label for="vin">VIN</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->purchase_date}}"/>
                                  <label for="purchase_date">Purchase Date</label>
                                </div>
                              </div>

                              
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->current_value}}"/>
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->current_loan_balance}}"/>
                                  <label for="current_loan_balance">Current loan balance</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-any-vehicle-blur" placeholder="" value="{{ $vehicle->monthly_payment}}"/>
                                  <label for="monthly_payment">Monthly payment</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="date_of_final_payment" class="form-control form-control-sm date-simple flatpickr-input input-any-vehicle-blur" placeholder="YYYY-MM-DD" value="{{ $vehicle->date_of_final_payment}}"/>
                                  <label for="date_of_final_payment">Date of final payment</label>
                                </div>
                              </div>
                              


                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_name" class="form-control form-control-sm input-any-vehicle-blur" placeholder=""  value="{{ $vehicle->lender_name}}"/>
                                  <label for="lender_name">Lender Name</label>
                                </div>
                              </div>
                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_address" class="form-control form-control-sm input-any-vehicle-blur" placeholder=""  value="{{ $vehicle->lender_address}}"/>
                                  <label for="lender_address">lender Address</label>
                                </div>
                              </div>

                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-any-vehicle-blur" placeholder=""  value="{{ $vehicle->lender_city_state_zip}}"/>
                                  <label for="lender_city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>

                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-any-vehicle-blur" placeholder=""  value="{{ $vehicle->lender_phone}}"/>
                                  <label for="lender_phone">Lender Phone</label>
                                </div>
                              </div>

                              <div class="mb-4">
                                <label class="form-check m-0">
                                  <input type="checkbox" class="form-check-input input-any-vehicle-check" name="is_loan" id="is_loan" value="1"  {{ $vehicle->is_loan == 1 ? 'checked' : ''}}>
                                  <span class="form-check-label">Loan/Own</span>
                                </label>

                                <label class="form-check m-0">
                                  <input type="checkbox" class="form-check-input input-any-vehicle-check"  name="is_lease" id="is_lease" value="1"  {{ $vehicle->is_lease == 1 ? 'checked' : ''}}>
                                  <span class="form-check-label">Lease</span>
                                </label>
                              </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-have-any-cars-boats-motorcycle"><i class="ri-add-circle-fill"></i> Add Vehicule</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Any other assets of value? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="other_valuable_assets" class="form-check-input input-check-toogle input-check-any-other-assets" type="radio" value="unknown" {{($client->other_valuable_assets == 'unknown') ? 'checked' : '' }} id="input-check-any-other-assets-home" >
                        <label class="form-check-label" for="is-any-other-assets-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="other_valuable_assets" class="form-check-input input-check-toogle input-check-any-other-assets" type="radio" value="no" {{($client->other_valuable_assets == 'no') ? 'checked' : '' }} id="input-check-any-other-assets-office">
                        <label class="form-check-label" for="is-any-other-assets-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="other_valuable_assets" class="form-check-input input-check-toogle input-check-any-other-assets" type="radio" value="yes" {{($client->other_valuable_assets == 'yes') ? 'checked' : '' }} id="input-check-any-other-assets-office">
                        <label class="form-check-label" for="is-any-other-assets-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>

                    <div class="row p-5 {{($client->other_valuable_assets == 'yes') ? '' : 'd-none' }}" id="content-any-other-assets">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->otherAssets as $otherAsset)
                          <div class="row item-other-asset {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="other_asset_id" id="other_asset_id" value="{{ $otherAsset->id }}">
                            <label class="form-check-label">Type? </label>
                            <div class="col-md-12 mt-2">
                              <div class="form-check form-check-inline">
                                <input name="type" class="form-check-input check-other-asset-blur" type="radio" value="tangible" id="type" {{ $otherAsset->type == 'tangible' ? 'checked' : '' }}>
                                <label class="form-check-label" for="type-home">Tangible</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input name="type" class="form-check-input check-other-asset-blur" type="radio" value="intangible" id="type" {{ $otherAsset->type == 'intangible' ? 'checked' : '' }}>
                                <label class="form-check-label" for="type-office">
                                  Intangible
                                </label>
                              </div>                                  
                            </div>

                            <div class="col-md-4 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="description" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->description }}" />
                                <label for="description">Description</label>
                              </div>
                            </div>

                            <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="street_address" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->street_address }}"/>
                                  <label for="street_address">Street Address</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->city_state_zip }}"/>
                                  <label for="city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="county" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->county }}"/>
                                  <label for="county">County</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->purchase_date }}"/>
                                  <label for="purchase_date">Puchase Date</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->current_value }}"/>
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->current_loan_balance }}"/>
                                  <label for="current_loan_balance">Current loan balance</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->monthly_payment }}"/>
                                  <label for="monthly_payment">Montly payment</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="date_of_final_payment" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->date_of_final_payment }}"/>
                                  <label for="date_of_final_payment">Date of final payment</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->lender }}"/>
                                  <label for="lender">Lender</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_address" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->lender_address }}"/>
                                  <label for="lender_address">Lender Address</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->lender_city_state_zip }}"/>
                                  <label for="lender_city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-other-asset-blur" placeholder="" value="{{ $otherAsset->lender_phone }}"/>
                                  <label for="lender_phone">Lender Phone</label>
                                </div>
                              </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-any-other-assets"><i class="ri-add-circle-fill"></i> Add Asset</a>
                        </div>
                    </div>
                </div>
              </div>
            </form>
          </div>
      </div>