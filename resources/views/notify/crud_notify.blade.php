
<div class="col-sm-12">
	@if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable ">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	       <b>{!! Session::get('success')!!}</b> 
	    </div>

	@elseif(Session::has('error'))
	    <div class="alert alert-danger alert-dismissable ">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	       <b>{!! Session::get('error')!!}</b> 
	    </div>
		
	@endif
</div>