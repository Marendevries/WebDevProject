<?PHP

session_start();
session_destroy();

header ("Location: hoofdmenu.php");
exit;