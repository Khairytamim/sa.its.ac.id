<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Artikel <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/artikel');?>"> <i class="fa fa-align-left"></i> Artikel </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <div class="panel panel-primary">

          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/artikel');?>" method="post">
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
                      <select class="form-control" name="m_sidebar_id" data-id="<?php echo (!empty($id)) ?  $query['query']->row('m_sidebar_id') : 0 ;?>">
                        <option value="0">none</option>
                        <?php foreach($query['menu']->result() as $m ){ ?>
                        <option value="<?php echo $m->sidebar_id; ?>"><?php echo $m->keyword; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Judul Ing</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul_ing" value="<?php echo (!empty($id)) ?  $query['query']->row('judul_ing') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Judul Ind</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul_ind" value="<?php echo (!empty($id)) ?  $query['query']->row('judul_ind') : '' ;?>">
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Tanggal</label>
                    <div class="col-sm-3">
                      <input type="text" class="datepicker form-control" id="artikel_time" name="artikel_time" value="<?php echo (!empty($id)) ?  date('Y-m-d',strtotime($query['query']->row('artikel_time'))): date('Y-m-d') ;?>">
                      (yyyy-mm-dd)
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Artikel Ing</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="artikel_ing"><?php echo (!empty($id)) ?  $query['query']->row('artikel_ing') : '' ;?></textarea>
                    </div>
                  </div>


                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Artikel Ind</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="artikel_ind"><?php echo (!empty($id)) ?  $query['query']->row('artikel_ind') : '' ;?></textarea>
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

tinymce.init({
    document_base_url: BASE_URL,
    convert_urls:true,
    relative_urls:false,
    remove_script_host:false,
    selector: "textarea",
    theme: "modern",
    skin: 'light',
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime  table contextmenu paste "
    ],
    file_browser_callback   : function(field_name, url, type, win) {
      var cmsURL       = BASE_URL+'index.php/upload/filemanager'

      tinymce.activeEditor.windowManager.open({
        file            : cmsURL,
        title           : 'Select an Image',
        width           : 600,  // Your dimensions may differ - toy around with them!
        height          : 600,
        resizable       : "yes",
        inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous  : "yes"
      }, {
        window  : win,
        input   : field_name
      });
    },
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link "
});
</script>
