<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('student/header');?>
	<title>Update Profile</title>
</head>
<?php $this->load->view('student/navbar'); ?>

<div id="page-wrapper">
	<div class="container">
		<div class="page-header">
			<h2>My Profile</h2>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p style="font-size:18px">Photo</p>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<form method="post" action="<?php echo site_url('student/uploadprofilepic') ?>" enctype="multipart/form-data">	
									<?php echo !empty($error) ? $error : "" ?>
									<input type="file" name="userfile">
									<br/> <br/>
									<button type="submit" class="btn btn-primary">Upload Pic</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>