<br>
<br>
<!-- Plans -->
<section id="plans">
    <div class="container">
        <div class="row">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Realiza tu búsqueda aquí:</h3>
                </div>
                <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('departamento/buscar_departamentos_user'); ?>
                    <div class="col-md-4">
                        <h4>Tipo Departamento</h4>
                        <SELECT id="activeMember" NAME="tipo_dep" class="form-control">
                            <OPTION VALUE="0">Seleccione un tipo de departamento</OPTION>
                            <?php foreach ($tipo_d as $item){ //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                                ?>
                                <OPTION VALUE='<?php echo $item['CODIGO_TIPO']?>'><?php echo $item['NOMBRE_TIPO'];?></OPTION>
                            <?php } ?>
                        </SELECT>
                    </div>
                    <div class="col-md-3">
                        <h4>Fecha Llegada</h4>
                        <div class="input-group">
                            <?php echo form_input(array('class'=>'form-control','type'=>'text','name'=>'fec_lleg','placeholder'=>'Elige una fecha de llegada','id'=>'dpd1','data-date-format'=>'yyyy-mm-dd','aria-describedby'=>'basic-addon2','value'=>$fechallegada)); ?>
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4>Fecha Salida</h4>
                        <div class="input-group">
                            <?php echo form_input(array('class'=>'form-control','type'=>'text','name'=>'fec_sal','placeholder'=>'Elige una fecha de salida','id'=>'dpd2','data-date-format'=>'yyyy-mm-dd','aria-describedby'=>'basic-addon2','value'=>$fechasalida)); ?>
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <br>
						<input type="checkbox" name="condicion" value="especial">Búsqueda especial
                        <input type="submit" class="center-block btn btn-primary btn-lg" value="BUSCAR" />
                    </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <h5 ><?php echo $mensaje; $i=0;?></h5>
                </div>
            </div>
            <!-- item -->
            <?php  foreach ($lista_departamentos as $item) { //item es el nombre de la variable para poder acceder a los datos "lista_deptos" que vienen del controlador "tipo_departamento"
                ?>

                <div class="col-md-4 text-center">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <i class="fa fa-home fa-4x"></i>
                            <h3>Departamento <?php echo $item['NUMERO_DEPARTAMENTO'];?></h3>
							<h3>Disponibilidad</h3>

							<h3><?php echo date('d-m-y',strtotime($item['FECHA_INICIO'])); echo " a "; echo date('d-m-y',strtotime($item['FECHA_FIN']));?></h3>
                        </div>
                <?php if(count($fotos[$i])!=0){  $SlNo = 0;?>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item">
                                                <div class="container-special">
                                                        <!-- Slider -->
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="col-xs-12" id="slider">
                                                                    <!-- Top part of the slider -->
                                                                    <div class="row">
                                                                        <div class="col-sm-12" align="left" id="carousel-bounding-box">
                                                                            <div class="carousel slide" id="<?php echo $i; ?>">
                                                                                <!-- Carousel items -->
                                                                                <div class="carousel-inner" >

                                                                                    <?php foreach ($fotos[$i] as $slide) {

                                                                                        if ($SlNo == 0 ) {
                                                                                            
                                                                                            echo '<div class="active item" data-slide-number=' . $SlNo . '>';
                                                                                            echo '<img width="388px" height="260px" src="'.base_url()."img/".$slide['foto'].' ?>" >';
                                                                                            echo '</div>';
                                                                                        } else {
                                                                                            echo '<div data-slide-number=' . $SlNo . ' class="item">';
                                                                                            echo '<img width="388px" height="260px" src="'.base_url()."img/".$slide['foto'].' ?>" >';
                                                                                            echo '</div>';
                                                                                        };
                                                                                        // Add +1 to slide No
                                                                                        $SlNo++;
                                                                                        }
                                                                                       
                                                                                    ?>
                                                    
                                                                            </div>
                                                                            <!-- Carousel nav -->
                                                                            <a class="left carousel-control" href="#<?php echo $i; ?>" role="button" data-slide="prev">
                                                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                                            </a>
                                                                            <a class="right carousel-control" href="#<?php echo $i; ?>" role="button" data-slide="next">
                                                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/Slider-->
                                                    </div>

                                            </div>
                                                  </li>

                                        </ul>
                                        <?php } else{?>
                                    
                                        <ul class="list-group text-center">
                                            <li class="list-group-item">
                                                <img width='388px' height='260px' src="<?php echo base_url()."img/logo.jpg" ?>" class="img-responsive" alt="">
                                            </li>

                                        </ul>
                                    <?php } ?>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $item['DESCRIPCION']; ?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class="fa fa-usd"></i> <?php echo $item['PRECIO']; ?> / noche</li>

                        </ul>
                        <ul class="list-group text-center">
                            <li class="list-group-item"><i class=""></i>
                                <?php foreach ($tipo_d as $nombredepto){
                                    if($item['CODIGO_TIPO']==$nombredepto['CODIGO_TIPO']){
                                        echo $nombredepto['NOMBRE_TIPO'];
                                        echo ", para ";
                                        echo $nombredepto['CAPACIDAD'];
                                        echo " persona(s).";
                                    }
                                } ?></li>

                        </ul>
                        <?php echo validation_errors(); ?>
                        <?php echo form_open('carrito/agregar_depto_carrito'); ?>

                        <input type="hidden" name="id_dep" value=<?php echo $item['ID_DEPARTAMENTO'] ?> >
                        <input type="hidden" name="cod_tip" value=<?php echo $item['CODIGO_TIPO'] ?> >
                        <input type="hidden" name="pre_dep" value=<?php echo $item['PRECIO'] ?> >
                        <input type="hidden" name="pre_ext" value=<?php echo $item['PRECIO_EXTRA'] ?> >
                        <input type="hidden" name="f_lleg" value=<?php echo $item['FECHA_INICIO'] ?> >
                        <input type="hidden" name="f_sal" value=<?php echo $item['FECHA_FIN']?> >
                        <div class="panel-footer">
                            <input type="submit" class="btn btn-lg btn-block btn-warning" value="RESERVE AHORA!" />
                        </div>
                    </div>
                </div>
                </form>
            <?php $i++;} ?>

            <!-- Load jQuery and bootstrap datepicker scripts -->
            <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>


            <script type="text/javascript">
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                var checkin = $('#dpd1').datepicker({
                    onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.setValue(newDate);
                    }
                    checkin.hide();
                    $('#dpd2')[0].focus();
                }).data('datepicker');
                var checkout = $('#dpd2').datepicker({
                    onRender: function(date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    checkout.hide();
                }).data('datepicker');
            </script>

        </div>
    </div>
</section>
<!-- /Plans -->