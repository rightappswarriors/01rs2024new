@if (session()->exists('employee_login')) 
@extends('mainEmployee')
@section('title', 'Monitoring Recommendation')
@section('content')
  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/monitoring')}}">Monitoring Entry</a> / <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">Monitoring Tool </a> / <a href="{{asset('employee/dashboard/others/monitoring/technical')}}">Technical Findings</a> / Recommendation of Technical Staff  / <a href="{{asset('employee/dashboard/others/monitoring/updatestatus')}}">Update Status of CA</a>
	      	</div>
	      	<div class="card-body table-responsive">
	      		<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto;">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">NOV No.</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Issued</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				{{-- <th scope="col" style="text-align: center; width:auto">Violation</th>
	        				<th scope="col" style="text-align: center; width:auto">Letter<br>of<br>Explanation</th>
	        				<th scope="col" style="text-align: center; width:auto">Attachments</th> --}}
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				@foreach($AllData as $key => $value)
	        					<tr>
	        						<td style="text-align: center;">{{$value->monid}}</td>
	        						<td style="text-align: center;">@if($value->novid != "") {{ AjaxController::getNovidById($value->monid, "M")->novid }} @endif</td>
	        						<td style="text-align: center;">{{\Carbon\Carbon::parse($value->date_issued)->format('M d, Y')}}</td>
	        						<td style="text-align: center;">{{$value->name_of_faci}}</td>

        							@if($value->hasViolation != "")
        								{{-- <td style="text-align:center">
        									<button type="btn" class="btn btn-danger" data-toggle="modal" data-target="#vMonModal" onclick="issueNOV('{{$value->monid}}', '{{$value->appid}}', '{{date('Y-m-d')}}', '{{$value->name_of_faci}}', '{{AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname}}', '{{AjaxController::getAllViolationByMonId($value->monid)}}', '{{ AjaxController::getViolationDescById(AjaxController::getAllViolationByMonId($value->monid)) }}', '{{$value->team}}')">
    											<i class="fa fa-fw fa-eye"></i>
    											Show Violation
    										</button>
        								</td>

        								<td style="text-align: center;">
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
        								</td>

        								<td style="text-align: center">
        									@if($value->hfsrbno != "")
	        									@if(AjaxController::getAttachMon($value->monid)->attached_files == "")
	        										<button class="btn btn-outline-info" title="Incude Attachments upon issuing" data-toggle="modal" data-target="#attMonModal" onclick="att('{{$value->monid}}')">
	        											<i class="fa fa-paperclip" aria-hidden="true"></i> Include Attachment
	        										</button>
	        									@elseif(AjaxController::getAttachMon($value->monid)->attached_files != "")
	        										<button class="btn btn-outline-info" data-toggle="modal" data-target="#attMonModal" onclick="att1('{{$value->monid}}', '{{AjaxController::getAttachMon($value->monid)->attached_files}}')">
	        											<i class="fa fa-paperclip" aria-hidden="true"></i> Edit Attached File
	        										</button>
	        									@endif
	        								@endif
        								</td> --}}

        								<td style="text-align: center; width: 15%">
        									@if($value->novid != "")
        										@if($value->recommendation != "" && AjaxController::getAllUidByAppid($value->appid)->rgnid != "HFSRB")
        											<a href="{{asset('employee/dashboard/others/raoin')}}/{{$value->monid}}">	
		    											<button class="btn btn-outline-info w-100" title="View RAOIN">
								                    		<i class="fa fa-paperclip" aria-hidden="true"></i> Download RAOIN
								                    	</button>
	        										</a>
        										@endif
						                    @endif

						                    @if($value->hasLOE != "")
	        									<button class="btn btn-outline-success" title="Recommendation" data-toggle="modal" data-target="#recMonModal" @if($value->novid == "" || $value->recommendation != "") hidden @endif onclick="recommendationModal('{{$value->monid}}', '{{$value->appid}}', '{{$value->date_issued}}', '{{$value->name_of_faci}}', '{{AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname}}', '{{$value->novid}}')">
							                		<i class="fa fa-sticky-note" aria-hidden="true"></i> Recommendation
							                	</button>
							                @endif
        								</td>
        							@else

        								<td style="text-align: center;"> 
        									
        								</td>
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
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_nov')}}" data-parsley-validate>
			              	{{csrf_field()}}

			              	{{-- monid --}}
			              	<input type="hidden" name="novmonid" id="novmonid" hidden>

			              	{{-- appid --}}
			              	<input type="hidden" name="novappid" id="novappid" hidden>

			              	{{-- date --}}
			              	<input type="date" name="novdate" id="novdate" value="{{date('')}}" hidden>

			              	{{-- ty --}}
			              	<input type="hidden" name="novty" id="novty" value="monitoring" hidden>

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
			                  		Monitoring Team: 
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

  	{{-- Recommendation --}}
	<div class="modal fade" id="recMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Recommendation</strong>
		          		<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, submitting recommendation is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_recommendation')}}" data-parsley-validate>
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
			              	<div class="row mb-2">
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
							</div>

							{{-- <hr>

							<div class="row mb-2">
								<div class="col-sm-12">
									RECOMMENDATION IS HEREBY:
								</div>
								<div class="col-sm-12">
									<select class="form-control w-100" name="recverdict" onchange="recextrachange(this)" id="recvselect" data-parsley-required-message="<b>*Verdict</b> required" required data-parsley="recrecom" required>
										<option selected disabled hidden value="">Select a verdict</option>
										@foreach($AllVer as $key => $value)
											<option value="{{$value->vid}}">{{$value->vdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-sm-12">
									<span id="recextra"></span>
								</div>
							</div> --}}

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

  	{{-- Update Recommendation --}}
	<div class="modal fade" id="urecMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Update Recommendation</strong>
		          		<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, submitting recommendation is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_recommendation_u')}}" data-parsley-validate>
			              	{{csrf_field()}}

			              	{{-- monid --}}
			              	<input type="hidden" name="recmonid" id="urecmonid" hidden>

			              	{{-- appid --}}
			              	<input type="hidden" name="recappid" id="urecappid" hidden>

			              	{{-- date --}}
			              	<input type="date" name="recdate" id="urecdate" value="{{date('Y-m-d')}}" hidden>

			              	{{-- name of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Name of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="recnameoffaci" id="urecnameoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	{{-- type of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Type of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="rectypeoffaci" id="urectypeoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	<hr>

			              	{{-- recommendation --}}
			              	<div class="row mb-2">
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
					            	<select class="form-control w-100" id="urecrecom" name="recrecom" onchange="urecextra(this)" data-parsley-required-message="<b>*Recommendation</b> required" required data-parsley="recrecom" required>
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
					            	<span id="uextras"></span>
					            </div>
							</div>

							<hr>

							<div class="row mb-2">
								<div class="col-sm-12">
									VERDICT:
								</div>
								<div class="col-sm-12">
									<select class="form-control w-100" name="recverdict" onchange="urecextrachange(this)" id="urecvselect" data-parsley-required-message="<b>*Verdict</b> required" required data-parsley="recrecom" required>
										<option selected disabled hidden value="">Select a verdict</option>
										@foreach($AllVer as $key => $value)
											<option value="{{$value->vid}}">{{$value->vdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-sm-12">
									<span id="urecextra"></span>
								</div>
							</div>

			              	{{-- submit btn --}}
			              	<div class="row mt-3">
			                	<div class="col-sm-6">
			                  		<button type="submit" class="btn btn-outline-warning w-100"><center>Submit</center></button>
			                	</div>

		                		<div class="col-sm-6">
			                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Cancel</center></button>
			                	</div>
			              	</div>
		            	</form>
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
			                		<select class="form-control w-100" name="" id="novviolation" onchange="selectVio(this, 'M')"></select>
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
		          		<strong>Letter of Explanation</strong>
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
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_attachment')}}" data-parsley-validate enctype="multipart/form-data">
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
			document.getElementById('aatt').innerHTML=att.split("/")[2].replace(monid+"^", '');
		}
	</script>

	@include('employee.cmp._othersJS')
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif