<?php 
require_once('../classes/classes.php'); 
$crud = new CRUD();
$darjaSno = "";
$yearFromDate = "";
$sqlUpdate = "";
$msgCounter = 0;
$rollNumber = 0;
if(isset($_REQUEST['darjaSno']) && !empty($_REQUEST['darjaSno']) &&
   isset($_REQUEST['yearFromDate']) && !empty($_REQUEST['yearFromDate']) && 
   isset($_REQUEST['endYear']) && !empty($_REQUEST['endYear'])){
	$darjaSno = addslashes($_REQUEST['darjaSno']);
	$yearFromDate = addslashes($_REQUEST['yearFromDate']);
	$endYear = addslashes($_REQUEST['endYear']);
	$rollNumber = isset($_REQUEST['startFrom']) && !empty($_REQUEST['startFrom']) ? addslashes($_REQUEST['startFrom']) : 0;
	
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo,n.regSno,d.darja,d.derjaCode AS darjaSno
				  FROM 
				  		registrationinfo r, regnumbers n,darjaat d,stdDarjaat std
				  WHERE 
				  		r.sno = n.regSno AND std.darja = d.derjaCode AND std.stdSno = r.sno AND 
				  		std.darja = ".$darjaSno." AND std.isCurrent = 1 AND r.isActive = 1 
						AND std.promotionDate = '".$yearFromDate."' AND std.dateEnd = '".$endYear."'
				  ORDER BY n.RollNumber ASC";
			if($crud->search($sqlSearch)){
					foreach($crud->getRecordSet($sqlSearch) as $row){ $rollNumber +=1;
						$sqlUpdate = "UPDATE regnumbers SET RollNumber = ".$rollNumber." 
						              WHERE regSno = ".$row["regSno"]." AND registrationNo = '".$row["registrationNo"]."'";
								if($crud->update($sqlUpdate)){ 
									$msgCounter +=1;
									}
							}//foreach()
						if($msgCounter > 0){
							echo(' رول نمبرز میں تبدیلی ہو گئ ');
							}
						else{
							echo("کمپیوٹر میں غلطی آنے کے وجہ سے رول نمبرز میں کوئی بھی تبدیل نہیں ہو پائی ");
							}
			}//end search()
			else{
				echo("کوئ بھی طالب علم اس سال منتخب کردہ درجہ میں نہیں پایا گیا ");
				}//search()
	}
else{
	echo(" برائے مہربانی سامنے والے لینک پر کلک کریں ");
    } 
?>