<?php
include_once(__DIR__ . "/classes/User.php");

$passwordMatch = true;

if(!empty($_POST)){
    try {
        $verification = new User();
        $verification->setEmail($_POST["email"]);
        $verification->setPassword($_POST["password"]);

        $passwordVerification = $verification->fetchPassword();

        if(password_verify($_POST["password"], $passwordVerification)){
            $passwordMatch = true;
        }
        else{
            throw new Exception("Paswoord of emailadres is fout");
            $passwordMatch = false;
        }

        if($passwordMatch == true){
            session_start();

            $_SESSION["user"] = $_POST["email"];

            header("Location: index.php");
        }


    }

    catch (\Throwable $th){
        $error = $th->getMessage();
    }

    

}

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

<form action="" method="post">

    <h2>Meld je aan</h2>

    <?php if(isset($error)):?>
        <div class="error" style="color: white;">
        <?php echo $error;?></div>
    <?php endif;?>

    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
    </div>

    <div>
        <label for="password">Paswoord</label>
        <input type="password" id="password" name="password">
    </div>

    <div class="submitBtn">
	    <input type="submit" id="submitBtn" value="Aanmelden">	
    </div>
    <div class="registratieLink">
        <a href="registratie.php">Nog geen account? Registreer hier.</a>
    </div>

</form>

</section>

</body>
</html>