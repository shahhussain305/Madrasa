<?php require_once('../classes/classes.php'); ?>
<?php 
$rnd = 0.000;
$sno = 0;
if(isset($_REQUEST['sno'])){
	$sno = $_REQUEST['sno'];
	$rnd = $_REQUEST['rnd'];
	//echo($rnd);
	?>
   <table width="920" align="center" border="1" cellspacing="0" cellpadding="4">
	  <tr style="font-size:20px; font-weight:bold; word-spacing:4px;">
    	<td width="74"> نمبر شمار </td>
    	<td width="123"> اسم الطالب </td>
        <td width="128"> اسم الاب </td>
        <td width="135"> رجسٹریشن نمبر </td>
        <td width="97"> تاریخِ پیدائش </td>
        <td width="62"> رول نمبر </td>
        <td width="152"> مستقل پتہ </td>
        <td width="67"> درجہ </td>
    </tr>
   <?php 
   	$crud = new CRUD(); 
   	$crud->connect();
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,r.admissionDate,r.cellNo,
						n.RollNumber,n.registrationNo,d.darja,d.derjaCode 
				  FROM registrationinfo r, regnumbers n,darjaat d
				  WHERE r.sno = n.regSno AND r.isActive = 1 AND r.darja = d.derjaCode AND r.darja = ".$sno;
	//echo($sqlSearch);
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="9" style="background-color:#ffffff">
            	<?php echo($crud->errorMsg("اس درجہ میں کوئی بھی طالب العلم داخل نہیں ہوا ہے۔","غلطی")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ 
		$sno +=1;
   ?>
    <tr style="font-size:20px;">
    	<td width="74"> <?php echo($sno); ?> </td>
    	<td width="123"> <?php echo($row['stdName']); ?> </td>
        <td width="128"> <?php echo($row['fatherName']); ?> </td>
        <td width="135"> <?php echo($row['registrationNo']); ?> </td>
        <td width="97"> <?php echo($row['dob']); ?> </td>
        <td width="62"> <?php echo($row['RollNumber']); ?> </td>
        <td width="152"> <?php echo($row['permanentAddress']); ?> </td>
        <td width="67"> <a href="pages/updateDarjaFrm.php?sno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="درجہ کو تبدیل کریں"><?php echo($row['darja']); ?> </a> </td>
    </tr>
    <?php }//end while loop
	}//end of else
	 ?>
</table>
    <?php
	}
else{
	echo('درجہ پر کلک کر کے لسٹ دکھائیں.');
	}
?>