@extends('mainEmployee')
@section('title', 'Monitoring Evaluation')
@section('content')
  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/monitoring')}}">Monitoring Entry</a> / <a href="{{asset('employee/dashboard/others/monitoring/teams')}}">  Assignment of Team</a> / <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">Inspection</a> / <a href="{{asset('employee/dashboard/others/monitoring/recommendation')}}">Recommendation </a> / Evaluation / Send Letter
	      	</div>
	      	<div class="card-body table-responsive">
	        	<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">NOV No.</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Facility Code</th>
	        				<th scope="col" style="text-align: center; width:auto">Recommendation</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Recommended</th>
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				@foreach($AllData as $key => $value)
			        			<tr>
			        				<td style="text-align:center">{{$value->monid}}</td>
			        				<td style="text-align:center">{{$value->hfsrbno}}</td>
			        				<td style="text-align:center">{{$value->name_of_faci}}</td>
			        				<td style="text-align:center">{{$value->type_of_faci}}</td>
			        				<td style="text-align:center">{{$value->recommendation}}</td>
			        				<td style="text-align:center">{{ \Carbon\Carbon::parse($value->date_recom)->format('M d, Y') }}</td>
			        				<td style="text-align:center">
			        					<button type="button" class="btn btn-outline-info" title="View {{$value->name_of_faci}}">
			                            	<i class="fa fa-eye" aria-hidden="true"></i>
				                        </button>

			        					<button type="button" class="btn btn-outline-dark" title="Open {{$value->name_of_faci}}'s LOE">
			                            	<i class="fa fa-envelope" aria-hidden="true"></i>
				                        </button>

				                        <button type="button" class="btn btn-outline-primary" title="Evaluate {{$value->name_of_faci}}">
				                        	<i class="fa fa-fw fa-clipboard-check"></i>
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