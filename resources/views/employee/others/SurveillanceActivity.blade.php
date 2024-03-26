@extends('mainEmployee')
@section('title', 'Surveillance Activity')
@section('content')
  <div class="content p-4">
    <datalist id="rgn_list">
      @if (isset($AllData))
        @foreach ($AllData as $key => $value)
          @if(trim($value->hfsrbno) != '')
          <option value="{{$value->hfsrbno}}"></option>
          @endif
        @endforeach
      @endif
    </datalist>
    @php 
    $employeeData = session('employee_login');
   $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
    @endphp
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
           @include('employee.cmp._survHead')
           @include('employee.tableDateSearch')
			</div>
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
          <thead>
            <tr>
              <th scope="col" style="text-align: center; width:auto;">ID</th>
              <th scope="col" style="text-align: center; width:auto">Name of Facility</th>
              <th scope="col" style="text-align: center; width:150px;">Location/ <br>Address</th>
              <th scope="col" style="text-align: center; width:auto">Facility Code</th>
              <th scope="col" style="text-align: center; width:auto">Reported Violation</th>
              <th scope="col" style="text-align: center; width:auto">Date of <br> Surveillance</th>
              <th scope="col" style="text-align: centerl width:auto">Span of <br> Surveillance</th>
              <th scope="col" style="text-align: center; width:auto;">NOV <br>Reference<br> number</th>
              <th scope="col" style="text-align: center; width:auto">Status</th>
              <th scope="col" style="text-align: center; width:auto">Options</th>
              <th scope="col" style="text-align: center; width:auto">Team <br> Assignment</th>
            </tr>
          </thead>
          <tbody>
            @isset($AllData)
              @foreach($AllData as $key => $value)
              @php 
              if($grpid != 'NA' && AjaxController::checkSurvTeam($value->team) == 'no'){
                continue;
              }
              @endphp
                <tr>
                  <td style="text-align:center">{{$value->survid}}</td>
                  <td style="text-align:center">{{$value->name_of_faci}}</td>
                  <td style="text-align:center">{{$value->address_of_faci}}</td>
                  <td style="text-align:center">{{$value->facname}}</td>
                  <td style="text-align:center" class="font-weight-bold">{{$value->violation}}</td>
                  <td style="text-align:center">
                    @if($value->date_surveillance != "") 
                      <b>{{\Carbon\Carbon::parse($value->date_surveillance)->format('M d, Y')}}</b> to
                      <b>{{\Carbon\Carbon::parse($value->date_surveillance_end)->format('M d, Y')}}</b>
                    @endif
                  </td>
                  <td style="text-align:center">
                    @if($value->date_surveillance != "") 
                      {{-- {{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}} --}}
                      @php
                        $date_start = new DateTime($value->date_surveillance);
                        $date_end = new DateTime($value->date_surveillance_end);
                        $interval = $date_start->diff($date_end);
                        $interval->d = $interval->d;
                      @endphp
                      @if($interval->d > 1)
                        {{$interval->d}} days
                      @else
                        {{$interval->d}} day
                      @endif
                    @endif
                  </td>
                  <td style="text-align:center">{{$value->hfsrbno}}</td>

                  <td style="text-align:center;" class="text-light font-weight-bold">
                        <span style="color: black">
                        
                        @if($value->survStat)
                        {{ $value->survStat != 'RS' ? AjaxController::getTransStatusById($value->survStat)[0]->trns_desc : ( $value->s_ver_others ?  $value->s_ver_others : $value->vdesc) }}
                        
                        @endif
                        </span>
                    </td>
                  <!-- @if($value->isApproved == "1")
                    <td style="text-align:center;" class="bg-success text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('A')[0]->trns_desc}}
                      </span>
                    </td>
                  @elseif($value->isFinePaid != "" )
                    <td style="text-align:center;" class="bg-info text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('PP')[0]->trns_desc}}
                      </span>
                    </td>
                  @elseif($value->recommendation != "")
                    <td style="text-align:center;" class="bg-primary text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('FPE')[0]->trns_desc}}
                      </span>
                    </td>
                  @elseif($value->assessmentStatus != "")
                    <td style="text-align:center;" class="bg-warning text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('FA')[0]->trns_desc}}
                      </span>
                    </td> 
                  @elseif($value->team != "")
                    <td style="text-align:center;" class="bg-danger text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('FS')[0]->trns_desc}}
                      </span>
                    </td>
                  @elseif($value->team == "")
                    <td style="text-align:center;" class="bg-secondary text-light font-weight-bold">
                      <span style="text-shadow: 2px 2px 4px #000000">
                        {{AjaxController::getTransStatusById('NT')[0]->trns_desc}}
                      </span>
                    </td>
                  @endif -->

                  <td style="text-align:center">
                    <center>
                      @if(empty($value->survAct))
                      	<button data-toggle="modal" data-target="#sMonModal" title="Add Surveillance Activity on {{$value->name_of_faci}}" onclick="getDatasToManipulate('{{$value->survid}}','{{$value->email}}','{{$value->compid}}')" class="btn btn-outline-info"><i class="fa fa-plus"></i></button>
                      @else
						<button class="btn btn-outline-info" onclick="showData('{{$value->survid}}')" data-toggle="modal" data-target="#viewAct" title="View {{$value->name_of_faci}}">
                        <i class="fa fa-fw fa-eye"></i>
                      </button>
                      @endif
                    </center>
                  </td>
                  <td style="text-align:center">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sMonModalTeam" onclick="showTeamSurv('{{$value->team}}')">
                          <i class="fa fa-fw fa-eye"></i>
                           Team
                        </button>
                  </td>
                </tr>
              @endforeach
            @endisset
          </tbody>
        </table>
      </div>
    </div>
  </div>  
  <div class="modal fade" id="sMonModalTeam" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <!-- <select readonly class="form-control w-100" id="smember" multiple rows="5" disabled></select> -->
                  <ul id="myList" style=" text-transform: capitalize;">
                    <!-- <li>Coffee</li>
                    <li>Tea</li> -->
                  </ul>
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
   <div class="modal fade" id="sMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Add Recommendation Details</strong></h5>
          <!-- <h5 class="modal-title text-center"><strong>Add Surveillance Activity Details</strong></h5> -->
          <hr>
          <form id="bodyToAdd" enctype="multipart/form-data" method="POST">
          	<input type="hidden" name="survid" value="">
          	{{csrf_field()}}
            <div class="container" id="facEmail">
              <div class="col-md-12 lead  text-center">Facility Email</div>
              <div class="container pb-3 pt-3">
                <input type="email" name="emailFaci" class="form-control" >
              </div>
            </div>
            {{-- <div class="container" id="facEmail">
              <div class="col-md-12 lead  text-center">Approved DPO</div>
              <div class="container pb-3 pt-3">
                <input type="dpo" name="dpo" class="form-control" required="">
              </div>
            </div> --}}
          	<div class="container">
          		<div class="col-md-12 lead  text-center">Issuing a (NOV/CDO)</div>
          		<div class="container pb-3 pt-3">
	          		<select required="" name="action" class="form-control ">
	          			<option value="">Please Select</option>
	          			<option value="NOV">NOV/CDO</option>
	          			<option value="others">Others</option>
	          			<!-- <option value="NOV">NOV</option> -->
	          			<!-- <option value="CDO">CDO</option> -->
	          		</select>
          		</div>
          	</div>
          	<div class="container" id="nov" hidden="">
          		<div class="col-md-12 lead  text-center">NOV/CDO Number</div>
          		<div class="container pb-3 pt-3">
	          		<input type="text" name="novNo" class="form-control" value="" id="novNo">
	          		<!-- <input type="number" name="novNo" class="form-control" value="" id="novNo"> -->
          		</div>
          	</div>
            <div class="container" id="others" hidden="">
          		<div class="col-md-12 lead  text-center">Others, Please specify</div>
          		<div class="container pb-3 pt-3">
                  <textarea  class="form-control" name="other"   id="otherspc"></textarea>
	          		<!-- <input type="text" name="novNo" class="form-control" value="" id="novNo"> -->
          		</div>
          	</div>
          	<div class="container">
          		<div class="col-md-12 lead pb-3 text-center">Details of Surveillance Activity</div>
          		<textarea required="" name="comments" cols="30" rows="10" class="form-control"></textarea>
          	</div>
            
            <div class="container pt-3" id="violationField">
              <div class="col-md-12 lead pb-3 text-center">
                Violations<br>
              </div>
              <textarea name="violation" cols="30" rows="10" class="form-control"></textarea>
            </div>

          	<div class="container pt-3 text-center">
          		<p class="lead">Add Images</p>
          		<input id="file-input" name="images[]" type="file" multiple>
          	</div>
          	<div class="container pt-3">
	          	<div class="row border rounded" id="preview">
	          	</div>
          	</div>
          	<div class="d-flex justify-content-center pt-3">
	          	<button class="btn btn-primary">Submit</button>
          	</div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="viewAct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>View Surveillance Activity</strong></h5>
          <hr>
	      	<div class="container">
	      		<div class="col-md-12 lead  text-center">Issuing a</div>
	      		<div class="container pb-3 pt-3 text-center lead font-weight-bold" id="survAct">
	          		{{-- survAct --}}
	      		</div>
            <center>
            <p id="viewOther">
            </p>
            </center>
	      	</div>
	      	<div class="container">
	      		<div class="col-md-12 lead  text-center">On</div>
	      		<div class="container pb-3 pt-3 text-center lead font-weight-bold" id="fac">
	          		{{-- fac --}}
	      		</div>
	      	</div>
	      	<div class="container">
	      		<div class="col-md-12 lead  text-center">Issued By</div>
	      		<div class="container pb-3 pt-3 text-center lead font-weight-bold" id="iB">
	          		{{-- issuer --}}
	      		</div>
	      	</div>
	      	<div class="container">
	      		<div class="col-md-12 lead pb-3 text-center">Details of Surveillance Activity</div>
	      		<div class="offset-1 col-md-10 border rounded h-auto" id="survDet" style="min-height: 100px;">
	      			
	      		</div>
	      	</div>
	      	<div class="container pt-3 text-center">
	      		<p class="lead">Images</p>
	      	</div>
	      	<div class="container pt-3 border" id="view">

	      	</div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">

