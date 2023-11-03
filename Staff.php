<?php

class Staff{

    private $staffID;
    private $staffName;
    private $email;
    private $phoneNumber;

	public function __constructor($staffID, $staffName, $email, $phoneNumber) {

		$this->staffID = $staffID;
		$this->staffName = $staffName;
		$this->email = $email;
		$this->phoneNumber = $phoneNumber;
	}

	public function getStaffID() {
		return $this->staffID;
	}

	public function setStaffID($value) {
		$this->staffID = $value;
	}

	public function getStaffName() {
		return $this->staffName;
	}

	public function setStaffName($value) {
		$this->staffName = $value;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($value) {
		$this->email = $value;
	}

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	public function setPhoneNumber($value) {
		$this->phoneNumber = $value;
	}

	
}