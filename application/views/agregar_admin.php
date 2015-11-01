<br>
<br>
<br>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/admin/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Agregar Administrador</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('admin/agregar_admin'); ?>

                <h5><?php echo $mensaje ?></h5>
                <h3><span class="">Usuario</span></h3>
                <input type="text" class="form-control" name="nom_user" placeholder="Usuario" value="<?php echo set_value('nom_user'); ?>">

                <h3><span class="">Contraseña</span></h3>
                <input type="password" class="form-control" name="pass" placeholder="Contraseña" value="<?php echo set_value('pass'); ?>">

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="AGREGAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>