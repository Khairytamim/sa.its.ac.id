<style type="text/css">
  .hasChildren:before{
    line-height: 36px;
    content: "+";
    float: left;
  }
  .hasChildren.active:before{
    line-height: 36px;
    content: "-";
  }
</style>

<aside class="large-3 columns show-for-large-up" id="sidebar">

  <?php echo $sidebar; ?>



 <?php if(count($pengumuman)){?>
  <div class="row">
  <div class="small-12 medium-12 large-12 small-centered columns" id="pengumuman" >
      <div class="heading panel-header ">
          PENGUMUMAN
      </div>
      <div class="nano">

        <div class="artikel-container nano-content">
        <?php foreach($pengumuman as $p) { ?>

          <article class="event">

           <div class="event-date">
             <p class="event-month"><?php echo date('M',strtotime($p->timestamp));?></p>
             <p class="event-day"><?php echo date('j/y',strtotime($p->timestamp));?></p>
           </div>
           <div class="event-desc">


            <!-- <a href="<?php echo base_url('upload/'.$p->pengumuman_ing);?>" target="_blank"> -->
            <a>
             <?php if($this->session->userdata('bahasa') == 'eng'){ ?>
             <p class="event-desc-detail"><?php echo strtoupper($p->judul_ing); ?></p>
             <?php } else { ?>
             <p class="event-desc-detail"><?php echo strtoupper($p->judul_ind); ?></p>
             <?php } ?>
            </a>
           </div>

         </article>

         <?php } ?>


        </div>
     </div>
    </div>
    </div>

    <?php } ?>


    <?php if(count($agenda)){?>
     <div class="row">
     <div class="small-12 medium-12 large-12 small-centered columns" id="pengumuman" >
         <div class="heading panel-header ">
             AGENDA
         </div>
         <div class="nano">

           <div class="artikel-container nano-content">
           <?php foreach($agenda as $p) { ?>

             <article class="event">

              <div class="event-date">
                <p class="event-month"><?php echo date('M',strtotime($p->agenda_time));?></p>
                <p class="event-day"><?php echo date('j/y',strtotime($p->agenda_time));?></p>
              </div>
              <div class="event-desc">


               <a href="<?php echo base_url('index.php/page/agenda/'.$p->agenda_id);?>" target="_blank">
                <?php if($this->session->userdata('bahasa') == 'eng'){ ?>
                <p class="event-desc-detail"><?php echo strtoupper($p->judul_ing); ?></p>
                <?php } else { ?>
                <p class="event-desc-detail"><?php echo strtoupper($p->judul_ind); ?></p>
                <?php } ?>
               </a>
              </div>

            </article>

            <?php } ?>


           </div>
        </div>
       </div>
       </div>

       <?php } ?>
</aside>
