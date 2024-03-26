{{-- @extends('mainEmployee')
@section('title', 'Notice of Violation')
@section('content') --}}

<!DOCTYPE html>
<html>
<head>
	<title>
		Notice of Violation
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
				Notice of Violation
				{{-- <a href="{{asset('employee/dashboard/others/monitoring/recommendation')}}"><button type="button" class="btn-primarys"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a> --}}
			</div>
			@isset($Nov)
				{{-- @foreach($Nov as $key => $value) --}}
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
								{{-- <div class="col-sm-4 text-left">
									<img style="width:30%" src="http://uhmis3.doh.gov.ph/fsmm/gallery/content/99_2nd%20Cosultative%20Meeting/DOH.jpg">
								</div>	 --}}
							</div>

							<div class="row text-left">
								<div class="col-sm-4"><b>Control No. {{$Nov->nov_num}}</b></div>
								<!-- <div class="col-sm-4"><b>Control No. {{$Nov->novid}}</b></div> -->
								<div class="col-sm-8 w-100">&nbsp;</div>
							</div>

							<div class="row text-center mt-2 mb-4">
								<div class="col-sm-12 text-center"><h4><b><u>NOTICE OF VIOLATION</u></b></h4></div>
							</div>

							<div class="row text-center mb-4">
								<div class="col-sm-8">&nbsp;</div>
								<div class="col-sm-4 w-100"><b> {{\Carbon\Carbon::parse($Nov->novdate)->format('M d, Y')}}</b> </div>
							</div>

							<div class="row mb-4">
								<div class="col-sm-4"><b>Dear {{$Nov->novauthorizedsign}}:</b></div>
								<div class="col-sm-8 w-100">&nbsp;</div>
							</div>

							<div class="row text-left">
								<div class="col-sm-12" style="text-indent: 50px;">
									The result of the {{$Nov->novtype}} {{-- done --}} conducted by our licensing officers{{--revealed--}} shows that you have incurred specific violation/s to the terms and conditions indicated below, the particulars of which are written in the attached report/s you were furnished with.
								</div>

								<div class="col-sm-12 mt-5" style="text-indent: 50px;">
									You are therefore directed to:
								</div>
								@isset($NovAll)
								@foreach($NovAll as $nov)

								@isset($arrNov)
								@if(in_array($nov->novid_directions, $arrNov))
								<div class="col-sm-12 mt-4" style="text-indent: 50px;">
									<input id="{{$nov->novid_directions}}" disabled name="{{$nov->novid_directions}}" type="checkbox"> {{$nov->novdesc}}
								</div>
								@if($nov->novextra != null)
								<div class="col-sm-12" style="margin-left: 48px; text-indent: 50px;">
									{!!$nov->novextra!!}
								</div>
								@endif
								@endif

								@endisset
								@endforeach
								@endisset
								
								{{-- <div class="col-sm-12" style="text-indent: 50px;">
									<input disabled name="novcheck"type="checkbox" @if(!!preg_match('#\\b' . preg_quote($Nov->novdire, '#') . '\\b#i', '2')) checked @endif> Cease and Desist from Operating <br>
								</div>
								<div class="col-sm-12" style="text-indent: 50px;">
									<input disabled name="novcheck" type="checkbox" @if(!!preg_match('#\\b' . preg_quote($Nov->novdire, '#') . '\\b#i', '3')) checked @endif> Others (Pls. specify)
								</div>
								<div class="col-sm-12" style="text-indent: 50px;">
									<textarea readonly class="w-100 text-indent pl-5" type="" name="" style="border: none; border-bottom: ridge; font-size: 13px;" rows="1">{{$Nov->novdireext}}</textarea>
								</div> --}}

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
<script>
	console.log('{!!$AllTeam!!}')
								</script>
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

							<div class="row text-left mt-5" style="margin-top: 100px !important;">
								<div class="col-md-4">
									<div class="col-sm w-100">
									<b>RECEIVED BY:</b>
									</div>
									<div class="col-sm w-100">
										<div class="row">
											<div class="col-sm-12 border-bottom border-dark text-center">
												<b>{{$Nov->conforme}}</b><br>
											</div>
											<div class="col-sm-12 text-center">
												(Signature over Printed Name)
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-4">
									<div class="col-sm w-100">
									<b>DESIGNATION BY:</b>
									</div>
									<div class="col-sm w-100">
										<div class="row">
											<div class="col-sm-12 border-bottom border-dark text-center">
												<b>{{$Nov->conformeDesignation}}</b><br>
											</div>
											<div class="col-sm-12 text-center">
												(Position/Designation)
											</div>
										</div>
									</div>
								</div>


								<div class="col-md-4">
									<div class="col-sm w-100">
									<b>Date:</b>
									</div>
									<div class="col-sm">
										<div class="row">
											<div class="col-sm-12 border-bottom border-dark text-center">
												<b>{{\Carbon\Carbon::parse($Nov->novdate)->format('M d, Y')}}</b>
											</div>
											<div class="col-sm-12 text-center">
												Date
											</div>
										</div>
									</div>
								</div>



								
								

							</div>
						</div>
					</div>
				{{-- @endforeach --}}
			@endisset
		</div>
	</div>
	
	{{-- @include('employee.cmp._othersJS') --}}
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		if(document.getElementsByTagName('textarea').length){
			document.getElementsByTagName('textarea')[0].setAttribute('disabled', true);
		}
		@isset($Nov)
		let all = [{{$Nov->novdire}}];
		let toTextarea;
		all.forEach(function(el,key){
			$('#'+el).prop('checked',true);
		})
		@isset($Nov->novdireext)
		toTextarea = '{{$Nov->novdireext}}';
		@else
		toTextarea = ' ';
		@endisset
		$("textarea[name=nov_others]").val(toTextarea);
		@endisset
	</script>
</body>
</html>

{{-- @endsection --}}