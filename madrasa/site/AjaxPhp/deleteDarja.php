<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
	$sno = addslashes($_REQUEST['sno']);
	//echo 'Value is : '.$sno;
		$sqlDel = "DELETE FROM darjaat WHERE derjaCode = ".$sno;
			if($crud->delete($sqlDel)){
				//also delete subject associated to this darja from subject table
				$sqlDeleteSubject = "DELETE FROM subjects WHERE darjaSno = ".$sno;
				$num_subj_del = $crud->delete($sqlDeleteSubject); 
				echo($crud->sucMsg('منتخب کردہ درجہ مٹ چکا ہے','معلومات','../images'));
				}
			else{
			    echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے درجہ نہیں مٹ سکا۔ "," غلطی",'../images'));}
	}
else{
	echo($crud->errorMsg("مہربانی کر کے مٹاؤ والے بٹن پر کلک کرکے درجہ کو ختم کردیں ","غلطی",'../images'));
    } 
?>