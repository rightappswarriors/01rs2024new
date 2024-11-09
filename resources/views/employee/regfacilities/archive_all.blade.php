<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Archiving')
  @section('content')
<input type="text" id="CurrentPage" hidden="" value="FR003">  
  <div class="content p-4" style="font-size:13px; margin-left:0px;" >
  	<div class="card" >
   
  		<div class="card-header bg-white font-weight-bold">
          <h3>Archive of Files</h3> 

          <div class="row">
            <input type="" id="token" value="{{ Session::token() }}" hidden>
              <a class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" href="{{asset('/employee/dashboard/facilityrecords/archiveall')}}">Back</a>&nbsp;
            
              <a href="#" title="Add New Services Upload" onclick="clearDataForAdd('add')" data-toggle="modal" data-target="#myModal">
                  <button type="button" class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fa fa-plus-circle"></i>&nbsp;Add Record of Unregistered Facility</button>
              </a>

              {{-- 
              <a href="{{asset('/employee/dashboard/facilityrecords/archive')}}" title="Add New Services Upload" class="btn btn-info  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold">
                  <i class="fa fa-plus-circle"></i>&nbsp;Add Record of Registered Facility
              </a>--}}

              <a href="#" title="Archive Info" data-toggle="modal" data-target="#myModalInfo">
                  <button type="button" class="btn btn-default  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fas fa-fw fa-cog"></i>&nbsp;Open Directory Instruction</button>
              </a>
          </div>

          <div class="row">
            <div class="col-sm-12">Archive Path: @isset($archive_loc){{$archive_loc}}@endisset 
              <button type="button" class="btn btn-outline-default" onClick="parent.location='file:///C:/'"><i class="fa fa-fw fa-folder"></i></button>
            </div>
          </div>
      </div>
      <form class="filter-options-form">
        @include('employee.regfacilities.arcFilter_all') 
      </form>
      <div class="card-body table-responsive backoffice-list">
        <div>   

          <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">Options</td>                                
                  <th scope="col" nowrap style="width: 35px;">ID No.</th>
                    <th scope="col" nowrap >Issuance Type/<br/>Year/<br/>Region</th>
                    <th scope="col" >Temp Facility Code</th>
                    <th scope="col">NHFR Facility Code</th>
                    <th scope="col" nowrap>Facility Name<br/>[Type of Facility]</th>
                    <th scope="col">Directory Path</th>
                    <th scope="col">D-Track No. </th>
                    <th scope="col">PTC No.<br/><br/>LTO/ATO/ COA/COR No.</th>
                    <th scope="col">Last Updated</th>                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                    @php $i=0; @endphp
                @foreach ($LotsOfDatas as $key)

                    <tr>
                      <td>
                        <center>
                          <a  class="btn btn-outline-default" href="{{asset('employee/dashboard/facilityrecords/archive/')}}/{{$key->regfac_id}}" title="View detailed information for {{$key->facilityname}}" class="btn btn-outline-info form-control"><i class="fa fa-fw fa-eye"></i></a>
                        
                        
                          <span class="FR003opendir">
                              <button type="button" class="btn btn-outline-warning" onClick="parent.location='file:///{{$key->savelocation}}' "><i class="fa fa-fw fa-folder"></i></button>
                            </span>

                            @php $savelocation =$key->savelocation;  @endphp
                            <span class="FR003_update">
                              <button type="button" class="btn btn-outline-secondary" onclick="showData('edit','{{$key->rfa_id}}', '{{$key->regfac_id}}', '{{$savelocation}}', '{{$key->hfser_id}}', '{{$key->nhfcode}}', '{{$key->nhfcode_temp}}', '{{$key->year}}', '{{$key->rgnid}}', '{{$key->facilityname}}', '{{$key->dtrackno}}', '{{$key->conid}}', '{{$key->ltoid}}', '{{$key->coaid}}', '{{$key->atoid}}', '{{$key->corid}}', '{{$key->hgpid}}', '{{$key->ptcid}}');" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-edit"></i></button>
                            </span>
                            <span class="FR003_cancel">
                              <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$key->rfa_id}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                            </span>
                        </center>
                      </td>

                      
                        <td>{{$key->rfa_id}}</td>
                        <td>{{$key->hfser_id}}<br/>{{$key->year}}<br/>{{$key->rgnid}}</td>
                        <td>{{$key->nhfcode_temp}}</td>
                        <td>{{$key->nhfcode}}</td>
                        <td>{{$key->facilityname}}<br/>[{{$key->hgpid}}]</td>
                        <td><a href="file:///{{$key->savelocation}}">{{$key->savelocation}}</a></td>
                        <td>{{$key->dtrackno}}</td>
                        <td>{{$key->ptcid}}<br/><br/>{{$key->ltoid}}{{$key->coaid}}{{$key->atoid}}{{$key->corid}}</td>
                        <td>Last Updated On {{$key->updated_at}}<br/>Last Updated By: {{$key->updated_by}}</td>
                    </tr>

                @endforeach
              @else
                  <tr><td colspan="10" class="text-center">No data available in table</td></tr>
              @endif 
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">Options</td>                                
                  <th scope="col" nowrap style="width: 35px;">ID No.</th>
                    <th scope="col" nowrap >Issuance Type/<br/>Year/<br/>Region</th>
                    <th scope="col" >Temp Facility Code</th>
                    <th scope="col">NHFR Facility Code</th>
                    <th scope="col" nowrap>Facility Name<br/>[Type of Facility]</th>
                    <th scope="col">Directory Path</th>
                    <th scope="col">D-Track No. </th>
                    <th scope="col">PTC No.<br/><br/>LTO/ATO/ COA/COR No.</th>
                    <th scope="col">Last Updated</th>    
                  
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
  	</div>
  </div>
  
