@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')

<div class="content p-4">
        <div class="card">
            <div class="card-header bg-white font-weight-bold">
                AMBULATORY SURGICAL CLINIC Oral and Maxillo-Facial Surgery
            </div>
            
            <div class="container p-4">
                <div class="container pb-3">
                    <p class="text-center mb-5 mt-5"><b>ASSESSMENT  TOOL FOR LICENSING AN
                    AMBULATORY SURGICAL CLINIC Oral and Maxillo-Facial Surgery

                    </b></p>

                    
                    <form>
                        <table class="mb-3 w-100" >
                            
                            <tbody>
                                <!-- name -->
                                <tr><td><p><b>I. GENERAL INFORMATION</b></p><br></td></tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="" name="" class="form-control input" placeholder="Name of Ambulatory Surgical Clinic "><br>
                                    </td>
                                </tr>
                                <!-- complete addr -->
                                <tr>
                                    <td>Complete Address</td>
                                </tr>
                                <tr>
                                    <td>
                                        {{-- region --}}
                                        <select type="" class="form-control input" id="d_region" onchange="regionSelect()">
                                            <option value="" hidden disabled selected>Region*</option>
                                            
                                        </select>
                                    </td>
                                    <td colspan="2">
                                        {{-- province --}}
                                        <select  type="" class="form-control input" id="d_prov" onchange="provSelect()">
                                            <option value="" hidden disabled selected>Province*</option>
                                            
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{-- cm --}}
                                        <select type="" class="form-control input" id="d_cm" onchange="cmSelect()">
                                            <option value="" hidden disabled selected>City/Municipality*</option>
                                            
                                        </select>
                                    </td>
                                    <td>
                                        {{-- brgy --}}
                                        <select type="" class="form-control input" id="d_brgy">
                                            <option value="" hidden disabled selected>Barangay</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="" name="" class="form-control input" placeholder="No. & Street"><br>
                                    </td>
                                </tr><br>

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

                                <tr>
                                    <td colspan="2">Telephone/Fax Number 
                                        <input type="" name="" class="form-control input" placeholder="Telephone/Fax Number"><br>
                                    </td>
                                </tr>
                                {{-- name of head facility --}}
                                <tr>
                                    <td colspan="2">Name of Owner/ Administrator
                                        <input type="" name="" class="form-control input" placeholder="Name of Owner/ Administrator"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <table class="table table-bordered black" style="">
                                    <tbody>
                                        <tr>
                                            <td colspan="1">
                                                <div class="row">
                                                    <div class="col">
                                                    <b><u>Classification According to Ownership:</u></b><br>
                                                        <input type="radio" name="ownership" style="margin-right:1em;" value="government">Government</input><br>
                                                       
                                                       <input type="radio" name="ownership" style="margin-right:1em;" value="private">Private</input><br>

                                                        
                                                    </div>
                                                
                                                    <div class="col">
                                                     <b><u>Classification According to Status of Application</u></b><br>
                                                            <input type="radio" name="status" style="margin-right:1em;" value=initial">Initial</input><br>
                                                        
                                                            <input type="radio" name="status" value="renewal" style="margin-right:1em;">Renewal</input><br>
                                                            <div class="col">
															<p><br><br>
																License No. <input type="text" name="licenseNo">
															<br><br>
																Date Issued <input type="text" name="dateIssued">
															<br><br>
																Expiry Date <input type="text" name="expiryDate">
															</p>
														</div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </tr>
                               
                                <br><br>
                                <tr><td><p><b>II.	COMPLIANCE WITH STANDARDS</b></p></td></tr>
                                <tr>
                                    <p>
                                       Instructions: Conduct a tour of the facility. Interview the owner and/or authorized representative. Put a check (/) on the appropriate boxes. Write N/A if not applicable.

                                    </p>
                                    <p style="margin:1em;">
                                        <b>A. Administrative</b>
                                    </p>
                                </tr>

                                <table  class="table row-bordered black center" style="width:70%;">
                                    <tbody>
                                        <tr class="at-tr-subhead" >
                                            <td colspan="3"><p>1.  Efficient and effective governance ensure a planned and coordinated service delivery system appropriate to the needs of patients and service providers.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               1.1   There is a written vision and mission statement stating the goals and objectives of the clinic.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td colspan="3"><p>2.  Dental  records  contain  patient  information  that  is  uniquely identifiable,  accurately recorded, current, confidential and accessible when required.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               2.1	Confidentiality of patient information is maintained at all times by providing appropriate storage areas.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               2.2	Diagnoses, procedures, and/ or operations performed on patients are recorded using ICD-10.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		 2.3	Patient Charts are properly and completely filled up and contain up-to-date information on the following:
                                        	</td>
                                        	<td></td><td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                        @php
	                                        $cpc = array(
		                                        "Identification Data",
		                                        "Chief Complaint",
		                                        "History of Present Illness",
		                                        "Diagnosis",
		                                        "Dentist",
		                                        "Clinical Laboratory Report, where applicable",
		                                        "X-ray Report, where applicable",
		                                        "Consultation/Referral Notes where applicable",
		                                        "Medication/ Treatment",
		                                        "Informed Consent",
		                                        "Record of Operative Technique",
		                                        "Anesthesia Record",
		                                        "Post-Operative Record"
		                                    );
                                        @endphp
                                
				                                <table class="table table-bordered black center" style="width:50%; margin-left:8em;">
				                                    <thead class="text-center">
				                                        <tr class="at-tr-head">
				                                            <th scope="col" style="width: 70%">Content of Patient Chart</th>
				                                            <th scope="col">Available</th>
				                                        </tr>
	                                       			</thead>
	                                       			<tbody>
	                                       				@for($i=0; $i<count($cpc); $i++)
	                                       					<tr>
	                                       						<td>
	                                       							{{$cpc[$i]}}
	                                       						</td>
	                                       						<td  class="input"></td>
	                                       					</tr>
	                                       				@endfor
	                                       			</tbody>
	                                       		</table>
	                                       		<br>

	                            <table  class="table row-bordered black center" style="width:70%;">
                                   
                                    <tbody>
                                       	<tr class="at-tr-subhead" >
                                            <td colspan="3"><p>3. Human resource management processes are conducted in accordance with good employment practices.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               3.1	Personnel  hired  are  qualified  and  competent  on  the  basis  of appropriate education, training, skills and experiences.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              3.2	New personnel receive an orientation that covers the essential components of the service being provided.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               3.3	The performance of personnel is monitored and evaluated.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead" >
                                            <td colspan="3"><p>4.  Effective  and  efficient  methods  are  used  to  identify  areas  for  improvement  of  the  quality management system performance.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               4.1   The  clinic  has  an  established,  documented  and  maintained quality management program that reflects continuous quality improvement principles.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              4.2   There is a system for recording, reporting, investigation, analysis, corrective action and review process for adverse, unplanned, or untoward events such as:<br>

                                            </td>
                                            <td></td><td></td>
                                        </tr>
                                        <tr>
                                            <td >
                                                <p style="margin-left:3em;">Accidents, incidents, near misses, and adverse clinical events
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin-left:3em;">Complaints and suggestions
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin-left:3em;">Others, specify:<input class="textarea"></p>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br><p style="margin:1em;">
                                        <b>B. Clinical</b>
                                    </p>
                             
                                <table  class="table row-bordered black center" style="width:70%;">
                                    
                                    <tbody>
                                        <tr class="at-tr-subhead" >
                                            <td colspan="3"><p>1.  The health facility appoints and allocates personnel who are suitably qualified, skilled and/or experienced to provide the service and meet patient needs.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               1.1   Each  personnel  are  qualified,  skilled  and/or  experienced  to assume  the  responsibilities,  authority,  accountability  and functions of the position.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               1.2  Professional qualifications are validated, including evidence of professional registration/ license, where applicable, prior to and during employment.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices1" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td colspan="3"><p>2.  All  equipment/  instruments  necessary  for  the  safe  and  effective  provision  of  services  are available and are properly maintained.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                              2.1	Records of equipment are maintained and updated regularly.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               2.2	A preventive maintenance program ensures that all equipment are maintained and/or calibrated to an appropriate standard or specification.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		2.3	There is a plan in place for essential equipment replacement.
                                        	</td>
                                        	<td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		2.4	Personnel  are  competent  when  using  equipment  in  line  with manufacturer’s instruction/ operational manual.
                                        	</td>
                                        	<td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		2.5	Operational  manuals  of  all  equipment  and  instruments  are available for reference and guidance.
                                        	</td>
                                        	<td>
                                                <input type="radio" class="input" name="choices3" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices3" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td colspan="3"><p>3.  Services in the clinic are provided in an environment that ensures physical privacy, promotes safety, has adequate space and meets the needs of patients, service providers and other stakeholders.</p></td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <i>Environment</i><br>
                                              <p style="margin-left:2em;"> 3.1   Free from undue noise, smoke, dust, foul odor, and flood.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                              <i>Environment</i> <br>
                                              <p style="margin-left:2em;"> 3.2   Not located adjacent to railroads, freight yards, children’s playgrounds, airports, industrial plants, and waste disposal plants.                       
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>

                                        @php
                                        	$pfus = array (
                                        		"3.3	All physical facilities and utility systems necessary for the safe and effective provision of services are available and are properly maintained.",
                                        		"3.4	A building maintenance program is in place to ensure that all buildings/ facilities are kept in a state of good repair.",
                                        		"3.5	A building/ facility inventory is maintained and updated regularly.Frequency:	 	",
                                        		"3.6	Floors, walls and ceiling are made of sturdy materials that allow durability and ease of cleaning.",
                                        		"3.7	The clinic has an approved power supply system.",
                                        		"3.8	Panel boards and feeders are properly coded and labeled.",
                                        		"3.9   The clinic has an approved water supply system.",
                                        		"3.10 The clinic has available water supply that is potable and safe for drinking.",
                                        		"3.11 Records of water analysis (bacteriological examination) are available and updated regularly (at least annually). Frequency:	",
                                        	);
                                        @endphp
                                        @for($i=0; $i<count($pfus); $i++)
                                         <tr>
                                            <td>
                                              	<i>Physical Facilities and Utility Systems</i>
                                              	<br><p style="margin-left:2em;">{{$pfus[$i]}}
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @endfor

                                        @php
                                        	$ss = array (
                                        		"3.12 Buildings pose no hazards to the life and safety of patients, personnel and public.",
                                        		"3.13 Exits are restricted to the following types: door leading directly outside the building, interior stair, ramp, and exterior stair.",
                                        		"3.14 Exits terminate directly at an open space to the outside of the building.",
                                        		"3.15 The clinic ensures the security of person and property within the facility.",
                                        	);
                                        @endphp
                                        @for($i=0; $i<count($ss); $i++)
                                         <tr>
                                            <td>
                                              	<i>Safety and Security</i>
                                              	<br><p style="margin-left:2em;">{{$ss[$i]}}
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @endfor

                                        <tr>
                                            <td>
                                              <i>Disaster Preparedness</i><br>
                                              <p style="margin-left:2em;"> 3.16 The clinic has a posted plan for evacuation of patients, personnel and visitors in case of fire or other emergencies.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                              <i>Lighting, Ventilation, Exposure to Environmental Tobacco Smoke</i> <br>
                                              <p style="margin-left:2em;"> 3.17 Areas used by patients and personnel are adequately lighted and ventilated.                      
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <i>Lighting, Ventilation, Exposure to Environmental Tobacco Smoke</i> <br>
                                              <p style="margin-left:2em;"> 3.18 Smoking is absolutely prohibited throughout the clinic in accordance with R.A. 9211 Tobacco Regulation Act of 2003.                     
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                              <i>Patient Accessibility and Movement</i> <br>
                                              <p style="margin-left:2em;"> 3.19 Areas ensure ease of access for people with a disability.                  
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                              <i>Patient Accessibility and Movement</i> <br>
                                              <p style="margin-left:2em;"> 3.20 Adequate space is provided to allow patients and personnel to move safely around.       
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <i>Auditory and Visual Privacy</i> <br>
                                              <p style="margin-left:2em;"> 3.21 Adequate privacy for patients is provided such that sensitive or private discussion, examination, and/or procedure are conducted in a manner or environment where these cannot be observed, or the risk of being overheard by others is minimized.
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                              <i>Signage</i> <br>
                                              <p style="margin-left:2em;"> 3.22 There are visual aids and devices for:       
                                          	</td><td></td><td></td>
                                        </tr>
                                        @php
                                        	$s = array(
                                        		"Information and Orientation ", "Direction", "Identification", "Prohibition and Warning"
                                        	);
                                        @endphp
                                        @for($i=0; $i<count($s); $i++)
                                        <tr>
                                            <td>
                                              <p style="margin-left:4em;">{{$s[$i]}}     
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @endfor

                                         <tr>
                                            <td>
                                              <i>Sanitation</i> <br>
                                              <p style="margin-left:2em;"> 3.23 The clinic observes pest and vermin control.    
                                          	</td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @php
                                        	$wm = array (
                                        		"3.24 The clinic has a waste management program that complies with current legislation, local government requirements, and the Health Care Waste Management Manual of the Department of Health, 2004.",
                                        		"3.25 The clinic observes safe and appropriate handling, storage and disposal of wastes.",
                                        		"3.26 Liquid waste is discharged into a multi-chamber septic tank.", 
                                        		"OR Liquid waste is discharged into municipal/city sewers that are connected to a sewage treatment plant.",
                                        		"3.27 Solid waste is collected, treated and disposed of in accordance with the Health Care Waste Management Manual of the Department of Health, 2004.",
                                        		"3.28 The clinic observes segregation, coding and labeling of waste.",
                                        	);
                                        @endphp
                                        @for($i=0; $i<count($wm); $i++)
                                         <tr>
                                            <td>
                                              	<i>Waste Management</i>
                                              	<br><p style="margin-left:2em;">{{$wm[$i]}}
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @endfor

                                        @php
                                        	$tbag = array (
                                        		"Black Trash Bag (General – Non-Infectious – Dry)", 
                                        		"Green Trash Bag (General – Non-Infectious – Wet)", 
                                        		"Yellow Trash Bag (Infectious – Pathological)",
												"Sharp Container (Sharps)"
                                        	);
                                        @endphp
                                        @for($i=0; $i<count($tbag); $i++)
                                         <tr>
                                            <td>
                                              	<br><p style="margin-left:4em;">{{$tbag[$i]}}
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        @endfor
                                        <tr>
                                            <td>
                                              <i>Waste Management</i> <br>
                                              <p style="margin-left:2em;">3.29 Protective equipment and clothing appropriate to the risks associated with the handling, storage, and disposal of wastes are provided to and used by personnel.</p></td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td><p>4.  The clinic has a Memorandum of Agreement with one or more hospitals with service capability of at least a Level 3 Hospital for the provision of inpatient   care  especially  during   emergencies  and  other   hospital services.</p></td>
                                             <td>
                                                <input type="radio" class="input" name="choices2" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices2" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td colspan="3"><p>5.  If ancillary service is available, appropriate regulatory requirements must be met.</p></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="171" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>cillary Service</strong>
                    </p>
                </td>
                <td width="104" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
                <td width="104" valign="top">
                    <p>
                        <strong>License</strong>
                    </p>
                    <p>
                        <strong>N</strong>
                        <strong>umber</strong>
                    </p>
                </td>
                <td width="104" valign="top">
                    <p>
                        <strong>D</strong>
                        <strong>ate Issued</strong>
                    </p>
                </td>
                <td width="104" valign="top">
                    <p>
                        <strong>V</strong>
                        <strong>alidity</strong>
                    </p>
                </td>
                <td width="104" valign="top">
                    <p>
                        <strong>R</strong>
                        <strong>emarks</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="171" valign="top">
                    <p>
                        Radiology
                    </p>
                </td>
                <td width="104" valign="top">
                </td>
                <td width="104" valign="top">
                </td>
                <td width="104" valign="top">
                </td>
                <td width="104" valign="top">
                </td>
                <td width="104" valign="top">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <p>
        <strong>III</strong>
        <strong>. COMPLIANCE WITH REQUIREMENTS</strong>
    </p>
    <p>
        <u>Instructions:</u>
    </p>
    <p>
        Conduct a tour of the facility. Interview the owner and/or authorized
        representative. Put a check (/) on the appropriate boxes. Write N/A if
        not applicable.
    </p>
    <p>
        <strong>A</strong>
        <strong>. Service Capability</strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ocedures</strong>
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>erformed</strong>
                    </p>
                    <p>
                        <strong>under Local</strong>
                    </p>
                    <p>
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="116" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>erformed</strong>
                    </p>
                    <p align="center">
                        <strong>under General</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1. Trauma Management
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1.1. Dento-alveolar fracture/ trauma
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1.2. Soft tissue injury (i.e. laceration, abrasion,
                        contusion, penetration, burns)
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1.3. Temporary immobilization of fracture of the jaws
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1.4. Temporo-mandibular joint dislocation
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1.5. Close reduction (simple jaw fracture)
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2. Dental Implant
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2.1. Sinus lifting
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2.2. Lateral nerve repositioning
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2.3. Bone grafting
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3. Pre – Prosthetic Surgery
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.1. Alveoloplasty/ alveolectomy
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.2. Removal of bony exostosis (torus)
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.3. Vestibuloplasty
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.4. Frenectomy
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.5. Bone augmentation
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3.6. Gingivectomy
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        4. Management of Cystic Lesions
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        4.1. Enucleation
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        4.2. Marsupialization
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ocedures</strong>
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>erformed</strong>
                    </p>
                    <p>
                        <strong>under Local</strong>
                    </p>
                    <p>
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="116" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>erformed</strong>
                    </p>
                    <p align="center">
                        <strong>under General</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        5. Management of Oral Benign Lesions
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        5.1. Excision
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        6. Management of Impacted Teeth
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        6.1. Odontectomy
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        7. Management of Localized Odontogenic Infections
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        7.1. Incision and Drainage
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        7.2. Debridement
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        8. Management of Complications of Maxillary Sinus of
                    </p>
                    <p>
                        Dental Origin
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        8.1. Closure of Oro-antral fistula
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        8.2. Caldwell-luc technique
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9. Biopsy
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9.1. Incision
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9.2. Excision
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9.3. Aspiration
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        10. Periodontal Surgery
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        11. Endodontic Surgery
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        12. Cleft Lip
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        12.1 Cheiloplasty
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="115" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="116" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <p>
        <strong>B. Personnel</strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="172" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ocedures</strong>
                    </p>
                </td>
                <td width="172" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>erformed under</strong>
                    </p>
                    <p>
                        <strong>Local Anesthesia</strong>
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
                <td width="172" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>erformed under</strong>
                    </p>
                    <p align="center">
                        <strong>G</strong>
                        <strong>eneral Anesthesia</strong>
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" rowspan="3" valign="top">
                    <p>
                        1. Trauma Management
                    </p>
                    <p>
                        2. Dental Implant
                    </p>
                    <p>
                        3. Pre – Prosthetic
                    </p>
                    <p>
                        Surgery
                    </p>
                    <p>
                        4. Management of Cystic
                    </p>
                    <p>
                        Lesions
                    </p>
                    <p>
                        5. Management of Oral
                    </p>
                    <p align="center">
                        Benign Lesions
                    </p>
                    <p>
                        6. Management of
                    </p>
                    <p align="center">
                        Impacted Teeth
                    </p>
                    <p>
                        7. Management of Localized Odontogenic Infections
                    </p>
                    <p>
                        8. Management of Complications of Maxillary Sinus of
                        Dental Origin
                    </p>
                    <p>
                        9. Biopsy
                    </p>
                    <p>
                        10. Periodontal Surgery
                    </p>
                    <p>
                        11. Endodontic Surgery
                    </p>
                </td>
                <td width="172" valign="top">
                    <p>
                        <strong>O</strong>
                        <strong>r</strong>
                        <strong>al Surgeon</strong>
                    </p>
                    <p>
                        • Registered Dentist with valid PRC Identification Card
                    </p>
                    <p>
                        • Certificate of Membership in the Philippine College
                        of Oral and Maxillo- Facial Surgeons (PCOMS)
                    </p>
                    <p>
                        or
                    </p>
                    <p>
                        Certificate of Proficiency (6 months training) from a
                        local/ foreign institution recognized by PCOMS
                    </p>
                    <p>
                        • Can be on-call
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
                <td width="172" valign="top">
                    <p>
                        <strong>O</strong>
                        <strong>r</strong>
                        <strong>al Surgeon</strong>
                    </p>
                    <p>
                        • Registered Dentist with valid PRC Identification Card
                    </p>
                    <p>
                        • Certificate of Membership in the Philippine College
                        of Oral and Maxillo- Facial Surgeons (PCOMS)
                    </p>
                    <p>
                        or
                    </p>
                    <p>
                        Certificate of Proficiency (6 months training) from a
                        local/ foreign institution recognized by PCOMS
                    </p>
                    <p>
                        • Can be on-call
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" rowspan="2" valign="top">
                    <p>
                        <strong>Dental Assistant</strong>
                    </p>
                    <p>
                        • Duty is limited to non- therapeutic, non-
                        restorative, and adjunctive procedure
                    </p>
                    <p>
                        • Work under the direct supervision of the Oral and
                        Maxillo-Facial Surgeon
                    </p>
                </td>
                <td width="89" rowspan="2" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
                <td width="172" valign="top">
                    <p>
                        <strong>Registered Nurse</strong>
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>e</strong>
                        <strong>sthesiologist</strong>
                    </p>
                    <p>
                        • Certification from the Philippine Society of
                        Anesthesiologists
                    </p>
                    <p>
                        • Can be on-call
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <table border="0" cellspacing="0" cellpadding="0" width="693">
        <tbody>
            <tr>
                <td width="172" colspan="2" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ocedures</strong>
                    </p>
                </td>
                <td width="172" colspan="4" valign="top">
                    <p>
                        <strong>P</strong>
                        <strong>erformed under</strong>
                    </p>
                    <p>
                        <strong>Local Anesthesia</strong>
                    </p>
                </td>
                <td width="89" colspan="2" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
                <td width="172" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>erformed under</strong>
                    </p>
                    <p align="center">
                        <strong>G</strong>
                        <strong>eneral Anesthesia</strong>
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>vailable</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" colspan="2" rowspan="3" valign="top">
                    <p>
                        12. Cleft Lip
                    </p>
                </td>
                <td width="172" colspan="4" rowspan="3" valign="top">
                    <p>
                        N/A
                    </p>
                </td>
                <td width="89" colspan="2" rowspan="3" valign="top">
                    <p>
                        N/A
                    </p>
                </td>
                <td width="172" valign="top">
                    <p>
                        <strong>O</strong>
                        <strong>r</strong>
                        <strong>al and Maxillo-Facial</strong>
                    </p>
                    <p>
                        <strong>S</strong>
                        <strong>u</strong>
                        <strong>r</strong>
                        <strong>g</strong>
                        <strong>eon</strong>
                    </p>
                    <p>
                        • Registered Dentist with valid PRC Identification Card
                    </p>
                    <p>
                        • Certificate of Membership in the Philippine College
                        of Oral and Maxillo- Facial Surgeons (PCOMS)
                    </p>
                    <p align="center">
                        or
                    </p>
                    <p>
                        • Certificate of Proficiency (4 years residency) from a
                        local/ foreign institution recognized by PCOMS
                    </p>
                    <p>
                        • Can be on-call
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" valign="top">
                    <p>
                        <strong>Registered Nurse</strong>
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="172" valign="top">
                    <p>
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>e</strong>
                        <strong>sthesiologist</strong>
                    </p>
                    <p>
                        • Certification from the Philippine Society of
                        Anesthesiologists
                    </p>
                    <p>
                        • Can be on-call
                    </p>
                </td>
                <td width="89" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="28">
                </td>
                <td width="149" colspan="2" valign="top">
                    <p>
                        <strong><em>O</em></strong>
                        <strong><em>t</em></strong>
                        <strong><em>hers:</em></strong>
                    </p>
                </td>
                <td width="181" colspan="4" valign="top">
                </td>
                <td width="335" colspan="3">
                </td>
            </tr>
            <tr>
                <td width="28">
                </td>
                <td width="149" colspan="2" valign="top">
                    <p>
                        1. Clerk
                    </p>
                    <p>
                        2. Utility Worker
                    </p>
                </td>
                <td width="106" valign="top">
                    <p>
                        [ ] Yes
                    </p>
                    <p>
                        [ ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [ [
                    </p>
                </td>
                <td width="42" colspan="2" valign="top">
                    <p>
                        ] No
                    </p>
                    <p>
                        ] No
                    </p>
                </td>
                <td width="335" colspan="3">
                </td>
            </tr>
            <tr height="0">
                <td width="28">
                </td>
                <td width="144">
                </td>
                <td width="5">
                </td>
                <td width="106">
                </td>
                <td width="33">
                </td>
                <td width="28">
                </td>
                <td width="14">
                </td>
                <td width="75">
                </td>
                <td width="172">
                </td>
                <td width="89">
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <strong>C. Equipment/ Instruments</strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>It</strong>
                        <strong>e</strong>
                        <strong>m</strong>
                        <strong>s</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under Local</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under General</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1. Ambu bag
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2. Anesthesia machine (with tanks of gases and gauges)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3. Autoclave
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        4. Basic oral surgery instruments
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        5. Cardiac monitor
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>It</strong>
                        <strong>e</strong>
                        <strong>m</strong>
                        <strong>s</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under Local</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under General</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        6. Dental unit/ chair
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        7. Defibrillator
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        8. Electrocautery
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9. Emergency cart/ tray (with emergency medicines)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        10. Endotracheal tubes (all sizes)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        11. Face mask
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        12. High-speed hand piece (air-driven or motor- driven)
                        with surgical burs
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        13. Instrument table
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        14. Intravenous stand
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        15. Laryngoscope with adult and pediatric blades
                    </p>
                    <p align="center">
                        (curve and straight), spare bulb and battery
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        16. Operating light
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        17. Operating table
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        18. Oxygen tank
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        19. Peri-apical x-ray machine (with apron)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        20. Pulse oximeter (with probe)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        21. Sphygmomanometer (with stethoscope)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        22. Sterilizing tray and solution
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        23. Stretcher/ Patient bed
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        24. Suction machine
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        25. Tracheostomy set
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        26. X-ray film viewer
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="693" colspan="3" valign="top">
                    <p>
                        <em>For Trauma Management, plus</em>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        27. Arch bars and wires
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>It</strong>
                        <strong>e</strong>
                        <strong>m</strong>
                        <strong>s</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under Local</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>U</strong>
                        <strong>sed under General</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        28. Splinting materials
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="693" colspan="3" valign="top">
                    <p>
                        <em>For Dental Implant, plus</em>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        29. Implant delivery system
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <strong><em>O</em></strong>
        <strong><em>t</em></strong>
        <strong><em>hers:</em></strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="21" valign="top">
                    <p>
                        1.
                    </p>
                </td>
                <td width="363" valign="top">
                    <p>
                        Emergency Lights
                    </p>
                </td>
                <td width="48" valign="top">
                    <p>
                        [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="21" valign="top">
                    <p>
                        2.
                    </p>
                </td>
                <td width="363" valign="top">
                    <p>
                        Fire Extinguisher
                    </p>
                </td>
                <td width="48" valign="top">
                    <p>
                        [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="21" valign="top">
                    <p>
                        3.
                    </p>
                </td>
                <td width="363" valign="top">
                    <p>
                        Patient Transport Vehicle (can be outsourced)
                    </p>
                </td>
                <td width="48" valign="top">
                    <p>
                        [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="21" valign="top">
                    <p>
                        4.
                    </p>
                </td>
                <td width="363" valign="top">
                    <p>
                        Personnel Protective Device
                    </p>
                </td>
                <td width="48" valign="top">
                    <p>
                        [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="21" valign="top">
                    <p>
                        5.
                    </p>
                </td>
                <td width="363" valign="top">
                    <p>
                        Standby Generator
                    </p>
                </td>
                <td width="48" valign="top">
                    <p>
                        [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <strong>D. Physical Plant</strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="346" valign="top">
                    <p align="center">
                        <strong>S</strong>
                        <strong>paces</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ovided under Local</strong>
                    </p>
                    <p align="center">
                        <strong>A</strong>
                        <strong>n</strong>
                        <strong>esthesia</strong>
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        <strong>P</strong>
                        <strong>r</strong>
                        <strong>ovided under</strong>
                    </p>
                    <p align="center">
                        <strong>G</strong>
                        <strong>eneral Anesthesia</strong>
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        1. Clean-up area
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        2. Dressing area/ room
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        3. Examination/ treatment area (with air conditioning
                        unit)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        4. Operating room (with air conditioning unit)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        5. Recovery room
                    </p>
                </td>
                <td width="173" valign="top">
                    <p align="center">
                        N/A
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        6. Scrub-up area (with sink and water supply)
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        7. Sterile instrument, supply and storage area
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        8. Sterilizing area/ room
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
            <tr>
                <td width="346" valign="top">
                    <p>
                        9. Toilet
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
                <td width="173" valign="top">
                    <p>
                        [ ] Yes [ ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="325" valign="top">
                    <p>
                        <strong><em>O</em></strong>
                        <strong><em>t</em></strong>
                        <strong><em>hers:</em></strong>
                    </p>
                </td>
                <td width="197" colspan="4" valign="top">
                </td>
            </tr>
            <tr>
                <td width="325" valign="top">
                    <p>
                        1. Waiting Area
                    </p>
                    <p>
                        2. Receiving, Billing and Records Area
                    </p>
                </td>
                <td width="59" valign="top">
                    <p align="right">
                        [ [
                    </p>
                </td>
                <td width="63" valign="top">
                    <p>
                        ] Yes
                    </p>
                    <p>
                        ] Yes
                    </p>
                </td>
                <td width="33" valign="top">
                    <p align="center">
                        [ [
                    </p>
                </td>
                <td width="42" valign="top">
                    <p>
                        ] No
                    </p>
                    <p>
                        ] No
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br clear="all"/>
<div>
    <p>
        <img
            width="621"
            height="102"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image002.gif"
            alt="doh_logo1"
        />
    </p>
    <br clear="ALL"/>
    <p>
        <img
            width="519"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image003.gif"
        />
        Name of Health Facility :
    </p>
    <p>
        <img
            width="487"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image004.gif"
        />
        Date of Inspection/Monitoring:
    </p>
    <p>
        <strong>RECOMMENDATIONS:</strong>
    </p>
    <p>
        <strong>A. </strong>
        <strong>For Licensing Process:</strong>
    </p>
    <p>
[ ] For issuance of License as        <u>Oral and Maxillo-Facial Surgery Ambulatory Surgical Clinic</u>
    </p>
    <p>
        <u></u>
    </p>
    <p>
        <u></u>
    </p>
    <p>
        <img
            width="241"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image005.gif"
        />
        <img
            width="207"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image006.gif"
        />
        Validity from to
    </p>
    <p>
        [ ] Issuance depends upon compliance to the recommendations given and
        submission of the
    </p>
    <p>
        <img
            width="216"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image007.gif"
        />
        following within days from the date of inspection/monitoring:
    </p>
    <table cellpadding="0" cellspacing="0" align="left">
        <tbody>
            <tr>
                <td width="0" height="0">
                </td>
                <td width="613">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image008.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="25">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image008.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="25">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image008.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="21">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image009.gif"
                    />
                </td>
            </tr>
        </tbody>
    </table>
    <br clear="ALL"/>
    <p>
        <img
            width="400"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image010.gif"
        />
        [ ] Non-issuance: Specify reason/s.
    </p>
    <table cellpadding="0" cellspacing="0" align="left">
        <tbody>
            <tr>
                <td width="50" height="7">
                </td>
                <td width="613">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image011.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="26">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image008.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="30">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image011.gif"
                    />
                </td>
            </tr>
            <tr>
                <td height="26">
                </td>
            </tr>
            <tr>
                <td height="2">
                </td>
                <td align="left" valign="top">
                    <img
                        width="613"
                        height="2"
                        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image012.gif"
                    />
                </td>
            </tr>
        </tbody>
    </table>
    <br clear="ALL"/>
    <p>
        <strong>Inspected by:</strong>
    </p>
    <table border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td width="213" valign="top">
                    <p align="center">
                        Printed Name
                    </p>
                </td>
                <td width="213" valign="top">
                    <p align="center">
                        Signature
                    </p>
                </td>
                <td width="248" valign="top">
                    <p align="center">
                        Position/Designation
                    </p>
                </td>
            </tr>
            <tr>
                <td width="213" valign="top">
                </td>
                <td width="213" valign="top">
                </td>
                <td width="248" valign="top">
                </td>
            </tr>
            <tr>
                <td width="213" valign="top">
                </td>
                <td width="213" valign="top">
                </td>
                <td width="248" valign="top">
                </td>
            </tr>
            <tr>
                <td width="213" valign="top">
                </td>
                <td width="213" valign="top">
                </td>
                <td width="248" valign="top">
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        <strong></strong>
    </p>
    <p>
        <strong>Received by:</strong>
    </p>
    <p>
        <img
            width="376"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image013.gif"
        />
        Signature
    </p>
    <p>
        <img
            width="356"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image014.gif"
        />
        Printed Name
    </p>
    <p>
        <img
            width="314"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image015.gif"
        />
        Position/Designation
    </p>
    <p>
        <img
            width="179"
            height="2"
            src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image016.gif"
        />
        Date
    </p>
</div>
<br clear="all"/>
<p>
    <img
        width="621"
        height="102"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image017.gif"
        alt="doh_logo1"
    />
</p>
<br clear="ALL"/>
<p>
    <img
        width="479"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image018.gif"
    />
    Name of Health Facility :
</p>
<p>
    <img
        width="523"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image019.gif"
    />
    Date of Monitoring:
</p>
<p>
    <strong></strong>
</p>
<p>
    <strong>RECOMMENDATIONS:</strong>
</p>
<p>
    <strong>B. </strong>
    <strong>For Monitoring Process:</strong>
</p>
<p>
    <strong></strong>
</p>
<p>
    [ ] Issuance of Notice of Violation<u></u>
</p>
<p>
    <u></u>
</p>
<table cellpadding="0" cellspacing="0" align="left">
    <tbody>
        <tr>
            <td width="50" height="9">
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image008.gif"
                />
            </td>
        </tr>
    </tbody>
</table>
<u></u>
<br clear="ALL"/>
<table cellpadding="0" cellspacing="0" align="left">
    <tbody>
        <tr>
            <td width="50" height="1">
            </td>
            <td width="613">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image011.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="27">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image020.gif"
                />
            </td>
        </tr>
    </tbody>
</table>
<br clear="ALL"/>
<p>
    [ ] Non-issuance of Notice of Violation
</p>
<table cellpadding="0" cellspacing="0" align="left">
    <tbody>
        <tr>
            <td width="48" height="0">
            </td>
            <td width="2">
            </td>
            <td width="611">
            </td>
            <td width="2">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td>
            </td>
            <td colspan="2" align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image020.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="26">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td>
            </td>
            <td colspan="2" align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image020.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="24">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td colspan="2" align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image021.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="27">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td colspan="2" align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image021.gif"
                />
            </td>
        </tr>
    </tbody>
</table>
<br clear="ALL"/>
<p>
    [ ] Others (Specify)
</p>
<p>
    <img
        width="491"
        height="3"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image022.gif"
    />
</p>
<table cellpadding="0" cellspacing="0" align="left">
    <tbody>
        <tr>
            <td width="50" height="6">
            </td>
            <td width="613">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image012.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="27">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image020.gif"
                />
            </td>
        </tr>
        <tr>
            <td height="29">
            </td>
        </tr>
        <tr>
            <td height="2">
            </td>
            <td align="left" valign="top">
                <img
                    width="613"
                    height="2"
                    src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image012.gif"
                />
            </td>
        </tr>
    </tbody>
</table>
<br clear="ALL"/>
<p>
    <strong>Monitored by:</strong>
</p>
<table border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td width="213" valign="top">
                <p align="center">
                    Printed Name
                </p>
            </td>
            <td width="213" valign="top">
                <p align="center">
                    Signature
                </p>
            </td>
            <td width="248" valign="top">
                <p align="center">
                    Position/Designation
                </p>
            </td>
        </tr>
        <tr>
            <td width="213" valign="top">
            </td>
            <td width="213" valign="top">
            </td>
            <td width="248" valign="top">
            </td>
        </tr>
        <tr>
            <td width="213" valign="top">
            </td>
            <td width="213" valign="top">
            </td>
            <td width="248" valign="top">
            </td>
        </tr>
        <tr>
            <td width="213" valign="top">
            </td>
            <td width="213" valign="top">
            </td>
            <td width="248" valign="top">
            </td>
        </tr>
        <tr>
            <td width="213" valign="top">
            </td>
            <td width="213" valign="top">
            </td>
            <td width="248" valign="top">
            </td>
        </tr>
    </tbody>
</table>
<p>
    <strong>Received by:</strong>
</p>
<p>
    <img
        width="376"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image013.gif"
    />
    Signature
</p>
<p>
    <img
        width="356"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image014.gif"
    />
    Printed Name
</p>
<p>
    <img
        width="241"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image023.gif"
    />
    Position/Designation
</p>
<p>
    <img
        width="179"
        height="2"
        src="file:///C:/Users/RA-PC3/AppData/Local/Temp/msohtmlclip1/01/clip_image024.gif"
    />
    Date
</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('employee.cmp._assessmentJS') {{-- Javascript for this Module --}}
@endsection