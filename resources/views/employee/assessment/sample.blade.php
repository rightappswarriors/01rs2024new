@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="container font-weight-bold">NOTE: THIS IS A TEST ONLY</div>
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
							<th scope="col">STANDARDS AND REQUIREMENTS</th>
							<th scope="col" class="at-col-bal">COMPLIANT</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr class="font-weight-bold">
							<td colspan="3" class="at-tr-subhead">
								<p>I.    PATIENCE CARE</p>
									<p class="pl-3">A.    ACCESS</p>
										<p class="pl-5">              Standard: Appropriate professionals perform coordinated and sequenced patient assessment to reduce waste and unnecessary repetition.</p>
							</td>
						</tr>
						<tr>
							<td>
								<span class="font-weight-bold">1. NURSING SERVICES</span><br> Moderate Nursing Care and Management
								<br>
								Licensed and appropriately trained nursing personnel assigned in special and critical areas
								<br>
								<br>
								<span class="font-weight-bold">DOCUMENT REVIEW</span><br> PRC Valid license Certificate of relevant training
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Wards, ER. OPD
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">2. Nurses make use of Nursing Process in the care of patients</span>
								<br>
								Charts have nurses’ notes Presence of Nursing manual and properly utilized Kardex
								<br>
								<br>
								<span class="font-weight-bold">CHART REVIEW</span> <br> Patients’ charts from medical records or wards have nurses’ notes
								<span class="font-weight-bold">DOCUMENTS</span><br> Patients’ charts Kardex
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Wards, ER. OPD
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="3" class="at-tr-subhead">
								<p>B.     IMPLEMENTATION OF CARE</p>
								<p>Standard:  Medicines are administered in a standardized and systematic manner. Diagnostic examinations appropriate to the provider or organization’s service capability and usual case mix are available and are performed by qualified personnel</p>
							</td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">3. Medicines are administered in a timely, safe, appropriate and controlled manner</span>
								<br>
								<br>
								All medicines are administered observing the five (5) R’s of medication which are:
								1.	Right patient
								2.	Right medication
								3.	Right dose
								4.	Right route
								5.	Right time
								<br>
								<br>
								<span class="font-weight-bold">CHART REVIEW</span> <br> Check patients charts for the accuracy of medicine administration.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								ER Wards
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">4. Only qualified personnel order, prescribe, dispense prepare, and administer drugs.</span>
								<br>
								<br>
								All doctors, pharmacists and nurses have updated licenses
								<br>
								<br>
								<span class="font-weight-bold">INTERVIEW</span> <br> Randomly check the licenses of some doctors, nurses and pharmacists if they are updated.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Wards Pharmacy ER OPD
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">5. Prescriptions or orders are verified and patients are properly identified  before medications are administered</span>
								<br>
								<br>
								Proof that prescriptions or orders are verified before medications are administered
								<br>
								<br>
								<span class="font-weight-bold">INTERVIEW</span> <br> Ask staff how they verify orders from doctors prior to administration of medicines.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Wards ER
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">6. patients are properly identified before medicines are administered</span>
								<br>
								<br>
								Proof that patients are correctly identified prior to administration of medications
								<br>
								<br>
								<span class="font-weight-bold">INTERVIEW</span> <br> Verify from patients if they were correctly identified prior to drug administration.
								<br>
								<br>
								<span class="font-weight-bold">OBSERVE</span><br>If the staff verifies the identity of patient prior to administration of medications (patient should be the one to state his/her name.)
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Wards ER
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">7. Medicine administration is properly documented in the patient chart. Proof that patients are correctly identified prior to administration of medications</span>
								<br>
								<br>
								Proof that patients are correctly identified prior to administration of medications
								<br>
								<br>
								<span class="font-weight-bold">All charts have proper documentation of medicine administration.</span>
								<br>
								<br>
								<span class="font-weight-bold">CHART REVIEW</span><br>Medication sheet in patient chart from medical records or from the wards.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								Medical records office wards
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr class="font-weight-bold">
							<td colspan="3" class="at-tr-subhead">
								<p>II. SAFE PRACTICE AND ENVIRONMENT </p>
								<p>A.  INFECTION CONTROL<br>
									Standard: the organization uses a coordinated system- wide approach to reduce the risks of healthcare- associated infections.
								</p>
							</td>
						</tr>
						<tr>
						<td>
							<span class="font-weight-bold">8. There are programs for prevention and treatment of needle stick injuries, and policies and procedures for the safe disposal of used needles are documented and monitored</span>
								<br>
								<br>
								Presence of policies and procedures on the prevention and treatment of needle stick injuries and safe disposal of needles
								<br>
								<br>
								<span class="font-weight-bold">INTERVIEW</span><br> Ask staff their policies on needle stick injury
								<br>
								<br>
								<span class="font-weight-bold">OBSERVE</span><br>Use of PPEs in doing minor surgeries, IV insertions, etc.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								ER Wards
						</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
						<tr>
							<td>
							<span class="font-weight-bold">9. Policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies.</span>
								<br>
								<br>
								Presence of policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies
								<br>
								<br>
								<span class="font-weight-bold">DOCUMENT REVIEW</span><br>• Policies and procedures<br>
								•   Logbooks on packaging
									and sterilizing of  and 
									equipment, instruments 
									supplies
								<br>
								<br>
								<span class="font-weight-bold">OBSERVE</span><br>Designated areas for receiving, cleaning, disinfecting, drying packaging, sterilizing and releasing of sterilized equipment, instruments and supplies.
								<br>
								<br>
								<span class="font-weight-bold">Area</span>
								<br>
								<br>
								ER Wards
							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>
			</div>

			{{--end part 2 1 page --}}

			{{-- part 3 1 page --}}
			{{-- <div class="container p-4 table-responsive">
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
								<td colspan="3">
									<b>
										I. PATIENT CARE <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. ACCESS <br>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: Appropriate professionals perform coordinated and sequenced patient assessment to reduce waste and unnecessary repitition.
									</b>
								</td>
							</tr> --}}

							{{-- 1st row --}}

						{{-- 	<tr>
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
							</tr> --}}

							{{-- 2nd row --}}

						{{-- 	<tr>
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
							</tr> --}}

							{{-- 4th row --}}
							{{-- <tr>
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
								<td class="font-weight-bold" colspan="3">1.	ADMINISTRATIVE SERVICES</td>
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
								<td colspan="3">
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
								<td colspan="3" class="at-tr-subhead">
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
								<td colspan="3" class="at-tr-subhead">
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
			</div> --}}
			{{-- end of part 3 1 page --}}

			<div class="container p-4 table-responsive">
				<div class="container pb-3">
					<b>PART IV - LEVEL 1 ATTACHMENT 1.A - PERSONAL</b>
				</div>
				<table class="table table-bordered black">
					<thead class="text-center">
						<tr class="at-tr-head">
							<th scope="col">STANDARDS AND REQUIREMENTS</th>
							<th scope="col" class="at-col-bal">COMPLIANT</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody>
						<tr class="at-tr-subhead">
							<td colspan="3">
								<b>TOP MANAGEMENT (Should be full time)</b>
							</td>
						</tr>

						{{-- 1st row --}}

						<tr>
							<td>
								Chief of Hospital/Medical Director
								<br>
								<br>	
								<ul>
									<li>Licensed physician</li>
									<li>
										Have completed at least twenty (20) units towards a Master's Degree in Hospital Administration or related course (MPH, etc) <b><u>OR</u></b> at least five (5) years hospital experience in a supervisory or managerial position
									</li>
								</ul>
								<br>
								<br>
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
								</ul><br>

							</td>
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 2nd row --}}

						<tr>
							<td>
								Chief Nurse/Director of Nursing
								<br><br>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Master's Degree in Nursing <b><u>AND</u></b> at least five (5) years of experience in a supervisory or managerial position in nursing (R.A. No. 9173)
									</li>
								</ul>
								<br><br>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>

						{{-- 3rd Row --}}

						<tr>
							<td>
								Chief Administrative Officer/Hospital Administrator
								<br><br>
								<ul class="m-0 p-4">
									<li>
										Licensed nurse
									</li>
									<li>
										Have completed at least twenty (20) Units towards Master's Degree in Hospital Administration or related course (MPH, MBA, MPA, MHSA, etc.) <b><u>OR</u></b> at least five (5) years hospital experience in a supervisory/managerial position.
									</li>
								</ul>
								<br><br>
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
							<td class="input"></td>
							<td class="input"></td>
						</tr>
					</tbody>
				</table>

			{{-- <div class="container p-4 table-responsive"> --}}
			
				<table class="table table-bordered black">
					
					<tbody>
						
						
						
						
					</tbody>
				</table>
			</div>
		{{-- </div> --}}
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