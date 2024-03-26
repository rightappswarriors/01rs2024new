@if (session()->exists('employee_login'))  
@extends('mainEmployee')
@section('title', 'Monitoring')
@section('content')
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
           Monitoring Tool
           <a title="Add New Monitoring" data-toggle="modal" data-target="#monModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover" style="font-size: 13px;" id="example">
          <thead>
            <tr>
              <th scope="col" >Name of Facility</th>
              <th scope="col" >Location/ <br>Address</th>
              <th scope="col" >Status</th>
              <th scope="col" >FDA Issued</th>
              <th scope="col" >Action</th>
            </tr>
          </thead>
          <tbody>
            @isset($entries)
              @foreach($entries as $key)
                <tr class="">
                  <td class="font-weight-bold">{{$key->facilityname}}</td>
                  <td>{{AjaxController::getFacilityAddress($key->appid)}}</td>
                  <td class="font-weight-bold">{{$key->trns_desc}}</td>
                  <td class="font-weight-bold">{{$key->certtype}}</td>
                  <td class="font-weight-bold">
                    <a class="btn btn-outline-primary" href="{{url('employee/dashboard/processflow/FDA/monitoring/'.$selected.'/'.$key->fdamon)}}"><i class="fa fa-fw fa-clipboard-check"></i></a>
                  </td>
                </tr>
              @endforeach
            @endisset
          </tbody>
        </table>
      </div>
    </div>
  </div>  

  {{-- Monitoring Identification --}}
  <div class="modal fade" id="monModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center">
            <strong>Add New Facilities To Monitor</strong> 
            <span class="btn button-outline-primary" data-toggle="tooltip" title="" data-html="true" style="cursor: pointer" data-original-title="<b style='color:yellow'>WARNING</b>, Submitting new facilities is irreversible.">
              <i class="fa fa-question-circle" aria-hidden="true"></i>
            </span>
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form method="POST" action="{{url('employee/dashboard/processflow/FDA/monitoring/'.$selected)}}">

                {{csrf_field()}}
                <input type="hidden" name="action" value="submitMonitor">
                {{-- address of faci --}}
                <div class="row">
                  <div class="col-sm-4">
                    Location:{{-- <span style="color:red">*</span> --}}
                  </div>

                  <div class="col-sm-8">
                    <input type="hidden" name="address_of_faci" class="form-control form-inline w-100" readonly id="facaddr">
                    <div class="row mb-1" hidden>
                      <div class="col-sm-6">
                        Region: <br>
                        <input class="form-control w-100" type="" name="" readonly id="facr">
                      </div>

                      <div class="col-sm-6">
                        Provice: <br>
                        <input class="form-control w-100" type="" name="" readonly id="facp">
                      </div>
                    </div>

                    <div class="row mb-1" hidden>
                      <div class="col-sm-6">
                        City/Municipality:<br>
                        <input class="form-control w-100" type="" name="" readonly id="facc">
                      </div>

                      <div class="col-sm-6" hidden>
                        Barangay: <br>
                        <input class="form-control w-100" type="" name="" readonly id="facb">
                      </div>
                    </div>

                    <div class="row mb-1">
                      <div class="col-sm-6">
                        Region: <br>
                        <select class="form-control" style="width: 100%" id="rgnid" name="rgnid" autocomplete="off" required>
                          <option selected disabled value hidden>Please select</option>
                          @if(count($region) > 0) @foreach($region AS $each)
                          <option value="{{$each->rgnid}}">{{$each->rgn_desc}}</option>
                          @endforeach @endif
                        </select>
                      </div>

                      <div class="col-sm-6">
                       Province: <br>
                        <select class="form-control" style="width: 100%" id="provid" name="provid" autocomplete="off" required>
                          <option selected disabled value hidden>Please select</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-1">
                      <div class="col-sm-12">
                        City/Municipality: <br>
                        <select style="width: 100%" class="form-control" id="cmid" name="cmid" autocomplete="off" required>
                          <option selected disabled value hidden>Please select</option>
                        </select>
                      </div>

                      <div class="col-sm-6" hidden>
                        Barangay: <br>
                        <select style="width: 100%" class="form-control" id="brgyid" name="brgyid" autocomplete="off">
                          <option selected disabled value hidden>Please select</option>
                        </select>
                      </div>
                    </div>



                  </div>


                </div>

                {{-- Criteria --}}
                <div class="row mb-3 mt-3">
                  <div class="col-sm-4">
                    Facilities on Area:<span style="color:red">*</span>
                  </div>

                  <div class="col-sm-8">
                    <select name="faci" class="form-control w-100" id="facilityOnArea" data-parsley-required-message="<b>*Type of Facility</b> required" required data-parsley="facilityOnArea" required>  
                      <option disabled hidden selected value="">Please Select</option>
                     
                    </select>
                  </div>
                </div>

                <hr>

                <div class="mx-auto">
                  <button type="submit" class="btn btn-primary" name="btn_sub"><b>SUBMIT</b></button>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function submitprompt(children) {
      if(document.getElementById('factype').value == "") {
        document.getElementById('prmsg').innerHTML = "<b>Please select a facility before submitting.</b>";
        document.getElementById('prdisplay').innerHTML = "";
        document.getElementById('prsubmit').hidden=true;
        document.getElementById('prclose').hidden=false;
      } else if(document.getElementById('facName').children[0].value=="") {
        document.getElementById('prmsg').innerHTML = "<b>There are no available facility/s.</b>";
        document.getElementById('prdisplay').innerHTML = "";
        document.getElementById('prsubmit').hidden=true;
        document.getElementById('prclose').hidden=false;
      } else {
        document.getElementById('prsubmit').hidden=false;
        document.getElementById('prclose').hidden=true;
        document.getElementById('prmsg').innerHTML = "<b>Add these following facilities to monitor: </b>";
        document.getElementById('p_sappid').value = document.getElementById('e_sappid').value;
        document.getElementById('p_date').value = document.getElementById('e_date').value;
        document.getElementById('prfactype').value = document.getElementById('factype').value;

        var display = "";
        Array.from(children).forEach(function(v) {
          display += v.text + " " + "<br>";
        });

        document.getElementById('prdisplay').innerHTML = display;
      }
      
    }
  </script>

  {{-- Monitoring Evaluate --}}
  <div class="modal fade" id="eMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Monitoring</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="">
              {{csrf_field()}}

              {{-- hfsrbno --}}
              <input class="form-control w-100" type="" name="hfsrbno" id="hfsrbno" hidden>

              {{-- nov --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  NOV Reference number:
                </div>

                <div class="col-sm-7 w-100">
                  <input class="form-control w-100" type="" name="edit_nov" id="edit_nov" readonly>
                </div>
              </div>

              {{-- date issued --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                    Date Added:
                </div>

                <div class="col-sm-7 w-100">
                    <input class="form-control w-100" type="" name="edit_date" id="edit_date" readonly>
                </div>
              </div>

              {{-- name --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  Name of Facility:
                </div>

                <div class="col-sm-7 w-100" colspan="12">
                  <input class="form-control w-100" type="" name="edit_name" id="edit_name" readonly>
                </div>
              </div>

              {{-- type --}}
              <div class="row mb-3">
                <div class="col-sm-5 w-100">
                  Type of Facility:
                </div>

                <div class="col-sm-7 w-100">
                  <input class="form-control w-100" type="" name="edit_type" id="edit_type" readonly>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  {{-- <button type="button" class="btn btn-outline-success w-100"><center>Save</center></button> --}}
                </div>
                <div class="col" colspan="6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Monitoring Team --}}
  <div class="modal fade" id="sMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Team</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="">
              
              <div class="row mt-3">
                <div class="col-sm-5">
                  Teams:
                </div>
                <div class="col-sm-7">
                  <input readonly id="steam" class="form-control w-100">
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-sm-12">
                  Members:
                </div>
                <div class="col-sm-12">
                  <select readonly class="form-control w-100" id="smember" multiple rows="5" disabled></select>
                </div>
              </div>

              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col-sm-6">
                  {{-- <button type="button" class="btn btn-outline-success w-100"><center>Save</center></button> --}}
                </div>
                <div class="col-sm-6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function sendRequestRetArr(arr_data, loc, type, bolRet, objFunction) {
      console.log("this is")
      try {
        type = type.toUpperCase();
        var xhttp = new XMLHttpRequest();
        if(bolRet == true) {
          xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                objFunction.functionProcess(JSON.parse(this.responseText));
              }
          };
        }
        xhttp.open(type, loc, bolRet);
        if(type != "GET") {
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send(arr_data.join('&'));
        } else {
          xhttp.send();
        }
        if(bolRet == false) {
          objFunction.functionProcess(JSON.parse(xhttp.responseText));
          _hasReturned = 1;
        }
      } catch(errMsg) {
        console.log(errMsg);
        }
    }


    let _obj = {rgnid: "province", provid: "city_muni", cmid: "barangay"}, _arrName = {rgnid: "provid", provid: "cmid", cmid: "brgyid"}, _arrCol = {rgnid: ["provid", "provname"], provid: ["cmid", "cmname"], cmid: ["brgyid", "brgyname"]}, _arrQCol = {rgnid: "rgnid", provid: "provid", cmid: "cmid"}, _allObj = ["rgnid", "provid", "cmid", "brgyid"];
      for(let i = 0; i < _allObj.length; i++) {
        if(document.getElementsByName(_allObj[i])[0] != undefined || document.getElementsByName(_allObj[i])[0] != null) {
          document.getElementsByName(_allObj[i])[0].addEventListener('change', function() {
            procAfter(this.name);
          });
        }
      }

      function procAfter(tName) {
   
        if(tName in _arrName) {
          let curDom = document.getElementsByName(_arrName[tName])[0], curInOf = _allObj.indexOf(tName);
          curDom.classList.add('loading');
          if(curInOf > -1) {
            for(var i = (curInOf + 1); i < _allObj.length; i++) {
              document.getElementsByName(_allObj[i])[0].innerHTML = '<option value hidden selected disabled>Please select</option>';
            }
          }
          // console.log("obsss")
          // console.log(_obj[tName])
          sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_arrQCol[tName], "rId="+document.getElementsByName(tName)[0].value], "{{asset('client1/request')}}/"+_obj[tName], "POST", true, {
            functionProcess: function(arr) {            
              if(curDom != undefined || curDom != null) {
                curDom.innerHTML = '<option value hidden selected disabled>Please select</option>';
                arr.forEach(function(a, b, c) {
                  curDom.innerHTML += '<option value="'+a[_arrCol[tName][0]]+'">'+a[_arrCol[tName][1]]+'</option>';
                });
                curDom.classList.remove('loading');
                canProc = 1;
              }
            }
          });
        }
      }


      $('#cmid').change(function(event) {
        console.log("this is")
        $("#facilityOnArea").empty();
        var el = new Option('', '');
        $(el).html('Please Select');
        $("#facilityOnArea").append(el);
        $.ajax({
          method: 'POST',
          data: {_token: '{{csrf_token()}}', action: 'getList', cmid: $('#cmid').val()},
          success: function(a){
            for (var i = 0; i < a.length; i++) {
              var o = new Option(a[i]['appid'], a[i]['appid']);
              $(o).html(a[i]['facilityname']);
              $("#facilityOnArea").append(o);
            }
          }
        })


        $("#cmidVal").val($(this).val());
      });

      $("table").DataTable();
  </script>
  
  {{-- @include('employee.cmp._othersJS') --}}
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif