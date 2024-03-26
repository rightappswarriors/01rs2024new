@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Group Rights - Manage')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="MG001">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <form class="form-inline" id="inLineForm">
               Group Rights &nbsp;
               <a href="#" title="Add New" data-toggle="modal" data-target="#myModal"><button type="button" class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a> &nbsp;
               <a href="{{ asset('employee/dashboard/manage/groups') }}" title="Manage Groups"><button type="button" class="btn btn-outline-secondary"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Groups</button></a>&nbsp;
               <a href="{{ asset('employee/dashboard/manage/modules') }}" title="Manage Modules"><button type="button" class="btn btn-outline-secondary"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Modules</button></a>
             </form>  
          </div>
          <div class="card-body">
            <div style="float:left;margin-bottom: 5px">
              <form class="form-inline">
                <label>Filter : &nbsp;</label>
                <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Group List">
                <datalist id="grp_list">
                  @isset($groups)
                    @foreach ($groups as $group)
                      <option value="{{$group->grp_id}}">{{$group->grp_desc}}</option>
                    @endforeach
                  @endisset
                </datalist>
                <datalist id="mod_list">
                  @isset($modules)
                    @foreach ($modules as $module)
                      <option value="{{$module->mod_id}}">{{$module->mod_desc}}</option>
                    @endforeach
                  @endisset
                </datalist>
                &nbsp;
                <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="chckIn()">Save</button>
                </form>
             </div>
            <span id="showSucc">
            
            </span>
            <div class="table-responsive" >  
            <hr>
                <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-sm-5 ">Module</div>
                        <div class="col-sm ">Allow</div>
                        <div class="col-sm ">Add</div>
                        <div class="col-sm ">Update</div>
                        <div class="col-sm ">Cancel</div>
                        <div class="col-sm ">Print</div>
                        <div class="col-sm ">&nbsp;</div>
                      </div>
                    </div>
                </div>
                <span  id="mainTable"></span>
              
              {{-- <table class="table table-hover" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: auto">Module</th>
                    <th style="width: auto"><center>Allow</center></th>
                    <th style="width: auto"><center>Add</center></th>
                    <th style="width: auto"><center>Update</center></th>
                    <th style="width: auto"><center>Cancel</center></th>
                    <th style="width: auto"><center>Print</center></th>
                    <th style="width: auto"><center>Option</center></th>
                  </tr>
                </thead>
                <tbody id="FilterdBody">
                </tbody>
              </table> --}}
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Add New Group</strong></h5>
            <hr>
            <form id="NewRight" action="#" class="container" data-parsley-validate>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
               <div class="row">
                  <div class="col-sm-4">Group ID :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_modid" class="form-control" data-parsley-required-message="*<strong>Right ID</strong> required" required>
                  </div>
               </div>
                <div class="row">
                  <div class="col-sm-4">Group Name :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <input type="text" id="new_rightdesc" class="form-control" data-parsley-required-message="*<strong>Right name</strong> required" required>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4">Group Type :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <select id="new_type" class="form-control" required>
                      <option value="DOH">DOH</option>
                      <option value="FDA">FDA</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Group</button>
                </div>
              </form>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Set Restriction Rights</strong></h5>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div> 
                <span id="modal_loaded"></span>
              </div>
            </div>
          </div>
        </div>
  <div class="modal fade" id="Test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Add New Group</strong></h5>
              <hr>
              <span id="Test_body">
                
              <form id="NewGropn" action="#" class="container" data-parsley-validate>
                 <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddNewGroupErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddNewGroupErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
                <div class="row">
                  <div class="col-sm-4">Group ID :</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;" id="grp_id_holder">
                      {{-- <input type="text" id="new_grpid" class="form-control" data-parsley-required-message="*<strong>Group ID</strong> required" disabled required> --}}
                    </div>  
                </div>  
                <div class="row">
                  <div class="col-sm-4">Group Name :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" id="grp_desc_holder">
                    {{-- <input type="text" id="new_grpdesc" class="form-control" data-parsley-required-message="*<strong>Group name</strong> required" required> --}}
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Group</button>
                </div>
              </form>

              </span>                
          </div>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function() {
          $('#example').DataTable();
      });
      $('#inLineForm').on('submit',function(e){e.preventDefault(); alert('test')});
      function filterGroup(){
          var id = $('#filterer').val();
          var token = $('#token').val();
          $.ajax({
                  url: " {{asset('employee/dashboard/manage/getrightsonsinglegroup')}}",
                  method: 'POST',
                  data: {
                    _token : token,
                    grp_id : id,
                  },
                  success: function(data) {
                    if (data == 'NONE') {
                      $('#FilterdBody').empty();
                    } else if(data == 'ERROR'){
                        $('#ERROR_MSG2').show(100);
                     } else {
                      $('#mainTable').empty();
                      $('#example').DataTable().clear().draw();
                      // console.log(data);
                      for (var i = 0; i < data.length; i++) {
                        var alw1 = data[i].allow == '1' ? '<button type="button" class="btn btn-success" onclick="theChange(\''+data[i].x06_id+'\' , \''+data[i].mod_id+'\', 0, \'allow\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-check"></i></button>' : '<button type="button" class="btn btn-danger" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 1, \'allow\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-times"></i></button>';
                         var add1 = data[i].ad_d == '1' ? '<button type="button" class="btn btn-success" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 0, \'ad_d\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-check"></i></button>' : '<button type="button" class="btn btn-danger" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 1, \'ad_d\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-times"></i></button>';
                         var upd1 = data[i].upd == '1' ? '<button type="button" class="btn btn-success" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 0, \'upd\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-check"></i></button>' : '<button type="button" class="btn btn-danger" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 1, \'upd\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-times"></i></button>';
                         var cnl1 = data[i].cancel == '1' ? '<button type="button" class="btn btn-success" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 0, \'cancel\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-check"></i></button>' : '<button type="button" class="btn btn-danger" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 1,  \'cancel\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-times"></i></button>';
                         var prt1 = data[i].print == '1' ? '<button type="button" class="btn btn-success" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 0, \'print\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-check"></i></button>' : '<button type="button" class="btn btn-danger" onclick="theChange(\''+data[i].x06_id+'\' ,\''+data[i].mod_id+'\', 1, \'print\', '+data[i].mod_lvl+')"><i class="fa fa-fw fa-times"></i></button>';
                         var drp2 = data[i].hasLevel2 != null ? '<button type="button" data-toggle="collapse" onclick="toggleDrpDwn(\''+data[i].mod_id+'\')" data-target="#'+data[i].mod_id+'_1_head" aria-expanded="true" class="btn btn-outline-info"><i id="'+data[i].mod_id+'_drpdwn" stat="1" class="fa fa-fw fa-caret-up"></i></button>'  : '&nbsp;';
                         var drp3 = data[i].hasLevel3 != null ? '<button type="button" data-toggle="collapse" onclick="toggleDrpDwn(\''+data[i].mod_id+'\')" data-target="#'+data[i].mod_id+'_2_head" aria-expanded="true" class="btn btn-outline-info"><i id="'+data[i].mod_id+'_drpdwn" stat="1" class="fa fa-fw fa-caret-up"></i></button>'  : '&nbsp;';
                          if (data[i].mod_lvl == '1') {
                            $('#mainTable').append(
                                '<div class="card">' +
                                  '<div class="card-header list-group-item-success">' +
                                    '<div class="row">' +
                                      '<div class="col-sm-5"><strong>'+data[i].mod_desc+'</strong></div>' +
                                      '<div class="col-sm">'+alw1+'</div>' +
                                      '<div class="col-sm">'+add1+'</div>' +
                                      '<div class="col-sm">'+upd1+'</div>' +
                                      '<div class="col-sm">'+cnl1+'</div>' +
                                      '<div class="col-sm">'+prt1+'</div>' +
                                      '<div class="col-sm">'+drp2+'</div>' +
                                    '</div>' + 
                                  '</div>' +
                                '</div>' 
                              );
                            if (data[i].hasLevel2 != null) {
                              $('#mainTable').append(
                                  '<div class="class-body collapse show"  id="'+data[i].mod_id+'_1_head"><div id="'+data[i].mod_id+'_1_body" ></div></div>'
                                );
                            }
                          }
                          else if (data[i].mod_lvl == '2') {
                            $('#'+data[i].mod_l1+ '_1_body').append(
                                '<div class="card">' +
                                  '<div class="card-header list-group-item-info"  data-target="#'+data[i].mod_id+'_2_head" aria-expanded="true">' +
                                    // '<div class="mb-0">' +
                                      '<div class="row">' +
                                      '<div class="col-sm-5"><strong>&nbsp;&nbsp;'+data[i].mod_desc+'</strong></div>' +
                                      '<div class="col-sm">'+alw1+'</div>' +
                                      '<div class="col-sm">'+add1+'</div>' +
                                      '<div class="col-sm">'+upd1+'</div>' +
                                      '<div class="col-sm">'+cnl1+'</div>' +
                                      '<div class="col-sm">'+prt1+'</div>' +
                                      '<div class="col-sm">'+drp3+'</div>' +
                                    '</div>' + 
                                    // '</div>' +
                                  '</div>' +
                                '</div>' 
                              );
                            if (data[i].hasLevel3 != null) {
                              $('#'+data[i].mod_l1+ '_1_body').append(
                                  '<div class="class-body collapse show" id="'+data[i].mod_id+'_2_head"><div id="'+data[i].mod_id+'_2_body"></div></div>'
                                );
                            }
                          }
                          else if (data[i].mod_lvl == '3') {
                            $('#'+data[i].mod_l2+ '_2_body').append(
                                '<div class="card">' +
                                  '<div class="card-header list-group-item-default"  aria-expanded="true">' +
                                    // '<div class="mb-0">' +
                                      '<div class="row">' +
                                      '<div class="col-sm-5"><strong>&nbsp;&nbsp;&nbsp;&nbsp;'+data[i].mod_desc+'</strong></div>' +
                                      '<div class="col-sm">'+alw1+'</div>' +
                                      '<div class="col-sm">'+add1+'</div>' +
                                      '<div class="col-sm">'+upd1+'</div>' +
                                      '<div class="col-sm">'+cnl1+'</div>' +
                                      '<div class="col-sm">'+prt1+'</div>' +
                                      '<div class="col-sm">&nbsp;</div>' +
                                    '</div>' + 
                                    // '</div>' +
                                  '</div>' +
                                '</div>' 
                              );
                          }
                      }                  
                      //   $('#example').DataTable().row.add([
                      //         data[i].mod_desc,
                      //         '<center>'+alw1+'</center>',
                      //         '<center>'+add1+'</center>',
                      //         '<center>'+upd1+'</center>',
                      //         '<center>'+cnl1+'</center>',
                      //         '<center>'+prt1+'</center>',
                      //         '<center><button type="button" class="btn btn-outline-warning" onclick="getData('+data[i].x06_id+', \''+data[i].grp_id+'\', \''+data[i].mod_id+'\',\''+data[i].grp_desc+'\',\''+data[i].mod_desc+'\', '+data[i].allow+', '+data[i].ad_d+', '+data[i].upd+', '+data[i].cancel+', '+data[i].print+', '+data[i].view+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button></center>'
                      //         ])
                      //   .draw();
                      // }
                    }
                  }, error : function (XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#ERROR_MSG2').show(100);
                  }
              });
      }
      function toggleDrpDwn(mod_id){
        var tobeDes = '#'+mod_id+'_drpdwn';
        var stat = $(tobeDes).attr('stat');
        if (stat == '1') {
            $(tobeDes).attr('stat', '0');
            $(tobeDes).removeClass('fa-caret-up');
            $(tobeDes).addClass('fa-caret-down');
        } else if (stat == '0') {
            $(tobeDes).attr('stat', '1');
            $(tobeDes).removeClass('fa-caret-down');
            $(tobeDes).addClass('fa-caret-up');
        }
      }
      function  theChange(x06_id, mod_id, stat, laType, mod_lvl)
      {
          var grp_id = $('#filterer').val();
          $.ajax({
              url : '{{asset('employee/dashboard/manage/saverightsonsinglegroup')}}',
              method : 'POST',
              data : {'_token':$('#token').val(), 'stat' : parseInt(stat), laType : laType, id : mod_id, grp_id : grp_id, x06_id : x06_id, mod_lvl : mod_lvl},
              success : function(data){
                if (data == 'DONE') {
                    filterGroup();
                } else if (data == 'ERROR') {
                    $('#ERROR_MSG2').show(100);
                } 
              },
              error : function(a, b, c){
                console.log(c);
                $('#ERROR_MSG2').show(100);
              }, 
          });
      }
      function getData(id,grp,mod,grp_name,mod_name,alw,ad,upd,cnl,prnt,vw){
          var alw2 = alw == '1' ? 'checked=""' : '';
          var add2 = ad == '1' ? 'checked=""' : '';
          var upd2 = upd == '1' ? 'checked=""' : '';
          var cnl2 = cnl == '1' ? 'checked=""' : '';
          var prt2 = prnt == '1' ? 'checked=""' : '';
          var vw2 = vw == '1' ? 'checked=""' : '';
          $('#modal_loaded').empty();
          $('#modal_loaded').append(
              '<div class="container">' +
                '<form>' +
                  '<div class="row text-center">' +
                      '<div class="col-sm-6">Group : '+grp_name+'</div>' +
                      '<div class="col-sm-6">Module : '+mod_name+'</div>' +
                    '</div>' +
                    '<hr>' +
                    '<div class="row">' +
                      '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkAlw" onchange="allowChange()"; type="checkbox" class="form-check-input" '+alw2+'>Allow</label></div></div>' +
                      '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkAdd" type="checkbox" class="form-check-input" '+add2+'>Add</label></div></div>' +
                    '</div>' +
                    '<div class="row">' +
                      '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkUpd" type="checkbox" class="form-check-input" '+upd2+'>Update</label></div></div>' +
                      '<div class="col-sm-6"><div class="form-check"><label class="form-check-label"><input id="chkCnl" type="checkbox" class="form-check-input" '+cnl2+'>Cancel</label></div></div>' +
                    '</div>' +
                    '<div class="row">' + 
                      '<div class="col-sm-6"><div class="form-check"><label class="form-check-label"><input id="chkPrt" type="checkbox" class="form-check-input" '+prt2+'>Print</label></div></div>' +
                      '<div class="col-sm-6" style="display:none"><div class="form-check"><label class="form-check-label"><input id="chkVw" type="checkbox" class="form-check-input" '+vw2+'>View</label></div></div>' +
                    '</div><hr>' +
                    '<div class="row">' +
                      '<div class="col-sm-6">' +
                        '<button type="button" class="btn btn-outline-success form-control" onclick="savedChecked('+id+',\''+grp+'\',\''+mod+'\',\''+grp_name+'\',\''+mod_name+'\')" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>' +
                      '</div>' +
                      '<div class="col-sm-6">' +
                        '<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>' +
                      '</div>' +
                    '</div>' +
                '</form>' +
              '</div>'
            );
      }
      function allowChange(){
          var alwChk = $('#chkAlw').prop('checked') == true ? 1 : 0;
          $('#chkAdd').removeAttr('checked');
          $('#chkUpd').removeAttr('checked');
          $('#chkCnl').removeAttr('checked');
          $('#chkPrt').removeAttr('checked');
          $('#chkVw').removeAttr('checked');

          if (alwChk == 1) { // checka;;
              $('#chkAdd').attr('checked','');
              $('#chkUpd').attr('checked','');
              $('#chkCnl').attr('checked','');
              $('#chkPrt').attr('checked','');
              $('#chkVw').attr('checked', '');
          } else if (alwChk == 0) { // uncheck allow
              $('#chkAdd').removeAttr('checked');
              $('#chkUpd').removeAttr('checked');
              $('#chkCnl').removeAttr('checked');
              $('#chkPrt').removeAttr('checked');
              $('#chkVw').removeAttr('checked');
          }

        }
        function refreshPage(){
          location.reload();
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
                    type : $('#new_type').val(),
                  },
                  success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added New Group');
                        location.reload();
                    } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100)             
                    }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                     $('#AddErrorAlert').show(100)
                  }
              });
            } else {
              alert('Right ID is already been taken');
              $('#new_modid').focus();
            }

          }
        });
     	function chckIn(){
          var filter = $('#filterer').val().toUpperCase();
          // console.log(filter);
          if (filter == "") {
            // alert();
          } else {
            var test = $('datalist option[value]').map(function () {
                return this.value;
            }).get();
            var test2 = $.inArray(filter,test);
            if (test2 == -1) {
              $('#grp_id_holder').empty();
              $('#grp_desc_holder').empty();
              $('#grp_id_holder').append('<input type="text" id="new_grpid" class="form-control" data-parsley-required-message="*<strong>Group ID</strong> required" disabled required>');
              $('#grp_desc_holder').append('<input type="text" id="new_grpdesc" class="form-control" data-parsley-required-message="*<strong>Group name</strong> required" required>');
              $('#new_grpid').attr('value','');
              $('#new_grpid').attr('value',filter);
              $('#Test').modal();            
            } 
          }
        }
        function savedChecked(id,grp,mod,grp_name,mod_name){
            var alwChk = $('#chkAlw').prop('checked') == true ? 1 : 0;
            var addChk = $('#chkAdd').prop('checked') == true ? 1 : 0;
            var updChk = $('#chkUpd').prop('checked') == true ? 1 : 0;
            var cnlChk = $('#chkCnl').prop('checked') == true ? 1 : 0;
            var prtChk = $('#chkPrt').prop('checked') == true ? 1 : 0;
            var vwChk = $('#chkVw').prop('checked') == true ? 1 : 0;
            $.ajax({
                  url: " {{asset('employee/dashboard/manage/saverightsonsinglegroup')}}",
                  method: 'POST',
                  data: {_token : $('#token').val(), id: id, alwChk : alwChk, addChk :addChk, updChk :updChk, cnlChk :cnlChk, prtChk :prtChk, vwChk : vwChk},
                  success: function(data) {
                    if (data == 'DONE') {
                      alert('Page will automatically reload to apply changes.');
                      $('#GodModal').modal('toggle');
                      filterGroup();
                      showSucc(grp_name,mod_name);
                      setInterval('refreshPage()', 3000);
                    } else if (data == 'ERROR') {
                        $('#EditErrorAlert').show(100);
                    }
                  }, error : function (XMLHttpRequest, textStatus, errorThrown){
                  	console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  }
              });
        }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif