@section('title')
COC - FDA
@endsection
@extends('main')
@section('content')
@include('client1.cmp.__payment')
<body>
	<style type="text/css">
		table, thead, tbody, tr,td,th{
			border:1px solid black!important;
		}
		@media print {
			.hidePrint {
				visibility: hidden;
			}
			@page { margin: 0; } body { margin: 1.6cm; }
			.pagebreak { page-break-before: always; }
		}
		.table th{
			vertical-align : middle;text-align:center!important;
		}
	</style>
	<div class="container mt-5 mb-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-8">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">FOOD AND DRUG ADMINISTRATION</h5>
						<h5 class="card-title text-center">Filinvest Corporate City</h5>
						<h5 class="card-title text-center">Alabang, City of Muntinlupa</h5>
					</div>
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/fda.png')}}" class="img-fluid" style="float: left; padding-right: 30px; margin-top: 30px;">
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="offset-7 container mt-4 mb-4 font-weight-bold">
					<div class="row">
						<div class="col-md-3 text-right">Authorization Status :</div>
						{{-- <div class="col-md-1">:</div> --}}
						<div class="col-md-6">{{$data->authorizationStatus}}</div>
					</div>
					<div class="row pt-1">
						<div class="col-md-3 text-right">CDRRHR-RRD-COC No. :</div>
						{{-- <div class="col-md-1">:</div> --}}
						<div class="col-md-6">{{$data->cocNo}}</div>
					</div>
					{{-- <div class="row pt-1">
						<div class="col-md-5">Warehouse Address</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->warehouse}}</div>
					</div>
					<div class="row pt-1">
						<div class="col-md-5">Owner</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->owner}}</div>
					</div>
					<div class="row pt-1">
						<div class="col-md-5">Pharmacist/Allied Profession</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->allied}}</div>
					</div> --}}
					{{-- <div class="row pt-1">
						<div class="col-md-5">Name of Owner</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->authorizedsignature}}</div>
					</div> --}}
				</div>
				<div class="container text-center pt-3 font-weight-bold" style="font-size: 30px;"><u>CERTIFICATE OF COMPLIANCE</u></div>

				<div class="container text-justify mt-5">
					This certificate of compliance is hereby issued to:
				</div>

				<div class="container mt-5">
					<div class="font-weight-bold text-center display-4">
						{{$data->facilityname}}
					</div>
					<div class="text-justify mt-4">
						with business address at <u class="font-weight-bold">{{$data->street_number . ' ' .$data->street_name . ' ' . AjaxController::getAddressByLocation($data->rgnid,$data->provid,$data->cmid,$data->brgyid)}}</u> for having complied with the relevant administrative order/s issued
						by the Department of Health on the Basic Standards on Radiation Protection by the Center for Device Regulation,
						Radiation Health, and Research (CDRRHR) of the Food and Drug Administration, Department of Health.
						This certificate is the basis of the HFSRB/ROs for the inclusion of the medical x-ray facility in the license to
						operate/certificate of accreditation of facilities under the one-stop-shop licensure system.
						The facility shall report to the CDRRHR/HFSRB in writing any change/s affecting the condition/s of this
						certificate of compliance (COC). This certificate is valid until <span class=" font-weight-bold"> <u>December 31, {{Date('Y',strtotime($data->issuedate))}}</span></u> , provided no change/s on the
						condition of this COC has been made.
					</div>
					<div class="text-justify mt-4 font-weight-bold">
						Given in Manila, Philippines this {{Date('F j, Y',strtotime($data->issuedate))}}.
					</div>
				</div>

				<div class="container mt-5">
					<div class="row">
						<div class="offset-3 col-md">
							<div class="float-right">
								<div class="contianer font-weight-bold mb-4">
									BY AUTHORITY OF THE DIRECTOR-GENERAL:<br>
								</div>
								<div class="container text-center">
									<span class="text-center font-weight-bold">
										MARIA CECILIA C. MATIENZO
									</span>
									<br>
									<span class="text-center">
										Director IV
									</span>
									<br>
									<span class="text-center">
										Center for Device Regulation, Radiation Health, and Research
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="container mt-5 mb-5">
					<div class="text-justify mt-4 font-weight-bold">
						<div class="row">
							<div class="col-md-4">Name of Owner / Legal Person</div>
							<div class="col-md-1">:</div>
							<div class="col-md-5">{{$data->owner}}</div>
						</div>
					</div>
				</div>

				
				<div class="container mt-5 pagebreak">
					<div class="container text-center ">
						ADDITIONAL INFORMATION:<br>
						{{$data->facilityname}}<br>
						{{Date('F j, Y',strtotime($data->issuedate))}}
					</div>
					<div class="container">
						<span class="font-weight-bold">Authorized Personnel:</span>
						<div class="container mt-4 mb-4">
							<div class="row">
								<div class="col-md-4">
									Head of the Radiology:
								</div>
								<div class="col-md font-weight-bold">{{$required['required2']}}</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									Chief of X-ray Technologist:
								</div>
								<div class="col-md font-weight-bold">{{$required['required1']}}</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									Radiation Protection Officer:
								</div>
								<div class="col-md font-weight-bold">{{$required['required3']}}</div>
							</div>
						</div>
						<span class="font-weight-bold">Machine Data:</span>
						<div class="container mt-4 mb-4 table-responsive">
							<table class="table">


							
								<thead>
									<tr>
										<th rowspan="2" >Manufacturer (Control Console/Tube)</th>
										<th rowspan="2">Maximum mA</th>
										<th rowspan="2">Maximum kVp</th>
										<th colspan="2">Serial No.</th>
										<th rowspan="2">Application/Use</th>
									</tr>
									<tr>
										<th>Control Console</th>
										<th>Tube</th>
									</tr>
								</thead>
								<tbody>
									@isset($machineData)
										@foreach($machineData as $mData)
										<tr>
											<td>{{$mData->brandtubehead}}</td>
											<td>{{$mData->maxma}}</td>
											<td>{{$mData->maxkvp}}</td>
											<td>{{$mData->serialtubehead}}</td>
											<td>{{$mData->serialconsole}}</td>
											<td></td>
										</tr>
										@endforeach
									@endisset
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		// window.print();
	</script>
</body>
@endsection