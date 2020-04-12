<?php
session_start();
include "classes\config.php";
require "classes\user.php";


if($_SESSION['is_host'] != true )
{
    header("Location: createhost.php");
    exit;
}


if($_SERVER["REQUEST_METHOD"] == "POST"){
    //IF VARIABLES NOT CHANGED
    if ($_POST['time'] == $_SESSION['time']){
    }else{
        if (empty(trim($_POST['time']))){
            $time_err = "Please enter a value";
        }else{
            $time = $_POST['time'];
        }
    
        if (empty($time_err)){
            $sql = "UPDATE pokerDb.game_settings SET tijd = ? WHERE settings_fk = '{$_SESSION['session_game_id']}'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$time]);
            $_SESSION['time'] = $time;
          
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
            <h5 class="card-title">Zet de tijd</h5>
            <form action="tijd.php" method="post" class="edit2">
                <img style="margin-right: 16px" id="time" src=""> Tijd aanpassen </i>
                <input pattern="\d*" type="text" value="<?php echo $_SESSION['time'] ?>" name="time"required style="margin-right: 40px"><br>
                <input id="submittime" value="Aanpassen" type="submit" class="timechange" />
            </form><br>
            <a href="hostoverzicht.php"><button class=back style="margin-right: 70px" >Terug</button></a>
        </div>
        </div>
    </div>
</div>
</body>
