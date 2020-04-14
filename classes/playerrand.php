<?php

include "classes/config.php";

$sql = "SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}'";
$stmt = $pdo->query($sql);
$allPlayers = $stmt->fetchall(PDO::FETCH_ASSOC);

$seat_random = new SplFixedArray(count($allPlayers));

$numberOfTablesNeeded = ceil(count($allPlayers) / 6);

$t1 = $t2 = $t3 = $t4 = $t5 = 0;

for($increment = 0; $increment < count($allPlayers); $increment++){
    $rand1 = rand(1, $numberOfTablesNeeded);
    if($rand1 == 1 && $t1 < 6){
        $seat_random[$increment] = $rand1;
        $t1++;
    }elseif($rand1 == 1 && $t1 >= 6){
        $increment--;
    }
    if($rand1 == 2 && $t2 < 6){
        $seat_random[$increment] = $rand1;
        $t2++;
    }elseif($rand1 == 2 && $t2 >= 6){
        $increment--;
    }
    if($rand1 == 3 && $t3 < 6){
        $seat_random[$increment] = $rand1;
        $t3++;
    }elseif($rand1 == 3 && $t3 >= 6){
        $increment--;
    }
    if($rand1 == 4 && $t4 < 6){
        $seat_random[$increment] = $rand1;
        $t4++;
    }elseif($rand1 == 4 && $t4 >= 6){
        $increment--;
    }
    if($rand1 == 5 && $t5 < 6){
        $seat_random[$increment] = $rand1;
        $t5++;
    }elseif($rand1 == 5 && $t5 >= 6){
        $increment--;
    }
}

for($player = 0; $player < count($allPlayers); $player++){
    $fk = $allPlayers[$player]['player_id_fk'];
    $table = $seat_random[$player];
    $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = '{$table}' WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':session_id', $_SESSION['session_game_id']);
    $stmt->execute();
}

//for ($table_id = 1; $table_id <= $numberOfTablesNeeded ; $table_id++){
//
//    for($seat_id = 1; $seat_id <= 6; $seat_id++){
//
//        $table_increment = $table_id * 6 - 7;
//        if(($table_increment+$seat_id) < count($allPlayers)) {
//            $fk = $allPlayers[($table_increment + $seat_id)]['player_id_fk'];
//            $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = :table_id WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
//            $stmt2 = $pdo->prepare($query);
//            $stmt2->bindValue(':table_id', $table_id);
//            $stmt2->bindValue(':session_id', $_SESSION['session_game_id']);
//            $stmt2->execute();
//        }
//    }
//}

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