<script type="text/javascript">
$(function() {
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
});
function validate()
{
	 valid=false;
	 var registrationNo=document.getElementById('registrationNo');
	// var year=document.getElementById('year');
	 if(registrationNo.value=="")
	 {
		 alert("رجسٹریشن نمبر لکھیں");
		 registrationNo.focus();
	 }
	 //else if(year.value=="")
	 //{
		// alert("سال لکھیں");
		 //year.focus();
	 //}
	 else{
	 valid=true;
	}
return valid;
}
$(document).ready(function(){
    $("#print").click(function(){
	var data = $("#printArea").html();
	window.open("Reports/printDMC.php?data="+data,"address=no; addressbar=no");
	});
});
</script>
<style>
#toggleLink{ padding:7px; }
#toggleLink a{ color:#ffffff; text-decoration:none; font-size:20px;}
#toggleLink a:hover{ color:#9F3; text-decoration:underline; font-size:20px;}
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
<form method="post" action="Reports/printDMC.php" target="_blank" class="generalTextFonts" onsubmit="return validate()">
  <table width="1090" align="center" border="0" cellpadding="10" cellspacing="0" bgcolor="#006633" height="100">
  <tr>
  	<td width="1090" style="text-align:center;">
    	<table width="1090" align="center" border="0" cellpadding="3" cellspacing="0">
		  <tr>
		    <td width="106" style="color:#ffffff;"><span style="width:20px;">&nbsp;</span> <font style="font-size:22px;"> طالب العلم </font> </td>
		    <td width="170">
            <span id="stdCombo">
            <select name="regSno" id="regSno" class="frmSelect" style="height:40px; width:160px; font-size:16px;">
   				 <?php // echo($crud->fillCombo("SELECT sno,stdName FROM registrationinfo ORDER BY stdName ASC","sno","stdName")); ?>
            </select>
            </span>
            </td>
            <td width="87" style="color:#ffffff;">
            <font style="font-size:22px;"> درجہ </font>
            </td>
            <td width="121"><?php $css = 'style="height:40px; width:152px; font-size:16px; position:relative; top:1px;" onchange="fillComboStd(this.value,\'stdCombo\',$(\'#promotionDate\').val(),$(\'#dateEnd\').val());"';		
						$crud->darjaatCmb('darja',$css); ?>
            <span id="msg"></span>
            </td>
            <td width="85" style="color:#ffffff;">تاریخ ابتداء </td>
            <td width="126"> 
                  <input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($sessionDate);} ?>" />
            </td>
            <td width="84" style="color:#ffffff;">تاریخ انتہا </td>
            <td width="129"> 
                  <input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEnding);} ?>" />
            </td>
	        <td width="128"><input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:0px; border-radius:4px;" /></td>
            <tr style="display:none;">
            <td colspan="7" align="right">
            	<span id="toggleLink">
            	 <a href="?cmd=dmcFrmSingleStdAll" title="طالب العلم کی مکمل ڈی۔ایم۔سی نکالنے کے لئے یہاں پر کلک کریں"> ہر درجہ کی ڈی۔ایم۔سی نکالنے کے لئے یہاں پر کلک کریں </a> 
            	</span>
            </td>
          </tr>
        </table>
  	</td>
  </tr>
  </table>
</form>
<?php
$stdname="";
$fathername="";
$dob="";
if(isset($_REQUEST['btnSearch'])){
$totalNumberObtained = 0;
$totalNumber=0;
$year = '';
$darja = '';
if(isset($_REQUEST['regSno']) && !empty($_REQUEST['regSno'])) {
	$darja = $_REQUEST['darja'];
	$regSno = addslashes($_REQUEST['regSno']);
	//$regSno = mysql_real_escape_string($registrationNo);
								
			$sql="SELECT r.sno,r.stdName,r.fatherName,r.dob,st.darja 
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
								
							}
				}
?>
<div id="printArea" align="center">
<table align="center" cellpadding="10" width="728" border="1" style="direction:rtl;">
<tr>
	<th colspan="3">
    <font class="titleFont" style="line-height:60px;"> <?php echo(M_Name);?> <?php echo(M_Address);?></br>
  رقم الالحاق <?php echo(Elhaq); ?> رجسٹریشن نمبر <?php echo(Reg_Number); ?> <br />
کشف الدرجات  &nbsp;&nbsp;&nbsp;&nbsp; <?php echo($crud->getValue("SELECT darja FROM darjaat where derjaCode = ".$darja,"darja")); ?>
</font>
<h2 align="center">اسم الطالب: <?php echo($stdname); ?> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 اسم الوالد: <?php echo ($fathername); ?>
 </h2>
<h2 align="center"> تاریخ المیلاد
&nbsp;&nbsp; &nbsp; 
<?php echo ($dob); ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</h2>    
    </th>
</tr>
  <tr style="background-color:#9C9">
    <td width="325" scope="col">&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> المادۃ </font> </td>
    <td width="325" scope="col">&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> الدرجات </font> </td>
    <td width="325" scope="col">&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> کل نمبرات </font> </td>
  </tr>
  <?php 
	$resultTerm = "3"; //سالانہ
	$year = $_REQUEST['year'];
	//$darja = $crud->getValue("SELECT darja FROM registrationinfo r, regnumbers reg WHERE reg.registrationNo = '".$registrationNo."';","darja");
  	$sqlDmc = "SELECT subjectsno,obtmarks FROM result where stdSno='".$regSno."' AND 
				resultTerm='".$resultTerm."' AND darjaSno = '".$darja."' AND resultYear = ".$year;
  	//echo($sqlDmc);
	$result1 = mysql_query($sqlDmc,$crud->con); 
  	while($row1 = mysql_fetch_assoc($result1)){
		$totalNumberObtained += $row1['obtmarks'];
		$totalNumber += $crud->getValue("SELECT totalMarks from subjects where sno = ".$row1['subjectsno'],"totalMarks");
   ?>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; <?php echo($crud->getValue("SELECT subjectName from subjects where sno = ".$row1['subjectsno'],"subjectName")); ?> </td>
    <td>&nbsp;&nbsp;&nbsp; <?php echo($row1['obtmarks']); ?> </td>
    <td>&nbsp;&nbsp;&nbsp; <?php echo($crud->getValue("SELECT totalMarks from subjects where sno = ".$row1['subjectsno'],"totalMarks")); ?> </td>
  </tr>
  <?php } ?>
  <tr style="background-color:#FFC">
  	<td>&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> مجموع الدرجات </font> </td>
    <td>&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> <?php echo($totalNumberObtained); ?> </font> </td>
    <td>&nbsp;&nbsp;&nbsp; <font class="titleFont" style="font-size:24px;"> <?php echo($totalNumber); ?> </font> </td>
  </tr>
  </table>
  <table width="200" border="0">
	<tr>
	    <td colspan="3"> <input type="button" id="print" name="print" value="Print" style="bckground-color:#ffffff; color:#039; border:0px;" /> </td>
        </tr>
  </table>
</div>
<?php } ?>
<p></p>