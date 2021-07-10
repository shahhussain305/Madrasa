<?php ob_start();session_start();
require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); ?>
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
<title>تفصیلی رپورٹ رجسٹرڈ طلباء- </title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<script type="text/javascript" src="../js/functions.js"></script>
<script language="javascript" type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style type="text/css">
@import "../js/jquery.datepick.css";
* {
	font-family:'Jameel Noori Nastaleeq';
	}
</style>
<script type="text/javascript">
$(function() {
	$('#admissionYear').datepick();
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
<script type="text/javascript" language="javascript">
var snd;
var year,snoDarja,opt;
	$(document).ready(function(){
	$("#showRpt").click(function(){
		year = document.getElementById("admissionYear").value;
		snoDarja = document.getElementById("darja").value;
		opt = document.getElementById("opt").value;
		//alert(year+"\n"+snoDarja+"\n"+opt);
	if((year.length < 10 || year.length > 10) || (snoDarja == "")) {
		alert('مہربانی کر کے داخلہ سال اور درجہ مہیّا کریں۔');
		}
	else{
		try{
			if (window.XMLHttpRequest) { snd=new XMLHttpRequest(); }else { snd=new ActiveXObject("Microsoft.XMLHTTP"); }
				  snd.onreadystatechange=function() {
				  if (snd.readyState != 4){
					document.getElementById("msg").innerHTML = '<img src="../images/loading/loader.gif" alt="Loading" style="border-width:0px;" />';
					}	
				  else {
					  document.getElementById("printerArea").innerHTML = snd.responseText;
					  document.getElementById("msg").innerHTML = '';
					  }		
				  }
					snd.open("POST","../AjaxPhp/nonLocalStdList.php",true);
					snd.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					snd.send("snoDarja="+snoDarja+"&year="+year+"&opt="+opt+"&rnd="+Math.random());
			}catch(e){
			alert(e.descriptions);
			}
		}//end of else
	});
 });
 </script>
</head>
<body style="background-image:none; background-color:#ffffff;">
<center>
<div id="searchPanel" style="width:1100px; background-color:#CCC">
<span id="msg"></span>
<form method="post" action="nonLocalStdList.php?cmd=rptShow" style="margin:0px;">
<table style="width:1100px" align="center" border="1" cellspacing="0" cellpadding="4">
	<tr>
    	<th colspan="10">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td> درجہ منتخب کریں </td>
                    <td> <?php $css = 'style="width:211px; position:relative;top:1px;"';		
           					   $crud->darjaatCmb('darja',$css); ?></td>
                    <td> داخلہ سال </td>
                    <td> <input type="text" class="frmInputTxt" style="width:160px;" value="<?php if(isset($_REQUEST['admissionYear']) && !empty($_REQUEST['admissionYear'])) {echo($_REQUEST['admissionYear']);}else{ echo($promotionDt);} ?>" name="admissionYear" id="admissionYear" /></td>
                    <td> 
                    <select name="opt" id="opt" class="frmSelect" style="width:160px;">
                    	<option value="0"> غیر رہائشی </option>
                        <option value="1"> رہائشی</option>
                    </select>
                    </td>
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


<div id="printerArea" style="width:1100px" title="رپورٹ">
        <span id="data"></span>
</div>
</center>
</body>
</html>
<?php ob_flush(); ?>