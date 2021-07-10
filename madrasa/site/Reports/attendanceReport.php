<?php ob_start();session_start();
require_once('../classes/classes.php'); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); 
$crud = new CRUD(); 
$hijri = new Hijri_GregorianConvert();
$sqlGetData = ""; 
$date = "";
$darja = "";
//vars to take decision on mizan + kifiat columns in the following table
$mezaan = "";
$kifiat = '';
$hazir = 28;
$ghairHazir = 0;
$rokhsat = 0;
$bemar = 0;
$sno = "";
$serialNo = 0;
$refresh = 0;//if greater then 0, will need to refresh the page
$tempLoopCounter = 0; //how much the loop for insert query will be executing
$timer = date('h:m:s');
	$format="YYYY/MM/DD";
	if(isset($_POST['month']) && !empty($_POST['month'])){
		$date = addslashes($_POST['month']);
		}
	else{
		$date = date("Y/m/d");//get this date from calendar to search over
		}
		$promotionDt = "";
		$dateEd = "";
		$yearHijri = $hijri->GregorianToHijri($date,$format);
		$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
		$dateAdmitionAry = explode('-',$yearHijri);
		//$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];
		$dateAdmition = $dateAdmitionAry[2].'-10-15';
		if(isset($_SESSION['hijri'])){
			$dt = new DateTime($_SESSION['hijri']);
			$promotionDt = $dt->format('Y-m-d');
			$y = explode("-",$promotionDt);
			$y = $y[0] + 1;
			$dateEd = $dt->format($y.'-m-d');
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>تفصیلی رپورٹ رجسٹرڈ طلباء- </title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<script type="text/javascript" src="../js/functions.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<?php // light box stylesheet ?>
<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="../js/thickbox.js"></script>
<link rel="stylesheet" href="../css/thickbox.css" type="text/css" media="screen" />
<?php // end thickbox  ?>
<style type="text/css">
@import "../js/jquery.datepick.css";
</style>
<script type="text/javascript">
$(function() {
	$('#date1').datepick();
	$('#date2').datepick();
	$('#month').datepick();	
});
$(document).ready(function(){
	$(this).dblclick(function(){
		$("#searchPanel").toggle(1000);
		});
	});
$(document).ready(function(){
		$("#num").css("fontSize","14px");
		$("#num td").css("fontWeight","normal");
		$("#num a").css({"text-decoration":"none","color":"#000","font-weight":"bold"});
	});
</script> 
<style>
#singleStdAtt a{ 
		color:#006; text-decoration:none;
		}
#singleStdAtt a:hover{ 
		color:#006; text-decoration:underline;
		}
</style>
</head>
<body style="background-image:none; background-color:#FFF">
<center>
<div id="searchPanel" style="width:1100px; background-color:#CCC">
<form method="post" action="attendanceReport.php" style="margin:0px;">
<table width="1100" align="center" border="1" cellspacing="0" cellpadding="4">
	<tr>
    	<th width="703" colspan="9">
        	<table width="703" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td width="107" align="center"> درجہ منتخب کریں </td>
                    <td width="80" align="center"> <?php $css = 'style="width:180px;position:relative;top:1px;"'; $crud->darjaatCmb('darja',$css); ?> </td>
                    <td width="103" align="center"> تاریخ داخلہ </td>
                    <td width="113" align="center"> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['date1']) && !empty($_REQUEST['date1'])) {echo($_REQUEST['date1']);}else{ echo($promotionDt);} ?>" style="width:100px;" name="date1" id="date1" /></td>
                	<td width="104" align="center"> تاریخ اختتام </td>
                    <td width="130" align="center"> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['date2']) && !empty($_REQUEST['date2'])) {echo($_REQUEST['date2']);}else{ echo($dateEd);} ?>" style="width:100px;" name="date2" id="date2" /></td>
                    <td width="147" align="center"> حاضری برائے ماہ </td>
                    <td width="101" align="center"> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['month']) && !empty($_REQUEST['month'])) {echo($_REQUEST['month']);}else{ echo($promotionDt);} ?>" style="width:100px;" name="month" id="month" /></td>
                    <td width="123" align="center"> <input type="submit" value="رپورٹ دکھائیں" id="showRpt" name="showRpt" class="btnSave" /> </td>
                </tr>
                <tr>
                <td colspan="9">
                	<table width="1080" border="0" cellspacing="0" cellpadding="4">
                        <tr>                            
                            <td style="background-color:#FFF; text-align:center;">
                            <font class="errFonts" style="font-size:16px; padding:3px;"> 
                            اس پینل کو چھپانے کے لئے پیج کے کسی بھی حصہ پر ڈبل کلک کریں اور دوبارہ 
                            کھولنے کے لئے پھر کسی بھی جگہ پر ڈبل کلک کریں
                            </font> </td>
                        </tr>
                    </table>
               </td>
               </tr>
            </table>
        </th>
    </tr>
