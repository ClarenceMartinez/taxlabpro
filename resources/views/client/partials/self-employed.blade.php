<div class="tab-pane fade" id="navs-self-employed-card" role="tabpanel" style="text-align: left;">
          <div class="card-body pt-3">
            <form>
              <div class="row g-6">

                <div class="col-md-12">
                  <div class="row">
                    <input type="hidden" name="bussines_client_id" id="bussines_client_id" value="{{$client->id}}">
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_name" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_name}}" />
                          <label for="business_name">Business Name</label>
                        </div>
                      </div>

                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="trade_name" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->trade_name}}" />
                          <label for="trade_name">Trade Name/DBA</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_street" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_street}}" />
                          <label for="business_street">Street</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_city" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_city}}" />
                          <label for="business_city">City </label>
                        </div>
                      </div>

                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_state" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_state}}" />
                          <label for="business_state">State</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_zip_code" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_zip_code}}" />
                          <label for="business_zip_code">ZIP Code</label>
                        </div>
                      </div>

                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_phone" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_phone}}" />
                          <label for="business_phone">Phone</label>
                        </div>
                      </div>

                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_ein" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_ein}}" />
                          <label for="business_ein">EIN</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="type_of_business" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->type_of_business}}" />
                          <label for="type_of_business">Type of business</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="business_website" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->business_website}}" />
                          <label for="business_website">Business website</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="total_number_of_employees" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->total_number_of_employees}}" />
                          <label for="total_number_of_employees">Total Number of Employees</label>
                        </div>
                      </div>

                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="average_gross_monthly_payroll" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->average_gross_monthly_payroll}}" />
                          <label for="average_gross_monthly_payroll">Average Gross Monthly Payroll</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="frequency_tax_deposits" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->frequency_tax_deposits}}" />
                          <label for="frequency_tax_deposits">Frecuency of Tax Deposits</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2">
                        <div class="form-floating form-floating-outline">
                          <input type="text" id="cash_on_hand" class="form-control form-control-sm input-433a-self-employed-blur" placeholder="" value="{{$client->cash_on_hand}}" />
                          <label for="cash_on_hand">Cash on Hand</label>
                        </div>
                      </div>

                  </div>
                  <div class="mb-4 mt-2">
                    <label class="form-check m-0">
                      <input type="checkbox" class="form-check-input input-433a-self-employed-check" value="1" id="sole_proprietorship" {{ ($client->sole_proprietorship == 1) ? 'checked' : ''}}>
                      <span class="form-check-label">Sole propiertorship</span>
                    </label>
                  </div>
                  <div class="mb-4 mt-2">
                    <label class="form-check m-0">
                      <input type="checkbox" class="form-check-input input-433a-self-employed-check" value="1" id="federal_contractor" {{ ($client->federal_contractor == 1) ? 'checked' : ''}}>
                      <span class="form-check-label">Federal Contractor</span>
                    </label>
                  </div>
                </div>



                <div class="col-md-12">
                  <label class="form-check-label">Does you business engage in e-commerce, internet sales or accept virtual currency? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_ecommerce_virtual_currency" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_ecommerce_virtual_currency == 'unknown') ? 'checked' : '' }}  id="" >
                        <label class="form-check-label" for="is-business-engage-e-commerce">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_ecommerce_virtual_currency" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_ecommerce_virtual_currency == 'no') ? 'checked' : '' }}  id="">
                        <label class="form-check-label" for="is-business-engage-e-commerce">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_ecommerce_virtual_currency" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_ecommerce_virtual_currency == 'yes') ? 'checked' : '' }}  id="">
                        <label class="form-check-label" for="is-business-engage-e-commerce">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_ecommerce_virtual_currency == 'yes') ? '' : 'd-none' }}" id="content-business-engage-e-commerce">
                        <div class="col-md-12 p-5 card">

                          @foreach($client->paymentProcessors as $paymentProcessor)
                            <div class="row item-business-engage-e-commerce {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="paymentProcessor_id" id="paymentProcessor_id" value="{{$paymentProcessor->id}}">
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="processor_name" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="{{$paymentProcessor->processor_name}}" />
                                  <label for="processor_name">Processor Name</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="street_address" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="{{$paymentProcessor->street_address}}" />
                                  <label for="street_address">Street Address</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="{{$paymentProcessor->city_state_zip}}" />
                                  <label for="city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="account_number" class="form-control form-control-sm input-business-engage-e-commerce-blur" value="{{$paymentProcessor->account_number}}" />
                                  <label for="account_number">Account Number</label>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-engage-e-commerce"><i class="ri-add-circle-fill"></i> Add Processor</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                  <label class="form-check-label">Does you business accept credit card? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_accept_credit_card" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_accept_credit_card == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_accept_credit_card">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_accept_credit_card" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_accept_credit_card == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_accept_credit_card">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_accept_credit_card" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_accept_credit_card == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_accept_credit_card">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_accept_credit_card == 'yes') ? '' : 'd-none' }}" id="content-business-accept-credit-card">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->creditCards as $creditCard)
                          
                          <div class="row item-business-accept-credit-card {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="creditCard_id" id="creditCard_id" value="{{$creditCard->id}}">
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="card_type" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->card_type}}" />
                                <label for="card_type">Card Type</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="name_on_account" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->name_on_account}}" />
                                <label for="name_on_account">Name on Account</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="merchant_account_number" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->merchant_account_number}}" />
                                <label for="merchant_account_number">Merchant Account Number</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="issuing_bank" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->issuing_bank}}" />
                                <label for="issuing_bank">Issuing Bank</label>
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="street_address" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->street_address}}" />
                                <label for="street_address">Street Address</label>
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->city_state_zip}}" />
                                <label for="city_state_zip">City, State, ZIP</label>
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="phone" class="form-control form-control-sm input-business-accept-credit-card-blur" value="{{$creditCard->phone}}" />
                                <label for="phone">Phone</label>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-accept-credit-card"><i class="ri-add-circle-fill"></i> Add Credit Card</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Does you business have any bank accounts? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_bank_accounts" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_bank_accounts == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_bank_accounts">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_bank_accounts" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_bank_accounts == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_bank_accounts">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_bank_accounts" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_bank_accounts == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_bank_accounts">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_bank_accounts == 'yes') ? '' : 'd-none' }}" id="content-business-have-any-bank">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->businessBankAccounts as $businessBankAccount)
                          <div class="row item-business-have-any-bank {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                            <input type="hidden" name="businessBankAccount_id" id="businessBankAccount_id" value="{{$businessBankAccount->id}}">
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <select class="form-control form-control-sm form-select input-business-have-any-bank-blur" name="type_of_account" id="type_of_account">
                                  <option value="0">Select</option>
                                  @foreach($bankAccountType as $type)
                                  <option value="{{$type->id}}" {{ ($type->id == $businessBankAccount->type_of_account) ? 'selected' : '' }}>{{$type->name}}</option>
                                  @endforeach
                                </select>
                                <label for="type_of_account">Type of Account</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="bank_name" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->bank_name}}" />
                                <label for="bank_name">Bank Name</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="bank_address" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->bank_address}}" />
                                <label for="bank_address">Bank Address</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->city_state_zip}}" />
                                <label for="city_state_zip">City, State, ZIP</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="account_number" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->account_number}}" />
                                <label for="account_number">Account Number</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->current_value}}" />
                                <label for="current_value">Current Value</label>
                              </div>
                            </div>

                            <div class="col-md-6 mt-2">
                              <div class="form-floating form-floating-outline">
                                <input type="date" id="statement_date" class="form-control form-control-sm input-business-have-any-bank-blur" value="{{$businessBankAccount->statement_date}}" />
                                <label for="statement_date">Statement Date</label>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-have-any-bank"><i class="ri-add-circle-fill"></i> Add Account</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Does you business own any digital assets ? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_digital_assets" class="form-check-input input-check-toogle" type="radio"  value="unknown" {{($client->business_digital_assets == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_digital_assets">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_digital_assets" class="form-check-input input-check-toogle" type="radio"  value="no" {{($client->business_digital_assets == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_digital_assets">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_digital_assets" class="form-check-input input-check-toogle" type="radio"  value="yes" {{($client->business_digital_assets == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_digital_assets">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_digital_assets == 'yes') ? '' : 'd-none' }}" id="content-business-own-any-digital-assets">
                        <div class="col-md-12 p-5 card">

                            @foreach($client->companyDigitalAssets as $companyDigitalAsset)
                            <div class="row  item-business-own-any-digital-assets {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="companyDigitalAsset_id" id="companyDigitalAsset_id" value="{{$companyDigitalAsset->id}}">
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="description" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->description}}" />
                                  <label for="description">Description</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="account_number" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->account_number}}" />
                                  <label for="account_number">Account # for assets held by broker</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="number_of_units" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->number_of_units}}" />
                                  <label for="number_of_units">Number of units</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="digital_address" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->digital_address}}" />
                                  <label for="digital_address">Digital address for  self-hosted assets</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="location" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->location}}" />
                                  <label for="location">Location(s)</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-own-any-digital-assets-blur" value="{{$companyDigitalAsset->current_value}}" />
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-own-any-digital-assets"><i class="ri-add-circle-fill"></i> Add Currenty</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Does you business have any accounts/notes receivable? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_accounts_receivable" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_accounts_receivable == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_accounts_receivable">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_accounts_receivable" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_accounts_receivable == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_accounts_receivable">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_accounts_receivable" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_accounts_receivable == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="is-business-have-any-account-notes">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_accounts_receivable == 'yes') ? '' : 'd-none' }}" id="content-business-have-any-account-notes">
                        <div class="col-md-12 p-5 card">
                          @foreach($client->companyAccountReceivables as $companyAccountReceivable)
                            <div class="row item-business-have-any-account-notes {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="companyAccountReceivable_id" id="companyAccountReceivable_id" value="{{$companyAccountReceivable->id}}">
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="account_description" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->account_description}}" />
                                  <label for="account_description">Account descrription</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="address" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->address}}" />
                                  <label for="address">Address</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->city_state_zip}}" />
                                  <label for="city_state_zip">City, State,ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="contact" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->contact}}" />
                                  <label for="contact">Contact</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="phone" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->phone}}" />
                                  <label for="phone">Phone</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="status" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->status}}" />
                                  <label for="status">Status</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="due_date" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->due_date}}" />
                                  <label for="due_date">Due Date</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="invoice_no" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->invoice_no}}" />
                                  <label for="invoice_no">Invoice No</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" id="amount_due" class="form-control form-control-sm input-business-have-any-account-notes-blur" value="{{$companyAccountReceivable->amount_due}}" />
                                  <label for="amount_due">Amount Due</label>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-have-any-account-notes"><i class="ri-add-circle-fill"></i> Add Receivable</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Does you business have any tools/equipment? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_tools_equipment" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_tools_equipment == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_tools_equipment">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_tools_equipment" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_tools_equipment == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_tools_equipment">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_tools_equipment" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_tools_equipment == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_tools_equipment">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5  {{($client->business_tools_equipment == 'yes') ? '' : 'd-none' }}" id="content-business-have-any-tools-equiment">
                        <div class="col-md-12 p-5 card">
                          @foreach ($client->companyToolEquipments as $companyToolEquipment)
                            <div class="row item-business-have-any-tools-equiment {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="companyToolEquipments_id" id="companyToolEquipments_id" value="{{$companyToolEquipment->id}}">
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="description" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->description}}" />
                                  <label for="description">Description</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="street_address" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->street_address}}" />
                                  <label for="street_address">Street Address</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="city_state_zip" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->city_state_zip}}" />
                                  <label for="city_state_zip">City, State,ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->purchase_date}}" />
                                  <label for="purchase_date">Purchase Date</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->current_value}}" />
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="status" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->status}}" />
                                  <label for="status">Status</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="current_loan_balance" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->current_loan_balance}}" />
                                  <label for="current_loan_balance">Current loan Balance</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="monthly_payment" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->monthly_payment}}" />
                                  <label for="monthly_payment">Monthly payment</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="date_of_final_payment" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->date_of_final_payment}}" />
                                  <label for="date_of_final_payment">Date of final payment</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->lender}}" />
                                  <label for="lender">Lender</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_address" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->lender_address}}" />
                                  <label for="lender_address">Lender address</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_city_state_zip" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->lender_city_state_zip}}" />
                                  <label for="lender_city_state_zip">City, State, ZIP</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="lender_phone" class="form-control form-control-sm input-business-have-any-tools-equiment-blur" value="{{$companyToolEquipment->lender_phone}}" />
                                  <label for="lender_phone">Lender Phone</label>
                                </div>
                              </div>
                              <div class="mb-4">
                                <label class="form-check m-0">
                                  <input type="checkbox" class="form-check-input check-business-have-any-tools-equiment-blur" name="is_leased_or_income_generating" id="is_leased_or_income_generating" value="1" {{($companyToolEquipment->is_leased_or_income_generating == 1) ? 'checked'  : ''}}>
                                  <span class="form-check-label">Asset is leased or used to generate income</span>
                                </label>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-have-any-tools-equiment"><i class="ri-add-circle-fill"></i> Add Asset</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Does you business have any intangible assets? </label>
                  <div class="col mt-2">
                      <div class="form-check form-check-inline">
                        <input name="business_intangible_assets" class="form-check-input input-check-toogle" type="radio" value="unknown" {{($client->business_intangible_assets == 'unknown') ? 'checked' : '' }} id="" >
                        <label class="form-check-label" for="business_intangible_assets">Unknown</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_intangible_assets" class="form-check-input input-check-toogle" type="radio" value="no" {{($client->business_intangible_assets == 'no') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_intangible_assets">
                          No
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input name="business_intangible_assets" class="form-check-input input-check-toogle" type="radio" value="yes" {{($client->business_intangible_assets == 'yes') ? 'checked' : '' }} id="">
                        <label class="form-check-label" for="business_intangible_assets">
                          Yes
                        </label>
                      </div>
                      
                    </div>
                    <div class="row p-5 {{($client->business_intangible_assets == 'yes') ? '' : 'd-none' }}" id="content-business-have-any-intangible-assets">
                        <div class="col-md-12 p-5 card">
                          @foreach ($client->companyIntangibleAssets as $companyIntangibleAsset)
                            <div class="row item-business-have-any-intangible-assets {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
                              <input type="hidden" name="companyIntangibleAsset_id" id="companyIntangibleAsset_id" value="{{$companyIntangibleAsset->id}}">
                              <div class="col-md-12 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="text" id="description" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="{{$companyIntangibleAsset->description}}" />
                                  <label for="description">Description</label>
                                </div>
                              </div>
                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="number" step="0.01" min="0" id="current_value" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="{{$companyIntangibleAsset->current_value}}" />
                                  <label for="current_value">Current Value</label>
                                </div>
                              </div>

                              <div class="col-md-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                  <input type="date" id="purchase_date" class="form-control form-control-sm input-business-have-any-intangible-assets-blur" value="{{$companyIntangibleAsset->purchase_date}}" />
                                  <label for="purchase_date">Purchase Date</label>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div class="col-md-12 mt-3">
                          <a href="javascript:;" id="add-item-business-have-any-intangible-assets"><i class="ri-add-circle-fill"></i> Add Asset</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                  <label class="form-check-label">Account Method used? </label>
                  <div class="col mt-2">
                    <div class="form-check form-check-inline">
                      <input name="account_method" class="form-check-input change-income-expense-period-check" type="radio" value="cash" id="account_method" {{ (isset($client->incomeExpensePeriods[0]) && $client->incomeExpensePeriods[0]->account_method == 'cash') ? 'checked' : '' }}>
                      <label class="form-check-label" for="account_method">Cash</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input name="account_method" class="form-check-input change-income-expense-period-check" type="radio" value="accrual" id="account_method" {{ ( isset($client->incomeExpensePeriods[0]) && $client->incomeExpensePeriods[0]->account_method == 'accrual') ? 'checked' : '' }}>
                      <label class="form-check-label" for="account_method">
                        Accrual
                      </label>
                    </div>                    
                  </div>
                </div>
                


                <div class="col-md-12">
                  <label class="form-check-label">Income expense period</label>

                  <div class="row">
                    <input type="hidden" name="incomeExpensePeriods_id" id="incomeExpensePeriods_id" value="{{ isset($client->incomeExpensePeriods[0]) ?$client->incomeExpensePeriods[0]->id : ''}}">
                    <div class="col-md-4">
                      <div class="form-floating form-floating-outline">
                        <input type="date" id="from_date" class="form-control form-control-sm input-income-expense-period-blur" value="{{ isset($client->incomeExpensePeriods[0]) ? $client->incomeExpensePeriods[0]->from_date : ''}}" />
                        <label for="from_date">From</label>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating form-floating-outline">
                        <input type="date" id="to_date" class="form-control form-control-sm input-income-expense-period-blur" value="{{ isset($client->incomeExpensePeriods[0]) ? $client->incomeExpensePeriods[0]->to_date : ''}}" />
                        <label for="to_date">To</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-2 mb-4">
                    <label class="form-check m-0 p-0">
                      <span class="form-check-label">Provide a breakdown below of taxper's average monthly income and expenses, based on the period of time used above.</span>
                    </label>
                  </div>                  
                </div>

                <div class="col-md-12">
                  <div class="row p-0">
                    <div class="col-md-6 p-1">
                      <h6 class="pt-0">Total Monthly Business Income</h6>
                      <table class="table table-bordered table-responsive">
                        <thead>
                          <tr>
                            <th>Source</th>
                            <th>Gross Monthly</th>
                          </tr>
                        </thead>
                        <tr>
                          <td>Gross Receipts</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Gross Rental Income</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Interest</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Dividends</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Cash Receipts</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        </tr>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        </tr>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        </tr>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        </tr>
                          <td>Total</td>
                          <td><p class="text-end">0.00</p></td>
                        </tr>
                        
                      </table>
                    </div>
                    <div class="col-md-6 p-1">
                      <h6 class="pt-0">Total Monthly Business Expenses</h6>
                      <table class="table table-bordered table-responsive">
                        <thead>
                          <tr>
                            <th>Expense Items</th>
                            <th>Actual Monthly</th>
                          </tr>
                        </thead>
                        <tr>
                          <td>Material Purchased</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Inventory Purchased</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Gross wages & Salaries</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Rent</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Supplies</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Utilities/telephone</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Vehicle Gasoline/Oil</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Repairs & Maintenance</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>
                        <tr>
                          <td>Insurance</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>

                        <tr>
                          <td>Current Taxes</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>

                        <tr>
                          <td>Other Secured Debts</td>
                          <td><input type="text" class="form-control form-control-sm" name=""></td>
                        </tr>

                        <tr>
                          <td><a href="javascript:;">Add expense</a></td>
                          <td></td>
                        </tr>

                        </tr>
                          <td>Total</td>
                          <td><p class="text-end">0.00</p></td>
                        </tr>
                        
                      </table>
                    </div>
                  </div>
                </div> 
              </div>
            </form>
          </div>
      </div>