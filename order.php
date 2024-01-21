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
    function listOfCarts()
    {
        $db = Database::getInstance();
        $query = 'select * from carts where userID = ' . $_SESSION['uid'] . ' and status = "show"';

        $data = $db->multiFetch($query);

        return $data;

    }

    function insert()
    {
        $this->findNextID($_SESSION['uid']);

        $data = $this->listOfCarts();
        foreach ($data as $cart) {
            $db = Database::getInstance();
            $sql = 'insert into orders (orderID, orderedBY, cartID, orderStatus , orderedON)
            values (\'' . $this->orderID . '\', \'' . $cart->userID . '\', \'' . $cart->cartID . '\', "Placed" ,   NOW() )';
            $db->querySQL($sql);
            $update = 'update carts set status = "hide" where cartID = ' . $cart->cartID;
            $db->querySQL($update);
            
            $updateBook = 'update books set inStock = 0 where bookID = ' . $cart->bookID;
            $db->querySQL($updateBook);
        }
        return true;
    }

    function getOrders()
    {
        $db = Database::getInstance();
        $data = $db->multiFetch("SELECT DISTINCT 
        b.*, 
        c.userID AS cartUserID, 
        o.orderStatus, 
        o.orderID,
        u1.phoneNumber, 
        u2.username 
    FROM 
        books b
    INNER JOIN 
        carts c ON b.bookID = c.bookID
    INNER JOIN 
        orders o ON c.cartID = o.cartID
    INNER JOIN 
        users u1 ON u1.uid = c.userID 
    INNER JOIN 
        users u2 ON u2.uid = c.userID 
    WHERE 
        b.addedBy = " . $_SESSION['uid']
        );
    
        return $data;
    }
    

    function changeState($bookID, $state)
    {
        $db = Database::getInstance();
        $sql = 'UPDATE orders 
                SET orderStatus = "' . $state . '" 
                WHERE cartID IN (
                    SELECT cartID 
                    FROM carts 
                    WHERE bookID = ' . $bookID . '
                )';

        $db->querySQL($sql);

        return true;
    }






}