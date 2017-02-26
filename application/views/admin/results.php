<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>Admin| View Students' Results</title>
	<style type="text/css">

	</style>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper" >
	<div class="container-fluid">
		<div class="page-header">
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9">
						
						<h2>Results <span class="pull-right">: <?php echo $totalRows ?></span></h2>
						
					</div>
				</div>
			</div>

		</div>
		
			<?php if (!empty($results)): ?>
				<?php $resultCounter = 1; ?>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped">
						<thead>
							<th>S/N</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Matric</th>
							<th>Dept</th>
							<th>Fac</th>
							<th>Course Code</th>
							<th>Score</th>
							<th>Percentage</th>
							<th>Grade</th>
						</thead>
						<tbody>
							<?php foreach($results as $result): ?>
								<tr>
									<td>
									<?php echo $resultCounter ?>
									</td>
									<td><?php echo $result->firstName ?></td>
									<td><?php echo $result->lastName ?></td>
									<td><?php echo $result->matric ?></td>
									<td><?php echo $result->dept ?></td>
									<td><?php echo $result->faculty ?></td>
									<td><?php echo $result->courseCode ?></td>
									<td><?php echo $result->score?></td>
									<td><?php echo $result->percentage ?> % </td>
									<td>
										<?php 
											$percentage = $result->percentage;
											if ($percentage >= 70){
												echo "A";
											}
											elseif ($percentage >= 60) {
												echo "B";
											}
											elseif ($percentage >= 50){
												echo "C";
											}
											elseif ($percentage >= 45) {
												echo "D";
											}
											elseif ($percentage >= 40){
												echo "E";
											}
											else{
												echo "F";
											}
										 ?>
									</td>
									
								</tr>
								<?php $resultCounter ++; ?>
							<?php endforeach; ?>
						</tbody>
						<!-- <ul class="pagination">
							<?php for ($i=1; $i <= $total_pages; $i++): ?>
								<?php if ($i == $current_page): ?>
									<li class="active"><a href='<?php echo site_url("admin/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php else: ?>
									<li><a href='<?php echo site_url("admin/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php endif; ?>

							<?php endfor; ?>
						</ul> -->
					</table>

				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php $this->load->view('footer') ?>