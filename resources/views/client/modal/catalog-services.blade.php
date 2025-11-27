<div class="modal fade" id="catalog-service" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-simple modal-refer-and-earn">
    <div class="modal-content p-5">
    	<div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Services Offered</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
	    <div class="modal-body p-0 mt-3">
	        <div class="row">
	        	<div class="table-responsive text-nowrap">
	        		<form method="post" id="frmServicesClient" name="frmServicesClient">
	        			<input type="hidden" name="client_service_id" id="client_service_id" value="0">
			        	<table class="table table-hover">
			        		<thead>
			        			<tr>
			        				<th>#</th>
			        				<th>Services</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			@foreach($company_services as $service)
			        			<tr>
			        				<td><input type="checkbox" class="form-check-input service-list"  name="service_id[]" id="service_id" value="{{$service->id}}"></td>
			        				<td>{{$service->service_name}}</td>
			        			</tr>
			        			@endforeach
			        		</tbody>
			        	</table>
	        		</form>
	        		
	        	</div>
	        </div>
    	</div>
    	<div class="modal-footer">
	        <button type="button" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">
	          Close
	        </button>
	        <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSaveServiceClient">Save</button>
	    </div>
	</div>
</div>
</div>