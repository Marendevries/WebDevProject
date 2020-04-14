<?php

session_start();
include "classes/config.php";

if($_SESSION['is_host'] == true){
    header("Location: hostoverzicht.php");
}
if($_SESSION['is_player'] == true){
    header("Location: speleroverzicht.php");
}

$input = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["hostname"]))) {

        $input = trim(str_replace(array("'", "'"), '', $_POST['hostname']));

        //CHECK IF NAME ALREADY EXISTS IN DATABASE
        $sql = "SELECT name FROM pokerDb.player_data WHERE name = :input";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':input', $input);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            echo "<script type='text/javascript'>alert('Name already exists.');</script>";
        }
        else{
            //SET PLAYER DATA IN DB
            $sql = "INSERT INTO pokerDb.player_data (name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$input]);
            //GET HOST PLAYER ID
            $sql = "SELECT player_id FROM pokerDb.player_data WHERE name = :input";
            $stmt= $pdo->prepare($sql);
            $stmt->bindValue(':input', $input);
            $stmt->execute();
            $result2 = $stmt->fetch();

            //SET SESSION DATA IN DB
            $sql = "INSERT INTO pokerDb.session_game (host_name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$input]);
            //GET SESSION ID
            $result1 = $pdo->lastInsertId();

            //SET PLAYER GAME FOR HOST
            $sql = "INSERT INTO pokerDb.player_game (game_id, player_id_fk) VALUES ($result1,$result2[0])";
            $stmt= $pdo->prepare($sql);
            $stmt->execute();

            //STORE ID's IN SESSION
            $_SESSION['session_game_id'] = $result1;
            $_SESSION['player_id'] = $result2[0];
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
    <title>Create new host</title>
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
             <h5 class="card-title">Nieuwe hostnaam aanmaken</h5>
                <form class="edit2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                     <p>Voer hier een nieuwe hostnaam in</p>
                     <input pattern="[a-zA-Z]+" name=hostname type="text" required /><br>
                     <input class="back" value="Aanmaken" type="submit" />
                </form><br>
             <a href="hostmenu.php"><button class=back>Terug</button></a>
         </div>
        </div>
    </div>
</div>
</body>
</html>