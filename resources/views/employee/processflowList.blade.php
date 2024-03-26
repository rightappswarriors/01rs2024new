<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<center>

    <div style="color: gray; ">
        <div class="row">


            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box" data-toggle="modal" data-target="#con" data-redirect='CON' style="cursor: pointer;">
                    <div style="padding: 25%">
                        <h1>CON</h1>
                    </div>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="con" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">CON PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.con_process')

                        </div>

                    </div>
                </div>
            </div>




            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box" data-redirect='CON' data-toggle="modal" data-target="#ptc" style="cursor: pointer;">
                    <div style="padding: 25%">
                        <h1>PTC</h1>
                    </div>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="ptc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">PTC PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.ptc_process')

                        </div>

                    </div>
                </div>
            </div>




            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box" data-redirect='CON'  data-toggle="modal" data-target="#lto" style="cursor: pointer;">
                    <div style="padding: 25%">
                        <h1>LTO</h1>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
 <!-- Modal -->
 <div class="modal fade" id="lto" tabindex="-1" role="dialog" aria-labelledby="lto" aria-hidden="true">
                <div class="modal-dialog  modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">LTO PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.lto_process')

                        </div>

                    </div>
                </div>
            </div>





            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box" data-redirect='CON' data-toggle="modal" data-target="#ato" style="cursor: pointer;">


                    <div style="padding: 25%">
                        <h1>ATO</h1>


                    </div>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
            </div>
              <!-- Modal -->
              <div class="modal fade" id="ato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">COR PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.con_process')

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-md-3 col-sm-6 col-xs-12">


            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box" data-redirect='CON' data-toggle="modal" data-target="#coa" style="cursor: pointer;">


                    <div style="padding: 25%">
                        <h1>COA</h1>


                    </div>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
            </div>
            <div class="modal fade" id="coa" tabindex="-1" role="dialog" aria-labelledby="lto" aria-hidden="true">
                <div class="modal-dialog  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">COA PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.coa_process')

                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="info-box" data-redirect='CON' data-toggle="modal" data-target="#cor" style="cursor: pointer;">


                    <div style="padding: 25%">
                        <h1>COR</h1>


                    </div>
                    <!-- /.info-box-content -->
                </div>

                <!-- /.info-box -->
            </div>
              <!-- Modal -->
              <div class="modal fade" id="cor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">COR PROCESS FLOW</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('employee.processflow-content.con_process')

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</center>