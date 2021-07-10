<?php ob_start(); session_start(); 
require_once('../classes/classes.php');
$crud = new CRUD(); 
require_once('../includes/configuration.php');
$darja = ""; $result = ""; $strSubject = ""; $colspan = 0; $i=0; $sno = 0; $strSubjectMrks = "";$regSno = "";
$subjectMarksSql = ""; $resultMarks = ""; $subjectMarksSql1 = ""; $resultMarks1 = "";
$totalMarksIn1 = 0;$totalMarksIn2 = 0; $totalMarksIn3 = 0;$totalMarksInSubjects1 = 1;
$registrationNo = 0; $optTxt = '';
//it will hold the obtanied total marks per result by the student on the year bases
$result1 = "";
$mrks1 = "";
$resultCounter = 0;
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
<form method="post" action="resultSheetByExamType.php" class="generalTextFonts">
  <table width="1117" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100">
    <tr>
      <td width="1117" style="text-align:center; vertical-align:middle;">
      	<table align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="46" style="vertical-align:middle;"><font color="#FFFFFF"> درجہ  </font></td>
          <td width="205" style="vertical-align:middle;">
          <?php $css = 'style="width:180px;position:relative; top:1px;"';		
           		$crud->darjaatCmb('darja',$css); ?>
          		</td>
          <td width="108" style="color:#ffffff;"> <span style="position:relative; top:10px;"> تاریخ ابتداء </span> </td>
          <td width="128"> 
                <input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($sessionDate);} ?>" />
          </td>
          <td width="93" style="color:#ffffff;"><span style="position:relative; top:10px;"> تاریخ انتہا </span> </td>
          <td width="137"> 
                <input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEnding);} ?>" />
          </td>
		  <td width="97" style="color:#ffffff;"> <span style="position:relative; top:10px;"> امتحان </span> </td>
		  <td width="183" style="vertical-align:middle;"> 
          <select name="resultTerm" id="resultTerm" class="frmSelect" style="width:180px;">
          	<option value="1"> سہ ماہی </option>
            <option value="2"> شش ماہی </option>
            <option value="3"> سالانہ </option>
          </select>
          </td>          
          <td width="83" style="vertical-align:middle;">
          <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:0px; border-radius:5px;" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form><div id="icons" style="width:1000px;">
    <div align="center">
        <a href="#" id="hide" onclick="return false;" title="سرچ پینل کو چھہائیں"> 
         <img src="../images/minus.png" style="border-width:0px;" /> 
         </a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="print" onclick="return false;" title="سرچ پینل کو چھہائیں"> 
         <img src="../images/print.png" style="border-width:0px;" /> 
         </a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#" id="show" onclick="return false;" title="سرج پینل کو کھولیں"> 
         <img src="../images/plus.png" style="border-width:0px;" /> 
        </a>
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <font class="headingTxtDiv"> رزلٹ شیٹ</font>
    </div>
</div>
</div>


<div id="printerArea" style="width:1117px">
<?php 
$resultTerm = "";
$year = "";
$sqlRstSearch = "";
if(isset($_REQUEST['btnSearch'])){
	if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
		isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
		isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) && 
		isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm'])){
			$darja=addslashes($_REQUEST['darja']);
			$promotionDate = addslashes($_REQUEST['promotionDate']); 
			$dateEnd = addslashes($_REQUEST['dateEnd']);
			$resultTerm = addslashes($_REQUEST['resultTerm']);
			//check if the result is available on this year or not
		    $sqlRstSearch = "SELECT * FROM result WHERE promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."' AND resultTerm = ".$resultTerm." AND darjaSno = ".$darja;
		   //echo($sqlRstSearch);
		if($crud->search($sqlRstSearch)) { 
			if($resultTerm == 1) { $optTxt = ' الفترۃ الاول '; } else if($resultTerm == 2) { $optTxt = ' الفترۃ الثانی '; } else if($resultTerm == 3) { $optTxt = ' الفترۃ السنوی '; }else { $optTxt = '';}
		?>
<table width="1117" border="0" align="center">
  <tr>
    <td width="403"><h2 style="position:relative; width:200px; right:1px;"><?php echo(M_Name); ?></h2>
    <font style="font-size:20px; position:relative; right:1px;">  <?php echo(L_Address); ?></font>
    </td>
    <td width="294" align="center"><h2>مکتب نتائج الاختبار <?php  echo($optTxt); ?>
    <hr style="border-style:double; height:6px;" />
    المرحلۃ <?php if(isset($_REQUEST['darja'])) { echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$_REQUEST['darja'],"darja")); } ?> 
    </h2>
    </td>
    <td width="406" style="text-align:center; vertical-align:middle; padding-right:70px;">
    	<table width="400" border="0" cellspacing="0" cellpadding="3">
        	<tr>
            	<td style="text-align:right;">  </td>
            </tr>
            <tr>
                <td style="text-align:right;"> </td>
            </tr>
            <tr>
                <td style="text-align:right;"> <span style="padding: 0 0 0 10px;">تاریخ اجراء </span>
                <?php $sqlRemarks = "SELECT edu_year_remarks FROM result WHERE resultTerm = ".$resultTerm." AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'"; ?>
                <input type="text" value="<?php echo($crud->getValue($sqlRemarks,"edu_year_remarks")); ?>" id="ex2" style="width:250px; border:0px; padding:2px;" />
                </td>
            </tr>
        </table>
    </td>
  </tr>
