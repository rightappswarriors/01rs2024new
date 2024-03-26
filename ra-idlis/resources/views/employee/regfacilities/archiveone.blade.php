<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('employee.regfacilities.template-regfacility')
  @section('title', 'Archive Facility')
  @section('content-regfacility')
  
<!---------------------------------->
  		    <div class="card-header bg-white font-weight-bold">             

              <div class="row">
                <input type="" id="token" value="{{ Session::token() }}" hidden>
                  <a class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" href="{{asset('/employee/dashboard/facilityrecords/archive')}}">Back</a>&nbsp;
                
                  <a href="#" title="Add New Services Upload" onclick="clearDataForAdd('add', '{{$user->regfac_id}}')" data-toggle="modal" data-target="#myModal">
                      <button type="button" class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fa fa-plus-circle"></i>&nbsp;Add Facility Record</button>
                  </a>

                  <a href="#" title="Archive Settings" data-toggle="modal" data-target="#myModalSettings">
                      <button type="button" class="btn btn-default  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fas fa-fw fa-cog"></i>&nbsp;Archive Settings</button>
                  </a>
              </div>

              <div class="row">
                <div class="col-sm-12">Archive Path: @isset($archive_loc){{$archive_loc}}@endisset 
                  <button type="button" class="btn btn-outline-default" onClick="parent.location='file:///C:/'"><i class="fa fa-fw fa-folder"></i></button>
                </div>
              </div>

          </div>
          <div class="card-body table-responsive  backoffice-list">
              <table class="table table-hover" style="font-size:12px;" id="1example">
                <thead>
                  <tr class="text-center">
                    <th scope="col" nowrap style="width: 35px;">Line No.<br/>[ID No.]</th>
                    <th scope="col" nowrap >Issuance Type/<br/>Year/<br/>Region</th>
                    <th scope="col" >Temp Facility Code</th>
                    <th scope="col">NHFR Facility Code</th>
                    <th scope="col" nowrap>Facility Name<br/>[Type of Facility]</th>
                    <th scope="col">Directory Path</th>
                    <th scope="col">D-Track No.<br/><br/>[Last Updated]</th>
                    <th scope="col">PTC No.<br/><br/>LTO/ATO/ COA/COR No.</th>
                    <th scope="col">Options</th>
                  </tr>

                </thead>
                <tbody>
                  @if (isset($data ))
                    @php $i=0; @endphp
                    @foreach ($data as $key)
                      <tr class="text-center">
                        <td>{{++$i}}<br/>[{{$key->rfa_id}}]</td>
                        <td>{{$key->hfser_id}}<br/>{{$key->year}}<br/>{{$key->rgnid}}</td>
                        <td>{{$key->nhfcode_temp}}</td>
                        <td>{{$key->nhfcode}}</td>
                        <td>{{$key->facilityname}}<br/>[{{$key->hgpid}}]</td>
                        <td><a href="file:///{{$key->savelocation}}">{{$key->savelocation}}</a></td>
                        <td>{{$key->dtrackno}}<br/>[On {{$key->updated_at}} By: {{$key->updated_by}}]</td>
                        <td>{{$key->ptcid}}<br/><br/>{{$key->ltoid}}{{$key->coaid}}{{$key->atoid}}{{$key->corid}}</td>
                        <td>
                          <center>
                            <span class="FD007_opendir">
                              <button type="button" class="btn btn-outline-warning" onClick="parent.location='file:///{{$key->savelocation}}' "><i class="fa fa-fw fa-folder"></i></button>
                            </span>
                            @php $savelocation =$key->savelocation;  @endphp
                            <span class="FD007_update">
                              <button type="button" class="btn btn-outline-warning" onclick="showData('edit','{{$key->rfa_id}}', '{{$key->regfac_id}}', '{{$savelocation}}', '{{$key->hfser_id}}', '{{$key->nhfcode}}', '{{$key->nhfcode_temp}}', '{{$key->year}}', '{{$key->rgnid}}', '{{$key->facilityname}}', '{{$key->dtrackno}}', '{{$key->conid}}', '{{$key->ltoid}}', '{{$key->coaid}}', '{{$key->atoid}}', '{{$key->corid}}', '{{$key->hgpid}}', '{{$key->ptcid}}');" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-edit"></i></button>
                            </span>
                            <span class="FD007_cancel">
                              <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$key->rfa_id}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                            </span>
                          </center>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>
          </div>

  <div class="modal fade" id="myModalSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Manage Archive Settings</strong></h5>
              <hr>
              <div class="container">
                  <form id="ArchiveSettings"  data-parsley-validate>
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="settings">
                        <input type="hidden" name="settings_facility_rgnid" value="{{$user->rgnid}}">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div> 

                        <div class="col-sm-3">Archive Path:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input name="archive_loc" value="@isset($archive_loc){{$archive_loc}}@endisset" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
                        </div>

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add Health Facility Record</strong></h5>
              <hr>
              <div class="container">
                  <form id="addRgn"  data-parsley-validate  enctype="multipart/form-data">
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" id="action" value="add">
                        <input type="hidden" name="regfac_id" id="regfac_id" value="{{$user->regfac_id}}">
	                  	  <input type="hidden" name="id" id="id">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div> 

                        <div class="col-sm-3">Region:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <select name="rgnid" id="rgnid" class="form-control" data-parsley-required-message="*<strong>Region Name</strong> required" required>
                            <option value="" selected="" disabled="" hidden readonly>Please Select</option>
                            @foreach($a_regions as $fa)
                              <option value="{{$fa->rgnid}}">{{$fa->rgn_desc}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-sm-3">Authorization Type:</div>
                        <div class="col-sm-5" style="margin:0 0 .8em 0;">
                          <select name="hfser_id" id="hfser_id" class="form-control" data-parsley-required-message="*<strong>Authorization Type</strong> required" required>
                            <option value="" selected="" disabled="" hidden readonly>Please Select</option>
                            @foreach($a_hfaci_service_type as $fa)
                              <option value="{{$fa->hfser_id}}">{{$fa->hfser_desc}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-sm-2">Year:</div>
                        <div class="col-sm-2" style="margin:0 0 .8em 0;">
                          <input name="year" id="year" type="text" required class="form-control" data-parsley-required-message="*<strong>Year Name</strong> required">
                        </div>
                        
                        <div class="col-sm-3">NHFR Code:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="nhfcode" id="nhfcode" class="form-control" data-parsley-required-message="*<strong>NHFR Code</strong> required">
                        </div>
                        
                        <div class="col-sm-3">Temp Facility Code:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="nhfcode_temp" id="nhfcode_temp" class="form-control" data-parsley-required-message="*<strong>Temp Facility Code</strong> required">
                        </div>

                        <div class="col-sm-3">Facility Name:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input name="facilityname" id="facilityname" required class="form-control" data-parsley-required-message="*<strong>Facility Name</strong> required">
                        </div>

                        
                        <div class="col-sm-3">Facility Type:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <select name="hgpid" id="hgpid" class="form-control" data-parsley-required-message="*<strong>Facility Type</strong> required" required>
                            <option value="" selected="" disabled="" hidden readonly>Please Select</option>
                            @foreach($a_factype as $fa)
                              <option value="{{$fa->hgpid}}">{{$fa->hgpdesc}}</option>
                            @endforeach
                          </select>
                        </div>
                        
                        <div class="col-sm-3">Directory Path:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input name="savelocation" id="savelocation" required class="form-control" data-parsley-required-message="*<strong>Directory Path</strong> required">
                        </div>
                        
                        <div class="col-sm-3">D-Track No.:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input name="dtrackno" id="dtrackno" required class="form-control" data-parsley-required-message="*<strong>D-Track No.</strong> required">
                        </div>

                        <div class="col-sm-12">
                          <hr/>
                        </div>

                        <div class="col-sm-3">PTC No.:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="ptcid" id="ptcid" class="form-control" data-parsley-required-message="*<strong>PTC No.</strong> required">
                        </div>
                        
                        <div class="col-sm-3">LTO No.:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="ltoid" id="ltoid" class="form-control" data-parsley-required-message="*<strong>LTO No.</strong> required">
                        </div>
                        
                        <div class="col-sm-3">COA No.:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="coaid" id="coaid" class="form-control" data-parsley-required-message="*<strong>COA No.</strong> required">
                        </div>

                        <div class="col-sm-3">ATO No.:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="atoid" id="atoid" class="form-control" data-parsley-required-message="*<strong>ATO No.</strong> required">
                        </div>

                        <div class="col-sm-3">COR No.:</div>
                        <div class="col-sm-3" style="margin:0 0 .8em 0;">
                          <input name="corid" id="corid" class="form-control" data-parsley-required-message="*<strong>COR No.</strong> required">
                        </div>

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
            <h5 class="modal-title text-center"><strong>Delete Archive Upload</strong></h5>
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
      $(document).ready(function() { $('#example').DataTable();});

      $('#ArchiveSettings').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();

          if (form.parsley().isValid()) {
            var data = new FormData(this);
            $.ajax({
              type: 'POST',
              contentType: false,
              processData: false,
              data: data,
              success: function(data) {
                if (data == 'DONE') {
                    alert('Settings successfully saved.');
                    location.reload();
                } else if (data == 'ERROR'){
                    $('#AddErrorAlert').show(100);
                }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#AddErrorAlert').show(100);
              }
            });
          }
      });

      $('#addRgn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();

          if (form.parsley().isValid()) {
            var data = new FormData(this);
            $.ajax({
              type: 'POST',
              contentType: false,
              processData: false,
              data: data,
              success: function(data) {
                if (data == 'DONE') {
                    alert('Successfully Added New Archive Upload');
                    location.reload();
                } else if (data == 'ERROR'){
                    $('#AddErrorAlert').show(100);
                }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#AddErrorAlert').show(100);
              }
            });
          }
      });

      $('#EditNow').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();

        if (form.parsley().isValid()) {
          var data = new FormData(this);
          var id = $("#id").val();
          $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            data: data,
            success: function(data){
                if (data == "DONE") {
                    alert('Successfully Edited Archive Upload');
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

      function clearDataForAdd(action, regfac_id ){
        let arrDom = ['input[name=id]','input[name=regfac_id]','input[name=savelocation]','select[name=hfser_id]','input[name=nhfcode]','input[name=nhfcode_temp]', 'input[name=year]','select[name=rgnid]','input[name=facilityname]','input[name=dtrackno]','input[name=conid]','input[name=ltoid]', 'input[name=coaid]','input[name=atoid]','input[name=corid]','select[name=hgpid]','input[name=ptcid]'];      

        arrDom.forEach(function(index, el) {

          if($(index).length > 0){
            $(index).val('');
          }
        });       
        
        document.getElementById("action").value = action;
        document.getElementById("regfac_id").value = regfac_id;     
      }

      function showData(action, id, regfac_id, savelocation, hfser_id, nhfcode, nhfcode_temp, year, rgnid, facilityname, dtrackno, conid, ltoid, coaid, atoid, corid, hgpid, ptcid){
        let arrDom = ['input[name=id]','input[name=regfac_id]','input[name=savelocation]','select[name=hfser_id]','input[name=nhfcode]','input[name=nhfcode_temp]', 'input[name=year]','select[name=rgnid]','input[name=facilityname]','input[name=dtrackno]','input[name=conid]','input[name=ltoid]', 'input[name=coaid]','input[name=atoid]','input[name=corid]','select[name=hgpid]','input[name=ptcid]'];
        let arrValue = [id, regfac_id, savelocation, hfser_id, nhfcode, nhfcode_temp, year, rgnid, facilityname, dtrackno, conid, ltoid, coaid, atoid, corid, hgpid, ptcid];

        arrDom.forEach(function(index, el) {

          if($(index).length > 0){
            $(index).val(arrValue[el]);
          }
        });

        document.getElementById("action").value = action;
      }
      
      function showDelete (id){
        $('#DelModSpan').empty();
        $('#DelModSpan').append(
            '<div class="col-sm-12"> Are you sure you want to delete this data?' +
            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
            '</div>' );
      }

      function deleteNow(){
        var id = $("#toBeDeletedID").val();
        $.ajax({
          method: 'POST',
          data: {
            _token:$('#token').val(),
            id:id,
            mod_id : $('#CurrentPage').val(), 
            action: 'delete'},
            success: function(data){
              if (data == 'DONE') {
                alert('Successfully deleted choosen entry');
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->