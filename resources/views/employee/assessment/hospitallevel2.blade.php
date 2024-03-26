@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="card">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="{{ asset('/employee/dashboard/') }}">Dashboard</a></li>
			    <li class="breadcrumb-item"><a href="{{ asset('/employee/dashboard/assessment') }}">Assessment</a></li>
			    <li class="breadcrumb-item active" aria-current="page">PART IV – LEVEL 2 HOSPITAL</li>
			  </ol>
			</nav>
			<div class="container p-4">
				<div class="container pb-3">
					<strong>ATTACHMENT 2.A – PERSONNEL</strong>
				</div>	
				<table class="table table-bordered">
					<thead class="text-center">
						<tr style="background-color: rgb(148,138,84);">
							<th scope="col">POSITION</th>
							<th scope="col">QUALIFICATION</th>
							<th scope="col">EVIDENCE</th>
							<th scope="col">NUMBER/RATIO</th>
							<th scope="col">COMPLIED</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr style="background-color: rgb(196,188,150);">
							<td colspan="6"><strong>TOP MANAGEMENT (Should be full-time)</strong></td>
						</tr>
						{{-- 1st tr --}}
						<tr>
							<td>
								Chief of Hospital/Medical Director
							</td>
							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Have completed at
									    least twenty (20) units
									    towards a Master’s
									    Degree in Hospital
									    Administration or
									    related course (MPH,
									    MBA, MPA, MHSA,
									    etc.) AND at least five
									    (5) years hospital
									    experience in a
									    supervisory or
									    managerial position
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/ Certificate of units earned
									</li>
									<li>
										Updated Physician PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of Hospital supervisory/ managerial experience)
									</li>
								</ul>
							</td>
							<td>1</td>
							<td class="comp" style="vertical-align : middle;">
								{{-- <div class="custom-control custom-radio">
								  <input type="radio" id="c1" name="c1" class="custom-control-input">
								  <label class="custom-control-label" for="c1">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c2" name="c1" class="custom-control-input">
								  <label class="custom-control-label" for="c2">No</label>
								</div> --}}
							</td>
							<td class="remarks">
								{{-- <div class="form-group">
								    <textarea class="form-control" name="r1" rows="20"></textarea>
							    </div> --}}
							</td>
						</tr>

						{{-- 2nd tr --}}
						<tr>
							<td>
								Chief of Clinics/ Chief of Medical Professional Services
							</td>

							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/diplomate of a specialty/subspecialty society
									</li>
									<li>
										At least five (5) years  hospital experience  in a clinical supervisory or managerial position
									</li>
								</ul>
							</td>

							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/ Certificate from Specialty society
									</li>
									<li>
										Updated Physician PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of clinical supervisory/managerial experience in hospital)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c3" name="c2" class="custom-control-input">
								  <label class="custom-control-label" for="c3">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c4" name="c2" class="custom-control-input">
								  <label class="custom-control-label" for="c4">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r2" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 3rd tr --}}
						<tr>
							<td>Department Head (Specialty)</td>

							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/diplomate in a specialty/Sub specialty society of the department he/she heads
									</li>
								</ul>
							</td>

							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/ Certificate from Specialty society
									</li>
									<li>
										Updated Physician PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
								</ul>
							</td>

							<td>
								1 per department
							</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c5" name="c3" class="custom-control-input">
								  <label class="custom-control-label" for="c5">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c6" name="c3" class="custom-control-input">
								  <label class="custom-control-label" for="c6">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r3" rows="20"></textarea>
							    </div>
							</td>

						</tr>

						{{-- 4th tr --}}

						<tr>
							<td>Chief Nurse/Director of Nursing</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										Master’s Degree in Nursing <strong><u>AND</u></strong> at least five (5) years of clinical experience in a Supervisory or managerial position in nursing (R.A. No. 9173)
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of supervisory/managerial experience in nursing)

									</li>
								</ul>
							</td>
							<td></td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c7" name="c4" class="custom-control-input">
								  <label class="custom-control-label" for="c7">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c8" name="c4" class="custom-control-input">
								  <label class="custom-control-label" for="c8">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r4" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 5th tr --}}
						<tr>
							<td>
								Chief Administrative Officer/Hospital Administrator
							</td>
							<td>
								Have completed at least twenty (20) Units towards Master’s Degree in Hospital Administration or related course (MPH, MBA, MPA, MHSA, etc.) AND at least five (5) years hospital experience in a supervisory/ managerial position 
							</td>
							<td>
								
							</td>
							<td>
								1
							</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c8" name="c5" class="custom-control-input">
								  <label class="custom-control-label" for="c8">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c9" name="c5" class="custom-control-input">
								  <label class="custom-control-label" for="c9">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r5" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- indicator --}}
						<tr>
							<td colspan="6"><strong>ADMINISTRATIVE SERVICES</strong></td>
						</tr>
						<tr>
							<td>
								Accountant
							</td>
							<td>
								Certified Public Accountant (may be outsourced)
							</td>
							<td rowspan="6">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated PRC license (if applicable)
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>1</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c10" name="c6" class="custom-control-input">
								  <label class="custom-control-label" for="c10">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c11" name="c6" class="custom-control-input">
								  <label class="custom-control-label" for="c11">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r5" rows="20"></textarea>
							    </div>
							</td>
						</tr>
						<tr>
							<td>
								Billing Officer
							</td>
							<td rowspan="5">
								With Bachelor’s Degree relevant to the job
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Book keeper
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Budget/Finance Officer
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cashier
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Human Resources Management Officer / Personnel Officer
							</td>
							<td>1</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c12" name="c7" class="custom-control-input">
								  <label class="custom-control-label" for="c12">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c13" name="c7" class="custom-control-input">
								  <label class="custom-control-label" for="c13">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r6" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 6th tr --}}
						<tr>
							<td>Engineer (full time)</td>
							<td>Licensed Engineer</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>

							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c13" name="c8" class="custom-control-input">
								  <label class="custom-control-label" for="c13">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c14" name="c8" class="custom-control-input">
								  <label class="custom-control-label" for="c14">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r7" rows="20"></textarea>
							    </div>
							</td>

						</tr>

						{{-- 7th tr --}}
						<tr>
							<td>Supply Officer/-Storekeeper</td>
							<td rowspan="2">With appropriate training and experience</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Certificates of Trainings attended

									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>

							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c14" name="c9" class="custom-control-input">
								  <label class="custom-control-label" for="c14">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c15" name="c9" class="custom-control-input">
								  <label class="custom-control-label" for="c15">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r8" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 8th tr --}}
						<tr>
							<td>Laundry Worker</td>
							<td>1</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c15" name="c10" class="custom-control-input">
								  <label class="custom-control-label" for="c15">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c16" name="c10" class="custom-control-input">
								  <label class="custom-control-label" for="c16">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r9" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 9th tr --}}
						<tr>
							<td>Medical Records officer</td>
							<td>
								<ul>
									<li>Bachelor’s Degree</li>
									<li>Training in ICD 10</li>
									<li>
										Training in Medical Records Management
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>1</td>
							<td class="comp" style="vertical-align : middle;">
								<div class="custom-control custom-radio">
								  <input type="radio" id="c17" name="c11" class="custom-control-input">
								  <label class="custom-control-label" for="c17">Yes</label>
								</div>
								<div class="custom-control custom-radio">
								  <input type="radio" id="c18" name="c11" class="custom-control-input">
								  <label class="custom-control-label" for="c18">No</label>
								</div>
							</td>
							<td class="remarks">
								<div class="form-group">
								    <textarea class="form-control" name="r10" rows="20"></textarea>
							    </div>
							</td>
						</tr>

						{{-- 10th tr --}}
						<tr>
							<td>Medical Social worker (Full Time)</td>
							<td>Licensed social worker</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated PRC license Certificates of Trainings attended

									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>

						</tr>

						{{-- 11th tr --}}
						<tr>
							<td>Nutritionist –Dietician (Full Time)</td>
							<td>Licensed Nutritionist-Dietician</td>
							<td></td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 12th tr --}}
						<tr>
							<td>With appropriate training and experienc</td>
							<td rowspan="2">With appropriate training and experience</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 13th tr --}}
						<tr>
							<td>Laundry Worker</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 14th tr --}}
						<tr>
							<td>Medical Records officer</td>
							<td>
								<ul>
									<li>
										Bachelor’s Degree
									</li>
									<li>
										Training in ICD 10
									</li>
									<li>
										Training in Medical Records Management
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment(Notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>

						</tr>

						{{-- 15th tr --}}
						<tr>
							<td>Medical Social worker (Full Time)</td>
							<td>Licensed social worker</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated PRC license Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1
							</td>

							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 16th tr --}}
						<tr>
							<td>Nutritionist –Dietician (Full Time)</td>
							<td>Licensed Nutritionist-Dietician</td>
							<td></td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 17th tr --}}
						<tr>
							<td>Building Maintenance Man/Utility Worker</td>
							<td rowspan="2">
								May be outsourced<br>
								Security guard must be licensed.
							</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Relevant Training
									</li>
									<li>
										Licensed if applicable
									</li>
									<li>
										Proof of Employment / Appointment (notarized) if employed by hospital
									</li>
									<li>
										Notarized MOA if outsourced
									</li>
								</ul>
							</td>
							<td>
								1 per shift
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 18th tr --}}
						<tr>
							<td>Security Guard (licensed)</td>
							<td>1 per shift</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- clinical services section --}}
						<tr>
							<td colspan="6" style="background-color: rgb(196,188,150)"><strong>CLINICAL SERVICES</strong></td>
						</tr>

						{{-- 19th tr --}}
						<tr>
							<td>
								Consultant Staff in Ob-Gyn. Pediatrics, Medicine. Surgery, and Anesthesia
								<br>
								<br>

								<i>*Hospital may have additional consultants from other specialties.</i>
							</td>
							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/Diplomate
									</li>
									<li>
										ACLS certified (for Surgeons and Anesthesiologists)
									</li>
								</ul>
							</td>
							<td rowspan="3">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Certificate from Specialty society, if applicable (for Board Certified)
									</li>
									<li>
										Residency Training Certificate (for Board Eligible)
									</li>
									<li>
										Certificate of Residency Training/ Medical Specialists (*DOH Medical specialist, last exam was in 1989)
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								At least 50% of the consultants per specialty are board certified
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 20th tr --}}
						<tr>
							<td>
								Intensive Care Unit: Multidisciplinary Team composed of, but not limited to, board certified Cardiologist, Pulmonologist, Neurologist. Pulmonologist Preferably <b><u>OR</u></b>  an intensivist
							</td>
							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/Diplomate
									</li>
								</ul>
							</td>
							<td>
								A team composed of at least 1 per specialty (May be part time or visiting consultant) <b><u>OR</u></b> a intensivist
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 21th tr --}}
						<tr>
							<td>
								Neonatal Intensive Care Unit: A multidisciplinary team compose of, but not limited to, pediatric, cardiologist, pediatric nephrologist, pediatric Pulmonologist <b><u>OR</u></b> a neonatologist
							</td>
							<td>
								<ul>
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/Diplomate
									</li>
								</ul>
							</td>
							<td>
								A team composed of at least 1 per specialty (May be part time or visiting consultant) <b><u>OR</u></b> a neonatologist
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 22th tr --}}
						<tr>
							<td>
								High Risk Pregnancy Unit: General Obstetricians, preferably with a Perinatologist, and a referral team of IM specialists
							</td>
							<td>
								<ul>
									<li>Licensed physician</li>
									<li>Fellow/Diplomate</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Certificate from Specialty society, if applicable (for Board Certified)
									</li>
									<li>
										Residency Training Certificate (for Board Eligible)
									</li>
									<li>
										Certificate of Residency Training/ Medical Specialists (*DOH Medical Specialist, last exam was in 1989)
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								General Obstetricians, preferably with a Perinatologist, and a referral team of IM specialists (May be part time or visiting consultant)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 23rd tr --}}
						<tr>
							<td>
								Resident Physician on duty (Shall not go on duty for more than 48 hours straight).
							</td>
							<td>
								Licensed physician
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
									<li>
										Schedule of duty approved by Medical Director/Chief of Hospital
									</li>
								</ul>
							</td>
							<td>
								Wards- 1:20 beds at any given time PLUS ER – at least 1 at any given time<br>
								<br>
								<i>
									*This ratio does not include Resident Physicians on Duty that shall be required for add-on services such as dialysis facility. It shall be counted separately.
								</i>

							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- nursing services section --}}
						<tr>
							<td colspan="6" style="background-color: rgb(196,188,150)"><strong>NURSING SERVICES</strong></td>
						</tr>

						{{-- 24th tr --}}
						<tr>
							<td>Assistant Chief Nurse</td>
							<td>
								<ul>
									<li>Licensed nurse</li>
									<li>
										At least twenty (20) units towards Master’s Degree in\ Nursing
									</li>
									<li>
										At least three (3) years-experience in supervisory/ managerial position in nursing
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of Units Earned
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of supervisory/ managerial experience in nursing)
									</li>
								</ul>
							</td>
							<td>1:100 Beds</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 25th tr --}}
						<tr>
							<td>Supervising Nurse/Nurse Managers</td>
							<td>
								<ul>
									<li>Licensed nurse</li>
									<li>
										With at least nine (9) units of Master’s Degree in Nursing
									</li>
									<li>
										At least two (2) years experience in general nursing service administration
									</li>
								</ul>
							</td>
							<td>
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of Units Earned
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (Proof of General nursing service Administration experience)
									</li>
								</ul>
							</td>
							<td>1 per Department-Office hours only (8am-5pm)</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 26th tr --}}
						<tr>
							<td>
								Head Nurse/Senior Nurse 
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										With at least two (2) years-hospital experience
									</li>
									<li>
										BLS certified
									</li>
								</ul>
							</td>
							<td rowspan="3">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of trainings attended
									</li>
									<li>
										Proof of employment (notarized)

									</li>
									<li>
										If nursing staffing is outsourced: Validity of the contract of of employment should be at least one (1) year and within the validity period of the hospital’s LTO.
									</li>
									<li>
										Schedule of duty approved by Chief Nurse
									</li>
								</ul>
							</td>
							<td>
								1 per shift per clinical department
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 27th tr --}}
						<tr>
							<td>
								Staff Nurse
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										BLS certified
									</li>
								</ul>
							</td>
							<td>
								Wards – 1:12 beds at any time (1 reliever for every 3 RNs)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 28th tr --}}
						<tr>
							<td>
								Staff Nurse in every Critical Unit (CCU, ICU, NICU, PICU, SICU. HRPU, etc.)
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										Certificate of Training in Critical Care Nursing, ACLS
									</li>
								</ul>
							</td>
							<td>
								1:3 beds at any time per shift (plus 1 reliever per 3 CCU RNs)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 29th tr --}}
						<tr>
							<td>Nursing Attendants in wards</td>
							<td rowspan="2">
								<ul class="m-0 p-4">
									<li>
										highschool graduate
									</li>
									<li>
										With relevant health related training (maybe in house training)
									</li>
								</ul>
							</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment (notarized)
									</li>
								</ul>
							</td>

							<td>
								1:24 beds at any time (1 reliever for every 3 NAs)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 30th tr --}}
						<tr>
							<td>Laundry Worker</td>
							<td>1:12 beds at any time (plus 1 reliever for every 3 NA/MWs)</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 31st tr --}}
						<tr>
							<td>
								Operating Room Nurses: 
								<br>-scrub Nurse (SN) 
								<br>-Circulating Nurse (CN)
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Training in OR Nursing
									</li>
									<li>
										Training in BLS and ACLS
									</li>
								</ul>
							</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of trainings attended
									</li>
									<li>
										Proof of Employment / Appointment (notarized
									</li>
									<li>
										If  outsourced: Validity  of the contract of employment should be at least one (1) year and within the validity period of the hospital’s LTO.
									</li>
								</ul>
							</td>

							<td>
								1 SN and 1 CN per functioning OR per shift (plus 1 reliever for every 3 nurses)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 32nd tr --}}
						<tr>
							<td>Delivery room Nurse</td>
							<td>
								<ul>
									<li>Licensed nurse</li>
									<li>
										Training in Maternal and Child Nursing (may be in house training or
									</li>
								</ul>
							</td>
							<td>1 per delivery table per shift (plus 1 reliever for every 3</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 33rd tr --}}
						<tr>
							<td></td>
							<td>
								training in Essential Integrated Newborn Care [EINC ])
								<ul>
									<li>
										Training in BLS and ACLS
									</li>
								</ul>
							</td>
							<td rowspan="3">
								Employment should be at least one (1) year and within the validity period of the hospital’s LTO.
								<ul>
									<li>Schedule of duty Approved by Chief Nurse</li>
								</ul>
							</td>
							<td>
								nurses)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 34th tr --}}
						<tr>
							<td>
								Emergency Room Nurse
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										Training in Trauma Nursing, ACLS and other relevant training
									</li>
								</ul>
							</td>
							<td>
								1:3 beds per shift (plus 1 reliever for every 3 nurses)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 35th tr --}}
						<tr>
							<td>
								Outpatient Department Nurse
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										Training in BLS
									</li>
								</ul>
							</td>
							<td>
								1 Office hours only (8am-5pm)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 36th --}}
						<tr>
							<td>Dentist – MOA if outsourced but the dental service should be within the vicinity of hospital</td>
							<td>Licensed dentist</td>
							<td rowspan="2">
								<strong>DOCUMENT REVIEW</strong>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Employment should be at least one (1) year and   within the validity period of the hospital’s LTO.
									</li>
								</ul>
							</td>
							<td>
								1 Office hours only (8am-5pm)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						{{-- 37th --}}
						<tr>
							<td>Respiratory Therapist</td>
							<td>
								Licensed respiratory therapist or licensed nurse with respiratory therapy training
							</td>
							<td>1 per shift</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container p-4">
				<div class="container pb-3">
					<strong>ATTACHMENT 2.B – PHYSICAL TEST</strong>
				</div>	
				<table class="table table-bordered">
					<thead class="text-center">
						<tr style="background-color: rgb(148,138,84);">
							<th>DOCUMENTS</th>
							<th>COMPLIED</th>
							<th>REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.	DOH – Approved PTC</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>2.	DOH Approved Floor Plan</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>3.	Checklist for Review of Floor Plans (accomplished)</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container p-4">
				<div class="container pb-3">
					<strong>OBSERVATIONS/FINDINGS (may use separate additional sheets if needed):</strong>
				</div>	
				<div class="form-group">
				    <textarea name="h2findings" class="form-control" rows="15"></textarea>
				</div>
			</div>

			<div class="container p-4">
				<div class="container pb-3">
					<strong>ATTACHMENT 2.C- EQUIPMENT/INSTRUMENT</strong>
				</div>	
				<table class="table table-bordered">
					<thead class="text-center">
						{{-- 38th tr --}}
						<tr style="background-color: rgb(148,138,84);">
							<th>EQUIPMENT/INSTRUMENT<br>(Functional)</th>
							<th>QUANTITY</th>
							<th>AREA</th>
							<th>COMPLIED</th>
							<th>REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>ADMINISTRATIVE SERVICE</strong></td>
						</tr>
						<tr>
							<td>
								Ambulance<br>
								<ul class="m-0 pl-4">
									<li>Available 24/7</li>
									<li>
										Physically present if not being used during time of inspection/monitoring
									</li>
								</ul>
							</td>
							<td>1</td>
							<td>Parking</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Computer with Internet Access</td>
							<td>1</td>
							<td>Administrative Office</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Light</td>
							<td></td>
							<td>
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Fire Extinguishers</td>
							<td>1 per unit or area</td>
							<td>
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Generator set with automatic Transfer Switch (ATS)</td>
							<td>1</td>
							<td>
								Genset house
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>KITCHEN DIETARY</strong></td>
						</tr>
						<tr>
							<td>
								Exhaust fan
							</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="9">Kitchen</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Food Conveyor or equivalent (closed-type)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Food Scale</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Blender/Osteorizer</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Oven</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stove</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Refrigerator/Freezer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Utility cart</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Garbage Receptacle with Cover (color-coded)</td>
							<td>1 for each color</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>



						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>EMERGENCY ROOM</strong></td>
						</tr>
						<tr>
							<td>
								Bag-valve-mask Unit
								<br>
								- Adult<br>
		                        - Pediatric

							</td>
							<td><br>1<br>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="9">ER</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Calculator for dose computation</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Clinical Weighing scale</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery set, primigravid</td>
							<td>2 sets</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery set, multigravid</td>
							<td>2 sets</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>ECG Machine with leads</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic set with Ophthalmoscope and Otoscope</td>
							<td>1set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list).</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr>
							<td>Examining table</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="4">ER</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Examining table (with Stirrups for OB-Gyne</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Glucometer with strips</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Gooseneck lamp/Examining Light</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="16">ER</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thoracostomy, Cutdown, etc.)
							</td>
							<td>2 sets</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Nebulizer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Negatoscope</td>
							<td>1set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Neurologic Hammer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>OR Light (portable or equivalent)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>Tank is anchored/chained/ strapped or with tank holder if not from pipeline
							</td>
							<td>2</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Pulse Oximeter</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, Non-mercurial
								<br>
		                        - Adult Cuff
		                        <br>
		                        - Pediatric Cuff
							</td>
							<td>1<br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suturing Set</td>
							<td>2 sets</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Thermometer, non –mercurial
								<br>
		                        - Oral
		                        <br>
		                        - Rectal
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Vaginal Speculum, Different Sizes</td>
							<td>
								1 for each different size
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Wheelchair</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Wheeled Stretcher with guard/side rails and wheel lock or anchor.</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>OUT-PATIENT DEPARTMENT</strong></td>
						</tr>
						<tr>
							<td>Clinical Height and Weight Scale</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">OPD</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Gooseneck lamp/Examining Light</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Examining table with wheel lock or anchor</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Minor Instrument Set 1 set</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Neurologic Hammer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">OPD</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Peak flow meter
		                        - Adult
		                        - Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
		                        - Adult
		                        - Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Thermometer, non-mercurial<br>
		                        - Oral<br>
		                        - Rectal
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suture Removal Set</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Wheelchair / Wheeled Stretcher</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="23">OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Anesthesia Machine
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Caesarean Section Instrument</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Electrocautery machine</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1</td>
							<td class="comp" ></td>
							<td class="remarks" ></td>
						</tr>
						<tr>
							<td>Glucometer with strips</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Instrument / Mayo table</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laparotomy pack (Linen pack)</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laparatomy / Major Instrument Set</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscopes with different sizes of blades</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Operating room light</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Operating room table</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Orthopedic Instrument Set</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Rechargeable Emergency Light (in case generator malfunction)</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<br>
		                        - Adult cuff
		                        <br>
		                        - Pediatric cuff
							</td>
							<td><br>1 per OR<br>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Spinal Set</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Thermometer, non-mercurial
								<br>
		                        - Oral
		                        <br>
		                        - Rectal
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Wheeled Stretcher with guard/side rails and wheel lock or anchor.
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">
								PACU/RR
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>
								1 (if separate from the OR Complex)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>
								1 (if separate from the OR Complex)
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								Mechanical / patient bed, with guard side rails and wheel lock or anchored
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<br>
		                        - Adult cuff
		                        <br>
		                        - Pediatric cuff
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td rowspan="2"></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Thermometer, non- mercurial</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>LABOR ROOM</strong></td>
						</tr>

						<tr>
							<td>Fetal Doppler</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">
								Labor Room
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Patient Bed
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Pulse Oximeter</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Stethoscope
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Thermometer, Non- mercurial
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>DELIVERY ROOM</strong></td>
						</tr>

						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="20">DR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bag valve mask unit (Adult and pediatric)
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bassinet
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Clinical Infant Weighing scale</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>
								Defibrillator with paddles 1 (if DR is separate from OR Complex)
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery set, primigravid</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery set, multigravid</td>
							<td>2 sets</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery room light</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Delivery room table</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Dilatation and Curettage set</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1 per OR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1 (if DR is separate from OR Complex)</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Kelly Pad or equivalent</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Rechargeable Emergency Light (in case generator malfunction)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Wheeled Stretcher</td>
							<td>1</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>HIGH RISK PREGNANCY UNIT</strong></td>
						</tr>

						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;"  rowspan="7">HRPU</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cardiotocography (CTG) Machine
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Fetal Doppler</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit <br> Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Patient bed with side rails</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Sphygmomanometer – Non-mercurial</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>


						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>NEONATAL INTENSIVE CARE UNIT (NICU)</strong></td>
						</tr>
						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="21">NICU</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bassinet
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bilirubin Light/ Phototherapy machine or equivalent
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Cardiac Monitor with Pulse Oximeter</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Clinical Infant Bag-valve mask unit
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Clinical Infant weighing scale</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Glucometer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Incubator</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Infusion pump/ Syringe pump</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with neonatal blades of different sizes</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mechanical Ventilator (May be outsourced)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Neonatal Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Refrigerator for Breast milk storage</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial<br>
								- for neonate
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Thermometer, non-mercurial</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Umbilical Cannulation set</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5">
								<strong>
									INTENSIVE CARE UNIT (ICU) – For all types of ICU (PICU, SICU, Medical ICU, etc.)
								</strong>
							</td>
						</tr>
						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="17">ICU</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bag-valve-mask Unit<br>
		                        -  Adult<br>
		                        -  Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Emergency Cart (for contents, refer to separate list)
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Infusion pump</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mechanical Bed</td>
							<td>
								Depending on the number of beds declared
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mechanical Ventilator/ Respirator (May be outsourced)</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thoracostomy, Cutdown, etc.)
							</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Infusion pump/ Syringe pump</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with neonatal blades of different sizes</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, non-mercurial(reserved for sudden breakdown of cardiac monitor)<br>
		                        -  Adult cuff for adult unit<br>
		                        -  Pediatric cuff for pediatric unit
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Suction apparatus
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5">
								<strong>
									NURSING UNIT/WARD
								</strong>
							</td>
						</tr>
						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="15">NURSING UNIT/WARD</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bag-valve-mask Unit<br>
		                        -  Adult<br>
		                        -  Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Clinical Height and Weight Scale
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Emergency cart or equivalent (refer to separate list for the contents)
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1 set</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mechanical/Patient bed with lock, if wheeled, with guard or side rails</td>
							<td>
								ABC
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Bedside Table</td>
							<td>ABC</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Neurologic Hammer
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Oxygen Unit Tank is anchored/chained if not pipeline</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Sphygmomanometer, Non-Mercurial
								<br>
		                        -  Adult cuff<br>
		                        -  Pediatric cuff
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Stethoscope
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>    
						<tr>
							<td>
								Thermometer, non-mercurial
								<br>
		                        -  Oral
		                        <br>
		                        -  Rectal
							</td>
							<td><br>1<br>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>RESPIRATORY/PULMONARY UNIT</strong></td>
						</tr>

						<tr>
							<td>
								ABG Machine
							</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;"  rowspan="4">
							Respiratory/ Pulmonary Unit</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Pulmonary Function Test (PFT) or Peak Expiratory Flow Rate (PEFR) Tube
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Spirometer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Nebulizer
							</td>
							<td>
								1
							</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>DENTAL CLINIC</strong></td>
						</tr>
						<tr>
							<td>Air compressor</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="25">DENTAL CLINIC</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Autoclave
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Bone file, stainless
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Cotton pliers</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Cowhorn Forceps
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Dental Chair Unit</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Explorer, double-end</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 8</td>
							<td></td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No.17 Upper molar</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 18 Upper molar</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 150 Maxillary Universal</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 150 S Primary Teeth</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 Lower Universal</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 Mandibular Pre-molar</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 S Lower Primary Teeth</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Gum separator
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>High speed handpiece with Burr remover</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Low speed handpiece, Angeled head
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mouth mirror explorer</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Periosteal elevator No. 9, double-end</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Rongeur</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Root elevator
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Scaler Jacquettes Set No. 1,2, and 3
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Surgical Chisel	
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Surgical Malette
							</td>
							<td>1</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>CENTRAL STERILIZING & SUPPLY ROOM</strong></td>
						</tr>
						<tr>
							<td>
								Autoclave/Steam Sterilizer
							</td>
							<td>1</td>
							<td>CSSR</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>CADAVER HOLDING AREA/ROOM</strong></td>
						</tr>
						<tr>
							<td>
								Bed or stretcher for cadaver
							</td>
							<td>1</td>
							<td>CADAVER HOLDING AREA</td>
							<td class="comp"></td>
							<td class="remarks"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container p-4">
				<div class="container pb-3 text-center">
					<strong>ATTACHMENT 2.D – EMERGENCY CART CONTENTS FOR LEVEL 2 HOSPITAL</strong>
				</div>	
				<table class="table table-bordered black">
					<thead>
						<tr style="background-color: rgb(214,227,188);">
							<th>EMERGENCY CART CONTENTS</th>
							<th>ER</th>	
							<th>OR</th>
							<th>DR</th>
							<th>ICU</th>
							<th>NICU</th>
							<th>HRPU</th>
							<th>NS 1</th>
							<th>NS 2</th>
							<th>NS 3</th>
							<th>NS 4</th>
							<th>NS 5</th>
							<th>NS 6</th>
							<th>NS 7</th>
							<th>OTHERS</th>
							<th>OTHERS</th>
							<th>REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Adenosine 6 mg/2mL vial</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Amiodarone 150mg/3mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Anti-tetanus serum (either equine-based antiserum or human antiserum)
							</td>
							<td></td>
							<td colspan="14" style="background-color: black;" ></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Aspirin USP grade (325 mg/tablet)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Atropine 1 mg/ml ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>B-adrenergic agonists (i.e. Salbutamol 2mg/ml)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Benzodiazepine (Diazepam 10mg/2ml ampule and/or Midazolam) (in high alert box)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Calcium (usually calcium gluconate 10% solution in 10 mL ampule)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Clopidogrel 75 mg tablet</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>D5W 250 mL</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>D50W 50mg/vial</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Digoxin 0.5mg/2mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Diphenhydramine 50mg/mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Dobutamine 250mg/5mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Dopamine 200mg/5mL ampule/vial</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Epinephrine 1mg/ml ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Furosemide 20mg/2ml ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Haloperidol 50mg/mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Hydrocortisone 250mg/2mL vial</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Lidocaine 10% in 50mL spray</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Lidocaine 2% solution vial 1g/50ml</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Magnesium sulphate 1g/2mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Mannitol 20% solution in 500ml/bottle</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Methylprednisolone 4mg/tablet</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Metoclopramide 10mg/2mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Morphine sulphate 10mg/mL ampule (in high alert box)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>
								Nitroglycerin inj. 10mg/10mL ampule or Isosorbide dinitrate 5mg SL tablet or 10 mg/10mL ampule
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Noradrenaline 2mg/2mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Paracetamol 300mg/ampule (IV preparation)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Phenobarbital 120mg/ml ampule IV or 30mg tablet (in high alert box)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Phenytoin 100mg/capsule or 100 mg.2mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Plain LRS 1L/bottle</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Plain NSS 1L/bottle-0.9% Sodium Chloride</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Potassium Chloride 40mEq/20mL vial (in high alert box)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Vitamin B1/6/12 vial (1g B1, 1g B6, 0.01gB12 in 10 mL vial)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Sodium bicarbonate 50mEq/50mL ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Verapamil 5 mg/2ml ampule</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr style="background-color: rgb(214,227,188)";>
							<td colspan="17"><strong>EQUIPMENT/SUPPLIES</strong></td>
						</tr>
						<tr>
							<td>Airway adjuncts</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Airway / Intubation Kit (with stylet and bag valve masks)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Alcohol disinfectant</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Aseptic bulb syringe</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Calculator</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Capillary Blood Glucose (CBG) Kit</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Cardiac Board</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Endotracheal Tubes, all sizes</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Flashlights or Pen lights</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Gloves, sterile</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Gloves,non-sterile</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Nasal cannula</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Protective face shield or mask or goggles</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Standard face mask</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Sterile gauze (pre-folded and individually packed)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Syringes (different volumes)</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Urethral catheter</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Urine collection bag</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
						<tr>
							<td>Waterproof aprons</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td class="remarks"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container pb-5">
				*Notes:<br>
				ER – Emergency Room<br>	
		        OR – Operating Room<br>
		        DR – Delivery Room<br>
		        NS – Nurses’ Station
			</div>
		</div>
	</div>

@endsection