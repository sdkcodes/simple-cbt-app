<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkIdentity($identity){

		$sql = "SELECT * FROM student WHERE email = ?";
		$query = $this->db->query($sql, array($identity));
		if ($query->num_rows() > 0){
			return $query->row()->studentID;
		}
		else{
			return 0;
		}
	}

	public function login($email, $password){
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->limit(1);
		$query = $this->db->get('student');

		if ($query->num_rows() === 1){
			return $query->row()->studentID;
		}
	}

	public function getLevels(){
		$sql = "SELECT * FROM level";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getCourses(){
		$sql = "SELECT * FROM course";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function signup($data){
		if ($this->db->insert('student', $data)){
			return TRUE ;
		}
	}
	public function getCourse($courseId){
		if(!is_null($courseId)){
			$this->db->where('courseID', $courseId);
			$query = $this->db->get('course');
			return $query->row();
		}
	}
	public function getStudentId($email){
		if (!empty($email)){
			$sql = "SELECT studentID from student
				WHERE email = ?";
			$query = $this->db->query($sql, array($email));
			return $query->row()->studentID;
		}
	}

	public function getStudent($studentId){
		$studentId = intval($studentId);
		$sql = "SELECT * FROM student WHERE studentID = ?";
		$query = $this->db->query($sql, array($studentId));

		if ($query->num_rows() === 1){
			return $query->row();
		}
	}

	public function addResult($data){
		$this->db->insert('result', $data);
	}

	public function getResults($studentId){
		$this->db->where('student.studentID', $studentId);
		$this->db->join('course', 'result.courseID = course.courseID');
		$this->db->join('student', 'result.studentID = student.studentID');
		
		$query = $this->db->get('result');
		return $query->result();
	}
	public function getQuestions($courseId){
		if (is_null($courseId)){
			exit('No data provided');
		}
		$this->db->where('courseID', $courseId);
		$this->db->order_by('questionText', 'RANDOM');
		$result = $this->db->get('question');
		return $result->result();
	}

	public function updateProfile($data){
		$this->db->where('studentID', $data['studentID']);
		$this->db->update('student', $data);
		return $this->db->affected_rows();
	}
}
