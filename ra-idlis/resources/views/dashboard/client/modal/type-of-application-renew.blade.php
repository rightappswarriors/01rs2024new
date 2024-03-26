<!-- Modal -->
<div class="modal fade" id="applicationTypeModalRenew" tabindex="-1" role="dialog" aria-labelledby="applicationTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="applicationTypeModalLabel">Choose Application Type for Renewal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-5 alert alert-success text-center">
                                <a style="color: #28a745" href="{{asset('client/dashboard/application/authority-to-operate')}}?grpn=c&type=r">Authority to Operate</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5 alert alert-warning text-center">
                                <!-- <a style="color: #ffc107" href="{{asset('client1/apply/app')}}/COR}}">Certificate of Accreditation</a> -->
                                <a style="color: #ffc107" href="{{asset('client/dashboard/application/certificate-of-accreditation')}}?grpn=c&type=r">Certificate of Accreditation</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5 alert alert-danger text-center">
                                <a style="color: #dc3545" href="{{asset('client/dashboard/application/license-to-operate')}}?grpn=c&type=r">License to Operate</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5 alert alert-dark text-center">
                                <!-- <a style="color: #343a40" href="{{asset('client1/apply/app')}}/COR}}">Certificate of Registration</a> -->
                                <a style="color: #343a40" href="{{asset('client/dashboard/application/certificate-of-registration')}}?grpn=c&type=r">Certificate of Registration</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>