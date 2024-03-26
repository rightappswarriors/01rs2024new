@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Discount Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PY001">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($discounts))
          @foreach ($discounts as $discount)
          <option value="{{$discount->id}}">{{$discount->description}}</option>
          @endforeach
        @endif
      </datalist> 
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Discount <span class="PY001_add"><a href="#" title="Add New Discount" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
          </div>
          <div class="card-body">
                 <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Date Range</th>
                    <th>Description</th>
                    <th>Percentage</th>
                    <th>Application Type</th>
                    <th>Status</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($discounts))
                  @foreach ($discounts as $discount)
                    <tr>
                      <td scope="row"> {{$discount->id}}</td>
                      <td>{{$discount->date_start}} - {{$discount->date_end}}</td>
                      <td>{{$discount->description}}</td>
                      <td>{{$discount->percentage}}</td>
                      <td>{{$discount->type}}</td>
                      <td>{{$discount->status == '1' ? 'Active' : 'Inactive'}}</td>
                      <td>
                        <center>
                          <span class="PY001_update">   
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$discount->id}}', '{{$discount->description}}', '{{$discount->percentage}}' , '{{$discount->type}}', '{{$discount->date_start}}', '{{$discount->date_end}}', '{{$discount->status}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="PY001_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$discount->id}}', '{{$discount->description}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
              <h5 class="modal-title text-center"><strong>Add Discount</strong></h5>
              <hr>
              <div class="container">
                <form id="addRgn" class="row"  data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="col-sm-4">Percentage:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" max="100" min="0" id="percentage" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="description" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Date Start:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="date" id="date_start" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Date End:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="date" id="date_end" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Application Type:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <select class="form-control" id="application_type">
                        <option value="Renewal">Renewal</option>
                        <option value="Initial">Initial</option>
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
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Order of Payment</strong></h5>
            <hr>
            <div class="container">
                  <form id="EditNow" data-parsley-validate>
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
  	      <h5 class="modal-title text-center"><strong>Delete Discount</strong></h5>
  	      <hr>
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
  	$(document).ready(function() {$('#example').DataTable();});
  	function showData(id,desc,percentage,type,date_start,date_end,status){

            if(status == '1'){
                status_html = '<input id="edit_status" type="checkbox"  value="1" id="edit_status" checked>';
            } else {
                status_html = '<input id="edit_status" type="checkbox" value="1" id="edit_status">';
            }

            $('#EditBody').empty();
            $('#EditBody').append(
                '<input type="hidden" id="edit_id" value="'+id+'">' +
                '<div class="col-sm-4">Percentage:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_percentage" value="'+percentage+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">Description:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">type:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_type" value="'+type+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">Date Start:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="date" id="edit_date_start" value="'+date_start+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">Date End:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="date" id="edit_date_end" value="'+date_end+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">Status:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                status_html +
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
            $.ajax({
              url : "{{ asset('employee/mf/del_discount') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                alert('Successfully deleted '+name);
                window.location.href = "{{ asset('/employee/dashboard/mf/discount') }}";
              }
            });
          }
      $('#addRgn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {


              $.ajax({
                method: 'POST',
                data: {
                    _token : $('#token').val(),
                    desc : $('#description').val(),
                    application_type : $('#application_type').val(),
                    date_start : $('#date_start').val(),
                    date_end : $('#date_end').val(),
                    percentage : $('#percentage').val(),
                    act: 'add',
                },
                success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added New Order of Payment');
                        window.location.href = "{{ asset('employee/dashboard/mf/discount') }}";
                    } else {
                    alert(data);
                    }
                }
            });
          }
      });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {

                 if($('#edit_status').is(':checked')){
                    status = '1';
                 } else {
                    status = '0';
                 }
                 $.ajax({
                    url: "{{ asset('employee/mf/save_discount') }}",
                    method: 'POST',
                    data : {
                        _token:$('#token').val(),
                        id:$('#edit_id').val(),
                        desc:$('#edit_desc').val(),
                        percentage:$('#edit_percentage').val(),
                        date_start:$('#edit_date_start').val(),
                        date_end:$('#edit_date_end').val(),
                        type:$('#edit_type').val(),
                        status:status,
                        mod_id : $('#CurrentPage').val()},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Discount');
                            window.location.href = "{{ asset('employee/dashboard/mf/discount') }}";
                        }
                    }
                 });
               }
          });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif