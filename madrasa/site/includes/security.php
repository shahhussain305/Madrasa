<?php 
if(!isset($_SESSION['userid']) || empty($_SESSION['userid']) || !isset($_SESSION['key']) || empty($_SESSION['key'])){
	header("Location: ../index.php?session=expired");
	}
?>