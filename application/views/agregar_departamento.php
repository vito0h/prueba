<br>
<br>
<br>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/departamento/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Agregar Departamento</b></h3>
            </div>

            <div class="panel-body">

                <div class="list-group"></div>
                <h2 class="centrado"></h2>

                <?php echo validation_errors(); ?>
                <?php echo form_open('departamento/insertar_depto'); ?>

                <h3><span class="">Edificio</span></h3>
                <SELECT id="activeMember" NAME=id_edificio class="form-control">
                    <?php  foreach ($edificios as $item) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                    ?>
                        <OPTION VALUE='<?php echo $item["ID_EDIFICIO"]?>'><?php echo $item["NOMBRE_EDIFICIO"]?></OPTION>
                    <?php } ?>
                </SELECT>

                <h3><span class="">Piso</span></h3>
                <input type="text" class="form-control"  name="n_piso" placeholder="Piso" value="<?php echo set_value('n_piso'); ?>">

                <h3><span class="">Número Departamento</span></h3>
                <input type="text"  class="form-control" name="n_depto" placeholder="N° Departamento" value="<?php echo set_value('n_depto'); ?>">

                <h3><span class="">Tipo Departamento</span></h3>
                <SELECT id="activeMember" NAME=codigo_tipo class="form-control">
                    <?php  foreach ($tipo_depto as $item) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                    ?>
                        <OPTION VALUE='<?php echo $item["CODIGO_TIPO"]?>'><?php echo $item["NOMBRE_TIPO"]?></OPTION>
                    <?php } ?>
                </SELECT>

                <h3><span class="">Precio</span></h3>
                <input type="text"  class="form-control" name="precio" placeholder="$Precio" value="<?php echo set_value('precio'); ?>">

                <h3><span class="">Precio Extra</span></h3>
                <input type="text"  class="form-control" name="precio_extra" placeholder="$Precio Extra/Persona" value="<?php echo set_value('precio_extra'); ?>">

                <h3><span class="">Descripción</span></h3>
                <textarea cols="70" row="5"  class="form-control" name="descrip" placeholder="Descripción" value="<?php echo set_value('descrip'); ?>"></textarea>

             

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="AGREGAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>