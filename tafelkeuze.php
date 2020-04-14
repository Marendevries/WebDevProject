<?php
session_start();
include "classes/config.php";

if($_SESSION['is_host'] != true )
{
    header("Location: createhost.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['t1'])){
        $_SESSION['table'] = 1;
        header("Location: hostoverzicht.php");
    }
    if (isset($_POST['t2'])){
        $_SESSION['table'] = 2;
        header("Location: hostoverzicht.php");
    }
    if (isset($_POST['t3'])){
        $_SESSION['table'] = 3;
        header("Location: hostoverzicht.php");
    }
    if (isset($_POST['t4'])){
        $_SESSION['table'] = 4;
        header("Location: hostoverzicht.php");
    }
    if (isset($_POST['t5'])){
        $_SESSION['table'] = 5;
        header("Location: hostoverzicht.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Poker Management</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tafel Selecteren</h5>
            <form action="tafelkeuze.php" method="post" ><img src="Afbeeldingen/table.png"> Tafel 1 </i><button name="t1" type="submit" class="edit2"> Selecteren </button></form><br>
            <form action="tafelkeuze.php" method="post" ><img src="Afbeeldingen/table.png"> Tafel 2 </i><button name="t2" type="submit" class="edit2"> Selecteren </button></form><br>
            <form action="tafelkeuze.php" method="post" ><img src="Afbeeldingen/table.png"> Tafel 3 </i><button name="t3" type="submit" class="edit2"> Selecteren </button></form><br>
            <form action="tafelkeuze.php" method="post" ><img src="Afbeeldingen/table.png"> Tafel 4 </i><button name="t4" type="submit" class="edit2"> Selecteren </button></form><br>
            <form action="tafelkeuze.php" method="post" ><img src="Afbeeldingen/table.png"> Tafel 5 </i><button name="t5" type="submit" class="edit2"> Selecteren </button></form><br>
            <a href="hostoverzicht.php"><button class=back>Terug</button></a>
        </div>
    </div>
</div>
</body>