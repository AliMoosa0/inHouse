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
    function initWithID($orderID)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select * from orders where uid = ' . $orderID);
        $this->initWith(
            $data->orderID,
            $data->orderedBY,
            $data->cartID,
            $data->orderedBY,
        );

    }
    function findNextID($userID)
    {
        $db = Database::getInstance();
        $data = $db->singleFetch('select max(cartID) as cartID from carts where userID = ' . $userID);
        $this->orderID = $data->cartID + 10000;
    }

    function insert()
    {
        $this->findNextID($_SESSION['userID']);
        $db = Database::getInstance();
        $sql = 'insert into orders (orderID, orderedBY, cartID, orderedON)
         values (\'' . $this->orderID . '\', \'' . $this->orderedBY . '\',\'' . $this->cartID . '\',\'' . $this->orderedON . '\')';
        $db->querySQL($sql);

    }



}