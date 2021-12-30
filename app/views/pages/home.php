<?php
if ($_SESSION['is_admin']) {
    require_once APP_ROOT . "/views/pages/admin_dashboard.php";
} else {
    require_once APP_ROOT . "/views/pages/user_dashboard.php";
}

?>

<!-- This is the code of the line chart -->
<script type="text/javascript">
    google.charts.load('current', {
        packages: ['corechart', 'line']
    });
    google.charts.setOnLoadCallback(drawCurveTypes);

    function drawCurveTypes() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'X')
        data.addColumn('number', 'Covid Cases');
        data.addColumn('number', 'Covid Deaths');

        data.addRows([


            <?php $count = 1; ?>
            <?php foreach ($data['monthly_result'] as $monthly_res) {
                $date = explode('-', $monthly_res['date'])[2];
                echo "[" . $date . "," . $monthly_res['addmit'] . "," . $monthly_res['death'] . "],";

                $count++;
            }
            ?>

        ]);
        const d = new Date();
        var year = d.getFullYear();
        var month = d.toLocaleString('default', {
            month: 'long'
        });

        var options = {

            'title': "Daily Covid Results (" + year + "/" + month + ")",
            'width': 700,
            'height': 500,

            'chartArea': {
                'width': '75%',
                'height': '70%'
            },
            'legend': {
                'position': 'bottom'
            },
            backgroundColor: {
                fill: 'transparent'
            },

            hAxis: {
                title: 'Day',
                format: '0',

                viewWindow: {
                    min: 1,
                    max: 31
                }
            },
            vAxis: {
                title: '',
                viewWindow: {
                    min: 0
                },
                format: '0'
            },
            series: {
                1: {
                    curveType: 'function'
                }
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    // This is the function to draw pie chart
    google.charts.setOnLoadCallback(drawChart);

    
    function drawChart() {

        

        var data = google.visualization.arrayToDataTable([
            ['Case Name', 'Count'],
            ['Recovered', 20],
            ['Active Cases', 11],
            ['Deaths', 2]
        ]);

        var options = {
            'width': 700,
            'height': 500,

            'chartArea': {
                'width': '75%',
                'height': '70%'
            },
            'legend': {
                'position': 'bottom'
            },
            backgroundColor: {
                fill: 'transparent'
            },

            title: 'Total Covid Results',
            slices: {1: {color: "#0d6efd"}, 0: {color: "#20c997"}, 2: {color: "#dc3545"}}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }


    // This is the code to draw the column chart
    google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var button = document.getElementById('change-chart');
        var chartDiv = document.getElementById('col_chart');

        var data = google.visualization.arrayToDataTable([
          ['Galaxy', 'Distance', 'Brightness'],
          ['Canis Major Dwarf', 8000, 23.3],
          ['Sagittarius Dwarf', 24000, 4.5],
          ['Ursa Major II Dwarf', 30000, 14.3],
          ['Lg. Magellanic Cloud', 50000, 0.9],
          ['Bootes I', 60000, 13.1]
        ]);

        var materialOptions = {
          width: 900,
          chart: {
            title: 'Nearby galaxies',
            subtitle: 'distance on the left, brightness on the right'
          },
          series: {
            0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
            1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
          },
          axes: {
            y: {
              distance: {label: 'parsecs'}, // Left y-axis.
              brightness: {side: 'right', label: 'apparent magnitude'} // Right y-axis.
            }
          }
        };

        var classicOptions = {
          width: 900,
          series: {
            0: {targetAxisIndex: 0},
            1: {targetAxisIndex: 1}
          },
          title: 'Nearby galaxies - distance on the left, brightness on the right',
          vAxes: {
            // Adds titles to each axis.
            0: {title: 'parsecs'},
            1: {title: 'apparent magnitude'}
          }
        };

        function drawMaterialChart() {
          var materialChart = new google.charts.Bar(chartDiv);
          materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
          button.innerText = 'Change to Classic';
          button.onclick = drawClassicChart;
        }

        function drawClassicChart() {
          var classicChart = new google.visualization.ColumnChart(chartDiv);
          classicChart.draw(data, classicOptions);
          button.innerText = 'Change to Material';
          button.onclick = drawMaterialChart;
        }

        drawMaterialChart();
    };
</script>

</head>

<body>

    <div class='sub-division'>

        <main class="sub-division-main">
            <header class="home-header">
                <div class="home-header-title">
                    <img src="<?php echo URL_ROOT; ?>/public/images/SquadOption-logo.png" class="squadoption-logo">

                    <h1 class="text-primary home-title">CoviDet</h1>
                    <h4 class="home-subtitle">Hospital Data Management System</h4>
                </div>
                <div id="carouselExampleDark" class="carousel carousel-dark slide home-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo URL_ROOT; ?>/public/images/washing-hands.gif" class="d-block w-100 home-carousel-img" alt="hand wash">
                        </div>
                        <div class="carousel-item carousel-item-centered">
                            <div class="d-flex justify-content-center">
                                <img src="<?php echo URL_ROOT; ?>/public/images/hand-sanitizer.gif" class="d-block home-carousel-img" alt="sanitizer" style="width: 60%;">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo URL_ROOT; ?>/public/images/use-mask.gif" class="d-block w-100 home-carousel-img" alt="use mask">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo URL_ROOT; ?>/public/images/get-vaccinated.gif" class="d-block w-100 home-carousel-img" alt="get vaccinated">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </header>

            <section calss="containter">

                <!-- Row - 1 Daily update and daily stats -->
                <div class="row home-daily-chart">
                    <div id="chart_div" class="home-graph col"></div>

                    <!-- Last 24 hours update -->
                    <div class="col-3 home-status">

                        <header class="row home-stat-header">
                            <span class="home-stat-title">
                                COVID STATICTICS
                            </span>
                            <span class="home-stat-subtitle">
                                Last 24 hours
                            </span>

                        </header>

                        <!-- Code for new covid cases stat -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/new-cases.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">New Cases <br>
                                    <h3 class="text-primary">400</h3>
                                </span>

                            </div>
                        </div>

                        <!-- Code for new covid deaths stats -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/new-deaths.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">Deaths <br>
                                    <h3 class="text-danger">69</h3>
                                </span>

                            </div>
                        </div>

                        <!-- Code for new covid recoveries stats -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/recovered.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">Recovered <br>
                                    <h3 class="text-success">96</h3>
                                </span>

                            </div>
                        </div>


                    </div>

                </div>

                <!-- Row - 2 Pie chart and total stats -->

                <div class="row home-daily-chart">
                    <div id="piechart" class="home-graph col"></div>

                    <!-- Last 24 hours update -->
                    <div class="col-3 home-status">

                        <header class="row home-stat-header">
                            <span class="home-stat-title">
                                COVID STATICTICS
                            </span>
                            <span class="home-stat-subtitle">
                                Overall - Sri Lanka
                            </span>

                        </header>

                        <!-- Code for new covid cases stat -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/new-cases.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">Total Cases <br>
                                    <h3 class="text-primary">400</h3>
                                </span>

                            </div>
                        </div>

                        <!-- Code for new covid deaths stats -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/new-deaths.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">Deaths<br>
                                    <h3 class="text-danger">69</h3>
                                </span>

                            </div>
                        </div>

                        <!-- Code for new covid recoveries stats -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/recovered.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">Recovered <br>
                                    <h3 class="text-success">96</h3>
                                </span>

                            </div>
                        </div>


                    </div>

                </div>

                <!-- Row - 3 Draw column chart -->

                <div class="row home-daily-chart">
                    <div id="col_chart" class="home-graph col"></div>

                </div>



            </section>


        </main>





    </div>
    </div>


    <script src="<?= URL_ROOT ?>./public/script/admin.js"></script>

    <?php require_once APP_ROOT . "/views/includes/footer.php" ?>