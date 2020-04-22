<?php

session_start();
include "classes\config.php";

            //STORE ID's IN SESSION
            $_SESSION['test'] = true;
            $_SESSION['session_game_id'] = "40";
            $_SESSION['player_id'] = "27";
            $_SESSION['is_host'] = true;
            $_SESSION['settings_id_set'] = true;
            $_SESSION['wit'] = 25;
            $_SESSION['rood'] = 50;
            $_SESSION['groen'] = 100;
            $_SESSION['blauw'] = 200;
            $_SESSION['zwart'] = 500;
            $_SESSION['tijd'] = 300;
            $_SESSION['pot'] = 0;
            $_SESSION['Bblind'] = 50;
            $_SESSION['Sblind'] = 25;
            $_SESSION['table'] = 1;
        

            // Redirect user to hostoverzicht page
            header("location: hostoverzicht.php");
            exit;

?>