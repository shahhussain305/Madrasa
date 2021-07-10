<?php ob_start(); session_start();
require_once('../classes/classes.php'); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); ?>
<?php $crud = new CRUD(); ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
<?php 
require_once("../includes/configuration.php");
$sqlGetData = ""; 
$date = "";
$darja = "";
$headerAppenderCounter = 0;
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
$rptHeader = '';
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
	$('#endDate').datepick();
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
<body style="background-image:none; background-color:#FFF;font-family:'Jameel Noori Nastaleeq';">
<center>
<div id="searchPanel" style="width:600px; background-color:#CCC">
<form method="post" action="examMarksEmptyReport.php" style="margin:0px;">
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="4">
	<tr>
    	<th width="600" colspan="9">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td> درجہ منتخب کریں </td>
                    <td> <?php $css = 'style="width:187px; position:relative;top:1px; right:2px;"';		
						$crud->darjaatCmb('darja',$css); ?>                    
                    </td>
                 </tr>
                 <tr> 
                   	<td> تاریخ داخلہ</td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['date']) && !empty($_REQUEST['date'])) {echo($_REQUEST['date']);}else{ echo($promotionDt);} ?>"  style="width:180px;" name="date" id="date" /></td>
                 </tr>
                 <tr>
                  	<td> تاریخ اختتام</td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['endDate']) && !empty($_REQUEST['endDate'])) {echo($_REQUEST['endDate']);}else{ echo($dateEd);} ?>"  style="width:180px;" name="endDate" id="endDate" /></td>           
				</tr>
                <tr>
                    <td colspan="2" align="center"> <input type="submit" value="رپورٹ دکھائیں" id="showRpt" name="showRpt" class="btnSave" /> </td>
                </tr>
            </table><div id="icons" style="width:600px;">
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

<?php if(isset($_REQUEST['showRpt'])) {
  if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && isset($_REQUEST['date']) && !empty($_REQUEST['date'])) {
  		$date = $_REQUEST['date'];
		$darja = $_REQUEST['darja'];
		$dt = new DateTime($date);
		$endDate = $_REQUEST['endDate'];
		$dateAdm = $dt->format('Y-m-d');
		$dt1 = new DateTime($endDate);
		$endDate_1 = $dt1->format('Y-m-d');
		
		//$endDate = $dt->format("Y-m-d");
		$rptHeader = '
				 <tr>
				 	<td colspan="5" style="text-align:center; font-size:25px; font-weight:bold;"> برائے سال <span style="padding:2px 6px;">&nbsp;</span>'
					.$dateAdm.'<span style="padding:2px 6px;">&nbsp;</span>  ھ <span style="padding:2px 6px;">&nbsp;</span> '.$endDate_1.' </td>
				 </tr>
				 <tr>
                          <td colspan="3" style="text-align:center; font-size:20px; font-weight:bold;">
                          ' .M_Name .'&nbsp; (' .$crud->getValue("SELECT darja FROM darjaat WHERE derjaCode=".$darja,"darja").') 
                          </td>
                          <td colspan="2" style="text-align:center; font-size:20px;"> اسم الکتاب</td>
                </tr>
                <tr style="text-align:center; font-size:15px;">
                    <td> الرقم </td>
                    <td> اسم الطالب </td>
                    <td> اسم الاب </td>
                    <td> کشف الحضور </td>
                    <td> الدرجات </td>
                </tr>';		
			?>
            <div id="printerArea" style="width:600px" title="رپورٹ">
            <table width="600" align="center" border="1" cellspacing="0" id="num" cellpadding="4">
                <?php echo($rptHeader); ?>
        		<?php
						 $counter = 0;
						 $sqlGetData = "SELECT r.sno,r.stdName,r.fatherName,std.darja 
						 				FROM registrationinfo r, stdDarjaat std 
										WHERE std.darja = $darja AND std.stdSno = r.sno AND std.isCurrent = 1 
										AND r.isActive = 1 AND std.promotionDate between '$date' AND '$endDate'";
										//echo($sqlGetData); 
						 $crud->connect();
							 $result = mysql_query($sqlGetData,$crud->con);
							 if(mysql_num_rows($result) > 0){
								 while($row = mysql_fetch_assoc($result)){ $counter += 1; $headerAppenderCounter +=1; ?>
									  <tr>
									  <td width="41" style="text-align:center; font-size:15px;"> <?php echo($counter); ?>  </td>
									  <td width="253" style="text-align:center; font-size:15px;"> <?php echo($row['stdName']); ?>  </td>
									  <td width="253" style="text-align:center; font-size:15px;"> <?php echo($row['fatherName']); ?> </td>
									  <td width="250" style="text-align:center; font-size:15px;"> </td>
									  <td width="251" style="text-align:center; font-size:15px;"> </td>
									  </tr>                                      
                                      <?php //add header to the page if total record reached to 20 rows
									  	if($headerAppenderCounter >= 21){ $headerAppenderCounter = 0; ?>
										<tr>
                                          <td colspan="5" style="height:70px; border-left-width:0px;">
                                          <div style="position:relative; background-color:#ffffff; height:70px;">
                                          <div style="height:76px; background-color:#ffffff; position:absolute; width:610px; top:-3px; left:-2px; right:-15px;">&nbsp;</div>
                                           </div>
                                          </td>
                                        </tr>		
									  <?php
									  		echo($rptHeader);
										 	} //end for $headerAppenderCounter
									   ?>
									  <?php }//end if while loop  ?>
								  <?php }//end if mysql_num_rows ?>
							  <?php } //end if for isOk() 
							  else{ 
								  echo($crud->errorMsg("مہربانی کرکے تاریخ ٹھیک لکھیں","غلطی","../images"));
								   }//end else for wrong date in the search boxes ?>
            </table>
            <br /><br />
		</div>
        <?php }//end if for if btnClick event ?>
</center>
</body>
</html>
<?php ob_flush(); ?>
<script language="javascript">
var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var broName  = navigator.appName;
/*var fullVersion  = ''+parseFloat(navigator.appVersion); 
var majorVersion = parseInt(navigator.appVersion,10);*/
var nameOffset,verOffset,ix;

// In Chrome, the true version is after "Chrome" 
if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 broName = "Chrome";
	if(broName == "Chrome"){
	$("#darja").css("width","178px");		 
	}
}
</script>
