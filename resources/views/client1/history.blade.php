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
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb_history')
	@include('client1.cmp.msg')
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<h3>List of History Records (Previous Application Records)</h3>
			</div>
		</div>
	</div>
	<div class="container mb-2">
			<div class="row">
				<div class="col-sm-4">
					
				</div>
				<div class="col-sm-4">
					@isset($legends)
					<div class="legend">
					    <h4>Legend</h4>
					    <ul>
					    	@foreach($legends as $legend)
					        <li><span style="background-color: {{$legend->color}}"></span>{{$legend->trns_desc}}</li>
					        @endforeach
					    </ul>
					 </div>
					@endisset
				</div>
				<div class="col-md-4">

				</div>
			</div>
	</div>
	<div  style="background: #fff;padding-left: 25px;padding-right: 25px;padding-top: 0;padding-bottom: 0;">
	<!-- <div  style="background: #fff;padding: 25px;"> -->
		<div style="overflow-x: scroll; min-height: 50%" >
			<table class="table table-bordered" id="tAppCl" style="border-bottom: none;border-collapse: collapse;">
				<thead class="thead-dark">
					<tr>
						<th style="white-space: nowrap;" class="text-center">Process & <br/>Type of Application</th>
						<th style="white-space: nowrap;" class="text-center">Application <br/> Code</th>
						<th style="white-space: nowrap;" class="text-center">Facility Name & Owner of Facility</th>
						<th style="white-space: nowrap;" class="text-center">Facility Type</th>
						<th style="white-space: nowrap;" class="text-center">Date Created</th>
						<th style="white-space: nowrap;" class="text-center">Date of Application<br/>Submitted</th>
					</tr>
				</thead>
				<tbody id="homeTbl">
					@if(isset($appDet)) 
						@if(is_array($appDet)) 
							@foreach($appDet AS $each) 
								@if($each[0]->canapply == $each[0]->canapply) 
								<?php 
									$_payment = "bg-info"; 
									
									if(count($each[1]) > 0) { $_payment = "bg-info"; } $_percentage = ""; 

									if(intval($each[2][0]) < 100) 
									{ 
										if(intval($each[2][0]) > 0) { $_percentage = "warning"; } 
										else { $_percentage = "danger"; } 
									} else { $_percentage = "success"; }
								?>
								<?php $_tColor = (($each[0]->canapply == 0) ? "success" : (($each[0]->canapply == 1) ? "warning" : "primary")); ?>

									<tr>
										<td class="text-center">
											<strong>@if ($each[0]->aptid == 'IN') Initial New @elseif ($each[0]->aptid == 'R') Renewal @else Initial Change @endif</strong>
											<br/>{{$each[0]->hfser_desc}}
										</td>
										<td class="text-center">
											{{$each[0]->hfser_id}}R{{$each[0]->rgnid}}-{{$each[0]->appid}}
											@isset($each[0]->nhfcode)<br/><strong style="font-size:smaller">NHFR Code:<br/><strong>{{$each[0]->nhfcode}}</strong></span>
											@endisset
										</td>
										<td style="height: auto;" class="text-center">
											<strong>{{$each[0]->facilityname}}</strong>
											<br/><span style="font-size:smaller">Owner: <span style="color:#228B22;">{{$each[0]->owner}}</span></span>											
										</td>
										<td style="height: auto;" class="text-center">
											<strong>{{$each[0]->hgpdesc}}</strong>										
										</td>
										<td style="height: auto;" class="text-center">
											@isset($each[0]->created_at)<br/><span style="font-size:smaller"><strong>{{$each[0]->created_at}}</strong></span>
											@else <br/><span style="font-size:smaller; color:red">Not officially applied yet.</span>
											@endisset
										</td>
										<td style="height: auto;" class="text-center">
											@isset($each[0]->t_date)<br/><span style="font-size:smaller"><strong>{{$each[0]->t_date}}</strong></span>
											@else <br/><span style="font-size:smaller; color:red">Not officially applied yet.</span>
											@endisset
										</td>
									</tr>
								@endif 
							@endforeach 
						@endif 
					@else
						<tr>
							<td colspan="13">No application applied yet.</td>
						</tr>
					@endif					
				</tbody>
			</table>
		</div>
	</div>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {	$('[data-toggle="tooltip"]').tooltip()	});
		$(document).ready( function () {
			$('#tApp').DataTable({
				"ordering": false,
				"lengthMenu": [10, 20, 50, 100]
			});
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');

		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
			$('#tAppCl').DataTable({
				"ordering": false,
				"lengthMenu": [10, 20, 50, 100]
			});
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>
@include('client1.cmp.footer')
</body>
@endsection

<script>
	function subProofPay(appid){

		document.getElementById("uppp-"+appid).addEventListener("submit", function(event){	event.preventDefault()	});		
		var form =	document.forms["uppp-"+appid].getElementsByTagName("input");
		
		if(form[0].value != ""){
			if(confirm("Are you sure you want to send your proof of payment?")){			
				$(document).on('submit','#uppp'+appid,function(event){
					event.preventDefault();
					let data = new FormData(this);
					console.log("data")
					console.log(data)
					$.ajax({
						url: '{{asset('client1/sendproofpay')}}',
						type: 'POST',
						contentType: false,
						processData: false,
						data:data,
						success: function(a){
							console.log("a")
							// if(a == 'DONE'){ alert('Successfully Edited Personnel');	location.reload(); } else { console.log(a); }
						},
						fail: function(a,b,c){
							console.log([a,b,c]);
						}
					})
				})
			// $.ajax({
			// 		url: '{{asset('client1/sendproofpay')}}',
			// 		// dataType: "json", 
			// 		async: false, type: 'POST', data:subs, cache: false, contentType: false, processData: false,
			// 		success: function(a){ console.log(a.msg)} 
			//});
			}
		}		
	}
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />