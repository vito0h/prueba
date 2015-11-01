<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Arriendo Departamentos</title>
    <meta name="description" content="">

    <link href='<?php echo base_url('assets/css/bootstrap.min.css') ?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/font-awesome.min.css') ?>' rel="stylesheet">

    <script src='<?php echo base_url('assets/js/jquery.min.js') ?>'></script>
    <script src='<?php echo base_url('assets/js/bootstrap.min.js') ?>'></script>

    <link href='<?php echo base_url('assets/css/signin.css') ?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style.css')?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style-responsive.css')?>' rel="stylesheet">


    <!-- Bootstrap -->


    <!-- jQuery -->
    <link rel="stylesheet" href='<?php echo base_url('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css') ?>'>
    <script src='<?php echo base_url('//code.jquery.com/jquery-1.10.2.js') ?>'></script>
    <script src='<?php echo base_url('//code.jquery.com/ui/1.11.4/jquery-ui.js') ?>'></script>
    <link rel="stylesheet" href='<?php echo base_url('/resources/demos/style.css') ?>'>

    <!-- Datepicker -->
    <link rel="stylesheet" href='<?php echo base_url('assets/css/datepicker.css') ?>'>


</head>
<body>
<br>
<br>
<br>

<div class="container">

    <div class="col-md-3"></div>
    <div class="col-md-6">

        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/visita'><i class="fa fa-arrow-left"></i><b> Página Principal</b></a></span>
                <h2><b>Regístrate</b></h2>
            </div>
            <div class="panel-body">

                <?php echo validation_errors(); ?>
                <?php echo form_open('cliente/agregar_cliente'); ?>

                <h5><?php echo $mensaje ?></h5>
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="">Rut</span></h4>
                        <input type="text" class="form-control" name="rut_cli" placeholder="Rut" value="<?php echo set_value('rut_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Nombre</span></h4>
                        <input type="text" class="form-control" name="nom_cli" placeholder="Nombre" value="<?php echo set_value('nom_cli'); ?>">
                    </div>

                    <div class="col-md-12">
                        <h4><span class="">Apellidos</span></h4>
                        <input type="text" class="form-control" name="ape_cli" placeholder="Apellidos" value="<?php echo set_value('ape_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4 class="centered"><span>Sexo</span></h4>
                        <div class="col-md-6">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="sexo_cli" id="optionsRadios1" value="Femenino">
                                    Femenino
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="radio-inline">
                                <label>
                                    <input type="radio" name="sexo_cli" id="optionsRadios1" value="Masculino">
                                    Masculino
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Fecha de Nacimiento</span></h4>
                        <div class="input-group">
                            <input type="text" class="form-control" name="fdn_cli" placeholder="Elige tu fecha de nacimiento"  id="example1" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4><span class="">Nacionalidad</span></h4>
                        <input type="text" class="form-control" name="nac_cli" placeholder="Nacionalidad" value="<?php echo set_value('nac_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">E-Mail</span></h4>
                        <input type="text" class="form-control" name="mail_cli" placeholder="Correo electrónico" value="<?php echo set_value('mail_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Teléfono</span></h4>
                        <input type="tel" class="form-control" name="tel_cli" placeholder="Teléfono" maxlength="8" value="<?php echo set_value('tel_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Ciudad</span></h4>
                        <input type="text" class="form-control" name="ciu_cli" placeholder="Ciudad" value="<?php echo set_value('ciu_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Usuario</span></h4>
                        <input type="text" class="form-control" name="user_cli" placeholder="Usuario" value="<?php echo set_value('user_cli'); ?>">
                    </div>

                    <div class="col-md-6">
                        <h4><span class="">Contraseña</span></h4>
                        <input type="password" class="form-control" name="pass_cli" placeholder="Contraseña" value="<?php echo set_value('pass_cli'); ?>">
                    </div>
                </div>

                <br>
                <div><input type="submit" class= "btn btn-primary form-control" value="REGISTRATE" /></div>

                <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"></script>
                <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
                <script type="text/javascript">
                    // When the document is ready
                    $(document).ready(function () {

                        $('#example1').datepicker({
                            format: "yyyy/mm/dd"
                        });

                    });
                </script>

                </form>
            </div>
        </div>
    </div>
</div>

</body>