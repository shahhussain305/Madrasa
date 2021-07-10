<?php
$promotionDate = "";
$dateEnd = "";
$snoDarja = "";
$yearAry = "";
$sno = 0; 
require_once('../classes/classes.php');
	require_once('../includes/configuration.php');
	$crud = new CRUD(); 
   	$crud->connect(); 
header("Pragma: no-cache");
header("cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if(isset($_POST['snoDarja']) && !empty($_POST['snoDarja']) && 
   isset($_POST['promotionDate']) && !empty($_POST['promotionDate']) && 
   isset($_POST['dateEnd']) && !empty($_POST['dateEnd'])){
	$promotionDate = addslashes($_POST['promotionDate']);
	$dateEnd = addslashes($_POST['dateEnd']);
	$snoDarja = addslashes($_POST['snoDarja']);
$counterRow = 0;	
$darjaa = $crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = {$_POST['snoDarja']}","darja");
$header = '<tr>
    	<th colspan="9" class="titleFont" style="text-align:center; font-size:30px; font-family: \'Jameel Noori Nastaleeq\';">
	<table width="1000" align="center" border="0" cellspacing="0" cellpadding="4">
	<tr>
	<td style="vertical-align:top; text-align:center; width:350px; font-size:30px;"> '.M_Name.' <br />
	<font style="font-size:25px;">'.M_Address.'</font></td>
	<td style="vertical-align:top; text-align:right; width:300px; font-size:30px;">	کل طلباء
	<br />
	<font style="font-size:20px;">
	تعلیمی درجہ :'.$darjaa.'
	</font>
	</td>
	<td style="vertical-align:top; text-align:right; width:300px; font-size:20px;"> الحاق نمبر: '.Elhaq.' 
	<br />	
	رجسٹریشن نمبر:'.Reg_Number.' <br />
	تعلیمی سال: '.$promotionDate.'
	</td>
	</tr>
	</table>
	</th>
    </tr>
    <tr style="font-weight:bold; font-size:15px;">
    	<td width="34" style="text-align:center; max-height:20px;">  شمارہ </td>
    	<td width="93" style="text-align:center;"> اسم الطالب </td>
        <td width="100" style="text-align:center;"> اسم الاب </td>
        <td width="128" style="text-align:center;"> رجسٹریشن نمبر </td>
        <td width="72" style="text-align:center;"> تاریخِ پیدائش </td>
        <td width="45" style="text-align:center;"> رول نمبر </td>
        <td width="214" style="text-align:center;"> مستقل پتہ </td>
        <td width="89" style="text-align:center;"> تاریخِ داخلہ</td>
        <td width="153" style="text-align:center;"> رابطہ نمبر </td>
    </tr>';

?>
   <table width="1020" align="center" border="1" cellspacing="0" cellpadding="4" style="background-color:#ffffff;">
	<?php echo($header); ?>
   <?php 
   
	$sqlSearch = "SELECT DISTINCT r.stdName,r.fatherName,r.dob,r.permanentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo
				  FROM registrationinfo r, regnumbers n,stdDarjaat std
				  WHERE r.sno = n.regSno AND r.isActive = 1 AND YEAR(std.promotionDate) BETWEEN ('".$promotionDate."') AND YEAR('".$dateEnd."') 
				  AND std.darja = ".$snoDarja." AND std.stdSno = r.sno ORDER BY  CAST(n.RollNumber as SIGNED INTEGER) ASC";
	//echo($sqlSearch);
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="9" style="background-color:#ffffff">
            	<?php echo($crud->errorMsg("اس درجہ میں سال {$yearAry[0]} میں کوئی بھی طالب العلم داخل نہیں ہوا ہے۔","غلطی","../images")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ $sno +=1; $counterRow +=1;
		if($counterRow == 13){
		echo($header);
			$counterRow = 0;
		 }
   ?>
    <tr>
    	<td width="34" align="center"> <?php echo($sno); ?> </td>
    	<td width="93" align="center"> <?php echo($row['stdName']); ?> </td>
        <td width="100" align="center"> <?php echo($row['fatherName']); ?> </td>
        <td width="128" align="center"> <?php echo($row['registrationNo']); ?> </td>
        <td width="122" align="center"> <?php 
		$df = new DateTime($row['dob']);
		echo($df->format('d-m-Y'));
		?> </td>
        <td width="45" align="center"> <?php echo($row['RollNumber']); ?> </td>
        <td width="214" align="center"> <?php echo($row['permanentAddress']); ?> </td>
        <td width="89" align="center"> <?php 
		$dAdmission = new DateTime($row['promotionDate']);
			echo($dAdmission->format('d-m-Y')); ?> </td>
        <td width="153" align="center"> <?php echo($row['cellNo']); ?> </td>
    </tr>
    <?php }//end while loop
	}//end of else
	 ?>
</table>
<br />
    <?php
	}
else{
	echo('طلباء کی درجہ اور سالِ داخلہ مہیّا کریں۔');
	}
?>