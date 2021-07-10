<?php ob_start(); session_start(); 
require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD();
require_once("../includes/configuration.php"); 
$statusStd = "";
function returnAttendenceOfWholeMonth($sql){
	$crud = new CRUD();
	$v = $crud->getValue($sql,"total");								  
	if(!empty($v)){
	   echo($v);
	  }
	else{
		echo('-');
	}	
	//echo $sql;
	}
$hazir = 28; $ghairHazir = 0; $rokhsat = 0; $bemar = 0;
$rowCounter = 0;
$darja = ""; $result = ""; $strSubject = ""; $colspan = 0; $i=0; $sno = 0; $strSubjectMrks = "";$regSno = "";
$subjectMarksSql = ""; $resultMarks = ""; $subjectMarksSql1 = ""; $resultMarks1 = ""; $subjectMarksSql2 = ""; $resultMarks2 = ""; 
$totalMarksIn1 = 0;$totalMarksIn2 = 0; $totalMarksIn3 = 0;$totalMarksInSubjects1 = 0;$totalMarksInSubjects2 = 0;$totalMarksInSubjects3 = 0;
$registrationNo = 0; $mezaan1 = 0;$mezaan2 = 0; $mezaan3 = 0;
$v1 = 0;$v2 = 0;$v3 = 0;$v4 = 0;$v5 = 0;$v6 = 0;$v7 = 0;$v8 = 0;$v9 = 0;
$v_9 = 0;$v10 = 0;$v11 = 0;$v12 = 0;$v13 = 0;$v14 = 0;$v15 = 0;$v16 = 0;$v17 = 0;
$v18 = 0;$v19 = 0;$v20 = 0;$v21 = 0;$v22 = 0;$v23 = 0;$v24 = 0;$v25 = 0;$v26 = 0;
//it will hold the obtanied total marks per result by the student on the year bases
$obtMarksSum1 = 0; 
$obtMarksSum2 = 0;
$obtMarksSum3 = 0;
$result1 = "";
$result2 = "";
$result3 = "";
$mrks1 = "";
$mrks2 = "";
$mrks3 = "";
$resultCounter = 0;
$selectedYear="";
$titleHead = "";
$header = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>رزلٹ شیٹ برائے <?php if(isset($_REQUEST['darja'])) { echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['darja'],"darja")); } ?></title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
td{
	vertical-align:top;
	font-family:'Jameel Noori Nastaleeq';
	line-height:20px;
	text-align:center;
	}
#singleStdAllResult a{ font-size:20px; color:#ffffff; text-decoration:none; }
#singleStdAllResult a:hover{ font-size:20px; color:#ffffff; text-decoration:none; }
</style>
<?php 
	if(isset($_SESSION["hijri"]) && !empty($_SESSION["hijri"])){ 
	$sessionDate = new DateTime($_SESSION["hijri"]);
	$sessionDate = $sessionDate->format('Y-m-d');
	$dtAry= explode("-",$sessionDate);
	$dateEnding = $dtAry[0]+1;
	$dateEnding = $dateEnding.'-'.$dtAry[1].'-'.$dtAry[2];	
	}
	?>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<script type="text/javascript" src="../js/functions.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style type="text/css">
@import "../js/jquery.datepick.css";
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(function() {
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
});
	$("#hide").click(function(){
		$("#searchPanel").slideUp(1000);
		});
	});
$(document).ready(function(){
		$("body").dblclick(function(){
			$("#searchPanel").slideDown(1000);
			});
	});
$(document).ready(function(){
	$("#print").click(function(){
		Print("printerArea");
		});
	});
</script> 

</head>
<body style="background-image:none; background-color:#ffffff; direction:rtl;" dir="rtl">
<center>	
<div id="searchPanel" style="width:1160px; background-color:#CCC; direction:rtl; margin:0 auto;">
<form method="post" action="resultSheet.php" class="generalTextFonts">
  <table width="1163" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100">
    <tr>
      <td width="1160" style="text-align:center; vertical-align:middle;">
      <table width="98%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="52" style="vertical-align:middle;"><font color="#FFFFFF" style="font-size:20px;"> درجہ  </font></td>
          <td width="194" style="vertical-align:middle;">
          <?php $css = 'style="position:relative; top:1px; width:180px; height:40px; font-size:20px;"';		
				$crud->darjaatCmb('darja',$css); ?>
          		</td>
            <td width="112" style="color:#ffffff;"> <span style="position:relative; top:10px;"> تاریخ ابتداء </span> </td>
            <td width="135"> 
                  <input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($sessionDate);} ?>" />
            </td>
            <td width="80" style="color:#ffffff;"><span style="position:relative; top:10px;"> تاریخ انتہا </span> </td>
            <td width="129"> 
                  <input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEnding);} ?>" />
            </td>
          <td width="85" style="vertical-align:middle;">
          <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:0xp; border-radius:4px;" /></td>
          <td width="126" style="vertical-align:middle;"><span id="singleStdAllResult" style="position:relative; top:12px;"> 
          <span style="position:relative; top:-10px;"> 
          <a href="resultSheetSingleStdAll.php" title="ایک طالب العلم کی مکمل نتائج یہاں پر دیکھیں"> ایک طالب علم کا نتیجہ</a>
          </span>
          </span></td>
          <td width="67" style="vertical-align:middle;">
       		 <a href="#" id="hide" onclick="return false;" title="سرچ پینل کو چھہائیں"> 
             <img src="../images/minus.png" style="border-width:0px;" /> 
             </a>
           </td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</div>


