<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	$sno = addslashes($_REQUEST['sno']);
	//echo 'Value is : '.$sno;
		$sqlDel = "DELETE FROM subjects WHERE sno = ".$sno;
			if($crud->delete($sqlDel)){ 
				echo($crud->sucMsg('منتخب کردہ مضمون مٹ چکا ہے','معلومات','../images'));
				}
			else{
			    echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے مضمون نہیں مٹ سکا۔ "," غلطی",'../images'));}
	}
else{
	echo($crud->errorMsg("مہربانی کر کے مٹاؤ والے بٹن  پر کلک کرکے مضمون کو ختم کردیں ","غلطی",'../images'));
    } 
?>