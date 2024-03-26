@if(count($r_grpid) > 0)
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <style>
    .hide{
      display: none;
    }
  </style>

  @php
    $data_count = array();
    $approved = 0;
    $denied = 0;
    foreach($hfaci_serv_type as $kkk => $vvv) {
      $data_count[$vvv->hfser_id] = 0;

    }

    foreach($BigData as $k => $v) {
      // switch($v->hfser_id) {
        foreach($hfaci_serv_type as $kk => $vv) {
          if($v->hfser_id == $vv->hfser_id)
          // case $vv->hfser_id: 
            $data_count[$v->hfser_id]++;
        }
      // }

      if ($v->isApprove == 1) $approved++;
      else if ($v->isApprove == 2) $denied++;
    }

    $surv_count = count($new_data["surv"]);
    $mon_count = count($new_data["mon"]);
  @endphp
  @php
  $concount=0;
 $atocount=0;
$coacount=0;
$corcount=0;
$ltocount=0;
$ptccount=0;


  foreach($appcount as $ap => $a) {
    switch($a->hfser_id){
									case 'CON' :
                    $concount = $a->ctr;
                  break;
                  	case 'ATO' :
                    $atocount = $a->ctr;
                  break	;
                  case 'COA' :
                    $coacount = $a->ctr;
                  break ;
                  case 'COR' :
                    $corcount = $a->ctr;
                  break ;
                   case 'LTO' :
                    $ltocount = $a->ctr;
                  break;
                   default:
                    $ptccount = $a->ctr;
                  break;
    }
  }
  @endphp

  
  <div class="" style="padding: 10px;">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box" data-redirect = 'CON' style="cursor: pointer;" onclick="toProcessFlow(1,'CON')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CON Applications</span>
            <span class="info-box-number">{{$concount}}</span>
            <!-- <span class="info-box-number">{{$data_count["CON"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>

        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'PTC' style="cursor: pointer;" onclick="toProcessFlow(1,'PTC')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PTC Applications</span>
            <span class="info-box-number">{{$ptccount}}</span>
            <!-- <span class="info-box-number">{{$data_count["PTC"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'LTO' style="cursor: pointer;" onclick="toProcessFlow(1,'LTO')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">LTO Applications</span>
            <span class="info-box-number">{{$ltocount}}</span>
            <!-- <span class="info-box-number">{{$data_count["LTO"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'ATO' style="cursor: pointer;" onclick="toProcessFlow(1,'ATO')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ATO Applications</span>
            <span class="info-box-number">{{$atocount}}</span>
            <!-- <span class="info-box-number">{{$data_count["ATO"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'COA' style="cursor: pointer;" onclick="toProcessFlow(1,'COA')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">COA Applications</span>
            <span class="info-box-number">{{$coacount}}</span>
            <!-- <span class="info-box-number">{{$data_count["COA"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'COR' style="cursor: pointer;" onclick="toProcessFlow(1,'COR')">
          <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">COR Applications</span>
            <span class="info-box-number">{{$coacount}}</span>
            <!-- <span class="info-box-number">{{$data_count["COR"]}}</span> -->
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
{{--       <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;">Near Deadlines Applications</span>
            <span class="info-box-number">0/span>
          </div>

        </div>

      </div> --}}
      <!-- /.col -->
{{--       <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

          <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;">Stop Clock Applications</span>
            <span class="info-box-number">0</span>
          </div>
        </div>

      </div> --}}
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'SURV' style="cursor: pointer;" onclick="toProcessFlow(2,'SURV')">
          <span class="info-box-icon bg-light-blue-gradient"><i class="fa fa-desktop"></i></span>

          <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;">Health Facilities for Surveillance or Surveyed</span>
            <span class="info-box-number">{{$surv_count}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box" data-redirect = 'MON' style="cursor: pointer;" onclick="toProcessFlow(3,'MON')">
          <span class="info-box-icon bg-blue"><i class="fa fa-video-camera"></i></span>

          <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;">Health Facilities for Monitoring or Monitored</span>
            <span class="info-box-number">{{$mon_count}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-thumbs-o-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;">Approved Applications </span>
            <span class="info-box-number">{{$approved}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-thumbs-o-down"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Denied Applications</span>
            <span class="info-box-number">{{$denied}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
      <!-- Left col -->
      <section id="setDataLeft" class="col-lg-6 connectedSortable">
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section id="setDataRight" class="col-lg-6 connectedSortable">
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div>
  <!-- ./wrapper -->
  <div id="removeDataAfter" hidden>
    <!-- div id="getData2" class="getDataClass">
     
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>

          <h3 class="box-title">Near Deadline Applications</h3>

          <div class="box-tools pull-right hide">
            <ul class="pagination pagination-sm inline">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
        
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin" id="dt">
              <thead>
              <tr>
                <th>Application Type</th>
                <th>Application Code</th>
                <th>Facility Name</th>
                <th>Date Applied</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
              @foreach($BigData as $data)
              <tr>
                <td>{{$data->hfser_id}}</td>
                <td class="font-weight-bold">{{$data->uid.'_'.$data->hfser_id.'_'.$data->appid}}</td>
                <td>{{$data->facilityname}}</td>
                <td>{{$data->t_date}}</td>
                <td>{{$data->trns_desc}}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div -->

    {{--
    <div id="getData4" class="getDataClass">
      <!-- Calendar -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Stop Clock Applications</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin hide">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
         <!--  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right hide">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <div id="getData6" class="getDataClass">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Applications for Approval</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body hide">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
         <!--  <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right hide">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
   --}}
    <!-- <div id="getData88" class="getDataClass"> -->
      <!-- <div class="box box-solid bg-teal-gradient"> -->
        <!-- <div class="box-header">
          <i class="fa fa-th"></i>

        

          <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div class="chart" id="line-chart" style="height: 250px;">
           </div>
        </div> -->
        <!-- width="640" -->
        <!-- <iframe src="https://docs.google.com/presentation/d/e/2PACX-1vSBOSAYVhQpfIkWVjkU5JCx2ZodBRqRAL3tLUsHQQ9hO63xg-5ObkL_r_a1OQOAaG2-I1AFovgWJoqf/embed?start=false&loop=false&delayms=3000" 
        frameborder="0" width="580" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
          -->
          <!-- <iframe src="https://docs.google.com/presentation/d/e/2PACX-1vQGwCqb08-Q1O47roBEYdCqshGnmUHBXrta7XZ6-6oX_Sp1rUNLxYIvGH8LuGXO0eJMSRltVL4Rv4P5/embed?start=true&loop=true&delayms=3000" frameborder="0" 
            width="580" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
     -->
        <!-- /.box-body -->
      <!-- </div> -->
      <!-- /.nav-tabs-custom -->
    <!-- </div>  -->
    <div id="getData1" class="getDataClass">
      <div class="box box-solid bg-teal-gradient">
        <div class="box-header">
          <i class="fa fa-th"></i>

          <h3 class="box-title"> Application Process Flows</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
            </button>
            
          </div>
        </div>
        <div class="box-body border-radius-none">
          <div class="chart" id="line-chart" style="height: 250px;">
          @include('employee.processflowList')
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div> 
   {{--
    <div id="getData3" class="getDataClass">
      <!-- Chat box -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Surveyed Applications</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive hide">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right hide">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
    </div>

    <div id="getData5" class="getDataClass">
        <!-- TO DO List -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Applications for Recommendations</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body hide">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20"><canvas width="34" height="20" style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas></div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right hide">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    --}}
  </div>
  <!-- Custom JS for WIDGET LOAD -->
  <script src="{{ asset('ra-idlis/public/js/forall.js') }}"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $("#dt").DataTable({
        "pageLength": 5
      });
    })
    var defaultData = { defaultLeft: ["getData88","getData1", "getData3", "getData5"], defaultRight: ["getData2", "getData4", "getData6"] }, dataSet = ['setDataLeft', 'setDataRight'], dataCount = ['defaultLeft', 'defaultRight'], setData = { setDataLeft: [], setDataRight: [] }, setDataCount = ['setDataLeft', 'setDataRight'], grpid = JSON.stringify({!!$r_grpid[0]->w_json!!}), n_grpid = JSON.stringify({!!$n_grpid[0]->w_custom_json!!});
    if(grpid != undefined || grpid != null) { defaultData = JSON.parse(grpid); } if(n_grpid != undefined || n_grpid != null) { defaultData = JSON.parse(n_grpid); }
    for(let j = 0; j < dataSet.length; j++) { if(defaultData != undefined) { if(defaultData[dataCount[j]] != undefined) { if(defaultData[dataCount[j]].length > 0) { for(let i = 0; i < defaultData[dataCount[j]].length; i++) { let setDataLeft = document.getElementById(dataSet[j]), insData = document.getElementById(defaultData[dataCount[j]][i]); if(setDataLeft != undefined || setDataLeft != null) { if(insData != undefined || insData != null) {
      setDataLeft.appendChild(insData);
    } } } } } } }
    deleteCurrentRow(document.getElementById('removeDataAfter'));
    // 'setDataLeft'
    function dispUpdate(elId) {
      let dom = document.getElementById(elId), retArr = [];
      if(dom != undefined || dom != null) {
        var eDom = dom.getElementsByClassName('getDataClass');
        for(let i = 0; i < eDom.length; i++) {
          retArr.push(eDom[i].id);
        }
      }
      return retArr;
    }
    function getDataSet() {
      setData = { setDataLeft: dispUpdate('setDataLeft'), setDataRight: dispUpdate('setDataRight') }, setDataCount = ['setDataLeft', 'setDataRight'], rBool = true;
      for(let j = 0; j < dataCount.length; j++) { if(defaultData != undefined && setData != undefined) { if(defaultData[dataCount[j]] != undefined && setData[setDataCount[j]] != undefined) { for(let i = 0; i < setData[setDataCount[j]].length; i++) {
        if(defaultData[dataCount[j]][i] != undefined || defaultData[dataCount[j]][i] != null) { if(defaultData[dataCount[j]][i] != setData[setDataCount[j]][i]) {
          rBool = false;
        } } else { 
          rBool = false;
        }
      } } } }
      return rBool;
    }
    function getDrop() {
      if(! getDataSet()) {
        saveCustom();
      }
    }
    function saveCustom() {
      console.log('not equal.');
    }
    window.addEventListener('drop', getDrop);
    document.body.addEventListener('drop', getDrop);
  </script>
  <!-- jQuery 3 -->
  {{-- <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script> --}}
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  {{-- <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script> --}}
  <!-- Morris.js charts -->
  <script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap -->
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- datepicker -->
  <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <!-- Slimscroll -->
  <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
  <!-- FastClick -->
  <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('dist/js/demo.js')}}"></script>
  
  <script>
    function toProcessFlow(caseForDirectory,where){
      switch (caseForDirectory) {
        case 1:
          url = "{{url('employee/dashboard/processflow/view/')}}" + "/" + where;
          break;
         case 2:
          url = "{{url('employee/dashboard/others/surveillance')}}";
          break;
         case 3:
          url = "{{url('employee/dashboard/others/monitoring')}}";
          break;
      }
      window.location.href = url;
    }
  </script>
@endif