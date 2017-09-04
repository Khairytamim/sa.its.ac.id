<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Setting <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/agenda');?>"> <i class="fa fa-align-left"></i> Setting </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <?php echo $this->session->flashdata('message');?>
     <div class="panel panel-primary">

          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/setting');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Setting</legend>
                  <?php //echo var_dump($query['query']->row('artikel_id'));?>
                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="setting_id" value="<?php echo ($task == 3) ?  $query->row('setting_id') : '' ;?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama Unit</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="setting_nama_unit" value="<?php echo ($task == 3) ?  $query->row('setting_nama_unit') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <!-- <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama Detail Unit</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="setting_detail_unit" value="<?php // echo ($task == 3) ?  $query->row('setting_detail_unit') : '' ;?>">
                    </div>
                  </div> -->

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Email Unit</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" name="setting_email_unit" value="<?php echo ($task == 3) ?  $query->row('setting_email_unit') : '' ;?>">
                    </div>
                  </div>



                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="pull-right">
                        <a href="<?php echo base_url('index.php/agenda');?>" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>

                </fieldset>
              </form>
          </div>
      </div>

  </div><!-- /.col-lg-12 -->

  <div class="col-lg-12">
      <div class="panel panel-primary">

           <div class="panel-body">
                <fieldset>
                    <legend>List Password Menu Sidebar</legend>
                </fieldset>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="<?php echo base_url('index.php/setting/formPassword');?>" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="col-lg-12" style="margin-top:12px;">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width='25%'>Nama Menu</th>
                                    <th>Password</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
           </div>
      </div>
  </div>
</div><!-- /.row -->

<script type="text/javascript">
$(document).ready(function() {
    var table = $('#example').dataTable( {
        "ajax": BASE_URL+"index.php/setting/jsonPassword",
        "columns": [
            { "data": "sidebar_ind" , "width": 600 },
            { "data": "password"},
            {
                "className": 'text-center',
                "data": "id",
                "render": function ( data, type, row ) {
                    var name  = "<?php echo $this->security->get_csrf_token_name();?>";
                    var value = "<?php echo $this->security->get_csrf_hash();?>";
                    var url   = "<?php echo base_url('index.php/setting');?>";
                    var form  = '<form action="'+url+'" method="post">';
                        form += '<input type="hidden" name="task" value="5" />';
                        form += '<input type="hidden" name="'+name+'" value="'+value+'" />';
                        form += '<input type="hidden" name="id" value="'+data+'" />';
                        form += '<a href="'+url+'/formPassword/'+data+'" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Ubah</a>';
                        form += '&nbsp;';
                        form += '<button type="submit" name="hapus" value="hapus" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
                        form += '</form>';
                    return form;
                },
                "targets": 0
            },
        ],
    });
});
</script>
