@if (session()->exists('employee_login'))	
	@extends('mainEmployee')
	@section('title', 'Default Payment Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="PY006">
	<div class="content p-4">
		<datalist>
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Default Payment <span class="PY006_add"><a href="#" title="Add New Default Payment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
			</div>
			<div class="card-body table-responsive">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto">Order of Payment</th>
							<th style="width: auto" class="text-center">Charge Code</th>
							<th style="width: auto;" class="text-center">Type of Facility</th>
							<th style="width: auto" class="text-center">Type</th>
							{{-- <th style="width: auto" class="text-center">Amount</th> --}}
							<th style="width: auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody id="TheBody">
						{{-- @if (isset($default))
							@foreach ($default as $d)
							<tr>
								 <td scope="row" style="cursor: pointer;" data-toggle="tooltip" title="{{$d->oop_desc}}">{{$d->oop_id}}</td>
								 <td scope="row" class="text-center" style="cursor: pointer;" data-toggle="tooltip" title="{{$d->chg_desc}}">{{$d->chg_code}}</td>
								 <td scope="row" class="text-center"> {{$d->hgpdesc}}</td>
								 <td scope="row" class="text-center"> {{$d->aptdesc}}</td>
								 <td scope="row"> 
									<center>
										<button class="btn btn-outline-primary" title="Show additional Information" data-toggle="modal" data-target="#GodModal"><i class="fa fa-eye" aria-hidden="true"></i></button>
										<button class="btn btn-outline-danger" title="Remove Default Payment"><i class="fa fa-trash" aria-hidden="true"></i></button>
									</center>
								 </td>	
							</tr>
							@endforeach
						@endif --}}
					</tbody>
					{{-- <tfoot>
						<tr>
							<th style="width: auto">Order of Payment</th>
							<th style="width: auto" class="text-center">Charge Code</th>
							<th style="width: auto;" class="text-center">Type of Facility</th>
							<th style="width: auto" class="text-center">Type</th>
							<th style="width: auto"><center>Options</center></th>
						</tr>
					</tfoot> --}}
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body text-justify" style=" background-color: #272b30;
				color: white;">
					<h5 class="modal-title text-center"><strong>Add New Default Payment</strong></h5>
					<hr>
					<div class="container">
						<form id="addRgn" class="row"  data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> 
							<div class="col-sm-4">Order of Payment:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select  id="new_oop"  data-parsley-required-message="*<strong>Order of Payment</strong> required"  class="form-control"  required>
									@isset ($OOP)
										<option value="">Select Order of Payment</option>
									    @foreach ($OOP as $e)
									    	<option value="{{$e->oop_id}}">{{$e->oop_desc}}</option>
									    @endforeach
									@else
										<option value="">No Order of Payment Available</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Application:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="new_app" class="form-control"  data-parsley-required-message="*<strong>Application</strong> required" required>
									@isset ($app)
										<option value="">Select Application</option>
										@foreach ($app as $o)
											<option value="{{$o->hfser_id}}">{{$o->hfser_desc}}</option>
										@endforeach
									@else
										<option value="">No Application Available</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Facility:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select  id="new_facility" class="form-control"  data-parsley-required-message="*<strong>Facility</strong> required" required>
									@isset ($facilitys)
										<option value="">Select Facility</option>
										@foreach ($facilitys as $f)
											<option value="{{$f->hgpid}}">{{$f->hgpdesc}}</option>
										@endforeach
									@else
										<option value="">No Facility Available</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Type:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="new_type" class="form-control"  data-parsley-required-message="*<strong>Type</strong> required" required>
									@isset ($aptype)
										<option value="">Select Type</option>
										@foreach ($aptype as $f)
											<option value="{{$f->aptid}}">{{$f->aptdesc}}</option>
										@endforeach
									@else
										<option value="">No Type Available</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Charge:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="SelectedCharge" class="form-control" data-parsley-required-message="*<strong>Charge Code</strong> required" onchange="getChargeCode();" required>
									@isset ($payment)
									    <option value="">Select Charge</option>
									    @foreach ($payment as $p)
									    	<option value="{{$p->chgapp_id}}" id="chg_code_{{$p->chgapp_id}}" code="{{$p->chg_code}}">{{$p->chg_desc}}</option>
									    @endforeach
									@else
										<option value="">No Charge Available</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Charge Code:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="SelectedChargeCode" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled required>
							</div>
							<div class="col-sm-12">
								<button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog {{-- modal-lg --}}" role="document">
	      <div class="modal-content" style="border-radius: 0px;border: none;">
	        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	          <h5 class="modal-title text-center"><strong>View Default Payment Information</strong></h5>
	          <hr>
	          <div class="container">
	                <form id="ViewNow" data-parsley-validate>
	                <span id="ViewBody">
	                </span>
	                <hr>
	                <div class="row">
	                  <div class="col-sm-6">
	                  {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
	                  </div> 
	                <div class="col-sm-6">
	                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
	                </div>
	                </div>
	              </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	<div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content" style="border-radius: 0px;border: none;">
	        <div class="modal-body text-left" style=" background-color: #272b30;
	      color: white;">
	          <h5 class="modal-title text-center"><strong><span id="ifActiveTitle">Remove Default Payment</span></strong></h5>
	          <hr>
	          <div class="container">
	            <form  id="RemoveDefaultPayment" class="row" data-parsley-validate>
	              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DeleteErrorAlert" role="alert">
	                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
	                    <span class="PY006_cancel">
	                    	<button type="button" class="close" onclick="$('#DeleteErrorAlert').hide(1000);" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    	</button>
	                    </span>
	                </div>
	              <div class="col-sm-12" id="Error">
	                <p>Are you sure you want to delete <span style="font-weight: bold;color:red" id="selectedFacility"></span> from <span style="font-weight: bold;color:red" id="selectedTypeX"></span>? </p>
	                <input type="text" id="ToBeRemovedFacility" hidden="" value="">
	              </div>
	              <div class="col-sm-12">
	                <hr>
	                <div class="row">
	                  <div class="col-sm-6">
	                    <button type="submit" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Remove</button>
	                  </div>
	                  <div class="col-sm-6">
	                    <button type="button" data-dismiss="modal" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
	                  </div>
	                </div>
	              </div> 
	            </form>
	         </div>
	        </div>
	      </div>
	    </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			getDataToView();
	    	$('#example').DataTable();
	    	$('[data-toggle="tooltip"]').tooltip();
	    	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
		});
		function getDataToView()
		{
			$.ajax({
				url: '{{ asset('employee/dashboard/mf/defaultpayment/get') }}',
				method: 'GET',
				data: {_token:$('#token').val()},
				success: function(data){
					if (data != null) 
					{
						$('#example').DataTable().clear().draw();
						if (data.length != 0) {
							for (var i = 0; i < data.length; i++) {
								$('#example').DataTable().row.add([
									'<span style="cursor: pointer;" data-toggle="tooltip" title="'+data[i].oop_desc+'"><center>'+data[i].oop_id+'</center></span>',
									'<span style="cursor: pointer;" data-toggle="tooltip" title="'+data[i].chg_desc+'"><center>'+data[i].chg_code+'</center></span>',
									'<center>'+data[i].hgpdesc+'</center>',
									'<center>'+data[i].aptdesc+'</center>',
									'<center>' +
										'<button class="btn btn-outline-primary" title="Show additional Information" data-toggle="modal" data-target="#GodModal" onclick="ShowAdditionalDetails(\''+data[i].oop_id+'\', \''+data[i].oop_desc+'\', \''+data[i].chg_code+'\', \''+data[i].chg_desc+'\', \''+data[i].hfser_id+'\', \''+data[i].hgpdesc+'\', \''+data[i].aptdesc+'\');"><i class="fa fa-eye" aria-hidden="true"></i></button>&nbsp;' +
										'<button class="btn btn-outline-danger" data-toggle="modal" data-target="#IfActiveModal" title="Remove Default Payment" onclick="ShowDelete(\''+data[i].id+'\', \''+data[i].oop_desc+'\', \''+data[i].chg_code+'\', \''+data[i].chg_desc+'\', \''+data[i].hgpdesc+'\')"><i class="fa fa-trash" aria-hidden="true"></i></button>' +
									'</center>'
								]).draw();
							}
						}
					}
					else{
						$('#example').DataTable().clear().draw();
					} 
				},
				error: function(a,b,c){
					console.log(c);
					$('#ERROR_MSG2').show(100);
				},
			});
		}
		function getChargeCode()
		{
			var chrg_id = $('#SelectedCharge').val();
			if (chrg_id != '') {
				var chrg_code = $('#chg_code_'+chrg_id).attr('code');
				$('#SelectedChargeCode').val(chrg_code);
			}
		}
		$('#addRgn').on('submit',function(e)
			{e.preventDefault();
			var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	        	$.ajax({
	        		method: 'POST',
	        		data: {
	        				_token:$('#token').val(), 
	        				oop:$('#new_oop').val(),
	        				hfser_id:$('#new_app').val(),
	        				facid:$('#new_facility').val(),
	        				aptid:$('#new_type').val(),
	        				chg_app:$('#SelectedCharge').val()  
	        			},
	        		success: function(data){
	        			if (data == 'DONE'){
	        				alert('Successfully added new default payment');
	        				location.reload();
	        			}
	        			else if (data == 'ERROR') {
	        				$('#AddErrorAlert').show(100);
	        			}
	        		},
	        		error: function(a, b, c) {
	        			console.log(c);
	        			$('#AddErrorAlert').show(100);
	        		}
	        	});
	        }
		});
		function ShowAdditionalDetails(oopid, oopdesc, chgcode, chgdesc, hfser_id, hgpdesc, aptdesc)
		{
			$('#ViewBody').empty();
			$('#ViewBody').append(
					'<div class="row">'+
						'<div class="col-sm-4">Order of Payment Code:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+oopid+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Order of Payment Description:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+oopdesc+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Application:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+hfser_id+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Facility:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+hgpdesc+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Application Type:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+aptdesc+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Charge Code:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+chgcode+'" disabled></div>' +
					'</div>' +
					'<div class="row">'+
						'<div class="col-sm-4">Charge Name:</div>' +
						'<div class="col-sm-8" style="margin:0 0 .8em 0;"><input class="form-control" value="'+chgdesc+'" disabled></div>' +
					'</div>' 
				);
		}
		function ShowDelete(id, oop_desc, chg_code, chg_desc, facility)
		{
			$('#selectedFacility').text('');
			$('#selectedFacility').text(chg_code+' ('+chg_desc+')');

			$('#selectedTypeX').text('');
			$('#selectedTypeX').text(facility + "'s "+ oop_desc);

			$('#ToBeRemovedFacility').val(id);
		}
		$('#RemoveDefaultPayment').on('submit', function(event){
			event.preventDefault();
			$.ajax({
				url: '{{ asset('employee/mf/defaultpayment/del') }}',
				method: 'GET',
				data: {_token:$('#token').val(), id : $('#ToBeRemovedFacility').val()},
				success: function(data){
					if (data !='ERROR') {
						alert('Successfully deleted a default payment.');
						location.reload();
					} else if(data == 'ERROR') {
						$('#DeleteErrorAlert').show(100);
					}
				},
				error: function(a,b,c){
					console.log(c);
					$('#DeleteErrorAlert').show(100);
				},
			});
		});
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif