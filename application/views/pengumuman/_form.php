<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pengumuman <small>Management Content</small>
        </h1>
        <ol class="breadcrumb">
            <li >
                <a href="<?php echo base_url('index.php/pengumuman');?>"> <i class="fa fa-align-left"></i> Pengumuman </a>
            </li>
            <li class="active">Form</li>
        </ol>
    </div>
</div>

<div class="row">
  <div class="col-lg-12">
     <div class="panel panel-primary">

          <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/pengumuman');?>" method="post">
                <fieldset>
                  <!-- Form Name -->
                  <legend>Form Pengumuman</legend>

                  <input type="hidden" name="task" value="<?php echo $task;?>" />
                  <input type="hidden" name="id"   value="<?php echo (!empty($id)) ? $id : '';?>" />
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama Link Ing</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul_ing" value="<?php echo (!empty($id)) ?  $query['query']->row('judul_ing') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama Link Ind</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="judul_ind" value="<?php echo (!empty($id)) ?  $query['query']->row('judul_ind') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Nama File</label>
                    <div class="col-sm-10">
                      <!-- <textarea class="form-control" rows="5" id="pengumuman_ing" name="pengumuman_ing"><?php // echo (!empty($id)) ?  $query['query']->row('pengumuman_ing') : '' ;?></textarea> -->
                      <input type="text" class="form-control" name="pengumuman_ing" value="<?php echo (!empty($id)) ?  $query['query']->row('pengumuman_ing') : '' ;?>">
                    </div>
                  </div>

                  <!-- Text input-->
                  <!-- <div class="form-group">
                    <label class="col-sm-2 control-label" for="textinput">Pengumuman Ind</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="pengumuman_ind"><?php // echo (!empty($id)) ?  $query['query']->row('pengumuman_ind') : '' ;?></textarea>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="pull-right">
                        <a href="<?php echo base_url('index.php/pengumuman');?>" class="btn btn-default">Cancel</a>
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
// tinymce.init({
//     selector: "textarea",
//     theme: "modern",
//     skin: 'light',
//     plugins: [
//         "advlist autolink lists link image charmap print preview anchor",
//         "searchreplace visualblocks code fullscreen",
//         "insertdatetime  table contextmenu paste "
//     ],
//     file_browser_callback   : function(field_name, url, type, win) {
//       var cmsURL       = BASE_URL+'index.php/upload'

//       tinymce.activeEditor.windowManager.open({
//         file            : cmsURL,
//         title           : 'Select an Image',
//         width           : 600,  // Your dimensions may differ - toy around with them!
//         height          : 600,
//         resizable       : "yes",
//         inline          : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
//         close_previous  : "yes"
//       }, {
//         window  : win,
//         input   : field_name
//       });
//     },
//     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link "
// });

tinyMCE.init({
    // General options
    document_base_url: BASE_URL,
    convert_urls:true,
    relative_urls:false,
    remove_script_host:false,
    mode : "textareas",
    selector: "textarea",
    theme: "modern",
    skin: 'light',

    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime  table contextmenu paste "
    ],



    valid_elements : "@[id|class|style|title|dir<ltr?rtl|lang|xml::lang],"
    + "a[rel|rev|charset|hreflang|tabindex|accesskey|type|"
    + "name|href|target|title|class],strong/b,em/i,strike,u,"
    + "#p[style],-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|"
    + "src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,"
    + "-blockquote,-table[border=0|cellspacing|cellpadding|width|frame|rules|"
    + "height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|"
    + "height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,"
    + "#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor"
    + "|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,"
    + "-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face"
    + "|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],"
    + "object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width"
    + "|height|src|*],map[name],area[shape|coords|href|alt|target],bdo,"
    + "button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|"
    + "valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],"
    + "input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value],"
    + "kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],"
    + "q[cite],samp,select[disabled|multiple|name|size],small,"
    + "textarea[cols|rows|disabled|name|readonly],tt,var,big",

    extended_valid_elements : "p[style]",
    inline_styles : true,
    verify_html : true
});
</script>
