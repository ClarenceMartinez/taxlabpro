<div class="tab-pane fade" id="navs-encome-expense-card" role="tabpanel" style="text-align: left;">
          <div class="card-body pt-3">
            <form>
             
              <div class="row g-6 mt-2 item-433a-income-expense">
                <input type="hidden" name="income_expense_id" id="income_expense_id" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->id : '' }}">
                <div class="col-md-12 mt-5">
                    <table class="table table-responsive table-bordered table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th class="text-end">Actual Amount</th>
                          <th class="text-end">Proposed Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Income Total</td>
                          <td class="text-end txt-income-total">0.00</td>
                          <td class="text-end">0.00</td>
                        </tr>
                        <tr>
                          <td>Expense Total</td>
                          <td class="text-end txt-expense-total">0.00</td>
                          <td class="text-end">0.00</td>
                        </tr>
                        <tr>
                          <td><strong>Net Monthly Income</strong></td>
                          <td class="text-end txt-net-monthly"><strong>0.00</strong></td>
                          <td class="text-end"><strong>0.00</strong></td>
                        </tr>
                      </tbody>
                  </table>                      
                </div>
                <div class="col-md-6 mt-5">

                  @php

                  $incomeFields = [
                      'primary_gross_wages',
                      'spouse_gross_wages',
                      'primary_social_security',
                      'spouse_social_security',
                      'primary_pension',
                      'spouse_pension',
                      'primary_unemployment',
                      'spouse_unemployment',
                      'additional_household_income',
                      'interested',
                      'dividends_income',
                      'distributions',
                      'net_rental_income',
                      'child_support_received',
                      'alimony_received',
                  ];

                  $total_income = 0;

                  if (isset($client->monthlyFinancial[0])) {
                      foreach ($incomeFields as $field) {
                          $total_income += floatval($client->monthlyFinancial[0]->$field ?? 0);
                      }
                  }

                  @endphp
                  <table class="table table-responsive table-hover">
                    <thead>
                      <tr>
                        <th>Income</th>
                        <th>Actual Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="javascript:;">Primary gross wages</a></td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->primary_gross_wages : '' }}" name="primary_gross_wages"></td>
                      </tr>
                      <tr>
                        <td><a href="javascript:;">Spouse gross wages</a></td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->spouse_gross_wages : '' }}" name="spouse_gross_wages"></td>
                      </tr>
                      <tr>
                        <td>Primary Social Security</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->primary_social_security : '' }}" name="primary_social_security"></td>
                      </tr>
                      <tr>
                        <td>Spouse Social Security</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->spouse_social_security : '' }}" name="spouse_social_security"></td>
                      </tr>
                      <tr>
                        <td>Primary pension</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->primary_pension : '' }}" name="primary_pension"></td>
                      </tr>
                      <tr>
                        <td>Spouse pension</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->spouse_pension : '' }}" name="spouse_pension"></td>
                      </tr>
                      <tr>
                        <td>Primary unemployment</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->primary_unemployment : '' }}" name="primary_unemployment"></td>
                      </tr>
                      <tr>
                        <td>Spouse unemployment</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->spouse_unemployment : '' }}" name="spouse_unemployment"></td>
                      </tr>
                      <tr>
                        <td>Add'l household income</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->additional_household_income : '' }}" name="additional_household_income"></td>
                      </tr>
                      <tr>
                        <td>Interested</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->interested : '' }}" name="interested"></td>
                      </tr>
                      <tr>
                        <td>Diviends</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->dividends_income : '' }}" name="dividends_income"></td>
                      </tr>
                      <tr>
                        <td>Distributions</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->distributions : '' }}" name="distributions"></td>
                      </tr>
                      <!-- <tr>
                        <td>Net business income</td>
                        <td><span>0</span></td>
                      </tr> -->

                     
                      <tr>
                        <td>Net rental income</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" name="net_rental_income" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->net_rental_income : '' }}"></td>
                      </tr>
                      <tr>
                        <td>Child support received</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" name="child_support_received" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->child_support_received : '' }}"></td>
                      </tr>
                      <tr>
                        <td>Alimony received</td>
                        <td><input type="text" class="form-control form-control-sm input-433a-income-expense-blur income-calculate" name="alimony_received" value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->alimony_received : '' }}"></td>
                      </tr>
                      <!-- <tr>
                        <td><a href="javascript:;">Add income</a></td>
                        <td></td>
                      </tr> -->
                      <tr>
                        <td><b>TOTAL</b></td>
                        <td><b>$<span class="total_income_span">{{ number_format($total_income,2) }}</span></b></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 mt-5">
                    
                    <h3>Expenses</h3>                        

                          @php
                              $expenseFields = [
                                  'expenses_food' => 'Food',
                                  'expenses_housekeeping_supplies' => 'Housekeeping Supplies',
                                  'expenses_clothing' => 'Clothing',
                                  'expenses_personal_care_products' => 'Personal Care Products',
                                  'expenses_credit_card_payments' => 'Credit Card Payments',
                                  'expenses_bank_fees' => 'Bank Fees',
                                  'expenses_school_supplies' => 'Reading Material and School Supplies',
                                  'expenses_miscellaneous' => 'Miscellaneous'
                              ];

                              $total_35 = 0;
                              $total_36 = 0;
                              $total_37 = 0;
                              $total_38 = 0;
                              $total_39 = 0;
                              $total_40 = 0;
                              $total_41 = 0;
                              $total_42 = 0;
                              $total_43 = 0;
                              $total_44 = 0;
                              $total_45 = 0;
                              $total_46 = 0;
                              $total_47 = 0;
                              $total_48 = 0;
                              foreach($expenseFields as $field => $label)
                              {
                                $total_35 += isset($client->monthlyFinancial[0]) && is_numeric($client->monthlyFinancial[0]->$field) ? floatval($client->monthlyFinancial[0]->$field) : 0;
                              }
                          @endphp
                          <div id="accordionCustomIcon" class="accordion mt-3 accordion-custom-button">
                            <div class="accordion-item item-35 active">
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconOne">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-1"
                                  aria-controls="accordionPopoutIcon-1">
                                  <i class="ri-bar-chart-2-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">
                                  Food, Clothing, misc. <span class="text-end float-end">{{ number_format($total_35,2) }}</span></p>
                                </button>
                              </h2>

                              <div
                                id="accordionCustomIcon-1"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">
                                  <table class="table ">
                                    @foreach($expenseFields as $field => $label)
                                        <tr>
                                            <td>{{ $label }}</td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    step="0.01" 
                                                    name="{{ $field }}" 
                                                    class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-food"
                                                    value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                                >
                                            </td>
                                        </tr>
                                    @endforeach
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-36">
                                  @php
                                      $expenseFields2 = [
                                          
                                          'expenses_mortgage' => 'Mortgage',
                                          'expenses_homeowners_insurance' => "Homeowner's Insurance",
                                          'expenses_rent' => 'Rent',
                                          'expenses_renters_insurance' => "Renter's Insurance",
                                          'expenses_real_estate_taxes' => 'Real Estate Taxes',
                                          'expenses_housing_maintenance' => 'Maintenance',
                                          'expenses_dues' => 'Dues',
                                          'expenses_fees' => 'Fees',
                                          'expenses_repairs' => 'Repairs',
                                          'expenses_electric' => 'Electric',
                                          'expenses_natural_gas' => 'Natural Gas',
                                          'expenses_water' => 'Water',
                                          'expenses_trash_collection' => 'Trash Collection',
                                          'expenses_home_phone' => 'Home Phone',
                                          'expenses_cellphone' => 'Cellphone',
                                          'expenses_internet' => 'Internet',
                                          'expenses_cable' => 'Cable Television',
                                          'expenses_oil' => 'Oil',
                                          'expenses_fuel' => 'Fuel',
                                          'expenses_other_fuels' => 'Other Fuels'
                                      ];
                                      
                                      foreach($expenseFields2 as $field => $label)
                                      {
                                        $total_36 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                      }
                                  @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-2"
                                  aria-controls="accordionCustomIcon-2">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Housing and utilities. <span class="text-end float-end">{{ number_format($total_36,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-2"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields2 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-housing"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-37">
                                @php
                                  $expenseFields37 = [
                                      'expenses_car_loan_payment' => 'Car Loan Payment',
                                      'expenses_car_lease_payment' => 'Car Lease Payment',
                                  ];

                                  foreach($expenseFields37 as $field => $label)
                                  {
                                    $total_37 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-37"
                                  aria-controls="accordionCustomIcon-37">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Vehicle Ownership Costs. <span class="text-end float-end">{{ number_format($total_37,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-37"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields37 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-vehicle-owe"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-38">
                                @php
                                  $expenseFields38 = [
                                      
                                      'expenses_vehicle_maintenance' => 'Vehicle Maintenance',
                                      'expenses_vehicle_repairs' => 'Vehicle Repairs',
                                      'expenses_vehicle_insurance' => 'Vehicle Insurance',
                                      'expenses_vehicle_fuel' => 'Vehicle Fuel',
                                      'expenses_vehicle_registrations' => 'Vehicle Registrations',
                                      'expenses_vehicle_licenses' => 'Vehicle Licenses',
                                      'expenses_parking' => 'Parking',
                                      'expenses_inspections' => 'Inspections',
                                      'expenses_tolls' => 'Tolls',
                                  ];

                                  foreach($expenseFields38 as $field => $label)
                                  {
                                    $total_38 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-38"
                                  aria-controls="accordionCustomIcon-38">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Vehicle Operating Costs. <span class="text-end float-end">{{ number_format($total_38,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-38"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields38 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-vehicle-operating"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-39">
                                @php
                                  $expenseFields39 = [
                                      
                                      'expenses_bus' => 'Bus',
                                      'expenses_train' => 'Train',
                                      'expenses_ferry' => 'Ferry',
                                      'expenses_taxi' => 'Taxi',
                                      'expenses_ride_share' => 'Ride-share',
                                  ];

                                  foreach($expenseFields39 as $field => $label)
                                  {
                                    $total_39 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-39"
                                  aria-controls="accordionCustomIcon-39">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Public Transportation Costs. <span class="text-end float-end">{{ number_format($total_39,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-39"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields39 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-public-transport"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-40">
                                @php
                                  $expenseFields40 = [
                                      
                                      'expenses_health_insurance' => 'Health Insurance',
                                      'expenses_dental_insurance' => 'Dental Insurance',
                                      'expenses_vision_insurance' => 'Vision Insurance',
                                  ];

                                  foreach($expenseFields40 as $field => $label)
                                  {
                                    $total_40 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-40"
                                  aria-controls="accordionCustomIcon-40">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Health Insurance <span class="text-end float-end">{{ number_format($total_40,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-40"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields40 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-health-insurance"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-41">
                                @php
                                  $expenseFields41 = [
                                      
                                      'expenses_medical_services' => 'Medical Services',
                                      'expenses_prescription_drugs' => 'Prescription Drugs (Medication)',
                                      'expenses_medical_supplies' => 'Medical Supplies',
                                      'expenses_medical_equipment' => 'Medical Equipment',
                                      'expenses_eyeglasses' => 'Eyeglasses',
                                      'expenses_contacts' => 'Contacts',
                                      'expenses_hearing_aids' => 'Hearing Aids',
                                  ];

                                  foreach($expenseFields41 as $field => $label)
                                  {
                                    $total_41 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-41"
                                  aria-controls="accordionCustomIcon-41">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Out-of-pocket Health Car <span class="text-end float-end">{{ number_format($total_41,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-41"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields41 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-out-of-pocket"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-42">
                                @php
                                  $expenseFields42 = [
                                      
                                      'expenses_alimony' => 'Alimony',
                                      'expenses_child_support' => 'Child Support',
                                      'expenses_restitution' => 'Restitution Payments (Due to court order)',
                                  ];

                                  foreach($expenseFields42 as $field => $label)
                                  {
                                    $total_42 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-42"
                                  aria-controls="accordionCustomIcon-42">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Court Ordered Payments. <span class="text-end float-end">{{ number_format($total_42,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-42"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields42 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-court-ordered-pay"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-43">
                                @php
                                  $expenseFields43 = [
                                      'expenses_daycare' => 'Daycare',
                                      'expenses_babysitter_fees' => 'Babysitter Fees',
                                      'expenses_elder_care' => 'Elder Care',
                                  ];
                                  foreach($expenseFields43 as $field => $label)
                                  {
                                    $total_43 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-43"
                                  aria-controls="accordionCustomIcon-43">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Child/Dependent Care <span class="text-end float-end">{{ number_format($total_43,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-43"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields43 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-child-dependend"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-44">
                                @php
                                  $expenseFields44 = [
                                     'expenses_life_insurance' => 'Life Insurance',
                                  ];
                                  
                                  foreach($expenseFields44 as $field => $label)
                                  {
                                    $total_44 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-44"
                                  aria-controls="accordionCustomIcon-44">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Life Insurance <span class="text-end float-end">{{ number_format($total_44,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-44"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields44 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-life-insurance"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-45">
                                @php
                                  $expenseFields45 = [
                                    'expenses_w2_federal' => 'W-2 Federal Withheld',
                                    'expenses_w2_state' => 'W-2 State Withheld',
                                    'expenses_fed_estimated_taxes' => 'FED Estimated Tax Payments',
                                    'expenses_state_estimated_taxes' => 'State Estimated Tax Payments',
                                    'expenses_social_security' => 'Social Security',
                                    'expenses_medicare' => 'Medicare',
                                  ];

                                  foreach($expenseFields45 as $field => $label)
                                  {
                                    $total_45 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-45"
                                  aria-controls="accordionCustomIcon-45">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Current Year Taxes <span class="text-end float-end">{{ number_format($total_45,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-45"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields45 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-current-year"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-46">
                                @php
                                  $expenseFields46 = [
                                    'expenses_heloc' => 'HELOC',
                                    'expenses_personal_loan' => 'Secured Personal Loan',
                                    'expenses_student_loans' => 'GOV Guaranteed Student Loans',
                                    'expenses_secured_cc' => 'Secured CC',
                                    'expenses_cd_loans' => 'CD Loans',
                                    'expenses_jewelry' => 'Jewelry',
                                    'expenses_stocks_bonds' => 'Stocks & Bonds',
                                  ];

                                  foreach($expenseFields46 as $field => $label)
                                  {
                                    $total_46 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-46"
                                  aria-controls="accordionCustomIcon-46">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Secured Debt <span class="text-end float-end">{{ number_format($total_46,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-46"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields46 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-secured-deb"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-47">
                              @php
                                $expenseFields47 = [
                                  'expenses_state_taxes' => 'State Taxes',
                                  'expenses_property_taxes' => 'Property Taxes',
                                  'expenses_sales_taxes' => 'Sales Taxes',
                                  'expenses_local_taxes' => 'Local Taxes',
                                ];

                                foreach($expenseFields47 as $field => $label)
                                  {
                                    $total_47 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-47"
                                  aria-controls="accordionCustomIcon-47">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Delinquent Taxes <span class="text-end float-end">{{ number_format($total_47,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-47"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields47 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-delinquent-tax"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item item-48">
                              @php
                                  $expenseFields48 = [
                                    'expenses_pet_related' => 'Pet-Related Expenses',
                                    'expenses_charitable_contributions' => 'Charitable Contributions',
                                    'expenses_legal_fees' => 'Legal Fees',
                                    'expenses_disability_expenses' => 'Disability-Related Expenses',
                                    'expenses_professional_dues' => 'Professional Licensing or Union Dues',
                                  ];

                                  foreach($expenseFields48 as $field => $label)
                                  {
                                    $total_48 += isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : 0;
                                  }
                              @endphp
                              <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionCustomIconTwo">
                                <button
                                  type="button"
                                  class="accordion-button collapsed"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#accordionCustomIcon-48"
                                  aria-controls="accordionCustomIcon-48">
                                  <i class="ri-briefcase-line ri-20px me-2"></i>
                                  <p class="m-0 mt-2 w-75">Other Expenses <span class="text-end float-end">{{ number_format($total_48,2) }}</span></p>
                                </button>
                              </h2>
                              <div
                                id="accordionCustomIcon-48"
                                class="accordion-collapse collapse"
                                data-bs-parent="#accordionCustomIcon">
                                <div class="accordion-body">

                                  <table class="table ">
                                    @foreach($expenseFields48 as $field => $label)
                                    <tr>
                                        <td>{{ $label }}</td>
                                        <td>
                                            <input 
                                                type="number" 
                                                step="0.01" 
                                                name="{{ $field }}" 
                                                class="form-control form-control-sm input-433a-income-expense-blur expense-calculate calculate-other-expense"
                                                value="{{ isset($client->monthlyFinancial[0]) ? $client->monthlyFinancial[0]->$field : '' }}"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>

                            @php
                            $totals = [
                                  $total_35,
                                  $total_36,
                                  $total_37,
                                  $total_38,
                                  $total_39,
                                  $total_40,
                                  $total_41,
                                  $total_42,
                                  $total_43,
                                  $total_44,
                                  $total_45,
                                  $total_46,
                                  $total_47,
                                  $total_48,
                              ];

                              $total_expense_nn = array_sum($totals);
                            @endphp
                            <input type="hidden" id="total_income_nn" value="{{number_format($total_income,2)}}">
                            <input type="hidden" id="total_expense_nn" value="{{ number_format($total_expense_nn,2) }}">

                          </div>

                </div>      
              </div>
            </form>
          </div>
      </div>