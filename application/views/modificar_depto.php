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
                <span class="pull-right"><a href='<?php echo site_url()?>/departamento/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Modificar Departamento</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('departamento/editar_depto/'.$item['ID_DEPARTAMENTO']) ?>
                <?php  echo form_input(array('class'=>'form-control','name'=>'id','type'=>'hidden','value'=>$item['ID_DEPARTAMENTO']))?>

                <h3><span class="">Nombre Edificio</span></h3>
                <SELECT id="activeMember" NAME="id_edi" class="form-control">
                    <?php  foreach ($edif as $items) { //foreach para poner el edificio correspondiente al depto que se está editando
                        ?>
                        <?php if($items['ID_EDIFICIO']==$item['ID_EDIFICIO']){ ?>
                            <OPTION VALUE='<?php echo $items['ID_EDIFICIO']?>'><?php echo $items['NOMBRE_EDIFICIO'] ;?></OPTION>
                        <?php } ?>
                    <?php } ?>
                    <!-- foreach para llenar las opciones de todos los edificios -->
                    <?php  foreach ($edif as $items) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                        ?>
                        <!--preguntamos los edificios distintos al del depto editado, para que no se repitan las opciones-->
                        <?php if($items['ID_EDIFICIO']!=$item['ID_EDIFICIO']){ ?>
                            <OPTION VALUE='<?php echo $items['ID_EDIFICIO']?>'><?php echo $items['NOMBRE_EDIFICIO'] ;?></OPTION>
                        <?php } ?>
                    <?php } ?>
                </SELECT>

                <h3><span class="">Número Piso</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Número Piso','name'=>'pis_dep','value'=>$item['NUMERO_PISO'])); ?>

                <h3><span class="">Número Departamento</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Número Departamento','name'=>'num_dep','value'=>$item['NUMERO_DEPARTAMENTO']));?>

                <h3><span class="">Tipo Departamento</span></h3>
                <SELECT id="activeMember" NAME="tip_dep" class="form-control">
                    <?php  foreach ($tipodep as $items2) { //foreach para poner administrador correspondiente al edificio que se está editando
                        ?>
                        <?php if($items2['CODIGO_TIPO']==$item['CODIGO_TIPO']){ ?>
                            <OPTION VALUE='<?php echo $items2['CODIGO_TIPO']?>'><?php echo $items2['NOMBRE_TIPO'] ;?></OPTION>
                        <?php } ?>
                    <?php } ?>
                    <!-- foreach para llenar las opciones de todos los administradores -->
                    <?php  foreach ($tipodep as $items2) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                        ?>
                        <!--preguntamos los rut distintos al del edificio editado, para que no se repitan las opciones-->
                        <?php if($items2['CODIGO_TIPO']!=$item['CODIGO_TIPO']){ ?>
                            <OPTION VALUE='<?php echo $items2['CODIGO_TIPO']?>'><?php echo $items2['NOMBRE_TIPO'] ;?></OPTION>
                        <?php } ?>
                    <?php } ?>
                </SELECT>

                <h3><span class="">Precio</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Precio','name'=>'pre_dep','value'=>$item['PRECIO']));?>

                <h3><span class="">Precio Extra</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Precio Extra','name'=>'ext_dep','value'=>$item['PRECIO_EXTRA']));?>

                <h3><span class="">Descripción</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Descripción','name'=>'des_dep','value'=>$item['DESCRIPCION']));?>

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="EDITAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>