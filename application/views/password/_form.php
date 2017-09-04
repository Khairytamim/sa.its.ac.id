<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Change <small>Password</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/agenda');?>"> <i class="fa fa-align-left"></i> Password </a>
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
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/password');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Setting</legend>
                  <?php //echo var_dump($query['query']->row('artikel_id'));?>
                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Password Lama</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="old_password" value="">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Password Baru</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="new_password" value="">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Repeat Password</label>
                    <div class="col-sm-10">
                       <input type="password" class="form-control" name="repeat_password" value="">
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
</div><!-- /.row -->
