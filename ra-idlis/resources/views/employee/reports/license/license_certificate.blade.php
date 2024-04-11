<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RLR004">  --}}
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
        <h3> {{$pg_title}} </h3>
      </div>
        @include('employee.reports.license.rptLicenseFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Application Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facilities</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Complete Address</td>

                  <td scope="col" style="text-align: center;">Owner, Head of Facility <br/>and Contact Info</td>
                  <td scope="col" style="text-align:center">License Details</td>
                  <td scope="col" style="text-align: center;">Action</td>                 
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:left"><strong>{{$data->appid}}</strong><br/><br/> Registered ID: {{$data->regfac_id}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left">
                        <strong>{{( $data->hgpdesc ?? 'NOT FOUND')}}</strong><br/>
                        {{$data->facmdesc}}<br/>
                        {{$data->ocdesc}}<br/>
                        {{$data->classname}} {{$data->subclassname}}<br/>
                        @isset($data->noofbed) @if($data->noofbed > 0) {{'No.Of Bed: '}} {{$data->noofbed}} <br/> @endif  @endisset
                        @isset($data->noofdialysis) @if($data->noofdialysis > 0) {{'Dialysis Station: '}} {{$data->noofdialysis}} <br/> @endif  @endisset
                      </td>
                      <td style="text-align:left">
                        {{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}},<br/>
                        {{$data->provname}} {{$data->zipcode}} <br/>
                        {{$data->rgn_desc}}
                      </td>
                      
                      <td style="text-align:left">
                        Owned by: <strong>{{$data->owner}}</strong><br/>
                        {{$data->approvingauthority}}, {{$data->approvingauthoritypos}}<br/>
                        @isset($data->landline) {{'Tel: '}} {{$data->landline}} <br/>  @endisset
                        @isset($data->faxnumber) {{'Fax: '}} {{$data->faxnumber}} <br/>  @endisset
                        @isset($data->email) {{'Email: '}} {{$data->email}} <br/>  @endisset
                      </td>

                      <td style="text-align:left">
                        Type: <strong>{{$data->hfser_id}}</strong><br/>
                        License No: <strong>{{$data->licenseNo}}</strong><br/>
                        Issued On: <strong>{{$data->formattedDateApprove}}</strong><br/>
                        Certificate Signatory: {{$data->signatoryname}}<br/>
                        Signatory Position: {{$data->signatorypos}}                    
                      </td>  

                      <td style="text-align:center">
                        <button type="button" title="Edit Certificate Number" class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" data-toggle="modal" data-target="#GodModal" onclick="showData('{{$data->appid}}', '{{$data->hfser_id}}', '{{$data->regfac_id}}', '{{str_replace(['"',"'"], "",strtoupper($data->facilityname))}}', '{{$data->licenseNo}}')" >
                          <i class="fa fa-edit"></i>
                        </button>
                          <a class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" target="_blank" href="{{ asset('client1/certificates/'.$data->hfser_id.'/'.$data->appid) }}"><i class="fa fa-fw fa-eye"></i></a>     
                      </td>
                    </tr>

                @endforeach
              @endif 
            </tbody>
          </table>

      </div>
  	</div>
  </div>


  
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Issued Certificate Number</strong></h5>
            <hr>
            <div class="container">
                  <form id="EditNow" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                    <div class="row">
                    </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
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

  
  <script type="text/javascript">
    function showData(appid, hfser_id, regfac_id, facilityname, licenseNo)
    {
      $('#EditBody').empty();
        $('#EditBody').append(
          
          '<div class="col-sm-12">' +
          
            '<div class="row">' +
            
              '<div class="col-sm-4">' +
                '<div class="col-sm-4">Application Number:</div>' + 
                '<div class="col-sm-12 text-center">' +
                    '<h4>'+appid+'</h4>' +
                    '<input type="hidden" value="'+appid+'" name="appid" id="appid" class="form-control" data-parsley-required-message="*<strong>Application Number</strong> required" readonly>' +
                '</div>' +
              '</div>' +

              
              '<div class="col-sm-4">' +
                '<div class="col-sm-4">Type:</div>' + 
                '<div class="col-sm-12 text-center">' +
                    '<h4>'+hfser_id+'</h4>' +
                    '<input type="hidden" value="'+hfser_id+'" name="hfser_id" id="hfser_id" class="form-control" data-parsley-required-message="*<strong>Application Number</strong> required" readonly>' +
                '</div>' +
              '</div>' +

              '<div class="col-sm-4">' +
                '<div class="col-sm-4">Registered ID:</div>' + 
                '<div class="col-sm-12 text-center">' +
                    '<h4>'+regfac_id+'</h4>' +
                    '<input type="hidden" value="'+regfac_id+'" name="regfac_id" id="regfac_id" class="form-control" data-parsley-required-message="*<strong>Registered ID</strong> required" readonly>' +
                '</div>' +
              '</div>' +

            '</div>' +

          '</div>' +

            '<div class="col-sm-4">Facility Name:</div>' +
            '<div class="col-sm-12 text-center"> ' +
                '<h4>'+facilityname+'</h4>' +
            '</div> ' +
            '<div class="col-sm-4">Certificate Number:</div> ' +
            '<div class="col-sm-12"> ' +
                '<input type="text" value="'+licenseNo+'" name="licenseNo" id="licenseNo" class="form-control text-center text-bold" data-parsley-required-message="*<strong>Certificate Number</strong> required" required style="font-size: x-large;"> ' +
            '</div>'
          );

      document.getElementById("appid").value = appid; 
      document.getElementById("appid2").value = appid; 
      document.getElementById("facilityname").value = facilityname; 
      document.getElementById("licenseNo").value = licenseNo;
    }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  