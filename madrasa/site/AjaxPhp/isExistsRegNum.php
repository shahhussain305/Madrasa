<?php require_once("../inc/db_import_for_ajaxp.php");
$num = "";
if(isset($_REQUEST['num']) && !empty($_REQUEST['num'])){
		$num = addslashes($_REQUEST['num']);	
		$sqlVal = "SELECT registrationNo FROM regnumbers WHERE registrationNo LIKE :registrationNo";
		$param = array(':registrationNo'=>'%".$num."');
		if($db->dbQuery($sqlVal,$param)){
			echo('<img src="images/error.png" width="16" height="16" alt="" />');
			}
		else{
			echo('<img src="images/okSign.png" width="16" height="16" alt="" />');
			}
	}
else{
	echo($method->errorMsg('لنک پر کلک کر کے تصدیق کروائے',''));
    }