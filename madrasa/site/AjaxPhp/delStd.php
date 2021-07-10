<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$stdSno = "";
if(isset($_REQUEST['stdSno']) && !empty($_REQUEST['stdSno'])){
	$stdSno = addslashes($_REQUEST['stdSno']);	
		$sqlDel = "DELETE FROM registrationinfo WHERE sno = ".$stdSno;
		$sqlDel2 = "DELETE FROM stddarjaat WHERE stdSno = ".$stdSno;
		$sqlDel3 = "DELETE FROM regnumbers WHERE regSno = ".$stdSno;
			if($crud->delete($sqlDel)){
				if($crud->delete($sqlDel2)){
					if($crud->delete($sqlDel3)){
						echo($crud->sucMsg(" طالب العلم کا ریکارڈ کامیابی کے ساتھ مکمل طور پر ختم ہوچکا ہے","معلومات"));
						}
					}
				}
	}
else{
	echo($crud->errorMsg(" برائے مہربانی طالب العلم کو مٹانے والے بٹن پر کلک کریں "," غلطی"));
    } 
?>