

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
    <script src="<?php echo $url;?>dist/js/app.min.js"></script>
    <?php if(isset($js_home)){
      //echo $js_home;
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
        <!--<script>
          $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas);

            var areaChartData = {
              labels: ["45", "50", "55", "60", "65", "70", "75", "80", "85", "90", "95", "100", "105", "110"],
              datasets: [
                {
                  label: "3D",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [3.275,4.467,6.073,7.847,9.454,10.880,12.168,13.389,14.869,16.533,18.215,20.028,22.166,24.708]
                },
                {
                  label: "2D",
                  fillColor: "rgba(210, 214, 222, 1)",
                  strokeColor: "rgba(210, 214, 222, 1)",
                  pointColor: "rgba(210, 214, 222, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [2.967,4.045,5.496,7.099,8.555,9.851,11.026,12.142,13.491,14.999,16.513,18.135,20.034,22.283]
                },
                {
                  label: "1D",
                  fillColor: "rgba(255,140,0, 1)",
                  strokeColor: "rgba(255,140,0, 1)",
                  pointColor: "rgba(255,140,0, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [2.698,3.676,4.992,6.447,7.770,8.952,10.027,11.050,12.283,13.655,15.024,16.480,18.175,20.174]
                },
                {
                  label: "Mediana",
                  fillColor: "rgba(152,251,152, 1)",
                  strokeColor: "rgba(152,251,152, 1)",
                  pointColor: "rgba(152,251,152, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [2.461,3.352,4.550,5.874,7.081,8.163,9.149,10.089,11.220,12.472,13.715,15.027,16.547,18.332]
                },
                {
                  label: "-1D",
                  fillColor: "rgba(255,140,0, 1)",
                  strokeColor: "rgba(255,140,0, 1)",
                  pointColor: "rgba(255,140,0, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [2.252,3.066,4.160,5.370,6.474,7.467,8.374,9.240,10.280,11.427,12.558,13.745,15.114,16.715]
                },
                {
                  label: "-2D",
                  fillColor: "rgba(210, 214, 222, 1)",
                  strokeColor: "rgba(210, 214, 222, 1)",
                  pointColor: "rgba(210, 214, 222, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [2.066,2.813,3.815,4.923, 5.937,6.850,7.687,8.487,9.445,10.498,11.532,12.610,13.847,15.289]
                },
                {
                  label: "-3D",
                  fillColor: "rgba(60,141,188,0.9)",
                  strokeColor: "rgba(60,141,188,0.8)",
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(60,141,188,1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(60,141,188,1)",
                  data: [1.902, 2.588, 3.508, 4.527, 5.459, 6.302, 7.075,7.816,8.702,9.671,10.618,11.600,12.722,14.025]
                }
              ]
            };

            var areaChartOptions = {
              //Boolean - If we should show the scale at all
              showScale: true,
              //Boolean - Whether grid lines are shown across the chart
              scaleShowGridLines: true,
              //String - Colour of the grid lines
              scaleGridLineColor: "rgba(0,0,0,.08)",
              //Number - Width of the grid lines
              scaleGridLineWidth: 1,
              //Boolean - Whether to show horizontal lines (except X axis)
              scaleShowHorizontalLines: true,
              //Boolean - Whether to show vertical lines (except Y axis)
              scaleShowVerticalLines: true,
              //Boolean - Whether the line is curved between points
              bezierCurve: true,
              //Number - Tension of the bezier curve between points
              bezierCurveTension: 0.3,
              //Boolean - Whether to show a dot for each point
              pointDot: false,
              //Number - Radius of each point dot in pixels
              pointDotRadius: 4,
              //Number - Pixel width of point dot stroke
              pointDotStrokeWidth: 1,
              //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
              pointHitDetectionRadius: 24,
              //Boolean - Whether to show a stroke for datasets
              datasetStroke: true,
              //Number - Pixel width of dataset stroke
              datasetStrokeWidth: 2,
              //Boolean - Whether to fill the dataset with a color
              datasetFill: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
              //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true
            };

            //Create the line chart
            areaChart.Line(areaChartData, areaChartOptions);

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas);
            var lineChartOptions = areaChartOptions;
            lineChartOptions.datasetFill = false;
            lineChart.Line(areaChartData, lineChartOptions);




          });
        </script> -->
  </body>
</html>
