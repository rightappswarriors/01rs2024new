@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	        	PHYSICAL PLANT
	        </div>
			<div class="container p-4">
				<div class="container pb-3">
					<p><b>DOH STANDARDS (Indicators) for HOSPITALS</b></p>
					<p><b>Instructions</b></p>
					<ul class="m-0 pt-0 pb-0">
						<li>
							In the appropriate box, place a check mark (✓) if the hospital is compliant or X-mark if not compliant.
						</li>
						<li>
							Interview at least 10 patients and 10 hospitals staff members.
						</li>
						<li>
							Conduct docement review of at least 10 sample documents.
						</li>
					</ul>
				</div>
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
							<td></td>
							<td></td>
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
							<td></td>
							<td></td>
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
							<td></td>
							<td></td>
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
							<td></td>
							<td></td>
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
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. SERVICE THAT MAY BE OUTSOURCED <br>
								</b>
							</td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								6. Outsourced services are within the facility
							</td>
							<td>
								Presence of all outsourced services within the hospital
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Contracts/MOA for 
   										outsourced services
									</li>
									<li>
										Valid licenses of all 
    									providers
									</li>
									<li>
										Check contracts/job orders
									</li>
								</ul>
							</td>
							<td class="text-center">
								Administrative Office
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. ADMINISTRATIVE SERVICES <br>
								</b>
							</td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								A.  Dietary
							</td>
							<td>
								There shall be provision of safe, quality and nutritious food to patients <br><br>
								Diet prescription or diet counselling is provided to patients
							</td>
							<td>
								<b>DOCUMENT REVIEW/INTERVIEW</b>
								<ul>
									<li>
										Check policies and   
								        procedures in the   
								        dietary
									</li>
									<li>
										Monthly menu for 
        								patients
									</li>
								</ul>
							</td>
							<td class="text-center at-td-mid" rowspan="5">
								Administrative Office
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								B. Linen/ Laundry
							</td>
							<td>
								If not contracted out, there shall be: <br>
								<ul>
									<li>
										Sorting of soiled and contaminated linens n designated areas
									</li>
									<li>
										Systematic washing of laundry with safeguard against spread of infection
									</li>
									<li>
										Disinfection of laundry
									</li>
								</ul>
							</td>
							<td>
								Check policies and procedures on how soiled linens are collected disinfected and washed
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								C. Security
							</td>
							<td>
								Policies and procedures on security of patients, visitors and hospital staff
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								security check for internal and external customers including use of visitor’s pass
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								D. Housekeeping/ Janitorial
							</td>
							<td>
								There shall be provision and maintenance of clean, safe and sanitary facilities and environment for
							</td>
							<td>
								<b>OBSERVE</b> <br>
								Proof of implementation
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								E. Proper Waste Disposal
							</td>
							<td>
								Policies and procedures on proper waste disposal.
							</td>
							<td>
								<b>DOCUMENT REVIEW</b><br><br>
								Proof of implementation of policies and procedures on proper waste disposal.
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								F. Maintenance (Equipment and Building)
							</td>
							<td>
								Policies and procedures on maintenance
							</td>
							<td>
								<b>DOCUMENT REVIEW</b><br><br>
								<b>OBSERVE</b><br>
								Proof of implementation
							</td>
							<td>
								Lobby <br>
								ER/OPD <br>
								Wards and the rest of the hospital
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									II. SAFE PRACTICE AND ENVIRONMENT <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. PATIENT AND STAFF SAFETY <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: the organization plans a safe and effective environment of care consistent with its mission, services, and with laws and regulations
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
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Updated DOH license
									</li>
									<li>
										If facility has nuclear 
									    medicine, check 
									    certificate issued by PNRI
									</li>
								</ul>
							</td>
							<td>
								Administrative office
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								8. Building Maintenance Program is in place ensuring facilities are in state of good repair
							</td>
							<td>
								Policies and procedures
							</td>
							<td>
								<b>DOCUMENT REVIEW</b><br>
								Routine program of work preventive maintenance and record of corrective maintenance are available
							</td>
							<td>
								
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								9. Hospital is free from undue noise, pollution and from foul odor
							</td>
							<td>
								
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Check presence of MSDS 
									    (Material Safety Data Sheet) 
									    in the laboratory and 
									    Engineering
									</li>
									<li>
										Record of disposal of 
    									radiologic wastes
									</li>
								</ul> <br><br>
								<b>INTERVIEW</b><br>
								Ask staff at random:
								their manner of waste segregation and disposal; safe storage and disposal of reagents, and disposal of wastewater
							</td>
							<td>
								Hospital surroundings Laboratory Pharmacy and other part of the facility and Maintenance
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								10. Presence of a management plan, policies and procedures addressing safety
							</td>
							<td>
								Presence of a management plan, policies and procedures addressing:
								<ul>
									<li>
										Safety
									</li>
									<li>
										Security
									</li>
									<li>
										Disposal and control of 
									    hazardous materials and 
									    biologic wastes
									</li>
									<li>
										Emergency and disaster preparedness
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b><br>
								<ul>
									<li>
										Management plan, policies and procedures
									</li>
									<li>
										Proof Of Implementation
									</li>
								</ul><br>
								<b>INTERVIEW</b><br>
								Ask about the frequency of the following:
								<ul>
									<li>
										Fire drill conducted in the past 12 months
									</li>
									<li>
										Earthquake drill conducted in the past 12 months
									</li>
								</ul>
							</td>
							<td>
								Administrative office Maintenance office, ER <br>Wards
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								11. Policies and procedures for the safe and efficient use of medical equipment according to specifications are documented and implemented.
							</td>
							<td>
								Presence of policies and procedures for:
								<ul>
									<li>
										Quality Control
									</li>
									<li>
										Corrective and 
									    Preventive Maintenance 
									    Program for medical 
									    equipment
									</li>
								</ul>
							</td>
							<td>
								<b>DOCUMENT REVIEW</b><br>
								<ul>
									<li>
										Presence of operating 
									    manuals of the medical 
									    equipment
									</li>
									<li>
										Preventive and corrective maintenance logbook
									</li>
									<li>
										Film reject analysis
									</li>
									<li>
										Quality control tests results
									</li>
								</ul><br>
								<b>OBSERVE</b><br>
								How staff performs necessary precaution or safety procedures such as: red light is on while x-ray procedure is being done.br <br>
								<i>Note: look into their storage of mercury containing devices which are no longer allowed to be used</i>

							</td>
							<td>
								ER <br>
								OPD<br>
								Wards<br>
								DR<br>
								Laboratory<br>
								Pharmacy<br>
								Maintenance Office<br>
								Other areas
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								12. Patient areas provide sufficient space for safety, comfort and privacy of the patient and for emergency care.
							</td>
							<td>
								<ul>
									<li>
										Presence of adequate 
									    space, lighting and 
									    ventilation in 
									    compliance
									    with structural 
									    requirements (for 
									    patient
									    safety a0nd privacy)
									</li>
								</ul>
							</td>
							<td>
								<b>OBSERVE</b><br>
								<ul>
									<li>
										Adequate space for patients 
									    in moving around the bed 
									    areas
									</li>
									<li>
										Adequate lighting (lights are
									    working, lighting is 
									    adequate enough for 
									    conduct of general 
									    activities)
									</li>
									<li>
										Adequate ventilation
									</li>
									<li>
										Segregation of sexes, in wards and clinical areas
									</li>
								</ul>
							</td>
							<td>
								ER <br>
								OPD<br>
								Wards<br>
								DR
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								13. A coordinated security arrangement in the organization assures protection of patients, staff and visitors
							</td>
							<td>
								Presence of an appointed personnel in charge of security.
							</td>
							<td>
								<b>DOCUMENT REVEIW</b><br>
								Contract of Appointment of person in charge of security.
								<b>INTERVIEW</b><br>
								Ask the personnel in charge of security what the policies on security are. <br>
								<b>OBSERVE</b>
								<ul>
									<li>
										Security measures
									</li>
									<li>
										CCTV is provided
									</li>
								</ul>
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									B. MAINTENANCE OF THE ENVIRONMENT OF CARE <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: Emergency light and/or power supply, water and ventilation systems are provided for, in keeping with relevant statutory requirements and codes of practice.
								</b>
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
								<b>DOCUMENT REVEIW</b>
								<ul>
									<li>
										Check result of water 
									    analysis for the last 6 
									    months.
									</li>
									<li>
										Preventive and corrective 
										maintenance logbooks
									</li>
								</ul>
								<br>
								<b>OBSERVE</b>
								<ul>
									<li>
										Test if faucets and water closets are working
									</li>
									<li>
										Functional lights and generators
									</li>
								</ul>
							</td>
							<td>
								Engineering/<br>Maintenance <br>
								Other <br>
								Relevant <br>
								Areas
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>
								15. Equipment re regularly maintained with plan for replacement according to expected life span or when no longer serviceable.
							</td>
							<td>
								Presence of policies and procedures on preventive and corrective maintenance and replacement if warranted
							</td>
							<td>
								<b>DOCUMENT REVEIW</b>
								Records of preventive and corrective maintenance and plan for replacement
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>
								16. Training of the staff who is in charge of the maintenance of the equipment
							</td>
							<td>
								Proof of training of the staff who is in charge of the maintenance of the equipment
							</td>
							<td>
								<b>DOCUMENT REVEIW</b><br>
								For in-house: Certificate of training of service personnel or Certificate of training For outsourced service: MOA/Contract <br><br>
								<b>INTERVIEW</b><br>
								Ask about how equipment (generator. A/C, Medical and non-medical devices, etc.) are maintained
							</td>
							<td>
								Engineering/<br>Maintenance <br>
								Office <br>
								Laboratory <br>
								Imaging <br>
								Other Areas 
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: Current information and scientific data from manufacturers concerning their products are available for   reference and guidance in the operation and maintenance of plant and equipment. <br>
								</b>
							</td>
						</tr>

						<tr>
							<td>
								17. Operating manuals of equipment
							</td>
							<td>
								Presence of operating manuals equipment
							</td>
							<td>
								<b>DOCUMENT REVEIW</b><br>
								Operating manual of Medical equipment, generators, air conditioners and other non-medical equipment.
							</td>
							<td>
								Engineering/<br>Maintenance <br>
								Office <br>
								Imaging <br>
								Laboratory <br>
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. ENERGY AND WASTE MANAGEMENT <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Standard:  The handling , collection and disposal of waste conform with relevant statutory requirements and code of practice
								</b>
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
								<b>DOCUMENT REVEIW</b><br>
								<ul>
									<li>
										Valid licenses/ permits 
									    regulatory agencies (LGU,
									    DENR, etc.)
									</li>
									<li>
										Proof of compliance i.e., 
									    generator permit, elevator 
									    permit, etc.
									</li>
								</ul>
							</td>
							<td>
								Administrative office
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>
								19. Policies and procedures on waste Disposal Management
							</td>
							<td>
								Proof of strict implementation of policies and procedures on waste management
							</td>
							<td>
								<b>DOCUMENT REVEIW</b><br>
								<ul>
									<li>
										Issuances- memos, 
									    guidelines on waste, 
									    segregation, collection 
									    treatment and disposal.
									</li>
									<li>
										Contracts with service 
									    providers waste handlers
									    or disposal contractors (if 
									    applicable)
									</li>
								</ul> <br>
								<b>OBSERVE</b>
								<ul>
									<li>
										Segregation of waste
									</li>
									<li>
										Proper labelling of waste receptacles
									</li>
									<li>
										Recyclable waste staging areas
									</li>
									<li>
										Proper management of 
									    temporary storage areas 
									    prior to hauling for 
									    disposal.
									</li>
								</ul> <br>
								<b>INTERVIEW</b> <br>
								Ask staff regarding SOPs on actual procedure on waste disposal
							</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection