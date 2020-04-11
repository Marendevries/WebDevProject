<?php
session_start();
include "config.php";
require "user.php";

if($_SESSION['is_host'] != true )
{
    header("Location: test.php");
    exit;
}
$wit = $rood = $groen = $blauw = $zwart = "";
$wit_err = $rood_err = $groen_err = $blauw_err = $zwart_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //IF VARIABLES ARE NOT CHANGED EXIT
    if ($_POST['wit'] == $_SESSION['wit'] && $_POST['rood'] == $_SESSION['rood'] && $_POST['groen'] == $_SESSION['groen']
        && $_POST['blauw'] == $_SESSION['blauw'] && $_POST['zwart'] == $_SESSION['zwart']){
    }else{
        if (empty(trim($_POST['wit']))){
            $wit_err = "Please enter value";
        }else{
            $wit = trim($_POST['wit']);
        }
        if (empty(trim($_POST['rood']))){
            $rood_err = "Please enter value";
        }else{
            $rood = trim($_POST['rood']);
        }
        if (empty(trim($_POST['groen']))){
            $groen_err = "Please enter value";
        }else{
            $groen = trim($_POST['groen']);
        }
        if (empty(trim($_POST['blauw']))){
            $blauw_err = "Please enter value";
        }else{
            $blauw = trim($_POST['blauw']);
        }
        if (empty(trim($_POST['zwart']))){
            $zwart_err = "Please enter value";
        }else{
            $zwart = trim($_POST['zwart']);
        }
        if (empty($wit_err)&&empty($rood_err)&&empty($groen_err)&&empty($blauw_err)&&empty($zwart_err)){
            $sql = "UPDATE pokerDb.game_settings SET wit_fiche=?, rood_fiche=?, groen_fiche=?, blauw_fiche=?, zwart_fiche=? WHERE settings_fk = '{$_SESSION['session_game_id']}'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$wit, $rood, $groen, $blauw, $zwart]);
            $_SESSION['wit'] = $wit;
            $_SESSION['rood'] = $rood;
            $_SESSION['groen'] = $groen;
            $_SESSION['blauw'] = $blauw;
            $_SESSION['zwart'] = $zwart;
            $success = "Successfully changed values!";
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
    <div class="card-group-blinds2">
        <div class="card">
         <div class="card-body-blinds2" style="background: url(Afbeeldingen/wood.jpg)">
             <h5 class="card-title">Waarde fiches</h5>
             <form class="edit2" method="post" action="fiches.php">
                 <img style="margin-right: 50px" class="elips" src="Afbeeldingen/Ellipse_11.png"></i><input pattern="\d*" type="text" value="<?php echo $_SESSION['wit'] ?>" name="wit"required><br>
                 <img style="margin-right: 50px" class="elips" src="Afbeeldingen/Ellipse_9.png"></i><input pattern="\d*" type="text" value="<?php echo $_SESSION['rood'] ?>" name="rood"required><br>
                 <img style="margin-right: 50px" class="elips" src="Afbeeldingen/Ellipse_8.png"></i><input pattern="\d*" type="text" value="<?php echo $_SESSION['groen'] ?>" name="groen"required><br>
                 <img style="margin-right: 50px" class="elips" src="Afbeeldingen/Ellipse_10.png"></i><input pattern="\d*" type="text" value="<?php echo $_SESSION['blauw'] ?>" name="blauw"required><br>
                 <img style="margin-right: 50px" class="elips" src="Afbeeldingen/Ellipse_12.png"></i><input pattern="\d*" type="text" value="<?php echo $_SESSION['zwart'] ?>" name="zwart"required><br>
                 <a><button class="back" type="submit">submit</button></a>
             </form>
            <a href="hostoverzicht.php"><button class=back>Terug</button></a>
         </div>
        </div>
    </div>
</div>
</body>