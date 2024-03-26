@if (session()->exists('employee_login')) 
  @extends('mainEmployee')
  @section('title', 'Transaction Status Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="AP012">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($trans))
          @foreach ($trans as $tran)
            <option value="{{$tran->trns_id}}">{{$tran->trns_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Transaction Status <span class="AP012_add"><a href="#" title="Add New Health Facility/Service Type" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: 20%">ID</th>
                    <th style="width: 35%">Description</th>
                    <th style="width: 10%"><center>Allow Payment</center></th>
                    <th style="width: 10%"><center>Display on client side legend</center></th>
                    <th style="width: 10%"><center>Can Apply</center></th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($trans))
                    @foreach ($trans as $tran)
                      <tr>
                        <td scope="row"> {{$tran->trns_id}}</td>
                        <td>{{$tran->trns_desc}}</td>
                        <td><center>
                          @if($tran->allowedpayment == 1) <span style="color:green;font-weight: bold">YES</span> @else <span style="color:red;font-weight: bold">NO</span> @endif
                        </center></td>
                        <td><center>
                          @if($tran->allowedlegend == 1) <span style="color:green;font-weight: bold">YES</span> @else <span style="color:red;font-weight: bold">NO</span> @endif
                        </center></td>
                        <td><center>
                          @if($tran->canapply == 0) <span style="font-weight: bold" class="text-warning">PENDING</span> @elseif($tran->canapply == 1) <span style="color:red;font-weight: bold">YES</span> @else <span style="color:green;font-weight: bold">NO</span> @endif
                        </center></td>
                        <td>
                          <center>
                            <span class="AP012_update">
                              <button type="button" class="btn btn-outline-warning" onclick="showData('{{$tran->trns_id}}', '{{$tran->trns_desc}}', {{$tran->allowedpayment}}, '{{$tran->allowedlegend}}', '{{$tran->color}}', '{{$tran->apply}}', {{$tran->canapply}});" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                            </span>
                            <span class="AP012_cancel">
                              <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$tran->trns_id}}', '{{$tran->trns_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                            </span>
                          </center>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add Transaction Status</strong></h5>
              <hr>
              <div class="container">
                <form id="addRgn" class="row"  data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="col-sm-4">ID:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
                  </div>
                  <div class="col-sm-4">Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Allow Payment:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="checkbox" id="new_rgn_allow" class="form-control">
                  </div>

                  <div class="col-sm-4">Show on Client Side Legend:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="checkbox" id="allowOnLegend" class="form-control">
                  </div>

                  <div class="col-sm-4 hideIfNotAllowedOnLegend" style="display: none">Please select color:</div>
                  <div class="col-sm-8 hideIfNotAllowedOnLegend" style="margin:0 0 .8em 0; display: none">
                  <input name="colorpickerAdd" type="color" class="w-100">
                  </div>

                  <div class="col-sm-4">Can Apply:</div>
                  <div class="col-sm-8" style="margin:0 0 .9em 0;">
                  {{-- <input type="checkbox" id="new_rgn_apply" class="form-control"> --}}
                    <select id="new_rgn_apply" class="form-control" data-parsley-required-message="*<strong>Can apply</strong> required" required>
                        <option value=""></option>
                        <option value="2">Yes</option>
                        <option value="0">Pending</option>
                        <option value="1">No</option>
                    </select>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                  </div> 
                </form>
             </div>
            </div>
          </div>
        </div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Transaction Status</strong></h5>
            <hr>
            <div >
                  <form id="EditNow" data-parsley-validate>
                   <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
                  <span id="EditBody">
                    
                  </span>
                  <div class="row">
                    <div class="col-sm-6">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                  </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Delete Transaction Status</strong></h5>
            <hr>
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
            <div class="container">
              <span id="DelModSpan">
              </span>
              <hr>

                  <div class="row">
                    <div class="col-sm-6">
                    <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function() {
            $('#example').DataTable({
                // dom: 'Bfrtip',
                // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
            });


            $(document).on('change', '#allowOnLegend, #allowOnLegendEdit',function(){
              $(".hideIfNotAllowedOnLegend").hide();
              if($(this).is(':checked')){
                $(".hideIfNotAllowedOnLegend").show();
              }
            })


      });
      function showData(id, desc, isAllowed, legend, color, app, canapp){
  		var check = (isAllowed == 1 ) ? 'checked' : '';
      var legend = (legend == 1 ) ? 'checked' : '';
  		$('#EditBody').empty();
  		$('#EditBody').append(
  		  '<div class="col-sm-4">ID:</div>' +
  		  '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  		    '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
  		  '</div>' +
  		  '<div class="col-sm-4">Description:</div>' +
  		  '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  		    '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
  		  '</div>' +
  		  '<div class="col-sm-4">Allow Payment:</div>' +
  		  '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  		    '<input type="checkbox" id="edit_allow" class="form-control" '+check+'>' +
  		  '</div>' +
        '<div class="col-sm-4">Display on legend :</div>'+
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
          '<input type="checkbox" id="allowOnLegendEdit" class="form-control" '+legend+'>'+
        '</div>'+

        '<div class="col-sm-4 hideIfNotAllowedOnLegend" style="display: none;">Please select color:</div>'+
        '<div class="col-sm-12 hideIfNotAllowedOnLegend" style="margin:0 0 .8em 0; display: none;">'+
        '<input value="'+color+'" name="colorpickerEdit" type="color" class="w-100">'+
        '</div>'+


  		  '<div class="col-sm-12">Can Apply: ('+app+')</div>' +
  		  '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
  		    '<select id="edit_apply" class="form-control"  data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" required>' +
  		          '<option value="'+canapp+'"></option>' +
  		          '<option value="1">Yes</option>' +
  		          '<option value="0">Pending</option>' +
  		          '<option value="2">No</option>' +
  		    '</select>' +
  		  '</div>' 
  		);

      $("#allowOnLegendEdit").trigger('change');
       }
      function showDelete (id,desc){
          $('#DelModSpan').empty();
          $('#DelModSpan').append(
              '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
              '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
              '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
              '</div>'
            );
      }
      function deleteNow(){
  		var id = $("#toBeDeletedID").val();
  		var name = $("#toBeDeletedname").val();
  		$.ajax({
  			url : "{{ asset('employee/mf/del_transactionstatus') }}",
  			method: 'POST',
  			data: {_token:$('#token').val(),id:id},
  			success: function(data){
  			  if (data == 'DONE') {
            logActions('Deleted Transaction Status with ID: '+id);
  			    alert('Successfully deleted '+name);
  			    window.location.href = "{{ asset('employee/dashboard/mf/transactionstatus') }}";
  			  }
  			  else if (data == 'ERROR') {
  			      $('#DelErrorAlert').show(100);
  			  }
  			}, error : function(XMLHttpRequest, textStatus, errorThrown){
  			    console.log(errorThrown);
  			    $('#DelErrorAlert').show(100);
  			}
  		});
      }
      $('#addRgn').on('submit',function(event){
  	    event.preventDefault();
  	    var form = $(this);
  	    form.parsley().validate();
  	    if (form.parsley().isValid()) {
  	        var id = $('#new_rgnid').val();
  	        var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
  	        var test = $.inArray(id,arr);
  	        var isChecked = ($('#new_rgn_allow').is(":checked")) ? 1 : 0 ;
            var isCheckedLegend = ($('#allowOnLegend').is(":checked")) ? 1 : 0 ;
  	        if (test == -1) { // Not in Array
  	            $.ajax({
  	              method: 'POST',
  	              data: {
  	                _token : $('#token').val(),
  	                id: $('#new_rgnid').val(),
  	                name : $('#new_rgn_desc').val(),
  	                allowed : isChecked,
                    legend : isCheckedLegend,
  	                apply : $('#new_rgn_apply').val(),
                    color : $("[name=colorpickerAdd]").val()
  	              },
  	              success: function(data) {
  	                if (data == 'DONE') {
                        logActions('Added new Transaction Status with ID: '+ $('#new_rgnid').val());
  	                    alert('Successfully Added New Transaction Status');
  	                    window.location.href = "{{ asset('employee/dashboard/mf/transactionstatus') }}";
  	                } else if(data == 'ERROR'){
  	                  $('#AddErrorAlert').show(100);
  	                }
  	              }, error : function(XMLHttpRequest, textStatus, errorThrown){
  	                  console.log(errorThrown);
  	                  $('#AddErrorAlert').show(100);
  	              }
  	          });
  	        } else {
  	          alert('Transaction Status ID is already been taken');
  	          $('#new_rgnid').focus();
  	        }
  	    }
  	});
  	$('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              var isChecked = ($('#edit_allow').is(":checked")) ? 1 : 0 ;
              var isCheckedLegend = ($('#allowOnLegendEdit').is(":checked")) ? 1 : 0 ;
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var x = $('#edit_name').val();
                 var y = $('#edit_desc').val();
                 $.ajax({
                    url: "{{ asset('employee/mf/save_transactionstatus') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),id:x,name:y,allow:isChecked,legend:isCheckedLegend,color : $("[name=colorpickerEdit]").val(),apply:$('#edit_apply').val()},
                    success: function(data){
                        if (data == "DONE") {
                            logActions('Edited Transaction Status with ID: '+$('#edit_name').val());
                            alert('Successfully Edited Transaction Status');
                            window.location.href = "{{ asset('employee/dashboard/mf/transactionstatus') }}";
                        } else if (data == "ERROR") {
                            $('#EditErrorAlert').show(100);
                        }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#EditErrorAlert').show(100);
                    }
                 });
               }
          }); 
  </script> 
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif