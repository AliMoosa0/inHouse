<?php
class Comments
{
	private $commentID;
	private $commentedBY;
	private $discID;
	private $uid;
	private $comment;
	private $commentedAT;





	public function __construct()
	{

		$this->commentID = null;
		$this->commentedBY = null;
		$this->discID = null;
		$this->uid = null;
		$this->comment = null;
		$this->commentedAT = null;
	}

	public function getCommentID()
	{
		return $this->commentID;
	}

	public function setCommentID($value)
	{
		$this->commentID = $value;
	}

	public function getCommentedBY()
	{
		return $this->commentedBY;
	}

	public function setCommentedBY($value)
	{
		$this->commentedBY = $value;
	}

	public function getDiscID()
	{
		return $this->discID;
	}

	public function setDiscID($value)
	{
		$this->discID = $value;
	}

	public function getUid()
	{
		return $this->uid;
	}

	public function setUid($value)
	{
		$this->uid = $value;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function setComment($value)
	{
		$this->comment = $value;
	}

	public function getCommentedAT()
	{
		return $this->commentedAT;
	}

	public function setCommentedAT($value)
	{
		$this->commentedAT = $value;
	}


	function initWith($commentID, $commentedBY, $discID, $uid, $comment, $commentedAT)
	{
		$this->commentID = $commentID;
		$this->commentedBY = $commentedBY;
		$this->discID = $discID;
		$this->uid = $uid;
		$this->comment = $comment;
		$this->commentedAT = $commentedAT;
	}

	function getAllComments()
	{
		$db = Database::getInstance();
		$data = $db->multiFetch('select * from comments');
		return $data;
	}
	function delteComment($id)
	{
		$db = Database::getInstance();
		 $db->querySQL('delete from comments where commentID = $id');
		return true;
	}
	function getCommentWithID($id)
	{
		$db = Database::getInstance();
		$data = $db->multiFetch('select * from comments where commentID = $id');
		$this->initWith(
			$data->commentID,
			$data->commentedBY,
			$data->discID,
			$data->uid,
			$data->comment,
			$data->commentedAT
		);
		return $data;
	}
}