footer class="bg-info text-white text-center pt-3 pb-3">&copy; Copyrights {{ Carbon\Carbon::now()->year }} {{ config('app.name') }}</footer>

<script src="{{ asset('/user_styles/js/jquery.min.js') }}"></script>
<script src="{{ asset('/user_styles/js/popper.min.js') }}"></script>
<script src="{{ asset('/user_styles/js/bootstrap.min.js') }}"></script>

  <script>
    $(".full-height").css({
      "min-height": $(window).height() - $("footer").innerHeight() - $("nav").innerHeight()
    });
    $(window).on('resize', function() {
      $(".full-height").css({
        "min-height": $(window).height() - $("footer").innerHeight() - $("nav").innerHeight()
      });
    });
  </script>

  @yield('js')

@yield('footer')