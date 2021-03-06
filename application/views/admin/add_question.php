<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/header'); 
?>
	<title>Admin | Add Question</title>
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
						
						<h2>Add a New Question</h2>
						
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
						<h2>Add Question</h2>
						<select name="course_id" class="form-control">
							<option value="">Select course to add question to</option>
							<?php foreach($courses as $course): ?>
								<option value="<?php echo $course->courseID?>"><?php echo $course->courseTitle . "(". $course->courseCode .")"?></option
								>
							<?php endforeach; ?>
						</select>
						<label for"Question Content">Question</label><br>
						<textarea name="question_text" class="form-control" 
							placeholder="Write the question here. e.g When was Nigeria created?" 
							id="question_text" required><?php echo set_value('question_text') ?></textarea>
						<br/>
						
						<label for="optionA">a.</label>
						<input name="option_a" id="option_a" placeholder="option A" class="form-control" 
							value="<?php echo set_value('option_a') ?>" required>
							<input type="radio" name="answer" id="answer" value="option_a">Correct answer
						<br>
						<label for="optionB">b.</label>
						<input name="option_b" id="option_b" placeholder="option B" class="form-control" 
							value="<?php echo set_value('option_b') ?>" required>
							<input type="radio" name="answer" id="answer" value="option_b">Correct answer
						<br>
						<label for="optionC">c.</label>
						<input name="option_c" id="option_c" placeholder="option C" class="form-control" 
							value="<?php echo set_value('option_c') ?>"  >
							<input type="radio" name="answer" id="answer" value="option_c">Correct answer
						<br>
						<label for="optionD">d.</label>
						<input name="option_d" id="option_d" placeholder="option D" class="form-control" 
							value="<?php echo set_value('option_d') ?>">
							<input type="radio" name="answer" id="answer" value="option_d">Correct answer
						<br>
						<label for="optionE">e.</label>
						<input name="option_e" id="option_e" placeholder="option E" class="form-control" 
							value="<?php echo set_value('option_e') ?>" >
							<input type="radio" name="answer" id="answer" value="option_e">Correct answer
						<br>
						
						<input type="submit" name="add_question" value="Add Question" class="btn btn-success">
						<br>
					</form>
				</div>
	
			</div>
		</div>
</div>
<?php $this->load->view('footer'); ?>