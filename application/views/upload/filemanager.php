<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Backend</title>

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

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url('assets/foundation/js/vendor/jquery.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js');?>"></script>


    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/fileinput.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/chosen.jquery.js')?>" type="text/javascript"></script>
    <script type="text/javascript">
        var BASE_URL = "<?php echo base_url();?>";
    </script>

</head>

<body>


        <div id="page-wrapper">

            <div class="container-fluid">

             <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Upload <small>Galeri File</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-cloud-upload"></i> Upload
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->



            <form enctype="multipart/form-data" action="<?php echo base_url("index.php/upload/process")?>" method="post">
              <div class="form-group">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input id="file-0" class="file" name="file" type="file" multiple=true>
              </div>
            </form>

            <div class="row">



                <div class="col-lg-12">


                  <?php echo $this->session->flashdata('message');?>
                  <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Foto</a></li>
                  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Document</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home" style="padding-top:20px;">
                    <div class="row">

                        <?php $arr = array('png', 'jpg', 'jpeg'); ?>
          		  		<?php foreach($result as $r){?>
                              <?php if(in_array($r->upload_ext, $arr)){ ?>
                                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                  			        <a class="thumbnail" href="#">
                  			            <img class="img-responsive" src="<?php echo base_url('upload/'.$r->upload_nama.'');?>" alt="photo" style="height: 133px;">
                  			        </a>
                                  </div>
                              <?php } ?>
          		    	<?php } ?>
                    </div>
                    </div>
                  <div role="tabpanel" class="tab-pane" id="settings" style="padding-top:20px;">
                      <ul class="list-group">
                      <?php foreach($result as $r){?>
                      <li class="list-group-item">
                          <a href="<?php echo base_url('index.php/upload/delete/'.$r->upload_id);?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="return confirm('Apakah ingin menghapus data ini ?')"></span></a>
                          <?php echo $r->upload_nama; ?>
                      </li>
  		    	      <?php } ?>
                      </ul>
                  </div>
                </div>
              </div>
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



    <script type="text/javascript">
    $(function(){

      $('img').on('click', function(event){
        // alert("test");
        var args    = top.tinymce.activeEditor.windowManager.getParams();
        win         = (args.window);
        input       = (args.input);
        console.log(win);
        console.log(input);
        win.document.getElementById(input).value = $(this).attr('src');
        top.tinymce.activeEditor.windowManager.close();
      });
    });
    $("#file-0").fileinput({
        'allowedFileExtensions' : ['jpg', 'png','gif','pdf','doc','docx','xls','xlsx']
    });
    </script>

</body>

</html>
