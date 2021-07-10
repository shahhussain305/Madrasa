<?php if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){ 
$sno = $_REQUEST['sno'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>داخلہ فارم</title>
<!--link rel="stylesheet" type="text/css" href="../css/default.css" /-->
</head>
<body style="margin:0px; background-color:#ffffff; background-image:none;font-size:20px;font-family:'Jameel Noori Nastaleeq';">
<?php require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD();
require_once('../includes/configuration.php');
$stdName = "";$fatherName = "";$nationality = "";$dob = "";$qualification = "";$guirdianName = "";$darja = "";$cellNo = "";$gurdianCellNo = "";
$permanentAddress = "";$presentAddress = "";$guirdianNameAuth = "";$guirdianFNameAuth = "";$stdNameAuth = "";$stdNameFatherNameAuth = "";
$guirdianSign = "";$stdNic = "";$guirdianNic = "";$formB = "";$relationShipWithGuirdian = "";$signNazim = "";$admissionDate = "";$dateEnd = "";
$admissionNo = "";$registrationNo = "";$RollNumber="";$isLocal = "";$fatherProfession = "";$shoba_sno = "";
$crud->connect();
$sql = "SELECT r.sno,r.stdName,r.fatherName,r.nationality,r.dob,r.qualification,r.guirdianName,r.cellNo,r.fatherProfession,r.gurdianCellNo,
	 		r.permanentAddress,r.presentAddress,r.guirdianNameAuth,r.guirdianFNameAuth,r.guirdianSign,r.stdNic,r.guirdianNic,r.formB,
	    	r.relationShipWithGuirdian,r.signNazim,st.dateEnd,r.admissionNo,r.stdPhoto,r.isLocal,st.darja,st.promotionDate,
			reg.registrationNo,reg.RollNumber,st.shoba_sno
		FROM registrationinfo r,regnumbers reg,stddarjaat st WHERE r.sno = {$sno} AND st.isCurrent = 1  
			AND r.sno=reg.regSno AND st.stdSno = reg.regSno ORDER BY st.promotionDate ASC,st.dateEnd ASC LIMIT 1";
		$result = mysql_query($sql,$crud->con);
		if(mysql_num_rows($result) > 0){
			while($row = mysql_fetch_assoc($result)){
 			  $stdPhoto = $row['stdPhoto'];
			  $stdName = $row['stdName'];
			  $fatherName = $row['fatherName'];
			  $nationality = $row['nationality'];
			  $dob = $row['dob'];
			  $qualification = $row['qualification'];
			  $guirdianName = $row['guirdianName'];
			  $darja = $row['darja'];
			  $cellNo = $row['cellNo'];
			  $fatherProfession = $row['fatherProfession'];
			  $gurdianCellNo = $row['gurdianCellNo'];
			  $permanentAddress = $row['permanentAddress'];
			  $presentAddress = $row['presentAddress'];
			  $guirdianNameAuth = $row['guirdianNameAuth'];
			  $guirdianFNameAuth = $row['guirdianFNameAuth'];
			  $guirdianSign = $row['guirdianSign'];
			  $stdNic = $row['stdNic'];
			  $guirdianNic = $row['guirdianNic'];
			  $formB = $row['formB'];
			  $relationShipWithGuirdian = $row['relationShipWithGuirdian'];
			  $signNazim = $row['signNazim'];
			  $admissionDate = $row['promotionDate'];
			  $dateEnd = $row['dateEnd'];
			  $isLocal = $row['isLocal'];
			  $admissionNo = $row['admissionNo'];
			  $RollNumber  = $row['RollNumber'];
			  $registrationNo = $row['registrationNo'];
			  $shoba_sno = $row['shoba_sno'];
?>
<style>
#regFrm td {
	direction:rtl;
	text-align:right;
	vertical-align:top;
}
td { padding: 0 14px; 0 0; }
</style>
<div style="border:5px double #000000; width:728px; margin:0 auto">
<table width="696" align="center" cellspacing="0" cellpadding="3" border="1" dir="rtl" style="direction:rtl; border:1px solid #f2f2f2;">
<tr>
    <td colspan="3" align="center">
    <div class="headingTxtDiv" style="font-size:20px; font-family:'Aseer Unicode';">
	<table width="696" border="0" cellspacing="0" cellpadding="0" height="100">
		<tr>
			<td align="center" style="line-height:30px; font-size:30px; font-family:'Jameel Noori Nastaleeq';"> 
			<div style="float:right;"><img src="../images/logo.png" alt="" style="width:100px; height:82px;" /></div>
			<span style="clear:right;">&nbsp;</span>
			فارم داخلہ <?php echo($crud->getValue("SELECT shoba FROM shobajaat WHERE sno = ".$shoba_sno,"shoba")); ?> <div style="height:20px;">&nbsp;</div> 
			<font style="font-size:23px; font-family:'Jameel Noori Nastaleeq';"> <?php echo(M_Name); ?> <?php echo(L_Address); ?></font></td>
			<td> <font style="font-size:18px; line-height:36px; font-family:'Jameel Noori Nastaleeq';"> الحاق نمبر: <b><?php echo(Elhaq); ?></b> 
			<br />رجسٹریشن نمبر : <b><?php echo(Reg_Number);?></b> </font>
			 </td>
		</tr>
	</table>    
	</div>
    
    </td>
</tr>
<tr>
	<td colspan="2" style="width:540px;"> نام طالب علم: <span style="padding-right:23px !important"></span> <?php echo($stdName); ?> 
   <span style="padding-right:100px !important"></span> ولدیت: <span style="padding-right:23px !important"></span> <?php echo($fatherName); ?>
     </td>
    
    <td rowspan="4" style="vertical-align:top; text-align:left;">
	<span>
     <img name="passportSizePhoto" id="passportSizePhoto" src="../takephoto/<?php echo($stdPhoto); ?>" style="border:3px; border-style:double; position:relative;" alt="طالب علم" width="130" height="140" hspace="5" vspace="5" />
	</span>    
</td>
</tr>
<tr>
	<td colspan="2"> شہریت :<span style="padding-right:23px !important"></span> <?php if(isset($nationality) && !empty($nationality)){ echo($nationality); }else{ echo('پاکستانی'); } ?> 
    <span style="padding-right:126px !important"></span>تاریخِ پیدائش :<span style="padding-right:23px !important"></span> <?php 
				$dateBirth = new DateTime($dob);
				echo($dateBirth->format('Y-m-d'));
	 ?> </td>
</tr>
<tr>
	<td colspan="2"> <b> علوم عصریہ :</b> <span style="padding-right:23px !important"></span> <?php echo($qualification); ?> 
    <span style="padding-right:100px !important"></span><b> رہائش: </b><span style="padding-right:23px !important"></span> <?php if(isset($isLocal) && $isLocal == 0){?> غیر رہائشی <?php }else{ ?> رہائشی <?php } ?>
  </td>
</tr>
<tr>
	<td colspan="2">ضامن/سر پرست کا نام: <span style="padding-right:23px !important"></span> <?php echo($guirdianName); ?>
    <span style="padding-right:1px !important"></span>
 	<font style="font-family:'Aseer Unicode'; color:#F00; padding: 0 103px 0 0;">الدرجہ: <span style="padding-right:13px !important"></span> 
	<?php 
	$currentDarja = $crud->getValue("SELECT * FROM stddarjaat WHERE stdSno = ".$sno." AND isCurrent = 1","darja");
	$printDarja = "SELECT darja FROM darjaat WHERE derjaCode = ".$currentDarja;	
	echo($crud->getValue($printDarja,"darja"));
	?>
</tr>
<tr>
	<td colspan="3"> رابطہ نمبر: <span style="padding-right:23px !important"></span> <?php echo($cellNo); ?> 
    <span style="padding-right:102px !important"></span>
     والد/سرپرست کے موبائل کا نمبر :<span style="padding-right:23px !important"></span> <?php echo($gurdianCellNo);  ?> 
     </td>
</tr>
<tr>
	<td colspan="3" style="border:0px; padding:0px; ">
		<table width="100%" border="1" cellspacing="0" cellpadding="3" style="border:1px solid #b5b5b5;">
		<tr>
			<td width="231" align="center"> مستقل پتہ </td>
			<td width="433" colspan="2"> &nbsp;&nbsp; <?php echo($permanentAddress);  ?> </td>
		</tr>
		<tr>
			<td align="center"> موجودہ پتہ </td>
			<td colspan="2"> &nbsp;&nbsp; <?php echo($presentAddress); ?></td>
		</tr>
		<tr>
			  <td align="center"> والد کا پیشہ </td>
			  <td colspan="2"> &nbsp;&nbsp; <?php echo($fatherProfession); ?> </td>
		</tr>
		</table>
	</td>
</tr>



<tr>
<td colspan="3" class="headingTxtDiv" style="font-size:20px; height:50px; text-align:center !important; font-family:'Aseer Unicode';"> حلف نامہ </td>
</tr>
<tr>
<td colspan="3"> 
	<div style="width:660px;">
میں مسمی  <strong><?php echo($guirdianNameAuth); ?></strong>  <?php // بن  <strong><u><?php echo($guirdianFNameAuth); ?></u></strong> 
  یہ بات اچھی طرح جانتے ہوئے کہ جان بوجھ کر جھوٹا حلف اٹھانے والا
 دنیا و آخرت میں سخت عذاب کا مستحق ہوتا ہے اس بات کی حلفیہ تصدیق کرتا ہوں کہ مسمی 
  <strong><?php echo($stdName); ?></strong> بن  
  <strong><?php echo($fatherName); ?></strong> 
  کے داخلہ فارم میں اس کی تاریخ پیدائش اور عمر سمیت جو دیگر 
 کوائف درج کئے گئے ہیں وہ میرے علم کے مطابق بالکل درست ہیں اور اس میں کوئی غلط بیانی نہیں کی گئی۔
	</div>
 </td>
</tr>
<tr>
	<td colspan="3" style="border:0px; padding:0px; ">
		<table width="100%" border="1" cellspacing="0" cellpadding="3" style=" border:1px solid #b5b5b5;">
		<tr>
			<td style="height:55px;"> <span style="position:relative; padding-right:60px;"> دستخط سرپرست </span></td>
			<td style="width:410px;">دستخط طالب علم  </td>
		</tr>
		<?php if($stdNic != 0){ ?>
		<tr>
			<td align="center"> طالب علم کا شناختی کارڈ نمبر  </td>
			<td> <?php echo($stdNic); ?> </td>
		</tr>
		<?php }else if($guirdianNic != 0){ ?>
		<tr>
			<td> والد یا سرپرست کی قومی شناختی کارڈ نمبر </td>
			<td> <?php  echo($guirdianNic); ?> </td>
		</tr>
		<?php }else if($formB != 0){ ?>
		<tr>
   			 <td> فارم "ب" </td>
			<td> <?php echo($formB); ?> </td>
		</tr>
		<?php } ?>
		<tr>
			<td align="center">  سرپرست سے رشتہ </td>
			<td> <?php echo($relationShipWithGuirdian); ?> </td>
		</tr>
		</table>
</td>
</tr>
<tr>
<td colspan="3" class="headingTxtDiv" style="font-size:20px; text-align:center !important; font-family:'Aseer Unicode'; height:50px;"> دفتری استعمال کے لئے</td>
</tr>
<tr>
	<td colspan="3" align="center"> تاریخِ داخلہ :<span style="padding-right:23px !important"></span> <?php echo($admissionDate); ?> 
     <span style="padding-right:102px !important"></span>
      اختتامِ داخلہ : <span style="padding-right:23px !important"></span><?php echo($dateEnd); ?> 
    </td>
</tr>
<tr>
	<td align="center" colspan="3"> 
	 رجسٹریشن نمبر: &nbsp;&nbsp; <input type="text" value="<?php echo($registrationNo); ?>" readonly="readonly" style="border:0px; font-size:16px;" />
    &nbsp;&nbsp;&nbsp;&nbsp;
     داخلہ نمبر :	<?php echo($RollNumber); ?>
	</td>
</tr>
<tr>
	<td colspan="3" align="center">
	دستخط ناظم <?php echo($signNazim); ?> &nbsp;&nbsp;&nbsp; <img src="../images/Signature.png" alt="" />
	&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>
</table>
</div>
<br />
<?php 	
		}//end of while loop
		}//end if for mysql_num_rows()
		?>
</body>
</html>
<?php        
 }//end if for empty or null $_REQUEST[sno] ?>