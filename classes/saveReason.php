<?php

include_once(__DIR__ . "/database.php");

class SaveReason{

    public $reason;
    public $buddyRequestReceiver;
    public $buddyRequestSender;




    /**
     * Get the value of reason
     */ 
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set the value of reason
     *
     * @return  self
     */ 
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get the value of buddyRequestReceiver
     */ 
    public function getBuddyRequestReceiver()
    {
        return $this->buddyRequestReceiver;
    }

    /**
     * Set the value of buddyRequestReceiver
     *
     * @return  self
     */ 
    public function setBuddyRequestReceiver($buddyRequestReceiver)
    {
        $this->buddyRequestReceiver = $buddyRequestReceiver;

        return $this;
    }

    /**
     * Get the value of buddyRequestSender
     */ 
    public function getBuddyRequestSender()
    {
        return $this->buddyRequestSender;
    }

    /**
     * Set the value of buddyRequestSender
     *
     * @return  self
     */ 
    public function setBuddyRequestSender($buddyRequestSender)
    {
        $this->buddyRequestSender = $buddyRequestSender;

        return $this;
    }

        

    public function saveReason(){
        $conn = Database::getConnection();

        $statement = $conn->prepare("
        UPDATE  friends 
        SET     reasonDenied    = :reason 
        WHERE   user_1          = :requestReceiver 
        AND     user_2          = :requestSender");

        $reason = $this->getReason();
        $buddyRequestSender = $this->getBuddyRequestSender();
        $buddyRequestReceiver = $this->getBuddyRequestReceiver();

        $statement->bindValue(":reason", $reason);
        $statement->bindValue(":requestReceiver", $buddyRequestSender);
        $statement->bindValue(":requestSender", $buddyRequestReceiver);

        $result = $statement->execute();


        return $result;
    }


}




?>