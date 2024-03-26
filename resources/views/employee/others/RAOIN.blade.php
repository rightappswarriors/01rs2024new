{{-- @extends('mainEmployee')
@section('title', 'RAOIN')
@section('content') --}}

<!DOCTYPE html>
<html>
<head>
	<title>
		Recommendation Action on Issued Notice of Violation
	</title>
	
	<style type="text/css">
		@media print{
			@page{margin:0;}
			nav:first-child,#wrapper,.card-header, .bg-white, .font-weight-bold{
				display: none!important;
			}
		}
	</style>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<div class="content p-4">
	    <div class="card">
			<div class="card-header bg-white font-weight-bold">
				Recommendation Action on Issued Notice of Violation
				{{-- <a href="{{asset('employee/dashboard/others/monitoring/recommendation')}}"><button type="button" class="btn-primarys"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a> --}}
			</div>
			
			<div class="card-body table-responsive">
				<div class="container">
					<div class="row text-center mb-2">

						<div class="col-sm-4 text-right">
							<img style="width:30%" src="http://uhmis3.doh.gov.ph/fsmm/gallery/content/99_2nd%20Cosultative%20Meeting/DOH.jpg">
						</div>

						<div class="col-sm-4 text-center">
							<div class="row">
								<div class="col-sm-12">
									<b>Republic of the Philippines</b>
								</div>
								<div class="col-sm-12">
									<b>Department of Health</b>
								</div>
								<div class="col-sm-12">
									<b>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</b>
								</div>
							</div>
						</div>
						
					</div>

					<hr>

					<div class="row mb-3 mt-5">
						<div class="col-sm-12 text-center">
							<h5><b><u>RECOMMENDATORY ACTION ON ISSUED NOTICE OF VIOLATION (RAOIN)</u></b></h5>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-2">
							<b><u>Facility Name:</u></b>
						</div>
						<div class="col-sm-10 text-left">
							{{$AllData->name_of_faci}}
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-2">
							<b><u>Address:</u></b>
						</div>
						<div class="col-sm-10 text-left">
							{{$AllData->address_of_faci}}
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-2">
							<b><u>Type of Facility:</u></b>
						</div>
						<div class="col-sm-10 text-left">
							{{$AllData->type_of_faci}}
						</div>
					</div>

					<div class="row mt-5 mb-4">
						<div class="col-sm-12 border border-dark">
							<div class="row p-3">
								<div class="col-sm-4 text-center">
									<input @if($AllData->offense == 1) checked @endif disabled type="checkbox" name=""> First Offense
								</div>

								<div class="col-sm-4 text-center">
									<input @if($AllData->offense == 2) checked @endif disabled type="checkbox" name=""> Second Offense
								</div>

								<div class="col-sm-4 text-center">
									<input @if($AllData->offense == 3) checked @endif disabled type="checkbox" name=""> Third Offense
								</div>
							</div>
						</div>
					</div>

					<div class="row mb-2">
						<div class="col-sm-4 mb-2">
							<b><u>Recommendation:</u></b>
						</div>

						<div class="class-sm-8" style="text-indent: 50px;">
							The written explanation submitted in compliance to the HFSRB NOV No. <u><b>{{$AllData->novid}}</b></u> issued last <u><b>{{\Carbon\Carbon::parse($AllData->date_issued)->format('M d, Y') }}</b></u>, a copy attached for your reference, was evaluated based only on its technical merits. We therefore recommend:
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-1">
							&nbsp;
						</div>
						<div class="col-sm-11">
							<div class="row">
								<div class="col-sm-12">
									<input  @if($AllData->recommendation == 1) checked @endif disabled type="checkbox" name=""> Lifting of the CDO and Suspension Order
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<input @if($AllData->recommendation == 2) checked @endif disabled type="checkbox" name=""> Payment of Fine amounting to P <b>{{$AllData->payment}}</b>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<input @if($AllData->recommendation == 3) checked @endif disabled type="checkbox" name=""> Suspension of License/Accreditation for a period of <b>{{$AllData->suspension}}</b>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<input @if($AllData->recommendation == 4) checked @endif disabled type="checkbox" name=""> Revocation of License/Accreditation 
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<input @if($AllData->recommendation == 5) checked @endif disabled type="checkbox" name=""> Others: <b>{{$AllData->s_ver_others}}</b>
								</div>
							</div>
						</div>
					</div>

					<div class="row mb-4 mt-5">
						<div class="col-sm-4">
							<b><u>SIGNED BY MONITORING TEAM MEMBERS:</u></b>
						</div>

						<div class="col-sm-12">
							@foreach($AllTeam as $k => $v)
								<div class="row text-left mt-5">
									<div class="col-sm-2 w-100 text-center">
										{{$k+1}}
									</div>
									<div class="col-sm-5 w-100">
										{{$v->fname}} {{$v->mname}} {{$v->lname}}
									</div>
									<div class="col-sm-5 w-100">
										{{$v->position}}
									</div>	
								</div>
							@endforeach
						</div>
					</div>

					<div class="row mb-4 mt-5">
						<div class="col-sm-12">
							<b><u>RECOMMENDED BY:</u></b>
						</div>

						<div class="col-sm-12 pt-5">
							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-8">
									<b>TEODORA M. EUGENIO, M.D., MHA</b>
								</div>
								<div class="col-sm-3">
									<b>Date:</b> &nbsp;{{\Carbon\Carbon::parse($AllData->date_issued)->format('M d, Y')}}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-8">
									Medical Officer V
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-8">
									Quality Assurance and Monitoring Division
								</div>
							</div>
						</div>
					</div>

					<hr>

					<div class="row mb-4">
						<div class="col-sm-4">
							<b><u>RECOMMENDATION IS HEREBY:</u></b>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-5">
									<input @if($AllData->verdict == 1) checked @endif disabled type="checkbox" name=""> Approved
								</div>
							</div>

							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-5">
									<input @if($AllData->verdict == 2) checked @endif disabled type="checkbox" name=""> Disapproved
								</div>
							</div>

							<div class="row">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-5">
									<input @if($AllData->verdict == 3) checked @endif disabled type="checkbox" name=""> Others: {{$AllData->s_ver_others}}
								</div>

								<div class="col-sm-5">
									<div class="row">
										<div class="col-sm-12 text-center"><b>ATTY. NICOLAS B. LUTERO III, CESO III</b></div>
									</div>
									<div class="row">
										<div class="col-sm-12 border-bottom border-dark"></div>
									</div>
									<div class="row">
										<div class="col-sm-12 text-center">Director IV</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('employee.cmp._othersJS')
</body>
</html>