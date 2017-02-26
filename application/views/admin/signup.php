<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header');
?>
	<title>Admin SignUp</title>
</head>
<?php $this->load->view('admin/public_navbar'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 ">
			<form role="form" method="post" action="<?php echo site_url('admin/signup') ?>">
				<h3><center>Sign Up | Admin</center></h3>
				<input type="email" name="email" placeholder="email@example.com" class="form-control">
				<small class="text-muted"><?php echo form_error('email') ?></small>
				<br/>
				<input type="text" name="username" placeholder="username" class="form-control">
				<small class="text-muted"><?php echo form_error('username') ?></small>
				<br/>
				<input type="password" name="password" placeholder="password" class="form-control">
				<small class="text-muted"><?php echo form_error('password') ?></small>
				<br/>
				<button type="submit" name="create_account" class="btn btn-success">Create Account</button>
				<p>
					<center><a href="<?php echo site_url('admin/login') ?>">Already have an account? </a></center>
				</p>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('footer') ?>