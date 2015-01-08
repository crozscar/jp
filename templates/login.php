<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="" method="post">
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>Enter any username and password.</span>
		</div>
    <?php if(isset($msg)): ?>
    <div class="alert alert-danger ">
			<button class="close" data-close="alert"></button>
			<span>:( Oops! Username or passowrd is invalid.</span>
		</div>
    <?php endif; ?>
    
     
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me
			</label>
			<button type="submit" name="submit" class="btn green pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>   
		 
		</div>
    <br>
   

    <a style="width:100%;" href="?type=facebook" class="btn blue"><i class="fa fa-facebook"></i>&nbsp;&nbsp;Login Via Facebook</a>
		<div class="create-account">
			<p>
				Don't have an account yet ?&nbsp; 
				<a href="signup.php" id="register-btn" >Create an account</a>
			</p>
		</div>
		
	</form>
<!-- END LOGIN FORM --> 