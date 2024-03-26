@extends('mainEmployee')
@section('title', 'Assessment Master File')
@section('content')
@if (isset($parts) && isset($asments))
    @foreach ($parts as $part)
   <datalist id="{{$part->partid}}_list">
     @foreach ($asments as $asment)
       @if ($part->partid == $asment->partid)
          <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
       @endif
     @endforeach
   </datalist>
  @endforeach
@endif
 @if (isset($asments))
   <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt_id}}_pro" value="{{$asment->asmt_id}}">{{$asment->asmt_name}}</option>
   @endforeach
 </datalist>
 @endif
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           <div style="float:right;display: inline-block;">
            <form class="form-inline" style="margin:0 0 .8em 0;">
              <label>Filter By: &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer" onchange="getFilterBy()">
                <option value="">None</option>
                <option value="1">By Facility</option>
                <option value="2">By Part</option>
                <option value="3">By Category</option>
                {{-- @if (isset($parts))
                  @foreach ($parts as $part)
                    <option value="{{$part->partid}}">{{$part->partdesc}}</option>
                  @endforeach
                @endif --}}
              </select>
            </form>
            <div style="float:right;display: inline-block;">
             <form class="form-inline">
                <select style="width: auto;" class="form-control" id="theslots" onchange="getDataNow()">
                    <option value="">Select type of filter..</option>
                </select>
             </form>
           </div>
           </div>

        </div>
        <div class="card-body table-responsive">

        <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto;text-align: center;">Facility</th>
                  <th style="width: 10%;text-align: center;">Part</th>
                  <th style="width: 10%;text-align: center;">Category</th>
                  <th style="width: 10%;text-align: center;">ID</th>
                  <th style="width: auto;text-align: center;">Description</th>
                  <th style="width: 10%;">Options</th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                @isset ($asments)
                  @foreach ($asments as $e)
                    <tr>
                      <td style="text-align: center">{{$e->hgpdesc}}</td>
                      <td style="text-align: center">{{$e->partid}}</td>
                      <td style="text-align: center">{{$e->caid}}</td>
                      <td style="text-align: center">{{$e->asmt_id}}</td>
                      <td>{{$e->asmt_name}}</td>
                      <td><center>
                        <div class="row">
                          <span class="MA18_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$e->asmt_id}}', '{{$e->asmt_name}}', '{{$e->categorydesc}}', '{{$e->hgpdesc}}', '{{$e->partdesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                            </span>
                            <span class="MA18_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$e->asmt_id}}', '{{$e->asmt_name}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </div>
                      </center></td>
                    </tr>
                  @endforeach
                @endisset
              </tbody>
            </table>
        </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Add New Assessment</strong></h5>
                <hr>
                <div class="container">
                    <form class="row" id="addCls" data-parsley-validate>
                    	<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                    		<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
	                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
	                            <span aria-hidden="true">&times;</span>
	                        </button>
                    	</div>
                    	{{ csrf_field() }}
                    	<div class="col-sm-4">Facility:</div>
	                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                      <select id="faci" class="form-control" data-parsley-required-message="*<strong>Facility</strong> required" required>
	                        <option value=""></option>
	                        @isset ($faci)
	                          @foreach ($faci as $t)
	                            <option value="{{$t->hgpid}}">{{$t->hgpdesc}}</option>
	                          @endforeach                            
	                        @endisset                        
	                      </select>
	                    </div>
	                    <div class="col-sm-4">Part:</div>
	                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                      <select id="partid" data-parsley-required-message="*<strong>Part</strong> required" class="form-control" required>  
	                          <option value="">Select Part ...</option>
	                          @if (isset($parts))
	                            @foreach ($parts as $part)
	                              <option value="{{$part->partid}}">{{$part->partdesc}}</option>
	                            @endforeach
	                          @endif
	                      </select>
	                    </div>
	                    <div class="col-sm-4">Category</div>
	                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                      <select id="caid" class="form-control" data-parsley-required-message="*<strong>Category</strong> required" required>
	                        <option value=""></option>
	                        @isset($cat)
	                            @foreach ($cat as $c)
	                              <option value="{{$c->caid}}">{{$c->categorydesc}}</option>
	                            @endforeach
	                        @endisset                        
	                      </select>
	                    </div>
	                    {{-- <div class="col-sm-4">ID:</div>
	                    <div class="col-sm-8"  style="margin:0 0 .8em 0;">
	                    	<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
	                    </div> --}}
	                    <div class="col-sm-4">Description:</div>
	                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                    <textarea  id="new_rgn_desc" name="fname" rows="5" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required></textarea>                    
	                    </div>
	                    <div class="col-sm-12">
	                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
          <h5 class="modal-title text-center"><strong>Edit Assessment</strong></h5>
          <hr>
          <div class="container">
                <form id="EditNow" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
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
          <h5 class="modal-title text-center"><strong>Delete Assessment</strong></h5>
          <hr>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <span id="DelModSpan"></span>
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
	$(document).ready(function(){$('#example').DataTable();});
  function getFilterBy(){
    var selected = $('#filterer').val();
    if (selected != '') {
        $('#theslots').empty();
            switch(selected){
              case "1":
                    $('#theslots').append(
                      @isset($faci)
                              '<option value="">Select Facility..</option>' +
                        @for($i = 0;$i < count($faci); $i++)
                            @if ($i != (count($faci) -1)) 
                              '<option value="{{$faci[$i]->hgpid}}">{{$faci[$i]->hgpdesc}}</option>' +
                              @else 
                              '<option value="{{$faci[$i]->hgpid}}">{{$faci[$i]->hgpdesc}}</option>'
                            @endif
                        @endfor
                      @else
                        '<option value=">No Data</option>'
                      @endisset
                      );
                break;
              case "2":
                    $('#theslots').append(
                      @isset($parts)
                              '<option value="">Select Part..</option>' +
                        @for($i = 0;$i < count($parts); $i++)
                            @if ($i != (count($parts) -1)) 
                              '<option value="{{$parts[$i]->partid}}">{{$parts[$i]->partdesc}}</option>' +
                              @else 
                              '<option value="{{$parts[$i]->partid}}">{{$parts[$i]->partdesc}}</option>'
                            @endif
                        @endfor
                      @else
                        '<option value=">No Data</option>'
                      @endisset
                      );
                break;
              case "3":
                    $('#theslots').append(
                      @isset($cat)
                              '<option value="">Select Category..</option>' +
                        @for($i = 0;$i < count($cat); $i++)
                            @if ($i != (count($cat) -1)) 
                              '<option value="{{$cat[$i]->caid}}">{{$cat[$i]->categorydesc}}</option>' +
                              @else 
                              '<option value="{{$cat[$i]->caid}}">{{$cat[$i]->categorydesc}}</option>'
                            @endif
                        @endfor
                      @else
                        '<option value=">No Data</option>'
                      @endisset
                      );
                break;
              default:
                    $('#theslots').append('<option value="">No Data</option>');
                break;
            }
    } else {
      $('#theslots').empty();
      $('#theslots').append('<option value="">Select type of filter..</option>');
    }
  }
  function getDataNow()
  {
    var selected = $('#filterer').val();
    var id =$('#theslots').val();
    var table = $('#example').DataTable();
    if (id!='') {
      $.ajax({
            url : '{{ asset('employee/mf/assessment/getfiltered_assessment') }}',
            method : 'GET',
            data : {_token:$('#token').val(), selected : selected, id :id},
            success : function(data){
                  if (data == 'ERROR') 
                  {
                    $('#ERROR_MSG2').show(100);
                  }
                  else if(data =='NODATA') 
                  {
                    table.clear().draw();
                  }
                  else
                  { 
                    table.clear().draw();
                    if(data.length != 0)
                    {
                      for (var i = 0; i < data.length; i++) {
                        table.row.add([
                            '<center>'+data[i].hgpdesc+'</center>',
                            '<center>'+data[i].partid+'</center>',
                            '<center>'+data[i].caid+'</center>',
                            '<center>'+data[i].asmt_id+'</center>',
                            data[i].asmt_name,
                            '<div class="row">' +
                            '<span class="MA18_update">' +
                              '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].asmt_id+'\', \''+data[i].asmt_name+'\', \''+data[i].categorydesc+'\', \''+data[i].hgpdesc+'\', \''+data[i].partdesc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;' +
                              '</span>' +
                              '<span class="MA18_cancel">' +
                              '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].asmt_id+'\', \''+data[i].asmt_name+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
                            '</span>' +
                          '</div>'

                          ]).draw();
                      }
                    }
                  }
            },
            error : function(a,b,c){
              console.log(c);
              $('#ERROR_MSG2').show(100);
            },
      });
    }
    else {
      $.ajax({
          url :'{{ asset('employee/mf/assessment/getAllAssessment') }}',
          method : 'GET',
           data : {_token:$('#token').val()},
           success : function(data){
            if (data == 'ERROR') {
                $('#ERROR_MSG2').show(100);
            } else {
                table.clear().draw();
                if(data.length != 0)
                {
                  for (var i = 0; i < data.length; i++) {
                    table.row.add([
                      '<center>'+data[i].hgpdesc+'</center>',
                      '<center>'+data[i].partid+'</center>',
                      '<center>'+data[i].caid+'</center>',
                      '<center>'+data[i].asmt_id+'</center>',
                      data[i].asmt_name,
                      '<div class="row">' +
                        '<span class="MA18_update">' +
                          '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].asmt_id+'\', \''+data[i].asmt_name+'\', \''+data[i].categorydesc+'\', \''+data[i].hgpdesc+'\', \''+data[i].partdesc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;' +
                          '</span>' +
                          '<span class="MA18_cancel">' +
                          '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].asmt_id+'\', \''+data[i].asmt_name+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
                        '</span>' +
                      '</div>'
                    ]).draw();
                  }
                }
            }
           },
           error : function(a,b,c){
              console.log(c);
              $('#ERROR_MSG2').show(100);
            },
      });
    }
  }
	function showData(id,desc, cat, facname, partdesc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-6">ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +   
              '<div class="col-sm-7">Facility: ('+facname+')</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<select id="edit_faci" class="form-control">' +
                  '<option value=""></option>' +
                  @isset ($faci)
                      @foreach ($faci as $f)
                        '<option value="{{$f->hgpid}}">{{$f->hgpdesc}}</option>' +
                      @endforeach
                  @endisset
                '</select>' +
              '</div>' +  
              '<div class="col-sm-7">Category: ('+cat+')</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<select id="edit_cat" class="form-control">' +
                  '<option value=""></option>' +
                  @isset ($cat)
                      @foreach ($cat as $c)
                        '<option value="{{$c->caid}}">{{$c->categorydesc}}</option>' +
                      @endforeach
                  @endisset
                '</select>' +
              '</div>' + 
              '<div class="col-sm-7">Part: ('+partdesc+')</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<select id="edit_prt" class="form-control">' +
                  '<option value=""></option>' +
                  @isset ($parts)
                      @foreach ($parts as $p)
                        '<option value="{{$p->partid}}">{{$p->partdesc}}</option>' +
                      @endforeach
                  @endisset
                '</select>' +
              '</div>' +          
              '<div class="col-sm-6">Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<textarea rows="5" type="text" id="edit_desc" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>'+desc+'</textarea>' +
              '</div>' 
            );
        }
    function showDelete (id,desc){
            $('#DelModSpan').empty();
            $('#DelModSpan').append(
                '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
                  // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
                '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
                '</div>'
              );
        }
    function deleteNow(){
      var id = $("#toBeDeletedID").val();
      var name = $("#toBeDeletedname").val();
      $.ajax({
        url : "{{ asset('employee/mf/assessment/del_assessment') }}",
        method: 'POST',
        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        success: function(data){
         if (data == 'DONE') {
          alert('Successfully deleted '+name);
          window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
        } else if (data == 'ERROR') {
            $('#DelErrorAlert').show(100);
        }
        }, error : function(){
          $('#DelErrorAlert').show(100);
        }
      });
    }
    $('#addCls').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
            var id = $('#new_rgnid').val();
            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
            var test = $.inArray(id,arr);
            if (test == -1) { // Not in Array
                $.ajax({
                  method: 'POST',
                  data: {
                    _token : $('#token').val(),
                    id: $('#new_rgnid').val(),
                    name : $('#new_rgn_desc').val(),
                    partid : $('#partid').val(),
                    caid : $('#caid').val(),
                    faci : $('#faci').val(),
                    mod_id : $('#CurrentPage').val(),
                  },
                  success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added New Assessment');
                        window.location.href = "{{ asset('employee/dashboard/mf/assessment') }}";
                    } else if (data == 'ERROR') {
                        $('#AddErrorAlert').show(100);
                    } 
                  }, error: function(XMLHttpRequest, textStatus, errorThrown){
                      $('#AddErrorAlert').show(100);
                  }
              });
            } else {
              alert('Assessment ID is already been taken');
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
               var faci = $('#edit_faci').val();
               var cat = $('#edit_cat').val();
               var part = $('#edit_prt').val();
               $.ajax({
                  url: "{{ asset('employee/mf/assessment/save_assessment') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val(), faci : faci, cat : cat, part : part},
                  success: function(data){
                      if (data == "DONE") {
                          alert('Successfully Edited Assessment');
                          window.location.href = "{{ asset('/employee/dashboard/mf/assessment') }}";
                      } else if (data == 'ERROR') {
                          $('#EditErrorAlert').show(100);
                      }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      $('#EditErrorAlert').show(100);
                  }
               });
             }
        });
</script>
@endsection