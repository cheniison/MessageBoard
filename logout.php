<?php
session_start();
unset($_SESSION['userName']);
unset($_SESSION['userPW']);
unset($_SESSION['isremember']);
header("Location:index.php");
