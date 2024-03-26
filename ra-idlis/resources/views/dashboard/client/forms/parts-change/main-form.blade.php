<!-- Application Details -->  
<div class="col-md-3">
    @isset($appid)
        <label>Type: </label>
        <label><strong class="text-xl">Initial Change - {{$registered_facility->hfser_id}}</strong></label>
    @endisset
</div>
<div class="col-md-3">
    <label>Registered ID: <strong class="text-xl">{{$registered_facility->regfac_id}}</strong></label>
</div>
<div class="col-md-3">
    <label>NHFR Code: <strong class="text-xl">{{$registered_facility->nhfcode}}</strong></label>
</div>
<div class="col-md-3 ">
    @isset($appid)
        <label class="col-md-12 btn-secondary text-center p-1">
            Application ID:&nbsp;&nbsp;&nbsp;<strong class="text-xl">
                @if($appid > 0)  {{$appid}}  @endif
            </strong>
        </label>
    @endisset
</div>

<!-- HF Name -->  
<div class="col-md-12">
    <label for="facility_name">Registered Facility Name: </label>
    <h3 class="text-center text-uppercase mb-2"><strong>{{$registered_facility->facilityname_old}}</strong></h3>
</div>

@if($registered_facility->facilityname != $registered_facility->facilityname_old)
    <div class="col-md-12">
        <label for="facility_name"><i>Rename Facility to <span class="text-danger">*</span></i> </label>
        <div class="input-group">
            <input type="text" name="facilityname" readonly="" class="form-control text-center text-uppercase" placeholder="FACILITY NAME" value="{{$registered_facility->facilityname}}" id="facility_name" onblur="checkFacilityNameNew(this.value)" required=""> 
        </div>
    </div>
@endif



<!-- Facility Address -->
<div class="col-md-12">
    <label for="facility_name"><i class="fa fa-map"></i> Registered HF Complete Address: </label>
    <label class="text-center text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>
        {{$registered_facility->street_number}} {{$registered_facility->street_name}},
        {{$registered_facility->brgyname}}, {{$registered_facility->cmname}}, 
        {{$registered_facility->provname}}, {{$registered_facility->rgn_desc}} {{$registered_facility->zipcode}}
    </strong></label>
</div>

@if($registered_facility->facilitytype != $registered_facility->facilitytype)
    <div class="col-md-12">
        <label for="facility_name">Change in Facility Address to<span class="text-danger">*</span></label>
        <div class="input-group">
            <input type="text" name="facilityaddress" readonly="" class="form-control" placeholder="FACILITY ADDRESS" value="{{$registered_facility->mailingAddress}}" id="facility_name" required=""> 
        </div>
    </div>
@endif

<!-- Contact Details -->
<div class="col-md-4">
    <label><i class="fa fa-phone-square"></i> Telephone: </label>
    <label><strong>({{$registered_facility->areacode}}) {{$registered_facility->landline}}</strong></label>
</div>

<div class="col-md-4">
    <label><i class="fa  fa-envelope"></i> Email: </label>
    <label><strong>{{$registered_facility->email}}</strong></label>
</div>

<div class="col-md-4">
    <label><i class="fa fa-mobile"></i> Mobile: </label>
    <label><strong>{{$registered_facility->ownerMobile}}</strong></label>
</div>

<!-- Owner -->
<div class="col-md-6">
    <label>Head of Facility/Medical Director: 
    <br/>&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$registered_facility->approvingauthority}}, {{$registered_facility->approvingauthoritypos}}</strong></label>
    <br/>
    <label>Owner Name: <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{$registered_facility->owner}}</strong></label>
</div>


<!-- Classification -->

