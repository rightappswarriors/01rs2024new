<!-- <div style="display: none" id="paymentsRN" >
    <div class="accordion" id="accordionExample" >
  
        <div class="card">

            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Payment Details Renewal
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tr ><td colspan="2"><center><b>Facility Registration Fee</b></center></td></tr>
                        <tbody id="not_serv_chgN">
                            <tr>
                                <td colspan="2">{{--- No Facility Type selected. ---}} </td>
                            </tr>
                        </tbody>
                        <tr ><td colspan="2"><center><b>Services Fee</b></center></td></tr>
                        <tbody id="serv_chgN">
                            <tr>
                                <td colspan="2">No Services selected.</td>
                            </tr>
                        </tbody>
                        <tr ><td colspan="2"><center><b>Ambulance Fee</b></center></td></tr>
                        <tbody id="serv_chg_notN">
                        <tr>
                                <td colspan="2">No Ambulance</td>
                            </tr>
                        </tbody>

                        
                        <tbody id="totalfeesN" style="display:none;">
                                <tr>
                                    <td colspan="2"><br/><center><b style="font-size:150%;">TOTAL FEES: ₱0.00</b></center></td>
                                </tr>
                            </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Application Details
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body table-responsive">
                <div style="display: none;">
                    @if(isset($hfser))
                    @if ($hfser == 'CON')
                    <?php $value = 'Certificate of Need' ?>
                    @elseif ($hfser == 'PTC') {
                    <?php $value = 'Permit to Construct' ?>
                    }
                    @elseif ($hfser == 'ATO') {
                    <?php $value = 'Authority to Operate' ?>
                    }
                    @elseif ($hfser == 'COA') {
                    <?php $value = 'Certificate of Accreditation' ?>
                    }
                    @elseif ($hfser == 'LTO') {
                    <?php $value = 'License to Operate' ?>
                    }
                    @else
                    <?php $value = 'Certificate of Registration' ?>
                    @endif
                    @endif
                </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="background-color: #4682B4; color: white;">Type of Facility</th>
                                <td >@if(isset($value)){{$value}}@endif</td>
                            </tr>
                            <tr>
                                <th style="background-color: #4682B4; color: white;">Status of Application</th>
                                <td id="appStat">No Status</td>
                            </tr>
                            <tr>
                                <th style="background-color: #4682B4; color: white;">Name of Facility</th>
                                <td id="appFacName">No Facility Name</td>
                            </tr>
                            <tr>
                                <th style="background-color: #4682B4; color: white;">Owner</th>
                                <td id="appOwner">No Owner</td>
                            </tr>
                            <tr>
                                <th style="background-color: #4682B4; color: white;">Date of Application</th>
                                <td id="appDate">No Date</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div> -->