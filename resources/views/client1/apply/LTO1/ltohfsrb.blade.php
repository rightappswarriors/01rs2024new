@extends('main') 
@section('content') 
@include('client1.cmp.__apply')

<body>

    <style type="text/css">
        .parsley-errors-list {
        	list-style:  none;
        	color: red;
        }
    </style>

    @if(! isset($hideExtensions)) 
	    @include('client1.cmp.nav') 
	    @include('client1.cmp.breadcrumb') 
	    @include('client1.cmp.msg') 
	    @include('client1.cmp.__wizard') 
    @endif 

    {{csrf_field()}}

    <div class="container-fluid mt-5 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item active text-primary"><a href="{{asset($addresses[0])}}">Application Details</a></li>
                <li class="breadcrumb-item active"><a href="{{asset($addresses[1])}}">DOH Requirements</a></li>
                <li class="breadcrumb-item active"><a href="{{asset($addresses[2])}}">FDA Requirements</a></li>
                <li class="breadcrumb-item active">Submit Requirements</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-4">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Application Details
				        </button>
				      </h5>
                        </div>
                        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="background-color: #4682B4; color: white;">Type of Application</th>
                                            <td>{{((count($fAddress) > 0) ? $fAddress[0]->hfser_desc : "No Type of Application")}}</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #4682B4; color: white;">Status of Application</th>
                                            <td>{{((count($fAddress) > 0) ? $fAddress[0]->trns_desc : "No Status")}}</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #4682B4; color: white;">Name of Facility</th>
                                            <td>{{((count($fAddress) > 0) ? $fAddress[0]->facilityname : "No Facility Name")}}</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #4682B4; color: white;">Owner</th>
                                            <td>{{((count($fAddress) > 0) ? $fAddress[0]->owner : "No Owner")}}</td>
                                        </tr>
                                        <tr>
                                            <th style="background-color: #4682B4; color: white;">Date of Application</th>
                                            <td>{{((count($fAddress) > 0) ? ( $fAddress[0]->t_date ?   date('M d, Y', strtotime($fAddress[0]->t_date)) : "Application not yet completed") : "No Date")}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Details
				        </button>
				      </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 border">
                <!-- if($fAddress[0]->noofsatellite > 0) -->
                @if(intval($appform->noofmain) > 0 || $hasRadio)
                <div class="float-right">
                    <button type="button" onclick="window.location.href='{{asset('client1/apply/app/'.($fAddress[0]->hfser_id ?? 'LTO').'/'.$fAddress[0]->appid."/fda")}}'" class="text-white btn btn-primary mt-1">Check FDA Requirements <span><i class="text-white fa fa-arrow-right"></i></span></button>
                </div>
                @endif
                <!-- endif -->
                <div class="container text-left mt-3 lead">
                    Requirements Status: 
                    <span>
                        @if($appform->isReadyForInspec > 0 && !isset($appform->isrecommended))
                            @if($appform->isrecommended === 0)
                                <span class="text-danger">Requirements Disapprove</span>
                            @elseif($appform->isrecommended === 1)
                                <span class="text-success">Requirements Approved</span>
                            @elseif($appform->isrecommended === 2)
                                <span class="text-warning">Requirements set for Revision</span>
                            @else
                                <span class="text-info">Pending for Evaluation</span>
                            @endif
                        @elseif($appform->isReadyForInspec <= 0 && $appform->isrecommended == 2)
                            <span class="text-warning">Requirements set for Revision</span>
                        @elseif($appform->isReadyForInspec > 0 && isset($appform->isrecommended) && $appform->isrecommended == 2)
                            <span class="text-info">Awaiting Re-Evaluation</span>
                        @else
                            <span class="text-info">Waiting for you to submit Requirements</span>
                        @endif
                    </span>
                </div>
                <div class="row marginbottom-md" style="padding-top: 40px;">
                    <div class="col-md-6" style="text-align: center;">
                      {{--   onclick="loadData('LIST OF PERSONNEL (Annex A)', '{{asset("client1/apply/app/LTO/48/hfsrb/annexAdd")}}');" data-toggle="modal" data-target="#viewModalA" --}}
                        <div class="col-12 mb-3">
                            <!-- @if(isset($data[0][2][0]->evaluation))
                                @if($data[0][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[0][1]}}','{{$data[0][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[0][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" onclick="addT('{{$data[0][1]}}','{{$data[0][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif -->
                        </div>
                        <button class="btn btn-info" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexa/'.$appid)}}'" style="white-space: normal; width: 100%; height: 90%;" ><i class="fa fa-user-plus"></i> LIST OF PERSONNEL (Annex A)</button>
                    </div>
                    <div class="col-md-6" style="text-align: center;">
                        <div class="col-12 mb-3">
                            <!-- @if(isset($data[1][2][0]->evaluation))
                                @if($data[1][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[1][1]}}','{{$data[1][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks3</button>
                                @elseif($data[1][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" onclick="addT('{{$data[1][1]}}','{{$data[1][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif -->
                        </div>
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 90%;" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexb/'.$appid)}}'"><i class="fa fa-cog"></i> LIST OF EQUIPMENT/ INSTRUMENT (Annex B)</button>
                    </div>
                    {{-- onclick="loadData('LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex C)', '');" data-toggle="modal" data-target="#viewModalC"
                    <div class="col-md-4" style="text-align: center;">
                        <div class="col-12 mb-3">
                            @if(!empty($data[2][2][0]))
                                @if($data[2][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[2][1]}}','{{$data[2][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[2][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" onclick="addT('{{$data[2][1]}}','{{$data[2][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif
                        </div>
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 90%;" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexc/'.$appid)}}'"><i class="fa fa-flask"></i> LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex C)</button>
                    </div> --}}
                </div>
                {{-- <div class="row marginbottom-md" style="margin-top: 50px;">
                    <div class="col-md-4" style="text-align: center;">
                        <div class="col-12 pb-3">
                            @if(!empty($data[3][2][0]))
                                @if($data[3][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[3][1]}}','{{$data[3][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[3][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" onclick="addT('{{$data[3][1]}}','{{$data[3][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif
                        </div>
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 90%;" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexd/'.$appid)}}'"><i class="fa fa-industry"></i> LIST OF PRODUCTS (Annex D)</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <div class="col-12 pb-3">
                            @if(!empty($data[4][2][0]))
                                @if($data[4][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                     <button class="btn" onclick="addT('{{$data[4][1]}}','{{$data[4][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[4][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                     <button class="btn" onclick="addT('{{$data[4][1]}}','{{$data[4][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif
                        </div>
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 90%;" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexf/'.$appid)}}'"><i class="fa fa-user-md"></i> LIST OF PERSONNEL FOR DIAGNOSTIC RADIOLOGY AND RADIATION SERVICES (Annex F)</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <div class="col-12 pb-3">
                            @if(!empty($data[5][2][0]))
                                @if($data[5][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[5][1]}}','{{$data[5][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[5][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                     <button class="btn" onclick="addT('{{$data[5][1]}}','{{$data[5][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif
                        </div>
                        <button class="btn btn-info" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexh/'.$appid)}}'" style="white-space: normal; width: 100%; height: 90%;" ><i class="fa fa-medkit"></i> LIST OF EQUIPMENT, LABORATORY WARE AND MATERIALS (Annex H)</button>
                    </div>
                </div> --}}
               {{--  <div class="row marginbottom-md" style="margin-top:50px;">
                    <div class="col-md-4" style="text-align: center;">
                        <div class="col-12 pb-3">
                            @if(!empty($data[6][2][0]))
                                @if($data[6][2][0]->evaluation == 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" onclick="addT('{{$data[6][1]}}','{{$data[6][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @elseif($data[6][2][0]->evaluation == 0)
                                    <i class="fa fa-times text-danger"></i>
                                     <button class="btn" onclick="addT('{{$data[6][1]}}','{{$data[6][2][0]->remarks}}')" data-toggle="modal" data-target="#modal">Show Remarks</button>
                                @endif
                            @endif
                        </div>
                        <button class="btn btn-info" onclick="window.location.href='{{asset('client1/apply/hfsrb/annexi/'.$appid)}}'" style="white-space: normal; width: 100%; height: 70%;"><i class="fa fa-pencil"></i> LIST OF TESTING MATERIALS (Annex I)</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="loadData('LIST OF PARAMETERS FOR EACH SERVICE CAPABILITY (Annex J)', '');" data-toggle="modal" data-target="#viewModalJ"><i class="fa fa-pencil"></i> LIST OF PARAMETERS FOR EACH SERVICE CAPABILITY (Annex J)</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="loadData('LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex K)', '');" data-toggle="modal" data-target="#viewModalK"><i class="fa fa-flask"></i> LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex K)</button>
                    </div>
                </div> --}}
                {{-- <div class="row marginbottom-md">
                    <div class="col-md-4" style="text-align: center;">
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="alert('Not yet available.');"><i class="fa fa-map-marker"></i> HEALTH FACILITY GEOGRAPHIC FORM</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <a href="{{asset($addresses[3])}}">
                            <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%"><i class="fa fa-usd"></i> ORDER OF PAYMENT</button>
                        </a>
                    </div>
                    <div class="col-md-4" style="text-align: center;">
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="loadData('UPLOAD PAYMENT RECEIPT', '');" data-toggle="modal" data-target="#viewModal"><i class="fa fa-upload"></i> UPLOAD PAYMENT RECEIPT</button>
                    </div>
                </div> --}}
                {{-- <hr>
                 div class="row marginbottom-md">
                    <div class="col-md-4" style="text-align: center;"></div>
                    <div class="col-md-4" style="text-align: center;">
                        <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="loadData('Other Attachments', '');" data-toggle="modal" data-target="#viewModal"><i class="fa fa-paperclip"></i> Other Attachments</button>
                    </div>
                    <div class="col-md-4" style="text-align: center;"></div>
                </div> --}}
                @if($appform->isReadyForInspec <= 0 || $appform->aptid <= 'R')
                    <div class="d-flex justify-content-center" style="margin-top: 100px;">
                    <!-- {{-- @if($isReadyForInspecFDA == 0 && $hfser_id == 'LTO') 
                    <button disabled class="btn btn-warning p-3">FDA requirements not yet finalize</button>
                    @else --}}
                    <button onclick="readyforInspection()" class="btn btn-primary p-3">Finalize and Submit</button>
                   {{-- @endif --}}    -->
                   @if(intval($appform->noofmain) > 0 || $hasRadio)
                        @if($isReadyForInspecFDA == 0 && ($hfser_id == 'LTO' || $hfser_id == 'COA')) 
                            <button disabled class="btn btn-warning p-3">FDA requirements not yet finalize</button>
                        @else
                        @if($appform->status == 'FSR' || $appform->status == '' || $appform->status == null)
                            <button onclick="readyforInspection()" data-status="{{$appform->status}}" class="btn btn-primary p-3">Finalize and Submit</button>
                        @endif
                        @endif
                    @else
                        <!-- To be changed -->
                        
                        @if($appform->status == 'FSR' || $appform->status == '' || $appform->status == null)
                                <button onclick="readyforInspection()" data-status="{{$appform->status}}" class="btn btn-primary p-3">Finalize and Submit</button>

                        @endif
                    @endif 
                    </div>

                @endif

            </div>


        </div>

    </div>

    {{-- <div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
        <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
            <div class="modal-content">
                <div class="modal-header" id="viewHead">
                    <h5 class="modal-title" id="viewModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input id="appid" type="hidden" name="appid" value="{{$appid}}">

                <div class="modal-body" id="viewBody">
                    <div id="_errMsg"></div>

                    <div class="card-body table-responsive" id="viewAll">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="remthis modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg shadow" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="addModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="card-body table-responsive" id="addAll">

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>

    <script type="text/javascript">
        "use strict";

        function addT(title,remark){
            $("#header").empty().html(title);
            $("#body").empty().html(remark);
        }

        // var ___wizardcount = document.getElementsByClassName('wizardcount');
        // document.getElementById('stepDetails').innerHTML = 'Step 3.b: HFSRB Requirement';
        // var ___div = document.getElementById('__applyBread'),
            // loadHere = document.getElementById('loadHere');
        var curAppid = "",
            curPtcId = "",
            lData = "hfsrb",
            sesslString = "",
            cAppid = "{{((count($fAddress) > 0) ? $fAddress[0]->appid : "
        0 ")}}";
        // if (___wizardcount != null || ___wizardcount != undefined) {
        //     for (let i = 0; i < ___wizardcount.length; i++) {
        //         if (i < 2) {
        //             ___wizardcount[i].parentNode.classList.add('past');
        //         }
        //         if (i == 2) {
        //             ___wizardcount[i].parentNode.classList.add('active');
        //         }
        //     }
        // }

        // if (___div != null || ___div != undefined) {
        //     ___div.classList.remove('active');
        //     ___div.classList.add('text-primary');
        // }

        function readyforInspection(){
            let r = confirm('Are you sure you want to submit this requirements?');
            if(r){
                $.ajax({
						// url: "{{asset('check/ltoannexs/')}}",
						url: '{{asset('check/ltoannexs/'.$appid)}}',
						dataType: "json", 
	    				async: false,
						method: 'POST',
						data: {},
						data: {_token:$("input[name=_token]").val()},
						success: function(a){
                            if(a.filled == "succ"){
                                $.ajax({
                                    method:"POST",
                                    data:{_token:$("input[name=_token]").val(),readyNow:true},
                                    success:function(a){
                                        if(a == 'succ'){
                                            @if($subclass == 'ND')
                                                 var r = confirm('This applciation is DOH Retained. You will proceed to home.');
                                                 if (r == true) { window.location.href = "{{url('client1/apply')}}" };
                                            @else

                                            var r = confirm('Requirements submitted. Proceed to Payment Method?');
                                            if (r == true) { window.location.href = "{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$appid)}}" };

                                            @endif
                                          
                                        }
                                    }
                                })
                            }else{
                                alert(a.filled)
                            }
                            
							
						}
				});
            }
        }

        function loadData(lString, asset) {
            if (lString != null || lString != "") {
                sesslString = lString;
                insDataFunction([
                        ['_token', 'rTbl[]', 'rId[]', 'rTbl[]', 'rId[]', 'rTbl[]', 'rId[]'],
                        [document.getElementsByName('_token')[0].value, 'type', sesslString, 'ltotype', lData, 'app_id', cAppid]
                    ], '{{asset('client1/request/app_upload')}}', 'POST', {
                        functionProcess: function(arr) {
                            if (loadHere != null || loadHere != undefined) {
                                loadHere.innerHTML = "";
                                if (arr.length > 0) {
                                    for (let i = 0; i < arr.length; i++) {
                                        let spl = (arr[i]['filepath']).split('/');
                                        loadHere.innerHTML += '<tr><td>' + ((spl.length > 0) ? spl[spl.length - 1] : 'No file uploaded.') + '</td></tr>';
                                    }
                                } else {
                                    loadHere.innerHTML = '<tr><td colspan="1">No file(s) uploaded.</td></tr>';
                                }
                            }
                        }
                    });

                // kanglloydni
                
                // endkanglloydni
            }
        }

        function upData() {
            insErrMsg('warning', 'Sending request');
            insDataFunction([
                    ['_token', 'filepath', 'type', 'ltotype', 'appid'],
                    [document.getElementsByName('_token')[0].value, document.getElementById('filepath').files[0], sesslString, lData, cAppid]
                ], '{{asset('client1/request/customQuery/fUploads')}}', 'POST', {
                    functionProcess: function(arr) {
                        if (arr == true) {
                            loadData(sesslString);
                            insErrMsg('success', 'Successfully sent request.');
                        } else {
                            loadData(sesslString);
                            insErrMsg('danger', arr);
                        }
                    }
                });
        }
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script> --}}

    @if(! isset($hideExtensions)) 
        @include('client1.cmp.footer') 
        <script>
            onStep(3);
        </script>
    @endif
</body>
@endsection