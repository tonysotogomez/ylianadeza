

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.5
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a target="_blank" href="http://softgroup-peru.com/">SoftGroup Perú</a>.</strong> Todos los derechos reservados.
      </footer>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $url;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
    <!--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
    <script src="<?php echo $url;?>dist/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $url;?>bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $url;?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $url;?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $url;?>plugins/datatables/dataTables.responsive.min.js"></script>


    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $url;?>plugins/chartjs/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $url;?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $url;?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $url;?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $url;?>plugins/knob/jquery.knob.js"></script>
		<!-- daterangepicker -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>-->
    <script src="<?php echo $url;?>dist/js/moment.min.js"></script>
    <script src="<?php echo $url;?>plugins/daterangepicker/daterangepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $url;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- datepicker -->
		<script src="<?php echo $url;?>plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Slimscroll -->
    <script src="<?php echo $url;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
    <script src="<?php echo $url;?>plugins/fastclick/fastclick.min.js"></script>
		<!-- AdminLTE App -->
    <script src="<?php echo $url;?>dist/js/app.min.js"></script>
    <?php if(isset($js_home)){
      echo $js_home;
    } ?>
    <!-- InputMask -->
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- Highcharts -->
    <script src="<?php echo $url;?>plugins/highcharts/highcharts.js"></script>
    <script src="<?php echo $url;?>plugins/highcharts/exporting.js"></script>
    <!-- Custom -->
    <script src="<?php echo $url;?>dist/js/custom.js"></script>

    <?php if(isset($js_custom)){
      echo $js_custom;
    } ?>

    <!--<script src="<?php echo $url;?>dist/js/examen/examen.js"></script>
    <script src="<?php echo $url;?>dist/js/alumno.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $url;?>dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#txt_fecha").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        if($('#pie_container').length > 0){
          $('#pie_container').highcharts().reflow();
          $('#bar_container').highcharts().reflow();
        }

      });
    </script>
  </body>
</html>
