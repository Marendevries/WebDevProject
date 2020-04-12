<?php
session_start();
include "config.php";
require "user.php";

if($_SESSION['is_host'] != true )
{
    header("Location: createhost.php");
    exit;
}

//MAKE ROW FOR GAME_SETTINGS IF IT DOESN'T EXIST
if($_SESSION['settings_id_set'] == false){
    $sql = "INSERT INTO pokerDb.game_settings (settings_fk) VALUES (?)";
    $stmt= $pdo->prepare($sql);
    $input = $_SESSION['session_game_id'];
    $stmt->execute([$input]);
    $_SESSION['settings_id_set'] = true;
    $_SESSION['wit'] = 25;
    $_SESSION['rood'] = 50;
    $_SESSION['groen'] = 100;
    $_SESSION['blauw'] = 200;
    $_SESSION['zwart'] = 500;
    $_SESSION['tijd'] = 300;
    $_SESSION['pot'] = 0;
    $_SESSION['Bblind'] = 50;
    $_SESSION['Sblind'] = 25;
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
            <h5 class="card-title"><?php echo "your session ID= ", $_SESSION['session_game_id'] ?></h5>
            <?php
            $sql ="SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}' ";
            $stmt= $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $sql2 = "SELECT * FROM pokerDb.player_data WHERE player_id = '{$row['player_id_fk']}'";
                $stmt2= $pdo->query($sql2);
                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<img src="Afbeeldingen/person.png"> '.$row2['name'].' </i><button class=edit>aanpassen </button><br>';
                }
            }
            ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body menu">
            <h5 class="card-title">Opties</h5>
            <a href="tafelkeuze.html"><button class=Menuknop>Tafel Selecteren</button></a><br>
            <a href="tijdmenu.php"><button class=Menuknop>Tijd</button></a><br>
            <a href="fiches.php"><button class=Menuknop>Waarde fiches</button></a><br>
            <a href="blinds.php"><button class=Menuknop>Blinds</button></a><br>
            <a href="Spelregels.html"><button class=Menuknop>Spelregels</button></a><br>
            <button class=Menuknop>Opslaan</button><br>
            <a href="Hoofdmenu.html"><button onclick="return confirm('Weet je zeker dat je wilt stoppen?')" class=Menuknop>Stoppen</button></a><br>
        </div>
    </div>
    <div class="card-group">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo "your session ID= ", $_SESSION['session_game_id'] ?></h5>
            <?php
            $sql ="SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}' ";
            $stmt= $pdo->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $sql2 = "SELECT * FROM pokerDb.player_data WHERE player_id = '{$row['player_id_fk']}' ORDER BY RAND()
                LIMIT 5";
                $stmt2= $pdo->query($sql2);
                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<img src="Afbeeldingen/person.png"> '.$row2['name'].' </i><button class=edit>aanpassen </button><br>';
                }
            }
            ?>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Huidige Tafel</h5>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
            <img src="Afbeeldingen/person.png"> Placeholder </i><a href="playeredit.html"><button class=edit> Selecteren </button></a><br>
        </div>
    </div>
</div>
</body>
</html>
