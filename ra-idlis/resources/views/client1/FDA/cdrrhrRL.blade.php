@section('title')
RL - FDA
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
				<div class="offset-6 container mt-4 mb-4 font-weight-bold">
					<div class="row">
						<div class="col-md-2">RL NO.</div>
						<div class="col-md-1">:</div>
						<div class="col-md-5">{{$data->rlNo}}</div>
					</div>
				</div>
				<div class="container text-center pt-3 font-weight-bold" style="font-size: 30px;"><u>RECOMMENDATION LETTER</u></div>
				<div class="container mt-4">
					<span style="font-weight: 50em;">This is to recommend approval of request of license to operate of:</span>
				</div>

				<div class="container mt-4 font-weight-bold">
					<div class="row">
						<div class="col-md-5">Name of Establishment</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->facilityname}}</div>
					</div>
					<div class="row pt-1">
						<div class="col-md-5">Address</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->street_number . ' ' .$data->street_name . ' ' . AjaxController::getAddressByLocation($data->rgnid,$data->provid,$data->cmid,$data->brgyid)}} </div>
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
					<div class="row pt-1">
						<div class="col-md-5">Name of Owner / Legal Person</div>
						<div class="col-md-1">:</div>
						<div class="col-md-6">{{$data->owner}}</div>
					</div>
				</div>

				<div class="container text-justify font-weight-bold mt-5">
					The facility has satisfactorily complied with the documentary requirements particularly for:
				</div>

				<div class="container mt-5 font-weight-bold text-justify">
					<table class="table">
						<thead>
							<tr>
								<td>Type of Application</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="pl-5">{{$data->aptdesc}}</td>
							</tr>
						</tbody>
					</table>
				</div>

{{-- 				<div class="container mt-5 font-weight-bold text-center">
					<table class="table">
						<thead>
							<tr>
								<td>Type of Establishment</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$data->estype}}</td>
							</tr>
						</tbody>
					</table>
				</div> --}}

				<div class="container mt-5 font-weight-bold text-center">
{{-- 					<table class="table">
						<tr>
							<th>{{$data->otherestype}}</th>
						</tr>
					</table> --}}
					<div class="container mt-5 font-weight-bold text-left">
						Issued this <u>{{Date('jS',strtotime($data->issuedate))}}</u> day of <u>{{Date('F Y',strtotime($data->issuedate))}}</u>
					</div>
				</div>
				
				<div class="container mt-5 text-center">
					<div class="row">
						<div class="col-md-6">
							{{$data->dtn}}
						</div>
						<div class="col-md-6">
							<div class="float-right">
								<div class="container">
									<span class="text-center font-weight-bold">
										ATTY. EMILIO L. POLIG, JR.
									</span>
									<br>
									<span class="text-center">
										Director.
									</span>
									<br>
									<span class="text-center">
										Field Regulatory Operation Office.
									</span>
								</div>
							</div>
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
									Head of the Facility:
								</div>
								<div class="col-md">{{$data->headFaci}}</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									Chief Radiologic Technologist:
								</div>
								<div class="col-md">{{$data->chiefRadioTechno}}</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									Radiation Protection Officer:
								</div>
								<div class="col-md">{{$data->radProOff}}</div>
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
				
				<div class="container mt-5 text-center">
					<div class="row">
						<div class="col-md-6">
							{{$data->dtn}}
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