
<footer class="footer-content hidden-xs">
  <span id="copyright-year"></span> © 2018 {{ config('app.name') }}.
  @if(Session::has('twitterInfo'))
  <footer-action></footer-action>
  @endif
</footer>