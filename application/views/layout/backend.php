<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SENAT AKADEMIK ITS</title>

    <!-- Bootstrap Core CSS -->


    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css');?>">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/sb-admin.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fileinput.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/backend.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dataTables.bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/chosen.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/chosen.min.css')?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker3.css')?>">

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url('assets/foundation/js/vendor/jquery.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js');?>"></script>


    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fileinput.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/chosen.jquery.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/bootstrap-datepicker.js')?>" type="text/javascript"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo base_url();?>";
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <?php echo $header;?>

            <?php echo $sidebar;?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php echo $content; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
