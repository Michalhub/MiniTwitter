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
        $this->user_id = $user_id = 0;
        $this->text = $text = 0;
        $this->creationDate = $creationDate = 0;
    }

    public function loadTweetById(PDO $conn, $id)
    {
        $sql = 'SELECT * FROM Tweets WHERE id= :id';

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['id' => $id]);

        if ($result && $stmt->rowCount() == 1) {
            $tweetData = $stmt->fetch(PDO::FETCH_ASSOC);

            $tweet = new Tweet;
            $tweet->id = $tweetData['id'];
            $tweet->text = $tweetData['text'];
            $tweet->creationDate = $tweetData['creationDate'];
        }
    }

    public static function loadAllTweets(PDO $conn)
    {
        $sql = 'SELECT * FROM Tweets ORDERED BY id';

        $tweets = [];
        $result = $conn->query($sql);

        if ($result && $result->rowCount() > 0) {
            foreach ($result->fetchAll(PDO::FETCH_ASSOC) AS $tweetData) {
                $tweets = new Tweet;
                $tweets->id = $tweetData['id'];
                $tweets->text = $tweetData['text'];
                $tweets->creationDate = $tweetData['creationDate'];
            }

        }
    }

    public static function loadAllTweetsByUserId(PDO $conn)
    {
        $sql = 'SELECT * FROM Tweets ORDERED BY $user_id';

        $tweets = [];
        $result = $conn->query($sql);

        if ($result && $result->rowCount() > 0) {
            foreach ($result->fetchAll(PDO::FETCH_ASSOC) AS $tweetData) {
                $tweets = new Tweet;
                $tweets->id = $tweetData['user_id'];
                $tweets->text = $tweetData['text'];
                $tweets->creationDate = $tweetData['creationDate'];
            }

        } else {
            return null;
        }

    }

    public static function loadTweetByUserId(PDO $conn, $user_id)
    {
        $sql = 'SELECT * FROM Tweets WHERE id = :user_id';

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

    public function saveTweetToDB(PDO $conn) : bool
    {
        if ($this->id == -1) {
            $sql = "INSERT INTO Tweets(text, creationDate) VALUES (:text, :creationDate)";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':text' => $this->text,
                ':creationDate' => $this->creationDate
            ]);
            $this->id = $conn->lastInsertId();

            return true;
        } else {
            $sql = "UPDATE Users SET username = :username, email = :email, hash_pass = :hash_pass WHERE id = :id";

            $stmt = $conn->prepare($sql);

            return $stmt->execute([
                ':username' => $this->username,
                ':email' => $this->email,
                ':hash_pass' => $this->hashPass,
                ':id' => $this->id,

            ]);
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