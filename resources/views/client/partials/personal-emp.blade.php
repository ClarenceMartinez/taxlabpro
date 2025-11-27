<div class="tab-pane fade active show" id="navs-home-card" role="tabpanel" style="text-align:left;">
        <!-- <h4 class="card-title">Personal & Emp</h4> -->
        <div class="card-body pt-3">
            <form>
              <!-- <h6 class="pt-0">1. Account Details</h6> -->
              <div class="row g-6">
                <div class="col-md-12">
                  <label class="form-check-label">Marital Status</label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="marital_status_first" class="form-check-input" type="radio" value="" id="marital_status_first" {{($client->marital_status == 2) ? 'checked=' : ''}}>
                        <label class="form-check-label" for="marital_status_first">UnMarried</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="marital_status_first" class="form-check-input" type="radio" value="" id="marital_status_first" {{($client->marital_status == 1) ? 'checked=' : ''}}>
                        <label class="form-check-label" for="marital_status_first">
                          Married
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                          <!-- <label for="date_married">Date</label> -->
                          <input
                            type="text"
                            id="date_married"
                            class="form-control form-control-sm date-simple flatpickr-input" placeholder="YYYY-MM-DD" 
                            aria-describedby="date_married"  value="{{$client->marital_date}}"/>
                        </div>
                    </div>
                    <div class="mb-4">
                      <label class="form-check m-0">
                        <input type="checkbox" class="form-check-input">
                        <span class="form-check-label">You were married  an lived in AZ, CA, ID, NM, NV, TX,  WI or WI within  the last ten years</span>
                      </label>
                    </div>
                </div>
                <div class="col-md-12">

                  <label class="form-check-label">Are there other members of the household or dependents? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="household_dependents" class="form-check-input input-check-other-member" type="radio" value="unknown" {{($client->household_dependents == 'unknown') ? 'checked' : '' }}>
                        <label class="form-check-label" for="household_dependents">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="household_dependents" class="form-check-input input-check-other-member" type="radio" value="no" {{($client->household_dependents == 'no') ? 'checked' : '' }}>
                        <label class="form-check-label" for="household_dependents">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="household_dependents" class="form-check-input input-check-other-member" type="radio" value="yes" {{($client->household_dependents == 'yes') ? 'checked' : '' }}>
                        <label class="form-check-label" for="household_dependents">
                          Yes
                        </label>
                      </div>
                      
                    </div>

                    <div class="row p-5 {{($client->household_dependents == 'yes') ? '' : 'd-none' }}" id="content-other-member">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->dependents as $dependent)
                          <div class="row item-dependent">
                              <input type="hidden" name="dependent_id" id="dependent_id" value="{{$dependent->id}}">
                              <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="name" class="form-control form-control-sm autocomplete-blur"  placeholder="" value="{{$dependent->name}}" />
                                  <label for="name">Name</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="age" class="form-control form-control-sm autocomplete-blur" placeholder="" value="{{$dependent->age}}"/>
                                  <label for="age">Age</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="relationship" class="form-control form-control-sm autocomplete-blur" placeholder="" value="{{$dependent->relationship}}"/>
                                  <label for="elationship">Relationship</label>
                                </div>
                              </div>
                              <div class="col-md-10 mt-2">
                                <div class="row">
                                  <label class="col-sm-7 form-check-label">Claimed as depended on Form 1040? </label>
                                  <div class="col mt-2 col-sm-5">

                                      <div class="form-check form-check-inline">
                                        <input name="claimed_as_dependent_{{$dependent->id}}" class="form-check-input check-dependent-claimed" type="radio" value="0" id="claimed_as_dependent_{{$dependent->id}}" checked="" @if($dependent->claimed_as_dependent == 0) checked @endif>
                                        <label class="form-check-label" for="claimed_as_dependent_{{$dependent->id}}">
                                          No
                                        </label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input name="claimed_as_dependent_{{$dependent->id}}" class="form-check-input check-dependent-claimed" type="radio" value="1" id="claimed_as_dependent_{{$dependent->id}}" @if($dependent->claimed_as_dependent == 1) checked @endif>
                                        <label class="form-check-label" for="claimed_as_dependent_{{$dependent->id}}">
                                          Yes
                                        </label>
                                      </div>
                                      
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-10">
                                <div class="row">
                                  <label class="col-sm-7 form-check-label">Countributes to household income? </label>
                                  <div class="col mt-2 col-sm-5">

                                      <div class="form-check form-check-inline">
                                        <input name="contributes_income_{{$dependent->id}}" class="form-check-input check-dependent-income" type="radio" value="0" id="contributes_income_{{$dependent->id}}" @if($dependent->contributes_income == 0) checked @endif>
                                        <label class="form-check-label" for="contributes_income_{{$dependent->id}}">
                                          No
                                        </label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input name="contributes_income_{{$dependent->id}}" class="form-check-input check-dependent-income" type="radio" value="1" id="contributes_income_{{$dependent->id}}" @if($dependent->contributes_income == 1) checked @endif>
                                        <label class="form-check-label" for="contributes_income_{{$dependent->id}}">
                                          Yes
                                        </label>
                                      </div>
                                      
                                  </div>
                                </div>
                              </div>                         
                          </div>
                          @endforeach


                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-more-dependent"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Is the taxpayer employed? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="taxpayer_employed" class="form-check-input input-check-taxpayer-employed" type="radio" value="unknown" id="is-taxpayer-employed-home" {{($client->taxpayer_employed == 'unknown') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-taxpayer-employed-home">Uknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="taxpayer_employed" class="form-check-input input-check-taxpayer-employed" type="radio" value="no" id="is-taxpayer-employed-office"
                        {{($client->taxpayer_employed == 'no') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-taxpayer-employed-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="taxpayer_employed" class="form-check-input input-check-taxpayer-employed" type="radio" value="yes" id="is-taxpayer-employed-office"
                        {{($client->taxpayer_employed == 'yes') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-taxpayer-employed-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>

                    <div class="row p-5 {{($client->taxpayer_employed == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-employed">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->employment as $employer )


                          <div class="row item-employed  {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="employer_id" id="employer_id" value="{{$employer->id}}">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="employer" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->employer}}" />
                                    <label for="employer">Employer</label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="street" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->street}}"/>
                                    <label for="street">Street</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->city}}"/>
                                    <label for="city">City</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="state" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->state}}"/>
                                    <label for="state">State</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="zip_code" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->zip_code}}"/>
                                    <label for="zip_code">ZIP Code</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="work_phone" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->work_phone}}"/>
                                    <label for="work_phone">Work Phone</label>
                                  </div>
                                </div>
                                <div class="col-md-8 mt-2">
                                  <div class="mb-4">
                                    <label class="form-check m-0">
                                      <input type="checkbox" class="form-check-input check-employer" id="contact_at_work_allowed" value="1" @if($employer->contact_at_work_allowed == 1) checked @endif>
                                      <span class="form-check-label">Contact at work allowed</span>
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-blur" id="occupation" placeholder="" value="{{$employer->occupation}}"/>
                                    <label for="occupation">Occupation</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-blur" id="employer_year" placeholder="" value="{{$employer->employer_year}}"/>
                                    <label for="employer_year">Employed Years</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-blur" id="employer_month" placeholder="" value="{{$employer->employer_month}}"/>
                                    <label for="employer_month">Employed Month</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm employer-blur select2 form-select" id="business_interest">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                    </select>
                                    <label for="business_interest">Bussiness Interest</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm employer-blur select2 form-select" id="pay_period">
                                      <option value="0">Select</option>
                                      @foreach($payPeriods as $payPeriod)
                                        <option value="{{$payPeriod->id}}" {{ ($employer->pay_period == $payPeriod->id) ? 'selected' : '' }}>{{$payPeriod->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="pay_period">Pay period</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="gross_wage" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->gross_wage}}"/>
                                    <label for="gross_wage">Gross Wage</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="federal_tax" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->federal_tax}}">
                                    <label for="federal_tax">Federal Tax</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="state_tax" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->state_tax}}">
                                    <label for="state_tax">State Tax</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="local_tax" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->local_tax}}">
                                    <label for="local_tax">Local Tax</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea name="" id="" class="form-control h-px-100"></textarea>
                                    <label for="multicol-username">Pay Stub Item</label>
                                  </div>

                                  <div class="col-md-12 mt-3">
                                    <a href="javascript:;"><i class="ri-add-circle-fill"></i> Add item</a>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="does_claimed_form" class="form-control form-control-sm employer-blur" placeholder="" value="{{$employer->does_claimed_form}}" />
                                    <label for="does_claimed_form">Exemptions (Number of withholding claimed on Form W-4)</label>
                                  </div>
                                </div>

                                <div class="mb-4">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-employer" id="does_not_withhold_social_security" value="1" @if($employer->does_not_withhold_social_security == 1) checked @endif>
                                    <span class="form-check-label">Does not withhold Social Security</span>
                                  </label>
                                </div>

                                <div class="mb-4">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-employer" id="does_not_withhold_medicare" value="1" @if($employer->does_not_withhold_medicare == 1) checked @endif>
                                    <span class="form-check-label">Does not withhold Medicare</span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-more-employer"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Is the individual's Spouse employed? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="spouse_employed" class="form-check-input input-check-individual-spouse-employed" type="radio" value="unknown" id="is-individual-spouse-employed-home" {{($client->spouse_employed == 'unknown') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-individual-spouse-employed-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="spouse_employed" class="form-check-input input-check-individual-spouse-employed" type="radio" value="no" id="is-individual-spouse-employed-office" {{($client->spouse_employed == 'no') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-individual-spouse-employed-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="spouse_employed" class="form-check-input input-check-individual-spouse-employed" type="radio" value="yes" id="is-individual-spouse-employed-office" {{($client->spouse_employed == 'yes') ? 'checked' : ''}}>
                        <label class="form-check-label" for="is-individual-spouse-employed-office">
                          Yes
                        </label>
                      </div>
                  </div>

                  <div class="row p-5 {{($client->spouse_employed == 'yes') ? '' : 'd-none'}}" id="content-individual-spouse-employed">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->employment_spouse as $employerSpouse )
                          <div class="row item-employed-spouse  {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="employer_spouse_id" id="employer_spouse_id" value="{{$employerSpouse->id}}">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="employer" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->employer}}" />
                                    <label for="employer">Employer</label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="street" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->street}}"/>
                                    <label for="street">Street</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->city}}"/>
                                    <label for="city">City</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="state" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->state}}"/>
                                    <label for="state">State</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="zip_code" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->zip_code}}"/>
                                    <label for="zip_code">ZIP Code</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="work_phone" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->work_phone}}"/>
                                    <label for="work_phone">Work Phone</label>
                                  </div>
                                </div>
                                <div class="col-md-8 mt-2">
                                  <div class="mb-4">
                                    <label class="form-check m-0">
                                      <input type="checkbox" class="form-check-input check-employer-spouse" id="contact_at_work_allowed" value="1" @if($employerSpouse->contact_at_work_allowed == 1) checked @endif>
                                      <span class="form-check-label">Contact at work allowed</span>
                                    </label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="occupation" placeholder="" value="{{$employerSpouse->occupation}}"/>
                                    <label for="occupation">Occupation</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="employer_year" placeholder="" value="{{$employerSpouse->employer_year}}"/>
                                    <label for="employer_year">Employed Years</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control form-control-sm employer-spouse-blur" id="employer_month" placeholder="" value="{{$employerSpouse->employer_month}}"/>
                                    <label for="employer_month">Employed Month</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm employer-spouse-blur select2 form-select" id="business_interest">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                    </select>
                                    <label for="business_interest">Bussiness Interest</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm employer-spouse-blur select2 form-select" id="pay_period">
                                      <option value="0">Select</option>
                                      @foreach($payPeriods as $payPeriod)
                                        <option value="{{$payPeriod->id}}" {{ ($employerSpouse->pay_period == $payPeriod->id) ? 'selected' : '' }}>{{$payPeriod->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="pay_period">Pay period</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="gross_wage" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->gross_wage}}"/>
                                    <label for="gross_wage">Gross Wage</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="federal_tax" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->federal_tax}}">
                                    <label for="federal_tax">Federal Tax</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="state_tax" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->state_tax}}">
                                    <label for="state_tax">State Tax</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="local_tax" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->local_tax}}">
                                    <label for="local_tax">Local Tax</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <textarea name="" id="" class="form-control h-px-100"></textarea>
                                    <label for="multicol-username">Pay Stub Item</label>
                                  </div>

                                  <div class="col-md-12 mt-3">
                                    <a href="javascript:;"><i class="ri-add-circle-fill"></i> Add item</a>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="does_claimed_form" class="form-control form-control-sm employer-spouse-blur" placeholder="" value="{{$employerSpouse->does_claimed_form}}" />
                                    <label for="does_claimed_form">Exemptions (Number of withholding claimed on Form W-4)</label>
                                  </div>
                                </div>

                                <div class="mb-4">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-employer-spouse" id="does_not_withhold_social_security" value="1" @if($employerSpouse->does_not_withhold_social_security == 1) checked @endif>
                                    <span class="form-check-label">Does not withhold Social Security</span>
                                  </label>
                                </div>

                                <div class="mb-4">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-employer-spouse" id="does_not_withhold_medicare" value="1" @if($employerSpouse->does_not_withhold_medicare == 1) checked @endif>
                                    <span class="form-check-label">Does not withhold Medicare</span>
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-more-spouse-employer"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Does the taxpayer or spouse have any other bussiness interest? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_interest" class="form-check-input input-check-other-bussiness" type="radio" value="unknown" id="other-bussiness-interest-home" {{($client->business_interest == 'unknown') ? 'checked' : ''}}>
                        <label class="form-check-label" for="other-bussiness-interest-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_interest" class="form-check-input input-check-other-bussiness" type="radio" value="no" id="other-bussiness-interest-office" {{($client->business_interest == 'no') ? 'checked' : ''}}>
                        <label class="form-check-label" for="other-bussiness-interest-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_interest" class="form-check-input input-check-other-bussiness" type="radio" value="yes" id="other-bussiness-interest-office" {{($client->business_interest == 'yes') ? 'checked' : ''}}>
                        <label class="form-check-label" for="other-bussiness-interest-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_interest == 'yes') ? '' : 'd-none'}}" id="content-other-bussiness">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->business_interests as $detailInt )
                          <div class="row item-other-bussines {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="business_interest_id" id="business_interest_id" value="{{$detailInt->id}}">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="business_name" class="form-control form-control-sm other-business-blur" placeholder="" value="{{$detailInt->business_name}}" />
                                    <label for="business_name">Business Name</label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="business_address" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->business_address}}"/>
                                    <label for="business_address">Bussiness Address</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->city_state_zip}}" />
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->phone}}" />
                                    <label for="phone">Phone</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">

                                <div class="col-md-7 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select id="type" class="form-control form-control-sm other-business-blur select2 form-select">
                                      <option></option>
                                    </select>
                                    <label for="multicol-username">Type of Bussiness</label>
                                  </div>
                                </div>
                                <div class="col-md-5 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="ownership" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->ownership}}"/>
                                    <label for="ownership">% Ownership</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="title" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->title}}"/>
                                    <label for="title">Title </label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="ein" class="form-control form-control-sm other-business-blur" placeholder=""  value="{{$detailInt->ein}}"/>
                                    <label for="ein">EIN </label>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-more-other-business"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
              </div>  
          </form>
        </div>
        
      </div>