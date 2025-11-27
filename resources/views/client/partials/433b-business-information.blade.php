<div class="tab-pane fade active show" id="433b-navs-home-card" role="tabpanel" style="text-align:left;">
        <!-- <h4 class="card-title">Personal & Emp</h4> -->
        <div class="card-body pt-3">
            <form>
	              <!-- <h6 class="pt-0">1. Account Details</h6> -->
	              <div class="row g-6">
                		<div class="col-md-12">
                						
					        
				            <div class="row">
				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="business_name" name="business_name" placeholder="Business Name" value="{{$client->business_name}}">
				                        <label for="business_name">Business Name</label>
				                    </div>
				                </div>
				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="business_address" name="business_address" placeholder="Business Address" value="{{$client->business_address}}">
				                        <label for="business_address">Business Address</label>
				                    </div>
				                </div>
				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="business_email_address" name="business_email_address" placeholder="Business Email Address" value="{{$client->business_email_address}}">
				                        <label for="business_email_address">Business Email Address</label>
				                    </div>
				                </div>
				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="business_phone" name="business_phone" placeholder="Business Phone" value="{{$client->business_phone}}">
				                        <label for="business_phone">Business Phone</label>
				                    </div>
				                </div>

				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="business_ein" name="business_ein" placeholder="Business Phone" value="{{$client->business_ein}}">
				                        <label for="business_ein">EIN</label>
				                    </div>
				                </div>
				                








				                <div class="col-md-6 mt-3">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="type_of_business" name="type_of_business" placeholder="Type of Business" value="{{$client->type_of_business}}">
				                        <label for="type_of_business">Type of Business</label>
				                    </div>
				                </div>
				                <div class="col-md-3 d-flex align-items-center">
				                    <div class="form-check mt-4">
				                        <input class="form-check-input input-433b-information-client-blur" type="checkbox" id="federal_contractor" name="federal_contractor" value="1" {{($client->federal_contractor == 1) ? 'checked=' : ''}}>
				                        <label class="form-check-label" for="federal_contractor">Federal Contractor</label>
				                    </div>
				                </div>
				            </div>

				            <div class="row mt-3">
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <select class="form-select input-433b-information-client-blur" id="type_of_entity" name="type_of_entity">
				                            <option value="" selected>Select...</option>
				                            @foreach($businessTypes as $businessType)
				                            	<option value="{{$businessType->id}}" {{ ($client->type_of_entity == $businessType->id) ? 'selected' : '' }}>{{$businessType->name}}</option>
				                            @endforeach
				                        </select>
				                        <label for="type_of_entity">Type of Entity</label>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <input type="date" class="form-control form-control-sm input-433b-information-client-blur" id="date_established" name="date_established" placeholder="Date Established" value="{{$client->date_established}}">
				                        <label for="date_established">Date Established</label>
				                    </div>
				                </div>
				            </div>

				            <div class="row mt-3">
				                <div class="col-md-12">
				                    <div class="form-floating form-floating-outline">
				                        <input type="url" class="form-control form-control-sm input-433b-information-client-blur" id="business_website" name="business_website" placeholder="Business Website" value="{{$client->business_website}}">
				                        <label for="business_website">Business Website</label>
				                    </div>
				                </div>
				            </div>

				            <div class="row mt-3">
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <input type="number" class="form-control form-control-sm input-433b-information-client-blur" id="total_number_of_employees" name="total_number_of_employees" placeholder="0 if you are the only one" value="{{$client->total_number_of_employees}}">
				                        <label for="total_number_of_employees">Total Number of Employees</label>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="average_gross_monthly_payroll" name="average_gross_monthly_payroll" placeholder="Average Gross Monthly Payroll" value="{{$client->average_gross_monthly_payroll}}">
				                        <label for="average_gross_monthly_payroll">Average Gross Monthly Payroll</label>
				                    </div>
				                </div>
				            </div>

				            <div class="row mt-3">
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="frequency_tax_deposits" name="frequency_tax_deposits" placeholder="Frequency of Tax Deposits" value="{{$client->frequency_tax_deposits}}">
				                        <label for="frequency_tax_deposits">Frequency of Tax Deposits</label>
				                    </div>
				                </div>
				                <div class="col-md-6">
				                    <div class="form-floating form-floating-outline">
				                        <input type="text" class="form-control form-control-sm input-433b-information-client-blur" id="cash_on_hand" name="cash_on_hand" placeholder="Cash on Hand" value="{{$client->cash_on_hand}}">
				                        <label for="cash_on_hand">Cash on Hand</label>
				                    </div>
				                </div>
				            </div>

					        <div class="row">
			        			<div class="container mt-4">
								    <!-- Pregunta 1 -->
								    <div class="mb-3">
								        <label class="form-label fw-bold">
								            Has business been located outside the U.S. for 6 mos. or longer in the past 10 years?
								        </label>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_6mos" id="outside_us_unknown" value="unknown" {{($client->outside_us_6mos == 'unknown') ? 'checked' : ''}}>
								            <label class="form-check-label" for="outside_us_unknown">Unknown</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_6mos" id="outside_us_no" value="no"  {{($client->outside_us_6mos == 'no') ? 'checked' : ''}} >
								            <label class="form-check-label" for="outside_us_no">No</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="outside_us_6mos" id="outside_us_yes" value="yes" {{($client->outside_us_6mos == 'yes') ? 'checked' : ''}}>
								            <label class="form-check-label" for="outside_us_yes">Yes</label>
								        </div>
								    </div>

								    <!-- Pregunta 2 -->
								    <div class="mb-3">
								        <label class="form-label fw-bold">
								            Is the business enrolled in Electronic Federal Tax Payment Systems (EFTPS)?
								        </label>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="enrolled_eftps" id="eftps_unknown" value="unknown" {{($client->enrolled_eftps == 'unknown') ? 'checked' : ''}}>
								            <label class="form-check-label" for="eftps_unknown">Unknown</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="enrolled_eftps" id="eftps_no" value="no" {{($client->enrolled_eftps == 'no') ? 'checked' : ''}}>
								            <label class="form-check-label" for="eftps_no">No</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="enrolled_eftps" id="eftps_yes" value="yes" {{($client->enrolled_eftps == 'yes') ? 'checked' : ''}}>
								            <label class="form-check-label" for="eftps_yes">Yes</label>
								        </div>
								    </div>

								    <!-- Pregunta 3 -->
								    <div class="mb-3">
								        <label class="form-label fw-bold">
								            Does your business engage in e-commerce, internet sales or accept virtual currency?
								        </label>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="engage_ecommerce" id="ecommerce_unknown" value="unknown" {{($client->engage_ecommerce == 'unknown') ? 'checked' : ''}}>
								            <label class="form-check-label" for="ecommerce_unknown">Unknown</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="engage_ecommerce" id="ecommerce_no" value="no" {{($client->engage_ecommerce == 'no') ? 'checked' : ''}}>
								            <label class="form-check-label" for="ecommerce_no">No</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="engage_ecommerce" id="ecommerce_yes" value="yes" {{($client->engage_ecommerce == 'yes') ? 'checked' : ''}}>
								            <label class="form-check-label" for="ecommerce_yes">Yes</label>
								        </div>

								        <div class="row p-5 {{($client->engage_ecommerce == 'yes') ? '' : 'd-none'}} contenedor" id="content-433b-ecommerce">
										    <div class="col-md-12 p-5 card">
										    	@foreach($client->ecommerceProcessors as $ecommerceProcessor)
										        <div class="row item-employed item-433b-ecommerceprocesor">
										        	<input type="hidden" name="ecommerceProcessor_id" id="ecommerceProcessor_id" value="{{$ecommerceProcessor->id}}">
										            <div class="row">
										                <div class="col-md-6">
										                    <div class="form-floating form-floating-outline">
										                        <input type="text" class="form-control form-control-sm input-433b-ecommerceprocesor-blur" id="processor_name" name="processor_name" placeholder="Processor Name" value="{{$ecommerceProcessor->processor_name}}">
										                        <label for="processor_name">Processor Name</label>
										                    </div>
										                </div>
										                <div class="col-md-6">
										                    <div class="form-floating form-floating-outline">
										                        <input type="text" class="form-control form-control-sm input-433b-ecommerceprocesor-blur" id="account_number" name="account_number" placeholder="Account Number" value="{{$ecommerceProcessor->account_number}}">
										                        <label for="account_number">Account Number</label>
										                    </div>
										                </div>
										            </div>

										            <div class="row mt-3">
										                <div class="col-md-12">
										                    <div class="form-floating form-floating-outline">
										                        <input type="text" class="form-control form-control-sm input-433b-ecommerceprocesor-blur" id="street_address" name="street_address" placeholder="Street Address" value="{{$ecommerceProcessor->street_address}}">
										                        <label for="street_address">Street Address</label>
										                    </div>
										                </div>
										            </div>

										            <div class="row mt-3">
										                <div class="col-md-12">
										                    <div class="form-floating form-floating-outline">
										                        <input type="text" class="form-control form-control-sm input-433b-ecommerceprocesor-blur" id="city_state_zip" name="city_state_zip" placeholder="City, State, ZIP" value="{{$ecommerceProcessor->city_state_zip}}">
										                        <label for="city_state_zip">City, State, ZIP</label>
										                    </div>
										                </div>
										            </div>
										        </div>
										        @endforeach
										    </div>
											<!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-433b-ecommerce"><i class="ri-add-circle-fill"></i> Add More</a>
					                        </div> -->
										</div>
								    </div>
								    <!-- Pregunta 4 -->
								    <div class="mb-3">
								        <label class="form-label fw-bold">
								            Does your business accept credit cards?
								        </label>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="accept_credit_cards" id="credit_cards_unknown" value="unknown" {{($client->accept_credit_cards == 'unknown') ? 'checked' : ''}} >
								            <label class="form-check-label" for="credit_cards_unknown">Unknown</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="accept_credit_cards" id="credit_cards_no" value="no" {{($client->accept_credit_cards == 'no') ? 'checked' : ''}} >
								            <label class="form-check-label" for="credit_cards_no">No</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="accept_credit_cards" id="credit_cards_yes" value="yes" {{($client->accept_credit_cards == 'yes') ? 'checked' : ''}} >
								            <label class="form-check-label" for="credit_cards_yes">Yes</label>
								        </div>


								        <div id="content-433b-credit-card" class="row p-5 {{($client->accept_credit_cards == 'yes') ? '=' : 'd-none'}} contenedor">
								        	<div class="col-md-12 p-5 card">
								        		@foreach($client->creditCards as $creditCard)
					                          	<div class="row item-dependent item-business-accept-credit-card  {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
					                          		<input type="hidden" name="creditCard_id" id="creditCard_id" value="{{$creditCard->id}}">
												    <div class="col-md-6">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="card_type" placeholder="VISA, MasterCard, etc." value="{{$creditCard->card_type}}">
												            <label for="card_type">Card Type</label>
												        </div>
												    </div>
												    <div class="col-md-6">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="issuing_bank" placeholder="Issuing Bank" value="{{$creditCard->issuing_bank}}">
												            <label for="issuing_bank">Issuing Bank</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="name_on_account" placeholder="Name on Account" value="{{$creditCard->name_on_account}}">
												            <label for="name_on_account">Name on Account</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="street_address" placeholder="Street Address" value="{{$creditCard->street_address}}">
												            <label for="street_address">Street Address</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="merchant_account_number" placeholder="Merchant Account Number" value="{{$creditCard->merchant_account_number}}">
												            <label for="merchant_account_number">Merchant Account Number</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$creditCard->city_state_zip}}">
												            <label for="city_state_zip">City, State, ZIP</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-business-accept-credit-card-blur" id="phone" placeholder="Phone" value="{{$creditCard->phone}}">
												            <label for="phone">Phone</label>
												        </div>
												    </div>	
												</div>
												@endforeach
											</div>
											<!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-433b-credit-card"><i class="ri-add-circle-fill"></i> Add More</a>
					                        </div> -->
										</div>


								        
								    </div>
								    <!-- Pregunta 5 -->
								    <div class="mb-3">
								        <label class="form-label fw-bold">
								            Does business have Partners, Officers, LLC Members, Major Shareholders, etc.?
								        </label>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="partners_officers" id="partners_unknown" value="unknown" {{($client->partners_officers == 'unknown') ? 'checked' : ''}}>
								            <label class="form-check-label" for="partners_unknown">Unknown</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="partners_officers" id="partners_no" value="no" {{($client->partners_officers == 'no') ? 'checked' : ''}}>
								            <label class="form-check-label" for="partners_no">No</label>
								        </div>
								        <div class="form-check form-check-inline">
								            <input class="form-check-input input-433b-check-toogle" type="radio" name="partners_officers" id="partners_yes" value="yes" {{($client->partners_officers == 'yes') ? 'checked' : ''}} >
								            <label class="form-check-label" for="partners_yes" >Yes</label>
								        </div>



								        <div id="content-abc" class="row p-5 {{($client->partners_officers == 'yes') ? '=' : 'd-none'}} contenedor">
								        	<div class="col-md-12 p-5 card">
								        		@foreach($client->partnersOfficers as $partnersOfficer)
					                          	<div class="row item-dependent  item-433b-partners_officers {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
								        		<input type="hidden" name="partnersOfficer_id" id="partnersOfficer_id" value="{{$partnersOfficer->id}}">

												    <div class="col-md-6">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="first_name" placeholder="First Name" value="{{$partnersOfficer->first_name}}">
												            <label for="first_name">First Name</label>
												        </div>
												    </div>
												    <div class="col-md-6">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="last_name" placeholder="Last Name" value="{{$partnersOfficer->last_name}}">
												            <label for="last_name">Last Name</label>
												        </div>
												    </div>
												    <div class="col-md-12 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="title" placeholder="Title" value="{{$partnersOfficer->title}}">
												            <label for="title">Title</label>
												        </div>
												    </div>
												    <div class="col-md-12 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="street_address" placeholder="Street Address" value="{{$partnersOfficer->street_address}}">
												            <label for="street_address">Street Address</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="city" placeholder="City" value="{{$partnersOfficer->city}}">
												            <label for="city">City</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <select class="form-select input-433b-partner-office-blur" id="state">
												                <option value="" disabled selected>Select State</option>
												                @foreach($states_of_america as $state)
												                	<option value="{{$state->id}}" {{($state->id == $partnersOfficer->state) ? 'selected' : '' }}>{{$state->name}}</option>
												                @endforeach
												            </select>
												            <label for="state">State</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="zip_code" placeholder="ZIP Code" value="{{$partnersOfficer->zip_code}}">
												            <label for="zip_code">ZIP Code</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="phone1" placeholder="Phone 1" value="{{$partnersOfficer->phone1}}">
												            <label for="phone1">Phone 1</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="phone2" placeholder="Phone 2" value="{{$partnersOfficer->phone2}}">
												            <label for="phone2">Phone 2</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="social_security_number" placeholder="Social Security Number" value="{{$partnersOfficer->social_security_number}}">
												            <label for="social_security_number">Social Security Number</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="ownership_percentage" placeholder="Ownership %" value="{{$partnersOfficer->ownership_percentage}}">
												            <label for="ownership_percentage">Ownership %</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="shares_interest" placeholder="Shares/Interest" value="{{$partnersOfficer->shares_interest}}">
												            <label for="shares_interest">Shares/Interest</label>
												        </div>
												    </div>
												    <div class="col-md-4 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-partner-office-blur" id="annual_salary_draw" placeholder="Annual Salary/Draw" value="{{$partnersOfficer->annual_salary_draw}}">
												            <label for="annual_salary_draw">Annual Salary/Draw</label>
												        </div>
												    </div>
												    <div class="col-md-12 mt-3">
												        <div class="form-check">
												            <input class="form-check-input input-433b-check-toogle" type="checkbox" id="payrollTaxes">
												            <label for="payrollTaxes">Responsible for Depositing Payroll Taxes</label>
												        </div>
												    </div>
												</div>
												@endforeach
											</div>
											<!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-abc"><i class="ri-add-circle-fill"></i> Add More</a>
					                        </div> -->
										</div>

								    </div>
								    <!-- Pregunta 6 -->
								    <div class="mb-3">
									    <label class="form-label fw-bold">
									        Does this business have other business affiliations?
									    </label>
									    <div class="form-check form-check-inline">
									        <input class="form-check-input input-433b-check-toogle" type="radio" name="other_business_affiliations" id="affiliations_unknown" value="unknown" {{($client->other_business_affiliations == 'unknown') ? 'checked=' : ''}}>
									        <label class="form-check-label" for="affiliations_unknown">Unknown</label>
									    </div>
									    <div class="form-check form-check-inline">
									        <input class="form-check-input input-433b-check-toogle" type="radio" name="other_business_affiliations" id="affiliations_no" value="no" {{($client->other_business_affiliations == 'no') ? 'checked=' : ''}}>
									        <label class="form-check-label" for="affiliations_no">No</label>
									    </div>
									    <div class="form-check form-check-inline">
									        <input class="form-check-input input-433b-check-toogle" type="radio" name="other_business_affiliations" id="affiliations_yes" value="yes" {{($client->other_business_affiliations == 'yes') ? 'checked=' : ''}}>
									        <label class="form-check-label" for="affiliations_yes">Yes</label>
									    </div>




									    <div id="content-abc" class="row p-5 {{($client->other_business_affiliations == 'yes') ? '=' : 'd-none'}} contenedor">
									    	<div class="col-md-12 p-5 card">

									    		@foreach($client->businessAffiliations as $businessAffiliation)
					                          	<div class="row item-dependent  item-433b-other-business-affiliation {{ !$loop->first ? 'mt-3 border-top border-2 pt-5' : '' }}">
					                          		<input type="hidden" name="businessAffiliation_id" id="businessAffiliation_id" value="{{$businessAffiliation->id}}">
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-other-business-affiliation-blur" id="business_name" placeholder="Business Name" value="{{$businessAffiliation->business_name}}">
												            <label for="business_name">Business Name</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-other-business-affiliation-blur" id="street_address" placeholder="Street Address" value="{{$businessAffiliation->street_address}}">
												            <label for="street_address">Street Address</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-other-business-affiliation-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$businessAffiliation->city_state_zip}}">
												            <label for="city_state_zip">City, State, ZIP</label>
												        </div>
												    </div>
												    <div class="col-md-6 mt-3">
												        <div class="form-floating form-floating-outline">
												            <input type="text" class="form-control form-control-sm input-433b-other-business-affiliation-blur" id="ein" placeholder="EIN" value="{{$businessAffiliation->ein}}">
												            <label for="ein">EIN</label>
												        </div>
												    </div>
												</div>
												@endforeach
											</div>
											<!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-abc"><i class="ri-add-circle-fill"></i> Add More</a>
					                        </div> -->
										</div>

									</div>
								</div>
					        </div>	
                		</div>
                	</div>
            </form>
        </div>
</div>