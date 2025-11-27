<div class="modal fade" id="modal-user-to-client" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-simple modal-refer-and-earn">
    <div class="modal-content p-5">
    	<div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Asign User to Client</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
	    <div class="modal-body p-0 mt-3">
	        <div class="row">
	        	<div class="table-responsive text-nowrap">
	        		<form action="" name="frmAsignClientToUser" id="frmAsignClientToUser" method="post">
	        			<input type="hidden" name="client_idxt" id="client_idxt" value="0">
			        	<table class="table table-hover">
			        		<thead>
			        			<tr>
			        				<th>#</th>
			        				<th>User</th>
			        			</tr>
			        		</thead>
			        		
							<tbody>
								@if(isset($users_all) && is_iterable($users_all))
									@foreach($users_all as $user)
									<tr>
										<td>
											<input type="checkbox" class="form-check-input user-list" name="user_idxt[]" id="user_idxt_{{$user->id}}" value="{{ isset($user->id) ? $user->id : '' }}">
										</td>
										<td>{{ isset($user->name) ? $user->name : '' }}</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="2">No users found.</td>
									</tr>
								@endif
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
	        <button type="button" class="btn btn-primary waves-effect waves-light" id="btnSaveUserToClient">Save</button>
	    </div>
	</div>
</div>
</div>