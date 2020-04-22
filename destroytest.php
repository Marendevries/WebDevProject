<?PHP
session_start();
include "classes/config.php";

    session_destroy();

header ("Location: hoofdmenu.php");
exit;