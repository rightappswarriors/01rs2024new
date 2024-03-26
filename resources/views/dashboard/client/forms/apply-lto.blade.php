

<div  class="row">

    <div class="col-md-8">
        <?php $_aptid = "IN";
        $_aptdesc = "Initial New";
        $_dispSubmit = false;
        $_dispData = "Submit Details";
        if (isset($aptid)) {
            if ($aptid == "IC") {
                $_aptid = $aptid;
                $_aptdesc = "Change Request";
                $_dispSubmit = true;
                $_dispData = "Update Details";
            }
            if ($aptid == "R") {
                $_aptid = $aptid;
                $_aptdesc = "Renewal";
                $_dispSubmit = true;
                $_dispData = "Update Details";
            }
        } ?>
        
        {{-- {{dd([$_aptdesc,$_dispSubmit,$_dispData,$aptid,$_aptdesc])}} --}}
        {{csrf_field()}}
        <section class="container-fluid">
        
            <div class="card">
                <div class="card-header">
                    <p class="lead text-center text-danger">Please note: Red asterisk (*) is a required field and may be encountered throughout the system </p>
                </div>
                <div class="card-body">
                    <form class="row" id="ltoForm">
                    <input type="hidden" name="uid" id="uid" value="{{isset($user->uid) ? $user->uid : '' }}"/>
                <!-- <input type="hidden" name="uid" id="uid" value="$user->uid"/> 6-9-2021 -->
                        <input type="hidden" name="appid" id="appid" />
                        <!-- <input type="hidden" name="appid" id="appid" value="{{ isset($appdata->appid) ? $appdata->appid : '' }}" /> -->

                        <!-- Application Details -->
                        @include('dashboard.client.forms.parts.application-details')

                        <!-- Facility Address -->
                        @include('dashboard.client.forms.parts.facility-address')

                        <!-- Facility Contact Details -->
                        @include('dashboard.client.forms.parts.facility-contact-details')

                        <!-- Classfication -->
                        @include('dashboard.client.forms.parts.classification')

                        <!-- Service Capabilities -->
                        <!-- @include('dashboard.client.forms.parts.service-capabilities') -->

                        <!-- Owner Details -->
                        @include('dashboard.client.forms.parts.owner-details')

                        <!-- Owner Contact Details -->
                        @include('dashboard.client.forms.parts.proponent-owner-contact-details')

                        <!-- Official Mailing Address -->
                        @include('dashboard.client.forms.parts.official-mailing-address')

                        <!-- Approving Authority Details -->
                        @include('dashboard.client.forms.parts.approving-authority-details')

                        {{-- LTO Health Facility Address --}}
                        <!-- @include('dashboard.client.forms.parts.license-to-operate.health-facility-address') -->

                        {{-- LTO PTC Code --}}
                        @include('dashboard.client.forms.parts.license-to-operate.ptc-code')

                        {{-- LTO Type of Facility --}}
                        @include('dashboard.client.forms.parts.license-to-operate.type-of-facility')

                        {{-- LTO Class of Hospitals --}}
                        @include('dashboard.client.forms.parts.license-to-operate.classification-of-hospital')

                        {{-- LTO For Hospital --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-hospital')

                        {{-- LTO Ancillary/Clinical Services --}}
                        @include('dashboard.client.forms.parts.license-to-operate.ancillary-clinical-services')

                        {{-- LTO For Dialysis Clinic --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-dialysis-clinic')

                        {{-- LTO For Ambulatory Surgical Clinic --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-ambulatory-surgical-clinic')

                        {{-- no. of dialysis station --}}
                          @include('dashboard.client.forms.parts.num-dialysis')
                        
                        {{-- LTO Add-On Services --}}
                        @include('dashboard.client.forms.parts.license-to-operate.add-on-services')                       

                        {{-- LTO For Ambulance Details --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-ambulance-details')

                        {{-- LTO Other Clinical Service(s) --}}
                        @include('dashboard.client.forms.parts.license-to-operate.other-clinic-services')

                        {{-- LTO For Clinical Laboratory --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-clinical-laboratory')

                        {{-- LTO Classification According To --}}
                        @include('dashboard.client.forms.parts.license-to-operate.classification-according-to')

                        {{-- LTO Authorized Bed Capacity --}}
                        @include('dashboard.client.forms.parts.license-to-operate.authorized-bed-capacity')

                        {{-- LTO For Pharmacy --}}
                        @include('dashboard.client.forms.parts.license-to-operate.for-pharmacy')
                       
                        <div class="form-group row col-md-12 mt-5">
                            <div class="col-lg-3 col-md-3 col-xs-12"></div>
                            <!-- <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                                <a class="btn btn-danger btn-block" href="{{URL::to('/client1/apply')}}">
                                    <i class="fa fa-times" aria-hidden="true"></i> Cancel
                                </a>
                            </div> -->
                            <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                                <button id="submit"  class="btn btn-info btn-block" type="button" value="submit" name="submit" data-toggle="modal" data-target="#confirmSubmitModalLto">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    Submit Form 
                                </button>
                                <input id="saveasn"  name="saveasn" value="partial" type="hidden" />
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                             {{--   <button  id="save" class="btn btn-success btn-block" type="button" onClick="savePartialLto('partial')">
                                <!-- <button class="btn btn-success btn-block" type="button" onClick="savePartialLto(this)"> -->
                                    <!-- onClick="savePartial(this)" -->
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    Save as Draft
                                </button> --}} 
                            </div>
                            @php
                                $employeeData = session('employee_login');
                                $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
                                
                            @endphp

                            @if((app('request')->input('grp') != 'c' || app('request')->input('grp') != 'C') ||  $grpid == 'DC')
                <div class="col-md-12">
                Remarks: <br>
                {!!((count($fAddress) > 0) ? $fAddress[0]->appComment: "")!!}
                </div>
              
                @endif
                                
                <div class="col-md-12"> &nbsp;</div>

                @if((app('request')->input('grp') != 'c' && app('request')->input('grp') != 'C')  && app('request')->input('cont') != 'yes' && app('request')->input('grpn') != 'c' )
                                        <!-- <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                                        <div class="col-md-12" id="divRem" >
                                            <label for="remarks" >Remarks</label>
                                            <textarea class="form-control" name="remarks" id="remarks" >
                                            
                                            </textarea>
                                        </div>
                                            <button id="update"  class="btn btn-primary btn-block" type="button" onClick="savePartialLto('update')">
                                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                Update
                                            </button>
                                        </div> -->
                                        <div class="col-md-12" id="divRem" >
                                                <label for="remarks" >Remarks</label>
                                                <textarea class="form-control" name="remarks" id="remarks" >
                                                
                                                </textarea>
                                            </div>
                                            <div class="col-md-12"> &nbsp;</div>
                                            <div class="col-lg-3 col-md-3 col-xs-12 mb-5">
                                                <button id="update"  class="btn btn-primary btn-block" type="button" onClick="savePartialLto('update')">
                                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                    Update 
                                                </button>
                                        </div>
                                    @endif
                        </div> 
                    </form>
                </div>
            </div>
            <div class="modal fade" id="confirmSubmitModalLto" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
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
                            <button onClick="savePartialLto('final')" type="button" class="btn btn-success" data-dismiss="modal">
                                <!-- href={{ asset('client/dashboard/application/requirements/') }} -->
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Proceed
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <div id="clickable">

            </div>
            @include('dashboard.client.modal.facilityname-helper')
        </section>

        {{-- payment --}}
        <div class="col-md-4">
            @include('dashboard.client.forms.parts.payment.payment-form')
         
        </div>
    </div>


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

    #asc-H1-REGIS {
        display: none;
    }
    #asc-H2-REGIS {
        display: none;
    }
    #asc-H3-REGIS {
        display: none;
    }
</style>
<script>
 var savStat = "partial";
 savStat ='{!!((count($fAddress) > 0) ? $fAddress[0]->savingStat: "")!!}';

if (window.location.href.indexOf("?cor=true") > -1 && 'final' == '{!!((count($fAddress) > 0) ? $fAddress[0]->savingStat: "")!!}') {
    savStat = "partial";
}

//  if(savStat == "final"){
//     document.getElementById('submit').setAttribute("hidden", "hidden");
//     document.getElementById('save').setAttribute("hidden", "hidden");
// document.getElementById('update').removeAttribute("hidden");
//  }
var apptypenew = '{!! $apptypenew !!}';

 if(savStat == "final" && apptypenew != "renewal"){
    document.getElementById('submit').setAttribute("hidden", "hidden");
    document.getElementById('save').setAttribute("hidden", "hidden");

    var update =  document.getElementById('update');
    if(update){
    document.getElementById('update').removeAttribute("hidden");
}
    @if($grpid == 'RLO' || $grpid == 'LO1' || $grpid == 'LO2' || $grpid == 'LO3' || $grpid == 'LO4' || $grpid == 'PO' || $grpid == 'PO1' || $grpid == 'PO2')
         document.getElementById('divRem').removeAttribute("hidden");
    @endif

 }

 if(apptypenew == "renewal"){
   var ren =   document.getElementsByClassName("renewal");

   for(var i = 0 ; i < ren.length ; i++){
       ren[i].removeAttribute("hidden");
   }
 }


</script>





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>


@include('dashboard.client.forms.parts.license-to-operate.new_ftr')
@include('dashboard.client.forms.parts.license-to-operate.lto-form-submission')
@include('dashboard.client.get_fees')



