@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

	<body>
		@include('client1.cmp.__wizard')
		
		<div class="container pb-3">
			@if($canAdd)
				<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
			@endif
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Brand Name</th>
							<th>Model</th>
							<th>Serial Number</th>
							<th>Quantity</th>
							<th>Date of Purchase</th>
							<th>Lab Materials</th>
							<th>Options</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexh as $Equipment)
							<tr>
								<td>{{$Equipment->brandname}}</td>
								<td>{{$Equipment->model}}</td>
								<td>{{$Equipment->serialno}}</td>
								<td>{{$Equipment->quantity}}</td>
								<td>{{$Equipment->dop}}</td>
								<td>{{$Equipment->labmaterials}}</td>
								@if($canAdd)
									<td>
										<center>
											<button class="btn btn-warning"  data-toggle="modal" data-target="#editEquipment" onclick="showData('{{$Equipment->id}}','{{$Equipment->brandname}}','{{$Equipment->model}}','{{$Equipment->serialno}}','{{$Equipment->quantity}}','{{$Equipment->dop}}','{{$Equipment->labmaterials}}')"><i class="fa fa-edit"></i></button>&nbsp;
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
		                   			<div class="col-sm">
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
		                   				<input class="form-control w-100" name="model" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Serial Number:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="serialno" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Quantity:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" class="form-control w-100" name="quantity" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Date of Purchase:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="date" class="form-control w-100" name="dop" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Lab Materials:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="labmaterials" required="">
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
			function showData(id,sname,fname,mname,prof,prcno,speciality,dop,sex,employement){
				// console.log(id,sname,fname,mname,prof,prcno,speciality,dop,sex,employement);
				$("#EquipmentEdit").empty().append(
					'<div class="container pl-5">'+
		            	'<div class="row mb-2">'+
		            		'{{csrf_field()}}'+
		            		'<input type="hidden" name="id" value="'+id+'">'+
		                   			'<div class="col-sm">'+
		                   				'Brand Name:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+sname+'" name="brandname" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Model:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+fname+'" name="model" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Serial Number:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input class="form-control w-100" value="'+mname+'" name="serialno" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Quantity:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input type="number" class="form-control w-100" value="'+prof+'" name="quantity" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Date of Purchase:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input type="date" class="form-control w-100" value="'+prcno+'" name="dop" required="">'+
		                   			'</div>'+
		                   		'</div>'+
		                   		'<div class="row mb-2">'+
		                   			'<div class="col-sm">'+
		                   				'Quantity:'+
		                   			'</div>'+
		                   			'<div class="col-sm-11">'+
		                   				'<input type="text" class="form-control w-100" value="'+speciality+'" name="labmaterials" required="">'+
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
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif