<div class="card sticky-top">
  <nav class="navbar navbar-expand navbar-dark" style="background-color: #004c00;">
    <a class="sidebar-toggle mr-3" href="#" id="menu-toggle" title="Show Sidebar"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="#">
          @isset ($employeeData)
              @isset ($employeeData->grpid)
                  @if ($employeeData->grpid == 'NA')
                      National Admin
                  @else
                      {{$employeeData->grp_desc}}, {{$employeeData->rgn_desc}}
                  @endif
              @endisset
          @endisset
        {{-- @if($employeeData->grpid)
        @endif --}}
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item S01_allow dropdown" id="navEmpl">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i id="AlertBell" class="fa fa-bell"></i>&nbsp;<span id="NumOfUnreadMsgs"></span>

              </a>
              <div class="dropdown-menu dropdown-menu-right" style="width: 300px;background-color: transparent;border: 0;" >
                <ul class="list-group" style="margin: 0;padding: 0;" id="AlertBoxes">
                  <a class="list-group-item list-group-item-action btn btn-outline-primary">
                    <center><small><strong>No Notifications</strong></small></center>
                  </a>
                </ul>
              </div>
            </li>
            {{-- <li class="nav-item S02_allow"><a href="#" class="nav-link "><i class="fa fa-bell"></i>1</a></li> --}}
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> @if(isset($employeeData->name)){{$employeeData->name}} @endif</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user" style="border-color: #004c00;border-width: thin;border-style: solid;">
                    {{-- <a href="#" class="dropdown-item S03_allow">Settings</a> --}}
                    {{-- <a href="{{ asset('employee/dashboard/act_logs') }}" class="dropdown-item S03_allow">Activity Logs</a> --}}
                    <a href="#" data-toggle="modal" data-target="#ChgPass" class="dropdown-item S03_allow">Change Password</a>

                    <a href="#" onclick="event.preventDefault();document.getElementById('employeeLogout').submit();" class="dropdown-item">Logout</a>
                    <form id="employeeLogout" action="{{asset('employee/logout')}}" method="GET" hidden>
                    {{csrf_field()}}
                  </form>
                </div>
            </li>
        </ul>
    </div>
  </nav>
</div>
<style type="text/css">
  .list-group-item.active:hover{
      background-color: #4C4F51;
      color: white;
  }
</style>
<script type="text/javascript">
  $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

  $.ajaxSetup({
    headers: {
      // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  @if(session()->has('employee_login'))
    $(document).ready(function(){
      checkMessage();
      // setInterval(function(){ checkMessage(); }, 5000);
    });

    function checkMessage(){
      $.ajax({
        url: '{{asset('/view/notification')}}',
        type: 'POST',
        async: false,
        data: {_token: $("input[name='_token']").val(), uid: '{{session()->get('employee_login')->uid}}'},
        success: function(a){
          $('#LOADERSDIV').hide();
          let data = JSON.parse(a);
          $('#AlertBoxes').empty();
          $("#NumOfUnreadMsgs").html(data['unread']);
          
          if (data['totalNotif'] <= 0) { // if Notification is Empty
             $('#NumOfUnreadMsgs').text('');
             $('#AlertBoxes').append(
                 '<a class="list-group-item list-group-item-action btn btn-outline-primary">' +
                   '<center><small><strong>No Notifications</strong></small></center>' +
                 '</a>'
               );
          } else {
            if (data['unread'] == 0) {
              $('#AlertBell').removeClass('faa-ring animated');
            } else {
              $('#AlertBell').addClass('faa-ring animated');
            }
            var allData = data['data'];
             for (var i = 0; i < allData.length; i++) {
               var checkRead = (allData[i].status ==  0) ? 'list-group-item-info' : 'list-group-item-dark' ; // if unread
               $('#AlertBoxes').append(
                   '<a href="'+allData[i].adjustedlink+'" class="list-group-item list-group-item-action '+checkRead+'" style=";cursor: pointer;">' + // background-color: #4C4F51;color: white
                     '<div class="d-flex w-100 justify-content-between">' +
                       '<h5 class="mb-1">&nbsp;</h5>' + // Title
                       '<small>'+allData[i].adjustedmonth+'</small>' + // Difference
                     '</div>' + 
                     '<p class="mb-1">'+allData[i].msg_desc+'</p>' + // Message // .substr(0, 20)
                     '<small>'+allData[i].notifdatetime+'</small>' + // Time Date
                   '</a>'
                 );
             }

             $('#AlertBoxes').append( // background-color: #6C7073;color: white;
                 '<a class="list-group-item list-group-item-action list-group-item-secondary" style="cursor: pointer;" onclick="window.location.href=\'{{ asset('employee/notification') }}\';">' +
                         '<center><small><strong>Show All</strong></small></center>' +
                 '</a>'
               );
           }

          }
      })
    }

    $("#navEmpl").click(function(event) {
      $.ajax({
        url: '{{asset('/update/notification')}}',
        type: 'POST',
        data: {_token: $("input[name='_token']").val(), uid: '{{session()->get('employee_login')->uid}}'},
      });  
    });

    
  @endif
  

</script>