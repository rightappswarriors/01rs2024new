@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	        	NURSING SERVICE
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
							<th scope="col">CRITERIA</th>
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
								1. 
								<b>NURSING SERVICES</b> <br>
								Moderate Nursing Care and Management
							</td>
							<td>
								Licensed and appropriately trained nursing personnel assigned in special and critical areas
							</td>
							<td>
								<b>DOCUMENT REVIEW</b> <br>
								PRC Valid license <br>
								Certificate of relevant training
							</td>
							<td class="text-center">Wards, ER, OPD</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 2nd row --}}

						<tr>
							<td>
								2. Nurses make use of Nursing Process in the care of patient
							</td>
							<td>
								Charts have nurses’ notes <br><br>
								Presence of Nursing manual and properly utilized Kardex
							</td>
							<td>
								<b>CHART REVIEW</b> <br>
								Patients’ charts from medical records or wards have nurses’ notes
								<br><br>
								<b>DOCUMENTS</b>
								<br> Patients’ charts Kardex
							</td>
							<td class="text-center">
								Wards <br><br>
								Medical
								Records
								Office
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 3rd Row --}}

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									B. IMPLEMENTATION OF CARE <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Standard:  Medicines are administered in a standardized and systematic manner. Diagnostic examinations 
        appropriate to the provider or organization’s service capability and usual case mix are available and are performed
        by qualified personnel    

								</b>
							</td>
						</tr>

						<tr>
							<td>
								3. Medicines are administered in a timely, safe, appropriate and controlled manner
							</td>
							<td>
								All medicines are administered observing the five (5) R’s of medication which are:
								<br>
								<ol>
									<li>
										Right patient
									</li>
									<li>
										Right medication
									</li>
									<li>
										Right dose
									</li>
									<li>
										Right route
									</li>
									<li>
										Right time
									</li>
								</ol>
							</td>
							<td>
								<b>CHART REVIEW</b> <br>
								Check patients charts for the accuracy of medicine administration.
							</td>
							<td class="text-center">
								ER <br> Wards
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 4th row --}}
						<tr>
							<td>
								4. Only qualified personnel order, prescribe, dispense prepare, and administer drugs.
							</td>
							<td>
								All doctors, pharmacists and nurses have updated licenses
							</td>
							<td>
								<b>INTERVIEW</b> <br>
								Randomly check the licenses of some doctors, nurses and pharmacists if they are updated.
							</td>
							<td>
								Wards <br>
								Pharmacy <br>
								ER <br>
								OPD
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>
								5. Prescriptions or orders are verified and patients are properly identified  before medications are administered
							</td>
							<td>
								Proof that prescriptions or orders are verified before medications are administered
							</td>
							<td>
								<b>INTERVIEW</b> <br>
								Ask staff how they verify orders from doctors prior to administration of medicines. <br><br>
								<b>OBSERVE</b> <br>
								How staff verifies the prescriptions or orders for medicines with the doctor’s order.
							</td>
							<td class="text-center">
								Wards <br> ER
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 5th row --}}
						<tr>
							<td>
								6.  patients are properly identified before medicines are administered
							</td>
							<td>
								Proof that patients are correctly identified prior to administration of medications
							</td>
							<td>
								<b>INTERVIEW</b> <br>
								Verify from patients if they were correctly identified prior to drug administration. <br><br>
								<b>OBSERVE</b> <br>
								If the staff verifies the identity of patient prior to administration of medications (patient should be the one to state his/her name.)
							</td>
							<td class="text-center">
								Wards <br> ER
							</td>
							<td></td>
							<td></td>
						</tr>

						{{-- 6th row --}}
						<tr>
							<td>
								7.  Medicine administration is properly documented in the patient chart
							</td>
							<td>
								All charts have proper documentation of medicine administration
							</td>
							<td>
								<b>CHART REVIEW</b> <br>
								Medication sheet in patient chart from medical records or from the wards.
							</td>
							<td class="text-center">
								Medical records office wards
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr class="at-tr-subhead">
							<td colspan="6">
								<b>
									II. SAFE PRACTICE AND ENVIRONMENT <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A.  INFECTION CONTROL <br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard: the organization uses a coordinated system- wide approach to reduce the risks of healthcare- associated infections.

								</b>
							</td>
						</tr>

						{{-- 7th row --}}
						<tr>
							<td>
								8. There are programs for prevention and treatment of needle stick injuries, and policies and procedures for the safe disposal of used needles are documented and monitored
							</td>
							<td>
								Presence of policies and procedures on the prevention and treatment of needle stick injuries and safe disposal of needles
							</td>
							<td>
								<b>INTERVIEW</b> <br>
								Ask staff their policies on needle stick injury <br><br>

								<b>OBSERVE</b> <br>
								Use of PPEs in doing minor surgeries, IV insertions, etc.
							</td>
							<td>
								ER <br> Wards
							</td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td colspan="6">
								<b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Standard:  Cleaning, disinfecting, drying, packaging and sterilizing of equipment, and maintenance of associated environment, conform to relevant statutory requirements and codes of practice.

								</b>
							</td>
						</tr>

						{{-- 8th row --}}
						<tr>
							<td>
								9. Policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies.
							</td>
							<td>
								Presence of policies and procedures on cleaning, disinfecting, drying, packaging and sterilizing of equipment, instruments and supplies
							</td>
							<td>
								<b>DOCUMENT REVIEW</b>
								<ul>
									<li>
										Policies and procedures
									</li>
									<li>
										Logbooks on packaging
								    	 and sterilizing of  and 
								     	equipment, instruments 
								     	supplies
									</li>
								</ul>
								<b>OBSERVE</b> <br>
								Designated areas for receiving, cleaning, disinfecting, drying packaging, sterilizing and releasing of sterilized equipment, instruments and supplies.

							</td>
							<td class="text-center">CSSR</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection