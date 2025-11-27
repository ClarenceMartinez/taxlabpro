<div class="tab-pane fade pt-3" id="navs-profile-card" role="tabpanel" style="text-align: left;">

        <div class="col-md-12">
          <label class="form-check-label">Is the taxpayer(s) party to a lawsuit? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit" type="radio" id="is-taxpayer-party-home" value="unknown" {{($client->lawsuit_party == 'unknown') ? 'checked' : '' }}>
                <label class="form-check-label" for="is-taxpayer-party-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit" type="radio" value="no" {{($client->lawsuit_party == 'no') ? 'checked' : '' }} id="is-taxpayer-party-office">
                <label class="form-check-label" for="is-taxpayer-party-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit" type="radio" value="yes" {{($client->lawsuit_party == 'yes') ? 'checked' : '' }} id="is-taxpayer-party-office">
                <label class="form-check-label" for="is-taxpayer-party-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->lawsuit_party == 'yes') ? '' : 'd-none' }} " id="content-taxpayer-party-lawsuit">
                <div class="col-md-12 p-5 card">

                  @foreach($client->lawsuits as $lawsuit)

                  <div class="row item-lawsuit-financial {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                    <input type="hidden" name="lawsuit_id" id="lawsuit_id" value="{{$lawsuit->id}}">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 mt-2">
                          <div class="form-check form-check-inline">
                            <input name="role{{$lawsuit->id}}" class="form-check-input input-item-check-taxpayer-party-lawsuit " type="radio" value="plaintiff" id="role" @if($lawsuit->role == 'plaintiff') checked @endif>
                            <label class="form-check-label" for="role">
                              Plaintiff
                            </label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input name="role{{$lawsuit->id}}" class="form-check-input input-item-check-taxpayer-party-lawsuit" type="radio" value="defendant" id="role" @if($lawsuit->role == 'defendant') checked @endif>
                            <label class="form-check-label" for="role">
                              Defendant
                            </label>
                          </div>
                        </div>

                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="subject_of_suit" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value="{{$lawsuit->subject_of_suit}}"/>
                            <label for="subject_of_suit">Subject of Suit</label>
                          </div>
                        </div>


                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="location_of_filing" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value="{{$lawsuit->location_of_filing}}"/>
                            <label for="location_of_filing">Location of Filing</label>
                          </div>
                        </div>

                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="city" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value="{{$lawsuit->city}}"/>
                            <label for="city">City</label>
                          </div>
                        </div>

                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="represented_by" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value="{{$lawsuit->represented_by}}"/>
                            <label for="represented_by">Represented by</label>
                          </div>
                        </div>

                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <select id="amount_of_suit" class="form-control form-control-sm party-lawsuit-blur select2 form-select">
                              <option></option>
                            </select>
                            <label for="amount_of_suit">Amount of Suit</label>
                          </div>
                        </div>
                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="docket_case_number" class="form-control form-control-sm party-lawsuit-blur" placeholder=""  value="{{$lawsuit->docket_case_number}}"/>
                            <label for="docket_case_number">Docker/Case No.</label>
                          </div>
                        </div>

                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="possible_completion_date" class="form-control form-control-sm party-lawsuit-blur  date-simple flatpickr-input" placeholder="YYYY-MM-DD" />
                            <label for="possible_completion_date">Possible Completion Date</label>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                <div class="col-md-12 mt-3">
                  <a href="javascript:;" id="add-more-lawsuit-financial"><i class="ri-add-circle-fill"></i> Add More</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Is or was  the taxpayer(s) party to a lawsuit involving IRS? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="irs_lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit-involving" type="radio" value="unknown" {{($client->irs_lawsuit_party == 'unknown') ? 'checked' : '' }} id="is-taxpayer-party-lawsuit-home" checked="">
                <label class="form-check-label" for="is-taxpayer-party-lawsuit-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="irs_lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit-involving" type="radio" value="no" {{($client->irs_lawsuit_party == 'no') ? 'checked' : '' }} id="is-taxpayer-party-lawsuit-office">
                <label class="form-check-label" for="is-taxpayer-party-lawsuit-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="irs_lawsuit_party" class="form-check-input input-check-taxpayer-party-lawsuit-involving" type="radio" value="yes" {{($client->irs_lawsuit_party == 'yes') ? 'checked' : '' }} id="is-taxpayer-party-lawsuit-office">
                <label class="form-check-label" for="is-taxpayer-party-lawsuit-office">
                  Yes
                </label>
              </div>
              
          </div>

            <div class="row p-5 {{($client->irs_lawsuit_party == 'yes') ? '' : 'd-none' }} " id="content-taxpayer-party-lawsuit-involving">
              <div class="col-md-12 p-5 card">
                @foreach($client->lawsuit_irs as $lawsuit_ir)
                  <div class="row item-lawsuit-irs {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                    <input type="hidden" name="lawsuit_irs_id" id="lawsuit_irs_id" value="{{$lawsuit_ir->id}}">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="name" class="form-control form-control-sm input-lawsuit-irs-blur" placeholder=""  value="{{$lawsuit_ir->name}}" />
                            <label for="name">If the suit included tax debit, provide the types of tax and periods involved</label>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  @endforeach
                </div>
                <div class="col-md-12 mt-3">
                  <a href="javascript:;" id="add-more-lawsuit-irs"><i class="ri-add-circle-fill"></i> Add More</a>
                </div>

            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Is the taxpayer/spouse currently in bankruptcy? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="bankruptcy_status" class="form-check-input input-check-taxpayer-currently-bankruptcy" type="radio" value="unknown" {{($client->bankruptcy_status == 'unknown') ? 'checked' : '' }} id="is-taxpayer-currently-bankruptcy-home" checked="">
                <label class="form-check-label" for="is-taxpayer-currently-bankruptcy-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="bankruptcy_status" class="form-check-input input-check-taxpayer-currently-bankruptcy" type="radio" value="no" {{($client->bankruptcy_status == 'no') ? 'checked' : '' }} id="is-taxpayer-currently-bankruptcy-office">
                <label class="form-check-label" for="is-taxpayer-currently-bankruptcy-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="bankruptcy_status" class="form-check-input input-check-taxpayer-currently-bankruptcy" type="radio" value="yes" {{($client->bankruptcy_status == 'yes') ? 'checked' : '' }} id="is-taxpayer-currently-bankruptcy-office">
                <label class="form-check-label" for="is-taxpayer-currently-bankruptcy-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->bankruptcy_status == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-spouse-bankruptcy">
                
                <div class="col-md-12 p-5 card">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12 mt-2">
                          <div class="form-floating form-floating-outline">
                            <span> If the suit included tax debit, provide the types of tax and periods involved</span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Has Taxpayer ever field bankruptcy? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="filed_bankruptcy" class="form-check-input input-check-taxpayer-ever-field" type="radio" value="unknown" {{($client->filed_bankruptcy == 'unknown') ? 'checked' : '' }} id="taxpayer-ever-field-home" checked="">
                <label class="form-check-label" for="taxpayer-ever-field-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="filed_bankruptcy" class="form-check-input input-check-taxpayer-ever-field" type="radio" value="no" {{($client->filed_bankruptcy == 'no') ? 'checked' : '' }} id="taxpayer-ever-field-office">
                <label class="form-check-label" for="taxpayer-ever-field-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="filed_bankruptcy" class="form-check-input input-check-taxpayer-ever-field" type="radio" value="yes" {{($client->filed_bankruptcy == 'yes') ? 'checked' : '' }} id="taxpayer-ever-field-office">
                <label class="form-check-label" for="taxpayer-ever-field-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->filed_bankruptcy == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-ever-field">
                  <div class="col-md-12 p-5 card">
                    @foreach($client->bankruptcies as $bankruptcy)
                    <div class="row item-taxpayer-bankruptcy {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                      <input type="hidden" name="bankruptcy_id" id="bankruptcy_id" value="{{$bankruptcy->id}}">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="date" id="date_field" class="form-control form-control-sm input-taxpayer-bankruptcy-blur" placeholder="" value="{{$bankruptcy->date_field}}" />
                              <label for="date_field">Date field </label>
                            </div>
                          </div>
                          <div class="col-md-6 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="petition_no" class="form-control form-control-sm input-taxpayer-bankruptcy-blur" placeholder="" value="{{$bankruptcy->petition_no}}"/>
                              <label for="petition_no">Petition No </label>
                            </div>
                          </div>

                          <div class="col-md-4 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="location" class="form-control form-control-sm input-taxpayer-bankruptcy-blur" placeholder=""  value="{{$bankruptcy->location}}"/>
                              <label for="location">Location </label>
                            </div>
                          </div>


                          <div class="col-md-4 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="date" id="date" class="form-control form-control-sm input-taxpayer-bankruptcy-blur" placeholder="" value="{{$bankruptcy->date}}"/>
                              <label for="date">Date</label>
                            </div>
                          </div>

                          <div class="col-md-4 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="extra_field" class="form-control form-control-sm input-taxpayer-bankruptcy-blur" placeholder="" value="{{$bankruptcy->extra_field}}"/>
                              <label for="extra_field">***</label>
                            </div>
                          </div>

                          
                        </div>
                      </div>
                    </div>
                    @endforeach                  
                  </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Is taxpayer a beneficiary of a trust, state,or life insurance policy? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="trust_beneficiary" class="form-check-input input-check-taxpayer-beneficiary-trust" type="radio" value="unknown" {{($client->trust_beneficiary == 'unknown') ? 'checked' : '' }} id="is-taxpayer-beneficiary-trust-home" checked="">
                <label class="form-check-label" for="is-taxpayer-beneficiary-trust-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="trust_beneficiary" class="form-check-input input-check-taxpayer-beneficiary-trust" type="radio" value="no" {{($client->trust_beneficiary == 'no') ? 'checked' : '' }} id="is-taxpayer-beneficiary-trust-office">
                <label class="form-check-label" for="is-taxpayer-beneficiary-trust-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="trust_beneficiary" class="form-check-input input-check-taxpayer-beneficiary-trust" type="radio" value="yes" {{($client->trust_beneficiary == 'yes') ? 'checked' : '' }} id="is-taxpayer-beneficiary-trust-office">
                <label class="form-check-label" for="is-taxpayer-beneficiary-trust-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->trust_beneficiary == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-trust">
                  <div class="col-md-12 p-5 card">
                    @foreach($client->beneficiaries_insurance as $beneficiaryInsurance)
                    <div class="row item-taxpayer-beneficiary-trust {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                      <input type="hidden" name="beneficiaryInsurance_id" id="beneficiaryInsurance_id" value="{{$beneficiaryInsurance->id}}">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-5 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="trust_or_policy_name" class="form-control form-control-sm input-taxpayer-beneficiary-trust-blur" placeholder="" value="{{$beneficiaryInsurance->trust_or_policy_name}}" />
                              <label for="trust_or_policy_name">Name of the trust, state or policy </label>
                            </div>
                          </div>
                          <div class="col-md-5 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="place_recorded" class="form-control form-control-sm input-taxpayer-beneficiary-trust-blur" placeholder="" value="{{$beneficiaryInsurance->place_recorded}}"/>
                              <label for="place_recorded">Place where recorded </label>
                            </div>
                          </div>

                          <div class="col-md-2 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="ein" class="form-control form-control-sm input-taxpayer-beneficiary-trust-blur" placeholder="" value="{{$beneficiaryInsurance->ein}}"/>
                              <label for="ein">EIN </label>
                            </div>
                          </div>


                          <div class="col-md-6 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="anticipated_amount" class="form-control form-control-sm input-taxpayer-beneficiary-trust-blur" placeholder="" value="{{$beneficiaryInsurance->anticipated_amount}}"/>
                              <label for="anticipated_amount">Anticipated amount to be received</label>
                            </div>
                          </div>

                          <div class="col-md-6 mt-2">
                            <div class="form-floating form-floating-outline">
                              <input type="date" id="amount_receival_date" class="form-control form-control-sm input-taxpayer-beneficiary-trust-blur" placeholder="" value="{{$beneficiaryInsurance->amount_receival_date}}" /> 
                              <label for="amount_receival_date">When will amount be received</label>
                            </div>
                          </div>

                          
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Does taxpayer have any founds  being held in trust by a third party? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="funds_held_in_trust" class="form-check-input input-check-taxpayer-have-any-founds" type="radio" value="unknown" {{($client->funds_held_in_trust == 'unknown') ? 'checked' : '' }} id="taxpayer-have-any-founds-home" checked="">
                <label class="form-check-label" for="taxpayer-have-any-founds-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="funds_held_in_trust" class="form-check-input input-check-taxpayer-have-any-founds" type="radio" value="no" {{($client->funds_held_in_trust == 'no') ? 'checked' : '' }} id="taxpayer-have-any-founds-office">
                <label class="form-check-label" for="taxpayer-have-any-founds-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="funds_held_in_trust" class="form-check-input input-check-taxpayer-have-any-founds" type="radio" value="yes" {{($client->funds_held_in_trust == 'yes') ? 'checked' : '' }} id="taxpayer-have-any-founds-office">
                <label class="form-check-label" for="taxpayer-have-any-founds-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->funds_held_in_trust == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-have-any-founds">
              <div class="col-md-12 p-5 card">

                @foreach($client->trustFunds as $trustFund)
                <div class="row item-trust-fund">
                  <input type="hidden" name="trustfund_id" id="trustfund_id" value="{{$trustFund->id}}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="number" step="0.01" min="0" id="amount" class="form-control form-control-sm input-trust-fund-blur" placeholder="" value="{{$trustFund->amount}}" />
                          <label for="amount">Amount </label>
                        </div>
                      </div>
                      <div class="col-md-9 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="location" class="form-control form-control-sm input-trust-fund-blur" placeholder="" value="{{$trustFund->location}}" />
                          <label for="location">Location </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach



              </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Is taxpayer a trustee, fiduciary or contributor of trust? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="trustee_fiduciary_contributor" class="form-check-input input-check-taxpayer-a-truste" type="radio" value="unknown" {{($client->trustee_fiduciary_contributor == 'unknown') ? 'checked' : '' }} id="is-taxpayer-truste-home" checked="">
                <label class="form-check-label" for="is-taxpayer-truste-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="trustee_fiduciary_contributor" class="form-check-input input-check-taxpayer-a-truste" type="radio" value="no" {{($client->trustee_fiduciary_contributor == 'no') ? 'checked' : '' }} id="is-taxpayer-truste-office">
                <label class="form-check-label" for="is-taxpayer-truste-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="trustee_fiduciary_contributor" class="form-check-input input-check-taxpayer-a-truste" type="radio" value="yes" {{($client->trustee_fiduciary_contributor == 'yes') ? 'checked' : '' }} id="is-taxpayer-truste-office">
                <label class="form-check-label" for="is-taxpayer-truste-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->trustee_fiduciary_contributor == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-a-truste">
              <div class="col-md-12 p-5 card">

                @foreach($client->trustees as $trustee)
                <div class="row item-trusteer-fiduciary">
                  <input type="hidden" name="trustee_id" id="trustee_id" value="{{$trustee->id}}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="trust_name" class="form-control form-control-sm input-trusteer-fiduciary-blur" placeholder="" value="{{$trustee->trust_name}}"/>
                          <label for="trust_name">Name of Trust </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="ein" class="form-control form-control-sm input-trusteer-fiduciary-blur" placeholder="" value="{{$trustee->ein}}" />
                          <label for="ein">EIN </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Does taxpayer have a safe deposit box (bussiness or personal)? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="safe_deposit_box" class="form-check-input input-check-taxpayer-have-safe-deposit" type="radio" value="unknown" {{($client->safe_deposit_box == 'unknown') ? 'checked' : '' }} id="taxpayer-have-safe-deposit-home" checked="">
                <label class="form-check-label" for="taxpayer-have-safe-deposit-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="safe_deposit_box" class="form-check-input input-check-taxpayer-have-safe-deposit" type="radio" value="no" {{($client->safe_deposit_box == 'no') ? 'checked' : '' }} id="taxpayer-have-safe-deposit-office">
                <label class="form-check-label" for="taxpayer-have-safe-deposit-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="safe_deposit_box" class="form-check-input input-check-taxpayer-have-safe-deposit" type="radio" value="yes" {{($client->safe_deposit_box == 'yes') ? 'checked' : '' }} id="taxpayer-have-safe-deposit-office">
                <label class="form-check-label" for="taxpayer-have-safe-deposit-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->safe_deposit_box == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-have-safe-deposit">
              <div class="col-md-12 p-5 card">

                @foreach($client->safeDepositBoxes as $safeDepositBox)
                <div class="row item-safe-deposit-box">
                  <input type="hidden" name="safedeposit_id" id="safedeposit_id" value="{{$safeDepositBox->id}}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="location_name" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->location_name}}"/>
                          <label for="location_name">Location Name </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="location_address" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->location_address}}"/>
                          <label for="location_address">Location Address </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="city_state_zip" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->city_state_zip}}"/>
                          <label for="city_state_zip">City, State, ZIP </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="box_numbers" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->box_numbers}}"/>
                          <label for="box_numbers">Box Number(s) </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="contents" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->contents}}"/>
                          <label for="contents">Contents </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="value" class="form-control form-control-sm input-safe-deposit-box-blur" placeholder="" value="{{$safeDepositBox->value}}"/>
                          <label for="value">Value </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Has taxpayer lived outside the U.S por 6 months or longer in the past 10 years? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="lived_outside_us" class="form-check-input input-check-taxpayer-lived-outside" type="radio" value="unknown" {{($client->lived_outside_us == 'unknown') ? 'checked' : '' }} id="taxpayer-lived-outside-home" checked="">
                <label class="form-check-label" for="taxpayer-lived-outside-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="lived_outside_us" class="form-check-input input-check-taxpayer-lived-outside" type="radio" value="no" {{($client->lived_outside_us == 'no') ? 'checked' : '' }} id="taxpayer-lived-outside-office">
                <label class="form-check-label" for="taxpayer-lived-outside-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="lived_outside_us" class="form-check-input input-check-taxpayer-lived-outside" type="radio" value="yes" {{($client->lived_outside_us == 'yes') ? 'checked' : '' }} id="taxpayer-lived-outside-office">
                <label class="form-check-label" for="taxpayer-lived-outside-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->lived_outside_us == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-lived-outside">
              <div class="col-md-12 p-5 card">

                @foreach($client->livedAbroads as $livedAbroad)
                <div class="row item-live-abroad">
                  <input type="hidden" name="liveabroad_id" id="liveabroad_id" value="{{$livedAbroad->id}}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="date" id="lived_abroad_from" class="form-control form-control-sm input-live-abroad-blur" placeholder="" value="{{$livedAbroad->lived_abroad_from}}"/>
                          <label for="lived_abroad_from">Lived abroad from </label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="date" id="lived_abroad_to" class="form-control form-control-sm input-live-abroad-blur" placeholder="" value="{{$livedAbroad->lived_abroad_to}}"/>
                          <label for="lived_abroad_to">Lived abroad to </label>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
        </div>
        <div class="col-md-12">
          <label class="form-check-label">Any property  or assets of value outside the U.S? </label>
          <div class="col mt-2">
              <div class="form-check form-check-inline">
                <input name="foreign_assets" class="form-check-input input-check-property-outside" type="radio" value="unknown" {{($client->foreign_assets == 'unknown') ? 'checked' : '' }} id="any-property-outside-home" checked="">
                <label class="form-check-label" for="any-property-outside-home">Unknown</label>
              </div>
              <div class="form-check form-check-inline">
                <input name="foreign_assets" class="form-check-input input-check-property-outside" type="radio" value="no" {{($client->foreign_assets == 'no') ? 'checked' : '' }} id="any-property-outside-office">
                <label class="form-check-label" for="any-property-outside-office">
                  No
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input name="foreign_assets" class="form-check-input input-check-property-outside" type="radio" value="yes" {{($client->foreign_assets == 'yes') ? 'checked' : '' }} id="any-property-outside-office">
                <label class="form-check-label" for="any-property-outside-office">
                  Yes
                </label>
              </div>
              
            </div>

            <div class="row p-5 {{($client->foreign_assets == 'yes') ? '' : 'd-none' }}" id="content-taxpayer-property-outside">
              <div class="col-md-12 p-5 card">
                @foreach($client->assetAbroads as $assetAbroad)
                <div class="row item-asset-abroad">
                  <input type="hidden" name="assetAbroad_id" id="assetAbroad_id" value="{{$assetAbroad->id}}">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="description" class="form-control form-control-sm input-asset-abroad-blur" placeholder="" value="{{$assetAbroad->description}}"/>
                          <label for="description">Provide description, location, and value </label>
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