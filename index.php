<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gerador de QRcode</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="css/datepicker3.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="js/jqueryconfirm/jquery-confirm.min.css">
        <link rel="stylesheet" href="js/jquery-loading/loading.css">

        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>Tron</span> Ensino de Robótica Educativa</a>

            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <img style="margin:10px auto" src="img/tron-robotica-educativa.png" class="img-responsive" alt="">

        <ul class="nav menu">
            <li id="menu-dashboard" class="active"><a href="#">Gerar Qr codes</a></li>
            <li id="menu-manager" ><a href="#">Demandas</a></li>
            <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                    <em class="fa fa-navicon">&nbsp;</em> Configurações <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-angle-down"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li>
                        <a id="componentes" class="" href="#">
                            <span class="fa fa-arrow-right">&nbsp;</span> Componentes
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div><!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Board</h1>
            </div>
        </div><!--/.row-->
        <!--carregar conteudi aqui-->
        <div class="content">
            <form class="form col-md-12" id="form-qr" action="" method="get">
                <div><h2>Nova Demanda</h2></div>
                <div class="form-group col-lg-12">
                    <div class="col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" autofocus>
                    </div>
                </div>
                <span id="form-qr-append">
                  <div><h2>Robôs</h2></div>
                  <div class="form-group col-lg-12">
                    <div class="col-md-6">
                        <label for="qrcode1">MAC do bluetooth</label>
                        <input type="text" class="mac form-control" name="qrcode1" id="qrcode1">
                    </div>
                    <div class="col-md-6">
                        <label for="desc">Descrição</label>
                        <input type="text" class="field form-control" maxlength="30" id="desc" name="desc" >
                    </div>
                  </div>
                </span>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                        <input type="submit" value="Gerar Qr's" class="form-control btn btn-primary ">
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>


    </div>	<!--/.main-->


    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/app.js"></script>
    <script src="js/tinymce/jquery.tinymce.min.js"></script>
    <script src="js/tinymce/tinymce.min.js"></script>
    <script src="js/jquery-loading/loading.js"></script>
    <script src="js/jqueryconfirm/jquery-confirm.min.js"></script>
    <script src="js/jquery-mask/jquery.mask.js"></script>

    <script>
        window.onload = function () {
            var chart1 = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(chart1).Line(lineChartData, {
                responsive: true,
                scaleLineColor: "rgba(0,0,0,.2)",
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleFontColor: "#c5c7cc"
            });
        }
    </script>

    </body>
</html>