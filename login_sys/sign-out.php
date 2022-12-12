<?php
// Clear session
session_start();
session_unset();
session_destroy();

// Clear cookie
setcookie('uniq', '', time() - 3600, '/');
setcookie('key', '', time() - 3600, '/');

header('Location: sign-in.php');
exit;
