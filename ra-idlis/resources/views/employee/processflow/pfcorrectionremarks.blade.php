@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Evaluate Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="MO003">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">


      <div class="card-header bg-white font-weight-bold">
      <a href="{{asset('employee/dashboard/others/monitoring/correctiondetails/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec' : '' }}"> For Corrective Action </a> / 
      <a href="{{asset('employee/dashboard/others/monitoring/correctionattachment/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec'  : '' }}"> Attachment</a> / 
         Remarks / 

       
         <div class="row mt-3">

              <!-- <div class="col-sm-3">
                <button type="button" class="btn btn-info w-100" data-toggle="modal" data-target="#monModal">
                  <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                  Add Licensed Facility
                </button>
              </div> -->
              @if ( request()->has('from') )

@else
               <div class="col-sm-3">
                <button type="button"  class="btn btn-info w-100" data-toggle="modal" data-target="#unregModal">
                  <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                  Add Remarks
                </button>
              </div>
@endif
      
              
             </div>

       
      </div>
        
          
          <div class="card-body table-responsive">


          	<table class="table table-bordered table-striped dataTable" style="font-size:13px;" id="example">
                  <thead>
              
                  <tr>
                      <td scope="col" class="text-center">Timestamp</td>
                      <td scope="col" class="text-center">From</td>
                      <td scope="col" class="text-center">Message</td>
                  </tr>
                  </thead>

        
                  <tbody id="FilterdBody">
              
                   @if (isset($BigData))
                      @foreach ($BigData as $index => $data)
                      
                          <tr>
                            <td class="text-center">{{$data->remarks_date}}</td>
                            <td class="text-center">{{$data->authorizedsignature == "" ? $data->fname : $data->authorizedsignature }} {{$data->authorizedsignature == "" ? $data->lname : ''}}</td>
                            <td class="text-center">{!!$data->message!!}</td>
                 
                            </td>
        
                 
                          
                          </tr>

                      @endforeach
                    @endif
                  </tbody>
              </table>
          </div>
  	</div>

    <div class="modal fade" id="unregModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content " style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
          <h5 class="modal-title text-center">
            <strong>Add Remarks</strong> 
          </h5>
          <hr>
          <div class="input-group form-inline">
            <div class="card-body">
              <form id="unreg" method="POST" action="{{asset('employee/dashboard/processflow/complianceaddremarks')}}" data-parsley-validate>

                {{csrf_field()}}
                <input type="hidden" name="compliance_id" value="{{$complianceId}}">
           
                <div class="row mb-3">
                  <div class="col-sm-4">
                    <b>Message:<span style="color:red">*</span></b>
                  </div>
                  <div class="col-sm-8">
                    <textarea name="message" cols="62" rows="10" class="form-control" required="required"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <button type="" name="btn_sub" class="btn btn-primary" {{-- data-toggle="modal" data-target="#uprModal" onclick="submitprompt(document.getElementById('u_nameoffaci'))" --}}><b>SUBMIT</b></button>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal"  name="btn_sub" class="btn btn-danger w-100"><b>CLOSE</b></button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){

      var table = $('#example').DataTable({
            order: [[0, 'desc']],
           });


 
    });



    
    </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
