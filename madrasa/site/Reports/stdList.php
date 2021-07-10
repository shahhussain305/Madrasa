<?php ob_start();session_start();
require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
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
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
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
<script type="text/javascript" language="javascript">
var snd;
	$(document).ready(function(){
	$("#showRpt").click(function(){
		var promotionDate = document.getElementById("promotionDate").value;
		var dateEnd = document.getElementById("dateEnd").value;
		var snoDarja = document.getElementById("darja").value;	
	if(snoDarja == "") {
		alert('مہربانی کر کے درجہ مہیّا کریں۔');
		}
	else if(promotionDate == ""){
		alert('تاریخ ابتداء منتخب کریں');
		}
	else if(dateEnd == ""){
		alert('تاریخ انتہاء منتخب کریں');
		}
	else{
		try{
			if (window.XMLHttpRequest) { snd=new XMLHttpRequest(); }else { snd=new ActiveXObject("Microsoft.XMLHTTP"); }
				  snd.onreadystatechange=function() {
				  if (snd.readyState != 4){
					document.getElementById("data").innerHTML = '<img src="../images/loading/loader.gif" alt="Loading" style="border-width:0px;" />';
					}	
				  else {
					  document.getElementById("printerArea").innerHTML = snd.responseText;
					  }		
				  }
					snd.open("POST","../AjaxPhp/registeredStdListByDarjaAndDate.php",true);
					snd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					snd.send("snoDarja="+snoDarja+"&promotionDate="+promotionDate+"&dateEnd="+dateEnd+"&rnd="+Math.random());
			}catch(e){
			alert(e.descriptions);
			}
		}//end of else
	});
 });
 </script>
</head>
<body style="background-image:none; background-color:#ffffff; font-family:'Jameel Noori Nastaleeq';">
<center>
<div id="searchPanel" style="width:1020px; background-color:#CCC">
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

<form method="post" action="stdList.php?cmd=rptShow" style="margin:0px;">
<table width="1020" align="center" border="1" cellspacing="0" cellpadding="4">
	<tr>
    	<th colspan="9">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td> درجہ منتخب کریں </td>
                    <td> <?php $css = 'style="width:180px;position:relative; top:1px;"';		
           					   $crud->darjaatCmb('darja',$css); ?>
                    </td>
                    <td> تاریخ ابتداء </td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($promotionDt);} ?>" style="width:180px;" name="promotionDate" id="promotionDate" /></td>
                	<td> تاریخ انتہاء </td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEd);} ?>" style="width:180px;" name="dateEnd" id="dateEnd" /></td>
                    <td> <input type="button" value="رپورٹ دکھائیں" id="showRpt" name="showRpt" class="btnSave" /> </td>
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


<div id="printerArea" style="width:1020px; background-color:#ffffff;" title="رپورٹ">
<table width="1020" align="center" border="1" cellspacing="0" cellpadding="4">	
    </tr>
    <tr>
    	<td width="20"> نمبر شمار </td>
    	<td width="50"> اسم الطالب </td>
        <td width="50"> اسم الاب </td>
        <td width="139"> رجسٹریشن نمبر </td>
        <td width="105"> تاریخِ پیدائش </td>
        <td width="54"> رول نمبر </td>
        <td width="196"> مستقل پتہ </td>
        <td width="99"> تاریخِ داخلہ</td>
        <td width="95"> رابطہ نمبر </td>
    </tr>
    <tr>
    	<td colspan="9">
        <span id="data"></span>
        </td>
    </tr>
</table>
</div>
</center>
</body>
</html>
<?php ob_flush(); ?>