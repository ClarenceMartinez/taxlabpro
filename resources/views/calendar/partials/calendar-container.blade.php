<div class="card app-calendar-wrapper">
                <div class="row g-0">
                  <!-- Calendar Sidebar -->
                  <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                    <div class="p-5 my-sm-0 mb-4 border-bottom">
                      <button
                        class="btn btn-primary btn-toggle-sidebar w-100"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#addEventSidebar"
                        aria-controls="addEventSidebar">
                        <i class="ri-add-line ri-16px me-1_5"></i>
                        <span class="align-middle">Add Event</span>
                      </button>
                    </div>
                    <div class="px-4">
                      <!-- inline calendar (flatpicker) -->
                      <div class="inline-calendar"></div>

                      <hr class="mb-5 mx-n4 mt-3" />
                      <!-- Filter -->
                      <div class="mb-4 ms-1">
                        <h5>Event Filters</h5>
                      </div>

                      <div class="form-check form-check-secondary mb-5 ms-3">
                        <input
                          class="form-check-input select-all"
                          type="checkbox"
                          id="selectAll"
                          data-value="all"
                          checked />
                        <label class="form-check-label" for="selectAll">View All</label>
                      </div>

                      <div class="app-calendar-events-filter text-heading">
                        <div class="form-check form-check-info ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-personal"
                            data-value="notes"
                            checked />
                          <label class="form-check-label" for="select-personal">Notes</label>
                        </div>
                        <div class="form-check form-check-success mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-business"
                            data-value="activity"
                            checked />
                          <label class="form-check-label" for="select-business">Activity</label>
                        </div>
                        


                        <!-- <div class="form-check form-check-warning mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-family"
                            data-value="family"
                            checked />
                          <label class="form-check-label" for="select-family">Family</label>
                        </div>
                        <div class="form-check form-check-success mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-holiday"
                            data-value="holiday"
                            checked />
                          <label class="form-check-label" for="select-holiday">Holiday</label>
                        </div>
                        <div class="form-check form-check-info ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-etc"
                            data-value="etc"
                            checked />
                          <label class="form-check-label" for="select-etc">ETC</label>
                        </div> -->

                      </div>
                    </div>
                  </div>
                  <!-- /Calendar Sidebar -->

                  <!-- Calendar & Modal -->
                  <div class="col app-calendar-content">
                    <div class="card shadow-none border-0">
                      <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                      </div>
                    </div>
                    <div class="app-overlay"></div>
                    <!-- FullCalendar Offcanvas -->
                    <div
                      class="offcanvas offcanvas-end event-sidebar"
                      tabindex="-1"
                      id="addEventSidebar"
                      aria-labelledby="addEventSidebarLabel">
                      <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                        <button
                          type="button"
                          class="btn-close text-reset"
                          data-bs-dismiss="offcanvas"
                          aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body">
                        <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                          <input type="hidden" name="idx" id="idx" value="0">
                          <div class="form-floating form-floating-outline mb-5">
                            <input
                              type="text"
                              class="form-control"
                              id="eventTitle"
                              name="eventTitle"
                              placeholder="Event Title" />
                            <label for="eventTitle">Title</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-5">
                            <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                              <option data-label="info" value="Notes">Notes</option>
                              <option data-label="success" value="Activity">Activity</option>
                              <!-- <option data-label="primary" value="Business" selected>Business</option>
                              <option data-label="danger" value="Personal">Personal</option>
                              <option data-label="warning" value="Family">Family</option> -->
                            </select>
                            <label for="eventLabel">Label</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-5">
                            <input
                              type="text"
                              class="form-control"
                              id="eventStartDate"
                              name="eventStartDate" 
                              min="<?= date('Y-m-d'); ?>"
                              placeholder="Start Date" />
                            <label for="eventStartDate">Start Date</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-5">
                            <input
                              type="text"
                              class="form-control"
                              id="eventEndDate"
                              name="eventEndDate"
                              placeholder="End Date" />
                            <label for="eventEndDate">End Date</label>
                          </div>
                          <div class="mb-5">
                            <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                              <label class="form-check-label" for="allDaySwitch">All Day</label>
                            </div>
                          </div>
                          <div class="form-floating form-floating-outline mb-5" style="display:none">
                            <input
                              type="url"
                              class="form-control"
                              id="eventURL"
                              name="eventURL"
                              placeholder="https://www.google.com" />
                            <label for="eventURL">Event URL</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-5 select2-primary">
                            <select
                              class="select2 select-event-guests form-select"
                              id="eventGuests"
                              name="eventGuests"
                              >
                              <option value="0" data-avatar="filter.png" >Seleccione</option>
                              @if(count($users))
                                @foreach($users as $user)
                                  <option data-avatar="{{$user->avatar}}.png" value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                              @endif
                            </select>
                            <label for="eventGuests">Add User</label>
                          </div>

                          <div class="form-floating form-floating-outline mb-5 select2-primary">
                            <select
                              class="select2 select-event-client form-select"
                              id="eventClient"
                              name="eventClient"
                              >
                              <option value="0" data-avatar="filter.png" >Seleccione</option>
                              <option value="1" data-avatar="11.png" >Juan</option>
                              <option value="2" data-avatar="11.png">Pedro</option>
                              <option value="3" data-avatar="11.png" >Luis</option>
                            </select>
                            <label for="eventClient">Add Client</label>
                          </div>

                          <div class="form-floating form-floating-outline mb-5" style="display:none">
                            <input
                              type="text"
                              class="form-control"
                              id="eventLocation"
                              name="eventLocation"
                              placeholder="Enter Location" />
                            <label for="eventLocation">Location</label>
                          </div>
                          <div class="form-floating form-floating-outline mb-5">
                            <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                            <label for="eventDescription">Description</label>
                          </div>
                          <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                            <div class="d-flex">
                              <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                                Add
                              </button>
                              <button
                                type="reset"
                                class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                                data-bs-dismiss="offcanvas">
                                Cancel
                              </button>
                            </div>
                            <button class="btn btn-outline-danger btn-delete-event d-none" style="display:none;">Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- /Calendar & Modal -->
                </div>
              </div>