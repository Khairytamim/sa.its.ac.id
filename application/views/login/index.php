<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">

	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css');?>">

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong>Access to Backend</strong>
					</div>
					<div class="panel-body">
						<form role="form" action="<?php echo base_url('index.php/auth');?>" method="POST">
							<fieldset>
								<div class="row">
									<div class="center-block">
										<img class="profile-img"
											src="<?php echo base_url('assets/img/photo.png');?>" alt="">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span> 
												<input type="hidden" name="task" value="1" />
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash();?>" />
												<input class="form-control" placeholder="Username" name="users_nama" type="text" autofocus>
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" name="users_password" type="password" value="">
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
                </div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets/foundation/js/vendor/jquery.js');?>"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>