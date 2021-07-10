<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$preority = 0;
$derjaCode = 0;
if(isset($_POST['darja']) && !empty($_POST['darja']) &&
   isset($_POST['subjectLbl']) && !empty($_POST['subjectLbl']) &&
   isset($_POST['totalMarks']) && !empty($_POST['totalMarks'])){
	$darja = addslashes($_POST['darja']);	
	$subjectLbl = addslashes($_POST['subjectLbl']);
	$totalMarks = addslashes($_POST['totalMarks']);
		if(!$crud->search("SELECT * FROM subjects WHERE darjaSno = '$darja' AND subjectName = '$subjectLbl'")){
			$sqlSave = "INSERT INTO subjects(subjectName,totalMarks,darjaSno) VALUES('$subjectLbl',$totalMarks,$darja)";
			if($crud->insert($sqlSave)){ 
				echo($crud->sucMsg('مضمون محفوظ ہوچکا ہے','معلومات','../images'));
				}
			else{
				echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کے وجہ سے درجہ میں مضمون درج نہ ہوسکا"," غلطی",'../images'));
				}
		}//search()
		else{
			echo($crud->errorMsg(" اس درجہ میں یہ مضمون پہلے ہی سے موجود ہے"," غلطی",'../images'));
			}//search()
	}
else{
	echo($crud->errorMsg(" مہربانی کرکے درجہ منتخب کرکے اس میں مضمون کا اندراج کریں"," غلطی",'../images'));
    } 
?>