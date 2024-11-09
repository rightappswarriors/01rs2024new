@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style type="text/css">
	.legend {
	  background-color: #fff;
	  left: 80px;
	  padding: 20px;
	  border: 1px solid;
	}
	.legend h4 {
	  text-transform: uppercase;
	  font-family: sans-serif;
	  text-align: center;
	}
	.legend ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	.legend li { padding-bottom: 5px; }
	.legend span {
	  display: inline-block;
	  width: 12px;
	  height: 12px;
	  margin-right: 6px;
	}
	.ddi{
		color: #fff;
	}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb_msg')
	@include('client1.cmp.msg')
	<div class="container mb-2">
		{{-- <div class="row">
			<div class="col-sm-4">
				<button class="btn btn-info btn-block" style="text-decoration: none;color:#fff;" data-toggle="modal" data-target="#applicationTypeModal" >
					Create New Messages
				</button>				
			</div>
			<div class="col-sm-4">

			</div>
			<div class="col-md-4">
				
			</div>
			<div class="col-md-8"></div>
		</div> --}}
	</div>
	<div class="card" style="background: #fff;padding-left: 25px;padding-right: 25px;padding-top: 0;padding-bottom: 0;">
	<!-- <div  style="background: #fff;padding: 25px;"> -->
		<div class="card-body table-responsive" style="overflow-x: scroll; min-height: 50%" >
			<div>
				<table class="table table-hover"  id="example" style="border-bottom: none;border-collapse: collapse;">
					<thead class="thead-dark">
						<tr>
							<th style="white-space: wrap; width:100px;" class="text-center">Options</th>
							<th style="white-space: nowrap; width:150px;" class="text-center">Date/Time</th>
							<th style="white-space: nowrap; width:150px;" class="text-center">Application Code</th>
							<th style="white-space: nowrap;" class="text-center">Messages</th>
						</tr>
					</thead>
					<tbody id="FilterdBody">
						@if(isset($msg_arr) ) 
							@if(count($msg_arr) > 0) 
								@foreach($msg_arr AS $key => $value) 
									@if($key == "data")
										@foreach($value AS $each)
										<tr>
											<td class="text-center">  
												<a title="View Details" class="btn btn-info form-control" href="{{$each->adjustedlink}}"><i class="fa fa-fw fa-eye"></i></a>
											</td>
											<td class="text-center">{{$each->adjustedmonth}}<br/><span style="font-size: smaller;">{{$each->notifdatetime}}</span></td>
											<td class="text-center">{{$each->appid}}</td>
											<td class="text-center"><a href="{{$each->adjustedlink}}" @if($each->status==0) style="color:black; font-weight: bold" @else style="color:gray;" @endif>{{$each->msg_desc}}</a></td>
										</tr>					
										@endforeach 	
									@endif						
								@endforeach 
							@else
								<tr>
									<td colspan="3">No application applied yet.</td>
								</tr>
							@endif	
						@else
							<tr>
								<td class="text-center" colspan="3">No Records Found.</td>
							</tr>
						@endif						
					</tbody>
					<tfoot class="thead-dark">
						<tr>
							<th style="white-space: wrap; width:100px;" class="text-center">Options</th>
							<th style="white-space: nowrap; width:150px;" class="text-center">Date/Time</th>
							<th style="white-space: nowrap; width:150px;" class="text-center">Application Code</th>
							<th style="white-space: nowrap;" class="text-center">Messages</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
@include('client1.cmp.footer')
</body>
@endsection

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />