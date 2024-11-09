
<form action="{{asset('/client1/changerequest/actionsubmit')}}" method="POST">
    {{ csrf_field() }}
    <!-- Application Details -->
    <input type="hidden" name="appid" id="appid" value="{{$appform->appid}}">
        
    <div class="modal fade" id="changeCOH" tabindex="-1" aria-labelledby="changeCOHModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeCOHModalLabel">CLASSIFICATION OF HOSPITAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <hr />
                    <div class="row">
                        <div class="col-md-6 change-div">
                            <label for="ownership">Classification of Hospital <span class="text-danger">*</span></label>

                            <select onchange="sel_hosp_class(this.value)" class="form-control"  data-funcid="duplicate" id="funcid" name="funcid">
                                <option  selected value hidden disabled>Please select</option>                            
                                @foreach($function AS $each)
                                    <option value="{{$each->funcid}}">{{$each->funcdesc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 change-div">
                            <label for="classification">Hospital Level <span class="text-danger">*</span></label>
                            
                            
                            
                            <div class=" forHosp" style="width: 100%;" hidden>
                            <!-- <div class="showifHospital forHosp" style="width: 100%;" hidden> -->
                                <div class="mb-2 col-md-12">&nbsp;</div>
                                <div class="showifHospital-class" hidden>
                                    <div class="col-md-12">
                                        <b class="text-primary">For Hospital
                                        </b>
                                    </div>

                                    {{-- Hospital --}}
                                    <div class="col-md-4">
                                        <label>
                                            <!-- <input type="radio" name="facid" checked value="HSTC"/> Trauma Center -->
                                            <!-- <div class="addCLick " id="hgpid6"></div> -->
                                            <div class="addCLick mb-3" id="hgpid6"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-2 col-md-12">&nbsp;</div>
                                <div class="showifSpecial-class" hidden>
                                    <div class="col-md-12">
                                        <b class="text-primary">For Specialty
                                        </b>
                                    </div>

                                    {{-- Hospital --}}
                                    <div class="col-md-4">
                                        <label>
                                            <!-- <input type="radio" name="facid" checked value="HSTC"/> Trauma Center -->
                                            <!-- <div class="addCLick " id="hgpid6"></div> -->
                                            <div class="addCLick mb-3 hgpid6" id="hgpid6-new"></div>
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger action-btn" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        No, Recheck details
                    </button>
                    <button class="btn btn-primary action-btn" type="submit">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Data
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>