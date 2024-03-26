@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'HFERC Evaluation')
  @section('content')
  @php
	$arrPart = $arrLvl1 = $arrLvl2 = $arrAssessment = array();
  @endphp
	<div class="content">
	    <div class="container pt-5">
	        <div class="row">
	        	<div class="col-3">
	            	<img class="w-50" src="{{asset('ra-idlis/public/img/doh2.png')}}" alt="DOH LOGO">
	          	</div>
				<div class="col-6 text-center">
					<p style="font-size: 30px;">Republic of the Philippines</p>
					<p style="font-size: 20px;">DEPARTMENT OF HEALTH</p>
					<p style="font-size:25px;">HEALTH FACLITIES AND SERVICES REGULATORY BUREAU</p>
				</div>
				<div class="col-3">
					<button class="btn-primary p-3" onclick="window.print()"><i class="fa fa-print"> Print</i></button>
				</div>
	        </div>
	    </div>

	    <div class="container text-center mt-3 font-weight-bold" style="font-size: 25px;">CHECKLIST FOR REVIEW OF FLOOR PLANS</div>

	      	<div class="container mt-5 mb-3">
				<div class="container">
					<div class="row" style="font-size: 20px;">
						<div class="col-md-3">Name of Health Facility:</div>
						<div class="col-md-9 text-left font-weight-bold"><u>{{$data['uInf']->facilityname}}</u></div>
					</div>

					<div class="row pt-1" style="font-size: 20px;">
						<div class="col-md-3">Address:</div>
						<div class="col-md-9 text-left font-weight-bold"><u>{{$data['uInf']->street_number . ' ' . $data['uInf']->street_name . ' ' . $data['uInf']->brgyname . ' ' . $data['uInf']->cmname . ' ' . $data['uInf']->provname}}</u></div>
					</div>

					<div class="row pt-1" style="font-size: 20px;">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3">Date:</div>
								<div class="col-md-9 text-center font-weight-bold"><u>@if(isset($hferc_evaluator)) {{date_format(date_create($hferc_evaluator->inspectDate), "F j, Y h:i A")}} @endif</u></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3">Review:</div>
								<div class="col-md-9 text-left font-weight-bold">
									1<sup>st</sup><span id="1">____</span>  
									2<sup>nd</sup><span id="2">____</span>
									{{-- 3<sup>rd</sup><span id="3">____</span> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="card-body">
				@foreach($data['reports'] as $key => $partid)
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
																	<u>{!!(is_numeric($values->evaluation) ? $values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' : '<i class="text-danger" aria-hidden="true">N/A</i>')!!}</u>
																	{{-- <u>{!!(is_numeric($values->evaluation) ? $values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' : '<i class="text-danger" aria-hidden="true">N/A</i>')!!}</u> --}}
																</div>
																<div class="col-md font-weight-bold">
																	{!!$values->assessmentName ?? ""!!}
																</div>
															</div>
															@isset($values->remarks)
															<div class="row">
																<div class="offset-1 col-md-11 pt-2" style="font-style: italic;">
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
																	<u>{!!(is_numeric($values->evaluation) ? $values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' : '<i class="text-danger" aria-hidden="true">N/A</i>')!!}</u>
																</div>
																<div class="col-md font-weight-bold">
																	{!!$values->assessmentName ?? ""!!}
																</div>
															</div>
															@isset($values->remarks)
															<div class="row">
																<div class="offset-1 col-md-11 pt-2" style="font-style: italic;">
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
				@isset($data['isPtc'])
				<div class="container lead pt-3 pb-3">
					<!-- Evaluated By: {{($data['assessor']->pre ?? null). ' ' . $data['assessor']->fname . ' ' . $data['assessor']->lname}} -->
				</div>
				@endisset
			</div>

	      <div class="container" style="margin-top: 80px; font-size: 20px;">
	      	<span >Name of Health Facility:</span><span class="font-weight-bold pl-5"><u>{{$appdata->facilityname}}</u></span>
	      </div>
	      <div class="container" style="margin-top: 30px; font-size: 20px;">
	      	<span >Address:</span><span class="font-weight-bold pl-5"><u>{{ucfirst($appdata->street_number.' '.$appdata->street_name.' '.$appdata->brgyname.' '.$appdata->provname)}}</u></span>
	      </div>

	      <div class="container w-auto" style="margin-top: 30px; font-size: 20px;">

		  <span >Evaluation Result:</span><br><br>
	      	<div class="container w-auto border border-secondary rounded" style="height: 300px; overflow-y: hidden; ">
			  {!!nl2br($reco->details)!!}
	      		<!-- {!!$evaluation->HFERC_comments!!} -->
			</div>
	      </div>
	      <div class="container text-center" style="margin-top: 50px; font-size: 20px;">
	      	HEALTH FACILITY EVALUATION REVIEW COMMITTEE(HFERC) IS RECOMMENDING FOR
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
			      		Approval
			      	@else
			      		Disapproval
			      	@endif
			    @else
			    	Not Yet Evaluated
		      	@endif
	      	</u>
	      </div> --}}
	      <div class="container text-center" style="margin-top: 50px; font-size: 20px;">
	      	<div class="row">
	      	@php $col = 0; @endphp
			  @php $membercount = 0; @endphp
			  @php $c = ''; @endphp
			  @php $vc = ''; @endphp
			  @php $member = ''; @endphp

			  @foreach($members as $m)
			  @switch($m->pos)
	                @case('E')
	                  <!-- @php $posname = 'Member'; @endphp -->
					  @php $membercount++; @endphp
	                @break
	             @endswitch

			  @endforeach

		      @foreach($members as $m)
		     	@switch($m->pos)
	                @case('C')
	                	@php $posname = 'Assigned Chairperson'; @endphp
	                @break
	                @case('VC')
	                  @php $posname = 'Vice Chairperson'; @endphp
	                @break
	                @case('E')
	                  @php $posname = 'Member'; @endphp
	                @break
	             @endswitch


		      	 @if($m->pos == 'C')
		      		@php $col = 12; @endphp
					@php $c .= '<div class="col-md-'.$col.' mt-3"><u>'.ucfirst($m->pre.' '. $m->fname.' '.(isset($m->mname) ? $m->mname.'. ' :''). $m->lname . ' '.$m->suf).'</u><div class="container">'.$m->position . ' / '.$posname.'</div></div>'; @endphp
				@elseif($m->pos == 'VC') 
					@php $col = 12; @endphp
					@php $vc .= '<div class="col-md-'.$col.' mt-3"><u>'.ucfirst($m->pre.' '. $m->fname.' '.(isset($m->mname) ? $m->mname.'. ' :''). $m->lname . ' '.$m->suf).'</u><div class="container">'.$m->position . ' / '.$posname.'</div></div>'; @endphp
				@else 
					@if($membercount > 2)
					@php $col = 4; @endphp
					@else 
					@php $col = 6; @endphp
					@endif
				@php $member .= '<div class="col-md-'.$col.' mt-3"><u>'.ucfirst($m->pre.' '. $m->fname.' '.(isset($m->mname) ? $m->mname.'. ' :''). $m->lname . ' '.$m->suf).'</u><div class="container">'.$m->position . ' / '.$posname.'</div></div>'; @endphp
				@endif
		      	 {{-- {{$col}} --}}
		      @endforeach
			  {!! $c !!}
			  {!! $vc !!}
			  {!! $member !!}
		    </div>
	      </div>
		</div>
      <br>

      <script>
      	@isset($data['revision'])
		$("#"+{{$data['revision']}}).replaceWith('<i class="p-3 fa fa-check" aria-hidden="true"></i>');
		@endisset
      </script>
  		

  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
