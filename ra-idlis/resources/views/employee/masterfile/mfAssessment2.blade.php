@extends('mainEmployee')
@section('title', 'Assessment Master File')
@section('content')
{{--  @if (isset($asments))
   <datalist id="rgn_list">
   @foreach ($asments as $asment)
     <option id="{{$asment->asmt2_id}}_pro" value="{{$asment->asmt2_id}}">{{$asment->asmt2_id}}</option>
   @endforeach
 </datalist>
 @endif --}}
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal" {{-- onclick="$('#AddEditor').summernote('code','    ');" --}}><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>

        </div>
        <div class="card-body table-responsive">

        <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto;text-align: center;">ID</th>
                  <th style="width: auto;text-align: center;">Header</th>
                  <th style="width: auto;text-align: center;">Description</th>
                  <th style="width: 10%;">Options</th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                @isset ($asments)
                  @foreach ($asments as $e)
                    <tr>
                      <td style="text-align: center">{{$e->asmt2_id}}</td>
                      <td style="text-align: center">{{$e->asmt2_loc}}</td>
                      <td >{{$e->asmt2_desc}}</td>
                      <td><center>
                        <div class="row">
                          <span class="MA18_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$e->asmt2_id}}', '{{$e->asmt2_loc}}' , '{{$e->asmt2_desc}}', '{{$e->asmt2sd_id}}', '{{$e->asmt2sd_id}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                            </span>
                            <span class="MA18_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$e->asmt2_id}}', '{{$e->asmt2_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>&nbsp;
                          </span>
                          <span class="MA18_duplicate">
                            <button type="button" class="btn btn-outline-success" onclick="showDuplicate('{{$e->asmt2_id}}', '{{$e->asmt2_desc}}');" data-toggle="modal" data-target="#DupGodModal"><i class="fa fa-clone" aria-hidden="true"></i></button>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content " style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Add New Assessment</strong></h5>
                <hr>
                <div class="container">
                    <form id="addCls" class="row"  data-parsley-validate>
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
              {{-- <div class="col-sm-4">Title:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select id="new_rgn_seq" class="form-control" data-parsley-required-message="*<strong>Title</strong> required" required>
                  @isset($title)
                      <option value="">Select title...</option>
                      @foreach ($title as $l)
                        <option value="{{$l->title_code}}">{{$l->title_name}}</option>
                      @endforeach
                  @else
                    <option value="">No registered location.</option>
                  @endisset
                </select>
              </div> --}}
              <div class="col-sm-4">Header: </div>
              <div class="col-sm-6" style="margin:0 0 .8em 0;">
                  <input type="text" id="desc" class="form-control" data-parsley-required-message="*<strong>Header</strong> required" required disabled>
                  
                {{-- <textarea rows="10" class="form-control summernote" id="AddEditor" data-parsley-required-message="*<strong>Description</strong> required" required></textarea> --}}
              </div>
              <div class="col-sm-2">
                <button type="button" onclick="showSearchHeader();" class="form-control" style="cursor: pointer"><i class="fa fa-search" aria-hidden="true"></i></button>
              </div>
              <div class="col-sm-4">Description:</div>
             <div class="col-sm-8" style="margin:0 0 .8em 0;">
               <input type="text" data-parsley-required-message="*<strong>Description</strong> required" id="la_DesC" class="form-control" required>
             </div>
              <div class="col-sm-4">Sub-Description Code: </div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <input list="test" id="new_subDesc" class="form-control" onchange="getOneSubDesc()">
                <datalist id="test">
                  @isset ($sdesc)
                    <option value="">Select Sub-Description...</option>
                    @foreach ($sdesc as $s)
                      <option value="{{$s->asmt2sd_id}}">{{strip_tags($s->asmt2sd_desc)}}</option>
                    @endforeach
                  @else
                    <option value="">No Sub-Description registered...</option>
                  @endisset
                </datalist>
             </div>
             <div class="col-sm-12">Sub-Description: </div>
             <div class="col-sm-12"  style="margin:0 0 .8em 0;">
               <textarea rows="10" class="form-control summernote" id="AddEditor" data-parsley-required-message="*<strong>Description</strong> required" disabled></textarea>
               <script type="text/javascript">
                // $('#AddEditor').summernote('code','Select sub-description..<br><br>');
                // $('#AddEditor').summernote('disable');
              </script>
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
    <div class="modal-dialog modal-lg" role="document">
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

<div class="modal fade" id="DupGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Duplicate Assessment</strong></h5>
          <hr>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DupErrorAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#DupErrorAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <span id="DupModSpan"></span>
            <hr>
                <div class="row">
                  <div class="col-sm-6">
                  <button type="button" onclick="duplicateNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
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


