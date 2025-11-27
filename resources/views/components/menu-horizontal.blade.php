<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner">
                  <!-- Dashboards -->
                  <li class="menu-item {{ request()->is('welcome') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ri-home-smile-line"></i>
                      <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->is('welcome') ? 'active' : '' }}">
                        <a href="{{ route('welcome.index') }}" class="menu-link">
                          <i class="menu-icon tf-icons ri-donut-chart-fill"></i>
                          <div data-i18n="Panel">Panel</div>
                        </a>
                      </li>
                      <!-- <li class="menu-item">
                        <a href="app-ecommerce-dashboard.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-shopping-cart-2-line"></i>
                          <div data-i18n="eCommerce">eCommerce</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="dashboards-crm.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-donut-chart-fill"></i>
                          <div data-i18n="CRM">CRM</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="index.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-bar-chart-line"></i>
                          <div data-i18n="Analytics">Analytics</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-logistics-dashboard.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-truck-line"></i>
                          <div data-i18n="Logistics">Logistics</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-academy-dashboard.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-book-open-line"></i>
                          <div data-i18n="Academy">Academy</div>
                        </a>
                      </li> -->
                    </ul>
                  </li>

                  <!-- Layouts -->
                  <li class="menu-item  {{ request()->is('clients*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <!-- <i class="menu-icon tf-icons ri-layout-2-line"></i> -->
                      <i class="ri-shield-user-line"></i>
                      <div data-i18n="Clients">Clients</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item {{ request()->is('clients*') ? 'active open' : '' }}">
                        <a href="{{ route('clients.index') }}" class="menu-link">
                          <i class="menu-icon tf-icons ri-account-circle-line"></i>
                          <div data-i18n="List">List</div>
                        </a>
                      </li>
                      <!-- <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon tf-icons ri-layout-left-line"></i>
                          <div data-i18n="Vertical">Vertical</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-fluid.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-layout-top-line"></i>
                          <div data-i18n="Fluid">Fluid</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-container.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-layout-top-2-line"></i>
                          <div data-i18n="Container">Container</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-blank.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-square-line"></i>
                          <div data-i18n="Blank">Blank</div>
                        </a>
                      </li> -->
                    </ul>
                  </li>

                  <!-- Apps -->
                  <li class="menu-item {{ request()->is('calendar*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ri-calendar-line"></i>
                      <div data-i18n="Calendar">Calendar</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="{{ route('calendar.index') }}" class="menu-link">
                          <i class="menu-icon tf-icons ri-calendar-line"></i>
                          <div data-i18n="Calendar">My Calendar</div>
                        </a>
                      </li>

                      <!-- <li class="menu-item">
                        <a href="app-email.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-mail-line"></i>
                          <div data-i18n="Email">Email</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-chat.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-message-line"></i>
                          <div data-i18n="Chat">Chat</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-drag-drop-line"></i>
                          <div data-i18n="Kanban">Kanban</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-shopping-cart-2-line"></i>
                          <div data-i18n="eCommerce">eCommerce</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-ecommerce-dashboard.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Products">Products</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-product-list.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Product List">Product List</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-product-add.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Add Product">Add Product</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-category-list.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Category List">Category List</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Order">Order</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-order-list.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Order List">Order List</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-order-details.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Order Details">Order Details</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Customer">Customer</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-customer-all.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="All Customers">All Customers</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Customer Details">Customer Details</div>
                                </a>
                                <ul class="menu-sub">
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                      <i class="menu-icon tf-icons ri-circle-fill"></i>
                                      <div data-i18n="Overview">Overview</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                      <i class="menu-icon tf-icons ri-circle-fill"></i>
                                      <div data-i18n="Security">Security</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                      <i class="menu-icon tf-icons ri-circle-fill"></i>
                                      <div data-i18n="Address & Billing">Address & Billing</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
                                      <i class="menu-icon tf-icons ri-circle-fill"></i>
                                      <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Manage Reviews">Manage Reviews</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-ecommerce-referral.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Referrals">Referrals</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Settings">Settings</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Store Details">Store Details</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Payments">Payments</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Checkout">Checkout</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Shipping & Delivery">Shipping & Delivery</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Locations">Locations</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Notifications">Notifications</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-book-open-line"></i>
                          <div data-i18n="Academy">Academy</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-academy-dashboard.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-academy-course.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="My Course">My Course</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-academy-course-details.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Course Details">Course Details</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-truck-line"></i>
                          <div data-i18n="Logistics">Logistics</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-logistics-dashboard.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-logistics-fleet.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Fleet">Fleet</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item active">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-article-line"></i>
                          <div data-i18n="Invoice">Invoice</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item active">
                            <a href="app-invoice-list.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-preview.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Preview">Preview</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-edit.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Edit">Edit</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-add.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Add">Add</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-user-line"></i>
                          <div data-i18n="Users">Users</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-user-list.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="View">View</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-user-view-account.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Account">Account</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-security.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Security">Security</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-billing.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Billing & Plans">Billing & Plans</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-notifications.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Notifications">Notifications</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-connections.html" class="menu-link">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Connections">Connections</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-shield-user-line"></i>
                          <div data-i18n="Roles & Permissions">Roles & Permission</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-access-roles.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Roles">Roles</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-access-permission.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Permission">Permission</div>
                            </a>
                          </li>
                        </ul>
                      </li> -->
                    </ul>
                  </li>

                  <!-- Pages -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons ri-settings-2-line"></i>
                      <div data-i18n="Settings">Settings</div>
                    </a>
                    <ul class="menu-sub">
                      <!-- <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-checkbox-multiple-blank-line"></i>
                          <div data-i18n="Front Pages">Front Pages</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Landing">Landing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Pricing">Pricing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Payment">Payment</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Checkout">Checkout</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Help Center">Help Center</div>
                            </a>
                          </li>
                        </ul>
                      </li> -->

                      <!-- <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-account-circle-line"></i>
                          <div data-i18n="User Profile">Users</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          
                        </ul>
                      </li> -->
                      <li class="menu-item {{ request()->is('company') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <!-- <i class="menu-icon tf-icons ri-settings-2-line"></i> -->
                          <i class="menu-icon ri-building-2-line"></i>
                          <div data-i18n="Company's">Company's</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-ite {{ request()->is('company') ? 'active ' : '' }}">
                            <a href="{{ route('company.index') }}" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          

                          <!-- <li class="menu-item">
                            <a href="pages-account-settings-security.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Security">Security</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-billing.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Billing & Plans">Billing & Plans</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-notifications.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Notifications">Notifications</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-connections.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Connections">Connections</div>
                            </a>
                          </li> -->
                        </ul>
                      </li>
                      <!-- <li class="menu-item">
                        <a href="pages-faq.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-question-line"></i>
                          <div data-i18n="FAQ">FAQ</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="pages-pricing.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-money-dollar-circle-line"></i>
                          <div data-i18n="Pricing">Pricing</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-file-line"></i>
                          <div data-i18n="Misc">Misc</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="pages-misc-error.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Error">Error</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-under-maintenance.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Under Maintenance">Under Maintenance</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-comingsoon.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Coming Soon">Coming Soon</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-not-authorized.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Not Authorized">Not Authorized</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-server-error.html" class="menu-link" target="_blank">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Server Error">Server Error</div>
                            </a>
                          </li>
                        </ul>
                      </li>

                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-lock-line"></i>
                          <div data-i18n="Authentications">Authentications</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Login">Login</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-login-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-login-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Register">Register</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-register-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-register-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-register-multisteps.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Multi-steps">Multi-steps</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Verify Email">Verify Email</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-verify-email-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-verify-email-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Reset Password">Reset Password</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-reset-password-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-reset-password-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Forgot Password">Forgot Password</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-forgot-password-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Two Steps">Two Steps</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-two-steps-basic.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-two-steps-cover.html" class="menu-link" target="_blank">
                                  <i class="menu-icon tf-icons ri-circle-fill"></i>
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon tf-icons ri-git-commit-line"></i>
                          <div data-i18n="Wizard Examples">Wizard Examples</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="wizard-ex-checkout.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Checkout">Checkout</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="wizard-ex-property-listing.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Property Listing">Property Listing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="wizard-ex-create-deal.html" class="menu-link">
                              <i class="menu-icon tf-icons ri-circle-fill"></i>
                              <div data-i18n="Create Deal">Create Deal</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="modal-examples.html" class="menu-link">
                          <i class="menu-icon tf-icons ri-tv-2-line"></i>
                          <div data-i18n="Modal Examples">Modal Examples</div>
                        </a>
                      </li> -->
                    </ul>
                  </li>

                  
                </ul>
              </div>
            </aside>