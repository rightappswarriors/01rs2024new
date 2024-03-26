<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 1px 1px 1px 1px;">
  <a class="navbar-brand">
    <div class="row">
      <div class="col-xs-6">
        <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="max-height: 90px; padding-left: 20px;">
      </div>
      <div class="col-xs-6">
        <div class="republic">
          <p><small>Republic of the Philippines</small></p>    
          <p  style="margin-top: -10px;font-size: 18px;font-weight: 600">DEPARTMENT OF HEALTH</p>
          <p  style="margin-top: -10px;">Kagawaran ng Kalusugan</p>
          <p  style="margin-top: -10px;">ISO 9001:2008 CERTIFIED</p>
        </div>
      </div>
    </div>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @isset($curUser) 
      <ul class="navbar-nav mr-auto">
      </ul>
      <ul class="navbar-nav ml-auto" style="padding: 0px 20px;">
        <li class="nav-item @isset($curPage) active @endisset">
          <a class="nav-link" href="{{asset('/client/home')}}">HOME</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-bell"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item">Sample Notification</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">See all</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fa fa-user-circle"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <center><p class="dropdown-item"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="max-height: 60px;"></p></center>
            <p class="dropdown-item">{{$curUser->authorizedsignature}}</p>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle="modal" data-target="#curUserModal" href="javascript:void(0)">View Information</a>
            <a class="dropdown-item" href="{{asset('/logout_user')}}">Logout</a>
          </div>
        </li>
      </ul>
    @else
      <form class="form-inline my-2 my-lg-0 ml-auto" method="POST" action="{{asset('/login_user')}}" style="padding: 0px 20px;">
        {{csrf_field()}}
        <input class="form-control mr-sm-2" type="text" name="uid" placeholder="Username" aria-label="Username" autocomplete="off">
        <input class="form-control mr-sm-2" type="password" name="pwd" placeholder="Password" aria-label="Password" autocomplete="off">
        <button class="btn btn-primary form-control" type="submit">Login</button>
      </form>
    @endisset
  </div>
</nav>
@isset($curUser)
<div class="modal fade" id="curUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Current User Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          {{-- <div class="col-md-6">
            <h5><small>Facility Name: </small> <br><strong>{{$curUser->facilityname}}</strong></h5>
          </div> --}}
          <div class="col-md-12">
            <h5><small>Owner: </small> <br><strong>{{$curUser->authorizedsignature}}</strong></h5>
          </div>
        </div><hr>
        @isset($forCurUser_) @if(count($forCurUser_) > 0)
        <div class="row">
          <div class="col-md-12">
            <h5><small>Email: </small> <br><strong style="word-wrap: break-word;">{{$curUser->email}}</strong></h5>
          </div>
          {{-- <div class="col-md-4">
            <h5><small>Institutional Character: </small> <br><strong style="word-wrap: break-word;">{{((isset($forCurUser_[0]->facmdesc)) ? $forCurUser_[0]->facmdesc : 'No Mode selected')}}</strong></h5>
          </div>
          <div class="col-md-4">
            <h5><small>Bed Capacity: </small> <br><strong style="word-wrap: break-word;">{{((isset($curUser->bed_capacity)) ? $curUser->bed_capacity : '0')}} Bed(s)</strong></h5>
          </div> --}}
        </div><hr>
        {{-- <div class="row">
          <div class="col-md-6">
            <h5><small>Type of Facility: </small> <br><strong>{{((isset($forCurUser_[0]->hgpdesc)) ? $forCurUser_[0]->hgpdesc : 'No Type of Facility')}}</strong></h5>
          </div>
          <div class="col-md-6">
            <h5><small>Service Capabilities: </small> <br><strong>@isset($forCurUserFac_) @if(count($forCurUserFac_) > 0) @for($i = 0; $i < count($forCurUserFac_); $i++){{(($i < 1) ? $forCurUserFac_[$i]->facname : ', '.$forCurUserFac_[$i]->facname)}}@endfor @else No facility type @endif @else No facility type @endisset</strong></h5>
          </div>
        </div><hr> --}}
        <div class="row">
          <div class="col-md-6">
            <h5><small>Location: </small> <br><strong>{{$forCurUser_[0]->brgyname}}, {{$forCurUser_[0]->cmname}}, {{$forCurUser_[0]->provname}}</strong></h5>
          </div>
          <div class="col-md-6">
            <h5><small>Street and House No. (if required): </small> <br><strong><u>{{$curUser->streetname}}</u> <u>{{$curUser->houseno}}</u></strong></h5>
          </div>
        </div><hr>
        <h5><small>Region: </small> <br><strong>{{$forCurUser_[0]->rgn_desc}}</strong></h5>
        @else
        No record(s).
        @endif @endisset
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endisset