<div class="modal fade" id="SearchHeaderModalEdit" tabindex="-1" role="dialog" aria-labelledby="Edit Modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Search Header</strong></h5>
          <hr>
          <form id="SubMitHeaderEdit" data-parsley-validate>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="SrcHeaderAlertEdit" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#SrcHeaderAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="row">
              <div class="col-sm-4">Header Level:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select class="form-control" id="new_modlvlEdit" data-parsley-required-message="*<strong>Header Level</strong> required" onchange="getTheLevelsEdit(this)" required>
                        <option value="">Select Header Level..</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                    </select>
              </div>
            </div>
            <div class="row" id="Add_mod_1Edit" style="display: none;">
                  <div class="col-sm-4">Header Level 1 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl1Edit" data-parsley-required-message="*<strong>Header Level 1</strong> required" onchange="getDatasAdd(this,1)">
                        <option value="">Select Header Level 1..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_2Edit" style="display: none;">
                  <div class="col-sm-4">Header Level 2 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl2Edit" data-parsley-required-message="*<strong>Header Level 2</strong> required" onchange="getDatasAdd(this,2)">
                        <option value="">Select Header Level 2..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_3Edit" style="display: none;">
                  <div class="col-sm-4">Header Level 3 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl3Edit" data-parsley-required-message="*<strong>Header Level 3</strong> required" onchange="getDatasAdd(this,3)">
                        <option value="">Select Header Level 3..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_4Edit" style="display: none;">
                  <div class="col-sm-4">Header Level 4 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl4Edit" data-parsley-required-message="*<strong>Header Level 4</strong> required" onchange="getDatasAdd(this,4)">
                        <option value="">Select Header Level 4..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_5Edit" style="display: none;">
                  <div class="col-sm-4">Header Level 5 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl5Edit" data-parsley-required-message="*<strong>Header Level 5</strong> required" onchange="getTheLevels(this)">
                        <option value="">Select Header Level 5..</option>
                    </select>
                  </div>
                </div>
              </form>
            <hr>
                <div class="row">
                  <div class="col-sm-6">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Ok</button>
                </div> 
                <div class="col-sm-6">
                  <button type="button" onclick="showSearchHeaderEdit()" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                </div>
                </div>
          </div>
        </div>
      </div>
    </div>




