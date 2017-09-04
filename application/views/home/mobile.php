<!-- START MENU HEADER FOR MOBILE -->
<nav class="tab-bar show-for-small-up hide-for-large-up">
  <section class="left-small">
    <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
  </section>

  <section class="middle tab-bar-section">
    <h1 class="title"><?php echo $setting->row('setting_nama_unit')." ITS";?></h1>
  </section>

  <section class="right-small">
    <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
  </section>
</nav>

<aside class="left-off-canvas-menu show-for-small-up hide-for-large-up">
 <!--  <ul class="off-canvas-list">
    <li><label>Menu</label></li>
    <li><a href="<?php // echo base_url('index.php/home')?>">Beranda</a>

    </li>
    <li class="has-submenu"><a href="#">profile</a>
      <ul class="left-submenu">
          <li class="back"><a href="#">back</a></li>
      </ul>
    </li>


  </ul> -->
  <?php echo $sidebarMobile; ?>
</aside>

<aside class="right-off-canvas-menu show-for-small-up hide-for-large-up">
  <ul class="off-canvas-list">
    <li class="has-submenu"><a href="#">Pengumuman</a>
        <ul class="right-submenu">
          <li class="back"><a href="#">back</a></li>

          <?php foreach($pengumuman as $p) { ?>
          <li>
            <a href="<?php echo base_url('index.php/page/pengumuman/'.$p->pengumuman_id);?>">
              <span class="positionTitle"><?php echo $p->judul_ind;?></span>
              <span class="location"><?php echo date('F j, Y.',strtotime($p->timestamp)); ?></span>
            </a>
          </li>
          <?php } ?>
          <!-- <li>
            <a href="#" target="_blank">
              <span class="positionTitle">TPA MABA ITS 2014</span>
              <span class="location">FMIPA; FTI; FTSP; FTK; FTIF</span>
            </a>
          </li> -->
        </ul>
    </li>
    <li class="has-submenu"><a href="#">Agenda</a>
        <ul class="right-submenu">
            <li class="back"><a href="#">Back</a></li>

             <?php foreach($agenda as $a) { ?>
              <li>
                <a href="<?php echo base_url('index.php/page/agenda/'.$a->agenda_id);?>">
                  <span class="positionTitle"><?php echo $a->judul_ind;?></span>
                  <span class="location"><?php echo date('F j, Y.',strtotime($a->agenda_time)); ?></span>
                </a>
              </li>
             <?php } ?>
        </ul>
    </li>
  </ul>
</aside>

<!-- END MENU HEADER FOR MOBILE -->
