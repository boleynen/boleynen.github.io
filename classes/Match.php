<?php

include_once(__DIR__ . "/database.php");

class BuddyMatch{

private $user;
private $goal;
private $match;


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
 * Get the value of goal
 */ 
public function getGoal()
{
return $this->goal;
}

/**
 * Set the value of goal
 *
 * @return  self
 */ 
public function setGoal($goal)
{
$this->goal = $goal;

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


public function fetchUser(){
    $conn = Database::getConnection();
    
    $statement = $conn->prepare("select * from users where id like :user" );

    $user = $this->getUser();

    $statement->bindValue(":user", $user);

    $statement->execute();
    
    $userData = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $userData;
}

public function fetchBuddies(){
    $conn = Database::getConnection();
    
    $statement = $conn->prepare("select * from users where buddy <> :buddy and id <> :user" );

    $goal = $this->getGoal();
    $user = $this->getUser();

    $statement->bindValue(":buddy", $goal);
    $statement->bindValue(":user", $user);

    $statement->execute();
    
    $buddyData = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $buddyData;
}

public function fetchMatch(){
    $conn = Database::getConnection();
    
    $statement = $conn->prepare("select * from users where id like :match" );

    $match = $this->getMatch();

    $statement->bindValue(":match", $match);

    $statement->execute();
    
    $matchData = $statement->fetch(PDO::FETCH_ASSOC);
    
    return $matchData;
}


}

?>

