<br>
<br>
<br>
<body>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/edificio/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Agregar Edificio</b></h3>
            </div>

            <div class="panel-body">

                <div class="list-group"></div>
                <h2 class="centrado"></h2>

                <?php echo validation_errors(); ?>
                <?php echo form_open('edificio/agregar_edificio'); ?>

                <h4><span class="">Nombre Edificio</span></h4>
                <input type="text" class="form-control" name="nombre_edi" placeholder="Nombre Edificio" value="<?php echo set_value('nombre_edi'); ?>">

                <h4><span class="">Número Edificio</span></h4>
                <input type="text"  class="form-control" name="numero" placeholder="Número Edificio" value="<?php echo set_value('numero'); ?>">

                <h4><span class="">Dirección</span></h4>
                <input type="text"  class="form-control" name="direccion" placeholder="Dirección" value="<?php echo set_value('direccion'); ?>">

                <h4><span class="">Administrador</span></h4>
                <SELECT id="activeMember" NAME="rut_admin" class="form-control">
                    <?php  foreach ($administradores as $item) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                        ?>
                        <OPTION VALUE='<?php echo $item['RUT_ADMIN']?>'><?php echo $item['NOMBRE_ADMIN'] ;?> <?php echo $item['APELLIDO_ADMIN'];?></OPTION>
                    <?php } ?>
                </SELECT>

                <h4><span class="">Teléfono Conserjería</span></h4>
                <input type="text" class="form-control"  name="fono_conserjeria" placeholder="Teléfono Conserjería" value="<?php echo set_value('fono_conserjeria'); ?>">

                <h4><span class="">Ciudad</span></h4>
                <input type="text"  class="form-control" name="ciudad" placeholder="Ciudad" value="<?php echo set_value('ciudad'); ?>">

                <h4><span class="">Descripción</span></h4>
                <textarea cols="70" row="5"  class="form-control" name="descripcion" placeholder="Descripción" value="<?php echo set_value('descripcion'); ?>"></textarea>

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="AGREGAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>