<?php
    include "classes\config.php";

    $sql ="SELECT player_id_fk FROM pokerDb.player_game WHERE game_id = '{$_SESSION['session_game_id']}'";
    $stmt= $pdo->query($sql);
    $allPlayers = $stmt->fetchall(PDO::FETCH_ASSOC);

    $numberOfTablesNeeded = ceil(count($allPlayers)/6);

    $tables = [];

    for ($i = 1; $i < count($allPlayers); $i++)
    {
        $table_id = ceil($i/6);
        $fk = $allPlayers[$i]['player_id_fk']; 
        $query = "UPDATE pokerDb.player_game SET pokerDb.player_game.table_id = '{$table_id}' WHERE pokerDb.player_game.player_id_fk = '{$fk}' ";
        $stmt2 = $pdo->prepare($query);
        $stmt2->execute();
    }
        
?>