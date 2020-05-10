<?php 

include_once(__DIR__ . "/classes/newUser.php");

session_start();

if(empty($_SESSION["user"])){
    header("Location: login.php");
}

$newUser = new NewUser();
$newUser->setEmail($_SESSION["user"]);

$data = $newUser->FindData();

$_SESSION["id"] = $data["id"];

if($data["new"] == true){
   header("Location: profielVervolledigen.php");
};


include_once(__DIR__ . "/classes/search.php");

$dataSearch = null;

if (!empty($_POST['search'])){
        try {
            $search = new Search();
            $search -> setSearch($_POST['search']);
            $dataSearch = $search -> fetchData();
        } catch (\Throwable $th) {
            $error = $th -> getMessage();
        }
}

include_once(__DIR__."/buddyMatch.php");



?>

<script>
    function reply_click(clicked_id){
        var clicked_id;
        console.log(clicked_id);
        window.location.href = "buddyProfiel.php?buddyId=" + clicked_id;
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/navigatie.css" />
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style>
</head>

<body>


    <?php 
    include_once(__DIR__ . "/inc.hamburger.php");
    include_once("inc.nav.php"); 
    include_once(__DIR__ . "/classes/User.php");

    ?>

    
    <?php 
    
    $e = new User();

    $allUsers = $e->getAllUsers();
    $allMatches = $e->getAllMatches();


    $allUsers = implode(" ", $allUsers);
    $allMatches = implode(" ", $allMatches);

    ?>

    <div id="headerContainer">
        <div id="bgContainer">
            <h1>Hallo <?php echo htmlspecialchars($data["firstname"]) ?>!</h1>
        </div>

        <div id="userMatchCount">
            <div id="totalUsers">
                <p class="number"><?php echo $allUsers; ?></p>
                <p>Mimir gebruikers</p>
            </div>
            <div id="totalMatches">
                <p class="number"><?php echo $allMatches; ?></p>
                <p>Matches gecreëerd</p>
            </div>
        </div>
    </div>

    <?php 



if( $dataSearch != null) {
    foreach($dataSearch as $result){ ?>
    <div>
        <img src="avatars/<?php echo $result["avatar"] ?>" alt="avatar">
        <h3><?php echo htmlspecialchars($result['firstname'] . " " . $result['lastname'])?></h3>
        <h4><?php echo htmlspecialchars($result['year']) ?></h4>

    </div>
    <?php }
} ?>

    <h2 id="matchesTitle">
        Wij hebben <?php echo count($commonInterests); ?> student(en) gevonden met gelijke
            interesses!
    </h2>


    <div id="scroll">
    <div id="buddyProposalsContainer">
    <?php 
        
    foreach($commonInterests as $common){
        if($common["teller"] >= 4){
        $buddy = new BuddyMatch();
        $buddy->setMatch($common["id"]);
        $matchData = $buddy->FetchMatch();
            
    ?>

        <!-- Met de class buddyProposals kan je de css van de voorgestelde buddies veranderen -->

        <a  href="#" 
            class="buddyProposals" 
            id="<?php echo $common["id"];?>"
            onClick="reply_click(this.id)"
            >

            <img src="avatars/<?php echo $matchData["avatar"] ?>" alt="avatar">
            <div id="titlesFlex">
                <h3><?php echo htmlspecialchars($matchData["firstname"]) ?></h3>
                <h4><?php echo htmlspecialchars($matchData["year"]) ?></h4>
            </div>
            <div id="interesses">
                <p id="interessesTitle">Gelijke interesses:</p>

                <?php 
                foreach($matchData as $key1 => $match){
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
                            if($key1 == $key2 && $match == $user){ ?>
                                <div class="interesse">
                                    <p>
                                        <?php echo htmlspecialchars($key1) ?>: &nbsp;
                                    </p>
                                    <p style="font-weight:bold">
                                        <?php echo htmlspecialchars($match) ?>
                                    </p>
                                </div>
                            <?php 
                            }
                        }
                    }
                }
                ?>
            </div>
            
        </a>
        
        
        <?php
        }
    } 
    ?>


    

    </div>

    </div>

    <div id="searchBuddiesContainer">
        <h2>Of zoek hier naar buddy's !</h2>
        <p>Zoeken kan op naam of interesses.</p>
        <form action="index.php" method="POST">
            <input type="text" name="search" placeholder="Zoeken...">
            <button type="submit" name="submit-search">Zoeken</button>
        </form>
    </div>

    <?php if(isset($error)):?>
        <div class="error" style="color: white;">
        <?php echo $error;?></div>
    <?php endif;?>
    

    <script src="js/nav.js"></script>
    <script src="js/index.js"></script>


    

</body>

</html>