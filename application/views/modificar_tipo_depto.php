<br>
<br>
<br>
<div class="row">
    <div class="col-md-3">
    <?php

    foreach ($query as $item) {}

    ?>
    </div>
    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/tipo_departamento/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Modificar Tipo Departamento</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('tipo_departamento/editar_tipoDepto/'.$item['CODIGO_TIPO']) ?>
                <?php  echo form_input(array('class'=>'form-control','name'=>'id','type'=>'hidden','value'=>$item['CODIGO_TIPO']))?>

                <h3><span class="">Tipo Departamento</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Tipo Departamento','name'=>'tipo_depto','value'=>$item['NOMBRE_TIPO'])); ?>

                <h3><span class="">Número de Habitaciones</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'N° Habitaciones','name'=>'n_habitaciones','value'=>$item['NUM_HABITACIONES'])); ?>

                <h3><span class="">Número de Baños</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'N° Baños','name'=>'n_banios','value'=>$item['NUM_BANIOS']));?>

                <h3><span class="">Capacidad</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Capacidad','name'=>'capacidad','value'=>$item['CAPACIDAD']));?>

                <br>
                <div><input type="submit"    class= "btn btn-primary form-control" value="EDITAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>