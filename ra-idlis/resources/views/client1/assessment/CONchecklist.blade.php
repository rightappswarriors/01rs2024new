@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	<body>
		<style>
			
		</style>
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

		<div class="container mb-3 border p-3">
			<div class="col text-left h4 text-capitalize">
				CHECKLIST OF DOCUMENTS
			</div>
			{{-- <div class="row pl-3 pt-3">
				<div class="col-1">
					<input type="checkbox" name="appform">
				</div>
				<div class="col-10 h6">
					Application Form for Certificate of Need for Hospitals
				</div>
			</div> --}}
			<div class="row pl-3">
				<div class="col-1">
					<input type="checkbox" name="cert">
				</div>
				<div class="col-10 h6">
					Certification from Provincial Planning and Development Office that the Proposed
					Hospital is part of the duly approved Provincial Hospital/Health Care Delivery Plan
					(if available)
				</div>
			</div>
			{{-- new checklist --}}
			<div class="row pl-3 mt-5">
				<div class="col-1">Note:</div>
				<div class="col-10 h6">
					The CHD may ask for additional requirements should there be more than one applicant covering the same catchment area.
				</div>
			</div>
			
			<div class="col text-left h4 text-center mt-5 mb-5">
				CHECKLIST FOR REVIEW OF FLOOR PLANS<br>
				LEVEL 1 HOSPITAL
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-3">Name of Hospital:</div>
					<div class="col-9">hospital</div>
				</div>
				<div class="row">
					<div class="col-2">Address:</div>
					<div class="col-9">address</div>
				</div>
				<div class="row pt-3">
					<div class="col-2">Date</div>
					<div class="col-2">1/1/1</div>
					<div class="col-2">Review</div>
					<div class="col-2">1st &nbsp;<input type="checkbox"></div>
					<div class="col-2">2nd &nbsp;<input type="checkbox"></div>
					<div class="col-2">3rd &nbsp;<input type="checkbox"></div>
				</div>
				
				<div class="text-left font-weight-bold pt-3">
					1. PHYSICAL PLANT
				</div>
				<div class="container-fluid border">
					<ul>

						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 1.1 &nbsp;<span class="font-weight-bold">Administrative Service</span>
							</div>
							<ul>

								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.1 &nbsp;<span class="font-weight-bold">Lobby</span>
									</div>
									<ul class="pt-1">

										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.1 &nbsp;<span class="font-weight-bold">Waiting Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.2 &nbsp;<span class="font-weight-bold">Information and Reception Area and Admintting Section</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.3 &nbsp;<span class="font-weight-bold">Public Toilet (Male/Female/PWD)</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.4 &nbsp;<span class="font-weight-bold">Staff Toilet</span>
											</div>
										</li>

									</ul>
								</li>
								<li class="pt-1">
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.2 &nbsp;<span class="font-weight-bold">Business Office</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.3 &nbsp;<span class="font-weight-bold">Medical Records <i>Office</i></span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.4 &nbsp;<span class="font-weight-bold">Prayer Area<i>/Room</i></span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.5 &nbsp;<span class="font-weight-bold">Office of the Chief of Hospital</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.6 &nbsp;<span class="font-weight-bold">Laundry* and Linen <i>Section</i></span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.7 &nbsp;<span class="font-weight-bold">Maintenance and Housekeeping <i>Section</i>*</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.8 &nbsp;<span class="font-weight-bold">Parking Area for Transport Vehicle(Ambulance)</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.9 &nbsp;<span class="font-weight-bold">Supply Room</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.10 &nbsp;<span class="font-weight-bold">Waste Holding Room</span>
									</div>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.11 &nbsp;<span class="font-weight-bold">Dietary</span>
									</div>
								</li>
									<ul class="pt-1">

										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.1 &nbsp;<span class="font-weight-bold">Dietitian Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.2 &nbsp;<span class="font-weight-bold">Supply Receiving Area*</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.3 &nbsp;<span class="font-weight-bold">Food Preparation Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.4 &nbsp;<span class="font-weight-bold">Cooking and Baking Area*</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.5 &nbsp;<span class="font-weight-bold">Cold and Dry Storage Area*</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.6 &nbsp;<span class="font-weight-bold">Serving and Food Assesmbly Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.7 &nbsp;<span class="font-weight-bold">Washing Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.8 &nbsp;<span class="font-weight-bold">Garbage Disposal Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.9 &nbsp;<span class="font-weight-bold">Dining Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.1.11.10 &nbsp;<span class="font-weight-bold">Toilet</span>
											</div>
										</li>

									</ul>
								<li class="pt-1">
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.1.12 &nbsp;<span class="font-weight-bold">Cadaver Holding Room</span>
									</div>
								</li>
							</ul>
						</li>
						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 1.2 &nbsp;<span class="font-weight-bold">Clinical Service</span>
							</div>

							<ul>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.2.1 &nbsp;<span class="font-weight-bold">Emergency Room</span>
									</div>
								</li>
								
								<ul class="pt-1">

										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.1.1 &nbsp;<span class="font-weight-bold">Waiting Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.2 &nbsp;<span class="font-weight-bold">Toilet</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.3 &nbsp;<span class="font-weight-bold">Nurses' Station <i>with Work Area with Lavatory/Sink</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.4 &nbsp;<span class="font-weight-bold">Minor Operating Room/<i>Surgical Area</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.5 &nbsp;<span class="font-weight-bold">Examination and Treatment Area with Lavatory/Sink</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.6 &nbsp;<span class="font-weight-bold">Observation Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.7 &nbsp;<span class="font-weight-bold">Equipment and Supply Storage Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.8 &nbsp;<span class="font-weight-bold">Wheeled Stretcher Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.9 &nbsp;<span class="font-weight-bold">Dining Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.11.10 &nbsp;<span class="font-weight-bold">Toilet</span>
											</div>
										</li>

									</ul>
							
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.2.2 &nbsp;<span class="font-weight-bold">Outpatient Department (Separate from ER Complex)</span>
									</div>

									<ul class="pt-1">

										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.2.1 &nbsp;<span class="font-weight-bold">Waiting Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.2.2 &nbsp;<span class="font-weight-bold">Toilet (Male/Female/PWD)</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.2.3 &nbsp;<span class="font-weight-bold">Admitting and Records Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.2.4 &nbsp;<span class="font-weight-bold">Examination and Treatment Area with Lavatory/Sink (OB, Medicine, Pedia, Surgery, Dental-optional)</span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.2.3 &nbsp;<span class="font-weight-bold">Surgical and Obstetrical Service</span>
									</div>
									
	
									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.1 &nbsp;<span class="font-weight-bold">Major Operating Room</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.2 &nbsp;<span class="font-weight-bold">Labor Room <i>with Toilet</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.2.3 &nbsp;<span class="font-weight-bold">Admitting and Records Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.4 &nbsp;<span class="font-weight-bold">Recovery Room (To provide additional Area)</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.5 &nbsp;<span class="font-weight-bold">Sub-sterilizing Area <i>/Work Area</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.6 &nbsp;<span class="font-weight-bold">Sterile Instrument, Supply and Storage Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.7 &nbsp;<span class="font-weight-bold">Scrub-up Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.8 &nbsp;<span class="font-weight-bold">Clean-up Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.9 &nbsp;<span class="font-weight-bold">Dressing-Room</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.10 &nbsp;<span class="font-weight-bold">Toilet</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.11 &nbsp;<span class="font-weight-bold">Nurses' station with <i>Work Area</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.12 &nbsp;<span class="font-weight-bold">Wheeled Stretcher Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.3.13 &nbsp;<span class="font-weight-bold">Janitor's Closet <i>with mop sink</i></span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.2.4 &nbsp;<span class="font-weight-bold">Nursing Unit</span>
									</div>

									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.4.1 &nbsp;<span class="font-weight-bold">Patient's Room with Toilet</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.4.2 &nbsp;<span class="font-weight-bold">Isolation Room <i>with Toilet and Ante Room  with sink, PPE Rack and Hamper</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.4.3 &nbsp;<span class="font-weight-bold">Nurses Station <i>with Medication Area with Lavatory/Sink</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.4.4 &nbsp;<span class="font-weight-bold">Treatment Area</span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.2.5 &nbsp;<span class="font-weight-bold">Central Sterilizing and Supply Room</span>
									</div>

									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.5.1 &nbsp;<span class="font-weight-bold">Receiving <i>and</i> Cleaning Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.5.2 &nbsp;<span class="font-weight-bold"><i>Inspection and Packaging Area</i></span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.5.3 &nbsp;<span class="font-weight-bold">Sterilizing Room</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.2.5.4 &nbsp;<span class="font-weight-bold">Storage and <i>Releasing Area</i></span>
											</div>
										</li>
									</ul>

								</li>



							</ul>

						</li>

						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 1.3 &nbsp;<span class="font-weight-bold">Nursing Service</span>
							</div>

							<ul class="mt-1">
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.3.1 &nbsp;<span class="font-weight-bold">Office of Chief Nurse</span>
									</div>
								</li>
							</ul>
						</li>

						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 1.4 &nbsp;<span class="font-weight-bold">Ancilliary Service</span>
							</div>

							<ul class="mt-1">
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.4.1 &nbsp;<span class="font-weight-bold">Secondary Clinical Laboratory with <i>Blood Station</i></span>
									</div>
									
									<ul class="mt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.1.1 &nbsp;<span class="font-weight-bold">Clinical Work Area with Lavatory/Sink (min. Floor Area: 20.00 sq.m).</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.1.2 &nbsp;<span class="font-weight-bold">Pathologist Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.1.3 &nbsp;<span class="font-weight-bold">Toilet</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.1.4 &nbsp;<span class="font-weight-bold"><i>Extraction Area Separate from Clinical Lab. Work Area</i></span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.4.2 &nbsp;<span class="font-weight-bold">Radiology - 1st Level</span>
									</div>
									<ul class="mt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.2.1 &nbsp;<span class="font-weight-bold">X-Ray Room with Control Booth, Dressing Area and Toilet</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.2.2 &nbsp;<span class="font-weight-bold">Dark Room</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.2.3 &nbsp;<span class="font-weight-bold">Film File and Storage Area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 1.4.2.4 &nbsp;<span class="font-weight-bold">Radiologist Area</span>
											</div>
										</li>
									</ul>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 1.4.3 &nbsp;<span class="font-weight-bold">Pharmacy with work counter and sink</span>
									</div>
								</li>
							</ul>
						</li>


					</ul>
				</div>
				<div class="text-left font-weight-bold pt-3">
					2. PLANNING AND DESIGN
				</div>
				<div class="container-fluid border">
					<ul>

						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 2.1 &nbsp;<span class="font-weight-bold">Floor plans properly identified and completely labeled</span>
							</div>
						</li>
						<li>
							<div class="row">
								<span><input type="checkbox"></span> &nbsp; 2.2 &nbsp;<span class="font-weight-bold">Conforms to applicable codes as part of normal professional service</span>
							</div>

							<ul>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.2.1 &nbsp;<span class="font-weight-bold">Exits restricted to the following types: door leading directly outside the building, interior stair, ramp and exterior stair.</span>
									</div>
									<div class="row">
									<span><input type="checkbox"></span> &nbsp; 2.2.1.1 &nbsp;<span class="font-weight-bold">Minimum of two(2) exits, remote from each other, for each floor of the building</span>
									</div>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.2.1.2 &nbsp;<span class="font-weight-bold">Patient Corridors and ramps for ingress and egress at least 2.44 meters in clear and onobstructed width</span>
									</div>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.2.1.3 &nbsp;<span class="font-weight-bold">Exits terminate directly at an open space to the outside of the building</i></span>
									</div>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.2.1.4 &nbsp;<span class="font-weight-bold">Minimum of one(1) toilet on each floor accessibe to the disabled</i></span>
									</div>
								</li>

								
							
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.3 &nbsp;<span class="font-weight-bold">Meets prescribed functional programs</span>
									</div>

									<ul class="pt-1">

										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.1 &nbsp;<span class="font-weight-bold">Main Entrance of the hospital directly accessible from public road</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.2 &nbsp;<span class="font-weight-bold">Ramp or elevator for clinical, Nursing and ancilliary service located on the upper floor</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.3 &nbsp;<span class="font-weight-bold">Administrative Service</span>
											</div>
												<ul class="pt-1">
													<li>
														<div class="row">
															<span><input type="checkbox"></span> &nbsp; 2.3.3.1&nbsp;<span class="font-weight-bold">Business office located near the entrance of the hospital</span>
														</div>
													</li>
												</ul>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.4 &nbsp;<span class="font-weight-bold">Emergency Service</span>
											</div>
											<ul class="pt-1">
												<li>
													<div class="row">
														<span><input type="checkbox"></span> &nbsp; 2.3.4.1&nbsp;<span class="font-weight-bold">Located in the ground floor to ensure easy access for patients </span>
													</div>
													<div class="row">
														<span><input type="checkbox"></span> &nbsp; 2.3.4.2&nbsp;<span class="font-weight-bold">Separate Entrance to the emergency</span>
													</div>
													<div class="row">
														<span><input type="checkbox"></span> &nbsp; 2.3.4.3&nbsp;<span class="font-weight-bold">Ramp for wheelchair access(<i>with clear with of at least 1.22m or 4.ft</i>)</span>
													</div>
													<div class="row">
														<span><input type="checkbox"></span> &nbsp; 2.3.4.4&nbsp;<span class="font-weight-bold">Easily accessible to the clinical and ancilliary services (laboratory,radiology,pharmacy,operating room)</span>
													</div>
													<div class="row">
														<span><input type="checkbox"></span> &nbsp; 2.3.4.5&nbsp;<span class="font-weight-bold">Nurse station located to permit observation of patient and control of access to entrance, waiting area, and treatment area</span>
													</div>
												</li>
											</ul>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.3.5 &nbsp;<span class="font-weight-bold">Outpatient Department</span>
									</div>
									
	
									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.5.1 &nbsp;<span class="font-weight-bold">Located near the main entrance of the hospital to ensure easy access for patients</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.5.2 &nbsp;<span class="font-weight-bold">Separate toilets for patients and staff (Male/Female/PWD)</span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.3.6 &nbsp;<span class="font-weight-bold">Surgical and Obstetrical Service</span>
									</div>

									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.1 &nbsp;<span class="font-weight-bold">Located and arranged to prevent non-related traffic through the suite</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.2 &nbsp;<span class="font-weight-bold">Operating room and delivery room located as remote as practicable from the entrance to the suite to reduce traffic and provide greater asepsis</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.3 &nbsp;<span class="font-weight-bold">Operating room and delivery room arranged to prevent staff and patients to travel from one area to the other area</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.4 &nbsp;<span class="font-weight-bold">Dressing room arranged to avoid exposure to dirty areas after changing to surgical garments</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.5 &nbsp;<span class="font-weight-bold">Nurse station located to permit visual observation of patient and movement into the suite</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.6 &nbsp;<span class="font-weight-bold">Scrub-up area recessed into an alcove or other open space out of the main traffic</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.6.7 &nbsp;<span class="font-weight-bold">Sub-sterilizing are shall be provided and shall be accessible from the Operation Room and Delivery Room</span>
											</div>
										</li>
									</ul>

								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.3.7 &nbsp;<span class="font-weight-bold">Nursing Service</span>
									</div>

									<ul class="pt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.7.1 &nbsp;<span class="font-weight-bold">Nurse station located and designed to allow visual observation of patient and movement into the nursing unit</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.7.2 &nbsp;<span class="font-weight-bold">Nurse station provided in all nursing units of the hospital with a ratio of at least one(1) nurse station for every thirty-five(35) bends</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.7.3 &nbsp;<span class="font-weight-bold">Toilet immediately accessible from each room in a nursing unit</span>
											</div>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.7.4 &nbsp;<span class="font-weight-bold">Separate <i>rooms with toilets for male and female patients</i></span>
											</div>
											
										</li>
									</ul>
								</li>
								<li>
									<div class="row">
										<span><input type="checkbox"></span> &nbsp; 2.3.8 &nbsp;<span class="font-weight-bold">Dietary, maintenance and other non patient contact services or located in areas away from normal traffic within the hospital, or located in separate buildings within the hospital premises</span>
									</div>
									
									<ul class="mt-1">
										<li>
											<div class="row">
												<span><input type="checkbox"></span> &nbsp; 2.3.9.1 &nbsp;<span class="font-weight-bold">The dietary service shall be away from morgue with atleast 25-meter distance</span>
											</div>
										</li>
									</ul>

								</li>
							</ul>
						</ul>
					</div>


				</div>
			<div class="d-flex justify-content-center mt-3">
				<button class="btn btn-primary btn-block" onclick="window.history.back()">Submit</button>
			</div>
		</div>

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		@include('client1.cmp.footer')
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
