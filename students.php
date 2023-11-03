<?php
class Students{
private $srudentID;
private $studentName;
private $email;
private $Password;
private $phoneNumber;

	public function __constructor($srudentID, $studentName, $email, $Password, $phoneNumber) {

		$this->srudentID = $srudentID;
		$this->studentName = $studentName;
		$this->email = $email;
		$this->Password = $Password;
		$this->phoneNumber = $phoneNumber;
	}

	public function getSrudentID() {
		return $this->srudentID;
	}

	public function setSrudentID($value) {
		$this->srudentID = $value;
	}

	public function getStudentName() {
		return $this->studentName;
	}

	public function setStudentName($value) {
		$this->studentName = $value;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($value) {
		$this->email = $value;
	}

	public function getPassword() {
		return $this->Password;
	}

	public function setPassword($value) {
		$this->Password = $value;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($value) {
		$this->phoneNumber = $value;
	}
}