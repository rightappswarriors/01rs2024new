@extends('mainEmployee')
@section('title', 'Surveillance Inspection')
@section('content')
  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/surveillance')}}">Surveillance Entry</a> / <a href="{{asset('employee/dashboard/others/surveillance/teams')}}">  Assignment of Team</a> / Inspection / <a href="{{asset('employee/dashboard/others/surveillance/recommendation')}}">Recommendation </a>
	      	</div>
	      	<div class="card-body table-responsive">
	        	<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Added</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Facility Code</th>
	        				<th scope="col" style="text-align: center; width:auto">Status</th>
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				@foreach($AllData as $key => $value)
			        			<tr>
			        				<td style="text-align:center">{{$value->survid}}</td>
			        				<td style="text-align:center">{{ \Carbon\Carbon::parse($value->date_added)->format('M d, Y') }}</td>
			        				<td style="text-align:center">{{$value->name_of_faci}}</td>
			        				<td style="text-align:center">{{$value->type_of_faci}}</td>
					                @if($value->isApproved == "1")
										<td style="text-align:center;" class="bg-success text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('A')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->isFinePaid != "" )
										<td style="text-align:center;" class="bg-info text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('PP')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->recommendation != "")
										<td style="text-align:center;" class="bg-primary text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FPE')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->assessmentStatus != "")
										<td style="text-align:center;" class="bg-warning text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FA')[0]->trns_desc}}
											</span>
										</td> 
									@elseif($value->team != "")
										<td style="text-align:center;" class="bg-danger text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FI')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->team == "")
										<td style="text-align:center;" class="bg-secondary text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('NT')[0]->trns_desc}}
											</span>
										</td>
									@endif
			        				<td style="text-align:center">
			        					@php
				                          $url = 'employee/dashboard/processflow/assessment/'.$value->survid.'/SURV/'.$value->type_of_faci;
				                        @endphp
				                        <button class="btn btn-outline-primary" title="Inspect {{$value->name_of_faci}}" onclick="window.location.href='{{url($url)}}'">
				                          <i class="fa fa-search" aria-hidden="true"></i>
				                        </button>
			        				</td>
			        			</tr>
			        		@endforeach
		        		@endisset
	        		</tbody>
	        	</table>
	    	</div>
		</div>
	</div>


	@include('employee.cmp._othersJS')
@endsection