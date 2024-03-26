<style>
	table,th,tr,td{	border: 2px solid black!important;	}
	.shadow-textarea div.form-control::placeholder {   font-weight: 300;	}
	.shadow-textarea div.form-control {    padding-left: 0.8rem;	}
</style>

@php	$arrPart = $arrLvl1 = $arrLvl2 = $arrAssessment = array();	@endphp

<div class="container border pt-3">
	<div class="card">
		<div class="card-header">
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

				<div class="row" style="font-size: 20px;">
					<div class="col-md-3">Facility</div>
					<div class="col-md-9 text-left font-weight-bold"><u>{{$datafromdb[0]->parttitle}}</u></div>
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
																<u>{!!$values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : ($values->evaluation == 'NA' ? '<span class="text-danger">N/A</span>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>')!!}</u>
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
																<u>{!!$values->evaluation == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : ($values->evaluation == 'NA' ? '<span class="text-danger">N/A</span>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>')!!}</u>
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

			@isset($reco)

					{{-- <div class="col-md-12 text-left font-weight-bold" style="font-size: 30px;">Recommendation</div>
					<div class="container mt-3 mb-3">
						@switch($reco->choice)
							@case('issuance')
								<div class="container">For Issuance of License to Operate with Validity date from <strong><u>{{$reco->valfrom}}</u></strong> to  <strong><u>{{$reco->valto}}</u></strong></div>
							@break
							@case('compliance')
								<div class="container" style="font-size: 20px;">
									Issuance depends upon compliance to the recommendations given and submission of the following within <strong><u>{{$reco->days}}</u></strong> days from the date of inspection:
								</div>

							@case('non')
								<div class="form-group shadow-textarea form-control z-depth-1 mt-3 mb-3" style="min-height: 100px;">
									<strong><u>{{$reco->details}}</u></strong>
								</div>
							@break
						@endswitch
					</div> --}}
				
				<div class="container mt-5 text-center">
					<span class="display-4">Comments</span>
					<div class="container border border-secondary rounded text-justify" style="height: 300px; overflow-y: auto; ">
						<span class="pt-3" style="font-size: 25px; white-space: pre-line;">
							{{ $reco->details }}
						</span>
					</div>
				</div>

				@isset($isPtc)
					<div class="container lead pt-3 pb-3">
						Evaluated By: {{$assessor->fname . ' ' . $assessor->lname}}
					</div>
				@endisset

				{{-- <div class="col-md-12 text-left font-weight-bold">Assessed By:</div>
				<table class="table">
					<thead>
						<tr>
							<th>Printed Name</th>
							<th>Signature</th>
							<th>Position/Designation</th>
						</tr>
					</thead>
					<tbody>
						@foreach($assessor as $evaluator)
							@if(isset($evaluator->fname) || isset($evaluator->lname))
							<tr>
								<td class="font-weight-bold">{{$evaluator->fname . ' ' . $evaluator->lname}}</td>
								<td></td>
								<td>{{$evaluator->position}}</td>
							</tr>
							@endif
						@endforeach
					</tbody>
				</table> --}}
			@endisset
		</div>
	</div>
</div>

<script>
	@isset($revision)
	$("#"+{{$revision}}).replaceWith('<i class="p-3 fa fa-check" aria-hidden="true"></i>');
	@endisset
</script>
