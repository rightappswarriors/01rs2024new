@if (session()->exists('employee_login'))
  @extends('mainEmployee')
  @section('title', 'Holidays Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="AP004">
  	<datalist id="rgn_list">
  		@if(isset($holidays))
  			@foreach ($holidays as $classs)
  				<option id="{{$classs->hdy_id}}_pro" value="{{$classs->hdy_id}}">{{$classs->hdy_desc}}</option>
  			@endforeach
  		@endif
  	</datalist>
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Holidays <span class="AP004_add"><a href="#" title="Add New Class" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             <div style="float:right;display: inline-block;">
              <form class="form-inline">
                <a href="#" title="View Calendar" data-toggle="modal" data-target="#CalendarModal"><button class="btn-primarys"><i class="fa fa-calendar"></i>&nbsp;View Calendar</button></a>        
                </form>
             </div>
          </div>
          <div class="card-body">
             <input type="" id="token" value="{{ Session::token() }}" hidden>
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: 20%">Code</th>
                    <th style="width: 30%">Description</th>
                    <th style="width: 10%">Date</th>
                    <th style="width: 10%"><center>Type</center></th>
                    <th style="width: 20%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody id="FilterdBody">
                  @if (isset($holidays))
                      @foreach ($holidays as $hly)
                      <tr>
                        <td>{{$hly->hdy_id}}</td>
                        <td style="font-weight: bold">{{$hly->hdy_desc}}</td>
                        <td data-order="{{$hly->hdy_date}}">{{$hly->formattedDate}}</td>
                        <td><center>{{$hly->hdy_typ}}</center></td>
                        <td><center>
                          <span class="AP004_update">
                          <button type="button" class="btn btn-outline-warning" onclick='showData("{{$hly->hdy_id}}", "{{$hly->hdy_desc}}");' data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          &nbsp;
                          <span class="AP004_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick='showDelete("{{$hly->hdy_id}}", "{{$hly->hdy_desc}}");' data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </center></td>
                      </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
          </div>
      </div>
  </div>
  {{-- Add --}}
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content" style="border-radius: 0px;border: none;">
  			<div class="modal-body" style=" background-color: #272b30;color: white;">
  				<h5 class="modal-title text-center"><strong>Add New Holiday</strong></h5>
  				<hr>
  				<div class="container">
  				  <form class="row" id="addCls" data-parsley-validate>
  				    {{ csrf_field() }}
  				    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
  				        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
  				        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
  				            <span aria-hidden="true">&times;</span>
  				        </button>
  				    </div>
  				    <div class="col-sm-4">Code:</div>
  				    <div class="col-sm-8"  style="margin:0 0 .8em 0;">
  				    <input type="text" id="new_code" data-parsley-required-message="*<strong>Code</strong> required" name="fname" class="form-control" required>
  				    </div>
  				    <div class="col-sm-4">Description:</div>
  				    <div class="col-sm-8" style="margin:0 0 .8em 0;">
  				    <input type="text" id="new_desc" name="fname" data-parsley-required-message="*<strong>Description</strong> required" class="form-control"  required>
  				    </div>
  				    <div class="col-sm-4">Date:</div>
  				    <div class="col-sm-8" style="margin:0 0 .8em 0;">
  				      <input type="date" id="new_dt" class="form-control" data-parsley-required-message="*<strong>Date</strong> required" name="" required>
  				    </div> 
  				    <div class="col-sm-4">Type:</div> 
  				    <div class="col-sm-8" style="margin:0 0 .8em 0">
  				      <select class="form-control" id="new_typ" data-parsley-required-message="*<strong>Type</strong> required" required>
  				        <option value=""></option>
  				        <option value="Regular">Regular</option>
  				        <option value="Special">Special</option>
  				      </select>
  				    </div>
  				    <div class="col-sm-12">
  				      <button type="submit" id class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
  				    </div> 
  				  </form>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>
  {{-- Edit --}}
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Holiday</strong></h5>
            <hr>
            <div class="container">
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
  {{-- Delete --}}
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color:white">
            <h5 class="modal-title text-center"><strong>Delete Holiday</strong></h5>
            <hr>
            <div class="container">
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
  {{-- Calendar --}}
  <div class="modal fade" id="CalendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #575c61;color: white;">
            <h5 class="modal-title text-center"><strong>Calendar</strong></h5>
            <hr>
            <div class="container">
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="CalendarFetchAlertError" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#CalendarFetchAlertError').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div id="CalendarMode">
              </div>
              <hr>
                <div class="row">
                    <div class="col-sm-8">
                  </div> 
                  <div class="col-sm-4">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;font-weight: bolder"><span class="fa fa-sign-up"></span>Close</button>
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
  	          "order": [[ 2, "asc" ]],
  	          // dom: 'Bfrtip',
  	          // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
          });	
          $('#CalendarMode').fullCalendar({
              themeSystem: 'bootstrap4',
              aspectRatio: 1.5,
              eventSources: [
                  // your event source
                  {
                    url: '{{ asset('employee/mf/getCalendarEvents') }}/1',
                    type: 'POST',
                    data: {
                      _token: $('#token').val()
                    },
                    error: function() {
                        $('#CalendarFetchAlertError').show(100);
                    },
                    color: 'yellow',   // a non-ajax option
                    textColor: 'black' // a non-ajax option
                  },

                  {
                    url: '{{ asset('employee/mf/getCalendarEvents') }}/2',
                    type: 'POST',
                    data: {
                      _token: $('#token').val()
                    },
                    error: function() {
                        $('#CalendarFetchAlertError').show(100);
                    },
                    color: 'green',   // a non-ajax option
                    textColor: 'white' // a non-ajax option
                  }
                ],
                eventRender: function(eventObj, $el) {
                    $el.popover({
                      title: eventObj.hdy_typ + ' Holiday',
                      content: eventObj.title,
                      trigger: 'hover',
                      placement: 'top',
                      container: 'body'
                    });
                  },
                  eventColor: '#378006',
          });
  	});
  	function showData(id,desc){
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4">ID:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_code" value="'+id+'" class="form-control disabled" disabled>' +
            '</div>' +
            '<div class="col-sm-4">Description:<span style="color:red;font-weight:bolder">*</span></div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong> Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
            '</div>' + 
            '<div class="col-sm-4">Date:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="date" id="edit_dt" class="form-control">' +
            '</div>'  +
            '<div class="col-sm-4">Type:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<select id="edit_typ" class="form-control">' +
                '<option value=""></option>'+
                '<option value="Regular">Regular</option>'+
                '<option value="Special">Special</option>'+
              '</select>' +
            '</div>' 
          );
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
  	        url : "{{ asset('employee/mf/del_holiday') }}",
  	        method: 'POST',
  	        data: {_token:$('#token').val(),id:id},
  	        success: function(data){
  	          if (data == 'DONE') {
                logActions('Deleted holiday with ID: '+id);
  	            alert('Successfully deleted '+name);
  	            window.location.href = "{{ asset('/employee/dashboard/mf/holidays') }}";
  	          } else {
  	            $('#DelErrorAlert').show(100);
  	          }
  	        }, error : function(XMLHttpRequest, textStatus, errorThrown){
  	          console.log(errorThrown);
  	          $('#DelErrorAlert').show(100);
  	        }
  	      });
      }
      $('#addCls').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              var id = $('#new_code').val();
              var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
              var test = $.inArray(id,arr);
              if (test == -1) { // Not in Array
                  $.ajax({
                    method: 'POST',
                    data: {
                      _token : $('#token').val(),
                      code: $('#new_code').val(),
                      desc : $('#new_desc').val(),
                      dat : $('#new_dt').val(),
                      typ: $('#new_typ').val()
                    },
                    success: function(data) {
                      if (data == 'DONE') {
                        logActions('Added new holiday with ID: '+ $('#new_code').val());
                          alert('Successfully Added New Holiday');
                          window.location.href = "{{ asset('employee/dashboard/mf/holidays') }}";
                      } else {
                        $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    }
                });
              } else {
                alert('Holiday Code is already been taken');
                $('#new_rgnid').focus();
              }
          }
      });
      $('#EditNow').on('submit',function(event){
        	event.preventDefault();
          var form = $(this);
          form.parsley().validate();
           if (form.parsley().isValid()) {
             var x = $('#edit_name').val();
             var y = $('#edit_desc').val();
             $.ajax({
                url: "{{ asset('employee/mf/save_holiday') }}",
                method: 'POST',
                data : {    
                          _token:$('#token').val(),
                          code: $('#edit_code').val(),
                          desc: $('#edit_desc').val(),
                          dt:   $('#edit_dt').val(),
                          typ:  $('#edit_typ').val(),
                        },
                success: function(data){
                    if (data == "DONE") {
                        logActions('Edited holiday with ID: '+$('#edit_code').val());
                        alert('Successfully Edited Holiday');
                        window.location.href = "{{ asset('/employee/dashboard/mf/holidays') }}";
                    } else {
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