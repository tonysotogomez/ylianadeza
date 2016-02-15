

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="http://softgroup-peru.com/">SoftGroup Perú</a>.</strong> Todos los derechos reservados.
      </footer>

      <!-- Control Sidebar
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes
        <div class="tab-content">
          <!-- Home tab content
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul> /.control-sidebar-menu

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul> /.control-sidebar-menu

          </div>< /.tab-pane -->
          <!-- Stats tab content
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
           Settings tab content
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div> /.form-group
            </form>
          </div> /.tab-pane
        </div>
      </aside> /.control-sidebar
      dd the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $url;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $url;?>bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $url;?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $url;?>plugins/datatables/dataTables.bootstrap.min.js"></script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
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
    <script src="<?php echo $url;?>dist/js/app.min.js"></script>txt_fecha
    <?php if(isset($js_home)){
      echo $js_home;
    } ?>
    <!-- InputMask -->
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo $url;?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
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

      });
    </script>
  </body>
</html>
