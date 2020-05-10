<?php

try {
    $emailAdressen = User::getEmails();

    if(!empty($_POST["email"]) && empty($_POST["emailVerification"])){
        throw new Exception("Kan emailadres niet veranderen, want wachtwoord is niet ingevuld");
    }

    if(!empty($_POST["email"]) && !empty($_POST["emailVerification"])){

        if(password_verify($_POST["emailVerification"], $data["password"])){
            $passwordMatch1 = true;
        }
        else{
            throw new Exception("Kan emailadres niet veranderen, want het wachtwoord is fout");
            $passwordMatch1 = false;
        } 

        if(strpos($_POST["email"], $required) == false){
            throw new Exception("Dit is geen geldig studenten emailadres, een geldig studenten emailadres eindigt op @student.thomasmore.be");
            $requiredVerification = false;
        }

        foreach($emailAdressen as $emailAdres){
    
            if($_POST["email"] == $emailAdres["email"]){
                throw new Exception("Dit emailadres is al in gebruik");
                $emailVerification = false;
            }
        }

        if($passwordMatch1 == true && $requiredVerification == true && $emailVerification == true){
            $_SESSION["user"] = $_POST["email"];
        }

    }

    if(empty($_POST["email"]) && !empty($_POST["emailVerification"])){

        if(password_verify($_POST["emailVerification"], $data["password"])){
            throw new Exception("Kan emailadres niet veranderen, want nieuw emailadres is niet ingevuld");
            
        }
        else{
            throw new Exception("Kan emailadres niet veranderen, want het wachtwoord is fout");
            $passwordMatch1 = false;
        } 
    }

    if(empty($_POST["email"]) && empty($_POST["emailVerification"])){
        $passwordMatch1 = true;
        $emailVerification = true;
        $requiredVerification = true;
        $_POST["emailVerification"] = $data["password"];
        $_POST["email"] = $data["email"];
    }
    

    

    if(!empty($_POST["passwordVerification"])){
        if(password_verify($_POST["passwordVerification"], $data["password"])){
            $passwordMatch2 = true;
        }
        else{
            throw new Exception("Kan wachtwoord niet veranderen, want oud wachtwoord is fout");
            $passwordMatch2 = false;
        }

        if(empty($_POST["password"]) && empty( $_POST["passwordConfirmation"])){
            throw new Exception("Kan wachtwoord niet veranderen, want nieuw wachtwoord en bevestiging zijn niet ingevuld");
        }

        if(!empty($_POST["password"]) && !empty( $_POST["passwordConfirmation"]) && $_POST["password"] != $_POST["passwordConfirmation"] && $passwordMatch2 == true){
            throw new Exception("De paswoorden zijn niet hetzelfde");
            $passwordVerification = false;
        }

        if(!empty($_POST["password"]) && !empty( $_POST["passwordConfirmation"]) && $_POST["password"] == $_POST["passwordConfirmation"] && $passwordMatch2 == true){
            $securePassword = password_hash($_POST["password"], PASSWORD_DEFAULT, ["cost" => 14]);
        }
    }
    else{
        if(!empty($_POST["passwordConfirmation"]) && !empty( $_POST["password"])){
            throw new Exception("Voordat je je wachtwoord kan veranderen moet je je oude wachtwoord ingeven");
        }
        else{
            $passwordMatch2 = true;
            $passwordVerification = true;
            $_POST["passwordVerification"] = $data["password"];
            $_POST["passwordConfirmation"] = $data["password"];
            $_POST["password"] = $data["password"];
            $securePassword = $data["password"];
        }
    }

    $fileSize = $_FILES["avatar"]["size"];
    if(!empty($_FILES["avatar"]["name"])){
        if($fileSize < 2000000){
            $img = $_FILES["avatar"]["name"];
            $imgSizeOk = true;
            $newImg = true;
        }
        else{
            throw new Exception("Je profielfoto heeft een grotere file size dan is toegelaten (max 2MB)");
            $imgSizeOk = false;
        }
    }
    else{
        $_POST["avatar"] = $data["avatar"];
        $img = $_POST["avatar"];
        $imgSizeOk = true;
        $newImg = false;
    }

    if(!empty($_POST["description"])){

        if(strlen($_POST["description"]) <= 300){
            $descLengthOK = true;
        }
        else{
            throw new Exception("Je profieltekst is te lang (max 300 tekens)");
            $descLengthOK = false;
        }
    }
    else{
        $_POST["description"] = $data["description"];
        $descLengthOK = true;
    }

    foreach($_POST as $key1 => $post){
       
        if(empty($post)){
            
            foreach($data as $key2 => $item){
                if($key1 == $key2){
                    $post = $item;
                }
            }
        }
        $_POST[$key1] = $post;
    }

    

    

    $userPro->setImagePath($img);
    $userPro->setEmail($_POST["email"]);
    $userPro->setYear($_POST["year"]);
    $userPro->setFirstname($_POST["firstname"]);
    $userPro->setLastname($_POST["lastname"]);
    $userPro->setPassword($securePassword);
    $userPro->setDescription($_POST["description"]);
    $userPro->setProvince($_POST["province"]);
    $userPro->setTown($_POST["town"]);
    $userPro->setPassion($_POST["passion"]);
    $userPro->setOs($_POST["os"]);
    $userPro->setMovie($_POST["movie"]);
    $userPro->setGame($_POST["game"]);
    $userPro->setGamegenre($_POST["gamegenre"]);
    $userPro->setMusic($_POST["music"]);
    $userPro->setSport($_POST["sport"]);
    $userPro->setBuddy($_POST["buddy"]);
   
    if($imgSizeOk == true && $descLengthOK == true && $emailVerification == true && $requiredVerification == true && $passwordVerification == true && $passwordMatch1 == true && $passwordMatch2 == true){
    $userPro->saveChanges();
    
    if($newImg == true){
    move_uploaded_file($_FILES["avatar"]["tmp_name"], "avatars/$img");   
    }

    header("Location: index.php");
    }
   



} catch (\Throwable $th) {
    $error = $th->getMessage();
}

?>