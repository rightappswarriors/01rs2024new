@if (session()->exists('uData'))  
	@include('client1.cmp.msg')
	<style>
		fieldset 
		{
			border: 1px solid #ddd !important;
			margin: 0;
			xmin-width: 0;
			padding: 10px;       
			position: relative;
			border-radius:4px;
			background-color:#f5f5f5;
			padding-left:10px!important;
		}	
		
		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}

		@media (min-width: 576px) {
			.modal-dialog { max-width: none; }
		}

		.modal-dialog {
			width: 98%;
			height: 92%;
			padding: 0;
		}

		.modal-body {
			max-height: calc(100vh - 200px);
			overflow-y: auto;
		}

		.modal-content {
			height: auto;
		}

		.select2-container--default .select2-selection--single {
			height: 40px !important;
			padding: 10px 16px;
			font-size: 18px;
			line-height: 1.33;
			border-radius: 6px;
		}
		.select2-container--default .select2-selection--single .select2-selection__arrow b {
			top: 85% !important;
		}
		.select2-container--default .select2-selection--single .select2-selection__rendered {
			line-height: 20px !important;
		}
		.select2-container--default .select2-selection--single {
			border: 1px solid #CCC !important;
			box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
		}
	</style>
	<style>
		@media print{
			
			footer, nav, button, #navBarWiz, div.dfn-hover, span.text-danger{
				display: none!important;
			}
			div.alert-warning{
				font-size: 10px;
			}
		}

		dfn {
			cursor: help;
			font-style: normal;
			position: relative;
		
		}
		dfn::after {
		    content: attr(data-info);
			white-space: pre-line;
			display: inline;
			position: absolute;
			top: 22px;
			left: 0;
			opacity: 0;
			width: 800px;
			font-size: 13px;
			font-weight: 700;
			line-height: 1.5em;
			padding: 0.5em 0.8em;
			background: rgba(0,0,0,0.8);
			color: #fff;
			pointer-events: none;
			transition: opacity 250ms, top 250ms;
		}
		dfn::before {
			content: '';
			display: block;
			position: absolute;
			top: 12px; left: 10px;
			opacity: 0;
			width: 0; height: 0;
			border: solid transparent 5px;
			border-bottom-color: rgba(0,0,0,0.8);
			transition: opacity 250ms, top 250ms;
		}
		dfn:hover {z-index: 2;} /* Keeps the info boxes on top of other elements */
		dfn:hover::after,
		dfn:hover::before {opacity: 1;}
		dfn:hover::after {top: 40px;}
		dfn:hover::before {top: 30px;}
	</style>
		<div class="container-fluid mt-5">
			<!-- div class="row">
				<div class="col-md-6 d-flex justify-content-start" id="prevDiv">
					<a href="#" class="inactiveSlider slider">&laquo; Previous</a>
				</div>
				<div class="col-md-6 d-flex justify-content-end" id="nextDiv">
					<a href="#" class="activeSlider slider">Next &raquo;</a>
				</div>
			</div --->
		</div>
		<div class="container text-center font-weight-bold mt-5">List of Personnel Annex A</div>
		<div class="container-fluid table-responsive pb-3">
			@if($canAdd)
				<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal" data-backdrop="static" data-keyboard="false" onclick="$('#viewModal').on('shown.bs.modal', function () {addFunc()});">Add</button>
			@endif
				<div class="col-md-1 pt-1 dfn-hover" style="font-size: 30px; display: inline-block;">
				<dfn data-info="For Radiology Personnel Requirements
				
				(Please input the qualification for the following)
				- Head of the facility
				- Chief Radiologic Technologist
				- Radiation Protection officer">
				<i class="fa fa-question-circle" aria-hidden="true"></i></dfn>
				</div>
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
		      				<th>Prefix</th>
							<th>Surname</th>
							<th>First Name</th>
							<th>Middle Name</th>
							<th>Suffix</th>
							<th>Profession</th>
							<th>PRC Reg. Number</th>
							<th>Validity Period Until</th>
							{{-- <th>Speciality</th> --}}
							<th>Date of Birth</th>
							<th>Sex</th>
							<!-- <th>Email</th> -->
							<th>Employment</th>
							<th>Position/<br/>Designation</th>
							{{-- <th>Qualification</th> --}}
							{{-- <th>Area</th> --}}
							<th>Work Status</th>
							{{-- <th>TIN</th> --}}
							<th>Status</th>
							<th>Options</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexa[0] as $personnel)
		      				@php 
		      					$_txtColor = 'text-black';
		      					$_trColor = 'white';
		      					$_stat = array('Active');
								if($personnel->validityPeriodTo != '') {
									if(strtotime($personnel->validityPeriodTo) <= strtotime('now')){
										$_trColor = 'danger';
										$_txtColor = 'text-white';
										array_push($_stat, 'PRC License Expired');
									} else if(strtotime($personnel->validityPeriodTo) <= strtotime('+1 month')){
										$_trColor = 'warning';
										array_push($_stat, 'PRC License Almost Expired');
									}
								} else {
									array_push($_stat, 'PRC License Not applicable');
								}
		      					
		      					if($personnel->status == 0){
		      						unset($_stat[0]);
		      						array_push($_stat, 'Resigned');
		      					}
		      				@endphp
							<tr class="bg-{{$_trColor}} {{$_txtColor}}">
								<td>{{ucfirst($personnel->prefix)}}</td>
								<td>{{ucfirst($personnel->surname)}}</td>
								<td>{{ucfirst($personnel->firstname)}}</td>
								<td>{{ucfirst($personnel->middlename)}}</td>
								<td>{{ucfirst($personnel->suffix)}}</td>
								<td>{{ucfirst($personnel->posname)}} </td>
								<td>{{$personnel->prcno}}</td>
								{{-- <td>{{$personnel->validityPeriodFrom}}</td> --}}
								<td>{{$personnel->validityPeriodTo}}</td>
								{{-- <td>{{$personnel->speciality}}</td> --}}
								<td>{{$personnel->dob}}</td>
								<td>{{$personnel->sex}}</td>
								<!-- <td>{{$personnel->email}}</td> -->
								<td>{{$personnel->pworksname}}</td>
								<td>{{$personnel->pos}}</td>
								{{-- <td>{{$personnel->qual}}</td> --}}
								{{-- <td>{{$personnel->designation}}</td> --}}
								{{-- <td>{{$personnel->area}}</td> --}}
								<td>{{$personnel->pworksname}}</td>
								{{-- <td>{{$personnel->tin}}</td> --}}
								<td class="font-weight-bold">{{implode(',',$_stat)}}</td>
								@if($canAdd)
								<td>
									<div class="container">
										<div class="row">
									
											<div class="col-md-6">
												<button class="btn border-dark btn-warning" title="edit" onclick="showData(
													'{{$personnel->id}}',
												'{{$personnel->prefix}}',
												'{{$personnel->surname}}',
												'{{$personnel->firstname}}',
												'{{$personnel->middlename}}',
												'{{$personnel->suffix}}',
												'{{$personnel->prof}}',
												'{{$personnel->prcno}}',
												'{{$personnel->validityPeriodTo}}',
												'{{$personnel->dob}}',
												'{{$personnel->sex}}',
												'{{$personnel->employement}}',
												'{{$personnel->pos}}'
												/*,'{{$personnel->area}}'*/,
												'{{$personnel->qual}}',
												'{{$personnel->email}}',
												/*'{{$personnel->tin}}',*/ 
												'{{$personnel->isMainRadio}}',
												 '{{$personnel->ismainpo}}',
												  '{{$personnel->isMainRadioPharma}}',
												  '{{$personnel->isXrayTech}}',
												  '{{$personnel->isChiefRadTech}}',
												  '{{$personnel->profession}}'
												  
												  )
												  
												  ">
													<i class="fa fa-edit"></i>
												</button>
											</div>
											@if($personnel->status == 1)
											<div class="col-md-6">
												<button class="btn border-primary btn-danger" data-toggle="modal" data-target="#deletePersonnel" title="Change Status to Resigned" onclick="showDelete('{{$personnel->id}}','{{$personnel->surname.' '.$personnel->firstname.' '.$personnel->middlename}}',1)"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
											</div>
											@else
											<div class="col-md-6">
												<button class="btn border-dark btn-primary" data-toggle="modal" data-target="#deletePersonnel" title="Change Status to Active" onclick="showDelete('{{$personnel->id}}','{{$personnel->surname.' '.$personnel->firstname.' '.$personnel->middlename}}',2)"><i class="fa fa-handshake-o" aria-hidden="true"></i></button>
											</div>
											@endif
										</div>
									</div>
								</td>
								@else 
								<td class="font-weight-bold">NOT AVAILABLE</td>
								@endif
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
		</div>
		<div class="remthis modal fade" id="viewModal" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="actionModalCRUD">Add Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>

	                <form id="personnelAdd" method="POST" enctype="multipart/form-data">
	                <div class="modal-body" id="viewBody">
	               		<input type="hidden" name="action" id="toChange" value="add">
	               		<input type="hidden" name="id" id="idToAdd">
	               		{{csrf_field()}}
						<fieldset>
							<legend>Employee Personal Details:</legend>
							<div class="row mb-2">
								<div class="col-md-3">
									<div class="col-sm">
										Prefix:
									</div>
									<div class="col-sm-11">
										{{-- <input class="form-control w-100" name="prefix"> --}}
										<select name="prefix" class="form-control">
											<option value="" selected>None</option>
											<option value="Mr">Mr</option>
											<option value="Mrs">Mrs</option>
											<option value="Ms">Ms</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-sm required">
										First Name:
									</div>
									<div class="col-sm-11">
										<input class="form-control w-100" name="fname" required="">
									</div>
								</div>
								<div class="col-md-3">
									<div class="col-sm">
										Middle Name:
									</div>
									<div class="col-sm-11">
										<input class="form-control w-100" name="mname">
									</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-md-6">
									<div class="col-sm required">
										Surname:
									</div>
									<div class="col-sm-11">
										<input class="form-control w-100" name="sur_name" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-sm">
										Suffix:
									</div>
									<div class="col-sm-11">
										<select name="suffix" class="form-control">
											<option value="" selected>None</option>
											<option value="Jr">Jr</option>
											<option value="II">II</option>
											<option value="III">III</option>
											<option value="IV">IV</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Date of Birth:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="date" class="form-control w-100" name="dob" required="">
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Sex:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<select name="sex" id="sex" class="form-control">
		                   					<option value="M">Male</option>
		                   					<option value="F">Female</option>
		                   				</select>
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Email:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="email" class="form-control w-100" name="email" required="">
		                   			</div>
								</div>
							</div>
						 </fieldset>
						 <fieldset class="mt-5">
							<legend>Employment Details:</legend>
							<div class="row mb-2">
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Position/Designation:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="position" required="">
		                   			</div>
									<div class="col-sm-11">
		                   				<span style="font-style:Italic; font-size: smaller">E.g. Licensing Officer II, Rad Tech III, etc.</span>
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Profession:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<div class="row">
		                   					<div class="col-md-10">
		                   						<!-- <select onchange="setAssignment(this.value)" name="prof"  class="form-control" required=""> -->
		                   						<select onchange="getAss(this.value)"  name="prof" id="prof" class="form-control" required="">
				                   					<option value="">Please Select</option>
													@php $fda_type = ""; $newgroup=1; @endphp
				                   					@foreach($pos as $p)

														@if($fda_type != $p->fda_type)
															@php $fda_type = $p->fda_type; $newgroup=0; @endphp

													   <optgroup label="@if($p->fda_type == 'cdrr')  Pharmacy Group @elseif($p->fda_type == 'cdrrhr')  Radiology Group @else Others @endif">
														@endif
				                   						<option value="{{$p->posid}}" isRequired="{{$p->groupRequired}}">{{$p->posname}}</option>
														
														@if($newgroup == 1)
															</optgroup>
															@php $newgroup=0; @endphp
														@endif
				                   					@endforeach
				                   				</select>
		                   					</div>		                   	

											<div id="mainassignment">
												<div id="assignment">
											
												</div>
											
											</div>	                   					
											 
		                   				</div>
													
										@foreach($professions as $profession)
											<div class="col-md pos-{{$profession->position_id}} profession-option" hidden>
												<input type="checkbox" value="{{$profession->id}}" name="profession[]" id="{{$profession->id}}" > Make as {{$profession->description}}
											</div>
										@endforeach
		                   				
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm">
	                   					Specialization:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="qual">
		                   			</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-md-4">
									<div class="col-sm prc-reg">
	                   					PRC Reg. Number:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100 canBeNot prc-reg-input" name="prcno" id="prcno" >
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm prc-reg">
	                   					Validity Period Until:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100 canBeNot prc-reg-input" type="date" name="vto" id="vto" >
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Work Status:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<select name="employement" id="employement" class="form-control">
		                   					<option value="">Please Select</option>
		                   					@foreach($workstat as $work)
		                   						<option value="{{$work->pworksid}}">{{$work->pworksname}}</option>
		                   					@endforeach
		                   				</select>
		                   			</div>
								</div>
							</div>
							<div class="row mb-2">
								
							</div>
						 </fieldset>

						 <fieldset class="mt-5" id="forUpload" hidden>
							<legend>Uploading of Credentials: <span class="text-danger" id="forCred"></span></legend>
							<div class="row mb-2 first" hidden>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					PRC:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" type="file" name="req[prc]">
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Board Certificate:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" type="file" name="req[bc]">
		                   			</div>
								</div>
								<div class="col-md-4">
									<div class="col-sm required">
	                   					Contract of Employment:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" type="file" name="req[coe]">
		                   			</div>
								</div>
							</div>
							<div class="row mb-2 second" hidden>
								<div class="col-md-6">
									<div class="col-sm required">
	                   					PRC:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" type="file" name="req[prc1]">
		                   			</div>
								</div>
								<div class="col-md-6">
									<div class="col-sm required">
	                   					Certificate of Training:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" type="file" name="req[cert]">
		                   			</div>
								</div>
							</div>
						</fieldset>

	                </div>
	                <div class="modal-footer">
	                	<button type="submit" class="btn btn-primary">Submit</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</form>

	            </div>
	        </div>
	    </div>

	    <div class="remthis modal fade" id="editPersonnel" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
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
	    <div class="remthis modal fade" id="deletePersonnel" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="actionModal">Edit Personnel</h5>
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
		function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
  		}
			function setAssignment(value){
				console.log()
				document.getElementById("assignment").remove()

				var x = document.createElement("div");
                x.setAttribute("id",'assignment');
                document.createElement("mainassignment").appendChild(x);
				
				chceb('head', ' Make as Head of Radiology');
				chceb('po', ' Make as Radiation protection officer');
				chceb('pharmahead', ' Make as Chief Pharmacist');

				
			}
			function getAss(value){

				console.log("value")
				console.log(value)

				jQuery('.profession-option').attr('hidden', '');
				jQuery('.pos-'+value).removeAttr('hidden');		

				jQuery('.prc-reg').attr('required', '');
				jQuery('.prc-reg').removeAttr('required');	

				var prcno = document.getElementById("prcno");
                prcno.required = true;	

				var vto = document.getElementById("vto");
                vto.required = true;	
			}
			function chceb(name, desc){
				var ass = document.getElementById("assignment");
			
				var x = document.createElement("div");
                x.setAttribute("id",'is'+name);
                x.setAttribute("class", "col-md");
                ass.appendChild(x);

				var ids = name+"inpt";
				var x = document.createElement("input");
                x.setAttribute("type", "checkbox");
                x.setAttribute("id", ids);
                x.setAttribute("name", name);
				x.setAttribute("class", "custom-control-input");
                document.getElementById("is"+name).appendChild(x);
				

                var label = document.createElement("Label");
                label.setAttribute("for", ids);
                label.setAttribute("class", "custom-control-label");
                label.innerHTML = desc;

                var newInput = document.getElementById(ids)
                insertAfter(newInput, label);
			}
			// $(function(){
			// 	toReq();
			// })
			let rad = Array('12','13');
			let par = Array('6','3');
			let fieldOnUp = $("#forUpload");
			let inputs;
			let fieldsForInput = Array('id','prefix','sur_name','fname','mname','suffix','prof','prcno','vto','dob','sex','employement','position'/*,'assignment'*/,'qual','email'/*,'tin'*/,null, null, null);

			$("#prof").change(function(event) {
				let isRequiredForSend = $("#prof option:selected").attr('isRequired');
				let canBeRequired = $(".canBeNot");
				switch (true) {

					case (isRequiredForSend == 1):
						canBeRequired.attr('required',true).addClass('required');
						if(canBeRequired.parent().prev().find('span').length <= 0){
							$( canBeRequired.parent().prev() ).append( '<span class="text-danger" style="font-size: 20px;">*</span>');
						}

					break;

					case (isRequiredForSend == 0):
						canBeRequired.removeAttr('required').removeClass('required').parent().prev().find('span').remove();
					break;

					// case (jQuery.inArray($(this).val(), rad) != -1):
					// 	fieldOnUp.removeAttr('hidden');
					// 	$(".first").removeAttr('hidden');
					// 	inputs = $(".first").find('input[type=file]');
					// 	if(inputs.length > 0){
					// 		inputs.each(function(index, el) {
					// 			$(this).attr('required',true).removeAttr('hidden');
					// 		});
					// 	}
					// 	$(".second").attr('hidden',true);
					// 	inputs = $(".second").find('input[type=file]');
					// 	if(inputs.length > 0){
					// 		inputs.each(function(index, el) {
					// 			$(this).removeAttr('required').attr('hidden',true).val('');
					// 		});
					// 	}
					// 	break;
					// case (jQuery.inArray($(this).val(), par) != -1):
					// 	fieldOnUp.removeAttr('hidden');
					// 	$(".second").removeAttr('hidden');
					// 	inputs = $(".second").find('input[type=file]');
					// 	if(inputs.length > 0){
					// 		inputs.each(function(index, el) {
					// 			$(this).attr('required',true).removeAttr('hidden');
					// 		});
					// 	}
					// 	$(".first").attr('hidden',true);
					// 	inputs = $(".first").find('input[type=file]');
					// 	if(inputs.length > 0){
					// 		inputs.each(function(index, el) {
					// 			$(this).removeAttr('required').attr('hidden',true).val('');
					// 		});
					// 	}
					// 	break;
					default:
						fieldOnUp.attr('hidden',true);
						$(".first .second").attr('hidden',true);
						inputs = fieldOnUp.find('input[type=file]');
						if(inputs.length > 0){
							inputs.each(function(index, el) {
								$(this).removeAttr('required').attr('hidden',true).val('');
							});
						}
						break;
				}
			});

			"use strict";

		</script>
		{{-- @include('client1.cmp.footer')  --}}

		{{-- start of from footer --}}	

		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

		{{-- end of from footer --}}

		<script>
            onStep(3);
            slider([],['hfsrb','annexb',{{$appid}}]);
        </script>
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
			$('[name=prefix],[name=suffix]').select2({ width: '100%', tags: true });
			@if($canAdd)
			function addFunc(){
				$("#actionModalCRUD").empty().html('Add Personnel');
				$("#toChange").val('add');
				$("#idToAdd").val("");
				$("#forCred").empty();
				for(let j = 0; fieldsForInput.length > j; j++){
					if($('input[name='+fieldsForInput[j]+']').length > 0){
				    	$('input[name='+fieldsForInput[j]+']').val("").trigger('change');
				    } else {
				    	$('select[name='+fieldsForInput[j]+']').val("").trigger('change');
				    }
				}
				// $("input[type=file]:hidden").each(function(index, el) {
				// 	$(this).parent().prev().append('<span class="text-danger" style="font-size: 20px;">*</span>');
				// 	$(this).attr('required',true);
				// });
			}
			function showData(id,pre,sur,first,mid,suf,prof,prcno,valid,dob,sex,emp,pos/*,des,area*/,qual,email/*,tin*/, head = null, po = null, pharmahead = null, isXrayTech = null, isChiefRadTech = null, profession){

				// console.log(profession);
				$("#viewModal").modal('toggle');
				$("#viewModal").on('shown.bs.modal', function(){
					otherFunction(id,pre,sur,first,mid,suf,prof,prcno,valid,dob,sex,emp,pos/*,des,area*/,qual,email/*,tin*/, head, po, pharmahead, isXrayTech, isChiefRadTech,profession);
				});
			}

			// function toReq(){
			// 	$(".required").each(function(index, el) {
			// 		$(el).append('<span class="text-danger" style="font-size: 20px;">*</span>');
			// 	});
			// }

			function otherFunction(id,pre,sur,first,mid,suf,prof,prcno,valid,dob,sex,emp,pos/*,des,area*/,qual,email/*,tin*/,head, po, pharmahead, isXrayTech, isChiefRadTech,profession){
				
				if(profession){
					profession = JSON.parse(profession);
					jQuery.each(profession,function(i, v){
						$('#'+v).prop('checked',true);
					});
				}
				
				//console.log(profession);
				$("#actionModalCRUD").empty().html('Edit Personnel');
				$("#toChange").val('edit');
				$("#idToAdd").val(id);
				$("#forCred").empty().append('(You may resubmit or if not, details of credentials will be retained)');
				//console.log(arguments)
				// if(arguments.length == fieldsForInput.length){
					// if(head != ""){
					// 	$('[name=head]').show();
					// 	$('[name=head]').attr('value',1);
					// 	$('[name=head]').prop('checked',true);
					// }
					// if(po != ""){
					// 	$('[name=po]').show();
					// 	$('[name=po]').attr('value',1);
					// 	$('[name=po]').prop('checked',true);
					// }
					// if(pharmahead != ""){
					// 	$('[name=pharmahead]').show();
					// 	$('[name=pharmahead]').attr('value',1);
					// 	$('[name=pharmahead]').prop('checked',true);
					// }
				//console.log("head")
				//console.log(isXrayTech)
				//console.log(isChiefRadTech)
					if(head == 1){
						
						$('[name=head1]').attr('value',1);
						$('[name=head1]').prop('checked',true);
					}
					if(isXrayTech == "1"){
						
						$('[name=xtech]').attr('value',1);
						$('[name=xtech]').prop('checked',true);
					}
					
					if(isChiefRadTech == "1"){
						
						$('[name=chiefrt]').attr('value',1);
						$('[name=chiefrt]').prop('checked',true);
					}
					if(po != ""){
						
						$('[name=po1]').attr('value',1);
						$('[name=po1]').prop('checked',true);
					}
					//console.log("pharmahead")
					//console.log(pharmahead)
					if(pharmahead == 1){
						
						$('[name=pharmahead1]').attr('value',1);
						$('[name=pharmahead1]').prop('checked',true);
					}
					for(var arg = 0; arg < arguments.length; ++ arg)
					{
					    var arr = arguments[arg];
					    if($('input[name='+fieldsForInput[arg]+']').length > 0){
					    	$('input[name='+fieldsForInput[arg]+']').val(arr).trigger('change');
					    } else {
					    	$('select[name='+fieldsForInput[arg]+']').val(arr).trigger('change');
					    }
					}
					$("input[type=file]:visible").each(function(index, el) {
						// $(this).parent().prev().find('span').remove()
						$(this).removeAttr('required');
					});
				// } else {
				// 	alert('Arguments are missing! Please contact Admin');
				// }
			}
			function showDelete(id,name,action){
				let sel;
				switch (action) {
					case 1:
					$("#actionModal").empty().html('Change status of Employee to Resign');
						sel = '<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to Set status of <span class="text-danger">'+
					name +
					' to Resigned?</span>?<br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>';
						break;
					case 2:
					$("#actionModal").empty().html('Change status of Employee to Active');
						sel = '<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to Re-active <span class="text-primary">'+
					name +
					'</span>?<br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>';
						break;
				}
				$("#viewBodyDelete").empty().append(
					sel
				);
			}
			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val()},
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Changed Status of Personnel');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			$(document).on('submit','#personnelAdd',function(event){
				event.preventDefault();
				let data = new FormData(this);
				$.ajax({
					type: 'POST',
					data:data,
					contentType: false,
					processData: false,
					success: function(a){
						if(a == 'DONE'){
							alert('Operation Successul');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			$(document).on('submit','#personnelEdit',function(event){
				event.preventDefault();
				let data = new FormData(this);
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

			let forHead = [12,3,17,8,6];
			let dom = [['po'],['po','head'],['po'],['pharmahead'],['po']];
			$("#prof").change(function(event) {
				if($.inArray(Number($(this).val()), forHead) >= 0){
					for (var j=0;  j < dom[$.inArray(Number($(this).val()), forHead)].length;  j++) {
						$('[name='+dom[$.inArray(Number($(this).val()), forHead)][j]+']').parent().toggle('display');
						$('[name='+dom[$.inArray(Number($(this).val()), forHead)][j]+']').attr('value',1);
					}
				} else {
					dom.forEach(function(el,key){
						for (var i=0; i < el.length; i++) {
							if($('[name='+el[i]+']').length){
								$('[name='+el[i]+']').parent().hide();
								$('[name='+el[i]+']').removeAttr('value');
								$('[name='+el[i]+']').prop('checked',false);
							}
						}
					})
				}
			});
			$(document).ready(function(){
				$('[name=head], [name=po], [name=pharmahead]').change(function(event) {
					if(!$(this).is(':checked')){
						$(this).removeAttr('value');
					} else {
						$(this).attr('value',1);
					}
				});
			})

		@endif
		</script>
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />