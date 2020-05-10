<?php 

include_once(__DIR__ . "/classes/buddyRequest.php");
include_once(__DIR__ . "/classes/saveReason.php");

session_start();

if(empty($_SESSION["id"])){
    header("Location: login.php");
}

$findBuddy = new Request();

$findBuddy->setUser($_SESSION['id']);

$buddies = $findBuddy->fetchFriends();



$requests = new Request();

$requests->setReceiver($_SESSION['id']);

$allRequests = $requests->fetchRequest();



if(!empty($_GET["approveBuddyRequest"])){

    $approved = new Request();

    $approved->setSender($_GET['approveBuddyRequest']);
    $approved->setReceiver($_SESSION['id']);

    $approved->acceptRequest();

    header("Location: chatbox.php?chat-btn-start=".$_GET['approveBuddyRequest']);

    $message = "Buddy verzoek aanvaard!";

}else if(!empty($_GET["denyBuddyRequest"])){

    $denied = new Request();

    $denied->setSender($_GET['denyBuddyRequest']);
    $denied->setReceiver($_SESSION['id']);

    $denied->denyRequest();


    $message = "Buddy verzoek geweigerd!";

    $id = $_GET['denyBuddyRequest'];

    $reasonDenied = $_COOKIE['reason'.$id];

    $saveReason = new SaveReason();

    $saveReason->setReason($reasonDenied);
    $saveReason->setBuddyRequestReceiver($_SESSION['id']);
    $saveReason->setBuddyRequestSender($_GET['denyBuddyRequest']);

    $saveReason->saveReason();

    header("Location: buddies.php");


}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/navigatie.css" />
    <link rel="stylesheet" type="text/css" href="css/buddies.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style>
</head>

<body>

    <?php 
    include_once(__DIR__ . "/inc.hamburger.php");
    include_once("inc.nav.php"); 

    ?>
    <main>
        <?php if(!empty($message)):?>
            <div class="error" style="color: white;">
            <?php echo $message;?></div>
        <?php endif;?>

        <div>

            <h2>Jouw buddies</h2>

            

            <ul>

            <?php     

            foreach ($buddies as $ids){
                $ids = implode("",$ids);
        
                $findBuddy->setBuddy($ids);

                $result1 = $findBuddy->searchUsers();

                $result1 = implode(" ",$result1); 
                
                ?>
                <li>
                <a href="buddyProfiel.php?buddyId=<?php echo $ids?>">
                <?php

                echo $result1;

                ?>
                </a>
                </li>
                <?php
            }
            
            ?>

            </ul>

        </div>

        

        <div>
            <h2>Openstaande buddy-verzoeken</h2>

            <ul>

            <?php 
    
            foreach($allRequests as $request){
                $request = implode("",$request);

                $findBuddy->setBuddy($request);

                $result2 = $findBuddy->searchUsers();

                $result2 = implode(" ",$result2);

                ?>
                <li>
                <a href="buddyProfiel.php?buddyId=<?php echo $request?>">
                <?php

                echo $result2;

                ?>
                </a>
                </li>
                <form method="get">
                    <input type="submit" class="approve-friend request" name="approveBuddyRequest" value="<?php echo $request ?>">
                    <input type="submit" class="deny-friend request" name="denyBuddyRequest" value="<?php echo $request ?>">
                </form>
                <?php

            }

            if(!$allRequests){
                ?>
                <p>
                <?php echo "Je hebt geen buddy-verzoeken!"; ?>
                </p>
                <?php
                
            }


            
            ?>

            </ul>

        </div>

    </main>

</body>

<script src="js/nav.js"></script>

</html>