<!-- Application Details -->  

@php $allowed_edit = true; @endphp

<div class="col-md-12 change-div"><b class="text-primary">APPLICATION</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeRenameHF"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-2">
    <label class="text-left upd-text-title">Registered ID </label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appform->regfac_id}}</h6>
</div>
<div class="col-sm-2">
    <label class="text-left upd-text-title">NHFR Code </label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appform->nhfcode}}</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Assigned Region </label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appform->asrgn_rgndesc}}</h6>
</div>

<div class="col-sm-2">
    <label class="text-left upd-text-title">Application ID </label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appid}}</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Process Type  <span class="text-danger">*</span></label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appform->aptdesc}}</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Type of Application  <span class="text-danger">*</span></label> 
    <h6  class="text-center upd-text-info">&nbsp;{{$appform->hfser_desc}}</h6>
</div>

<!-- HF Name -->  
<div class="col-sm-12">
    <label class="text-left upd-text-title"  for="facility_name">Facility Name  <span class="text-danger">*</span></label>
    <h3 class="text-center text-uppercase mb-2 upd-text-info"><a class="text-primary" style="text-decoration:none;" href="#" data-toggle="modal" data-target="#changeRenameHF">{{$appform->facilityname}}&nbsp;</a></h3>
</div>
<div class="col-md-12 change-div"><b class="text-primary">FACILTY ADDRESS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeAddress"><i class="fa fa-edit"></i></button> @endif</div>
<!-- Facility Address -->
<div class="col-sm-3">
    <label class="text-left upd-text-title">Region <span class="text-danger">*</span>
    </label>
    <h6 id="rgnid_name"  class="text-center upd-text-info">{{$appform->rgn_desc}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">Province/District <span class="text-danger">*</span>
    </label>
    <h6  id="provid_name" class="text-center upd-text-info">{{$appform->provname}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">City/Municipality <span class="text-danger">*</span>
    </label>
    <h6  id="cmid_name" class="text-center upd-text-info">{{$appform->cmname}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">Barangay <span class="text-danger">*</span>
    </label>
    <h6  id="brgyid_name" class="text-center upd-text-info">{{$appform->brgyname}}</h6>
</div>


<div class="col-sm-3">
    <label class="text-left upd-text-title">Street Number
    </label>
    <h6  id="street_number_txt" class="text-center upd-text-info">{{$appform->street_number}}&nbsp;</h6>
</div>


<div class="col-sm-6">
    <label class="text-left upd-text-title">Street name
    </label>
    <h6  id="street_name_txt" class="text-center upd-text-info">{{$appform->street_name}}&nbsp;</h6>
</div>


<div class="col-sm-3">
    <label class="text-left upd-text-title">Zip Code <span class="text-danger">*</span>
    </label>
    <h6   id="zipcode_txt" class="text-center upd-text-info">{{$appform->zipcode}}&nbsp;</h6>
</div>


<!-- Contact Details -->
@php
    try {
        $areacode_1 = "";
        $areacode_2 = "";
        $areacode_3 = "";
        
        if(!empty($appform->areacode))
        {
            $areacode = json_decode($appform->areacode);
            $areacode_1 = $areacode[0];
            $areacode_2 = $areacode[1];
            $areacode_3 = $areacode[2];
        }
    } catch (Exception $e) {}                            
@endphp

<div class="col-md-12 change-div"><b class="text-primary">FACILITY CONTACT DETAILS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeContactDetails"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-mobile"></i> Facility Mobile No. </label>
    <h6  class="text-center upd-text-info">{{$appform->contact}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-phone-square"></i> Facility Landline </label>
    <h6  class="text-center upd-text-info">@if(!empty($areacode_1)) ({{$areacode_1}}) @endif {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-fax"></i> Fax Number </label>
    <h6  class="text-center upd-text-info">@if(!empty($areacode_2)) ({{$areacode_2}}) @endif {{$appform->faxnumber}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa  fa-envelope"></i> Facility Email Address </label>
    <h6  class="text-center upd-text-info">{{$appform->email}}&nbsp;</h6>
</div>




<!-- Classification -->

<div class="col-md-12 change-div"><b class="text-primary">CLASSIFICATION ACCORDING TO</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeCFIO"><i class="fa fa-edit"></i></button> @endif</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title">Ownership <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">{{$appform->ownership_desc}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title">Classification <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">{{$appform->classname}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title">Sub Classification <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">@isset($appform->subclassname){{$appform->subclassname}}@endisset &nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Institutional Character <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">{{$appform->facmdesc}} &nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Function <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">{{$appform->funcdesc}} &nbsp;</h6>
</div>


<!-- Owner -->


<div class="col-md-12 change-div"><b class="text-primary">OWNER DETAILS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeOwner"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">
    <label class="text-left upd-text-title">Owner Name <span class="text-danger">*</span></label>
    <h6  class="text-center upd-text-info">{{$appform->owner}}</h6>
</div>

<div class="col-md-12 change-div">
    <div class="mb-1 mt-1 alert alert-warning">
        For Sole-proprietorship,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your DTI-Business Name Registration
            </li>
        </ul>
        For Partnership and Corporation,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your SEC Registration
            </li>
        </ul>
        For Cooperative,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Name of the owner must be the same as your Cooperative Development Authority Registration
            </li>
        </ul>        
        For Government Facilities,
        <ul class="list-unstyled" style="font-size: small">
            <li>
                Please refer to your Enabling Act/Board Resolution
            </li>
        </ul>        
    </div>
</div>


<div class="col-md-12"><label class="text-left upd-text-title"><b class="text-primary">Proponent/Owner Contact Details</b></label></div>
<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa fa-mobile"></i> Proponent/Owner Mobile No. </label>
    <h6  class="text-center upd-text-info">{{$appform->ownerMobile}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa fa-phone-square"></i> Proponent/Owner Landline </label>
    <h6  class="text-center upd-text-info">@if(!empty($areacode_3)) ({{$areacode_3}}) @endif {{$appform->ownerLandline}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa  fa-envelope"></i> Proponent/Owner Email Address </label>
    <h6  class="text-center upd-text-info">{{$appform->ownerEmail}}&nbsp;</h6>
</div>

<div class="col-sm-12">
    <label class="text-left upd-text-title"><i class="fa  fa-envelope"></i> <b class="text-primary">Official Mailing Address </b></label>
    <h6  class="text-center upd-text-info">{{$appform->mailingAddress}}&nbsp;</h6>
</div>


<div class="col-md-12 change-div"><b class="text-primary">APPROVING AUTHORITY DETAILS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeApprovingAuthority"><i class="fa fa-edit"></i></button> @endif</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Approving Authority Position/Designation </label>
    <h6  class="text-center upd-text-info">{{$appform->approvingauthoritypos}}&nbsp;</h6>
</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Approving Authority Full Name </label>
    <h6  class="text-center upd-text-info">{{$appform->approvingauthority}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Head of Facility Full Name / Medical Director Full Name </label>
    <h6  class="text-center upd-text-info">{{$appform->head_of_facility_name}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    &nbsp;
</div>


<!-- Authorization Number -->
<div class="col-md-12 change-div"><b class="text-primary">LATEST AUTHORIZATION NUMBER</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeLatestAuthorization"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Permit to Construct No. (if applicable)   </label>
    <h6  class="text-center upd-text-info">{{$appform->ptc_id}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Date Issued </label>
    <h6  class="text-center upd-text-info">@isset($issued_date){{$issued_date}}@endisset&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Latest {{$appform->hfser_id}}  Number  </label>
    <h6  class="text-center upd-text-info">{{$appform->con_id}} {{$appform->lto_id}} {{$appform->ato_id}} {{$appform->coa_id}} {{$appform->cor_id}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Validity Period </label>
    <h6  class="text-center upd-text-info">@isset($validity){{$validity}}@endisset&nbsp;</h6>
</div>


<div class="col-sm-12"><hr/></div>                                    
<!-- Type of Health Facility / Service -->

<div class="col-md-12 change-div"><b class="text-primary">TYPE OF HEALTH FACILITY</b>  {{--- @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeDialysisStation"><i class="fa fa-edit"></i></button> @endif ---}}</div>
<div class="col-sm-12">
    <h3  class="text-center upd-text-info"><i class="fa fa-check-square-o"></i> &nbsp;{{$appform->facilitytype}}&nbsp;</h3>
</div>         

<div class="col-md-12 change-div"><b class="text-primary">CLASSIFICATION OF HOSPITAL</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeCOH"><i class="fa fa-edit"></i></button> @endif</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Classification of Hospital </label>
    <h6  class="text-center upd-text-info">@isset($validity){{$validity}}@endisset&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Hospital Level </label>
    <h6  class="text-center upd-text-info">@isset($validity){{$validity}}@endisset&nbsp;</h6>
</div>


<!---- For Add On services --->
<div class="col-md-12 change-div"><b class="text-primary">ANCILLARY/CLINICAL SERVICES</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeDialysisStation"><i class="fa fa-plus"></i></button> @endif</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAncillary">
        <div class="col-sm-12">  
            @php $proceed_addon = 0;  @endphp
            @if (isset($addOnservices_applied))
                <ul style="list-style-type:none">
                @foreach ($addOnservices_applied as $d)
                    @php $proceed_addon = 1; @endphp
                        <li class="text-center">
                            @if($isupdate == 1)   
                                <span class="text-center">
                                    <button class="btn btn-primary" onclick="showDataAddOnServ(
                                    '{{$d->facid}}',
                                    '{{$d->servtyp}}',
                                    '{{$d->servowner}}',
                                    'edit'
                                    )" data-toggle="modal" data-target="#addOnService"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '0')" 
                                            data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                    </button>
                                </span>
                            @endif 
                        {{$d->facname}}<br/><small style="color:#ccc">{{$d->anc_name}} [{{$d->facid}}]</small> </li>
                    
                @endforeach
                </ul>	
            @endif
        </div>
    </div>
</div>  
 
 <div class="col-md-12 change-div"><b class="text-primary">For Ambulatory Surgical Clinic</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeDialysisStation"><i class="fa fa-edit"></i></button> @endif</div>
 <div class="col-sm-12">         
     @if (isset($addOnservices_applied))  
         <ul style="list-style-type: none; ">    
             @foreach ($addOnservices_applied as $d)
                @php $proceed_addon = 1; @endphp
                <li class="text-center">
                    @if($isupdate == 1)   
                        <span class="text-center">
                            <button class="btn btn-primary" onclick="showDataAddOnServ(
                            '{{$d->facid}}',
                            '{{$d->servtyp}}',
                            '{{$d->servowner}}',
                            'edit'
                            )" data-toggle="modal" data-target="#addOnService"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '0')" 
                                    data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                            </button>
                        </span>
                    @endif 
                {{$d->facname}}<br/><small style="color:#ccc">{{$d->anc_name}} [{{$d->facid}}]</small> </li>
             @endforeach	
         </ul>
     @endif
 </div>  

<!---- For Add On services --->
<div class="col-md-12 change-div"><b class="text-primary">ADD ON SERVICES</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeDialysisStation"><i class="fa fa-plus"></i></button> @endif</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAmb">

        <table class="table display" id="example" style="overflow-x: scroll;">
            <thead>
                <tr>
                    @if($isupdate == 1) 
                        <th class="text-center">Option</th>                    
                    @endif 
                    <th class="text-center">Add On Services</th>
                    <th class="text-center">Type(Owned, Outsoured)</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody>
            @php $proceed_addon = 0;  @endphp
            @if (isset($addOnservices_applied))
                @foreach ($addOnservices_applied as $d)
                    @php $proceed_addon = 1; @endphp
                    <tr>
                        @if($isupdate == 1)   
                            <td class="text-center">
                                <button class="btn btn-primary" onclick="showDataAddOnServ(
                                '{{$d->facid}}',
                                '{{$d->servtyp}}',
                                '{{$d->servowner}}',
                                'edit'
                                )" data-toggle="modal" data-target="#addOnService"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger " onclick="showDataDelServ('{{$d->facid}}', '{{$d->facname}}', '0')" 
                                        data-toggle="modal" data-target="#delService"><i class="fa fa-minus-circle"></i>
                                </button>
                            </td>
                        @endif 
                        <td class="text-center">{{$d->facname}}<br/><small style="color:#ccc">{{$d->anc_name}} [{{$d->facid}}]</small> </td>
                        <td class="text-center">Owned</td>
                        <td class="text-center">Remarks</td>
                    </tr>
                @endforeach	
            @endif
            
            @if($proceed_addon == 0)   
                <tr>
                    <td colspan="{{$addon_colspan+2}}" class="text-center">No Records found.</td>
                </tr>
            @endif
            
            </tbody>
        </table>

    </div>
</div>     

<!---- For Add On services --->
<div class="col-md-12 change-div">
    <b class="text-primary">AMBULANCE DETAILS</b> 
    @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeAmbulanceVehicle"><i class="fa fa-plus"></i>
</button> @endif</div>
<div class="col-md-12">
    <span class="text-danger">NOTE: For Owned ambulance, Payments are as follows:</span> <br>
    Ambulance Service Provider = ₱ 5,000
    Ambulance Unit (Per Unit) = ₱ 1,000
</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAmb">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Option</th>
                    <th class="text-center">Ambulance Service(Type 1, Type 2)</th>
                    <th class="text-center">Ambulance Type(Owned, Outsoured)</th>
                    <th class="text-center">Plate Number</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($appform_ambulance))
                    @php $aa = 0;  @endphp
                    @foreach ($appform_ambulance as $d)

                        @if(!empty($d['plate_number']))
                            @php $aa++;    @endphp
                            <tr>
                        
                                <td class="text-center"></td>
                                <td class="text-center">@if($d['typeamb'] == 1) Type 1 (Basic Life Support) @else Type 2 (Advance Life Support) @endif </td>
                                <td class="text-center">@if($d['ambtyp'] == "1") Outsourced @else Owned @endif</td>
                                <td class="text-center">{{$d['plate_number']}}</td>
                                <td class="text-center">{{$d['ambOwner']}}</td>
                            </tr>
                        @endif 
                    @endforeach	
                @else
                    <tr>
                        <td colspan="4" class="text-center">No Records found.</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr><td colspan="4" class="text-center">Total Number of Ambulance Apply: @if (isset($appform_ambulance)) {{count($appform_ambulance)}} @endif</td></tr>
            </tfoot>
        </table>
    </div>
</div>  

<div class="col-sm-6">
    
    <label class="text-left upd-text-title"><b class="text-primary">Authorized Bed Capacity </b>@if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeBedCapacity"><i class="fa fa-edit"></i></button> @endif</label>
    <h6  class="text-center upd-text-info">{{$appform->noofbed}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title"><b class="text-primary">Number of Dialysis Station </b>@if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changeDialysisStation"><i class="fa fa-edit"></i></button> @endif</label>
    <h6  class="text-center upd-text-info">{{$appform->noofdialysis}}&nbsp;</h6>
</div>


<div class="col-md-12 change-div"><b class="text-primary">For Pharmacy</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm" name="edit" data-toggle="modal" data-target="#changePharmacy"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Number of Main Pharmacy </label>
    <h6  class="text-center upd-text-info">{{$appform->noofbed}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">No. of Satellites </label>
    <h6  class="text-center upd-text-info">{{$appform->noofdialysis}}&nbsp;</h6>
</div>




@include('dashboard.client.forms.parts-update.rename-facility-form')
@include('dashboard.client.forms.parts-update.address-form')
@include('dashboard.client.forms.parts-update.facility-contact-details-form')
@include('dashboard.client.forms.parts-update.class-inst-func-others-form')
@include('dashboard.client.forms.parts-update.owner-form')
@include('dashboard.client.forms.parts-update.approving-authority-form')
@include('dashboard.client.forms.parts-update.latest-authorization-form')
@include('dashboard.client.forms.parts-update.classification-of-hospital-form')
@include('dashboard.client.forms.parts-update.ambulance-vehicle')
@include('dashboard.client.forms.parts-update.beds-capacity-form')
@include('dashboard.client.forms.parts-update.dialysis-station-form')
@include('dashboard.client.forms.parts-update.pharmacy-form')