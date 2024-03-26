@extends('main')
@section('content')
@include('client1.cmp.__payment')
<body>
	<style type="text/css">
	.pagebreak { page-break-before: always; }
	.table-bordered td{
	   /*border-color: black;*/
	   border:2px solid black;
	}
	@media print{
		.pagebreak{
			padding-top:30px;
		}
	}
	
	</style>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-3">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-6 text-center">
			            <p> Republic of the Philippines</p>
			            <p> DEPARTMENT OF HEALTH</p>
			            <p class="font-weight-bold">Food and Drug Administration</p>
			            <p>Civic Drive, Filinvest Corporate City</p>
			            <p>Alabang, Muntinlupa City</p>
			            <p class="pt-5 font-weight-bold">ORDER OF PAYMENT</p>
					</div>
					<div class="col-3">
		            	<img class="w-75 pt-4" src="{{asset('ra-idlis/public/img/fda.png')}}" alt="FDA LOGO" style="float: left; max-height: 118px;">
		          	</div>
				</div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>REFERENCE NUMBER:</td>
							<td>{{$fda[0]->hfser_id}}R{{$fda[0]->rgnid}}-{{$fda[0]->appid}}</td>
						</tr>
						<tr>
							<td>FACILITY NAME:</td>
							<td>{{$fda[0]->facilityname}}</td>
						</tr>
						<tr>
							<td>ADDRESS:</td>
							<td>{{ucwords($fda[0]->street_number. " " . $fda[0]->street_name. " ". $fda[0]->brgyname. " ". $fda[0]->cmname)}}</td>
						</tr>
						<tr>
							<td>EMAIL ADDRESS:</td>
							<td>{{$fda[0]->email}}</td>
						</tr>
						<tr>
							<td>CONTACT NUMBER:</td>
							<td>{{$fda[0]->contact. (isset($fda[0]->landline) ?"/ ". $fda[0]->landline : '')}}</td>
						</tr>
						<tr>
							<td>CENTER/DIVISION:</td>
							<td class="font-weight-bold">CDRR</td>
						</tr>
						<tr>
							<td>APPLICATION TYPE:</td>
							<td>{{$fda[0]->aptdesc}}</td>
						</tr>
						<tr>
							<td>PAYABLE TO ACCOUNT NUMBER:</td>
							<td class="font-weight-bold">0392-2220-14</td>
						</tr>
						<tr>
							<td>PAYABLE TO ACCOUNT NAME:</td>
							<td class="font-weight-bold">FDA Drugs Clearing Account</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>
								Total Pharmacies
								@isset($fda[3])
								@isset($fda[3][0])

								<div class="container">
									Main: {{$fda[3][0]}}
								</div>

								@endisset

								@isset($fda[3][1])

								<div class="container">
									Sattelite: {{$fda[3][1]}}
								</div>

								@endisset

								@endisset
							</td>
							<td class="font-weight-bold pt-5">
								{{$fda[1]}}
							</td>
						</tr>
						<tr>
							<td> <span><i class="fa fa-question pr-3" data-toggle="tooltip" data-placement="left" title="LRF is not inclusive in total amount"></i></span>LRF:</td>
							<td>&#8369; {{number_format($fda[4],2)}}</td>
						</tr>
						<tr>
							<td>
								Total Payment
							</td>
							<td class="font-weight-bold">
								&#8369;{{number_format($fda[2] + $fda[4])}}
							</td>
						</tr>
					</tbody>
				</table>
				<div class="container pt-4">
					<div>
						<span><i class="fa fa-check"></i></span>
						<span>Payments shall be made through OnColl payment at the Landbank of the Philippines (LBP) OnColl Payment Facility using the designated <strong class="">Account No.: <u>0392-2220-14</u></strong> and <strong>Account Name: FDA Drugs Clearing Account.</strong></span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>Insufficient payment shall be ground for the disapproval of the application.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>For initial/renewal application, fee paid shall be forfeited when the facility fails to comply with the licensing requirements within the given time <span class="">frame</span> issued by the FDA.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>The payment of fee is not a guarantee that the application will be granted. The processing of application will still be subject to the evaluation of <span class="">the</span> concerned FDA personnel and its compliance with pertinent laws, rules and regulations.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>Applicant facility shall follow the corresponding payment procedures and shall pay the applicable non-refundable fee required fees as shown in <span class="">the</span> matrix of the schedule of fees below.</span>
					</div>

					<div class="pt-3">
						<img src="{{asset('ra-idlis/public/img/fdainstruction.png')}}">	
					</div>

					
			</div>
		</div>
	</div>
	<script>
		// window.print();
	</script>
</body>
@endsection