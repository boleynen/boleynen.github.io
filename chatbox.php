<?php 

include_once(__DIR__ . "/classes/chats.php");

session_start();

if(empty($_SESSION["id"])){
    header("Location: login.php");
}

$data = "";

try {
    $chat = new Chat();

    $chat->setSender($_SESSION['id']);
    $chat->setReceiver($_GET['chat-btn-start']);
    
    
    $myId = $chat->getSender();
    $receiverId = $chat->getReceiver();     // = STRING

    $receiverId = intval($receiverId);      // = OMZETTEN NAAR INT


    $receiver = $chat->searchUsers($receiverId);

    $receiver = implode(" ",$receiver);

    if(!empty($_POST)){

        try {
            $receiverId = $chat->getReceiver();     // = STRING
            $receiverId = intval($receiverId);      // = OMZETTEN NAAR INT

            date_default_timezone_set("Europe/Amsterdam");
            $time = date("d-m-Y - H:i");

            $chat->setSender($_SESSION['id']);
            $chat->setReceiver($receiverId);
            $chat->setMessage($_POST['message']);
            $chat->setTime($time);

            $chat->sendMessage();

        } catch (\Throwable $th) {
            $error = $th->getMessage();
            echo $error;
        }
   
    }
    

} catch (\Throwable $th) {
    $error = $th->getMessage();
    echo $error;
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/chat.css" />
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style>
    <title>Document</title>
</head>
<body>

<a href="chat.php" id="terugknop">< Terug</a>

<?php 
include_once(__DIR__."/buddyMatch.php");

$chat->setMatch($receiverId);

$myInterests = $chat->fetchCurrentUser();
$matchInterests = $chat->fetchMatch();

$matchReason = array_intersect($myInterests, $matchInterests);

$matchKeys = implode(" ",array_keys($matchReason));

$matchKeys = array_keys($matchReason);

?>

<h3>Hoera, een match! Dit zijn jullie gelijke interesses:</h3>

<table id="match-reason">

<tr class="match-row">

<?php 
foreach($matchKeys as $key){
    ?> 

            <th>
                <?php echo $key ?>
            </th>
    <?php 
}
?> 
</tr>
<tr class="match-row">
<?php
foreach($matchReason as $match){
    ?> 
            <td>
                <?php echo $match ?>
            </td>
    
    
    <?php
}
?> 
</tr>
</table>


<section id="chatbox">
        <div>
            <h3><?php echo $receiver?></h3>
        </div>
        <div id="chat-output">

            <div id="match-reason">
            
            </div>
            <div id="scroll">

                <?php 
                    $conversation = $chat->getChat();
                    $myId = $chat->getSender();

                    foreach ( $conversation as $message ) {
                       
                        foreach ( $message as $key => $value ) {  

                            if($value == $myId && $key == 'sender_id'){
                                $myName = $chat->searchMyName($myId);
                                $myName = implode(" ", $myName);
                                ?> 
                                <div class="sender">
                                    <p class="chat-person"><?php echo $myName;?></p>
                                    <p class="chat-message"><?php echo $message['message'];?></p>

                                </div>
                                <?php
                  
                            }else if($key == 'sender_id'){
                                ?>
                                <div class="receiver">
                                    <p class="chat-person"><?php  echo $receiver; ?></p>
                                    <p class="chat-message"><?php echo $message['message']; ?></p>
                                </div>
                                <?php
                            }
                        }                     
                    }
                
                 ?> 

                
            </div>
        </div>
        <div>
            <form method="post" id="form-chat">
                <input type="text" id="text-input" name="message" placeholder="Typ hier je bericht">
                <input type="submit" id="text-submit" name="submit-chat" value="Verzend">
            </form>
        </div>
    </section>
</body>
</html>