<div class="col-md-6">
    <label style="margin-bottom:0; padding-bottom:0">Classification According to: </label>
    
    <ul style="list-style-type: none; margin-top:0; padding-top:0;">
        <li>
            Ownership: <strong>{{$registered_facility->ocdesc}} - {{$registered_facility->classname}}@isset($registered_facility->subclassname) - {{$registered_facility->subclassname}}@endisset</strong>     
            @if($registered_facility->facilitytype != $registered_facility->facilitytype)
                <br/><i>Change Ownership to <strong>{{$registered_facility->ocdesc}}</strong></i> 
            @endif                                              
        </li>
        <li>
            Institutional Character: <strong>{{$registered_facility->facmdesc}}</strong>     
            @if($registered_facility->facilitytype != $registered_facility->facilitytype)
                <br/><i>Change Ownership to <strong>{{$registered_facility->ocdesc}}</strong></i> 
            @endif                                              
        </li>
        <li>
            Function: <strong>{{$registered_facility->funcdesc}}</strong>     
            @if($registered_facility->facilitytype != $registered_facility->facilitytype)
                <br/><i>Change Function to <strong>{{$registered_facility->ocdesc}}</strong></i> 
            @endif                                              
        </li>
    </ul>
</div>

<!-- Authorization Number -->
<div class="col-md-6">
    <label>Latest LTO/COA/COR/ATO Number: </label>
    <label><strong class="text-xl">{{$registered_facility->con_id}} {{$registered_facility->lto_id}} {{$registered_facility->ato_id}} {{$registered_facility->coa_id}} {{$registered_facility->cor_id}}</strong></label>
</div>

<div class="col-md-6">
    <label>Validity Period: </label>
    <label><strong>@isset($validity){{$validity}}@endisset</strong></label>
</div>

<div class="col-md-6">
    <label>Permit to Construct No. (if applicable): </label>
    <label><strong class="text-xl">{{$registered_facility->ptc_id}}</strong></label>
</div>

<div class="col-md-6">
    <label>Date Issued: </label>
    <label><strong>@isset($issued_date){{$issued_date}}@endisset</strong></label>
</div>

<div class="col-md-12"><hr/></div>                                    
<!-- Type of Health Facility / Service -->

<div class="col-md-6">
    <label>Type of Health Facility / Service: </label>
    <!-- style type="text/css">
        ul {    list-style: none;    }
        ul li:before {    content: '✓ ';    }
    </style --->
    <ul style="list-style-type: none;  font-size: 30px;"><li class="text-uppercase font-weight-bold">{{$registered_facility->facilitytype}}</li></ul>
</div> 

<div class="col-md-6">                                        
    <label>Services:</label>
    <ul style="list-style-type: none; "><li>
        
        @if (isset($regservices))
            @foreach ($regservices as $d)
                {{$d->facname}}, 
            @endforeach	
        @endif

    </li></ul>
</div>

@if($registered_facility->facilitytype != $registered_facility->facilitytype)
    <div class="col-md-12">
        <br/><label><i>Change Type of Facility:</label>
        <h3 class="text-uppercase"><strong>{{$registered_facility->facilitytype}}</strong></h3>
    </div>
@endif                            

<div class="col-md-4">
    <label>Approved Bed Capacity:  
        @if(isset($registered_facility->noofbed_old))
            <strong>{{$registered_facility->noofbed_old}}</strong>
        @else
            <strong>0</strong>
        @endif
    </label>
    @if($registered_facility->noofbed_old != $registered_facility->noofbed)
        <br/><label><i>Increase/Decrease in Bed Capacity to  <strong>{{$registered_facility->noofbed}}</strong></i></label>
    @endif
</div>

<div class="col-md-4">
    <label>Number of Dialysis Station:  
        @if(isset($registered_facility->noofdialysis_old))
            <strong>{{$registered_facility->noofdialysis_old}}</strong>
        @else
            <strong>0</strong>
        @endif
    </label>
    @if($registered_facility->noofdialysis_old != $registered_facility->noofdialysis)
        <br/><label><i>Increase or Decrease in Dialysis Station to <strong>{{$registered_facility->noofdialysis}}</strong></i></label>
    @endif
</div>

<!-- div class="col-md-4">
    <label>Number of Ambulances:  
        <button id="submitAmbulanceVehicle"  class="btn btn-default btn-flat" type="button" value="ambulancevehicle" name="submit" data-toggle="modal" data-target="#changeAmbulanceVehicle">
            @if(isset($registered_facility->noofamb))
                <strong>{{$registered_facility->noofamb}}</strong> 
            @else
                <strong>0</strong>
            @endif
        </button>
    </label>
    @if($registered_facility->noofamb != $registered_facility->noofamb)
        <br/><label><i>Increase or Decrease in Ambulances to  <strong>{{$registered_facility->noofamb}}</strong></i></label>
    @endif
</div -->