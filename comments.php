<?php
class Comments
{
	private $commentID;
	private $studentID;
	private $commentBody;
	private $commentedBy;



	public function __constructor($commentID, $studentID, $commentBody, $commentedBy)
	{

		$this->commentID = $commentID;
		$this->studentID = $studentID;
		$this->commentBody = $commentBody;
		$this->commentedBy = $commentedBy;
	}

	public function getCommentID()
	{
		return $this->commentID;
	}

	public function setCommentID($value)
	{
		$this->commentID = $value;
	}

	public function getStudentID()
	{
		return $this->studentID;
	}

	public function setStudentID($value)
	{
		$this->studentID = $value;
	}

	public function getCommentBody()
	{
		return $this->commentBody;
	}

	public function setCommentBody($value)
	{
		$this->commentBody = $value;
	}

	public function getCommentedBy()
	{
		return $this->commentedBy;
	}

	public function setCommentedBy($value)
	{
		$this->commentedBy = $value;
	}



function getAllComments(){
	$db = Database::getInstance();
        $data = $db->multiFetch('select * from comments');
        return $data;
}
}