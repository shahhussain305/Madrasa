<?php ob_start(); session_start(); 
require_once('../classes/classes.php'); ?>
<?php require_once("../classes/Hijri_GregorianConvert.php");?>
<?php $crud = new CRUD(); 
require_once('../includes/configuration.php');
$cal = new Hijri_GregorianConvert();
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
$colspans = "";$rowCounter = 0;$titleTbl="";$exTyp="";$drja="";
$darja = ""; $result = ""; $strSubject = ""; $colspan = 0; $i=0; $sno = 0; $strSubjectMrks = "";$regSno = "";$edu_year_remarks="";
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>رزلٹ شیٹ برائے <?php if(isset($_REQUEST['darja'])) { $sqlDarja = "SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['darja']; echo($crud->getValue($sqlDarja,"darja")); } ?></title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
td{
	vertical-align:top;
	font-family:'Jameel Noori Nastaleeq';
	line-height:20px;
	}
#singleStdAllResult a{ font-size:20px; color:#ffffff; text-decoration:none; }
#singleStdAllResult a:hover{ font-size:20px; color:#ffffff; text-decoration:underline; }
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
});
$(document).ready(function(){
	$("#hide").click(function(){
		$("#searchPanel").slideUp(1000);
		});
	});
$(document).ready(function(){
		$("body").dblclick(function(){
			$("#searchPanel").slideDown(1000);
			});
		$(document).dblclick(function(){
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
<body style="background-image:none; background-color:#ffffff;">
<center>
<div id="searchPanel" style="width:1117px; background-color:#CCC">
<form method="post" action="resultQuarter.php" class="generalTextFonts">
  <table width="1117" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100">
    <tr>
      <td width="1117" style="text-align:center; vertical-align:middle;">
      <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="41" style="vertical-align:middle;"><font color="#FFFFFF"> درجہ  </font></td>
          <td width="209" style="vertical-align:middle;">
          		<?php $css = 'style="width:180px; height:40px; position:relative; top:1px; font-size:15px;"';		
           			  $crud->darjaatCmb('darja',$css); ?>
                </td>
                 <td width="97" style="color:#ffffff;"> <span style="position:relative; top:10px;"> تاریخ ابتداء </span> </td>
                    <td width="127"> 
                          <input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($sessionDate);} ?>" />
                    </td>
                    <td width="83" style="color:#ffffff;"><span style="position:relative; top:10px;"> تاریخ انتہا </span> </td>
                    <td width="134"> 
                          <input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEnding);} ?>" />
                    </td>
                <td width="66" style="color:#ffffff;"> <span style="position:relative; top:10px;"> امتحان </span> </td>
                <td width="151">
 				<select name="examType" class="frmSelect" style="width:150px; height:40px; font-size:15px;">
				<option value="1"> سہ ماہی </option>
                <option value="2"> ششماہی </option>
                <option value="3"> سالانہ </option>
                </select>
                </td>
                <td width="84" style="vertical-align:middle;">
				<input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:0px; border-radius:5px;" />
				</td>    
                <td width="81"> 
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


<div id="printerArea" style="width:1117px">
<?php 
$sqlRstSearch = "";
if(isset($_REQUEST['btnSearch'])){
	if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 	
		isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
		isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
		$darja=addslashes($_REQUEST['darja']);
			$promotionDate = addslashes($_REQUEST['promotionDate']); 
			$dateEnd = addslashes($_REQUEST['dateEnd']);
			$examType = $_REQUEST['examType'];
			//check if the result is available on this year or not
		    $sqlRstSearch = "SELECT * FROM result WHERE promotionDate = '".$promotionDate."' AND 
						 dateEnd = '".$dateEnd."' AND resultTerm=".$examType." AND darjaSno = ".$darja;
		//echo($sqlRstSearch);
		if($crud->search($sqlRstSearch)) {
			if($examType==1){$exTyp='الفترۃ الاولٰی'; }else if($examType == 2){$exTyp='الفترۃ الثانی';}else{$exTyp='الفترۃ السنوی';}
		    if(isset($_REQUEST['darja'])) { 
				$drja = $crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['darja'],"darja"); } 
			
			$titleTbl = '<table width="1100" border="0" align="center">
			  <tr>
				<td width="364" style="padding:9px 30px 0 0;"><h2>'.M_Name.'</h2>
				<font style="font-size:20px;"> '.L_Address.' </font>
				</td>
				<td width="340" align="center" style="font-family:\'Aseer Unicode\';">
			<h2 style="font-size:18px !important;">مکتب نتائج الاختبار '.$exTyp.' </h2>
			<h2 style="font-size:18px !important;"> المرحلۃ'.$drja.' </h2>
				</td>
				<td width="452" style="text-align:right; vertical-align:middle; padding-right:100px; position:relative; right:100px;">
					<span style="font-size:17px;">تعلیمی سال </span>
					<span class="dat"></span>
				</td>
			  </tr>
			</table>';
			?>

<?php   //to fetch all the subjects in the specified darja in table below
 				$subjectSql = "SELECT sno,subjectName FROM subjects WHERE darjaSno = ".$darja;
						$subject_ary = array();
							foreach($crud->getRecordSet($subjectSql) as $rowSubject){
							$colspan += 1; 
							$sbj = $rowSubject['subjectName'];
							$sbj = str_replace(",","/",$sbj);
							$sbj = str_replace("،","/",$sbj);
							$subject_ary[] = $rowSubject["sno"];
                            $strSubject .= "<td style='width:90px; height:25px; vertical-align:middle; text-align:center;'> ". $sbj. "</td>";
							}//foreach()
						//}//end if mysql_num_rows()							
				 		?>
<?php if($colspan > 1){ $colspans = " colspan='".$colspan."'"; } ?>

<table width="1116" border="1" align="center" cellspacing="0" cellpadding="0" style="border:0px;">
 <?php
$headers = ' 
<tr>
	<td colspan="9">'.$titleTbl.' </td>
 </tr>
<tr id="heading">	
    <td width="24" style="vertical-align:middle; text-align:center;"><font size="3">الرقم</font></td>
    <td width="180" nowrap="nowrap" style="vertical-align:middle; text-align:center;" colspan="2">
     <font size="3" style="font-family:\'Jameel Noori Nastaleeq\'; line-height:20px;">اسم طالب مع ولدیت</font>
    </td>    
    <td width="466" style="vertical-align:middle; text-align:center; border-width:0px;">
    		<table width="483" border="1" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="479" align="center" '.$colspans.'> مضامین </td>
                        </tr>
                        <tr> '.$strSubject.' </tr>                        
        	</table>
    </td>   
    <td width="42" style="text-align:center; vertical-align:middle;"><font size="3">مجموع الدرجات</font></td>
    <td width="41" style="text-align:center; vertical-align:middle;"><font size="3">الدرجات المحصلۃ</font></td>
    <td width="42" style="text-align:center; vertical-align:middle;"><font size="3">الاوسط</font></td>
    <td width="42" style="text-align:center; vertical-align:middle"><font size="3">التقدیر</font></td>
    <td width="247" style="border-width:1px; vertical-align:middle; text-align:center"> 
    کشف الحضور 
    <table width="100%" border="1" style="border:0px;" cellpadding="3" cellspacing="0">
		<tr>
        	<td width="33%"> غیر حاضر</td>
            <td width="33%"> بیماری </td>
            <td width="33%"> رخصت </td>
        </tr>
	</table>
    </td>
  </tr> 
';

echo($headers);

//loop over the data ?>
  <?php 
  		$resultAllSql = "SELECT DISTINCT
						  r.stdName, r.fatherName, r.sno
						FROM registrationInfo r,stdDarjaat st, result rs
						WHERE st.darja = ".$darja." AND rs.darjaSno = ".$darja." AND rs.promotionDate = '".$promotionDate."' 
							 AND rs.dateEnd = '".$dateEnd."'
							 AND r.isActive = 1 AND st.stdSno = r.sno AND rs.stdSno = r.sno"; 
				
				foreach($crud->getRecordSet($resultAllSql) as $rowsStd){
				$sno += 1;
				$regSno = $rowsStd['sno'];
				$rowCounter += 1;
				if($rowCounter >= 17) { echo('<tr><td colspan='.$colspan.' style="border:0px; height:70px;">&nbsp</td></tr>'); echo($headers); $rowCounter = 0;}
 			 ?>      
              <tr>
                <td width="24" height="26" style="padding:4px 2px 0 0;"><font size="3"> <?php echo($sno); ?> </font></td>
                <td width="60" style="padding:4px 2px 0 0;"><font size="3" style="font-family:'Jameel Noori Nastaleeq'; line-height:17px;">
				<?php echo($rowsStd['stdName']); ?></font>
                </td>   
		<td width="80" style="padding:4px 2px 0 0;"><font size="3" style="font-family:'Jameel Noori Nastaleeq'; line-height:17px;">
		 <?php echo($rowsStd['fatherName']); ?> </font> </td>             
                <td style="border-width:0px;">
                <?php //print_r($subject_ary); ?>
                        <table width="483" border="1" cellpadding="0" cellspacing="0">
                             <tr style="border-width:0px;">
							 	<?php  //to fetch all the subjects in the specified darja in table below
                                $subjectMarksSql =     "SELECT r.obtmarks,regInfo.stdName,r.resultTerm,r.subjectSno,r.edu_year_remarks 
														FROM result r,regnumbers reg,registrationinfo regInfo
														WHERE r.darjaSno = ".$darja." AND regInfo.sno = r.stdSno  
														AND regInfo.sno = reg.regSno AND r.resultTerm = ".$examType." AND 
														regInfo.sno = ".$regSno." AND regInfo.isActive = 1  
														AND r.promotionDate = '".$promotionDate."'
													 	AND r.dateEnd = '".$dateEnd."'";
                               							/*echo('<textarea>'.$subjectMarksSql.'</textarea>');
														exit();*/
								 
							    if($crud->search($subjectMarksSql)) { //print_r($subjectMarksSql);
								$totalMarksInSubjects1 = 0;
								$totalMarksIn1 = 0;
								$mezaan1 = 0; $mezaan2 = 0; $mezaan3 = 0;
									$aryCounter = -1;  
									foreach($crud->getRecordSet($subjectMarksSql) as $rowSub){ $aryCounter += 1;
									$totalMarksIn1 += $rowSub['obtmarks']; 
									$totalMarksInSubjects1 += $crud->getValue("SELECT s.totalMarks FROM subjects s WHERE s.sno = ".$rowSub['subjectSno'],"totalMarks");                                   						
	                                    $sqlMarks = "SELECT obtmarks FROM result WHERE 
																				stdSno = '".$regSno."'
																				AND	darjaSno = ".$darja." 
																				AND subjectsno = '".$subject_ary[$aryCounter]."'
																				AND resultTerm = ".$examType." 
																				AND promotionDate = '".$promotionDate."'
													 							AND dateEnd = '".$dateEnd."'";
														  $obtN = $crud->getValue($sqlMarks,"obtmarks");
														  //echo($rowSub['obtmarks']); 
										?>                                    
                                        <td style="vertical-align:middle; height:28px; width:90px; text-align:center; <?php if($obtN < 40){ ?> background-color:#CACACA;  <?php } ?>">
										<?php echo($obtN); ?> 
                                        </td>
                                        <?php 
										}//end foreach()
										 }//end if mysql_num_rows() 
										 ?>
                          </tr>       
                        </table>
                </td>   
                <td width="42" style="border-width:1px;">
                            	 <?php if($totalMarksInSubjects1 > 0){ echo($totalMarksInSubjects1);}else{ echo('صفر'); } ?>    
                </td>
                <td width="41" style="border-width:1px;">
                		<?php if($totalMarksIn1 > 0){ echo($totalMarksIn1);}else{ echo('صفر'); } ?> 
                </td>
                <td width="45" style="border-width:1px;">
                		 <?php if($totalMarksInSubjects1 > 0){
											echo(round((($totalMarksIn1*100)/$totalMarksInSubjects1),2)); 
								}else{ echo('صفر'); } ?> 
                </td>
                <td width="42" style="border-width:1px; text-align:center;">
                		<?php //echo('('.$totalMarksIn1.'/'.$totalMarksInSubjects1.')* 100 < 40');
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
								?> 
            			    </td>
			                <?php $registrationNo = $crud->getValue("SELECT reg.registrationNo FROM regnumbers reg,registrationinfo r WHERE reg.regSno = r.sno AND reg.regSno =".$regSno,"registrationNo"); 
											$obtMarksSum1Sql = "SELECT SUM(obtmarks) AS total FROM result 
														WHERE resultTerm = ".$examType." AND 
														stdSno = '".$regSno."' AND 
														promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
														/*echo($obtMarksSum1Sql);
														exit();*/
														$mrks1 = $crud->getValue($obtMarksSum1Sql,"total");
														//echo($mrks1);
														$stdNameSqlA = "SELECT CONCAT(r.stdName,' ولدِ ',r.fatherName) as stdName 
																		FROM registrationinfo r, result reg, regnumbers rr
																		WHERE r.sno = reg.stdSno AND r.isActive = 1 
																		AND reg.promotionDate = '".$promotionDate."' 
																		AND reg.dateEnd = '".$dateEnd."' 
																		AND r.sno = ".$regSno." AND reg.stdSno = r.sno LIMIT 1";
														$stdNameA = $crud->getValue($stdNameSqlA,"stdName");
														$result1 .= $mrks1.'<br />'.$stdNameA.",";
														//getFirstPosExm1($result1);
								 ?>
				                <td style="border-width:1px;" align="center"> 
  									<table width="100%" border="1" style="border:0px; padding:0;" cellspacing="0" cellpadding="4">
                              		<?php if($crud->search("SELECT * FROM attendence WHERE regSno = '".$regSno."' AND YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."') AND stdStatus != 'ح'")){ ?>
                                                    	<tr>
                                                        	<td width="33%" align="center"> 
																<?php	
																$v1 = 0;										                                                           
                                                                $hSql1 =  "SELECT COUNT(stdStatus) AS totalG FROM attendence 
																		  WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
																		  AND darjaSno = ".$darja." AND regSno = ".$regSno." 
																		  AND stdStatus = 'غ'";	
																		  $v1 = $crud->getValue($hSql1,"totalG");
																		  if($v1 != 0){
																			  echo($v1);
																			}
																			
                                                		              ?>
                                                            </td>
                                                            <td width="33%" align="center"> 
																<?php 	
																$v2 = 0;														
																$hSql2 =  "SELECT COUNT(stdStatus) AS totalB FROM attendence
																		  WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
																		  AND darjaSno = ".$darja." AND regSno = ".$regSno." 
																		  AND stdStatus = 'ب'";	
																		  $v2 = $crud->getValue($hSql2,"totalB");
																		   if($v2 != 0){
																			  echo($v2);
																			}
															 ?> </td>
                                                            <td width="33%" align="center"> 
																<?php 
																$v3 = 0;
									 							$hSql3 =  "SELECT COUNT(stdStatus) AS totalR FROM attendence 
																		  WHERE YEAR(attendanceDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')
																		  AND darjaSno = ".$darja." AND regSno = ".$regSno." 
																		  AND stdStatus = 'ر'";	
																		  $v3 = $crud->getValue($hSql3,"totalR");
																		   if($v3 != 0){
																			  echo($v3);
																			  }
															?> 
                                                            </td>
                                                        </tr>
											<?php }else{ ?>
											<tr> 
                                            	<td align="center"> <?php echo('صاحب الترتیب'); ?> </td>
                                            </tr>
									<?php } ?>
                                    </table>
							                </td>
					              </tr>  
              <?php }//end loop $resultStd
			//}//end if no record found by $resultStd
			?>
             </table>
             
              <br />
    <div id="positions">
    	<table width="1118" border="1" cellpadding="0" cellspacing="0">
	<tr> 
    	<td width="363" style="text-align:center; vertical-align:middle; height:30px;"> 
        <strong><?php if($examType == 1) {?> سہ ماہی <?php }else if($examType == 2){ ?> شش ماہی <?php }else{ ?> سالانہ <?php } ?></strong>
         امتحان میں پہلی،دوسری اور تیسری پوزیشن حاصل کرنے والے طلباء </td>
    </tr>
    <tr> 
    	<td style="border-width:0px;">
                <table width="100%" height="100" border="1" cellpadding="0" cellspacing="0">
                    <tr> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:30px;"> الاول </td> 
                     <td width="111" style="text-align:center; vertical-align:middle; height:30px;"> الثانی </td> 
                     <td width="115" style="text-align:center; vertical-align:middle; height:30px;"> الثالث </td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:middle;"> 
						<?php 						
						$rst1 = substr($result1,0,-1);						
						$ary1 = explode(",",$rst1);
						natsort($ary1);
						sort($ary1);
						rsort($ary1);
						
						echo(@$ary1[0]);
						?> 
                    </td>
                    <td style="text-align:center; vertical-align:middle;"> <?php if(isset($ary1[1])){echo($ary1[1]);} ?> </td>
                    <td style="text-align:center; vertical-align:middle;"> <?php if(isset($ary1[2])){echo($ary1[2]);} ?> </td>
                  </tr>
                </table>
        </td>
        </tr>
                </table>
        </td>
    </tr>
    <tr>
    	<td colspan="3" style="border-width:0px;">
        		<table width="100%"  border="1" cellpadding="0" cellspacing="0">
                	<tr style="border-width:0px;">
                        <td width="33%" style="text-align:center; vertical-align:middle; height:28px; font-weight:bold; line-height:13px;">
 			     امتحان <?php if($examType == 1) {?> سہ ماہی <?php }else if($examType == 2){ ?> شش ماہی <?php }else{ ?> سالانہ <?php } ?>
                             : التاریخ [<span id="lastPrintDate">
							<?php 		
								$sql1 = "SELECT edu_year_remarks FROM result WHERE promotionDate = '".$promotionDate."' 
										 AND dateEnd = '".$dateEnd."' AND resultTerm = ".$examType." AND darjasno = ".$darja." ORDER BY sno DESC LIMIT 1";
								$edu_y_remarks = $crud->getValue($sql1,"edu_year_remarks");
								echo($edu_y_remarks); ?> 
                           	</span>]
				<script language="javascript" type="text/javascript">
					$(document).ready(function(){
					var txt = $("#lastPrintDate").html();	
					$(".dat").html(txt);
				}); 
			</script>
                           </td>                       
                    </tr>
                </table>
        </td>
    </tr>
    </table>        
    </div>
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
    
<br /><br />
</center>
</body>
</html>
<?php ob_flush(); ?>