 <!DOCTYPE html>
 <html>
 <head>
    <title>SENAT AKADEMIK ITS</title>

    <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
    <link rel="stylesheet" href="<?php echo base_url('assets/foundation/css/normalize.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/foundation/css/foundation.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nav_vertical.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nanoscroller.css');?>">
    <style type="text/css">
    .nano { height: 270px; }
    .nano .nano-slider { background: #111; }

    .event {
        margin-bottom: 10px;
        padding: 1px 1px 1px 0;
        display: table;
    }

    .event-date {
      display: table-cell;
    }
  .event-date .event-month {
    color:#fff;
    margin: 0;
    padding:2px;
    width: 60px;
    background: #008CBA;

    text-align: center; }
  .event-date .event-day {
    margin: 0;
    border: 1px solid  #DDDDDD;
    text-align: center;
    font-size: 1rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    }

    .event-desc {
        font-size: 0.8rem;
      padding: 0 0 0 0.5rem;
      text-align: left;
      display: table-cell;
      vertical-align: top;
    }

    .event-desc-detail{
        font-size: 0.8rem;
    }


    </style>
 </head>
 <body>


 <!-- START MOBILE DESAIN -->
  <div id="mobile" class="off-canvas-wrap " data-offcanvas>
    <div class="inner-wrap">
      <?php echo $mobile; ?>
      <section class="main-section" style="padding:10px;" >
        <header class="row show-for-large-up">
          <div class="large-12 columns">
            <div class="logo">
              <div class="logo-gmb"></div>
            </div>
          </div>
        </header>
        <div class="row">
          <?php echo $header; ?>
          <?php echo $sidebar; ?>
          <?php echo $content;?>
          <div class="clear" style="padding-top:25px;">
              <?php echo @$pagination; ?>
          </div>
        </div>
      </section>
      <?php  echo $footer;?>
      <a class="exit-off-canvas"></a>
    </div>
  </div>

  <!-- END MOBILE DESAIN -->

  <script src="<?php echo base_url('assets/foundation/js/vendor/jquery.js');?>"></script>
  <script src="<?php echo base_url('assets/foundation/js/foundation/foundation.js');?>"></script>
  <script src="<?php echo base_url('assets/foundation/js/foundation/foundation.accordion.js');?>"></script>
  <script src="<?php echo base_url('assets/foundation/js/foundation/foundation.offcanvas.js');?>"></script>
  <script src="<?php echo base_url('assets/foundation/js/foundation/foundation.dropdown.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.flip.js');?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.nanoscroller.min.js');?>"></script>
  <!-- Other JS plugins can be included here -->

  <script type="text/javascript">
  $(document).foundation();


  var flip_continer = $(".flip-container");

  $.fn.flipQuicklink = function(){
      return this.each(function(){
          $(this).flip({trigger:'hover'});
      });
  };

  flip_continer.flipQuicklink();


  $('.side-nav li:has("ul")').children('ul').hide(); //hide submenu
  $('.side-nav li:has("ul")').addClass('hasChildren'); // add class to li ul child
  $('.side-nav li:has("ul")').click(function(){
    $(this).toggleClass( "active" ) // add active class to clicked menu item
    $(this).children('ul').slideToggle(); //toggle submenu
  });
  $(".nano").nanoScroller();
  </script>

 </body>
 </html>
