<div class="tab-pane fade" id="433b-navs-assets-liabilities" role="tabpanel" style="text-align:left;">
        <!-- <h4 class="card-title">Personal & Emp</h4> -->
        <div class="card-body pt-3">
            <form>
	              <!-- <h6 class="pt-0">1. Account Details</h6> -->
	              <div class="row g-6">
                		<div class="col-md-12">

                			<!-- Pregunta: ¿El negocio tiene cuentas bancarias? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Business bank accounts?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_bank_accounts" value="unknown" {{($client->business_bank_accounts == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_bank_accounts" value="no" {{($client->business_bank_accounts == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_bank_accounts" value="yes" {{($client->business_bank_accounts == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de detalles de cuenta bancaria -->
							    <div id="" class="row p-5 {{($client->business_bank_accounts == 'yes') ? '' : 'd-none'}} contenedor">
								    <div class="col-md-12 p-5 card">

								    	@foreach($client->bankAccounts as $bankAccounts)
								        <div class="row item-dependent item-433b-bank-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								        	<input type="hidden" name="bankAccount_id" id="bankAccount_id" value="{{$bankAccounts->id}}">
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <select class="form-select input-433b-bank-account-blur" id="type_of_account">
								                        <option value="">Select</option>
								                        @foreach($bankAccountType as $item)
								                        	<option value="{{$item->id}}" {{ ($item->id == $bankAccounts->type_of_account) ? 'selected' : '' }}>{{$item->name}}</option>
								                        @endforeach
								                    </select>
								                    <label for="type_of_account">Type of account</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-bank-account-blur" id="account_number" placeholder="Account Number" value="{{$bankAccounts->account_number}}">
								                    <label for="account_number">Account Number</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-bank-account-blur" id="bank_name" placeholder="Bank Name" value="{{$bankAccounts->bank_name}}">
								                    <label for="bank_name">Bank Name</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-bank-account-blur" id="current_value" placeholder="Current Value" value="{{$bankAccounts->current_value}}">
								                    <label for="current_value">Current Value</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-bank-account-blur" id="address" placeholder="Address" value="{{$bankAccounts->address}}">
								                    <label for="address">Address</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control form-control-sm input-433b-bank-account-blur" id="statement_date" placeholder="Statement Date" value="{{$bankAccounts->statement_date}}">
								                    <label for="statement_date">Statement Date</label>
								                </div>
								            </div>
								            <div class="col-md-12">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-bank-account-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$bankAccounts->city_state_zip}}">
								                    <label for="city_state_zip">City, State, ZIP</label>
								                </div>
								            </div>

								            <!-- <div class="col-md-12 mt-3">
								                <a href="#" class="text-primary">Add Account</a>
								                <span class="float-end fw-bold">$0</span>
								            </div> -->
								        </div>
								        @endforeach
								    </div>
								</div>


							</div>

							<!-- Pregunta: ¿El negocio tiene cuentas/notas por cobrar? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Does the business have any accounts/notes receivable?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="accounts_notes_receivable" value="unknown" {{($client->accounts_notes_receivable == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="accounts_notes_receivable" value="no" {{($client->accounts_notes_receivable == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="accounts_notes_receivable" value="yes" {{($client->accounts_notes_receivable == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de detalles de cuentas por cobrar -->
							    <div id="" class="row p-5 {{($client->accounts_notes_receivable == 'yes') ? '' : 'd-none'}} contenedor">
								    <div class="col-md-12 p-5 card">

								    	@foreach($client->receivables as $receivable)
								        <div class="row item-dependent item-433b-receivable">
								        	<input type="hidden" name="receivable_id" id="receivable_id" value="{{$receivable->id}}">
								            <div class="col-md-12">
								                <div class="form-floating form-floating-outline mt-3">
								                    <div class="form-control border-none">
								                        <label class="me-3">Type</label>
								                        <input type="radio" id="account" name="type" class="form-check-input input-433b-receivable-check" value="account" {{ ($receivable->type=='account') ? 'checked' : ''}}>
								                        <label for="account">Account</label>
								                        <input type="radio" id="note" name="type" class="ms-3 form-check-input input-433b-receivable-check" value="note" {{ ($receivable->type=='note') ? 'checked' : ''}}>
								                        <label for="note">Note</label>
								                    </div>
								                </div>
								            </div>

								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="account_description" placeholder="Account Description" value="{{$receivable->account_description}}">
								                    <label for="account_description">Account Description</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="status" placeholder="Status" value="{{$receivable->status}}">
								                    <label for="status">Status</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="address" placeholder="Address" value="{{$receivable->address}}">
								                    <label for="address">Address</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control form-control-sm input-433b-receivable-blur" id="due_date" placeholder="Due Date" value="{{$receivable->due_date}}">
								                    <label for="due_date">Due Date</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$receivable->city_state_zip}}">
								                    <label for="city_state_zip">City, State, ZIP</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="invoice_no" placeholder="Invoice No" value="{{$receivable->invoice_no}}">
								                    <label for="invoice_no">Invoice No</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="contact" placeholder="Contact" value="{{$receivable->contact}}">
								                    <label for="contact">Contact</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="amount_due" placeholder="Amount Due" value="{{$receivable->amount_due}}">
								                    <label for="amount_due">Amount Due</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-receivable-blur" id="phone" placeholder="Phone" value="{{$receivable->phone}}">
								                    <label for="phone">Phone</label>
								                </div>
								            </div>

								            <!-- <div class="col-md-12 mt-3">
								                <a href="#" class="text-primary">Add Receivable</a>
								                <span class="float-end fw-bold">$0</span>
								            </div> -->
								        </div>
								        @endforeach

								    </div>
								</div>

							</div>

							<!-- Pregunta: ¿El negocio tiene cuentas de inversión? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Investment accounts?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="investment_accounts" value="unknown" {{($client->investment_accounts == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="investment_accounts" value="no" {{($client->investment_accounts == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="investment_accounts" value="yes" {{($client->investment_accounts == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de detalles de cuentas de inversión -->
							    <div id="" class="row p-5 {{($client->investment_accounts == 'yes') ? '' : 'd-none'}} contenedor">
								    <div class="col-md-12 p-5 card">

								    	@foreach($client->investmentAccounts as $investmentAccount)
								        <div class="row item-dependent item-433b-investment-account {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								        	<input type="hidden" name="investmentAccount_id" id="investmentAccount_id" value="{{$investmentAccount->id}}">
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <select class="form-select input-433b-investment-account-blur" id="type_of_account">
													<option value="">Select</option>
													@foreach($accountTypes as $accountType)
														<option value="{{$accountType->id}}"  {{ ($accountType->id == $investmentAccount->type_of_account) ? 'selected' : '' }} >{{$accountType->name}}</option>
													@endforeach
													
								                </select>
								                <label for="type_of_account">Type of account</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="account_number" placeholder="Account Number" value="{{$investmentAccount->account_number}}">
								                <label for="account_number">Account Number</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="company_name" placeholder="Company Name" value="{{$investmentAccount->company_name}}">
								                <label for="company_name">Company Name</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="current_value" placeholder="Current Value" value="{{$investmentAccount->current_value}}">
								                <label for="current_value">Current Value</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="address" placeholder="Address" value="{{$investmentAccount->address}}">
								                <label for="address">Address</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="loan_balance" placeholder="Loan Balance" value="{{$investmentAccount->loan_balance}}">
								                <label for="loan_balance">Loan Balance</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$investmentAccount->city_state_zip}}">
								                <label for="city_state_zip">City, State, ZIP</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="date" class="form-control form-control-sm input-433b-investment-account-blur" id="statement_date" placeholder="Statement Date" value="{{$investmentAccount->statement_date}}">
								                <label for="statement_date">Statement Date</label>
								            </div>
								            
								            <div class="col-md-6 form-floating form-floating-outline mt-3">
								                <input type="text" class="form-control form-control-sm input-433b-investment-account-blur" id="company_phone" placeholder="Company Phone" value="{{$investmentAccount->company_phone}}">
								                <label for="company_phone">Company Phone</label>
								            </div>
								            
								            <div class="col-md-6 mt-3">
								                <input type="checkbox" id="used_as_collateral" value="1" class="form-check-input input-433b-investment-account-check" {{ ($investmentAccount->used_as_collateral == 1) ? 'checked' : '' }}>
								                <label for="used_as_collateral">Used as collateral on loan</label>
								            </div>
								        </div>
								        @endforeach

								    </div>
								</div>

							</div>

							<!-- Pregunta: ¿El negocio tiene activos digitales? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Digital Assets?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="digital_assets" value="unknown" {{($client->digital_assets == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="digital_assets" value="no" {{($client->digital_assets == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="digital_assets" value="yes" {{($client->digital_assets == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de detalles de activos digitales -->
							    <div id="" class="row p-5 {{($client->digital_assets == 'yes') ? '' : 'd-none'}} contenedor">
								    <div class="col-md-12 p-5 card">

								    	@foreach($client->digitalAssets as $digitalAssets)
								        <div class="row item-dependent item-433b-asset-digital-assets {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								        	<input type="hidden" name="digitalAsset_id" id="digitalAsset_id" value="{{$digitalAssets->id}}">
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Type/description of asset" id="description" name="description" value="{{$digitalAssets->description}}">
								                    <label>Type/description of asset</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Name of asset (Virtual Wallet, DCE, etc.)" id="asset_name" name="asset_name" value="{{$digitalAssets->asset_name}}">
								                    <label>Name of asset (Virtual Wallet, DCE, etc.)</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Number of units" id="units" name="units" value="{{$digitalAssets->units}}">
								                    <label>Number of units</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Location(s)" id="location" name="location" value="{{$digitalAssets->location}}">
								                    <label>Location(s)</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="email" class="form-control-sm form-control" placeholder="Email address used to setup asset" id="email" name="email" value="{{$digitalAssets->email}}">
								                    <label>Email address used to setup asset</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Account # for assets held by broker" id="account_number" name="account_number" value="{{$digitalAssets->account_number}}">
								                    <label>Account # for assets held by broker</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Digital address for self-hosted assets" id="digital_address" name="digital_address" value="{{$digitalAssets->digital_address}}">
								                    <label>Digital address for self-hosted assets</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control" placeholder="Current Value" id="current_value" name="current_value" value="{{$digitalAssets->current_value}}">
								                    <label>Current Value</label>
								                </div>
								            </div>
								        </div>
								        @endforeach


								    </div>
								</div>

							</div>

							<!-- Pregunta: ¿El negocio tiene crédito disponible? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Available Credit?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="available_credit" value="unknown" {{($client->available_credit == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="available_credit" value="no" {{($client->available_credit == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="available_credit" value="yes" {{($client->available_credit == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de crédito disponible -->
							    <div id="" class="row p-5 {{($client->available_credit == 'yes') ? '' : 'd-none'}} contenedor">
								    <div class="col-md-12 p-5 card">
								    	@foreach($client->creditLines as $creditLines)
								        <div class="row item-dependent item-433b-asset-credit-line {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								        	<input type="hidden" name="creditLine_id" id="creditLine_id" value="{{$creditLines->id}}">
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Bank Name" value="{{$creditLines->bank_name}}" id="bank_name" name="bank_name">
								                    <label>Bank Name</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Bank address" value="{{$creditLines->bank_address}}" id="bank_address" name="bank_address">
								                    <label>Bank address</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="City, State, ZIP" value="{{$creditLines->city_state_zip}}" id="city_state_zip" name="city_state_zip">
								                    <label>City, State, ZIP</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Property / Security" value="{{$creditLines->property_security}}" id="property_security" name="property_security">
								                    <label>Property / Security</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Account Number" value="{{$creditLines->account_number}}" id="account_number" name="account_number">
								                    <label>Account Number</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Credit Limit" value="{{$creditLines->credit_limit}}" id="credit_limit" name="credit_limit">
								                    <label>Credit Limit</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Loan Balance" value="{{$creditLines->loan_balance}}" id="loan_balance" name="loan_balance">
								                    <label>Loan Balance</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Minimum monthly pmt" value="{{$creditLines->minimum_monthly_pmt}}" id="minimum_monthly_pmt" name="minimum_monthly_pmt">
								                    <label>Minimum monthly pmt</label>
								                </div>
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control-sm form-control input-433b-asset-credit-line-blur" placeholder="Statement Date" value="{{$creditLines->statement_date}}" id="statement_date" name="statement_date">
								                    <label>Statement Date</label>
								                </div>
								            </div>
								        </div>
								        @endforeach


								    </div>
								</div>

							</div>

							<!-- Pregunta: ¿El negocio posee propiedades reales? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Does the business own any real property?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="own_real_property" value="unknown" {{($client->own_real_property == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="own_real_property" value="no" {{($client->own_real_property == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="own_real_property" value="yes" {{($client->own_real_property == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de propiedad inmobiliaria -->
							    <div id="" class="row p-5 {{($client->own_real_property == 'yes') ? '' : 'd-none'}} contenedor">
								    <!-- Primer div con clase col-md-12 p-5 card -->
								    <div class="col-md-12 p-5 card">

								    	@foreach($client->properties as $properties)
								        <div class="row item-dependent item-433b-asset-properties">
								        	<input type="hidden" name="property_id" id="property_id" value="{{$properties->id}}">
								            <!-- Este div es donde iría el contenido de la imagen (como el formulario) -->
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="street_address" placeholder="Street Address" value="{{$properties->street_address}}">
								                    <label for="street_address">Street Address</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control form-control-sm input-433b-asset-properties-blur" id="refinance_date" placeholder="Refinance Date" value="{{$properties->refinance_date}}">
								                    <label for="refinance_date">Refinance Date</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$properties->city_state_zip}}">
								                    <label for="city_state_zip">City, State, ZIP</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="lender" placeholder="Lender" value="{{$properties->lender}}">
								                    <label for="lender">Lender</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="country" placeholder="County" value="{{$properties->country}}">
								                    <label for="country">County</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="lender_address" placeholder="Lender Address" value="{{$properties->lender_address}}">
								                    <label for="lender_address">Lender Address</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="description" placeholder="Description" value="{{$properties->description}}">
								                    <label for="description">Description</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="lender_phone" placeholder="Lender Phone" value="{{$properties->lender_phone}}">
								                    <label for="lender_phone">Lender Phone</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="text" class="form-control form-control-sm input-433b-asset-properties-blur" id="title_held" placeholder="How Title is Held" value="{{$properties->title_held}}">
								                    <label for="title_held">How Title is Held</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="number" class="form-control form-control-sm input-433b-asset-properties-blur" id="current_value" placeholder="Current Value" value="{{$properties->current_value}}">
								                    <label for="current_value">Current Value</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control form-control-sm input-433b-asset-properties-blur" id="purchase_date" placeholder="Purchase Date" value="{{$properties->purchase_date}}">
								                    <label for="purchase_date">Purchase Date</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="number" class="form-control form-control-sm input-433b-asset-properties-blur" id="loan_balance" placeholder="Current Loan Balance" value="{{$properties->loan_balance}}">
								                    <label for="loan_balance">Current Loan Balance</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="number" class="form-control form-control-sm input-433b-asset-properties-blur" id="purchase_price" placeholder="Purchase Price" value="{{$properties->purchase_price}}">
								                    <label for="purchase_price">Purchase Price</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="number" class="form-control form-control-sm input-433b-asset-properties-blur" id="monthly_payment" placeholder="Monthly Payment" value="{{$properties->monthly_payment}}">
								                    <label for="monthly_payment">Monthly Payment</label>
								                </div>
								            </div>
								            <div class="col-md-6">
								                <div class="form-floating form-floating-outline mt-3">
								                    <input type="date" class="form-control form-control-sm input-433b-asset-properties-blur" id="final_payment_date" placeholder="Date of Final Payment" value="{{$properties->final_payment_date}}">
								                    <label for="final_payment_date">Date of Final Payment</label>
								                </div>
								            </div>

								            <!-- Botón para agregar más propiedades -->
								            <!-- <div class="col-md-12 mt-3">
								                <a href="#" class="text-primary">Add Property</a>
								                <div class="fw-bold mt-2">$0 &nbsp; &nbsp; $0</div>
								            </div> -->
								        </div>
								        @endforeach
								    </div>
								</div>

							</div>

							<!-- Pregunta: ¿Propiedad en venta? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">
							        Is real property currently for sale or anticipate selling to fund the offer amount?
							    </label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_property_for_sale" value="unknown" {{($client->real_property_for_sale == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_property_for_sale" value="no" {{($client->real_property_for_sale == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_property_for_sale" value="yes" {{($client->real_property_for_sale == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>
							    @foreach($client->propertySales as $propertySales)
							    <div class="mt-2">
							    	<input type="hidden" name="propertysale_id" id="propertysale_id"  value="{{$propertySales->id}}">
							        <label class="form-label">Listing price</label>
							        <input type="number" class="form-control form-control-sm input-433b-asset-propertysale-blur" name="listing_price" id="listing_price" value="{{$propertySales->listing_price}}">
							    </div>
							    @endforeach
							</div>

							<!-- Pregunta: ¿Activos fuera de EE.UU.? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">
							        Any property or assets of value outside the US?
							    </label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_assets" value="unknown" {{($client->outside_us_assets == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_assets" value="no" {{($client->outside_us_assets == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_assets" value="yes" {{($client->outside_us_assets == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>
							    @foreach($client->foreignProperties as $foreignProperty)
							    <div class="mt-2">
							    	<input type="hidden" name="foreignProperty_id" id="foreignProperty_id"  value="{{$foreignProperty->id}}">
							        <label class="form-label">Provide description, location, and value</label>
							        <textarea class="form-control input-433b-asset-foreignproperty-blur" rows="2" name="description_location_value" id="description_location_value">{{$foreignProperty->description_location_value}}</textarea>
							    </div>
							    @endforeach
							</div>


							<!-- Pregunta: ¿Vehículos, arrendados o comprados? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Vehicles, Leased or Purchased?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="vehicles_leased_purchased" value="unknown" {{($client->vehicles_leased_purchased == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="vehicles_leased_purchased" value="no" {{($client->vehicles_leased_purchased == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="vehicles_leased_purchased" value="yes" {{($client->vehicles_leased_purchased == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de vehículos -->
							    <div id="" class="row p-5 {{($client->vehicles_leased_purchased == 'yes') ? '' : 'd-none'}} contenedor">
								  <!-- Primer contenedor con la clase col-md-12 p-5 card -->
								  <div class="col-md-12 p-5 card">
								    <!-- Segundo contenedor con la clase row item-dependent -->

								    @foreach($client->vehicles as $vehicles)
								    <div class="row item-dependent item-433b-asset-vehicles {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								      <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$vehicles->id}}">
								      <!-- Year -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="year" placeholder="Year" value="{{$vehicles->year}}">
								          <label for="year">Year</label>
								        </div>
								      </div>

								      <!-- Make -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="make" placeholder="Make" value="{{$vehicles->make}}">
								          <label for="make">Make</label>
								        </div>
								      </div>

								      <!-- Model -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="model" placeholder="Model" value="{{$vehicles->model}}">
								          <label for="model">Model</label>
								        </div>
								      </div>

								      <!-- Mileage -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="mileage" placeholder="Mileage" value="{{$vehicles->mileage}}">
								          <label for="mileage">Mileage</label>
								        </div>
								      </div>

								      <!-- License -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="license" placeholder="License" value="{{$vehicles->license}}">
								          <label for="license">License</label>
								        </div>
								      </div>

								      <!-- VIN -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="vin" placeholder="VIN" value="{{$vehicles->vin}}">
								          <label for="vin">VIN</label>
								        </div>
								      </div>

								      <!-- Purchase date (type="date") -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="date" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="purchase_date" placeholder="Purchase date" value="{{$vehicles->purchase_date}}">
								          <label for="purchase_date">Purchase date</label>
								        </div>
								      </div>

								      <!-- Current Value -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="current_value" placeholder="Current Value" value="{{$vehicles->current_value}}">
								          <label for="current_value">Current Value</label>
								        </div>
								      </div>

								      <!-- Current loan balance -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="current_loan_balance" placeholder="Current loan balance" value="{{$vehicles->current_loan_balance}}">
								          <label for="current-loan-balance">Current loan balance</label>
								        </div>
								      </div>

								      <!-- Monthly payment -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="monthly_payment" placeholder="Monthly payment" value="{{$vehicles->monthly_payment}}">
								          <label for="monthly-payment">Monthly payment</label>
								        </div>
								      </div>

								      <!-- Date of final payment (type="date") -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="date" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="date_of_final_payment" placeholder="Date of final payment" value="{{$vehicles->date_of_final_payment}}">
								          <label for="date-final-payment">Date of final payment</label>
								        </div>
								      </div>

								      <!-- Lender name -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="lender_name" placeholder="Lender name" value="{{$vehicles->lender_name}}">
								          <label for="lender-name">Lender name</label>
								        </div>
								      </div>

								      <!-- Lender address -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="lender_address" placeholder="Lender address" value="{{$vehicles->lender_address}}">
								          <label for="lender-address">Lender address</label>
								        </div>
								      </div>

								      <!-- City, State, ZIP -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="lender_city_state_zip" placeholder="City, State, ZIP" value="{{$vehicles->lender_city_state_zip}}">
								          <label for="city-state-zip">City, State, ZIP</label>
								        </div>
								      </div>

								      <!-- Lender phone -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input type="text" class="form-control form-control-sm input-433b-asset-vehicles-blur" id="lender_phone" placeholder="Lender phone" value="{{$vehicles->lender_phone}}">
								          <label for="lender-phone">Lender phone</label>
								        </div>
								      </div>

								      <!-- Type (combobox con opciones del formulario 433-B) -->
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <select class="form-select form-control-sm input-433b-asset-vehicles-blur" id="type" placeholder="Type"aria-label="Type">
								            <option value="">-- Select --</option>
								            <option value="Loan" {{ ($vehicles->type == 'Loan') ? 'selected' : '' }}>Loan</option>
								            <option value="Own" {{ ($vehicles->type == 'Own') ? 'selected' : '' }}>Own</option>
								            <option value="Lease" {{ ($vehicles->type == 'Lease') ? 'selected' : '' }}>Lease</option>
								          </select>
								          <label for="type">Type</label>
								        </div>
								      </div>

								    </div> <!-- Fin .row.item-dependent -->
								    @endforeach
								  </div> <!-- Fin .col-md-12.p-5.card -->
								</div> <!-- Fin #content-abc -->
							</div>

							<!-- Pregunta: ¿Herramientas o equipos comerciales? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">Any business tools/equipment?</label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_tools_equipment" value="unknown" {{($client->business_tools_equipment == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_tools_equipment" value="no" {{($client->business_tools_equipment == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_tools_equipment" value="yes" {{($client->business_tools_equipment == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>

							    <!-- Formulario de herramientas/equipos -->
							    <div id="" class="row p-5 {{($client->business_tools_equipment == 'yes') ? '' : 'd-none'}} contenedor">
								  <!-- Primer contenedor con la clase col-md-12 p-5 card -->
								  <div class="col-md-12 p-5 card">
								    <!-- Segundo contenedor con la clase row item-dependent -->

								    @foreach($client->companyToolEquipments as $companyToolEquipments)
									    <div class="row item-dependent item-433b-asset-companytool {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
									    	<input type="hidden" name="companyToolEquipment_id" id="companyToolEquipment_id" value="{{$companyToolEquipments->id}}">
									      <!-- Description -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="description" placeholder="Description" value="{{$companyToolEquipments->description}}">
									          <label for="description">Description</label>
									        </div>
									      </div>

									      <!-- Street Address -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="street_address" placeholder="Street Address" value="{{$companyToolEquipments->street_address}}">
									          <label for="street-address">Street Address</label>
									        </div>
									      </div>

									      <!-- City, State, ZIP (Propiedad) -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$companyToolEquipments->city_state_zip}}">
									          <label for="city_state_zip-prop">City, State, ZIP</label>
									        </div>
									      </div>

									      <!-- County -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="county" placeholder="County" value="{{$companyToolEquipments->county}}">
									          <label for="county">County</label>
									        </div>
									      </div>

									      <!-- Purchase date (type="date") -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input 
									            type="date" class="form-control form-control-sm input-433b-asset-companytool-blur" id="purchase_date" placeholder="Purchase date" value="{{$companyToolEquipments->purchase_date}}">
									          <label for="purchase-date">Purchase date</label>
									        </div>
									      </div>

									      <!-- Current Value -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="current_value" placeholder="Current Value" value="{{$companyToolEquipments->current_value}}">
									          <label for="current-value">Current Value</label>
									        </div>
									      </div>

									      <!-- Current loan balance -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="current_loan_balance" placeholder="Current loan balance" value="{{$companyToolEquipments->current_loan_balance}}">
									          <label for="current-loan-balance">Current loan balance</label>
									        </div>
									      </div>

									      <!-- Monthly payment -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="monthly_payment" placeholder="Monthly payment" value="{{$companyToolEquipments->monthly_payment}}">
									          <label for="monthly-payment">Monthly payment</label>
									        </div>
									      </div>

									      <!-- Date of final payment (type="date") -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input 
									            type="date" class="form-control form-control-sm input-433b-asset-companytool-blur" id="date_of_final_payment" placeholder="Date of final payment" value="{{$companyToolEquipments->date_of_final_payment}}">
									          <label for="date-final-payment">Date of final payment</label>
									        </div>
									      </div>

									      <!-- Lender -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="lender" placeholder="Lender" value="{{$companyToolEquipments->lender}}">
									          <label for="lender">Lender</label>
									        </div>
									      </div>

									      <!-- Lender address -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="lender_address" placeholder="Lender address" value="{{$companyToolEquipments->lender_address}}">
									          <label for="lender-address">Lender address</label>
									        </div>
									      </div>

									      <!-- City, State, ZIP (Lender) -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="lender_city_state_zip" placeholder="City, State, ZIP" value="{{$companyToolEquipments->lender_city_state_zip}}">
									          <label for="city-state-zip-lender">City, State, ZIP</label>
									        </div>
									      </div>

									      <!-- Lender phone -->
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input type="text" class="form-control form-control-sm input-433b-asset-companytool-blur" id="lender_phone" placeholder="Lender phone" value="{{$companyToolEquipments->lender_phone}}">
									          <label for="lender-phone">Lender phone</label>
									        </div>
									      </div>

									      <!-- Checkbox: Asset is leased or used to generate income -->
									      <div class="col-md-6">
									        <!-- Nota: form-floating no aplica bien a checkboxes -->
									        <div class="form-check mt-3">
									          <input type="checkbox" class="form-check-input"  id="asset-leased">
									          <label for="asset-leased">Asset is leased or used to generate income</label>
									        </div>
									      </div>
									    </div> <!-- Fin .row.item-dependent -->
								    @endforeach


								  </div> <!-- Fin .col-md-12.p-5.card -->
								</div> <!-- Fin #content-abc -->

							</div>

							<!-- Pregunta: ¿Activos intangibles? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">
							        Does your business have any intangible assets?
							    </label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="intangible_assets" value="unknown" {{($client->intangible_assets == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="intangible_assets" value="no" {{($client->intangible_assets == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="intangible_assets" value="yes" {{($client->intangible_assets == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>


							    <div id="" class="row p-5 {{($client->intangible_assets == 'yes') ? '' : 'd-none'}} contenedor">
									  <div class="col-md-12 p-5 card">

									  	@foreach($client->intangibleAssets as $intangibleAssets)
									    <div class="row item-dependent item-433b-asset-intangible-asset {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
									    	<input type="hidden" name="intangibleAsset_id" id="intangibleAsset_id" value="{{$intangibleAssets->id}}">
									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input 
									            type="text" class="form-control form-control-sm input-433b-asset-intangible-asset-blur" id="description" placeholder="Description" value="{{$intangibleAssets->description}}">
									          <label for="description">Description</label>
									        </div>
									        <div class="form-floating form-floating-outline mt-3">
									          <input 
									            type="date" class="form-control form-control-sm input-433b-asset-intangible-asset-blur" id="purchase_date" placeholder="Purchase date" value="{{$intangibleAssets->purchase_date}}">
									          <label for="purchase-date">Purchase date</label>
									        </div>
									      </div>

									      <div class="col-md-6">
									        <div class="form-floating form-floating-outline mt-3">
									          <input 
									            type="text" class="form-control form-control-sm input-433b-asset-intangible-asset-blur" id="current_value" placeholder="Current Value" value="{{$intangibleAssets->current_value}}">
									          <label for="current-value">Current Value</label>
									        </div>
									      </div>

									    </div>
									    @endforeach
									  </div>
									  <!-- <div class="col-md-12 mt-3">
									    <a href="#">
									      <i class="ri-add-circle-fill"></i>
									      Add Asset
									    </a>
									  </div> -->
									</div>



							</div>

							<!-- Pregunta: ¿Pasivos del negocio? -->
							<div class="mb-3">
							    <label class="form-label fw-bold">
							        Business Liabilities?
							    </label>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_liabilities" value="unknown" {{($client->business_liabilities == 'unknown') ? 'checked' : ''}}>
							        <label class="form-check-label">Unknown</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_liabilities" value="no" {{($client->business_liabilities == 'no') ? 'checked' : ''}}>
							        <label class="form-check-label">No</label>
							    </div>
							    <div class="form-check form-check-inline">
							        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_liabilities" value="yes" {{($client->business_liabilities == 'yes') ? 'checked' : ''}}>
							        <label class="form-check-label">Yes</label>
							    </div>




							    <div id="" class="row p-5 {{($client->business_liabilities == 'yes') ? '' : 'd-none'}} contenedor">
								  <div class="col-md-12 p-5 card">


								  	@foreach($client->businessLiabilities as $businessLiabilities)
								    <div class="row item-dependent item-433b-asset-businessLiabilities {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								    	<input type="hidden" name="businessLiabilities_id" id="businessLiabilities_id" value="{{$businessLiabilities->id}}">
								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="description" placeholder="Description" value="{{$businessLiabilities->description}}">
								          <label for="description">Description</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="date" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="date_pledged" placeholder="Date Pledged" value="{{$businessLiabilities->date_pledged}}">
								          <label for="date-pledged">Date Pledged</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="name" placeholder="Name (If applicable)" value="{{$businessLiabilities->name}}">
								          <label for="name-applicable">Name (If applicable)</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="balance_owed" placeholder="Balance Owed" value="{{$businessLiabilities->balance_owed}}">
								          <label for="balance-owed">Balance Owed</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="street" placeholder="Street" value="{{$businessLiabilities->street}}">
								          <label for="street">Street</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="payment_amount" placeholder="Payment Amount" value="{{$businessLiabilities->payment_amount}}">
								          <label for="payment-amount">Payment Amount</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$businessLiabilities->city_state_zip}}">
								          <label for="city-state-zip">City, State, ZIP</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="date" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="final_payment" placeholder="Final payment" value="{{$businessLiabilities->final_payment}}">
								          <label for="final-payment">Final payment</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="form-floating form-floating-outline mt-3">
								          <input 
								            type="text" class="form-control form-control-sm input-433b-asset-businessLiabilities-blur" id="phone" placeholder="Phone" value="{{$businessLiabilities->phone}}">
								          <label for="phone">Phone</label>
								        </div>
								      </div>

								      <div class="col-md-6">
								        <div class="mt-3">
								          <div class="form-check">
								            <input 
								              class="form-check-input input-433b-asset-businessLiabilities-check" type="radio" id="collateral" name="collateral"  value="secured" {{ ($businessLiabilities->collateral == 'secured') ? 'checked' : ''}}>
								            <label for="secured">Secured</label>
								          </div>
								          <div class="form-check">
								            <input 
								              class="form-check-input input-433b-asset-businessLiabilities-check" type="radio" id="collateral" name="collateral" value="unsecured" {{ ($businessLiabilities->collateral == 'unsecured') ? 'checked' : ''}}>
								            <label for="unsecured">Unsecured</label>
								          </div>
								        </div>
								      </div>
								    </div>
								    @endforeach
								  </div>
								  <!-- <div class="col-md-12 mt-3">
								    <a href="#">
								      <i class="ri-add-circle-fill"></i>
								      Add Liability
								    </a>
								  </div> -->
								</div>

							</div>

							<script>
							    // document.addEventListener("DOMContentLoaded", function () {
							    //     document.querySelectorAll('input[name="intangible_assets"]').forEach(function (radio) {
							    //         radio.addEventListener("change", function () {
							    //             document.getElementById("intangible_fields").classList.toggle("d-none", this.value !== "yes");
							    //         });
							    //     });

							    //     document.querySelectorAll('input[name="business_liabilities"]').forEach(function (radio) {
							    //         radio.addEventListener("change", function () {
							    //             document.getElementById("liabilities_fields").classList.toggle("d-none", this.value !== "yes");
							    //         });
							    //     });
							    // });
							</script>
                		</div>
                	</div>
            </form>
        </div>
</div>