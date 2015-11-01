<br>
<br>
<br>
<div class="row">

    <div class="col-md-4">
    </div>


    <div class="col-md-4">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/login/inicio'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Modifica tu Contraseña</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('admin/editar_admin/') ?>

                <h3><span class="">Nombre Usuario</span></h3>
                <?php echo form_input(array('class'=>'form-control','name'=>'usuario','readonly'=>'readonly','value'=>$nom_user))?>

                <h3><span class="">Contraseña Nueva</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Contraseña Nueva','name'=>'pass','type'=>'password')); ?>

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="Modificar" /></div>
                </form>
            </div>
        </div>
    </div>
</div>