@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Recommendation')
	@section('content')
		<div class="container border">
			<div class="container mt-3 mb-3 display-4 text-center">Please Provide recommendation on the {{isset($mon) ? 'Monitored' : 'assessed'}} Facility</div>
			
			<form id="submitReco" method="POST">
				{{csrf_field()}}
				<input type="hidden" value="reco" name="reco">
				<div class="container mt-5 mb-3">
					<select name="choice" class="form-control">

						@if(!isset($uInf->isMon))
						<option value="issuance">Recommended for Issuance of Authorization</option>
						<option value="compliance">For Compliance</option>
						<option value="non">For Non Issuance</option>
						@else
						<option value="compliance">For Non Issuance of Notice of Violation</option>
						<option value="issuance">For Issuance of Notice of Violation</option>
						<option value="non">Others, Please specify</option>
						<!-- <option value="issuance">Acceptable</option>
						<option value="compliance">Unacceptable Corrective Action</option>
						<option value="non">Others, Please specify</option> -->
						@endif
					</select>
					<small style="color:red">*Based on the assessment made on the facility, what would be your recommendation (action) ?</small>
				</div>
				
				@if(!isset($uInf->isMon))
				<div class="container mt-5 mb-3" id="forDom">
					
					<div class="row">
						<div class="col-md-12">
							<div hidden >
							<small style="color:red">Validity From*</small>
							<input name="vf" type="date" class="form-control"  placeholder="validity from">
							<!-- <input name="vf" type="date" class="form-control" required="" placeholder="validity from"> -->

							</div>
							<small style="color:red">Note: If approved, the validity of the application starts on the day of the Director's Approval.</small>
							<br>
							<br>
						</div>
						<div class="col-md-12">
							<small style="color:red">Validity Until*</small>
							<input name="vto" type="date" value="{{date('Y-m-d', strtotime('Last day of December', strtotime(date('Y-m-d'))))}}" class="form-control"  placeholder="validity Until">
							<!-- <input name="vto" type="date" class="form-control" required="" placeholder="validity Until"> -->
						</div>
						<div class="col-md-12 mt-5 mb-3">
							<!-- <input name="noofbed" type="number" class="form-control" placeholder="Total number of beds"> -->
							<input name="noofbed" type="number" class="form-control" placeholder="Authorized bed capacity">
							<small style="color:red">Authorized bed capacity</small>
							<!-- <small style="color:red">Total number of beds</small> -->
						</div>
						<div class="col-md-12 mt-5 mb-3">
							<!-- <input name="noofdialysis" type="number" class="form-control" placeholder="Total number of Dialysis Station"> -->
							<input name="noofdialysis" type="number" class="form-control" placeholder="Authorized Dialysis Station">
							<small style="color:red">Authorized Dialysis Station</small>
							<!-- <small style="color:red">Total number of Dialysis Station</small> -->
						</div>
					</div>
				
				</div>

				
				@endif

				<div class="container mt-5 mb-3">
					<textarea name="details" id="" cols="30" rows="10" class="form-control"></textarea>
					<small style="color:red">*Remarks on the decision made</small>

					
					<input name="conformee" type="text" class="form-control" required="" placeholder="Conforme">
					<small style="color:red">Conforme*</small>

					<input name="conformeeDes" type="text" class="form-control" required="" placeholder="Position/Designation">
					<small style="color:red">Position/Designation*</small>
				</div>
				
				<div class="d-flex justify-content-center">
					<button class="btn btn-primary " type="submit">Submit</button>
				</div>

			</form>


		</div>

		<script type="text/javascript">
			@if(!isset($uInf->isMon))
			$("select[name=choice]").change(function(event) {
				let currentVal = $(this).find('option:selected').val();
				if($.trim(currentVal) != ''){
					let dom = $("#forDom");
					dom.empty();
					switch (currentVal) {
						case 'issuance':
							dom.append(
								'<div class="row">'+
									'<div hidden>'+
										'<small style="color:red">Validity From*</small>'+
										'<input name="vf" type="date" class="form-control" required="" placeholder="validity from">'+
									'</div>'+
									'<div class="col-md-12">'+
										'<small style="color:red">Validity To*</small>'+
										'<input name="vto" type="date" class="form-control" required="" placeholder="validity to">'+
									'</div>'+
									'<div class="container mt-5 mb-3">'+
										'<input name="noofbed" type="number" class="form-control" placeholder="Total number of beds">'+
										'<small style="color:red">*Total number of beds</small>'+
									'</div>'+
									// '<div class="container mt-5 mb-3">'+
									// 	'<input name="noofbed" type="number" class="form-control" required="" placeholder="Total number of beds/Dialysis Station">'+
									// 	'<small style="color:red">*Total number of beds/Dialysis Station</small>'+
									// '</div>'+
									
									'<div class="container mt-5 mb-3">'+
										'<input name="noofdialysis" type="number" class="form-control" placeholder="Total number of Dialysis Station">'+
										'<small style="color:red">*Total number of Dialysis Station</small>'+
									'</div>'+
								'</div>'
							);
							break;
						case 'compliance':
							dom.append(
								'<div class="row">'+
									'<div class="col-md-12">'+
										// '<small style="color:red">Days*</small>'+
										'<span>Issuance depends upon compliance to the recommendations given and submission of the following within<input name="days" type="hidden" class="" required="" value="30" style="width:4em"> 30  days from the date of inspection</span>'+
									'</div>'+
								'</div>'
							)
							break;
					}
				} else {
					alert('Error on page. refreshing');
					window.location.reload();
				}
			});
			@endif
		</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
