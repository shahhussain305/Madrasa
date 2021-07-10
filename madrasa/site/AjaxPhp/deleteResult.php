<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$regSno = "";
$termResult = "";
$year = "";
if(isset($_REQUEST['regSno']) && !empty($_REQUEST['regSno']) && 
   isset($_REQUEST['termResult']) && !empty($_REQUEST['termResult']) &&
   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
	$regSno = addslashes($_REQUEST['regSno']);
	$termResult = addslashes($_REQUEST['termResult']);
	$promotionDate = addslashes($_REQUEST['promotionDate']);	
	$dateEnd = addslashes($_REQUEST['dateEnd']);
		$sqlDel = "DELETE FROM result WHERE stdSno = ".$regSno." AND promotionDate = '".$promotionDate."'
										AND dateEnd = '".$dateEnd."' AND resultTerm=".$termResult;
			if($crud->delete($sqlDel)){ echo('نتیجہ مکمل طور پر مٹ چکا');}
			else{echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کے وجہ سے نتیجہ نہ مٹ سکا "," غلطی"));}
			//echo($sqlDel);
	}
else{
	echo($crud->errorMsg(" برائے مہربانی نتیجہ کو مٹانے والے لنک پر کلک کریں "," غلطی"));
    } 
?>