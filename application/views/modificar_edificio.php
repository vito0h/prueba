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
                <span class="pull-right"><a href='<?php echo site_url()?>/edificio/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Modificar Edificio</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('edificio/editar_Edificio/'.$item['ID_EDIFICIO']) ?>
                <?php  echo form_input(array('class'=>'form-control','name'=>'id','type'=>'hidden','value'=>$item['ID_EDIFICIO']))?>

                <h3><span class="">Nombre Edificio</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Nombre Edificio','name'=>'nom_edi','value'=>$item['NOMBRE_EDIFICIO'])); ?>

                <h3><span class="">Número</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Número Edificio','name'=>'num_edi','value'=>$item['NUMERO'])); ?>

                <h3><span class="">Dirección</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Dirección','name'=>'dir_edi','value'=>$item['DIRECCION']));?>

                <h3><span class="">Administrador</span></h3>
                <SELECT id="activeMember" NAME="adm_edi" class="form-control">
                    <?php  foreach ($admins as $items) { //foreach para poner administrador correspondiente al edificio que se está editando
                        ?>
                        <?php if($items['RUT_ADMIN']==$item['RUT_ADMIN']){ ?>
                            <OPTION VALUE='<?php echo $items['RUT_ADMIN']?>'><?php echo $items['NOMBRE_ADMIN'] ;?> <?php echo $items['APELLIDO_ADMIN'];?></OPTION>
                        <?php } ?>
                    <?php } ?>
                    <!-- foreach para llenar las opciones de todos los administradores -->
                    <?php  foreach ($admins as $items) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                        ?>
                        <!--preguntamos los rut distintos al del edificio editado, para que no se repitan las opciones-->
                        <?php if($items['RUT_ADMIN']!=$item['RUT_ADMIN']){ ?>
                            <OPTION VALUE='<?php echo $items['RUT_ADMIN']?>'><?php echo $items['NOMBRE_ADMIN'] ;?> <?php echo $items['APELLIDO_ADMIN'];?></OPTION>
                        <?php } ?>
                    <?php } ?>
                </SELECT>

                <h3><span class="">Teléfono Conserjería</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Teléfono','name'=>'tel_edi','value'=>$item['TELEFONO_CONSERJERIA']));?>

                <h3><span class="">Ciudad</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Ciudad','name'=>'ciu_edi','value'=>$item['CIUDAD']));?>

                <h3><span class="">Descripción</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Descripción','name'=>'des_edi','value'=>$item['DESCRIPCION']));?>

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="EDITAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>