<div class="col-md-8">
<section class="container-fluid">
<div class="card">
    <div class="card-header">
        <p class="lead text-center text-danger">Please note: Red asterisk (*) is a required field and may be encountered throughout the system </p>
    </div>
    <div class="card-body">
        <form class="row">
            <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
            <!-- <input type="hidden" name="uid" id="uid" value="$user->uid"/> 6-9-2021 -->
            <!-- <input type="hidden" name="appid" id="appid" value="{{ isset($appdata->appid) ? $appdata->appid : '' }}" /> -->
            <input type="hidden" name="appid" id="appid" />
            
            <!-- Application Details -->
            @include('dashboard.client.forms.parts.application-details')

            <!-- Facility Address -->
            @include('dashboard.client.forms.parts.facility-address')

            <!-- Facility Contact Details -->
            @include('dashboard.client.forms.parts.facility-contact-details')

            <!-- Classfication -->
            @include('dashboard.client.forms.parts.classification')

          

            <!-- Owner Details -->
            @include('dashboard.client.forms.parts.owner-details')

            <!-- Owner Contact Details -->
            @include('dashboard.client.forms.parts.proponent-owner-contact-details')

            <!-- Official Mailing Address -->
            @include('dashboard.client.forms.parts.official-mailing-address')

            <!-- Approving Authority Details -->
            @include('dashboard.client.forms.parts.approving-authority-details')


                <!-- PTC Type of Consturction -->
                @include('dashboard.client.forms.parts.permit-to-construct.type-of-construction')

                <!-- PTC Type of Health Facility -->
                @include('dashboard.client.forms.parts.permit-to-construct.type-of-health-facility')
            
                <!-- PTC Type of Service Capabilities -->
                @include('dashboard.client.forms.parts.permit-to-construct.service-capabilities')

                {{-- PTC Available Add-Ons --}}
                @include('dashboard.client.forms.parts.permit-to-construct.available-add-ons')

                {{-- no. of dialysis station --}}
                @include('dashboard.client.forms.parts.num-dialysis')

                {{-- PTC Option --}}
                @include('dashboard.client.forms.parts.permit-to-construct.options')

                {{-- PTC CON Code --}}         
                @include('dashboard.client.forms.parts.con_number')

                {{-- PTC Proposed Health Facility Address --}}
                {{-- @include('dashboard.client.forms.parts.permit-to-construct.proposed-health-facility-address') --}}

                {{-- PTC Classification According To --}}
                {{-- @include('dashboard.client.forms.parts.permit-to-construct.classification-according-to') --}}
           

            <div class="form-group row col-md-12 mt-5">
                <div class="col-lg-3 col-md-3 col-xs-12"></div>
                <!-- <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                    <a class="btn btn-danger btn-block" href="{{URL::to('/client1/apply')}}">
                        <i class="fa fa-times" aria-hidden="true"></i> Cancel
                    </a>
                </div> -->
                <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                    <button 
                        id="submit"
                        class="btn btn-info btn-block" 
                        type="button" 
                        value="submit" 
                        name="submit"
                        data-toggle="modal" 
                        data-target="#confirmSubmitModalPtc"
                    >
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        Submit Form
                    </button>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                    <!-- <button id="save" class="btn btn-success btn-block" type="button" onClick="savePartialPtc('partial')">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save as Draft
                    </button> -->
                </div>
                 
                @php
                    $employeeData = session('employee_login');
                    $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
                @endphp

                @if(app('request')->input('grp') == 'c' ||  $grpid == 'DC')
                    <div class="col-md-12">
                    Remarks: <br>
                    {!!((count($fAddress) > 0) ? $fAddress[0]->appComment: "No Remarks")!!}
                    </div>
                @endif

                @if($grpid != 'C')
                    @if(app('request')->input('grp') != 'c' && app('request')->input('cont') != 'yes' && app('request')->input('grpn') != 'c')
                        <div class="col-md-12" id="divRem" >
                            <label for="remarks" >Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" >
                            
                            </textarea>
                        </div>
                        <div class="col-md-12"> &nbsp;</div>
                        <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                            <button id="update"  class="btn btn-primary btn-block" type="button" onClick="savePartialPtc('update')">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Update 
                            </button>
                        </div>
                    @endif
                @endif
            </div>                 
        </form>
    </div>
</div>

@include('dashboard.client.modal.facilityname-helper')

<div class="modal fade" id="confirmSubmitModalPtc" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmSubmitModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <p class="lead"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b>Are you sure you want to submit form?</b></p>
                                <p>Please check and review your application form before submitting.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-primary" onclick="setTimeout(function() {window.print()}, 10); ">
                                <i class="fa fa-eye" aria-hidden="true"></i> Preview
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <i class="fa fa-times" aria-hidden="true"></i>
                                No, Recheck details
                            </button>
                            <button onClick="savePartialPtc('final')" type="button" class="btn btn-success" data-dismiss="modal">
                                <!-- href={{ asset('client/dashboard/application/requirements/') }} -->
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

{{-- payment --}}
<div class="col-md-4">
    @include('dashboard.client.forms.parts.payment.payment-form')
  
</div>

<style>
    .feedback {
        width: 100%;
        display: block;
    }
    .custom-selectpicker {
        border: 1px solid #ced4da;
    }
    .region {
        display: none;
    }
    .province {
        display: none;
    }
</style>

<script>
    var savStat = "partial";
    savStat ='{!!((count($fAddress) > 0) ? $fAddress[0]->savingStat: "")!!}';

//     if(savStat == "final"){
//         document.getElementById('submit').setAttribute("hidden", "hidden");
//         document.getElementById('save').setAttribute("hidden", "hidden");
// document.getElementById('update').removeAttribute("hidden");
//     }

var apptypenew = '{!! $apptypenew !!}';

 if(savStat == "final" && apptypenew != "renewal"){
    document.getElementById('submit').setAttribute("hidden", "hidden");
    document.getElementById('save').setAttribute("hidden", "hidden");
    document.getElementById('update').removeAttribute("hidden");
    
    @if($grpid == 'RLO')
        //  document.getElementById('divRem').removeAttribute("hidden");
    @endif
    
 }

 if(apptypenew == "renewal"){
   var ren =   document.getElementsByClassName("renewal");

   for(var i = 0 ; i < ren.length ; i++){
       ren[i].removeAttribute("hidden");
   }
 }
</script>