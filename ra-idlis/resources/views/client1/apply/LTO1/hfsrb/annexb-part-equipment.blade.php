@if (session()->exists('uData'))  
	@php
		$toProceed = ((FunctionsClientController::hasRequirementsFor('cdrr',$appid) || FunctionsClientController::hasRequirementsFor('cdrrhr',$appid)) ? true : false);
	@endphp

	<div class="container text-center font-weight-bold mt-5">List of Equipment/Instrument Annex B</div>
	<div class="container pb-3">
		@if($canAdd)
			<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
		@endif
		<div class="container">
			<table class="table table-hover" id="tApp">
				<thead style="background-color: #428bca; color: white" id="theadapp">
					<tr>
						<th>Equipment</th>
						<th>Brand Name</th>
						<th>Model</th>
						<th>Serial (If Applicable)</th>
						<th>Manufacturing Date</th>
						<th>Date of Purchase</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody id="loadHere">
					@foreach($hfsrbannexb as $Equipment)
						<tr>
							<td>{{($Equipment->equipment ?? 'No Equipment Entered')}}</td>
							<td>{{($Equipment->brandname ?? 'No Brandname Entered')}}</td>
							<td>{{($Equipment->model ?? 'No Model Entered')}}</td>
							<td>{{($Equipment->serial ?? 'No Serial Entered')}}</td>
							<td>{{($Equipment->manDate ?? 'No Manufacturing Date Entered')}}</td>
							<td>{{($Equipment->dop ?? 'No Date of Purchase Entered')}}</td>
							@if($canAdd)
								<td>
									<center>
										<button class="btn btn-warning"  data-toggle="modal" data-target="#editEquipment" onclick="showData('{{$Equipment->id}}','{{$Equipment->equipment}}','{{$Equipment->brandname}}','{{$Equipment->model}}','{{$Equipment->serial}}','{{$Equipment->manDate}}','{{$Equipment->dop}}')"><i class="fa fa-edit"></i></button>&nbsp;
										<button class="btn btn-danger" data-toggle="modal" data-target="#deleteEquipment" onclick="showDelete('{{$Equipment->id}}')"><i class="fa fa-trash"></i></button>
									</center>
								</td>
							@else
							<td class="font-weight-bold">NOT AVAILABLE</td>
							@endif
						</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" id="viewHead">
					<h5 class="modal-title" id="viewModalLabel">Add Equipment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="viewBody">
					<form id="EquipmentAdd">
						{{csrf_field()}}
						<div class="container pl-5">
							<div class="row mb-2">
								<div class="col-sm required">
									Equipment:
								</div>
								<div class="col-sm-11">
									<input class="form-control w-100" name="equipment" required="">
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-sm required">
									Brand Name:
								</div>
								<div class="col-sm-11">
									<input class="form-control w-100" name="brandname" required="">
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-sm">
									Model:
								</div>
								<div class="col-sm-11">
									<input class="form-control w-100" name="model">
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-sm required">
									Serial:
								</div>
								<div class="col-sm-11">
									<input class="form-control w-100" required name="serial">
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-sm">
									Manufacturing Date:
								</div>
								<div class="col-sm-11">
									<input type="date" class="form-control w-100" name="manDate">
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-sm required">
									Date of Purchase:
								</div>
								<div class="col-sm-11">
									<!-- <input type="date" class="form-control w-100" name="dop" required=""> -->
									<input type="date" max="{{date('Y-m-d')}}" class="form-control w-100" name="dop" required="">
								</div>
							</div>
							<input type="hidden" name="action" value="add">
								<button class="btn btn-primary pt-1" type="submit" id="getEquipment">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="remthis modal fade" id="editEquipment" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" id="viewHead">
					<h5 class="modal-title" id="viewModalLabel">Edit Equipment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="viewBodyEdit">
					<form id="EquipmentEdit">	

					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="remthis modal fade" id="deleteEquipment" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" id="viewHead">
					<h5 class="modal-title" id="viewModalLabel">Delete Equipment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="viewBodyDelete">
					
				</div>
			</div>
		</div>
	</div>

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
	</script>
	<script>
		onStep(3);
		slider(['hfsrb','annexa',{{$appid}}],['app','LTO',{{$appid}},'hfsrb','Proceed To Submission of DOH Requirements']);
	</script>
	<script>
		$(function(){
			$("#tApp").dataTable();
		})
		
		@if($canAdd)

			function showData(id,sname,fname,mname,prof,prcno,speciality,dop,sex,employement){
				// console.log(id,sname,fname,mname,prof,prcno,speciality,dop,sex,employement);
				$("#EquipmentEdit").empty().append(
					'<div class="container pl-5">'+
						'<div class="row mb-2">'+
							'{{csrf_field()}}'+
							'<input type="hidden" name="id" value="'+id+'">'+
									'<div class="col-sm required">'+
										'Equipment:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input class="form-control w-100" value="'+sname+'" name="equipment" required="">'+
									'</div>'+
								'</div>'+
								'<div class="row mb-2">'+
									'<div class="col-sm required">'+
										'Brand Name:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input class="form-control w-100" value="'+fname+'" name="brandname" required="">'+
									'</div>'+
								'</div>'+
								'<div class="row mb-2">'+
									'<div class="col-sm">'+
										'Model:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input class="form-control w-100" value="'+mname+'" name="model">'+
									'</div>'+
								'</div>'+
								'<div class="row mb-2">'+
									'<div class="col-sm">'+
										'Serial:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input class="form-control w-100" value="'+prof+'" name="serial">'+
									'</div>'+
								'</div>'+
								'<div class="row mb-2">'+
									'<div class="col-sm required">'+
										'Manufacturing Date:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input type="date" class="form-control w-100" value="'+prcno+'" name="manDate" required="">'+
									'</div>'+
								'</div>'+
								'<div class="row mb-2">'+
									'<div class="col-sm required">'+
										'Date of Purchase:'+
									'</div>'+
									'<div class="col-sm-11">'+
										'<input type="date" max="{{date("Y-m-d")}}" class="form-control w-100" value="'+speciality+'" name="dop" required="">'+
									'</div>'+
								'</div>'+
								'<input type="hidden" name="action" value="edit">'+
									'<button class="btn btn-primary pt-1" type="submit" id="getEquipment">Submit</button>'+
					'</div>'
					);
			}

			function showDelete(id,name){
				$("#viewBodyDelete").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to delete this entry? <span class="text-danger">'+
					'</span><br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>'
					);
			}

			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val()},
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Deleted Equipment');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})

			$(document).on('submit','#EquipmentAdd',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added new Equipment');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			
			$(document).on('submit','#EquipmentEdit',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Edited Equipment');
							location.reload();
						} else {
							console.log(a);
						}
					},
					fail: function(a,b,c){
						console.log([a,b,c]);
					}
				})
			})

		@endif

		// $('[name=manDate],[name=dop]').on('change',function(){
		$('[name=manDate],[name=dop]').on('blur',function(){
			validateDateLessGreat($('[name=manDate]'),$('[name=dop]'));
		})
	</script>
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif