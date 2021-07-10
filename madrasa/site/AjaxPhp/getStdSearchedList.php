<style>
td { 
	word-wrap:normal; 
	text-wrap:supress; 
	}
.bordr{
	border:1px solid #e5e5e5;
	}
.bordr td,th{
	border:1px solid #e5e5e5;
	}
</style>
<?php require_once('../classes/classes.php'); ?>
<?php 
$crud = new CRUD(); 
$crud->connect();
$stdRegNo = "";
$stdName = "";
$sqlTxt = "";
$stdSno = "";
//SELECT r.stdName, reg.registrationNo FROM registrationinfo r, regnumbers reg WHERE r.sno = reg.regSno
header("Pragma: no-cache");
header("cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
if(isset($_REQUEST['stdName']) && !empty($_REQUEST['stdName']) && isset($_REQUEST['stdRegNo']) && !empty($_REQUEST['stdRegNo'])){
		$sqlTxt = " AND r.stdName = '".$_REQUEST['stdName']."' AND  reg.registrationNo = '".$_REQUEST['stdRegNo']."' AND r.sno = reg.regSno";
	}
else if(isset($_REQUEST['stdName']) && !empty($_REQUEST['stdName']) && !isset($_REQUEST['stdRegNo']) || empty($_REQUEST['stdRegNo'])){
		$sqlTxt = " AND r.stdName = '".$_REQUEST['stdName']."' AND r.sno = reg.regSno";
	}
else if(!isset($_REQUEST['stdName']) || empty($_REQUEST['stdName']) && isset($_REQUEST['stdRegNo']) && !empty($_REQUEST['stdRegNo'])){
		$sqlTxt = " AND reg.registrationNo = '".$_REQUEST['stdRegNo']."' AND r.sno = reg.regSno";
	}
else{
	$sqlTxt = "";
	}
	
?>
 <table width="770" border="1" align="center" style="background-color:#FFF; font-size:23px;" cellpadding="0" cellspacing="0" class="bordr">
	<?php if(strlen($sqlTxt) > 42){
	//echo($sqlTxt);	
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,r.presentAddress,r.cellNo,r.stdPhoto,
				  reg.registrationNo,
				  st.darja,st.promotionDate,st.isCurrent 
				FROM 
					registrationinfo r, stdDarjaat st,regnumbers reg
				WHERE 
					r.sno = st.stdSno AND st.stdSno = reg.regSno AND 
					r.sno = reg.regSno AND st.isCurrent = 1 AND r.isActive = 1 ".$sqlTxt;
	//echo('<textarea cols="40" rows="6">'.$sqlSearch.'</textarea>');
	foreach($crud->getRecordSet($sqlSearch) as $row){ $stdSno = $row['sno'];
	?>
    <tr>
    	<td width="208" style="height:50px; padding-right:5px;"> نام </td><td width="557"> <?php echo($row['stdName']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> ولدیت </td><td> <?php echo($row['fatherName']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> تاریخ پیدائش </td><td> <?php echo($row['dob']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> مستقل پتہ </td><td> <?php echo($row['permanentAddress']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> عارضی پتہ </td><td> <?php echo($row['presentAddress']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> موبائل نمبر</td><td> <?php echo($row['cellNo']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> رجسٹریشن نمبر </td><td> <?php echo($row['registrationNo']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> درجہ حالیہ </td><td> <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$row['darja'],"darja")); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> تاریخ داخلہ</td><td> <?php echo($row['promotionDate']); ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> موجودہ حالت </td><td> <?php if($row['isCurrent']) { echo('داخل شدہ طالب العلم'); }else{echo('طالب العلم کا درجہ درست نہ ہے');} ?> </td>
    </tr>
    <tr>
        <td style="height:50px; padding-right:5px;"> تصویر </td>
        <td> 
		<?php if(!empty($row['stdPhoto'])){  ?>
        	<a href="pages/stdPhote.php?regSno=<?php echo($row['sno']); ?>" rel="prettyPhoto" target="_new" title="<?php echo($row['stdName']); ?>">
            <img src="takephoto/<?php echo($row['stdPhoto']);?>" width="120" height="140" />
            </a>
		<?php } ?> 
        </td>
    </tr>
    <tr>
    <td colspan="2" valign="top">
    <?php }//end foreach() ?>
    <?php if(!empty($stdSno)){ ?>
    <table width="770" border="1" cellspacing="0" cellpadding="3" style="font-size:23px;" class="bordr">
    	<tr>
        	<th colspan="3" style="background-color:#069; color:#FFF; height:50px; padding-right:10px; text-align:right;"> مزید تفصیل </th>
        </tr>
        <tr style="background-color:#CCC; height:39px;">
            	<td width="162"> درجہ </td>
                <td width="283"> درجہ میں تاریخ داخلہ </td>
                <td width="304"> حالیہ درجہ </td>
            </tr>
        <?php 
			$sqlDetails = "SELECT * FROM stddarjaat WHERE stdSno = ".$stdSno; 
			foreach($crud->getRecordSet($sqlDetails) as $rw){			
			?>
            <tr style="background-color:#FFF">
            	<td style="height:50px; padding-right:5px;"> <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$rw['darja'],"darja")); ?>  </td>
                <td style="height:50px; padding-right:5px;"> <?php echo($rw['promotionDate']); ?> </td>
                <td style="font-color:#039;height:50px; padding-right:5px;"> <?php if($rw['isCurrent'] == 1) { echo('<img src="images/okSign.png" />'); }else{ ?> 
				<a href="#" title="اس طالب علم کی منتخب کردہ سال کی مکمل ریکارڈ مٹادیں؟" onclick="delHistory(<?php echo($rw['sno']); ?>); return false;">مٹاؤ</a>
				<?php } ?> </td>
            </tr>
            <?php
			}
		?>
    </table>
   
    <?php }//end if stdSno not empty ?>
    </td>
    </tr>
<?php 		
	}//end if
else { ?>
    <tr>
    	<td style="height:200px; line-height:50px; vertical-align:top;" colspan="2"> 
		<?php echo($crud->errorMsg('طالب العلم کا نام یا رجسٹریشن نمبر  میں سے کم از کم ایک مہیاں کریں، جبکہ طالب العلم کا نام ضروری ہے اور اگر طالب العلم کے نام سے ریکارڈ نہ مل سکیں تو رجسٹریشن نمبر مہیاں کریں','غلطی')); ?> 
        </td>
    </tr>
   <?php } 
?>
</table>