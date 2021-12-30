<?php require_once APP_ROOT . "/views/pages/admin_dashboard.php" ?>

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
            [1, 12, 1],
            [2, 10, 2],
            [3, 14, 5],
            [4, 13, 6],
            [5, 20, 11],
            [6, 25, 10],
            [7, 30, 12],
            [8, 29, 15],
            [9, 37, 20],
            [10, 72, 31],

        ]);

        var options = {
            'title': "Daily Covid results (Year/Month)",
            'width': 800,
            'height': 500,
            backgroundColor: {fill:'transparent'},

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

            <section calss="daily-chart">
                <div id="chart_div" class="home-graph"></div>
            </section>


        </main>





    </div>
    </div>


    <script src="<?= URL_ROOT ?>./public/script/admin.js"></script>

    <?php require_once APP_ROOT . "/views/includes/footer.php" ?>