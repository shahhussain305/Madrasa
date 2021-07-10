<?php require_once('../classes/classes.php'); 
require_once('../includes/configuration.php');
require_once('../classes/Hijri_GregorianConvert.php');
$hijri = new Hijri_GregorianConvert();
$crud = new CRUD(); 
$crud->connect();
$year = "";
$snoDarja = "";
$yearAry = "";
$sno = 0;
$opt = 1;
header("Pragma: no-cache");
header("cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if(isset($_REQUEST['snoDarja']) && !empty($_REQUEST['snoDarja']) && 
	isset($_REQUEST['year']) && !empty($_REQUEST['year']) && 
	isset($_REQUEST['opt']) && !empty($_REQUEST['opt'])){
	$year = addslashes($_REQUEST['year']);
	$snoDarja = addslashes($_REQUEST['snoDarja']);
	$yearAry = explode("-",$year);
	$opt = $_REQUEST['opt'];
	$changedHijriFormatedDate = $yearAry[2].$yearAry[1].$yearAry[0];
	$hijriToGreYear = $yearAry[2].'/'.$yearAry[1].'/'.$yearAry[0];
	$changeFormate = $yearAry[2].'-'.$yearAry[1].'-'.$yearAry[0];
	$hijriSearched = $hijri->GregorianToHijri($hijriToGreYear,'YYYY/MM/DD');
	if($opt == 2) { $opt = 0; }
	//echo($year.'<br />'.$snoDarja.'<br />'.$_REQUEST['rnd']);
	$header = '<tr>
    	<th colspan="11" class="titleFont" style="height:60px; text-align:center; font-size:40px;"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<th style="font-size:27px;line-height:30px;"> '.M_Name.'<br /><font style="font-size:20px;">'.L_Address.'</font></th>
                <th style="font-size:20px; font-family:\'Aseer Unicode\';">
                	رجسٹر داخل / خارج<br />
                	تعلیمی درجہ / <span style="display:none;" id="darjaLbl"></span>'.$crud->getValue("SELECT darja from darjaat where derjaCode = $snoDarja","darja").'
                </th>
                <th style="font-size:18px;">  الحاق نمبر '.Elhaq.' <span style="width:20px;">&nbsp;</span> رجسٹریشن نمبر  '.Reg_Number.'<br /> تعلیمی سال '. $changeFormate .'</th>
                </tr>
         </table>
        </th>
    </tr>
	';

   $firstRow = '<tr>
    	<td width="45" align="center"> الرقم  </td>
    	<td width="50" align="center"> اسم الطالب </td>
        <td width="70" align="center">اسم الوالد</td>
        <td width="84" align="center"> تاریخ المیلاد</td>
        <td width="85"  align="center" colspan="2"> شناختی کارڈ نمبر / فارم ب</td>
        <td width="100" align="center"> اسم الضامن</td>
        <td width="181" align="center">العنوان الدائم</td>
        <td width="139" align="center"> العنوان</td>
        <td width="95" align="center"> الرقم الھاتف</td>
		<td>رجسٹریشن نمبر</td>
    </tr>';

	?>
  <table width="1160" align="right" border="1" cellspacing="0" cellpadding="4" style="padding-left:17px; border-left-size:0px; border:0px; background-color:#ffffff;">
  <?php echo($header); ?>

    <tr>
    	<td align="center"> الرقم  </td>
    	<td align="center"> اسم الطالب </td>
        <td align="center">اسم الوالد</td>
        <td align="center"> تاریخ المیلاد</td>
        <td align="center" colspan="2"> شناختی کارڈ نمبر / فارم ب</td>
        <td align="center"> اسم الضامن</td>
        <td align="center">العنوان الدائم</td>
        <td align="center"> العنوان</td>
        <td align="center"> الرقم الھاتف</td>
        <td>رجسٹریشن نمبر</td>
    </tr>
   <?php 
   	
	$sqlSearch = "SELECT r.stdName,r.fatherName,r.stdNic, r.guirdianNic,r.formB,r.dob,r.permanentAddress,
						r.presentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo,r.guirdianNameAuth,r.gurdianCellNo 
				  FROM registrationinfo r, stdDarjaat std, regnumbers n
				  WHERE r.sno = n.regSno AND r.isActive = ".$opt." AND std.promotionDate = '".$year."' 
				  AND std.darja = ".$snoDarja." AND std.stdSno = r.sno";
	//echo($sqlSearch);
	$rCounter = 0;
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="11" style="background-color:#ffffff; min-height:400px;">
            	<?php echo($crud->errorMsg("اس درجہ میں سال {$yearAry[0]} میں کوئی بھی طالب العلم خارج نہیں ہوا ہے۔","غلطی","../images")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ $sno +=1; $rCounter += 1; 
		if($rCounter >= 17){
			echo('<tr><td colspan="11">&nbsp;</td></tr>');
			echo($header);
			echo($firstRow);
			$rCounter = 0;
			}
   ?>
    <tr style="font-size:15px;">
    	<td width="45" align="center"> <?php echo($sno); ?> </td>
    	<td width="128" align="center"><?php echo($row['stdName']); ?> </td>
        <td width="113" align="center"> <?php echo($row['fatherName']); ?> </td>
        <td width="119" align="center"> <?php 
		$dbt = new DateTime($row['dob']);
		echo($dbt->format('d-m-Y'));
		 ?> </td>
        <td width="60" align="center">
							<?php	if($row['stdNic'] != '0'){ 
                                    echo("طالب");
                                } 
                                else if($row['guirdianNic'] != '0'){ 
                                    echo("والد");
                                } 
                                else if($row['formB'] != '0'){ 
                                    echo("فارم ب");
                             } ?>
        </td>
        <td width="145" align="center" style="font-size:15px;">
							 <?php	if($row['stdNic'] != '0'){ 
                                    echo($row['stdNic']); 
                                } 
                                else if($row['guirdianNic'] != '0'){ 
                                     echo($row['guirdianNic']);  
                                } 
                                else if($row['formB'] != '0'){ 
                                    echo($row['formB']); 
                             } ?>
                     
         </td>
        <td width="70" align="center"> <?php echo($row['guirdianNameAuth']); ?> </td>
        <td width="110" align="center"> <?php echo($row['permanentAddress']); ?> </td>
        <td width="190" align="center"> <?php echo($row['presentAddress']); ?> </td>
        <td width="95" align="center"> <?php //gurdianCellNo cellNo 
		if($row['cellNo'] != '') {
			echo('<span title="طالب العلم کا موبائل نمبر">'.$row['cellNo'].'</span>'); 
		}
		else if($row['gurdianCellNo'] != ''){
			echo('<span title="طالب العلم کے والد کے موبائل کا نمبر">'.$row['gurdianCellNo'].'</span>');
			}
		
		?> </td>
        <td width="120" style="font-size:13px;"> <?php echo($row['registrationNo']); ?> </td>
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