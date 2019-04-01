<?php 
    $setting = $this->lib_mod->detail('setting', array('id'=>1));
 ?>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php if(isset($setting[0])) echo $setting[0]['name']; else echo 'Đăng nhập hệ thống quản trị';  ?></title>    
<meta name="description" content="<?php if(isset($setting[0])) echo $setting[0]['description']; else echo 'Đăng nhập hệ thống quản trị';  ?>" />
<meta name="keywords" content="<?php if(isset($setting[0])) echo $setting[0]['keyword']; else echo 'Đăng nhập hệ thống quản trị';  ?>" />

<base href="<?php echo base_url(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>styles/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url();?>styles/assets/css/pages/lock.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php if(isset($setting[0])) echo base_url().$setting[0]['favicon']?>" type="image/x-icon">

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div class="page-lock">
	<div class="page-logo">
		<a class="brand" href="<?php echo base_url(); ?>">
			<?php if(isset($setting[0])){ ?>
				<img src="<?php echo base_url().$setting[0]['favicon']?>" alt="Đăng nhập">
			<?php } ?>
		</a>
	</div>
	<div class="page-body">
		
		<?php $error = $this->session->flashdata('error');
		if(!empty($error)){ ?>
		<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span>
				<?php echo $error; ?>
			</span>
		</div>
		<?php } ?>

		<img class="page-lock-img" alt="<?php echo $this->session->userdata('admin_fullname'); ?>" src="<?php if(!empty($this->session->userdata('admin_thumbnail'))) echo base_url().$this->session->userdata('admin_thumbnail'); else echo base_url(). 'styles/assets/img/user-default.png';?>"/>
		<div class="page-lock-info">
			<h1><?php echo $this->session->userdata('admin_fullname'); ?></h1>
			<span class="email">
				 <?php echo $this->session->userdata('admin_email'); ?>
			</span>
			<span class="locked">
				 Locked
			</span>
			<form class="form-inline" action="<?php echo base_url();?>lock/action_login" method="post">	
				<div class="input-group input-medium">
					<input type="hidden" name="admin_name" value="<?php echo $this->session->userdata('admin_name'); ?>">
					<input type="hidden" name="admin_fullname" value="<?php echo $this->session->userdata('admin_fullname'); ?>">
					<input type="hidden" name="admin_email" value="<?php echo $this->session->userdata('admin_email'); ?>">
					<input type="hidden" name="admin_thumbnail" value="<?php echo $this->session->userdata('admin_thumbnail'); ?>">
					<input type="password" required class="form-control" name="password" placeholder="Password">
					<span class="input-group-btn">
						<button type="submit" name="submit" value="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
					</span>
				</div>
				<!-- /input-group -->
				<div class="relogin">
					<a href="<?php echo base_url();?>home/login">
						Không phải <?php echo $this->session->userdata('admin_fullname'); ?> ?
					</a>
				</div>
			</form>
		</div>
	</div>
	<div class="page-footer">
	 	2014 &copy; acetiendung.
	</div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>styles/assets/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>styles/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>styles/assets/scripts/core/app.js"></script>
<script src="<?php echo base_url();?>styles/assets/scripts/custom/lock.js"></script>
<script>
jQuery(document).ready(function() {    
   App.init();
   Lock.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>