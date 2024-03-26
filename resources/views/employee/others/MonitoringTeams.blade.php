@if (session()->exists('employee_login')) 
@extends('mainEmployee')
@section('title', 'Monitoring Team')
@section('content')
@php
	$WT = AjaxController::getEmployeeWithTeamOthers();
	$WOT = AjaxController::getEmployeeWithoutTeamOthers();
@endphp

{{-- {{dd(AjaxController::getAllX08())}} --}}
{{-- {{dd(AjaxController::getAllMonTeamMembers())}} --}}
	<style type="text/css">
		.border-3 {
		    border-width:3px !important;
		}
	</style>

  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           Assignment of Team 
	           {{-- <a href="#" title="Add New Team" data-toggle="modal" data-target="#teamModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new Member</button></a> --}}

	           <button class="btn-primarys" style="background-color: rgb(29,160,182) !important"  data-toggle="modal" data-target="#mtMonVModal"><i class="fa fa-users"></i>&nbsp;Manage Team</button>
	           {{-- employee/dashboard/mf/manage/teams --}}
	      	 @include('employee.tableDateSearch')
			</div>
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto;">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Added</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
						<script>
						
						</script>
	        				@foreach($AllData as $key => $value)
			        			<tr>
			        				<td style="text-align:center">{{$value->monid}}</td>
			        				<td style="text-align:center">{{ \Carbon\Carbon::parse($value->date_added)->format('M d, Y') }}</td>
			        				<td style="text-align:center">{{$value->name_of_faci}}</td>

									<td style="text-align:center">
										<div class="dropup">
						                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						                    	<i class="fa fa-align-justify"></i>
						                    </button>

						                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="padding-left: 10px">

												<button class="btn btn-outline-info" data-toggle="modal" data-target="#aMonVModal" onclick="viewTMonitoring('{{$value->novid}}', '{{$value->appid}}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}', '{{$value->name_of_faci}}', '{{$value->address_of_faci}}', '{{ AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}')" title="View {{$value->name_of_faci}} {{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}">
		                        					<i class="fa fa-fw fa-eye"></i>
		                      					</button>
												  
												  <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#aMonVModal" onclick="viewTMonitoring('{{$value->novid}}', '{{$value->appid}}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}', '{{$value->name_of_faci}}', '{{$value->address_of_faci}}', ' AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname')" title="View {{$value->name_of_faci}} AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname">
		                        					<i class="fa fa-fw fa-eye"></i>
		                      					</button> -->

		                      					<button class="btn btn-outline-primary" data-toggle="modal" data-target="#aMonTModal" onclick="getMonitoringData('{{$value->appid}}', '{{$value->monid}}')" title="Assign Team in {{$value->name_of_faci}} {{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}">
		                        					<i class="fa fa-users" aria-hidden="true"></i>
		                      					</button>
<!-- 												  
<button class="btn btn-outline-primary" data-toggle="modal" data-target="#aMonTModal" onclick="getMonitoringData('{{$value->appid}}', '{{$value->monid}}')" title="Assign Team in {{$value->name_of_faci}} AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname">
		                        					<i class="fa fa-users" aria-hidden="true"></i>
		                      					</button> -->

						                    </div>
									</td>

			        				{{-- <td style="text-align:center">
			        					<button class="btn btn-outline-info" data-toggle="modal" data-target="#aMonVModal" onclick="viewTMonitoring('{{$value->novid}}', '{{$value->appid}}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}', '{{$value->name_of_faci}}', '{{$value->address_of_faci}}', '{{ AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}')" title="View {{$value->name_of_faci}} {{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}">
                        					<i class="fa fa-fw fa-eye"></i>
                      					</button>
<!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#aMonVModal" onclick="viewTMonitoring('{{$value->novid}}', '{{$value->appid}}', '{{\Carbon\Carbon::parse($value->date_added)->format('M d, Y')}}', '{{$value->name_of_faci}}', '{{$value->address_of_faci}}', 'AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname')" title="View {{$value->name_of_faci}} AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname">
                        					<i class="fa fa-fw fa-eye"></i>
                      					</button> -->

			        					<button class="btn btn-outline-primary" data-toggle="modal" data-target="#aMonTModal" onclick="getMonitoringData('{{$value->appid}}', '{{$value->monid}}')" title="Assign Team in {{$value->name_of_faci}} {{AjaxController::getHgpByFacid($value->type_of_faci)[0]->hgpdesc}}">
                        					<i class="fa fa-users" aria-hidden="true"></i>
                      					</button>
										  <!-- <button class="btn btn-outline-primary" data-toggle="modal" data-target="#aMonTModal" onclick="getMonitoringData('{{$value->appid}}', '{{$value->monid}}')" title="Assign Team in {{$value->name_of_faci}} AjaxController::getFacTypeByFacid($value->type_of_faci)[0]->facname">
                        					<i class="fa fa-users" aria-hidden="true"></i>
                      					</button>
										   -->
			        				</td> --}}
			        			</tr>
			        		@endforeach
		        		@endisset
	        		</tbody>
	        	</table>
	    	</div>
		</div>
	</div>

	{{-- Team Assign --}}
	<div class="modal fade" id="aMonTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content " style="border-radius: 0px;border: none;">
	    		<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	      			<h5 class="modal-title text-center">
	      				<strong>Assign Team</strong>
	      				<span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, Appending a Team in a Facility is irreversible.">
			              <i class="fa fa-question-circle" aria-hidden="true"></i>
			            </span>
	      			</h5>
	      			<hr>
	      			<div class="input-group form-inline mb-1 mt-2">
	        			<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_team')}}" data-parsley-validate>
		          			{{csrf_field()}}

		          			{{-- hfsrbno --}}
				         	<input class="form-control w-100" type="" name="athfsrbno" id="athfsrbno" hidden>
				         	{{-- appid --}}
				         	<input class="form-control w-100" type="" name="atappid" id="atappid" hidden>
				         	{{-- monid --}}
				         	<input class="form-control w-100" type="" name="atmonid" id="atmonid" hidden>

				         	<div class="row mb-3">
				         		<div class="col-sm-5 w-100">
				         			Date of Monitoring: (from)
				         		</div>

				         		<div class="col-sm-7">
				         			<input class="form-control w-100" type="date" name="date" required data-parsley-required-message="<b>*Date</b> required" data-parsley="">
				         		</div>
				         	</div>

				         	<div class="row mb-3">
				         		<div class="col-sm-5 w-100">
				         			Date of Monitoring: (to)
				         		</div>

				         		<div class="col-sm-7">
				         			<input class="form-control w-100" type="date" name="date_end" required data-parsley-required-message="<b>*Date</b> required" data-parsley="">
				         		</div>
				         	</div>

				         	{{-- region --}}
				          	<div class="row mb-3">
				            	<div class="col-sm-5 w-100">
				              		Region:
				            	</div>

				            	<div class="col-sm-7 w-100">
				              		<select class="form-control w-100" name="team" required data-parsley-required-message="<b>*Team</b> required" onchange="onRegionChange(this)">
		              					<option disabled hidden selected value="">Select a region</option>
		              					@foreach(AjaxController::getAllRegion(true) as $key => $value)
											{{-- @if($emp['rgnid'] == $value->rgnid) --}}
		              						<option value="{{$value->rgnid}}" selected>{{$value->rgn_desc}}</option>
											{{-- @endif --}}
		              					@endforeach
				              		</select>
				            	</div>
				          	</div>

				          	{{-- team --}}
				          	<div class="row mb-3">
				            	<div class="col-sm-5 w-100">
				              		Assign Team:
				            	</div>

				            	<div class="col-sm-7 w-100">
				              		<select id="monteam" class="form-control w-100" name="team" required data-parsley-required-message="<b>*Team</b> required" data-parsley="" {{-- onchange="teamselect(this)" --}} {{-- onchange="getteammembers(this)" --}} onchange="onTeamChange(this)">
		              					<option disabled hidden selected value="">Select a team</option>
		              					<option disabled >No team available</option>
				              			{{-- @isset($AllTeam)
				              				@foreach($AllTeam as $key => $value)
				              					<option value="{{$value->teamid}}">{{$value->teamdesc}}</option>
				              				@endforeach
				              			@endisset --}}
				              		</select>
				            	</div>
				          	</div>

				          	<div class="row mb-3">
				            	<div class="col-sm-12 w-100">
				              		Members:
				            	</div>

				            	<div class="col-sm-12 w-100">
				              		<select id="monteammember" name="" class="form-control w-100" id="selectmember" multiple></select>
				            	</div>
				            	{{-- <div class="col-sm-2 w-100">
				              		<button type="button" class="btn btn-outline-success text-center">
				              			<i class="fa fa-fw fa-plus"></i>
				              		</button>
				            	</div> --}}
				          	</div>

		          			{{-- submit btn --}}
		          			<div class="row mt-3">
		            			<div class="col" colspan="6">
		              				<button type="submit" class="btn btn-outline-success w-100"><center>Assign</center></button>
		            			</div>
		            			<div class="col" colspan="6">
		              				<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Cancel</center></button>
		            			</div>
		          			</div>
	        			</form>
	      			</div>
	    		</div>
	  		</div>
		</div>
	</div>

	<script type="text/javascript">

		function getteammembers(dom) {
			mmbers.open("GET", "{{asset('employee/dashboard/monitor/team/remarks')}}"+dom.value.split('^')[1], true);
            mmbers.send();
		}

		function removeExisting(montid) {
			var select = document.getElementById('xnotmembers'+montid);
			var options = select.children;
			var members = document.getElementById('xmembers'+montid).children;
			var m_members = [];

			for(i=0; i<members.length; i++) {
				var x  = members[i].value.split('^')[0];
				m_members.push(x);
			}

			for(j=0; j<m_members.length+1; j++) {
				for(i=0; i<options.length; i++) {
					if(m_members.includes(options[i].value.split('^')[0])) {
						select.options[i] = null;
					}
				}
			}
		}

		function changeRemarks(dom) {
			rem.open("GET", "{{asset('employee/dashboard/monitor/team/remarks')}}"+dom.value.split('^')[1], true);
            rem.send();
		}

		var rem = new XMLHttpRequest();
	    rem.onreadystatechange = function() {
	     	if (this.readyState == 4 && this.status == 200) {
	        	var r = JSON.parse(this.responseText);
	        	document.getElementById('xremarks'+r.montid).innerHTML=r.remarks;
	    	}
	    };

	    var mmbers = new XMLHttpRequest();
	    mmbers.onreadystatechange = function() {
	     	if (this.readyState == 4 && this.status == 200) {
	        	var r = JSON.parse(this.responseText);
	        	document.getElementById('xremarks'+r.montid).innerHTML=r.remarks;
	    	}
	    };

	    function onRegionChange(dom) {
	    	regionCH.open("GET", "{{asset('employee/dashboard/monitor/team/getMonTeamByRegionJSON')}}"+dom.value, true);
            regionCH.send();
	    }

	    var regionCH = new XMLHttpRequest();
	    regionCH.onreadystatechange = function() {
	     	if (this.readyState == 4 && this.status == 200) {
	        	var r = JSON.parse(this.responseText);

	        	var select = document.getElementById('monteam');
	        	var memberselect = document.getElementById('monteammember');

	        	// while(memberselect.firstChild) {
	        	// 	select.removeChild(memberselect.firstChild);
	        	// }
	        	$("#monteammember option").remove();
	        	$("#monteam option").remove()

	        	// while(select.firstChild) {
	        	// 	select.removeChild(select.firstChild);
	        	// }

	        	var x = document.createElement('OPTION');
	        		x.setAttribute('hidden', '');
	        		x.setAttribute('selected', '');
	        		x.setAttribute('disabled', '');
	        		x.innerHTML="Select a team";
	        		select.appendChild(x);

	        	if(r.length > 0) {
	        		Array.from(r).forEach(function(v) {
			        	var option = document.createElement('OPTION');
		        		option.setAttribute('value', v.montid);
		        		option.innerHTML=v.montname;

		        		select.appendChild(option);
			        });
	        	} else {
	        		var x = document.createElement('OPTION');
	        		x.setAttribute('disabled', '');
	        		x.innerHTML="No team available";
	        		select.appendChild(x);
	        	}
	    	}
	    };

	    function onTeamChange(dom) {
	    	teamCH.open("GET", "{{asset('employee/dashboard/monitor/team/getMembersByNewTeamId')}}"+dom.value, true);
            teamCH.send();
	    }

	    var teamCH = new XMLHttpRequest();
	    teamCH.onreadystatechange = function() {
	     	if (this.readyState == 4 && this.status == 200) {
	        	var r = JSON.parse(this.responseText);

	        	var select = document.getElementById('monteammember');

	        	if(r.length > 0) {
	        		$("#monteammember option").remove();
	        		Array.from(r).forEach(function(v) {
			        	var option = document.createElement('OPTION');
		        		option.setAttribute('value', v.montmemberid);
		        		option.innerHTML=v.fname+' '+v.lname;

		        		select.appendChild(option);
			        });
	        	} else {
	        		var x = document.createElement('OPTION');
	        		x.setAttribute('disabled', '');
	        		x.innerHTML="No team available";
	        		select.appendChild(x);
	        	}
	    	}
	    };

	</script>

	{{-- Manage --}}
	<div class="modal fade" id="mtMonVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content " style="border-radius: 0px;border: none;">
	    		<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	      			<h5 class="modal-title text-center"><strong>Manage Monitoring Team</strong></h5>
	      			<hr>
	      			<div class="input-group form-inline mb-1 mt-2">
	          			<div class="container">
	          				@isset($AllMonTeam)
	          				@if(count($AllMonTeam) > 0)
	          					@foreach($AllMonTeam as $key => $value)
			          				<div class="row mt-1">
			          					<div class="col-sm-12 bg-success p-2 rounded-top">
			          						<a data-toggle="collapse" href="#collapseExample1{{$key}}" style="text-decoration: none; color: white" onclick="removeExisting('{{$value->montid}}')">
			          							<center><b><span class="text-warning">{{$value->montname}}</span>: {{AjaxController::getRegionById($value->rgnid)->rgn_desc}}</b></center>
			          						</a>
			          					</div>
			          				</div>

			          				<div class="row mb-1" >
			          					<div class="col-sm-12 border border-3 border-success p-2 rounded-bottom" style="color: black; background-color: rgb(200, 200, 200)">
			          						<div class="row collapse" id="collapseExample1{{$key}}">
			          							<div class="container">
			          								<form method="POST" form-id="{{$value->montid}}" name="addMemberLooped" data-parsley-validate>
				          								{{csrf_field()}}

				          								<input type="hidden" name="xteamid" value="{{$value->montid}}">
					          						
					          							<div class="row">
					          								<div class="col-sm-8">
						          								<b>Members:</b>
						          							</div>

						          							<div class="col-sm-4">
						          								<b>Remarks:</b>
						          							</div>
					          							</div>

					          							<div class="row">
					          								<div class="col-sm-8">
						          								<select id="xmembers{{$value->montid}}" class="form-control w-100" multiple onclick="changeRemarks(this)">

						          									@foreach(AjaxController::getAllMonTeamMembers() as $k => $v)
						          										@if($v->montid == $value->montid)
						          											<option value="{{$v->uid}}^{{$v->montmemberid}}">{{$v->fname.' '.$v->mname .' '. $v->lname}}</option>
						          										@endif
						          									@endforeach
						          								</select>
						          							</div>

						          							<div class="col-sm-4">
						          								<textarea class="form-control w-100" rows="4" placeholder="Not available" readonly id="xremarks{{$value->montid}}"></textarea>
						          							</div>
					          							</div>

					          							<hr>

					          							<div class="col-sm-12">
					          								<b>Add member: {{$value->rgnid}}</b>
					          							</div>

					          							<div class="row p-3">

					          								<div class="col-sm-10">
					          									<div class="row">
					          										<div class="col-sm-12">
					          											<select id="xnotmembers{{$value->montid}}" class="form-control w-100" name="teammember" required data-parsley-required-message="<b>*At least one member</b> required" data-parsley="">
								          									@foreach(AjaxController::getAllX08($value->rgnid) as $k => $v)
								          											<option value="{{$v->uid}}">{{$v->fname.' '.$v->lname}}</option>
								          									@endforeach 
								          								</select>
					          										</div>
					          									</div>

					          									<div class="row">
					          										<div class="col-sm-12">
					          											<textarea class="form-control w-100" placeholder="Remarks" name="xtremarks"></textarea>
					          										</div>
					          									</div>	
						          							</div>

						          							<div class="col-sm-2">
						          								<button class="btn btn-success">
						          									<i class="fa fa-plus" aria-hidden="true"></i>
						          								</button>
						          							</div>
					          							</div>
					          						</form>

					          						<hr>

					          						<form method="POST" action="{{asset('employee/dashboard/others/mon_remmonteammember')}}" data-parsley-validate>
					          							{{csrf_field()}}
					          							<input type="hidden" name="xteamid" value="{{$value->montid}}">

					          							<div class="col-sm-12">
					          								<b style="color:red">Remove member:</b>
					          							</div>

					          							<div class="row p-3">

					          								<div class="col-sm-10">

					          									<div class="row">
					          										<div class="col-sm-12">
					          											<select class="form-control w-100" name="teammember" required data-parsley-required-message="<b>*At least one member</b> required" data-parsley="">
								          									@foreach(AjaxController::getAllMonTeamMembers($value->montid) as $k => $v)
								          										@if($v->montid == $value->montid)
								          											<option value="{{$v->uid}}^{{$v->montmemberid}}">{{$v->fname.' '.$v->mname .' '. $v->lname}}</option>
								          										@endif
								          									@endforeach
								          								</select>
					          										</div>
					          									</div>

						          							</div>

						          							<div class="col-sm-2">
						          								<button class="btn btn-danger">
						          									<i class="fa fa-minus" aria-hidden="true"></i>
						          								</button>
						          							</div>
					          							</div>

					          						</form>

			          							</div>
			          						</div>
			          					</div>
			          				</div>
			          			@endforeach
			          		<hr>
			          		@endif
			          		@endisset

			          		<!--///////////////////////////////////////////////////////////////// Add new Team /////////////////////////////////////////////////////-->
			          		<div class="row mt-3">
	          					<div class="col-sm-12 bg-info p-2 rounded-top">
	          						<a data-toggle="collapse" href="#collapseExample" style="text-decoration: none; color: white">
	          							<center><b><i class="fa fa-plus-circle"></i> Add new Team</b></center>
	          						</a>
	          					</div>
	          				</div>

	          				<div class="row mb-1" >
	          					<div class="col-sm-12 border border-3 border-info p-2 rounded-bottom" style="color: black; background-color: rgb(200, 200, 200)">
	          						<div class="row collapse" id="collapseExample">
	          							<div class="container">
	          								<form method="POST" action="{{asset('employee/dashboard/others/mon_addmonteam')}}">
		          								{{csrf_field()}}
			          							<div class="col-sm-4">
			          								<b>Region:<span style="color: red">*</span></b>
			          							</div>
			          							<div class="col-sm-8">
			          								<select class="form-control w-100" name="teamrgn">
			          									@foreach(AjaxController::getAllRegion(true) as $k => $v)
															{{-- @if($emp['rgnid'] == $v->rgnid) --}}
			          										<option value="{{$v->rgnid}}" selected>{{$v->rgn_desc}}</option>
															{{-- @endif --}}
			          									@endforeach
			          								</select>
			          							</div>

			          							<div class="col-sm-4 mt-3">
			          								<b>Team Name:<span style="color: red">*</span></b>
			          							</div>
			          							<div class="col-sm-8 mt-3">
			          								<input class="form-control w-100" type="" name="teamname">
			          							</div>

			          							<div class="col-sm-12 mt-3">
			          								<button class="btn btn-success w-100" type="submit">Add</button>
			          							</div>
			          						</form>
	          							</div>
	          						</div>
	          					</div>
	          				</div>
	          				<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	          				<!--///////////////////////////////////////////////////////////////// Remove Team //////////////////////////////////////////////////////////-->

	          				@if(count($AllMonTeam) > 0)
	          				<hr>
	          				<div class="row mt-3">
	          					<div class="col-sm-12 bg-danger p-2 rounded-top">
	          						<a data-toggle="collapse" href="#collapseExample2" style="text-decoration: none; color: white">
	          							<center><b><i class="fa fa-plus-circle"></i> Remove Team</b></center>
	          						</a>
	          					</div>
	          				</div>

	          				<div class="row mb-1" >
	          					<div class="col-sm-12 border border-3 border-danger p-2 rounded-bottom" style="color: black; background-color: rgb(200, 200, 200)">
	          						<div class="row collapse" id="collapseExample2">
	          							<div class="container">
	          								<form method="POST" action="{{asset('employee/dashboard/others/mon_removemonteam')}}">
		          								{{csrf_field()}}

			          							<div class="col-sm-4 mt-3">
			          								<b>Team Name:<span style="color: red">*</span></b>
			          							</div>
			          							<div class="col-sm-8 mt-3">
			          								<select class="form-control w-100"  name="xxteamname">
			          									<option value="" hidden selected disabled></option>
			          									@isset($AllMonTeam)
	          												@foreach($AllMonTeam as $key => $value)
	          													<option value="{{$value->montid}}">{{$value->montname}}</option>
	          												@endforeach
	          											@endisset
			          								</select>
			          							</div>

			          							<div class="col-sm-12 mt-3">
			          								<button class="btn btn-danger w-100" type="submit">Remove</button>
			          							</div>
			          						</form>
	          							</div>
	          						</div>
	          					</div>
	          				</div>
	          				@endif

	          				<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

	          				{{-- submit btn --}}
		          			<div class="row mt-3">
		            			<div class="col-sm-6">
		              				{{-- <button type="submit" class="btn btn-outline-success w-100"><center>Assign</center></button> --}}
		            			</div>
		            			<div class="col-sm-6">
		              				<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
		            			</div>
		          			</div>
	          			</div>
	      			</div>
	    		</div>
	  		</div>
		</div>
	</div>



	{{-- View --}}
	<div class="modal fade" id="aMonVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  		<div class="modal-content " style="border-radius: 0px;border: none;">
	    		<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	      			<h5 class="modal-title text-center"><strong>Details</strong></h5>
	      			<hr>
	      			<div class="input-group form-inline mb-1 mt-2">
	        			<form class="container" method="POST" action="#">
		          			{{csrf_field()}}

		          			{{-- hfsrbno --}}
				         	<input class="form-control w-100" type="" name="athfsrbno" id="vthfsrbno" hidden>
				         	{{-- appid --}}
				         	<input class="form-control w-100" type="" name="atappid" id="vtappid" hidden>

				         	{{-- date issued --}}
				          	<div class="row mb-3">
				            	<div class="col-sm-5 w-100">
				              		Date Added:
				            	</div>

				            	<div class="col-sm-7 w-100">
				              		<input class="form-control w-100" type="" name="vDate" id="vDate" readonly>
				            	</div>
				          	</div>

				         	{{-- name --}}
				         	<div class="row mb-3">
				         		<div class="col-sm-5 w-100">
				         			Name of Facility:
				         		</div>

				         		<div class="col-sm-7">
				         			<input class="form-control w-100" type="" name="vName" id="vName" readonly>
				         		</div>
				         	</div>

				          	{{-- addr --}}
				          	<div class="row mb-3">
				            	<div class="col-sm-5 w-100">
				              		Location/<br>Address:
				            	</div>

				            	<div class="col-sm-7 w-100">
				              		{{-- <input class="form-control w-100" type="" name="vAddr" id="vAddr" readonly> --}}
				              		<textarea class="form-control w-100" name="vAddr" id="vAddr" rows="4" readonly></textarea>
				            	</div>
				          	</div>

				          	{{-- type --}}
				          	<div class="row mb-3">
				            	<div class="col-sm-5 w-100">
				              		Type of Facility:
				            	</div>

				            	<div class="col-sm-7 w-100">
				              		<input class="form-control w-100" type="" name="vType" id="vType" readonly>
				            	</div>
				          	</div>

		          			{{-- submit btn --}}
		          			<div class="row mt-3">
		            			<div class="col" colspan="6">
		              				{{-- <button type="submit" class="btn btn-outline-success w-100"><center>Assign</center></button> --}}
		            			</div>
		            			<div class="col" colspan="6">
		              				<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
		            			</div>
		          			</div>
	        			</form>
	      			</div>
	    		</div>
	  		</div>
		</div>
	</div>

	<!--{{-- Team --}}
	<div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
	  		<div class="modal-content" style="border-radius: 0px;border: none;">
	    		<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	      			<h5 class="modal-title text-center"><strong>Assign Team</strong></h5>
	      			<hr>
	      			<div class="input-group form-inline mb-1 mt-2">
	        			<form class="container" method="POST" action="{{asset('employee/dashboard/others/mon_addappteam')}}" data-parsley-validate>
		          			{{csrf_field()}}

		          			{{-- appid --}}
				         	<input class="form-control w-100" type="" name="ntappid" id="ntappid" hidden>
				         	{{-- monid --}}
				         	<input class="form-control w-100" type="" name="ntmonid" id="ntmonid" hidden>

				         	{{-- date recom --}}
				         	<div class="row mb-3">
				         		<div class="col-sm-5 w-100">
				         			Date of Inspection:
				         		</div>

				         		<div class="col-sm-7">
				         			<input class="form-control w-100" type="date" name="date" required data-parsley-required-message="<b>*Date</b> required" data-parsley="">
				         		</div>
				         	</div>

				          	<div class="row mb-3 mt-4">
				            	<div class="col-sm-5 w-100">
				              		Team:
				            	</div>

				            	<div class="col-sm-7 w-100 mb-2">
				              		<select id="teams" name="team" class="form-control w-100" data-parsley-required-message="<b>*Team</b> required" required data-parsley="" required onchange="newteamselect(this)">
				              			<option selected hidden disabled value="">Select a team</option>
				              			@isset($AllTeam)
				              				@foreach($AllTeam as $key => $value)
				              					<option value="{{$value->teamid}}">{{$value->teamdesc}}</option>
				              				@endforeach
				              			@endisset
				              		</select>
				            	</div>
				          	</div>

				          	<div class="row mb-3 mt4">
				          		<div class="col-sm-12 w-100">
				          			Members:
				          		</div>

				          		<div class="col-sm-12 w-100">
				          			<textarea id="teammembers" class="form-control w-100" readonly rows="3" placeholder="No members available"></textarea>
				          		</div>
				          	</div>

				          	<div class="row mb-3 mt-4">
				          		<div class="col-sm-5 w-100">
				              		Employees:
				            	</div>

				            	<div class="col-sm-6 w-100">
				              		<select id="newEmployee" class="form-control w-100">
				              			<option selected hidden disabled value="">Select an employee</option>
				              			@isset($WT)
				              				@foreach($WT as $key => $value)
				              					<option value="{{$value->uid}}/{{$value->fname}} {{$value->mname}} {{$value->lname}}^{{$value->position}}" id="{{$value->uid}}{{$key}}">{{$value->fname}} {{$value->mname}} {{$value->lname}}</option>
				              				@endforeach
				              			@endisset
				              		</select>
				            	</div>

				            	<div class="col-sm-1 w-100 mb-2">
				            		<button type="button" class="btn btn-outline-success" onclick="addEmployee('WT')">
				            			<i class="fa fa-plus"></i>
				            		</button>
				            	</div>
				          	</div>

				          	<div class="row mb-3 mt-4">
				          		<div class="col-sm-5 w-100">
				              		Employee/s without Team:
				            	</div>

				            	<div class="col-sm-6 w-100">
				              		<select id="newEmployeeWO" class="form-control w-100">
				              			<option selected hidden disabled value="">Select an employee</option>
				              			@isset($WOT)
				              				@foreach($WOT as $key => $value)
				              					@if($value->fname != "")
				              						<option value="{{$value->uid}}/{{$value->fname}} {{$value->mname}} {{$value->lname}}^{{$value->position}}" id="{{$value->uid}}{{$key}}">{{$value->fname}} {{$value->mname}} {{$value->lname}}</option>
			              						@endif
				              				@endforeach
				              			@endisset
				              		</select>
				            	</div>

				            	<div class="col-sm-1 w-100 mb-2">
				            		<button type="button" class="btn btn-outline-success" onclick="addEmployee('WOT')">
				            			<i class="fa fa-plus"></i>
				            		</button>
				            	</div>
				          	</div>

				          	<hr>

				          	<div class="row mb-2 mt-2">
				          		<div class="col-sm-12 w-100 text-center">
				          			To be Added Members
				          		</div>
				          	</div>

				          	<hr>

				          	<div class="row mb-2 mt-2">
				          		<div class="col-sm-12 w-100 text-center">
				          			<table class="table">
				          				<thead>
				          					<tr>
				          						<th>Name</th>
				          						<th style="width:300px">&nbsp;</th>
				          						<th>&nbsp;</th>
				          					</tr>
				          				</thead>
				          				<tbody id="newTbody">
				          					
				          				</tbody>
				          			</table>
				          		</div>
				          	</div>

				          	<div hidden>
				          		<input name="mon_addteammember" id="mon_addteammember" value="" required data-parsley-required-message="<b>*At least one member</b> required" data-parsley="">
				          	</div>

		          			{{-- submit btn --}}
		          			<div class="row mt-3">
		            			<div class="col" colspan="6">
		              				<button type="submit" class="btn btn-outline-success w-100"><center>Save</center></button>
		            			</div>
		            			<div class="col" colspan="6">
		              				<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Cancel</center></button>
		            			</div>
		          			</div>
	        			</form>
	      			</div>
	    		</div>
	  		</div>
		</div>
	</div>-->
	<script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>

	@include('employee.cmp._othersJS')
	<script>
	
		// $('select').select2({ width: '100%' });

		$("[name=addMemberLooped]").submit(function(event) {
			if($(this).parsley().validate()){
				event.preventDefault();
				let toSendData = $(this).serialize();
				let thisForm = $(this);
				$.ajax({
					method: 'POST',
					url: '{{asset('employee/dashboard/others/mon_addmonteammember')}}',
					data: toSendData,
					success: function(a){
						if(a.length){
							try {
								let data = JSON.parse(a);
								var o = new Option(data['uid'], data['uid']);
								var el = new Option(data['uid'], data['uid']);
								$(o).html(data['fname']);
								$(el).html(data['fname']);
								$('select#xmembers'+$(thisForm).attr('form-id')).append(o);
								thisForm.next().next().find('select').append(el);
								alert('Added Successfully')
							} catch(e) {
								// statements
								alert(a);
							}
						} else {
							console.log(a);
						}
					}
				})
			}
		}); 
	</script>
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif