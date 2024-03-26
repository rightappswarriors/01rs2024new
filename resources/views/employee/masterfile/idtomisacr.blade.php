@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Team Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="TM001">
  <div class="content p-4">
     
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             ACR Application <span class="TM001_add" ><a href="#" title="Import" data-toggle="modal" data-target="#myModal"><button class="btn btn-primarys"><i class="fa fa-plus-circle" style="cursor: pointer;"></i>Import</button></a></span>
          </div>
          <div class="card-body">
              <table class="table display" id="example" style="overflow-x: scroll;" >
  				<thead>
  					<tr>
  					  <th style="width: 10%">App No</th>
  					  <th style="width: 10%">Accre No</th>
  					  <th style="width: 10%">Address</th>
  					  <th style="width: 10%">Email</th>
              <th style="width: 10%">Facility Name</th>
              <th style="width: 10%">Owner Name</th>
  					</tr>
  				</thead>
  				<tbody>
  					@if (isset($acr_application))
  						@foreach ($acr_application as $ref)
  						<tr>
  							<td scope="row"> {{$ref->appNo}}</td>
  							<td>{{$ref->accreNo}}</td>
  							<td>{{$ref->adr}}</td>
                <td>{{$ref->emailAdr}}</td>
                <td>{{$ref->facilityName}}</td>
  							<td>{{$ref->ownerFname}} {{$ref->ownerLname}}</td>
  							
  						</tr>
  						@endforeach
  					@endif
  				</tbody>
              </table>
          </div>
      </div>
  </div>
  {{-- Add --}}
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                  <h5 class="modal-title text-center"><strong>Import ACR Application</strong></h5>
                  <hr>
                  <div class="container">
                    <form method="POST" action="{{asset('employee/idtomis/import/acr')}}" enctype="multipart/form-data">
                      {{ csrf_field() }}
  	              
  	                 
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      CSV file:<input type="file" name="uploaded_file" class="form-control" accept=".xls">
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
  {{-- Add --}}


  <script type="text/javascript">
  	$(document).ready(function() {
            $('#example').DataTable();
    } );
  	function showData(id,desc, rgndesc, rgid){ 
      $('#EditBody').empty();
      $('#EditBody').append(
          '<div class="col-sm-4">ID:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
          '</div>' +
          '<div class="col-sm-4">Description:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
          '</div>' +
          '<div class="col-sm-12">Region: ('+rgndesc+')</div>' +
          '<input type="text" id="selectedRegID" value="'+rgid+'"  hidden>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<select id="edit_seq" class="form-control" data-parsley-required-message="*<strong>Region</strong> required">'+
                '<option value="'+rgid+'"></option>' +
                @isset($region)
                      @foreach ($region as $r)
                        '<option value="{{$r->rgnid}}">{{$r->rgn_desc}}</option>' +
                      @endforeach
                    @endisset
            '</select>' + 
          '</div>' 
        );
    }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif