<?php

include_once(__DIR__ . "/database.php");

class Chat{
    private $sender;
    private $receiver;
    private $message;
    private $time;
    private $seen;
    private $match;
    
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
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of seen
     */ 
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * Set the value of seen
     *
     * @return  self
     */ 
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    
    /**
     * Get the value of match
     */ 
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set the value of match
     *
     * @return  self
     */ 
    public function setMatch($match)
    {
        $this->match = $match;

        return $this;
    }

    public function sendMessage(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("INSERT INTO chats (sender_id, receiver_id, message, timestamp) 
                                    VALUES (:sender_id, :receiver_id, :message, :time)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();
        $message = $this->getMessage();
        $time = $this->getTime();

        $statement->bindValue(":sender_id", $sender);
        $statement->bindValue(":receiver_id", $receiver);
        $statement->bindValue(":message", $message);
        $statement->bindValue(":time", $time);

        $result = $statement->execute();

        return $result;
    }
    

    public function searchUsers($receiver){
        $conn = Database::getConnection();

        $statement = $conn->prepare("select firstname, lastname from users where id like :receiver_id");

        $receiver = $this->getReceiver();

        $statement->bindValue(":receiver_id", $receiver);

        $result = $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function searchMyName($receiver){
        $conn = Database::getConnection();

        $statement = $conn->prepare("select firstname, lastname from users where id like :sender_id");

        $sender = $this->getSender();

        $statement->bindValue(":sender_id", $sender);

        $result = $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getChat(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("SELECT sender_id, receiver_id, message FROM chats
        WHERE
            (sender_id = :sender_id AND receiver_id = :receiver_id)
        OR
            (sender_id = :receiver_id AND receiver_id = :sender_id)");

        $sender = $this->getSender();
        $receiver = $this->getReceiver();

        $statement->bindValue(":sender_id", $sender);
        $statement->bindValue(":receiver_id", $receiver);

        $result = $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function fetchMatch(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select province, town, passion, os, movie, game, gamegenre, music, sport from users where id like :match" );
    
        $match = $this->getMatch();
    
        $statement->bindValue(":match", $match);
    
        $statement->execute();
        
        $matchData = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $matchData;
    }

    public function fetchCurrentUser(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select province, town, passion, os, movie, game, gamegenre, music, sport from users where id like :sender" );
    
        $sender = $this->getSender();
    
        $statement->bindValue(":sender", $sender);
    
        $statement->execute();
        
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $data;
    }






}