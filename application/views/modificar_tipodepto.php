<br>
<br>
<br>
<div class="row">
    <div class="col-md-3">
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
                <?php echo form_open('tipo_departamento/editar_tipo_depto/'.$id) ?>
                <?php echo form_input(array('class'=>'form-control','name'=>'id','type'=>'hidden','value'=>$id))?>

                <h3><span class="">Tipo Departamento</span></h3>
                <input type="text" class="form-control" name="tipo_depto" placeholder="Tipo Departamento" value="<?php echo set_value('tipo_depto'); ?>">

                <h3><span class="">Número de Habitaciones</span></h3>
                <input type="text" class="form-control"  name="n_habitaciones" placeholder="N° Habitaciones" value="<?php echo set_value('n_habitaciones'); ?>">

                <h3><span class="">Número de Baños</span></h3>
                <input type="text" class="form-control" name="n_banios" placeholder="N° Baños" value="<?php echo set_value('n_banios'); ?>">

                <h3><span class="">Capacidad</span></h3>
                <input type="text" class="form-control" name="capacidad" placeholder="Capacidad" value="<?php echo set_value('capacidad'); ?>">

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="Modificar" /></div>

            </div>

        </div>
        </form>
    </div>
</div>