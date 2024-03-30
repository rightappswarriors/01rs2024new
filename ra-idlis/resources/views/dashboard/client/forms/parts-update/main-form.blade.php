<!-- Application Details -->  

@php $allowed_edit = true; @endphp

<div class="col-md-12 change-div"><b class="text-primary">APPLICATION</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
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
    <h3 class="text-center text-uppercase mb-2 upd-text-info">{{$appform->facilityname}}</h3>
</div>
<div class="col-md-12 change-div"><b class="text-primary">FACILTY ADDRESS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<!-- Facility Address -->
<div class="col-sm-3">
    <label class="text-left upd-text-title">Region <span class="text-danger">*</span>
    </label>
    <h6  class="text-center upd-text-info">{{$appform->rgn_desc}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">Province/District <span class="text-danger">*</span>
    </label>
    <h6  class="text-center upd-text-info">{{$appform->provname}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">City/Municipality <span class="text-danger">*</span>
    </label>
    <h6  class="text-center upd-text-info">{{$appform->cmname}}</h6>
</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title">Barangay <span class="text-danger">*</span>
    </label>
    <h6  class="text-center upd-text-info">{{$appform->brgyname}}</h6>
</div>


<div class="col-sm-3">
    <label class="text-left upd-text-title">Street Number
    </label>
    <h6  class="text-center upd-text-info">{{$appform->street_number}}&nbsp;</h6>
</div>


<div class="col-sm-6">
    <label class="text-left upd-text-title">Street name
    </label>
    <h6  class="text-center upd-text-info">{{$appform->street_name}}&nbsp;</h6>
</div>


<div class="col-sm-3">
    <label class="text-left upd-text-title">Zip Code <span class="text-danger">*</span>
    </label>
    <h6  class="text-center upd-text-info">{{$appform->zipcode}}&nbsp;</h6>
</div>


<!-- Contact Details -->
<div class="col-md-12 change-div"><b class="text-primary">FACILITY CONTACT DETAILS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-mobile"></i> Facility Mobile No. </label>
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-phone-square"></i> Facility Landline </label>
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa fa-fax"></i> Fax Number </label>
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-3">
    <label class="text-left upd-text-title"><i class="fa  fa-envelope"></i> Facility Email Address </label>
    <h6  class="text-center upd-text-info">{{$appform->email}}&nbsp;</h6>
</div>




<!-- Classification -->

<div class="col-md-12 change-div"><b class="text-primary">CLASSIFICATION ACCORDING TO</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>

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


<div class="col-md-12 change-div"><b class="text-primary">OWNER DETAILS</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
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


<div class="col-md-12 change-div"><b class="text-primary">Proponent/Owner Contact Details</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa fa-mobile"></i> Proponent/Owner Mobile No. </label>
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa fa-phone-square"></i> Proponent/Owner Landline </label>
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>

<div class="col-sm-4">
    <label class="text-left upd-text-title"><i class="fa  fa-envelope"></i> Proponent/Owner Email Address </label>
    <h6  class="text-center upd-text-info">{{$appform->email}}&nbsp;</h6>
</div>


<div class="col-md-12 change-div"><b class="text-primary">Official Mailing Address</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">
    <h6  class="text-center upd-text-info">({{$appform->areacode}}) {{$appform->landline}}&nbsp;</h6>
</div>


<div class="col-md-12 change-div"><b class="text-primary">Approving Authority Details</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Approving Authority Position/Designation </label>
    <h6  class="text-center upd-text-info">{{$appform->approvingauthoritypos}}&nbsp;</h6>
</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Approving Authority Full Name   </label>
    <h6  class="text-center upd-text-info">{{$appform->approvingauthority}}&nbsp;</h6>
</div>

<div class="col-sm-12">
    <label class="text-left upd-text-title">Head of Facility Full Name   </label>
    <h6  class="text-center upd-text-info">{{$appform->approvingauthority}}&nbsp;</h6>
</div>


<!-- Authorization Number -->
<div class="col-md-12 change-div"><b class="text-primary"> Latest Authorization Number</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Permit to Construct No. (if applicable)   </label>
    <h6  class="text-center upd-text-info">{{$appform->ptc_id}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Date Issued </label>
    <h6  class="text-center upd-text-info">@isset($issued_date){{$issued_date}}@endisset&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Latest LTO/COA/COR/ATO Number  </label>
    <h6  class="text-center upd-text-info">{{$appform->con_id}} {{$appform->lto_id}} {{$appform->ato_id}} {{$appform->coa_id}} {{$appform->cor_id}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">Validity Period </label>
    <h6  class="text-center upd-text-info">@isset($validity){{$validity}}@endisset&nbsp;</h6>
</div>


<div class="col-sm-12"><hr/></div>                                    
<!-- Type of Health Facility / Service -->

<div class="col-md-12 change-div"><b class="text-primary"> Type of Health Facility</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">
    <ul style="list-style-type: none;  font-size: 30px;">
        <li class="text-uppercase font-weight-bold">
            <i class="fa fa-check-square-o"></i> &nbsp;{{$appform->facilitytype}}&nbsp;
        </li>
    </ul>
</div> 
 
<div class="col-md-12 change-div"><b class="text-primary"> For Ambulatory Surgical Clinic</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">         
    @if (isset($regservices))  
        <ul style="list-style-type: none; ">    
            @foreach ($regservices as $d)
                <li>{{$d->facname}}</li>
            @endforeach	
        </ul>
    @endif
</div>          

<div class="col-md-12 change-div"><b class="text-primary"> Classification of Hospital</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">         
    @if (isset($regservices))  
        <ul style="list-style-type: none; ">    
            @foreach ($regservices as $d)
                <li>{{$d->facname}}</li>
            @endforeach	
        </ul>
    @endif
</div>   

<!---- For Add On services --->
<div class="col-md-12 change-div"><b class="text-primary"> Ancillary/Clinical Services</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAncillary">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Option</th>
                    <th class="text-center">Services</th>
                    <th class="text-center">Type(Owned, Outsoured)</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody id="body_ancillary">
                <tr id="tr_addOn" hidden="">
                    <td class="text-center" onclick="return preventDef()">
                        <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle" onclick="return preventDef()"></i></button>
                    </td>
                    <td class="text-center">
                        Service Name
                    </td>
                    <td class="text-center">
                        Outsourced / Owned
                    </td>
                    <td class="text-center">
                        Owner
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>  

<!---- For Add On services --->
<div class="col-md-12 change-div"><b class="text-primary"> Add on services</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAmb">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Option</th>
                    <th class="text-center">Services</th>
                    <th class="text-center">Type(Owned, Outsoured)</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody id="body_addOn">
                <tr id="tr_addOn" hidden="">
                    <td class="text-center" onclick="return preventDef()">
                        <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle" onclick="return preventDef()"></i></button>
                    </td>
                    <td class="text-center">
                        Service Name
                    </td>
                    <td class="text-center">
                        Outsourced / Owned
                    </td>
                    <td class="text-center">
                        Owner
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>     

<!---- For Add On services --->
<div class="col-md-12 change-div"><b class="text-primary"> Ambulance Details</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-12">    
    <div class="row col-border-right showAmb">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Option</th>
                    <th class="text-center">Ambulance Service(Type 1, Type 2)</th>
                    <th class="text-center">Ambulance Type(Owned, Outsoured)</th>
                    <th class="text-center">Details</th>
                </tr>
            </thead>
            <tbody id="body_amb">
                <tr id="tr_addOn" hidden="">
                    <td class="text-center" onclick="return preventDef()">
                        <button class="btn btn-danger " onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle" onclick="return preventDef()"></i></button>
                    </td>
                    <td class="text-center">
                        Ambulance Service
                    </td>
                    <td class="text-center">
                        Ambulance Type
                    </td>
                    <td class="text-center">
                        Owner
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>  

<div class="col-sm-6">
    <div class="col-md-12 change-div"><b class="text-primary">Authorized Bed Capacity</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
    <h6  class="text-center upd-text-info">{{$appform->noofbed}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <div class="col-md-12 change-div"><b class="text-primary">Number of Dialysis Station</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
    <h6  class="text-center upd-text-info">{{$appform->noofdialysis}}&nbsp;</h6>
</div>


<div class="col-md-12 change-div"><b class="text-primary">For Pharmacy</b>  @if($allowed_edit)<button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> @endif</div>
<div class="col-sm-6">
    <label class="text-left upd-text-title">Number of Main Pharmacy </label>
    <h6  class="text-center upd-text-info">{{$appform->noofbed}}&nbsp;</h6>
</div>

<div class="col-sm-6">
    <label class="text-left upd-text-title">No. of Satellites </label>
    <h6  class="text-center upd-text-info">{{$appform->noofdialysis}}&nbsp;</h6>
</div>




@include('dashboard.client.forms.beds-capacity-form')
@include('dashboard.client.forms.beds-capacity-form')
@include('dashboard.client.forms.dialysis-station-form')
@include('dashboard.client.forms.rename-facility-form')
@include('dashboard.client.forms.class-inst-func-others-form')
@include('dashboard.client.forms.ic-downgrade-hospital')
@include('dashboard.client.forms.ic-ambulance-vehicle')