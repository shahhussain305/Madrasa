<?php
require_once('../classes/classes.php'); 
$crud = new CRUD();
$num = "";
if(isset($_REQUEST['num']) && !empty($_REQUEST['num'])){
		$num = addslashes($_REQUEST['num']);	
		$sqlVal = "SELECT registrationNo FROM regnumbers WHERE registrationNo LIKE '%".$num."'";
		if($crud->search($sqlVal)){
			echo('<img src="images/error.png" width="16" height="16" alt="" />');
			//echo($crud->errorMsg("یہ سیریل نمبر پہلے ہی سے دوسرے طالب علم کے لئے موجود ہے",""));
			}
		else{
			echo('<img src="images/okSign.png" width="16" height="16" alt="" />');
			}
	}
else{
	echo($crud->errorMsg('لنک پر کلک کر کے تصدیق کروائے',''));
    } 
?>