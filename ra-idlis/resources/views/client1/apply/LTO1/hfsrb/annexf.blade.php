@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

	<body>
		@include('client1.cmp.__wizard')
		
		<div class="container pb-3 border">
			@if($canAdd)
				<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
			@endif
			<div class="container table-responsive">
				<table class="table table-hover border" width="400" id="tApp">
		      		<thead style="background-color: #428bca; color: white">
		      			<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Rad No.</th>
							<th>Rad Onco</th>
							<th>FPCR*</th>
							<th>DPBR*</th>
							<th>DOH Cert</th>
							<th>FP CCP*</th>
							<th>Trained*</th>
							<th>FPROS*</th>
							<th>RXT*</th>
							<th>RRT*</th>
							<th>RSO*</th>
							<th>Others*</th>
							<th>PRC License No.</th>
							<th>Validity*</th>
							<th>Options</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexf as $personnel)
							<tr>
								<td>{{$personnel->name}}</td>
								<td>{{$personnel->position}}</td>
								<td>{!!($personnel->rad == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->radonco == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpcr == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->dpbr == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->dohcert == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpccp == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->trained == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpros == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rxt == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rrt == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rso == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{{$personnel->others}}</td>
								<td>{{$personnel->prcno}}</td>
								<td>{{$personnel->validity}}</td>
								@if($canAdd)
									<td>
										<center>&nbsp;
											<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete('{{$personnel->id}}')"><i class="fa fa-trash"></i></button>
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
	                    <h5 class="modal-title" id="viewModalLabel">Add Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="personnelAdd">
	                   		{{csrf_field()}}
							<div class="container pl-5">
								<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Name:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="name" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Position/Designation:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="pos" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Department.:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<div class="row">
		                   					<div class="col-6">
		                   						<input id="rado" type="radio" class="form-control-input w-100" name="department" value="rad" required="">
		                   						<label for="rado">Radiology/X-ray</label>
		                   					</div>
		                   					<div class="col-6">
		                   						<input id="onco" type="radio" class="form-control-input w-100" name="department" value="radonco" required="">
		                   						<label for="onco">Radiation Oncology</label>
		                   					</div>
		                   				</div>
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				FPCR*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="fpcr">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				DPBR*
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="dpbr">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				DOH Cert:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="dohcert">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				FP CCP*:
		                   			</div>
		                   			<input value="1" type="checkbox" class="form-control w-100" name="fpccp">
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Trained*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="trained">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				FPROS*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="fpros">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				RXT*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="rxt">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				RRT*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="rrt">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				RSO*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input value="1" type="checkbox" class="form-control w-100" name="rso">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Others*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="others" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				PRC License No.:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="prcno" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Validity*:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="date" class="form-control w-100" name="validity" required="">
		                   			</div>
		                   		</div>
		                   		<input type="hidden" name="action" value="add">
		                   			<button class="btn btn-primary pt-1" type="submit" id="getpersonnel">Submit</button>
							</div>
	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="remthis modal fade" id="editPersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Edit Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyEdit">
	                   	<form id="personnelEdit">	

	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="remthis modal fade" id="deletePersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Edit Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyDelete">
	                   	
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="container table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<td rowspan="2"><span class="font-weight-bold">Legend:</span></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Rad. – Radiology/X-ray Department
						</td>
						<td>
							FPCCP – Fellow of the Philippine College of Chest Physicians
						</td>
					</tr>
					<tr>
						<td>
							Rad. Onco – Radiation Oncology Department
						</td>
						<td>
							FPROS – Fellow of the Philippine Radiation Oncology Society
						</td>
					</tr>
					<tr>
						<td>
							FPCR - Fellow of the Philippine College of Radiology
						</td>
						<td>
							RXT – Registered X-ray Technologist
						</td>
					</tr>
					<tr>
						<td>
							DPBR – Diplomate of the Philippine Board of Radiology	
						</td>
						<td>
							RRT – Registered Radiologic Technologist
						</td>
					</tr>
					<tr>
						<td>
							DOH Cert – Department of Health Certified	
						</td>
						<td>
							
						</td>
					</tr>
				</tbody>
			</table>
		</div>



		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script type="text/javascript">
			"use strict";
			var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
			document.getElementById('stepDetails').innerHTML = 'Step 3.b: HFSRB Requirement';
			if(___wizardcount != null || ___wizardcount != undefined) {
				for(let i = 0; i < ___wizardcount.length; i++) {
					if(i < 2) {
						___wizardcount[i].parentNode.classList.add('past');
					}
					if(i == 2) {
						___wizardcount[i].parentNode.classList.add('active');
					}
				}
			}
			if(___div != null || ___div != undefined) {
				___div.classList.remove('active');	___div.classList.add('text-primary');
			}
		</script>
		@include('client1.cmp.footer')
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
			@if($canAdd)
			function showData(id,sname,fname,mname,prof,prcno,speciality,dob,sex,employement){
				// console.log(id,sname,fname,mname,prof,prcno,speciality,dob,sex,employement);
				$("#personnelEdit").empty().append(
					'<div class="container pl-5">'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Name:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   			'{{csrf_field()}}'+
		                   			'<input type="hidden" class="form-control" value="'+id+'" w-100" name="id" required="">'+
		                   				'<input class="form-control" value="'+sname+'" w-100" name="sur_name" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Position/Designation:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+fname+'" name="fname" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Rad No.:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+mname+'" name="mname" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Rad Onco:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+prof+'" name="prof" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'FPCR*:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+prcno+'" name="prcno" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'DPBR*'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+speciality+'" name="speciality" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'DOH Cert:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input type="date" class="form-control w-100" value="'+dob+'" name="dob" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'FP CCP*:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<select name="sex" value="'+sex+'" id="sex" class="form-control">'+
		                   					'<option value="M">Male</option>'+
		                   					'<option value="F">Female</option>'+
		                   				'</select>'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Trained*:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<select name="employement" value="'+employement+'" id="employement" class="form-control">'+
		                   					'<option value="PT">Part Time</option>'+
		                   					'<option value="FT">Full Time</option>'+
		                   				'</select>'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<input type="hidden" name="action" value="edit">'+
		                   			'<button class="btn btn-primary pt-1" type="submit" +id="getpersonnel">Save</button>'+
							'</div>'
					);
			}

			function showDelete(id,name){
				$("#viewBodyDelete").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to delete this entry <span class="text-danger">'+
					'</span>?<br>'+
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
							alert('Successfully Deleted Personnel');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})


			$(document).on('submit','#personnelAdd',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				console.log(data);
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added new Personnel');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			$(document).on('submit','#personnelEdit',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Edited Personnel');
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
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif