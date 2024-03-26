<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
@extends('mainEmployee')
@section('title', 'Surveillance Recommendation')
@section('content')
  	<div class="content p-4">
	  <datalist id="rgn_list">
		@if (isset($AllData))
			@foreach ($AllData as $key => $value)
			@if(trim($value->hfsrbno) != '')
			<option value="{{$value->hfsrbno}}"></option>
			@endif
			@endforeach
		@endif
		</datalist>

	    <div class="card">
			<div class="card-header bg-white font-weight-bold">
				@include('employee.cmp._survHead')
			</div>
	      
			  @php 
					$employeeData = session('employee_login');
				$grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
					@endphp
			@include('employee.tableDateSearch')
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto;">ID</th>
	        				<th scope="col" style="text-align: center; width:auto;">Facility <br>Status</th>
	        				<th scope="col" style="text-align: center; width:auto">NOV <br> No.</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of <br>Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Address</th>
	        				<th scope="col" style="text-align: center; width:auto">Facility <br>Code</th>
	        				<th scope="col" style="text-align: center; width:auto">Reported <br>Violation</th>
	        				<th scope="col" style="text-align: center; width:auto">Date of <br> Surveillance</th>
	        				<th scope="col" style="text-align: center; width:auto">Span of <br> Surveillance</th>
	        				<th scope="col" style="text-align: center; width:auto">Recommendation Status</th>
	        				<th scope="col" style="text-align: center; width:auto">Violation</th>
	        				{{-- <th scope="col" style="text-align: center; width:auto">Letter<br>of<br>Explanation</th> --}}
	        				{{-- <th scope="col" style="text-align: center; width:auto">Attachments</th> --}}
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				@foreach($AllData as $key => $value)
							@php 
								if($grpid != 'NA' && AjaxController::checkSurvTeam($value->team) == 'no'){
									continue;
								}
								@endphp
	        					<tr>
	        						<td style="text-align: center;">{{$value->survid}}</td>
	        						<td style="text-align: center;">{!!(isset($value->regfac_id) ? 'Licensed' : '<span class="font-weight-bold">Unlicensed</span>')!!}</td>
	        						<td style="text-align: center;">{{$value->hfsrbno}}</td>
	        						<td style="text-align: center;">{{$value->name_of_faci}}</td>
	        						<td style="text-align: center;">{{$value->address_of_faci}}</td>
	        						<td style="text-align: center;">{{$value->facname}}</td>
	        						<td style="text-align: center;" class="font-weight-bold">{{$value->violation}}</td>
	        						<td style="text-align:center">
					                    @if($value->date_surveillance != "") 
					                      	<b>{{\Carbon\Carbon::parse($value->date_surveillance)->format('M d, Y')}}</b> to
					                      	<b>{{\Carbon\Carbon::parse($value->date_surveillance_end)->format('M d, Y')}}</b>
					                    @endif
					                </td>
				                  	<td style="text-align:center">
					                    @if($value->date_surveillance != "") 
					                      {{-- {{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}} --}}
					                      	@php
						                        $date_start = new DateTime($value->date_surveillance);
						                        $date_end = new DateTime($value->date_surveillance_end);
						                        $interval = $date_start->diff($date_end);
						                        $interval->d = $interval->d;
					                      	@endphp
					                     	@if($interval->d > 1)
					                        	{{$interval->d}} days
					                      	@else
					                        	{{$interval->d}} day
					                     	 @endif
					                    @endif
				                  	</td>
				                  	<!-- <td class="font-weight-bold" style="text-align:center">{{isset($value->verdict) ? ucfirst($value->verdict) :  'No Recommendation Yet' }}</td> -->
				                  	<td class="font-weight-bold" style="text-align:center">
									  {{ $value->s_ver_others ?  $value->s_ver_others : $value->vdesc}}
									  <!-- {{isset($value->vdesc) ? $value->vdesc : (isset($value->s_ver_others) ? $value->s_ver_others : 'No Recommendation Yet') }}{{(isset($value->s_ver_others) ? $value->s_ver_others : ' ')}}</td> -->
				                  	<!-- <td class="font-weight-bold" style="text-align:center">{{isset($value->vdesc) ? $value->vdesc : (isset($value->s_ver_others) ? $value->s_ver_others : 'No Recommendation Yet') }}{{(isset($value->s_ver_others) ? $value->s_ver_others : ' ')}}</td> -->
				                  	<!-- <td class="font-weight-bold" style="text-align:center">{{isset($value->vdesc) ? $value->vdesc : (isset($value->s_ver_others) ? $value->s_ver_others : 'No Recommendation Yet') }}</td> -->
        							@if($value->hasViolation != "")
        								<td style="text-align:center">
        									<button type="btn" class="btn btn-danger" data-toggle="modal" data-target="#sMonModal" onclick=" $('#vDetails').empty().append('{{$value->violation}}'); ">
    											<i class="fa fa-fw fa-eye"></i>
    											Show Violation
    										</button>
        								</td>

        								{{-- <td style="text-align: center;">
        									@if($value->hfsrbno == "")
        										<span class="text-warning"><b>NOV not yet issued</b></span>
        									@elseif($value->hasLOE == "")
        										<span class="text-danger"><b>Not Received</b></span>
        									@else
        										<button type="btn" class="btn btn-info" data-toggle="modal" data-target="#lMonModal" onclick="showLOE('{{AjaxController::getLOEByNov($value->hfsrbno)->loehtml}}')">
        											<i class="fa fa-fw fa-eye"></i>
        											Show LOE
        										</button>
        									@endif
        								</td> --}}

        								{{-- attachments --}}
        								{{-- <td style="text-align: center">
        									@if($value->hfsrbno != "")
	        									@if(AjaxController::getAttachSurv($value->survid)->attached_files == "")
	        										<button class="btn btn-outline-info" title="Incude Attachments upon issuing" data-toggle="modal" data-target="#attMonModal" onclick="att('{{$value->survid}}')">
	        											<i class="fa fa-paperclip" aria-hidden="true"></i> Include Attachment
	        										</button>
	        									@elseif(AjaxController::getAttachSurv($value->survid)->attached_files != "")
	        										<button class="btn btn-outline-info" data-toggle="modal" data-target="#attMonModal" onclick="att1('{{$value->survid}}', '{{AjaxController::getAttachSurv($value->survid)->attached_files}}')">
	        											<i class="fa fa-paperclip" aria-hidden="true"></i> Edit Attached File
	        										</button>
	        									@endif
	        								@endif
        								</td> --}}


        								<td style="text-align: center;">
        									{{-- @if($value->hfsrbno != "")
        										<a href="{{asset('employee/dashboard/others/novs')}}/{{$value->survid}}">	
	    											<button class="btn btn-outline-info" title="View NOV">
							                    		<i class="fa fa-fw fa-eye"></i>
							                    	</button>
        										</a>
        										@if($value->recommendation != "")
        											<a href="{{asset('employee/dashboard/others/raoins')}}/{{$value->survid}}">	
		    											<button class="btn btn-info" title="View RAOIN">
								                    		<i class="fa fa-fw fa-eye"></i>
								                    	</button>
	        										</a>
        										@endif
						                    @endif --}}

						                    {{-- @if($value->hasLOE != "" && $value->survAct != "CDO") --}}
	        									<button class="btn btn-outline-success" title="Recommendation" data-toggle="modal" data-target="#recMonModal" onclick="recommendationModal('{{$value->survid}}', '{{$value->appid}}', '{{$value->date_issued}}', '{{$value->name_of_faci}}', '{{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}', '{{$value->hfsrbno}}')">
							                		<i class="fa fa-sticky-note" aria-hidden="true"></i>
							                	</button>
												<!-- <button class="btn btn-outline-success" title="Recommendation" data-toggle="modal" data-target="#recMonModal" @if($value->hfsrbno == "" || $value->recommendation != "") hidden @endif onclick="recommendationModal('{{$value->survid}}', '{{$value->appid}}', '{{$value->date_issued}}', '{{$value->name_of_faci}}', '{{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}', '{{$value->hfsrbno}}')">
							                		<i class="fa fa-sticky-note" aria-hidden="true"></i>
							                	</button> -->
												@if($value->supportDoc)
												

												<!-- <a target="_blank" href="{{ route('OpenFile', $value->supportDoc) }}" > -->
												
													<button title="Supporting Document" onclick="getUps('{{$value->supportDoc}}')" data-toggle="modal" data-target="#uploadsmod"  style="float: right;" type="button" class="btn btn-primary p-2 m-1">
													<i class="fa fa-paperclip" aria-hidden="true"></i>
													<!-- </button> -->
													<!-- </a> -->
												@endif
												
												<!-- <button class="btn btn-outline-success" title="Recommendation" data-toggle="modal" data-target="#recMonModal" @if($value->hfsrbno == "" || $value->recommendation != "") hidden @endif onclick="recommendationModal('{{$value->survid}}', '{{$value->appid}}', '{{$value->date_issued}}', '{{$value->name_of_faci}}', 'AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname', '{{$value->hfsrbno}}')">
							                		<i class="fa fa-sticky-note" aria-hidden="true"></i>
							                	</button> -->
							               {{--  @elseif($value->survAct == "CDO")
							                	<span class="text-success"><b>Not Applicable</b></span>
							                @endif --}}

        									<!-- {{-- <button class="btn btn-outline-warning" title="Issue NOV" data-toggle="modal" data-target="#novMonModal"  onclick="issueNOV('{{$value->survid}}', '{{$value->appid}}', '{{date('Y-m-d')}}', '{{$value->name_of_faci}}', 'AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname', '{{AjaxController::getAllViolationBySurvId($value->survid)}}', '{{ AjaxController::getViolationDescById(AjaxController::getAllViolationBySurvId($value->survid)) }}', '{{$value->team}}')" 
        									@if($value->hfsrbno != "") hidden @endif>
						                        <i class="fa fa-fw fa-clipboard-check"></i>
						                    </button> --}} -->

        								</td>
        							@else
        								<td style="text-align:center;">
        									{{-- <span class="text-success"><b>No Violation</b></span> --}}
        								</td>

        								
        								<td style="text-align: center;">
        									<span class="text-success"><b>Not Applicable</b></span>
        								</td>

        								{{-- attachments --}}
        								{{-- <td></td>

        								<td style="text-align: center;"> 
        									
        								</td> --}}
        							@endif
	        					</tr>
	        				@endforeach
	        			@endisset
	        		</tbody>
	        	</table>

			
	      	</div>
	    </div>
	</div>

	{{-- Issue NOV --}}
	<div class="modal fade" id="novMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Issue NOV</strong>
		          		<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, issuing an NOV is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_nov')}}" data-parsley-validate>
			              	{{csrf_field()}}

			              	{{-- monid --}}
			              	<input type="hidden" name="novmonid" id="novmonid" hidden>

			              	{{-- appid --}}
			              	<input type="hidden" name="novappid" id="novappid" hidden>

			              	{{-- date --}}
			              	<input type="date" name="novdate" id="novdate" value="{{date('')}}" hidden>

			              	{{-- ty --}}
			              	<input type="hidden" name="novty" id="novty" value="surveillance" hidden>

			              	{{-- name of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Name of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="novnameoffaci" id="novnameoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	{{-- type of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Type of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="novtypeoffaci" id="novtypeoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	<!--{{-- violation --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Violation:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                		<select class="form-control w-100" name="" id="novviolation" onchange="selectVio(this)"></select>
			                  		{{-- <textarea name="novviolation" id="novviolation" class="form-control w-100" placeholder="No Violation" readonly></textarea> --}}
			                	</div>
			              	</div>

			              	{{-- remarks --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Remarks:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<textarea name="" name="" id="novremarks" class="form-control w-100" placeholder="Not Available" readonly></textarea>
			                	</div>
			              	</div>

			              	{{-- subdesc --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-12 w-100">
			                  		Violation Sub-description:
			                	</div>

			                	<div class="col-sm-12 w-100">
			                  		<textarea name="" id="novsubdesc" class="form-control w-100 summernote" rows="5" placeholder="Not Available" readonly></textarea>
			                  		{{-- <textarea rows="10" class="form-control summernote" id="AddEditor" data-parsley-required-message="*<strong>Description</strong> required" disabled></textarea> --}}
			                	</div>
			              	</div>-->

			              	<hr>

			              	{{-- dire --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Direction:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<select name="novdire" class="form-control w-100" onchange="novextra(this)" data-parsley-required-message="<b>*Direction</b> required" required data-parsley="recrecom" required>
			                  			<option disabled hidden selected value="">Select an option</option>
			                  			@isset($AllNov)
			                  				@foreach($AllNov as $key => $value)
			                  					<option value="{{$value->novid_directions}}">{{$value->novdesc}}</option>
			                  				@endforeach)
			                  			@endisset
			                  		</select>
			                	</div>			                	
			              	</div>

			              	<div class="row mb-2">
			              		<div class="col-sm-4">&nbsp;</div>
			              		<div class="col-sm-8">
			              			<span id="novextras"></span>
			              		</div>
				            </div>

			              	<hr>

			              	{{-- team --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Surveillance Team: 
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input class="form-control w-100" type="" name="novteam" id="novteam" readonly>
			                	</div>
			              	</div>

			              	{{-- members --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Members:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<select class="form-control w-100" multiple readonly id="novselect">
			                  		</select>
			                	</div>
			              	</div>

			              	{{-- submit btn --}}
			              	<div class="row mt-3">
			                	<div class="col-sm-12 w-100">
			                  		<button type="submit" class="btn btn-outline-warning w-100"><center>Issue NOV</center></button>
			                	</div>

		                		{{-- <div class="col" colspan="6">
			                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>No</center></button>
			                	</div> --}}
			              	</div>
		            	</form>
		          	</div>
        		</div>
	      	</div>
	    </div>
  	</div>

	  <div class="modal fade" id="uploadsmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Supporting Documents</strong>
		          		<!-- <strong>Recommendation</strong> -->
		          		
		          	</h5>
					  <center>
					  <div id="mainappendups">
							  <div id="appendups">

						    	</div>
					  </div>  
					  </center>
				</div>
			</div>
		</div>
	  </div>





  	{{-- Recommendation --}}
	<div class="modal fade" id="recMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Verdict</strong>
		          		<!-- <strong>Recommendation</strong> -->
		          		<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, submitting recommendation is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" enctype="multipart/form-data" method="POST" action="{{asset('employee/dashboard/others/surv_recommendation')}}" data-parsley-validate>
			              	{{csrf_field()}}

			              	{{-- monid --}}
			              	<input type="hidden" name="recmonid" id="recmonid" hidden>

			              	{{-- appid --}}
			              	<input type="hidden" name="recappid" id="recappid" hidden>

			              	{{-- date --}}
			              	<input type="date" name="recdate" id="recdate" value="{{date('Y-m-d')}}" hidden>

			              	{{-- name of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Name of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="recnameoffaci" id="recnameoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	{{-- type of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Type of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="rectypeoffaci" id="rectypeoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	<hr>

			              	{{-- recommendation --}}
			              	<!-- <div class="row mb-2">
			              		<div class="col-sm-12 w-100 mb-2">
			              			RECOMMENDATION:
			              		</div>
			              		{{-- <div class="col-sm-12 w-100">
				                	The written explanation submitted in compliance to the HFSRB NOV No. 
				                	<span id="rechfsrbno" style="color: red">&lt;placeholder&gt;</span> 
				                	issued last 
				                	<span id="recdateissued" style="color: red">&lt;placeholder&gt;</span>
				                	, a copy attached for your reference, was evaluated based only on its technical merits. We therefore recommend:
			              		</div> --}}

					            <div class="col-sm-12 mt-3">
					            	<select class="form-control w-100" id="recrecom" name="recrecom" onchange="recextra(this)" data-parsley-required-message="<b>*Recommendation</b> required" required data-parsley="recrecom" required>
					            		<option diabled hidden selected value="">Select a recommendation</option>
					            		@isset($AllRec)
					            			@foreach($AllRec as $key => $value)
					            				<option value="{{$value->rec_id}}">{{$value->rec_desc}}</option>
					            			@endforeach
					            		@endisset
					            	</select>
					            </div>

					            <div class="col-sm-12 mt-3">
					            	{{-- @foreach($AllRec as $key => $value)
					            			<span id="@php echo $value->rec_id; @endphp">@php echo $value->rec_extra; @endphp</span>
					            	@endforeach --}}
					            	<span id="extras"></span>
					            </div>
							</div> -->

							<hr>

							<div class="row mb-2">
								<div class="col-sm-12">
									VERDICT:
								</div>
								<div class="col-sm-12">
								<!-- <textarea class="form-control w-100" name="recverdict">
								</textarea> -->
									<select class="form-control w-100" name="recverdict" onchange="recextrachange(this)" id="recvselect" data-parsley-required-message="<b>*Verdict</b> required" required data-parsley="recrecom" required>
										<option selected disabled hidden value="">Select a verdict</option>
										@foreach($AllVer as $key => $value)
											@if($value->vdesc != 'Accepted' && $value->vdesc != 'Not Accepted' )
											<option value="{{$value->vid}}">{{$value->vdesc}}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-sm-12">
									<span id="recextra"></span>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-sm-12">
									<label style="float: left;" for="fileup">Attach supporting documents</label>
								
									<input id="fileup" class="form-control "  style="width: 90%;" type="file" name="filesup[]">&nbsp;<a class="btn btn-success" onclick="processImages()" ><i class="fa fa-plus-circle"></i></a>
									<div id="appendArea"></div>
									<!-- <input id="fileup" class="form-control"  type="file" name="filesup"> -->
								</div>
							</div>


			              	{{-- submit btn --}}
			              	<div class="row mt-3">
			                	<div class="col">
			                  		<button type="submit" class="btn btn-outline-warning w-100"><center>Submit</center></button>
			                	</div>

		                		{{-- <div class="col" colspan="6">
			                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>No</center></button>
			                	</div> --}}
			              	</div>
		            	</form>
		          	</div>
        		</div>
	      	</div>
	    </div>
  	</div>

  	<div class="modal fade" id="sMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center lead"><strong>Violation</strong></h5>
          <hr>
          	<div class="container">
          		<div class="col-md-12 lead pb-3 text-center">Violation Details</div>
          		<div class="container border rounded pt-1" id="vDetails" style="min-height: 100px;">
          			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt nam sed, accusamus alias incidunt, magnam sint. Expedita corporis officiis amet omnis facere labore alias, odio veniam dicta suscipit ipsum assumenda.
          		</div>
          	</div>
        </div>
      </div>
    </div>
  </div>

  	{{-- Violation --}}
	<div class="modal fade" id="vMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Violation</strong>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST">
			              	{{-- violation --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Violation:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                		<select class="form-control w-100" name="" id="novviolation" onchange="selectVio(this, 'S')"></select>
			                  		{{-- <textarea name="novviolation" id="novviolation" class="form-control w-100" placeholder="No Violation" readonly></textarea> --}}
			                	</div>
			              	</div>

			              	{{-- subdesc --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-12 w-100">
			                  		Violation Sub-description:
			                	</div>

			                	<div class="col-sm-12 w-100">
			                  		<textarea name="" id="novsubdesc" class="form-control w-100 summernote" rows="5" placeholder="Not Available" readonly></textarea>
			                  		{{-- <textarea rows="10" class="form-control summernote" id="AddEditor" data-parsley-required-message="*<strong>Description</strong> required" disabled></textarea> --}}
			                	</div>
			              	</div>

			              	{{-- remarks --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Remarks:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<textarea name="" name="" id="novremarks" class="form-control w-100" placeholder="Not Available" readonly></textarea>
			                	</div>
			              	</div>
		            	</form>
		          	</div>
        		</div>
	      	</div>
	    </div>
  	</div>

  	{{-- Violation --}}
	<div class="modal fade" id="lMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Letter of Explanation </strong>
		          	</h5>
			          	
		          	<hr>
		          	
		          	<div class="container">
		          		<div class="row mb-3">
			          		<div class="col-sm-12">
			          			<span id="loehtml"></span>
			          		</div>	
			          	</div>
		          	</div>
			          	

		          	{{-- submit btn --}}
	              	<div class="row mt-3">
	                	<div class="col-sm-6 w-100">
	                  		&nbsp;
	                	</div>

                		<div class="col-sm-6 w-100">
	                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
	                	</div>
	              	</div>
        		</div>
	      	</div>
	    </div>
  	</div>

  	{{-- Attachments --}}
	<div class="modal fade" id="attMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Include Attachment</strong>
		          		{{-- <span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, System will generate the NOV if no included attachments.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span> --}}
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_attachment')}}" data-parsley-validate enctype="multipart/form-data">
			              	{{csrf_field()}}

			              	<input type="hidden" name="monid" id="monid">

			              	<div class="row">
				          		<div class="col-sm-12" id="aatt">
			          				
				          		</div>
				          	</div>

			              	<div class="row">
				          		<div class="col-sm-10">
			          				<input class="form-control w-100" type="file" name="attfile[]" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple>
				          		</div>
				          		<div class="col-sm-2">
				          			{{-- <button type="button" class="btn btn-outline-success">
				          				<i class="fa fa-plus"></i>
				          			</button> --}}
				          		</div>
				          	</div>

			              	<div class="row mt-3">
			                	<div class="col-sm-6 w-100">
			                  		<button type="submit" class="btn btn-outline-success w-100"><center>Submit</center></button>
			                	</div>

		                		<div class="col-sm-6 w-100">
			                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
			                	</div>
			              	</div>

		            	</form>
		          	</div>
        		</div>
	      	</div>
	    </div>
  	</div>

<script>
let increment = 1;
function processImages(e){
	increment++;
$("#appendArea").prepend(
				'<div id="file'+increment+'" ><input style="width: 90%; margin-top: 4px;"  class="form-control" id="mi"  type="file" name="filesup[]"> <a class="btn btn-danger " onclick="removeFile('+"'file"+increment+"'"+')"><i class="fa fa-minus-circle"></i></a></div>'
				);

				return false;
}

function removeFile(id){
	console.log(id)
	$('#'+id).remove()
}

function getUps(ups){
	$('#appendups').remove()
	var newDiv = document.createElement("div");
    newDiv.setAttribute("id", "appendups");
	document.getElementById("mainappendups").appendChild(newDiv);

	console.log(ups)
	const myArr = ups.split(",");

	console.log('{{URL::to('/')}}')
	const url ='{{URL::to('/')}}';

	for(var i = myArr.length - 1; i >= 0; i--){
		$("#appendups").prepend(
				'<br><a target="_blank" href="'+url+'/file/open/'+myArr[i]+'" >' +
				'<button class="btn btn-outline-primary "> Document #'+(i +1)+'</button></a><br><br>' 
				);
		console.log(myArr[i])
	}
}


</script>
<script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>
	{{-- <script>
		var data = {!!$AllData[0]->DOHMonitoring!!};
		console.log(data);
	</script> --}}

	<script type="text/javascript">
		function att(monid) {
			document.getElementById('monid').value=monid;
		}

		function att1(monid, att) {
			document.getElementById('monid').value=monid;
			document.getElementById('aatt').innerHTML=att.split("/")[2].replace(monid, '');
		}
	</script>

	

	@include('employee.cmp._othersJS')
@endsection