<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav" >
        <li class="<?php echo @$dashboard;?>">
            <a href="<?php echo base_url('index.php/auth');?>" ><i class="fa fa-home"></i> Dashboard</a>
        </li>
        <li class="<?php echo @$artikel;?>">
            <a href="<?php echo base_url('index.php/artikel');?>"><i class="fa fa-align-left"></i> Artikel</a>
        </li>
        <li class="<?php echo @$pengumuman?>">
            <a href="<?php echo base_url('index.php/pengumuman');?>"><i class="fa fa-list-alt"></i> Pengumuman</a>
        </li>
        <li class="<?php echo @$agenda; ?>">
            <a href="<?php echo base_url('index.php/agenda'); ?>"><i class="fa fa-table"></i> Agenda</a>
        </li>
        <li class="<?php echo @$sidebar;?>">
            <a href="<?php echo base_url('index.php/sidebar');?>"><i class="fa fa-sort-amount-desc"></i> Sidebar Menu</a>
        </li>
        <li class="<?php echo @$quicklink;?>">
            <a href="<?php echo base_url('index.php/quicklink');?>"><i class="fa fa-external-link-square"></i> Quicklink</a>
        </li>
        <li class="<?php echo @$upload;?>">
            <a href="<?php echo base_url('index.php/upload');?>"><i class="fa fa-cloud-upload"></i> Upload</a>
        </li>
        <li class="<?php echo @$setting;?>">
            <a href="<?php echo base_url('index.php/setting');?>"><i class="fa fa-laptop"></i> Setting</a>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->
