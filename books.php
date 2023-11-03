<?php

class Books{
    
private $bookID;
private $bookName;
private $bookAuthor;
private $publishDate;
private $bookCondition;
private $bookBarcode;
private $inStock;
private $stockCount;
private $addedByStudent;
private $addedByStaff;

	public function __constructor($bookID, $bookName, $bookAuthor, $publishDate, $bookCondition, $bookBarcode, $inStock, $stockCount, $addedByStudent, $addedByStaff) {

		$this->bookID = $bookID;
		$this->bookName = $bookName;
		$this->bookAuthor = $bookAuthor;
		$this->publishDate = $publishDate;
		$this->bookCondition = $bookCondition;
		$this->bookBarcode = $bookBarcode;
		$this->inStock = $inStock;
		$this->stockCount = $stockCount;
		$this->addedByStudent = $addedByStudent;
		$this->addedByStaff = $addedByStaff;
	}

	public function getBookID() {
		return $this->bookID;
	}

	public function setBookID($value) {
		$this->bookID = $value;
	}

	public function getBookName() {
		return $this->bookName;
	}

	public function setBookName($value) {
		$this->bookName = $value;
	}

	public function getBookAuthor() {
		return $this->bookAuthor;
	}

	public function setBookAuthor($value) {
		$this->bookAuthor = $value;
	}

	public function getPublishDate() {
		return $this->publishDate;
	}

	public function setPublishDate($value) {
		$this->publishDate = $value;
	}

	public function getBookCondition() {
		return $this->bookCondition;
	}

	public function setBookCondition($value) {
		$this->bookCondition = $value;
	}

	public function getBookBarcode() {
		return $this->bookBarcode;
	}

	public function setBookBarcode($value) {
		$this->bookBarcode = $value;
	}

	public function getInStock() {
		return $this->inStock;
	}

	public function setInStock($value) {
		$this->inStock = $value;
	}

	public function getStockCount() {
		return $this->stockCount;
	}

	public function setStockCount($value) {
		$this->stockCount = $value;
	}

	public function getAddedByStudent() {
		return $this->addedByStudent;
	}

	public function setAddedByStudent($value) {
		$this->addedByStudent = $value;
	}

	public function getAddedByStaff() {
		return $this->addedByStaff;
	}

	public function setAddedByStaff($value) {
		$this->addedByStaff = $value;
	}


















    
}