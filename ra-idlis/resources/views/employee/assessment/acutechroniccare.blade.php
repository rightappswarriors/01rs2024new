@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')

<div class="content p-4">
        <div class="card">
            <div class="card-header bg-white font-weight-bold">
                ACUTE-CHRONIC PSYCHIATRIC CARE FACILITY
            </div>
            
            <div class="container p-4">
                <div class="container pb-3">
                    <p class="text-center mb-5"><b>ASSESSMENT  TOOL FOR LICENSING AN
                    ACUTE-CHRONIC PSYCHIATRIC CARE FACILITY
                    </b></p>

                    
                    <form>
                        <table class="mb-3 w-100" >
                            
                            <tbody>
                                <!-- name -->
                                <tr>
                                    <td colspan="2">
                                        <input type="" name="" class="form-control input" placeholder="Name of Facility: "><br>
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

                                <tr><td><p><b>1. GENERAL INFORMATION</b></p><br></td></tr>
                                <tr>
                                    <td colspan="2">Owner : 
                                        <input type="" name="" class="form-control input" placeholder="Owner :"><br>
                                    </td>
                                </tr>
                                {{-- name of head facility --}}
                                <tr>
                                    <td colspan="2">Medical Director :
                                        <input type="" name="" class="form-control input" placeholder="Medical Director :"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <table class="table table-bordered black" style="">
                                    <tbody>
                                        <tr>
                                            <td colspan="1">
                                                <b><u>Classification</u></b><br>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="radio" name="government" style="margin-right:1em;" value="government">Government:</input><br>
                                                       
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="government" style="margin-right:1em;" value="National">National</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="government" style="margin-right:1em;" value="Local">Local</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="government" value="others" style="margin-right:1em;">Others, specify:
                                                            <textarea rows="4" class="form-control" disabled></textarea>
                                                        </input>
                                                        </label><br>
                                                    </div>
                                                
                                                    <div class="col">
                                                        <input type="radio" name="private" style="margin-right:1em;" value="private">Private:</input><br>
                                                        
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" style="margin-right:1em;" value="single">Single</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="proprietorship" style="margin-right:1em;">Proprietorship</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="partnership" style="margin-right:1em;">Partnership</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="corporation" style="margin-right:1em;">Corporation</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="civic" style="margin-right:1em;">Civic</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="organization" style="margin-right:1em;">Organization</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="religious" style="margin-right:1em;">Religious</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="foundation" style="margin-right:1em;">Foundation</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="others" style="margin-right:1em;">Others, specify</input>
                                                        </label><br>
                                                        <label style="margin-left:2em;">
                                                            <input type="radio" name="private" value="others" style="margin-right:1em;">Others, specify:
                                                            <textarea rows="4" class="form-control" disabled></textarea>
                                                        </input>
                                                        </label><br>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </tr>
                                <tr>
                                    <td colspan="1">
                                        <label>Chairman of the Board (If Corporation):</label>
                                        <input type="" name="" class="form-control input" placeholder=""><br>
                                        <label>Authorized Bed Capacity:</label>
                                        <input type="" name="" class="form-control input" placeholder=""><br>
                                        <label>Implementing Bed Capacity :</label>
                                        <input type="" name="" class="form-control input" placeholder=""> <br>
                                    </td>
                                </tr>

                                <tr><td><p><b>2.  SERVICE CAPABILITY</b></p><br></td></tr>
                                <tr>
                                    <p>
                                        2.1. Service Capability of an Acute-Chronic Psychiatric Care Facility:
                                    </p>
                                    <p style="margin:1em;">
                                        2.1.1. Provides medical service, nursing care, pharmacological
                                        treatment and psychosocial intervention for mentally ill patients.
                                    </p>
                                    <p>
                                        2.2. The health facility shall render quality health services
                                        appropriate to the level of care being provided.
                                    </p>
                                </tr>

                                <table class="table table-bordered black">
                                    <thead class="text-center">
                                        <tr class="at-tr-head">
                                            <th scope="col" style="width: 50%">SERVICE</th>
                                            <th scope="col">AVAILABILITY<br> (/ if Available)</th>
                                            <th scope="col">REMARKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>General Administrative</b></td>
                                            <td></td>
                                            <td class="textarea"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Clinical Service</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>Medical and Psychiatric Services</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>Crisis Intervention</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Nursing Service</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Psychiatric Nursing Care</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><b>Ancillary Service</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Psychosocial Services </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Referral Services</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Medical-Surgical Services</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Dental Services</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Clinical Laboratory</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;Radiology</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="653" colspan="3" valign="top">
                                                <p>
                                                    ◘ For psychological evaluation of patients, affiliation
                                                    with a service provider is allowed.
                                                </p>
                                                <p>
                                                    A memorandum of agreement with the service provider
                                                    must be secured as a prerequisite for license to
                                                    operate.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <br><br>
                                <p>2.3. Operations</p>

                                <tr>
                                <table  class="table row-bordered black center" style="width:50%;">
                                    <thead class="text-center">
                                        <tr class="at-tr-head">
                                            <th scope="col" style="width: 70%"></th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="at-tr-subhead">
                                            <td><p>2.3.1. Policies and Procedures</p></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                An organizational chart is placed in a location readily seen by the public. 
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p> The health facility has documented policies and standard operating procedures for the following:</p>
                                             </td>
                                            <td></td>
                                            <td> </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p> General Administrative Service</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Clinical Service</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Medical and Psychiatric Services</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">No Crisis Intervention</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Use of Restraint</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Isolation of Patient</p> 
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Patient Transport/Conduction</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Nursing Service</p>   
                                             </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Psychiatric Nursing Care</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Ancillary Service</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Psychosocial Services</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Referral Services</p>
                                                 <p></p>
                                                 
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td><p>2.3.2. General Administrative Service</p></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                               New personnel receive an orientation program that covers the essential components of the service being provided.
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                Duties and responsibilities of the personnel are identified and  documented.     
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr class="at-tr-subhead">
                                            <td><p>2.3.3. Clinical Service</p></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Personnel to deliver care are available for 24 hours.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>All equipment, medicines and supplies necessary to provide care, are available. </p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>The use of restraint is covered by doctor’s order.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Nursing care is provided at all times.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Nursing Procedure Manual (available in all patient care units)</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Properly Utilized Kardex (available in all patient care units)</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>The delivery of nursing care utilizes the nursing process.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Medical diagnoses, procedures and/or operations performed on patients are recorded using ICD – 10.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Records of medico – legal cases are properly and completely filled up. </p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Death certificate forms are properly and completely filled up.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>Confidentiality of patient information is maintained at all times.</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p>A patient Logbook is properly filled up in the following areas:</p>
                                             </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Admission</p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                 <p style="margin-left:2em;">Discharge </p>
                                             </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="yes">Yes</input>
                                            </td>
                                            <td>
                                                <input type="radio" class="input" name="choices" value="no">No</input>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>

                                @php 
                                    $cmc = array(
                                        "Identification Data",
                                        "Consent Form",
                                        "Chief Complaint / Referral Information",
                                        "Policy for discipline, suspension, demotion and termination of all personnel at all levels",
                                        "History of Present Illness or Interval History for Re-admitted Patients",
                                        "Physical and Neurological Examination and Initial Mental Status Examination",
                                        "Laboratory Results, X-ray Results and all other Ancillary Procedures",
                                        "Diagnosis/Admitting Diagnosis",
                                        "Admitting/Attending Physician",
                                        "Consultation/Referral Notes",
                                        "Progress Notes",
                                        "Doctor’s Order Sheet",
                                        "Medication/Treatment Record",
                                        "Nursing Record",
                                        "Visitor’s Log",
                                        "Discharge Summary",
                                        "Others "
                                    );
                                @endphp


                                <tr>
                                    <td>Patient Charts are properly and completely filled up and contain up-to-date information on the following:</td>
                                </tr>
                                <tr>
                                    <table class="table table-bordered black center" style="width:60%;">
                                        <thead class="text-center">
                                            <tr class="at-tr-head">
                                                <th scope="col" style="width: 60%">Contents of Medical Chart</th>
                                                <th scope="col">In-Patient <br>(check if available)</th>
                                                <th scope="col">Out-Patient <br>(check if available)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for($i=0; $i<count($cmc); $i++)
                                                <tr>
                                                    <td>
                                                        {{$cmc[$i]}}
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endfor
                                                
                                        </tbody>
                                    </table>
                                </tr>
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