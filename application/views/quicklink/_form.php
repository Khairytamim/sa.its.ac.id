<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Quicklink <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/quicklink');?>"> <i class="fa fa-align-left"></i> Quicklink </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <div class="panel panel-primary">
          
          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/quicklink');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Quicklink</legend>

                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="id"   value="<?php echo (!empty($id)) ? $id : '';?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                  
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama Quicklink</label>
                    <div class="col-sm-10">
                       <input type="text" class="form-control" name="quicklink_nama" value="<?php  echo (!empty($id)) ?  $query['query']->row('quicklink_nama') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">URL</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="quicklink_url" value="<?php  echo (!empty($id)) ?  $query['query']->row('quicklink_url') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Image</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="quicklink_image" value="<?php  echo (!empty($id)) ?  $query['query']->row('quicklink_image') : '' ;?>">
                    </div>
                  </div>


                   <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="pull-right">
                        <a href="<?php echo base_url('index.php/quicklink');?>" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>

                </fieldset>
              </form>
          </div>
      </div>
   
  </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
