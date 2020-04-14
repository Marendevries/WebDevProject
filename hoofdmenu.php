<?php
session_start();
if (!isset($_SESSION['is_host'])){
    $_SESSION['is_host'] = false;
}
if (!isset($_SESSION['is_player'])){
    $_SESSION['is_player'] = false;
}
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<head>
    <title>Hoofdmenu</title>
</head>
<body>
<div class="container">
    <div>
        <button class="Knop" name="HostToernooi" onClick="document.location.href='hostmenu.php'"> Host Toernooi </button>
    </div>
    <div><button class="Knop" name="JoinToernooi" onClick="document.location.href='spelermenu.php'">Join Toernooi</button> </div>
    <?php if (isset($_SESSION['session_game_id'])){
        echo     '<div><button class="Knop"name="destroy" onClick="document.location.href=\'destroy.php\'">Verlaat spel(Host blijft)</button> </div>';
    }  ?>
        <?php if ($_SESSION['is_host'] != false){
        echo     '<div><button class="Knop"name="destroyhost" onClick="document.location.href=\'destroyhost.php\'">Eindig Toernooi</button> </div>';
    }  ?>
</div>
</body>
</html>