<?php

include "classes/config.php";

$sql = "SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}'";
$stmt = $pdo->query($sql);
$allPlayers = $stmt->fetchall(PDO::FETCH_ASSOC);

$numberOfTablesNeeded = ceil(count($allPlayers) / 6);
for ($table_id = 1; $table_id <= $numberOfTablesNeeded ; $table_id++){

    for($seat_id = 1; $seat_id <= 6; $seat_id++){

        if(($table_id*$seat_id)-1 < count($allPlayers)) {
            $table_increment = $table_id * 6 - 7;
            $fk = $allPlayers[($table_increment + $seat_id)]['player_id_fk'];
            $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = :table_id WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
            $stmt2 = $pdo->prepare($query);
            $stmt2->bindValue(':table_id', $table_id);
            $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
            $stmt2->execute();
        }
    }
}

//        if(($table_id*$seat_id)-1 < count($allPlayers)) {
//            $table_increment = $table_id * 6 - 7;
//            $fk = $allPlayers[(-1 + $seat_id)]['player_id_fk'];
//            $fk2 = $allPlayers[(5 + $seat_id)]['player_id_fk'];
//            $fk3 = $allPlayers[(11 + $seat_id)]['player_id_fk'];
//            $fk4 = $allPlayers[(17 + $seat_id)]['player_id_fk'];
//            $fk5 = $allPlayers[(23 + $seat_id)]['player_id_fk'];
//            $fk = $allPlayers[($table_increment + $seat_id)]['player_id_fk'];
//            $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = 1 WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//            $stmt2 = $pdo->prepare($query);
//            $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//            $stmt2->execute();
//        }
//
//for ($i = 0; $i < (count($allPlayers)); $i++) {
//    $table_id = floor($i / 6);
//    $fk = $allPlayers[$i]['player_id_fk'];
//    $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = '{$table_id}' WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//    $stmt2 = $pdo->prepare($query);
//    $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//    $stmt2->execute();
//}

//if(($table_id*$seat_id)-1 < count($allPlayers)) {
//    $fk = $allPlayers[($table_id*$seat_id)-1]['player_id_fk'];
//    $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = 1 WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//    $stmt2 = $pdo->prepare($query);
//    $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//    $stmt2->execute();
//}

//if($table_id == 1){
//    if(($table_id*$seat_id)-1 < count($allPlayers)) {
//        $fk = $allPlayers[($table_id*$seat_id)-1]['player_id_fk'];
//        $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = 1 WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//        $stmt2 = $pdo->prepare($query);
//        $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//        $stmt2->execute();
//    }
//}
//if($table_id == 2){
//    if(($table_id*$seat_id)-1 < count($allPlayers)) {
//        $fk = $allPlayers[$seat_id+5]['player_id_fk'];
//        $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = 2 WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//        $stmt2 = $pdo->prepare($query);
//        $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//        $stmt2->execute();
//    }
//}