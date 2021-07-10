<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$sno = "";
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	$sno = addslashes($_REQUEST['sno']);	
		$sqlDel = "DELETE FROM attendence WHERE sno = ".$sno;
			if($crud->delete($sqlDel)){ echo('done');}
			else{echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کے وجہ سے حاضری نہ مٹ سکی "," غلطی"));}
	}
else{
	echo($crud->errorMsg(" برائے مہربانی حاضری کو مٹانے والے لنک پر کلک کریں "," غلطی"));
    } 
?>