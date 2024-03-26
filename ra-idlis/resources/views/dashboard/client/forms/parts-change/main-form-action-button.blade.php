@php 

@endphp

<div class="col-md-12"><hr/></div>   

<!-- Action Functions --->
<div class="row">
    @if($registered_facility->isHospital)
    <div class="form-group col-md-3" id="bedcapacity_div">
        <button id="submitBedCapacity"  class="btn btn-block btn-primary btn-flat" type="button" value="bedcapacity" name="submit" data-toggle="modal" data-target="#changeBedCapacity">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> Bed Capacity
        </button>    
    </div>
    @endif
    @if($registered_facility->dialysisClinic)
    <div class="form-group col-md-3" id="dialysisstation_div">
        <button id="submitDialysisStation"  class="btn btn-block btn-primary btn-flat" type="button" value="dialysisstation" name="submit" data-toggle="modal" data-target="#changeDialysisStation">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> Dialysis Station
        </button>   
    </div>
    @endif
    
    <div class="form-group col-md-3" id="personnel_div">
        <a class="btn btn-block btn-primary btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/annexa"  {{-- href="{{asset('/client1/regfacility/reg_annexa/')}}/{{$registered_facility->regfac_id}}" --}} >
            <i class="fa fa-group " aria-hidden="true"></i> Personel
        </a>
    </div>

    <div class="form-group col-md-3" id="equipment_div">
        <a class="btn btn-block btn-primary btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/annexb" {{-- href="{{asset('/client1/regfacility/reg_annexb/')}}/{{$registered_facility->regfac_id}}" --}} >
            <i class="fa fa-edit" aria-hidden="true"></i> Equipment
        </a>
    </div>
    
    @if($registered_facility->isHospital)
    <div class="form-group col-md-3" id="hospital_div">
        
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/hospital">
            <i class="fa  fa-plus" aria-hidden="true"></i>/<i class="fa  fa-minus" aria-hidden="true"></i> Update Hospital Level
        </a>
    </div>
    @endif
    @if($registered_facility->isHospital =="1" || $registered_facility->otherClinicService =="1" || $registered_facility->clinicLab =="1" || $registered_facility->ambulSurgCli =="1"  || $registered_facility->addOnServe =="1" )
    <div class="form-group col-md-3" id="addonservice_div">
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/as">
            <i class="fa fa-plus" aria-hidden="true"></i> Add On Service
        </a>
    </div>  
    @endif
    @if($registered_facility->isHospital =="1" || $registered_facility->otherClinicService =="1" || $registered_facility->clinicLab =="1" || $registered_facility->ambulSurgCli =="1"  || $registered_facility->addOnServe =="1" )
    <div class="form-group col-md-3" id="changeinservice_div">
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/cs">
            <i class="fa fa-edit" aria-hidden="true"></i> Change in Service
        </a>
    </div>                           
    @endif
    @if($registered_facility->ambuDetails)
    <div class="form-group col-md-3" id="ambulance_div">
        <a class="btn btn-block btn-info btn-flat" type="button" href="{{asset('/client1/changerequest/')}}/{{$registered_facility->regfac_id}}/av">
            <i class="fa fa-ambulance" aria-hidden="true"></i> Ambulance
        </a>
    </div>                 
    @endif

    <div class="form-group col-md-3" id="classification_div">
        <button id="submitCFIO"  class="btn btn-block btn-primary btn-flat" type="button" value="cfio" name="submit" data-toggle="modal" data-target="#changeCFIO">
            <i class="fa fa-edit" aria-hidden="true"></i> 
            Classification
        </a>
    </div> 
    
    <div class="form-group col-md-3" id="rename_div">
        <button id="submitRenameHF"  class="btn btn-block btn-primary btn-flat" type="button" value="renamehf" name="submit" data-toggle="modal" data-target="#changeRenameHF">
            <i class="fa fa-file-word-o" aria-hidden="true"></i> Rename Facility
        </a>
    </div>
{{-- 
    <div class="col-md-3" id="otherupdates_div">
        <a class="btn btn-block btn-primary btn-flat" type="button" href="#">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            Other Updates
        </a>
    </div>
      --}}
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