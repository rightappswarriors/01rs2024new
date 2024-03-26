@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Header - Manage')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="header">
  <div class="content p-4">
      <datalist id="grp_list">
        @if (isset($Mods))
          @foreach ($Mods as $Mod)
            <option value="{{$Mod->asmt2l_id}}">{{$Mod->asmt2l_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Headers <span class="AT002_add"><a href="#" title="Add New Header" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             <div style="float:right;display: inline-block;">
              <form class="form-inline">
                <label>Filter : &nbsp;</label>
                <select style="width: auto;" class="form-control" id="filterer" onchange="selectFilterLevel()" >
                  <option value="">Select Level ...</option>
                  <option value="1">Level 1</option>
                  <option value="2">Level 2</option>
                  <option value="3">Level 3</option>
                  <option value="4">Level 4</option>
                  <option value="5">Level 5</option>
                </select> &nbsp;
                <span id="filterer1span" style="width: auto;display: none">
                <select  class="form-control" id="filterer1" onchange="getDatas(this,1)">
                  <option value="">Select Header Level 1 ...</option>
                </select> &nbsp;
                </span>
                <span id="filterer2span" style="width: auto;display: none">
                <select class="form-control" id="filterer2" onchange="getDatas(this,2)">
                  <option value="">Select Header Level 2 ...</option>
                </select>
                </span>
                <span id="filterer3span" style="width: auto;display: none">
                <select class="form-control" id="filterer3" onchange="getDatas(this,3)">
                  <option value="">Select Header Level 3 ...</option>
                </select>
                </span>
                <span id="filterer4span" style="width: auto;display: none">
                <select class="form-control" id="filterer4" onchange="getDatas(this,4)">
                  <option value="">Select Header Level 4 ...</option>
                </select>
                </span>
                <span id="filterer5span" style="width: auto;display: none">
                <select class="form-control" id="filterer5" onchange="getDatas(this,5)">
                  <option value="">Select Header Level 5 ...</option>
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
                    <th style="width: auto">Name</th>
                    <th style="width: auto">Sub Description</th>
                    <th style="width: auto">Level</th>
                    <th style="width: auto"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @if (isset($Mods))
                  @foreach ($Mods as $Mod)
                    <tr>
                      <td scope="row"> {{$Mod->asmt2l_id}}</td>
                      <td>{{$Mod->asmt2l_desc}}</td>
                      <td>
                        <center>
                          <span class="">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$Mod->asmt2l_id}}', '{{$Mod->asmt2l_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$Mod->asmt2l_id}}', '{{$Mod->asmt2l_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
            <h5 class="modal-title text-center"><strong>Add New Header</strong></h5>
            <hr>
            <form id="NewRight" action="#" class="container" data-parsley-validate>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
               <div class="row">
                  <div class="col-sm-4">Header ID :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_modid" class="form-control" data-parsley-required-message="*<strong>Header ID</strong> required" required>
                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-4">Header Name/Description :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <input type="text" id="new_rightdesc" class="form-control" data-parsley-required-message="*<strong>Header Name</strong> required" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">Header Sub Description(optional):</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <textarea id="subDesc" class="form-control" rows="5"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">Header Level :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    {{-- <input type="text" id="" class="form-control" data-parsley-required-message="*<strong>Right name</strong> required" required> --}}
                    <select class="form-control" id="new_modlvl" data-parsley-required-message="*<strong>Header Level</strong> required" onchange="getTheLevels(this)" required>
                        <option value="">Select Header Level..</option>
                        <option value="1">Level 1</option>
                        <option value="2">Level 2</option>
                        <option value="3">Level 3</option>
                        <option value="4">Level 4</option>
                        <option value="5">Level 5</option>
                        <option value="6">Level 6</option>
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
                  <div class="col-sm-5">Header Level 5 :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select class="form-control" id="new_modlvl5" data-parsley-required-message="*<strong>Header Level 5</strong> required" onchange="getDatasAdd(this,5)">
                        <option value="">Select Header Level 5..</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Header</button>
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
            <h5 class="modal-title text-center"><strong>Edit Header</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete Header</strong></h5>
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
     $(function(){
      var levels = ['filterer','filterer1','filterer2','filterer3','filterer4'];
        levels.forEach(function(element) {
          if(sessionStorage.getItem(element) != null){
            var level = sessionStorage.getItem(element);
            $("#"+element).val(level).trigger('change');
          }
        });
        $('#filterer,#filterer1,#filterer2,#filterer3,#filterer4').change(function() { 
          var dropVal = $(this).val();
          sessionStorage.setItem($(this).attr('id'), dropVal);
        })
     });
    $(document).ready(function(){$('#example').DataTable();});
    let lastSelected;
    let lastSelectedFilter;
    function selectFilterLevel(){
      var mod_lvl =  $('#filterer').val();
      var lastOption = $('#filterer option:last-child').val();
      if(typeof(lastSelectedFilter) != 'undefined'){
          if(lastSelectedFilter > mod_lvl){
            for (k = lastSelectedFilter; k >= mod_lvl; k--) {
              $('#filterer'+k+'span').hide();
            }
            $('#example').DataTable().clear().draw();
          }
        }
      if(typeof(mod_lvl) != 'undefined'){
        lastSelectedFilter = mod_lvl;
        if(mod_lvl > 1){
          for (i = 1; i < mod_lvl; ++i) {
            if($('#filterer'+i+'span').length > 0){
              $('#filterer'+i+'span').show();
            }
          }
        }
    } else {
      for (j = 1; j < lastOption; j++) {
        $('#filterer'+j+'span').hide();
      }
          $('#example').DataTable().clear().draw();
        }
        loadLevelHeaderFilter(mod_lvl);
  }
  function getDatas(who,level){
      $('#example').DataTable().clear().draw();
      let valWho = $(who).val();
    $.ajax({
      url : '{{ asset('employee/dashboard/manage/getlvlFilterFromLevel') }}',
      method : 'GET',
      data: {_token:$('#token').val(),modlvl:valWho,level:level},
      success : function(data) {
        if(data.length > 0){
          $(who).parent().next('span').children().append('<option value="">Please select Data</option>');
          if($(who).parent().next('span').children().length > 0){
            $(who).parent().next('span').children().empty();
            for (var i = 0; i < data.length; i++) {
                         $(who).parent().next('span').children().append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'</option>');
                      }
                      if($(who).parent().parent().find('span select:visible:last').val() != ""){
                        let filterLevel = $('#filterer').val();
                        let dataLast = $(who).parent().parent().find('span select:visible:last').val();
                        $.ajax({
                      url : '{{ asset('employee/dashboard/manage/getlvlFilterFromLevel') }}',
                  method : 'GET',
                  data: {_token:$('#token').val(),headerLevel:filterLevel,level:(filterLevel -1),code:dataLast,getData:true},
                      success : function(data) {
                        if (data != 'ERROR') {
                            if (data.length != 0) {
                                $('#example').DataTable().clear().draw();
                                 for (var i = 0; i < data.length; i++) {
                                    $('#example').DataTable().row.add([
                                          data[i].asmt2l_id,
                                          data[i].asmt2l_desc,
                                          data[i].asmt2l_sdesc,
                                          data[i].header_lvl,
                                          '<center>' +
                                            '<span class="AT002_update">' +
                                              '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].asmt2l_id+'\', \''+data[i].asmt2l_desc+'\', \''+data[i].asmt2l_sdesc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                                            '</span>&nbsp;' +
                                            '<span class="AT002_cancel">' +
                                              '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].asmt2l_id+'\', \''+data[i].asmt2l_desc+'\', \''+data[i].asmt2l_sdesc+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
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
            }
          } else {
            $(who).parent().next('span').children().html('<option value="">NO DATA FOUND</option>');
          }
      }
      });     
    }
  function loadLevelHeaderFilter(lvl)
  {
    var lastOption = $('#filterer option:last-child').val();
    $('#example').DataTable().clear().draw();
    $('#filterer1').trigger('change');
    if(lvl == 1){
      $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvlFilter') }}',
              method : 'GET',
              data: {_token:$('#token').val(),modlvl:lvl},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                        $('#example').DataTable().clear().draw();
                         for (var i = 0; i < data.length; i++) {
                            $('#example').DataTable().row.add([
                                  data[i].asmt2l_id,
                                  data[i].asmt2l_desc,
                                  data[i].asmt2l_sdesc,
                                  data[i].header_lvl,
                                  '<center>' +
                                    '<span class="AT002_update">' +
                                      '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+data[i].asmt2l_id+'\', \''+data[i].asmt2l_desc+'\', \''+data[i].asmt2l_sdesc+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>' +
                                    '</span>&nbsp;' +
                                    '<span class="AT002_cancel">' +
                                      '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].asmt2l_id+'\', \''+data[i].asmt2l_desc+'\', \''+data[i].asmt2l_sdesc+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>' +
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
    } else {
      $.ajax({
              url : '{{ asset('employee/dashboard/manage/getlvlFilter') }}',
              method : 'GET',
              data: {_token:$('#token').val(),modlvl:1},
              success : function(data) {
                if (data != 'ERROR') {
                    if (data.length != 0) {
                        $('#filterer1').empty();
                         for (var i = 0; i < data.length; i++) {
                            $('#filterer1').append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+'-'+data[i].asmt2l_desc+'</option>');
                         }
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
  function getTheLevels(who){
        let selectedLevel = ($(who).val()-1);
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
  function loadLevelHeaderFilterAdd(lvl)
  {
    $('#new_modlvl1').trigger('change');
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
            $(who).parent().parent().next().children().children().html('<option value="">NO DATA FOUND</option>');
          } else {
              if($(who).parent().parent().next().children().children().length > 0){
                for (var i = 0; i < data.length; i++) {
                    // $(who).parent().parent().next().children().children().empty();
                      $(who).parent().parent().next().children().children().append('<option value="'+data[i].asmt2l_id+'">'+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'</option>');
                      // $(who).parent().parent().next().children().children().trigger('change');
                  }
              }
            }
        }
      });      
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
                subDesc: $('#subDesc').val(),
                lvl : $('#new_modlvl').val(),
                lvl1 : $('#new_modlvl1').val(),
                lvl2 : $('#new_modlvl2').val(),
                lvl3 : $('#new_modlvl3').val(),
                lvl4 : $('#new_modlvl4').val(),
              },
              success: function(data) {
                if (data == 'DONE') {
                    alert('Successfully Added New Header');
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
          alert('Header ID is already been taken');
          $('#new_modid').focus();
        }
      }
    });
  function showData(id,name,desc){
      $('#EditBody').empty();
      $('#EditBody').append(
          '<div class="col-sm-8">Header ID:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
          '</div>' +
          '<div class="col-sm-8">Header Name:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<input type="text" id="name" value="'+name+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+name+'" class="form-control" required>' +
          '</div>' +
          '<div class="col-sm-8">Header Description:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
          '</div>' 
      );
  } 
  $('#EditNow').on('submit',function(event){
        event.preventDefault();
          var form = $(this);
          form.parsley().validate();
           if (form.parsley().isValid()) {
             var x = $('#edit_name').val();
             var y = $('#name').val();
             var z = $('#edit_desc').val();
             $.ajax({
                url: "{{ asset('employee/dashboard/manage/saveHeader') }}",
                method: 'POST',
                data : {_token:$('#token').val(),id:x,name:y,desc:z,action:"edit"},
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited Header');
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
              url: "{{ asset('employee/dashboard/manage/saveHeader') }}",
              method: 'POST',
              data : {_token:$('#token').val(),id:id,name:name},
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