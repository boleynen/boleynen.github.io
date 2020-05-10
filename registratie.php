<?php

include_once(__DIR__ . "/classes/User.php");

$emailVerification = true;
$required = "@student.thomasmore.be";
$requiredVerification = true;
$passwordVerification = true;

if(!empty($_POST)){
    try {
        $user = new User();
        $user->setFirstName($_POST["firstName"]);
        $user->setLastName($_POST["lastName"]);
        $user->setEmail($_POST["email"]);
        $user->setPassword($_POST["password"]);
        $user->setPasswordConfirmation($_POST["passwordConfirmation"]);
        
        $emailAdressen = User::getEmails();

        foreach($emailAdressen as $emailAdres){
        if($_POST["email"] == $emailAdres["email"]){
            $emailVerification = false;
        }
        }

        if($emailVerification == false){
            throw new Exception("Dit emailadres is al in gebruik");
        }

        if(strpos($_POST["email"], $required) == false){
            throw new Exception("Dit is geen geldig studenten emailadres, een geldig studenten emailadres eindigt op @student.thomasmore.be");
            $requiredVerification = false;
        }

        if($_POST["password"] != $_POST["passwordConfirmation"]){
            throw new Exception("De paswoorden zijn niet hetzelfde");
            $passwordVerification = false;
        }


        if($emailVerification == true && $requiredVerification == true && $passwordVerification == true){
            $user->save();

            session_start();

            $_SESSION["user"] = $_POST["email"];

            header("Location: index.php");
        }
        
            
        
        
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
    

      
};


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/registratieLogin.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style> 
    <title>Document</title>
</head>
<body>
    
<section class="flex">

    <div id="logo-container">
        <img src="images/woordlogo.png" alt="logo">
    </div>

    <form action="" method="post" class="clearfix">

    <h2>Maak een nieuw account</h2>

    <?php if(isset($error)):?>
        <div class="error" style="color: white;">
        <?php echo $error;?></div>
    <?php endif;?>

    <div>
        <label for="firstName">Voornaam</label>
        <input type="text" id="firstName" name="firstName">
    </div>

    <div>
        <label for="lastName">Familienaam</label>
        <input type="text" id="lastName" name="lastName">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
    </div>

    <div>
        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <label for="passwordConfirmation">Bevestig je wachtwoord</label>
	    <input type="password" id="passwordConfirmation" name="passwordConfirmation">
    </div>

    <div class="submitBtn">
	    <input type="submit" id="submitBtn" value="Bevestig">	
    </div>

    <div class="loginLink">
        <a href="login.php">Heb je al een account? Log hier in.</a>
    </div>

</form>

</section>

</body>
</html>