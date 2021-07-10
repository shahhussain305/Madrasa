<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$preority = 0;
$derjaCode = 0;
if(isset($_POST['darjaLbl']) && !empty($_POST['darjaLbl']) &&
   isset($_POST['shoba']) && !empty($_POST['shoba'])){
	$darjaLbl = addslashes($_POST['darjaLbl']);	
	$shoba = addslashes($_POST['shoba']);	
		if(!$crud->search("SELECT * FROM darjaat WHERE shoba_sno = $shoba AND darja = '$darjaLbl'")){
			$sqlSave = "INSERT INTO darjaat(shoba_sno,darja) VALUES($shoba,'$darjaLbl')";
			if($crud->insert($sqlSave)){ 
				echo($crud->sucMsg('درجہ محفوظ ہوچکا ہے','معلومات','../images'));
				}
			else{
				echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کے وجہ سے درجہ محفوظ نہ ہوسکا"," غلطی",'../images'));
				}
		}//search()
		else{
			echo($crud->errorMsg("یہ درجہ پہلے ہی سے موجود ہے"," غلطی",'../images'));
			}//search()
	}
else{
	echo($crud->errorMsg(" مہربانی کرکے درجہ مہیاں کریں "," غلطی",'../images'));
    } 
?>