<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$resultTrm="";
$yr="";
$darj ="";
$edu_remarks="";
$sqlUpdate = "";
if(isset($_REQUEST['resultTrm']) && !empty($_REQUEST['resultTrm']) &&
   isset($_REQUEST['yr']) && !empty($_REQUEST['yr']) &&
   isset($_REQUEST['edu_remarks']) && !empty($_REQUEST['edu_remarks']) &&
   isset($_REQUEST['darj']) && !empty($_REQUEST['darj'])){
	$resultTrm = addslashes($_REQUEST['resultTrm']);
	$yr = addslashes($_REQUEST['yr']);
	$darj = $_REQUEST['darj'];
	$edu_remarks = $_REQUEST['edu_remarks'];
		$sqlUpdate = "UPDATE result SET edu_year_remarks = '".$edu_remarks."' 
					  WHERE resultYear = '".$yr."' AND resultTerm=".$resultTrm." AND darjasno=".$darj;
			if($crud->update($sqlUpdate)){ echo($crud->sucMsg('ریمارکس میں تبدیلی کامیابی کے ساتھ ہوچکی ',' کامیابی','images'));}
			else{echo($crud->errorMsg("ریماکس میں تبدیلی کر کے دوبارہ کوشش کریں","غلطی ","images"));
			//echo('<br /> <br />'.$sqlUpdate);
			}
			//echo($sqlDel);
	}
else{
	echo($crud->errorMsg(" برائے مہربانی سامنے والے بٹن پر کلک کریں "," غلطی","images"));
    } 
?>