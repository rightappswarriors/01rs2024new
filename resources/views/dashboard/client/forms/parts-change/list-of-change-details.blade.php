<div class="row">
    <div class="col-md-12"><hr/></div>
    <div class="col-md-12 pt-3 pb-2 text-center">
        <h4 class="text-uppercase font-weight-bold" style="font-size:30px ;">List of Details for Change</h4>
    </div>
    <div class="col-md-12">
        <table class="table display" id="example" style="overflow-x: scroll;">
            <thead>
                <tr>
                    <th style="white-space: nowrap;" class="sorting_disabled">Type of Change</th>
                    <th style="white-space: nowrap;" class="sorting_disabled">Remarks</th>
                    <th style="white-space: nowrap;" class="sorting_disabled">Options</th>
                </tr>
            </thead>
            <tbody>                
                @if (isset($appform_changeaction)) 
                    @php $i=1;  @endphp
                    @foreach ($appform_changeaction as $data)
                    <tr class="odd" role="row">
                        
                        <td >{{$data->description}}</td>
                        <td >{{$data->remarks}}</td>
                        <td >
                            <button class="btn btn-primary" onclick="showChangeRemarks('{{$data->id}}',  '{{$data->remarks}}')" data-toggle="modal" data-target="#changeRemarks">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr> 
                    @endforeach
                @else
                    <tr class="odd" role="row">
                        <td colspan="2">No Changes made yet.</td>
                    </tr> 
                @endif        
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="changeRemarks" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Update Remarks</strong></h5>
                <hr>
                <div class="container">
                    <form id="frmChangeRemarks" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="cat_id"value="0">        
                        <input type="hidden" name="regfac_id" id="regfac_id" value="{{$regfac_id}}">   
                        <input type="hidden" name="id" id="id" value="">  
                        <input type="hidden" name="action" id="action" value="updremarks">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>				
                        <div class="col-sm-4">Remarks:</div>
                        <div class="col-sm-8" style="margin:0 0 .8em 0;">
                            <input type="text" id="remarks" name="remarks" placeholder="Remarks" class="form-control" required="">
                        </div>
                        <br/>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success form-control" style="border-radius:0;">
                                <span class="fa fa-sign-up"></span>Save
                            </button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function showChangeRemarks(id, remarks){

        $("#id").val(id);
        $("#remarks").val(remarks);

    }
</script>