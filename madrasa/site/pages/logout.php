<?php
session_start();
$_SESSION['userid'] = '';
$_SESSION['key'] = '';
if($_SESSION['userid'] == '' || $_SESSION['key'] == ''){
	header("Location: ../../index.php");
	}
?>