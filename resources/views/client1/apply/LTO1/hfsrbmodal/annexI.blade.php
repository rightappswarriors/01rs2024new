<div class="remthis modal fade" id="viewModalI" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
        <div class="modal-content">

            <div class="modal-header" id="viewHeadI">
                <h5 class="modal-title">LIST OF TESTING MATERIALS (Annex I)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="viewBodyI">
                <div id="_errMsg"></div>

                <div class="card-body table-responsive" id="viewAllI">
                    <span id="viewModalHeader">
                        <button class="btn btn-primary mb-5" type="button" style="width:100px" data-toggle="modal" data-target="#addModalI" id="addBtn">
                            Add
                        </button>
                    </span>
                    <div id="tApp_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover" style="font-size: 13px;" id="tAppI">
                            <thead style="background-color: #428bca; color: white">
                                <tr role="row">
                                    <th class="text-center">Test</th>
                                    <th class="text-center">Kit Type</th>
                                    <th class="text-center">Kit</th>
                                    <th class="text-center">Lot No.</th>
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

<div class="remthis modal fade mt-5" id="addModalI" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true" id="toDark" style="border-color: rgba(126, 239, 104, 0.8);">
    <div class="modal-dialog modal-lg shadow" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="addModalLabel">NEW KIT</h6>
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
                                <div class="col-sm-12"><b>Testing Material Information</b></div>
                            </div>
							
							<div class="row mb-2">
                                <div class="col-sm-6">Test:</div>
                                <div class="col-sm-6">Kit Type:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
									<select class="form-control w-100" name="add_test" required="" data-required="true" data-parsley-required-message="<b>*Profession</b> required">
                                        <option hidden="" selected="" disabled="">Please select</option>
                                        <option value="SC">Screening Test/s, specify name of kit</option>
                                        <option value="SU">Supplemental Test/s, specify name of kit</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control w-100" required="" data-parsley="" data-parsley-required-message="<b>*Kit Type</b> required">
                                </div>
                            </div>

							
                            <div class="row mb-2">
                                <div class="col-sm-12">Kit:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
									<textarea class="form-control w-100"></textarea>
								</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">Lot Number:</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <input class="form-control w-100" name="add_equipmentqty" required="" data-parsley="" data-parsley-required-message="<b>*Lot Number</b> required">
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

    $('#addModalI').on('shown.bs.modal', function (e) {
        $("#viewBodyI").css({ opacity: 0.5 });
        $("#viewBodyI").css('background-color', '#dedede');
        $("#viewHeadI").css({ opacity: 0.5 });
        $("#viewHeadI").css('background-color', '#dedede');
        $("#addBtn").addClass("disabled");
        $('#form').parsley();
    })

    //when add modal closes
    $('#addModalI').on('hidden.bs.modal', function (e) {
        $("#viewBodyI").css({ opacity: 1 });
        $("#viewBodyI").css('background-color', '#ffffff');
        $("#viewHeadI").css({ opacity: 1 });
        $("#viewHeadI").css('background-color', '#ffffff');
        $("#addBtn").removeClass("disabled");
    })

    $('#tAppI').DataTable();
</script>