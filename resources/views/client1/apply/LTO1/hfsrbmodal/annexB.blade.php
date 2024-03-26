<div class="remthis modal fade" id="viewModalB" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
        <div class="modal-content">

            <div class="modal-header" id="viewHeadB">
                <h5 class="modal-title">LIST OF EQUIPMENT/ INSTRUMENT (Annex B)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBodyB">
                <div id="_errMsg"></div>

                <div class="card-body table-responsive" id="viewAllB">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalB" id="addBtn">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tAppB">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">Equipment</th>
                                    <th class="text-center">Brand Name</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Serial No.</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Date of Purchase</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="remthis modal fade mt-5" id="addModalB" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark" style="border-color: rgba(126, 239, 104, 0.8);">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="addModalLabel">NEW EQUIPMENT</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card-body table-responsive" id="addAll">
                    <form method="POST" action="" id="form" data-parsley-validate novalidate>
                        {{csrf_field()}}
                        <input id="appid" type="hidden" name="appid" value="{{$appid}}">
                        <input id="id" type="hidden" name="id" value="">
                        <div class="container">
                            <div class="row mb-2">
                                <div class="col-sm-12"><b>Equipment Information</b></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">Equipment:</div>
                                <div class="col-sm-12">
                                    <input class="form-control w-100" name="add_equipmentname" required="" data-parsley="" data-parsley-required-message="<b>*Equipment</b> required">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4">Brand Name:</div>
                                <div class="col-sm-4">Model:</div>
                                <div class="col-sm-4">Serial No.:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <input class="form-control w-100" name="add_equipmentbrand" required="" data-parsley="" data-parsley-required-message="<b>*Brand</b> required">
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control w-100" name="add_equipmentmodel" required="" data-parsley="" data-parsley-required-message="<b>*Model</b> required">
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control w-100" name="add_equipmentserialno" required="" data-parsley="" data-parsley-required-message="<b>*Serial No.</b> required">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">Quantity:</div>
                                <div class="col-sm-6">Date of Purchase:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <input class="form-control w-100" name="add_equipmentqty" required="" data-parsley="" data-parsley-required-message="<b>*Quantity</b> required">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" name="add_equipmentdop" required="" data-parsley="" data-parsley-required-message="<b>*Date of Purchase</b> required">
                                </div>
                            </div>
							
							<br/>
							<div class="row mb-2">
                                <div class="col-sm-4">&nbsp;</div>
                                <div class="col-sm-4">
                                    <button class="btn btn-success w-100" type="button" onclick="onSubmit()">SUBMIT</button>
                                </div>
								<div class="col-sm-4">&nbsp;</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('#addModalB').on('shown.bs.modal', function (e) {
        $("#viewBodyB").css({ opacity: 0.5 });
        $("#viewBodyB").css('background-color', '#dedede');
        $("#viewHeadB").css({ opacity: 0.5 });
        $("#viewHeadB").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalB').on('hidden.bs.modal', function (e) {
        $("#viewBodyB").css({ opacity: 1 });
        $("#viewBodyB").css('background-color', '#ffffff');
        $("#viewHeadB").css({ opacity: 1 });
        $("#viewHeadB").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    $('#tAppB').DataTable();
</script>