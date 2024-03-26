@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Manage Charges Master File')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="PY004">
  <div hidden>
    @if (isset($Cats) AND isset($Chrgs))
      @foreach ($Cats as $Cat)
          <datalist id="{{$Cat->cat_id}}_list">
         @foreach ($Chrgs as $Chrg)
           @if ($Cat->cat_id == $Chrg->cat_id)
              <option id="{{$Chrg->chg_code}}_pro" value="{{$Chrg->chg_code}}" exp='{{$Chrg->chg_exp}}' rmks="{{$Chrg->chg_rmks}}">{{$Chrg->chg_desc}}</option>
           @endif
         @endforeach
       </datalist>
      @endforeach
    @endif
  </div>
  <div class="content p-4">
    <div class="card">
            <div class="card-header bg-white font-weight-bold">
               Manage Charges<a href="" title="Add New" data-toggle="modal" data-target="#myModal">
                <span class="PY004_add">
                  <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
              </a>  
            </div>
            <div class="card-body">
              <div style="float:left;margin-bottom: 5px">
                <form class="form-inline">
                  <label>Filter : &nbsp;</label>
                  <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Order of Payment">
                  <datalist id="grp_list">
                    @if (isset($OOPs))
                      @foreach ($OOPs as $OOP)
                        <option value="{{$OOP->oop_id}}">{{$OOP->oop_desc}}</option>
                      @endforeach
                    @endif
                  </datalist>
                  &nbsp;
                  </form>
               </div>
              <span id="showSucc">
              </span>
              <div class="table-responsive">
                <table class="table table-hover display" id="example" style="overflow-x: scroll;" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>OOP</th>
                      <th>Code</th>
                      <th>Charge</th>
                      <th>Application Type</th>
                      <th>Type</th>
                      <th><center>Amount</center></th>
                      <th><center>Remarks</center></th>
                      <th width="20%"><center>Option</center></th>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">
                  </tbody>
                </table>
                </div>
            </div>
        </div>
  </div>
  <div class="modal fade" id="ShowMeTheMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Modify Amount for <span id="ifActiveTitle"></span></strong></h5>
                <hr>
                <div class="container">
                  <form  id="AddAmount" class="row" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddAmtErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddAmtErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    <div class="col-sm-12" id="Error"></div>
                    <input type="text" id="PutTypeIDhere" name="" hidden>
                    <div class="col-sm-4">
                      Amount:
                    </div>
                    <div class="col-sm-8" id="ShowTheMoneyBox" style="margin:0 0 .8em 0;">
                    </div>
                    <div class="col-sm-4">
                      Remarks:
                    </div>
                    <div class="col-sm-8" id="ShowTheRemarkBox" style="margin:0 0 .8em 0;">
                    </div>
                    <div class="col-sm-12">
                      <hr>
                      <div class="row">
                        <div class="col-sm-6">
                          <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Modify</button>
                        </div>
                        <div class="col-sm-6">
                          <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                        </div>
                      </div>
                    </div> 
                  </form>
               </div>
              </div>
            </div>
          </div>
  </div>
  <div class="modal fade" id="ShowDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;
        color: white;">
            <h5 class="modal-title text-center"><strong>Delete Charge</span></strong></h5>
            <hr>
            <div class="container">
              <form  id="DelCharge" class="row" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                  <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                <input type="text" id="PutTypeIDhere4Delete" name="" hidden>
                <input type="text" id="PutTypeOOP_IDhere4Delete" name="" hidden>
                <div class="col-sm-12" id="DelMessage">
                  {{-- Enter Amount: --}}
                </div>
                <div class="col-sm-12">
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div>
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                  </div>
                </div> 
              </form>
           </div>
          </div>
        </div>
      </div>
    </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Add Charge in Order of Payment</strong></h5>
                <hr>
                <form id="NewFacServIn" action="#" class="container" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    <div class="row">
                      <div class="col-sm-4">Order of Payment :</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                       <select id="appID" data-parsley-required-message="*<strong>Order of Payment</strong> required" class="form-control" required>  
                              <option value="">Select Order of Payment ...</option>
                              @isset($OOPs)
                                @foreach ($OOPs as $OOP)
                                  <option value="{{$OOP->oop_id}}">{{$OOP->oop_desc}}</option>
                                @endforeach
                              @endisset
                          </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Category</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <select data-parsley-required-message="*<strong>Category</strong> required" id="SelectedCat" class="form-control" onchange="GetCharges()" required>
                        <option value="">Select Category ...</option>
                        @if (isset($Cats))
                          @foreach ($Cats as $Cat)
                            <option value="{{$Cat->cat_id}}">{{$Cat->cat_id}} - {{$Cat->cat_desc}}</option>
                          @endforeach
                        @endif
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Application Type</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <select data-parsley-required-message="*<strong>Category</strong> required" id="SelectedHfaci" class="form-control" required>
                        <option value="">Select Application Type ...</option>
                        @if (isset($Hfaci))
                          @foreach ($Hfaci as $hafc)
                            <option value="{{$hafc->hfser_id}}">{{$hafc->hfser_id}} - {{$hafc->hfser_desc}}</option>
                          @endforeach
                        @endif
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Charge :</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                       <select id="FacServID" data-parsley-required-message="*<strong>Charge</strong> required" class="form-control" onchange="GetChargeDetails()" required>
                          </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Charge Explanation:</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <textarea class="form-control" rows="3" id="SelectedChargeExplanation" disabled></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Charge Remarks:</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <textarea class="form-control" rows="2" id="SelectedChargeRemark" disabled></textarea>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Type :</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                          <select class="form-control" id="AptID"  data-parsley-required-message="*<strong>Charge</strong> required" required>
                              <option value="">Select Type ...</option>
                              @if (isset($IniRen))
                                @foreach ($IniRen as $data)
                                  <option value="{{$data->aptid}}">{{$data->aptdesc}}</option>
                                @endforeach
                              @endif
                          </select>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">Remarks :</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <textarea class="form-control" id="NewRmk" rows="5"></textarea>
                      </div>
                    </div>   
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add Charge</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
  <script type="text/javascript">
    $(document).ready(function() {$('#example').DataTable();});
    function filterGroup(){
          var id = $('#filterer').val();
          var token = $('#token').val();
          $.ajax({
                  url: " {{asset('employee/mf/get_manageChargesOOPFiltered')}}",
                  method: 'POST',
                  data: {
                    _token : token,
                    id : id,
                  },
                  success: function(data) {
                    console.log(data)
                    if (data == 'NONE') {
                      $('#FilterdBody').empty();
                    } else {
                      $('#FilterdBody').empty();
                      var table = $('#example').DataTable();
                      table.clear().draw();
                      var x = data.data;
                      for (var i = 0; i < x.length; i++) {
                        var d = data.data[i];
                        var sq = "";
                        if (data.TotalNumber > 1) {
                          if (d.chgopp_seq == 1) {sq='&nbsp;<a href="#"><button onclick="Rearranged(\'down\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgapp_id+')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                          else if (d.chgopp_seq > 1 && d.chgopp_seq < data.TotalNumber) {sq = '&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgapp_id+')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>&nbsp;<a href="#"><button  onclick="Rearranged(\'down\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgapp_id+')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';}
                          else {sq='&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+d.oop_id+'\','+d.chgopp_seq+','+d.chgapp_id+')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>';}
                        }
                        var test = (d.chg_rmks == null)? 'No Remarks' : d.chg_rmks;
                        $('#example').DataTable()
                             .row
                             .add([
                                  d.chgapp_id, 
                                  d.oop_id,
                                  '<a href="#" data-toggle="tooltip" title="" data-original-title="'+test+'">'+d.chg_code+'</a>',
                                  d.chg_desc, ((d.hfser_desc != null) ? d.hfser_desc : "No Application type"), d.aptdesc,
                                  '<center>' + d.amt + '</center>',
                                  d.remarks,
                                  '<center>'+
                                    '<a href="#">'+
                                    '<span class="PY004_update">'+
                                    '<button data-toggle="modal" data-target="#ShowMeTheMoney" onclick="AddAmt('+d.amt+','+d.chgapp_id+',\''+d.chg_desc+'\', \''+d.remarks+'\')" class="btn btn-outline-success" title="Modify Amount"><i class="fa fa-edit"></i></button>'+
                                    '<span>' +
                                    '</a>&nbsp;'+
                                    '<a href="#">'+
                                    '<span class="PY004_cancel">'+
                                    '<button  onclick="DelUploaded('+d.chgapp_id+',\''+d.chg_desc+'\', \''+d.oop_desc+'\',\''+d.oop_id+'\')" class="btn btn-outline-danger" title="Remove Charge"><i class="fa fa-trash"></i></button>'+
                                    '</span>'+
                                    '</a>'+sq +
                                  '</center>'
                                ])
                             .draw();
                      }
                    }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $("#ERROR_MSG2").show(100);
                  }
              });
        }
        function GetCharges(){
            var id = $('#SelectedCat').val();
            $('#FacServID').empty();
            $('#SelectedChargeExplanation').empty();
            $('#SelectedChargeRemark').empty();
            $('#FacServID').append('<option value=""></option>');
            var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
            for (var i = 0; i < x.length; i++) {
              var d = $('#'+x[i]+'_pro').text();
              var e = $('#'+x[i]+'_pro').attr('value');
              $('#FacServID').append('<option value="'+e+'">'+e+' | '+d+'</option>');
            }
        }
        function GetChargeDetails(){
          var x = $('#FacServID').val();
          var exp = $('#'+x+'_pro').attr('exp');
          var rmk = $('#'+x+'_pro').attr('rmks');
          $('#SelectedChargeExplanation').empty();
          $('#SelectedChargeRemark').empty();
          $('#SelectedChargeExplanation').text(exp);
          $('#SelectedChargeRemark').text(rmk);
        }
    function AddAmt(amt, chgapp_id, chg_desc, remarks){
          $('#ifActiveTitle').empty();
          $('#ifActiveTitle').append(chg_desc);
          $('#ShowTheMoneyBox').empty();
          $('#ShowTheMoneyBox').append(
            '<input type="test" class="form-control" id="selectedAMOUNT" data-parsley-trigger="keyup" data-parsley-type="number" data-parsley-required-message="*<strong>Amount</strong> required." required>'
            );
          $('#selectedAMOUNT').removeAttr('placeholder');
          $('#selectedAMOUNT').attr('placeholder', amt);
          $('#PutTypeIDhere').attr('value','');
          $('#PutTypeIDhere').attr('value',chgapp_id);
         var test = (remarks == 'null') ? '' : remarks;
          $('#ShowTheRemarkBox').empty();
          $('#ShowTheRemarkBox').append(
              '<textarea class="form-control" id="selectedRemark" placeholder="'+test+'">'+test+'</textarea>'
            );
        }
      function DelUploaded(chgopp_id, chg_desc, oop_desc,oop_id){
          $('#DelMessage').empty();
          $('#DelMessage').append('Are you sure want to delete <span style="color:red;font-weight:bold">'+chg_desc+'</span> in <span style="text-decoration:underline">' + oop_desc + '</span>?');
          // $('#PutTypeIDhere4Delete').attr('value','');
          $('#PutTypeIDhere4Delete').attr('value',chgopp_id);
          // $('#PutTypeOOP_IDhere4Delete').attr('value','');
          $('#PutTypeOOP_IDhere4Delete').attr('value',oop_id);
          $('#ShowDelete').modal('toggle');
        }
    $('#NewFacServIn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              $.ajax({
                  method: 'POST',
                  data: {
                    _token:$('input[name="_token"]').val(),
                    oop_id:$('#appID').val(),
                    chg_code:$('#FacServID').val(),
                    aptid: $('#AptID').val(), 
                    rmk : $('#NewRmk').val(), 
                    hfser_id: $('#SelectedHfaci').val()
                  },
                  success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added New Charge in an Application');
                        window.location.href = "{{ asset('employee/dashboard/mf/manage/charges') }}";
                    } else if (data == 'SAME') {
                        alert('Charge is already in the selected Order of Payment');
                        $('#FacServID').focus();
                    } else if (data == 'ERROR') {
                      $('#AddErrorAlert').show(100);
                    }
                  }, error  : function (XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#AddErrorAlert').show(100);
                  }
            });
        }
    });
    $('#AddAmount').on('submit',function(event){    
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
            $.ajax({
              url: '{{ asset('employee/mf/manage/charges/save_amount') }}' ,
              method : 'POST',
              data : {_token:$('input[name="_token"]').val(),amt : $('#selectedAMOUNT').val(),id : $('#PutTypeIDhere').val(),rmk : $('#selectedRemark').val()},
              success : function(data){
                  if (data == 'DONE') {
                    alert('Successfully Updated Amount');
                        filterGroup();
                        $('#ShowMeTheMoney').modal('toggle');
                  } else if (data == 'ERROR') {
                      $('#AddAmtErrorAlert').show(100);
                  }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  $('#AddAmtErrorAlert').show(100);
              }
            });
          }
        });
    $('#DelCharge').on('submit',function(event){
          event.preventDefault();
          $.ajax({
            url : '{{ asset('employee/mf/del_manageCharges') }}',
            method : 'POST',
            data : {_token:$('input[name="_token"]').val(), id : $('#PutTypeIDhere4Delete').val(), oop_id : $('#PutTypeOOP_IDhere4Delete').val()},
            success : function(data){
              if (data == 'DONE') {
                alert('Successfully deleted a Charge');
                filterGroup();
                $('#ShowDelete').modal('toggle');
              } else if (data == 'ERROR') {
                $('#DelErrorAlert').show(100);
              }
            }, error : function(){
              $('#DelErrorAlert').show(100);
            }
          });
        });
    function Rearranged(type,oop_id,seq_num,chgopp_id){
          $.ajax({
            url : '{{ asset('employee/mf/manage/charges/rearrange') }}',
            method : 'POST',
            data : {_token:$('input[name="_token"]').val(), type:type,oop_id:oop_id,seq_num:seq_num,chgopp_id:chgopp_id},
            success : function(data){
              if (data == 'DONE') {
                  alert('Successfully Rearranged');
                  filterGroup();
                } else if (data == 'ERROR') {
                  alert('An error occured. Please contact the system administrator.');
                }
            }, error : function(XMLHttpRequest, textStatus, errorThrown){
              console.log(errorThrown);
              $('#ERROR_MSG2').show(100);
              $('#ERROR_MSG2').focus();
            }
          });
        }
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var x = $('#edit_name').val();
                 var y = $('#edit_desc').val();
                 $.ajax({
                    url: "{{ asset('employee/mf/save_modeofpayment') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Application Status');
                            window.location.href = "{{ asset('/employee/dashboard/mf/mode_payment') }}";
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
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif