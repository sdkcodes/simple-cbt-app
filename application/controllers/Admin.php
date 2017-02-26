<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('pagination');
		
	}

	public function index(){
		if ($this->isLoggedInAdmin()){
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			$data['total_courses'] = $this->admin_model->getNumberOfCourses();
			$data['total_students'] = $this->admin_model->getNumberOfStudents();
			$data['total_questions'] = $this->admin_model->countQuestions();
			$this->load->view('admin/dashboard', $data);
		}
		else{
			$this->session->set_flashdata("current_url", current_url());
			redirect(site_url('admin/login'));
		}
	}

	public function viewResults(){
		if ($this->isLoggedInAdmin()) {
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			$data['results'] = $this->admin_model->getResults();
			$data['totalRows'] = count($this->admin_model->getResults());
			$this->load->view('admin/results', $data);
		}
		else{
			$this->session->set_flashdata('login-message', "Log in to continue");
			$this->session->set_flashdata('current_url', current_url());
			redirect(site_url('admin/login'));
		}
	}
	public function login(){
		$this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
		if($this->form_validation->run() === FALSE){
			$data['message'] = "";
			
			$this->load->view('admin/login', $data);
			
		}
		else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$adminId = $this->admin_model->login($email, $password);
			if (isset($adminId) AND ($adminId > 0)){
				$adminDetails = $this->admin_model->getAdmin($adminId);
				$_SESSION['admin_id'] = $adminDetails->adminID;
				$_SESSION['email'] = $adminDetails->email;
				$_SESSION['admin_logged_in'] = TRUE;
				$_SESSION['role'] = "admin";
				if (isset($_SESSION['current_url'])){
					redirect($_SESSION['current_url']);
				}
				else{
					redirect(site_url('admin'));
				}
			}
			else{
				$data['message'] = "Invalid email/password combination";
				$this->load->view('admin/login', $data);
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

		if ($this->form_validation->run() === FALSE){
			$data['message'] = "";
			$this->load->view('admin/signup', $data);
		}
		else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			
			if ($this->admin_model->checkIdentity($email)){
				$data['message'] = "That email already exists";
				$this->load->view('admin/signup', $data);
				
				return;
			}
			
			$adminDetails = array('email' => $email,
				'password' => $password,
				'username' => $this->input->post('username')
			);
			

			if ($this->admin_model->signup($adminDetails)){
				
				$adminId = $this->admin_model->getAdminId($email);
				$this->session->set_flashdata("login-message", "You account has been created, Log in now");
				redirect(site_url('admin/login'));
			}
			else{
				$data['message'] = "There's an error creating your account";
				
				$this->load->view('admin/signup', $data);
			}
		}
	}

	public function addCourse(){
		if ($this->isLoggedInAdmin()){
			$this->form_validation->set_rules('title', 'Course Title', 'trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('code', 'Course Code', 'trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('time', 'Time Alloted', 'trim|required|numeric');
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			if ($this->form_validation->run() === FALSE){

				$this->load->view('admin/add_course', $data);
			}
			else{
				$courseTitle = $this->input->post('title');
				$courseCode = $this->input->post('code');
				$courseDetails = array(
					'courseTitle' => $courseTitle,
					'courseCode' => $courseCode,
					'timeAlloted' => $this->input->post('time')
					);
				if ($this->admin_model->createCourse($courseDetails)){
					$this->session->set_flashdata("message", "Course was successfully created");
					redirect("admin/viewcourses");
				}
			}
		}	
	}

	public function viewCourses(){
		if ($this->isLoggedInAdmin()){
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			
			$totalRows = $this->admin_model->getNumberOfCourses();
			$rowsPerPage = 20;
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
			$data['courses'] = $this->admin_model->getCourses($offset, $rowsPerPage);
			$this->load->view("admin/courses", $data);
		}

		else{
			$this->session->set_flashdata("message", "Log in to continue");
			redirect(site_url('admin/login'));
		}
	}

	public function viewStudents(){
		if ($this->isLoggedInAdmin()){
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			$totalRows = $this->admin_model->getNumberOfStudents();
			$rowsPerPage = 20;
			$totalPages = ceil($totalRows / $rowsPerPage);
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
			$data['totalRows'] = $totalRows;
			$data['total_pages'] = $totalPages;
			$data['current_page'] = $currentPage;
			$data['students'] = $this->admin_model->getStudents();
			$this->load->view('admin/students', $data);
		}
		else{
			$this->session->set_flashdata('login-message', "Log in to continue");
			$this->session->set_flashdata('current_url', current_url());
			redirect(site_url('admin/login'));
		}
	}
	public function deleteCourse($courseId=NULL){
		if ($this->isLoggedInAdmin()){
			if ($this->input->get('course_id') !== null){
				$this->admin_model->deleteCourse($this->input->get("course_id"));
			}
		}
	}

	public function deleteQuestion($questionId=NULL){
		if ($this->isLoggedInAdmin()){
			if ($this->input->get_post('question_id') !== null){
				$this->admin_model->deleteQuestion($this->input->get_post("question_id"));
			}
		}
	}

	public function addQuestion(){
		if ($this->isLoggedInAdmin()) {
				$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
				$data['courses'] = $this->admin_model->getCourses();
				$this->form_validation->set_rules('course_id', "Course", "trim|required|alpha_numeric_spaces");
				$this->form_validation->set_rules('question_text', 
					'Question Content', 'trim|required');
				$this->form_validation->set_rules('option_a', 
					'Option A', 'trim|required');
				$this->form_validation->set_rules('option_b', 
					'Option B', 'trim|required');
				$this->form_validation->set_rules('option_c', 
					'Option C', 'trim');
				$this->form_validation->set_rules('option_d', 
					'Option D', 'trim');
				$this->form_validation->set_rules('option_e', 
					'Option E', 'trim');
				$this->form_validation->set_rules('answer',
					'Answer', 'trim|required');
				if ($this->form_validation->run() === FALSE){
					
					$this->load->view('admin/add_question', $data);
					return;
				}
				switch ($this->input->post('answer')) {
					case 'option_a':
						# code...
						$answer = $this->input->post('option_a');
						break;
					case 'option_b':
						$answer = $this->input->post('option_b');
						break;
					case 'option_c':
						$answer = $this->input->post('option_c');
						break;
					case 'option_d':
						$answer = $this->input->post('option_d');
						break;
					case 'option_e':
						$answer = $this->input->post('option_e');
						break;
					
					default:
						# code...
						break;
				}
				$courseId = $this->input->post('course_id');
				$data = array(
					'questionText' => $this->input->post('question_text'),
					'option1' => $this->input->post('option_a'),
					'option2' => $this->input->post('option_b'),
					'option3' => $this->input->post('option_c'),
					'option4' => $this->input->post('option_d'),
					'option5' => $this->input->post('option_e'),
					'answer' => $answer,
					
					'courseID' => $courseId
					
					);
				
				if ($this->admin_model->addQuestion($data)){
					$this->session->set_flashdata('message', "Question Added");
					redirect(site_url("admin/addQuestion/"));
					return;
				}
		}
		else{
			$this->session->set_flashdata("current_url", current_url());
			$this->session->set_flashdata("login-message", "Login to continue");
			redirect("admin/login");
		}

	}

	public function editQuestion($questionId = NULL){
		if ($this->isLoggedInAdmin()) {
				$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
				$data['courses'] = $this->admin_model->getCourses();
				$this->form_validation->set_rules('course_id', "Course", "trim|required|alpha_numeric_spaces");
				$this->form_validation->set_rules('question_text', 
					'Question Content', 'trim|required');
				$this->form_validation->set_rules('option_a', 
					'Option A', 'trim|required');
				$this->form_validation->set_rules('option_b', 
					'Option B', 'trim|required');
				$this->form_validation->set_rules('option_c', 
					'Option C', 'trim');
				$this->form_validation->set_rules('option_d', 
					'Option D', 'trim');
				$this->form_validation->set_rules('option_e', 
					'Option E', 'trim');
				$this->form_validation->set_rules('answer',
					'Answer', 'trim|required');
				$data['question'] = $this->admin_model->getQuestion($questionId);
				if ($this->form_validation->run() === FALSE){
					
					$this->load->view('admin/edit_question', $data);
					return;
				}
				switch ($this->input->post('answer')) {
					case 'option_a':
						# code...
						$answer = $this->input->post('option_a');
						break;
					case 'option_b':
						$answer = $this->input->post('option_b');
						break;
					case 'option_c':
						$answer = $this->input->post('option_c');
						break;
					case 'option_d':
						$answer = $this->input->post('option_d');
						break;
					case 'option_e':
						$answer = $this->input->post('option_e');
						break;
					
					default:
						# code...
						break;
				}
				$courseId = $this->input->post('course_id');
				$courseDetails = array(
					'questionID' => $data['question']->questionID,
					'questionText' => $this->input->post('question_text'),
					'option1' => $this->input->post('option_a'),
					'option2' => $this->input->post('option_b'),
					'option3' => $this->input->post('option_c'),
					'option4' => $this->input->post('option_d'),
					'option5' => $this->input->post('option_e'),
					'answer' => $answer,
					'courseID' => $courseId
					
					);
				
				if ($this->admin_model->updateQuestion($courseDetails)){
					$this->session->set_flashdata('message', "Question updated");
					redirect(site_url("admin/viewQuestions/"));
					return;
				}
		}
		else{
			$this->session->set_flashdata("current_url", current_url());
			$this->session->set_flashdata("login-message", "Login to continue");
			redirect("admin/login");
		}

	}

	public function editCourse($courseId = NULL){
		if ($this->isLoggedInAdmin()){
			$this->form_validation->set_rules('title', 'Course Title', 'trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('code', 'Course Code', 'trim|required|alpha_numeric_spaces');
			$this->form_validation->set_rules('time', 'Time Alloted', 'trim|required|numeric');
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			$course = $this->admin_model->getCourse($courseId);
			
			if ($this->form_validation->run() === FALSE){
				
				$data = array('title' => $course->courseTitle,
					'code' => $course->courseCode,
					'time' => $course->timeAlloted, 
					);
				$this->load->view('admin/edit_course', $data);
			}
			else{
				$courseTitle = $this->input->post('title');
				$courseCode = $this->input->post('code');
				$courseDetails = array(
					'courseID' => $course->courseID,
					'courseTitle' => $courseTitle,
					'courseCode' => $courseCode,
					'timeAlloted' => $this->input->post('time')
					);
				if ($this->admin_model->updateCourse($courseDetails)){
					$this->session->set_flashdata("message", "Course was successfully updated");
					redirect("admin/viewcourses");
				}
			}
		}
	}
	public function viewQuestions(){
		if ($this->isLoggedInAdmin()){
			$totalRows = $this->admin_model->countQuestions();
			$rowsPerPage = 20;
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
			$data['questions'] = $this->admin_model->getQuestions($rowsPerPage, $offset);
			$offset = ($currentPage - 1) * $rowsPerPage;
			$data['total_pages'] = $totalPages;
			$data['current_page'] = $currentPage;
			$data['total_rows'] = $totalRows;
			$data['admin'] = $this->admin_model->getAdmin($_SESSION['admin_id']);
			$this->load->view('admin/questions', $data);
		}	
		else{
			$this->session->set_flashdata("message", "Login to continue");
			$this->session->set_flashdata('current_url', current_url());
			redirect(site_url('admin/login'));
		}
	}

	public function isLoggedInAdmin(){
		if (isset($_SESSION['admin_logged_in']) AND $_SESSION['role'] == "admin"){
			return TRUE;
		}
	}

	public function logout(){
		if ($this->isLoggedInAdmin()){
			session_destroy();
			redirect('admin/login');
		}
	}

}