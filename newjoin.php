<?php

session_start();
include "classes\config.php";
require "classes\user.php";

$player_name = $toernooi_id  =  "";
$id_err = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["playername"]))&&!empty(trim($_POST['toernooi_id']))) {

        $player_name = trim(str_replace(array("'", "'"), '', $_POST['playername']));
        $toernooi_id = trim(str_replace(array("'", "'"), '', $_POST['toernooi_id']));

        $sql = "SELECT session_id FROM pokerDb.session_game WHERE session_id = $toernooi_id AND is_active = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        //CHECK IF SESSION ID IS REAL AND ACTIVE
        if($stmt->rowCount() == 0){
            $id_err = true;
        }

        //CHECK IF NAME ALREADY EXISTS IN DATABASE
        $sql = "SELECT name FROM pokerDb.player_data WHERE name = :playername";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':playername', $player_name);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            echo "<script type='text/javascript'>alert('Name already exists.');</script>";
        }elseif($id_err == false){
            //SET PLAYER DATA IN DB
            $sql = "INSERT INTO pokerDb.player_data (name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$player_name]);
            //GET HOST PLAYER ID
            $sql = "SELECT player_id FROM pokerDb.player_data WHERE name='$player_name'";
            $stmt= $pdo->query($sql);
            $result2 = $stmt->fetch();

            //SET SESSION DATA IN DB
            $sql = "INSERT INTO pokerDb.session_game (host_name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$player_name]);
            //GET SESSION ID
            $sql = "SELECT MAX(session_id) FROM pokerDb.session_game";
            $stmt= $pdo->query($sql);
            $result1 = $stmt->fetch();

            //SET PLAYER GAME FOR PLAYER
            $sql = "INSERT INTO pokerDb.player_game (game_id, player_id_fk) VALUES ($result1[0],$result2[0])";
            $stmt= $pdo->prepare($sql);
            $stmt->execute();

            //STORE ID's IN SESSION
            $_SESSION['session_game_id'] = $result1[0];
            $_SESSION['player_id'] = $result2[0];
            $_SESSION['is_host'] = false;

            // Redirect user to hostoverzicht page
            header("location: speleroverzicht.php");
            exit;
        }elseif($id_err == true){
            echo "<script type='text/javascript'>alert('Geen toernooi met dit ID gevonden');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<head>
    <title>Page Title</title>
</head>
<body>
<div class="container">
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Join game new player</h5>
                <form class="edit2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <p>Voer hier uw naam in</p>
                    <input pattern="[a-zA-Z]+" name=playername type="text" required /><br>
                    <br>
                    <p>Voer hier het toernooi ID in</p>
                    <input type="text" pattern="\d*" name="toernooi_id" required><br>
                    <input class="back" value="Join" type="submit" />
                </form><br>
                <a href="spelermenu.php"><button class=back>Terug</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>