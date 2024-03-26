@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style>
	@media print{
		button, footer{
			display: none;
		}
	}
</style>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
	{{-- @include('client1.cmp.__wizard') --}}
	
	<div class="container mt-3 pb-3">
		@isset($dataOfEvaluation)
			@php
				$arrPart = $arrLvl1 = $arrLvl2 = $arrAssessment = array();
			@endphp

			<div class="card mt-3" style="box-shadow: 5px 10px 18px #888888;">
				<div class="card-header" style="padding: 1.25rem 1.25rem;">
					<div class="row">
						<div class="col-md-2 hide-div">
							<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
						</div>
						<div class="col-md-8 ">
							<h6 class="card-title text-center">Republic of the Philippines</h6>
							<h5 class="card-title text-center">Department of Health</h5>
							<h5 class="card-title text-center">HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</h5>
						</div>
					</div>
				</div>

				<div class="container text-center mt-3 font-weight-bold" style="font-size: 25px;">CHECKLIST FOR REVIEW OF FLOOR PLANS</div>
				{{-- <div class="container text-center font-weight-bold" style="font-size: 25px;">HEMODIALYSIS CLINIC</div> --}}

				<div class="container mt-5 mb-3">
					<div class="container">
						<div class="row" style="font-size: 20px;">
							<div class="col-md-3">Name of Health Facility:</div>
							<div class="col-md-9 text-left font-weight-bold"><u>{{$uInf->facilityname}}</u></div>
						</div>

						<div class="row pt-1" style="font-size: 20px;">
							<div class="col-md-3">Address:</div>
							<div class="col-md-9 text-left font-weight-bold"><u>{{$uInf->street_number . ' ' . $uInf->street_name . ' ' . $uInf->brgyname . ' ' . $uInf->cmname . ' ' . $uInf->provname}}</u></div>
						</div>

						<div class="row pt-1" style="font-size: 20px;">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-3">Date:</div>
									<div class="col-md-9 text-center font-weight-bold"><u>{{Date('Y-m-d',strtotime('now'))}}</u></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-3">Review:</div>
									<div class="col-md-9 text-left font-weight-bold">
										1<sup>st</sup><span id="1">____</span>  
										2<sup>nd</sup><span id="2">____</span>
										3<sup>rd</sup><span id="3">____</span>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				
				<div class="card-body">
				@foreach($reports as $key => $partid)
					@foreach($partid as $key => $asmtH3ID_FK)
						@foreach($asmtH3ID_FK as $key => $asmtH2ID_FK)
							@foreach($asmtH2ID_FK as $key => $asmtH1ID_FK)
								@foreach($asmtH1ID_FK as $key => $values)
									<div class="col-md text-uppercase font-weight-bold" style="font-size: 20px;">
										@if(!in_array($values->asmtH1ID_FK, $arrLvl1))
										@php
										array_push($arrLvl1,$values->asmtH1ID_FK);
										@endphp
										{{$values->h1name}}
										@endif
									</div>
									<div class="row" style="padding-left: 3.1rem!important;">
										<div class="container">
											@if(!in_array($values->asmtH2ID_FK, $arrLvl2))
											@php
											array_push($arrLvl2,$values->asmtH2ID_FK);
											@endphp	
											<div class="col-md font-weight-bold pl-5 pt-2">
											{{-- endif filtering of repeating level 1 header --}}
											@if($values->isdisplay == 1)
												{{$values->h2name}}
											@endif
											</div>
											@endif
										</div>
									</div>
									<div class="container">
										<div class="row">
											<div class="container">
												<div class="col-md">
													@if(!isset($values->sub))
													<div class="col-md-8">
														<div class="pt-3" style="padding-left: {{($values->isAlign != 1 ? '4rem!important;' : '1rem!important;')}}">
															<div class="row">
																<div class="col-md-1">
																	{{-- <u>{!!$values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>'!!}</u> --}}
																	<u>{!!(is_numeric($values->evaluation) ? $values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' : '<i class="text-danger" aria-hidden="true">N/A</i>')!!}</u>
																</div>
																<div class="col-md font-weight-bold">
																	{!!$values->assessmentName ?? ""!!}
																</div>
															</div>
															@isset($values->remarks)
															<div class="row">
																<div class="offset-1 col-md-11 pt-2" style="font-size: 20px;">
																	Remarks: {{$values->remarks ?? ""}}
																</div>
															</div>
															@endisset
														</div>
													</div>

													@elseif(isset($values->sub))
													<div class="col-md-8">
														<div class="pt-3" style="padding-left: 11.2rem!important;">
															<div class="row">
																<div class="col-md-1">
																	{{-- <u>{!!$values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>'!!}</u> --}}
																	<u>{!!(is_numeric($values->evaluation) ? $values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' : '<i class="text-danger" aria-hidden="true">N/A</i>')!!}</u>
																</div>
																<div class="col-md font-weight-bold">
																	{!!$values->assessmentName ?? ""!!}
																</div>
															</div>
															@isset($values->remarks)
															<div class="row">
																<div class="offset-1 col-md-11 pt-2" style="font-size: 20px;">
																	Remarks: {{$values->remarks ?? ""}}
																</div>
															</div>
															@endisset
														</div>
													</div>	
													@endif
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endforeach
						@endforeach
					@endforeach
				@endforeach
				@isset($isPtc)
				<div class="container lead pt-3 pb-3">
					Evaluated By: {{$assessor->fname . ' ' . $assessor->lname}}
				</div>
				@endisset
			</div>
		</div>

		@endisset

	   <div class="card mt-3 border" style="box-shadow: 5px 10px 18px #888888;">

      <div class="card-header" style="padding: 1.25rem 1.25rem;">
			<div class="row">
				<div class="col-md-2 hide-div">
					<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
				</div>
				<div class="col-md-8 ">
					<h6 class="card-title text-center">Republic of the Philippines</h6>
					<h5 class="card-title text-center">Department of Health</h5>
					<h5 class="card-title text-center">HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</h5>
				</div>
			</div>
		</div>
		<div class="card-body">
		
      <div class="container" style="margin-top: 80px; font-size: 20px;">
      	<span >Name of Health Facility:</span><span class="font-weight-bold pl-5"><u>{{$appdata->facilityname}}</u></span>
      </div>
      <div class="container" style="margin-top: 30px; font-size: 20px;">
      	<span >Address:</span><span class="font-weight-bold pl-5"><u>{{ucfirst($appdata->street_number.' '.$appdata->street_name.' '.$appdata->brgyname.' '.$appdata->provname)}}</u></span>
      </div>
      <div class="container w-auto" style="margin-top: 30px; font-size: 20px;">
      	<span >Comments:</span><br><br>
      	<div class="container w-auto border border-secondary rounded" style="height: 300px; overflow-y: hidden; ">
      		{{$evaluation->HFERC_comments}}
		</div>
      </div>
      <div class="container text-center" style="margin-top: 50px; font-size: 20px;">
	      	HEALTH FACILITY EVALUATION REVIEW COMMITEE(HFERC) IS RECOMMENDING FOR
	      	<span class="text-center font-weight-bold">
	      		<u>
		      	@if(isset($evaluation->HFERC_eval))
			      	@if($evaluation->HFERC_eval == 1)
			      		Approval
			      	@else
			      		Disapproval
			      	@endif
			    @else
			    	Not Yet Evaluated
		      	@endif
		      	</u>
		    </span>
	      </div>
      {{-- <div class="container text-center font-weight-bold" style="margin-top: 50px; font-size: 20px;">
      	<u>
      		@if(isset($evaluation->HFERC_eval))
		      	@if($evaluation->HFERC_eval == 1)
		      		Approved
		      	@else
		      		Disapproved
		      	@endif
		    @else
		    	Not Yet Evaluated
	      	@endif
      	</u>
      </div> --}}
      <div class="container text-center" style="margin-top: 50px; font-size: 20px;">
      	<div class="row">
      	@php $col = 0; @endphp
	      @foreach($members as $m)
	     	@switch($m->pos)
                @case('C')
                	@php $posname = 'Chairperson'; @endphp
                @break
                @case('VC')
                  @php $posname = 'Vice Chairperson'; @endphp
                @break
                @case('E')
                  @php $posname = 'Evaluator'; @endphp
                @break
                {{-- @case('S')
                  @php $posname = 'Secretariat'; @endphp
                @break --}}
             @endswitch
	      	 @if($m->pos == 'C' || $m->pos == 'VC')
	      		@php $col = 12; @endphp
	      	 @else
	      	 	@php $col = 6; @endphp
	      	 @endif
	      	 {{-- {{$col}} --}}
				<div class="col-md-{{$col}} mt-3">
					<u>{{ucfirst($m->fname.' '.(isset($m->mname) ? $m->mname.'. ' :''). $m->lname)}}</u>
					<div class="container">
						{{$posname}}
					</div>
				</div>
	      @endforeach
	    </div>
      </div>

    </div>
    </div>
    <div class="container mt-3">
		@if($evaluation->HFERC_eval == 2 && $canResub)
		<div class="d-flex justify-content-center">
			<form method="POST">
				{{csrf_field()}}
				<button type="submit" class="btn btn-primary">Request Re-evaluation of facility</button>
			</form>
		</div>
		@elseif(!$canResub && $evaluation->HFERC_eval == 2)
		<div class="d-flex justify-content-center">
			Please wait for Re-evaluation result and Please re-submit Floor Plan / Blue Print to HFSRB/CHD Office
		</div>
		@endif

	</div>
    </div>
	
	
</body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		@isset($revision)
		$("#"+{{$revision}}).replaceWith('<i class="p-3 fa fa-check" aria-hidden="true"></i>');
		@endisset
		
	</script>
		@include('client1.cmp.footer')
</body>
@endsection