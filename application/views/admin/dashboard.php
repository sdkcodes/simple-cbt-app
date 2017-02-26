<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header');?>
	<title>Admin Dashboard</title>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="page-header">
			<h2>Dashboard</h2>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3><?php echo $total_students ?></h3>
					</div>
					<div class="panel-body">
						Students
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3><?php echo $total_courses ?></h3>
					</div>
					<div class="panel-body">
						Courses
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3><?php echo $total_questions ?></h3>
					</div>
					<div class="panel-body">
						Questions
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4>Results</h4>
					</div>
					<div class="panel-body">
						<a href="<?php echo site_url('admin/viewresults') ?>" class="btn btn-primary">View Results</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			
			<div class="col-md-12">
				<div class="masthead">	
					<nav>
					          <ul class="nav nav-justified">
					            
					            <li><a type="button" class="btn btn-default" href="<?php echo site_url('admin/addquestion') ?>">Add Question</a></li>
					            <li><a href="admin/viewquestions" class="btn btn-default" role="button">View Questions</a></li>
					            <li><a href="admin/addcourse" class="btn btn-default">Add Course</a></li>
					            <li><a href="admin/viewcourses" class="btn btn-default">View Courses</a></li>
					            <li><a href="admin/viewstudents" class="btn btn-default">Students</a></li>
					          </ul>
					</nav>
				</div>
				</div>	
			</div>
		<div>
			
		</div>
	</div>
</div>

<center><?php $this->load->view('footer') ?></center>