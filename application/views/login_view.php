<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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



    <!-- Custom Fonts -->
    <link href='<?php echo base_url('assets/font-awesome/css/font-awesome.css')?>' rel="stylesheet" type="text/css">
    <link href='<?php echo base_url('assets/font-awesome/css/font-awesome.min.css')?>' rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


</head>
<body>
<br>
<br>
<br>
<div class="container">
    <div class="col-md-4"></div>
    <div class="col-md-4">     

        <div class="form-login">
            <h2 class="form-login-heading">INICIA SESIÓN</h2>
            <div class="login-wrap">
              <?php echo validation_errors();?>
              <?php echo form_open('login');?>

                <h5 ><?php echo $mensaje ?></h5>

                <input type="text" name="username" class="form-control" placeholder="Nombre" autofocus value="<?php echo set_value('usernamelogin'); ?>">
                <br>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" value="<?php echo set_value('passwordlogin'); ?>">
                <br>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Ingresar</button>
                <br>
                <p class="pull-right">¿No tienes cuenta? <a href='<?php echo site_url()?>/cliente/registrate' class="navbar-link">Regístrate aquí</a></p>
                <br>
                <p class="pull-right"><a href='<?php echo site_url()?>/visita' class="navbar-link">Volver a página principal</a></p>
                <br>
            </div>
        </div>
    </div>
    
    <?php echo form_close() ?>
</div>

</body>
