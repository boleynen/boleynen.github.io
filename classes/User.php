<?php

include_once(__DIR__ . "/database.php");

class User{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $passwordConfirmation;
    private $imagePath;
    private $id;
    private $year;
    private $description;
    private $province;
    private $town;
    private $passion;
    private $os;
    private $movie;
    private $game;
    private $gamegenre;
    private $music;
    private $sport;
    private $buddy;
    private $user;
    private $totalUsers;
    private $totalMatches;

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
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        if(empty($firstName)){
            throw new Exception("Voornaam mag niet leeg zijn");
        }

        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        if(empty($lastName)){
            throw new Exception("Familienaam mag niet leeg zijn");
        }

        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        if(empty($email)){
            throw new Exception("Email mag niet leeg zijn");
        }

        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        if(empty($password)){
            throw new Exception("Paswoord mag niet leeg zijn");
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of passwordConfirmation
     */ 
    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }

    /**
     * Set the value of passwordConfirmation
     *
     * @return  self
     */ 
    public function setPasswordConfirmation($passwordConfirmation)
    {
        if(empty($passwordConfirmation)){
            throw new Exception("Bevestig paswoord mag niet leeg zijn");
        }

        $this->passwordConfirmation = $passwordConfirmation;

        return $this;
    }

    
    /**
     * Get the value of imagePath
     */ 
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set the value of imagePath
     *
     * @return  self
     */ 
    public function setImagePath($imagePath)
    {
        if(empty($imagePath)){
            throw new Exception("Kies een profielfoto");
        }
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get the value of year
     */ 
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of year
     *
     * @return  self
     */ 
    public function setYear($year)
    {

        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of passion
     */ 
    public function getPassion()
    {
        return $this->passion;
    }

    /**
     * Set the value of passion
     *
     * @return  self
     */ 
    public function setPassion($passion)
    {
        $this->passion = $passion;

        return $this;
    }

    /**
     * Get the value of os
     */ 
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set the value of os
     *
     * @return  self
     */ 
    public function setOs($os)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * Get the value of game
     */ 
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set the value of game
     *
     * @return  self
     */ 
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get the value of music
     */ 
    public function getMusic()
    {
        return $this->music;
    }

    /**
     * Set the value of music
     *
     * @return  self
     */ 
    public function setMusic($music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get the value of sport
     */ 
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * Set the value of sport
     *
     * @return  self
     */ 
    public function setSport($sport)
    {
        $this->sport = $sport;

        return $this;
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
       /**
     * Get the value of buddy
     */ 
    public function getBuddy()
    {
        return $this->buddy;
    }

    /**
     * Get the value of province
     */ 
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set the value of province
     *
     * @return  self
     */ 
    public function setProvince($province)
    {
        if(empty($province)){
            throw new Exception("Provincie mag niet leeg zijn");
        }
        $this->province = $province;

        return $this;
    }

    /**
     * Get the value of town
     */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set the value of town
     *
     * @return  self
     */ 
    public function setTown($town)
    {
        if(empty($town)){
            throw new Exception("Gemeente/stad mag niet leeg zijn");
        }
        $this->town = $town;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of gamegenre
     */ 
    public function getGamegenre()
    {
        return $this->gamegenre;
    }

    /**
     * Set the value of gamegenre
     *
     * @return  self
     */ 
    public function setGamegenre($gamegenre)
    {
        $this->gamegenre = $gamegenre;

        return $this;
    }

     /**
     * Get the value of totalUsers
     */ 
    public function getTotalUsers()
    {
        return $this->totalUsers;
    }

    /**
     * Set the value of totalUsers
     *
     * @return  self
     */ 
    public function setTotalUsers($totalUsers)
    {
        $this->totalUsers = $totalUsers;

        return $this;
    }

    /**
     * Get the value of totalMatches
     */ 
    public function getTotalMatches()
    {
        return $this->totalMatches;
    }

    /**
     * Set the value of totalMatches
     *
     * @return  self
     */ 
    public function setTotalMatches($totalMatches)
    {
        $this->totalMatches = $totalMatches;

        return $this;
    }

    public function save(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("insert into users (firstname, lastname, email, password) 
                                    values (:firstname, :lastname, :email, :password)");
        
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 14]);
        
        $statement->bindValue(":firstname", $firstName);
        $statement->bindValue(":lastname", $lastName);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        
        $result = $statement->execute();
        
        return $result;
        
    }

    public function completion(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("update users set avatar=:avatar, year=:year, description=:description, 
                                     province=:province, town=:town, passion=:passion, os=:os, movie=:movie,
                                     game=:game, gamegenre=:gamegenre, music=:music, sport=:sport, 
                                     buddy=:buddy, new=false where id like :id");
        
        $imagePath = $this->getImagePath();
        $id = $this->getId();
        $year = $this->getYear();
        $description = $this->getDescription();
        $province = $this->getProvince();
        $town = $this->getTown();
        $passion = $this->getPassion();
        $os = $this->getOs();
        $movie = $this->getMovie();
        $game = $this->getGame();
        $gamegenre = $this->getGamegenre();
        $music = $this->getMusic();
        $sport = $this->getSport();
        $buddy = $this->getBuddy();
    
        $statement->bindValue(":avatar", $imagePath);
        $statement->bindValue(":id", $id);
        $statement->bindValue(":year", $year);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":province", $province);
        $statement->bindValue(":town", $town);
        $statement->bindValue(":passion", $passion);
        $statement->bindValue(":os", $os);
        $statement->bindValue(":movie", $movie);
        $statement->bindValue(":game", $game);
        $statement->bindValue(":gamegenre", $gamegenre);
        $statement->bindValue(":music", $music);
        $statement->bindValue(":sport", $sport);
        $statement->bindValue(":buddy", $buddy);
        
        $result = $statement->execute();
        
        return $result;
        
    }

    public static function getEmails(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select email from users");
        
        $statement->execute();
        
        $emailAdressen = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $emailAdressen;
    }

    public function fetchPassword(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select password from users where email like :email" );

        $email = $this->getEmail();

        $statement->bindValue(":email", $email);

        $statement->execute();
        
        $passwordVerification = $statement->fetchColumn();
        
        return $passwordVerification;
    }

    public function saveChanges(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("update users set avatar=:avatar, year=:year, description=:description, 
                                     province=:province, town=:town, passion=:passion, os=:os, movie=:movie,
                                     game=:game, gamegenre=:gamegenre, music=:music, sport=:sport, 
                                     buddy=:buddy, firstname=:firstname, lastname=:lastname,
                                     password=:password, email=:email where id like :user");
        
        $user = $this->getUser();  
        $firstName = $this->getFirstName();
        $lastName = $this->getLastName();                       
        $imagePath = $this->getImagePath();
        $email = $this->getEmail();
        $year = $this->getYear();
        $description = $this->getDescription();
        $province = $this->getProvince();
        $town = $this->getTown();
        $passion = $this->getPassion();
        $os = $this->getOs();
        $movie = $this->getMovie();
        $game = $this->getGame();
        $gamegenre = $this->getGamegenre();
        $music = $this->getMusic();
        $sport = $this->getSport();
        $buddy = $this->getBuddy();
        $password = $this->getPassword();

        $statement->bindValue(":user", $user);
        $statement->bindValue(":firstname", $firstName);
        $statement->bindValue(":lastname", $lastName);
        $statement->bindValue(":avatar", $imagePath);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":year", $year);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":province", $province);
        $statement->bindValue(":town", $town);
        $statement->bindValue(":passion", $passion);
        $statement->bindValue(":os", $os);
        $statement->bindValue(":movie", $movie);
        $statement->bindValue(":game", $game);
        $statement->bindValue(":gamegenre", $gamegenre);
        $statement->bindValue(":music", $music);
        $statement->bindValue(":sport", $sport);
        $statement->bindValue(":buddy", $buddy);
        $statement->bindValue(":password", $password);

        
        $result = $statement->execute();
        
        return $result;
        
        
    }

    public function fetchData(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select * from users where id like :user" );

        $user = $this->getUser();

        $statement->bindValue(":user", $user);

        $statement->execute();
        
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $data;
    }

    public function getAllUsers(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select count(*) from users");
        
        $statement->execute();
        
        $totalUsers = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $totalUsers;

    }

    public function getAllMatches(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select count(*) from friends where status = 1");
        
        $statement->execute();
        
        $totalMatches = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $totalMatches;

    }


}

?>


