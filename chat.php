<?php 

include_once(__DIR__ . "/classes/buddyRequest.php");
include_once(__DIR__ . "/classes/chats.php");

session_start();

if(empty($_SESSION["id"])){
    header("Location: login.php");
}

$findBuddy = new Request();

$findBuddy->setUser($_SESSION['id']);

$buddies = $findBuddy->fetchFriends();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/navigatie.css" />
    <link rel="stylesheet" type="text/css" href="css/chat.css" />
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style>
    <title>Document</title>
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

            

            <table>

                <?php     

            foreach ($buddies as $ids){
                $ids = implode("",$ids);
        
                $findBuddy->setBuddy($ids);

                $result1 = $findBuddy->searchUsers();

                $result1 = implode(" ",$result1); 
                
                ?>
                <tr>
                    <td>
                        <?php

                            echo $result1;

                        ?>
                    </td>
                    <td>
                        <form action="chatbox.php" method="get">
                            <input type="submit" class="start-chat-btn" name="chat-btn-start" value="<?php echo (int)$ids ?>">
                        </form>
                    </td>
                </tr>
                <?php
            }
            
            ?>

            </table>

        </div>

    </main>

    <script src="js/nav.js"></script>
    <script src="js/chat.js"></script>
</body>

</html>