<div id="printerArea" style="width:1160px !important; margin:0 auto;">
<?php
$sqlRstSearch = "";
$drja = "";
if(isset($_REQUEST['btnSearch'])){
	if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
	   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
	   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
		$darja = addslashes($_REQUEST['darja']);
			//$darja=mysql_real_escape_string($darja);
			$promotionDate = addslashes($_REQUEST['promotionDate']);
			$dateEnd = addslashes($_REQUEST['dateEnd']);
			
		$sqlRstSearch = "SELECT * FROM result WHERE promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
		//echo($sqlRstSearch);
		if($crud->search($sqlRstSearch)) { 
		if(isset($_REQUEST['darja'])) { $drja = $crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['darja'],"darja"); } 
		 $titleHead = '<table width="1160" border="0" align="center" id="resultsheet">  
		  <tr>
			<td width="364" style="vertical-align:middle"><h2>'.M_Name.'</h2>
			<font style="font-size:20px;">'.L_Address.'	</font>
			</td>
			<td width="287" align="center" style="vertical-align:middle; line-height:16px;"><h2 style="font-family:Asad;"> مکتب نتائج الاختبارات
			<hr style="border-style:double; height:6px; border-left-width:0px; border-right-width:0px;" />
			المرحلۃ '.$drja.' </h2>
			</td>
			<td width="452" style="text-align:center; vertical-align:middle; padding-right:100px;">
				<table width="400" border="1" cellspacing="0" cellpadding="3">
					<tr>
						<td style="text-align:right;"> تاریخ اجراء <input type="text" value="'.$crud->getValue("SELECT edu_year_remarks FROM result WHERE resultTerm = 1 AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'","edu_year_remarks").'" id="ex1" style="width:320px; border:0px; padding:2px;" /></td>
					</tr>
					<tr>
						<td style="text-align:right;"> تاریخ اجراء <input type="text" value="'.$crud->getValue("SELECT edu_year_remarks FROM result WHERE resultTerm = 2 AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'","edu_year_remarks").'" id="ex2" style="width:320px; border:0px; padding:2px;" /></td>
					</tr>
					<tr>
						<td style="text-align:right;"> تاریخ اجراء <input type="text" value="'.$crud->getValue("SELECT edu_year_remarks FROM result WHERE resultTerm = 3 AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'","edu_year_remarks").'" id="ex3" style="width:320px; border:0px; padding:2px;" /></td>
					</tr>
				</table>
			</td>
		  </tr>
		</table>';
		?>
		
		
	<table width="1163" border="1" align="center" cellspacing="0" cellpadding="0" style="margin:0 auto; border:0px;">
	
	                 <?php   //to fetch all the subjects in the specified darja in table below
					$subjectSql = "SELECT sno,subjectName FROM subjects WHERE darjaSno = ".$darja;
					//$resultSubject = mysql_query($subjectSql,$crud->con);
					if($crud->search($subjectSql)){
						$subject_ary = array();
						foreach($crud->getRecordSet($subjectSql) as $rowSubject){
						//while($rowSubject = mysql_fetch_assoc($resultSubject)){ 
							$colspan += 1;
							$sbj = $rowSubject['subjectName'];
							$sbj = str_replace("/","<br />",$sbj);
							$sbj = str_replace(",","<br />",$sbj);
							$sbj = str_replace("،","<br />",$sbj);
							$subject_ary[] = $rowSubject["sno"];
                            $strSubject .= "<td style='width:50px;vertical-align:bottom; text-align:center;'> ". $sbj. "</td>";
							}
					}//end if mysql_num_rows()							
				 		?>
	
	<?php 
	
	
	$colspans = ' colspan="'.$colspan.'"';
	
	$header = '<tr>
    <td width="19" style="vertical-align:bottom; text-align:center;"><font size="3">الرقم</font></td>
    <td style="vertical-align:bottom; text-align:center;"><font size="3" style="font-family:\'Jameel Noori Nastaleeq\'; line-height:20px;">اسم طالب <br />مع ولدیت</font></td>
    <td width="63" style="vertical-align:bottom; text-align:center; font-weight:bold;"><font size="3">سالانہ<br /> نتائج</font></td>
    <td width="248" style="vertical-align:bottom; text-align:center; border-width:0px;">
    		<table border="1" cellspacing="0" cellpadding="0" width="250">
                        <tr>
                            <td align="center" '.$colspans.'> مضامین </td>
                        </tr>
                        <tr> '. $strSubject .'
                        </tr>
        	</table>
    </td>   
    <td width="38" style="text-align:center; vertical-align:bottom;"><font size="3">مجموع الدرجات</font></td>
    <td width="41" style="text-align:center; vertical-align:bottom;"><font size="3">الدرجات المحصلۃ</font></td>
    <td width="38" style="text-align:center; vertical-align:bottom;"><font size="3">الاوسط</font></td>
    <td width="38" style="text-align:center; vertical-align:bottom"><font size="3">التقدیر</font></td>
    <td width="59" style="text-align:center; vertical-align:bottom;"><font size="3">کشف الحضور</font></td>
    <td width="349" style="border-width:1px; vertical-align:bottom">
    	<table width="351" border="1" cellspacing="0" cellpadding="0">
        	<tr style="border-width:0px;">
            	<td colspan="10" style="text-align:center;height:38px"> ماہانہ حاضری '. $promotionDate.' - '. ($dateEnd) .'</td>
            </tr>
            <tr style="border-width:0px;">
            	<td width="39" style="vertical-align:middle; text-align:center;"> شوّال </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> ذی القعدة </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> ذی الحجہ </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> محرّم </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> صفر </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> ربيع الأوّل  </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> ربیع الثانی  </td>
                <td width="39" style="vertical-align:middle; text-align:center;"> جمادى الأول</td>
                <td width="39" style="vertical-align:middle; text-align:center;"> جمادى الثانی </td>
                <td width="39" style="vertical-align:middle; text-align:center;">  رجب </td>
            </tr>
        </table>
    </td>
    <td width="154" style="border-width:1px; vertical-align:bottom;"> 
   		 	<table width="100%" height="66" border="1" cellpadding="0" cellspacing="0">
        	<tr style="border-width:0px;">
            	<td height="37" colspan="3" style="text-align:center;"> سالانہ رپورٹ </td>
            </tr>
            <tr style="border-width:0px;">
                <td width="84" style="vertical-align:middle; text-align:center;height:41px;"> میزان  </td>   
                <!--td width="68" style="vertical-align:middle; text-align:center;"> تصویر </td -->
          	</tr>
            </table>
	</td>
  </tr>'; 
				 echo('<tr> <td colspan="11">'.$titleHead.'</td></tr>');
				 echo($header);
  //loop over the data ?>
  <?php 
  		$resultAllSql = "SELECT DISTINCT
						  r.stdName, r.fatherName, r.sno
						FROM registrationInfo r,stdDarjaat st, result rs
						WHERE st.darja = ".$darja." AND rs.darjaSno = ".$darja." AND rs.promotionDate = '".$promotionDate."'
							 AND rs.dateEnd = '".$dateEnd."'
							 AND r.isActive = 1 AND st.stdSno = r.sno AND rs.stdSno = r.sno"; 
					//echo($resultAllSql); //AND st.isCurrent = 1
					//exit();
			//$resultStd = mysql_query($resultAllSql,$crud->con);
			if($crud->search($resultAllSql)){
				foreach($crud->getRecordSet($resultAllSql) as $rowsStd){
				//while($rowsStd = mysql_fetch_assoc($resultStd)){ 
				$sno += 1; $rowCounter +=1;
				$regSno = $rowsStd['sno'];
				if($rowCounter >= 7){
				 echo('<tr> <td colspan="11" style="height:90px; border:0px;">&nbsp;</td></tr>');
				 echo('<tr> <td colspan="11">'.$titleHead.'</td></tr>');
				 echo($header);
				 $rowCounter = 0;
				}
 			 ?>      
              <tr>
                <td width="19" style="padding-top:20px;"><font size="3"> <?php echo($sno); ?> </font></td>
                <td align="center" style="width:200px !important; padding-top:20px;">
			    <font size="3" style="font-family:'Jameel Noori Nastaleeq'; line-height:17px;">
				<?php echo($rowsStd['stdName'].' <strong> ولد </strong>'.$rowsStd['fatherName']); ?></font></td>
                <td width="63" style="border-width:0px;">
                    <table width="65" border="1" cellspacing="0" cellpadding="3" id="tblSession">
                        <tr style="border-width:0px;">
                            <td align="right" style="font-size:17px; height:14px; line-height:13px;"> سہ ماہی </td>
                      </tr>
                         <tr style="border-width:0px;">
                            <td align="right" style="font-size:17px; height:14px; line-height:13px;"> شش ماہی </td>
                         </tr>	
                         <tr style="border-width:0px;">
                            <td align="right" style="font-size:17px; height:14px; line-height:13px;"> سالانہ </td>
                        </tr>
                    </table>
                </td>
                <td style="border-width:0px;">
                        <table width="250" border="1" cellpadding="0" cellspacing="0">
                             <tr style="border-width:0px;">
							 	<?php   //to fetch all the subjects in the specified darja in table below
							    $subjectMarksSql =     "SELECT r.obtmarks,regInfo.stdName,r.resultTerm,r.subjectSno,r.edu_year_remarks 
														FROM result r,regnumbers reg,registrationinfo regInfo
														WHERE r.darjaSno = ".$darja." AND regInfo.sno = r.stdSno  
														AND regInfo.sno = reg.regSno AND r.resultTerm = 1 AND 
														regInfo.sno = ".$regSno." AND regInfo.isActive = 1  
														AND r.promotionDate = '".$promotionDate."'
													 	AND r.dateEnd = '".$dateEnd."'";							  
								                             
							    if($crud->search($subjectMarksSql)) { //print_r($subjectMarksSql);
								$totalMarksInSubjects1 = 0;
								$totalMarksIn1 = 0;
								$mezaan1 = 0; $mezaan2 = 0; $mezaan3 = 0;$aryCounter = -1;
                                    foreach($crud->getRecordSet($subjectMarksSql) as $rowSub){ $aryCounter += 1;
									//while($rowSub = mysql_fetch_array($resultMarks)){  
									$totalMarksIn1 += $rowSub['obtmarks']; 
									    $totalMarksInSubjects1 += $crud->getValue("SELECT s.totalMarks FROM subjects s WHERE s.sno = ".$rowSub['subjectSno'],"totalMarks");                                   						
	                                    $sqlMarks = "SELECT obtmarks FROM result WHERE 
																				stdSno = '".$regSno."'
																				AND	darjaSno = ".$darja." 
																				AND subjectsno = '".$subject_ary[$aryCounter]."'
																				AND resultTerm = 1 
																				AND promotionDate = '".$promotionDate."'
													 							AND dateEnd = '".$dateEnd."'";
														  $obtN = $crud->getValue($sqlMarks,"obtmarks");
										?>                                    
                                        <td width="246" style="width:80px; vertical-align:middle; text-align:center; <?php if($rowSub['obtmarks'] < 40){ ?> background-color:#CACACA; font-weight:bold; font-size:13px; <?php } ?>"> 
										<?php echo($obtN); ?>
                                        </td>
                                        <?php }//end while loop
										 }//end if mysql_num_rows() 
										 ?>
                          </tr>
                               <tr style="border-width:0px;"><?php   //to fetch all the subjects in the specified darja in table below							   
                                $subjectMarksSql1 =     "SELECT r.obtmarks,regInfo.stdName,r.resultTerm,r.subjectSno,r.edu_year_remarks 
														FROM result r,regnumbers reg,registrationinfo regInfo
														WHERE r.darjaSno = ".$darja." AND regInfo.sno = r.stdSno  
														AND regInfo.sno = reg.regSno AND r.resultTerm = 2 AND 
														regInfo.sno = ".$regSno." AND regInfo.isActive = 1  
														AND r.promotionDate = '".$promotionDate."'
													 	AND r.dateEnd = '".$dateEnd."'";
                                						
                               
							    if($crud->search($subjectMarksSql1)) { //print_r($subjectMarksSql1);
								$totalMarksInSubjects2 = 0;
								$totalMarksIn2 = 0;$aryCounter1 = -1;
                                    foreach($crud->getRecordSet($subjectMarksSql1) as $rowSub1){$aryCounter1 += 1;
									//while($rowSub1 = mysql_fetch_assoc($resultMarks1)){ 
									$totalMarksIn2 += $rowSub1['obtmarks'];
									$totalMarksInSubjects2 += $crud->getValue("SELECT s.totalMarks FROM subjects s WHERE s.sno = ".$rowSub1['subjectSno'],"totalMarks");			
	                                   $sqlMarks2 = "SELECT obtmarks FROM result WHERE 
															stdSno = '".$regSno."'
															AND	darjaSno = ".$darja." 
															AND subjectsno = '".$subject_ary[$aryCounter1]."'
															AND resultTerm = 2 
															AND promotionDate = '".$promotionDate."'
															AND dateEnd = '".$dateEnd."'";
														  $obtN2 = $crud->getValue($sqlMarks2,"obtmarks");
										?>                                    
                                        <td style="vertical-align:middle; text-align:center; <?php if($obtN2 < 40){ ?> background-color:#CACACA; font-weight:bold; font-size:13px; <?php } ?>""> 
										<?php echo($obtN2); ?> </td>
                                        <?php }//end while loop
										 }//end if mysql_num_rows() 
										 ?>
                          </tr> 
                                <tr style="border-width:0px;"><?php   //to fetch all the subjects in the specified darja in table below							   
                                $subjectMarksSql2 =     "SELECT r.obtmarks,regInfo.stdName,r.resultTerm,r.subjectSno,r.edu_year_remarks 
														FROM result r,regnumbers reg,registrationinfo regInfo
														WHERE r.darjaSno = ".$darja." AND regInfo.sno = r.stdSno  
														AND regInfo.sno = reg.regSno AND r.resultTerm = 3 AND 
														regInfo.sno = ".$regSno." AND regInfo.isActive = 1  
														AND r.promotionDate = '".$promotionDate."'
													 	AND r.dateEnd = '".$dateEnd."'";
                                //$resultMarks2 = mysql_query($subjectMarksSql2);
                               
							    if($crud->search($subjectMarksSql2)) { //print_r($subjectMarksSql2);
								$totalMarksInSubjects3 = 0;
								$totalMarksIn3 = 0;
								$aryCounter2 = -1;
                                    foreach($crud->getRecordSet($subjectMarksSql2) as $rowSub2){$aryCounter2 += 1;
									//while($rowSub2 = mysql_fetch_assoc($resultMarks2)){  
									$totalMarksIn3 += $rowSub2['obtmarks'];   
									$totalMarksInSubjects3 += $crud->getValue("SELECT s.totalMarks FROM subjects s WHERE s.sno = ".$rowSub2['subjectSno'],"totalMarks");                                   						
	                                    
										$sqlMarks3 = "SELECT obtmarks FROM result WHERE 
																				stdSno = '".$regSno."'
																				AND	darjaSno = ".$darja." 
																				AND subjectsno = '".$subject_ary[$aryCounter2]."'
																				AND resultTerm = 3 
																				AND promotionDate = '".$promotionDate."'
													 							AND dateEnd = '".$dateEnd."'";
														  $obtN3 = $crud->getValue($sqlMarks3,"obtmarks");
										
										?>                                    
                                        <td style="vertical-align:middle; text-align:center; <?php if($obtN3 < 40){ ?> background-color:#CACACA; font-weight:bold; font-size:13px; <?php } ?>"> 
										<?php echo($obtN3); ?> </td>
                                        <?php }//end while loop
										 }//end if mysql_num_rows() 
										 ?>
                                </tr> 
                        </table>
                </td>   
                <td width="38" style="border-width:0px;">
                		<table width="40" border="1" cellspacing="0" cellpadding="0">
                        	<tr style="border-width:0px;">
                            	<td> <?php if($totalMarksInSubjects1 > 0){ echo($totalMarksInSubjects1);}else{ echo('صفر'); } ?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> <?php if($totalMarksInSubjects2 > 0){ echo($totalMarksInSubjects2);}else{ echo('صفر'); } ?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> <?php if($totalMarksInSubjects3 > 0){ echo($totalMarksInSubjects3);}else{ echo('صفر'); } ?> </td>
                            </tr>
                        </table>                
                </td>
                <td width="41" style="border-width:0px;">
                		<table width="40" border="1" cellspacing="0" cellpadding="0">
                        	<tr style="border-width:0px;">
                            	<td> <?php if($totalMarksIn1 > 0){ echo($totalMarksIn1);}else{ echo('صفر'); } ?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> 
									 <?php if($totalMarksIn2 > 0){ echo($totalMarksIn2);}else{ echo('صفر'); } ?>
                                </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> 
									 <?php if($totalMarksIn3 > 0){ echo($totalMarksIn3);}else{ echo('صفر'); } ?>
                              </td>
                            </tr>
                        </table>    
                </td>
                <td width="38" style="border-width:0px;">
                		<table width="40" border="1" cellspacing="0" cellpadding="0">
                        	<tr style="border-width:0px;">
                            	<td>  <?php if($totalMarksInSubjects1 > 0){
											echo(round((($totalMarksIn1*100)/$totalMarksInSubjects1),2)); 
								}else{ echo('صفر'); } ?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> <?php if($totalMarksInSubjects2 > 0){
										 echo(round((($totalMarksIn2*100)/$totalMarksInSubjects2),2));
										 }else{ echo('صفر'); } ?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td>  <?php if($totalMarksInSubjects3 > 0){
											 echo(round((($totalMarksIn3*100)/$totalMarksInSubjects3),2));
											}else{ echo('صفر'); } ?> </td>
                            </tr>
                        </table> 
                </td>
                <td width="38" style="border-width:0px;" align="center">
                		<table width="40" border="1" cellspacing="0" cellpadding="0">
                        	<tr style="border-width:0px;">
                            	<td> <?php //echo('('.$totalMarksIn1.'/'.$totalMarksInSubjects1.')* 100 < 40');
									  $totalMarksIn1 = $totalMarksIn1 == 0 ? 1:$totalMarksIn1;
									  $totalMarksInSubjects1 = $totalMarksInSubjects1 == 0 ? 1:$totalMarksInSubjects1;
									if(($totalMarksIn1/$totalMarksInSubjects1)* 100 < 40){
										echo("راسب");
									}
									else if(($totalMarksIn1/$totalMarksInSubjects1)* 100 > 40 && ($totalMarksIn1/$totalMarksInSubjects1)* 100 < 56){
										echo('مقبول');
									}
									else if(($totalMarksIn1/$totalMarksInSubjects1)* 100 > 56 && ($totalMarksIn1/$totalMarksInSubjects1)* 100 < 66){
										echo('جید');
									}
									else if(($totalMarksIn1/$totalMarksInSubjects1)* 100 > 65 && ($totalMarksIn1/$totalMarksInSubjects1)* 100 < 76){
										echo('جید جداً');
									}
									else if(($totalMarksIn1/$totalMarksInSubjects1)* 100 > 75){
										echo('ممتاز');
									}
								?> </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> 
									 <?php 
									if(($totalMarksIn2/$totalMarksInSubjects2)* 100 < 40){
										echo("راسب");
									}
									else if(($totalMarksIn2/$totalMarksInSubjects2)* 100 > 40 && ($totalMarksIn2/$totalMarksInSubjects2)* 100 < 56){
										echo('مقبول');
									}
									else if(($totalMarksIn2/$totalMarksInSubjects2)* 100 > 56 && ($totalMarksIn2/$totalMarksInSubjects2)* 100 < 66){
										echo('جید');
									}
									else if(($totalMarksIn2/$totalMarksInSubjects2)* 100 > 65 && ($totalMarksIn2/$totalMarksInSubjects2)* 100 < 76){
										echo('جید جداً');
									}
									else if(($totalMarksIn2/$totalMarksInSubjects2)* 100 > 75){
										echo('ممتاز');
									}
								?> 
                                </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td> 
									 <?php 
									if(($totalMarksIn3/$totalMarksInSubjects3)* 100 < 40){
										echo("راسب");
									}
									else if(($totalMarksIn3/$totalMarksInSubjects3)* 100 > 40 && ($totalMarksIn3/$totalMarksInSubjects3)* 100 < 56){
										echo('مقبول');
									}
									else if(($totalMarksIn3/$totalMarksInSubjects3)* 100 > 56 && ($totalMarksIn3/$totalMarksInSubjects3)* 100 < 66){
										echo('جید');
									}
									else if(($totalMarksIn3/$totalMarksInSubjects3)* 100 > 65 && ($totalMarksIn3/$totalMarksInSubjects3)* 100 < 76){
										echo('جید جداً');
									}
									else if(($totalMarksIn3/$totalMarksInSubjects3)* 100 > 75){
										echo('ممتاز');
									}
								?> 
                              </td>
                            </tr>
                        </table>   
                </td>
                <?php $registrationNo = $crud->getValue("SELECT reg.registrationNo FROM regnumbers reg,registrationinfo r WHERE reg.regSno = r.sno AND reg.regSno =".$regSno,"registrationNo"); 
				//echo($registrationNo);				
									$obtMarksSum1Sql = "SELECT SUM(obtmarks) AS total FROM result 
														WHERE resultTerm = 1 AND 
														stdSno = '".$regSno."' AND 
														promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
														/*echo($obtMarksSum1Sql);
														exit();*/
														$mrks1 = $crud->getValue($obtMarksSum1Sql,"total");
														//echo($mrks1);
														$stdNameSqlA = "SELECT CONCAT(r.stdName,' ولدِ ',r.fatherName) as stdName 
																		FROM registrationinfo r, result reg, regnumbers rr
																		WHERE r.sno = reg.stdSno AND r.isActive = 1 AND reg.promotionDate = '".$promotionDate."' 
																		AND reg.dateEnd = '".$dateEnd."' AND r.sno = ".$regSno." AND reg.stdSno = r.sno LIMIT 1";
														$stdNameA = $crud->getValue($stdNameSqlA,"stdName");
														$result1 .= $mrks1.'<br />'.$stdNameA.",";
														//getFirstPosExm1($result1);
											
								 
									$obtMarksSum2Sql = "SELECT SUM(obtmarks) AS total FROM result 
														WHERE resultTerm = 2 AND 
														stdSno = '".$regSno."' AND 
														promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
														//echo($obtMarksSum2Sql);
														$stdNameSqlB = "SELECT CONCAT(r.stdName,' ولدِ ',r.fatherName) as stdName 
																		FROM registrationinfo r, result reg, regnumbers rr
																		WHERE r.sno = reg.stdSno AND r.isActive = 1 AND reg.promotionDate = '".$promotionDate."' 
																		AND reg.dateEnd = '".$dateEnd."' AND r.sno = ".$regSno." AND reg.stdSno = r.sno LIMIT 1";
														$stdNameB = $crud->getValue($stdNameSqlB,"stdName");
														$mrks2 = $crud->getValue($obtMarksSum2Sql,"total");
														//echo($stdNameSqlB);
														$result2 .= $mrks2.'<br />'.$stdNameB.",";
									 					$obtMarksSum3Sql = "SELECT SUM(obtmarks) AS total FROM result 
														WHERE resultTerm ='3' AND 
														stdSno = '".$regSno."' AND 
														promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
														//echo($obtMarksSum3Sql);
														$stdNameSqlC = "SELECT CONCAT(r.stdName,' ولدِ ',r.fatherName) as stdName 
																		FROM registrationinfo r, result reg, regnumbers rr
																		WHERE r.sno = rr.regSno AND r.isActive = 1 AND reg.promotionDate = '".$promotionDate."'
																		AND reg.dateEnd = '".$dateEnd."' 
																		AND r.sno = ".$regSno." AND reg.stdSno = r.sno LIMIT 1";
														$stdNameC = $crud->getValue($stdNameSqlC,"stdName");
														$mrks3 = $crud->getValue($obtMarksSum3Sql,"total");
														//echo($stdNameSqlC);
														$result3 .= $mrks3.'<br />'.$stdNameC.",";
														
								 ?>
                <td width="59" style="text-align:left; border-width:0px;">
                		<table width="100%" border="1" cellpadding="0" cellspacing="0">
                        	<tr style="border-width:0px;">
                            	<td width="67" nowrap="nowrap" style="vertical-align:middle; text-align:center;font-size:16px; height:20px; line-height:14px; font-weight:bold;" class="attTbl"> غیر حاضری </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td style="vertical-align:middle; text-align:center; height:20px; line-height:14px;" class="attTbl"> رخصت </td>
                            </tr>
                            <tr style="border-width:0px;">
                            	<td style="vertical-align:middle; text-align:center; height:20px; line-height:14px;" class="attTbl"> بیمار </td>
                            </tr>
                        </table>  
                </td>
                <td style="border-width:0px;">                
                    <table width="350" border="0" cellspacing="0" cellpadding="0" style="border-width:0px;">
                         <tr style="border-width:0px;">
                            	<td width="45" style="border-width:0px;"> 
                                     <table width="100%" border="1" cellspacing="0" cellpadding="0">
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php $ten = 10;
                                            $hSql =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '".$ten."' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'غ'";	
													  returnAttendenceOfWholeMonth($hSql);
													  ?> 
                                       </td>
                                     </tr>
                                      <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq2 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '10' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ر'";									  
                                                      returnAttendenceOfWholeMonth($hSq2);
													  ?> 
                                        </td>
                                     </tr>
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq3 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '10' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ب'";	
													   returnAttendenceOfWholeMonth($hSq3);
													  ?> 
                                       </td>
                                     </tr>
                                     </table>
                                </td>
                            	<td width="45" style="border-width:0px;"> 
                           			  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq4 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '11' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'غ'";									  
                                                       returnAttendenceOfWholeMonth($hSq4);
													  ?> 
                                       </td>
                                     </tr>
                                      <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq5 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '11' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ر'";									  
                                                      returnAttendenceOfWholeMonth($hSq5);
													  ?> 
                                        </td>
                                     </tr>
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq6 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '11' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ب'";									  
                                                     returnAttendenceOfWholeMonth($hSq6);											  
													  ?> 
                                       </td>
                                     </tr>
                                     </table>
                              	</td>
                            	<td width="45" style="border-width:0px;"> 
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq7 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '12' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'غ'";									  
                                                     returnAttendenceOfWholeMonth($hSq7);
													  ?> 
                                       </td>
                                     </tr>
                                      <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq8 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '12' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ر'";									  
                                                     returnAttendenceOfWholeMonth($hSq8);
														  ?> 
                                        </td>
                                     </tr>
                                     <tr style="border-width:0px;">
                                        <td style="vertical-align:middle; text-align:center;">    
                                            <?php
                                            $hSq9 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                      AND MONTH(attendanceDate) = '12' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                      AND stdStatus = 'ب'";		
													  returnAttendenceOfWholeMonth($hSq9);													  
													  ?> 
                                       </td>
                                     </tr>
                                     </table>
                                </td>
                            	<td width="45" style="border-width:0px;"> 
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSql_9 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '01' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";	
														 returnAttendenceOfWholeMonth($hSql_9);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq10 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '01' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";	
														 returnAttendenceOfWholeMonth($hSq10);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq11 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '01' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";									  
                                                           returnAttendenceOfWholeMonth($hSq11);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                              	<td width="45" style="border-width:0px;">
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq12 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '02' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";									  
                                                          returnAttendenceOfWholeMonth($hSq12);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq13 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '02' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";
														 returnAttendenceOfWholeMonth($hSq13);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq14 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '02' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";									  
                                                          returnAttendenceOfWholeMonth($hSq14);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                            	<td width="45" style="border-width:0px;">
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq15 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '03' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";	
														  returnAttendenceOfWholeMonth($hSq15);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq16 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '03' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";									  
														   returnAttendenceOfWholeMonth($hSq16);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq17 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '03' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";	
														 returnAttendenceOfWholeMonth($hSq17);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                           		<td width="45" style="border-width:0px;">
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq18 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '04' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";	
														 returnAttendenceOfWholeMonth($hSq18);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq19 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '04' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";	
														  returnAttendenceOfWholeMonth($hSq19);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq20 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '04' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";
														 returnAttendenceOfWholeMonth($hSq20);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
	                            <td width="45" style="border-width:0px;">
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq21 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '05' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";
														 returnAttendenceOfWholeMonth($hSq21);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq22 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '05' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";		
														 returnAttendenceOfWholeMonth($hSq22);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq23 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '05' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";	
														 returnAttendenceOfWholeMonth($hSq23);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                                <td width="45" style="border-width:0px;">
                                <table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq21 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '06' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";
														 returnAttendenceOfWholeMonth($hSq21);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                 $hSq22 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '06' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";		
														 returnAttendenceOfWholeMonth($hSq22);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq23 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '06' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";	
														  returnAttendenceOfWholeMonth($hSq23);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                            	<td width="45" style="border-width:0px;">
                                		<table width="100%" border="1" cellspacing="0" cellpadding="0">
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq24 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '07' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'غ'";	
														  returnAttendenceOfWholeMonth($hSq24);
														  ?> 
                                           </td>
                                         </tr>
                                          <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq25 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '07' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ر'";	
														  returnAttendenceOfWholeMonth($hSq25);
														  ?> 
                                            </td>
                                         </tr>
                                         <tr style="border-width:0px;">
                                            <td style="vertical-align:middle; text-align:center;">    
                                                <?php
                                                $hSq26 =  "SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
                                                          AND MONTH(attendanceDate) = '07' AND darjaSno = ".$darja." AND regSno = ".$regSno." 
                                                          AND stdStatus = 'ب'";	
														  returnAttendenceOfWholeMonth($hSq26);
														  ?> 
                                           </td>
                                         </tr>
                                     </table>
                                </td>
                   	  </tr>                        
                    </table>
                </td>
                <td style="border-width:0px;"> 
                        <table width="100%" border="1" cellspacing="0" cellpadding="0">
                         <tr style="border-width:0px;">
                            <td style="border-width:0px; width:100%">
                            		<table width="100%" border="1" height="65" cellspacing="0" cellpadding="0" style="font-size:15px;">
                                    <tr>
                                        <td style="border-width:0px;text-align:center; vertical-align:middle;" rowspan="3"> 
										<?php 
										foreach($crud->getRecordSet("SELECT COUNT(stdStatus) AS total FROM attendence WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."') AND darjaSno = ".$darja." AND regSno = ".$regSno) as $rows){
											if($rows['total'] > 0){												
												echo("کل غیر حاضری <span style='width:20px;'> : ".$rows['total']."</span>");
											}
											else{
												echo('صاحب الترتیب ');
												}
											}										
										?>
                                       </td>
                                    </tr>                                   
                                </table> 
                            </td>   
                        </tr>
                        </table>
                </td>
              </tr>  
              <?php }//end loop $resultStd
			}//end if no record found by $resultStd
			?>
             </table>
<hr />
<table width="1160" border="1" cellpadding="0" cellspacing="0" style="margin:0 auto;">
	<tr> 
    	<td width="320" style="text-align:center; vertical-align:middle; height:30px;"> <strong>سہ ماہی</strong> امتحان میں پہلی پوزیشن حاصل کرنے والا طالب العلم </td>
        <td width="320" style="text-align:center; vertical-align:middle; height:30px;"> <strong> شش ماہی</strong> امتحان میں پہلی پوزیشن حاصل کرنے والا طالب العلم </td>
        <td width="360" style="text-align:center; vertical-align:middle; height:30px;"> <strong>سالانہ امتحان</strong> میں پہلی پوزیشن حاصل کرنے والا طالب العلم </td>
    </tr>
    <tr> 
    	<td style="border-width:0px;">
                <table width="100%" height="100" border="1" cellpadding="0" cellspacing="0">
                    <tr> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;"> اول </td> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;">دوئم </td> 
                     <td width="115" style="text-align:center; vertical-align:middle; height:25px;"> سوئم </td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:top;"> 
						<?php 						
						$rst1 = substr($result1,0,-1);						
						$ary1 = explode(",",$rst1);
						//print_r($ary1);
						natsort($ary1);
						//echo($ary1[0]);
						//print_r($ary1);
						sort($ary1);
						//print_r($ary1);
						rsort($ary1);
						//print_r($ary1);
						echo($ary1[0]);
						?> 
                    </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary1[1])){echo($ary1[1]);} ?> </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary1[2])){echo($ary1[2]);} ?> </td>
                  </tr>
                </table>
        </td>
         <td style="border-width:0px;">
         		 <table width="100%" height="100" border="1" cellpadding="0" cellspacing="0">
                    <tr> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;"> اول </td> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;">دوئم </td> 
                     <td width="115" style="text-align:center; vertical-align:middle; height:25px;"> سوئم </td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:top;"> <?php $rst2 = substr($result2,0,-1);						
						$ary2 = explode(",",$rst2);
						natsort($ary2);
						sort($ary2);
						rsort($ary2);
						echo($ary2[0]);
						?> 
                    </td>
                    <td style="text-align:center; vertical-align:top;"> <?php 
			if(isset($ary2[1])){ echo($ary2[1]); } ?> </td>
                    <td style="text-align:center; vertical-align:top;"> 
			<?php if(isset($ary2[2])){echo($ary2[2]);} ?> </td>
                   </tr>
                </table>
        </td>
         <td style="border-width:0px;">
         		<table width="100%" height="100" border="1" cellpadding="0" cellspacing="0">
                    <tr> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;"> اول </td> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:25px;">دوئم </td> 
                     <td width="115" style="text-align:center; vertical-align:middle; height:25px;"> سوئم </td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:top;"> <?php $rst3 = substr($result3,0,-1);						
						$ary3 = explode(",",$rst3);
						natsort($ary3);
						sort($ary3);
						rsort($ary3);
						echo($ary3[0]);
						?> 
                    </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary3[1])){echo($ary3[1]); } ?> </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary3[2])){echo($ary3[2]); } ?> </td>
                    </tr>
                </table>
        </td>
    </tr>
    <tr>
    	<td colspan="3" dir="rtl" style="border-width:0px; direction:rtl;">
        		<table width="100%"  border="1" cellpadding="0" cellspacing="0" dir="rtl" style="direction:rtl;">
                	<tr style="border-width:0px;">
                        <td width="32%" style="text-align:center; vertical-align:middle; height:28px; font-weight:bold; line-height:13px;">
                         	 <span id="lastPrintDate1">
							<?php 		
								$sql1 = "SELECT edu_year_remarks FROM result WHERE promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND resultTerm = 1 AND darjasno = ".$darja." ORDER BY sno DESC LIMIT 1";
								$edu_y_remarks1 = $crud->getValue($sql1,"edu_year_remarks");
								echo($edu_y_remarks1); ?> 
                           	</span>
                           </td>
                        <td width="32%" style="text-align:center; vertical-align:middle; font-weight:bold; line-height:13px;">
							<span id="lastPrintDate1">
							<?php 		
								$sql2 = "SELECT edu_year_remarks FROM result WHERE promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND resultTerm = 2 AND darjasno = ".$darja." ORDER BY sno DESC LIMIT 1";
								$edu_y_remarks2 = $crud->getValue($sql2,"edu_year_remarks");
								echo($edu_y_remarks2); ?> 
                           	</span>
                            </td>
                        <td width="36%" style="text-align:center; vertical-align:middle; font-weight:bold; line-height:13px;">
                        <span id="lastPrintDate1">
							<?php 		
								$sql3 = "SELECT edu_year_remarks FROM result WHERE promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND resultTerm = 3 AND darjasno = ".$darja." ORDER BY sno DESC LIMIT 1";
								$edu_y_remarks3 = $crud->getValue($sql3,"edu_year_remarks");
								echo($edu_y_remarks3); ?> 
                           	</span>
                            </td>
                    </tr>
                </table>
        </td>
    </tr>
    </table>
    <?php 
		}//if the result was uploaded on the spesific year 
		else{
			//no result was found on specified year
			echo($crud->errorMsg("مہیاں کردہ سال میں کوئی بھی نتیجہ نہیں بنایا گیا ہے۔","غلطی","../images"));
			}
	} //end if for year and darja fields empty check
}//end if for btnSearch
?>
    </div>
    <form method="post" action="../pages/toExcel.php" id="exporter">
    <input type="hidden" id="sheet" name="sheet" />
    </form>
<br /><br />
</center>
</body>
</html>
<?php ob_flush(); ?>
<script language="javascript">
var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var broName  = navigator.appName;
var nameOffset,verOffset,ix;
// In Chrome, the true version is after "Chrome" 
if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 broName = "Chrome";
	if(broName == "Chrome"){
	$("#tblSession").css("min-height","70px");
	$(".attTbl").css("height","22px");	 
	}
}
</script>