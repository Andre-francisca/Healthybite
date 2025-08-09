
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="#">HealthyBiteGH</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="././js/jquery.js"></script>
<!-- Bootstrap 4 -->
<script src="././js/gridjs.js"></script>
<script src="././js/popper.js"></script>

<script src="././js/fusiontheme.js" type="text/javascript"></script>
<script src="././js/jquery.dataTables.js" type="text/javascript"></script>
<script src="././js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

<script>
      function isNumberKey(txt, evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
</script>

<!-- AdminLTE App -->
<script src="././js/adminlte.min.js"></script>
<script src="../js/bootstrap-fileupload.js"></script>
<script src="././js/crs.min.js" ></script>
<script src="././js/app.js" ></script>
</body>
</html>
