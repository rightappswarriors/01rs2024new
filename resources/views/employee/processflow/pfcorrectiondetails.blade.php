@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Evaluate Process Flow')
  @section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <input type="text" id="CurrentPage" hidden="" value="MO003">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">


      <div class="card-header bg-white font-weight-bold">
       For Corrective Action
      /
      <a href="{{asset('employee/dashboard/others/monitoring/correctionattachment/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec'  : '' }}"> Attachment</a> / 
      <a href="{{asset('employee/dashboard/others/monitoring/correctionremarks/')}}/{{$complianceId}}{{ app('request')->input('from') ? '/?from=rec'  : ''}}"> Remarks </a> / 

       
      </div>
        
          
          <div class="card-body table-responsive">


          	<table class="table table-bordered table-striped dataTable" style="font-size:13px;" id="example">
                  <thead>
              
                  <tr>
                      <!-- <td scope="col" class="text-center"></td> -->
                      <td scope="col" class="text-center">ID</td>
                      <td scope="col" class="text-center">For Corrective Action</td>
                      <td scope="col" class="text-center">Corrective Action Notes</td>
                      <td scope="col" class="text-center">Area of Concern</td>
                      <td scope="col" class="text-center">Complied?</td>
                  </tr>
                  </thead>

        
                  <tbody id="FilterdBody">
              
                   @if (isset($BigData))
                      @foreach ($BigData as $index => $data)
                      
                          <tr>
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">{!!$data->assessmentName!!}</td>
                            <td class="text-center">{!!$data->remarks!!}</td>
                            <td class="text-center">
                            {!!$data->h1name!!}
                            <br>
                            {!!$data->h2name!!}
                            <br>
                            {!!$data->h3name!!}
                            </td>
                            <td>

                            @if ( request()->has('from') )
                            <input type="checkbox" value="0" disabled class="complianceChecker" {{$data->assesment_status == 0 ? 'checked' : '' }}> No
                            <input type="checkbox" value="1" disabled class="complianceChecker compliance_complied" {{$data->assesment_status == 1 ? 'checked' : '' }} > Yes
                            
                            @else
                            <input type="checkbox" value="0" class="complianceChecker" {{$data->assesment_status == 0 ? 'checked' : '' }} onclick="complianceChecker({{$data->compliance_item_id}}, 0, {{$data->compliance_id}})"> No
                            <input type="checkbox" value="1" class="complianceChecker compliance_complied" {{$data->assesment_status == 1 ? 'checked' : '' }} onclick="complianceChecker({{$data->compliance_item_id}}, 1, {{$data->compliance_id}})"> Yes
                            @endif
                            </td>
        
                 
                          
                          </tr>

                      @endforeach
                    @endif
                  </tbody>
              </table>

              <div class="complied-btn mt-3" style="display: inline-block;text-align: right;width: 100%;/* display: inline-flex; */">
    
              @if ( request()->has('from') )

              @else
                <div class="" style="display:inline-block;">
                  <button type="button" onclick="complied(2, {{$complianceId}})" class="btn btn-info w-100">
                    <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
                    Complied
                  </button>
                </div>
             


                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content" style="border-radius: 0px;border: none;">
                          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                              <h5 class="modal-title text-center"><strong>Compliance</strong></h5>
                              <hr>
                              <div class="container">
                                <form id="compliance_form">
                                  <div class="col-md-12">
                                    <div hidden >
                                      
                                    <input type="hidden" name="status" value="2">
                                    <input type="hidden" name="compliance_id" value="{{$complianceId}}">
                                    <small style="color:red">Validity From*</small>
                                    <input name="vf" value="{{date('Y-m-d')}}" type="date" class="form-control"  placeholder="validity from">
                                    <!-- <input name="vf" type="date" class="form-control" required="" placeholder="validity from"> -->

                                    </div>
                                    <small style="color:red">Note: If approved, the validity of the application starts on the day of the Director's Approval.</small>
                                    <br>
                                    <br>
                                  </div>
                                  <div class="col-md-12">
                                    <small style="color:red">Validity Until*</small>
                                    <input name="vto" type="date" value="{{date('Y-m-d', strtotime('Last day of December', strtotime(date('Y-m-d'))))}}" class="form-control"  placeholder="validity Until">
                                    <!-- <input name="vto" type="date" class="form-control" required="" placeholder="validity Until"> -->
                                  </div>
                                  <div class="col-md-12 mt-5 mb-3">
                                    <!-- <input name="noofbed" type="number" class="form-control" placeholder="Total number of beds"> -->
                                    <input name="noofbed" type="number" class="form-control" placeholder="Authorized bed capacity">
                                    <small style="color:red">Authorized bed capacity</small>
                                    <!-- <small style="color:red">Total number of beds</small> -->
                                  </div>
                                  <div class="col-md-12 mt-5 mb-3">
                                    <!-- <input name="noofdialysis" type="number" class="form-control" placeholder="Total number of Dialysis Station"> -->
                                    <input name="noofdialysis" type="number" class="form-control" placeholder="Authorized Dialysis Station">
                                    <small style="color:red">Authorized Dialysis Station</small>
                                    <!-- <small style="color:red">Total number of Dialysis Station</small> -->
                                  </div>
                                <form>
                                <div class="col-md-12 mt-5" style="display:inline-block; text-align: right;">
                                <div class="" style="display:inline-block;">
                                  <button type="button" class="btn btn-info w-100" id="compliance-id">
                                    Complied
                                  </button>
                                </div>
                                <div class="" style="display:inline-block;">
                                  <button type="button" data-dismiss="modal" class="btn btn-danger w-100">
                                    Cancel
                                  </button>
                                </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              @endif


                </div>
          
            </div>
  	</div>
  </div>



  <script type="text/javascript">
  	$(document).ready(function(){

      var table = $('#example').DataTable();


      jQuery('.complianceChecker').click(function(e){
           e.preventDefault();
      });

      jQuery('#compliance-id').click(function(e){

           data = jQuery('#compliance_form');

           $.ajax({
              url: '{{asset('employee/dashboard/processflow/complianceApprove')}}',
              type: 'POST',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: data.serialize(),
              success: function(){
                Swal.fire({
                  type: 'success',
                  title: 'Success',
                  text: 'Successfully Updated Compliance',
                  timer: 2000,
                }).then(() => {
                    window.location.href = '{{asset('employee/dashboard/processflow/compliance')}}';
                });
              }
            })
      });
     

      // if(jQuery('.compliance_complied').not(':checked').length == 0){
      //     jQuery('.complied-btn').css('display', 'block');
      // } else {
      //     jQuery('.complied-btn').css('display', 'none');
      // }

    });

    function complied(assesment_status, compID){

      if(assesment_status == 0){
        $text = 'Are you sure you want to deny this application?';
    } else {
        $text = 'Are you sure you want to set this Complied?';
    }

    

    

            Swal.fire({
              title: 'Please review Application',
              text: $text,
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{asset('employee/dashboard/processflow/correctionSubmit/')}}/'+assesment_status+'/'+compID,
                  type: 'GET',
                  success: function(){
                    Swal.fire({
                      type: 'success',
                      title: 'Success',
                      text: 'Successfully Updated Compliance',
                      timer: 2000,
                    }).then(() => {
                        window.location.href = '{{asset('employee/dashboard/others/monitoring/technical')}}';
                    });
                  }
                })
              }
            })

    }

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
  <script type="text/javascript"> window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
