@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.requirementsSlider')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

	<body>
		@include('client1.cmp.__wizard')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6 d-flex justify-content-start" id="prevDiv">
					<a href="#" class="inactiveSlider slider">&laquo; Previous</a>
				</div>
				<div class="col-md-6 d-flex justify-content-end" id="nextDiv">
					<a href="#" class="activeSlider slider">Next &raquo;</a>
				</div>
			</div>
		</div>
		<div class="container text-center font-weight-bold mt-5">List of X-Ray machines</div>
		<div style="padding: 2%;" >
		@if(!$canAdd)
			<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
		@endif
		<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr style="font-size: 15px">
							<th>Type of X-ray Machine</th>
							<th>Manufacturer Control Console</th>
							<th>Manufacturer Tube housing</th>
							<th>Model Control Console</th>
							<th>Model Tube Head</th>
							<th>Serial Control Console</th>
							<th>Serial Tube Housing</th>
							<th>X-ray Machine Max.mA</th>
							<th>X-ray Machine Max.kVp</th>
							{{-- <th>Linear Accelerator Photons,MV</th> --}}
							{{-- <th>Linear Accelerator Electrons,MeV</th> --}}
							<th>Location</th>
							<th>Application</th>
							<th>Option</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrxraylist as $xraylist)
							<tr>
								<td>{{$xraylist->xraydesc}}</td>
								<td>{{$xraylist->brandtubeconsole}}</td>
								<td>{{$xraylist->brandtubehead}}</td>
								<td>{{$xraylist->modeltubeconsole}}</td>
								<td>{{$xraylist->modeltubehead}}</td>
								<td>{{$xraylist->serialconsole}}</td>
								<td>{{$xraylist->serialtubehead}}</td>
								<td>{{$xraylist->maxma}}</td>
								<td>{{$xraylist->maxkvp}}</td>
								{{-- <td>{{$xraylist->photonmv}}</td> --}}
								{{-- <td>{{$xraylist->electronsmev}}</td> --}}
								<td>{{$xraylist->location}}</td>
								<td>{{$xraylist->appuse}}</td>
								<td>
									@if(!$canAdd)
									<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete({{$xraylist->id}})"><i class="fa fa-trash"></i></button>
									@else
									NOT AVAIALBE
									@endif
								</td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
		</div>
		<div class="container pb-3 table-responsive">
			
			<div class="container">
				
			</div>
		</div>
		@if(!$canAdd)
		<div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Add X-Ray List</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="xraylist_add">
	                   		{{csrf_field()}}
							<div class="container pl-5">
								<div class="row mb-2">
									<input type="hidden" name="action" value="add">
		                   			<div class="col-sm required">
		                   				Type of X-ray machine:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<select name="xray" class="form-control" required>
			                   				@foreach($dropdowns[1] as $mach)
											   @if($mach->xrayid != 15)
			                   					<option value="{{$mach->xrayid}}">{{$mach->xraydesc}}</option>
											   @endif
			                   				@endforeach
		                   				</select>
		                   			</div>
		                   		</div>
								   <div class="row mb-2">
		                   			<div class="col-sm">
									   Manufacturer Control Console:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="brandCC">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Manufacturer Tube Housing:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="brandTH">
		                   			</div>
		                   		</div>
		                   		
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Model Tube Housing:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="modelTH">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Model Control Console:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="modelCC">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				Serial Tube Housing:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="serialTH" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				Serial Control Console:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="serialCC" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				X-ray Machine Max.mA:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" min="0" class="form-control w-100" name="ma" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				X-ray Machine Max.kVp
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" class="form-control w-100" name="kvp" required="">
		                   			</div>
		                   		</div>
		                   		{{-- <div class="row mb-2">
		                   			<div class="col-sm">
		                   				Linear Accelerator Photons,MV:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" class="form-control w-100" name="lmv" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Linear Accelerator Electrons,MeV:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" class="form-control w-100" name="lmev" required="">
		                   			</div>
		                   		</div> --}}
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				Location:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="location" required="">
		                   				{{-- <select name="location" class="form-control" required="">
			                   				@foreach($dropdowns[0] as $loc)
			                   					<option value="{{$loc->locid}}">{{$loc->locdesc}}</option>
			                   				@endforeach
		                   				</select> --}}
		                   			</div>
		                   		</div>
								   <div class="row mb-2">
		                   			<div class="col-sm required">
		                   			Application Use
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="appuse"  required="">
		                   			</div>
		                   		</div>
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
	                    <h5 class="modal-title" id="viewModalLabel">Delete Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyDelete">
	                   	
	                </div>
	            </div>
	        </div>
	    </div>
	    @endif



		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script type="text/javascript">
			"use strict";
			// var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
			// document.getElementById('stepDetails').innerHTML = 'Step 3.b: FDA Requirement';
			// if(___wizardcount != null || ___wizardcount != undefined) {
			// 	for(let i = 0; i < ___wizardcount.length; i++) {
			// 		if(i < 2) {
			// 			___wizardcount[i].parentNode.classList.add('past');
			// 		}
			// 		if(i == 2) {
			// 			___wizardcount[i].parentNode.classList.add('active');
			// 		}
			// 	}
			// }
			// if(___div != null || ___div != undefined) {
			// 	___div.classList.remove('active');	___div.classList.add('text-primary');
			// }
		</script>
		@include('client1.cmp.footer')
		<script>
			onStep(3);
			slider(['fda','CDRRHR/xrayservcat',{{$appid}}],['fda','CDRRHR/attachments',{{$appid}}]);
			// slider(['fda','CDRRHR/xrayservcat',{{$appid}}],['app','LTO',{{$appid}},'fda','Proceed To Submission of FDA Requirements']);
		</script>
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
			@if(!$canAdd)
			function showData(id,name,pos,faciassign,qualification,prcno,validity,filename){
				$("#personnelEdit").empty().append(
					'<div class="container pl-5">'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   			'	Full Name:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   			'{{csrf_field()}}'+
                   				'<input value='+name+' class="form-control w-100" name="edit_name" required="">'+
                   				'<input type="hidden" class="form-control w-100" name="action" value="edit">'+
                   				'<input type="hidden" class="form-control w-100" name="id" value='+id+'>'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Designation/Position:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input value='+pos+' class="form-control w-100" name="edit_position" required="">'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Facility Assignment:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input value='+faciassign+' class="form-control w-100" name="edit_faciassign" required="">'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Qualification:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   			'	<input value='+qualification+' type="qualification" class="form-control w-100" name="edit_qualification" +required="">'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'PRC License Number:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input value='+prcno+' class="form-control w-100" name="edit_prcno" required="">'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Validity Period:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input type="date" value='+validity+' class="form-control w-100" name="edit_validity" required="">'+
                   			'</div>'+
                   		'</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Cetificate Attachment:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input type="file" name="edit_attachment" class="form-control w-100">'+
                   				'<input type="hidden" name="oldFilename" class="form-control w-100" value="'+filename+'">'+
                   			'</div>'+
                   		'</div>'+
           			'<button class="btn btn-primary pt-1" type="submit">Save</button>'+
					'</div>'
					);
			}

			function showDelete(id){
				$("#viewBodyDelete").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to delete this entry?<br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>&nbsp;'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>'
					);
			}

			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val(),filename:$("#filename").val()},
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Deleted X-Ray Machine');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})


			$(document).on('submit','#xraylist_add',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added X-Ray List');
							location.reload();
						} else {
							console.log(a);						}
					}
				})
			})
			$(document).on('submit','#personnelEdit',function(event){
				event.preventDefault();
				let data = new FormData(this);
				data.append('action','edit');
				$.ajax({
					type: 'POST',
					data:data,
					cache: false,
			        contentType: false,
			        processData: false,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Edited Personnel');
							location.reload();
						} else if(a == 'invalidFile') {
							alert('File Invalid! Please upload valid PDF file');
						}
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />