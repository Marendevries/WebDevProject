<?PHP
session_start();
include "classes/config.php";

if($_SESSION['is_host'] != false){
    $sql ="UPDATE pokerDb.player_game SET active=0 WHERE game_id =:session_game_id AND player_id_fk =:player_id";
    $data = ['session_game_id'=>$_SESSION["session_game_id"],'player_id'=>$_SESSION["player_id"]];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    $sql ="UPDATE pokerDb.session_game SET is_active=0 WHERE session_id =:session_game_id";
    $stmt = $pdo->prepare($sql);
    $data = ['session_game_id'=>$_SESSION["session_game_id"]];
    $stmt->execute($data);

    session_destroy();
}
header ("Location: hoofdmenu.php");
exit;