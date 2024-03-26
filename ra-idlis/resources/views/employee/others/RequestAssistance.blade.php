@if(session()->exists('employee_login'))
@extends('mainEmployee')

@section('title', 'Request Assistance/Compaints')
<style>
  .select2-selection {
    width: 100% !important;
  }
</style>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> -->


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@php
    $employeeData = session('employee_login');
    $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';

    $rgnid = $grpid == 'NA'? null : $employeeData->rgnid;
@endphp

@section('content')
  {{-- {{dd((array) DB::table('req_ast_form')->where('ref_no', '2')->first())}} --}}


  <div class="content p-4" >

    <div class="card" >

      <div class="card-header bg-white font-weight-bold">

         Complaint/Request For Assistance

         <a href="#" style="float: right;" title="Add New Request/Complaints" data-toggle="modal" data-target="#reqModal" id="add_new_new"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>

      </div>

      <!-- <div class="card-body " style="font-size:13px;  min-height: 300px; "> -->
      @include('employee.tableDateSearch')
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
        <!-- <table class="table table-hover" style="font-size:13px;  min-height: 450px; " id="example"> -->

          <thead>

            <tr>

              <th scope="col" style="text-align: center; width:auto">Case No./<br>Ref No.</th>

              <!-- <th scope="col" style="text-align: center; width:auto">RGNID</th> -->
              <th scope="col" style="text-align: center; width:auto">Type</th>

              <th scope="col" style="text-align: center; width:auto">Name of Facility</th>

              <th scope="col" style="text-align: center; width:auto" class="w-25">Type of Facility</th>

              <th scope="col" style="text-align: center; width:auto" class="w-25">Date Received</th>

              <th scope="col" style="text-align: center; width:25%;" class="w-50">Nature of Complaint/<br>Request of Assistance</th>

              <th scope="col" style="text-align: center; width:auto;" class="w-50">Status</th>

              <th scope="col" style="text-align: center; width:auto;" class="w-50">Date <br> Resolved</th>

              <th scope="col" style="text-align: center; width:auto" class="w-25">Options</th>

            </tr>

          </thead>

          <tbody>

            @isset($AllData)

              @foreach($AllData as $all => $a)

                <tr style="z-index: 99999 !important;">

                  <form method="POST" action="{{asset('employee/dashboard/others/roacomplaints/manage')}}">

                    {{csrf_field()}}



                    <input type="hidden" name="ref_no" value="{{$a->ref_no}}">

                    <input type="hidden" name="type" value="{{$a->type}}">

                    <input type="hidden" name="name_of_comp" value="{{$a->name_of_comp}}">

                    <input type="hidden" name="age" value="{{$a->age}}">

                    <input type="hidden" name="civ_stat" value="{{$a->civ_stat}}">

                    <input type="hidden" name="address" value="{{$a->address}}">

                    <input type="hidden" name="gender" value="{{$a->gender}}">

                    <input type="hidden" name="req_date" value="{{$a->req_date}}">

                    <input type="hidden" name="contact_no" value="{{$a->contact_no}}">

                    <input type="hidden" name="appid" value="{{$a->appid}}">

                    <input type="hidden" name="name_of_faci" value="{{$a->name_of_faci}}">

                    <input type="hidden" name="type_of_faci" value="{{$a->type_of_faci}}">

                    <input type="hidden" name="address_of_faci" value="{{$a->address_of_faci}}">

                    <input type="hidden" name="name_of_conf_pat" value="{{$a->name_of_conf_pat}}">

                    <input type="hidden" name="date_of_conf_pat" value="{{$a->date_of_conf_pat}}">

                    <input type="hidden" name="reqs" value="{{$a->reqs}}">

                    <input type="hidden" name="comps" value="{{$a->comps}}">

                    <input type="hidden" name="signature" value="{{$a->signature}}">

                    <input type="hidden" name="isChecked" value="{{$a->isChecked}}">

                    <input type="hidden" name="actions" value="{{$a->actions}}">
                    
                    <input type="hidden" name="staff_name" value="{{$a->staff_name}}">
                    <input type="hidden" name="staff_position" value="{{$a->staff_position}}">
                    <input type="hidden" name="action2_text" value="{{$a->action2_text}}">
                    <input type="hidden" name="action3_text" value="{{$a->action3_text}}">


                    <td style="text-align:center">{{$a->ref_no}}</td>

                    <!-- <td style="text-align:center">{{$a->rgnid}}</td> -->

                    <td style="text-align:center">{{$a->type}}</td>

                    <td style="text-align:center">{{$a->name_of_faci}}</td>

                    <td style="text-align:center">{{$a->type_of_faci}}</td>

                    <td style="text-align:center"> {{ \Carbon\Carbon::parse($a->req_date)->format('M d, Y') }}</td>

                    <td style="text-align:center">

                      @if($a->type == "Assistance")

                        {{$a->reqs}}
                        {{-- @if(in_array(5, explode(',',$a->reqs)))
                          {{$a->others}}
                        @endif --}}

                      @else

                        {{$a->comps}}
                        {{-- @if(in_array(8, explode(',',$a->reqs)))
                          {{$a->others}}
                        @endif --}}

                      @endif

                    </td>

                    <td style="text-align:center" class="font-weight-bold">
                      @if(!isset($a->resolveDate))
                      @if($a->deleted == null)

                      @switch($a->isChecked)

                        @case(1)

                          Currently Surveyed

                        @break

                        @case(2)

                          Evaluated

                        @break

                        @default

                          On Process

                        @break

                      @endswitch

                      @else

                      <span class="text-danger">Deleted</span>

                      @endif
                      @else
                      <span class="text-success">Resolved</span>
                      @endif

                    </td>

                    <td style="text-align:center">
                      {{isset($a->resolveDate) ? Date('F j, Y',strtotime($a->resolveDate)) : 'Not yet Resolved'}}
                    </td>

                    <td style="text-align:center">

                      @if($a->deleted == null)

                      <div class="dropdown">
                      <!-- <div class="dropdown" style="z-index: 99999 !important; position: absolute"> -->

                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                          <i class="fa fa-align-justify"></i>

                        </button>

                        <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=" position: fixed; z-index: 1000"> -->
                        <!-- <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton" style="padding-left: 5px; z-index: 10 !important; position: relative"> -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  style="padding-left: 5px; margin-right:30px; position: relative; z-index: 1000" >
                        <!-- <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton" > -->

                          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#vReqModal" title="View {{$a->type}}" onclick="vReqComp('{{$a->ref_no}}', '{{$a->type}}', '{{$a->name_of_comp}}', '{{$a->appid}}', '{{$a->name_of_faci}}', '{{$a->type_of_faci}}', '{{$a->reqs}}', '{{$a->comps}}')">
                          
                            <i class="fa fa-fw fa-eye"></i>
                          </button>

                          <button class="btn btn-light" data-toggle="modal" data-target="#mReqModal" title="Manage {{$a->type}}" type="submit">

                            <i class="fa fa-fw fa-clipboard-check"></i>

                          </button>

                          <button type="button" onclick="act('ref_noDelete','{{$a->ref_no}}','{{$a->type}}')" class="btn btn-light" data-toggle="modal" data-target="#dReqModal" title="Cancel {{$a->type}}">

                            <i class="fa fa-fw fa-trash"></i>

                          </button> 

                          <button type="button" class="btn btn-light" title="Edit {{$a->type}}" data-toggle="modal" data-target="#reqModal" onclick="FillFields('{{json_encode($a)}}')">
                         
                            <i class="fa fa-fw fa-edit"></i>
                          </button>

                          <button type="button" class="btn btn-light" title="Edit Actions {{$a->type}}" data-toggle="modal" data-target="#actionstaken" onclick="ActionsTaken('{{json_encode($a)}}')">
                            <i class="fa fa-fw fa-cog"></i>
                          </button>

                          @if( $a->attachment)
                          <a target="_blank" href="{{ route('OpenFile', $a->attachment) }}" >
                          <button type="button" class="btn btn-light" title="Attachment {{$a->type}}" >
                            <i class="fa fa-fw fa-paperclip"></i>
                          </button>
                          </a>
                          @endif

                          @if(!$a->resolveDate)
                          <button type="button" onclick="act('ref_noResolve','{{$a->ref_no}}','{{$a->type}}')" class="btn btn-light" data-toggle="modal" data-target="#resolve" title="Resolve {{$a->type}}">

                            <i class="fa fa-fw fa-check"></i>

                          </button>
                          @endif

                          <button type="button" class="btn btn-light" title="Logs of {{$a->type}}" data-toggle="modal" data-target="#histLogs" onclick="getAllHistory('{{$a->ref_no}}', '{{$a->type}}')">
                            <i class="fa fa-fw fa-history"></i>
                          </button>
                        </div>
                      </div>
                      @else
                      <button type="button" class="btn btn-success btn-restore" title="Restore {{$a->name_of_comp}}" data-toggle="modal" data-target="#restoreEntry" restid="{{$a->ref_no}}" resttype="{{$a->type}}"><i class="fas fa-history"></i></button>
                      @endif

                      {{-- <center>

                        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#vReqModal" title="View {{$a->type}}" onclick="vReqComp('{{$a->ref_no}}', '{{$a->type}}', '{{$a->name_of_comp}}', '{{$a->appid}}', '{{$a->name_of_faci}}', '{{$a->type_of_faci}}', '{{$a->reqs}}', '{{$a->comps}}')">

                          <i class="fa fa-fw fa-eye"></i>

                        </button>



                        <button class="btn btn-outline-primary" data-toggle="modal" data-target="#mReqModal" title="Manage {{$a->type}}" type="submit">

                          <i class="fa fa-fw fa-clipboard-check"></i>

                        </button>



                        <button type="button" onclick="act('ref_noDelete','{{$a->ref_no}}','{{$a->type}}')" class="btn btn-outline-danger" data-toggle="modal" data-target="#dReqModal" title="Delete {{$a->type}}">

                          <i class="fa fa-fw fa-trash"></i>

                        </button> 

                        <button type="button" class="btn btn-outline-warning" title="Edit {{$a->type}}" data-toggle="modal" data-target="#reqModal" onclick="FillFields('{{json_encode($a)}}')">
                          
                          <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-outline-dark" title="Edit Actions {{$a->type}}" data-toggle="modal" data-target="#actionstaken" onclick="ActionsTaken('{{json_encode($a)}}')">
                          <i class="fa fa-fw fa-cog"></i>
                        </button>

                        @if(!$a->resolveDate)
                        <button type="button" onclick="act('ref_noResolve','{{$a->ref_no}}','{{$a->type}}')" class="btn btn-outline-success" data-toggle="modal" data-target="#resolve" title="Resolve {{$a->type}}">

                          <i class="fa fa-fw fa-check"></i>

                        </button>
                        @endif

                      </center> --}}

                    </td>

                  </form>

                </tr>

              @endforeach

            @endisset

          </tbody>      

        </table>      

      </div>

    </div>

  </div>

  <div class="modal fade" id="histLogs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"> 
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #C2CAD0; color: black;">
          <h5 class="modal-title text-center"><strong>History Logs</strong></h5>
          <hr>
          <div class="container">
            <div class="table-responsive">
              <table id="dataTable2">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Type</th>
                    <th>Name of Facility</th>
                    <th>Type of Facility</th>
                    <th>Date Received</th>
                    <th>Nature of Complaints/<br>Request of Assistance</th>
                    <!-- <th>Status</th> -->
                    <th>Date Resolved</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="restoreEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"> 
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Restore </strong></h5>
          <hr>
          <center>Are you sure you want to restore?</center>
          <form action="{{asset('employee/dashboard/others/restoreROAC')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="restore_id">
            <input type="hidden" name="restore_type">
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

  <script>

    let t1 = $('#dataTable2').DataTable(
    {
       "pageLength": 5 
    }
    );
    function getAllHistory(ref_no, type) {
      t1.clear().draw();

      $.ajax({
        type: 'get',
        url: '{{asset('employee/dashboard/others/getHistoryLogs')}}',
        data: {"ref_no":ref_no, "type":type},
        success: function(data) {
            
          for(i=0; i<data.length; i++) {
            let y = "";
            switch(data[i].isChecked) {
              case 1: y = "Currently Surveyed"; break;
              case 2: y = "Evaluated"; break;
              default: y = "On Process"; break;
            }

            console.log("data[i].resolveDate")
            console.log(data[i].resolveDate)
            t1.row.add(
              [
                data[i].action.toUpperCase(),
                data[i].type,
                data[i].name_of_faci,
                data[i].type_of_faci,
                data[i].req_date,
                data[i].comps+data[i].reqs,
                data[i].resolveDate,
                // y,
               
              ]
            ).draw();
          }
          
        },
      });
    }

    $('.btn-restore').on('click', function() {
      $('input[name="restore_id"]').val($(this).attr('restid'));
      $('input[name="restore_type"]').val($(this).attr('resttype'));
    });


    $('#add_new_new').on('click', function() {
      $('#modal_title_new').html('<b>Add new Request/Complaints<b>');

      for(i=0; i<$('input[name="comps[]"]').length; i++) {
        $('input[name="comps[]"]')[i].removeAttribute('checked');
      }
      for(i=0; i<$('input[name="reqs[]"]').length; i++) {
        $('input[name="reqs[]"]')[i].removeAttribute('checked');
      }

      togBtn.checked = true;
      naturechange();

      $('#r-others-form')[0].removeAttribute('action');
      $('#r-others-form')[0].setAttribute('action', '{{asset('employee/dashboard/others/req_submit/reg').'/'.count($ROAData)}}');
      // $('#r-others-form')[0].setAttribute('action', '{{asset('employee/dashboard/others/req_submit').'/'.count($ROAData)}}');

      $('input[name="ref_no_new_new"]').val('');

      $('input[name="source"]').val('');
      $('input[name="name_of_comp"]').val('');
      $('input[name="age"]').val('');
      $('select[name="gender"]').val('').trigger('change');
      $('input[name="address"]').val('');
      $('select[name="civ_stat"]').val('').trigger('change');
      $('input[name="contact_no"]').val('');
      $('input[name="email"]').val('');

      $('#xfacName').val('').trigger('change');
      $('#factype').val('').trigger('change');
      $('#facaddr').val('');

      $('#unregxfacName').val('');
      $('#unregfactype').val('').trigger('change');
      $('#unregfacaddr').val('');

      $('#name_of_conf_pat').val('');
      $('#date_of_conf_pat').val('');

      $('input[name="txt_details"]').val('');
      $('#ot-others2').val('');
      $('#ot-others').val('');

      $('#togBtn')[0].removeAttribute('hidden');
      $('#tog_tog_btn')[0].removeAttribute('hidden');

      $('#togBtn')[0].removeAttribute('disabled');
      $('#facitogBtn')[0].removeAttribute('disabled');
    });

   function setOthersourc(value){
    if(value == "Others"){
      document.getElementById("othersource").removeAttribute("hidden")
    }else{
      document.getElementById("othersource").setAttribute("hidden", true)
    }
   }

    function FillFields(data) {
      let d = JSON.parse(data);
      console.log(d)
      console.log(d.source)
      document.getElementById("source1").value = d.source;
     
      setOthersourc(d.source)
      console.log( d.sourceOthers)
      document.getElementById("othsrc").value = d.sourceOthers;
      // console.log(d);

      for(i=0; i<$('input[name="comps[]"]').length; i++) {
        $('input[name="comps[]"]')[i].removeAttribute('checked');
      }
      for(i=0; i<$('input[name="reqs[]"]').length; i++) {
        $('input[name="reqs[]"]')[i].removeAttribute('checked');
      }

      $('#modal_title_new').html('<b>Edit Request/Complaints<b>');
      $('#togBtn')[0].removeAttribute('disabled');
      $('#facitogBtn')[0].removeAttribute('disabled');

      // $('#r-others-form')[0].removeAttribute('action');

      setTimeout(function() {
        $('#r-others-form')[0].setAttribute('action', '{{asset('employee/dashboard/others/action/edit')}}^{{count($ROAData)}}');
      }, 250);

      $('input[name="ref_no_new_new"]').val(d.ref_no);

    
      $('input[name="source"]').val(d.source);
      $('input[name="name_of_comp"]').val(d.name_of_comp);
      $('input[name="age"]').val(d.age);
      $('select[name="gender"]').val(d.gender).trigger('change');
      $('input[name="address"]').val(d.address);
      $('input[name="address_of_faci"]').val(d.address_of_faci);
      $('select[name="civ_stat"]').val(d.civ_stat).trigger('change');
      $('input[name="contact_no"]').val(d.contact_no);
      $('input[name="email"]').val(d.compEmail);

      $('#xfacName').val(d.regfac_id).trigger('change');
      // $('#xfacName').val(d.appid).trigger('change');
      $('#factype').val(d.type_of_faci).trigger('change');
      // $('#factype').val(d.type_of_faci).trigger('change');
      // $('#facaddr').val(d.address_of_faci);

      

     

      $('#name_of_conf_pat').val(d.name_of_conf_pat);
      $('#conf-date').val(d.date_of_conf_pat);
      $('#txt_details').val(d.details);
      // $('#date_of_conf_pat').val(d.date_of_conf_pat);

      if(d.type=="Complaints") {
        $('#togBtn').bootstrapToggle('off');
        for(i=0; i<$('input[name="comps[]"]').length; i++) {
          // console.log($('input[name="reqs[]"]')[i].value);
          // console.log(x.includes($('input[name="reqs[]"]')[i].value))
          let x = d.x_comps.split(', ');
          if(x.includes($('input[name="comps[]"]')[i].value)) {
            $('input[name="comps[]"]')[i].setAttribute('checked', '');
          }

          $('#ot-others2').text(d.others);
        }
      } else {
        $('#togBtn').bootstrapToggle('on');
        for(i=0; i<$('input[name="reqs[]"]').length; i++) {
          // console.log($('input[name="reqs[]"]')[i].value);
          // console.log(x.includes($('input[name="reqs[]"]')[i].value))
          let x = d.x_reqs.split(', ');
          if(x.includes($('input[name="reqs[]"]')[i].value)) {
            $('input[name="reqs[]"]')[i].setAttribute('checked', '');
          }

          $('#ot-others1').text(d.others);
        }
      }

      if(d.appid == d.name_of_faci) {
        $('#facitogBtn').bootstrapToggle('off');
      } else {
        $('#facitogBtn').bootstrapToggle('on');
        let xval = d.select_type.original[0].uid+"^"+d.type_of_faci;
        console.log(xval);
        setTimeout(function() {
          $('select[name="type_of_faci"]').val(xval).trigger('change');
        }, 500);
      }

      $('textarea[name="txt_details"]').val(d.details);
        

      $('input[name="txt_details"]').val(d.details);

      // var togBtn = document.getElementById('togBtn');

      // if(d.type == "Complaints") {
      //   togBtn.checked = false;
      //   naturechange();
      // } else {
      //   togBtn.checked = true;
      //   naturechange();
      // }

      // $('#togBtn')[0].setAttribute('hidden', '');
      // $('#tog_tog_btn')[0].setAttribute('hidden', '');
      $('#r-others-form')[0].setAttribute('action', '{{asset('employee/dashboard/others/action/edit')}}^{{count($ROAData)}}');
      $('#togBtn')[0].setAttribute('disabled', '');
      $('#facitogBtn')[0].setAttribute('disabled', '');


      $('#unregxfacName').val(d.name_of_faci);
      $('#unregfactype').val(d.type_of_faci).trigger('change');
      $('#unregfacaddr').val(d.address_of_faci);
      // $('#togBtn')[0].disabled = true;
    }

    function customalert() {

      if (document.forms["sub"]["source"].value == ""

        || document.forms["sub"]["name_of_comp"].value == ""

        || document.forms["sub"]["age"].value == ""

        || document.forms["sub"]["gender"].value == ""

        || document.forms["sub"]["address"].value == ""

        || document.forms["sub"]["civ_stat"].value == ""

        || document.forms["sub"]["contact_no"].value == ""

        || document.forms["sub"]["email"].value == ""

        || ((document.forms["sub"]["togglefaci"].checked && 

          (document.forms["sub"]["name_of_faci"][1].value == ""

            || document.forms["sub"]["address_of_faci"][1].value == "")) 

          || (!document.forms["sub"]["togglefaci"].checked && 

            (document.forms["sub"]["name_of_faci"][0].value == ""

              || document.forms["sub"]["address_of_faci"][0].value == "")))) {

        return false;

      } else {

        Swal.fire({

          title: 'Do you want to add this entry?',

          type: 'warning',

          showCancelButton: true,

          confirmButtonColor: '#3085d6',

          cancelButtonColor: '#d33',

          confirmButtonText: 'Yes, add it!'

        }).then((result) => {

          if (result.value) {

            $.ajax({

              type: 'POST',

              url: $('#r-others-form').attr("action"),

              data: $("#r-others-form").serialize(), 

              //or your custom data either as object {foo: "bar", ...} or foo=bar&...

              success: Swal.fire({

                title: 'Added!',

                text: 'Your entry has been added.',

                type: 'success'

              }).then((result1) => {

                // console.log(result1.value);

                return result1.value;

              })

            });

          }

        })

      }

      return false;

    }

  </script>

  

  {{-- Request Assistance / Complaints --}}

  <div class="modal fade" id="reqModal"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content " style="border-radius: 0px;border: none;">

            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">

                <h5 class="modal-title text-center" id="modal_title_new"><strong>Add New Request/Complaints </strong></h5>

                <hr>

                  <div class="card-body">

                      <br>

                      @isset($ROAData)

                        <form class="container" enctype="multipart/form-data" name="sub" method="POST" action="{{asset('employee/dashboard/others/req_submit/reg').'/'.count($ROAData)}}" id="r-others-form"   data-parsley-validate>

                          {{csrf_field()}}

                          <input type="hidden" name="e_sappid" id="e_sappid">

                          {{-- ref no --}}

                          <!-- <input type="text" name="ref_no_new_new"> -->
                          <input type="hidden" name="ref_no_new_new">

                          @isset($FormData)

                            {{-- <div class="row mb-2">

                              <div class="col-sm-4">

                                Reference No.:
                                <!-- Reference No.:<span style="color:red">*</span> -->

                              </div>



                              <div class="col-sm-8">

                                <input type="number" name="ref_no" class="form-control" >
                                <!-- <input type="number" name="ref_no" class="form-control" required> -->

                              </div>

                            </div> --}}



                          @endisset

                          {{-- date --}}

                          {{-- <div class="row mb-2">

                            <div class="col-sm-4">

                              Date:<span style="color:red">*</span>

                            </div>



                            <div class="col-sm-8">

                              <input type="date" name="req_date" class="form-control form-inline" placeholder="date" value="{{date("Y-m-d")}}"required>

                            </div>

                          </div>

    

                          <hr> --}}



                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Source:
                              <!-- Source:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <!-- <input type="text" name="source" class="form-control form-inline" required data-parsley-required-message="<b>*Source</b> required" data-parsley=""> -->
                              <!-- <input type="text" name="source" class="form-control form-inline" required data-parsley-required-message="<b>*Source</b> required" data-parsley=""> -->
                              <select name="source" onchange="setOthersourc(this.value)" id="source1" class="form-control form-inline"  data-parsley="">
                              <!-- <select name="source" id="source1" class="form-control form-inline" required data-parsley-required-message="<b>*Source</b> required" data-parsley=""> -->
                                    <option value="Email">Email</option>
                                    <option value="Walk In">Walk In</option>
                                    <option value="Other Offices">Referred from Other Offices</option>
                                    <option value="Others">Others please specify</option>
                              </select>
                            </div>
                            

                          </div>

                          <div class="row mb-2" hidden id="othersource">
                              <div class="col-sm-4">

                              Other Source:
                              <!-- Source:<span style="color:red">*</span> -->

                              </div>
                              <div class="col-sm-8">
                            <input type="text" name="sourceOther" id="othsrc" class="form-control form-inline"  >
                            </div>

                          </div>

                          {{-- name --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Name of Client/Complainant:
                              <!-- Name of Client/Complainant:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="text" name="name_of_comp" class="form-control form-inline"   data-parsley="">
                              <!-- <input type="text" name="name_of_comp" class="form-control form-inline" required data-parsley-required-message="<b>*Name</b> required" data-parsley=""> -->

                            </div>

                          </div>



                          {{-- age --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Age:
                              <!-- Age:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="number" name="age" class="form-control form-inline"  data-parsley="">
                              <!-- <input type="number" name="age" class="form-control form-inline" required data-parsley-required-message="<b>*Age</b> required" data-parsley=""> -->

                            </div>

                          </div>



                          {{-- gender --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Gender:
                              <!-- Gender:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <select type="" name="gender" class="form-control"  data-parsley="" style="width: 100%">
                              <!-- <select type="" name="gender" class="form-control" required data-parsley-required-message="<b>*Gender</b> required" data-parsley="" style="width: 100%"> -->

                                <option disabled hidden selected value="0"><span class="text-success"><i></i></span></option>

                                <option value="Male">Male</option>

                                <option value="Female">Female</option>

                                {{-- <option value="Others">Others</option> --}}

                              </select>

                            </div>

                          </div>



                          {{-- address --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Address:
                              <!-- Address:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="" name="address" class="form-control form-inline" data-parsley="">
                              <!-- <input type="" name="address" class="form-control form-inline" required data-parsley-required-message="<b>*Address</b> required" data-parsley=""> -->

                            </div>

                          </div>



                          {{-- civil stats --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Civil Status:
                              <!-- Civil Status:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <select type="" name="civ_stat" class="form-control" data-parsley="" style="width: 100%">
                              <!-- <select type="" name="civ_stat" class="form-control" required data-parsley-required-message="<b>*Civil Status</b> required" data-parsley="" style="width: 100%"> -->

                                <option disabled hidden selected value="0"></option>

                                <option value="Single">Single</option>

                                <option value="Married">Married</option>

                                {{-- <option value="Divorced">Divorced</option> --}}

                                <option value="Separated">Separated</option>

                                <option value="Widowed">Widowed</option>

                              </select>

                            </div>

                          </div>



                          {{-- contact no. --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                             Mobile Number:
                              <!-- Contact No.: -->
                              <!-- Contact No.:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="text" name="contact_no" class="form-control form-inline"  data-parsley-required-message="<b>*Contact No.</b> required" data-parsley="">

                            </div>

                          </div>



                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Email:

                            </div>



                            <div class="col-sm-8">

                              <input type="text" name="email" class="form-control form-inline">

                            </div>

                          </div>



                          <hr>



                          <script>
                            

                            function facinaturechange() {

                              var togBtn = document.getElementById('facitogBtn');



                              var rname = document.getElementById('rname');
                              var regInput = document.getElementById('xfacName');

                              var regDataList = document.getElementById('xfacName');

                              var regFacType = document.getElementById('factype');

                              var regFacAddr = document.getElementById('facaddr');

                             

                              var unregInput = document.getElementById('unregxfacName');

                              console.log(unregInput)

                              var unregFacType = document.getElementById('unregfactype');
                              var region = document.getElementById('region');

                              $("#region").change();

                              var unregFacAddr = document.getElementById('unregfacaddr');



                              var spanWarning = document.getElementById('spanwarning');

                              switch (togBtn.checked) {

                                  case false:
                                    document.getElementById('facinaturevalue').value="false";
                                    rname.setAttribute('hidden', 'hidden')
                                    unregInput.setAttribute('required', 'required')
                                    regInput.removeAttribute('required')
                                    unregInput.hidden = false;
                                    region.hidden = false;

                                    unregInput.disabled = false;

                                    unregInput.required = true;


                                    regInput.hidden = true;

                                    regInput.disabled = true;

                                    regInput.required = false;

                                    regDataList.hidden = true;

                                    regDataList.disabled = true;

                                    regDataList.required = false;

                                    regFacType.hidden = true;

                                    regFacType.disabled = true;

                                    regFacType.required = false;

                                    regFacAddr.hidden = true;

                                    regFacAddr.disabled = true;

                                    regFacAddr.required = false;



                               
                                    unregFacType.hidden = false;

                                    unregFacType.disabled = false;

                                    unregFacType.required = true;



                                    unregFacAddr.hidden = false;

                                    unregFacAddr.disabled = false;

                                    unregFacAddr.required = true;



                                    spanWarning.hidden = true;



                                   

                                    break;

                                  case true:
                                    document.getElementById('facinaturevalue').value="true";
                                    rname.removeAttribute('hidden')

                                    regInput.setAttribute('required', 'required')
                                    unregInput.removeAttribute('required')

                                    unregInput.hidden = true;
                                    region.hidden = true;
                                    region.value = " ";

                                    unregInput.disabled = true;

                                    unregInput.required = false;
                                    regInput.hidden = false;

                                    regInput.disabled = false;

                                    regInput.required = true;

                                    regDataList.hidden = false;

                                    regDataList.disabled = false;

                                    regDataList.required = true;

                                    
                                    regFacType.hidden = false;

                                    regFacType.disabled = false;

                                    regFacType.required = true;

                                    regFacAddr.hidden = false;

                                    regFacAddr.disabled = false;

                                    regFacAddr.required = true;



                                    

                                    unregFacType.hidden = true;

                                    unregFacType.disabled = true; 

                                    unregFacType.required = false;

                                    unregFacAddr.hidden = true;

                                    unregFacAddr.disabled = true;

                                    unregFacAddr.required = false;



                                    spanWarning.hidden = false;



                                  

                                    break;



                              }

                            }

                          </script>



                          <div class="row mb-2">

                            <div class="col-sm-4">

                              &nbsp;

                            </div>

                            <div class="col-sm-8">

                              <input onchange="facinaturechange()" value="Reg" type="checkbox" name="togglefaci" checked data-toggle="toggle" data-on="Registered Facility&nbsp;{{'<i class="fa fa-caret-right" aria-hidden="true"></i>'}}" data-off="{{'<i class="fa fa-caret-left" aria-hidden="true"></i>'}}&nbsp;Unregistered Facility" data-onstyle="primary" data-offstyle="success" data-width="180"  id="facitogBtn">

                            </div>



                  

                          </div>



                          {{-- name of faci --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Name of Facility:
                              <!-- Name of Facility: <span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="text" class="form-control" name="name_of_faci" data-parsley=""  hidden disabled id="unregxfacName" >
                              <!-- <input type="text" class="form-control" name="name_of_faci" data-parsley-required-message="<b>*Name of Facility</b> required" data-parsley=""  hidden disabled id="unregxfacName"> -->
                              <!-- <input type="text" class="form-control" name="name_of_faci" data-parsley-required-message="<b>*Name of Facility</b> required" data-parsley=""  hidden disabled id="unregxfacName"> -->



                              {{-- <input list="facName" id="xfacName" name="name_of_faci" class="form-control" onchange="changeFaciSelect()"  data-parsley-required-message="<b>*Name of Facility</b> required">
<!-- 
                              <datalist id="facName">

                                @isset($FacName)

                                  @foreach($FacName as $key => $value)

                                    @if($value->facilityname!="")

                                      <option value="{{$value->appid}}">{{$value->facilityname}} </option>

                                    @endif

                                  @endforeach

                                @endisset

                              </datalist>  -->
                              --}}

                                
                            <p id="rname" >
                              <select  type="" style="width: 100%" name="name_of_faci" class="form-control selectpicker" onchange="changeFacname(this.value)" id="xfacName"  data-parsley="" data-live-search="true" >
                              <!-- <select type="" style="width: 100%" name="name_of_faci" class="form-control" onchange="changeFacname(this.value)" id="xfacName" required data-parsley-required-message="<b>*Name of Facility</b> required" data-parsley=""> -->
                              <!-- <select type="" style="width: 100%" name="name_of_faci" class="form-control" onchange="changeFaciSelect()" id="xfacName" required data-parsley-required-message="<b>*Name of Facility</b> required" data-parsley=""> -->
<!-- HERE -->
                                <option disabled hidden selected value="0"></option>

                                @isset($FacName)

                                  @foreach($FacName as $key => $value)

                                    @if($value->facilityname!="")

                                      <option data-tokens="{{$value->regfac_id}}" value="{{$value->regfac_id}}">{{$value->facilityname}} </option>

                                    @endif

                                  @endforeach

                                @endisset

                              </select>
                            </p>

                            </div>

                          </div>



                          {{-- type of faci --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Type of Facility:
                              <!-- Type of Facility:<span id="spanwarning" style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="text" class="form-control" name="type_of_faci" id="unregfactype" hidden disabled>

                              <select name="type_of_faci" id="type_of_faci" style="width: 100%" class="form-control" id="factype" data-parsley="">
                              <!-- <select name="type_of_faci" id="type_of_faci" style="width: 100%" class="form-control" id="factype"  required data-parsley-required-message="<b>*Type of Facility</b> required" data-parsley=""> -->
                              <!-- <select name="type_of_faci" style="width: 100%" class="form-control" id="factype" onchange="changeFaciType()" required data-parsley-required-message="<b>*Type of Facility</b> required" data-parsley=""> -->

                                <!-- <option diabled hidden selected value="">Type of Facility*</option> -->
                                @isset($hgps)

                                    @foreach($hgps as $key => $hg)

                                     

                                        <option value="{{$hg->hgpdesc}}">{{$hg->hgpdesc}} </option>
                                        <!-- <option value="{{$hg->hgpid}}">{{$hg->hgpdesc}} </option> -->

                                      

                                    @endforeach

                                    @endisset

                              </select>

                            </div>

                          </div>
                          
                      <div {{$grpid == 'NA' ? '': 'hidden'}}>
                          <div class="row mb-2" id="region" hidden >

                          <div class="col-sm-4">

                            Region Facility:
                            <!-- Address of Facility:<span style="color:red">*</span> -->
                          
                          </div>
                          <div class="col-sm-8">
                          <!-- <select value="{{$rgnid}}" name="rgnid" id="rgnid" style="width: 100%" class="form-control" id="rgnid" data-parsley=""> -->
                          <select {{$grpid != 'NA'? 'disabled' : ''}} value="{{$rgnid}}" name="rgnid" id="rgnid" style="width: 100%" class="form-control" id="rgnid" data-parsley="">
                         
                          @foreach( $regions as $region)
                              @if($region->rgnid != 'HFSRB')
                                @if($region->rgnid == $rgnid)
                                <option selected value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>
                                @else
                                <option  value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>
                                @endif
                              @endif
                          @endforeach
                        </select>



                          </div>
                          </div>
                        </div>

                          {{-- address of faci --}}

                          <div class="row mb-2">

                            <div class="col-sm-4">

                              Address of Facility:
                              <!-- Address of Facility:<span style="color:red">*</span> -->

                            </div>



                            <div class="col-sm-8">

                              <input type="text"  class="form-control" name="address_of_faci" id="unregfacaddr" data-parsley-required-message="<b>*Address of Facility</b> required" data-parsley="" hidden disabled>

                              <input type="text" id="address_of_faci" name="address_of_faci" class="form-control form-inline"   id="facaddr"  data-parsley="">
                              <!-- <input type="text" id="address_of_faci" name="address_of_faci" class="form-control form-inline"  required id="facaddr" data-parsley-required-message="<b>*Address of Facility</b> required" data-parsley=""> -->
                              <!-- <input type="text" id="address_of_faci" name="address_of_faci" class="form-control form-inline" readonly required id="facaddr" data-parsley-required-message="<b>*Address of Facility</b> required" data-parsley=""> -->

                            </div>

                          </div>



                          <hr>



                          {{-- conf pat --}}

                          <div class="row mb-2 forAssistance">

                            <div class="col-sm-4">

                              Name of Confined Patient:<br/> (if applicable)

                            </div>



                            <div class="col-sm-8">

                              <input type="text" id="name_of_conf_pat" name="name_of_conf_pat" class="form-control form-inline" oninput="toggleDate(this)">

                            </div>

                          </div>



                          {{-- conf date --}}

                          <div class="row mb-2 forAssistance">

                            <div class="col-sm-4">

                              Date of Patient Confined

                            </div>



                            <div class="col-sm-8">

                              <input type="date" name="date_of_conf_pat" id="conf-date" class="form-control form-inline" readonly>

                            </div>

                          </div>



                          <hr>



                          <div class="row">

                            <div class="col-sm-4">

                              &nbsp;

                            </div>

                            <div class="col-sm-8" id="tog_tog_btn">

                              <input value="Request" type="checkbox" name="togglenature" checked data-toggle="toggle" data-on="Assistance&nbsp;{{'<i class="fa fa-caret-right" aria-hidden="true"></i>'}}" data-off="{{'<i class="fa fa-caret-left" aria-hidden="true"></i>'}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Complaints &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" data-onstyle="primary" data-offstyle="success" data-width="180" onchange="naturechange()" id="togBtn">

                              {{-- &nbsp; --}}

                              {{-- Type: --}}

                              <input type="hidden" name="facinaturevalue" id="facinaturevalue">

                            </div>



                            {{-- <div class="col-sm-8">

                              <select class="form-control" onchange="naturechange()" id="togBtn">

                                <option value="Request">Request for Assistance</option>

                                <option value="Complaints">Nature of Complaints</option>

                              </select>

                            </div> --}}

                          </div>



                          <input type="hidden" name="type" id="hidType" value="Request">



                          {{-- reqs --}}

                          <div id="reqsdiv">

                            {{-- <h5 class="modal-title text-center mb-3"><strong>Request for Assistance<span style="color:red">*</span></strong></h5> --}}

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

                            {{-- <h5 class="modal-title text-center mb-3"><strong>Nature of Complaint<span style="color:red">*</span></strong></h5> --}}

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

                          <div class="row">
                            <div class="col-sm-4">
                              Brief Narration of Facts/Circumstances:
                              <!-- Brief Narration of Facts/Circumstances:ds<span style="color:red">*</span> -->
                            </div>
                            <div class="col-sm-8">
                              <textarea type="text" id="txt_details" name="txt_details" class="form-control" rows="3"></textarea>
                            </div>
                          </div> 
                        <br/>
                          <div class="row">
                            <div class="col-sm-4">
                              Upload attachment:
                              <!-- Upload attachment:<span style="color:red">*</span> -->
                            </div>
                            <div class="col-sm-8">
                           
												      	<input  class="form-control"  type="file" name="reqcompattach">
                            </div>
                          </div>
                          <hr>

                          <div class="mx-auto">

                            <button type="submit" name="btn_sub" class="btn btn-primary"><b>SUBMIT </b></button>

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



  <script>
var facnames = JSON.parse('{!!addslashes(json_encode($FacName))!!}')
console.log(facnames)

// var uninpt = document.getElementById('xfacName');
//             uninpt.setAttribute('required', 'required')

  function changeFacname (value){
        console.log(value)

        var result = facnames.filter(function (v) {
                                return v.regfac_id == value;
                            })

                            document.getElementById("address_of_faci").value = result[0].address
                            document.getElementById("type_of_faci").value = result[0].hgpdesc
                            // document.getElementById("type_of_faci").value = result[0].facid
                            console.log("facilityname")
                            console.log(result[0].facilityname)
                            console.log(result[0].hgpdesc)
                            console.log(result[0].address)

  }

   //  function naturechange() {

   //    var togBtn = document.getElementById('togBtn');

   //    var hidType = document.getElementById('hidType');

   //    var reqsdiv = document.getElementById('reqsdiv');

   //    var compsdiv = document.getElementById('compsdiv');

   //    var form = document.getElementById('r-others-form');

   //    var xaction;



   //    switch(togBtn.checked*//*togBtn.value) {

   //       case true:

   //          hidType.value="Request";



   //          reqsdiv.hidden=false;

   //          compsdiv.hidden=true;



   //          for(i=0; i<reqsdiv.childElementCount; i++) {

   //             if(reqsdiv.children[i].tagName == "INPUT" || reqsdiv.children[i].tagName == "TEXTAREA") {

   //                reqsdiv.children[i].disabled=false;

   //             }

   //          }



   //          for(i=0; i<compsdiv.childElementCount; i++) {

   //             if(compsdiv.children[i].tagName == "INPUT" || compsdiv.children[i].tagName == "TEXTAREA") {

   //                compsdiv.children[i].disabled=true;

   //             }

   //          }

   //          xaction = form.getAttribute("action");

   //          xaction = xaction.split('/');



   //          xaction[xaction.length-1] = "5";

   //          xaction[xaction.length-2] = "req_submit";



   //          xaction = xaction.join('/');



   //          form.removeAttribute('action');

   //          form.setAttribute('action', xaction);



   //          break;

   //       case false:

   //          hidType.value="Complaints";



   //          reqsdiv.hidden=true;

   //          compsdiv.hidden=false;



   //          for(i=0; i<reqsdiv.childElementCount; i++) {

   //             if(reqsdiv.children[i].tagName == "INPUT" || reqsdiv.children[i].tagName == "TEXTAREA") {

   //                reqsdiv.children[i].disabled=true;

   //             }

   //          }



   //          for(i=0; i<compsdiv.childElementCount; i++) {

   //             if(compsdiv.children[i].tagName == "INPUT" || compsdiv.children[i].tagName == "TEXTAREA") {

   //                compsdiv.children[i].disabled=false;

   //             }

   //          }

   //          xaction = form.getAttribute("action");

   //          xaction = xaction.split('/');



   //          xaction[xaction.length-1] = "8";

   //          xaction[xaction.length-2] = "comp_submit";



   //          xaction = xaction.join('/');



   //          form.removeAttribute('action');

   //          form.setAttribute('action', xaction);



   //          break;

   //    }

   // }

  </script>



  {{-- ////////////////////  Lloyd - Dec 11, 2018 ////////////////// --}}

  {{-- ROA/Complaints View --}}

  <div class="modal fade" id="vReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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

  </div>



  {{-- ROA/Complaints Delete --}}

  <div class="modal fade" id="dReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog" role="document">

      <div class="modal-content " style="border-radius: 0px;border: none;">

        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">

          <h5 class="modal-title text-center"><strong><!-- Delete --> Cancel Request/Complaints</strong></h5>

          <hr>

          <div class="input-group form-inline mb-1 mt-2">

            <form class="container" method="POST" action="{{asset('employee/dashboard/others/action/delete')}}">

              {{csrf_field()}}



              {{-- refno --}}
              <input type="hidden" name="ref_noDelete">
              <input type="hidden" name="type">
              <input class="form-control w-100" type="" name="dref_no" id="dref_no" hidden>



              {{-- message --}}

              <div class="row">

                <div class="col w-100" colspan="12">

                  <center>Are you sure you want to <!-- delete --> cancel <b><span style="color:red" id="delrcMsg"></span></b></center>

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

  </div>



  <div class="modal fade" id="resolve" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog" role="document">

      <div class="modal-content " style="border-radius: 0px;border: none;">

        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">

          <h5 class="modal-title text-center"><strong>Resolve Request/Complaints</strong></h5>

          <hr>

          <div class="input-group form-inline mb-1 mt-2">

            <form class="container" method="POST" action="{{asset('employee/dashboard/others/action/resolve')}}">

              {{-- message --}}
              {{csrf_field()}}
              <div class="row">

                <div class="col w-100" colspan="12">
                  <input type="hidden" name="ref_noResolve">
                  <input type="hidden" name="type">
                  <center>Are you sure you want to resolve this complaint/request?</center>

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

  </div>

  <div class="modal fade" id="actionstaken" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Actions for Request/Complaints</strong></h5>
          <hr>
          <div class="input-group form-inline mb-1 mt-2">
            <form class="container" method="POST" action="{{asset('employee/dashboard/others/action/actions')}}">
              {{-- message --}}
              {{csrf_field()}}
              <div class="row">
                <div class="col w-100" colspan="12">
                  <input type="hidden" name="refno">
                  <input type="hidden" name="type">
                  <input type="hidden" name="select_real_val">
                  
                  <div class="row mb-2">
                    <div class="col-3">
                      Name of staff:
                    </div>
                    <div class="col">
                      <input name="staffname" type="text" class="form-control w-100" required data-parsley-required-message="<b>*Name of staff</b> required" data-parsley="">
                    </div>
                  </div>
  
                  <div class="row mb-2">
                    <div class="col-3">
                      Position:
                    </div>
                    <div class="col">
                      <input name="position" type="text" class="form-control w-100" required data-parsley-required-message="<b>*Position</b> required" data-parsley="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-3">
                      Actions:
                    </div>
                    <div class="col">
                      <select name="actions" class="form-control w-100" multiple>
                        @foreach(DB::table('roacomplaintactions')->get() as $k => $v)
                        {{-- <option value="1">Sent Letter to the Health Facility</option>
                        <option value="2">Endorsed to concerned Division/Regional Office (specify)</option>
                        <option value="3">Endorsed to other agency (specify agency)</option> --}}
                        <option value="{{$v->id}}">{{$v->descr}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="row mb-2" id="action_2" hidden>
                    <div class="col-3">
                      Division/Regional Office:
                    </div>
                    <div class="col">
                      <input name="action_2_text" type="text" class="form-control w-100" >
                    </div>
                  </div>

                  <div class="row mb-2" id="action_3" hidden>
                    <div class="col-3">
                      Other agency:
                    </div>
                    <div class="col">
                      <input name="action_3_text" type="text" class="form-control w-100" >
                    </div>
                  </div>


                </div>
              </div>
              {{-- submit btn --}}
              <div class="row mt-3">
                <div class="col" colspan="6">
                  <button type="submit" class="btn btn-outline-success w-100"><center>Submit</center></button>
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
  </div>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> -->

<script>
$(function() {
  // $('.selectpicker').selectpicker();
  $('.selectpicker').selectpicker();
  // $('select').selectpicker();
});
  </script>
  <script>
    $('select[name="actions"]').on('change', function() {

      let sample = $(this).val();
      let samplee = $('input[name="select_real_val"]');

      samplee.val(sample);

      // console.log($(this).val());
      // console.log($('input[name="select_real_val"]').val());
      // console.log(samplee);

      if($(this).val().includes('2')) {
        $('input[name="action_2_text"]')[0].removeAttribute('hidden');
        $('input[name="action_2_text"]')[0].removeAttribute('disabled');
        $('input[name="action_2_text"]')[0].removeAttribute('required');

        $('#action_2')[0].removeAttribute('hidden');
      } else {
        $('#action_2')[0].setAttribute('hidden', '');

        $('input[name="action_2_text"]').val('');
        $('input[name="action_2_text"]')[0].setAttribute('hidden', '');
        $('input[name="action_2_text"]')[0].setAttribute('disabled', '');
        $('input[name="action_2_text"]')[0].setAttribute('required', '');
      }

      if($(this).val().includes('3')) {
        $('input[name="action_3_text"]')[0].removeAttribute('hidden');
        $('input[name="action_3_text"]')[0].removeAttribute('disabled');
        $('input[name="action_3_text"]')[0].removeAttribute('required');

        $('#action_3')[0].removeAttribute('hidden');
      } else {
        $('#action_3')[0].setAttribute('hidden', '');

        $('input[name="action_3_text"]').val('');
        $('input[name="action_3_text"]')[0].setAttribute('hidden', '');
        $('input[name="action_3_text"]')[0].setAttribute('disabled', '');
        $('input[name="action_3_text"]')[0].setAttribute('required', '');
      }

      // else {
      //   $('#action_2')[0].setAttribute('hidden', '');
      //   $('#action_3')[0].setAttribute('hidden', '');
      // }

    });

    function ActionsTaken(data) {
      let d = JSON.parse(data);
      $('input[name="refno"]').val(d.ref_no);
      $('input[name="type"]').val(d.type);

    }
  </script>

  <script type="text/javascript">
    // $('select').select2();

    function act(elementName,val,type){
      $("input[name="+elementName+"]").val(val);
      $("input[name=type]").val(type);
    }

  </script>
<script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>

  @include('employee.cmp._othersJS') {{-- Javascript for this Module --}}
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>



@endsection

@else
  <script>window.location.href="{{url('employee')}}"</script>
@endif

