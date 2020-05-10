<?php

include_once(__DIR__ . "/database.php");

class Request{
    private $user;
    private $buddy;
    private $sender;
    private $receiver;
    private $status;

    

    /**
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

      /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of buddy
     */ 
    public function getBuddy()
    {
        return $this->buddy;
    }

    /**
     * Set the value of buddy
     *
     * @return  self
     */ 
    public function setBuddy($buddy)
    {
        $this->buddy = $buddy;

        return $this;
    }


    public function sendRequest(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("insert into friends (user_1, user_2) values (:user_1, :user_2)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();

        $statement->bindValue(":user_1", $sender);
        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();

        return $result;


    }

    public function fetchRequest(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("SELECT user_1 FROM friends WHERE user_2 = :user_2 AND status = 0");

        $receiver = $this->getReceiver();

        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;


    }

    public function fetchFriends(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("SELECT user_1 FROM friends WHERE user_2 = :user AND status = 1 UNION ALL SELECT user_2 FROM friends WHERE user_1 = :user AND status = 1");

        $user = $this->getUser();

        $statement->bindValue(":user", $user);

        $result = $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
        
    }

    public function searchUsers(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("select firstname, lastname, year from users where id like :buddy");

        $buddy = $this->getBuddy();

        $statement->bindValue(":buddy", $buddy);

        $result = $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function searchDuplicate(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("SELECT * FROM friends
        WHERE
            (user_1 = :user_1 AND user_2 = :user_2)
        OR
            (user_1 = :user_2 AND user_2 = :user_1)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();

        $statement->bindValue(":user_1", $sender);
        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        

        return $result;
        
    }

    public function acceptRequest(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("UPDATE friends SET status = 1 WHERE (user_1 = :user_1 AND user_2 = :user_2)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();

        $statement->bindValue(":user_1", $sender);
        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();


        return $result;
    }

    public function denyRequest(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("UPDATE friends SET status = 2 WHERE (user_1 = :user_1 AND user_2 = :user_2)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();

        $statement->bindValue(":user_1", $sender);
        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();


        return $result;
    }

    public function getNotification(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("SELECT * from friends WHERE user_2 = :user_2 && status = 0");

        $receiver = $this->getReceiver();

        $statement->bindValue(":user_2", $receiver);

        $result = $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}



?>