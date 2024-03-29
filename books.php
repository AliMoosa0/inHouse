<?php

class Books
{
	

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


	public function __construct()
	{

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

	public function getBookID()
	{
		return $this->bookID;
	}

	public function setBookID($value)
	{
		$this->bookID = $value;
	}

	public function getBookName()
	{
		return $this->bookName;
	}

	public function setBookName($value)
	{
		$this->bookName = $value;
	}

	public function getBookAuthor()
	{
		return $this->bookAuthor;
	}

	public function setBookAuthor($value)
	{
		$this->bookAuthor = $value;
	}

	public function getBookCategory()
	{
		return $this->bookCategory;
	}

	public function setBookCategory($value)
	{
		$this->bookCategory = $value;
	}

	public function getBookPrice()
	{
		return $this->bookPrice;
	}

	public function setBookPrice($value)
	{
		$this->bookPrice = $value;
	}

	public function getPublishDate()
	{
		return $this->publishDate;
	}

	public function setPublishDate($value)
	{
		$this->publishDate = $value;
	}

	public function getBookCondition()
	{
		return $this->bookCondition;
	}

	public function setBookCondition($value)
	{
		$this->bookCondition = $value;
	}


	public function getBookPic()
	{
		return $this->bookPic;
	}

	public function setBookPic($value)
	{
		$this->bookPic = $value;
	}

	public function getInStock()
	{
		return $this->inStock;
	}

	public function setInStock($value)
	{
		$this->inStock = $value;
	}

	public function getAddedBy()
	{
		return $this->addedBy;
	}

	public function setAddedBy($value)
	{
		$this->addedBy = $value;
	}

	public function initWith($bookID, $bookName, $bookAuthor, $bookCategory, $bookPrice, $publishDate, $bookCondition, $bookPic, $inStock, $addedBy)
	{
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
	function getBooks()
	{
		$db = Database::getInstance();
		$data = $db->multiFetch('Select * from books where inStock = 1 order by publishDate desc');
		return $data;
	}
	public function initWithId($id)
	{
		$db = Database::getInstance();
		$data = $db->singleFetch("SELECT * FROM books WHERE BookID = $id");

		$this->initWith(
			$data->bookID,
			$data->bookName,
			$data->bookAuthor,
			$data->bookCategory,
			$data->bookPrice,
			$data->publishDate,
			$data->bookCondition,
			$data->bookPic,
			$data->inStock,
			$data->addedBy
		);
		return $data;
	}
	function getBooksByCategory($category)
	{
		$db = Database::getInstance();
		$data = $db->multiFetch("Select * from books where bookCategory = '$category' and inStock = 1 order by publishDate desc");
		return $data;
	}

	function getBooksByAddedBy($addedBy)
	{
		$db = Database::getInstance();
		$data = $db->multiFetch("Select * from books where addedBy = '$addedBy' order by publishDate desc");
		return $data;
	}


	function initWithIdOrName($keyword)
	{
		$db = Database::getInstance();
		$lowerKeyword = strtolower($keyword); // Convert keyword to lowercase
		$searchTerm = '%' . $lowerKeyword . '%'; // Add wildcards for partial matching
		$sql = "SELECT * FROM books WHERE bookID = '$keyword' OR LOWER(bookName) LIKE '$searchTerm' and inStock = 1 order by publishDate desc";
		$results = $db->multiFetch($sql);
		return $results;
	}

	function initWithIdOrNameMy($keyword)
	{
		$db = Database::getInstance();
		$lowerKeyword = strtolower($keyword); // Convert keyword to lowercase
		$searchTerm = '%' . $lowerKeyword . '%'; // Add wildcards for partial matching
		$sql = "SELECT * FROM books WHERE bookID = '$keyword' OR LOWER(bookName) LIKE '$searchTerm' AND inStock = 1 AND addedBy = '{$session['uid']}' ORDER BY publishDate DESC";
		$results = $db->multiFetch($sql);
		return $results;
	}




	function addBook()
	{
		try {

			$db = Database::getInstance();
			$query = "INSERT INTO books (bookID, bookName, bookAuthor, bookCategory, bookPrice, publishDate, bookCondition, bookPic, inStock, addedBy)
					  VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
					  $conn = new Connection();
			$connection = $conn->getConnection();
	
			$stmt = mysqli_prepare($connection, $query);
			$stmt->bind_param("sssdssssi", $this->bookName, $this->bookAuthor, $this->bookCategory, $this->bookPrice, $this->publishDate, $this->bookCondition, $this->bookPic, $this->inStock, $this->addedBy);
	
			if ($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo 'Exception: ' . $e->getMessage();
			echo 'Error: Unable to execute the query.';
			return false;
		}
	}
	






	function deleteBook()
	{
		try {
			$db = Database::getInstance();
			$db->querySql('Delete from books where bookID=' . $this->bookID);
			return true;
		} catch (Exception $e) {
			echo 'Exception: ' . $e;
			return false;
		}
	}
	function updateDB()
{
    try {
        $db = Database::getInstance();
        $query = "UPDATE books SET 
                    bookName = ?,
                    bookAuthor = ?,
                    bookCategory = ?,
                    bookPrice = ?,
                    publishDate = ?,
                    bookCondition = ?,
                    bookPic = ?,
                    inStock = ?,
                    addedBy = ?
                  WHERE bookID = ?";

$conn = new Connection();
$connection = $conn->getConnection();

$stmt = mysqli_prepare($connection, $query);

        $stmt->bind_param("sssdssssii",
		 $this->bookName,
		 $this->bookAuthor,
		  $this->bookCategory,
		   $this->bookPrice, 
		   $this->publishDate,
		    $this->bookCondition,
			 $this->bookPic, 
			 $this->inStock,
			  $this->addedBy,
			   $this->bookID);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo 'Exception: ' . $e->getMessage();
        echo 'Error: Unable to execute the query.';
        return false;
    }
}





	// public function getBookPicWithID($id) {
	// 	$db = Database::getInstance();
	// 	$data = $db->singleFetch("SELECT bookPic FROM books WHERE BookID = $id");
	// 	return $data;
	// }




	// public function isValid() {
	// 	$errors = true;
	// 	if(empty($this->bookAuthor)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->bookName)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->bookCategory)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->BookPic)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->bookCondition)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->BookPrice)) {
	// 		$errors = false;
	// 	}
	// 	if(empty($this->addedBy)) {
	// 		$errors = false;
	// 	}

	// 	return $errors;
	// }
}