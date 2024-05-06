@if (session()->exists('employee_login')) 
@extends('mainEmployee')
@section('title', 'Monitoring Technical Findings')
@section('content')
  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/monitoring')}}">Monitoring Entry</a> /  <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">Monitoring Tool </a> / Technical Findings 
			   @include('employee.tableDateSearch')
			</div>
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto;">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">NOV No.</th>
	        				<th scope="col" style="text-align: center; width:auto">Date of Monitoring</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Monitored</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Deficiency</th>
	        				<th scope="col" style="text-align: center; width:10%">
	        					{{-- Letter<br>of<br>Explanation --}}
	        					Action to <br> Status
	        				</th>
	        				{{-- <th scope="col" style="text-align: center; width:auto">Attachments</th> --}}
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        			{{-- {{dd($AllData)}} --}}
	        				@foreach($AllData as $key => $value)
	        					<tr>
	        						<td style="text-align: center;">{{$value->monid}}</td>
	        						<td style="text-align: center;">{{ $value->novid }}</td>

	        						<td style="text-align: center;">
	        							<b>{{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}}</b>
	        							to<b>{{\Carbon\Carbon::parse($value->date_monitoring_end)->format('M d, Y')}}</b>
	        						</td>

	        						<td style="text-align: center;">
	        							<b>{{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}}</b>
	        							to<b>{{\Carbon\Carbon::parse($value->date_monitoring_end)->format('M d, Y')}}</b>
	        						</td>


	        						<td style="text-align: center;">{{$value->name_of_faci}}</td>
	        						
        							@if($value->hasViolation != "")
        								<td style="text-align:center">
										
        									<button type="btn" class="btn btn-danger" data-toggle="modal" data-target="#vMonModal" onclick="issueNOV('{{$value->monid}}', '{{$value->regfac_id}}', '{{date('Y-m-d')}}', '{{$value->name_of_faci}}', '{{ $value->hgpdesc }}', '{{-- AjaxController::getAllViolationsNew($value->monid) --}}', '{{-- AjaxController::getAllViolationsKeyNew($value->monid) --}}', '{{$value->team}}')">
    											<i class="fa fa-fw fa-eye"></i>
    											Go to Show Violation
    										</button>
        								</td>

        								<td 
											@if($value->hasLOE == ""  && $value->novid_directions == 1) 
												class="{{--bg-warning text-center--}}text-warning" 
											@elseif($value->hasLOE == "" && $value->novid_directions == 2) 		
												class="{{--bg-danger text-center text-white--}}text-danger" 
											@endif>
											
        									@if($value->isCDO && $value->hasLOE == "")
        										<span style="font-weight: bold; text-align: center">CDO Applied</span>
        									{{-- @elseif($value->hasLOE == "" && $value->novid_directions == 1)

        										@if(date_create(date('Y-m-d')) > date_create(date('Y-m-d', strtotime($value->date_issued.'+ 3 days'))))
        											<span style="font-weight: bold; text-align: center;">CDO Applied</span>
        										@elseif(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($value->date_issued.'+ 3 days'))))->d == 0)
        											<span style="font-weight: bold; text-align: center;">last day <br>before CDO</span>
        										@else
        											<span style="font-weight: bold; text-align: center;">{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($value->date_issued.'+ 3 days'))))->d  }} day/s remaining <br>before CDO</span>
        										@endif    --}} 											

        									@elseif(($value->hasLOE != ""))

												@if($value->LOE != null)
													<button type="btn" onclick="showData('{{$value->LOE}}','{{$value->monid}}')" class="btn btn-info" data-toggle="modal" data-target="#viewAct">
														<i class="fa fa-paperclip" aria-hidden="true"></i> Show LOE
													</button>	
												@endif
												@if($value->attached_filesUser != null)
													<button type="btn" onclick="showData('{{strip_tags($value->explanation)}}','{{$value->monid}}',true)" class="btn btn-info mt-3" data-toggle="modal" data-target="#viewActWithImage">
														<i class="fa fa-paperclip" aria-hidden="true"></i> Show Uploads
													</button>	
												@endif

        									@endif

											@if($value->novid != "" && $value->compliance_id != "" )
								
												@if($value->novid != "" && $value->isApproved != "1" )
													<a href="{{asset('employee/dashboard/others/monitoring/correctiondetails')}}/{{$value->compliance_id}}">	
														<button class="btn btn-outline-info w-100" title="For Corrective Action">
															For corrective action
														</button>
													</a>
												@endif

												@if($value->novid != "" && $value->isApproved == "1" )
													<a href="{{asset('employee/dashboard/others/monitoring/correctiondetails')}}/{{$value->compliance_id}}/?from=rec">	
														<button class="btn btn-outline-info w-100" title="For Corrective Action">
															Show corrective action
														</button>
													</a>
												@endif

											@endif
        								</td>

        								<td style="text-align: center;">
        									@if($value->novid == "" && $value->team != "")
	        									<button class="btn btn-outline-warning" title="Issue NOV" data-toggle="modal" data-target="#novMonModal" onclick="issueNOV('{{$value->monid}}', '{{$value->regfac_id}}', '{{date('Y-m-d')}}', '{{$value->name_of_faci}}', '{{ $value->hgpdesc }}', '', '', '{{$value->team}}', '{{$value->montname}}')">
							                        <i class="fa fa-fw fa-clipboard-check"></i> Issue NOV
							                    </button>
							                @elseif($value->novid != "")
							                	<a href="{{asset('employee/dashboard/others/novm')}}/{{$value->monid}}">	
	    											<button class="btn btn-outline-info w-100" title="View NOV">
							                    		<i class="fa fa-paperclip" aria-hidden="true"></i> Download NOV
							                    	</button>
	    										</a>
	    										<br><br>
	    										<a class="btn btn-outline-info w-100" href="{{asset('employee/dashboard/processflow/GenerateReportAssessments/regfac/'.$value->regfac_id)}}/{{$value->monid}}"><i class="fa fa-eye" aria-hidden="true"></i> View HF Assessment</a>
	    										
	    										@if($value->hasLOE == "" && $value->isCDO == null)
	    										<br><br>
		    										<button class="btn btn-outline-secondary w-100" title="Update NOV" data-toggle="modal" data-target="#unovMonModal" onclick="issueNOVu('{{$value->monid}}', '{{$value->regfac_id}}', '{{date('Y-m-d')}}', '{{$value->name_of_faci}}', '{{ $value->hgpdesc }}', '', '', '{{$value->team}}', '{{$value->montname}}')">
		    											<i class="fa fa-clipboard-check" aria-hidden="true"></i> Update NOV
							                    	</button>
						                    	@endif
							                @endif
        								</td>
        							@else
        								<td style="text-align: center;"> 
        									<span style="font-weight: bold; color: green">No Violation/s</span>
        								</td>

        								<td style="text-align: center;"> 
        									<span style="font-weight: bold; color: green">No Violation/s</span>
        								</td>

        								<td style="text-align: center;"> 
        									<span style="font-weight: bold; color: green">No Violation/s</span>
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

	<script>
		$(document).ready(function() {
			$('#novviolation').on('change', function() {
				// console.log($(this).val());
				$.ajax({
					type: "post",
					url: "{{url('employee/dashboard/monitor/violations/get')}}",
					data: {"dupId":$(this).val(), "_token":'{{csrf_token()}}'},
					success: function(response) {
						$('#novsubdesc').summernote('code',response[2]);
						$('.note-toolbar').hide();
						$('#novremarks').val(response[1]);
					},
				});
			});
		});	
	</script>

	<div class="modal fade" id="viewAct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center lead"><strong>Letter of Explanation </strong></h5>
          <hr>
          	<div class="container">
          		<div class="col-md-12 lead pb-3 text-center font-weight-bold">Client Action Comment</div>
          		<div class="container border rounded pt-1 cDetails" style="min-height: 100px;">
          		</div>
          	</div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="viewActWithImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
	  <form method="POST">
	  	{{csrf_field()}}
	  	  <input type="hidden" name="setToRevise">
	  	  <input type="hidden" name="monid">
	      <div class="modal-content " style="border-radius: 0px;border: none;">
	        <div class="modal-body text-justify" style="background-color: #272b30;color: white;">
	          <h5 class="modal-title text-center lead"><strong>Client Action Taken</strong></h5>
	          <hr>
	          	<div class="container">
	          		<div class="col-md-12 lead pb-3 text-center font-weight-bold">Client Action Comment</div>
	          		<div class="container border rounded pt-1 cDetails" style="min-height: 100px;">
	          		</div>
	          	</div>
	          	
				<div class="col-md-12 lead pt-3 pb-3 text-center font-weight-bold">Client Action Proofs</div>
	          	<div class="container pt-3 border" id="view">
					
		      	</div>

		      	<div class="container pt-3 border">
		      		Remarks
					<textarea required class="form-control w-100 mt-3 mb-3" name="remark" rows="5"></textarea>
		      	</div>

	        </div>
	        <div class="modal-footer" style="background-color: #272b30;color: white;">
	          <button type="submit" class="btn btn-primary">Set as Not accepted</button>
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	  </form>
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

							<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		NOV Number:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="nov_num" id="nov_num" class="form-control w-100" required>
			                	</div>
			              	</div>

			              	<hr>

			              	{{-- dire --}}
			              	<div class="row mb-2">
			                  		Direction:
									  <div class="container">
										@isset($AllNov)
			                  				@foreach($AllNov as $key => $value)
											  <div class="row">
   											    <div class="col-sm-2">
													<input type="checkbox" id="{{$value->novid_directions}}" name="novdire[]" class="form-control w-100" 
													onclick="showextra(this.value)" value="{{$value->novid_directions}}" >
												</div>
												<div class="col-sm-10">
												{{$value->novdesc}} <br/>
												</div>
											  </div>
									@endforeach
			                  			@endisset
									  </div>
			              	</div>

			              	<div class="row mb-2">
			              		<div class="col-sm-4">&nbsp;</div>
			              		<div class="col-sm-8">
			              			<span id="novextras"></span>
			              		</div>
				            </div>
							<textarea name="nov_others" id="nov_others" hidden class="form-control w-100" placeholder="Specify"
							 data-parsley="recrecom"></textarea>

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

  	{{-- Update NOV --}}
	<div class="modal fade" id="unovMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Update NOV</strong>
		          		<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, issuing an NOV is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
		          	</h5>
			          	
		          	<hr>
		          	<div class="input-group form-inline mb-1 mt-2">
		            	<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_nov_u')}}" data-parsley-validate>
			              	{{csrf_field()}}

			              	{{-- monid --}}
			              	<input type="hidden" name="novmonid" id="unovmonid" hidden>

			              	{{-- appid --}}
			              	<input type="hidden" name="novappid" id="unovappid" hidden>

			              	{{-- date --}}
			              	<input type="date" name="novdate" id="unovdate" value="{{date('')}}" hidden>

			              	{{-- ty --}}
			              	<input type="hidden" name="novty" id="unovty" value="monitoring" hidden>

			              	{{-- name of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Name of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="novnameoffaci" id="unovnameoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	{{-- type of faci --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Type of Facility:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input type="text" name="novtypeoffaci" id="unovtypeoffaci" class="form-control w-100" readonly>
			                	</div>
			              	</div>

			              	<hr>

			              	{{-- dire --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Direction:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<select name="novdire" class="form-control w-100" onchange="novextrau(this)" data-parsley-required-message="<b>*Direction</b> required" required data-parsley="recrecom" required>
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
			              			<span id="unovextras"></span>
			              		</div>
				            </div>

			              	<hr>

			              	{{-- team --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Monitoring Team: 
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<input class="form-control w-100" type="" name="novteam" id="unovteam" readonly>
			                	</div>
			              	</div>

			              	{{-- members --}}
			              	<div class="row mb-2">
			                	<div class="col-sm-4 w-100">
			                  		Members:
			                	</div>

			                	<div class="col-sm-8 w-100">
			                  		<select class="form-control w-100" multiple readonly id="unovselect">
			                  		</select>
			                	</div>
			              	</div>

			              	{{-- submit btn --}}
			              	<div class="row mt-3">
			                	<div class="col-sm-6 w-100">
			                  		<button type="submit" class="btn btn-outline-warning w-100"><center>Update NOV</center></button>
			                	</div>

		                		<div class="col-sm-6 w-100">
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
	    <div class="modal-dialog modal-lg" role="document">
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
			                		<select class="form-control w-100" name="" id="novviolation"></select>
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

<script type="text/javascript">
	function showextra(value){
		if($('#3').prop('checked')){
			document.getElementById('nov_others').removeAttribute("hidden")
		}else{
			document.getElementById('nov_others').setAttribute("hidden", true);
		}
	}

	let validImageTypes = ["gif", "jpeg", "png", "jpg"];
	function showData(det,survid,displayImage = false){
		let aString = '<div class="row">';
		let sView = $("#view");
		$(".cDetails").empty().html(det);
		if(displayImage){
			$('[name=monid]').val(survid);
			$.ajax({
				url: '{{asset('employee/dashboard/others/surveillance/getMonAct')}}',
				method: 'POST',
				async: false,
				data: {_token: $('input[name=_token]').val(), survid: survid},
				success: function(a){
					let det = JSON.parse(a);
					sView.empty().html('<div class="container text-center font-weight-bold ">No Image Uploaded</div>');
					if(det['attached_filesUser'] != "" && det['attached_filesUser'] != null){
						let splited = det['attached_filesUser'].split(',');
						let perDiv = (12 % splited.length == 0 ? '-' + 12 / splited.length : '-3');
						for (var i = 0;  i < splited.length; i++) {
							let link = '{{asset('ra-idlis/storage/app/public/uploaded/')}}/'+splited[i]+'';
							aString  += '<div class="col'+perDiv+' mt-3">'+
							'<img onclick="window.open('+"\'"+ link+'\')" " class="w-100" src="'+($.inArray(link.split('.').pop(), validImageTypes) < 0 ? '{{url('ra-idlis/public/img/no-preview-available.png')}}' : link)+'" style="cursor: pointer;">'+
							'</div>';
						}
						aString +='</div>';
						sView.empty().append(aString);
					}	
				}
			})
		}
	}
	function att(monid) {
		document.getElementById('monid').value=monid;
	}

	function att1(monid, att) {
		document.getElementById('monid').value=monid;
		document.getElementById('aatt').innerHTML=att.split("/")[2].replace(monid+"^", '');
	}

	@isset($optid)
		$(document).ready(function(){
			$('#example_filter input').val('{{$optid}}').trigger('keyup');
		})
	@endisset


</script>
<script>
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>
	@include('employee.cmp._othersJS')
	@include('employee.others.__timeDiff')
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif