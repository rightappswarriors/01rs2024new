@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	        	DRUG TESTING LABORATORY
	        </div>
	        
	        <div class="container p-4">
				<div class="container pb-3">
					<p class="text-center mb-5"><b>ASSESSMENT TOOL FOR ACCREDITATION OF DRUG TESTING LABORATORY</b></p>
					<p><b>I. FACILITY INFORMATION</b></p>
					<form>
						<table class="mb-3 w-100" >
							
							<tbody>
								<!-- name -->
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Laboratory:"><br>
									</td>
								</tr>
								<!-- complete addr -->
								<tr>
									<td>Complete Address</td>
								</tr>
								<tr>
									<td>
										{{-- region --}}
										<select type="" class="form-control" id="d_region" onchange="regionSelect()">
											<option value="" hidden disabled selected>Region*</option>
											
										</select>
									</td>
									<td colspan="2">
										{{-- province --}}
										<select  type="" class="form-control" id="d_prov" onchange="provSelect()">
											<option value="" hidden disabled selected>Province*</option>
											
										</select>
									</td>
								</tr>
								<tr>
									<td>
										{{-- cm --}}
										<select type="" class="form-control" id="d_cm" onchange="cmSelect()">
											<option value="" hidden disabled selected>City/Municipality*</option>
											
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
										<input type="" name="" class="form-control" placeholder="No. & Street"><br>
									</td>
								</tr><br>
								
								<tr>
									<td class="">
										<input type="" name="" class="form-control" placeholder="Contact Number"><br>
									</td>
									<td class="">
										<input type="" name="" class="form-control" placeholder="E-mail Address"><br>
									</td>
								</tr>
								{{-- name of owner --}}
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Owner or Corporation"><br>
									</td>
								</tr>
								{{-- name of head facility --}}
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Head of Laboratory"><br>
									</td>
								</tr>
								
							</tbody>
						</table>
						{{-- Type --}}
						<div>
							<div class="row mb-3">
								<table class="table table-bordered black" style="margin:1em;">
									<tbody>
										<tr>
											<td>
												<b><u>Application for:</u></b><br>

												<label>
													<input type="radio" name="application" style="margin-right:1em;">Initial</input>
												</label><br>
												<label>
													<input type="radio" name="application" style="margin-right:1em;">Renewal</input>
												</label><br>
								
												<label>
													<input type="radio" name="application" style="margin-right:1em;">New</input>
												</label><br>

												<label>
													<input type="radio" name="application" style="margin-right:1em;">Existing with change/s.Specify <textarea class="form-control" rows="2"></textarea></input>
												</label><br>
												<label>
													Accreditation No.<input type="textarea"><br>
													Expiry Date<input type="date" name="" class="form-control">
												</label>
											</td>
											<td>
												<b><u>Classification:</u></b><br>
												<div class="row">
													<div class="col">
														<label style="margin-left:1em;">Ownership:</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="ownership" style="margin-right:1em;">Government</input>
														</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="ownership" style="margin-right:1em;">Private</input>
														</label><br>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<label style="margin-left:1em;">Institutional Character:</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="institutionalchar" style="margin-right:1em;">Institution-based</input>
														</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="institutionalchar" style="margin-right:1em;">Free-standing</input>
														</label><br>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<label style="margin-left:1em;">Service Capability:</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="servicecap" style="margin-right:1em;">Screening</input>
														</label><br>
														<label style="margin-left:2em;">
															<input type="radio" name="servicecap" style="margin-right:1em;">Confirmatory</input>
														</label><br>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
						<br><br>
						<p><b>II. TECHNICAL REQUIREMENTS</b></p>
						<p>
							<i>Instruction: In the appropriate box, place a check mark (/) if the drug testing laboratory is compliant or x mark (X) if it is not compliant.</i>
						</p>

						@php 
							$app = array(
								"Vision, Mission and Objectives (should be in accordance with RA 9165 'Comprehensive Dangerous Drug Act of 2002')",
								"Policy for hiring, orientation, and promotion for all levels of personnel",
								"Continuing Education/Training Program for Staff",
								"Policy for discipline, suspension, demotion and termination of all personnel at all levels",
								"Procedures for handling complaints and laboratory accidents",
								"Quality Plan - A written program/plan of management to assure competence, integrity of drug testing",
								"Policy for waste management and housekeeping",
								"Policy for equipment maintenance and repair"
							);
							$tpp = array(
								"Specimen Collection/ Sampling (within the laboratory)",
								"Receiving, Accessioning and Releasing of Specimen",
								"Specimen Rejection/ Cancellation",
								"Referral to Confirmatory Laboratory when positive results ws obtained",
								"Remote Collection",
								"Reagents, Standards and Controls",
								"Analytical Procedure",
								"Mechanism of Reporting Results",
								"Procedure for Security and Confidentialit of Records, Suppiles and Specimen",
								"Storage and Disposal of Specimen *for CDTL, include storage and disposal of chemicals",
								"Internal Quality Assurance Program",
								"External Quality Assurance Program",
								"Good Laboratory Practice"
							);
						@endphp
						
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 50%">STANDARDS AND REQUIREMENTS</th>
									<th scope="col">INSPECTION</th>
									<th scope="col">MONTORING</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td >
										<p><b>A. PERSONNEL</b></p>
										<b>
											Every DTL shall have an adequate number of qualified, trained, and competent staff to ensure efficient and effective delivery of services.
										</b>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<b>ORGANIZATIONAL CHART</b>
										<p>The organizational chart shall be clearly structured indicating the name and designation of all personnel with corresponding picture.</p>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<b>HEAD OF THE LABORATORY</b>
										<ul>
											<li>
												For SDTL
												<ul style="list-style-type: circle;">
													<li>
														Free Standing
														<br><input type="checkbox">Clinical Pathologist</input>
														<br><input type="checkbox">Physician trained in Laboratory Management</input>
														<br><input type="checkbox">Chemist</input>
													</li>
													<li>
														Institution-based
														<br><input type="checkbox">Clinical Pathologist/Trained Physician</input>
														<br><input type="checkbox">Chemist</input>
														<br><input type="checkbox">Medical Technologist</input>
														<br><input type="checkbox">Pharmacist</input>
														<br>
													</li>
												</ul>
											</li>
											<li>
												For CDTL
													<br><input type="checkbox">Clinical Pathologist</input>
													<br><input type="checkbox">Chemist</input>
											</li>
											
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<b>ANALYST</b>
										<ul>
											<br><input type="checkbox">Chemist</input>
											<br><input type="checkbox">Medical Technologist</input>
											<br><input type="checkbox">Pharmacist</input>
											<br><input type="checkbox">Chemical Engineer</input>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<b>201 FILES</b>(All records should be within the laboratory premises)
										<ul>
											<li>HEAD OF LABORATORY
											<br>Name:<input class="textarea">
											<br><input type="checkbox">Resume</input>
											<br><input type="checkbox">PRC ID (Valid)</input>
											<br><input type="checkbox">PRC Board Certificate</input>
											<br><input type="checkbox">Written & notarized employment contract/appointment as head of lab.</input>
											<br><input type="checkbox">For Clinical Pathologist, certificate from Philippine Society of Pathologist</input>
											<br><input type="checkbox">For Non-Pathologist, Certificate of Laboratory Management for DTL conducted by DOH</input>
											<br>Certificate No.<input class="textarea">
											<br><input type="checkbox">Job description (detailed description of tasks, responsibilities and accountabilities)</input>
											<br><input type="checkbox">Complete, updated and notarized list of DTLs handled to include each address and work schedule</input>
											<br><u>For CDTL only:</u>
											<br><input type="checkbox">2years of active laboratory experience in analytical toxicology</input>
											<br><input type="checkbox">If chemist, master's degree in Chemistry/Biochemistry/other fields of chemistry</input>
										</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>
												ANALYST
												<br><input type="checkbox">Resume</input>
												<br><input type="checkbox">PRC ID (Valid)</input>
												<br><input type="checkbox">PRC Board Certificate</input>
												<br><input type="checkbox">Written & notarized employment contract/appointment as analyst</input>
												<br><input type="checkbox">Certificate of training for SDTL conducted by DOH</input>
												<br>Certificate No.<input class="textarea">
												<br><input type="checkbox">Certificate of training for CDTL conducted by DOH</input>
												<br><input type="checkbox">Job description (detailed description of tasks, responsibilities and accountabilities)</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>
												AUTHORIZED SPECIMEN COLLECTOR (ASC) <small>*Applicable for SDTL only</small>
												<br><input type="checkbox">Resume</input>
												<br><input type="checkbox">Written and notarized employment contract/appointment as ASC</input>
												<br><input type="checkbox">Certificate of training conducted by the Laboratory signed by HOL</input>
												<br><input type="checkbox">Job description (detailed description of tasks, responsibilities and accountabilities)</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>
												HEALTH STATUS
												<br><input type="checkbox">Medical/Health Certificate(valid)</input>
												<br><input type="checkbox">Annual drug test report conducted by another accredited DTL </input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<b>WORK SCHEDULE</b>
										<ul style="list-style-type: circle;">
											<li>
											Monthly schedule of duties and assignment posted within the laboratory
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr class="at-tr-subhead">
									<td >
										<p><b>B. PHYSICAL FACILITIES</b></p>
										<b>
											The laboratory has adequate space for conduct of its activities.
										</b>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>
												FLOOR AREA
												<ul style="list-style-type: circle;">
													<li>SCREENING LABORATORY
														<ul style="list-style-type: square;">
															<li>FREE-STANDING
																<br><input type="checkbox">Approved PTC (for new facility)</input>
																<br><input type="checkbox">Floor Area (20 sq.m.)</input>
															</li>
															<li>INSTITUTION-BASED
																<br><input type="checkbox">Working Area of Seconday/Tertiary Clinical Lab. (designated area Exclusive for drug testing)</input>
															</li>
														</ul>
													</li>
													<br>
													<li>CONFIRMATORY LABORATORY
														<br><input type="checkbox">Floor Area (60 sq.m.)</input>
														<br><input type="checkbox">Stock Room</input>
														<br><input type="checkbox">Instrumentation Room</input>
													</li>
												</ul>
											</li>
											<br><p>A laboratory of whatever category shall have within its premises the following:</p>
											<ul style="list-style-type: square;">
												<li>Receiving Area (can accommodates at least 5 clients at a given time)
													<br>--Suggestion box for Client's Feedback
												</li>
												<li>Toilet Facility</li>
											</ul>											
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>POSTED IN CONSPICUOUS AREA
												<br><input type="checkbox">For SDTL, poster detailing the process flow of drug testing</input>
												<br><input type="checkbox">Vision, mission and objectives</input>
												<br><input type="checkbox">Organizational Chart</input>
												<br><input type="checkbox">Local Permits</input>
												<br><input type="checkbox">Licenses and Certificates of personnel</input>
												<br><input type="checkbox">NO SMOKING Signage</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>SPECIMEN COLLECTION AREA(SDTL)
												<br><input type="checkbox">Waterless urinal</input>
												<br><input type="checkbox">Handwashing Facility</input>
												<ul style="list-style-type: square;">
													<li>Outside the toilet</li>
													<li>Within, provided with partition</li>
													<li>With free flowing water supply from the faucet</li>
												</ul>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>WORKING AREA
												<br><input type="checkbox">At least 10sq.m. for free standing SDTL</input>
												<br><input type="checkbox">At least 30sq.m. for Confirmatory Lab.</input>
												<br><input type="checkbox">Sink(with countertop and faucet with adequate water supply</input>
												<br><input type="checkbox">Functional exhaust fan</input>
												<br><input type="checkbox">Electric fan/air conditioner unit may be used for improved ventilation</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul><li>PERIODIC SIGNAGE PER AREA</li></ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>WASTE MANAGEMENT AND HOUSEKEEPING
												<br><input type="checkbox">Solid Waste - Practice of waste segregation</input>

												<br><input type="checkbox">Liquid Waste</input>
													<ul style="list-style-type: square;">
														<li>Proper disposal of urine specimen</li>
														<li>Proper disposal of used and expired reagents either by neutralization, delay to decay or through the drainage system (Applicable for CDTL only)</li>
													</ul>
												<input type="checkbox">Housekeeping</input>
													<ul style="list-style-type: square;">
														<li>Facility is kept clean, safe and odor-free</li>
														<li>There should be a program for pest and vermin control</li>
														<li>Supplies are kept and secured</li>
													</ul>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul><li>PROGRAM FOR THE PROPER MAINTENANCE AND MONITORING OF PHYSICAL PLANT AND FACILITIES</li></ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr class="at-tr-subhead">
									<td >
										<p><b>C. EQUIPMENT, SUPPLIES AND FIXTURES</b></p>
										<input type="checkbox">Schedule of preventive maintenance of equipment</input>
										<br><input type="checkbox">Inventory relative to the workloada and procurement receipts of supplies</input>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>REFRIGERATOR/FREEZER
												<br><input type="checkbox">Properly maintained and functional, strictly for urine specimen</input>
												<br><input type="checkbox">Laboratory thermometer inside refrigerator/freezer (non-mercurial)</input>
												<br><input type="checkbox">Daily monitoring temperature record posted on the unit</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>INFORMATION TECHNOLOGY<br>REQUIREMENTS
												<ul style="list-style-type: square;">
													<li>Windows XP operating system</li>
													<li>1.5 GHz processor</li>
													<li>4GB HDD</li>
													<li>ISP 128Kbps CIR</li>
													<li>Fingerprint Biometric Scanning Device</li>
													<li>Webcam (For SDTL only)</li>
													<li>Megamatcher License Dangle</li>
													<li>Ink or Laser printer</li>
													<li>DOH-IDTOMIS</li>
												</ul>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>SUPPLIES
												<br><input type="checkbox">Specimen Container(For SDTL only)</input>
												<br>-&nbsp;&nbsp; 60 mL polyethylene, wide mouth with screw cap
												<br><input type="checkbox">Plastic Bag(For SDTL only)</input>
												<br>-&nbsp;&nbsp; Transparent, self-sealing/sealable and leak proof, capable of containing the specimen and pertinent documents (CCF)
												<br><input type="checkbox">Gloves - disposable</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>FIXTURES
												<br><input type="checkbox">Cabinet</input>
												<br>-&nbsp;&nbsp; With lock to secure and store records and supplies
												<br><input type="checkbox">Tables/Chairs/Bench</input>
												<br>-&nbsp;&nbsp; Tables and chairs allotted for personnel
												<br>-&nbsp;&nbsp; Chairs/bench that can accommodate at least 5 clients at the same time
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr class="at-tr-subhead">
									<td >
										<p><b>D. STANDARD OPERATING PROCEDURES</b></p>
										<p>The DTL shall have a Manual of Standard Operating Procedures containing documented policies, protocols, guidelines in the operation and maintenance of the laboratory.</p>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li><b>Administrative Policies and Procedures</b></li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@for($i=0; $i<count($app); $i++)
									<tr>
										<td>
											<ul style="list-style-type: circle;">
												<li>{{$app[$i]}}</li>
											</ul>
										</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endfor
								<tr>
									<td>
										<ul>
											<li><b>Technical Policies and Procedures</b></li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								@for($i=0; $i<count($tpp); $i++)
									<tr>
										<td>
											<ul style="list-style-type: circle;">
												<li>{{$tpp[$i]}}</li>
											</ul>
										</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								@endfor
								<tr class="at-tr-subhead">
									<td >
										<p><b>E. RECORDS/FILES</b></p>
										<p>Systematic filing and safekeeping of records</p>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li><u>For SDTL</u>
												<br><input type="checkbox">Laboratory file copy of results with corresponding attached test kit membrane (For Renewal)</input>
												<br><input type="checkbox">File of letters of request for confirmatory drug test received by CDTL/with attached copy of receipt from courier (For Renewal)</input>
												<br><input type="checkbox">File of submitted MFR through IDTOMIS (For Renewal)</input>
												<br><input type="checkbox">Memorandum of Agreement with Confirmatory Drug Testing Laboratory</input>
												<br>Name of CDTL:<input class="textarea">
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>FORMS(For SDTL)
												<br>For renewal, completely and properly filled-out.
												<ul style="list-style-type: circle;">
													<li>Custody and Control Form(CCF)</li>
													<li>Consent Form</li>
												</ul>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>LOGBOOKS
												<br>Properly labeled. For renewal, with updated entries
												<ul style="list-style-type: circle;">
													<li>Remote Collection (For SDTL only)</li>
													<li>Receiving, Accessioning and Releasing (For SDTL only)</li>
													<li>Confirmatory (For SDTL only)</li>
													<li>Test Results</li>
													<li>Quality Control Results</li>
													<li>Equipment Preventive Maintenance</li>
													<li>Storage and Disposal of Specimen</li>
													<li>Visitor's Logbook</li>
												</ul>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr class="at-tr-subhead">
									<td >
										<p><b>F. QUALITY IMPROVEMENT ACTIVITIES</b></p>
										<p>The drug testing laboratory shall practice Quality Assurance Program (QAP) and Continuous Quality Improvement (CQI) reviewed periodically.</p>
										<ul style="list-style-type: circle;">
											<li>Client Satisfaction Survey (e.g. comments, feedback)</li>
											<li>Records of complaints and laboratory accidents</li>
											<li>Corrective Actions Taken (For renewal)</li>
											<li>Management/staff meetings conducted at least twice a year (with minutes of meetings)<br>-For Renewal</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<ul>
											<li>EXTERNAL QUALITY ASSURANCE PROGRAM (For Renewal of Accreditation)
												<br><input type="checkbox">Application for proficiency test</input>
												<br><input type="checkbox">Record of receipt of samples for EQAS from NRL</input>
												<br><input type="checkbox"> Logbook/Record of PT Results</input>
												<br><input type="checkbox">Certificate of PT</input>
												<br><input type="checkbox">Record of corrective action taken when evaluation of performance is below satisfactory</input>
											</li>
										</ul>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>

							</tbody>
						</table>
						
					
			
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
										<div class="input-group-prepend">
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
										<input type="" name="" class="form-control" placeholder="Name of Health Facility:">
									</td>
								</tr>
								<!-- date of inspection -->
								<tr>
									<td colspan="2">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">Date of Monitoring</span>
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
	    </div>
	</div>
	@include('employee.cmp._assessmentJS') {{-- Javascript for this Module --}}
@endsection