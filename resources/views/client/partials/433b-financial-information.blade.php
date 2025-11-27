<div class="tab-pane fade" id="433b-navs-financial-info" role="tabpanel" style="text-align:left;">
        <!-- <h4 class="card-title">Personal & Emp</h4> -->
        <div class="card-body pt-3">
            <form>
	              <!-- <h6 class="pt-0">1. Account Details</h6> -->
	              <div class="row g-6">
                		<div class="col-md-12">
                			<!-- Pregunta: ¿Usa el negocio un Proveedor de Nómina o Agente de Reportes? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Does the business use a Payroll Service Provider or Reporting Agent?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="payroll_service_provider" value="unknown" {{($client->payroll_service_provider == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="payroll_service_provider" value="no" {{($client->payroll_service_provider == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="payroll_service_provider" value="yes" {{($client->payroll_service_provider == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Campos adicionales si responde "Yes" -->
								    <div id="content-abc" class="row p-5  {{($client->payroll_service_provider == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">

									    	@foreach($client->payrollServiceProviders as $payrollServiceProvider)
									        <div class="row item-dependent item-433b-financial-payroll-service">
									        	<input type="hidden" name="payrollServiceProvider_id" id="payrollServiceProvider_id" value="{{$payrollServiceProvider->id}}">
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-financial-payroll-service-blur" id="provider_name" placeholder="Provider Name" value="{{$payrollServiceProvider->provider_name}}">
									                    <label for="provider_name">Provider Name</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-financial-payroll-service-blur" id="address" placeholder="Address" value="{{$payrollServiceProvider->address}}">
									                    <label for="address">Address</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-financial-payroll-service-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$payrollServiceProvider->city_state_zip}}">
									                    <label for="city_state_zip">City, State, ZIP</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="date" class="form-control form-control-sm input-433b-financial-payroll-service-blur" id="effective_date" placeholder="Effective Date" value="{{$payrollServiceProvider->effective_date}}">
									                    <label for="effective_date">Effective Date</label>
									                </div>
									            </div>
									        </div>
									        @endforeach
									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿Partes relacionadas deben dinero al negocio? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Do any related parties owe money to the business?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="related_parties_owe_business" value="unknown" {{($client->related_parties_owe_business == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="related_parties_owe_business" value="no" {{($client->related_parties_owe_business == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="related_parties_owe_business" value="yes" {{($client->related_parties_owe_business == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Campos adicionales si responde "Yes" -->
								    <div id="content-433b-financial-money-to-the-bussiness" class="row p-5  {{($client->business_bank_accounts == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">

									    	@foreach($client->relatedPartiesOweBusiness as $relatedPartiesOweBusines)
										        <div class="row item-dependent item-433b-financial-related-parties">
										        	<input type="hidden" name="relatedPartiesOweBusines_id" id="relatedPartiesOweBusines_id" value="{{$relatedPartiesOweBusines->id}}">
										            <!-- Columna izquierda -->
										            <div class="col-md-6">
										                <div class="form-floating form-floating-outline">
										                    <input type="text" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="name" placeholder="Name" value="{{$relatedPartiesOweBusines->name}}">
										                    <label for="name">Name</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="text" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="address" placeholder="Address" value="{{$relatedPartiesOweBusines->address}}">
										                    <label for="address">Address</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="text" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="city_state_zip" placeholder="City, State, ZIP" value="{{$relatedPartiesOweBusines->city_state_zip}}">
										                    <label for="city_state_zip">City, State, ZIP</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="date" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="date_of_loan" placeholder="Date of loan" value="{{$relatedPartiesOweBusines->date_of_loan}}">
										                    <label for="date_of_loan">Date of loan</label>
										                </div>
										            </div>

										            <!-- Columna derecha -->
										            <div class="col-md-6">
										                <div class="form-floating form-floating-outline">
										                    <input type="text" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="current_balance" placeholder="Current balance" value="{{$relatedPartiesOweBusines->current_balance}}">
										                    <label for="current_balance">Current balance</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="date" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="as_of" placeholder="As of" value="{{$relatedPartiesOweBusines->as_of}}">
										                    <label for="as_of">As of</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="date" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="payment_date" placeholder="Payment date" value="{{$relatedPartiesOweBusines->payment_date}}">
										                    <label for="payment_date">Payment date</label>
										                </div>
										                <div class="form-floating form-floating-outline mt-3">
										                    <input type="text" class="form-control form-control-sm input-433b-financial-related-parties-blur" id="payment_amount" placeholder="Payment Amount" value="{{$relatedPartiesOweBusines->payment_amount}}">
										                    <label for="payment_amount">Payment Amount</label>
										                </div>
										            </div>
										        </div>
									        @endforeach
									    </div>
									    <!-- <div class="col-md-12 mt-3">
				                          <a href="javascript:;" id="add-item-433b-financial-money-to-the-bussiness"><i class="ri-add-circle-fill"></i> Add More</a>
				                        </div> -->
									</div>

								</div>

								<!-- Pregunta: ¿El negocio es parte de una demanda? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Is the business a party to a lawsuit?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_party_lawsuit" value="unknown" {{($client->business_party_lawsuit == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_party_lawsuit" value="no" {{($client->business_party_lawsuit == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_party_lawsuit" value="yes" {{($client->business_party_lawsuit == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Campos adicionales si responde "Yes" -->
								    <div id="content-433b-financial-lawsuit" class="row p-5  {{($client->business_party_lawsuit == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">
									    	@foreach($client->lawsuits as $lawsuits)

									        <div class="row item-dependent item-lawsuit-financial">
									        	<input type="hidden" name="lawsuit_id" id="lawsuit_id"  value="{{$lawsuits->id}}">
									            <!-- Columna izquierda -->
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline">
									                    <div class="form-check form-check-inline">
									                        <input class="form-check-input input-433b-item-check-taxpayer-party-lawsuit " type="radio" name="role" id="plaintiff" value="plaintiff" {{ ($lawsuits->role == 'plaintiff') ? 'checked' : ''}}>
									                        <label for="plaintiff">Plaintiff</label>
									                    </div>
									                    <div class="form-check form-check-inline">
									                        <input class="form-check-input input-433b-item-check-taxpayer-party-lawsuit " type="radio" name="role" id="defendant" value="defendant" {{ ($lawsuits->role == 'defendant') ? 'checked' : ''}}>
									                        <label for="defendant">Defendant</label>
									                    </div>
									                </div>
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="subject_of_suit" placeholder="Subject of Suit" value="{{$lawsuits->subject_of_suit}}">
									                    <label for="subject_of_suit">Subject of Suit</label>
									                </div>
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="location_of_filing" placeholder="Location of Filing" value="{{$lawsuits->location_of_filing}}">
									                    <label for="location_of_filing">Location of Filing</label>
									                </div>
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="represented_by" placeholder="Represented By" value="{{$lawsuits->represented_by}}">
									                    <label for="represented_by">Represented By</label>
									                </div>
									            </div>

									            <!-- Columna derecha -->
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="amount_of_suit" placeholder="Amount of Suit" value="{{$lawsuits->amount_of_suit}}">
									                    <label for="amount_of_suit">Amount of Suit</label>
									                </div>
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="docket_case_number" placeholder="Docket/Case No." value="{{$lawsuits->docket_case_number}}">
									                    <label for="docket_case_number">Docket/Case No.</label>
									                </div>
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="date" class="form-control form-control-sm input-433b-party-lawsuit-blur" id="possible_completion_date" placeholder="Possible Completion Date" value="{{$lawsuits->possible_completion_date}}">
									                    <label for="possible_completion_date">Possible Completion Date</label>
									                </div>
									            </div>
									        </div>
									        @endforeach
									    </div>
									    <!-- <div class="col-md-12 mt-3">
				                          <a href="javascript:;" id="add-item-433b-financial-lawsuit"><i class="ri-add-circle-fill"></i> Add More</a>
				                        </div> -->
									</div>

								</div>


								<!-- Pregunta: ¿El contribuyente ha estado involucrado en una demanda con el IRS? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Is or was the taxpayer(s) party to a lawsuit involving the IRS?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="taxpayer_party_lawsuit_irs" value="unknown" {{($client->taxpayer_party_lawsuit_irs == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="taxpayer_party_lawsuit_irs" value="no" {{($client->taxpayer_party_lawsuit_irs == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="taxpayer_party_lawsuit_irs" value="yes" {{($client->taxpayer_party_lawsuit_irs == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <div id="content-abc" class="row p-5  {{($client->taxpayer_party_lawsuit_irs == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">
									    	@foreach($client->taxpayerLawsuitsIrs as $taxpayerLawsuitsIrs)
									        <div class="row item-dependent item-433b-tax-payer-lawsuit">
									        	<input type="hidden" name="taxpayerLawsuitsIrs_id" id="taxpayerLawsuitsIrs_id"  value="{{$taxpayerLawsuitsIrs->id}}">
									            <div class="col-md-12">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-tax-payer-lawsuit-blur" id="types_of_tax_and_periods" placeholder="If the suit included tax debt, provide the types of tax and periods involved" value="{{$taxpayerLawsuitsIrs->types_of_tax_and_periods}}">
									                    <label for="types_of_tax_and_periods">If the suit included tax debt, provide the types of tax and periods involved</label>
									                </div>
									            </div>
									        </div>
									        @endforeach
									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿El negocio está en bancarrota? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Is the business currently in bankruptcy?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_currently_bankrupt" value="unknown" {{($client->business_currently_bankrupt == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_currently_bankrupt" value="no" {{($client->business_currently_bankrupt == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_currently_bankrupt" value="yes" {{($client->business_currently_bankrupt == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <p class="text-danger mt-2">⚠️ You cannot submit a 433-B or 433-B (OIC) until you are out of bankruptcy.</p>
								</div>

								<!-- Pregunta: ¿El negocio ha declarado bancarrota anteriormente? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Has the business ever filed bankruptcy?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_ever_filed_bankruptcy" value="unknown"   {{($client->business_ever_filed_bankruptcy == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_ever_filed_bankruptcy" value="no" {{($client->business_ever_filed_bankruptcy == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="business_ever_filed_bankruptcy" value="yes" {{($client->business_ever_filed_bankruptcy == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Formulario de detalles de la bancarrota -->
								    <div id="content-abc" class="row p-5  {{($client->business_ever_filed_bankruptcy == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">

									    	@foreach($client->bankruptcies as $bankruptcies)
									        <div class="row item-dependent item-433b-taxpayer-bankruptcy">
									        	<input type="hidden" name="bankruptcy_id" id="bankruptcy_id" value="{{$bankruptcies->id}}">
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="date" class="form-control form-control-sm input-433b-taxpayer-bankruptcy-blur" id="date_field" placeholder="Date Filed" value="{{$bankruptcies->date_field}}">
									                    <label for="date_field">Date Field</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="date" class="form-control form-control-sm input-433b-taxpayer-bankruptcy-blur" id="date" placeholder="Date Dismissed or Discharged" value="{{$bankruptcies->date}}">
									                    <label for="date">Date Dismissed or Discharged</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-taxpayer-bankruptcy-blur" id="petition_no" placeholder="Petition No." value="{{$bankruptcies->petition_no}}">
									                    <label for="petition_no">Petition No.</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-taxpayer-bankruptcy-blur" id="location" placeholder="Location" value="{{$bankruptcies->location}}">
									                    <label for="location">Location</label>
									                </div>
									            </div>
									        </div>
									        @endforeach
									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿En los últimos 10 años se han transferido activos por menos de su valor? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">In the past 10 years have any assets been transferred for less than value?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="assets_transferred_less_value" value="unknown"  {{($client->assets_transferred_less_value == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="assets_transferred_less_value" value="no" {{($client->assets_transferred_less_value == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="assets_transferred_less_value" value="yes" {{($client->assets_transferred_less_value == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>


								    <div id="content-433b-financial-transfer-10-year" class="row p-5  {{($client->assets_transferred_less_value == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">
									    	@foreach($client->businessAssetTransfers as $businessAssetTransfer)
									        <div class="row item-dependent item-433b-business-asset-transfer">
									        	<input type="hidden" name="businessAssetTransfer_id" id="businessAssetTransfer_id" value="{{$businessAssetTransfer->id}}">
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-business-asset-transfer" id="asset" placeholder="Asset" value="{{$businessAssetTransfer->asset}}">
									                    <label for="asset">Asset</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-business-asset-transfer" id="value_at_time_of_transfer" placeholder="Value at time of transfer" value="{{$businessAssetTransfer->value_at_time_of_transfer}}">
									                    <label for="value_at_time_of_transfer">Value at time of transfer</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="date" class="form-control form-control-sm input-433b-business-asset-transfer" id="date_transferred" placeholder="Date transferred" value="{{$businessAssetTransfer->date_transferred}}">
									                    <label for="date_transferred">Date transferred</label>
									                </div>
									            </div>
									            <div class="col-md-6 mt-3">
									                <div class="form-floating form-floating-outline">
									                    <input type="text" class="form-control form-control-sm input-433b-business-asset-transfer" id="where_transferred" placeholder="Where transferred" value="{{$businessAssetTransfer->where_transferred}}">
									                    <label for="where_transferred">Where transferred</label>
									                </div>
									            </div>
									        </div>
									        @endforeach


									        <!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-433b-financial-transfer-10-year"><i class="ri-add-circle-fill"></i> Add Asset Transfer</a>
					                        </div> -->
									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿En los últimos 3 años se ha transferido alguna propiedad inmobiliaria? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">In the past 3 years, has any real estate property been transferred?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_estate_transferred_3yrs" value="unknown"   {{($client->real_estate_transferred_3yrs == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_estate_transferred_3yrs" value="no" {{($client->real_estate_transferred_3yrs == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="real_estate_transferred_3yrs" value="yes" {{($client->real_estate_transferred_3yrs == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Formulario de detalles de la transferencia -->
								    <div id="content-433b-financial-transfer-3-year" class="row p-5  {{($client->real_estate_transferred_3yrs == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">

									    	@foreach($client->realEstateTransfers as $realEstateTransfer)
									        <div class="row item-dependent item-433b-financial-transfer">
									        	<input type="hidden" name="realEstateTransfer_id" id="realEstateTransfer_id" value="{{$realEstateTransfer->id}}">
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-real-state-transfer-blur" id="assets" placeholder="Asset" value="{{$realEstateTransfer->assets}}">
									                    <label for="assets">Asset</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="date" class="form-control form-control-sm input-433b-real-state-transfer-blur" id="date_transferred" placeholder="Date transferred" value="{{$realEstateTransfer->date_transferred}}">
									                    <label for="date_transferred">Date transferred</label>
									                </div>
									            </div>
									        </div>
									        @endforeach
									    </div>
									    <!-- <div class="col-md-12 mt-3">
					                          <a href="javascript:;" id="add-item-433b-financial-transfer-3-year"><i class="ri-add-circle-fill"></i> Add Asset Transfer</a>
					                        </div> -->
									</div>

								</div>

								<!-- Pregunta: ¿Se anticipa un aumento/disminución de ingresos? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Any increase/decrease in income anticipated?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="income_increase_decrease" value="unknown"   {{($client->income_increase_decrease == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="income_increase_decrease" value="no" {{($client->income_increase_decrease == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="income_increase_decrease" value="yes" {{($client->income_increase_decrease == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <!-- Formulario de detalles de ingresos -->
								    <div id="content-abc" class="row p-5  {{($client->income_increase_decrease == 'yes') ? '' : 'd-none'}}  contenedor">

									    <div class="col-md-12 p-5 card">
								    		@foreach($client->incomeChanges as $incomeChanges)
									        <div class="row item-dependent item-433b-incomechange">
									        	<input type="hidden" name="incomeChanges_id" id="incomeChanges_id" value="{{$incomeChanges->id}}">
									            <div class="col-md-12">
									                <div class="form-floating form-floating-outline mt-3">
									                    <textarea class="form-control input-433b-income-change-blur" id="explanation" placeholder="Explain" rows="5">{{$incomeChanges->explanation}}</textarea>
									                    <label for="explanation">Explain</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-income-change-blur" id="amount" placeholder="How much will it increase/decrease" value="{{$incomeChanges->amount}}">
									                    <label for="amount">How much will it increase/decrease</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="date" class="form-control form-control-sm input-433b-income-change-blur" id="date_of_change" placeholder="When will it increase/decrease" value="{{$incomeChanges->date_of_change}}">
									                    <label for="date_of_change">When will it increase/decrease</label>
									                </div>
									            </div>
									        </div>
									    	@endforeach


									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿Hay una caja fuerte en las instalaciones del negocio? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Is there a safe on the business premises?</label>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="safe_on_premises" value="unknown" {{($client->safe_on_premises == 'unknown') ? 'checked' : ''}}>
								        <label class="form-check-label">Unknown</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="safe_on_premises" value="no" {{($client->safe_on_premises == 'no') ? 'checked' : ''}}>
								        <label class="form-check-label">No</label>
								    </div>
								    <div class="form-check form-check-inline">
								        <input class="form-check-input input-433b-check-toogle" type="radio" name="safe_on_premises" value="yes" {{($client->safe_on_premises == 'yes') ? 'checked' : ''}}>
								        <label class="form-check-label">Yes</label>
								    </div>

								    <div id="content-abc" class="row p-5  {{($client->safe_on_premises == 'yes') ? '' : 'd-none'}}  contenedor">
									    <div class="col-md-12 p-5 card">

									    	@foreach($client->safe as $safe)
									        <div class="row item-dependent item-433b-financial-safe">
									        	<input type="hidden" name="safe_id" id="safe_id" value="{{$safe->id}}">
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-financial-safe" id="contents" placeholder="Contents" value="{{$safe->contents}}">
									                    <label for="contents">Contents</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-financial-safe" id="value" placeholder="Value" value="{{$safe->value}}">
									                    <label for="value">Value</label>
									                </div>
									            </div>
									        </div>
									        @endforeach


									    </div>
									</div>

								</div>

								<!-- Pregunta: ¿El negocio tiene fondos en custodia de un tercero? -->
								<div class="mb-3">
								    <label class="form-label fw-bold">Does the business have any funds being held in trust by a third party?</label>
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

								    <div id="content-abc" class="row p-5 {{($client->business_bank_accounts == 'yes') ? '' : 'd-none'}} contenedor">
									    <div class="col-md-12 p-5 card">
									    	@foreach($client->trustFunds as $trustFunds)
									        <div class="row item-dependent item-433b-trust-fund">
									        	<input type="hidden" name="trustFunds_id" id="trustFunds_id" value="{{$trustFunds->id}}">
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-trustfund-blur" id="location" placeholder="Location" value="{{$trustFunds->location}}">
									                    <label for="location">Location</label>
									                </div>
									            </div>
									            <div class="col-md-6">
									                <div class="form-floating form-floating-outline mt-3">
									                    <input type="text" class="form-control form-control-sm input-433b-trustfund-blur" id="amount" placeholder="Amount" value="{{$trustFunds->amount}}">
									                    <label for="amount">Amount</label>
									                </div>
									            </div>
									        </div>
									        @endforeach


									    </div>
									</div>

								</div>

                		</div>
                	</div>
            </form>
        </div>
</div>