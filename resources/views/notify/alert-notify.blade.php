
@if(Session::has('success') || Session::has('error'))
<div id="gritter-notice-wrapper">
  <div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class alert alert-dismissable no_padding" role="alert">
    <div class="gritter-top"></div>
    @if(Session::has('success'))
    <div class="gritter-item">
      <button type="button" class="gritter-close close" data-dismiss="alert" aria-hidden="true">×</button>
      <img src="{{asset('public/img/success.png')}}" class="gritter-image">
      <div class="gritter-with-image">
        <span class="gritter-title">Success</span>
        <p><b>{!! Session::get('success')!!}</b> </p>
      </div>
      <div style="clear:both"></div>
    </div>
    @elseif(Session::has('error'))
    <div class="gritter-item">
      <button type="button" class="gritter-close close" data-dismiss="alert" aria-hidden="true">×</button>
      <img src="{{asset('public/img/error.png')}}" class="gritter-image">
      <div class="gritter-with-image">
        <span class="gritter-title">Something wrong</span>
        <p><b>{!! Session::get('error')!!}</b> </p>
      </div>
      <div style="clear:both"></div>
    </div>
    @endif
    <div class="gritter-bottom"></div>
  </div>
</div>
@endif