<?php
session_start();
include "classes/config.php";
require "classes/user.php";

if($_SESSION['is_player'] != true )
{
    header("Location: spelermenu.php");
    exit;
}
if(!isset($_SESSION['table'])){
    $_SESSION['table'] = "Nog niet ingedeeld. Contacteer uw host.";
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
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo "Uw tafelnummer is : ", $_SESSION['table'] ?></h5>
            <?php
            $sql = "SELECT tafel FROM pokerDb.player_game WHERE player_id_fk = :player_id AND game_id = :game_id AND tafel != 0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':player_id', $_SESSION['player_id']);
            $stmt->bindValue(':game_id', $_SESSION['session_game_id']);
            $stmt->execute();
            if($stmt->rowCount() == 0){
                $_SESSION['table'] = "Nog niet ingedeeld. Contacteer uw host.";
            }else{
                $table = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['table'] = $table['tafel'];
                $sql ="SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}' AND pokerDb.player_game.tafel = '{$_SESSION['table']}' ";
                $stmt= $pdo->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $sql2 = "SELECT * FROM pokerDb.player_data WHERE player_id = '{$row['player_id_fk']}'";
                    $stmt2= $pdo->query($sql2);
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<img src="Afbeeldingen/person.png"> '.$row2['name'].' </i><br>';
                    }
                }
            }
            ?>
            <a href="spelregelsspeler.php"><button class=rulebutton>Spelregels</button></a>
            <button class=timebutton>Tijd:</button>
            <a href="fichesspeler.php"><button class=rulebutton>fiches</button></a>
            <a href="hoofdmenu.php"><button class=rulebutton>Stoppen</button></a><br>
        </div>
    </div>
</div>
</body>
</html>