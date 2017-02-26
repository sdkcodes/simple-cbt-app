<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>Admin | Edit Question</title>
	
</head>
<?php $this->load->view('admin/navbar'); ?>

<div id="page-wrapper" >
	<div class="container">
		<div class="page-header">
			
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						
						<h2>Edit Question</h2>
						
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-sm-8">	
				<div class="well" id="instruction">
					<h3>Instruction for setting Questions</h3>
					<ol>
						<li>Enter the question and the options in the spaces provided below</li>
						<li>To set the correct answer for the question, select the "correct answer" button next to the option</li>
					</ol>
				</div>
				
				<?php if ($this->session->flashdata('message')!== null): ?>
					<div class="alert alert-info"><a href="#" class="close" data-dismiss="alert">&times; </a>
						<?php echo $this->session->flashdata("message"); ?>
			 		</div>
			 	<?php endif; ?>
				
				
				<?php echo validation_errors() ?>
				<div id="form-inline">
					<form method="post" role="form" class="form-signin" >
						<h2>Edit Question</h2>
						<!-- <select name="course_id" class="form-control">
							<option value="">Select course to add question to</option>
							<?php foreach($courses as $course): ?>
								<option value="<?php echo $course->courseID?>"><?php echo $course->courseTitle . "(". $course->courseCode .")"?></option
								>
							<?php endforeach; ?>
						</select> -->
						<input type="text" value="<?php echo $question->courseTitle ?> (<?php echo $question->courseCode ?>)" class="form-control" disabled>
						<input type="hidden" name="course_id" value=<?php echo $question->courseID ?>>
						<label for="Question Content">Question</label><br>
						<textarea name="question_text" class="form-control" 
							placeholder="Write the question here. e.g When was Nigeria created?" 
							id="question_text" required><?php echo $question->questionText ?></textarea>
						<br/>
						
						<label for="optionA">a.</label>
						<input name="option_a" id="option_a" placeholder="option A" class="form-control" 
							value="<?php echo $question->option1 ?>" required>
							<input type="radio" name="answer" id="answer" value="option_a">Correct answer
						<br>
						<label for="optionB">b.</label>
						<input name="option_b" id="option_b" placeholder="option B" class="form-control" 
							value="<?php echo $question->option2 ?>" required>
							<input type="radio" name="answer" id="answer" value="option_b">Correct answer
						<br>
						<label for="optionC">c.</label>
						<input name="option_c" id="option_c" placeholder="option C" class="form-control" 
							value="<?php echo $question->option3 ?>">
							<input type="radio" name="answer" id="answer" value="option_c">Correct answer
						<br>
						<label for="optionD">d.</label>
						<input name="option_d" id="option_d" placeholder="option D" class="form-control" 
							value="<?php echo $question->option4 ?>">
							<input type="radio" name="answer" id="answer" value="option_d">Correct answer
						<br>
						<label for="optionE">e.</label>
						<input name="option_e" id="option_e" placeholder="option E" class="form-control" 
							value="<?php echo $question->option5 ?>" >
							<input type="radio" name="answer" id="answer" value="option_e">Correct answer
						<br>
						
						<input type="submit" name="add_question" value="Edit Question" class="btn btn-success">
						<br>
					</form>
				</div>
	
			</div>
		</div>
</div>
<?php $this->load->view('footer'); ?>