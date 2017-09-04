<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Sidebar <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/sidebar');?>"> <i class="fa fa-align-left"></i> Sidebar </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <div class="panel panel-primary">

          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/sidebar');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Sidebar</legend>

                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="id"   value="<?php echo (!empty($id)) ? $id : '';?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />


                   <!-- Text input-->
                  <!-- <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Parent</label>
                    <div class="col-sm-3">
                        <select name="parent" id='parent' class="form-control" >
                          <option value="0">None</option>
                          <?php // foreach($parent as $p) { ?>
                          <option value="<?php // echo $p->sidebar_id; ?>" ><?php // echo $p->keyword; ?></option>
                          <?php // } ?>
                        </select>
                    </div>
                  </div> -->

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Judul Ing</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="sidebar_ing" value="<?php echo (!empty($id)) ?  $query['query']->row('sidebar_ing') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Judul Ind</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="sidebar_ind" value="<?php echo (!empty($id)) ?  $query['query']->row('sidebar_ind') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Urutan</label>
                    <div class="col-sm-1">
                      <input type="text" class="form-control" name="sidebar_urutan" value="<?php echo (!empty($id)) ?  $query['query']->row('sidebar_urutan') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Keyword</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="keyword" value="<?php echo (!empty($id)) ?  $query['query']->row('keyword') : '' ;?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="pull-right">
                        <a href="<?php echo base_url('index.php/sidebar');?>" class="btn btn-default">Cancel</a>
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


<script type="text/javascript">
var id = "<?php echo (!empty($id)) ? 'true' : 'false';?>";
console.log(id);
if(id == 'true'){
    var value = "<?php echo (!empty($id)) ? $query['query']->row('sidebar_parent') : '0'; ?>";
    $("#parent").val(value);
}
</script>
