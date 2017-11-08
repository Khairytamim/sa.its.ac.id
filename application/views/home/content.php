 <?php if(count($content)){?>
 <aside class="large-8 medium-12 small-12 columns" role="content" id="content" style="padding-bottom:30px;">
  <center><img src="http://sa.its.ac.id/upload/Selamat datang senat.png" alt="" /></center>
    <?php $i = 0; ?>
    <?php foreach($content as $r){ ?>
        <?php $i++; ?>
        <?php if($this->session->userdata('bahasa') == 'eng'){ ?>

        <article >

          <h3><a href="#"><?php echo $r->judul_ing;?></a></h3>

          <?php if(isset($date)){ ?>
              <p>Post by <a href="#"><?php  echo $r->users_nama;?></a> on <?php echo date('F j, Y.',strtotime($r->artikel_time));?></p>
          <?php } ?>

          <p>

              <?php $str = explode("{ellipsis}",$r->artikel_ing);?>
              <?php if(count($str) > 1){ ?>
                  <?php echo $str[0]."</article><div class='clearfix'><a class='button tiny right' href='".base_url('index.php/site/detail/'.$r->artikel_id)."'><strong>Selengkapnya</strong></a></div>" ?>
              <?php } else { ?>
                  <?php echo $r->artikel_ing?>
              <?php } ?>
          </p>

        </article>

        <?php }  else { ?>

        <article >

          <h3><a href="#"><?php echo $r->judul_ind;?></a></h3>
          
          <p>
              <?php $str = explode("{ellipsis}",$r->artikel_ind);?>
              <?php if(count($str) > 1){ ?>
                  <?php echo $str[0]."</article><div class='clearfix'><a class='button tiny right' href='".base_url('index.php/site/detail/'.$r->artikel_id)."'><strong>Selengkapnya</strong></a></div>" ?>
              <?php } else { ?>
                  <?php echo $r->artikel_ind?>
              <?php } ?>

          </p>
          <?php if(isset($date)){ ?>
              <p style="margin:0">Post by <a href="#"><?php  echo $r->users_nama;?></a> on <?php echo date('F j, Y.',strtotime($r->artikel_time));?></p>
          <?php } ?>

        </article>

        <?php } ?>

        <?php if($i != count($content)) {  ?>
            <?php echo $hr; ?>
        <?php }  ?>

    <?php } ?>


</aside>


<?php } ?>
