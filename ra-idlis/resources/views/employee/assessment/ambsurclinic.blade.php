@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	        	AMBULATORY SURGERY CLINIC
	        </div>
	        @isset($data)
	        <div class="container p-4">
				<div class="container pb-3">
					<p class="text-center mb-5"><b>ASSESSMENT TOOL FOR LICENSING AN AMBULATORY SURGERY CLINIC</b></p>
					<p><b>I. FACILITY INFORMATION</b></p>
					<form>
						<table class="mb-3 w-100">
							<thead>
								<th style="width: 50%">
									
								</th>
							</thead>
							<tbody>
								<!-- name -->
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Facility:">
									</td>
								</tr>
								<!-- complete addr -->
								<tr>
									<td>
										{{-- region --}}
										<select type="" class="form-control" id="d_region" onchange="regionSelect()">
											<option value="" hidden disabled selected>Region*</option>
											@foreach($data->region as $key => $value)
												<option value="{{$value->rgnid}}">{{$value->rgn_desc}}</option>
											@endforeach
										</select>
									</td>
									<td colspan="2">
										{{-- province --}}
										<select  type="" class="form-control" id="d_prov" onchange="provSelect()">
											<option value="" hidden disabled selected>Province*</option>
											@foreach($data->province as $key => $value)
												<option value="{{$value->provid}}" id="{{$value->rgnid}}" hidden>{{$value->provname}}</option>
											@endforeach
										</select>
									</td>
								</tr>
								<tr>
									<td>
										{{-- cm --}}
										<select type="" class="form-control" id="d_cm" onchange="cmSelect()">
											<option value="" hidden disabled selected>City/Municipality*</option>
											@foreach($data->cm as $key => $value)
												<option value="{{$value->cmid}}" id="{{$value->provid}}" hidden>{{$value->cmname}}</option>
											@endforeach
										</select>
									</td>
									<td>
										{{-- brgy --}}
										<select type="" class="form-control" id="d_brgy">
											<option value="" hidden disabled selected>Barangay</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="No. & Street">
									</td>
								</tr>
								{{-- coordinates --}}
								<tr>
									<td class="pt-2">
										Geographic Coordinates of the Facility.	
									</td>
								</tr>
								<tr>
									{{-- latitude --}}
									<td>
										<input type="" name="" class="form-control" placeholder="Latitude">
									</td>
									{{-- longitude --}}
									<td>
										<input type="" name="" class="form-control" placeholder="Longitude">
									</td>
								</tr>
								{{-- contact no --}}
								<tr>
									<td class="">
										<input type="" name="" class="form-control" placeholder="Contact Number">
									</td>
									<td class="">
										<input type="" name="" class="form-control" placeholder="E-mail Address">
									</td>
								</tr>
								{{-- name of owner --}}
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Owner">
									</td>
								</tr>
								{{-- name of head facility --}}
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Head of the Facility">
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Latest DOH License Number (if renewal)">
									</td>
								</tr>
							</tbody>
						</table>
						{{-- Type --}}
						<div>
							<div class="row mb-3">
								<div class="col">
									<b><u>Type of Application:</u></b>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div>
										<label class="radcont">Initial
											<input type="radio" name="application">
											<span class="radchkmark"></span>
										</label>
									</div>
									<div>
										<label class="radcont">Renewal
											<input type="radio" name="application">
											<span class="radchkmark"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
							
						{{-- Classification --}}
						<div>
							<div class="row mt-3 mb-3">
								<div class="col" colspan="12">
									<b><u>Classification:</u></b>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div colspan="2">
										<label class="radcont">Government National
											<input type="radio" name="classification" onchange="others_c(this)">
											<span class="radchkmark"></span>
										</label>
									</div>
									<div colspan="2">
										<label class="radcont">Local
											<input type="radio" name="classification" onchange="others_c(this)">
											<span class="radchkmark"></span>
										</label>

									</div>
									<div colspan="2">
										<label class="radcont">Private
											<input type="radio" name="classification" onchange="others_c(this)" id="others_c_p">
											<span class="radchkmark"></span>
										</label>
										<div class="row" hidden id="pv">
											<div class="col" colspan="1"></div>
											<div class="col" colspan="2">
												<label class="radcont">Single Proprietorship/ Partnership/ Corp.
													<input type="radio" name="private" onchange="others_p(this)">
													<span class="radchkmark"></span>
												</label>
												<label class="radcont">Religious
													<input type="radio" name="private" onchange="others_p(this)">
													<span class="radchkmark"></span>
												</label>
												<label class="radcont">Civic Organization
													<input type="radio" name="private" onchange="others_p(this)">
													<span class="radchkmark"></span>
												</label>
												<label class="radcont">Foundation
													<input type="radio" name="private" onchange="others_p(this)">
													<span class="radchkmark"></span>
												</label>
												<label class="radcont">Others, specify
													<input type="radio" name="private" onchange="others_p(this)" id="others_p_rad">
													<span class="radchkmark"></span>
												</label>
												<textarea class="form-control" rows="4" id="others_p_txt" disabled></textarea>
											</div>
											<div class="col"></div>
											<div class="col"></div>
										</div>
									</div>
									<div colspan="2">
										<label class="radcont">Others, specify
											<input type="radio" name="classification" onchange="others_c(this)" id="others_c_rad">
											<span class="radchkmark"></span>
										</label>
										<textarea class="form-control" rows="5" id="others_c_txt" disabled=""></textarea>
									</div>
								</div>
							</div>				
						</div>
						{{-- Character --}}
						<div>
							<div class="row">
								<div class="col mb-3 mt-5">
									<b><u>Institutional Character:</u></b>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div>
										<label class="radcont">Hospital-Based
											<input type="radio" name="character">
											<span class="radchkmark"></span>
										</label>
									</div>
									<div>
										<label class="radcont">Nonhospital-based
											<input type="radio" name="character">
											<span class="radchkmark"></span>
										</label>
									</div>
								</div>
							</div>
						</div>	
						{{-- Surgical --}}
						<div>
							<div class="row">
								<div class="col mt-5 mb-3" colspan="4">
									<b><u>Surgical Services:</u></b>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<div>
										<label class="chkcont">Colorectal Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">General Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Oral-Maxillo-Facial Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Ophthalmologic Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Othopedic Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Otorhinolaryngologic Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
								</div>
								<div class="col">
									<div>
										<label class="chkcont">Pediatric Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Plastic and Reconstructive Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Reproductive Health Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Thoracic Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
									<div>
										<label class="chkcont">Urologic Surgery
											<input type="checkbox" name="surgical">
											<span class="chk"></span>
										</label>
									</div>
								</div>
							</div>
						</div>
						{{-- Ancillary --}}
						<div>
							<div class="row">
								<div class="col mt-5 mb-3" colspan="4">
									<b><u>Acillary Services:</u></b>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<big><b>Radiology:</b></big>
									<div class="row mt-3">
										<div>
											<label class="radcont">Chest and Lungs
												<input type="radio" name="ancillary_r">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Level 1
												<input type="radio" name="ancillary_r">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Level 2
												<input type="radio" name="ancillary_r">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Level 3
												<input type="radio" name="ancillary_r">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col">
									<big><b>Clinical Laboratory:</b></big>
									<div class="row mt-3">
										<div>
											<label class="radcont">Primary
												<input type="radio" name="ancillary_c">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Secondary
												<input type="radio" name="ancillary_c">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Tertiary
												<input type="radio" name="ancillary_c">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
									<div class="row mt-3">
										<div>
											<label class="radcont">Pharmacy
												<input type="radio" name="ancillary_c">
												<span class="radchkmark"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<br><br>
						<hr>
						<br><br>
						<p><b>II. TECHNICAL REQUIREMETS</b></p>
						<p>
							<i>Instruction: In the appropriate box, place a check mark (/) if the Ambulatory Surgical Clinic is compliant or x mark (X) if it is not compliant.</i>
						</p>
						@php
							$arr1 = array(
								"1. Surgeon",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Valid PRC license",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. PTR",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Updated Certificate of Training in Basic Life Support and Advanced Cardiac Life Support",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Specialty Board Certificate",
								"&nbsp;&nbsp;&nbsp;&nbsp;e. Notarized Contract of Employment",
								"2. Anesthesiologist",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Valid PRC license",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. PTR",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Specialty Board Certificate",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Notarized Contract of Employment",
								"3. Nurse",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Valid PRC license",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Valid Certificates of Training in Basic Life Support",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. At least one nurse on duty with valid Certificate of Training of Advanced Cardiac Life Support",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Notarized Contract of Employment",
								"4. Nursing Attendant/Aide",
								"&nbsp;&nbsp;&nbsp;&nbsp;- Notarized Contract of Employment",
								"5. Administrator/Clerk",
								"&nbsp;&nbsp;&nbsp;&nbsp;- Notarized Contract of Employment",
								"6. Designated Medical Records Officer (MRO)",
								"&nbsp;&nbsp;&nbsp;&nbsp;- Letter of Appointment/Designation as MRO",
								"7. Designated ICD-10 Coder",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Certificate of Completion for ICD-10 Training for Coders",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Letter of Appointment",
								"8. Designated Regulatory Compliance Officer (RCO)",
								"&nbsp;&nbsp;&nbsp;&nbsp;- Letter of Appointment/Designation as RCO",
							);

							$arr2 = array(
								"1. Approved Permit to Construct",
								"2. ASC conforms to the approved Floor Plan",
								"3. Signage",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Information and Orientation",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Direction",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Identificationn",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Prohibition and Warning",
								"&nbsp;&nbsp;&nbsp;&nbsp;e. No Smoking Sign",
								"&nbsp;&nbsp;&nbsp;&nbsp;f. Evacuation Plan",
								"&nbsp;&nbsp;&nbsp;&nbsp;g. Process flowchart of clinical services",
								"4. Posted in conspicuous area",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. License of ASC (for renewal)",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Local Permits",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Vision and mission",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Organizational Chart",
							);
						@endphp
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 70%">STANDARDS AND REQUIREMENTS</th>
									<th scope="col">COMPLIANT</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td colspan="3">
										<p><b>A. PERSONNEL</b></p>
										<p>
											The health facility appoints and allocates personnel who are suitably qualified, skilled and/or experienced to provide the service and meet the patient needs.
										</p>
									</td>
								</tr>
								@for($i=0; $i<count($arr1); $i++)
									<tr>
										<td>
											{{$arr1[$i]}}
										</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
								<tr class="at-tr-subhead">
									<td colspan="3">
										<p><b>B. EQUIPMENT, INSTRUMENTS/SUPPLIES, AND BASIC MEDICINES</b></p>
										<p>
											<i>(Refer to checklist of appropriate service/s applied for.)</i> All equipment and instruments necessary for the safe and effective provision of services are available and properly maintained.
										</p>
									</td>
								</tr>
								<tr class="at-tr-subhead">
									<td colspan="3">
										<p><b>C. PHYSICAL FACILITY</b></p>
										<p>
											Services in ASC are provided in an environment that ensures physical privacy and promotes safety has adequate space and meets the needs of patients, service providers and other stakeholders
										</p>
									</td>
								</tr>
								@for($i=0; $i<count($arr2); $i++)
									<tr>
										<td>
											{{$arr2[$i]}}
										</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>
						<p><b>III. FACILITY OPERATIONS</b></p>
						@php
							$arr3 = array(
								"1. Vision and Mission",
								"2. Organizational chart",
								"3. Human Resource Management",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Human resource development program that identifies, plan, facilitate and record training and education for all personnel.",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Personnel hired are qualified and competent on the basis of appropriate education, training, skills, and experiences.",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. New personnel receive an orientation program that covers essential component of the service being provided.",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. An exit interview is conducted for personnel who resign or retire from the service.",
								"&nbsp;&nbsp;&nbsp;&nbsp;e. Performance of each personnel is monitored and evaluated.",
								"4. Documented process flow for provision of clinical services in the facility.",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Pre-operative",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Intraoperative",
								"5. Documented technical procedures of services provided in the facility.",
								"6. Quality Management Review System",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Quality Management Program that reflects continuous quality improvement principles",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Documented procedure for handling complaints, reporting and analysis of incidents, adverse events, etc.",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Exception reporting system for adverse, unplanned or untoward events (accidents, complaints, infectious/ notifiable diseases)",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.1 Recording",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.2 Reporting",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.3 Investigation",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.4 Analysis",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.5 Corrective Action",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.6 Review process",
								"7. Preventive maintenance program for equipment.",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Plan for essential equipment replacement in case of breakdown",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Record of equipment",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Operational manuals of all equipment and instruments",
								"8. Transfer/Referral System Documented policy and procedures on transfer or referral of patient to at least Level 2 Hospital for the provision of inpatient care especially during emergencies and other hospital services.",
								"9. Healthcare Waste Management The clinic observes safe and appropriate handling, storage and disposal of wastes that complies with current legislation, local government requirements and the Health Care Waste Management Manual of Department of Health, 2004.",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Written policy and procedures on waste Management.",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Proper collection, segregation, coding, storage, and disposal of wastes (for both solid and liquid wastes)",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Use of protective equipment and clothing appropriate for handling, storage, and disposal of wastes.",
								"10. Building maintenance program",
								"11. Pest and vermin control program Documented policies for pest and vermin control program",
								"12. Medical Records",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Confidentiality of patient information",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Medical diagnoses, procedures and/or operations performed on patients are recorded using ICD-10.",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Policy and procedures for retention and disposal of medical records.",
							);
						@endphp
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 70%">STANDARDS AND REQUIREMENTS</th>
									<th scope="col">COMPLIANT</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td colspan="3">
										<p><b>MANUAL OF OPERATIONS/STANDARD OPERATING PROCEDURES</b></p>
									</td>
								</tr>
								<tr class="at-tr-subhead">
									<td colspan="3">
										<p>
											Efficient and effective governance ensures a planned and coordinated service delivery system appropriate to the needs of patients, families and service providers.
										</p>
									</td>
								</tr>
								@for($i=0; $i<count($arr3); $i++) 
									<tr>
										<td>{{$arr3[$i]}}</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>
						<p><b>IV. RECORDS/FILES</b></p>
						@php
							$arr4a = array(
								"1. Human Resource Management",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Verificatio n of credentials of personnel",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Review of effectiveness of training provided to personnel",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Proof of orientation given to new personnel (i.e. communication, attendance to orientation)",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Monitoring and evaluation of performance of personnel",
								"2. Quality Management Program",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Minutes of meeting",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Attendance log book",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. File of customer satisfaction survey/feedback, analyses, and corrective actions taken",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Reports of adverse, unplanned or untoward events and recommendations for preventive/corrective action",
								"&nbsp;&nbsp;&nbsp;&nbsp;e. Evidence of implementation of preventive/corrective actions",
								"3. Equipment",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Calibration certificates (third party)",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. records of equipment maintencance",
								"4. Physical Facility",
								"&nbsp;&nbsp;&nbsp;&nbsp;Water Analysis Report (Bacteriological)",
								"5. Waste Management",
								"&nbsp;&nbsp;&nbsp;&nbsp;Wastes are properly segregated, coded and labeled as follows:",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. General/Non-infectious/Dry – Black",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. General/Non-infectious/Wet – Green",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Infectious/Pathological – Yellow",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. Sharps – Sharps container",
								"6. Building Maintenance",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Schedule of building maintenance",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Reports of building maintenance",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Report of water tank/reservoir flushing",
								"7. Pest and Vermin Control",
								"&nbsp;&nbsp;&nbsp;&nbsp;Reports of activities of pest and vermin control",
								"8. Notarized Memorandum of Agreements",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Patient Transport Service Provider (if applicable)",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Security Service",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Utility Service",
								"&nbsp;&nbsp;&nbsp;&nbsp;d. At least one Level Two Hospital for the provision of inpatient care especially during emergencies and other hospital services.",
								"&nbsp;&nbsp;&nbsp;&nbsp;e. Waste management service",
								"&nbsp;&nbsp;&nbsp;&nbsp;f. Pest and vermin control service (if applicable)",
							);
						@endphp
						<table class="table table-bordered black">
							<thead class="text-center at-td-mid">
								<tr class="at-tr-head">
									<th scope="col" style="width: 70%" rowspan="2">STANDARDS AND REQUIREMENTS</th>
									<th scope="col" colspan="2">COMPLIANT</th>
									<th scope="col" rowspan="2">REMARKS</th>
								</tr>
								<tr class="at-tr-head">
									<th>INITIAL</th>
									<th>RENEWAL</th>
								</tr>
							</thead>
							<tbody>
								@for($i=0; $i<count($arr4a); $i++)
									<tr>
										<td>{{$arr4a[$i]}}</td>
										<td>
											@if($i == 6 || $i == 7)
												N/A
											@else

											@endif
										</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>
						<p><b>V. Checklist of Requirements on Medical Records, Equipment, Instruments, and Medicines for Ambulatory Surgical Clinic</b></p>
						@php
							$arr5 = array(
								"5. Medical Records",
								"&nbsp;&nbsp;&nbsp;&nbsp;a. Diagnoses, procedures and operations are recorded in patient charts using ICD-10",
								"&nbsp;&nbsp;&nbsp;&nbsp;b. Patient logbook",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.1 Outpatient department",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2 Operating Room",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.1 Case Number",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.2 Date",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.3 Patient name",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.4 Age",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.5 Gender",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.6 Pre-operative Diagnosis",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.7 Procedure done",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.8 Post-operative diagnosis",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.9 Time started",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.10 Time ended",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.11 Surgeon",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.12 Anesthesiologist",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b.2.13 Nurse",
								"&nbsp;&nbsp;&nbsp;&nbsp;c. Content of Patient Chart",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.1 Identification Data",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.2 Chief Complaint",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.3 History of Present Illness",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.4 Physical Examination",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.5 Diagnosis",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.6 Attending Physician",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.7 Clinical Laboratory Report",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.8 X-ray report",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.9 Consultation/Referral Notes",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.10 Medication/Treatment",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.11 Nurse’s Notes",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.12 Consent",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.13 Doctor’s Order Sheet",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.14 Operative Technique",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.15 Anesthesia Record",
								"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c.16 Discharge Summary",
							);
						@endphp
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 70%" rowspan="2">STANDARDS AND REQUIREMENTS</th>
									<th scope="col" colspan="2">COMPLIANT</th>
									<th scope="col" rowspan="2">REMARKS</th>
								</tr>
								<tr class="at-tr-head">
									<th>INITIAL</th>
									<th>RENEWAL</th>
								</tr>
							</thead>
							<tbody>
								@for($i=0; $i<count($arr5); $i++)
									<tr>
										<td>{{$arr5[$i]}}</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endfor
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>
						<p><b><i>All Ambulatory Surgical Clinics shall have the following equipment, instruments and medicines. Place a check (/) if the ASC if compliant and x mark (X) if not compliant.</i></b></p>
						@php
							$arr6a = array(
								"Ambu bag (adult and pedia)",
								"Anesthesia machine with tanks of gases and gauges",
								"Autoclave machine",
								"Cardiac monitor",
								"Cardiac board",
								"Clinical Weighing Scale",
								"Computer/Typewriter",
								"Defibrillator",
								"Electrocautery machine",
								"Emergency lights",
								"Emergency medicine cart/tray",
								"Endotracheal tubes (all sizes)",
								"Examining table",
								"Fire extinguisher",
								"Foot stool",
								"Instrument table"
							);
							$arr6b = array(
								"Instrument tray",
								"IV stand",
								"Laryngoscope with curve and straight blades, spare bulb and battery",
								"Minor Surgical Set",
								"Operating Light",
								"Operating Table",
								"Oxygen tank with gauge in trolley or rack",
								"Patient Transport Vehicle",
								"Pulse oximeter",
								"Sphygmomanometer",
								"Standby generator",
								"Stethoscope",
								"Stretcher",
								"Suction machine",
								"Thermometer",
								"Wheelchair"
							);

							$arr6c = array(
								"Amiodarone 150mg/ampule",
								"Aspirin USP grade 325mg/tab)",
								"Atropine 1 mg/mL ampule",
								"B-adrenergic agonists like Salbutamol 2 mg/mL",
								"Benzodiazepine (Diazepam 10 mg/2 mL ampule and/or Midazolam)",
								"D5 0.3 NaCl 500 mL",
								"D5 LR 1 L/bottle",
								"D5NM 500 mL/bottle",
								"D5 NSS 1 L/bottle",
								"Mefenamic acid 500 mg/tablet",
								"Meperidine 100mg/vial",
								"Metoclopromide 10mg/ ampule",
								"Morphine sulfate 10 mg/ ampule",
								"Nitroglycerine spray or Isosorbide dinitrate 5 mg/tab/amp",
								"Noradrenaline 2 mg/ampule",
								"Paracetamol 300 mg/ampule"
							);

							$arr6d = array(
								"D5W 250 ML/bottle",
								"Dexamethasone",
								"Diphenhydramine 50 mg/ampule",
								"Dobutamine 250 mg/20 mL vial",
								"Dopamine 200 mg/vial",
								"Epinephrine 1 mg/mL",
								"Hydrocortisone 250 mg/vial",
								"Hyoscine N-butyl- bromide 20 mg/vial",
								"Lidocaine 5% solution/vial",
								"Plain LRS 1 L/bottle",
								"Plain NSS I L/bottle",
								"Sodium bicarbonate 50 mEq/ampule",
								"Tramadol 50 mg/cap",
								"Verapamil 5 mg/2mL ampule",
								"5 Caloric agent (D50 W50 mL/vial)",
								""
							);
						@endphp
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col"></th>
									<th scope="col">COMPLAINTS</th>
									<th scope="col">REMARKS</th>
									<th scope="col"></th>
									<th scope="col">COMPLAINTS</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td colspan="6">
										<b>EQUIPMENT/INSTRUMENTS</b>
									</td>
								</tr>
								@for($i=0; $i<count($arr6a); $i++)
									<tr>
										<td>{{$arr6a[$i]}}</td>
										<td></td>
										<td></td>
										<td>{{$arr6b[$i]}}</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
								<tr class="at-tr-subhead">
									<td colspan="6">
										<b>MEDICINES</b>
									</td>
								</tr>
								@for($i=0; $i<count($arr6c); $i++)
									<tr>
										<td>{{$arr6c[$i]}}</td>
										<td></td>
										<td></td>
										<td>{{$arr6d[$i]}}</td>
										<td></td>
										<td></td>
									</tr>
								@endfor
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>
						<table class="mb-3 w-100 container">
							<thead>
								<tr>
								</tr>
							</thead>
							<tbody >
								<!-- name health faci bottom -->
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Facility:">
									</td>
								</tr>
								<!-- date of inspection -->
								<tr>
									<td colspan="2">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">Date of Inspection/Monitoring</span>
											<input type="date" name="" class="form-control" placeholder="Date of Inspection/Monitoring:">
			                            </div>
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<p><b>RECOMMENDATIONS</b></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><b>A. For Licensing Process:</b></p>
									</td>
								</tr>
								<tr class="form-inline">
									<td colspan="2" class="">
										<label class="radcont">
											<input type="radio" name="recommendation" onchange="a_button(this)" id="a_first">
											<span class="radchkmark"></span>
										</label>
										<span class="ml-5">For issuance of License to Operate as <u>Ambulatory Surgical Clinic</u>.</span>
									</td>
								</tr>
								<tr>
									<td colspan="2" class="pt-5" hidden>
										<input type="" name="" class="form-control w-100" placeholder="Number of Stations" disabled id="a_frist_0">
									</td>
								</tr>
								<tr>
									<td colspan="2" hidden>
										<input type="" name="" class="form-control w-100" placeholder="Classification" disabled id="a_frist_1">
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group-prepend mt-3">
											<span class="input-group-text" id="basic-addon1">Validity from</span>
											<input type="date" name="" class="form-control" placeholder="Date of Inspection:" disabled id="a_frist_2">
			                            </div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">to</span>
											<input type="date" name="" class="form-control" placeholder="Date of Inspection:" disabled id="a_frist_3">
			                            </div>
									</td>
								</tr>
								<tr class="form-inline">
									<td colspan="2" class="pt-5">
										<label class="radcont"> 
											<input type="radio" name="recommendation" onchange="a_button(this)" id="a_second">
											<span class="radchkmark"></span>
										</label>
									</td>
									<td class="ml-5">
										Issuance depends upon compliance to the recommendations given and submission of the following within <input type="" name="" class="ml-4 form-control" disabled id="a_second_0"> &nbsp; days from the date of inspection/monitoring:
									</td>
								</tr>
								<tr>
									<td>
										<textarea rows="10" class="form-control" disabled id="a_second_1"></textarea>
									</td>
								</tr>
								</div>

								<tr class="form-inline">
									<td colspan="2" class="pt-5">
										<label class="radcont"> 
											<input type="radio" name="recommendation" onchange="a_button(this)" id="a_third">
											<span class="radchkmark"></span>
										</label>
										<span class="ml-5">Non-Issuance: Specify reason/s.</u></span>
									</td>
								</tr>
								<tr>
									<td class="pt-3">
										<textarea rows="10" class="form-control" disabled id="a_third_0"></textarea>
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<b>Inspected by:</b>
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Printed Name">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Signature">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Position/Designation">
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<b>Received by:</b>
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Signature">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Printed Name">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Position/Designation">
									</td>
								</tr>
								<tr>
									<td>
										Date:
									</td>
								</tr>
								<tr>
									<td>
										<input type="date" name="" class="form-control">
									</td>
								</tr>
							</tbody>
						</table>
						<br><br>
						<hr>
						<br><br>

						<table class="mb-3 w-100 container">
							<thead>
								<tr>
								</tr>
							</thead>
							<tbody >
								<!-- name dialysis clinic bottom -->
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Dialysis Clinic:">
									</td>
								</tr>
								<!-- date of inspection -->
								<tr>
									<td colspan="2">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">Date of Inspection</span>
											<input type="date" name="" class="form-control" placeholder="Date of Inspection:">
			                            </div>
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<p><b>RECOMMENDATIONS</b></p>
									</td>
								</tr>
								<tr>
									<td>
										<p><b>B. For Monitoring Process:</b></p>
									</td>
								</tr>
								<tr class="form-inline b-3">
									<td colspan="2" class="">
										<label class="radcont">
											<input type="radio" name="recommendation" onchange="b_button(this)" id="b_first">
											<span class="radchkmark"></span>
										</label>
										<span class="ml-5"> Issuance of Notice of Violation</span>
									</td>
								</tr>
								<tr>
									<td class="pt-3 pb-3">
										<textarea class="form-control" rows="10" id="b_first_0" disabled></textarea>
									</td>
								</tr>
								<tr class="form-inline b-3">
									<td colspan="2" class="">
										<label class="radcont">
											<input type="radio" name="recommendation" onchange="b_button(this)" id="b_second">
											<span class="radchkmark"></span>
										</label>
										<span class="ml-5">Non-issuance of Notice of Violation</span>
									</td>
								</tr>
								<tr>
									<td class="pt-3 pb-3">
										<textarea class="form-control" rows="10" id="b_second_0" disabled></textarea>
									</td>
								</tr>
								<tr class="form-inline b-3">
									<td colspan="2" class="">
										<label class="radcont">
											<input type="radio" name="recommendation" onchange="b_button(this)" id="b_third">
											<span class="radchkmark"></span>
										</label>
										<span class="ml-5">Others (Specify)</span>
									</td>
								</tr>
								<tr>
									<td class="pt-3 pb-3">
										<textarea class="form-control" rows="10" id="b_third_0" disabled></textarea>
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<b>Monitored by:</b>
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Printed Name">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Signature">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Position/Designation">
									</td>
								</tr>
								<tr>
									<td class="pt-5">
										<b>Received by:</b>
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Signature">
									</td>
								</tr>
								<tr>
									<td>
										<input type="" name="" class="form-control" placeholder="Printed Name">
									</td>
								</tr>
								<tr>
									<td c>
										<input type="" name="" class="form-control" placeholder="Position/Designation">
									</td>
								</tr>
								<tr>
									<td>
										Date:
									</td>
								</tr>
								<tr>
									<td>
										<input type="date" name="" class="form-control">
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
			@endisset
	    </div>
	</div>
	@include('employee.cmp._assessmentJS') {{-- Javascript for this Module --}}
@endsection