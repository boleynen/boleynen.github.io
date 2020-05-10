<?php

include_once(__DIR__ . "/classes/User.php");

session_start();

if(empty($_SESSION["id"])){
    header("Location: login.php");
}



$userComp = new User;
$userComp->setId($_SESSION["id"]);

$imgSizeOk = false;
$descLengthOK = true;

if(!empty($_POST)){
    try {

        $fileSize = $_FILES["avatar"]["size"];

        if($fileSize < 2000000){
            $imgSizeOk = true;
        }
        else{
            throw new Exception("Je profielfoto heeft een grotere file size dan is toegelaten (max 2MB)");
            $imgSizeOk = false;
        }

        if(strlen($_POST["description"]) <= 300){
            $descLengthOK = true;
        }
        else{
            throw new Exception("Je profieltekst is te lang (max 300 tekens)");
            $descLengthOK = false;
        }

        $img = $_FILES["avatar"]["name"];

        $userComp->setImagePath($img);
        $userComp->setYear($_POST["year"]);
        $userComp->setDescription($_POST["description"]);
        $userComp->setProvince($_POST["province"]);
        $userComp->setTown($_POST["town"]);
        $userComp->setPassion($_POST["passion"]);
        $userComp->setOs($_POST["os"]);
        $userComp->setMovie($_POST["movie"]);
        $userComp->setGame($_POST["game"]);
        $userComp->setGamegenre($_POST["gamegenre"]);
        $userComp->setMusic($_POST["music"]);
        $userComp->setSport($_POST["sport"]);
        $userComp->setBuddy($_POST["buddy"]);
       
        if($imgSizeOk == true && $descLengthOK == true){
        $userComp->completion();
        
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "avatars/$img"); 
        header("Location: index.php");
        }
       
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/profielVervoledigen.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style> 
</head>
<body>
    
<section>

<form action="" method="post" enctype="multipart/form-data">

<h2>Vervolledig je profiel</h2>

    <?php if(isset($error)):?>
        <div class="error" style="color: red;">
        <?php echo $error;?></div>
    <?php endif;?>

    <div>
        <label for="avatar" id="avatarLabel" style="cursor: pointer;">Klik hier om een avatar te kiezen</label>
        <input type="file"  accept="image/*" name="avatar" id="avatar"  onchange="loadFile(event)" style="display: none;">
        <img id="output" width="150" />
    </div>

    <div>
        <label for="description">Profieltekst (niet verplicht)</label>
        <input type="text" id="description" name="description">
    </div>

    <div>
        <label for="province">Woonplaats: provincie</label>
        <input type="text" id="province" name="province" placeholder="bv. Vlaams-Brabant">
    </div>

    <div>
        <label for="town">Woonplaats: gemeente/stad</label>
        <input type="text" id="town" name="town" placeholder="bv. Mechelen">
    </div>

    <div>
        <label for="year">Jaar</label>
        <select name="year" id="year">
            <option value="1IMD" selected="selected">1 IMD 👶</option>
            <option value="2IMD">2 IMD 👩👨</option>
            <option value="3IMD">3 IMD 🧓👴</option>
        </select>
    </div>

    <div>
        <label for="passion">Passie</label>
        <select name="passion" id="passion">
            <option value="Design" selected="selected">Design 🖌</option>
            <option value="Development">Development 💻</option>
            <option value="Design&Development">Design&Development 🖌💻</option>
        </select>
    </div>

    <div>
        <label for="os">OS</label>
        <select name="os" id="os">
            <option value="Windows" selected="selected">Windows</option>
            <option value="Mac">Mac</option>
            <option value="Linux">Linux</option>
        </select>
    </div>

    <div>
        <label for="movie">Favoriet film genre</label>
        <select name="movie" id="movie">
            <option value="Actie" selected="selected">Actie ⚔</option>
            <option value="Avontuur">Avontuur 🗺</option>
            <option value="Komedie">Komedie 🤣</option>
            <option value="Drama">Drama 😧</option>
            <option value="Horror">Horror 🎃</option>
            <option value="Romantisch">Romantisch 💋</option>
            <option value="Sciencefiction">Sciencefiction 🚀</option>
            <option value="Thriller">Thriller 😱</option>
        </select>
    </div>

    <div>
        <label for="game">Favoriet gaming platform</label>
        <select name="game" id="game">
            <option value="Playstation" selected="selected">Playstation 🎮</option>
            <option value="Xbox">Xbox 🎮</option>
            <option value="PC">PC 💻</option>
            <option value="Nintendo">Nintendo 🕹</option>
            <option value="Mobile">Mobile 📱</option>
            <option value="geen">Ik game niet 😭</option>
        </select>
    </div>

    <div>
        <label for="gamegenre">Favoriet game genre</label>
        <select name="gamegenre" id="gamegenre">
            <option value="Actie" selected="selected">Actie ⚔</option>
            <option value="Avontuur">Avontuur 🗺</option>
            <option value="Role-Playing">Role-Playing 🕵️‍♂️</option>
            <option value="Simulatie">Simulatie 👨‍👩‍👧‍👦</option>
            <option value="Strategie">Strategie 🧠</option>
            <option value="Sport">Sport ⚽</option>
            <option value="Racing">Racing 🚗</option>
            <option value="geen">Ik game niet 😭</option>
        </select>
    </div>

    <div>
        <label for="music">Favoriet muziek genre</label>
        <select name="music" id="music">
            <option value="Rock" selected="selected">Rock 🎸</option>
            <option value="Metal">Metal 🤘</option>
            <option value="Klassiek">Klassiek 🎻</option>
            <option value="Schlager">Schlager 🍻</option>
            <option value="Jazz">Jazz 🎷</option>
            <option value="R&B">R&B 🎶</option>
            <option value="Pop">Pop 🎉</option>
            <option value="Electronic">Electronic 💻</option>
            <option value="Rap">Rap 🤯</option>
            <option value="Latin">Latin 🏝</option>
        </select>
    </div>

    <div>
        <label for="sport">Favoriete sport</label>
        <select name="sport" id="sport">
            <option value="Fitness" selected="selected">Fitness 🏋️‍♂️</option>
            <option value="Voetbal">Voetbal ⚽</option>
            <option value="Basketbal">Basketbal 🏀</option>
            <option value="Volleybal">Volleybal 🏐</option>
            <option value="Gevechtssport">Gevechtssport 👊</option>
            <option value="Tennis">Tennis 🥎</option>
            <option value="Zwemmen">Zwemmen 🏊‍♂️</option>
            <option value="geen">Ik sport niet 😭</option>
        </select>
    </div>

    <div>
        <label for="buddy">Ik ben hier</label>
        <select name="buddy" id="buddy">
            <option id="beBuddy" value="buddy" selected="selected">om een buddy te zijn</option>
            <option id="begeleider" value="begeleider">om een begeleider te zijn</option>
        </select>
    </div>
    
    
    <div class="submitBtn">
    	<input type="submit" id="submitBtn" value="Bevestig">	
    </div>


</form>

</section>

<script src="js/profielVervolledigen.js"></script>

</body>
</html>