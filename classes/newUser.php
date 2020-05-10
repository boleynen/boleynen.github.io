<?php 

include_once(__DIR__ . "/database.php");

class NewUser{
    private $email;
    private $data;
   
   

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
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function FindData(){
        $conn = Database::getConnection();
        
        $statement = $conn->prepare("select * from users where email like :email" );

        $email = $this->getEmail();

        $statement->bindValue(":email", $email);

        $statement->execute();
        
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        
       return $data;

    }

}

?>
