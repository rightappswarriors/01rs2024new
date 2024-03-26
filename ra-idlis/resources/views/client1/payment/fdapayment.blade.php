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
							<td>{{$fda[1]->hfser_id}}R{{$fda[1]->rgnid}}-{{$fda[1]->appid}}</td>
						</tr>
						<tr>
							<td>FACILITY NAME:</td>
							<td>{{$fda[1]->facilityname}}</td>
						</tr>
						<tr>
							<td>ADDRESS:</td>
							<td>{{ucwords($fda[1]->street_number. " " . $fda[1]->street_name. " ". $fda[1]->brgyname. " ". $fda[1]->cmname)}}</td>
						</tr>
						<tr>
							<td>EMAIL ADDRESS:</td>
							<td>{{$fda[1]->email}}</td>
						</tr>
						<tr>
							<td>CONTACT NUMBER:</td>
							<td>{{$fda[1]->contact. "/ ". $fda[1]->landline}}</td>
						</tr>
						<tr>
							<td>CENTER/DIVISION:</td>
							<td class="font-weight-bold">CDRRHR / RRD</td>
						</tr>
						<tr>
							<td>APPLICATION TYPE:</td>
							<td>{{$fda[1]->aptdesc}}</td>
						</tr>
						<tr>
							<td>PAYABLE TO ACCOUNT NUMBER:</td>
							<td class="font-weight-bold">0392-2220-30</td>
						</tr>
						<tr>
							<td>PAYABLE TO ACCOUNT NAME:</td>
							<td class="font-weight-bold">FDA Devices Clearing Account</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="2" class="text-center font-weight-bold">PAYMENT DETAILS</td>
						</tr>
						<tr>
							<td>NUMBER OF MACHINE / SITE / CLEARANCE:</td>
							<td>{{$fda[2]}}</td>
						</tr>
						<tr>
							<td>SUB TOTAL (WITH LRF):</td>
							<td>&#8369; {{number_format($fda[3],2)}}</td>
						</tr>
						<tr>
							<td>SURCHARGE:</td>
							<td>0</td>
						</tr>
						
						<tr>
							<td>TOTAL:</td>
							<td class="font-weight-bold"><u>&#8369; {{number_format($fda[4],2)}}</u></td>
						</tr>
					</tbody>
				</table>
				<div class="pagebreak">
					TERMS AND CONDITIONS
				</div>
				<div class="container pt-4">
					<div>
						<span><i class="fa fa-check"></i></span>
						<span>Payments shall be made through OnColl payment at the Landbank of the Philippines (LBP) OnColl Payment Facility using the designated <strong class="pl-4">Account No.: <u>0392-2220-30</u></strong> and <strong>Account Name: FDA Devices Clearing Account.</strong></span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>Insufficient payment shall be ground for the disapproval of the application.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>For initial/renewal application, fee paid shall be forfeited when the facility fails to comply with the licensing requirements within the given time <span class="pl-4">frame</span> issued by the FDA.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>The payment of fee is not a guarantee that the application will be granted. The processing of application will still be subject to the evaluation of <span class="pl-4">the</span> concerned FDA personnel and its compliance with pertinent laws, rules and regulations.</span>
					</div>
					<div class="pt-3">
						<span><i class="fa fa-check"></i></span>
						<span>Applicant facility shall follow the corresponding payment procedures and shall pay the applicable non-refundable fee required fees as shown in <span class="pl-4">the</span> matrix of the schedule of fees below.</span>
					</div>
					<div class="pl-4 pt-3">
						<span>2.1 For facilities utilizing x-ray machines for medical/non-medical/dental/educational/veterinary/anti-crime and research applications:</span>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr class="text-center bg-secondary">
								<td class="font-weight-bold">mA RANGE</td>
								<td class="font-weight-bold">INITIAL</td>
								<td><span class="font-weight-bold">RENEWAL</span><br>(Valid LTO)</td>
								<td class="font-weight-bold">Renewal of Expired LTO</td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">1st Month</div>
										<div class="col-2">2nd Month</div>
										<div class="col-2">3rd Month</div>
										<div class="col-2">4th Month</div>
										<div class="col-2">>4 Month</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>100 and below</td>
								<td>810.00</td>
								<td>410.00</td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">1,250.00</div>
										<div class="col-2">1,250.00</div>
										<div class="col-2">1,330.00</div>
										<div class="col-2">1,370.00</div>
										<div class="col-2">1,770.00</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>101 up to 300</td>
								<td>1,111.00</td>
								<td>560.00</td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">1,715.00</div>
										<div class="col-2">1,770.00</div>
										<div class="col-2">1,825.00</div>
										<div class="col-2">1,880.00</div>
										<div class="col-2">2,431.00</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>301 up to 500</td>
								<td>1,414.00</td>
								<td>710.00</td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">2,180.00	</div>
										<div class="col-2">2,250.00</div>
										<div class="col-2">2,320.00</div>
										<div class="col-2">2,390.00</div>
										<div class="col-2">3,094.00</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>501 up to 700</td>
								<td>1,717.00</td>
								<td>860.00</td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">2,645.00</div>
										<div class="col-2">2,730.00</div>
										<div class="col-2">2,815.00</div>
										<div class="col-2">2,900.00</div>
										<div class="col-2">3,757.00</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
							<tr>
								<td>greater than 700</td>
								<td>2,020.00</td>
								<td>1,010.00</td>
								<td>
									<div class="row">
										<div class="offset-1"></div>
										<div class="col-2">3,110.00</div>
										<div class="col-2">3,210.00</div>
										<div class="col-2">3,310.00</div>
										<div class="col-2">3,410.00</div>
										<div class="col-2">4,420.00</div>
										<div class="offset-1"></div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					
{{-- 					<div class="pl-4 pt-3">
						<span>	2.3 For Clearance for Customs Release (CFCR) and Radiofrequency Radiation (RFR) Safety Evaluation</span>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr class="text-center bg-secondary">
								<td>Type of application</td>
								<td>Fee</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Clearance for Customs Release (CFCR)</td>
								<td>175.00 per unit</td>
							</tr>
							<tr>
								<td>RFR Safety Evaluation Report</td>
								<td>900 per site application</td>
							</tr>
						</tbody>
					</table> --}}
					<div class="container pt-3">
						<div class="float-lg-left font-weight-bold">
							{{(isset($fda[1]->payEvalbyFDA) ? 'Evaluated By: '.$fda[1]->payEvalbyFDA : 'Order of Payment not yet verified')}}
						</div>
						<div class="float-lg-right font-weight-bold">
							DATE {{Date('Y-m-d')}}
						</div>
					</div>

					<div class="container pt-3">
						<img src="{{asset('ra-idlis/public/img/fdainstruction.png')}}">	
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		// window.print();
	</script>
</body>
@endsection