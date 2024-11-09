

<div class="modal fade" id="confirmSubmitModalLto" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <p class="lead"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <b>Are you sure you want to submit form?</b></p>
                    <p>Please check and review your application form before submitting.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" onclick="setTimeout(function() {window.print()}, 10); ">
                    <i class="fa fa-eye" aria-hidden="true"></i> Preview
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    No, Recheck details
                </button>
                <form id="change_mainform" action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST" >
                                                {{ csrf_field() }}
                                                <input type="hidden" name="cat_id" id="cat_id" value="100000">
                                                <input type="hidden" name="hfser_id" value="{{$registered_facility->hfser_id}}">   
                                                <input type="hidden" name="appid" id="appid" value="{{$registered_facility->appid}}">         
                                                <input type="hidden" name="regfac_id" id="regfac_id" value="{{$registered_facility->regfac_id}}">  
                                                <input type="hidden" class="form-control" id="aptidnew" name="aptidnew" value="IC">       
                                                <input type="hidden" class="form-control" id="aptid" name="aptid" value="IC">       
                                                <input id="saveasn"  name="saveasn" value="partial" type="hidden" />
                                               
                                            

                            <button type="submit" class="btn btn-success">
                                <!-- href={{ asset('client/dashboard/application/requirements/') }} -->
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                Proceed
                </button>
                </form>  
            </div>
        </div>
    </div>
</div>