<?php

class Books{
    
private $bookID;
private $bookName;
private $bookAuthor;
private $bookCategory;
private $bookPicture;
private $publishDate;
private $bookCondition;
private $bookBarcode;
private $inStock;





	public function __constructor($bookID, $bookName, $bookAuthor, $bookCategory, $bookPicture, $publishDate, $bookCondition, $bookBarcode, $inStock) {

		$this->bookID = $bookID;
		$this->bookName = $bookName;
		$this->bookAuthor = $bookAuthor;
		$this->bookCategory = $bookCategory;
		$this->bookPicture = $bookPicture;
		$this->publishDate = $publishDate;
		$this->bookCondition = $bookCondition;
		$this->bookBarcode = $bookBarcode;
		$this->inStock = $inStock;
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

	public function getBookCategory() {
		return $this->bookCategory;
	}

	public function setBookCategory($value) {
		$this->bookCategory = $value;
	}

	public function getBookPicture() {
		return $this->bookPicture;
	}

	public function setBookPicture($value) {
		$this->bookPicture = $value;
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






	public function getAllBooks() {
		$db = Database::getInstance();
		$data = $db->multiFetch('SELECT * FROM books');
        return $data;
    }

	public function initWith($bookID, $bookName, $bookAuthor, $bookCategory, $bookPicture, $publishDate, $bookCondition, $bookBarcode, $inStock, $addedBy)
    {
        $this->articleID = $bookID;
        $this->title = $bookName;
        $this->category = $bookAuthor;
        $this->text = $bookCategory;
        $this->status = $bookPicture;
        $this->publishedBy = $publishDate;
        $this->publishDate = $bookCondition;
        $this->publishDate = $bookBarcode;
        $this->publishDate = $inStock;
        $this->publishDate = $addedBy;
        
    }


	function initWithId($id)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select * from books where BookID = ' . $id);
        $this->initWith($data->bookID, $data->bookName, $data->bookAuthor, $data->bookCategory, $data->bookPicture, $data->publishDate, $data->bookCondition, $data->bookBarcode, $data->inStock, $data->addedBy);
    }



	public function isValid()
	{
		$errors = true;
		if (empty($this->bookAuthor)) {
			$errors = false;
		}
		if (empty($this->bookName)) {
			$errors = false;
		}
		if (empty($this->bookCategory)) {
			$errors = false;
		}
		if (empty($this->bookPicture)) {
			$errors = false;
		}
		if (empty($this->bookCondition)) {
			$errors = false;
		}
		if (empty($this->inStock)) {
			$errors = false;
		}
		
		
		return $errors;
	}
}