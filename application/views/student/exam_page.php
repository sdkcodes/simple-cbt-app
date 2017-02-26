<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('student/header');?>
	<title>Student | Exam in Progress</title>
</head>
<?php $this->load->view('student/navbar'); ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="page-header" >
			<h2><?php echo $course->courseTitle ." (". $course->courseCode .")"; ?> 
				
			</h2>
			<div class="label label-danger">Exam In Progress</div>
			<div class="alert alert-info" style="width:30%">
				Time alloted: <?php echo $course->timeAlloted ?> minutes.
			</div>
		</div>
		
		<div class="row">
			
			<div class="col-md-5">
				<form class="form-group" role="form" method="post" id="test_form">
				<ul class="nav nav-tabs">
					<?php $questionCounter = 1; ?>
					<?php foreach ($questions as $question): ?>
						<li><a href="#<?php echo $questionCounter ?>" data-toggle="tab"><?php echo $questionCounter ?></a></li>
						<?php $questionCounter ++ ; ?>
					<?php endforeach; ?>
				</ul>
					<div class="tab-content">
					<?php $counter = 1; ?>
					<?php foreach ($questions as $question): ?>
						<div id="<?php echo $counter ?>" class="tab-pane fade">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<?php echo $question->questionText; ?>
								</div>
								<div class="panel-body">
									<ul class="list-group">
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option1?>"><?php echo $question->option1 ?></label></li>
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option2?>"><?php echo $question->option2 ?></label></li>
										<?php if (isset($question->option3) AND !empty($question->option3)): ?>
											<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option3?>"><?php echo $question->option3 ?></label></li>
										<?php endif; ?>
										<?php if(isset($question->option4) AND !empty($question->option4))	: ?>
											<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option4?>"><?php echo $question->option4 ?></label></li>
										<?php endif; ?>
										<?php if (!empty($question->option5)): ?> 
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option5 ?>"><?php echo $question->option5 ?></label></li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
						<?php $counter ++ ; ?>
					<?php endforeach; ?>
					</div>
				</ul>
				<!-- <?php $counter = 1; ?>
					
						<?php foreach ($questions as $question): ?>
							<div class="panel panel-primary">
								<div class="panel-heading">
									<?php echo "(" . $counter . ") " . $question->questionText; ?>
								</div>
								<div class="panel-body">
									<ul class="list-group">
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option1?>"><?php echo $question->option1 ?></label></li>
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option2?>"><?php echo $question->option2 ?></label></li>
										<?php if (isset($question->option3) AND !empty($question->option3)): ?>
											<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option3?>"><?php echo $question->option3 ?></label></li>
										<?php endif; ?>
										<?php if(isset($question->option4) AND !empty($question->option4))	: ?>
											<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option4?>"><?php echo $question->option4 ?></label></li>
										<?php endif; ?>
										<?php if (!empty($question->option5)): ?> 
										<li class="list-group-item"><label class="radio-inline"><input type="radio" name="que_<?php echo $counter ?>" value="<?php echo $question->option5 ?>"><?php echo $question->option5 ?></label></li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						
							<?php $counter++ ?>
						<?php endforeach; ?> -->
						<input type="hidden" name="status" value="test_started">
						<button type="submit" class="btn btn-primary" name="submit_test" onclick="return confirm('Are you sure you want to submit?\n Make sure you have answered ann questions before submitting')">Submit</button>
					</form>
			</div>
			<div class="col-md-4">
				<h3 class="pull-right" data-spy="affix"><span class="label label-danger" id="time"></span></h3>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var time_alloted = <?php echo $course->timeAlloted ?>;
	var one_second = 1000;
	var one_minute = 60 * one_second;
	var time = time_alloted * 60 *  one_second; 
	var auto_submit = setInterval(function(){submitform();}, 1000);
	var minutes = time_alloted - 1;
	var seconds = 59;
	
	function submitform(){
		if (time >= 0){
			time -= 1000;
			if (minutes >= 0){
				if (seconds >= 0 & seconds <= 60){
					document.getElementById('time').innerHTML = (minutes + ":" + (seconds >= 10 ?(seconds): 0 + "" + seconds));
					seconds--;
					if (seconds <= 0){
						minutes --;
						seconds = 59;
					}

				}
			}
			
		}
		else{
			document.getElementById("test_form").submit();
		}

	}
	/*window.onbeforeunload = function(){
		    event.returnValue = "Leaving this page might cause you to lose some money";
	};*/
	
</script>
<?php $this->load->view('footer'); ?>