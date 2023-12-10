<?php

class order
{

    private $orderID;
    private $orderedBY;
    private $cartID;
    private $orderedON;

    public function __construct()
    {
        $this->orderID = null;
        $this->orderedBY = null;
        $this->cartID = null;
        $this->orderedON = null;
    }

    public function getOrderID()
    {
        return $this->orderID;
    }

    public function setOrderID($value)
    {
        $this->orderID = $value;
    }

    public function getOrderedBY()
    {
        return $this->orderedBY;
    }

    public function setOrderedBY($value)
    {
        $this->orderedBY = $value;
    }

    public function getCartID()
    {
        return $this->cartID;
    }

    public function setCartID($value)
    {
        $this->cartID = $value;
    }

    public function getOrderedON()
    {
        return $this->orderedON;
    }

    public function setOrderedON($value)
    {
        $this->orderedON = $value;
    }

    function initWith($orderID, $orderedBY, $cartID, $orderedON)
    {
        $this->orderID = $orderID;
        $this->orderedBY = $orderedBY;
        $this->cartID = $cartID;
        $this->orderedON = $orderedON;

    }
    function initWithID()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('select * from orders where orderedBY = ' . $_SESSION['uid']);
        // $this->initWith(
        //     $data->orderID,
        //     $data->orderedBY,
        //     $data->cartID,
        //     $data->orderedBY
        // );
        return $data;

    }

    function findNextID($userID)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select max(cartID) as cartID from carts where userID = ' . $userID);
        $this->orderID = $data->cartID + 10000;
    }
    function listOfCarts($userID)
    {
        $db = Database::getInstance();
        $data = $db->multiFetch('select * from carts where userID = ' . $userID);
        return $data;

    }

    function insert()
    {
        $this->findNextID($_SESSION['uid']);
        // var_dump($this->orderID);
        // die();
        $data = $this->listOfCarts($_SESSION['uid']);
        foreach ($data as $cart) {
            $db = Database::getInstance();
            $sql = 'insert into orders (orderID, orderedBY, cartID, orderStatus , orderedON)
            values (\'' . $this->orderID . '\', \'' . $cart->userID . '\', \'' . $cart->cartID . '\', "Placed" ,   NOW() )';
            $db->querySQL($sql);
            $update = 'update carts set status = "hide" where cartID = ' . $cart->cartID;
            $db->querySQL($update);
            //TODO: update the status of the book to sold
        }
        return true;
    }


}