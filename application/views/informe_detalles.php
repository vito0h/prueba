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
                <h3 class="pull-left"><b>Informes </b></h3>
                <br>
                <a href='<?php echo site_url()?>/cliente/historial_arriendo' type="button" class="pull-right btn btn-success"> <i class="fa fa-file"></i><b> Historial Arriendos</b></a>
                <a href='<?php echo site_url()?>/admin/depto_a_ocupar' type="button" class="pull-right btn btn-success"> <i class="fa fa-arrow-down"></i><b> Departamentos que se habitan hoy</b></a>
                <a href='<?php echo site_url()?>/admin/depto_a_desocupar' type="button" class="pull-right btn btn-success"> <i class="fa fa-arrow-up"></i><b> Departamentos que se desocupan hoy</b></a>
                <br>
                <br>
            </span>
        </div>
</div>