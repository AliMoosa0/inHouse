<?php
class Discussions
{
	private $discID;
	private $discTitle;
	private $discBookName;
	private $discBookPic;
	private $discBody;
	private $voteUps;
	private $createdBy;
	private $publishDate;
	// Constructor 
	public function __construct()
	{
		$this->discID = null;
		$this->discTitle = null;
		$this->discBookName = null;
		$this->discBookPic = null;
		$this->discBody = null;
		$this->voteUps = null;
		$this->createdBy = null;
		$this->publishDate = null;
	}

	// Setters
	public function setDiscID($discID)
	{
		$this->discID = $discID;
	}

	public function setDiscTitle($discTitle)
	{
		$this->discTitle = $discTitle;
	}

	public function setDiscBookName($discBookName)
	{
		$this->discBookName = $discBookName;
	}

	public function setDiscBookPic($discBookPic)
	{
		$this->discBookPic = $discBookPic;
	}

	public function setDiscBody($discBody)
	{
		$this->discBody = $discBody;
	}

	public function setVoteUps($voteUps)
	{
		$this->voteUps = $voteUps;
	}

	public function setCreatedBy($createdBy)
	{
		$this->createdBy = $createdBy;
	}

	public function setPublishDate($publishDate)
	{
		$this->publishDate = $publishDate;
	}

	// Getters
	public function getDiscID()
	{
		return $this->discID;
	}

	public function getDiscTitle()
	{
		return $this->discTitle;
	}

	public function getDiscBookName()
	{
		return $this->discBookName;
	}

	public function getDiscBookPic()
	{
		return $this->discBookPic;
	}

	public function getDiscBody()
	{
		return $this->discBody;
	}

	public function getVoteUps()
	{
		return $this->voteUps;
	}

	public function getCreatedBy()
	{
		return $this->createdBy;
	}

	public function getPublishDate()
	{
		return $this->publishDate;
	}



	public function getAllDisc()
	{
		$db = Database::getInstance();
		$data = $db->multiFetch('SELECT * FROM discussions ORDER BY publishDate DESC');
		return $data;
	}
	public function addDisc()
	{
		try {
			$db = Database::getInstance();
			$query = "INSERT INTO discussions (discID, discTitle, discBookName, discBookPic, discBody, voteUps, createdBy, publishDate)
			 VALUES (null, '$this->discTitle', '$this->discBookName', '$this->discBookPic', '$this->discBody', '$this->voteUps', '$this->createdBy', NOW())";
			$db->querySQL($query);
			return true;
		} catch (Exception $e) {
			echo 'Exception: ' . $e->getMessage();
			echo 'Error: Unable to execute the query.';

			return false;
		}

	}





}