function showTeamSurv(id){
      let aString = '';
      if(id != ""){
        $.ajax({
          url: '{{asset('employee/mf/getMembersInTeam/neww')}}',
          // url: '{{asset('employee/mf/getMembersInTeam')}}',
          method: 'POST',
          data: {_token : $("input[name=_token]").val(), id: id},
          async: false,
          success: function(a){
            console.log(a)


            $("#steam").val(a[0].montname);
            // $("#steam").val(id);
            // if(a.length > 0)
            // {
              $("#myList").empty();
              // $("#smember").empty();
              for (var i = 0; i < a.length; i++) {
                // aString  += '<option>'+a[i].wholename+'</option>';
                // aString  += '<option>'+a[i]['wholename']+'</option>';
                var node = document.createElement("LI");
                var textnode = document.createTextNode(a[i].wholename);
                node.appendChild(textnode);
                document.getElementById("myList").appendChild(node);
              }
              // $("#smember").append(aString);
            // }
          }
        })
      }
    }

  	$("select[name=action]").change(function(event) {
  		if($(this).val() == 'NOV'){
  			$("#nov").removeAttr('hidden');
  			$("input[name=novNo]").attr('required',true);
  		} else {
  			$("#nov").attr('hidden',true);
  			$("input[name=novNo]").removeAttr('required');
  		}

      if($(this).val() == 'others'){
  			$("#others").removeAttr('hidden');
  			$("input[name=other]").attr('required',true);
  		} else {
  			$("#others").attr('hidden',true);
  			$("input[name=other]").removeAttr('required');
  		}
  	});
  	function previewImages() {

	  var $preview = $('#preview').empty();
	  if (this.files) $.each(this.files, readAndPreview);

	  function readAndPreview(i, file) {
	    
	    if (!/\.(jpe?g|jpg|png|gif|pdf|docx|doc)$/i.test(file.name)){
	      return alert(file.name +" is not allowed. Allowed files are only the jpg, png, gif, pdf, docx, and doc. ");
	    } // else...
	    
	    var reader = new FileReader();

	    $(reader).on("load", function() {
	      $preview.append($("<img/>", {src:this.result, height:100,width:100})) ;
	    });

	    reader.readAsDataURL(file);
	    
	  }
	}

  function getDatasToManipulate(id,email,compid){
    $('input[name=survid]').val(id);
    if($.trim(email) != ""){
      $("#facEmail").replaceWith('<input type="hidden" name="emailFaci" value="'+email+'" disabled>');
    }
    if($.trim(compid) != ""){
      $("#violationField").hide();
    } else {
      $("#violationField").show();
    }
  }

	function showData(survid){
		if(survid > 0){
			let sAct = $("#survAct");
			let sDet = $("#survDet");
			let viewOther = $("#viewOther");
			let sView = $("#view");
			let sFac = $("#fac");
			let siB = $("#iB");
      let vio = $("#violation");
			let aString = '<div class="row">';
			$.ajax({
				url: '{{asset('employee/dashboard/others/surveillance/getSurvAct')}}',
				method: 'POST',
				data: {_token: $('input[name=_token]').val(), survid: survid},
				success: function(a){
					let det = JSON.parse(a);
					sAct.empty().html(det['survAct'] == 'NOV'? 'NOV/CDO': 'Specified');
					sFac.empty().html(det['name_of_faci']);
					viewOther.empty().html(det['otherspec']);
					siB.empty().html(det['fname'] + ' ' + det['lname']);
					sDet.empty().html(det['comments']);
					sView.empty().html('<div class="container text-center font-weight-bold ">No Image Uploaded</div>');
					if(det['LOAttachments'] != "" && det['LOAttachments'] != null){
						let splited = det['LOAttachments'].split(',');
						let perDiv = (12 % splited.length == 0 ? '-' + 12 / splited.length : '-3');
						for (var i = 0;  i < splited.length; i++) {
							let link = '{{asset('ra-idlis/storage/app/public/uploaded/')}}/'+splited[i]+'';
							aString  += '<div class="col'+perDiv+' mt-3"><img onclick="window.open('+"\'"+ link+'\')" " class="w-100" src="'+link+'" style="cursor: pointer;"></div>';
						}
						aString +='</div>';
						sView.empty().append(aString);
					}	
				}
			})
		}
	}

	$('#file-input').on("change", previewImages);

  $("#bodyToAdd").submit(function(event) {
    event.preventDefault();
    let data = new FormData(this);
    var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
    var test = $.inArray($("#novNo").val(),arr);
    console.log(test);
    if (test == -1) {
      $.ajax({
        method: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function(a){
          alert('Successfully sent data');
          location.reload();
        }
      })
    } else {
      alert('NOV number already exist. Please check again or change the NOV number');
      $("#novNo").focus();
    }
  });
  </script>
<script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>
  @include('employee.cmp._othersJS')
@endsection