<?php


class Comment
{
	private $id;
	private $user_id;
	private $post_id;
	private $creationDate;
	private $textComment;

	public function __construct()
	{
		$this->id = -1;
		$this->user_id = '';
		$this->post_id = '';
		$this->creationDate = '';
		$this->textComment = '';
	}

	public static function loadCommentById($conn, $id)
    {
        $sql = 'SELECT * FROM Comment WHERE id= :id';

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([':id' => $id]);

        if ($result && $stmt->rowCount() == 1) {
            $commentData = $stmt->fetch(PDO::FETCH_ASSOC);

            $comment = new Comment;

            $comment->id = $commentData['id'];
            $comment->user_id = $commentData['user_id'];
            $comment->post_id = $commentData['post_id'];
            $comment->textComment = $commentData['textComment'];
            $comment->creationDate = $commentData['creationDate'];

        } else {
            return null;
        }

        return $comment;
    }

    public static function loadAllCommentsByPostId(PDO $conn, $post_id) //////////////////////
    {
        $sql = 'SELECT * FROM Comment 
                WHERE post_id = :post_id 
                ORDER BY creationDate DESC';

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['post_id' =>$post_id ]);

        $comments = [];

        if ($result && $stmt->rowCount() > 0) {
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $commentData) {
                $comment = new Comment();

                $comment->id = $commentData['id'];
                $comment->post_id = $commentData['post_id'];
                $comment->user_id = $commentData['user_id'];
                $comment->textComment = $commentData['textComment'];
                $comment->creationDate = $commentData['creationDate'];

                $comments[] = $comment;
            }

            return $comments;
        } else {
            return null;
        }
    }

    public function saveToDB(PDO $conn) : bool
    {
        if ($this->id == -1) {
            $sql = 'INSERT INTO Comment (`textComment`, user_id, post_id, creationDate) 
                    VALUES (:textComment, :user_id, :post_id, NOW())';

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':textComment' => $this->textComment,
                ':user_id' => $this->user_id,
                ':post_id' => $this->post_id,
            ]);
            $this->id = $conn->lastInsertId();

            return true;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    }

    public function getTextComment()
    {
        return $this->textComment;
    }

    public function setTextComment($textComment)
    {
        $this->textComment = $textComment;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getPostId()
    {
        return $this->post_id;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

}