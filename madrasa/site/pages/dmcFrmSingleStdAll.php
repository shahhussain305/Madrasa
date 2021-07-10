<script type="text/javascript">
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
</script>
<style>
#toggleLink{ padding:7px; }
#toggleLink a{ color:#ffffff; text-decoration:none; font-size:20px;}
#toggleLink a:hover{ color:#9F3; text-decoration:underline; font-size:20px;}
</style>
<?php /*?><div class="headingTxtDiv">ڈی.ایم.سی </div><?php */?>
<form method="post" action="?cmd=dmcFrmSingleStdAll" class="generalTextFonts" onsubmit="return validate()">
  <table width="1090" align="center" border="0" cellpadding="10" cellspacing="0" bgcolor="#006633" height="100">
  <tr>
  	<td width="1090" style="text-align:center;">
    	<table width="1090" align="center" border="0" cellpadding="3" cellspacing="0">
		  <tr>
		    <td width="12%" style="color:#ffffff;"><span style="width:20px;">&nbsp;</span> <font style="font-size:22px;"> طالب العلم </font> </td>
		    <td width="21%">
            <span id="stdCombo">
            <select name="regSno" id="regSno" class="frmSelect" style="height:40px; width:160px; font-size:16px;">
   				 <?php // echo($crud->fillCombo("SELECT sno,stdName FROM registrationinfo ORDER BY stdName ASC","sno","stdName")); ?>
            </select>
            </span>
            </td>
            <td width="6%" style="color:#ffffff;">
            <font style="font-size:22px;"> درجہ </font>
            </td>
            <td width="15%">
            <select name="darja" id="darja" class="frmSelect" style="height:40px; width:100px; font-size:16px; position:relative;top:1px;" onchange="fillComboStdAll(this.value,'stdCombo');">
   				 <option value=""></option>
				 <?php echo($crud->fillCombo("SELECT derjaCode,darja FROM darjaat ORDER BY preority ASC","sno","darja")); ?>
            </select>
            <span id="msg"></span>
            </td>
            <td width="5%" style="color:#ffffff;">
           <font style="font-size:22px;">  سال </font>
            </td>
            <td width="15%"><input type="text" name="year" id="year" size="4" maxlength="4" class="frmInputTxt" style="width:50px; height:25px;" value="<?php $yr = explode("-",$_SESSION["hijri"]); echo($yr[2]); ?>">      </td>
	        <td width="13%"><input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" /></td>
            </tr>
            <tr style="display:none;">
            <td width="13%" colspan="7" align="right">
            	<span id="toggleLink">
            	 <a href="?cmd=dmcFrm" title="کسی ایک طالب العلم کی ڈی۔ایم۔سی نکالنے کے لئے یہاں پر کلک کریں"> کسی ایک طالب العلم کی ڈی۔ایم۔سی نکالنے کے لئے یہاں پر کلک کریں </a>
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
					 AND r.isActive = 1 AND st.darja = ".$darja;
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
<div align="center">
<table align="center" cellpadding="10" width="728" border="1" style="direction:rtl;">
<tr>
	<th colspan="3">
    <font class="titleFont" style="line-height:60px;"> مدرسہ تعلیم القران باغ محلہ مینگورہ </br>
  رقم الالحاق 05701 رجسٹریشن نمبر /5/3516 <br />
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
</div>
<?php } ?>
<p></p>