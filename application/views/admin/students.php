<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>Admin| View Students</title>
	<style type="text/css">

	</style>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper" >
	<div class="container">
		<div class="page-header">
			
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						
						<h2>Students <span class="pull-right">Total Students: <?php echo $totalRows ?></span></h2>
						
					</div>
				</div>
			</div>

		</div>
		
			<?php if (!empty($students)): ?>
				<?php $studentCounter = 1; ?>
			<div class="row">
				<div class="col-md-8">
					<table class="table table-striped">
						<thead>
							<th>S/N</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Matric</th>
							<th>Dept</th>
							<th>Fac</th>
						</thead>
						<tbody>
							<?php foreach($students as $student): ?>
								<tr>
									<td>
									<?php echo $studentCounter ?>
									</td>
									<td><?php echo $student->firstName ?></td>
									<td><?php echo $student->lastName ?></td>
									<td><?php echo $student->matric ?></td>
									<td><?php echo $student->dept ?></td>
									<td><?php echo $student->faculty ?></td>
									
								</tr>
								<?php $studentCounter ++; ?>
							<?php endforeach; ?>
						</tbody>
						<ul class="pagination">
							<?php for ($i=1; $i <= $total_pages; $i++): ?>
								<?php if ($i == $current_page): ?>
									<li class="active"><a href='<?php echo site_url("admin/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php else: ?>
									<li><a href='<?php echo site_url("admin/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php endif; ?>

							<?php endfor; ?>
						</ul>
					</table>

				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php $this->load->view('footer') ?>