<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Menu <small>Management Password</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/artikel');?>"> <i class="fa fa-align-left"></i> Menu </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <div class="panel panel-primary">

          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/setting');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Artikel</legend>
                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="id"   value="<?php echo (!empty($id)) ? $id : '';?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Menu</label>
                    <div class="col-sm-3">
                      <select class="form-control" name="m_sidebar_id" data-id="<?php echo (!empty($id)) ?  $query['query']->row('sidebar_id') : 0 ;?>">
                        <?php foreach($query['menu']->result() as $m ){ ?>
                        <option value="<?php echo $m->sidebar_id; ?>"><?php echo $m->keyword; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Password</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="password" value="<?php echo (!empty($id)) ?  $query['query']->row('password') : '' ;?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="pull-right">
                        <a href="<?php echo base_url('index.php/artikel');?>" class="btn btn-default">Cancel</a>
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
// $('#artikel_time').datepicker({ format: 'yyyy-mm-dd',})
// $('#artikel_time').datepicker("update", new Date());
var menu = $("select");
menu.chosen();

var id = menu.attr("data-id");
$('select').val(parseInt(id));
$('select').trigger("chosen:updated");

</script>
