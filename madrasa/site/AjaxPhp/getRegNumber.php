<?php require_once('../classes/classes.php'); 
$crud = new CRUD();
if(isset($_POST['darja_sno']) && !empty($_POST['darja_sno'])){
	$darja_sno = addslashes($_POST['darja_sno']);
		$shoba_sno = $crud->getValue("SELECT shoba_sno FROM darjaat WHERE derjaCode = ".$darja_sno,"shoba_sno");
		$regNo = $crud->getValue("SELECT COUNT(sno) AS total FROM stddarjaat WHERE isCurrent = 1 AND shoba_sno = ".$shoba_sno,"total"); 	
		if(isset($regNo) && !empty($regNo)){ 
			echo($crud->changeNumberFormate($regNo + 1)); 
			}
		else{  
			echo("000001"); 
			}
	}
?>