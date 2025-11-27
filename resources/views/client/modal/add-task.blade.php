<div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-simple modal-refer-and-earn">
    <div class="modal-content p-5">
    	<div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Add Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
	    <div class="modal-body p-0 mt-3">
	        <div class="row">
	        	<div class="table-responsive text-nowrap">
	        		<form name="frmnewTask" id="frmnewTask">
	        			<input type="hidden" name="idx" id="idx" value="0">
	        			<input type="hidden" name="client_id" id="client_id" value="0">
			          <!-- Preset -->
			          <div class="mb-3">
			            <label for="preset_id" class="form-label">Preset</label>
			            <select class="form-select" id="preset_id" name="preset_id">
			              <option selected disabled>- Select from list -</option>
			            	@foreach($presets as $preset)
				              	<option value="{{$preset->id}}">{{$preset->name}}</option>
			              	@endforeach
			            </select>
			          </div>

			          <!-- Description -->
			          <div class="mb-3">
			            <label for="description" class="form-label">Description</label>
			            <!-- <input type="text" class="form-control" name="description" id="description" placeholder="Enter task description"> -->

			            <div id="descriptionEditor"></div>
						<input type="hidden" name="description" id="descriptionInput">
			          </div>

			          <!-- Due Date -->
			          <div class="mb-3">
			            <label for="dueDate" class="form-label">Due Date</label>
			            <input type="date" class="form-control" id="dueDate" name="dueDate" min="{{ now()->format('Y-m-d') }}">
			          </div>

			          <!-- Steps -->
			          <!-- <div class="mb-3">
			            <label class="form-label">Steps</label>
			            <div class="form-check">
			              <input class="form-check-input" name="setp1[]" type="checkbox" checked id="step1">
			              <label class="form-check-label" for="step1">Engagement letter</label>
			            </div>
			            <div class="form-check">
			              <input class="form-check-input" name="setp2[]" type="checkbox" checked id="step2">
			              <label class="form-check-label" for="step2">Prepare Invoice and secure payment</label>
			            </div>
			            <div class="form-check">
			              <input class="form-check-input" name="setp3[]" type="checkbox" checked id="step3">
			              <label class="form-check-label" for="step3">Secure Power of Attorney - Form 2848</label>
			            </div>
			          </div> -->
			        </form>
	        		
	        	</div>
	        </div>
    	</div>
    	<div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
	          Close
	        </button>
	        <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSaveTask">Save</button>
	    </div>
	</div>
</div>
</div>

<div class="modal fade" id="editTaskModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-simple modal-refer-and-earn">
    <div class="modal-content p-5">
    	<div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Update Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
	    <div class="modal-body p-0 mt-3">
	        <div class="row">
	        	<div class="table-responsive text-nowrap">
	        		<form name="frmUpdateTask" id="frmUpdateTask">
	        			<input type="hidden" name="idx" id="idx" value="0">
	        			<input type="hidden" name="client_id" id="client_id" value="0">
			          <!-- Preset -->
			          <div class="mb-3">
			            <label for="preset_id" class="form-label">Preset</label>
			            <select class="form-select" id="preset_id" name="preset_id">
			              <option selected disabled>- Select from list -</option>
			            	@foreach($presets as $preset)
				              	<option value="{{$preset->id}}">{{$preset->name}}</option>
			              	@endforeach
			            </select>
			          </div>

			          <!-- Description -->
			          <div class="mb-3">
			            <label for="description" class="form-label">Description</label>
			            <!-- <input type="text" class="form-control" name="description" id="description" placeholder="Enter task description"> -->

			            <div id="descriptionEditor2"></div>
						<input type="hidden" name="description" id="descriptionInput2">
			          </div>

			          <!-- Due Date -->
			          <div class="mb-3">
			            <label for="dueDate" class="form-label">Due Date</label>
			            <input type="date" class="form-control" id="dueDate" name="dueDate" min="{{ now()->format('Y-m-d') }}">
			          </div>

			          	<div class="col-6">
	                      <div class="form-check">
	                        <input class="form-check-input" type="checkbox" value="" id="mark_done" checked="">
	                        <label class="form-check-label" for="mark_done">
	                          Mark Done
	                        </label>
	                      </div>
	                    </div>

	                    <div class="col-6">
	                      <div class="form-check">
	                        <input class="form-check-input" type="checkbox" value="" id="send_to_client" checked="">
	                        <label class="form-check-label" for="send_to_client">
	                          Send to Client
	                        </label>
	                      </div>
	                    </div>

	                    <div class="col-md-12 mb-6">
                          <div class="form-floating form-floating-outline">
                            <div class="select2-success">
                            <label for="select2Success">Mentions</label>
                              <select id="select2Success" class="select2 form-select form-sm" multiple>
                                <option value="1" selected>Option1</option>
                                <option value="2" selected>Option2</option>
                                <option value="3">Option3</option>
                                <option value="4">Option4</option>
                              </select>
                            </div>
                          </div>
                        </div>


			          
			        </form>
	        		
	        	</div>
	        </div>
    	</div>
    	<div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
	          Close
	        </button>
	        <button type="button" class="btn btn-primary waves-effect waves-light" id="btnUpdateTask">Update</button>
	    </div>
	</div>
</div>
</div>