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
                <span class="pull-right"><a href='<?php echo site_url()?>/login/inicio'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Perfil de Usuario</b></h3>
            </div>

            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('cliente/mi_perfil/'.$item['usuario']) ?>
                <?php  echo form_input(array('class'=>'form control','name'=>'rut','type'=>'hidden','value'=>$item['rut']))?>
                

                <h3><span class="">Nombre </span></h3>
				<?php echo $item['nombre'] ?>
				
				<h3><span class="">Apellidos </span></h3>
                 <?php echo $item['apellidos'] ?>


                <h3><span class="">Email</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'email','name'=>'email','value'=>$item['email'])); ?>

                <h3><span class="">Telefono</span></h3>
                <?php echo form_input(array('class'=>'form-control','placeholder'=>'Telefono','name'=>'telefono','value'=>$item['telefono']));?>

                <h3><span class="">Ciudad</span></h3>
                 <?php echo form_input(array('class'=>'form-control','placeholder'=>'Ciudad','name'=>'ciudad','value'=>$item['ciudad']));?>


                <h3><span class="">Usuario</span></h3>
                <?php echo $item['usuario']?>

                <h3><span class="">Contraseña</span></h3>
				<input type="password" class="form-control" name="contrasena" placeholder="Contraseña" value="<?php echo set_value('contrasena'); ?>">


                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="EDITAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>