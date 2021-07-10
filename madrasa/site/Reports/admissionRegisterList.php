<?php ob_start();session_start();
 ini_set('display_errors',0); 
 error_reporting(0);  // to keep error warning off replace E_ALL on 0
require_once('../classes/classes.php'); 
$crud = new CRUD();
require_once('../includes/configuration.php');
require_once('../classes/Hijri_GregorianConvert.php');  ?>
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
/*$(function(){
	 $('input:radio[name=opt]').click(function(){
		if($('input:radio[name=opt]:checked').val() == 1){
			opt = 1;
			}
		if($('input:radio[name=opt]:checked').val() == 2){
			opt = 2;
			}
		 });
	 });
*/	 
	 
$(document).ready(function(){
	$("#showRpt").click(function(){
		//alert("snoDarja="+snoDarja+"&year="+year+"&opt="+opt+"&rnd="+Math.random());
		year = document.getElementById("admissionYear").value;
		snoDarja = document.getElementById("darja").value;
		opt = $('input[name=opt]:checked').val();		
	if((year.length < 10 || year.length > 10) || (snoDarja == "") || opt == null) {
		alert('مہربانی کر کے داخلہ سال اور درجہ مہیّا کریں۔');
		}
	else{
		try{			
			if (window.XMLHttpRequest) { snd=new XMLHttpRequest(); } else { snd=new ActiveXObject("Microsoft.XMLHTTP"); }
				  snd.onreadystatechange=function() {					  
				  if (snd.readyState != 4){
					  document.title = 'Please Wait ...';
					//document.getElementById("data").innerHTML = '<img src="../images/loading/loader.gif" alt="Loading" style="border-width:0px;" />';
					}	
				  else {
					  document.getElementById("printerArea").innerHTML = snd.responseText;
					  document.title = 'تفصیلی رپورٹ رجسٹرڈ طلباء-';
					  getDarjaLbl(snoDarja,"darjaLbl","../AjaxPhp/getDarjaLabBySno.php");
					  }		
				  }
					snd.open("POST","../AjaxPhp/admissionRegisterList.php",true);
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
<body style="font-family:'Jameel Noori Nastaleeq'; background-image:none; background-color:#ffffff;">
<center>
<div id="searchPanel" style="width:1133px; padding-left:20px; background-color:#CCC;">
<form method="post" action="stdList.php?cmd=rptShow" style="margin:0px;">
<table width="1140" align="right" border="1" cellspacing="0" cellpadding="4">
	<tr>
    	<th colspan="9">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" style="height:60px; font-size:25px" class="titleFont">
            	<tr>
                	<td> درجہ منتخب کریں </td>
                    <td> <?php $css = 'style="width:205px;position:relative; top:1px; border:1px solid #e5e5e5;"';		
           					   $crud->darjaatCmb('darja',$css); ?>
                               </td>
                    <td> داخلہ سال </td>
                    <td> <input type="text" class="frmInputTxt" value="<?php if(isset($_REQUEST['admissionYear']) && !empty($_REQUEST['admissionYear'])) {echo($_REQUEST['admissionYear']);}else{ echo($promotionDt);} ?>" style="width:140px;" name="admissionYear" id="admissionYear" /></td>
                    <td> 
                    	 <input type="radio" name="opt" id="dakhil" checked="checked" value="1" /> داخل
                    	 <input type="radio" name="opt" value="2" id="kharij" /> خارج
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


<div id="printerArea" style="width:1160px; background-color:#ffffff; min-height:550px;" title="رپورٹ">
<table width="1160" align="right" border="1" cellspacing="0" cellpadding="4" style="padding-left:15px; border:0px;">
	<tr>
    	<th colspan="10" class="titleFont" style="height:60px; text-align:center; font-size:40px;"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<th style="font-size:35px;"> <?php echo(M_Name); ?><br /><font style="font-size:22px;"><?php echo(L_Address); ?></font></th>
                <th style="font-size:20px; font-family:'Aseer Unicode';"> رجسٹر داخل / خارج <br />
                	تعلیمی درجہ / 
                </th>
                <th style="font-size:18px;">  الحاق نمبر <?php echo(Elhaq); ?> <br /> رجسٹریشن نمبر  <?php echo(Reg_Number); ?>
                <br /> تعلیمی سال <?php //echo($hijri->HijriToGregorian(date('d-m-Y'),"DD/MM/YYYY")); ?> </th>
                </tr>
         </table>
        </th>
    </tr>
    <tr>
    	<td width="40"> الرقم  </td>
    	<td width="60"> اسم الطالب </td>
        <td width="70">اسم الوالد</td>
        <td width="84"> تاریخ المیلاد</td>
        <td width="85" colspan="2"> شناختی کارڈ نمبر / فارم ب</td>
        <td width="80"> اسم الضامن</td>
        <td width="171">العنوان الدائم</td>
        <td width="139"> العنوان</td>
        <td width="95"> الرقم الھاتف</td>
    </tr>
    <tr>
    	<td colspan="10">
        <span id="data"></span>
        </td>
    </tr>
</table>
<br />
</div>
</center>
</body>
</html>
<?php ob_flush(); ?>