<?php 
$stdSno = "";
if(isset($_REQUEST['stdSno']) && !empty($_REQUEST['stdSno'])){ $stdSno = $_REQUEST['stdSno']; ?>
<?php require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
<?php 
$sqlGetData = ""; 
$date = "";
$darja = "";
//vars to take decision on mizan + kifiat columns in the following table
$mezaan = "";
$kifiat = '';
$hazir = 0;
$ghairHazir = 0;
$rokhsat = 0;
$bemar = 0;
$format="YYYY/MM/DD";
	$date=date("Y/m/d");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	$dateAdmitionAry = explode('-',$yearHijri);
	$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];

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
<style type="text/css">
@import "../js/jquery.datepick.css";
</style>
<script type="text/javascript">
$(function() {
	$('#date').datepick();
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

$(document).ready(function(){
		$("#num").css("fontSize","14px");
		$("#num td").css("fontWeight","normal");
	});
</script> 
</head>
<body style="background-image:none; background-color:#FFF">
<center>
<div id="searchPanel" style="width:1100px; background-color:#CCC">
<form method="post" action="attendanceReportSingleStd.php" style="margin:0px;">
<table width="95%" align="center" border="0" cellspacing="0" cellpadding="4">
	<tr>
    	<th width="703" colspan="9">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td> درجہ منتخب کریں </td>
                    <td> <select name="darja" id="darja" class="frmSelect" style="width:180px;">
                    <option value=""></option>
                    <?php echo($crud->fillCombo("SELECT derjaCode,darja FROM darjaat ORDER BY sno ASC","derjaCode","darja")); ?>
                    </select></td>
                    <td> سال و ماہ برائے رجسٹر </td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['date']) && !empty($_REQUEST['date'])){echo($_REQUEST['date']);}else{ echo($dateAdmition);} ?>" style="width:180px;" name="date" id="date" /></td>
                	<td>
    					<input type="hidden" name="stdSno" id="stdSno" value="<?php echo($stdSno); ?>" />
	                    <input type="submit" value="رپورٹ دکھائیں" id="showRpt" name="showRpt" class="btnSave" /> </td>
                </tr>
            </table><div id="icons" style="width:1000px;">
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
    </div>
</div>
        </th>
    </tr>
</table>
</form>
</div>

<?php if(isset($_REQUEST['showRpt'])) { ?>
  <?php if(isset($_REQUEST['date']) && !empty($_REQUEST['date']) && isset($_REQUEST['darja']) &&  !empty($_REQUEST['darja'])) { 
  			$date = $_REQUEST['date'];
			$darja = $_REQUEST['darja'];
			$stdSno = $_REQUEST['stdSno'];
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
	 <tr>
              <th width="78" style="text-align:center">نام طالب علم  </th>
              <th width="81"> ولدیت </th>              
              <?php for($th=1; $th<=31; $th++){ ?>
              <th> <?php echo($th); ?> </th>
              <?php }//end for loop ?>
              <th width="112" style="text-align:center"> درجہ </th>
    </tr>
<?php /*?>    	<?php if(isset($_REQUEST['showRpt'])) { ?>
        	<?php if($crud->isOk($_REQUEST['date']) && $crud->isOk($_REQUEST['darja'])) { 
<?php */?>	

        		<?php
						 $sqlGetData = "SELECT DISTINCT r.sno,r.stdName,r.fatherName,std.darja 
						 				FROM registrationinfo r, stdDarjaat std 
										WHERE std.darja = ".$darja." AND std.stdSno = r.sno AND r.isActive = 1 
										AND std.stdSno=".$stdSno." ";
							//echo($sqlGetData);			
						 $crud->connect();
						  $chagedFormat = new DateTime($date);
						  $date = $chagedFormat->format("Y-m-d");
						  $dateAry = explode("-",$date);
						  $day = $dateAry[2];
						  $month = $dateAry[1];
						  $year = $dateAry[0];
						  //print_r($dateAry);
							 $result = mysql_query($sqlGetData,$crud->con);
							 if(mysql_num_rows($result) > 0){								 
								 while($row = mysql_fetch_assoc($result)){
									?>
                    <tr>
                    <td width="78" style="text-align:center"><?php echo($row['stdName']); ?> </td>
                          <td width="81"> <?php echo($row['fatherName']); ?> </td>              
                          <?php for($k=1; $k<=31; $k++){ ?>
                          <td> <?php 
						  			$registrationNo = $crud->getValue("SELECT registrationNo FROM regnumbers WHERE regSno = ".$stdSno,"registrationNo");
									
									$sql1 = "SELECT
												  a.stdStatus
												FROM attendence a,regnumbers r,stddarjaat std
												WHERE YEAR(a.attendanceDate) = '".$year."'
												AND MONTH(a.attendanceDate) = '".$month."'
												AND DAY(a.attendanceDate) = '".$k."'
												AND a.regSno = r.regSno
												AND std.darja = a.darjaSno
												AND std.darja = ".$row['darja']." 
												AND std.stdSno = a.regSno
												AND std.stdSno = ".$row['sno'];												
									//echo($sql1);
									//exit();									
						  			$status = $crud->getValue($sql1,"stdStatus");
									if(!empty($status)){
												if($status === 'ح'){
													echo('<font color="#000000">'.$status.'</font>'); 
													$hazir +=1; 
													}
												else if($status === 'غ'){
													echo('<font color="#FF0000">'.$status.'</font>'); 
													$ghairHazir +=1; 
													}
												else if($status === 'ب'){
													echo('<font color="#336633">'.$status.'</font>'); 
													$bemar +=1; 
													}
												else if($status === 'ر'){
													echo('<font color="#CC3333">'.$status.'</font>'); 
													$rokhsat +=1; 
													}
											//echo($status); 
										} 
									else { 
										$hazir +=1;
									?>
                                                    <a href="../pages/updateAttendanceWindow.php?sno=<?php echo($sno); ?>&date=<?php echo($year.'-'.$month.'-'.$k);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox"> <?php echo('ح'); ?> </a>
													<?php  	
										}
									?> </td>
                               <?php }//end for loop ?>                          
                          <td width="112" style="text-align:center"> <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$darja,"darja")); ?> </td>
                    </tr>
                    <?php }//end if while loop  ?>
                <?php }//end if mysql_num_rows ?>
        	<?php } //end if for isOk() ?>
            </table>
		</div>
        <?php }//end if for if btnClick event ?>
</center>
<br /><br />
</body>
</html>
<?php } ?> 