</div>
<script type="text/javascript">
	$(document).ready(function(){
    $('#example').DataTable();
    // $('#AddEditor').summernote('code','Select description..<br><br>');
    // $('#AddEditor').summernote('enable');
  });

  $(function(){
    if(sessionStorage.getItem("SelectedItem") != null){
      var selectedItem = sessionStorage.getItem("SelectedItem");
      $('input[type=search]').val(selectedItem).trigger('keyup');
    }
    $('input[type=search]').keyup(function() { 
      var dropVal = $(this).val();
      sessionStorage.setItem("SelectedItem", dropVal);
    });
  })

  let lastSelected;
	function showData(id, desc, loc, header, subDesc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-6">ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +   
              '<div class="col-sm-4">Header: </div>'+
              '<div class="ml-1 row">'+
                '<div class="col-sm-7" style="margin:0 0 .8em 0;">'+
                    '<input type="text" id="descEdit" value="'+desc+'" class="form-control" data-parsley-required-message="*<strong>Header</strong> required" required disabled>'+
                '</div>'+
                '<div class="col-sm-2">'+
                  '<button type="button" onclick="showSearchHeaderEdit();" class="form-control" style="cursor: pointer"><i class="fa fa-search" aria-hidden="true"></i></button>'+
                '</div>'+
              '</div>'+
              '<div class="col-sm-7">Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_faci" class="form-control" ata-parsley-required-message="<strong>*</strong>Location <strong>Required</strong>" value="'+loc+'" required>' +
              '</div>'+       
              '<div class="col-sm-6">Sub-Description Code:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input list="test1" value="'+subDesc+'" id="new_subDescEdit" class="form-control" data-parsley-required-message="*<strong>Sub-Description</strong> required" onchange="getOneSubDesc()">'+
                '<datalist id="test1">'+
                  @isset ($sdesc)               
                    '<option value="">Select Sub-Description...</option>'+
                    @foreach ($sdesc as $s)
                    @php
                    $desc = trim(preg_replace('/\s+/', ' ', $s->asmt2sd_desc));
                    @endphp
                      '<option value="{{$s->asmt2sd_id}}">{{strip_tags($desc)}}</option>'+
                    @endforeach
                  @else
                    '<option value="">No Sub-Description registered...</option>'+
                  @endisset
                '</datalist>'+
              '</div>'+
              '<div class="col-sm-6">Sub-Description:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<textarea rows="8" class="form-control" id="edit_desc"></textarea>'+
                '</div>'+
              '</div>'
            );
           // $("#new_rgn_seqEdit").val(title).trigger('change');
           var test = $('#new_subDescEdit').val();
            if (test != '') {
              $.ajax({
                url: '{{ asset('employee/mf/assessment/getSingleAssessment2') }}',
                method: 'GET',
                data: {_token:$('#token').val(), id:test},
                success: function(data){
                    if (data != null) {
                      $('#edit_desc').summernote('code',data.asmt2sd_desc);
                    }
                     else {
                        $('#edit_desc').summernote('code', '<br><br>');
                     }
                     $('.note-toolbar').hide();
                     $('#edit_desc').summernote('disable');
                },
                error : function(a, b, c){
                  console.log(c);
                }
              });
            }
            id, loc, header, subDesc = null;
        }

        $(function(){
          $(document).on('change keyup','#new_subDescEdit',function(){
            var test = $('#new_subDescEdit').val();
            if (test != '') {
              $.ajax({
                url: '{{ asset('employee/mf/assessment/getSingleAssessment2') }}',
                method: 'GET',
                data: {_token:$('#token').val(), id:test},
                success: function(data){
                    $('#edit_desc').summernote('reset');
                    if (data != null) {
                      $('#edit_desc').summernote('code',data.asmt2sd_desc);
                    }
                     else {
                        $('#edit_desc').summernote('code', '<br><br>');
                     }
                     $('.note-toolbar').hide();
                     $('#edit_desc').summernote('disable');
                },
                error : function(a, b, c){
                  console.log(c);
                }
              });
            }
          });
        })


    function showDuplicate(id,desc){
      $('#DupModSpan').empty();
      $('#DupModSpan').append(
          '<div class="col-sm-12"> Are you sure you want to duplicate <span style="color:green"><strong>' + desc + '</strong></span>?' +
          '<input type="text" id="toBeDupetedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
          '<input type="text" id="toBeDupetedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
          '</div>'
        );
    }
    function duplicateNow(){
      var id = $("#toBeDupetedID").val();
      var name = $("#toBeDupetedname").val();
      $('#DupErrorAlert').empty().hide();
      $.ajax({
        url : "{{ asset('employee/mf/assessment/dupAssessment2') }}",
        method: 'POST',
        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        success: function(data){
          let dataFromDB = data[0];
          $('#new_rgnid, #desc, #la_DesC, #new_subDesc').empty();
          $("#new_rgn_seq").val('');
          $('#new_rgnid').val(dataFromDB.asmt2_id);
          // $('#new_rgn_seq').val(dataFromDB.asmt2_title).trigger('change');
          $('#desc').val(dataFromDB.asmt2_loc).trigger('change');
          $('#la_DesC').val(dataFromDB.asmt2_desc);
          $('#new_subDesc').val(dataFromDB.asmt2sd_id).trigger('change');
          $('#DupGodModal').modal('toggle');
          $('#myModal').modal('toggle');
        }, error : function(){
          $('#DupErrorAlert').show(100);
        }
      });
      id,name;
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
        url : "{{ asset('employee/mf/assessment/del_assessment2') }}",
        method: 'POST',
        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        success: function(data){
         if (data == 'DONE') {
          alert('Successfully deleted '+name);
          location.reload();
        } else if (data == 'ERROR') {
            $('#DelErrorAlert').show(100);
        }
        }, error : function(){
          $('#DelErrorAlert').show(100);
        }
      });
    }
    function getOneSubDesc()
    {
      var test = $('#new_subDesc').val();
      if (test != '') {
        $.ajax({
          url: '{{ asset('employee/mf/assessment/getSingleAssessment2') }}',
          method: 'GET',
          data: {_token:$('#token').val(), id:test},
          success: function(data){
              if (data != null) {
                $('#AddEditor').summernote('code',data.asmt2sd_desc);
              }
               else {
                  $('#AddEditor').summernote('code', '<br><br>');
               }
               $('.note-toolbar').hide();
               $('#AddEditor').summernote('disable');
          },
          error : function(a, b, c){
            console.log(c);
          }
        });
      }
    }
    function showSearchHeader()
    {
      $('#myModal').modal('toggle');
      $('#SearchHeaderModal').modal('toggle');
    }

    function showSearchHeaderEdit()
    {
      $('#GodModal').modal('toggle');
      $('#SearchHeaderModalEdit').modal('toggle');
    }
    function getTheLevels(who){
        let selectedLevel = ($(who).val());
        let selectCount = $("div.modal select").length;
        let i;
        let h;
        if(typeof(lastSelected) != 'undefined'){
          if(lastSelected > selectedLevel){
            for (h = lastSelected; h > selectedLevel; h--) {
              if($('#Add_mod_'+h).length > 0){
              $('#Add_mod_'+h).hide();
              $('#new_modlvl'+h).removeAttr('required');
            }
            }
          }
        }
      if(selectedLevel >= 1){
        for (i = 1; i <= selectedLevel; i++) {
          if($('#Add_mod_'+i).length > 0){
            $('#Add_mod_'+i).show();
            $('#new_modlvl'+i).attr('required','');
            lastSelected = i;
          }
      }
        }
        loadLevelHeaderFilterAdd(selectedLevel)
    }
    function getTheLevelsEdit(who){
        let selectedLevel = ($(who).val());
        let selectCount = $("div.modal select").length;
        let i;
        let h;
        if(typeof(lastSelected) != 'undefined'){
          if(lastSelected > selectedLevel){
            for (h = lastSelected; h > selectedLevel; h--) {
              if($('#Add_mod_'+h+'Edit').length > 0){
              $('#Add_mod_'+h+'Edit').hide();
              $('#new_modlvl'+h+'Edit').removeAttr('required');
            }
            }
          }
        }
      if(selectedLevel >= 1){
        for (i = 1; i <= selectedLevel; i++) {
          if($('#Add_mod_'+i+'Edit').length > 0){
            $('#Add_mod_'+i+'Edit').show();
            $('#new_modlvl'+i+'Edit').attr('required','');
            lastSelected = i;
          }
      }
        }
        loadLevelHeaderFilterAddEdit(selectedLevel)
    }
  function loadLevelHeaderFilterAdd(lvl)
  {
    if(lvl >=1 ){
      $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvlFilter') }}',
              method : 'GET',
              data: {_token:$('#token').val(),modlvl:1},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                        $('#new_modlvl1').empty();
                         for (var i = 0; i < data.length; i++) {
                            $('#new_modlvl1').append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+'-'+data[i].asmt2l_desc+'</option>');
                         }
                         $('#new_modlvl1').trigger('change');
                    } else {
                       alert('NO DATA');
                    }
                }
                else if (data == 'ERROR') {
                  $('#ERROR_MSG2').show(100);   
                }
              },
              error : function(a,b,c){
                console.log(c);
                $('#ERROR_MSG2').show(100);   
              }
          });
    }
  }
    function loadLevelHeaderFilterAddEdit(lvl)
  {
    if(lvl >=1 ){
      $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvlFilter') }}',
              method : 'GET',
              data: {_token:$('#token').val(),modlvl:1},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                        $('#new_modlvl1Edit').empty();
                         for (var i = 0; i < data.length; i++) {
                            $('#new_modlvl1Edit').append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+'-'+data[i].asmt2l_desc+'</option>');
                         }
                         $('#new_modlvl1Edit').trigger('change');
                    } else {
                       alert('NO DATA');
                    }
                }
                else if (data == 'ERROR') {
                  $('#ERROR_MSG2').show(100);   
                }
              },
              error : function(a,b,c){
                console.log(c);
                $('#ERROR_MSG2').show(100);   
              }
          });
    }
  }
  function getDatasAdd(who,level){
      let valWho = $(who).val();
      $.ajax({
        url : '{{ asset('employee/dashboard/manage/getlvlFilterFromLevel') }}',
        method : 'GET',
        data: {_token:$('#token').val(),modlvl:valWho,level:level},
        success : function(data) {
          $(who).parent().parent().next().children().children().empty().append('<option value="">Please select Data</option>');
          if(data.length < 0){
            $(who).parent().parent().next().children().children().append('<option value="">NO DATA FOUND</option>');
          } else {
              if($(who).parent().parent().next().children().children().length > 0){
                for (var i = 0; i < data.length; i++) {
                      $(who).parent().parent().next().children().children().append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'</option>');
                  }
              }
            }
        }
      });      
    }
  $(document).on('submit','#SubMitHeader',function(eveny){
    event.preventDefault();
    var form = $(this);
    form.parsley().validate();
    if (form.parsley().isValid()) {
        var selectedid = $('#new_modlvl').val();
        var AddToHead = $('#new_modlvl' + selectedid).val();
        $('#desc').val(AddToHead);
        showSearchHeader();
        $('#addCls').submit();
    }
  });

  $(document).on('submit','#SubMitHeaderEdit',function(eveny){
    event.preventDefault();
    var form = $(this);
    form.parsley().validate();
    if (form.parsley().isValid()) {
        var selectedid = $('#new_modlvlEdit').val();
        var AddToHead = $('#new_modlvl' + selectedid + 'Edit').val();
        console.log(selectedid);
        $('#descEdit').empty().val(AddToHead);
        showSearchHeaderEdit();
    }
  });

  $('#addCls').on('submit',function(event){
      event.preventDefault();
      var form = $(this);
      form.parsley().validate();
      if (form.parsley().isValid()) {
          var id = $('#new_rgnid').val();
          var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
          var test = $.inArray(id,arr);
          var hasRemarks = $('#defaultCheck1').is(':checked') ? 1 : 0;

          // console.log(test);
          // if (test == -1) { // Not in Array
              $.ajax({
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: id.toUpperCase(),
                  // title : $('#new_rgn_seq').val(),
                  header : $('#desc').val(),
                  desc : $('#la_DesC').val(),
                  sub_desc : $('#new_subDesc').val(),
                  mod_id : $('#CurrentPage').val(),
                  hasRemarks : hasRemarks,
                },
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New Assessment');
                      location.reload();
                  } else if (data == 'ERROR') {
                      $('#AddErrorAlert').show(100);
                  }  else if (data == 'SAME') {
                    alert('Assessment ID is already been taken');
                    $('#new_rgnid').focus();
                  }
                }, error: function(XMLHttpRequest, textStatus, errorThrown){
                    $('#AddErrorAlert').show(100);
                }
            });
          // } else {
            // alert('Assessment ID is already been taken');
            // $('#new_rgnid').focus();
          // }
      }
  });

  $('#EditNow').on('submit',function(event){
        event.preventDefault();
          var form = $(this);
          form.parsley().validate();
           if (form.parsley().isValid()) {
             var x = $('#edit_name').val(); //id
             var y = $('#edit_faci').val(); //description
             var z = $('#descEdit').val(); //header
             var a = $('#new_subDescEdit').val(); // subdescription
             $.ajax({
                url: "{{ asset('employee/mf/assessment/save_assessment2') }}",
                method: 'POST',
                data : {
                  _token:$('#token').val(),
                  id:x,
                  name:y,
                  header:z,
                  subDesc:a,
                  mod_id : $('#CurrentPage').val()
                },
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited Assessment');
                        location.reload();
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
<div class="modal fade" id="SearchHeaderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form id="SubMitHeader" data-parsley-validate>
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Search Header</strong></h5>
          <hr>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="SrcHeaderAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#SrcHeaderAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="row">
              <div class="col-sm-4">Header Level:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select class="form-control" id="new_modlvl" data-parsley-required-message="*<strong>Header Level</strong> required" onchange="getTheLevels(this)" required>
                        <option value="">Select Header Level..</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                    </select>
              </div>
            </div>
            <div class="row" id="Add_mod_1" style="display: none;">
                  <div class="col-sm-4">Header Level 1 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl1" data-parsley-required-message="*<strong>Header Level 1</strong> required" onchange="getDatasAdd(this,1)">
                        <option value="">Select Header Level 1..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_2" style="display: none;">
                  <div class="col-sm-4">Header Level 2 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl2" data-parsley-required-message="*<strong>Header Level 2</strong> required" onchange="getDatasAdd(this,2)">
                        <option value="">Select Header Level 2..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_3" style="display: none;">
                  <div class="col-sm-4">Header Level 3 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl3" data-parsley-required-message="*<strong>Header Level 3</strong> required" onchange="getDatasAdd(this,3)">
                        <option value="">Select Header Level 3..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_4" style="display: none;">
                  <div class="col-sm-4">Header Level 4 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl4" data-parsley-required-message="*<strong>Header Level 4</strong> required" onchange="getDatasAdd(this,4)">
                        <option value="">Select Header Level 4..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_5" style="display: none;">
                  <div class="col-sm-4">Header Level 5 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl5" data-parsley-required-message="*<strong>Header Level 5</strong> required" onchange="getTheLevels(this)">
                        <option value="">Select Header Level 5..</option>
                    </select>
                  </div>
                </div>
              
            <hr>
                <div class="row">
                  <div class="col-sm-6">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Ok</button>
                </div> 
                <div class="col-sm-6">
                  <button type="button" onclick="showSearchHeader()" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                </div>
                </div>
          </div>
        </div>
      </div>
      </form>
    </div>
@endsection