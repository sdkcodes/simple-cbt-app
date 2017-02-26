<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('student/header');?>
	<title>Student Dashboard</title>
</head>
<?php $this->load->view('student/navbar'); ?>

<div id="page-wrapper">
	<div class="container">
		<div class="page-header">
			<h2>Dashboard</h2>
		</div>

		<div class="row">
			<div class="col-md-5">
				<h2><div class="label label-info">Choose a course to start test</div></h2>
					<div class="list-group">
						<?php foreach ($courses as $course): ?>
							<li class="list-group-item"><a href='<?php echo site_url("student/takeExam/$course->courseID")?>'><?php echo $course->courseCode ?></a></li>
							
						<?php endforeach; ?>
					</div><!-- /list-group -->
			</div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading"><?php echo $student->firstName . " ". $student->lastName ?></div>
					<div class="panel-body">
						<img src='<?php echo base_url("images/$student->image") ?>' width="80" height="70"><br>
						Status: student<br/>
						Today's Date: <span id="today"></span><br>
						Matric No: <?php echo $student->matric ?>
						<br/>
						<a href="<?php echo site_url('student/viewresults') ?>" class="btn btn-warning">View Your Results</a>

						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	today = new Date();

	document.getElementById('today').innerHTML = today.getFullYear() + "/" + (Number(today.getMonth()) + 1) + "/" + today.getDate();
</script>
<?php $this->load->view('footer') ?>