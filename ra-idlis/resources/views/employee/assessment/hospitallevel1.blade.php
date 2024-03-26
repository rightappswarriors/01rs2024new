@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="container border font-weight-bold">NOTE: THIS IS A TEST ONLY</div>
	<div class="content p-4">
		@yield('errors')
		<div class="card">
			{{-- part 2 1 page --}}
			<div class="container p-4 table-responsive">
				<div class="card-header bg-white font-weight-bold mb-4">
					<b>PART II HOSPITAL NURSING SERVICE</b>
				</div>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th scope="col">CRITERIA</th>
							<th scope="col" class="at-col-bal">INDICATOR</th>
							<th scope="col">EVIDENCE</th>
							<th scope="col">AREAS</th>
							<th scope="col">COMPLIED</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr class="font-weight-bold">
							<td colspan="6" class="at-tr-subhead">
								<p>I.    PATIENCE CARE</p>
									<p class="pl-3">A.    ACCESS</p>
										<p class="pl-5">              Standard: Appropriate professionals perform coordinated and sequenced patient assessment to reduce waste and unnecessary repetition.</p>
							</td>
						</tr>
						<tr>
							<td><span class="font-weight-bold">1. NURSING SERVICES</span><br> Moderate Nursing Care and Management</td>
							<td>Licensed and appropriately trained nursing personnel assigned in special and critical areas</td>
							<td><span class="font-weight-bold">DOCUMENT REVIEW</span><br> PRC Valid license Certificate of relevant training</td>
							<td>Wards, ER. OPD</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>2. Nurses make use of Nursing Process in the care of patients</td>
							<td>Charts have nurses’ notes Presence of Nursing manual and properly utilized Kardex</td>
							<td>
								<span class="font-weight-bold">CHART REVIEW</span> <br> Patients’ charts from medical records or wards have nurses’ notes
								<span class="font-weight-bold">DOCUMENTS</span><br> Patients’ charts Kardex

							</td>
							<td>Wards, ER. OPD</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="6" class="at-tr-subhead">
								<p>B.     IMPLEMENTATION OF CARE</p>
								<p>Standard:  Medicines are administered in a standardized and systematic manner. Diagnostic examinations appropriate to the provider or organization’s service capability and usual case mix are available and are performed by qualified personnel</p>
							</td>
						</tr>
						<tr>
							<td>3. Medicines are administered in a timely, safe, appropriate and controlled manner</td>
							<td>
								All medicines are administered observing the five (5) R’s of medication which are:
								1.	Right patient
								2.	Right medication
								3.	Right dose
								4.	Right route
								5.	Right time

							</td>
							<td>
								<span class="font-weight-bold">CHART REVIEW</span><br>Check patients charts for the accuracy of medicine administration.
							</td>
							<td>ER Wards</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>4. Only qualified personnel order, prescribe, dispense prepare, and administer drugs.</td>
							<td>All doctors, pharmacists and nurses have updated licenses</td>
							<td>
								<span class="font-weight-bold">INTERVIEW</span><br>Randomly check the licenses of some doctors, nurses and pharmacists if they are updated.
							</td>
							<td>Wards Pharmacy ER OPD</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>5. Prescriptions or orders are verified and patients are properly identified  before medications are administered</td>
							<td>Proof that prescriptions or orders are verified before medications are administered</td>
							<td>
								<span class="font-weight-bold">INTERVIEW</span><br> Ask staff how they verify orders from doctors prior to administration of medicines.
								<span class="font-weight-bold">OBSERVE</span><br>How staff verifies the prescriptions or orders
							</td>
							<td>Wards ER</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>6. patients are properly identified before medicines are administered</td>
							<td>Proof that patients are correctly identified prior to administration of medications</td>
							<td>
								<span class="font-weight-bold">INTERVIEW</span><br> Verify from patients if they were correctly identified prior to drug administration.
								<span class="font-weight-bold">OBSERVE</span><br>If the staff verifies the identity of patient prior to administration of medications (patient should be the one to state his/her name.)
							</td>
							<td>Wards ER</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>7. Medicine administration is properly documented in the patient chart</td>
							<td>Proof that patients are correctly identified prior to administration of medications</td>
							<td>
								<span class="font-weight-bold">All charts have proper documentation of medicine administration.</span>
								<span class="font-weight-bold">CHART REVIEW</span><br>Medication sheet in patient chart from medical records or from the wards.
							</td>
							<td>Medical records office wards</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="6" class="at-tr-subhead">
								<p>II. SAFE PRACTICE AND ENVIRONMENT </p>
								<p>A.  INFECTION CONTROL<br>
									Standard: the organization uses a coordinated system- wide approach to reduce the risks of healthcare- associated infections.
								</p>
							</td>
						</tr>
						<tr>
							<td>8. There are programs for prevention and treatment of needle stick injuries, and policies and procedures for the safe disposal of used needles are documented and monitored</td>
							<td>Presence of policies and procedures on the prevention and treatment of needle stick injuries and safe disposal of needles</td>
							<td>
								<span class="font-weight-bold">INTERVIEW</span><br> Ask staff their policies on needle stick injury
								<span class="font-weight-bold">OBSERVE</span><br>Use of PPEs in doing minor surgeries, IV insertions, etc.
							</td>
							<td>ER Wards</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>9. Policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies.</td>
							<td>Presence of policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies</td>
							<td>
								<span class="font-weight-bold">DOCUMENT REVIEW</span><br>• Policies and procedures<br>
								•   Logbooks on packaging
									and sterilizing of  and 
									equipment, instruments 
									supplies
								<br>
								<span class="font-weight-bold">OBSERVE</span><br>Designated areas for receiving, cleaning, disinfecting, drying packaging, sterilizing and releasing of sterilized equipment, instruments and supplies.
							</td>
							<td>ER Wards</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
			</div>

			{{--end part 2 1 page --}}

			{{-- part 3 1 page --}}
			<div class="container p-4 table-responsive">
				<div class="card-header bg-white font-weight-bold">
		        	PART III PHYSICAL PLANT
		        </div>
				<div class="container p-4">
					<table class="table table-bordered black">
						<thead class="text-center">
							<tr class="at-tr-head">
								<th scope="col" class="at-col-bal">CRITERIA</th>
								<th scope="col" class="at-col-bal">INDICATOR</th>
								<th scope="col">EVIDENCE</th>
								<th scope="col">AREAS</th>
								<th scope="col">COMPLIED</th>
								<th scope="col">REMARKS</th>
							</tr>
						</thead>
						<tbody>
							<tr class="at-tr-subhead">
								<td colspan="6">
									<b>
										I. PATIENT CARE <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. ACCESS <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: Appropriate professionals perform coordinated and sequenced patient assessment to reduce waste and unnecessary repitition.
									</b>
								</td>
							</tr>

							{{-- 1st row --}}

							<tr>
								<td>
									1.  A multi-level ramp shall have a minimum clear width of 1.22 meters in one direction and slope is 1:12; an elevator which can accommodate at least a patient bed, provided at the entrance if it is not at the same level with the inside
								</td>
								<td>
									presence of ramp or elevator
								</td>
								<td>
									<b>OBSERVE</b> <br>
								</td>
								<td class="text-center"></td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>

							{{-- 2nd row --}}

							<tr>
								<td>
									2. Entrances and exits are clearly and prominently marked
								</td>
								<td>
									Presence of entrances and exits that are readily accessible. <i>(Reference: RA 6541 Building code of the Philippines)</i>
								</td>
								<td>
									<b>OBSERVE</b> <br>
									<ul>
										<li>
											With entrance and 
										     exit signs. Check ER. 
										     OPD and wards
										</li>
										<li>
											Entrances and exits 
										    are accessible and   
										    free from any 
										    obstruction   
										</li>
									</ul>
								</td>
								<td>
									ER <br>
									OPD <br>
									Wards<br>
									OR/RR/DR<br>
									maging
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>

							<tr>
								<td>
									3. Directional signs are prominently posted to help locate service areas within the organization.
								</td>
								<td>
									Presence of directional signage to locate service areas
								</td>
								<td>
									<b>OBSERVED</b> <br>
									Signage is easily seen along corners, corridor, lobby, clinic
								</td>
								<td>
									ER <br>
									OPD <br>
									Wards <br>
									Lobby
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>

							{{-- 4th row --}}
							<tr>
								<td>
									4. Alternative passageways for patients with special needs (e.g. ramps) are available, clearly and prominently marked and free of any obstruction.
								</td>
								<td>
									Entrance ramp is provided, as required in Accessibility Law for all types of structure
								</td>
								<td>
									<b>OBSERVED</b><br>
									Checked:
									<ul>
										<li>
											Alternative 
										    passageways for   
										    patients with special 
										    needs
										</li>
										<li>
											They are prominently 
											marked
										</li>
										<li>
											They are free from 
	    									obstruction.
										</li>
									</ul>
								</td>
								<td>
									ER <br>
									OPD <br>
									Wards<br>
									Other areas
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									5. Corridors conform with standard measurement
								</td>
								<td>
									Corridors used as access for patients using bed or stretcher are at least 2.44 meters while in areas not commonly used for bed or stretcher are at least 1.83 meters
								</td>
								<td>
									<b>OBSERVED</b> <br>
									Corridors 2.44 meters wide can accommodate 2 wheeled stretchers alongside each other
									<ul>
										<li>
											Wheeled stretcher can
										    have a 360 degree 
										    turning radius
										</li>
									</ul>
								</td>
								<td class="text-center">
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									6. Outsourced services are within the facility
								</td>
								<td>
									Presence of all outsourced services within the hospital
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									•    Contracts/MOA for 
									       outsourced services
									•  Valid licenses of all 
									     providers

									•     Check contracts/ job  
									       orders
								</td>
								<td class="text-center">Administrative Office</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td class="font-weight-bold" colspan="6">1.	ADMINISTRATIVE SERVICES</td>
							</tr>
							<tr>
								<td>
									A.  Dietary 
								</td>
								<td>
									There shall be provision of safe, quality and nutritious food to patients Diet prescription or diet counselling is provided to patients
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									•   Check policies and   
									       procedures in the   
									       dietary
									•     Monthly menu for 
									       patients
								</td>
								<td class="text-center" rowspan="5">Administrative Office</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									B. Linen/ Laundry
								</td>
								<td>
									If not contracted out, there shall be:
									•	Sorting of soiled and contaminated linens n designated areas
									•	Systematic washing of laundry with safeguard against spread of infection
									•	Disinfection of laundry
								</td>
								<td>
									Check policies and procedures on how soiled linens are collected disinfected and washed
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									C. Security
								</td>
								<td>
									Policies and procedures on security of patients, visitors and hospital staff
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									security check for internal and external customers including use of visitor’s pass
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									D. Housekeeping/ Janitorial
								</td>
								<td>
									There shall be provision and maintenance of clean, safe and sanitary facilities and environment for hospital personnel, patients and clients
								</td>
								<td>
									<b>OBSERVE</b> <br>
									Proof of implementation
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									E. Proper Waste Disposal
								</td>
								<td>
									Policies and procedures on proper waste disposal.
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Proof of implementation of policies and procedures on proper waste disposal.
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									F. Maintenance (Equipment and Building)
								</td>
								<td>
									Policies and procedures on maintenance
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									<b>OBSERVE</b><br>Proof of implementation
								</td>
								<td>Lobby ER/OPD
									Wards and the rest of the hospital
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr class="at-tr-subhead">
								<td colspan="6">
									<b>
										II. SAFE PRACTICE AND ENVIRONMENT <br>
										A.	PATIENT AND STAFF SAFETY
										Standard: the organization plans a safe and effective environment of care consistent with its mission, services, and with laws and regulations	
									</b>
								</td>
							</tr>
							<tr>
								<td>
									7. Hospital has a valid license
								</td>
								<td>
									Presence of updated DOH license to operate 
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Updated DOH license
									• If facility has nuclear 
									   medicine, check 
									   certificate issued by PNRI
								</td>
								<td>Lobby ER/OPD
									Wards and the rest of the hospital
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									8. Building Maintenance Program is in place ensuring facilities are in state of good repair
								</td>
								<td>
									Policies and procedures
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Routine program of work preventive maintenance and record of corrective maintenance are available
								</td>
								<td></td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									9. Hospital is free from undue noise, pollution and from foul odor
								</td>
								<td>
									
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Check presence of MSDS 
									    (Material Safety Data Sheet) 
									     in the laboratory and 
									     Engineering
									• Record of disposal of 
									    radiologic wastes


									INTERVIEW
									Ask staff at random:
									their manner of waste segregation and disposal; safe storage and disposal of reagents, and disposal of wastewater

								</td>
								<td>Hospital surroundings Laboratory Pharmacy and other part of the facility and Maintenance</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									10. Presence of a management plan, policies and procedures addressing safety
								</td>
								<td>
									Presence of a management plan, policies and procedures addressing:
									• Safety
									• Security
									• Disposal and control of 
									   hazardous materials and 
									   biologic wastes
									• Emergency and disaster 
									   preparedness
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Check presence of MSDS 
									    (Material Safety Data Sheet) 
									     in the laboratory and 
									     Engineering
									• Record of disposal of 
									    radiologic wastes


									INTERVIEW
									Ask staff at random:
									their manner of waste segregation and disposal; safe storage and disposal of reagents, and disposal of wastewater

								</td>
								<td>
									Administrative office Maintenance office, 
									ER
									Wards
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									11. Policies and procedures for the safe and efficient use of medical equipment according to specifications are documented and implemented.
								</td>
								<td>
									Presence of policies and procedures for:
									• Quality Control
									• Corrective and 
									   Preventive Maintenance 
									   Program for medical 
									   equipment
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Presence of operating 
									   manuals of the medical 
									   equipment
									• Preventive and corrective 
									   maintenance logbook
									• Film reject analysis
									• Quality control tests results

									OBSERVE
									How staff performs necessary precaution or safety procedures such as: red light is on while x-ray procedure is being done.
									Note: look into their storage of mercury containing devices which are no longer allowed to be used
								</td>
								<td>
									ER
									OPD
									Wards
									DR
									Laboratory
									Pharmacy
									Maintenance Office
									Other areas
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									12. Patient areas provide sufficient space for safety, comfort and privacy of the patient and for emergency care.
								</td>
								<td>
									• Presence of adequate 
									   space, lighting and 
									   ventilation in 
									   compliance
									   with structural 
									   requirements (for 
									   patient
									   safety a0nd privacy)

								</td>
								<td>
									<b>OBSERVE</b> <br>
									• Adequate space for patients 
									    in moving around the bed 
									    areas
									• Adequate lighting (lights are
									   working, lighting is 
									   adequate enough for 
									   conduct of general 
									   activities)
									• Adequate ventilation
									• Segregation of sexes, in 
									   wards and clinical areas
								</td>
								<td>
									ER
									OPD
									Wards
									DR
									Laboratory
									Pharmacy
									Maintenance Office
									Other areas
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									13. A coordinated security arrangement in the organization assures protection of patients, staff and visitors.
								</td>
								<td>
									Presence of an appointed personnel in charge of security.
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Contract of Appointment of person in charge of security.
								</td>
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr class="font-weight-bold">
								<td colspan="6" class="at-tr-subhead">
									<p>B.	MAINTENANCE OF THE ENVIRONMENT OF CARE</p>
									<p>Standard: Emergency light and/or power supply, water and ventilation systems are provided for, in keeping with relevant statutory requirements and codes of practice.
									</p>
								</td>
							</tr>
							<tr>
								<td>
									14. Generator, emergency light, water system, adequate ventilation or air conditioning
								</td>
								<td>
									Presence of generator, emergency light, water system, adequate ventilation on air conditioning.
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Check result of water 
									   analysis for the last 6 
									   months.
									• Preventive and corrective 
									    maintenance logbooks
									OBSERVE
									• Test if faucets and water 
									    closets are working
									• Functional lights and   
									   generators

								</td>
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>	
							<tr>
								<td>
									15. Equipment re regularly maintained with plan for replacement according to expected life span or when no longer serviceable.
								</td>
								<td>
									Presence of policies and procedures on preventive and corrective maintenance and replacement if warranted
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Records of preventive and corrective maintenance and plan for replacement
								</td>
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									16. Training of the staff who is in charge of the maintenance of the equipment
								</td>
								<td>
									Proof of training of the staff who is in charge of the maintenance of the equipment
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									For in-house: Certificate of training of service personnel or Certificate of training For outsourced service: MOA/Contract

									INTERVIEW
									Ask about how equipment (generator. A/C, Medical and non-medical devices, etc.) are maintained
								</td>
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									17. Operating manuals of equipment
								</td>
								<td>
									Presence of operating manuals equipment
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									Operating manual of Medical equipment, generators, air conditioners and other non-medical equipment.
								</td>
								Engineering/ Maintenance Office
								Imaging
								Laboratory
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr class="font-weight-bold">
								<td colspan="6" class="at-tr-subhead">
									<p>C.	ENERGY AND WASTE MANAGEMENT</p><br>
									<p>Standard:  The handling , collection and disposal of waste conform with relevant statutory requirements and code of practice
									</p>
								</td>
							</tr>
							<tr>
								<td>
									18.Licenses/permits/Clearances from pertinent regulatory agencies
								</td>
								<td>
									Presence of L-licenses/permits/Clearances from pertinent regulatory agencies, if applicable
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Valid licenses/ permits 
									    regulatory agencies (LGU,
									    DENR, etc.)
									• Proof of compliance i.e., 
									     generator permit, elevator 
									     permit, etc.
								</td>
								Administrative office
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
							<tr>
								<td>
									19. Policies and procedures on waste Disposal Management
								</td>
								<td>
									Proof of strict implementation of policies and procedures on waste management
								</td>
								<td>
									<b>DOCUMENT REVIEW</b> <br>
									• Issuances- memos, 
									   guidelines on waste, 
									   segregation, collection 
									   treatment and disposal.
									• Contracts with service 
									   providers waste handlers
									   or disposal contractors (if 
									    applicable)


									OBSERVE
									• Segregation of waste 
									• Proper labelling of waste 
									   receptacles
									• Recyclable waste staging       
									   areas
									• Proper management of 
									   temporary storage areas 
									   prior to hauling for 
									   disposal.

									INTERVIEW
									Ask staff regarding SOPs on actual procedure on waste disposal
								</td>
								Administrative office
								<td>
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			{{-- end of part 3 1 page --}}

			<div class="container p-4 table-responsive">
				<div class="container pb-3">
					<b>PART IV - LEVEL 1 ATTACHMENT 1.A - PERSONAL</b>
				</div>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th scope="col">POSITION</th>
							<th scope="col" class="at-col-bal">QUALIFICATION</th>
							<th scope="col">EVIDENCE</th>
							<th scope="col">NUMBER/RATIO</th>
							<th scope="col">COMPLIED</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>TOP MANAGEMENT (Should be full time)</b>
							</td>
						</tr>

						{{-- 1st row --}}

						<tr>
							<td>
								Chief of Hospital/Medical Director
							</td>
							<td>
								<ul>
									<li>Licensed physician</li>
									<li>
										Have completed at least twenty (20) units towards a Master's Degree in Hospital Administration or related course (MPH, etc) <b><u>OR</u></b> at least five (5) years hospital experience in a supervisory or managerial position
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated Physician PRC license
									</li>
									<li>
										Certificate of Training attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of hospital supervisory/managerial experience)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}

						<tr>
							<td>
								Chief Nurse/Director of Nursing
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Master's Degree in Nursing <b><u>AND</u></b> at least five (5) years of experience in a supervisory or managerial position in nursing (R.A. No. 9173)
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENTARY REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of supervisory/managerial experience in nursing)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd Row --}}

						<tr>
							<td>
								Chief Administrative Officer/Hospital Administrator
							</td>
							<td>
								Have completed at least twenty (20) Units towards Master's Degree in Hospital Administration or related course (MPH, MBA, MPA, MHSA, etc.) <b><u>OR</u></b> at least five (5) years hospital experience in a supervisory/managerial position.</td>
							<td>
								<b>DOCUMENTARY REVIEW</b>
								<ul>
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of Employment (proof of hospital supervisory/managerial)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>ADMINISTRATIVE SERVICES</b>
							</td>
						</tr>
						<tr>
							<td>
								Accountant
							</td>
							<td>
								Bachelor's Degree in Accountancy (may be outsourced)
							</td>
							<td rowspan="6">
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Updated PRC license (if applicable)
									</li>
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Billing Officer
							</td>
							<td>
								With Bachelor's Degree relevant to job
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Budget/Finance Officer
							</td>
							<td rowspan="4">
								
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Cashier
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Human Resource Management Officer/Personenel Officer
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Bookkeeper
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Supply Officer/storekeeper
							</td>
							<td>
								With appropriate training and experience
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Medical Records officer
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Bachelor's Degree
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
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li> 
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Medical Social worker (Full Time)
							</td>
							<td>
								Licensed social worker
							</td>
							<td rowspan="2">
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Diploma/Certificate of units earned
									</li>
									<li>
										Update PRC license
									</li>
									<li>
										Certificate of Trainings attended
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
								</ul>
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Nutritionist-Dletician (Full Time)
							</td>
							<td>
								License nutritionist
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Utility Worker 
							</td>
							<td rowspan="3">
								<p>May be outsourced</p>
								<p></p>
								<p>Security guard must be licensed</p>
							</td>
							<td rowspan="3">
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Relevant Training
									</li>
									<li>
										Licensed, if applicable
									</li>
									<li>
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Notarized MOA if outsourced
									</li>
								</ul>
							</td>
							<td class="text-center">1 per shift</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 15th row --}}
						<tr>
							<td>
								Security Guard
							</td>
							<td class="text-center">1 per shift</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 16th row --}}
						<tr>
							<td>
								Laundry worker
							</td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 17th row --}}
						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>CLINICAL SERVICES</b>
							</td>
						</tr>
						<tr>
							<td>
								<p>Consultant Staff in Og-Gyn Pediatrics, Medicine, Surgery, and Anesthesia.</p>
								<p></p>
								<p><i>*Hospital may have additional consultants from other specialties</i></p>
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed physician
									</li>
									<li>
										Fellow/Diplomate
									</li>
									<li>
										ACLS certified (for Surgeons and Anesthesiologist)
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Certificate from Specialty society, if applicable (for Board Certified)
									</li>
									<li>
										Residency Training Certificate (for Board Eligible)
									</li>
									<li>
										Certificate of Residency Training/ Medical
									</li>
									<br>
									<p>Specialist(*DOH Medical Specialist, last exam was in 1989)</p>
									<li>
										Updated PRC license
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
								All consultants must be at least board eligible. At least one consultant must be board certified per specialty.
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

							{{-- 18th row --}}

							{{-- <tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr> --}}

						{{-- 19th row --}}
						<tr>
							<td>
								Resident Physician on Duty (Shall not go on duty for more than 48 hours straight). 
							</td>
							<td>
								Licensed physician
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
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
										Schedule of duty approved by Medical Director/Chief of Hospital
									</li>
								</ul>
							</td>
							<td>
								<p>
									Wards – 1:20 beds at any given time PLUS ER – at least 1 at any given time
								</p>
								<p>
									<i>
										*This ratio does not include Resident Physicians on Duty that shall be required for add-on services such as dialysis facility. It shall be counted separately.
									</i>
								</p>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 20th row --}}
						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>NURSING SERVICES</b>
							</td>
						</tr>
						<tr>
							<td>
								Supervising Nurse/Nurse Manager
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										With at least nine (9) units of Master’s Degree in Nursing
									</li>
									<li>
										At least two (2) years experience in general nursing service administration.
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
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
										Proof of Employment/Appointment (notarized)
									</li>
									<li>
										Service Record/Certificate of employment (Proof of general nursing service administration experience)
									</li>
								</ul>
							</td>
							<td>
								1:50 Beds Office hours only (8am to 5pm)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 21st row --}}
						<tr>
							<td>
								Head Nurse/Senior Nurse
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										With at least 2 years hospital experience
									</li>
									<li>
										BLS certified
									</li>
								</ul>
							</td>
							<td rowspan="2">
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificate of trainings attended
									</li>
									<li>
										Proof of employment (notarized)
									</li>
									<li>
										If nursing staffing is outsourced: Validity period of the hospital’s LTO.
									</li>
									<li>
										Schedule of duty approved by Chief Nurse
									</li>
								</ul>
							</td>
							<td>
								1:15 staff nurses
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 22nd row --}}
						<tr>
							<td>
								Staff Nurse
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										BLS certified
									</li>
								</ul>
							</td>
							<td>
								Ward - 1:12 Beds at any given time (plus 1 reliever for every 3 RNs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 23rd row --}}
						<tr>
							<td>
								Nursing Attendant
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Highschool graduate
									</li>
									<li>
										With relevant health related training (may be in house training)
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul class="m-0 p-4">
									<li>
										Certificate of trainings attended
									</li>
									<li>
										Proof of Employment/ Appointment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1:24 beds at any given time (plus 1 reliever for every 3 NAs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 24th row --}}
						<tr>
							<td>
								<p>Operating Room Nurse:</p> 
								<p>-Scrub Nurse (SN)</p> 
								<p>-Circulating Nurse (CN)</p> 
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
								<b>DOCUMENT REVIEW</b>
								<p></p>
								<ul class="m-0 p-4">
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificate of trainings attended
									</li>
									<li>
										Proof of employment (notarized)
									</li>
									<li>
										If nursing staffing is outsourced: Validity period of the hospital’s LTO.
									</li>
									<li>
										Schedule of duty
									</li>
								</ul>
							</td>
							<td>
								1 SN and 1 CN per functioning OR per shift (plus 1 reliever for every 3 nurses)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 25th row --}}
						<tr>
							<td>
								Delivery room Nurse
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Training in Maternal and Child Nursing (maybe in house training or training in Essential Integrated Newborn Care [EINC])
									</li>
									<li>
										Training in BLS and ACLS
									</li>
								</ul>
							</td>
							<td>
								1 per 3 delivery table per shift (plus 1 reliever for every 3 nurses)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 26th row --}}
						<tr>
							<td>
								Emergency Room Nurse
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Training in Trauma Nursing, ACLS and other relevant training
									</li>
								</ul>
							</td>
							<td>
								approved by Chief Nurse
							</td>
							<td>
								1:3 beds per shift (plus 1 reliever for every 3 nurses)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 27th row --}}
						<tr>
							<td>
								Outpatient Department Nurse
							</td>
							<td>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Training n BLS
									</li>
								</ul>
							</td>
							<td></td>
							<td class="text-center">1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
				<br><br>
				<p><b>ATTACHMENT 1.B - PHYSICAL PLANT</b></p>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th scope="col" class="at-col-bal-lg">DOCUMENTS</th>
							<th scope="col">COMPLIED</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						{{-- 1st row --}}
						<tr>
							<td>
								1. DOH –Approved PTC
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 2nd row --}}
						<tr>
							<td>
								2. DOH Approved Floor Plan
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 3rd row --}}
						<tr>
							<td>
								2. Checklist for Review of Floor Plans (accomplished)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
				<br><hr><br>
				<p><b>OBSERVATION/FINDINGS (may use separate additional sheet if needed)</b></p>
				<div class="container border border-secondary rounded input" style="height: 300px; overflow-y: scroll; ">
				</div>
				<br><hr><br>
				<p><b>ATTACHMENT 1.C - EQUIPMENT INSTRUMENT</b></p>	
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th scope="col" class="at-col-bal-xlg">EQUIPMENT/INSTRUMENT (Functional)</th>
							<th scope="col">QUANTITY</th>
							<th scope="col" class="at-col-bal">AREA</th>
							<th scope="col">COMPLIED</th>
							<th scope="col">REWARD</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-subhead text-center">
							<td colspan="5">
								<b>ADMINISTRATIVE SERVICE</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Ambulance
								<ul class="m-0 p-4">
									<li>
										If owned by hospital, available 24/7 and physical present if not being used during time of inspection/monitoring
									</li>
									<li>
										If outsourced, shall be on call but able to respond within reasonable time.
									</li>
								</ul>
							</td>
							<td class="text-center">
								1
							</td>
							<td class="text-center at-td-mid">
								Parking
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Computer with Internet Access 
							</td>
							<td class="text-center">
								1
							</td>
							<td class="text-center">
								Administrative Office
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Emergency Light
							</td>
							<td class="text-center"></td>
							<td class="text-center">
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Fire Extinguishers
							</td>
							<td class="text-center">
								1 per unit or area
							</td>
							<td class="text-center">
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Generator set with automatic Transfer Switch (ATS)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="text-center">
								Genset house
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead text-center">
							<td colspan="5">
								<b>KITCHEN DIETARY</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Exhaust fan
							</td>
							<td class="text-center">
								1
							</td>
							<td rowspan="9" class="text-center at-td-mid">
								Kitchen
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Food Conveyor or equivalent (closed-type)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Food Scale
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Blender/Osteorizer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Oven
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Stove
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Refrigerator/Freezer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Utility cart
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Garbage Receptacle with Cover (color-coded)
							</td>
							<td class="text-center">
								1 for each color
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead text-center">
							<td colspan="5">
								<b>EMERGENCY ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Bag-valve-mask Unit
								<ul class="m-0 -4">
									<li>Adult</li>
									<li>Pediatric</li>
								</ul>
							</td>
							<td class="text-center">
								1
							</td>
							<td rowspan="29" class="text-center pagination-centered at-td-mid">
								ER
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Calculator for dose computation
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Clinical Weighing scale
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Delivery set, primigravid
							</td>
							<td class="text-center">
								2 sets
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Delivery set, multigravid
							</td>
							<td class="text-center">
								2 sets
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								ECG Machine with leads
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								EENT Diagnostic set with Ophthalmoscope and Otoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Emergency Cart (for contents, refer to separate list).
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Examining table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Examining table (with Stirrups for OB-Gyne)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Glucometer with strips
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Gooseneck lamp/Examining Light
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Instrument/Mayo Table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 15th row --}}
						<tr>
							<td>
								Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thoracostomy, Cutdown, etc.)
							</td>
							<td class="text-center">
								2 sets
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 16th row --}}
						<tr>
							<td>
								Nebulizer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 17th row --}}
						<tr>
							<td>
								Negatoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 18th row --}}
						<tr>
							<td>
								Neurologic Hammer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 19th row --}}
						<tr>
							<td>
								OR Light (portable or equivalent)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 20th row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not from pipeline
							</td>
							<td class="text-center">
								2
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 21st row --}}
						<tr>
							<td>
								Pulse Oximeter
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 22nd row --}}
						<tr>
							<td>
								Sphygmomanometer, Non-mercurial
								<ul class="m-0 p-4">
									<li>
										Adult Cuff
									</li>
									<li>
										Pediatric Cuff
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br><br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 23rd row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 24th row --}}
						<tr>
							<td>
								Suction Apparatus
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 25th row --}}
						<tr>
							<td>
								Suturing Set
							</td>
							<td class="text-center">
								2 sets
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 26th row --}}
						<tr>
							<td>
								Thermometer, non –mercurial
								<ul class="m-0 p-4">
									<li>
										Oral
									</li>
									<li>
										Rectal
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br><br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 27th row --}}
						<tr>
							<td>
								Vaginal Speculum, Different Sizes
							</td>
							<td class="text-center">
								1 for each different size
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 28th row --}}
						<tr>
							<td>
								Wheelchair
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 29th row --}}
						<tr>
							<td>
								Wheeled Stretcher with guard/side rails and wheel lock or anchor.
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="5" class="text-center">
								<b>OUT-PATIENT DEPARTMENT</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Clinical Height and Weight Scale
							</td>
							<td class="text-center">
								1
							</td>
							<td rowspan="14" class="text-center at-td-mid">
								OPD
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								EENT Diagnostic set with ophthalmoscope and otoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Gooseneck lamp/Examining Light
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Examining table with wheel lock or anchor
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Instrument/Mayo Table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Minor Instrument Set
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Neurologic Hammer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								<p>Oxygen Unit</p>
								<p>Tank is anchored/chained/ strapped or with tank holder if not pipeline</p>
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Peak flow meter
								<ul class="m-0 p-4">
									<li>
										Adult
									</li>
									<li>
										Pediatric
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<ul class="m-0 p-4">
									<li>
										Adult
									</li>
									<li>
										Pediatric
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Thermometer, non-mercurial
								<ul class="m-0 p-4">
									<li>
										Oral
									</li>
									<li>
										Rectal
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Suture Removal Set
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Wheelchair / Wheeled Stretcher
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="5" class="text-center">
								<b>OPERATING ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Air conditioning Unit
							</td>
							<td class="text-center">
								1/OR
							</td>
							<td rowspan="22" class="text-center at-td-mid">
								OR
								<br><br><br><br><br><br><br><br>
								<br><br><br><br><br><br><br><br>
								OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Anesthesia Machine
							</td>
							<td class="text-center">
								1/OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td class="text-center">
								1/OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Caesarean Section Instrument
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Electrocautery machine
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Emergency Cart (for contents, refer to separate list)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Glucometer with strips
							</td>
							<td class="text-center"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Instrument / Mayo table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Laparotomy pack (Linen pack)
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Laparatomy / Major Instrument Set
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Laryngoscopes with different sizes of blades
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Operating room light
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Operating room table
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 15th row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 16th row --}}
						<tr>
							<td>
								Rechargeable Emergency Light (in case generator malfunction)
							</td>
							<td class="text-center">
								1 per OR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 17th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<ul class="m-0 p-4">
									<li>
										Adult cuff
									</li>
									<li>
										Pediatric cuff	
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 per OR <br>
								1 per OR <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 18th row --}}
						<tr>
							<td>
								Spinal Set
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 19th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 20th row --}}
						<tr>
							<td>
								Suction Apparatus
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 21st row --}}
						<tr>
							<td>
								Thermometer, non-mercurial
								<ul class="m-0 p-4">
									<li>
										Oral
									</li>
									<li>
										Rectal
									</li>
								</ul>
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 23rd row --}}
						<tr>
							<td>
								Wheeled Stretcher with guard/side rails and wheel lock or anchor.
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="5" class="text-center">
								<b>POST ANESTHESIA CARE UNIT / RECOVERY ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Air conditioning unit
							</td>
							<td class="text-center">
								1
							</td>
							<td rowspan="11" class="text-center at-td-mid">
								PACU/RR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Cardiac Monitor
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td class="text-center">
								1 (if separate from the OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Emergency Cart (for contents, refer to separate list)
							</td>
							<td class="text-center">
								1 (if separate from the OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Glucometer with strips
							</td>
							<td class="text-center"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Mechanical / patient bed, with guard side rails and wheel lock or anchored
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Pulse Oximeter
							</td>
							<td class="text-center"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<ul class="m-0 p-4">
									<li>
										Adult cuff
									</li>
									<li>
										Pediatric cuff
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Thermometer, non- mercurial
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td class="text-center" colspan="5">
								<b>LABOR ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Fetal Doppler
							</td>
							<td class="text-center">
								1
							</td>
							<td class="text-center at-td-mid" rowspan="7">
								Labor Room
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Patient Bed
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Pulse Oximeter
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Thermometer, Non- mercurial
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td class="text-center" colspan="5">
								<b>DELIVERY ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Air-conditioning Unit
							</td>
							<td class="text-center">
								1
							</td>
							<td class="text-center at-td-mid" rowspan="20">
								DR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Bag valve mask unit (Adult and pediatric)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Bassinet
							</td>
							<td class="text-center"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Clinical Infant Weighing scale
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td class="text-center">
								1 (if DR is separate from OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Delivery set, primigravid
							</td>
							<td class="text-center">
								1 set
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Delivery set, multigravid
							</td>
							<td class="text-center">
								2 set
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Delivery room light
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Delivery room table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Dilatation and Curettage set
							</td>
							<td class="text-center">
								1 set
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Emergency Cart (for contents, refer to separate list)
							</td>
							<td class="text-center">
								1 (if DR is separate from OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Instrument / Mayo Table
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Kelly Pad or equivalent
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Laryngoscope with different sizes of blades
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 15th row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 16th row --}}
						<tr>
							<td>
								Rechargeable Emergency Light (in case generator malfunction)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 17th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 18th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 19th row --}}
						<tr>
							<td>
								Suction Apparatus
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 20th row --}}
						<tr>
							<td>
								Wheeled Stretcher
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="5">
								<b>NURSING UNIT/WARD</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Bag-Valve-Mask Unit
								<ul class="m-0 p-4">
									<li>
										Adult
									</li>
									<li>
										Pediatric
									</li>	
								</ul>
							</td>
							<td class="text-center">
								<br>
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="text-center at-td-mid" rowspan="15">
								NURSING UNIT/WARD
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Clinical Height and Weight Scale
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd row --}}
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td class="text-center">
								1
							</td>
							<td></td>
							<td>
								Nursing units located on the same floor may share the defibrillator and the E-cart, Provided that they are not more than 50 meters away from each other.
							</td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Emergency cart or equivalent (refer to separate list for the contents)
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								EENT Diagnostic set with ophthalmoscope and otoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								Laryngoscope with different sizes of blades
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								Mechanical/Patient bed with lock, if wheeled; with guard or side rails
							</td>
							<td class="text-center">
								ABC
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								Bedside Table
							</td>
							<td class="text-center">
								ABC
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 9th row --}}
						<tr>
							<td>
								Nebulizer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 10th row --}}
						<tr>
							<td>
								Neurologic Hammer
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 11th row --}}
						<tr>
							<td>
								Oxygen Unit Tank is anchored/chained/ if not pipeline
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th row --}}
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
								<ul class="m-0 p-4">
									<li>
										Adult cuff
									</li>
									<li>
										Pediatric cuff
									</li>
								</ul>
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 13th row --}}
						<tr>
							<td>
								Stethoscope
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 14th row --}}
						<tr>
							<td>
								Suction Apparatus
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 15th row --}}
						<tr>
							<td>
								Thermometer, non –mercurial
								<ul class="m-0 p-4">
									<li>
										Oral
									</li>
									<li>
										Rectal
									</li>
								</ul>
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td class="text-center" colspan="5">
								<b>CENTRAL STERILIZING &amp; SUPPLY ROOM</b>
							</td>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Autoclave/steam Sterilizer
							</td>
							<td class="text-center">
								1
							</td>
							<td>
								CSSR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr class="at-tr-subhead">
							<td class="text-center" colspan="5">
								<b>CADAVER HOLDING AREA/ROOM</b>
							</td>
						</tr>

						<tr>
							<td>
								Bed or stretcher for cadaver
							</td>
							<td class="text-center">
								1
							</td>
							<td>
								CADAVER HOLDING AREA
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
				<br><hr><br>
				<p><b>ATTACHMENT 1.D - EMERGENCY CART CONTENTS FOR LEVEL 1 HOSPITAL</b></p> <br>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head2">
							<th scope="col" class="at-col-bal">EMERGENCY CART CONTENTS</th>
							<th scope="col">ER</th>
							<th scope="col">OR</th>
							<th scope="col">DR</th>
							<th scope="col">NS 1</th>
							<th scope="col">NS 2</th>
							<th scope="col">NS 3</th>
							<th scope="col">NS 4</th>
							<th scope="col">NS 5</th>
							<th scope="col">NS 6</th>
							<th scope="col">NS 7</th>
							<th scope="col">NS 8</th>
							<th scope="col">NS 9</th>
							<th scope="col">NS 10</th>
							<th scope="col">NS 11</th>
							<th scope="col">NS 12</th>
							<th scope="col">REMARKS</th>
						</tr>

						{{-- 1st row --}}
						<tr>
							<td>
								Adenosine 6 mg/2mL vial
							</td>
							@for($i=0; $i<16; $i++)
								<td class="input"></td>
							@endfor
						</tr>

						{{-- 2nd row --}}
						<tr>
							<td>
								Amiodarone 150mg/3mL ampule
							</td>
						@for($i=0; $i<16; $i++)
								<td class="input"></td>
							@endfor
						</tr>

						{{-- 3rd row--}}
						<tr>
							<td>
								Anti-tetanus serum (either equine-based antiserum or human antiserum)
							</td>
							<td class="input"></td>
							<td colspan="14" style="background-color: black"></td>
							<td class="input"></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								Aspirin USP grade (325 mg/tablet)
							</td>
							@for($i=0; $i<16; $i++)
								<td class="input"></td>
							@endfor
						</tr>

						{{-- 5th to 37th --}}
						<?php
							$td = array(
								"Atropine 1 mg/ml ampule",
								"B-adrenergic agonists (i.e. Salbutamol 2mg/ml)",
								"Benzodiazepine (Diazepam 10mg/2ml ampule and/or Midazolam) (in high alert box)",
								"Calcium (usually calcium gluconate 10% solution in 10 mL ampule)",
								"Clopidogrel 75 mg tablet",
								"D5W 250 mL",
								"D50W 50mg/vial",
								"Digoxin 0.5mg/2mL ampule",
								"Diphenhydramine 50mg/mL ampule",
								"Dobutamine 250mg/5mL ampule",
								"Dopamine 200mg/5mL ampule/vial",
								"Epinephrine 1mg/ml ampule",
								"Furosemide 20mg/2ml ampule",
								"Haloperidol 50mg/mL ampule",
								"Hydrocortisone 250mg/2mL vial",
								"Lidocaine 10% in 50mL spray",
								"Lidocaine 2% solution vial 1g/50ml",
								"Magnesium sulphate 1g/2mL ampule",
								"Mannitol 20% solution in 500ml/bottle",
								"Methylprednisolone 4mg/tablet",
								"Metoclopramide 10mg/2mL ampule",
								"Morphine sulphate 10mg/mL ampule (in high alert box)",
								"Nitroglycerin inj. 10mg/10mL ampule or Isosorbide dinitrate 5mg SL tablet or 10 mg/10mL ampule",
								"Noradrenaline 2mg/2mL ampule",
								"Paracetamol 300mg/ampule (IV preparation)",
								"Phenobarbital 120mg/ml ampule IV or 30mg tablet (in high alert box)",
								"Phenytoin 100mg/capsule or 100 mg.2mL ampule",
								"Plain LRS 1L/bottle",
								"Plain NSS 1L/bottle-0.9% Sodium Chloride",
								"Potassium Chloride 40mEq/20mL vial (in high alert box)",
								"Vitamin B1/6/12 vial (1g B1, 1g B6, 0.01gB12 in 10 mL vial)",
								"Sodium bicarbonate 50mEq/50mL ampule",
								"Verapamil 5 mg/2ml ampule"
							);
						?>
						@for($i=0; $i<count($td); $i++)
							<tr>
								<td>
									{{$td[$i]}}
								</td>
								@for($j=0; $j<16; $j++)
									<td class="input"></td>
								@endfor
							</tr>
						@endfor

						<tr class="at-tr-head2">
							<td colspan="17" class="text-left">
								EQUIPMENT/SUPPLIES
							</td>
						</tr>

						<?php
							$td1 = array(
								"Airway adjuncts",
								"Airway / Intubation Kit (with stylet and bag valve masks)",
								"Alcohol disinfectant",
								"Aseptic bulb syringe",
								"Calculator",
								"Capillary Blood Glucose (CBG) Kit",
								"Cardiac Board",
								"Endotracheal Tubes, all sizes",
								"Flashlights or Pen lights",
								"Gloves, sterile",
								"Gloves,non-sterile",
								"Laryngoscope with different sizes of blades",
								"Nasal cannula",
								"Protective face shield or mask or goggles",
								"Standard face mask",
								"Sterile gauze (pre-folded and individually packed)",
								"Syringes (different volumes)",
								"Urethral catheter",
								"Urine collection bag",
								"Waterproof aprons"
							);
						?>
						@for($i=0; $i<count($td1); $i++)
							<tr>
								<td>
									{{$td1[$i]}}
								</td>
								@for($j=0; $j<16; $j++)
									<td class="input"></td>
								@endfor
							</tr>
						@endfor

					</thead>
					<tbody>
					</tbody>
				</table>

				<br><br><br>

				*Notes:<br>
				ER – Emergency Room<br>
				OR – Operating Room<br>
				DR – Delivery Room<br>
				NS – Nurses’ Station

				<br><br><br>

				<p><b>ATTACHMENT 1.E - ADD-ON SERVICE</b></p>
				<i>
					<p>Level 1 hospitals applying for the following add-on services must comply first with the licensing</p> 
					<p>standards for the following: </p>
					<p class="ml-5">1. Physical plant of the desired add-on service by securing an approved DOH Permit to Construct; and </p>
					<p class="ml-5">2. Licensing standards for the required ancillary and support units (e.g. tertiary clinical laboratory, Level 2 x-ray facility, board certified specialists, and respiratory therapy unit).</p> 
					<p>Thus, it is still strongly recommended to upgrade to a higher level of hospital.</p>
					<br>
					<p class="ml-5"><b>A. INTENSE CARE UNIT (ICU)</b></p>
				</i>

				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="6" class="text-left">
								I. ICU PERSONNEL
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td scope="col" class="at-col-bal"><b>POSITION</b></td>
							<td><b>QUALIFICATION</b></td>
							<td><b>EVIDENCE</b></td>
							<td><b>NUMBER/RATIO</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						{{-- 1st --}}
						<tr>
							<td>
								Multidisciplinary
								Team composed of,
								but not limited to,
								board certified
								Cardiologist,
								Pulmonologist,
								Neurologist,
								Pulmonologist <u><b>OR</b></u>
								an Intensivist
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma/Certificate from Specialty society
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of
										Employment/
										Appointment
										(notarized)
									</li>
								</ul>
							</td>
							<td>
								A team
								composed of
								at least 1 per
								specialty
								(May be part
								time or
								visiting
								consultant/s)
								<u><b>OR</b></u> an
								intensivist
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 2nd --}}
						<tr>
							<td>
								Nurse
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of
										Trainings attended
									</li>
									<li>
										Proof of
										Employment/
										Appointment
										(notarized)
									</li>
									<li>
										If nursing staffing is
										outsourced: Validity
										of the contract of
										employment should
										be at least one (1)
										year and within the
										validity period of the
										hospital’s LTO.
									</li>
									<li>
										Schedule of duty
										approved by Chief
										Nurse
									</li>
								</ul>
							</td>
							<td>
								1:3 beds at
								any time per
								shift (plus 1
								reliever for
								every 3 RNs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 3rd --}}
						<tr>
							<td>
								Nursing Attendant
							</td>
							<td>
								<ul>
									<li>
										Highschool graduate
									</li>
									<li>
										With relevant
										health-related
										training (may
										be in house
										training)
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1:12 beds at
								any time
								(plus 1
								reliever for
								every 3
								NA/MWs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>						
					</tbody>
				</table>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="4" class="text-left">
								II. ICU EQUIPMENT
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td class="at-col-bal-xlg"><b>EQUIPMENT/INSTRUMENT (Functional)</b></td>
							<td class="at-col-bal"><b>QUANTITY</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						{{-- 1st --}}

						@php
							$array = array(
								"Cardiac Monitor with Pulse Oximeter",
								"BDefibrillator with paddles",
								"EENT Diagnostic set with ophthalmoscope and otoscope",
								"Emergency Cart (for contents, refer to separate list).",
								"Infusion pump",
								"Larynfoscope with different sizes of blades",
								"Mechanical Bed",
								"Mechanical Ventilator (May be outsourced)",
								"Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thorascostomy, Cutdown, etc.)",
								"Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline",
								"Stethoscope",
								"Suction Apparatus",
								"Thermometer, Non-mercurial"
							);
							$qty = array(
								"1",
								"1",
								"1 set",
								"1",
								"1",
								"1",
								"Depending on the number of beds applied",
								"1",
								"1 set",
								"1",
								"1",
								"1",
								"1"
							);
						@endphp
						{{-- 1 --}}
						<tr>
							<td class="text-left">
								Air Conditioning Unit
							</td>
							<td class="text-center">
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 2 --}}
						<tr>
							<td class="text-left">
								Bag-valve-mask Unit
								<ul>
									<li>
										Adult
									</li>
									<li>
										Pediatric
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								1 <br>
								1 <br> 
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 3rd to 10th --}}
						@for($i=0; $i<count($array)-3; $i++)
							<tr>
								<td class="text-left">
									{{$array[$i]}}
								</td>
								<td class="text-center">
									{{$qty[$i]}}
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
						@endfor
						{{-- 11th --}}
						<tr>
							<td  class="text-left">
								Sphygmomanometer, Non-mercurial
								<ul>
									<li>
										Adult Cuff
									</li>
									<li>
										Pediatric Cuff
									</li>
								</ul>
							</td>
							<td class="text-center">
								<br>
								1 <br>
								1 <br>
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 12th to 14th --}}
						@for($i=count($array)-3; $i<count($array); $i++)
							<tr>
								<td class="text-left">
									{{$array[$i]}}
								</td>
								<td class="text-center">
									{{$qty[$i]}}
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
						@endfor
					</tbody>
				</table>
				<br>
				<p class="ml-5"><b><i>B. NEONTAL INTENSIVE CARE UNIT (NICU)</i></b></p>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="6" class="text-left">
								I. NICU PERSONNEL
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td class="at-col-bal"><b>POSITION</b></td>
							<td><b>QUALIFICATION</b></td>
							<td class="at-col-bal"><b>EVIDENCE</b></td>
							<td><b>NUMBER/RATIO</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						{{-- 1 --}}
						<tr>
							<td>
								Multidisciplinary
								team composed of,
								but not limited to,
								pediatric
								cardiologist,
								nephrologist,
								pediatric
								pulmonologist <b><i>OR</i></b> 
								a neonatologist
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma/Certificate
										from Specialty
										society
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of
										Employment /
										Appointment
										(notarized)
									</li>
								</ul>
							</td>
							<td>
								A team
								composed of
								at least 1 per
								specialty
								(May be part
								time or
								vising
								consultant)
								<b><u>OR</u></b> a
								neonatologist
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 2 --}}
						<tr>
							<td>
								Nurse
							</td>
							<td>
								<ul>
									<li>
										Licensed nurse
									</li>
									<li>
										Certificate of
										Training in
										Critical Care
										Nursing, ACLS
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificate of
										trainings attended
									</li>
									<li>
										Proof of employment
										(notarized)
									</li>
									<li>
										If nursing staffing is
										outsourced: Validity of
										the contract of
										employment should
										be at least one (1)
										year and within the
										validity period of the
										hospital’s LTO.
										- Schedule of duty
										approved by Chief
										Nurse
									</li>
								</ul>
							</td>
							<td>
								1:3
								bassinets/
								incubator/
								warmer
								(1 reliever
								for
								Every 3
								RNs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 3 --}}
						<tr>
							<td>
								Nursing attendants/Midwife
							</td>
							<td>
								<ul>
									<li>
										Highschool graduate
									</li>
									<li>
										With relevant
										health-related
										training (may
										be in house
										training
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of
										Employment
										(notarized)
									</li>
								</ul>
							</td>
							<td>
								1:12
								bassinets/
								incubator/
								warmer
								(1 reliever
								for
								every 3
								NAs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="4" class="text-left">
								II. NICU EQUIPMENT
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td class="at-col-bal-xlg"><b>EQUIPMENT/INSTRUMENT (Functional)</b></td>
							<td class="at-col-bal"><b>QUANTITY</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						@php
							$array = array(
								"Air Conditioning Unit",
								"Bassinet",
								"Bilirubin Light/ Phototherapy machine or equivalent",
								"Cardiac Monitor with Pulse Oximeter",
								"Clinical Infant Bag-valve mask unit",
								"Clinical Infant weighing scale",
								"Defibrillator with paddles",
								"EENT Diagnostic Set with ophthalmoscope and otoscope",
								"Emergency Cart (for contents, refer to separate list)",
								"Glucometer",
								"Incubator",
								"Infusion pump",
								"Laryngoscope with neonatal blades of different sizes",
								"Mechanical Ventilator (May be outsourced)",
								"Neonatal Stethoscope",
								"Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline",
								"Refrigerator for Breast milk storage",
								"Sphygmomanometer, N0b-mercurial - Neonate",
								"Suction Apparatus",
								"Thermometer, N0n-mercurial",
								"Umbilical Cannulation set"
							);

							$qty = array(
								"1",
								"1",
								"",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"Depending of the number of beds applied",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1",
								"1 set"
							);
						@endphp
						{{-- 1st to last --}}
						@for($i=0; $i<count($array); $i++)
							<tr>
								<td>
									{{$array[$i]}}
								</td>
								<td>
									{{$qty[$i]}}
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
						@endfor
					</tbody>
				</table>
				<br>
					<p class="ml-5"><b><i>C. HIGH RISK PREGNANCY UNIT (HRPU)</i></b></p>
				<br>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="6" class="text-left">
								I. HRPU PERSONEL
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td scope="col" class="at-col-bal"><b>POSITION</b></td>
							<td><b>QUALIFICATION</b></td>
							<td><b>EVIDENCE</b></td>
							<td><b>NUMBER/RATIO</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						{{-- 1st --}}
						<tr>
							<td>
								General
								obstetricians,
								preferably with a
								Perinatologist, and
								a referral team of
								IM specialists
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma/Certificate from Specialty society
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of
										Employment/
										Appointment
										(notarized)
									</li>
								</ul>
							</td>
							<td>
								General
								Obstetricians,
								Perinatologist,
								and IM
								specialists
								(May be part
								time or
								visiting
								consultant)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 2nd --}}
						<tr>
							<td>
								Nurse
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Diploma
									</li>
									<li>
										Updated PRC license
									</li>
									<li>
										Certificates of
										Trainings attended
									</li>
									<li>
										Proof of
										Employment/
										Appointment
										(notarized)
									</li>
									<li>
										If nursing staffing is
										outsourced: Validity
										of the contract of
										employment should
										be at least one (1)
										year and within the
										validity period of the
										hospital’s LTO.
									</li>
									<li>
										Schedule of duty
										approved by Chief
										Nurse
									</li>
								</ul>
							</td>
							<td>
								1:3 beds at
								any time per
								shift (plus 1
								reliever for
								every 3 RNs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- 3rd --}}
						<tr>
							<td>
								Nursing Attendants/Midwife
							</td>
							<td>
								<ul>
									<li>
										Highschool graduate
									</li>
									<li>
										With relevant
										health-related
										training (may
										be in house
										training)
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Certificates of Trainings attended
									</li>
									<li>
										Proof of Employment (notarized)
									</li>
								</ul>
							</td>
							<td>
								1:12 beds at
								any time
								(plus 1
								reliever for
								every 3
								NA/MWs)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>						
					</tbody>
				</table>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th colspan="4" class="text-left">
								II. HRPU EQUIPMENT
							</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-head">
							<td class="at-col-bal-xlg"><b>EQUIPMENT/INSTRUMENT (Functional)</b></td>
							<td class="at-col-bal"><b>QUANTITY</b></td>
							<td><b>COMPLIED</b></td>
							<td><b>REMARKS</b></td>
						</tr>
						@php
							$array = array(
								"Cardiac Monitor with Pulse Oximeter",
								"Cardiotocography (CTG) Machine",
								"Fetal Doppler",
								"Oxygen Unit Tank is anchored/chained/ strapped or with tank holder if not pipeline",
								"Patient bed with side rails",
								"Sphygmomanometer, Non-mercurial",
								"Suction Apparatus"
							);

							$qty = array(
								"1",
								"1",
								"1",
								"1",
								"Refer to approved PTC",
								"1",
								"1"
							);
						@endphp
						{{-- 1st to last --}}
						@for($i=0; $i<count($array); $i++)
							<tr>
								<td>
									{{$array[$i]}}
								</td>
								<td>
									{{$qty[$i]}}
								</td>
								<td class="input"></td>
								<td class="input"></td>
							</tr>
						@endfor
					</tbody>
				</table>
				<p class="ml-5"><b><i>D. AMBULATORYSURGICAL CLINICS (ASC)</i></b></p>
				<p class="ml-5">
					<span class="ml-5"><i>- Refer to assessment tool for (ASC)</i></span>
				</p>
				<p class="ml-5"><b><i>E. DIALYSIS CLINICS</i></b></p>
				<p class="ml-5">
					<span class="ml-5"><i>- Refer to assessment tool for Dialysis Clinics</i></span>
				</p>
				{{-- part 4 level 2 --}}
				<div class="container mt-5 pb-3">
					<strong>PART IV - LEVEL 1 ATTACHMENT 2.A – PERSONNEL</strong>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Billing Officer
							</td>
							<td rowspan="5">
								With Bachelor’s Degree relevant to the job
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Book keeper
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Budget/Finance Officer
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cashier
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Human Resources Management Officer / Personnel Officer
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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

							<td class="input"></td>
							<td class="input"></td>

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

							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 8th tr --}}
						<tr>
							<td>Laundry Worker</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>

						</tr>

						{{-- 11th tr --}}
						<tr>
							<td>Nutritionist –Dietician (Full Time)</td>
							<td>Licensed Nutritionist-Dietician</td>
							<td></td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 12th tr --}}
						
						{{-- 13th tr --}}

						{{-- 14th tr --}}

						{{-- 15th tr --}}

						{{-- 16th tr --}}

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
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 18th tr --}}
						<tr>
							<td>Security Guard (licensed)</td>
							<td>1 per shift</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td></td>
							<td></td>
						</tr>

						{{-- 30th tr --}}
						<tr>
							<td>Nursing attendant in CCU</td>
							<td>1:12 beds at any time (plus 1 reliever for every 3 NA/MWs)</td>
							
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td></td>
							<td></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 37th --}}
						<tr>
							<td>Respiratory Therapist</td>
							<td>
								Licensed respiratory therapist or licensed nurse with respiratory therapy training
							</td>
							<td>1 per shift</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>2.	DOH Approved Floor Plan</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>3.	Checklist for Review of Floor Plans (accomplished)</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container p-4">
				<div class="container pb-3">
					<strong>OBSERVATIONS/FINDINGS (may use separate additional sheets if needed):</strong>
				</div>	
				<div class="container border border-secondary rounded input" style="height: 300px; overflow-y: scroll; ">
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Computer with Internet Access</td>
							<td>1</td>
							<td>Administrative Office</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Emergency Light</td>
							<td></td>
							<td>
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Fire Extinguishers</td>
							<td>1 per unit or area</td>
							<td>
								Lobby, hallway, nurses’ station, office/unit and stairways
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Generator set with automatic Transfer Switch (ATS)</td>
							<td>1</td>
							<td>
								Genset house
							</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Food Conveyor or equivalent (closed-type)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Food Scale</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Blender/Osteorizer</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Oven</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stove</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Refrigerator/Freezer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Utility cart</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Garbage Receptacle with Cover (color-coded)</td>
							<td>1 for each color</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Calculator for dose computation</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Clinical Weighing scale</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery set, primigravid</td>
							<td>2 sets</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery set, multigravid</td>
							<td>2 sets</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>ECG Machine with leads</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic set with Ophthalmoscope and Otoscope</td>
							<td>1set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list).</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr>
							<td>Examining table</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="4">ER</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Examining table (with Stirrups for OB-Gyne</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Glucometer with strips</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Gooseneck lamp/Examining Light</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>


						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="16">ER</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thoracostomy, Cutdown, etc.)
							</td>
							<td>2 sets</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Nebulizer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Negatoscope</td>
							<td>1set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Neurologic Hammer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>OR Light (portable or equivalent)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>Tank is anchored/chained/ strapped or with tank holder if not from pipeline
							</td>
							<td>2</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Pulse Oximeter</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suturing Set</td>
							<td>2 sets</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Vaginal Speculum, Different Sizes</td>
							<td>
								1 for each different size
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Wheelchair</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Wheeled Stretcher with guard/side rails and wheel lock or anchor.</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>


						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>OUT-PATIENT DEPARTMENT</strong></td>
						</tr>
						<tr>
							<td>Clinical Height and Weight Scale</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">OPD</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Gooseneck lamp/Examining Light</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Examining table with wheel lock or anchor</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Minor Instrument Set 1 set</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Neurologic Hammer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>


						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="6">OPD</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Peak flow meter
		                        - Adult
		                        - Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
		                        - Adult
		                        - Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- <tr>
							HIDDEN
							<td>Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr> --}}
						<tr>
							<td>
								Thermometer, non-mercurial<br>
		                        - Oral<br>
		                        - Rectal
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suture Removal Set</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Wheelchair / Wheeled Stretcher</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>


						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="22">OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Anesthesia Machine
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Caesarean Section Instrument</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Electrocautery machine</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Glucometer with strips</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Instrument / Mayo table</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laparotomy pack (Linen pack)</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laparatomy / Major Instrument Set</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscopes with different sizes of blades</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Operating room light</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Operating room table</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
{{-- 						<tr>
							<td>Orthopedic Instrument Set!@#</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr> --}}
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Rechargeable Emergency Light (in case generator malfunction)</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Spinal Set</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Wheeled Stretcher with guard/side rails and wheel lock or anchor.
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="7">
								PACU/RR
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>
								1 (if separate from the OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>
								1 (if separate from the OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Mechanical / patient bed, with guard side rails and wheel lock or anchored
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td rowspan="2"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Thermometer, non- mercurial</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Patient Bed
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Pulse Oximeter</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Stethoscope
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Thermometer, Non- mercurial
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>DELIVERY ROOM</strong></td>
						</tr>

						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="19">DR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Bag valve mask unit (Adult and pediatric)
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Bassinet
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Clinical Infant Weighing scale</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Defibrillator with paddles
							</td>
							<td>
								Defibrillator with paddles 1 (if DR is separate from OR Complex)
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery set, primigravid</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery set, multigravid</td>
							<td>2 sets</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery room light</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Delivery room table</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Dilatation and Curettage set</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- <tr>
							HIDDEN
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1 per OR</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr> --}}
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1 (if DR is separate from OR Complex)</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Instrument/Mayo Table</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Kelly Pad or equivalent</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Rechargeable Emergency Light (in case generator malfunction)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Wheeled Stretcher</td>
							<td>1</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cardiotocography (CTG) Machine
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Fetal Doppler</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit <br> Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Patient bed with side rails</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Sphygmomanometer – Non-mercurial</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>


						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>NEONATAL INTENSIVE CARE UNIT (NICU)</strong></td>
						</tr>
						<tr>
							<td>Air conditioning Unit</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="21">NICU</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Bassinet
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						{{-- <tr>
							HIDDEN
							<td>
								Bilirubin Light/ Phototherapy machine or equivalent
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr> --}}
						<tr>
							<td>Cardiac Monitor with Pulse Oximeter</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Clinical Infant Bag-valve mask unit
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Clinical Infant weighing scale</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Emergency Cart (for contents, refer to separate list)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Glucometer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Incubator</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Infusion pump/ Syringe pump</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscope with neonatal blades of different sizes</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mechanical Ventilator (May be outsourced)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Neonatal Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Oxygen Unit<br>
								Tank is anchored/chained/ strapped or with tank holder if not pipeline
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Refrigerator for Breast milk storage</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, N0n-mercurial<br>
								- for neonate
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Thermometer, non-mercurial</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Umbilical Cannulation set</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td style="vertical-align : middle;text-align:center;" rowspan="16">ICU</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Bag-valve-mask Unit<br>
		                        -  Adult<br>
		                        -  Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cardiac Monitor with Pulse Oximeter
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
{{-- 						<tr>
							HIDDEN
							<td>
								Emergency Cart (for contents, refer to separate list)
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr> --}}
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Infusion pump</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mechanical Bed</td>
							<td>
								Depending on the number of beds declared
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mechanical Ventilator/ Respirator (May be outsourced)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Minor Instrument Set (May be used for Tracheostomy, Closed Tube Thoracostomy, Cutdown, etc.)
							</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							{{-- !@#Infusion pump/ Syringe pump --}}
							<td>Emergency_Cart(for contents, refer to separate list)</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							{{-- <td>!@#Laryngoscope with neonatal blades of different sizes</td> --}}
							<td>Oxygen Unit tank is anchored/chained/strapped or with tank holder if not pipeline</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Sphygmomanometer, non-mercurial(reserved for sudden breakdown of cardiac monitor)<br>
		                        -  Adult cuff for adult unit<br>
		                        -  Pediatric cuff for pediatric unit
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Stethoscope</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Suction apparatus
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5">
								<strong>
									NURSING UNIT/WARD
								</strong>
							</td>
						</tr>
						<tr>
							{{-- <td>Air conditioning Unit</td>HIDDEN --}}
							<td></td>
							<td style="vertical-align : middle;text-align:center;" rowspan="15">NURSING UNIT/WARD</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								Bag-valve-mask Unit<br>
		                        -  Adult<br>
		                        -  Pediatric
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Clinical Height and Weight Scale
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Defibrillator with paddles</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Emergency cart or equivalent (refer to separate list for the contents)
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>EENT Diagnostic Set with ophthalmoscope and otoscope</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td>1 set</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mechanical/Patient bed with lock, if wheeled, with guard or side rails</td>
							<td>
								ABC
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Bedside Table</td>
							<td>ABC</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Neurologic Hammer
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Oxygen Unit Tank is anchored/chained if not pipeline</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Sphygmomanometer, Non-Mercurial
								<br>
		                        -  Adult cuff<br>
		                        -  Pediatric cuff
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Stethoscope
							</td>
							<td><br>1<br>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Suction Apparatus</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Pulmonary Function Test (PFT) or Peak Expiratory Flow Rate (PEFR) Tube
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Spirometer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Nebulizer
							</td>
							<td>
								1
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						<tr style="background-color: rgb(196,188,150);" class="text-center">
							<td colspan="5"><strong>DENTAL CLINIC</strong></td>
						</tr>
						<tr>
							<td>Air compressor</td>
							<td>1</td>
							<td style="vertical-align : middle;text-align:center;" rowspan="25">DENTAL CLINIC</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Autoclave
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Bone file, stainless
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Cotton pliers</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Cowhorn Forceps
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Dental Chair Unit</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Explorer, double-end</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 8</td>
							<td></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No.17 Upper molar</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 18 Upper molar</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 150 Maxillary Universal</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 150 S Primary Teeth</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 Lower Universal</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 Mandibular Pre-molar</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Forceps, No. 151 S Lower Primary Teeth</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Gum separator
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>High speed handpiece with Burr remover</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Low speed handpiece, Angeled head
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mouth mirror explorer</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Periosteal elevator No. 9, double-end</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Rongeur</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Root elevator
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Scaler Jacquettes Set No. 1,2, and 3
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Surgical Chisel	
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Surgical Malette
							</td>
							<td>1</td>
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="container p-4 table-responsive">
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
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Amiodarone 150mg/3mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Anti-tetanus serum (either equine-based antiserum or human antiserum)
							</td>
							<td class="input"></td>
							<td colspan="14" style="background-color: black;" ></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Aspirin USP grade (325 mg/tablet)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Atropine 1 mg/ml ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>B-adrenergic agonists (i.e. Salbutamol 2mg/ml)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Benzodiazepine (Diazepam 10mg/2ml ampule and/or Midazolam) (in high alert box)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Calcium (usually calcium gluconate 10% solution in 10 mL ampule)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Clopidogrel 75 mg tablet</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>D5W 250 mL</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>D50W 50mg/vial</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Digoxin 0.5mg/2mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Diphenhydramine 50mg/mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Dobutamine 250mg/5mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Dopamine 200mg/5mL ampule/vial</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Epinephrine 1mg/ml ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Furosemide 20mg/2ml ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Haloperidol 50mg/mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Hydrocortisone 250mg/2mL vial</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Lidocaine 10% in 50mL spray</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Lidocaine 2% solution vial 1g/50ml</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Magnesium sulphate 1g/2mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Mannitol 20% solution in 500ml/bottle</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Methylprednisolone 4mg/tablet</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Metoclopramide 10mg/2mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Morphine sulphate 10mg/mL ampule (in high alert box)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
								Nitroglycerin inj. 10mg/10mL ampule or Isosorbide dinitrate 5mg SL tablet or 10 mg/10mL ampule
							</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Noradrenaline 2mg/2mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Paracetamol 300mg/ampule (IV preparation)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Phenobarbital 120mg/ml ampule IV or 30mg tablet (in high alert box)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Phenytoin 100mg/capsule or 100 mg.2mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Plain LRS 1L/bottle</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Plain NSS 1L/bottle-0.9% Sodium Chloride</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Potassium Chloride 40mEq/20mL vial (in high alert box)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Vitamin B1/6/12 vial (1g B1, 1g B6, 0.01gB12 in 10 mL vial)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Sodium bicarbonate 50mEq/50mL ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Verapamil 5 mg/2ml ampule</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr style="background-color: rgb(214,227,188)";>
							<td colspan="17"><strong>EQUIPMENT/SUPPLIES</strong></td>
						</tr>
						<tr>
							<td>Airway adjuncts</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Airway / Intubation Kit (with stylet and bag valve masks)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Alcohol disinfectant</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Aseptic bulb syringe</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Calculator</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Capillary Blood Glucose (CBG) Kit</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Cardiac Board</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Endotracheal Tubes, all sizes</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Flashlights or Pen lights</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Gloves, sterile</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Gloves,non-sterile</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Laryngoscope with different sizes of blades</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Nasal cannula</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Protective face shield or mask or goggles</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Standard face mask</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Sterile gauze (pre-folded and individually packed)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Syringes (different volumes)</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Urethral catheter</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Urine collection bag</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>Waterproof aprons</td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
				<div class="container pb-5">
					*Notes:<br>
					ER – Emergency Room<br>	
			        OR – Operating Room<br>
			        DR – Delivery Room<br>
			        NS – Nurses’ Station
				</div>
			</div>
		</div>
		{{-- recommendation --}}
			
		</div>
		{{-- end of recommendation --}}
	</div>
	<script>
		$('.input').each(function(index, el) {
			$(this).html('<i class="fa fa-check text-success" style="font-size:30px"; aria-hidden="true"></i>');
		});
	</script>
	@yield('script')
@endsection