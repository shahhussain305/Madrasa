<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$stdSno = "";
if(isset($_REQUEST['stdSno']) && !empty($_REQUEST['stdSno'])){
	$stdSno = addslashes($_REQUEST['stdSno']);	
		$sqlUpd = "UPDATE registrationinfo SET isActive = 0 WHERE sno = ".$stdSno;
		if($crud->update($sqlUpd)){
			echo($crud->sucMsg(" طالب العلم خارج ہوچکا ہے","معلومات"));
		}				
	}
else{
	echo($crud->errorMsg(" برائے مہربانی طالب العلم کو خارج کرنے والے بٹن پر کلک کریں "," غلطی"));
    } 
?>