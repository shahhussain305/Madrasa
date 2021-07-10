<style>
td { text-align:center;}
</style>
<?php require_once('../classes/classes.php'); 
require_once('../includes/configuration.php');
$crud = new CRUD(); 
$crud->connect();
$year = "";
$snoDarja = "";
$yearAry = "";
$sno = 0;
$opt = 0;
header("Pragma: no-cache");
header("cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if(isset($_REQUEST['snoDarja']) && isset($_REQUEST['year'])){
	$opt = $_REQUEST['opt'];
	$year = addslashes($_REQUEST['year']);
	$snoDarja = addslashes($_REQUEST['snoDarja']);
	$yearAry = explode("-",$year);
	//echo('Year = '.$year.'<br />Sno Darja = '.$snoDarja.'<br />Rnd = '.$_REQUEST['rnd'].'<br />Opt = '.$opt.'<br />');	
	$sqlSearch = "SELECT r.stdName,r.fatherName,r.dob,r.stdNic,r.guirdianName,r.formB,r.guirdianNic,
				  r.guirdianName,r.permanentAddress,r.presentAddress,r.cellNo 
				  FROM registrationinfo r,stdDarjaat std 
				  WHERE YEAR(std.promotionDate) = '".$yearAry[0]."' 
				  AND std.darja = ".$snoDarja."
				  AND r.isLocal = '".$opt."' AND r.isActive = 1 AND std.stdSno = r.sno and std.isCurrent = 1";
	//echo($sqlSearch);
	$tDarja = "";
	$header = "";
	$rowCounter = 0;
	?>

 <?php if(isset($snoDarja) && !empty($snoDarja)){
			$tDarja = $crud->getValue("SELECT darja FROM darjaat where derjaCode = ".$snoDarja,"darja");
			} 
   $header = '
	 <tr>
    	<th colspan="4" class="titleFont" style="border:0px; width:200px; height:60px; text-align:center; font-size:25px;">
        نام <strong> '.M_Name.' </strong><br />
        نام     <font style="font-family:\'Microsoft Uighur\';"> مہتمم </font> <strong> '.Mohtamim.' </strong>
         </th>
         <th colspan="3" class="titleFont" style="border:0px; width:200px; height:60px; text-align:center; font-size:21px;">
       	   مکمل پتہ '.L_Address.' <br />
            <font style="font-size:16px">فون: '.Phone.'  موبائل: '.Cell.'</font>
         </th>
         </th>
         <th colspan="3" class="titleFont" style="border:0px; height:60px; text-align:center; font-size:20px;">
         الحاق نمبر '.Elhaq.' 
        رجسٹریشن نمبر '.Reg_Number.' <br />
        تعلیمی درجہ '.$tDarja.'
         </th>
    </tr>';
	?>
   <table width="1068" border="1" align="center" cellpadding="4" cellspacing="0" style="border:0px;">
	<?php echo($header);?>	  
    <tr>
    	<td colspan="10" class="titleFont" style=" text-align:center; font-size:20px;"> <?php if($opt == 1){ echo('رہائشی طلباء کا مکمل لسٹ'); }else{ echo('غیر رہائشی طلباء کا مکمل لسٹ');} ?> </td>
    </tr>
    <tr>
    	<td style="width:39px;"> نمبر شمار </td>
    	<td width="63"> نام طالب علم </td>
        <td width="64"> ولدیت </td>
        <td width="105"> تاریخِ پیدائش </td>
        <td colspan="2" style="text-align:center; width:150px;"> شناختی کارڈ نمبر / فارم ب </td>
        <td width="90"> سر پرست </td>
        <td width="157"> مستقل پتہ  </td>
        <td width="90"> موجودہ رہائش </td>
        <td width="34"> رابطہ نمبر </td>
    </tr>
   <?php 
	if(!$crud->search($sqlSearch)){
		$optChar = $opt == 0 ? ' غیر رہائشی ' : ' رہائشی ';
		?>
        <tr>
        	<td colspan="10" style="background-color:#ffffff;">
            	<?php echo($crud->errorMsg("اس درجہ میں سال {$yearAry[0]} میں کوئی بھی طالب العلم جو کہ {$optChar} ہو، نے داخلہ نہیں لیا ہے۔","غلطی","../images")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ $sno +=1; $rowCounter +=1;
		if($rowCounter >= 11) { ?>
		<tr><td colspan="10" style="height:80px; border:1px solid #ffffff;">&nbsp;</td></tr>
		<?php echo($header); $rowCounter = 0; } ?>
    <tr>
    	<td width="59"> <?php echo($sno); ?> </td>
    	<td width="93"> <?php echo($row['stdName']); ?> </td>
        <td width="94"> <?php echo($row['fatherName']); ?> </td>
        <td width="120"> <?php $dbirth = new DateTime($row['dob']); echo($dbirth->format('d-m-Y')); ?> </td>
        <?php 
					if($row['stdNic'] != 0) { ?>
                    	<td width="40" style="width:100px"> طالب علم </td>
                   	 	<td width="130"> <?php echo($row['stdNic']); ?></td>
                    <?php						
						}
					if($row['guirdianNic'] != 0) { ?>
						<td style="width:40px;"> والد </td>
                    	<td style="width:130px;"> <?php echo($row['guirdianNic']); ?></td>
                    <?php 
						}
					else if($row['formB'] != 0){ ?>
                    	<td style="width:40px;"> طالب علم </td>
                    	<td style="width:130px;"> <?php echo($row['formB']); ?></td>
                    <?php
						}
                 ?>
        <td width="17"> <?php echo($row['guirdianName']); ?> </td>
        <td width="17"> <?php echo($row['permanentAddress']); ?> </td>
        <td width="150"> <?php echo($row['presentAddress']); ?> </td>
        <td width="62"> <?php echo($row['cellNo']); ?> </td>
    </tr>
    <?php }//end while loop
	}//end of else
	 ?>
</table>
<table width="1100" border="0" cellspacing="0" cellpadding="2" style="height:170px; font-size:28px;">
<tr>
    	<td width="181"> پاک آرمی یونٹ نمبر </td> 
        <td width="233"> F:18 </td>
        <td width="396">دستخط مہتمم </td>
        <td width="274" rowspan="2"> تاریخ __________ </td>
    </tr>
    <tr>
    	<td> پولیس سٹیشن </td>
        <td>  مکان باغ مینگورہ </td>
        <td> مہر/مدرسہ </td>
    </tr>
</table>
    <?php
	}
else{
	echo('طلباء کی درجہ اور سالِ داخلہ مہیّا کریں۔');
	}
?>