@extends('mainEmployee')
@section('title', 'Assessment')
@section('content')

<div class="container-fluid">
	<div class="row bg-info pt-5 d-flex align-content-center text-center justify-content-center">
		<div class="col border">
			qwe
		</div>
	</div>
</div>
<div class="divs">
    <div class="cls1">

    </div>
</div>
{{-- 	<nav aria-label="Page navigation example">
	  <ul class="pagination">
	    <li id="prev" class="page-item"><a class="page-link" href="#">Previous</a></li>
	    <li id="next" class="page-item"><a class="page-link" href="#">Next</a></li>
	  </ul>
	</nav> --}}



<script type="text/javascript">
	$(function(){
	    $(".divs div").each(function(e) {
	        if (e != 0)
	            $(this).hide();
	    });

	    $("#next").click(function(){
	    	let accept = true;
	    	if($(".divs div:visible").find("input[type=checkbox]").length > 0){
	    		if($("input[type=checkbox]:checked").not(':hidden').length == 0){
	    			if($(".divs div:visible").find("textarea:eq(0)").length > 0 && $.trim($(".divs div:visible").find("textarea:eq(0)").val()) == ""){
	    				$(".divs div:visible").find("textarea:eq(0)").css({
	    					'border': 'solid 1px red'
	    				});
	    				accept = false;
	    			} else {
	    				accept = true;
	    			}
	    		}
	    	}
	        if ($(".divs div:visible").next().length != 0 && accept == true){
	        	// console.log(($(".divs div:visible").next().length-1));
	           	$(".divs div:visible").next().show().prev().hide();
	        }
	        else if(accept == true) {
	        	$(this).replaceWith('<button id="submit" type="submit" name="submt" class="btn btn-primary btn-sm">Submit</button>');
	        }
	        return false;
	    });

	    $("#prev").click(function(){
	        if ($(".divs div:visible").prev().length != 0)
	            $(".divs div:visible").prev().show().next().hide();
	        else {
	        	console.log('yey');
	            $(".divs div:visible").hide();
	            $(".divs div:last").show();
	        }
	        return false;
	    });
});

</script>
@endsection