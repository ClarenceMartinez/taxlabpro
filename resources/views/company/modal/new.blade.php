<div class="offcanvas offcanvas-end w-25" id="add-company">
            <div class="offcanvas-header border-bottom">
              <h5 class="offcanvas-title" id="exampleModalLabel">New Company</h5>
              <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
              <form class="add-company pt-0 row g-3" method="post" name="form-add-company" id="form-add-company" onsubmit="return false">

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="name"
                      name="name"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="name">Name</label>
                  </div>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <select id="state"
                      name="state"
                      class="form-select"
                      aria-label="Default select example">
                        <option value="0">Seleccione</option>
                      
                      @foreach($states_list as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                      @endforeach
                    </select>
                    <label for="state">State</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="city"
                      name="city"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="city">City</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="address_1"
                      name="address_1"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="address_1">Address</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="address_2"
                      name="address_2"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="address_2">Address 2</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="office_phone"
                      name="office_phone"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="office_phone">Office Phone</label>
                  </div>
                </div>

                <div class="col-12 col-md-12">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="office_cell"
                      name="office_cell"
                      class="form-control"
                      value=""
                      placeholder="" />
                    <label for="office_cell">Office Cell</label>
                  </div>
                </div>
                
                <div class="col-sm-12">
                  <button type="submit" id="btn-save" data-form="form-add-company" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                  <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
              </form>
              </div>
            </div>
          </div>