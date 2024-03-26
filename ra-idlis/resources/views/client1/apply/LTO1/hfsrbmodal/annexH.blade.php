<div class="remthis modal fade" id="viewModalH" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
        <div class="modal-content">

            <div class="modal-header" id="viewHeadH">
                <h5 class="modal-title">LIST OF EQUIPMENT, LABORATORY WARE AND MATERIALS (Annex H)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBodyH">
                <div id="_errMsg"></div>

                <div class="card-body table-responsive" id="viewAllH">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalH" id="addBtn">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tAppH">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">Brand Name</th>
                                    <th class="text-center">Model</th>
                                    <th class="text-center">Serial No.</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Date of Purchase</th>
                                    <th class="text-center">Laboratory Ware and Equipment</th>
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

<div class="remthis modal fade mt-5" id="addModalH" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark" style="border-color: rgba(126, 239, 104, 0.8);">
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
                                    <input type="number" class="form-control w-100" name="add_equipmentqty" required="" data-parsley="" data-parsley-required-message="<b>*Quantity</b> required">
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control w-100" name="add_equipmentdop" required="" data-parsley="" data-parsley-required-message="<b>*Date of Purchase</b> required">
                                </div>
                            </div>
							
							<div class="row mb-2">
                                <div class="col-sm-12">Laboratory Ware and Materials</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
									<textarea  class="form-control  w-100" required="" data-parsley=""></textarea>
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

    $('#addModalH').on('shown.bs.modal', function (e) {
        $("#viewBodyH").css({ opacity: 0.5 });
        $("#viewBodyH").css('background-color', '#dedede');
        $("#viewHeadH").css({ opacity: 0.5 });
        $("#viewHeadH").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalH').on('hidden.bs.modal', function (e) {
        $("#viewBodyH").css({ opacity: 1 });
        $("#viewBodyH").css('background-color', '#ffffff');
        $("#viewHeadH").css({ opacity: 1 });
        $("#viewHeadH").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    $('#tAppH').DataTable();
</script>