<br>
<br>
<br>
<div class="row">

    <div class="col-md-3"></div>

    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/login/inicio'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Aplicar Descuentos</b></h3>
            </div>

            <div class="panel-body">
                <div class="col-md-8">

                    <?php echo validation_errors(); ?>
                    <?php echo form_open('tipo_departamento/aplicar_descuento'); ?>

                    <?php  foreach ($tdepto as $item) { //item es el nombre de la variable para poder acceder a los datos "lista_deptos" que vienen del controlador "tipo_departamento"
                        ?>
                        <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" name="check[]" value="<?php echo $item['NOMBRE_TIPO']?>">
                        </span>
                            <label class="form-control"> <?php echo $item['NOMBRE_TIPO']?></label>
                        </div>
                    <?php } ?>

                    <br>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Porcentaje" name="porc" aria-describedby="basic-addon2">
                        <span class="input-group-addon" id="basic-addon2">%</span>
                    </div>
                    <br>
                </div>

                <div><input type="submit" class= "btn btn-primary form-control" value="APLICAR" /></div>

                </form>
            </div>
        </div>
    </div>
</div>