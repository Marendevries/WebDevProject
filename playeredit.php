<?php
session_start();
include "classes/config.php";

if($_SESSION['is_host'] != true )
{
    header("Location: createhost.php");
    exit;
}
if($_SESSION['is_player'] == true){
    header("Location: speleroverzicht.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['rebuy_name'])){
        $_SESSION['player_edit'] = $_POST['rebuy_name'];
    }
    if(isset($_POST['ingekocht'])){
        $ingekocht = $_POST['ingekocht'];
        $rebuy = $_POST['rebuy'];
        $data =[
            'rebuy' => $rebuy,
            'bought' => $ingekocht,
            'player_id' => $_SESSION['player_id'],
            'game_id' => $_SESSION['session_game_id'],
        ];
        $sql = "UPDATE pokerDb.player_game SET rebuy =:rebuy, has_paid =:bought WHERE player_id_fk =:player_id AND game_id =:game_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

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
  <div class="card-group">
  <div class="card">
      <div class="card-body">
          <h5 style="width: 30rem" class="card-title"><?php echo 'Speler: ' , $_SESSION['player_edit'] ?></h5>
          <form action="playeredit.php" method="POST">
              <label id="rebuybox"> Ingekocht </label>
              <input type="hidden" name="ingekocht" value="0"/>
              <input type="checkbox" name="ingekocht"value="1" />
              <br>
              <label id="rebuybox"> Rebuy </label>
              <input type="hidden" name="rebuy" value="0"/>
              <input type="checkbox" value="1" name="rebuy">
              <br>
              <button type="submit" style="float: left" class="edit">Submit</button>
              <br><br>
          </form>
          <a href="hostoverzicht.php"><button class=back>Terug</button></a>
      </div>
  </div>
</div>
  </div>
</body>