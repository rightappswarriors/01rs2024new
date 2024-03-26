<div class="col-md-12"><hr/></div>   

<!-- Action Functions --->
<div class="row">
    
    <div class="form-group col-md-3">
        <button id="submitBedCapacity"  class="btn btn-block btn-primary btn-flat" type="button" value="bedcapacity" name="submit" data-toggle="modal" data-target="#changeBedCapacity">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> Bed Capacity
        </button>    
    </div>

    <div class="form-group col-md-3">
        <button id="submitDialysisStation"  class="btn btn-block btn-primary btn-flat" type="button" value="dialysisstation" name="submit" data-toggle="modal" data-target="#changeDialysisStation">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> Dialysis Station
        </button>   
    </div>
    
    <div class="form-group col-md-3">
        <a class="btn btn-block btn-primary btn-flat" type="button"  href="{{asset('/client1/regfacility/reg_annexa/')}}/{{$registered_facility->regfac_id}}" >
            <i class="fa fa-group " aria-hidden="true"></i> Personel
        </a>
    </div>

    <div class="form-group col-md-3">
        <a class="btn btn-block btn-primary btn-flat" type="button"  href="{{asset('/client1/regfacility/reg_annexb/')}}/" >
            <i class="fa fa-edit" aria-hidden="true"></i> Equipment
        </a>
    </div>

    <div class="form-group col-md-3">
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/apply/change_request_new/')}}/{{$registered_facility->regfac_id}}/cs">
            <i class="fa fa-edit" aria-hidden="true"></i> Change in Service
        </a>
    </div>

    <div class="form-group col-md-3">
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/apply/change_request_new/')}}/{{$registered_facility->regfac_id}}/cs">
            <i class="fa fa-plus" aria-hidden="true"></i> Add On Service
        </a>
    </div>                                   

    <div class="form-group col-md-3">
        <button id="submitAmbulanceVehicle"  class="btn btn-block btn-primary btn-flat" type="button" value="ambulancevehicle" name="submit" data-toggle="modal" data-target="#changeAmbulanceVehicle">
            <i class="fa fa-ambulance" aria-hidden="true"></i> Ambulance
        </a>
    </div>

    <div class="form-group col-md-3">
        <button id="submitCFIO"  class="btn btn-block btn-info btn-flat" type="button" value="cfio" name="submit" data-toggle="modal" data-target="#changeCFIO">
            <i class="fa fa-edit" aria-hidden="true"></i> 
            Classification
        </a>
    </div> 
    
    {{-- @if($registered_facility->hgpid == '6')  --}}
    <div class="form-group col-md-3">
        <button id="submitDowngradeHospital"  class="btn btn-block btn-primary btn-flat" type="button" value="downgradehospital" name="submit" data-toggle="modal" data-target="#changeDowngradeHospital">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> <small >Downgrade Hospital</small>
        </button>   
    </div>
    {{-- @endif    --}}

    <div class="form-group col-md-3">
        <button id="submitRenameHF"  class="btn btn-block btn-primary btn-flat" type="button" value="renamehf" name="submit" data-toggle="modal" data-target="#changeRenameHF">
            <i class="fa fa-file-word-o" aria-hidden="true"></i> Rename Facility
        </a>
    </div>

    <div class="col-md-3">
        <a class="btn btn-block btn-primary btn-flat" type="button" href="#">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            Other Updates
        </a>
    </div>
    
    <!-- div class="col-md-3 ">
        <a class="btn btn-block btn-primary btn-flat" type="button" href="#">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>  View Facility Profile 
        </a>
    </div --->
    
</div>



@include('dashboard.client.forms.beds-capacity-form')
@include('dashboard.client.forms.dialysis-station-form')
@include('dashboard.client.forms.rename-facility-form')
@include('dashboard.client.forms.class-inst-func-others-form')
@include('dashboard.client.forms.ic-downgrade-hospital')
@include('dashboard.client.forms.ic-ambulance-vehicle')