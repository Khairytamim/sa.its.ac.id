<style type="text/css">

.btn-link {
     background:none!important;
     border:none;
     padding:0!important;
    /*border is optional*/
     cursor: pointer;
     margin:0;
}

</style>

<div class="row show-for-large-up" id="header">

  <div class="large-10 columns">

    <nav class="nav-bar right">
    <ul class="inline-list" style="overflow: inherit;">
       <?php foreach ($quicklink as $q) { ?>
          <li>
            <div class="flip-container">
              <div class="front">
                <img src="<?php echo base_url('assets/img/quicklink_pendaftaran.png')?>" alt="ADMISSIONS" width="99" height="73">
                <!-- front content -->
              </div>
              <div class="back">
                <div class="text-description"><a href="<?php echo $q->quicklink_url;?>" target="blank_" style="color:white;font-size: 75%;"> <?php echo $q->quicklink_nama; ?> </a> </div>
                <!-- back content -->
              </div>
            </div>
         </li>
       <?php } ?>


    </ul>
    </nav>



    <h3 style="color:white; width: 100px; margin-top : -12px; margin-left: 4.3em;"><?php echo strtoupper($setting->row('setting_nama_unit'))?></h3>
    <h6 style="color:white;"><?php echo strtoupper($setting->row('setting_detail_unit'));?> <h6>
    <!-- <hr/> -->

    <div class="clear"></div>
  </div>

  <div class="large-2 columns">
    <div class="langs row">
        <form method="post" action="<?php echo base_url('index.php/translate');?>">
        <input type="hidden" name="url" id="url">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <?php if($this->session->userdata('bahasa') == 'eng') { ?>
            <input  type="hidden" name="translate" value="ind">
            <button class="btn-link"><img src="<?php echo base_url('assets/img/id.png')?>" alt="Switch Indonesia"></button>
        <?php } else { ?>
            <input  type="hidden" name="translate" value="eng">
            <button class="btn-link"><img src="<?php echo base_url('assets/img/en.png')?>" alt="Switch English"></button>
        <?php } ?>
        </form>
    </div>
    <div class="search row">
    <form action="<?php echo base_url('index.php/search');?>" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <button class="right large3" id="ok" type="submit"><i class="fa fa-search"></i></button>
        <input type="text" placeholder="search" name="keyword" class="right large-9" >
    </form>
    </div>
  </div>
</div>

<script type="text/javascript">
document.getElementById("url").value = document.URL;
</script>
