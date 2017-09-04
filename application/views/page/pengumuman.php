 <aside class="large-8 medium-12 small-12 columns" role="content" id="content">


    <?php foreach($content as $r){ ?>


    <article >

      <h3><a href="#"><?php echo $r->judul_ind;?></a></h3>
      <h6>Post by <a href="#"><?php  echo $r->users_nama;?></a> on <?php  echo date('F j, Y.',strtotime($r->timestamp));?></h6>

      <p><?php echo $r->pengumuman_ind;?></p>

      <?php echo $hr; ?>

    </article>




    <?php } ?>

  </aside>
