@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
    @include('client1.cmp.nav')
    @include('client1.cmp.breadcrumb')
    @include('client1.cmp.msg')
    @include('dashboard.client.templates.step')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style type="text/css">
        #style-15::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }
        #style-15::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }
        #style-15::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-gradient(linear, 40% 0%, 75% 84%, from(#4D9C41), to(#19911D), color-stop(.6, #54DE5D))
        }
    </style>

    @include('dashboard.client.forms.loadertyle')
    <div id="loader"></div>
    <div  style="display:none;" id="myDivLo">
        
        @if(isset($fAddress)&&(count($fAddress) > 0))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb d-flex justify-content-center">
                    <li class="breadcrumb-item active text-primary"><a href="{{asset($addresses[0])}}">Application Details</a></li>
                    <li class="breadcrumb-item active text-primary"><a href="{{asset('client1/apply/assessmentReady/')}}/{{$fAddress[0]->appid}}/">Self Assessment</a></li>
                    <li class="breadcrumb-item active"><a href="{{asset($addresses[1])}}">DOH Requirements</a></li>
                    <li class="breadcrumb-item active"><a href="{{asset($addresses[2])}}">FDA Requirements</a></li>
                    <li class="breadcrumb-item active">Submit Requirements</li>
                </ol>
            </nav>
        @endif
            
    
        <div class="container-fluid mt-5 mb-5">
            <div class="row">
                <div class="col-md-8">
                @include('dashboard.client.forms.parts.printbutton')
                    <h2 class=" text-center pt-2"> <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width:50px;"/> APPLICATION FORM</h2>
                </div>
                <div class="col-md-4"></div>
                {{-- @include('dashboard.client.forms.parts.main-form')  --}}
            </div>

            <!----------------->
            

            <div class="row">         

                <div class="col-md-8">
                    <section class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <p class="lead text-center text-danger">Please note: Red asterisk (*) is a required field and may be encountered throughout the system </p>
                            </div>

                            <div class="card-body" style="border: thin solid #f5f5f5; background-color: #f5f5f5;">
                                <div class="row">                                     
                                    @include('dashboard.client.forms.parts-update.main-form')
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- end of initial change form -->
                <div class="col-md-4">
                    @include('dashboard.client.forms.parts.payment.payment-form-change')
                </div>
                @if (session()->exists('employee_login'))
                    
                        <div class="col-md-8 text-center pt-5">

                            <div class="row">
                                <div class="col-md-3"> </div>
                                <div class="col-md-6 text-center">
                                    <div class="form-group">
                                        <a class="btn btn-secondary action-btn btn-block"  href="{{asset('client1/apply')}}">
                                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Application Dashboard
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3"> </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                        
                        </div>
                @else

                    <!---  Main Form Submit -->
                    @if($savingStat =='final')
                        
                        <div class="col-md-8">
                                    <div class="col-md-6 text-center">
                                        <div class="form-group">
                                <a class="btn btn-secondary action-btn btn-block"  href="{{asset('client1/apply')}}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Application Dashboard
                                </a>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        
                        </div>

                    @elseif(($functype == 'main' || $functype == '') && $savingStat !='final' )
                    
                        @isset($appid)
                            @if($appid > 0)
                            <div class="col-md-8">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary action-btn"  style="margin:auto; margin-top:10px;" value="submit" name="submit" id="submit" data-toggle="modal" data-target="#confirmSubmitModalLto">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Proceed to Requirements
                                            </button>                                            
                                        </div> 
                                    </div>                                    
                                </div>

                                @include('dashboard.client.forms.parts-update.modal-submission-confirmation')
                            @endif
                        @endisset
                    
                    @else
                        
                        <div class="col-md-8">
                            <div class="text-center" style="margin:auto; margin-top:10px;">
                                <a class="btn btn-secondary action-btn btn-block"  href="{{asset('client1/apply')}}">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Application Dashboard
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                        
                        </div>

                    @endif
                    <!---  Main Form  -->

                @endif

            </div>




            <!----------------->


        </div>
        <!-- Modals -->
        
        @include('dashboard.client.modal.confirm-submit')
        @include('dashboard.client.forms.parts.defVals')

    </div>
    @include('dashboard.client.forms.loaderscript')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        const base_url = '{{URL::to('/')}}';
    </script>
    <script src="{{asset('ra-idlis/public/js/clients/application-form.js')}}"></script>
    @php $allowed_edit = true; @endphp
    
    @if($allowed_edit)
        @include('client1.cmp.footer')
        @include('dashboard.client.forms.parts-update.js-submission')        
    @endif
    @include('dashboard.client.forms.generalFormScript')
</body>
@endsection