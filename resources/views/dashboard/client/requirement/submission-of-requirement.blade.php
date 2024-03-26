@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
    @include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
    @include('dashboard.client.templates.step-requirement')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style type="text/css">
        #style-15::-webkit-scrollbar-track
        {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
        background-color: #F5F5F5;
        border-radius: 10px;
        }

        #style-15::-webkit-scrollbar
        {
        width: 10px;
        background-color: #F5F5F5;
        }

        #style-15::-webkit-scrollbar-thumb
        {
        border-radius: 10px;
        background-color: #FFF;
        background-image: -webkit-gradient(linear,
                            40% 0%,
                            75% 84%,
                            from(#4D9C41),
                            to(#19911D),
                            color-stop(.6,#54DE5D))
        }
	</style>
    <div class="container-fluid mb-5">
        <div class="row">
            @include('dashboard.client.requirement.requirement-form')
        </div>
    </div>

    <!-- Modals -->
        @include('dashboard.client.modal.confirm-submit')
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
    @include('client1.cmp.footer')
</body>
@endsection