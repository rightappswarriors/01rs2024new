@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Generated Report assessment file')
	@section('content')
	<style>
		table,th,tr,td{
			border: 2px solid black!important;
		}
		.shadow-textarea div.form-control::placeholder {
		    font-weight: 300;
		}
		.shadow-textarea div.form-control {
		    padding-left: 0.8rem;
		}

		#menu1 {
			position: fixed;
			right: 0;
			top: 50%;
			left: 93.5%;
			width: 8em;
			margin-top: -2.5em;
			z-index: 9999999;
		}

		#menu{
			position: fixed;
		    bottom: 15px;
		    right: 70px;
		    width: 8em;
		    z-index: 9999999;
		    /*height: 50px;*/
		    display: block;
		}

		@media print{
			#menu, #return-to-top, nav:first-child, div.sidebar, button{
				display: none!important;
			}
			thead,tfoot {display: table-row-group;}
			.page{
				overflow: hidden;
				page-break-after: avoid;
				page-break-inside:avoid;
			}
		}
	</style>

		{{-- <div class="container" id="menu">
			<label class="switch"><input type="checkbox" id="togBtn" checked><div class="slider round"></div></label>
		</div> --}}
		{{-- <div class="container" id="menu1">
			<button type="button" name="buttonPrint"><i class="fas fa-print" style="font-size: 30px; color:#064FF2"></i></button>
		</div> --}}

		<form method="POST" action="{{asset('/employee/dashboard/assessment/document')}}">
			{{csrf_field()}}
			<input type="hidden" name="html" value="">
			<input type="hidden" name="filename" value="sample">
			
			<button type="submit" class="d-none" name="toSubmit"></button>
		</form>

		<div class="container border pt-3 page" id="mainContent">
			@isset($uInf->facilityname)
			<div class="container pt-3 pb-3" style="font-size: 30px;">
				Generated Report for
			</div>
			<div class="container display-4 pt-3 pb-5">
				{{$uInf->facilityname}}
			</div>
			@endisset
			<table class="table">
				<thead>
					<tr class="font-weight-bold" style="background-color: rgb(148,138,84);">
						<th>STANDARDS AND REQUIREMENTS</th>
						<th class="text-center">COMPLIANT</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reports as $report)
					@if(isset($report->assessmentHead))
					<tr>
						<td colspan="3" class="" style="background-color: rgb(196,188,150);">{!!$report->assessmentHead!!}</td>
					</tr>
					@endif
					<tr>
						<td>
							<div class="container">
								{!!$report->assessmentName!!}
							</div>
						</td>
						<td class="text-center mt-3" style="font-size:30px">
							@isset($report->evaluation)
							{!!( $report->evaluation == 'NA' ? '<i class="fa fa-ban text-danger" aria-hidden="true"></i>' : ($report->evaluation ? '<i class="fa fa-check text-success" ; aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' ))!!}
							@endisset
						</td>
						<td>
							@isset($report->remarks)
							{{$report->remarks}}
							@endisset
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
			{{-- <div class="container"> --}}
				<div class="row">
					@if(isset($otherReports[0]) && count($otherReports[0]) > 0)
					<div class="col-md-12">
						<div class="text-center pt-3 pb-3 font-weight-bold" style="font-size: 25px;">For Improvement</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="font-weight-bold" style="background-color: rgb(148,138,84);">
										<th>STANDARDS AND REQUIREMENTS</th>
										<th class="text-center">COMPLIANT</th>
										<th>REMARKS</th>
									</tr>
								</thead>
								<tbody>
									@foreach($otherReports[0] as $report)
									@if(isset($report->assessmentHead))
									<tr>
										<td colspan="3" class="" style="background-color: rgb(196,188,150);">{!!$report->assessmentHead!!}</td>
									</tr>
									@endif
									<tr>
										<td>
											<div class="container">
												{!!$report->assessmentName!!}
											</div>
										</td>
										<td class="text-center mt-3" style="font-size:30px">

											{!!( $report->evaluation == 'NA' ? '<i class="fa fa-ban text-danger" aria-hidden="true"></i>' : ($report->evaluation ? '<i class="fa fa-check text-success" ; aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' ))!!}
										</td>
										<td>
											{{$report->remarks}}
										</td>
									</tr>

									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					@endif
					@if(isset($otherReports[1]) && count($otherReports[1]) > 0)
					<div class="col-md-12">
						<div class="text-center pt-3 pb-3 font-weight-bold" style="font-size: 25px;">For Compliance</div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr class="font-weight-bold" style="background-color: rgb(148,138,84);">
										<th>STANDARDS AND REQUIREMENTS</th>
										<th class="text-center">COMPLIANT</th>
										<th>REMARKS</th>
									</tr>
								</thead>
								<tbody>
									@foreach($otherReports[1] as $report)
									@if(isset($report->assessmentHead))
									<tr>
										<td colspan="3" class="" style="background-color: rgb(196,188,150);">{!!$report->assessmentHead!!}</td>
									</tr>
									@endif
									<tr>
										<td>
											<div class="container">
												{!!$report->assessmentName!!}
											</div>
										</td>
										<td class="text-center mt-3" style="font-size:30px">

											{!!( $report->evaluation == 'NA' ? '<i class="fa fa-ban text-danger" aria-hidden="true"></i>' : ($report->evaluation ? '<i class="fa fa-check text-success" ; aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' ))!!}
										</td>
										<td>
											{{$report->remarks}}
										</td>
									</tr>

									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					@endif
				</div>
			{{-- </div> --}}
			@isset($isPtc)
			<div class="container lead pt-3 pb-3">
				Evaluated By: {{$assessor->fname . ' ' . $assessor->lname}}
			</div>
			@endisset
			@isset($reco)
			<div class="col-md-12 text-left font-weight-bold" style="font-size: 30px;">Recommendation</div>
			<div class="container mt-3 mb-3">
				@if(!isset($isMon))
				@switch($reco->choice)
					@case('issuance')
						{{-- <div class="container">For Licensing Process:</div> --}}
						<div class="container">For Issuance of License to Operate with Validity date from <strong><u>{{$reco->valfrom}}</u></strong> to  <strong><u>{{$reco->valto}}</u></strong></div>
						<div class="container">
							<strong>With:</strong>
						</div>
						<div class="container">
							{{$reco->noofbed}} bed Station,
						</div>
						<div class="container">
							{!!$reco->noofdialysis ?? '<span class="font-weight-bold">No</span>'!!} Dialysis Station
						</div>
					@break
					@case('compliance')
						<div class="container" style="font-size: 20px;">
							Issuance depends upon compliance to the recommendations given and submission of the following within <strong><u>{{$reco->days}}</u></strong> days from the date of inspection:
						</div>

					@case('non')
						@isset($reco->details)
						<div class="form-group shadow-textarea form-control z-depth-1 mt-3 mb-3" style="min-height: 100px;">
							<strong><u>{{$reco->details}}</u></strong>
						</div>
						@endisset
					@break
				@endswitch
				@else
				
				@switch($reco->choice)
					@case('issuance')
						{{-- <div class="container">For Licensing Process:</div> --}}
				
						<div class="container">Issuance of Notice of Violation</div>
					@break
					@case('compliance')
						<div class="container" style="font-size: 20px;">
						
							Non-Issuance of Notice of Violation
						
						</div>

					@case('non')
						@isset($reco->details)
						<div class="form-group shadow-textarea form-control z-depth-1 mt-3 mb-3" style="min-height: 100px;">
							<strong><u>{{$reco->details}}</u></strong>
						</div>
						@endisset
					@break
				@endswitch
				@isset($otherDetails)
				<div class="container font-weight-bold">
					With NOV Details
					@foreach($otherDetails['mon']['NOV'] as $nov)
						@if($nov != null)
						<div class="container">
							@if($nov->novid_directions == 3)
							@isset($otherDetails['mon']['NOVDetails'])
							{{$otherDetails['mon']['NOVDetails']->novdireext}}
							@endisset
							@else
							{{$nov->novdesc}}
							@endif
						</div>
						@endif
					@endforeach
				</div> 
				@endisset
				@endif
			</div>
			@endisset
			
			@isset($assessor)
			{{-- <div class="container"> --}}
			<div class="col-md-12 text-left font-weight-bold">Assessed By:</div>
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
			</table>
			{{-- </div> --}}
			@isset($reco)
			<div class="col-md-12 text-left font-weight-bold">Conforme:</div>
			<table class="table">
				<thead>
					<tr>
						<th>Printed Name</th>
						<th>Signature</th>
						<th>Position/Designation</th>
						<th>Date Received</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="font-weight-bold">{{$reco->conforme}}</td>
						<td></td>
						<td>{{$reco->conformeDesignation}}</td>
						<td></td>
					</tr>
				</tbody>
			</table>
			@endisset

			@endisset
			
		</div>

		<script>
			$(document).on('click','button[name=buttonPrint]',function(){
			let htmlFromHere = $("#mainContent").html();

            let final = 
            '<!DOCTYPE html>\n'+
                '<html>\n'+
                '<head>\n'+
                '<meta charset="utf-8">'+
                '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n'+
                '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">\n'+

                '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">\n'+
                '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">\n'+
                '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">\n'+
                '<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">\n'+
                '<style type="text/css">\n'+
					'thead{\n'+
						'display: table-row-group;\n'+
					'}\n'+
					'.page{\n'+
						'overflow: hidden;\n'+
						'page-break-after: avoid;\n'+
						'page-break-inside:avoid;\n'+
					'}\n'+

				'</style>\n'+
                '</head>\n'+
                '<body>\n'+
                htmlFromHere+
                '</body>\n'+
                '</html>\n'
                triggerCopy(final, function(){});

                function triggerCopy(final,callback){
					$('input[name=html]').val(final);
					triggerSubmit();
				}

				function triggerSubmit() {
					$("button[name=toSubmit]").click();
				}
                
 
		})
		</script>
		
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
