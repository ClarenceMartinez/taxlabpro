<div class="tab-pane fade" id="navs-messages-card" role="tabpanel" style="text-align: left;">
          

          <div class="card-body pt-3">
            <form>
              <div class="row g-6">

                <div class="col-md-12">
                  <label class="form-check-label">Personal Bank Accounts? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="personal_bank_accounts" class="form-check-input input-check-personal-bank-account" type="radio"  id="is-personal-bank-account-home" value="unknown" {{($client->personal_bank_accounts == 'unknown') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is-personal-bank-account-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="personal_bank_accounts" class="form-check-input input-check-personal-bank-account" type="radio" value="no" {{($client->personal_bank_accounts == 'no') ? 'checked' : '' }} id="is-personal-bank-account-office">
                        <label class="form-check-label" for="is-personal-bank-account-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="personal_bank_accounts" class="form-check-input input-check-personal-bank-account" type="radio" value="yes" {{($client->personal_bank_accounts == 'yes') ? 'checked' : '' }} id="is-personal-bank-account-office">
                        <label class="form-check-label" for="is-personal-bank-account-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->personal_bank_accounts == 'yes') ? '' : 'd-none' }}" id="content-personal-bank-account">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->bankAccounts as $bankAccount)
                          <div class="row item-bank-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="bankAccount_id" id="bankAccount_id" value="{{$bankAccount->id}}">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm form-select input-bank-account-blur " id="type_of_account">
                                      <option value="0">Select</option>
                                      @foreach($bankAccountType as $type)
                                        <option value="{{$type->id}}" {{ $bankAccount->type_of_account == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                      @endforeach
                                      
                                    </select>
                                    <label for="type_of_account">Type of Account</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="bank_name" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->bank_name}}"/>
                                    <label for="bank_name">Bank Name</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="address" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->address}}"/>
                                    <label for="address">Address</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->city_state_zip}}"/>
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="account_number" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->account_number}}"/>
                                    <label for="account_number">Account Number</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->current_value}}"/>
                                    <label for="current_value">Current Value</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="statement_date" class="form-control form-control-sm input-bank-account-blur" placeholder="" value="{{$bankAccount->statement_date}}"/>
                                    <label for="statement_date">Statement Date</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-bank-account"><i class="ri-add-circle-fill"></i> Add Account</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Investment Accounts? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="investment_accounts" class="form-check-input input-check-investment-account" type="radio" value="unknown" {{($client->investment_accounts == 'unknown') ? 'checked' : '' }} id="is-investment-account-home" >
                        <label class="form-check-label" for="is-investment-account-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="investment_accounts" class="form-check-input input-check-investment-account" type="radio" value="no" {{($client->investment_accounts == 'no') ? 'checked' : '' }} id="is-investment-account-office">
                        <label class="form-check-label" for="is-investment-account-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="investment_accounts" class="form-check-input input-check-investment-account" type="radio" value="yes" {{($client->investment_accounts == 'yes') ? 'checked' : '' }} id="is-investment-account-office">
                        <label class="form-check-label" for="is-investment-account-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->investment_accounts == 'yes') ? '' : 'd-none' }}" id="content-investment-account">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->investmentAccounts as $investmentAccount)
                          <div class="row item-investment-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="investmentAccount_id" id="investmentAccount_id" value="{{$investmentAccount->id}}">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm form-select input-investment-account-blur" id="type_of_account">
                                      <option value="0">Select</option>
                                      @foreach($bankAccountType as $type)
                                        <option value="{{$type->id}}" {{ $investmentAccount->type_of_account == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="type_of_account">Type of Account</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="company_name" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->company_name}}"/>
                                    <label for="company_name">Company Name</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="address" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->address}}"/>
                                    <label for="address">Address</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->city_state_zip}}"/>
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="account_number" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->account_number}}"/>
                                    <label for="account_number">Account Number</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="company_phone" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->company_phone}}"/>
                                    <label for="company_phone">Company Phone</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->current_value}}"/>
                                    <label for="current_value">Current Value</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->loan_balance}}"/>
                                    <label for="loan_balance">Loan Balance</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="statement_date" class="form-control form-control-sm input-investment-account-blur" placeholder="" value="{{$investmentAccount->statement_date}}"/>
                                    <label for="statement_date">Statement Date</label>
                                  </div>
                                </div>

                                <div class="mb-4 mt-2">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-investment-account-blur" name="used_as_collateral" value="1" {{ ($investmentAccount->used_as_collateral == 1) ? 'checked' : '' }}>
                                    <span class="form-check-label">Used as Collateral on loan</span>
                                  </label>
                                </div>


                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-investment-account"><i class="ri-add-circle-fill"></i> Add Account</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Digital Assets? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="digital_assets" class="form-check-input input-check-digital-assets" type="radio" value="unknown" {{($client->digital_assets == 'unknown') ? 'checked' : '' }} id="is-digital-assets-home">
                        <label class="form-check-label" for="is-digital-assets-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="digital_assets" class="form-check-input input-check-digital-assets" type="radio" value="no" {{($client->digital_assets == 'no') ? 'checked' : '' }} id="is-digital-assets-office">
                        <label class="form-check-label" for="is-digital-assets-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="digital_assets" class="form-check-input input-check-digital-assets" type="radio" value="yes" {{($client->digital_assets == 'yes') ? 'checked' : '' }} id="is-digital-assets-office">
                        <label class="form-check-label" for="is-digital-assets-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5  {{($client->digital_assets == 'yes') ? '' : 'd-none' }}" id="content-digital-assets">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->digitalAssets as $digitalAsset)
                          <div class="row item-digital-assets  {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="digitalAsset_id" id="digitalAsset_id" value="{{$digitalAsset->id}}">

                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="description" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->description}}" />
                                    <label for="description">Type/Description of assets</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="email" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->email}}" />
                                    <label for="email">Email address used to setup asset</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="asset_name" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->asset_name}}" />
                                    <label for="asset_name">Name of asset(Virtual Wallet, DCE, etc)</label>
                                  </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="account_number" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->account_number}}" />
                                    <label for="account_number">Account # for assets held by broker</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="units" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->units}}" />
                                    <label for="units">Number of units</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="digital_address" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->digital_address}}" />
                                    <label for="digital_address">Digital address  for self-hosted assets</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="location" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->location}}" />
                                    <label for="location">Location(s)</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-digital-assets-blur" placeholder="" value="{{$digitalAsset->current_value}}" />
                                    <label for="current_value">Current Value</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-digital-assets"><i class="ri-add-circle-fill"></i> Add Currency</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Retirement accounts? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="retirement_accounts" class="form-check-input input-check-retirement-account" type="radio" value="unknown" {{($client->retirement_accounts == 'unknown') ? 'checked' : '' }} id="collapsible-address-type-home" >
                        <label class="form-check-label" for="collapsible-address-type-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="retirement_accounts" class="form-check-input input-check-retirement-account" type="radio" value="no" {{($client->retirement_accounts == 'no') ? 'checked' : '' }} id="collapsible-address-type-office">
                        <label class="form-check-label" for="collapsible-address-type-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="retirement_accounts" class="form-check-input input-check-retirement-account" type="radio" value="yes" {{($client->retirement_accounts == 'yes') ? 'checked' : '' }} id="collapsible-address-type-office">
                        <label class="form-check-label" for="collapsible-address-type-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->retirement_accounts == 'yes') ? '' : 'd-none' }}" id="content-retirement-account">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->retirementAccounts as $retirementAccount)
                          <div class="row item-retirement-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }} ">
                              <input type="hidden" name="retirementAccount_id" id="retirementAccount_id" value="{{$retirementAccount->id}}">
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <select class="form-control form-control-sm form-select input-retirement-account-blur" id="account_type">
                                    <option value="0">Select</option>
                                      @foreach($bankAccountType as $type)
                                        <option value="{{$type->id}}" {{ $retirementAccount->type_of_account == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                      @endforeach
                                  </select>
                                  <label for="account_type">Type of account</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="account_number" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->account_number}}"/>
                                  <label for="account_number">Account Number</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="company_name" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->company_name}}"/>
                                  <label for="company_name">Company Name</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="address" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->address}}"/>
                                  <label for="address">Address</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->city_state_zip}}"/>
                                  <label for="city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="company_phone" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->company_phone}}"/>
                                  <label for="company_phone">Company Phone</label>
                                </div>
                              </div>
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->current_value}}"/>
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>

                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="loan_balance" class="form-control form-control-sm input-retirement-account-blur" placeholder="" value="{{$retirementAccount->loan_balance}}"/>
                                  <label for="loan_balance">Loan Balance</label>
                                </div>
                              </div>

                              
                              <div class="col-md-4 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="statement_date" class="form-control form-control-sm input-retirement-account-blur date-simple flatpickr-input" placeholder="YYYY-MM-DD" value="{{$retirementAccount->statement_date}}"/>
                                  <label for="statement_date">Statement Date</label>
                                </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-retirement-account-change" name="used_as_collateral"  id="used_as_collateral" value="1" {{($retirementAccount->used_as_collateral == 1)  ? 'checked' : ''}}>
                                    <span class="form-check-label">Used as collateral on loan</span>
                                  </label>
                                  <br>
                                  <label class="form-check m-0">
                                    <input type="checkbox" class="form-check-input check-retirement-account-change" id="custom_quick_sale" value="1" name="custom_quick_sale" {{($retirementAccount->custom_quick_sale == 1)  ? 'checked' : ''}}>
                                    <span class="form-check-label">Used custom Quick Sale % instead of 0.8</span>
                                  </label>
                              </div>

                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="fed_tax_rate" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value="{{$retirementAccount->fed_tax_rate}}"/>
                                  <label for="fed_tax_rate">Fed Tax Rate (%)</label>
                                </div>
                              </div>
                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="fed_penalty" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value="{{$retirementAccount->fed_penalty}}"/>
                                  <label for="fed_penalty">Fed Penalty (%)</label>
                                </div>
                              </div>

                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="state_tax_rate" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value="{{$retirementAccount->state_tax_rate}}" />
                                  <label for="state_tax_rate">State Tax Rate (%)</label>
                                </div>
                              </div>

                              <div class="col-md-3 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="state_penalty" class="form-control form-control-sm input-retirement-account-blur" placeholder="" readonly="" value="{{$retirementAccount->state_penalty}}"/>
                                  <label for="state_penalty">State Penalty (%)</label>
                                </div>
                              </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-retirement-account"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Available credit, included credit card? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="available_credit" class="form-check-input input-check-available-credit" type="radio" value="unknown" {{($client->available_credit == 'unknown') ? 'checked' : '' }} id="is-taxpayer-employed-home">
                        <label class="form-check-label" for="is-taxpayer-employed-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="available_credit" class="form-check-input input-check-available-credit" type="radio" value="no" {{($client->available_credit == 'no') ? 'checked' : '' }} id="is-taxpayer-employed-office">
                        <label class="form-check-label" for="is-taxpayer-employed-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="available_credit" class="form-check-input input-check-available-credit" type="radio" value="yes" {{($client->available_credit == 'yes') ? 'checked' : '' }} id="is-taxpayer-employed-office">
                        <label class="form-check-label" for="is-taxpayer-employed-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>

                    <div class="row p-5 {{($client->available_credit == 'yes') ? '' : 'd-none' }}" id="content-question-available-credit">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->creditAccounts as $creditAccount)
                          <div class="row item-credit-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="creditAccount_id" id="creditAccount_id" value="{{$creditAccount->id}}">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="bank_name" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->bank_name}}"/>
                                    <label for="bank_name">Bank Name</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="bank_address" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->bank_address}}"/>
                                    <label for="bank_address">Bank Address</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->city}}"/>
                                    <label for="city">City</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->city_state_zip}}"/>
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="property_security" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->property_security}}"/>
                                    <label for="property_security">Property / Security</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="account_number" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->account_number}}"/>
                                    <label for="account_number">Account Number</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="credit_limit" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->credit_limit}}"/>
                                    <label for="credit_limit">Credit Limit</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="loan_balance" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->loan_balance}}"/>
                                    <label for="loan_balance">Loan Balance</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="num" id="employed_years" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->employed_years}}"/>
                                    <label for="employed_years">Employed Years</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="minimum_monthly_payment" class="form-control form-control-sm input-credit-account-blur" placeholder="" value="{{$creditAccount->minimum_monthly_payment}}"/>
                                    <label for="minimum_monthly_payment">Minimun Mounthly pmt</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="statement_date" class="form-control form-control-sm input-credit-account-blur date-simple flatpickr-input" placeholder="YYYY-MM-DD" value="{{$creditAccount->statement_date}}" />
                                    <label for="statement_date">Statement Date</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-question-available-credit"><i class="ri-add-circle-fill"></i> Add Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Have life insurance with cash valued? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="life_insurance_cash_value" class="form-check-input input-check-life-insurance" type="radio" value="unknown" {{($client->life_insurance_cash_value == 'unknown') ? 'checked' : '' }}  id="is-individual-spouse-employed-home">
                        <label class="form-check-label" for="is-individual-spouse-employed-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="life_insurance_cash_value" class="form-check-input input-check-life-insurance" type="radio" value="no" {{($client->life_insurance_cash_value == 'no') ? 'checked' : '' }}  id="is-individual-spouse-employed-office">
                        <label class="form-check-label" for="is-individual-spouse-employed-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="life_insurance_cash_value" class="form-check-input input-check-life-insurance" type="radio" value="yes" {{($client->life_insurance_cash_value == 'yes') ? 'checked' : '' }}  id="is-individual-spouse-employed-office">
                        <label class="form-check-label" for="is-individual-spouse-employed-office">
                          Yes
                        </label>
                      </div>
                  </div>

                  <div class="row p-5 {{($client->life_insurance_cash_value == 'yes') ? '' : 'd-none' }}" id="content-life-insurance">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->lifeInsurances as $lifeInsurance)
                          <div class="row item-life-insurance {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="lifeInsurance_id" id="lifeInsurance_id" value="{{$lifeInsurance->id}}">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="company_name" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->company_name}}" />
                                    <label for="company_name">Company Name</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="company_address" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->company_address}}" />
                                    <label for="company_address">Company Address</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->city_state_zip}}" />
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="policy_number" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->policy_number}}" />
                                    <label for="policy_number">Policy Number(s)</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="policy_owner" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->policy_owner}}"/>
                                    <label for="policy_owner">Policiy Owner</label>
                                  </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="num" id="current_cash_value" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->current_cash_value}}"/>
                                    <label for="current_cash_value">Current  Cash Value</label>
                                  </div>
                                </div>

                                <div class="col-md-4 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="outstanding_loan_balance" class="form-control form-control-sm input-life-insurance-blur" placeholder="" value="{{$lifeInsurance->outstanding_loan_balance}}"/>
                                    <label for="outstanding_loan_balance">Outstanding  Loan Balance</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-life-insurance"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">In the past 10 years have any assets been transferred  for less than Value? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="assets_transferred_10_years" class="form-check-input input-check-then-year-have-any" type="radio" value="unknown" {{($client->assets_transferred_10_years == 'unknown') ? 'checked' : '' }} id="other-bussiness-interest-home">
                        <label class="form-check-label" for="other-bussiness-interest-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="assets_transferred_10_years" class="form-check-input input-check-then-year-have-any" type="radio" value="no" {{($client->assets_transferred_10_years == 'no') ? 'checked' : '' }} id="other-bussiness-interest-office">
                        <label class="form-check-label" for="other-bussiness-interest-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="assets_transferred_10_years" class="form-check-input input-check-then-year-have-any" type="radio" value="yes" {{($client->assets_transferred_10_years == 'yes') ? 'checked' : '' }} id="other-bussiness-interest-office">
                        <label class="form-check-label" for="other-bussiness-interest-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->assets_transferred_10_years == 'yes') ? '' : 'd-none' }}" id="content-then-year-have-any">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->assetTransfers as $assetTransfer)
                          <div class="row item-asset-transfer {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="assetTransfer_id" id="assetTransfer_id" value="{{$assetTransfer->id}}">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="business_name" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->business_name}}"/>
                                    <label for="business_name">Business Name</label>
                                  </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="business_address" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->business_address}}"/>
                                    <label for="business_address">Business Address</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="city_state_zip" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->city_state_zip}}"/>
                                    <label for="city_state_zip">City, State, ZIP</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->phone}}"/>
                                    <label for="phone">Phone</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="row">

                                <div class="col-md-7 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <select class="form-control form-control-sm form-select input-asset-transfer-blur" name="type_of_business" id="type_of_business">
                                      <option value="0">Select</option>
                                      @foreach($businessTypes as $type)
                                        <option value="{{$type->id}}" {{ $assetTransfer->type_of_business == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="type_of_business">Type of Bussiness</label>
                                  </div>
                                </div>
                                <div class="col-md-5 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="ownership_percentage" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->ownership_percentage}}"/>
                                    <label for="ownership_percentage">% Ownership</label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="title" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->title}}"/>
                                    <label for="title">Title </label>
                                  </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="ein" class="form-control form-control-sm input-asset-transfer-blur" placeholder="" value="{{$assetTransfer->ein}}"/>
                                    <label for="ein">EIN </label>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-then-year-have-any"><i class="ri-add-circle-fill"></i> Add More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">In the past 3 years has any real state property  been transferred? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="real_estate_transferred_3_years" class="form-check-input input-check-three-year-any-property" type="radio" value="unknown" {{($client->real_estate_transferred_3_years == 'unknown') ? 'checked' : '' }} id="is-past-3-year-any-real-home">
                        <label class="form-check-label" for="is-past-3-year-any-real-home">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="real_estate_transferred_3_years" class="form-check-input input-check-three-year-any-property" type="radio" value="no" {{($client->real_estate_transferred_3_years == 'no') ? 'checked' : '' }} id="is-past-3-year-any-real-office">
                        <label class="form-check-label" for="is-past-3-year-any-real-office">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="real_estate_transferred_3_years" class="form-check-input input-check-three-year-any-property" type="radio" value="yes" {{($client->real_estate_transferred_3_years == 'yes') ? 'checked' : '' }} id="is-past-3-year-any-real-office">
                        <label class="form-check-label" for="is-past-3-year-any-real-office">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->real_estate_transferred_3_years == 'yes') ? '' : 'd-none' }}" id="content-three-year-any-property">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->realEstateTransfers as $realEstateTransfer)
                          <div class="row item-real-state-transfer {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="realEstateTransfer_id" id="realEstateTransfer_id" value="{{$realEstateTransfer->id}}">
                            <div class="col-md-6">
                              <div class="row">
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="text" id="assets" class="form-control form-control-sm input-real-state-transfer-blur" placeholder="" value="{{$realEstateTransfer->assets}}"/>
                                    <label for="assets">Assets</label>
                                  </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                  <div class="form-floating form-floating-outline">
                                    <input type="date" id="date_transferred" class="form-control form-control-sm input-real-state-transfer-blur" placeholder="" value="{{$realEstateTransfer->date_transferred}}"/>
                                    <label for="date_transferred">Date Transferred</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-three-year-any-property"><i class="ri-add-circle-fill"></i> Add RE transfer</a>
                        </div>
                    </div>
                </div>
              </div>
            </form>
          </div>
      </div>