<?php
session_start();
session_destroy();
header("Location: kitchen1.php");
exit();
?>