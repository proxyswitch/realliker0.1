<?php ob_start(); session_start();
unset($_SESSION['smmebhaveshsitelike']);
unset($_SESSION['csrfTOken']);
unset($_SESSION['sitelogid']);
unset($_SESSION['siteregid']);
unset($_SESSION['siteforgetid']);
header("location:index.php");
?>