<?php

session_start();
include "config.php";
require "user.php";

$input_err = $input = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["hostname"]))) {
        $input_err = "Please enter name.";
    } else {

        $input = trim(str_replace(array("'", "'"), '', $_POST['hostname']));

        //CHECK IF NAME ALREADY EXISTS IN DATABASE
        $already_exists = false;
        $sql = "SELECT name FROM pokerDb.player_data WHERE name = :input";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':input', $input);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $already_exists = true;
            $input_err = "Name already exists.";
        }
        else{
            //SET PLAYER DATA IN DB
            $sql = "INSERT INTO pokerDb.player_data (name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$input]);
            //GET HOST PLAYER ID
            $sql = "SELECT player_id FROM pokerDb.player_data WHERE name='$input'";
            $stmt= $pdo->query($sql);
            $result2 = $stmt->fetch();

            //SET SESSION DATA IN DB
            $sql = "INSERT INTO pokerDb.session_game (host_name) VALUES (?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$input]);
            //GET SESSION ID
            $sql = "SELECT MAX(session_id) FROM pokerDb.session_game";
            $stmt= $pdo->query($sql);
            $result1 = $stmt->fetch();

            //SET PLAYER GAME FOR HOST
            $sql = "INSERT INTO pokerDb.player_game (game_id, player_id_fk) VALUES ($result1[0],$result2[0])";
            $stmt= $pdo->prepare($sql);
            $stmt->execute();

            //STORE ID's IN SESSION
            $_SESSION['session_game_id'] = $result1[0];
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
    <title>Happy Brides</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="maincss.css">

</head>
<body>

<!-- Masthead -->
<header class="masthead text-white text-center masthead">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-row">
                        <div class="col-12 col-md-9 mb-2 mb-md-0">
                            <input name="hostname" type="text" class="form-control form-control-lg">
                        </div>
                        <div class="col-12 col-md-3">
                            <button id="code" class="btn btn-block btn-lg btn-primary" >Enter!</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<!-- Masthead -->
</body>
</html>