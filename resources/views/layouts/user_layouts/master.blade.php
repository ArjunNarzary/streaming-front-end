
<!--HEARDER SECTION-->
@include('layouts.user_layouts.inc.header')

<!--CONTENT WRAPPER-->
<!-- Page Wrapper -->
<div id="wrapper">

<!--SIDE NAV-->
@include('layouts.user_layouts.inc.side-nav')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!--TOP NAV BAR-->
            @include('layouts.user_layouts.inc.top-nav')

            <!-- Begin Page Content -->
            <div class="container-fluid">



                <!--MAIN CONTENT HERE-->
                @yield('content')
                <!--MAIN CONTENT END HERE-->



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!--FOOTER-->
        @include('layouts.user_layouts.inc.footer')

    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('getThrills/vendor/jquery/jquery.min.js') }}"></script>

  <script>
    // Toggled Navbar on small
    (function($) {
      var $window = $(window),
          $top = $('#page_top');
          $sidebar = $('#accordionSidebar');

      function resize() {
          if ($window.width() < 514) {
              return [ $top.addClass('sidebar-toggled'), $sidebar.addClass('toggled') ];
          }

          $top.removeClass('sidebar-toggled');
          $sidebar.removeClass('toggled');
      }

      $window
          .resize(resize)
          .trigger('resize');
  })(jQuery);

    $(document).ready(function(){
        $( document ).ajaxSend(function(elm, xhr, s){
         var csrf = $('meta[name="csrf_token"]').attr('content');
        if (s.type == "POST") {
            xhr.setRequestHeader('x-csrf-token', csrf);
        }
    });

    });
</script>

  <script src="{{ asset('getThrills/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('getThrills/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- slick Slider JS-->
  <script type="text/javascript" src="{{ asset('getThrills/vendor/slick/slick.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('getThrills/js/osahan.min.js') }}"></script>
  <!--Custome JS-->
  <script src="{{ asset('getThrills/js/custom.js') }}"></script>
  <!--Video JS-->
  <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.1.0/remodal.min.js"></script>
  <!--Custom js-->
  @yield('JS')
</html>
