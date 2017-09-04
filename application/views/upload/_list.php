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
	    <input id="file-0" class="file" name="file" type="file" multiple=true>
	</div>
</form>

<div class="row">

    <div class="col-lg-12">


    	<?php echo $this->session->flashdata('message');?>
	    <ul class="nav nav-tabs" role="tablist" id="myTab">
		  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Galery Image</a></li>
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

<script type="text/javascript">
	// $(function(){

	// 	$('img').on('click', function(event){
	// 		var args    = top.tinymce.activeEditor.windowManager.getParams();
	// 		win         = (args.window);
	// 		input       = (args.input);
	// 		console.log(win);
	// 		console.log(input);
	// 		win.document.getElementById(input).value = $(this).attr('src');
	// 		top.tinymce.activeEditor.windowManager.close();
	// 	});
	// });
	$("#file-0").fileinput({
	    'allowedFileExtensions' : ['jpg', 'png','gif','pdf','doc','docx','xls','xlsx']
	});
</script>
