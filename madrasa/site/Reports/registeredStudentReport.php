<?php ob_start(); session_start(); require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php');  ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
<?php 
	$format="DD/MM/YYYY";
	$date=date("d/m/Y");
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
<title>داخلہ فارم برائے داخل شدہ طلباء- </title>
<?php // light box stylesheet ?>
<script language="javascript" type="text/javascript" src="../js/jquery.min.js"></script>
<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<?php // end light box stylesheet ?>
<?php // Lightbox css ?>
<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>
<?php // End Lightbox Completed ?>
<?php //calendar ?>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style type="text/css">
@import "../js/jquery.datepick.css";
</style>
<script type="text/javascript">
$(function() {
	$('#dtFrom').datepick();
	$('#dtTo').datepick();
});
</script>
<?php //End Calendar ?>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<script type="text/javascript" src="../js/functions.js"></script>
<style>
#listTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#listTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}

#darjaTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#darjaTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}
#rpt a{
	font-family:'Jameel Noori Nastaleeq';
	font-size:25px !important;
	color:#F00;
	}		
</style>
</head>
<body style="font-family:'Jameel Noori Nastaleeq'; background-image:none; background-color:#ffffff;" class="admissionReport">
<center>
<div id="searchPanel" style="width:1020px; background-color:#CCC">
<table width="100%" align="center" border="0" cellpadding="7" cellspacing="0" style="background-color:#999">
   <tr>
  <td colspan="7" style="background-color:#ffffff;">
  <?php 
  	  $snoNum = 0;
	  $sql = "SELECT derjaCode as sno,darja FROM darjaat ORDER BY sno ASC";
	  ?>
	 	<form method="post" action="?cmd=registeredStudentReport">
            <table width="1020" align="center" border="0" cellpadding="7" cellspacing="0" id="darjaTbl" style="background-color:#ffffff">
                <tr>
                    <td colspan="9" style="height:80px;">
                     کسی بھی طالب العلم کی داخلہ فارم نکالنے کے لئے اس کے داخلہ فارم کے لنک پر کلک کریں۔
                     </td>
                </tr>
                <tr>
                    <td> درجہ منتخب کریں</td>
                    <td>
                     <?php $css = 'style="width:180px;position:relative; border:1px solid #e4e4e4; top:1px;"';		
           				   $crud->darjaatCmb('sno',$css); ?>                
                    </td>
                    <td> تاریخ سے </td> 
                    <td> <input class="frmInputTxt" style="width:100px;" type="text" id="dtFrom" name="dtFrom" value="<?php if(isset($_REQUEST['dtFrom']) && !empty($_REQUEST['dtFrom'])) {echo($_REQUEST['dtFrom']);}else{ echo($promotionDt);} ?>" /></td>
                    <td> تاریخ تک </td>
                    <td><input class="frmInputTxt" style="width:100px;" type="text" name="dtTo" id="dtTo" value="<?php if(isset($_REQUEST['dtTo']) && !empty($_REQUEST['dtTo'])) {echo($_REQUEST['dtTo']);}else{ echo($dateEd);} ?>" /></td>
                    <td><input type="submit" class="btnSave" name="btnSearch" id="btnSearch" value="تلاش کریں" /> </td>
                </tr>
             </table>
			</form>
	   
</td>
</tr>
</table>
<div style="height:20px; width:1020px;"></div>
<span id="list">
<?php 
	if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
	   isset($_REQUEST['dtFrom']) && !empty($_REQUEST['dtFrom']) &&
	   isset($_REQUEST['dtTo']) && !empty($_REQUEST['dtTo'])){
		$sno = addslashes($_REQUEST['sno']);
		$dtFrom = addslashes($_REQUEST['dtFrom']);
		$dtTo = addslashes($_REQUEST['dtTo']);
	?>
    <script language="javascript" type="text/javascript">
	try{
		$(document).ready(function(){
			$("#listTbl a").css({"text-decoration":"none","color":"#03F"});
		});
		}catch(err){
		
		}
	</script>
   <table width="1020" align="center" border="1" cellspacing="0" cellpadding="4" id="listTbl">
	  <tr style="font-size:20px; font-weight:bold;background-color:#000000;color:#ffffff;">
    	<th width="43" style="padding:3px;"> نمبر شمار </th>
    	<th width="191" style="padding:3px;"> اسم الطالب </th>
        <th width="160" style="padding:3px;"> رجسٹریشن نمبر </th>
        <th width="115" style="padding:3px;"> تاریخِ پیدائش </th>
        <th width="74" style="padding:3px;"> رول نمبر </th>
        <th width="180" style="padding:3px;"> مستقل پتہ </th>
        <th width="85" style="padding:3px;"> درجہ </th>
        <th width="85" style="padding:3px;"> داخلہ فارم </th>
    </tr>
   <?php 
   	$crud = new CRUD(); 
   	$crud->connect();
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo,d.darja 
				  FROM registrationinfo r, regnumbers n,darjaat d,stdDarjaat std
				  WHERE r.sno = n.regSno AND std.darja = d.derjaCode AND std.stdSno = r.sno AND 
				  std.darja = ".$sno." AND std.promotionDate BETWEEN '".$dtFrom."' AND '".$dtTo."' AND std.isCurrent = 1 AND r.isActive = 1 ORDER BY n.RollNumber ASC";
	//echo($sqlSearch);
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="9" style="background-color:#ffffff; height:60px; padding:3px;">
            	<?php echo($crud->errorMsg("اس درجہ میں کوئی بھی طالب العلم داخل نہیں ہوا ہے۔","غلطی","../images")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ 
		$sno +=1;
		$snoNum +=1;
   ?>
    <tr style="font-size:20px;">
    	<td width="43" style="height:60px; text-align:center"> <?php echo($snoNum); ?> </td>
    	<td width="191" align="center"> <?php echo($row['stdName']); ?>  ولدِ <?php echo($row['fatherName']); ?> </td>
        <td width="160" align="center"><a href="../?cmd=registrationUpdateForm&registrationNoSearch=<?php echo($row['registrationNo']); ?>&btnSearch=true" target="_blank" title="یہاں سے طالب العلم کی رجسٹریشن تبدیل کر سکتے ہیں۔"> <?php echo($row['registrationNo']); ?> </a> </td>
        <td width="115" align="center"> <?php echo($row['dob']); ?> </td>
        <td width="74" align="center"> <?php echo($row['RollNumber']); ?> </td>
        <td width="180"> <span style="position:relative; right:5px;"> <?php echo($row['permanentAddress']); ?> </span> </td>
        <td width="85" align="center"> <?php echo($row['darja']); ?> </td>
        <td width="85" align="center"> 
        	<span id="rpt">
         		<a href="reportAdmissionForm.php?sno=<?php echo($row['sno']); ?>" target="_blank" title="داخلہ فارم">داخلہ فارم </a> 
        	</span>
         </td>
    </tr>
    <?php }//end while loop
	}//end of else
	 ?>
</table>
    <?php
	}
else{
	echo('درجہ پر کلک کر کے لسٹ دکھائیں.');
	}
?>
</span>
</div>
</center>
</body>
</html>
<?php ob_flush(); ?>