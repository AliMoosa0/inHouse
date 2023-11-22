<?php

class Books{
    
private $bookID;
private $bookName;
private $bookAuthor;
private $bookCategory;
private $bookPrice;
private $publishDate;
private $bookCondition;
private $bookPic;
private $inStock;
private $addedBy;





	

	public function __construct() {

		$this->bookID = null;
		$this->bookName = null;
		$this->bookAuthor = null;
		$this->bookCategory = null;
		$this->bookPrice = null;
		$this->publishDate = null;
		$this->bookCondition = null;
		$this->bookBarcode = null;
		$this->bookPic = null;
		$this->inStock = null;
		$this->addedBy = null;
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

	public function getBookPrice() {
		return $this->bookPrice;
	}

	public function setBookPrice($value) {
		$this->bookPrice = $value;
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


	public function getBookPic() {
		return $this->bookPic;
	}

	public function setBookPic($value) {
		$this->bookPic = $value;
	}

	public function getInStock() {
		return $this->inStock;
	}

	public function setInStock($value) {
		$this->inStock = $value;
	}

	public function getAddedBy() {
		return $this->addedBy;
	}

	public function setAddedBy($value) {
		$this->addedBy = $value;
	}


		public function initWith($bookID, $bookName, $bookAuthor, $bookCategory, $bookPrice, $publishDate, $bookCondition, $bookPic, $inStock, $addedBy) {
			$this->bookID = $bookID;
			$this->bookName = $bookName;
			$this->bookAuthor = $bookAuthor;
			$this->bookCategory = $bookCategory;
			$this->bookPrice = $bookPrice;
			$this->publishDate = $publishDate;
			$this->bookCondition = $bookCondition;
			$this->bookPic = $bookPic;
			$this->inStock = $inStock;
			$this->addedBy = $addedBy;
		}	
		function getBooks() {
			$db = Database::getInstance();
			$data = $db->multiFetch('Select * from books where inStock = 1 order by publishDate desc');
			return $data;
		}

		public function getUserNameWithID($id){
			$db = Database::getInstance(); 
			$data = $db->singleFetch("SELECT * FROM users WHERE username = $id");
		}
		
	

		public function deleteBook($id)
		{
			$db = Database::getInstance();
			$db->query("DELETE FROM books WHERE BookID = $id");
		}
		
		public function updateBook($id)
		{
			$db = Database::getInstance();
			$db->query("UPDATE books SET BookName = '$this->bookName', BookAuthor = '$this->bookAuthor', BookCategory = '$this->bookCategory', BookPrice = '$this->bookPrice', PublishDate = '$this->publishDate', BookCondition = '$this->bookCondition', BookPic = '$this->bookPic', InStock = '$this->inStock', AddedBy = '$this->addedBy' WHERE BookID = $id");
		}
    


		public function initWithId($id)
		{
			$db = Database::getInstance(); 
			$data = $db->singleFetch("SELECT * FROM books WHERE BookID = $id");

			if ($data) {
				return $data; // Return the fetched data
			} else {
				return false; // Return false if no data found
			}
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
		if (empty($this->BookPic)) {
			$errors = false;
		}
		if (empty($this->bookCondition)) {
			$errors = false;
		}
		if (empty($this->BookPrice)) {
			$errors = false;
		}
		if (empty($this->addedBy)) {
			$errors = false;
		}
		
		return $errors;
	}
}