<?php require_once('../classes/classes.php'); $crud = new CRUD(); 
$regSno = '';
$fromDarja = '';
$fromDate = '';
$dateAdmition = '';
$dateEnd = '';
$toDarja = '';
$promotionDateOld = "";
$dateEndOld = "";
$sqlUpdatedFlag = false;
$sqlUpdateIsCurrentFlag = false;
$sqlUpdateEndFlag = false;
$shoba_sno = "";
/*print_r($_POST);
exit();*/
if(isset($_REQUEST['fromDarja']) && !empty($_REQUEST['fromDarja']) &&
   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) && 
   isset($_REQUEST['promotionDateOld']) && !empty($_REQUEST['promotionDateOld']) && 
   isset($_REQUEST['dateEndOld']) && !empty($_REQUEST['dateEndOld']) &&
   isset($_REQUEST['shoba_sno']) && !empty($_REQUEST['shoba_sno']) &&
   isset($_REQUEST['toDarja']) && !empty($_REQUEST['toDarja'])){
	    $fromDarja = addslashes($_REQUEST['fromDarja']);
		$promotionDate = addslashes($_REQUEST['promotionDate']);
		$dateEnd = addslashes($_REQUEST['dateEnd']);
		$toDarja = addslashes($_REQUEST['toDarja']);
		$regSno = addslashes($_REQUEST['regSno']);
		$shoba_sno = addslashes($_REQUEST['shoba_sno']);
		$promotionDateOld = addslashes($_REQUEST['promotionDateOld']);
		$dateEndOld = addslashes($_REQUEST['dateEndOld']);
	   			//echo($fromDarja.'<br />'.$fromDate.'<br />'.$dateAdmition.'<br />'.$dateEnd.'<br />'.$toDarja);
		$sqlSearch = "SELECT r.sno,d.darja,d.derjaCode AS darjaSno,std.promotionDate
				  FROM 
				  		registrationinfo r, regnumbers n,darjaat d,stdDarjaat std
				  WHERE 
				  		r.sno = n.regSno AND std.darja = d.derjaCode AND std.stdSno = r.sno AND 
				  		std.darja = ".$fromDarja." AND std.isCurrent = 1 AND r.isActive = 1 
						AND std.promotionDate = '".$promotionDateOld."' AND 
						dateEnd = '".$dateEndOld."' AND std.shoba_sno = $shoba_sno";
				  /*echo($sqlSearch);
				  exit();*/
				  $shoba_sno = $crud->getValue("SELECT shoba_sno FROM darjaat WHERE derjaCode = ".$toDarja,"shoba_sno");
				  //run the loop to get data row by row and use upadte and insert queires inside the below loop
				  foreach($crud->getRecordSet($sqlSearch) as $row){
					  //echo('Reg Sno = '.$row['sno'].'<br />Darja Sno = '.$row['darjaSno'].' ('.$row['darja'].') '.'<br />promotion Date = '.$row['promotionDate'].'<hr />');
					  //echo($fromDarja.' : '.$toDarja.'//');
					  $sqlUpdateIsCurrent = "UPDATE stdDarjaat SET isCurrent = 0 WHERE stdSno = ".$row['sno'];
					  $sqlUpdated = "INSERT INTO stdDarjaat(darja,stdSno,isCurrent,promotionDate,dateEnd,shoba_sno) VALUES(".$toDarja.",".$row['sno'].",1,'".$promotionDate."','".$dateEnd."',".$shoba_sno.")";
					   						  
						  $sqlUpdateIsCurrentFlag = $crud->update($sqlUpdateIsCurrent);
						  $sqlUpdatedFlag = $crud->insert($sqlUpdated);					  		
							
							    //delete all the record from the table which kept the student darja greater then this new selected darja and 
								//also delete record i.e. if darja = 6 and this is already exists but not isCurrent, this query will be affective
								//SELECT * FROM stddarjaat WHERE stdSno = 1 AND darja > 6 AND isCurrent = 0	
								if($crud->delete("DELETE FROM stddarjaat WHERE stdSno = ".$row['sno']." AND darja > ".$toDarja." AND isCurrent = 0")){						 									
									if($crud->delete("DELETE FROM stddarjaat WHERE stdSno=".$row['sno']." AND darja = ".$toDarja." AND isCurrent = 0")){
										
										}//if the same darja has repeated then remove the 0th index
										//done : old record which should not be remain will be deleted from here 
								}//end delete method
					  					  	
					  }//end of foreach loop
					  
					  if($sqlUpdatedFlag && $sqlUpdateIsCurrentFlag){
							echo($crud->sucMsg("اس درجہ کے تمام طلباء منتخب کردہ درجہ میں منتقل ہوچکے۔","معلومات"));
							}
					else{
							echo($crud->errorMsg("اس درجہ میں کوئی بھی طالب العلم منتخب کردہ تاریخ  میں موجود نہیں ہے۔","غلطی"));
							}
		}
else{
	echo($crud->errorMsg("فارم کو مکمل طور پر پرُ کریں","غلطی"));
	}
?>