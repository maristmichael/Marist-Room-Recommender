<?php
session_start();
unset($_SESSION['login_user']);
echo "You are logged out";
header ("location: index.php?LoggedOut");
?>