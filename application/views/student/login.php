<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php $this->load->view('student/header'); ?>	
	<title>Student | Log In to your account</title>
</head>
<?php $this->load->view('student/public_navbar'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?php echo site_url('student/login') ?>" method="post">
					<?php 
					if (isset($_SESSION['account_verified'])){ 
						echo '<div class="alert alert-success">';
						echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
						echo $_SESSION['account_verified'];
						echo '</div><!-- alert alert-success -->';
					}
					if (isset($message) AND $message != "") {
						echo '<div class="alert alert-danger">';
						echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
						echo $message;
						echo '</div><!-- alert alert-success -->';
					}
					
					?>
					<?php if (isset($_SESSION['login-message'])): ?>
					    <div class="alert alert-warning">
					        <a href="#" class="close" data-dismiss="alert">&times;</a>
					        <?php echo $_SESSION['login-message'] ?>
					    </div>
					<?php endif; ?>
			
					<h2 class="form-signin-heading">Student | Login </h2>
					<label for="identity">Email:</label>
					<input type="email" name="email" 
						placeholder="email@example.com" value="<?php echo set_value('email') ?>" class="form-control" id="email">
						<small class="text-muted"><?php echo form_error('email') ?></small>
					
					<label for="password">Password:</label>
					<input type="password" name="password" placeholder="Enter your password" class="form-control" id="password"
						value="<?php echo set_value('password') ?>">
					<small class="text-muted"><?php echo form_error('password') ?></small>
					<button type="submit" name="login" class="btn btn-primary" role="button">Login</button>
					<p><center><a href="#" data-toggle="modal" data-target="#forgot_password">Forgot Password?</center></p>
					<p><center>
					<a href="<?php echo site_url('student/signup') ?>">Don't have an account?</a>
					</center>
					</p> 	
				</form>
				<div class="modal fade" id="forgot_password" role="dialog">
					<div class="modal-dialog">
						<!-- modal content -->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times; </button>
								<h4 class="modal-title">Enter your email</h4>
							</div> <!-- /modal header -->
							<div class="modal-body">
								<form method="post" class="form-group" action="<?php echo site_url('student/forgotpassword') ?>">
									<input type="email" name="email" class="form-control" placeholder="email@example.com">
									<span class='text-warning'><?php echo form_error('email'); ?></span>
									<button type="submit" name="forgotPassword" class="btn btn-success">Get Password reset Link</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- /col-md-4 -->
		</div> <!-- /row -->
		
	</div><!-- Container end -->
<?php $this->load->view('footer'); ?>