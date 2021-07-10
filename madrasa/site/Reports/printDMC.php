<?php require_once('../classes/classes.php'); ?>
<?php require_once("../classes/Hijri_GregorianConvert.php");?>
<?php $crud = new CRUD(); 
$cal = new Hijri_GregorianConvert();
require_once("../includes/configuration.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> ڈی۔ایم۔سی </title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style type="text/css">
td{ text-align:center;}
#bg{
	background:url(../images/dmc/bgMiddle.png);
	background-repeat:repeat-y;
	width:636px;
	margin:0 auto;
	min-height:750px;
	}
#bgBottom{
	background:url(../images/dmc/bgBottom.png);
	background-repeat:no-repeat;
	width:636px;
	margin:0 auto;
	height:75px;
	}
#bgTop{
	background:url(../images/dmc/bgTop.png);
	background-repeat:no-repeat;
	width:636px;
	margin:0 auto;
	height:65px;
	}
.titleFont{
	padding:0px !important;
	}		
</style>
</head>
<body style="background-image:none; background-color:#ffffff; font-family:'Jameel Noori Nastaleeq';">

<?php 
$totalNumberObtained = 0;
$totalNumber=0;
$darja = '';
$rollNubmer = "";
$resultTerm = "3"; //سالانہ
$registrationNo = "";
$permanentAddress="";
if(isset($_REQUEST['regSno']) && !empty($_REQUEST['regSno']) &&
   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) &&
   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {
	$darja = $_REQUEST['darja'];
	$regSno = addslashes($_REQUEST['regSno']);
	$promotionDate = addslashes($_REQUEST['promotionDate']);
	$dateEnd = addslashes($_REQUEST['dateEnd']);
	$endHijriYear = explode("-",$promotionDate);
	$promotionHijriYear = explode("-",$dateEnd);
	$endHijriYear = $endHijriYear[0];
	$promotionHijriYear = $promotionHijriYear[0];
			$sql="SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,st.darja,reg.RollNumber,reg.registrationNo  
					FROM registrationinfo r,regnumbers reg,stdDarjaat st
					WHERE r.sno=reg.regSno AND reg.regSno = '".$regSno."' AND st.stdSno = r.sno 
					AND st.isCurrent = 1 AND r.isActive = 1 AND st.darja = ".$darja;
				 // echo($sql);
							if($crud->search($sql)){
								$rslt = mysql_query($sql,$crud->con);
								$row = mysql_fetch_assoc($rslt);
								$stdname=$row['stdName'];
								$fathername=$row['fatherName'];
								$dob=$row['dob'];
								$rollNubmer = $row['RollNumber'];
								$registrationNo = $row['registrationNo'];
								$permanentAddress = $row['permanentAddress'];
							}
?>
<div id="printArea" align="center">
<div id="bgTop"></div>
<div id="bg">
<img src="../images/dmc/darjaatLogo.png" style="border:0px; width:501px; height:89px;" />
<table align="center" cellpadding="2" cellspacing="0" width="506" border="1" style="direction:rtl;">
<?php /*?><tr>
	<th colspan="4">
    <!--<div>
    <div style="float:right;"><img src="../images/logo.png" style="width:171px; height:142px" /></div>-->
    <!--<div style="float:left;">-->
    <img src="../images/dmc/darjaatLogo.png" style="border:0px; width:568px; height:102px;" />
    <!--<font class="titleFont" style="line-height:35px; font-size:25px; font-family:Asad; position:relative; top:80px; left:80px;"> کشف الدرجات / رزلٹ کارڈ </font></div>
    <span style="clear:both;"></span>
    </div>-->
    </th>
</tr><?php */?>
<tr>
	<td colspan="2" align="center"> <font class="titleFont" style="line-height:30px; font-size:20px;">
     درجہ : <?php echo($crud->getValue("SELECT darja FROM darjaat where derjaCode = ".$darja,"darja")); ?> </font></td>
    <td colspan="2" align="center"><font class="titleFont" style="line-height:30px; font-size:20px;">
      سالانہ امتحان &nbsp;&nbsp; <?php echo($endHijriYear.' - '.$promotionHijriYear); ?> ھ  </font> </td>
</tr>
<tr>
	<td width="144"><font class="titleFont" style="line-height:30px; font-size:20px;"> رول نمبر</font> </td>
    <td width="112"><font class="titleFont" style="line-height:30px; font-size:20px;"> <?php echo($rollNubmer); ?>  </font> </td>
    <td width="155"><font class="titleFont" style="line-height:30px; font-size:20px;"> رجسٹریشن نمبر </font> </td>
    <td width="137"><font class="titleFont" style="line-height:30px; font-size:17px;"> <?php echo($registrationNo); ?> </font> </td>  
</tr>
<tr>
	<td><font class="titleFont" style="line-height:30px; font-size:20px;"> نام </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo($stdname); ?> </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;"> ولدیت </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo($fathername); ?> </font> </td>  
</tr>
<tr>
	<td><font class="titleFont" style="line-height:30px; font-size:20px;"> تاریخ پیدائش </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo($dob); ?> </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;"> ضلع </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo($permanentAddress); ?> </font> </td>  
</tr>
<tr>
	<td><font class="titleFont" style="line-height:30px; font-size:20px;"> الحاق نمبر </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo(Elhaq); ?> </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;"> نام مدرسہ </font> </td>
    <td><font class="titleFont" style="line-height:30px; font-size:20px;">  <?php echo(M_Name); ?> </font> </td>  
</tr>
<tr>
	<td><font class="titleFont" style="line-height:40px; font-size:20px;"> العنوان </font> </td>
    <td colspan="3"><font class="titleFont" style="line-height:40px; font-size:25px;">  <?php echo(L_Address); ?> </font> </td>
</tr>
<tr>
	<td colspan="4" align="center"> <font class="titleFont" style="line-height:26px; font-size:20px; font-family:arial;">تفصیل الارقام </font> </td>
</tr>
</table>
<table align="center" cellspacing="0" cellpadding="2" width="506" border="1" style="direction:rtl">
  <tr>
    <td width="193"><font class="titleFont" style="font-size:20px;"> المادۃ </font> </td>
    <td width="193"><font class="titleFont" style="font-size:20px;"> الدرجات </font> </td>
    <td width="169"><font class="titleFont" style="font-size:20px;"> مجموعہ الدرجات </font> </td>
  </tr>
  <?php 
	//$darja = $crud->getValue("SELECT darja FROM registrationinfo r, regnumbers reg WHERE reg.registrationNo = '".$registrationNo."';","darja");
  	$sqlDmc = "SELECT subjectsno,obtmarks FROM result where stdSno='".$regSno."' AND 
				resultTerm='".$resultTerm."' AND darjaSno = '".$darja."' AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'";
  	//echo($sqlDmc);
	//$result1 = mysql_query($sqlDmc,$crud->con); 
	if($crud->search($sqlDmc)){
  	foreach($crud->getRecordSet($sqlDmc) as $row1){
		$totalNumberObtained += $row1['obtmarks'];
		$totalNumber += $crud->getValue("SELECT totalMarks from subjects where sno = ".$row1['subjectsno'],"totalMarks");
   ?>
  <tr>
    <td><?php echo($crud->getValue("SELECT subjectName from subjects where sno = ".$row1['subjectsno'],"subjectName")); ?> </td>
    <td><?php echo($row1['obtmarks']); ?> </td>
    <td><?php echo($crud->getValue("SELECT totalMarks from subjects where sno = ".$row1['subjectsno'],"totalMarks")); ?> </td>
  </tr>
  <?php } ?>
  <tr>
  	<td><font class="titleFont" style="font-size:20px; font-family:arial;"> الدرجات المحصلہ </font> </td>
    <td><font class="titleFont" style="font-size:20px; font-family:arial;"> <?php echo($totalNumberObtained); ?> </font> </td>
    <td><font class="titleFont" style="font-size:20px; font-family:arial;"> <?php echo($totalNumber); ?> </font> </td>
  </tr>
    <tr>
  	<td colspan="2"><font class="titleFont" style="font-size:24px;"> تقدیر </font> </td>
    <td><font class="titleFont" style="font-size:24px;"> 
	<?php 
									
									if(($totalNumberObtained/$totalNumber)* 100 < 40){
										echo("راسب");
									}
									else if(($totalNumberObtained/$totalNumber)* 100 > 40 && ($totalNumberObtained/$totalNumber)* 100 < 56){
										echo('مقبول');
									}
									else if(($totalNumberObtained/$totalNumber)* 100 > 56 && ($totalNumberObtained/$totalNumber)* 100 < 66){
										echo('جید');
									}
									else if(($totalNumberObtained/$totalNumber)* 100 > 65 && ($totalNumberObtained/$totalNumber)* 100 < 76){
										echo('جید جداً');
									}
									else if(($totalNumberObtained/$totalNumber)* 100 > 75){
										echo('ممتاز');
									}
								?> 
     </font> </td>
  </tr>
<?php }//end if record found in table
else{
	?>
   <tr>
   	<td colspan="3">
    	<font class="titleFont" style="font-size:24px;">
   			 اس طالب  علم کا سالانہ رزلٹ ابھی تک اپ لوڈ نہیں کیا گیا ہے۔
             </font>
             </td>
   </tr>
    <?php }//end else record not found in table ?>  
  </table>

<?php }//end if for resSno check ?>
</div>
</div>
<div id="bgBottom"></div>
</body>
</html>