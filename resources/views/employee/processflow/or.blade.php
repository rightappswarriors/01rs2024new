@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Offical Receipt Print')
  @section('content')
		<div class="content"  style="padding-left:408px; margin-top: 302.362204724px;">
  	<div style=" width: 514px; height: 945px;">
      {{-- <div class="container pt-5">
        <div class="row">
          <div class="col-3">
            <img class="w-50" style="float: right;" src="{{asset('ra-idlis/public/img/phiRepub.png')}}" alt="PHILIPPINE REBUBLIC LOGO">  
          </div>
          <div class="col-6 text-center">
            <p class="h1 font-weight-bold">OFFICIAL RECEIPT</p>
            <p> Republic of the Philippines</p>
            <p class="h4 font-weight-bold"> DEPARTMENT OF HEALTH</p>
            <p>San Lazaro Compound, Rizal Avenue</p>
            <p>Sta. Cruz,. Manila, Philippines</p>
            <p>Tel. No. (632) 743-8301 / (632) 651-7800</p>
          </div>
          <div class="col-3">
            <img class="w-50" src="{{asset('ra-idlis/public/img/doh2.png')}}" alt="DOH LOGO">
          </div>
        </div>
      </div>
      <br> --}}
  		<table class="table table-borderless">
        <tbody>
          <tr>
            <td scope="row" style="padding-left: 20px;" class="text-left">{{Date('Y-m-d',strtotime('now'))}}</td>
            {{-- <td class="text-left"><span>{{$or}}</span></td> --}}
          </tr>
          <tr>
            <td scope="row" style="padding-left: 50px;" class="text-left"><span class="">{{$payor}}</span></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2" style="padding-left: 40px;" class="text-left"><span class="">{{$address}}</span></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <div class="container-fluid pl-0">
        <table class="table table-borderless">
          <thead>
            <tr>
              <td>
               {{--  Nature of Collection --}}
              </td>
              <td>
                {{-- Account Code --}}
              </td>
              <td>
                {{-- Amount --}}
              </td>
            </tr>
          </thead>
          <tbody>
            @php $total = 0; $count = 0; @endphp
            {{-- {{dd($payments)}} --}}
            @foreach($payments as $fees)
              @if($fees->cat_id != 'PMT' || $fees->cat_id == 'HPL')
               @php $count+=1; @endphp
              <tr class="">
                <td class="w-25">
                  {{(isset($fees->m04Desc) ? $fees->m04Desc : $fees->reference)}}
                </td>
                <td class="pt-4 pl-4">
                  {{isset($fees->m04ID) ? $fees->m04ID : '-'}}
                </td>
                <td class="text-left pt-4 pl-4">
                     {{$fees->amount}}
                      @php 
                        $total += $fees->amount;
                      @endphp
                </td>
              </tr>
              @endif
            @endforeach
            @if($count < 7)
              @for($i = $count; $i < 7; $i++)
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              @endfor
            @endif
            <tr>
              <td></td>
              <td></td>
              <td class="text-left pt-3">{{$total}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="container text-left" style="margin-left: 130px; padding-top:2px;">
        <span class="">{{ucwords(FunctionsClientController::moneyToString($total))}} Pesos</span>
      </div>
      <table class="table table-borderless">
        <thead>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <div class="container">
        
      </div>
      <table class="table table-borderless" style="margin-top: 110px; margin-left: 25px">
        <thead>
          <tr>
            <td class="text-center">
              {{$cUser['fullname']}}
            </td>
          </tr>
        </thead>
      </table>
      <div class="container">
        <div class="row">
          <div class="col-12">
            {{-- Received the amount stated above. --}}
          </div>
        </div>
        <div class="offset-10" class="text-right">
         <span class=""></span>
        </div>
        {{-- <div class="offset-10" style="font-size: 15px;">
          Collecting Office
        </div> --}}
      </div>
      {{-- <div class="container-fluid border-top p-4">
        NOTE: Write the number and date of this receipt on the back of check or money order received.
      </div> --}}  
  	</div>
  </div>

    <div class="container float-right">
    <button onclick="window.history.back();" class="btn btn-success text-white"><i class="fa fa-arrow-left" aria-hidden="true"> </i> Go Back</button>
    </div>

  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
