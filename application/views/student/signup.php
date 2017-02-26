<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('student/header');
?>
	<title>Student SignUp</title>
</head>
<?php $this->load->view('student/public_navbar'); ?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 ">

			<form role="form" method="post" action="<?php echo site_url('student/signup') ?>">
				<h3><center>Sign Up | Student</center></h3>
				<?php if (isset($message) AND $message != "") echo '<div class="alert alert-info">' . $message . "</div>"; ?>
				<input type="text" name="firstname" placeholder="First name" class="form-control" value="<?php echo set_value('firstname') ?>">
				<small class="text-danger"><?php echo form_error('firstname') ?></small>
				<br/>
				<input type="text" name="lastname" placeholder="Last Name" class="form-control" value="<?php echo set_value('lastname') ?>">
				<small class="text-danger"><?php echo form_error('lastname') ?></small>
				<br/>
				<input type="email" name="email" placeholder="email@example.com" class="form-control" value="<?php echo set_value('email') ?>">
				<small class="text-danger"><?php echo form_error('email') ?></small>
				<br/>
				<input type="text" name="username" placeholder="username" class="form-control" value="<?php echo set_value('username') ?>">
				<small class="text-danger"><?php echo form_error('username') ?></small>
				<br/>
				<input type="password" name="password" placeholder="password" class="form-control" value="<?php echo set_value('password') ?>">
				<small class="text-danger"><?php echo form_error('password') ?></small>
				<br/>
				<select name="level" class="form-control">
					<?php foreach ($levels as $level): ?>
						<option value="<?php echo $level->levelID?>"><?php echo $level->levelName ?></option>
					<?php endforeach; ?>
				</select>
				<small class="text-danger"><?php echo form_error('level') ?></small>
				<br/>
				<input type="text" name="matric" placeholder="Matric No" class="form-control" value="<?php echo set_value('matric') ?>">
				<small class="text-danger"><?php echo form_error('matric') ?></small>
				<br/>
				<input type="text" name="faculty" placeholder="Faculty" class="form-control" value="<?php echo set_value('faculty') ?>">
				<small class="text-danger"><?php echo form_error('faculty') ?></small>
				<br/>
				<input type="text" name="dept" placeholder="Department" class="form-control" value="<?php echo set_value('dept') ?>">
				<small class="text-danger"><?php echo form_error('dept') ?></small>
				<br/>

				<button type="submit" name="create_account" class="btn btn-success">Create Account</button>
				<p>
					<center><a href="<?php echo site_url('student/login') ?>">Already have an account? </a></center>
				</p>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('footer') ?>