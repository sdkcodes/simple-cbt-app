<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>Create a New Course</title>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper">
	<div class="container">
		<div class="page-header">
			
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<!-- <span class="pull-right"><a href="#" class="btn btn-default" role="button">Add New Course</a></span> -->
						<h2>Add New Course</h2>
						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form method="post">
					<input type="text" name="title" placeholder="Course Title e.g Chemistry" class="form-control">
					<small class="text-danger"><?php echo form_error('title') ?></small>
					<br/>
					<input type="text" name="code" placeholder="Course Code e.g chm 201" class="form-control">
					<small class="text-danger"><?php echo form_error('code') ?></small>
					<br/>
					<label>Time Allocated (in Minutes):</label>
					<input type="number" name="time" placeholder="Time allocated e.g 45" class="form-control">
					<div class="text-danger"><?php echo form_error('time') ?></div>
					<br/>
					<button class="btn btn-warning">Add Course</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('footer'); ?>