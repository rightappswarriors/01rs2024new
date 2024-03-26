<!-- Modal -->
<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
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
            <p >Please check and review your application form before submitting.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa fa-times" aria-hidden="true"></i> 
            No, Recheck details
        </button>
        <button type="submit" class="btn btn-success" data-dismiss="modal"
        
         >
         <!-- href={{ asset('client/dashboard/application/requirements/') }} -->
            <i class="fa fa-paper-plane" aria-hidden="true"></i> 
            Submit and Proceed to Submission of Requirements
        </button>
      </div>
    </div>
  </div>
</div>