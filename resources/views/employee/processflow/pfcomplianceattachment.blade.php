@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Evaluate Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF002">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">


      <div class="card-header bg-white font-weight-bold">
      <a href="{{asset('employee/dashboard/processflow/compliancedetails/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec' : '' }}"> For Compliance Details</a> / 
      Attachment / 
      <a href="{{asset('employee/dashboard/processflow/complianceremarks/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec' : '' }}"> Remarks </a> / 

     
      <div class="row mt-3">
      @if ( request()->has('from') )

@else
      <div class="col-sm-3">
        <button type="button"  class="btn btn-info w-100" data-toggle="modal" data-target="#unregModal">
            <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
            Add Attachments
        </button>
      </div>
      @endif
</div>



</div>

      </div>
        
          
          <div class="card-body table-responsive">


          	<table class="table table-bordered table-striped dataTable" style="font-size:13px;" id="example">
                  <thead>
              
                  <tr>
                      <!-- <td scope="col" class="text-center"></td> -->
                      <td scope="col" class="text-center">Timestamp</td>
                      <td scope="col" class="text-center">File Name</td>
                      <td scope="col" class="text-center">Description</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">Client</td>
                      <td scope="col" class="text-center">Action</td>
                  </tr>
                  </thead>

        
                  <tbody id="FilterdBody">
              
                   @if (isset($BigData))
                      @foreach ($BigData as $index => $data)
                      
                          <tr>
                            <td class="text-center">{{$data->date_submitted}}</td>
                            <td class="text-center">{{$data->attachment_name}}</td>
                            <td class="text-center">{{$data->description}}</td>
                            <td class="text-center">{{$data->type}}</td>
                            <td class="text-center">{{$data->authorizedsignature}}</td>
                           
                            <td>

                            <a href="{{asset('file/open')}}/{{$data->file_real_name}}" target="_blank" class="btn btn-primary"> 
                       <i class="fa fa-fw fa-eye"></i>

                       <a href="{{asset('file/open')}}/{{$data->file_real_name}}" download class="btn btn-success"> 
                       <i class="fa fa-fw fa-download"></i>
                       </td>
        
                 
                          
                          </tr>

                      @endforeach
                    @endif
                  </tbody>
              </table>
          </div>

          <div class="modal fade" id="unregModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content " style="border-radius: 0px;border: none;">
                <div class="modal-body text-justify" style=" background-color: #5a636b;color: white;">
                    <h5 class="modal-title text-center">
                    <strong>Add Attachments</strong> 
                    </h5>
                    <hr>
                    <div class="input-group form-inline">
                    <div class="card-body">
                        <form id="unreg" enctype="multipart/form-data" method="POST" action="{{asset('employee/dashboard/processflow/complianceaddattachment')}}" data-parsley-validate>

                        {{csrf_field()}}
                        <input type="hidden" name="compliance_id" value="{{$complianceId}}">
                        <input type="hidden" name="appid" value="{{$appid}}">
                    
                        <div class="row mb-3">
                           
                            <div class="col-sm-8">
                            <input type="file" multiple name="attachment" accept=".jpg, .pdf, .png, .doc." required="required">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                            <b>Name:<span style="color:red">*</span></b>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="attachment_name" required="required" class="form-control" style="width:100%;">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                            <b>Description:<span style="color:red">*</span></b>
                            </div>
                            <div class="col-sm-8">
                            <textarea name="description" style="width:100%;" rows="10" class="form-control" required="required"></textarea>
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
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){

      var table = $('#example').DataTable({
            order: [[0, 'desc']],
           });


      jQuery('.complianceChecker').click(function(e){
           e.preventDefault();
      });




    });

    function complianceChecker(id, assesment_status, appid){
            
    if(assesment_status == 1){
        $text = 'Are you sure you want to complied this item?';
    } else {
        $text = 'Are you sure you want to set this for Compliance?';
    }

    

    

            Swal.fire({
              title: 'Please review Compliance Item',
              text: $text,
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{asset('employee/dashboard/processflow/complianceChecker/')}}/'+id+'/'+assesment_status,
                  type: 'GET',
                  success: function(){
                    Swal.fire({
                      type: 'success',
                      title: 'Success',
                      text: 'Successfully Updated Compliance',
                      timer: 2000,
                    }).then(() => {
                        location.reload();
                    });
                  }
                })
              }
            })
       }
    </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
