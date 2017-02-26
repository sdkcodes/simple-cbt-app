5<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>View Courses</title>
	<style type="text/css">

	</style>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper" >
	<div class="container-fluid">
		<div class="page-header">
			
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<span class="pull-right"><a href="<?php echo site_url('admin/addcourse') ?>" class="btn btn-default" role="button">Add New Course</a></span>
						<h2>Courses <span class="pull-right">Total Courses: <?php echo $totalRows ?></span></h2>
						
					</div>
				</div>
			</div>

		</div>
		
			<?php if (!empty($courses)): ?>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<th>Course Id</th>
							<th>Course Title</th>
							<th>Course Code</th>
							<th>Time Alloted</th>
						</thead>
						<tbody>
							<?php foreach($courses as $course): ?>
								<tr>
									<td>
									<?php echo $course->courseID ?>
									</td>
									<td><?php echo $course->courseTitle ?></td>
									<td><?php echo $course->courseCode ?></td>
									<td><?php echo $course->timeAlloted ?> minutes</td>
									<td><span class="fa fa-pencil"><a href='<?php echo site_url("admin/editCourse/$course->courseID") ?>'>Edit</a> <i class="fa fa-remove"></i><a href='<?php echo site_url("admin/deleteCourse/?course_id=$course->courseID") ?>' > Delete </a> </td>
								</tr>
								
							<?php endforeach; ?>
						</tbody>
						<ul class="pagination">
							<?php for ($i=1; $i <= $total_pages; $i++): ?>
								<?php if ($i == $current_page): ?>
									<li class="active"><a href='<?php echo site_url("admin/viewcourses?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php else: ?>
									<li><a href='<?php echo site_url("admin/viewcourses?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php endif; ?>

							<?php endfor; ?>
						</ul>
					</table>

				</div>
			</div>
			<?php endif; ?>
		</div>
	
</div>
<script type="text/javascript">
	function startEditing(course_id) {
		//prompt("Enter the new course name", course_id);
	}
</script>
<?php $this->load->view('footer') ?>