</table>
</form>
</div>

<?php if(isset($_REQUEST['showRpt'])) { ?>
  <?php if(isset($_REQUEST['date1']) && !empty($_REQUEST['date1']) && 
  		   isset($_REQUEST['date2']) &&  !empty($_REQUEST['date2']) &&
		   isset($_REQUEST['month']) &&  !empty($_REQUEST['month']) && 
  		   isset($_REQUEST['darja']) &&  !empty($_REQUEST['darja'])) { 
  			$date1 = $_REQUEST['date1'];
			$date2 = $_REQUEST['date2'];
			$darja = $_REQUEST['darja'];
			?>
<div id="printerArea" style="width:1100px" title="رپورٹ">
رجسٹر روزانہ حاضری 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
المرحلہ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo($crud->getValue("SELECT darja from darjaat WHERE derjaCode = {$darja}","darja")); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
بابت ماہ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<?php 
	//echo($crud->strFormatDateUrdu($date));
	$hijri->ConstractDayMonthYear($date,"YYYY-MM-DD");
	echo($hijri->Day.'-'.$hijri->Month.'-'. $hijri->Year);
  ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table width="1100" align="center" border="1" cellspacing="0" id="num" cellpadding="4">
	 <tr>	  <th width="30"> سیریل نمبر </th>
              <th width="78" style="text-align:center">نام طالب علم  </th>
              <th width="81"> ولدیت </th>              
              <?php for($th=1; $th<=30; $th++){ ?>
              <th> <?php if($th < 10){ echo('0'.$th); }else{ echo($th);} ?> </th>
              <?php }//end for loop ?>
              <th width="88" style="text-align:center"> میزان </th>
              <th width="112" style="text-align:center"> کیفیت </th>
    </tr>

        		<?php 
						  $crud->connect();
						  $chagedFormat1 = new DateTime($date1);
						  $dateFirst = $chagedFormat1->format("Y-m-d");
						  
						  $chagedFormat2 = new DateTime($date2);
						  $dateSecond = $chagedFormat2->format("Y-m-d");
						  
						  $dateAry = explode("-",$date);
						  $year = $dateAry[0];
						  $month = $dateAry[1];
						  
						  $sqlGetData = "SELECT r.sno,r.stdName,r.fatherName,std.darja 
						 				FROM registrationinfo r, stdDarjaat std 
										WHERE std.darja = ".$darja." AND std.stdSno = r.sno AND 
										std.isCurrent = 1 AND std.dateEnd BETWEEN '".$dateFirst."' AND '".$dateSecond."'";
							/*echo($sqlGetData);			
							exit();*/
							 $result = mysql_query($sqlGetData,$crud->con);
							 if(mysql_num_rows($result) > 0){								
								 while($row = mysql_fetch_assoc($result)){
									  $sno = $row['sno']; $serialNo +=1;
									   $hazir =0;$bemar=0;$ghairHazir=0;$rokhsat=0;
									   $mezaan = '';
									?>
                    <tr>
                    <td><?php echo($serialNo); ?></td>
                    <td width="78" style="text-align:center"> 
                    		<span id="singleStdAtt"> 
                            <a href="attendanceReportSingleStd.php?stdSno=<?php echo($row['sno']); ?>" target="_blank" title="اس طالب العلم کی علحٰیدہ حاضری دیکھیں"> 
							<font style="font-family:'Jameel Noori Nastaleeq'; font-size:16px;"><?php echo($row['stdName']); ?></font> </a> </span> 
							</td>
                          <td width="81" align="center"><font style="font-family:'Jameel Noori Nastaleeq'; font-size:16px;">
							<?php echo($row['fatherName']); ?> 
							</font>
							</td>              
                          <?php for($k=1; $k<=30; $k++){ ?>
                          <td align="center"> <?php 
						  			$registrationNo = $crud->getValue("SELECT registrationNo FROM regnumbers WHERE regSno = ".$row['sno'],"registrationNo");
									
											
									$sql1 = "SELECT stdStatus FROM attendence 
												WHERE regSno = ".$row['sno']." 
												AND YEAR(attendanceDate) = '".$year."' 
												AND MONTH(attendanceDate) = '".$month."'
												AND DAY(attendanceDate) = '".$k."'";																						
									/*echo($sql1);
									exit();	*/
									$sqlAttSno = "SELECT sno FROM attendence 
												WHERE regSno = ".$row['sno']." 
												AND YEAR(attendanceDate) = '".$year."' 
												AND MONTH(attendanceDate) = '".$month."'
												AND DAY(attendanceDate) = '".$k."'";
														
									$attdenceSno = $crud->getValue($sqlAttSno,"sno");							
						  			$status = $crud->getValue($sql1,"stdStatus");
									$att = '';
									//echo('-'.$status.':');
									if(!empty($status)){										
												if($status == 'ح'){
													$att = ('<font color="#000000">'.$status.'</font>'); 
													?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="<?php echo($k);?>"> <?php echo($att); ?> </a>
													<?php 
													$hazir +=1; 
													}
												else if($status == 'غ'){
													$att = ('<font color="#FF0000">'.$status.'</font>');
													?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="<?php echo($k);?>"> <?php echo($att); ?> </a>
													<?php  
													$ghairHazir +=1; 
													}
												else if($status == 'ب'){
													$att = ('<font color="#FF0000">'.$status.'</font>');
													?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="<?php echo($k);?>"> <?php echo($att); ?> </a>
													<?php  
													$bemar +=1; 
													}
												else if($status == 'ر'){
													$att = ('<font color="#FF0000">'.$status.'</font>');
													?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="<?php echo($k);?>"> <?php echo($att); ?> </a>
													<?php  
													$rokhsat +=1; 
													}
											
										} 
									else { 
									$hazir +=1;
									?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="<?php echo($k);?>"> <?php echo('ح'); ?> </a>
													<?php  																			
										}//end if else status
									?> </td>
                               <?php }//end for loop ?>
                          <td width="88" style="text-align:center">
                          	<?php if($ghairHazir == 0 && $bemar == 0 && $rokhsat == 0 && $hazir >= 26){
												$mezaan = 'صاحب الترتیب ';												
										} 
										?>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="1" style="border-width:0px;">
										<?php if(!empty($mezaan)){ ?>
                                        <tr>
                                        	<th colspan="4"> <?php echo($mezaan); ?> </th>
                                        </tr>
                                        <?php }//end if for $mezaan value testing ?>
                                       	<tr>
                                        	<td style="text-align:center; vertical-align:middle; font-weight:bold;"> ح </td>
                                            <td style="text-align:center; vertical-align:middle; font-weight:bold;"> غ </td>
                                            <td style="text-align:center; vertical-align:middle; font-weight:bold;"> ر </td>
                                            <td style="text-align:center; vertical-align:middle; font-weight:bold;"> ب </td>
                                        </tr>
                                        <tr>
                                        	<td style="text-align:center; vertical-align:middle;"> <?php echo($hazir); ?> </td>
                                            <td style="text-align:center; vertical-align:middle;"> <?php echo($ghairHazir); ?> </td>
                                            <td style="text-align:center; vertical-align:middle;"> <?php echo($rokhsat); ?> </td>
                                            <td style="text-align:center; vertical-align:middle;"> <?php echo($bemar); ?> </td>
                                        </tr>
                                    </table>
                             </td>
                          <td width="112" style="text-align:center"> <?php
						    if(isset($sno) && !empty($sno)){
								$isActiveVal = "SELECT isActive FROM registrationinfo WHERE sno =".$sno;
							   	$isOut = $crud->getValue($isActiveVal,"isActive");
							   	if(!$isOut){
									echo('<font color="#FF0000" style="font-weight:bold;"> خارج شدہ </font>');
									}
							   
							   } ?> </td>
                    </tr>
                    <?php }//end if while loop  ?>
                <?php }//end if mysql_num_rows
				else{ ?>
                    <font color="#f00"><b>غلطی</b>منخب کردہ تاریخ میں حاضری نہیں بنائی گئی ہے۔</font>
                    <?php } ?>
        	<?php } //end if for isOk() ?>
            </table>
		</div>
        <?php }//end if for if btnClick event ?>
<?php // echo('values = '.$tempLoopCounter); echo(': opt = '.$_REQUEST['attOpt']); ?>
</center>
<br /><br />
</body>
</html>
<?php ob_flush(); ?>