<?php
session_start();
include "classes/config.php";
require "classes/user.php";

if($_SESSION['is_player'] != true )
{
    header("Location: spelermenu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fiches Speler</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="card-group">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Waarde fiches</h5>
            <?php
            $sql ="SELECT * FROM pokerDb.game_settings WHERE settings_fk = '{$_SESSION['session_game_id']}'";
            $stmt= $pdo->query($sql);
            $chips = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<img src="Afbeeldingen/Ellipse_11.png"> '.$chips['wit_fiche'].' </i><br>';
            echo '<img src="Afbeeldingen/Ellipse_9.png"> '.$chips['rood_fiche'].' </i><br>';
            echo '<img src="Afbeeldingen/Ellipse_8.png"> '.$chips['groen_fiche'].' </i><br>';
            echo '<img src="Afbeeldingen/Ellipse_10.png"> '.$chips['blauw_fiche'].' </i><br>';
            echo '<img src="Afbeeldingen/Ellipse_12.png"> '.$chips['zwart_fiche'].' </i><br>';
            ?>
            <a href="speleroverzicht.php"><button class=back>Terug</button></a>
        </div>
    </div>
</div>
</div>
</body>