<div class="modal fade" id="myModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Open Directory Instruction</strong></h5>
              <hr>
              <div class="container">
                  <div class="row">
                    <h1>Accessing Local Directories with Chrome Extension</h1><br/>
                    <div class="row text-center"><img src="{{asset('ra-idlis/public/img/archive')}}/enable-local-file-links.png" style="width: 50%; margin:auto;"></div>
                    <ol>
                        <li style="word-wrap: break-word;">
                          Visit the Chrome Web Store and search for the "<b>Enable local file links</b>" extension or just click this link <a href="https://chromewebstore.google.com/detail/nikfmfgobenbhmocjaaboihbeocackld" target="_blank">https://chromewebstore.google.com/detail/nikfmfgobenbhmocjaaboihbeocackld</a>
                        </li>
                        <li>Click on "Add to Chrome" to install the extension.</li>
                        <li>Once successfully installed, click the button Open Folder</li>
                    </ol>
                </div>
                <div class="row">

                    <h1>Enabling the feature</h1><br/>
                    <div class="row text-center"><img src="{{asset('ra-idlis/public/img/archive')}}/extension-enable.png" style="width: 50%; margin:auto;"></div>
                    
                    <ol>
                        <li style="word-wrap: break-word;">Open <a href="chrome://extensions/?id=nikfmfgobenbhmocjaaboihbeocackld" target="_blank">chrome://extensions/?id=nikfmfgobenbhmocjaaboihbeocackld</a></li>
                        <li>Enable "Allow access to file URLs"</li>
                    </ol>
                </div>
             </div>
            </div>
          </div>
        </div>
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
                        <input type="text" name="settings_facility_rgnid" value="">
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
                  <form id="addRgn"  method="post" data-parsley-validate >
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" id="action" value="add">
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
                          <input name="year" id="year" type="number" required class="form-control" data-parsley-required-message="*<strong>Year Name</strong> required">
                        </div>
                        
                        
                        <div class="col-sm-3">Temporary NHFR Code:</div>
                        <div class="col-sm-4" style="margin:0 0 .8em 0;">
                          <input name="nhfcode_temp" id="nhfcode_temp" class="form-control" data-parsley-required-message="*<strong>Temporary NHFR Code</strong> required">
                        </div>

                        <div class="col-sm-3">Registered Facility Code:</div>
                        <div class="col-sm-2" style="margin:0 0 .8em 0;">
                          <input type="text" class="form-control" readonly="readonly"  name="regfac_id" id="regfac_id" value="">
                        </div>

                        <div class="col-sm-3">NHFR Code:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input name="nhfcode" id="nhfcode" class="form-control" data-parsley-required-message="*<strong>NHFR Code</strong> required">
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

      function clearDataForAdd(action ){
        let arrDom = ['input[name=id]','input[name=regfac_id]','input[name=savelocation]','select[name=hfser_id]','input[name=nhfcode]','input[name=nhfcode_temp]', 'input[name=year]','select[name=rgnid]','input[name=facilityname]','input[name=dtrackno]','input[name=conid]','input[name=ltoid]', 'input[name=coaid]','input[name=atoid]','input[name=corid]','select[name=hgpid]','input[name=ptcid]'];      

        arrDom.forEach(function(index, el) {

          if($(index).length > 0){
            $(index).val('');
          }
        });       
        
        document.getElementById("action").value = action;  
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