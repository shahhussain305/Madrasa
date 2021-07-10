<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$sno= "";
$subjectName= "";
$randomNum = "";
$sqlUpdate = "";
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
   isset($_REQUEST['rnd']) && !empty($_REQUEST['rnd']) &&
   isset($_REQUEST['subjectName']) && !empty($_REQUEST['subjectName'])){
	$sno = addslashes($_REQUEST['sno']);
	$subjectName = addslashes($_REQUEST['subjectName']);
	$randomNum = $_REQUEST['rnd'];//this is for refreshed page request (Temporary)
		$sqlUpdate = "UPDATE subjects SET subjectName = '".$subjectName."' WHERE sno = ".$sno;
			if($crud->update($sqlUpdate)){ echo($crud->sucMsg('مضمون میں تبدیلی کامیابی کے ساتھ ہوچکی ',' کامیابی','../images'));}
			else{echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کے وجہ سے مضمون میں تبدیلی نہ ہوسکی "," غلطی","../images"));
			//echo('<br /> <br />'.$sqlUpdate);
			}
			//echo($sqlDel);
	}
else{
	echo($crud->errorMsg(" برائے مہربانی سامنے والے بٹن پر کلک کریں "," غلطی","../images"));
    } 
?>