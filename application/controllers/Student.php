<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller{
	public function  __construct(){
		parent::__construct();
		$this->load->model('student_model');
	}

	public function index(){
		if ($this->isLoggedIn()){
			$data['student'] = $this->student_model->getStudent($_SESSION['student_id']);
			$data['courses'] = $this->student_model->getCourses();
			$this->load->view('student/dashboard', $data);
		}
		else{
			$this->session->set_flashdata("current_url", current_url());
			redirect(site_url('student/login'));
		}
	}

	public function login(){
		$this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
		if($this->form_validation->run() === FALSE){
			$data['message'] = "";
			
			$this->load->view('student/login', $data);
			
		}
		else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$studentId = $this->student_model->login($email, $password);
			if (isset($studentId) AND ($studentId > 0)){
				$studentDetails = $this->student_model->getStudent($studentId);
				$_SESSION['student_id'] = $studentDetails->studentID;
				$_SESSION['email'] = $studentDetails->email;
				$_SESSION['logged_in'] = TRUE;
				$_SESSION['role'] = "student";
				if (isset($_SESSION['current_url'])){
					redirect($_SESSION['current_url']);
				}
				else{
					redirect(site_url('student'));
				}
			}
			else{
				$data['message'] = "Invalid email/password combination";
				$this->load->view('student/login', $data);
			}
		}
	}

	public function signup(){
		
		$this->form_validation->set_rules('username', 
			'Username', 'trim|required|min_length[3]|alpha_dash');
		
		$this->form_validation->set_rules('email', "Email", 
			"trim|required|valid_email");
		$this->form_validation->set_rules('password', "Password",
			"trim|required");
		$this->form_validation->set_rules('firstname', "First Name", 
			"trim|required|alpha_dash");
		$this->form_validation->set_rules('lastname', "Last Name",
			"trim|required|alpha_dash");
		$this->form_validation->set_rules('matric', 'Matric No', 'trim|required');
		$this->form_validation->set_rules('level', 'Level', 'trim|required');
		$this->form_validation->set_rules('dept', "Department", "trim|required|alpha_numeric_spaces");
		$this->form_validation->set_rules('faculty', "Faculty", "trim|required|alpha_numeric_spaces");

		$data['levels'] = $this->student_model->getLevels();

		if ($this->form_validation->run() === FALSE){
			$data['message'] = "";
			$this->load->view('student/signup', $data);
		}
		else{

			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			
			if ($this->student_model->checkIdentity($email)){
				$data['message'] = "That email already exists";
				
				//$this->load->view('header');
				$this->load->view('student/signup', $data);
				//$this->load->view('footer');
				
				return;
			}
			
			$studentDetails = array('email' => $email,
				'password' => $password,
				'firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				'matric' => $this->input->post('matric'),
				'dept' => $this->input->post('dept'),
				'faculty' => $this->input->post('faculty')
			);
			

			if ($this->student_model->signup($studentDetails)){
				
				$studentId = $this->student_model->getStudentId($email);
				$this->session->set_flashdata('account_verified', "Your account has been created, you can login now");
				redirect(site_url('student/login'));
			}
			else{
				$data['message'] = "There's an error creating your account";
				
				$this->load->view('student/signup', $data);
			}
		}
	}

	public function takeExam($courseId=NULL){
		if ($this->isLoggedIn()) {
			if (is_null($courseId)){
				exit("An error occured");
			}
			$totalRows = count($this->student_model->getQuestions($courseId));
			$rowsPerPage = 1;
			$totalPages = ceil($totalRows/$rowsPerPage);
			if (isset($_GET['current_page']) AND is_numeric($_GET['current_page'])){
				$currentPage = $_GET['current_page'];
			}
			else{
				$currentPage = 1;
			}

			if ($currentPage > $totalPages)
				$currentPage = $totalPages;
			if ($currentPage < 1)
				$currentPage = 1;
			$offset = ($currentPage - 1) * $rowsPerPage;
			
			$data['total_pages'] = $totalPages;
			$data['current_page'] = $currentPage;
			$data['totalRows'] = $totalRows;
			$data['questions'] = $this->student_model->getQuestions($courseId);

			$data['student'] = $this->student_model->getStudent($_SESSION['student_id']);
			//$data['questions'] = $this->student_model->getQuestions($courseId);
			$data['course'] = $this->student_model->getCourse($courseId);
			if (empty($data['questions'])){
				exit("Selected course not available");
			}
			if ($this->input->post() == NULL) {
				$this->load->view('student/exam_page', $data);
			}
			else{
				$correct = 0;
				$wrong = 0;
				foreach($data['questions'] as $question){
					$answers[] = $question->answer;
				}
				foreach ($this->input->post() as $selectAnswer){
					foreach ($answers as $correctAnswer) {
						if ($selectAnswer == $correctAnswer)
							$correct++;
						else
							$wrong++;
					}
				}
				$noQuestions = count($data['questions']);

				$result['courseID'] = $data['course']->courseID;
				$result['studentID'] = $_SESSION['student_id'];
				
				$result['score'] = $correct . "/" . $noQuestions;
				
				$percentage = ($correct / $noQuestions) * 100;
				$result['percentage'] = $percentage;
				$this->student_model->addResult($result);
				redirect(site_url('student')); 
			}
		}
	}

	public function forgotPassword(){
		$this->session->set_flashdata("account_verified", "A password reset link has been sent to your email");
		redirect(site_url('student/login'));
	}

	public function updateProfile(){
		$data['student'] = $this->student_model->getStudent($_SESSION['student_id']);
		$this->load->view('student/update_profile', $data);
	}
	public function uploadProfilePic(){
		if ($this->isLoggedIn()){

				$student = $this->student_model->getStudent($_SESSION['student_id']);
				$date = date("Y-m-d H:i:s");
				$config['upload_path'] = './images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 0;
				$config['max_width'] = 0;
				$config['max_height'] = 0;
				//$config['file_name'] = $student->firstName . "" . $student->lastName . "-" . $date . ".jpg";
				$config['file_name'] = $student->email . ".jpg";
				$config['overwrite'] = TRUE;
				

				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('userfile')){
					$error = array('error' => $this->upload->display_errors("<div class='alert alert-danger'>", "</div>"));
					$this->load->view('student/update_profile', $error);
				}
				else{
					
					$data = $this->upload->data('file_name');
					$studentData['studentID'] = $student->studentID;
					$studentData['image'] = $data;
					$this->student_model->updateProfile($studentData);
					
					redirect(site_url('student'));
				}
			}
			else{
				$this->session->set_flashdata('message', "Log in to continue");
				// $this->session->set_flashdata('alert-type', 'info');
				// $this->session->set_flashdata('current_url', current_url());
				redirect(site_url('student/login'));
			}
		}
	

	public function viewResults(){
		if ($this->isLoggedIn()){
			$data['results'] = $this->student_model->getResults($_SESSION['student_id']);
			$data['student'] = $this->student_model->getStudent($_SESSION['student_id']);
			$this->load->view('student/results', $data);
		}
		else{
			$this->session->set_flashdata("account_verified", "Log in to continue");
			$this->session->set_flashdata('current_url', current_url());
			redirect(site_url('student/login'));
		}
	}
	public function isLoggedIn(){
		if (isset($_SESSION['logged_in']) AND $_SESSION['role'] == "student"){
			return TRUE;
		}
	}
	public function logout(){
		if ($this->isLoggedIn()){
			session_destroy();
			redirect('student/login');
		}
	}
}
