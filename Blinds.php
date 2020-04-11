<?php
session_start();
include "config.php";
require "user.php";

if($_SESSION['is_host'] != true )
{
    header("Location: createhost.php");
    exit;
}

$Bblind = $Sblind = "";
$Bblind_err = $Sblind_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //IF VARIABLES NOT CHANGED
    if ($_POST['Bblind'] == $_SESSION['Bblind'] && $_POST['Sblind'] == $_SESSION['Sblind']){
    }else{
        if (empty(trim($_POST['Bblind']))){
            $Bblind_err = "Please enter a value";
        }else{
            $Bblind = $_POST['Bblind'];
        }
        if (empty(trim($_POST['Sblind']))){
            $Sblind_err = "Please enter a value";
        }else{
            $Sblind = $_POST['Sblind'];
        }
        if (empty($Sblind_err&&$Bblind_err)){
            $sql = "UPDATE pokerDb.game_settings SET B_blind = ?, S_blind = ? WHERE settings_fk = '{$_SESSION['session_game_id']}'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$Bblind, $Sblind]);
            $_SESSION['Bblind'] = $Bblind;
            $_SESSION['Sblind'] = $Sblind;
            $success = "Succesfully updated values!";
            echo "<script type='text/javascript'>alert('$success');</script>";
        }else{
            $success = "Something went wrong!";
            echo "<script type='text/javascript'>alert('$success');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card-body-blinds">
     <div class="card">
        <div class="card-body-blinds">
            <h5 class="card-title">Waarde fiches</h5>
            <form action="Blinds.php" method="post" class="edit2">
                <img style="margin-right: 16px" id="blindellips" src="Afbeeldingen/ellipse_13.png"> Inzet Big blind </i>
                <input pattern="\d*" type="text" value="<?php echo $_SESSION['Bblind'] ?>" name="Bblind"required style="margin-right: 40px"><br>
                <img id="blindellips" src="Afbeeldingen/Ellipse_10.png"> Inzet Small blind </i>
                <input pattern="\d*" type="text" value="<?php echo $_SESSION['Sblind'] ?>" name="Sblind"required style="margin-right: 40px"><br>
                <input id="submitblind" value="Aanpassen" type="submit" />
            </form><br>
            <a href="hostoverzicht.php"><button class=back style="margin-right: 70px" >Terug</button></a>
        </div>
        </div>
    </div>
</div>
</body>