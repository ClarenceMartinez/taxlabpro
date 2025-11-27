                <div class="" id="navs-justified-activities">
                    <div class="row">
                      <div class="col-lg-12 mb-6">  
                        <form id="frm-add-activity" name="frm-add-activity" class="row g-5 fv-plugins-bootstrap5 fv-plugins-framework" onsubmit="return false" novalidate="novalidate">
                            <input type="hidden" name="client_id" id="client_id" value="0">
                          <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                              <select id="deal" name="deal" class="form-select" aria-label="Default select example">
                                <option value="Million" selected="">Million</option>
                                <option value="Deal">Deal</option>
                              </select>
                              <label for="deal">Deal</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="title" name="title" class="form-control" value="" placeholder="">
                              <label for="title">Activity title</label>
                            </div>
                          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                          <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                              <select id="type" name="type" class="form-select" aria-label="Default select example">
                                <option value="1" selected="">Email</option>
                              </select>
                              <label for="type">Activity Type</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                              <input type="text" id="notes" name="notes" class="form-control" value="" placeholder="">
                              <label for="notes">Add Notes</label>
                            </div>
                          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                          <div class="col-12 col-md-6 fv-plugins-icon-container">
                            <div class="form-floating form-floating-outline">
                              <input type="date" id="date" name="date" class="form-control" value="Queen" placeholder="Queen">
                              <label for="date">Date</label>
                            </div>
                          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                          <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                              <select id="user_id" name="user_id" class="form-select" aria-label="Default select example">
                                <option value="1" selected="">Javier R</option>
                              </select>
                              <label for="user_id">Assigned To</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                              <input type="time" class="form-control" name="time" id="time">
                              <label for="time">Time</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                              <select id="duration" name="duration" class="form-select" aria-label="Default select example">
                                <option value="15" selected="">15 min</option>
                                <option value="20">20 min</option>
                                <option value="30">30 min</option>
                                <option value="1">1 hour</option>
                                <option value="10">+1 hour</option>
                              </select>
                              <label for="duration">Duration</label>
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input" id="done" name="done" value="1">
                              <label for="done" class="text-heading">Mark as Done</label>
                            </div>
                          </div>
                          <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                            <button type="submit" data-form="frm-add-activity" class="btn-save btn btn-primary waves-effect waves-light">Save</button>
                            <!-- <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">
                              Cancel
                            </button> -->
                          </div>
                      </form>
                      </div>
                      <div class="col-lg-12 mt-6">
                        
                            <div class="card mb-6 border-none mt-2" style="height: 250px; overflow-x: auto;">
                              <!-- <h5 class="card-header">User Activity Timeline</h5> -->
                              <div class="card-body pt-0">
                                <ul class="timeline mb-0 vertical-example" id="activities-list"></ul>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>