<br>
<br>
<br>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
      
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
      
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>

        <script type="text/javascript">

        $(document).ready(function(){
            $('#myTable').DataTable();
        });


    </script>

</head>

<div class="panel panel-warning">

         <div class="panel-heading">
            <span>
                <h3 class="pull-left"><b>Reservas </b></h3>
                <br>
				<a href='<?php echo site_url()?>/login/inicio' type="button" class="pull-right btn btn-success"> <i class="fa fa-arrow-down"></i><b> Volver</b></a>
				 <a href='<?php echo site_url()?>/admin/reservas_activas' type="button" class="pull-right btn btn-success"> <i class="fa fa-arrow-down"></i><b> Reservas Activas</b></a>

                <br>
                <br>
            </span>
        </div>
</div>