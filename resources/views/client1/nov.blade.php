@extends('main')
@section('content')
@include('client1.cmp.__nov')
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.msg')
	<div class="container-fluid mt-5 mb-5">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				<center>Notice of Violation</center>
			</div>
			<div class="card-body table-responsive">
				<div class="container">

					<div class="row text-center mb-5">
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
									<h4><b>OFFICE OF THE SECRETARY</b></h4> 
								</div>
							</div>
						</div>
						<div class="col-sm-4 text-left">
							<img style="width:30%" src="http://uhmis3.doh.gov.ph/fsmm/gallery/content/99_2nd%20Cosultative%20Meeting/DOH.jpg">
						</div>	
					</div>

					<div class="row text-left">
						<div class="col-sm-4">Control No. <b>{{str_pad($Nov->novid, 8, "0", STR_PAD_LEFT)}}</b></div>
						<div class="col-sm-8 w-100">&nbsp;</div>
					</div>

					<div class="row text-center mt-2 mb-4">
						<div class="col-sm-12 text-center"><h4><b><u>NOTICE OF VIOLATION</u></b></h4></div>
					</div>

					<div class="row text-center mb-4">
						<div class="col-sm-8">&nbsp;</div>
						<div class="col-sm-4 w-100">Date: <b>{{\Carbon\Carbon::parse($Nov->novdate)->format('M d, Y')}}</b> </div>
					</div>

					<div class="row mb-4">
						<div class="col-sm-4">Dear <b>{{$Nov->novauthorizedsign}}</b>:</div>
						<div class="col-sm-8 w-100">&nbsp;</div>
					</div>

					<div class="row text-left">
						<div class="col-sm-12" style="text-indent: 50px;">
							The result of the visit <u><b>{{$Nov->novtype}}</b></u> done by our licensing officers revealed that you have incurred specific violation/s to the terms and conditions indicated below, the particulars of which are written in the attached report/s you were furnished with.
						</div>

						<div class="col-sm-12 mt-5" style="text-indent: 50px;">
							You are therefore directed to:
						</div>

						<div class="col-sm-12 mt-4" style="text-indent: 50px;">
							<input disabled name="novcheck" type="checkbox" @if($Nov->novdire == 1) checked @endif> Submit a letter of explanation within three (3) days from receipt of this notice
						</div>
						<div class="col-sm-12" style="text-indent: 50px;">
							<input disabled name="novcheck"type="checkbox" @if($Nov->novdire == 2) checked @endif> Cease and Desist from Operating <br>
						</div>
						<div class="col-sm-12" style="text-indent: 50px;">
							<input disabled name="novcheck" type="checkbox" @if($Nov->novdire == 3) checked @endif> Others (Pls. specify)
						</div>
						<div class="col-sm-12" style="text-indent: 50px;">
							<textarea readonly class="w-100 text-indent pl-5" type="" name="" style="border: none; border-bottom: ridge; font-size: 13px;" rows="1">{{$Nov->novdireext}}</textarea>
						</div>

						<div class="col-sm-8 w-100 mt-5" style="text-indent: 50px;">
							<b>For strict and immediate compliance.</b>
						</div>
					</div>

					<div class="row text-left mt-5">
						<div class="col-sm-8 w-100">
							<b>SERVED BY:</b>
						</div>
					</div>

					<div class="row text-left mt-5">
						<div class="col-sm-2 w-100">
							&nbsp;
						</div>
						<div class="col-sm-5 w-100">
							(Name and Signature of Licensing Officers)
						</div>
						<div class="col-sm-5 w-100">
							(Designation)
						</div>	
					</div>

					@foreach($novTeams as $k => $v)
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

					<div class="row text-left mt-5" style="margin-top: 100px !important;">
						<div class="col-sm-2 w-100">
							<b>RECEIVED BY:</b>
						</div>
						<div class="col-sm-5 w-100">
							<div class="row">
								<div class="col-sm-12 border-bottom border-dark text-center">
									<b>{{$Nov->novauthorizedsign}}</b>
								</div>
								<div class="col-sm-12 text-center">
									(Signature over Printed Name)
								</div>
							</div>
						</div>
						<div class="col-sm-2 w-100 text-right">
							<b>Date Time:</b>
						</div>
						<div class="col-sm-3">
							<div class="row">
								<div class="col-sm-12 border-bottom border-dark text-center">
									<b>{{\Carbon\Carbon::parse($Nov->novdate)->format('M d, Y')}}</b>
								</div>
								<div class="col-sm-12 text-center">
									&nbsp;
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>