</table>


<table width="1104" border="1" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td width="36" style="vertical-align:middle; text-align:center;"><font size="3">الرقم</font></td>
    <td width="75" nowrap="nowrap" style="vertical-align:middle; text-align:center;">
    <font size="3" style="font-family:'Jameel Noori Nastaleeq'; line-height:20px;">اسم طالب </font></td>
    <td width="122" style="vertical-align:middle; text-align:center; font-weight:bold;"><font size="3">اسم الاب</font></td>
    <td width="350" style="vertical-align:middle; text-align:center; border-width:0px;">
    		<table border="1" cellspacing="0" cellpadding="0" width="350">
                 <?php   //to fetch all the subjects in the specified darja in table below
					$subjectSql = "SELECT sno,subjectName FROM subjects WHERE darjaSno = ".$darja;					
					if($crud->search($subjectSql)) {
						$subject_ary = array();
						foreach($crud->getRecordSet($subjectSql) as $rowSubject){
							$colspan += 1;
							$subject_ary[] = $rowSubject["sno"];
							$sbj = $rowSubject['subjectName'];
							$sbj = str_replace("/","<br />",$sbj);
							$sbj = str_replace(",","<br />",$sbj);
							$sbj = str_replace("،","<br />",$sbj);
                            $strSubject .= "<td style='width:80px;vertical-align:middle; text-align:center;'> ". $sbj. "</td>";
							}						
				 		?>
                        <tr>
                            <td align="center" style="width:350px;" <?php if($colspan > 1){ echo(" colspan='".$colspan."'")	; } ?>> مضامین </td>
                        </tr>
                        <tr>
                            <?php echo($strSubject); //print_r($subject_ary); ?>
                        </tr>
                        <?php }//end if mysql_num_rows() ?>
        	</table>
    </td>   
    <td width="89" style="text-align:center; vertical-align:middle;"><font size="3">مجموع الدرجات</font></td>
    <td width="86" style="text-align:center; vertical-align:middle;"><font size="3">الدرجات المحصلۃ</font></td>
    <td width="78" style="text-align:center; vertical-align:middle;"><font size="3">الاوسط</font></td>
    <td width="90" style="text-align:center; vertical-align:middle"><font size="3">التقدیر</font></td>
    <td width="158" style="text-align:center; vertical-align:middle"><font size="3">کشف الحضور</font></td>
  </tr>
  
  <?php //loop over the data ?>
  <?php 
  		$resultAllSql = "SELECT DISTINCT
						  r.stdName,
						  r.fatherName,
						  r.sno
						FROM registrationInfo r,stdDarjaat st, result rs
						WHERE st.darja = ".$darja." AND rs.darjaSno = ".$darja." AND r.isActive = 1 AND resultTerm = ".$resultTerm." 
							AND st.stdSno = r.sno AND rs.stdSno = r.sno 
							AND rs.promotionDate = '".$promotionDate."' 
							AND rs.dateEnd = '".$dateEnd."'"; 
					//echo($resultAllSql);
					//exit();
			//$resultStd = mysql_query($resultAllSql,$crud->con);
			if($crud->search($resultAllSql)){
				//while($rowsStd = mysql_fetch_assoc($resultStd)){ $sno += 1;
				foreach($crud->getRecordSet($resultAllSql) as $rowsStd){
				$regSno = $rowsStd['sno'];
 			 ?>      
              <tr>
                <td width="36"><font size="3"> <?php echo($sno); ?> </font></td>
                <td width="75"><font size="3" style="font-family:'Jameel Noori Nastaleeq'; line-height:17px;">
				<?php echo($rowsStd['stdName']); ?></font></td>
                <td width="122"> <?php echo($rowsStd['fatherName']); ?> </td>
                <td style="width:350px; border-width:0px;">
                        <table border="1" cellpadding="0" cellspacing="0">
                             <tr>
							 	<?php  //to fetch all the subjects in the specified darja in table below
                                                               							
								$subjectMarksSql =     "SELECT r.obtmarks,regInfo.stdName,r.resultTerm,r.subjectSno,r.edu_year_remarks 
														FROM result r,regnumbers reg,registrationinfo regInfo
														WHERE r.darjaSno = ".$darja." AND regInfo.sno = r.stdSno  
														AND regInfo.sno = reg.regSno AND r.resultTerm = ".$resultTerm." AND 
														regInfo.sno = ".$regSno." AND regInfo.isActive = 1  
														AND r.promotionDate = '".$promotionDate."'
													 	AND r.dateEnd = '".$dateEnd."'";										
																		
                               
							    if($crud->search($subjectMarksSql)) { //print_r($subjectMarksSql);
								$totalMarksInSubjects1 = 0;
								$totalMarksIn1 = 0;
								$aryCounter = -1;
								foreach($crud->getRecordSet($subjectMarksSql) as $rowSub){	$aryCounter += 1;
										  $totalMarksIn1 += $rowSub['obtmarks']; 
										  $totalMarksInSubjects1 += $crud->getValue("SELECT s.totalMarks FROM subjects s WHERE s.sno = ".$rowSub['subjectSno'],"totalMarks");                                   						
	                                    
										$sqlMarks = "SELECT obtmarks FROM result WHERE 
																				stdSno = '".$regSno."'
																				AND	darjaSno = ".$darja." 
																				AND subjectsno = '".$subject_ary[$aryCounter]."'
																				AND resultTerm = ".$resultTerm." 
																				AND promotionDate = '".$promotionDate."'
													 							AND dateEnd = '".$dateEnd."'";
														  $obtN = $crud->getValue($sqlMarks,"obtmarks");
										
										?>                                    
                                        <td style="width:80px; vertical-align:middle; text-align:center; <?php if($obtN < 40){ ?> background-color:#CACACA;<?php } ?>"> 
										<?php echo($obtN); ?> 
                                        </td>
                                        <?php }//end foreqach()
										 }//end if mysql_num_rows() 
										 ?>
                          </tr>
                              
                        </table>
                </td>   
                <td width="89" style="vertical-align:middle; text-align:center;"> <?php echo($totalMarksInSubjects1); ?> </td>
                <td width="86" style="vertical-align:middle; text-align:center;"> <?php  echo($totalMarksIn1); ?> </td>
                <td width="78" style="vertical-align:middle; text-align:center;"><?php echo(round((($totalMarksIn1*100)/$totalMarksInSubjects1),2)); ?> </td>
                <td width="90">
                		<table width="90" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td> <?php //echo('('.$totalMarksIn1.'/'.$totalMarksInSubjects1.')* 100 < 40');
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
                        </table>   
                </td>
                <?php $registrationNo = $crud->getValue("SELECT reg.registrationNo FROM regnumbers reg,registrationinfo r WHERE reg.regSno = r.sno AND reg.regSno =".$regSno,"registrationNo"); 
				
									$obtMarksSum1Sql = "SELECT SUM(obtmarks) AS total FROM result 
														WHERE resultTerm = ".$resultTerm." AND 
														stdSno = '".$regSno."'  
														AND promotionDate = '".$promotionDate."' 
							 							AND dateEnd = '".$dateEnd."' AND darjaSno = ".$darja;
														/*echo($obtMarksSum1Sql);
														exit();*/
														$mrks1 = $crud->getValue($obtMarksSum1Sql,"total");
														//echo($mrks1);
														$stdNameSqlA = "SELECT CONCAT(r.stdName,' ولدِ ',r.fatherName) as stdName 
																		FROM registrationinfo r, result reg, regnumbers rr
																		WHERE r.sno = reg.stdSno AND r.isActive = 1 AND resultTerm = ".$resultTerm." 
																		AND reg.promotionDate = '".$promotionDate."' 
																		AND reg.dateEnd = '".$dateEnd."' 
																		AND r.sno = ".$regSno." AND reg.stdSno = r.sno LIMIT 1";
														$stdNameA = $crud->getValue($stdNameSqlA,"stdName");
														$result1 .= $mrks1.'<br />'.$stdNameA.",";
								 ?>
                <td width="158">
                <?php /*?><table width="100%" border="1" style="border:0px; padding:0;" cellspacing="0" cellpadding="4">
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
                                    </table><?php */?>
                
                </td>
              </tr>  
              <?php }//end loop $resultStd
			}//end if no record found by $resultStd
			?>
             </table>
<table width="1104" border="1" cellpadding="0" cellspacing="0">
	<tr> 
    	<td width="363" style="text-align:center; vertical-align:middle; height:30px;"> کیفیّت </td>        
    </tr>
    <tr> 
    	<td style="border-width:0px;">
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tr> 
                     <td width="364" style="text-align:center; vertical-align:middle; height:25px;"> اول </td> 
                     <td width="364" style="text-align:center; vertical-align:middle; height:25px;"> دوئم </td> 
                     <td width="369" style="text-align:center; vertical-align:middle; height:25px;"> سوئم </td>
                </tr>
                <tr>
                    <td style="text-align:center; vertical-align:top;"> 
						<?php 						
						$rst1 = substr($result1,0,-1);						
						$ary1 = explode(",",$rst1);
						natsort($ary1);
						sort($ary1);
						rsort($ary1);
						echo($ary1[0]);
						?> 
                    </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary1[1])){ echo($ary1[1]);} ?> </td>
                    <td style="text-align:center; vertical-align:top;"> <?php if(isset($ary1[2])) { echo($ary1[2]);} ?> </td>
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
<br /><br />
</center>
</body>
</html>
<?php ob_flush(); ?>