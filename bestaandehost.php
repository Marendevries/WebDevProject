<?php

session_start();
include "classes\config.php";
require "classes\user.php";


$input_err = $input = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["hostname"]))) {

        $input = trim(str_replace(array("'", "'"), '', $_POST['hostname']));

        //CHECK IF NAME ALREADY EXISTS IN DATABASE
        $sql = "SELECT name, player_id FROM pokerDb.player_data WHERE name = :input";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':input', $input);
        $stmt->execute();
        if($stmt->rowCount() == 0){
            echo "<script type='text/javascript'>alert('Name not found');</script>";
        }
        else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $result2 = $row['player_id'];

            //SET SESSION DATA IN DB
            $sql = "INSERT INTO pokerDb.session_game (host_name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$input]);
            //GET SESSION ID
            $sql = "SELECT MAX(session_id) FROM pokerDb.session_game";
            $stmt= $pdo->query($sql);
            $result1 = $stmt->fetch();

            //SET PLAYER GAME FOR HOST
            $sql = "INSERT INTO pokerDb.player_game (game_id, player_id_fk) VALUES ($result1[0],$result2)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute();

            //STORE ID's IN SESSION
            $_SESSION['session_game_id'] = $result1[0];
            $_SESSION['player_id'] = $result2;
            $_SESSION['is_host'] = true;
            $_SESSION['settings_id_set'] = false;

            // Redirect user to hostoverzicht page
            header("location: hostoverzicht.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bestaande host</h5>
                <form class="edit2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <p>Voer hier uw eerder gebruikte naam in</p>
                    <input pattern="[a-zA-Z]+" name=hostname type="text" required /><br>
                    <input class="back" value="Opvragen" type="submit" />
                </form><br>
                <a href="hostmenu.php"><button class=back>Terug</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>