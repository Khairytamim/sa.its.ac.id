<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url('index.php/home');?>" target="_blank">Lihat Website</a>
</div>
<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->userdata('username');?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="<?php echo base_url('index.php/password');?>"><i class="fa fa-fw fa-gear"></i>Password</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="<?php echo base_url('index.php/auth/logout');?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul>
