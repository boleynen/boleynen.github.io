<?php

include_once(__DIR__ . "/classes/User.php");

session_start();

if(empty($_SESSION["id"])){
    header("Location: login.php");
}

$userPro = new User;
$userPro->setUser($_SESSION["id"]);

$data = $userPro->fetchData();

$emailVerification = true;
$required = "@student.thomasmore.be";
$requiredVerification = true;
$passwordVerification = true;
$passwordMatch1 = true;
$passwordMatch2 = true;
$imgSizeOk = false;
$descLengthOK = true;
$securePassword;
$newImg = false;


if(!empty($_POST)){
    include_once(__DIR__ . "/classes/logicProfile.php");  
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/profiel.css" />
    <link rel="stylesheet" type="text/css" href="css/navigatie.css" />
    <script src="jquery-3.4.1.min.js"></script>
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style>
</head>

<body>

    <?php include_once(__DIR__ . "/inc.hamburger.php"); ?>
    <?php include_once(__DIR__ . "/inc.nav.php"); ?>
    <h1>Profiel</h1>

    <section class="flex">

        <form id="form" action="" method="post" enctype="multipart/form-data">

            <?php if(isset($error)):?>
            <div class="error" style="color: red;"><?php echo $error;?></div>
            <?php endif;?>

            <div id="nameImg">
                <div id="oldAvatar">
                    <img src="avatars/<?php echo $data["avatar"] ?>" alt="avatar">
                </div>
                <h1>Jouw profiel</h1>
            </div>

            <div>
                <label for="avatar" class="showInput" id="changeAvatar" style="cursor: pointer;">Avatar
                    veranderen</label>
                <input type="file" accept="image/*" name="avatar" id="avatar" onchange="loadFile(event)"
                    style="display: none;">
                <img id="output" width="200" />
            </div>

            <div>
                <p>Voornaam: <?php echo htmlspecialchars($data["firstname"]) ?></p>
                <label for="firstname" class="showInput changeLabel">Verander voornaam</label>
                <input class="inputField showInput" type="text" id="firstname" name="firstname">
            </div>

            <div>
                <p>Familienaam: <?php echo htmlspecialchars($data["lastname"]) ?></p>
                <label for="lastname" class="showInput changeLabel">Verander familienaam</label>
                <input class="inputField showInput" type="text" id="lastname" name="lastname">
            </div>

            <div id="emailChange">
                <p>Email: <?php echo htmlspecialchars($data["email"]) ?></p>
                <label for="emailVerification" class="showInput changeLabel">Wachtwoord</label>
                <input class="inputField showInput" type="password" id="emailVerification" name="emailVerification">

                <label for="email" class="showInput changeLabel">Nieuw emailadres</label>
                <input class="inputField showInput" type="text" id="email" name="email">
            </div>


            <div id="passChange">
                <p class="showInput">Wachtwoord</p>
                <label for="passwordVerification" class="showInput changeLabel">Oud wachtwoord</label>
                <input class="inputField showInput" type="password" id="passwordVerification"
                    name="passwordVerification">

                <label for="password" class="showInput changeLabel">Nieuw wachtwoord</label>
                <input class="inputField showInput" type="password" id="password" name="password">

                <label for="passwordConfirmation" class="showInput changeLabel">Bevestig je nieuwe
                    wachtwoord</label>
                <input class="inputField showInput" type="password" id="passwordConfirmation"
                    name="passwordConfirmation">
            </div>



            <div>
                <p>Profieltekst: <?php echo htmlspecialchars($data["description"]) ?></p>
                <label for="description" class="showInput changeLabel">Verander profieltekst</label>
                <input class="inputField showInput" type="text" id="description" name="description">
            </div>

            <div>
                <p>Provincie: <?php echo htmlspecialchars($data["province"]) ?></p>
                <label for="province" class="showInput changeLabel">Verander provincie</label>
                <input class="inputField showInput" type="text" id="province" name="province"
                    placeholder="bv. Vlaams-Brabant">
            </div>

            <div>
                <p>Gemeente/stad: <?php echo htmlspecialchars($data["town"]) ?></p>
                <label for="town" class="showInput changeLabel">Verander gemeente/stad</label>
                <input class="inputField showInput" type="text" id="town" name="town" placeholder="bv. Mechelen">
            </div>

            <div>
                <p>Jaar: <span id="dbYear"><?php echo $data["year"] ?></span></p>
                <label for="year" class="showInput changeLabel">Verander jaar</label>
                <select class="inputField showInput" name="year" id="year">
                    <option id="select1" value="" selected="selected" disabled>Jaar</option>
                    <option value="1IMD">1 IMD 👶</option>
                    <option value="2IMD">2 IMD 👩👨</option>
                    <option value="3IMD">3 IMD 🧓👴</option>
                </select>
            </div>

            <div>
                <p>Passie: <?php echo $data["passion"] ?></p>
                <label for="passion" class="showInput changeLabel">Verander passie</label>
                <select class="inputField showInput" name="passion" id="passion">
                    <option id="select2" value="" selected="selected" disabled>Passie</option>
                    <option value="Design">Design 🖌</option>
                    <option value="Development">Development 💻</option>
                    <option value="Design&Development">Design&Development 🖌💻</option>
                </select>
            </div>

            <div>
                <p>OS: <?php echo $data["os"] ?></p>
                <label for="os" class="showInput changeLabel">Verander OS</label>
                <select class="inputField showInput" name="os" id="os">
                    <option id="select3" value="" selected="selected" disabled>OS</option>
                    <option value="Windows">Windows</option>
                    <option value="Mac">Mac</option>
                    <option value="Linux">Linux</option>
                </select>
            </div>

            <div>
                <p>Favoriet film genre: <?php echo $data["movie"] ?></p>
                <label for="movie" class="showInput changeLabel">Verander favoriet film genre</label>
                <select class="inputField showInput" name="movie" id="movie">
                    <option id="select4" value="" selected="selected" disabled>Film genre</option>
                    <option value="Actie">Actie ⚔</option>
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
                <p>Favoriet gaming platform: <?php echo $data["game"] ?></p>
                <label for="game" class="showInput changeLabel">Verander favoriet gaming platform</label>
                <select class="inputField showInput" name="game" id="game">
                    <option id="select5" value="" selected="selected" disabled>Gaming platform</option>
                    <option value="Playstation">Playstation 🎮</option>
                    <option value="Xbox">Xbox 🎮</option>
                    <option value="PC">PC 💻</option>
                    <option value="Nintendo">Nintendo 🕹</option>
                    <option value="Mobile">Mobile 📱</option>
                    <option value="geen">Ik game niet 😭</option>
                </select>
            </div>

            <div>
                <p>Favoriet game genre: <?php echo $data["gamegenre"] ?></p>
                <label for="gamegenre" class="showInput changeLabel">Verander favoriet game genre</label>
                <select class="inputField showInput" name="gamegenre" id="gamegenre">
                    <option id="select8" value="" selected="selected" disabled>Game genre</option>
                    <option value="Actie">Actie ⚔</option>
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
                <p>Favoriet muziek genre: <?php echo $data["music"] ?></p>
                <label for="music" class="showInput changeLabel">Verander favoriet muziek genre</label>
                <select class="inputField showInput" name="music" id="music">
                    <option id="select6" value="" selected="selected" disabled>Muziek genre</option>
                    <option value="Rock">Rock 🎸</option>
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
                <p>Favoriete sport: <?php echo $data["sport"] ?></p>
                <label for="sport" class="showInput changeLabel">Verander favoriete sport</label>
                <select class="inputField showInput" name="sport" id="sport">
                    <option id="select7" value="" selected="selected" disabled>Sport</option>
                    <option value="Fitness">Fitness 🏋️‍♂️</option>
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
                <p>Ik ben hier: <?php echo $data["buddy"] ?></p>
                <label for="buddy" class="showInput changeLabel">verander je doel</label>
                <select class="inputField showInput" name="buddy" id="buddy">
                    <option id="select9" value="" selected="selected" disabled>Doel</option>
                    <option id="beBuddy" value="buddy">om een buddy te zijn</option>
                    <option id="begeleider" value="begeleider">om een begeleider te zijn </option>
                </select>
            </div>

            <div>
                <input type="submit" id="submitBtn" class="hide" value="Bevestig veranderingen">
                <a href='javascript:void();' id="changeProfileBtn" onclick="changeProfile()">Profiel aanpassen</a>

            </div>

        </form>

        

    </section>
    <script src="js/profiel.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/avatarUpdate.js"></script>
</body>

</html>