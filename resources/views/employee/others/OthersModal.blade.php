{{-- ////////////////////  Lloyd - Nov 22, 2018 ////////////////// --}}
  {{-- Request Assistance / Complaints --}}
  <!--<div class="modal fade" id="reqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content " style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Add New Request/Complaints</strong></h5>
                <hr>
                <div class="container">
                  <div class="card-body">
                    <div class="container">
                      <br>
                      @isset($ROAData)
                        <form class="container" method="POST" action="{{asset('employee/dashboard/others/req_submit').'/'.count($ROAData)}}" id="r-others-form">
                          {{csrf_field()}}
                          {{-- ref no --}}
                          @isset($FormData)
                            <div class="input-group form-inline mb-1">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1-ref_no">Reference No. *</span>
                              </div>
                              <input type="number" name="ref_no" class="form-control form-inline" required>
                            </div>
                          @endisset
                          {{-- date --}}
                          <div class="input-group form-inline mb-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1-req_date">Date *</span>
                            </div>
                            <input type="date" name="req_date" class="form-control form-inline" placeholder="date" value="{{date("Y-m-d")}}"required>
                          </div>
                          <hr>
                          {{-- name --}}
                          <div class="input-group form-inline mb-1 mt-5">
                            <input type="text" name="name_of_comp" class="form-control form-inline" placeholder="Name of Client/Complainant *" required>
                          </div>
                          {{-- age --}}
                          <div class="input-group form-inline mb-1">
                            <input type="number" name="age" class="form-control form-inline" placeholder="Age *" required >
                          </div>
                          {{-- gender --}}
                          <div class="input-group form-inline mb-1">
                            <select type="" name="gender" class="form-control" required>
                              <option disabled selected value="0"><span class="text-success"><i>Gender *</i></span></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Others">Others</option>
                            </select>
                          </div>
                          {{-- address --}}
                          <div class="input-group form-inline mb-1">
                            <input type="" name="address" class="form-control form-inline" placeholder="Address *" required>
                          </div>
                          {{-- civil stats --}}
                          <div class="input-group form-inline mb-1">
                            <select type="" name="civ_stat" class="form-control" required>
                              <option disabled selected value="0">Civil Status *</option>
                              <option value="Single">Single</option>
                              <option value="Married">Married</option>
                              <option value="Divorced">Divorced</option>
                              <option value="Separeted">Separeted</option>
                              <option value="Widowed">Widowed</option>
                            </select>
                          </div>
                          {{-- contact no. --}}
                          <div class="input-group form-inline mb-1">
                            <input type="number" name="contact_no" class="form-control form-inline" placeholder="Contact No. *">
                          </div>

                          <hr>

                          {{-- name of faci --}}
                          <div class="input-group form-inline mb-1">
                            <select type="" name="name_of_faci" class="form-control" onchange="changeFaci()" id="facName" required>
                              <option disabled hidden selected value="0">Name of Facility *</option>
                              @isset($FacName)
                                @foreach($FacName as $key => $value)
                                  @if($value->facilityname!="")
                                    <option value="{{$value->appid}}">{{$value->facilityname}}</option>
                                  @endif
                                @endforeach
                              @endisset
                            </select>
                          </div>

                          {{-- type of faci --}}
                          <div class="input-group form-inline mb-1">
                            {{-- <input type="text" name="type_of_faci" class="form-control form-inline" placeholder="Type of Facility *" required> --}}
                            {{-- <select name="type_of_faci" class="form-control" id="factype" onchange="changeFaciType()">
                              <option diabled hidden selected value="">Type of Facility*</option>
                            </select> --}}
                            <textarea class="form-control" rows="5" name="type_of_faci" id="factype" onchange="changeFaciType()" readonly placeholder="Facilities"></textarea>
                          </div>

                          {{-- address of faci --}}
                          <div class="input-group form-inline mb-1">
                            <input type="text" name="address_of_faci" class="form-control form-inline" placeholder="Address of Facility *" readonly required id="facaddr">
                          </div>

                          <hr>

                          {{-- conf pat --}}
                          <div class="input-group form-inline mb-1">
                            <input type="text" name="name_of_conf_pat" class="form-control form-inline" placeholder="Name of Confined Patient (if applicable)" oninput="toggleDate(this)">
                          </div>

                          {{-- conf date --}}
                          <div class="input-group form-inline mb-1">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1-date_of_conf_pat">Date of Patient Confined</span>
                            </div>
                            <input type="date" name="date_of_conf_pat" id="conf-date" class="form-control form-inline" readonly>
                          </div>

                          <hr>

                          <input value="Request" type="checkbox" checked data-toggle="toggle" data-on="Request For Assistance&nbsp;{{'<i class="fa fa-caret-right" aria-hidden="true"></i>'}}" data-off="{{'<i class="fa fa-caret-left" aria-hidden="true"></i>'}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Complaints&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-onstyle="primary" data-offstyle="success" data-width="180" onchange="naturechange()" id="togBtn">

                          <input type="hidden" name="type" id="hidType" value="Request">

                          {{-- reqs --}}
                          <div id="reqsdiv">
                            <h5 class="modal-title text-center mb-3"><strong>Request for Assistance *</strong></h5>
                            @isset($ROAData)
                              @for($i=0; $i<count($ROAData); $i++)
                                  <input type="checkbox" name="reqs[]" @if($i==count($ROAData)-1) {{-- onclick="toggleForm(this)" --}} @endif value="{{$i+1}}">
                                  {{$ROAData[$i]->rq_desc}} <br>
                                  @if($i==count($ROAData)-1)
                                    <textarea class="form-control" name="ot_text" id="ot-others1"></textarea>
                                  @endif
                              @endfor
                            @endisset
                          </div>

                          {{-- comps --}}
                          <div id="compsdiv" hidden>
                            <h5 class="modal-title text-center mb-3"><strong>Nature of Complaint *</strong></h5>
                            @isset($CompData)
                              @for($i=0; $i<count($CompData); $i++)
                                  <input type="checkbox" name="comps[]" @if($i==count($CompData)-1) {{-- onclick="toggleForm(this)" --}} @endif value="{{$i+1}}" disabled>
                                  {{$CompData[$i]->cmp_desc}} <br>
                                  @if($i==count($CompData)-1)
                                    <textarea class="form-control" name="ot_text" id="ot-others2"  disabled></textarea>
                                  @endif
                              @endfor
                            @endisset
                          </div>
                          <hr>

                          {{-- sign --}}
                          <div class="input-group form-inline mb-1">
                            <input type="" name="signature" class="form-control form-inline" placeholder="Client's/Complainant's Name and Signature *" required>
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon1-signature"></span>
                            </div>
                          </div>

                          <hr>
                          <div class="mx-auto">
                            <button type="submit" name="btn_sub" class="btn btn-primary"><b>SUBMIT</b></button>
                          </div>
                        </form>
                      @endisset
                    </div>  {{-- end of form div --}}
                  {{-- <button data-toggle="modal" data-target="#myModal">Press to Open Modal</button>  --}}       
                  </div>
                </div>
               </div>
            </div>
        </div>
  	</div>
  </div>-->

  {{-- ////////////////////  Lloyd - Dec 7, 2018 ////////////////// --}}
  {{-- Surveillance --}}
  <!--<div class="modal fade" id="survModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Add New Surveillance</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-5">
            <div class="container">
              <div class="card-body">
                <div class="container">
                  
                  <form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_submit')}}">

                    {{csrf_field()}}

                    <input type="hidden" name="e_sappid" id="e_sappid">

                    {{-- Name of Facility --}}
                    <div class="input-group form-inline mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Name of Facility*</span>
                      </div>
                      <select name="name_of_faci" class="form-control" onchange="changeFaci()" id="facName" required>
                        <option disabled hidden selected value="0"></option>
                        @isset($FacName)
                          @foreach($FacName as $key => $value)
                            @if($value->facilityname!="")
                              <option value="{{$value->appid}}">{{$value->facilityname}}</option>
                            @endif
                          @endforeach
                        @endisset
                      </select>
                      {{-- type of faci --}}
                      {{-- <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Type of Facility*</span>
                      </div>
                      <select name="type_of_faci" class="form-control" id="factype" onchange="changeFaciType()">
                        <option diabled hidden selected value=""></option>
                      </select> --}}
                    </div>

                    {{-- type of faci --}}
                    <div class="input-group form-inline mb-1">
                      <textarea class="form-control" rows="5" name="type_of_faci" id="factype" onchange="changeFaciType()" readonly placeholder="Facilities"></textarea>
                    </div>

                    {{-- address of faci --}}
                    <div class="input-group form-inline mb-1">
                      <input type="text" name="address_of_faci" class="form-control form-inline" placeholder="Address of Facility *" readonly required id="facaddr">
                    </div>
                    <hr>

                    {{-- Offense --}}
                    <div class="border border-dark p-3 row">
                      <div class="col">
                        <input type="radio" name="offense[]" value="1st Offense">
                        1st Offense
                      </div>
                      <div class="col">
                        <input type="radio" name="offense[]" value="2nd Offense">
                        2nd Offense
                      </div>
                      <div class="col">
                        <input type="radio" name="offense[]" value="3rd Offense">
                        3rd Offense
                      </div>
                    </div>

                    <hr>

                    {{-- Recommendation --}}
                    <div class="border border-dark p-4" style="border-width: 3px !important;">
                      <p><b>RECOMMENDATION:</b></p>
                      <h5 class="text-light">The written explanation submitted in compliance to the HFSRB NOV No. 
                        <input type="" name="hfsrbno" class="form-control" placeholder="HFSRB NOV No.*" required>
                        issued last <input type="date" name="date_issued" class="form-control" required>, a copy attached for your reference, was evaluated based only on its technical merits. We therefore recommend:
                      </h5> 
                    </div>
                      
                    <div class="input-group form-inline mb-1 mt-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Recommendation/s*</span>
                      </div>
                      <select name="recommendation" class="form-control" onchange="showHiddenInRecommendation(this)" required>
                        <option selected hidden disabled value="0"></option>
                        @isset($AllRec)
                          @foreach($AllRec as $key => $value)
                            <option value="{{$value->rec_id}}">{{$value->rec_desc}}</option>
                          @endforeach
                        @endisset
                        {{-- <option value="1">Lifting of the CDO and Suspension Order</option>
                        <option value="2">Payment of Fine amounting to</option>
                        <option value="3">Suspension of License/Accreditation for a period of</option>
                        <option value="4">Revocation of License/Accreditation</option>
                        <option value="5">Others:</option> --}}
                      </select>
                    </div>

                    {{-- hidden --}}
                    <div class="input-group form-inline mb-1" id="payment" hidden>
                      <input type="" name="payment" class="form-control" placeholder="Fine amount" disabled>
                    </div>
                    <div class="input-group form-inline mb-1" id="suspension" hidden>
                      <input type="" name="suspension" class="form-control" placeholder="Suspension period" disabled>
                    </div>
                    <div class="input-group form-inline mb-1" id="s_rec_others" hidden>
                      <textarea row="5" name="s_rec_others" class="form-control" placeholder="Specify" disabled></textarea>
                    </div>

                    <hr>

                    {{-- signature --}}
                    <p><b>SIGNED BY MONITORING TEAM MEMBERS:</b></p>
                    <div id="s_sign">
                      <div class="input-group form-inline mb-1" id="s_sign_0">
                        <select name="signs[]" class="form-control" id="s_signatures_0_0">
                          <option hidden required selected value=""></option>
                        </select>
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button" onclick="addMonitoringMember()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                        <div class="input-group-append" id="minusButton" hidden>
                          <button class="btn btn-danger" type="button" onclick="removeMonitoringMember(this)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        </div>
                      </div>
                    </div>

                    <hr>

                    {{-- Date recommended --}}
                    <div class="input-group form-inline mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Date Recommended</span>
                      </div>
                      <input type="date" name="date_recom" class="form-control" value="{{date("Y-m-d")}}" required>
                    </div>

                    <br>
                    <hr>
                    <br>

                    {{-- verdict --}}
                    <p><b>RECOMMENDATION IS HEREBY:</b></p>
                    <div class="input-group form-inline mb-1">
                      <select name="verdict" class="form-control" onchange="showHiddenInVerdict(this)" required>
                        <option selected hidden disabled value="0"></option>
                        <option value="approved">Approved</option>
                        <option value="notapproved">Not Approved</option>
                        <option value="ot">Others:</option>
                      </select>
                    </div>
                    {{-- hidden --}}
                    <div class="input-group form-inline mb-1" id="s_ver_others" hidden>
                      <textarea type="" name="s_ver_others" class="form-control" placeholder="Specify" disabled></textarea>
                    </div>

                    <hr>

                    <div class="mx-auto">
                      <button type="submit" name="btn_sub" class="btn btn-primary"><b>SUBMIT</b></button>
                    </div>
                  </form> 
                </div>
              </div>
            </div>     
          </div>
        </div>
      </div>
    </div>
  </div>-->

{{-- Monitoring --}}
<!--<div class="modal fade" id="monModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content " style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
        <h5 class="modal-title text-center"><strong>Add New Monitoring</strong></h5>
        <hr>
        <div class="input-group form-inline mb-1 mt-5">
          <div class="container">
            <div class="card-body">
              <div class="container">
                
                <form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_submit')}}">

                  {{csrf_field()}}

                  {{-- Name of Facility --}}
                  <div class="input-group form-inline mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Name of Facility*</span>
                    </div>
                    <select name="name_of_faci" class="form-control" onchange="changeFaci()" id="facName" required>
                      <option disabled hidden selected value="0"></option>
                      @isset($FacName)
                        @foreach($FacName as $key => $value)
                          @if($value->facilityname!="")
                            <option value="{{$value->appid}}">{{$value->facilityname}}</option>
                          @endif
                        @endforeach
                      @endisset
                    </select>
                    {{-- type of faci --}}
                    {{-- <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Type of Facility*</span>
                    </div>
                    <select name="type_of_faci" class="form-control" id="factype" onchange="changeFaciType()">
                      <option diabled hidden selected value=""></option>
                    </select> --}}
                  </div>

                  {{-- type of faci --}}
                  <div class="input-group form-inline mb-1">
                    <textarea class="form-control" rows="5" name="type_of_faci" id="factype" onchange="changeFaciType()" readonly placeholder="Facilities"></textarea>
                  </div>

                  {{-- address of faci --}}
                  <div class="input-group form-inline mb-1">
                    <input type="text" name="address_of_faci" class="form-control form-inline" placeholder="Address of Facility *" readonly required id="facaddr">
                  </div>
                  <hr>

                  {{-- Offense --}}
                  <div class="border border-dark p-3 row">
                    <div class="col">
                      <input type="radio" name="offense[]" value="1st Offense">
                      1st Offense
                    </div>
                    <div class="col">
                      <input type="radio" name="offense[]" value="2nd Offense">
                      2nd Offense
                    </div>
                    <div class="col">
                      <input type="radio" name="offense[]" value="3rd Offense">
                      3rd Offense
                    </div>
                  </div>

                  <hr>

                  {{-- Recommendation --}}
                  <div class="border border-dark p-4" style="border-width: 3px !important;">
                    <p><b>RECOMMENDATION:</b></p>
                    <h5 class="text-light">The written explanation submitted in compliance to the HFSRB NOV No. 
                      <input type="" name="hfsrbno" class="form-control" placeholder="HFSRB NOV No.*" required>
                      issued last <input type="date" name="date_issued" class="form-control" required>, a copy attached for your reference, was evaluated based only on its technical merits. We therefore recommend:
                    </h5> 
                  </div>
                    
                  <div class="input-group form-inline mb-1 mt-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Recommendation/s*</span>
                    </div>
                    <select name="recommendation" class="form-control" onchange="showHiddenInRecommendation(this)" required>
                      <option selected hidden disabled value="0"></option>
                      @isset($AllRec)
                        @foreach($AllRec as $key => $value)
                          <option value="{{$value->rec_id}}">{{$value->rec_desc}}</option>
                        @endforeach
                      @endisset
                      {{-- <option value="1">Lifting of the CDO and Suspension Order</option>
                      <option value="2">Payment of Fine amounting to</option>
                      <option value="3">Suspension of License/Accreditation for a period of</option>
                      <option value="4">Revocation of License/Accreditation</option>
                      <option value="5">Others:</option> --}}
                    </select>
                  </div>

                  {{-- hidden --}}
                  <div class="input-group form-inline mb-1" id="payment" hidden>
                    <input type="" name="payment" class="form-control" placeholder="Fine amount" disabled>
                  </div>
                  <div class="input-group form-inline mb-1" id="suspension" hidden>
                    <input type="" name="suspension" class="form-control" placeholder="Suspension period" disabled>
                  </div>
                  <div class="input-group form-inline mb-1" id="s_rec_others" hidden>
                    <textarea row="5" name="s_rec_others" class="form-control" placeholder="Specify" disabled></textarea>
                  </div>

                  <hr>

                  {{-- signature --}}
                  <p><b>SIGNED BY MONITORING TEAM MEMBERS:</b></p>
                  <div id="s_sign">
                    <div class="input-group form-inline mb-1" id="s_sign_0">
                      <select name="signs[]" class="form-control" id="s_signatures_0_0">
                        <option hidden required selected value=""></option>
                      </select>
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="addMonitoringMember()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                      </div>
                      <div class="input-group-append" id="minusButton" hidden>
                        <button class="btn btn-danger" type="button" onclick="removeMonitoringMember(this)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>

                  <hr>

                  {{-- Date recommended --}}
                  <div class="input-group form-inline mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">Date Recommended</span>
                    </div>
                    <input type="date" name="date_recom" class="form-control" value="{{date("Y-m-d")}}" required>
                  </div>

                  <br>
                  <hr>
                  <br>

                  {{-- verdict --}}
                  <p><b>RECOMMENDATION IS HEREBY:</b></p>
                  <div class="input-group form-inline mb-1">
                    <select name="verdict" class="form-control" onchange="showHiddenInVerdict(this)" required>
                      <option selected hidden disabled value="0"></option>
                      <option value="approved">Approved</option>
                      <option value="notapproved">Not Approved</option>
                      <option value="ot">Others:</option>
                    </select>
                  </div>
                  {{-- hidden --}}
                  <div class="input-group form-inline mb-1" id="s_ver_others" hidden>
                    <textarea type="" name="s_ver_others" class="form-control" placeholder="Specify" disabled></textarea>
                  </div>

                  <hr>

                  <div class="mx-auto">
                    <button type="submit" name="btn_sub" class="btn btn-primary"><b>SUBMIT</b></button>
                  </div>
                </form> 
              </div>
            </div>
          </div>     
        </div>
      </div>
    </div>
  </div>
</div>-->

  {{-- ////////////////////  Lloyd - Dec 10, 2018 ////////////////// --}}
  {{-- Surveillance Evaluate --}}
  <!--<div class="modal fade" id="eSurvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Evaluate Surveillance</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_edit')}}">
              {{csrf_field()}}

              {{-- hfsrbno --}}
              <input class="form-control w-100" type="" name="hfsrbno" id="hfsrbno" hidden>

              {{-- name --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Name of Facility:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_name" id="edit_name" readonly>
                </div>
              </div>

              {{-- type --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Type of Facility:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_type" id="edit_type" readonly>
                </div>
              </div>

              {{-- violation --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Violation:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_violation" id="edit_violation" readonly>
                </div>
              </div>

              {{-- recommendation --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Recommendation:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_recommendation" id="edit_recommendation" readonly>
                </div>
              </div>

              {{-- recommentaion-cont --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_recommendation_cont" id="edit_recommendation_cont" readonly>
                </div>
              </div>

              {{-- monitoring team --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Monitoring Team:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_monitoring" id="edit_monitoring" readonly>
                </div>
              </div>

              {{-- status --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  Status of Compliance:
                </div>
              </div>
              <div class="row mb-2">
                <div class="col w-100" colspan="12">
                  <select class="form-control w-100" type="" name="edit_status" id="edit_status" onchange="editSurvOthers(this)">
                    <option value="approved">Approved</option>
                    <option value="notapproved">Not Approved</option>
                    <option value="ot">Others:</option>
                  </select>
                </div>
              </div>
              {{-- hidden --}}
              <div class="input-group form-inline mb-1" id="edit_ver_others" hidden>
                <textarea type="" name="edit_ver_others" class="form-control" placeholder="Specify" disabled></textarea>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  <button type="submit" class="btn btn-outline-success w-100"><center>Save</center></button>
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Cancel</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>-->

  {{-- Surveillance Delete --}}
  <!--<div class="modal fade" id="dSurvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Delete Surveillance</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="{{asset('employee/dashboard/others/surv_delete')}}">
              {{csrf_field()}}

              {{-- hfsrbno --}}
              <input class="form-control w-100" type="" name="dhfsrbno" id="dhfsrbno" hidden>

              {{-- message --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  <center>Are you sure you want to delete <b><span style="color:red" id="delMsg"></span></b></center>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  <button type="submit" class="btn btn-outline-success w-100"><center>Yes</center></button>
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>No</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>-->

  {{-- ////////////////////  Lloyd - Dec 11, 2018 ////////////////// --}}
  {{-- ROA/Complaints View --}}
  <!--<div class="modal fade" id="vReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Request/Complaints</strong></h5>
          <hr>
          <div class="mb-1 mt-2 container">

            {{-- complainant/client --}}
            <div class="row mb-3">
              <div class="col-md-4 w-100">
                <span id="vcom"></span>
              </div>
              <div class="col-md-8 w-100">
                <span id="vcom_name"></span>
              </div>
            </div> 

            {{-- type --}}
            <div class="row mb-3">
              <div class="col-md-4 w-100">
                Type:
              </div>
              <div class="col-md-8 w-100">
                <span id="vtype"></span>
              </div>
            </div> 

            {{-- name --}}
            <div class="row mb-3">
              <div class="col-md-4 w-100">
                Name of Facility:
              </div>
              <div class="col-md-8 w-100">
                <span id="vname"></span>
              </div>
            </div>

            {{-- type of faci --}}
            <div class="row mb-3">
              <div class="col-md-4 w-100">
                Type of Facility:
              </div>
              <div class="col-md-8 w-100">
                <span id="vtypef"></span>
              </div>
            </div>

            {{-- reqs/comps --}}
            <div class="row mb-2">
              <div class="col-md-4 w-100">
                <span id="rc"></span>
              </div>
              <div class="col-md-8 w-100">
                <textarea type="" name="edit_ver_others" class="form-control w-100" placeholder="Requests/Complaints" id="rqtextarea" disabled></textarea>
              </div>
            </div>
            {{-- submit btn --}}
            <div class="row mt-3">
              <div class="col-md-6 w-100">
                &nbsp;
              </div>
              <div class="col-md-6 w-100">
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>-->

  {{-- ROA/Complaints Delete --}}
  <!--<div class="modal fade" id="dReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Delete Request/Complaints</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="{{asset('employee/dashboard/others/reqcomp_delete')}}">
              {{csrf_field()}}

              {{-- refno --}}
              <input class="form-control w-100" type="" name="dref_no" id="dref_no" hidden>

              {{-- message --}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  <center>Are you sure you want to delete <b><span style="color:red" id="delrcMsg"></span></b></center>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  <button type="submit" class="btn btn-outline-success w-100"><center>Yes</center></button>
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>No</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>-->