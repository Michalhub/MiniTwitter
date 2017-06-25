<?php

class Tweet
{
    private $id;
    private $user_id;
    private $text;
    private $creationDate;

    public function __construct()
    {
        $this->id = $id = -1;
        $this->user_id = '';
        $this->text = '';
        $this->creationDate = '';
    }

    public static function loadTweetById(PDO $conn, $id)
    {
        $sql = 'SELECT * FROM Tweet WHERE id= :id';

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([':id' => $id]);

        if ($result && $stmt->rowCount() == 1) {
            $tweetData = $stmt->fetch(PDO::FETCH_ASSOC);

            $tweet = new Tweet;
            $tweet->id = $tweetData['id'];
            $tweet->text = $tweetData['text'];
            $tweet->creationDate = $tweetData['creationDate'];
        } else {
            return null;
        }

        return $tweet;
    }

    public static function loadAllTweets(PDO $conn)
    {
        $sql = 'SELECT Tweet.id, user_id, username, `text`, creationDate 
                FROM Users 
                JOIN Tweet 
                WHERE Users.id=Tweet.user_id ORDER BY creationDate DESC';

        $tweets = [];

        $result = $conn->query($sql);

        if ($result && $result->rowCount() > 0) {
            foreach ($result->fetchAll(PDO::FETCH_ASSOC) AS $tweetData) {
                $tweet = new Tweet;

                $tweet->id = $tweetData['id'];
                $tweet->user_id = $tweetData['user_id'];
                $tweet->userName = $tweetData['username'];
                $tweet->text = $tweetData['text'];
                $tweet->creationDate = $tweetData['creationDate'];
                $tweets[] = $tweet;
            }

            return $tweets;
        } else {
            return null;
        }
    }

    public static function loadAllTweetsByUserId(PDO $conn, $user_id)
    {
        $sql = 'SELECT * FROM Users 
                JOIN Tweet ON Users.id=Tweet.user_id 
                WHERE user_id = :user_id';

        $tweets = [];

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([':user_id' => $user_id]);

        if ($result && $stmt->rowCount() > 0) {
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) AS $tweetData) {
                $tweet = new Tweet;

                $tweet->id = $tweetData['id'];
                $tweet->user_id = $tweetData['user_id'];
                $tweet->text = $tweetData['text'];
                $tweet->creationDate = $tweetData['creationDate'];
                $tweets[] = $tweet;
            }

            return $tweets;

        } else {
            return null;
        }

    }

    public static function loadTweetByUserId(PDO $conn, $user_id)
    {
        $sql = 'SELECT * FROM Tweet WHERE id = :user_id';

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['user_id' => $user_id]);

        if ($result && $stmt->rowCount() == 1) {
            $tweetData = $stmt->fetch(PDO::FETCH_ASSOC);

            $tweet = new Tweet;
            $tweet->user_id = $tweetData['user_id'];
            $tweet->text = $tweetData['text'];
            $tweet->creationDate = $tweetData['creationDate'];
        } else {
            return null;
        }
    }

    public function saveToDB(PDO $conn) : bool
    {
        if ($this->id == -1) {
            $sql = 'INSERT INTO Tweet(`text`, user_id, creationDate) VALUES (:text, :user_id, NOW())';

            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                ':text' => $this->text,
                ':user_id' => $this->user_id,
            ]);

            if (!$result) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }



}