<?php 
    $setting = [];
 ?>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<base href="<?php echo base_url(); ?>">

<title><?php if(isset($setting[0])) echo $setting[0]['name']; else echo 'Đăng nhập hệ thống quản trị';  ?></title>    
<meta name="description" content="<?php if(isset($setting[0])) echo $setting[0]['description']; else echo 'Đăng nhập hệ thống quản trị';  ?>" />
<meta name="keywords" content="<?php if(isset($setting[0])) echo $setting[0]['keyword']; else echo 'Đăng nhập hệ thống quản trị';  ?>" />

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
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>styles/assets/plugins/select2/select2-metronic.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>styles/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url();?>styles/assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>styles/assets/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="<?php if(isset($setting[0])) echo WEBSITE.$setting[0]['favicon']?>" type="image/x-icon">

</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<?php if(isset($setting[0])){ ?>
		<img src="<?php echo WEBSITE.$setting[0]['logo']?>" alt="Đăng nhập">
	<?php } ?>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?php echo base_url();?>home/action_login" method="post">
		<h3 class="form-title">Đăng nhập hệ thống</h3>
		
		<?php $error = $this->session->flashdata('error');
		if(!empty($error)){ ?>
		<div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
			<span>
				<?php echo $error; ?>
			</span>
		</div>
		<?php } ?>

		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Tài khoản</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" required="true" type="text" autocomplete="off" placeholder="Tài khoản" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" required="true" type="password" autocomplete="off" placeholder="Mật khẩu" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Ghi nhớ </label>
			<button type="submit" class="btn green pull-right">
			Đăng nhập <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>

		<div class="forget-password">
			<h4>Quên mật khẩu ?</h4>
			<p>
				Chọn
				<a href="javascript:;" id="forget-password">
					đây
				</a>
				để lấy lại mật khẩu.
			</p>
		</div>
		
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="<?php echo base_url();?>home/reset_password" method="post">
		<h3>Quên mật khẩu ?</h3>
		<p>
			Điền email đã đăng ký để lấy lại mật khẩu
		</p>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" required="true" autocomplete="off" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Trở lại </button>
			<button type="submit" class="btn green pull-right">
			Gửi <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2014 &copy; acetiendung.
</div>
<!-- END COPYRIGHT -->
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
<script src="<?php echo base_url();?>styles/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>styles/assets/plugins/select2/select2.min.js"></script>
<script src="<?php echo base_url();?>styles/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>styles/assets/scripts/core/app.js" type="text/javascript"></script>
<!--<script src="<?php echo base_url();?>styles/assets/scripts/custom/login.js" type="text/javascript"></script>-->
<script src="<?php echo base_url();?>styles/assets/scripts/custom/login-soft.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>