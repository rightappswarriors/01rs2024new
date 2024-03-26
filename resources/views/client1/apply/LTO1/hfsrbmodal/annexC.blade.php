<div class="remthis modal fade" id="viewModalC" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
        <div class="modal-content">

            <div class="modal-header" id="viewHeadC">
                <h5 class="modal-title">LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex C)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBodyC">
                <div id="_errMsg"></div>

                <div class="card-body table-responsive" id="viewAllC">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalC" id="addBtn">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tAppC">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">Test Method</th>
                                    <th class="text-center">Equipment</th>
                                    <th class="text-center">Reagent/Media</th>
                                    <th class="text-center">Laboratory Ware and Materials</th>
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

<div class="remthis modal fade mt-5" id="addModalC" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark" style="border-color: rgba(126, 239, 104, 0.8);">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="addModalLabel">NEW REAGENT</h6>
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
                                <div class="col-sm-12"><b>Reagent Information</b></div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">Test Method:</div>
                                <div class="col-sm-12">
                                    <textarea class="form-control w-100" name="add_equipmentname" required="" data-parsley="" data-parsley-required-message="<b>*Test Method</b> required"></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4">Equipment:</div>
                                <div class="col-sm-4">Reagent/Media:</div>
                                <div class="col-sm-4">Laboratory Ware and Materials.:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <textarea class="form-control w-100" name="add_equipmentbrand" required="" data-parsley="" data-parsley-required-message="<b>*Equipment</b> required"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea class="form-control w-100" name="add_equipmentmodel" required="" data-parsley="" data-parsley-required-message="<b>*Reagent/Media</b> required"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea class="form-control w-100" name="add_equipmentserialno" required="" data-parsley="" data-parsley-required-message="<b>*Laboratory Ware and Materials.</b> required"></textarea>
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

    $('#addModalC').on('shown.bs.modal', function (e) {
        $("#viewBodyC").css({ opacity: 0.5 });
        $("#viewBodyC").css('background-color', '#dedede');
        $("#viewHeadC").css({ opacity: 0.5 });
        $("#viewHeadC").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalC').on('hidden.bs.modal', function (e) {
        $("#viewBodyC").css({ opacity: 1 });
        $("#viewBodyC").css('background-color', '#ffffff');
        $("#viewHeadC").css({ opacity: 1 });
        $("#viewHeadC").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    $('#tAppC').DataTable();
</script>