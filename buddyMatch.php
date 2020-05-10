<?php

include_once(__DIR__ . "/classes/Match.php");

$buddy = new BuddyMatch();
$buddy->setUser($_SESSION['id']);

$userData = $buddy->FetchUser();

switch($userData["buddy"]){
    case "buddy":
        $buddy->setGoal($userData["buddy"]);
    break;

    case "begeleider":
        $buddy->setGoal($userData["buddy"]);
    break;
}

$buddyData = $buddy->FetchBuddies();
$commonInterests;

foreach($buddyData as $buddy){ 
    $teller = 0;
    foreach($buddy as $key1 => $item1){
        foreach($userData as $key2 => $user){

          $interest = true;
          switch($key2){
               case "firstname":
               $interest = false;
               break;
     
               case "lastname":
               $interest = false;
               break;
     
               case "description":
               $interest = false;
               break;
     
               case "year":
               $interest = false;
               break;
     
               case "avatar":
               $interest = false;
               break;
     
               case "new":
               $interest = false;
               break;
     
               case "buddy":
               $interest = false;
               break;
          }

            if($interest == true){
                
              if($key1 == $key2 && $item1 == $user){ 
                $teller++;
              }
            }
        }
    } 

    $commonInterests[] = [
            "teller" => $teller,
            "id" => $buddy["id"]
            
        
    ];
    
}
arsort($commonInterests);

?>