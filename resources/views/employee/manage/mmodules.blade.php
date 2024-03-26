@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Module - Manage')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="MG006">
  <div class="content p-4">
      <datalist id="grp_list">
        @if (isset($Mods))
          @foreach ($Mods as $Mod)
            <option value="{{$Mod->mod_id}}">{{$Mod->mod_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Modules <a href="#" title="Add New Module" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
             <div style="float:right;display: inline-block;">
              <form class="form-inline">
                <label>Filter : &nbsp;</label>
                <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()" >
                  <option value="">Select Level ...</option>
                  <option value="1">Level 1</option>
                  <option value="2">Level 2</option>
                  <option value="3">Level 3</option>
                </select> &nbsp;
                <span id="filterer1span" style="width: auto;display: none">
                <select  class="form-control" id="filterer1" onchange="filterGetLevel2()">
                  <option value="">Select Module Level 1 ...</option>
                </select> &nbsp;
                </span>
                <span id="filterer2span" style="width: auto;display: none">
                <select class="form-control" id="filterer2" onchange="filterGetLevel3()">
                  <option value="">Select Module Level 2 ...</option>
                </select>
                </span>
                </form>
             </div>
          </div>
          <div class="card-body table-responsive">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: auto">ID</th>
                    <th style="width: auto">Description</th>
                    <th style="width: auto">Level</th>
                    <th style="width: auto"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @if (isset($Mods))
                  @foreach ($Mods as $Mod)
                    <tr>
                      <td scope="row"> {{$Mod->mod_id}}</td>
                      <td>{{$Mod->mod_desc}}</td>
                      <td>
                        <center>
                          <span class="">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$Mod->mod_id}}', '{{$Mod->mod_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$Mod->mod_id}}', '{{$Mod->mod_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </center>
                      </td>
                    </tr>
                  @endforeach
                  @endif --}}
                </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Add New Module</strong></h5>
            <hr>
            <form id="NewRight" action="#" class="container" data-parsley-validate>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
               <div class="row">
                  <div class="col-sm-4">Module ID :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_modid" class="form-control" data-parsley-required-message="*<strong>Module ID</strong> required" required>
                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-4">Module Name :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <input type="text" id="new_rightdesc" class="form-control" data-parsley-required-message="*<strong>Module Name</strong> required" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">Module Level :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    {{-- <input type="text" id="" class="form-control" data-parsley-required-message="*<strong>Right name</strong> required" required> --}}
                    <select class="form-control" id="new_modlvl" data-parsley-required-message="*<strong>Module Level</strong> required" onchange="getTheLevels()" required>
                        <option value="">Select Module Level..</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_1" style="display: none;">
                  <div class="col-sm-4">Module Level 1 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl1" data-parsley-required-message="*<strong>Module Level 1</strong> required" onchange="getTheLevels2()">
                        <option value="">Select Module Level 1..</option>
                    </select>
                  </div>
                </div>
                <div class="row" id="Add_mod_2" style="display: none;">
                  <div class="col-sm-4">Module Level 2 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl2" data-parsley-required-message="*<strong>Module Level 2</strong> required">
                        <option value="">Select Module Level 2..</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Module</button>
                </div>
              </form>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Module</strong></h5>
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
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Delete Module</strong></h5>
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
  <script type="text/javascript">
  	$(document).ready(function(){$('#example').DataTable();});
  	function showData(id,desc){
            $('#EditBody').empty();
            $('#EditBody').append(
                '<div class="col-sm-8">Module ID:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
                '</div>' +
                '<div class="col-sm-8">Module Description:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
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
      function getTheLevels(){
        //  Add_mod_1  new_modlvl1 Add_mod_2 new_modlvl2
        var selectedLevel = $('#new_modlvl').val();
        if (selectedLevel == "1" || selectedLevel == "") {
          $('#Add_mod_1').hide();
          $('#new_modlvl1').removeAttr('required');
          $('#Add_mod_2').hide();
          $('#new_modlvl2').removeAttr('required');
        }
        else if (selectedLevel == "2") {
          $('#Add_mod_1').show();
          $('#new_modlvl1').attr('required', '');
          $('#Add_mod_2').hide();
          $('#new_modlvl2').removeAttr('required');
          loadLevel1Modules(selectedLevel);
        } else if (selectedLevel == "3") {
          $('#Add_mod_1').show();
          $('#new_modlvl1').attr('required', '');
          $('#Add_mod_2').show();
          $('#new_modlvl2').attr('required', '');
          loadLevel1Modules(selectedLevel);
        } 
      }
      function loadLevel1Modules(lvl)
      {
        if (lvl == "2" || lvl == "3") {
          $('#new_modlvl1').empty();
          $('#new_modlvl2').empty();
          $('#new_modlvl2').append('<option val="">Select Module Level 1 first.</option>');
          $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvl1module') }}',
              method : 'GET',
              data: {_token:$('#token').val()},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                         $('#new_modlvl1').append('<option value="">Select Module Level 1..</option>');
                         for (var i = 0; i < data.length; i++) {
                            $('#new_modlvl1').append('<option value="'+data[i].mod_id+'">'+data[i].mod_id+' - '+data[i].mod_desc+'</option>');
                         }
                    } else {
                       $('#new_modlvl1').append('<option value="">No Module Level 1</option>');
                       $('#new_modlvl2').append('<option value="">No Module Level 1 to be selected</option>');
                    }
                }
                else if (data == 'ERROR') {
                  $('#AddErrorAlert').show(100);   
                }
              },
              error : function(a,b,c){
                console.log(c);
                $('#AddErrorAlert').show(100);   
              }
          });
        }
      }
      function getTheLevels2()
      {
        var mod_lvl = $('#new_modlvl').val();
        var mod_l1 = $('#new_modlvl1').val();
        $('#new_modlvl2').empty();
        if (mod_lvl == '3') {
          if (mod_l1 != "") {
            $.ajax({
                url : '{{ asset('employee/dashboard/manage/getlvl2module') }}',
                method : 'GET',
                data : {_token:$('#token').val(), mod_l1 : mod_l1},
                success : function(data){
                    if (data != 'ERROR') {
                        if (data.length != 0) {
                            $('#new_modlvl2').append('<option value="">Select Module Level 2</option>');
                            for (var i = 0; i < data.length; i++) {
                              $('#new_modlvl2').append('<option value="'+data[i].mod_id+'">'+data[i].mod_id+' - '+data[i].mod_desc+'</option>');
                            }
                        } else {
                          $('#new_modlvl2').append('<option value="">No Module Level 2 registered</option>');
                        }
                    } else {
                      $('#AddErrorAlert').show(100);                     
                    }
                },
                error : function(a, b, c){
                  console.log(c);
                  $('#AddErrorAlert').show(100); 
                },
            });
          } else {
            $('#new_modlvl1').append('<option value="">Select Module Level 1..</option>');
          } 
        } else {
          $('#new_modlvl2').append('<option value="">Select Module Level 2..</option>');
        }
      }
      function filterGroup()
      {
        var mod_lvl =  $('#filterer').val();
        var url =" ";
        if (mod_lvl != '') {
            if (mod_lvl == "1") {
              $('#filterer1span').hide();
              $('#filterer2span').hide();
              loadLevel1ModulesFilter();
            } else if (mod_lvl == "2") {
              $('#filterer1span').show();
              $('#filterer2span').hide();
              $('#example').DataTable().clear().draw();
              loadLevel1ModulesFilter();

            } else if (mod_lvl == "3") {
              $('#filterer1span').show();
              $('#filterer2span').show();
              $('#example').DataTable().clear().draw();
              loadLevel1ModulesFilter();
            }
        } else {
          $('#filterer1span').hide();
          $('#filterer2span').hide();
          $('#example').DataTable().clear().draw();
        }
      }
      function loadLevel1ModulesFilter(){
        var mod_lvl =  $('#filterer').val();
        if (mod_lvl == "1") {
          $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvl1module') }}',
              method : 'GET',
              data: {_token:$('#token').val()},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                        $('#example').DataTable().clear().draw();
                         for (var i = 0; i < data.length; i++) {
                            // $('#new_modlvl1').append('<option value="'+data[i].mod_id+'">'+data[i].mod_id+' - '+data[i].mod_desc+'</option>');
                            $('#example').DataTable().row.add([
                                  data[i].mod_id,
                                  data[i].mod_desc,
                                  data[i].mod_lvl,
                                  '<center>' +
                                    '<span class="MG006_update">' +
                                      '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                                    '</span>&nbsp;' +
                                    '<span class="MG006_cancel">' +
                                      '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
                                  '</span>' +
                                  '</center>'

                              ]).draw();
                         }
                    } else { // No Data
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
        else if (mod_lvl == "2" || mod_lvl == "3") {
            $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvl1module') }}',
              method : 'GET',
               data: {_token:$('#token').val()},
              success : function(data) {// filterer1
                  $('#filterer1').empty();
                  if (data.length != 0) {
                      $('#filterer1').append('<option value="">Select Module Level 1 ...</option>');
                      for (var i = 0; i < data.length; i++) {
                        $('#filterer1').append('<option value="'+data[i].mod_id+'">'+data[i].mod_id+'-'+data[i].mod_desc+'</option>');
                      }
                  } else if (data.length == 0) {
                      $('#filterer1').append('<option value="">No Level 1 Module Available</option>');
                  } else if (data == 'ERROR') {
                      $('#ERROR_MSG2').show(100);  
                  }
              },
              error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);  
              }
            });
        }
      }
      function filterGetLevel2()
      {
       var mod_lvl =  $('#filterer').val();
       var mod_l1 = $('#filterer1').val();
       if (mod_lvl == "2") {
          if (mod_l1 != '') {
            $.ajax({
              url: '{{ asset('employee/dashboard/manage/getlvl2module') }}',
              method : 'GET',
              data : {_token:$('#token').val(), mod_l1 : mod_l1},
              success : function(data){
                if (data != 'ERROR') {
                        if (data.length != 0) {
                          $('#example').DataTable().clear().draw();
                            // $('#new_modlvl2').append('<option value="">Select Module Level 2</option>');
                            for (var i = 0; i < data.length; i++) {
                              $('#example').DataTable().row.add([
                                  data[i].mod_id,
                                  data[i].mod_desc,
                                  data[i].mod_lvl,
                                  '<center>' +
                                    '<span class="MG006_update">' +
                                      '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                                    '</span>&nbsp;' +
                                    '<span class="MG006_cancel">' +
                                      '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
                                  '</span>' +
                                  '</center>'

                              ]).draw();
                            }
                        } else {
                          // $('#new_modlvl2').append('<option value="">No Module Level 2 registered</option>');
                          $('#example').DataTable().clear().draw();
                          alert('No registered Module Level 2');
                        }
                    } else {
                      $('#ERROR_MSG2').show(100);                     
                    }
              },
              error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);  
              }
            });
          } else {
            $('#example').DataTable().clear().draw();
          }
       }
       else  if (mod_lvl == "3") {
          if (mod_l1 != '') {
            $.ajax({
              url: '{{ asset('employee/dashboard/manage/getlvl2module') }}',
              method : 'GET',
              data : {_token:$('#token').val(), mod_l1 : mod_l1},
              success : function(data){
                if (data != 'ERROR') {
                        if (data.length != 0) {
                          $('#filterer2').empty();
                          $('#example').DataTable().clear().draw();
                            $('#filterer2').append('<option value="">Select Module Level 2</option>');
                            for (var i = 0; i < data.length; i++) {
                              $('#filterer2').append('<option value="'+data[i].mod_id+'">'+data[i].mod_id+'-'+data[i].mod_desc+'</option>');
                            }
                        } else {
                          $('#filterer2').empty();
                          $('#filterer2').append('<option value="">No Module Level 2 registered</option>');
                          $('#example').DataTable().clear().draw();
                          // alert('No registered Module Level 2');
                        }
                    } else {
                      $('#ERROR_MSG2').show(100);                     
                    }
              },
              error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);  
              }
            });
          } else {
            $('#example').DataTable().clear().draw();
          }
       }
      }
      function filterGetLevel3(){
        var mod_l2 = $('#filterer2').val();
        var mod_lvl =  $('#filterer').val();
        if (mod_lvl == "3") {
          if (mod_l2 !="") {
              $.ajax({
                url : '{{ asset('employee/dashboard/manage/getlvl3module') }}',
                method : 'GET',
                data : {_token:$('#token').val(), mod_l2 : mod_l2},
                success : function (data){
                  if (data != 'ERROR') {
                     if (data.length != 0) {
                        $('#example').DataTable().clear().draw();
                        for (var i = 0; i < data.length; i++) {
                          $('#example').DataTable().row.add([
                                  data[i].mod_id,
                                  data[i].mod_desc,
                                  data[i].mod_lvl,
                                  '<center>' +
                                    '<span class="MG006_update">' +
                                      '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                                    '</span>&nbsp;' +
                                    '<span class="MG006_cancel">' +
                                      '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].mod_id+'\', \''+data[i].mod_desc+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
                                  '</span>' +
                                  '</center>'

                              ]).draw();
                        }
                     } else {
                      $('#example').DataTable().clear().draw();
                      alert('No Module Level 3 registered');
                     }
                  } else if (data == 'ERROR') {
                    $('#ERROR_MSG2').show(100); 
                  }
                },
                error : function (a, b, c){
                  console.log(c);
                  $('#ERROR_MSG2').show(100);  
                }
              });
          }
        }
      }
      $('#NewRight').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
            var CurrentRights =  $('#grp_list option[value]').map(function () {
                return this.value}).get();
            var newId = $('#new_modid').val();
            var testNow = $.inArray(newId,CurrentRights);
            if (testNow == -1) {
              $.ajax({
                  method: 'POST',
                  data: {
                    _token : $('#token').val(),
                    id: $('#new_modid').val(),
                    name : $('#new_rightdesc').val(),
                    lvl : $('#new_modlvl').val(),
                    lvl1 : $('#new_modlvl1').val(),
                    lvl2 : $('#new_modlvl2').val(),
                  },
                  success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added New Module');
                        location.reload();
                    } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);             
                    }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                     $('#AddErrorAlert').show(100);
                  }
              });
            } else {
              alert('Module ID is already been taken');
              $('#new_modid').focus();
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
                    url: "{{ asset('employee/dashboard/manage/savemodule') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Module');
                            location.reload();
                        } else if (data == 'ERROR') {
                            $('#EditErrorAlert').show(100);
                        }
                    }, error : function (XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#EditErrorAlert').show(100);
                    }
                 });
               }
          });
     	function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              url : "{{ asset('employee/dashboard/manage/delmodule') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  location.reload();
                } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
                }
              }, error : function (XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#DelErrorAlert').show(100);
              }
            });
          }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif