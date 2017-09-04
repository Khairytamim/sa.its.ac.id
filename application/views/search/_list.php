<aside class="large-8 medium-12 small-12 columns" role="content" id="content" style="padding-bottom:30px;">

	Keyword : <?php echo $keyword; ?>
	<hr>
	<?php foreach($query as $r) { ?>
    <article>
   	  <?php if($this->session->userdata('bahasa') == 'eng'){ ?>
      <h3><a href="<?php echo base_url('index.php/site/detail/'.$r->artikel_id);?>"><?php echo $r->judul_ing;?></a></h3>
      <?php } else { ?>
      <h3><a href="<?php echo base_url('index.php/site/detail/'.$r->artikel_id);?>"><?php echo $r->judul_ind;?></a></h3>
      <?php } ?>
      <!-- <h6>Post by <a href="#"><?php //  echo $r->users_nama;?></a> on <?php // echo date('F j, Y.',strtotime($r->artikel_time));?></h6> -->
    </article>

    <?php } ?>

<aside>
