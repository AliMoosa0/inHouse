<?php

class Discussions{
private $discussionID;
private $discussionTitle;
private $discussionBody;
private $discussionBooks;
private $voteUps;
private $createdBy;




	public function __constructor($discussionID, $discussionTitle, $discussionBody, $discussionBooks, $voteUps, $createdBy) {

		$this->discussionID = $discussionID;
		$this->discussionTitle = $discussionTitle;
		$this->discussionBody = $discussionBody;
		$this->discussionBooks = $discussionBooks;
		$this->voteUps = $voteUps;
		$this->createdBy = $createdBy;
	}

	public function getDiscussionID() {
		return $this->discussionID;
	}

	public function setDiscussionID($value) {
		$this->discussionID = $value;
	}

	public function getDiscussionTitle() {
		return $this->discussionTitle;
	}

	public function setDiscussionTitle($value) {
		$this->discussionTitle = $value;
	}

	public function getDiscussionBody() {
		return $this->discussionBody;
	}

	public function setDiscussionBody($value) {
		$this->discussionBody = $value;
	}

	public function getDiscussionBooks() {
		return $this->discussionBooks;
	}

	public function setDiscussionBooks($value) {
		$this->discussionBooks = $value;
	}

	public function getVoteUps() {
		return $this->voteUps;
	}

	public function setVoteUps($value) {
		$this->voteUps = $value;
	}

	public function getCreatedBy() {
		return $this->createdBy;
	}

	public function setCreatedBy($value) {
		$this->createdBy = $value;
	}
}