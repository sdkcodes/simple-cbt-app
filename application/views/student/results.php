<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('student/header'); 
?>
	<title>student| View Results</title>
	<style type="text/css">

	</style>
</head>
<?php $this->load->view('student/navbar'); ?>

<div id="page-wrapper" >
	<div class="container-fluid">
		<div class="page-header">
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9">
						
						<h2>Your Results <span class="pull-right"></span></h2>
						
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
							<th>Matric</th>
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
									
									<td><?php echo $result->matric ?></td>
									
									<td><?php echo $result->courseCode ?></td>
									<td><?php echo $result->score?></td>
									<td><?php echo $result->percentage ?></td>
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
									<li class="active"><a href='<?php echo site_url("student/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php else: ?>
									<li><a href='<?php echo site_url("student/viewstudents?current_page=$i") ?>'><?php echo $i ?></a></li>
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