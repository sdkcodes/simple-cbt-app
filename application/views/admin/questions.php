<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>View Questions</title>
	<style type="text/css">

	</style>
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper" >
	<div class="container">
		<div class="page-header">
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9">
						<span class="pull-right"> <a href="<?php echo site_url('admin/addquestion') ?>" class="btn btn-default">Add New Question</a> </span>
						<h2>Questions</h2>
						
					</div>
				</div>
			</div>

		</div>
		
			<?php if (!empty($questions)): ?>
				<?php $questionCounter = 1; ?>
			<div class="row">
				<div class="col-md-10">
					<table class="table table-striped">
						<thead>
							<th>S/N</th>
							<th>Question</th>
							<th>Option A</th>
							<th>Option B</th>
							<th>option C</th>
							<th>Option D</th>
							<th>option E</th>
							<th>Correct</th>
							<th>Course Code</th>
						</thead>
						<tbody>
							<?php foreach($questions as $question): ?>
								<tr>
									<td>
									<?php echo $questionCounter ?>
									</td>
									<td><?php echo $question->questionText ?></td>
									<td><?php echo $question->option1 ?></td>
									<td><?php echo $question->option2 ?></td>
									<td><?php echo $question->option3 ?></td>
									<td><?php echo $question->option4 ?></td>
									<td><?php echo $question->option5 ?></td>
									<td><?php echo $question->answer ?></td>
									<td><?php echo $question->courseCode ?></td>
									<td><a href='<?php echo site_url("admin/editQuestion/$question->questionID") ?>'>Edit</a> <i class="fa fa-remove"></i><a href='<?php echo site_url("admin/deleteQuestion/?question_id=$question->questionID") ?>' > Delete </a> </td>
								</tr>
								<?php $questionCounter ++; ?>
							<?php endforeach; ?>
						</tbody>
						<ul class="pagination">
							<?php for ($i=1; $i <= $total_pages; $i++): ?>
								<?php if ($i == $current_page): ?>
									<li class="active"><a href='<?php echo site_url("admin/viewquestions?current_page=$i") ?>'><?php echo $i ?></a></li>
								<?php else: ?>
									<li><a href='<?php echo site_url("admin/viewquestions?current_page=$i") ?>'><?php echo $i ?></a></li>
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