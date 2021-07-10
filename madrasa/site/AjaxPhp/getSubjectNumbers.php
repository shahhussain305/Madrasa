<?php require_once('../classes/classes.php'); 
$crud = new CRUD();
if(isset($_POST['subject_sno']) && !empty($_POST['subject_sno'])){
	$sno = addslashes($_POST['subject_sno']);
	$sql = "SELECT totalMarks FROM subjects WHERE sno = ".$sno;
	echo($crud->getValue($sql,"totalMarks"));
	}
?>