<?php 
include_once(__DIR__ . "/classes/buddyRequest.php");


$notification = new Request();

$notification->setReceiver($_SESSION['id']);

$dt = $notification->getNotification();

if($dt){
    $n = "visible";
}else{
    $n = "not-visible";
}

?>


<div id="nav-container">
    <img src="images/woordlogo.png" alt="logo">
    <button class="hamburger hamburger--spin" onclick="showNav()" type="button">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>

    </button>
    <nav id="webNav">
        <a href="index.php">Home</a>
        <a href="profiel.php">Profiel</a>
        <a href="chat.php">Chat</a>
        <a href="buddies.php"><span class="notificatie <?php echo $n ?>">&nbsp;</span>Jouw buddies</a>
        <a href="logout.php">Logout</a>
    </nav>
</div>
