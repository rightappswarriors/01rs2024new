@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')

<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	        	BIRTHING HOME
	        </div>
	        
	        <div class="container p-4">
				<div class="container pb-3">
					<p class="text-center mb-5"><b>ASSESSMENT TOOL FOR LICENSING A BIRTHING HOME</b></p>
					<p><b>I. FACILITY INFORMATION</b></p>
					<form>
						<table class="mb-3 w-100" >
							
							<tbody>
								<!-- name -->
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Facility: "><br>
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
										<input type="" name="" class="form-control" placeholder="Name of Owner of Corporation"><br>
									</td>
								</tr>
								{{-- name of head facility --}}
								<tr>
									<td colspan="2">
										<input type="" name="" class="form-control" placeholder="Name of Head of the Facility:"><br>
									</td>
								</tr>
								<tr>
									<td>
										<label>Latest DOH License Number (if renewal):</label>
										<input type="" name="" class="form-control" placeholder="">
										<label>Authorized Bed Capacity:</label>
										<input type="" name="" class="form-control" placeholder="">
									</td>

								</tr>
								<div class="row mb-3">
								<table class="table table-bordered black" style="">
									<tbody>
										<tr>
											<td>
												<b><u>Classification According to:</u></b><br>
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
											</td>
										</tr>
									</tbody>
								</table>
							</div>
								
							</tbody>
						</table>
				

				<br><br>
						<p><b>II. TECHNICAL REQUIREMENTS</b></p>
						<p>
							<i>Instruction: In the appropriate box, place a check mark (/) if the drug testing laboratory is compliant or x mark (X) if it is not compliant.</i>
						</p>
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 50%">STANDARDS AND REQUIREMENTS</th>
									<th scope="col">COMPLIANT</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td width="600" colspan="3" valign="top">
										<p><b>A. PERSONNEL</b></p>
										<b>
											A birthing facility shall be managed and supervised by
                    healthcare professional(s) who have complied with the
                    minimum and valid licensing requirements. Every birth must
                    be attended by skilled birth attendants.
									</td>
								</tr>
								<tr>
						            <td width="624" colspan="3" valign="top">
						                <p>
						                    <strong>1. </strong>
						                    <strong>Physician </strong>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    a. Valid PRC license
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    b. Certificate of Completed Training from an institution
						                    with an Accredited Residency Program (for Obstetrician and
						                    Gynecologist and Pediatrician)
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    c. A valid certificate of good standing from the Accredited
						                    Professional Organization (APO) of Physicians of PRC and/or
						                    any DOH recognized association of physicians (for Family
						                    Medicine Physician, Municipal Health Officers and General
						                    Practitioners)
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    d. Certificate of Training on BEmONC ( for Family Medicine
						                    Physicians, Municipal Health Officers and General
						                    Practitioners)
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    e. Notarized Contract of Employment/Appointment/Designation
						                    (for employees)
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="3" valign="top">
						                <p>
						                    <strong>2. </strong>
						                    <strong>Nurse </strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    a. Valid PRC License
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    b. Certificate pf good standing from the Accredited
						                    Professional Organization (APO) of Nurses of PRC and/or any
						                    DOH recognized association of nurses.
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="246" valign="top">
						                <p>
						                    c. Notarized Contract of Employment (for employees)
						                </p>
						            </td>
						            <td width="181" valign="top">
						            </td>
						            <td width="196" valign="top">
						            </td>
						        </tr>
						         <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>3. </strong>
						                    <strong>Midwife</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Valid PRC License
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Valid Certificate of Good Standing from the Accredited
						                    Professional Organization (APO) of Midwives of PRC and/or
						                    any DOH recognized association of midwives
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Certificate of Training on BEmONC (no required for those
						                    who finished the four (4) year Midwifery Course)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d. Certificate of Training in Basic Life Support
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    e. Notarized Contract of Employment (for employees)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>4. </strong>
						                    <strong>Administrator</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Notarized Contract of Employment (for employees)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>5. </strong>
						                    <strong>Clerk</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Notarized Contract of Employment (for employees)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>6. </strong>
						                    <strong>Utility Worker</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
											a. Notarized Contract of Employment (for employees) 
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>7. </strong>
						                    <strong>
						                        Driver (on call 24/7 or MOA with a transport provider
						                    </strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Notarized Contract of Employment (for employees)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
					     		<tr class="at-tr-subhead">
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>B. </strong>
						                    <strong>
						                        EQUIPMENT , INSTRUMENTS/SUPPLIES, BASIC MEDICINES
						                    </strong>
						                    (Refer to List of Equipment, Instruments/Supplies, Basic
						                    Medicines) Every health facility shall have available
						                    medicines and operational equipment and instruments
											consistent with the services it shall provide.                    
						                </p>
						            </td>
					        	</tr>
					        	<tr class="at-tr-subhead">
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>C. </strong>
						                    <strong>PHYSICAL FACILITY</strong>
						                </p>
						                <p>
						                    Every health facility shall have physical facility with
						                    adequate areas in order to safely, effectively, and
											efficiently provide health services to patients.                    
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    1. DOH Approved Permit to Contract (PTC)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    2. DOH Approved Floor Plan
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    3. Business Permit
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    4. Posted in conspicuous area
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. License to Operate (for renewal)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Local Permits
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Vision and Mission
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d. Organizational Chart
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    5. Signages
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Information
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Direction
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Prohibition and Warning
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d. No Smoking sign
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    e. Evacuation Plan
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    f. Process Flow of Clinical Services
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
							</tbody>
						</table>

						<br><br>
						<p>
							<strong>III. </strong>
    						<strong>FACILITY OPERATIONS</strong>
						</p>
						<table class="table table-bordered black">
							<thead class="text-center">
								<tr class="at-tr-head">
									<th scope="col" style="width: 50%">STANDARDS AND REQUIREMENTS</th>
									<th scope="col">COMPLIANT</th>
									<th scope="col">REMARKS</th>
								</tr>
							</thead>
							<tbody>
								<tr class="at-tr-subhead">
									<td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>A. </strong>
						                    <strong>
						                        MANUAL OF OPERATIONS/STANDARD OPERATING PROCEDURES
						                    </strong>
						                </p>
						            </td>
								</tr>
								<tr>
						            <td width="340" valign="top">
						                <p>
						                    1. Vision and Mission
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    2. Organizational Chart
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    3. Documented policies and procedures on provision of
						                    clinical services in the facility
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Antepartum Care
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Spontaneous vaginal delivery including essential
						                    intrapartum care
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    c. Postpartum Care
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d. Newborn Care
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1 Essential Newborn Care based on A.O. No.
						                </p>
						                <p>
						                    2009-0025
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1.1 Time Bound interventions
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1.2. Non time bound interventions including
						                </p>
						                <p>
						                    birth doses of recommended vaccines (BCG
						                </p>
						                <p>
						                    and first dose Hepa B)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1.2.1 Routine newborn care
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1.2.2 Postnatal care
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    e. Detection of high risk pregnancies and early referral
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    f. Family Planning
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    f.1 Natural Family Planning Methods pursuant to
						                </p>
						                <p>
						                    A.O. No. 132 s. 2004
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    f.2 Artificial Family Planning Methods
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    g. Health Education
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    g.1 Birth Planning and Preparedness
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    g.2 Material and Newborn Care (Unang Yakap)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    g.3 Infant and Young Child Feeding and Lactation
						                </p>
						                <p>
						                    Management (Breastfeeding TSek)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    g.4 Hygiene
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    4. Documented Policies and procedures on transfer/referral
						                    system to a health facility of higher capability
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    5. Documented Policies and procedures on administration of
						                    life-saving medications such as magnesium sulphate,
						                    oxytocin, steroids, and oral antibiotics pursuant to A.O.
						                    No. 2010-0014.
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    6. Documented policies and procedures on Infection Control
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    7. Healthcare Waste Management
						                </p>
						                <p>
						                    Documented policy and procedures on proper collection,
						                    segregation, treatment and disposal of generated wastes.
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Written policy and procedures on waste
						                </p>
						                <p>
						                    Management
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Proper collection, segregation, coding, storage and
						                    disposal of wastes (for both solid and liquid wastes)
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Use of protective equipment and clothing appropriate for
						                    handling, storage, and disposal of wastes.
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d. Wastes are properly segregated, coded and labelled as
						                    follows:
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1 General/Non-infectious/Dry - Black
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.2 General/Non – infectious/Wet - Green
						                </p>
						            </td>
						            <td width="104" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="155" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						         <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.3 Infectious/Pathological - Yellow
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.4 Sharps – Sharps container
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    8. Preventive maintenance program for equipment.
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Plan for essential equipment replacement in case of
						                    breakdown
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Record of equipment
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Operational manuals of all equipment and instruments
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    9. Documented policies and procedures for handling
						                    complaints, reporting and analysis of incidents, adverse
						                    events, etc.
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    10. Pest and vermin control program
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Documented policies for pest and vermin control Program
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    11. Medical Records
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Confidentiality of patient information
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Policy and procedures for retention and disposal of
						                    medical records in accordance with Department Circular No.
						                    70 S. 1996
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr class="at-tr-subhead">
						            <td width="600" colspan="3" valign="top">
						                <p>
						                    <strong>B. </strong>
						                    <strong>RECORDS/FILES</strong>
						                </p>
						                <p>
						                    Each patient record shall be kept confidential and shall
						                    contain sufficient information to identify the patient and
						                    to justify the diagnosis and treatment.
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    1. Patient’s Clinical Record
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Maternal Clinical Charts with duly accomplished
						                    Partograph
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    Contents of Maternal Clinical Chart:
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.1 Identification Data
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.2 History of Present Condition
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.3 Physical Examination
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.4 Admitting Diagnosis
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.5 Physician’s Order Sheet (if seen by a physician)
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.6 Clinical Laboratory Report and results of other
						                </p>
						                <p>
						                    diagnostic procedures done, if any
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.7 Consultation/Referral Notes
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.8 Medication/Treatment Record
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.9 Postpartum Monitoring
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.10 Informed Consent
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a.11 Final Diagnosis, if seen by a physician
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Newborn Clinical Chart
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b.1 Identification data
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b.2 APGAR Scoring/Ballard’s Maturational Score
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    2. Logbooks for Consultations, Admissions, Discharges,
						                    Deliveries and Sentinel Events (For sentinel events,
						                    include correction, corrective and preventive actions done)
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    3. Copies of Birth/Death Certificates (including Festal
						                    Deaths) submitted to local civil registrar
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    4. Copies of Annual Birthing Home Statistical Report
						                    received by the regional office
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    5. Records of transfer/referral of patient to another
						                    health facility
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    6. Certificate (from UPNIH) as a Newborn Screening Facility
						                    pursuant to RA No. 9288 and AO No. 2008-0026
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    7. Assurance and notarized certification (from a Notary
						                    Public) that the birthing facility does not perform
						                    Dilatation and Curettage.
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    8. Assurance and notarized certification (from a Notary
						                    Public) that the birthing facility does not perform
						                    permanent sterilization procedures such as Bilateral Tubal
						                    Ligation (BTL) and vasectomy.
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    9. Notarized Memorandum of Agreements for outsourced
						                    services
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    a. Patient Transport service provider (if outsourced)
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    b. Waste management service (if outsourced)
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    c. Pest and vermin control service (if outsourced)
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    10. Notarized Memorandum of Agreement if birthing home is
						                    manned by:
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.1. Obstetrician – MOA with Pediatrician or Medical practitioners and/or local government physicians trained on BEmONC
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.2. Pediatrician – MOA with Obstetrician or Medical practitioners and/or local government physicians trained on BEmONC
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.3. Nurse – MOA with Obstetrician and Pediatrician or a General Physician with a Certificate of Completion of a training on 
						                    BEmONC
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
						        <tr>
						            <td width="340" valign="top">
						                <p>
						                    d.4. Midwife – MOA with Obstetrician and Pediatrician or a General Physician with Certificate of Completion Training on BEmONC
						                </p>
						            </td>
						            <td width="104" valign="top">
						            </td>
						            <td width="155" valign="top">
						            </td>
						        </tr>
							</tbody>
						<table>
						<br clear="ALL"/>
						<p>
						    <strong>
						        Checklist of Requirements on Equipment, Instruments/Supplies, and Basic
						        Medicines for Birthing Home
						    </strong>
						</p>
						<p>
						    <strong></strong>
						</p>
						<p>
						    <strong>A. </strong>
						    <strong>General Administrative Service</strong>
						</p>

						<br>
						<table border="1" cellspacing="0" cellpadding="0">
						    <tbody>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    <strong>MINIMUM REQT.</strong>
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p align="center">
						                    <strong>COMPLIANT</strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p align="center">
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    <strong>MINIMUM REQT</strong>
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p align="center">
						                    <strong>COMPLIANT</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong>EQUIPMENT/INSTRUMENTS</strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    1. Bench
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    7. Fire Extinguisher
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    2. Cabinet
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    <strong>8. </strong>
						                    Open Shelf
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    3. Calculator
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    <strong>9. </strong>
						                    Standby Generator or (battery operated rechargeable
						                    emergency light)
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    4. Chair
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1/staff
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    <strong>10. </strong>
						                    Transport vehicle or MOA with a service provider
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    5. Desk
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1/staff
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    <strong>11. </strong>
						                    Typewriter/
						                </p>
						                <p>
						                    Computer
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="147" valign="top">
						                <p>
						                    6. Electric Fan
						                </p>
						            </td>
						            <td width="83" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="126" valign="top">
						                <p>
						                    <strong>12. </strong>
						                    Refrigerator/ cooler (for breast milk, medications and
						                    vaccines such as Hepatitis B and BCG
						                </p>
						            </td>
						            <td width="90" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong><em>Sterilization Area</em></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    1. Autoclave/Steam sterilizer or its equivalent
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    2. Soaking or decontaminating solution
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong>
						                        <em>Treatment Room (same as Outpatient Area)</em>
						                    </strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    1. Clinical weighing scale (adult)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    5. Stethoscope
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    2. Examining table
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    6. Tape measure
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    3. Foot stool
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    7. Vaginal speculum
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    4. Gooseneck/ examining light
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong>
						                        <em>Ward (includes Labor Room and Recovery Room)</em>
						                    </strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    1. Lubricant (water -based)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    5. Thermometer (non-mercurial)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    2. Sphygmomanometer (non-mercurial)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    6. Wall clock with second hand
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    3. Sterile gloves
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    7. Bed with guard rail
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    4. Stethoscope
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    8. Bed sheets
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    Depends on the number of beds
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong><em>Bathing Room</em></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    1. Delivery set
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 per 2 beds
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    6. Instrument table
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    a. Hemostatic/Kelly Forceps, curve or straight
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    7. Instrument cabinet
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    b. Kidney basin
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    8. IV stand
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    c. Needle holder, 8 inches
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    9. Kelly pad
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 (optional)
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    d. Surgical scissors (straight mayo)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    10. Oxygen unit (with humidifier and regulator min 5 lbs)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    e. Bandage scissors
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    11. Pail
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    f. Thumb forceps
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    12. Stool
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    g. Tissue forceps (with teeth)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    13. Suction apparatus (not for routine suctioning, may be
						                    used for newborns whose airway may be bocked)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    h. Sterile plastic umbilical cord clamp(s) or lies
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    14. Pair(s) of slippers (exclusive for birthing room use)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p>
						                    2 pairs
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    i. Umbilical cord scissors
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    15. Room thermometer (non-mercurial), maintain room
						                    temperature between 25-28 degrees Celsius
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    2. Delivery table with stirrups and with provision for
						                    semi-upright position of the birthing mother
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    16. Gowns or patient’s gown
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    For Birthing Room use
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    3. Emergency light/ flashlight
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    17. Linen for drying newborns
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 per bed
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    4. Foot stool
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    18. Sterile drapes
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 per bed
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    5. Gooseneck/ examining lamp
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    19. Scrub suits
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 per staff
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						         <tr>
						            <td width="624" colspan="6" valign="top">
						                <p>
						                    <strong><em>Newborn Resuscitation Area</em></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    1. Emergency kit or cart/ Portable kit or trolley (should
						                    contain the basic medicines, equipment and supplies listed)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    <strong><em>Basic Medicines</em></strong>
						                </p>
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    <strong>Basic Supplies</strong>
						                </p>
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    a. Atropine 1mg/ml ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    a. Intravenous catheter set (adults and newborns)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 each
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						b. BCG vaccines (stored inside ref at temp between 2-8                    <strong>° Celsius</strong>
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    b.70% Isopropyl alcohol
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 bottle
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    c. Bethamethasone (Diprospan) 7 mg per ampule (preferred)
						                    or Dexamethasone 9Scancortin) 5mg per ampule (alternative)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    c. Dispssable syringes (1 cc. 3cc, 5cc, 10cc) with needles
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 each
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    d. Calcium gluconate 10mg/ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    d. IV lubings (macro
						                </p>
						                <p>
						                    and micro-drip sets)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 each
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    e. Dophenhydramine 50mg/ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    e. Nasal cannulas or
						                </p>
						                <p>
						                    plastic face masks
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    f. Epinephrine 1 mg/ml ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    f. plaster
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    g. Erythromycin ophthalmic ointment 0.5% or Oxytetracycline
						                    ophthalmic ointment
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    g. Povidone-iodine
						                </p>
						                <p>
						                    solution
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 bottle
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    h. Hepatitis B vaccines (stored inside ref at temp. between
						                    2-8<strong>° Celsius</strong>
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    h. Sterile absorbable
						                </p>
						                <p>
						                    sutures
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    i. IV fluids (stand by) such as:
						                </p>
						                <p>
						                    i. D5 LR or Plain LR
						                </p>
						                <p>
						                    1L per bottle
						                </p>
						                <p>
						                    ii. Plain NSS 1L per bottle
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    3 bottles
						                </p>
						                <p align="center">
						                    2 bottles
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    i. Sterile cotton balls
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 pack
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    j. Local anesthetic such as Lidocaine 2% solution 50ml vial
						                    5ml carpule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 vial if 50ml, 5 pcs if capsules
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    J. Sterile cotton
						                </p>
						                <p>
						                    pledgets
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 pack
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    k. Magnesium Sulfate ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    k. Sterile gauzes
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 pack
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    l. Oxytocin 10 units per ampule or Oxytocin in pre-filled,
						                    single dose, non-reusable injection
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    2
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    l. sterile gloves
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 box
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    m. Tetanus loxoid containing vaccines
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    2
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    m. Surgical caps
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 box
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    n. Tranxenamic acid ampule
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    n. surgical masks
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 box
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    o. Vitamin K ampules
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    2
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    o. Sharps container
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    <strong><em>Basic Equipment</em></strong>
						                </p>
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <p>
						                    p. Suction catheters (adult and newborn sizes)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 per bed
						                </p>
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    a. Sek=lf-inflating bag-valve-mask devices (one for adult,
						                    one for newborn) or masks for adult and masks for the
						                    newborn (one size 1 for term and one size 0 for pre-term)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1 each
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						                <table cellpadding="0" cellspacing="0">
						                    <tbody>
						                        <tr>
						                            <td width="85" height="52">
						                                <table
						                                    cellpadding="0"
						                                    cellspacing="0"
						                                    width="100%"
						                                >
						                                    <tbody>
						                                        <tr>
						                                            <td>
						                                                <div>
						                                                    <p align="right">
						                                                        DOH-BH-LTO-AT
						                                                    </p>
						                                                    <p align="right">
						                                                        Revision: 03
						                                                    </p>
						                                                    <p align="right">
						                                                        08/03/2016
						                                                    </p>
						                                                    <p align="right">
						                                                        Page 8 of 10
						                                                    </p>
						                                                </div>
						                                            </td>
						                                        </tr>
						                                    </tbody>
						                                </table>
						                            </td>
						                        </tr>
						                    </tbody>
						                </table>
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    b. Stethoscope
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1- adult
						                </p>
						                <p align="center">
						                    1- pediatric
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    c. Sphygmomanometer (non-mercurial_ with adult cuff and
						                    neonatal cuff
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    d. Thermometer (non-mercurial)
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
						        <tr>
						            <td width="175" valign="top">
						                <p>
						                    e. Weighing scale for newborn
						                </p>
						            </td>
						            <td width="76" valign="top">
						                <p align="center">
						                    1
						                </p>
						            </td>
						            <td width="89" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						            <td width="156" valign="top">
						            </td>
						            <td width="76" valign="top">
						            </td>
						            <td width="53" valign="top">
						                <p>
						                    <strong></strong>
						                </p>
						            </td>
						        </tr>
							</tbody>
						</table>
				</div>
			</div>
		</div>
</div>
@include('employee.cmp._assessmentJS') {{-- Javascript for this Module --}}
@endsection