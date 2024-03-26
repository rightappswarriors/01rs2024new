@section('title')
NOD - FDA
@endsection
@extends('main')
@section('content')
@include('client1.cmp.__payment')

<body>
    <style type="text/css">
        table,
        thead,
        tbody,
        tr,
        td,
        th {
            border: 1px solid black !important;
        }

        @media print {
            .hidePrint {
                visibility: hidden;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }

            .pagebreak {
                page-break-before: always;
            }
        }

        .table th {
            vertical-align: middle;
            text-align: center !important;
        }

        td {
            /* padding-right:10px */
            margin: 20px !important;
        }

        .sectab {
            width: 40%;
        }
    </style>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2 hide-div">
                        <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
                    </div>
                    <div class="col-md-8">
                        <h6 class="card-title text-center">Republic of the Philippines </h6>
                        <h5 class="card-title text-center">Department of Health</h5>
                        <h5 class="card-title text-center">FOOD AND DRUG ADMINISTRATION</h5>
                        <h5 class="card-title text-center">Filinvest Corporate City</h5>
                        <h5 class="card-title text-center">Alabang, City of Muntinlupa</h5>
                    </div>
                    <div class="col-md-2 hide-div">
                        <img src="{{asset('ra-idlis/public/img/fda.png')}}" class="img-fluid" style="float: left; padding-right: 30px; margin-top: 30px;">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="offset-7 container mt-4 mb-4 font-weight-bold">
                    <table style="width: 25%;">
                        <tr>
                            <td style="width: 70%;">Document No.:</td>
                            <td style="width: 30%;"></td>
                        </tr>
                        <tr>
                            <td>Revision:</td>
                            <td></td>
                        </tr>
                    </table>
                    <br>
                    Date:



                </div>
                <div class="container text-center pt-3 font-weight-bold" style="font-size: 30px;">NOTICE OF DEFICIENCY</div>

                <table class="table" style="width: 100%;">
                    <tr>
                        <td style="padding-right:10px">Name of X-ray Facility</td>
                        <td colspan="3"> {{$data->facilityname}}</td>
                    </tr>
                    <tr>
                        <td>Facility Address</td>
                        <td colspan="3">{{$data->street_number . ' ' .$data->street_name . ' ' . AjaxController::getAddressByLocation($data->rgnid,$data->provid,$data->cmid,$data->brgyid)}}</td>
                    </tr>

                    <!-- </table>
                <table class="table" style="width: 100%;">
                    -->
                    <tr>
                        <td colspan="2">Authorization Number:</td>
                        <td>Validity:</td>
                        <td>Issuance Date:</td>
                    </tr>
                </table>
                <div class="container text-justify mt-5">
                    TThe Health Physics team of the Center for Device Regulation, Radiation Health, and Research (CDRRHR), Food
                    and Drug Administration of the Department of Health, Manila conducted <input type="checkbox" />
                    Radiation Protection Survey and
                    Evaluation (RPSE) / <input type="checkbox" /> Facility Compliance Monitoring (FCM) on<u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>. The following
                    deficiency/ies was/were noted by the team (refer to the RPSE/FCM checklist):
                </div>
                <br>
                <table class="table">
                    <tr>
                        <td class="sectab"><b>I. Personnel</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>I. X-ray Machine</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>II. X-ray Examination Room</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>III. Darkroom</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>IV. Accessories</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>V. Administrative Requirements</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="sectab"><b>VII.Other Irregularities</b></td>
                        <td></td>
                    </tr>
                </table>
                <br>
                <b>Other Recommendations:</b><u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                <br><br>
                Failure to comply with the above-mentioned requirements on or before <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> shall be ground
                for disapproval of your application, and/or ground for appropriate action.
                <br>
                <br>
                This serves as a <b> FINAL NOTICE </b>to your facility.

                <br><br><b>Documents to be submitted:</b>
                <br><input type="checkbox" /> Proof of compliance (pictures, receipts, logbooks, charts, job report, etc.)
                <br><input type="checkbox" /> Notarized certificate of compliance
                <br><input type="checkbox" /> Others <u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>

                <br>
                <br>
                <b>HEALTH PHYSICS TEAM:</b>
                <br>
                <br>

                <center> <b>HEALTH PHYSICS TEAM:</b></center>
                <br>
                A copy of this report was left to me with its contents having been thoroughly explained. I have agreed and fully
                understood this notice.

                <div class="row pt-1">
                    <div class="col-md-2">Signature</div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-6" style="border-bottom: 1px solid;"></div>
                </div>
                <div class="row pt-1">
                    <div class="col-md-2">Printed Name</div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-6" style="border-bottom: 1px solid;" ></div>
                </div>
                <div class="row pt-1">
                    <div class="col-md-2">Position</div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-6" style="border-bottom: 1px solid;"></div>
                </div> 
                
                <div class="row pt-1">
                    <div class="col-md-2">Time of Visit:</div>
                    <div class="col-md-1" style="border-bottom: 1px solid;"></div>
                    <div class="col-md-2" >Arrival:</div>
                    <div class="col-md-1" style="border-bottom: 1px solid;"></div>
                    <div class="col-md-2" >Departure:</div>
                    <div class="col-md-1" style="border-bottom: 1px solid;"></div>
                </div>

                <hr>
                <center>
                    <b>
                    Civic Drive, Filinvest City, Alabang, 1781 Muntinlupa City<br>
                    Trunk Line: (632) 857 1900, Fax No. (632) 807 0751<br>
                    URL: http://www.fda.gov.ph; e-mail: cdrrhr_rrd@fda.gov.ph
                    </b>
                </center>
               

            </div>
        </div>
    </div>
    <script type="text/javascript">
        // window.print();
    </script>
</body>
@endsection