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
        data.addColumn('string', 'X')
        data.addColumn('number', 'Covid Cases');
        data.addColumn('number', 'Covid Deaths');

        data.addRows([

            <?php foreach ($data['monthly_result'] as $monthly_res) {
                $date = explode('-', $monthly_res['date'])[2];
                echo "['" . $monthly_res['date'] . "'," . $monthly_res['addmit'] . "," . $monthly_res['death'] . "],";
            }
            ?>

        ]);
        const d = new Date();
        var year = d.getFullYear();
        var month = d.toLocaleString('default', {
            month: 'long'
        });

        var options = {

            title: "Daily Covid Results - Past 30 Days",

            titleTextStyle: {
                bold: true,
                color: "black",

                fontSize: 14,

            },

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

            pointSize: 5,

            hAxis: {
                title: 'Date',
            },
            vAxis: {
                title: '',
                viewWindow: {
                    min: 0
                },
                format: '0'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    // This is the function to draw pie chart
    google.charts.setOnLoadCallback(drawPieChart);


    function drawPieChart() {



        var data = google.visualization.arrayToDataTable([
            ['Case Name', 'Count'],
            ['Recovered', <?php echo $data['total']['recover'] ?>],
            ['Active Cases', <?php echo $data['total']['new'] ?>],
            ['Deaths', <?php echo $data['total']['death'] ?>]
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

            titleTextStyle: {
                bold: true,
                color: "black",

                fontSize: 14,

            },

            slices: {
                1: {
                    color: "#0d6efd"
                },
                0: {
                    color: "#20c997"
                },
                2: {
                    color: "#dc3545"
                }
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }


    // This is the code to draw the column chart
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawColChart);

    function drawColChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'PCR positive', 'Antigen Positive'],

            <?php foreach ($data['monthly_result'] as $monthly_res) {
                echo "['" . $monthly_res['date'] . "'," . $monthly_res['pcr'] . "," . $monthly_res['antigen'] . "],";
            }
            ?>
        ]);

        var options = {

            title: 'Daily PCR/Antigen Test positive',

            titleTextStyle: {
                bold: true,
                color: "black",

                fontSize: 14,

            },


            backgroundColor: {
                fill: 'transparent'
            },

            height: 500,
            chartArea: {
                backgroundColor: 'transparent'
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>

</head>

<body>

    <div class='sub-division'>
        <!-- echo date_default_timezone_get;  -->

        <main class="sub-division-main">
            <header class="home-header">
                <div class="home-header-title">
                    <img src="<?php echo URL_ROOT; ?>/public/images/SquadOption-logo.png" class="squadoption-logo">

                    <h1 class="text-primary home-title">CoviDet</h1>
                    <h4 class="home-subtitle">Covid Details Handeling System</h4>
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

            <?php
            $today = $data['monthly_result'][sizeof($data['monthly_result']) - 1];
            //var_dump($today);

            ?>
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
                                Today : <?php echo $today['date']; ?>
                            </span>

                        </header>

                        <!-- Code for new covid cases stat -->
                        <div class="home-cases-stat row">

                            <div class="col-4">
                                <img src="<?php echo URL_ROOT; ?>/public/images/new-cases.gif" class="home-stat-icon" alt="new cases">

                            </div>

                            <div class="col">
                                <span class="home-stat-labal">New Cases <br>
                                    <h3 class="text-primary"><?php echo $today['addmit']; ?></h3>
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
                                    <h3 class="text-danger"><?php echo $today['death']; ?></h3>
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
                                    <h3 class="text-success"><?php echo $today['discharge']; ?></h3>
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
                                    <h3 class="text-primary"><?php echo $data['total']['new']; ?></h3>
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
                                    <h3 class="text-danger"><?php echo $data['total']['death']; ?></h3>
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
                                    <h3 class="text-success"><?php echo $data['total']['recover']; ?></h3>
                                </span>

                            </div>
                        </div>


                    </div>

                </div>

                <!-- Row - 3 Draw column chart -->

                <div class="row home-daily-chart">
                    <div id="columnchart_material" class="home-graph col"></div>

                </div>



            </section>


        </main>





    </div>
    </div>


    <script src="<?= URL_ROOT ?>./public/script/admin.js"></script>

    <?php require_once APP_ROOT . "/views/includes/footer.php" ?>