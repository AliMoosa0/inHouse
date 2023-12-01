<?php
class likes
{

    private $likeID;
    private $likeON;
    private $likeBY;


    public function __construct()
    {
        $this->likeID = null;
        $this->likeON = null;
        $this->likeBY = null;
    }

    public function getLikeID()
    {
        return $this->likeID;
    }

    public function setLikeID($value)
    {
        $this->likeID = $value;
    }

    public function getLikeON()
    {
        return $this->likeON;
    }

    public function setLikeON($value)
    {
        $this->likeON = $value;
    }

    public function getLikeBY()
    {
        return $this->likeBY;
    }

    public function setLikeBY($value)
    {
        $this->likeBY = $value;
    }

    public function initWithId($id)
    {
        $this->likeID = $id;
        $this->load();
    }

    public function load()
    {
        $sql = "SELECT * FROM likes WHERE likeID = " . $this->likeID;
        $db = Database::getInstance();
        $row = $db->singleFetch($sql);
        $this->likeON = $row['likeON'];
        $this->likeBY = $row['likeBY'];
    }

    public function save()
    {
        $db = Database::getInstance();
        $db->querySql("update likes set likeON = '" . $this->likeON . "', likeBY = '" . $this->likeBY . "' where likeID = " . $this->likeID);
        return true;
    }

    public function delete()
    {
        $sql = "DELETE FROM likes WHERE likeID = " . $this->likeID;
        $db = Database::getInstance();
        $db->querySQL($sql);
        return true;
    }

    public function insert()
    {
        $sql = "INSERT INTO likes (likeON, likeBY) VALUES ('" . $this->likeON . "', '" . $this->likeBY . "')";
        $db = Database::getInstance();
        $db->querySQL($sql);
        return true;
    }
    


public function getNumberOfLikes()
{
    $sql = "SELECT COUNT(*) AS numLikes FROM likes WHERE likeON = '" . $this->likeON . "'";
    $db = Database::getInstance();
    $row = $db->singleFetch($sql);
    return $row['numLikes'];
}

}