<?php

require 'config.php';

class Comment
{
	private $id;
	private $userId;
	private $postId;
	private $creation_date;
	private $text;

	public function __construct()
	{
		$this->id = -1;
		$this->userId = 0;
		$this->postId = 0;
		$this->creation_date = '';
		$this->text = '';

	}

    public function getUserId()
    {
        return $this->userId;
    }


    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    public function getPostId()
    {
        return $this->postId;
    }


    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getCreationDate()
    {
        return $this->creation_date;
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getId()
    {
        return $this->id;
    }

	
}