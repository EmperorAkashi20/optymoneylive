
            <div class="row">
            <!--   <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Region chart</h4>
                    <div class="google-chart-container">
                      <div id="line-chart" class="google-charts"></div>
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocation by Type</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div" class="google-charts mt-n5"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocation by Top Sector(MF)</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div2" class="google-charts"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocation by Type [Ex: For Loggedin User]</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div3" class="google-charts"></div>
                    </div>
                  </div>
                </div>
              </div> -->
 
       

            
            <!-- <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Region chart</h4>
                    <div class="google-chart-container">
                      <div id="line-chart1" class="google-charts"></div>
                    </div>
                  </div>
                </div>
              </div> -->

              <!-- <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Bar chart</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div1" class="google-charts mt-n5"></div>
                    </div>
                  </div>
                </div>
              </div> -->
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocation by Type</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div3" class="google-charts"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocation by Type</h4>
                    <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                      <div id="chart_div4" class="google-charts"></div>
                    </div>
                  </div>
                </div>
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);
          //google.charts.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
           var data = new google.visualization.DataTable();
        data.addColumn('string', 'scheme_type');
        data.addColumn('number', 'amount  ');
        for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'scheme_type');
        data2.addColumn('number', 'amount  ');
        for(i = 0; i < my_2d.length; i++)
    data2.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);

            var data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'scheme_type');
        data3.addColumn('number', 'amount  ');
        for(i = 0; i < my_2d.length; i++)
    data3.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);

            // Set chart options
            var options = { 
                         is3D: true};
            // // Set chart options
             var options2 = { 
                         is3D: true};
            // // Set chart options
             var options3 = { 
                            
                           pieHole: 0.4,
          };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data,options);
            var chart2 = new google.visualization.BarChart(document.getElementById('chart_div2'));
            chart2.draw(data2,options2);
            var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));
            chart3.draw(data3,options3);

          }
        </script>
            <?php
require 'config.php';
if ($stmt = $connection->query("SELECT DISTINCT scheme_type AS Type,SUM(amount)FROM mf_live_table Where pan_no='AHNPG5052C' GROUP BY scheme_type DESC")) {
    while ($row = $stmt->fetch_row()) {
        $dbdata[] = $row;
    }
} else {
    echo $connection->error;
}
echo '<script>
        var my_2d = '.json_encode($dbdata).'
</script>';
?>
          
          