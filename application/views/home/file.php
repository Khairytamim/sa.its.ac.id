 <?php if(count($content)){?>
 <aside class="large-8 medium-12 small-12 columns" role="content" id="content" style="padding-bottom:30px;">
    <?php $i = 0; ?>
    <?php foreach($content as $r){ ?>
        <?php $i++; ?>
        <?php if($r->upload_ext == 'pdf' ) {  ?>
          <article >
            <h3><?php echo substr($r->upload_nama, 0,-4);?></h3>
            <a class="button small" href="<?php echo base_url();?>/upload/<?php echo $r->upload_nama;?>">Download File</a>
            <p style="margin:0 "><?php echo $r->upload_time;?></p>
          </article>      
        <?php }  else { ?>
          <article >
            <center><img src="<?php echo base_url();?>/upload/<?php echo $r->upload_nama;?>"></center>
          </article>
        <?php }  ?>
        <?php if($i != count($content)) {  ?>
            <?php echo $hr; ?>
        <?php }  ?>

    <?php } ?>


</aside>


<?php } ?>
