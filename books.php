<?php

class Books{
    
private $bookID;
private $bookName;
private $bookAuthor;
private $bookCategory;
private $bookPrice;
private $publishDate;
private $bookCondition;
private $bookBarcode;
private $bookPic;
private $inStock;
private $addedBy;





	

	public function __construct($bookID, $bookName, $bookAuthor, $bookCategory, $bookPrice, $publishDate, $bookCondition, $bookBarcode, $bookPic, $inStock, $addedBy) {

		$this->bookID = $bookID;
		$this->bookName = $bookName;
		$this->bookAuthor = $bookAuthor;
		$this->bookCategory = $bookCategory;
		$this->bookPrice = $bookPrice;
		$this->publishDate = $publishDate;
		$this->bookCondition = $bookCondition;
		$this->bookBarcode = $bookBarcode;
		$this->bookPic = $bookPic;
		$this->inStock = $inStock;
		$this->addedBy = $addedBy;
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

	public function getBookBarcode() {
		return $this->bookBarcode;
	}

	public function setBookBarcode($value) {
		$this->bookBarcode = $value;
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


		public function initWith($bookID, $bookName, $bookAuthor, $bookCategory, $bookPrice, $publishDate, $bookCondition, $bookBarcode, $bookPic, $inStock, $addedBy) {
			$this->bookID = $bookID;
			$this->bookName = $bookName;
			$this->bookAuthor = $bookAuthor;
			$this->bookCategory = $bookCategory;
			$this->bookPrice = $bookPrice;
			$this->publishDate = $publishDate;
			$this->bookCondition = $bookCondition;
			$this->bookBarcode = $bookBarcode;
			$this->bookPic = $bookPic;
			$this->inStock = $inStock;
			$this->addedBy = $addedBy;
		}

	
    


		public function initWithId($id)
		{
			$db = Database::getInstance(); // Assuming you have a Database class
			$data = $db->singleFetch("SELECT * FROM books WHERE BookID = $id");
	
			if ($data) {
				$this->initWith(
					$data->BookID,
					$data->BookName,
					$data->BookAuthor,
					$data->BookCategory,
					$data->BookPrice,
					$data->PublishDate,
					$data->BookCondition,
					$data->BookBarcode,
					$data->BookPic,
					$data->InStock,
					$data->AddedBy
				);
			}
		}



	// public function isValid()
	// {
	// 	$errors = true;
	// 	if (empty($this->bookAuthor)) {
	// 		$errors = false;
	// 	}
	// 	if (empty($this->bookName)) {
	// 		$errors = false;
	// 	}
	// 	if (empty($this->bookCategory)) {
	// 		$errors = false;
	// 	}
	// 	if (empty($this->bookPicture)) {
	// 		$errors = false;
	// 	}
	// 	if (empty($this->bookCondition)) {
	// 		$errors = false;
	// 	}
	// 	if (empty($this->inStock)) {
	// 		$errors = false;
	// 	}
		
		
	// 	return $errors;
	// }
}