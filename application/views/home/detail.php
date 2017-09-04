  <?php if(count($content)){?>
 <aside class="large-8 medium-12 small-12 columns" role="content" id="content">



    <?php $i = 0; ?>
    <?php foreach($content as $r){ ?>

        <?php $i++; ?>

        <?php if($this->session->userdata('bahasa') == 'eng'){ ?>
        <article >

          <h3><a href="#"><?php echo $r->judul_ing;?></a></h3>

          <h6>Post by <a href="#"><?php  echo $r->users_nama;?></a> on <?php echo date('F j, Y.',strtotime($r->artikel_time));?></h6>

          <p><?php echo str_replace("{ellipsis}", "", $r->artikel_ing);?></p>


          <?php if($i != count($content)) {  ?>

          <?php  echo $hr; ?>

          <?php } ?>
        </article>


        <?php } else {  ?>
        <article >

          <h3><a href="#"><?php echo $r->judul_ind;?></a></h3>

          <h6>Post by <a href="#"><?php echo $r->users_nama;?></a> on <?php  echo date('F j, Y.',strtotime($r->artikel_time));?></h6>

          <p><?php echo str_replace("{ellipsis}", "", $r->artikel_ind);?></p>


          <?php if($i != count($content)) {  ?>

          <?php  echo $hr; ?>

          <?php } ?>

        </article>
        <?php } ?>


    <?php } ?>

  </aside>


  <?php } ?>
