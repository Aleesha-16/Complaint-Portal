<?php

session_start();

/* REMOVE ALL SESSION VARIABLES */

session_unset();

/* DESTROY SESSION */

session_destroy();

/* CLEAR CACHE */

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");

/* REDIRECT */

header("Location: login.php");

exit();

?>