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
            <h3 class="pull-left"><b>Detalle Reserva</b></h3>
            <br>
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
                    <th class="centered">
                        Número
                    </th>
                    <th class="centered">
                        Precio/Noche
                    </th>
                    <th class="centered">
                        Precio Extra/Noche
                    </th>
                    <th class="centered">
                        Precio Total/Noche
                    </th>
                    <th class="centered">
                        Descuento (%)
                    </th>
                    <th class="centered">
                        Personas
                    </th>
                    <th class="centered">
                        Fecha Llegada
                    </th>
                    <th class="centered">
                        Fecha Salida
                    </th>
                    <th class="centered">
                        Subtotal
                    </th>
                    <th class="centered">

                    </th>
                    <th class="centered">

                    </th>
                </tr>
                </thead>
                <tbody>

                <?php $suma_total=0; ?>
                <?php  foreach ($query as $item) { //item es el nombre de la variable para poder acceder a los datos "lista_deptos" que vienen del controlador "tipo_departamento"
                    ?>
                    <tr>
                        <td class="centered"><?php echo  $item['ID_DEPTO']?></td>
                        <td class="centered"><?php echo "$"; echo $item['PRECIO_DEPTO']?></td>
                        <td class="centered"><?php echo "$"; echo $item['PRECIO_EXTRA']?></td>
                        <td class="centered"><?php echo "$"; echo $item['PRECIO_TOTALDIAS']?></td>
                        <td class="centered"><?php echo  $item['DCTO']; echo "%" ?></td>
                        <td class="centered"><?php echo  $item['NUMPERSONAS']?></td>
                        <td class="centered"><?php echo  $item['F_LLEGADA']?></td>
                        <td class="centered"><?php echo  $item['F_SALIDA']?></td>
                        <td class="centered"><?php echo "$"; echo $item['SUBTOTAL']?></td>

                        <?php echo validation_errors(); ?>
                        <?php echo form_open('carrito/agregar_personas'); ?>
                        <div class="">

                            <td>
                                <input class="form-control" placeholder="N° Personas" type="number" min="0" name="npersonas" style="width: 125px;">
                                <input type="hidden" name="rut" value=<?php echo $item['RUT']?>>
                                <input type="hidden" name="id_dep" value=<?php echo $item['ID_DEPTO']?>>
                                <input type="hidden" name="pre_dep" value=<?php echo $item['PRECIO_DEPTO']?>>
                                <input type="hidden" name="pre_ext" value=<?php echo $item['PRECIO_EXTRA']?>>
                                <input type="hidden" name="dcto" value=<?php echo $item['DCTO']?>>
                                <input type="hidden" name="f_lleg" value=<?php echo $item['F_LLEGADA']?>>
                                <input type="hidden" name="f_sali" value=<?php echo $item['F_SALIDA']?>>
                            </td>
                        </div>
                        <div class="form-group">
                            <td>
                                <input type="submit" class="inline-block list-group-item list-group-item-warning" style="width: 50px" value="+"/>
                               <!-- <input type="submit" class="inline-block list-group-item list-group-item-danger" style="width: 50px" value="-"/>-->
                               <!--<a href='<?php //echo site_url().$modificar.$item['ID_DEPARTAMENTO']?>' class="list-group-item list-group-item-info" style="width: 50px"><span class="fa fa-refresh fa-lg"></span><b></b></a>
                                <a href='<?php //echo site_url().$modificar.$item['ID_DEPARTAMENTO']?>' class="list-group-item list-group-item-danger" style="width: 50px"><span class="fa fa-times fa-lg"></span><b></b></a>-->
                            </td>
                        </div>
                        </form>
                    </tr>
                    <?php
                    $suma_total=$suma_total+$item['SUBTOTAL'];


                    ?>
                <?php } ?>

                </tbody>
            </table>
        </div>
        <table class="table table-condensed">
            <tr>
                <td>TOTAL</td>
                <td>...........................</td>
                <td>...........................</td>
                <td>...........................</td>
                <td>...........................</td>
                <td>...........................</td>
                <td>...........................</td>
                <td>............................</td>
                <td> $ <?php  echo $suma_total?></td>
                <td>...........................</td>
                <td>
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('carrito/agregar_reserva'); ?>

                    <input type="hidden" name="sum_total" value=<?php echo $suma_total ?>>

                    <!--for each para que no me de error si no hay nada en el carrito-->
                    <?php foreach ($query as $itm)  { ?>
                        <input type="hidden" name="rutr" value=<?php echo $itm['RUT']?>>
                    <?php }?>

                    <input type="submit" class="btn btn-primary" value="RESERVAR">
                    </form>
                </td>

            </tr>
        </table>

    </div>
</div>
