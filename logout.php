<?php
session_start();
session_unset();
unset($_SESSION['comp_id']);
unset($_SESSION['comp_id']);
unset($_SESSION['company_user']);

session_destroy();
header("Location: login.php");
exit;
?>
