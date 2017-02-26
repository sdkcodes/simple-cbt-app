<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	public function checkIdentity($identity){

		$sql = "SELECT * FROM admin WHERE email = ?";
		$query = $this->db->query($sql, array($identity));
		if ($query->num_rows() > 0){
			return $query->row()->adminID;
		}
		else{
			return 0;
		}
	}

	public function login($email, $password){
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->limit(1);
		$query = $this->db->get('admin');

		if ($query->num_rows() === 1){
			return $query->row()->adminID;
		}
	}

	public function getAdmin($adminId){
		$adminId = intval($adminId);
		$sql = "SELECT * FROM admin WHERE adminID = ?";
		$query = $this->db->query($sql, array($adminId));

		if ($query->num_rows() === 1){
			return $query->row();
		}
	}

	public function signup($data){
		if ($this->db->insert('admin', $data)){
			return TRUE ;
		}
	}

	public function getAdminId($email){
		if (!empty($email)){
			$sql = "SELECT adminID from admin
				WHERE admin.email = ?";
			$query = $this->db->query($sql, array($email));
			return $query->row()->adminID;
		}
	}

	public function updateProfile($data){
		$this->db->where('adminID', $data['adminID']);
		if ($this->db->update('admin', $data)){
			return TRUE;
		}
	}

	public function updateQuestion($data){
		$this->db->where('questionID', $data['questionID']);
		if ($this->db->update('question', $data))
			return TRUE;
	}

	public function updateCourse($data){
		$this->db->where('courseID', $data['courseID']);
		if ($this->db->update('course', $data)){
			return TRUE;
		}
	}
	public function createCourse($courseDetails){
		$this->db->insert('course', $courseDetails);
		if ($this->db->insert_id() > 0){
			return TRUE;
		}
	}

	public function deleteCourse($courseId){
		$sql = "DELETE FROM course WHERE courseID = ?";
		$query = $this->db->query($sql, array(intval($courseId)));
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}
	}

	public function deleteQuestion($questionId){
		$sql = "DELETE FROM question WHERE questionID = ?";
		$query = $this->db->query($sql, array(intval($questionId)));
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}
	}
	public function getCourses($offset=NULL, $limit=NULL){
		if (is_null($offset) OR is_null($limit)){
			//return $this->db->get('course');
			$sql = "SELECT * FROM course";
			$query = $this->db->query($sql);
			return $query->result();
		}	
			$sql = "SELECT * FROM course LIMIT ?, ?";
			$query = $this->db->query($sql, array($offset, $limit));
			if ($query->num_rows() > 0){
				return $query->result();
			}
	}

	public function getCourse($courseId){
		$this->db->where('courseID', $courseId);
		$result = $this->db->get('course');
		return $result->row();
	}

	public function getStudents($offset=NULL, $limit=NULL){
		if (is_null($offset) OR is_null($limit)){
			//return $this->db->get('course');
			$sql = "SELECT * FROM student";
			$query = $this->db->query($sql);
			return $query->result();
		}	
			$sql = "SELECT * FROM student ? ?";
			$query = $this->db->query($sql, array($offset, $limit));
			if ($query->num_rows() > 0){
				return $query->result();
			}
	}

	public function addQuestion($data){
		$this->db->insert('question', $data);
		if ($this->db->insert_id() > 0){
			return TRUE;
		}
	}
	public function getNumberOfCourses(){
		return $this->db->count_all("course");
	}

	public function getNumberOfStudents(){
		return $this->db->count_all("student");
	}

	public function countQuestions(){
		return $this->db->count_all('question');
	}
	public function getQuestions($limit=NULL, $offset=NULL){
		$sql = "SELECT * FROM question JOIN course ON course.courseID = question.courseID LIMIT ?, ?";

		$query = $this->db->query($sql, array($offset, $limit));
		return $query->result();
	}

	public function getQuestion($questionId){
		$this->db->where('questionID', $questionId);
		$this->db->join('course', 'question.courseID = course.courseID');
		$result = $this->db->get('question');
		return $result->row();
	}

	public function getResults(){
		$this->db->join('course', 'result.courseID = course.courseID');
		$this->db->join('student', 'result.studentID = student.studentID');
		
		$query = $this->db->get('result');
		return $query->result();
	}

}