<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
      
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
      
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>


    <title>Reserva departamento</title>
    <meta name="description" content="">

    <link href='<?php echo base_url('assets/css/bootstrap.min.css') ?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/font-awesome.min.css') ?>' rel="stylesheet">

    <script src='<?php echo base_url('assets/js/jquery.min.js') ?>'></script>
    <script src='<?php echo base_url('assets/js/bootstrap.min.js') ?>'></script>

    <link href='<?php echo base_url('assets/css/signin.css') ?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style.css')?>' rel="stylesheet">
    <link href='<?php echo base_url('assets/css/style-responsive.css')?>' rel="stylesheet">


    <!--Data table web-->
    <link href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
      
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
   
   <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="/DataTables-1.10.7/media/css/jquery.dataTables.css">
      
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="/DataTables-1.10.7/media/js/jquery.js"></script>
      
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="/DataTables-1.10.7/media/js/jquery.dataTables.js"></script>


    <!--Data table local-->
    <link  href='<?php echo site_url('DataTables-1.10.7/media/css/jquery.dataTables.css')?>' rel="stylesheet">
    <link  href='<?php echo site_url('DataTables-1.10.7/media/css/jquery.dataTables.min.css')?>' rel="stylesheet">
    <link  href='<?php echo site_url('DataTables-1.10.7/media/css/jquery.dataTables_themeroller.css')?>' rel="stylesheet">

     <script src='<?php echo site_url('DataTables-1.10.7/js/jquery.dataTables.js') ?>'></script>
     <script src='<?php echo site_url('DataTables-1.10.7/js/jquery.dataTables.min.js') ?>'></script>
     <script src='<?php echo site_url('DataTables-1.10.7/js/jquery.js') ?>'></script>

    
   <link  href='<?php echo base_url('DataTables-1.10.7/media/css/jquery.dataTables.css')?>' rel="stylesheet">
	    
    <script type="text/javascript">

        $(document).ready(function(){
            $('#myTable').DataTable();
        });


    </script>
        <script>
        $(document).ready(function () {
            $('#table').DataTable({
                responsive: true,
                "order": [[2, "asc"]],
                //"scrollX": true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    { "orderSequence": [] }
                ]
            });
        });

        </script>

   
</head>