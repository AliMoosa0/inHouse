<?php 

class Logs{

private $logID;
private $logTitle;
private $logBody;
private $logDateTime;
private $studentID;
private $staffID;

	public function __constructor($logID, $logTitle, $logBody, $logDateTime, $studentID, $staffID) {

		$this->logID = $logID;
		$this->logTitle = $logTitle;
		$this->logBody = $logBody;
		$this->logDateTime = $logDateTime;
		$this->studentID = $studentID;
		$this->staffID = $staffID;
	}

	public function getLogID() {
		return $this->logID;
	}

	public function setLogID($value) {
		$this->logID = $value;
	}

	public function getLogTitle() {
		return $this->logTitle;
	}

	public function setLogTitle($value) {
		$this->logTitle = $value;
	}

	public function getLogBody() {
		return $this->logBody;
	}

	public function setLogBody($value) {
		$this->logBody = $value;
	}

	public function getLogDateTime() {
		return $this->logDateTime;
	}

	public function setLogDateTime($value) {
		$this->logDateTime = $value;
	}

	public function getStudentID() {
		return $this->studentID;
	}

	public function setStudentID($value) {
		$this->studentID = $value;
	}

	public function getStaffID() {
		return $this->staffID;
	}

	public function setStaffID($value) {
		$this->staffID = $value;
	}

	
}