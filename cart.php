<?php
class Cart {
    private $cartID;
    private $userID;
    private $bookID;
    private $price;
    private $bookName;
    private $bookPic;

    // Constructor
    public function __construct() {
        $this->cartID = null;
        $this->userID = null;
        $this->bookID = null;
        $this->price = null;
        $this->bookName = null;
        $this->bookPic = null;
    }

    // Setters
    public function setCartID($cartID) {
        $this->cartID = $cartID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setBookID($bookID) {
        $this->bookID = $bookID;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setBookName($bookName) {
        $this->bookName = $bookName;
    }

    public function setBookPic($bookPic) {
        $this->bookPic = $bookPic;
    }

    // Getters
    public function getCartID() {
        return $this->cartID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getBookID() {
        return $this->bookID;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getBookName() {
        return $this->bookName;
    }

    public function getBookPic() {
        return $this->bookPic;
    }
    function initWith($userId, $bookID, $bookName, $price, $bookPic) {
        $this->userId = $userId;
        $this->bookID = $bookID;
        $this->bookName = $bookName;
        $this->price = $price;
        $this->bookPic = $bookPic;
    }

    function addToCart($Bookid) {
        $db = Database::getInstance();
        //         var_dump($this->userId, $this->bookID . $this->price . $this->bookName . $this->bookPic);
// die();
        $sql = "INSERT INTO carts (cartID, userID, bookID, price, bookName, bookPic) VALUES (null, '$this->userId', '$this->bookID', '$this->price', '$this->bookName', '$this->bookPic')";
        // var_dump($sql);
        // die();
        $db->querySQL($sql);

        return true;
    }


    function getCart($userID) {
        $db = Database::getInstance();
        $sql = "SELECT * FROM carts where userID = $userID";
        // var_dump($sql);
        // die();
        $data = $db->multiFetch($sql);
        return $data;
    }

    function deleteItem($cartID) {
        $db = Database::getInstance();
        $sql = "DELETE FROM carts WHERE cartID = $cartID";
        $db->querySQL($sql);
        return true;
    }

    function deleteCart() {
        $db = Database::getInstance();
        $sql = "DELETE * FROM carts WHERE userID = $this->userId";
        $db->querySQL($sql);
        return true;
    }

    function getTotal($userID) {
        $db = Database::getInstance();
        $sql = "SELECT SUM(price) as total FROM carts WHERE userID = $userID";
        $data = $db->singleFetch($sql);
        return $data;
    }



}
