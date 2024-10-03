<script src="{{asset('admin1/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin1/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin1/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin1/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('admin1/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin1/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin1/js/demo/chart-pie-demo.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('admin1/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin1/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin1/js/demo/datatables-demo.js')}}"></script>

    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('vendors/cropper/cropper.js')}}"></script>

<script>
@if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':

            toastr.options.timeOut = 10000;
            toastr.info("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();
            break;
        case 'success':

            toastr.options.timeOut = 10000;
            toastr.success("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
        case 'warning':

            toastr.options.timeOut = 10000;
            toastr.warning("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
        case 'error':

            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");
            var audio = new Audio('audio.mp3');
            audio.play();

            break;
    }
@endif
</script>
<!-- <script>
$(document).ready(function() {
  $('#sidebarSearchInput').on('keyup', function() {
    var searchText = $(this).val().toLowerCase(); // Get input value and convert to lowercase
    $('.nav-item').each(function() { // Loop through each nav item
      var currentItemText = $(this).text().toLowerCase(); // Get nav item text and convert to lowercase
      if(currentItemText.includes(searchText)) {
        $(this).show(); // Show the nav item if the search text matches
      } else {
        $(this).hide(); // Hide the nav item if the search text does not match
      }
    });
  });
});
</script> -->


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
  $(document).ready(function() {
    $('#sidebarSearchInput').on('keyup', function() {
      var searchText = $(this).val().toLowerCase(); // Get input value and convert to lowercase
      
      $('.nav-item').each(function() { // Loop through each nav item
        var currentItem = $(this);
        var found = false;

        // Check the main link text (parent) against search text
        var mainLinkText = currentItem.find('.nav-link span').text().toLowerCase();
        if (mainLinkText.includes(searchText)) {
          found = true;
        }

        // Check all child links (collapse items) against search text
        currentItem.find('.collapse-item').each(function() {
          var childLinkText = $(this).text().toLowerCase();
          if (childLinkText.includes(searchText)) {
            found = true;
            currentItem.find('.collapse').collapse('show'); // Expand the collapse if child item matches
          }
        });

        if (found) {
          currentItem.show(); // Show the nav item if the search text matches
          currentItem.parents('.collapse').collapse('show'); // Expand all parent collapses
        } else {
          currentItem.hide(); // Hide the nav item if the search text does not match
        }
      });
    });
  });
</script>
