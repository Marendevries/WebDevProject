<?php

session_start();
include "classes\config.php";

if($_SESSION['is_player'] == true){
    header("Location: speleroverzicht.php");
}
if($_SESSION['is_host'] == true){
    header("Location: hostoverzicht.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty(trim($_POST["playername"]))) {
        $player_name = $_POST['playername'];
          //CHECK IF NAME ALREADY EXISTS IN DATABASE
          $sql = "SELECT player_id FROM pokerDb.player_data WHERE name = :playername";
          $stmt = $pdo->prepare($sql);
          $stmt->bindValue(':playername', $player_name);
          $stmt->execute();
          if($stmt->rowCount() == 0) {
              echo "<script type='text/javascript'>alert('Name not found.');</script>";
          }elseif($id_err == false){
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $result2 = $row['player_id'];
              
            //STORE ID's IN SESSION
            $_SESSION['session_game_id'] = '40';
            $_SESSION['player_id'] = $result2;
            $_SESSION['is_player'] = true;
            $_SESSION['test'] = true;

            $sql = "SELECT tafel FROM pokerDb.player_game WHERE player_id_fk = :player_id AND game_id = :game_id AND tafel != 0";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':player_id', $_SESSION['player_id']);
            $stmt->bindValue(':game_id', $_SESSION['session_game_id']);
            $stmt->execute();
            
                $table = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['table'] = $table['tafel'];

            // Redirect user to hostoverzicht page
            header("location: speleroverzicht.php");
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
    <title>New user join game</title>
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
                    <input class="back" value="Join" type="submit" />
                </form><br>
                <a href="spelermenu.php"><button class=back>Terug</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>