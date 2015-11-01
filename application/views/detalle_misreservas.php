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
            <h3 class="pull-left"><b>DETALLE MIS RESERVAS</b></h3>
            <br>
			<?php $mis_reservas="/cliente/mis_reservas/"?>
            <a href='<?php echo site_url().$mis_reservas.$usuario?>' type="button" class="pull-right btn btn-success"> <i class="fa fa-plus"></i><b> VOLVER</b></a>
            <br>
            <br>
        </span>
    </div>

    <div class="panel-body">
        <div class="list-group"></div>

        <div>
            <table class="table table-striped table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
						<th>
                            ID DEPARTAMENTO
                        </th>
                        <th>
                            NUM DEPARTAMENTO
                        </th>
                        <th>
                            PRECIO_DEPARTAMENTO
                        </th>
						<th>
                            PRECIO EXTRA
                        </th>
                        <th>
                            PRECIO SUBTOTAL
                        </th>
                        <th>
                            FECHA_INICIO
                        </th>
						<th>
                            FECHA_FIN
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php  foreach ($query as $item) { //item es el nombre de la variable para poder acceder a los datos "lista_deptos" que vienen del controlador "tipo_departamento"
                    ?>
                        <tr>
							<td><?php echo  $item['ID_DEPARTAMENTO']?></td>
                            <td><?php echo  $item['NUMERO_DEPARTAMENTO']?></td>
                            <td><?php echo  $item['PRECIO_DEPARTAMENTO']?></td>
                            <td><?php echo  $item['PRECIO_EXTRA']?></td>
							<td><?php echo  $item['PRECIO_SUBTOTAL']?></td>
                            <td><?php echo  $item['FECHA_INICIO']?></td>
                            <td><?php echo  $item['FECHA_FIN']?></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>