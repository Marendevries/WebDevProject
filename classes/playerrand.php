<?php

include "classes/config.php";

$sql = "SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}'";
$stmt = $pdo->query($sql);
$allPlayers = $stmt->fetchall(PDO::FETCH_ASSOC);

$seat_random = new SplFixedArray(count($allPlayers));

$numberOfTablesNeeded = ceil(count($allPlayers) / 6);

$t1 = $t2 = $t3 = $t4 = $t5 = 0;


if(count($allPlayers) % 6 == 0){
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
}elseif(count($allPlayers) % 5 == 0){
    for($increment = 0; $increment < count($allPlayers); $increment++){
        $rand1 = rand(1, $numberOfTablesNeeded);
        if($rand1 == 1 && $t1 < 5){
            $seat_random[$increment] = $rand1;
            $t1++;
        }elseif($rand1 == 1 && $t1 >= 5){
            $increment--;
        }
        if($rand1 == 2 && $t2 < 5){
            $seat_random[$increment] = $rand1;
            $t2++;
        }elseif($rand1 == 2 && $t2 >= 5){
            $increment--;
        }
        if($rand1 == 3 && $t3 < 5){
            $seat_random[$increment] = $rand1;
            $t3++;
        }elseif($rand1 == 3 && $t3 >= 5){
            $increment--;
        }
        if($rand1 == 4 && $t4 < 5){
            $seat_random[$increment] = $rand1;
            $t4++;
        }elseif($rand1 == 4 && $t4 >= 5){
            $increment--;
        }
        if($rand1 == 5 && $t5 < 5){
            $seat_random[$increment] = $rand1;
            $t5++;
        }elseif($rand1 == 5 && $t5 >= 5){
            $increment--;
        }
    }
}elseif(count($allPlayers) % 5 == 1 && count($allPlayers) != 6){
    for($increment = 0; $increment < count($allPlayers); $increment++){
        $rand1 = rand(1, $numberOfTablesNeeded);
        if($rand1 == 1 && $t1 < 6){
            $seat_random[$increment] = $rand1;
            $t1++;
        }elseif($rand1 == 1 && $t1 >= 6){
            $increment--;
        }
        if($rand1 == 2 && $t2 < 5){
            $seat_random[$increment] = $rand1;
            $t2++;
        }elseif($rand1 == 2 && $t2 >= 5){
            $increment--;
        }
        if($rand1 == 3 && $t3 < 5){
            $seat_random[$increment] = $rand1;
            $t3++;
        }elseif($rand1 == 3 && $t3 >= 5){
            $increment--;
        }
        if($rand1 == 4 && $t4 < 5){
            $seat_random[$increment] = $rand1;
            $t4++;
        }elseif($rand1 == 4 && $t4 >= 5){
            $increment--;
        }
        if($rand1 == 5 && $t5 < 5){
            $seat_random[$increment] = $rand1;
            $t5++;
        }elseif($rand1 == 5 && $t5 >= 5){
            $increment--;
        }
    }
}elseif(count($allPlayers) % 5 == 2 && count($allPlayers) != 7){
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
        if($rand1 == 3 && $t3 < 5){
            $seat_random[$increment] = $rand1;
            $t3++;
        }elseif($rand1 == 3 && $t3 >= 5){
            $increment--;
        }
        if($rand1 == 4 && $t4 < 5){
            $seat_random[$increment] = $rand1;
            $t4++;
        }elseif($rand1 == 4 && $t4 >= 5){
            $increment--;
        }
        if($rand1 == 5 && $t5 < 5){
            $seat_random[$increment] = $rand1;
            $t5++;
        }elseif($rand1 == 5 && $t5 >= 5){
            $increment--;
        }
    }
}elseif(count($allPlayers) % 5 == 3 && count($allPlayers) % 6 != 0 && count($allPlayers) != 8){
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
        if($rand1 == 4 && $t4 < 5){
            $seat_random[$increment] = $rand1;
            $t4++;
        }elseif($rand1 == 4 && $t4 >= 5){
            $increment--;
        }
        if($rand1 == 5 && $t5 < 5){
            $seat_random[$increment] = $rand1;
            $t5++;
        }elseif($rand1 == 5 && $t5 >= 5){
            $increment--;
        }
    }
}elseif(count($allPlayers) % 5 == 4 && count($allPlayers) % 6 != 0 && count($allPlayers) != 29){
    for($increment = 0; $increment < count($allPlayers); $increment++){
        $rand1 = rand(1, $numberOfTablesNeeded);
        if($rand1 == 1 && $t1 < 5){
            $seat_random[$increment] = $rand1;
            $t1++;
        }elseif($rand1 == 1 && $t1 >= 5){
            $increment--;
        }
        if($rand1 == 2 && $t2 < 4){
            $seat_random[$increment] = $rand1;
            $t2++;
        }elseif($rand1 == 2 && $t2 >= 4){
            $increment--;
        }
        if($rand1 == 3 && $t3 < 5){
            $seat_random[$increment] = $rand1;
            $t3++;
        }elseif($rand1 == 3 && $t3 >= 5){
            $increment--;
        }
        if($rand1 == 4 && $t4 < 5){
            $seat_random[$increment] = $rand1;
            $t4++;
        }elseif($rand1 == 4 && $t4 >= 5){
            $increment--;
        }
    }
}elseif(count($allPlayers) == 7){
    for($increment = 0; $increment < count($allPlayers); $increment++){
        $rand1 = rand(1, $numberOfTablesNeeded);
        if($rand1 == 1 && $t1 < 4){
            $seat_random[$increment] = $rand1;
            $t1++;
        }elseif($rand1 == 1 && $t1 >= 4){
            $increment--;
        }
        if($rand1 == 2 && $t2 < 3){
            $seat_random[$increment] = $rand1;
            $t2++;
        }elseif($rand1 == 2 && $t2 >= 3){
            $increment--;
        }
    }
}elseif(count($allPlayers) == 8){
    for($increment = 0; $increment < count($allPlayers); $increment++){
        $rand1 = rand(1, $numberOfTablesNeeded);
        if($rand1 == 1 && $t1 < 4){
            $seat_random[$increment] = $rand1;
            $t1++;
        }elseif($rand1 == 1 && $t1 >= 4){
            $increment--;
        }
        if($rand1 == 2 && $t2 < 4){
            $seat_random[$increment] = $rand1;
            $t2++;
        }elseif($rand1 == 2 && $t2 >= 4){
            $increment--;
        }}}



for($player = 0; $player < count($allPlayers); $player++){
    $fk = $allPlayers[$player]['player_id_fk'];
    $table = $seat_random[$player];
    $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.tafel = '{$table}' WHERE pokerDb.player_game.player_id_fk = '{$fk}' AND pokerDb.player_game.game_id = :session_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':session_id', $_SESSION['session_game_id']);
    $stmt->execute();
}