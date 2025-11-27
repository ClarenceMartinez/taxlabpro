@extends('components.layout')
@section('content')
 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('company.account', ['hash' => $hash])}}"
                          ><i class="ri-group-line me-2"></i>Account</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('company.teams', ['hash' => $hash])}}"
                          ><i class="ri-bookmark-line me-2"></i>Teams</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="{{route('company.bills', ['hash' => $hash])}}"
                          ><i class="ri-bookmark-line me-2"></i>Billing & Plans</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('company.notifications', ['hash' => $hash])}}"
                          ><i class="ri-notification-4-line me-2"></i>Notifications</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{route('company.connections', ['hash' => $hash])}}"
                          ><i class="ri-link-m me-2"></i>Connections</a
                        >
                      </li>
                    </ul>
                  </div>







                  <div class="card mb-6">
                    <!-- Current Plan -->
                    <h5 class="card-header">Current Plan</h5>
                    <div class="card-body pt-1">
                      <div class="row row-gap-6">
                        <div class="col-md-6 mb-1">
                          <div class="mb-6">
                            <h6 class="mb-1">Your Current Plan is Basic</h6>
                            <p>A simple start for everyone</p>
                          </div>
                          <div class="mb-6">
                            <h6 class="mb-1">Active until Dec 09, 2021</h6>
                            <p>We will send you a notification upon Subscription expiration</p>
                          </div>
                          <div>
                            <h6 class="mb-1">
                              <span class="me-1">$199 Per Month</span>
                              <span class="badge bg-label-primary rounded-pill">Popular</span>
                            </h6>
                            <p class="mb-1">Standard plan for small to medium businesses</p>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="alert alert-warning mb-6 alert-dismissible" role="alert">
                            <h5 class="alert-heading mb-1 d-flex align-items-center">
                              <span class="alert-icon rounded-3"><i class="ri-alert-line ri-22px"></i></span>
                              <span>We need your attention!</span>
                            </h5>
                            <span class="ms-11 ps-1">Your plan requires update</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                          </div>
                          <div class="plan-statistics">
                            <div class="d-flex justify-content-between">
                              <h6 class="mb-1">Days</h6>
                              <h6 class="mb-1">24 of 30 Days</h6>
                            </div>
                            <div class="progress rounded mb-1" style="height: 6px">
                              <div
                                class="progress-bar w-75 rounded"
                                role="progressbar"
                                aria-valuenow="75"
                                aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                            <small>6 days remaining until your plan requires update</small>
                          </div>
                        </div>
                        <div class="col-12 d-flex gap-4 flex-wrap">
                          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pricingModal">
                            Upgrade Plan
                          </button>
                          <button class="btn btn-outline-danger cancel-subscription">Cancel Subscription</button>
                        </div>
                      </div>
                    </div>
                    <!-- /Current Plan -->
                  </div>
                  <div class="card mb-6">
                    <h5 class="card-header mb-1">Payment Methods</h5>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <form id="creditCardForm" class="row g-5" onsubmit="return false">
                            <div class="col-12 d-flex column-gap-5 flex-wrap">
                              <div class="form-check form-check-inline mb-sm-1 mb-3">
                                <input
                                  name="collapsible-payment"
                                  class="form-check-input"
                                  type="radio"
                                  value=""
                                  id="collapsible-payment-cc"
                                  checked="" />
                                <label class="form-check-label" for="collapsible-payment-cc"
                                  >Credit/Debit/ATM Card</label
                                >
                              </div>
                              <div class="form-check form-check-inline mb-1">
                                <input
                                  name="collapsible-payment"
                                  class="form-check-input"
                                  type="radio"
                                  value=""
                                  id="collapsible-payment-cash" />
                                <label class="form-check-label" for="collapsible-payment-cash">Paypal account</label>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                  <input
                                    id="paymentCard"
                                    name="paymentCard"
                                    class="form-control credit-card-mask"
                                    type="text"
                                    placeholder="135632156548789"
                                    aria-describedby="paymentCard2" />
                                  <label for="paymentCard">Card Number</label>
                                </div>
                                <span class="input-group-text cursor-pointer" id="paymentCard2"
                                  ><span class="card-type"></span
                                ></span>
                              </div>
                            </div>
                            <div class="col-12 col-lg-6">
                              <div class="form-floating form-floating-outline">
                                <input type="text" id="paymentName" class="form-control" placeholder="John Doe" />
                                <label for="paymentName">Name</label>
                              </div>
                            </div>
                            <div class="col-6 col-lg-3">
                              <div class="form-floating form-floating-outline">
                                <input
                                  type="text"
                                  id="paymentExpiryDate"
                                  class="form-control expiry-date-mask"
                                  placeholder="06/24" />
                                <label for="paymentExpiryDate">Expiry</label>
                              </div>
                            </div>
                            <div class="col-6 col-lg-3">
                              <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                  <input
                                    type="text"
                                    id="paymentCvv"
                                    class="form-control cvv-code-mask"
                                    maxlength="3"
                                    placeholder="***" />
                                  <label for="paymentCvv">CVV</label>
                                </div>
                                <span class="input-group-text cursor-pointer" id="paymentCvv2"
                                  ><i
                                    class="ri-question-line text-muted"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Card Verification Value"></i
                                ></span>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-check form-switch my-1">
                                <input type="checkbox" class="form-check-input" id="future-billing" />
                                <label for="future-billing">Save card for future billing?</label>
                              </div>
                            </div>
                            <div class="col-12">
                              <button type="submit" class="btn btn-primary me-3">Save Changes</button>
                              <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                          </form>
                        </div>
                        <div class="col-md-6 mt-12 mt-md-0">
                          <h6 class="mb-6">My Cards</h6>
                          <div class="added-cards">
                            <div class="cardMaster bg-lighter p-5 rounded-4 mb-6">
                              <div class="d-flex justify-content-between flex-sm-row flex-column">
                                <div class="card-information me-2">
                                  <img
                                    class="mb-2 img-fluid"
                                    src="../../assets/img/icons/payments/mastercard.png"
                                    alt="Master Card" />
                                  <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                                    <h6 class="mb-0 me-2">Tom McBride</h6>
                                    <span class="badge bg-label-primary rounded-pill">Primary</span>
                                  </div>
                                  <span class="card-number"
                                    >&#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; 9856</span
                                  >
                                </div>
                                <div class="d-flex flex-column text-start text-lg-end">
                                  <div class="d-flex order-sm-0 order-1 mt-sm-0 mt-4">
                                    <button
                                      class="btn btn-sm btn-outline-primary me-4"
                                      data-bs-toggle="modal"
                                      data-bs-target="#editCCModal">
                                      Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                  </div>
                                  <small class="mt-sm-4 mt-2 order-sm-1 order-0">Card expires at 12/26</small>
                                </div>
                              </div>
                            </div>
                            <div class="cardMaster bg-lighter p-5 rounded-4">
                              <div class="d-flex justify-content-between flex-sm-row flex-column">
                                <div class="card-information me-2">
                                  <img
                                    class="mb-2 img-fluid"
                                    src="../../assets/img/icons/payments/visa.png"
                                    alt="Visa Card" />
                                  <h6 class="mb-2">Mildred Wagner</h6>
                                  <span class="card-number"
                                    >&#8727;&#8727;&#8727;&#8727; &#8727;&#8727;&#8727;&#8727; 5896</span
                                  >
                                </div>
                                <div class="d-flex flex-column text-start text-lg-end">
                                  <div class="d-flex order-sm-0 order-1 mt-sm-0 mt-4">
                                    <button
                                      class="btn btn-sm btn-outline-primary me-4"
                                      data-bs-toggle="modal"
                                      data-bs-target="#editCCModal">
                                      Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                  </div>
                                  <small class="mt-sm-4 mt-2 order-sm-1 order-0">Card expires at 10/27</small>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal -->
                          <!-- Add New Credit Card Modal -->
                          <div class="modal fade" id="editCCModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                              <div class="modal-content p-4 p-md-12">
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                                <div class="modal-body p-md-0">
                                  <div class="text-center mb-6">
                                    <h3 class="mb-2 pb-1">Edit Card</h3>
                                    <p>Edit your saved card details</p>
                                  </div>
                                  <form id="editCCForm" class="row g-4" onsubmit="return false">
                                    <div class="col-12">
                                      <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                          <input
                                            id="modalEditCard"
                                            name="modalEditCard"
                                            class="form-control credit-card-mask-edit"
                                            type="text"
                                            placeholder="4356 3215 6548 7898"
                                            value="4356 3215 6548 7898"
                                            aria-describedby="modalEditCard2" />
                                          <label for="modalEditCard">Card Number</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer" id="modalEditCard2"
                                          ><span class="card-type-edit"></span
                                        ></span>
                                      </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                      <div class="form-floating form-floating-outline">
                                        <input
                                          type="text"
                                          id="modalEditName"
                                          class="form-control"
                                          placeholder="John Doe"
                                          value="John Doe" />
                                        <label for="modalEditName">Name</label>
                                      </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                      <div class="form-floating form-floating-outline">
                                        <input
                                          type="text"
                                          id="modalEditExpiryDate"
                                          class="form-control expiry-date-mask-edit"
                                          placeholder="MM/YY"
                                          value="08/28" />
                                        <label for="modalEditExpiryDate">Exp. Date</label>
                                      </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                      <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                          <input
                                            type="text"
                                            id="modalEditCvv"
                                            class="form-control cvv-code-mask-edit"
                                            maxlength="3"
                                            placeholder="654"
                                            value="XXX" />
                                          <label for="modalEditCvv">CVV Code</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer" id="modalEditCvv2"
                                          ><i
                                            class="ri-question-line text-muted"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Card Verification Value"></i
                                        ></span>
                                      </div>
                                    </div>
                                    <div class="col-12">
                                      <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="editPrimaryCard" />
                                        <label for="editPrimaryCard">Set as primary card</label>
                                      </div>
                                    </div>
                                    <div class="col-12 text-center">
                                      <button type="submit" class="btn btn-primary me-sm-4 me-1">Submit</button>
                                      <button
                                        type="reset"
                                        class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                        Cancel
                                      </button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!--/ Add New Credit Card Modal -->

                          <!--/ Modal -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mb-6">
                    <!-- Billing Address -->
                    <h5 class="card-header">Billing Address</h5>
                    <div class="card-body">
                      <form id="formAccountSettings" onsubmit="return false">
                        <div class="row g-5">
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="text"
                                id="companyName"
                                name="companyName"
                                class="form-control"
                                placeholder="Pixinvent" />
                              <label for="companyName">Company Name</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                class="form-control"
                                type="text"
                                id="billingEmail"
                                name="billingEmail"
                                placeholder="john.doe@example.com" />
                              <label for="billingEmail">Billing Email</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="text"
                                id="taxId"
                                name="taxId"
                                class="form-control"
                                placeholder="Enter Tax ID" />
                              <label for="taxId">Tax ID</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                class="form-control"
                                type="text"
                                id="vatNumber"
                                name="vatNumber"
                                placeholder="Enter VAT Number" />
                              <label for="vatNumber">VAT Number</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="input-group input-group-merge">
                              <div class="form-floating form-floating-outline">
                                <input
                                  class="form-control mobile-number"
                                  type="text"
                                  id="mobileNumber"
                                  name="mobileNumber"
                                  placeholder="202 555 0111" />
                                <label for="mobileNumber">Mobile</label>
                              </div>
                              <span class="input-group-text">US (+1)</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <select id="country" class="form-select select2" name="country">
                                <option>USA</option>
                                <option>Canada</option>
                                <option>UK</option>
                                <option>Germany</option>
                                <option>France</option>
                              </select>
                              <label for="country">Country</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="text"
                                class="form-control"
                                id="billingAddress"
                                name="billingAddress"
                                placeholder="Billing Address" />
                              <label for="billingAddress">Billing Address</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                class="form-control"
                                type="text"
                                id="state"
                                name="state"
                                placeholder="California" />
                              <label for="state">State</label>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="text"
                                class="form-control zip-code"
                                id="zipCode"
                                name="zipCode"
                                placeholder="231465"
                                maxlength="6" />
                              <label for="zipCode">Zip Code</label>
                            </div>
                          </div>
                        </div>
                        <div class="mt-5">
                          <button type="submit" class="btn btn-primary me-3">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Billing Address -->
                  </div>
                  <div class="card">
                    <!-- Billing History -->
                    <h5 class="card-header text-center text-md-start pb-0">Billing History</h5>
                    <div class="card-datatable table-responsive">
                      <table class="invoice-list-table table">
                        <thead>
                          <tr>
                            <th></th>
                            <th></th>
                            <th>#ID</th>
                            <th>#</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th class="text-truncate">Issued Date</th>
                            <th>Balance</th>
                            <th>Invoice Status</th>
                            <th class="cell-fit">Actions</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <!--/ Billing History -->
                  </div>











                  



































                </div>
              </div>
            </div> 




            <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-pricing">
                  <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                      <!-- Pricing Plans -->
                      <div class="pb-6 rounded-top">
                        <h4 class="text-center mb-2">Pricing Plans</h4>
                        <p class="text-center mb-0">
                          All plans include 40+ advanced tools and features to boost your product. Choose the best plan
                          to fit your needs.
                        </p>
                        <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pt-12 pb-4">
                          <label class="switch switch-sm ms-sm-12 ps-sm-12 me-0">
                            <span class="switch-label fs-6 text-body">Monthly</span>
                            <input type="checkbox" class="switch-input price-duration-toggler" checked />
                            <span class="switch-toggle-slider">
                              <span class="switch-on"></span>
                              <span class="switch-off"></span>
                            </span>
                            <span class="switch-label fs-6 text-body">Annually</span>
                          </label>
                          <div class="mt-n5 ms-n10 ml-2 mb-10 d-none d-sm-flex align-items-center gap-2">
                            <i class="ri-corner-left-down-fill ri-24px text-muted scaleX-n1-rtl"></i>
                            <span class="badge badge-sm bg-label-primary rounded-pill mb-2">Save up to 10%</span>
                          </div>
                        </div>

                        <div class="row gy-3">
                          <!-- Basic -->
                          <div class="col-xl mb-md-0 mb-6">
                            <div class="card border shadow-none">
                              <div class="card-body pt-12">
                                <div class="mt-3 mb-5 text-center">
                                  <img
                                    src="../../assets/img/illustrations/pricing-basic.png"
                                    alt="Basic Image"
                                    height="100" />
                                </div>
                                <h4 class="card-title text-center text-capitalize mb-2">Basic</h4>
                                <p class="text-center mb-5">A simple start for everyone</p>
                                <div class="text-center h-px-50">
                                  <div class="d-flex justify-content-center">
                                    <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1 fw-normal">$</sup>
                                    <h1 class="mb-0 text-primary">0</h1>
                                    <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                                  </div>
                                </div>

                                <ul class="list-group ps-6 my-5 pt-4">
                                  <li class="mb-4">100 responses a month</li>
                                  <li class="mb-4">Unlimited forms and surveys</li>
                                  <li class="mb-4">Unlimited fields</li>
                                  <li class="mb-4">Basic form creation tools</li>
                                  <li class="mb-0">Up to 2 subdomains</li>
                                </ul>

                                <button
                                  type="button"
                                  class="btn btn-outline-success d-grid w-100"
                                  data-bs-dismiss="modal">
                                  Your Current Plan
                                </button>
                              </div>
                            </div>
                          </div>

                          <!-- Standard -->
                          <div class="col-xl mb-md-0 mb-6">
                            <div class="card border-primary border shadow-none">
                              <div class="card-body position-relative pt-4">
                                <div class="position-absolute end-0 me-6 top-0 mt-6">
                                  <span class="badge bg-label-primary rounded-pill">Popular</span>
                                </div>
                                <div class="my-5 pt-6 text-center">
                                  <img
                                    src="../../assets/img/illustrations/pricing-standard.png"
                                    alt="Standard Image"
                                    height="100" />
                                </div>
                                <h4 class="card-title text-center text-capitalize mb-2">Standard</h4>
                                <p class="text-center mb-5">For small to medium businesses</p>
                                <div class="text-center h-px-50">
                                  <div class="d-flex justify-content-center">
                                    <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                                    <h1 class="price-toggle price-yearly text-primary mb-0">7</h1>
                                    <h1 class="price-toggle price-monthly text-primary mb-0 d-none">9</h1>
                                    <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                                  </div>
                                  <small class="price-yearly price-yearly-toggle text-muted">USD 480 / year</small>
                                </div>

                                <ul class="list-group ps-6 my-5 pt-4">
                                  <li class="mb-4">Unlimited responses</li>
                                  <li class="mb-4">Unlimited forms and surveys</li>
                                  <li class="mb-4">Instagram profile page</li>
                                  <li class="mb-4">Google Docs integration</li>
                                  <li class="mb-0">Custom “Thank you” page</li>
                                </ul>

                                <button type="button" class="btn btn-primary d-grid w-100" data-bs-dismiss="modal">
                                  Upgrade
                                </button>
                              </div>
                            </div>
                          </div>

                          <!-- Enterprise -->
                          <div class="col-xl">
                            <div class="card border shadow-none">
                              <div class="card-body pt-12">
                                <div class="mt-3 mb-5 text-center">
                                  <img
                                    src="../../assets/img/illustrations/pricing-enterprise.png"
                                    alt="Enterprise Image"
                                    height="100" />
                                </div>
                                <h4 class="card-title text-center text-capitalize mb-2">Enterprise</h4>
                                <p class="text-center mb-5">Solution for big organizations</p>

                                <div class="text-center h-px-50">
                                  <div class="d-flex justify-content-center">
                                    <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                                    <h1 class="price-toggle price-yearly text-primary mb-0">16</h1>
                                    <h1 class="price-toggle price-monthly text-primary mb-0 d-none">19</h1>
                                    <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                                  </div>
                                  <small class="price-yearly price-yearly-toggle text-muted">USD 960 / year</small>
                                </div>

                                <ul class="list-group ps-6 my-5 pt-4">
                                  <li class="mb-4">PayPal payments</li>
                                  <li class="mb-4">Logic Jumps</li>
                                  <li class="mb-4">File upload with 5GB storage</li>
                                  <li class="mb-4">Custom domain support</li>
                                  <li class="mb-0">Stripe integration</li>
                                </ul>

                                <button
                                  type="button"
                                  class="btn btn-outline-primary d-grid w-100"
                                  data-bs-dismiss="modal">
                                  Upgrade
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--/ Pricing Plans -->
                      <div class="text-center">
                        <p>Still Not Convinced? Start with a 14-day FREE trial!</p>
                        <a href="javascript:void(0);" class="btn btn-primary">Start your trial</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Pricing Modal -->

              <script src="{{asset('assets/js/pages-pricing.js')}}"></script>
@endsection

@section('scripts')
    @include('company.js-company-datatables')

      @section('scripts')
          @include('company.js-company-datatables')
      @endsection
@endsection

<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/js/pages-pricing.js')}}"></script>
<script src="{{asset('assets/js/pages-account-settings-billing.js')}}"></script>
<script src="{{asset('assets/js/app-invoice-list.js')}}"></script>
<script src="{{asset('assets/js/modal-edit-cc.js')}}"></script>