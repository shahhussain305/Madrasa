<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$darjaSno = "";
$stdSno = "";
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	$sno = addslashes($_REQUEST['sno']);
	//echo 'Value is : '.$sno;
		$sqlDel = "DELETE FROM stddarjaat WHERE sno = ".$sno." AND isCurrent = 0";
			if($crud->delete($sqlDel)){ 
				echo('ریکارڈ مٹ کامیابی کے ساتھ مٹ گیا ہے۔');
				}
			else{
			    echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے ریکارڈ نہیں مٹ سکا۔ "," غلطی"));}
	}
else{
	echo($crud->errorMsg("مہربانی کر کے مٹاؤ والے لنک پر کلک کرکے ریکارڈ کو مٹادی ","غلطی"));
    } 
?>