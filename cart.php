<?php
class Cart
{
    private $cartID;
    private $userID;
    private $bookID;
    private $price;
    private $bookName;
    private $bookPic;
    private $status;

    // Constructor
    public function __construct()
    {
        $this->cartID = null;
        $this->userID = null;
        $this->bookID = null;
        $this->price = null;
        $this->bookName = null;
        $this->bookPic = null;
        $this->status = null;
    }

    // Setters
    public function setCartID($cartID)
    {
        $this->cartID = $cartID;
    }

    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    public function setBookID($bookID)
    {
        $this->bookID = $bookID;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setBookName($bookName)
    {
        $this->bookName = $bookName;
    }

    public function setBookPic($bookPic)
    {
        $this->bookPic = $bookPic;
    }
    public function setstatus($status)
    {
        $this->status = $status;
    }

    // Getters
    public function getCartID()
    {
        return $this->cartID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getBookID()
    {
        return $this->bookID;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getBookName()
    {
        return $this->bookName;
    }

    public function getBookPic()
    {
        return $this->bookPic;
    }
    public function getStatus()
    {
        return $this->status;
    }
    function initWith($userId, $bookID, $bookName, $price, $bookPic, $status)
    {
        $this->userId = $userId;
        $this->bookID = $bookID;
        $this->bookName = $bookName;
        $this->price = $price;
        $this->bookPic = $bookPic;
        $this->status = $status;

    }

    function addToCart($Bookid)
    {
        $db = Database::getInstance();
        $sql = "INSERT INTO carts (cartID, userID, bookID, price, bookName, bookPic, status ) VALUES (null, '$this->userId', '$this->bookID', '$this->price', '$this->bookName', '$this->bookPic', 'show')";
        // var_dump($sql);
        // die();
        $db->querySQL($sql);

        return true;
        
    }


    function getCart($userID)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM carts where userID = $userID and status = 'show'";
        // var_dump($sql);
        // die();
        $data = $db->multiFetch($sql);
        return $data;
    }

    function deleteItem($cartID)
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM carts WHERE cartID = $cartID";
        $db->querySQL($sql);
        return true;
    }

    function deleteCart()
    {
        $db = Database::getInstance();
        $sql = "DELETE * FROM carts WHERE userID = $this->userId";
        $db->querySQL($sql);
        return true;
    }

    function getTotal($userID)
    {
        $db = Database::getInstance();
        $sql = "SELECT SUM(price) as total FROM carts WHERE userID = $userID and status = 'show'";
        $data = $db->singleFetch($sql);
        return $data;
    }



}
