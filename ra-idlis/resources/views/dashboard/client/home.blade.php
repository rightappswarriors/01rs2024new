@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
    @include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
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
    <div class="container mb-5"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    
    @include('client1.cmp.footer')
</body>
@endsection