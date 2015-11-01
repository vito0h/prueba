<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Arriendo Departamentos</title>

    <!-- Bootstrap Core CSS -->
     <link href='<?php echo base_url('assets/css/bootstrap.min.css') ?>' rel="stylesheet">

    <!-- Custom CSS -->
    <link href='<?php echo base_url('assets/css/sb-admin.css')?>' rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href='<?php base_url('assets/css/plugins/morris.css')?>' rel="stylesheet">

    <!-- Custom Fonts -->
    <link href='<?php echo base_url('assets/font-awesome/css/font-awesome.css')?>' rel="stylesheet" type="text/css">
    <link href='<?php echo base_url('assets/font-awesome/css/font-awesome.min.css')?>' rel="stylesheet" type="text/css">

    <!-- Fuente bonita -->
    <link href='<?php echo base_url('assets/css/signin.css') ?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style.css')?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style-responsive.css')?>' rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href='<?php echo base_url('assets/css/datepicker.css') ?>'>

</head>

<body>
<br>
<br>

<div>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only"> Departamentos para todos</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=""><i class="fa fa-home"></i> Arriendo Departamentos</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="">
                <a href='<?php echo site_url()?>/login'><i class="fa fa-fw fa-user"></i> Iniciar Sesión</a>
            </li>
            <li class="">

                <a href='<?php echo site_url()?>/cliente/registrate'><i class="fa fa-fw fa-sign-in"></i> Registrarse</a>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


        <!-- /.navbar-collapse -->
    </nav>


    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<!-- /#wrapper -->
<!-- jQuery -->
<script src='<?php echo base_url('DataTables-1.10.7/js/jquery.dataTables.js') ?>'></script>
<script src='<?php echo base_url('assets/js/jquery.js')?>'></script>

<!-- Bootstrap Core JavaScript -->
<script src='<?php echo base_url('assets/js/bootstrap.min.js')?>'></script>


<!-- Morris Charts JavaScript -->
<script src='<?php echo base_url('assets/js/plugins/morris/raphael.min.js')?>'></script>
<script src='<?php echo base_url('assets/js/plugins/morris/morris.min.js')?>'></script>
<script src='<?php echo base_url('assets/js/plugins/morris/morris-data.js')?>'></script>

</body>

</html>
