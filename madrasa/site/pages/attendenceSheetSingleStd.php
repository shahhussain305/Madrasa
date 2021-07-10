<script type="text/javascript">
$(function() {
	$('#dat').datepick();
	$('#year').datepick();
});
function getStdList(darjaSn){
	try{
		if(darjaSn == "" || document.getElementById("year").value == ""){
			alert('مہربانی کر کے تاریخ منتخب کریں اوردرجہ پر \n کلک کریں تاکہ طلباء کی لِسٹ دکھایا جا سکیں');
			}
		else{
			document.getElementById("sno").value = darjaSn;
			document.getElementById("frmYear").submit();
		}
		}catch(err){
		
		}
	}
</script>
<div class="headingTxtDiv" style="text-decoration:none; font-size:25px;"> کسی بھی طالب العلم کی حاضری لگانے کے لئے طالب العلم کے نام پر کلک کریں</div>
<div>
<style>
#listTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#listTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}

#darjaTbl a{
	color:#039;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	}
#darjaTbl a:hover {
	color:#C30;
	text-decoration:none;
	padding:4px 4px 4px 4px;
	background-color:#CCC;
	}	
</style>
<table width="1090" align="center" border="0" cellpadding="7" cellspacing="0" style="background-color:#999">
  <tr>
  <td colspan="7" style="background-color:#ffffff;">
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
  	
  	  $snoNum = 0;
	  $crud->connect();
	  $sql = "SELECT derjaCode,darja FROM darjaat ORDER BY derjaCode ASC";
	  $result = mysql_query($sql,$crud->con);
	  if(mysql_num_rows($result) > 0){ ?>
            <table width="1090" align="center" border="0" cellpadding="7" cellspacing="0" id="darjaTbl" style="background-color:#ffffff">
                <tr>
                    <td colspan="9" style="height:20px;"><br />
                    <form method="get" name="frmYear" action="?cmd=attendenceSheetSingleStd" id="frmYear">
                    <input type="hidden" name="cmd" id="cmd" value="attendenceSheetSingleStd" />
                     <span style="padding:0 0 0 10px;">داخلہ سال منتخب کریں
                    </span>
                    <input type="text" name="year" id="year" class="frmInputTxt" style="width:150px;" value="<?php if(isset($_REQUEST['year']) && !empty($_REQUEST['year'])) {echo($_REQUEST['year']);}else{ echo($promotionDt);} ?>" />
                    <input type="hidden" name="sno" id="sno" />
                    <span style="padding:5px;">&nbsp;</span>
                    درجہ منتخب کریں
                    <span style="padding:5px;">&nbsp;</span>
                    <?php $css = 'style="border:1px solid #e4e4e4; width:200px;position:relative; top:1px;" onchange="getStdList(document.getElementById(\'darja\').value);"';		
          			  $crud->darjaatCmb('darja',$css); ?>
                    </form>                    
                    </td>
                </tr>
                     <td colspan="9" style="height:20px">                    
                    </td>
                </tr>
             </table>
	   <?php }//end if for mysql_num_rows() ?> 
</td>
</tr>
</table>
<div style="height:20px; width:1090px;"></div>
<span id="list">
<?php 
	if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) && 
	   isset($_REQUEST['year']) && !empty($_REQUEST['year'])){
	$sno = $_REQUEST['sno'];
	$year = $_REQUEST['year'];
	?>
    <script language="javascript" type="text/javascript">
	try{
		$(document).ready(function(){
			$("#listTbl a").css("text-decoration","none","color","#03F");
		});
		}catch(err){
		
		}
	</script>
   <table width="1090" align="center" border="1" cellspacing="0" cellpadding="4" id="listTbl">
	  <tr style="font-size:20px; font-weight:bold;background-color:#000000;color:#ffffff;">
    	<th width="43" style="padding:3px;"> نمبر شمار </th>
    	<th width="191" style="padding:3px;"> اسم الطالب </th>
        <th width="160" style="padding:3px;"> رجسٹریشن نمبر </th>
        <th width="115" style="padding:3px;"> تاریخِ پیدائش </th>
        <th width="74" style="padding:3px;"> رول نمبر </th>
        <th width="180" style="padding:3px;"> مستقل پتہ </th>
        <th width="85" style="padding:3px;"> درجہ </th>
    </tr>
   <?php 
   	$crud = new CRUD(); 
   	$crud->connect();
	$sqlSearch = "SELECT r.sno,r.stdName,r.fatherName,r.dob,r.permanentAddress,std.promotionDate,r.cellNo,
						n.RollNumber,n.registrationNo,d.darja,d.derjaCode AS darjaSno
				  FROM 
				  		registrationinfo r, regnumbers n,darjaat d,stdDarjaat std
				  WHERE 
				  		r.sno = n.regSno AND std.darja = d.derjaCode AND std.stdSno = r.sno AND std.darja = ".$sno." 
						AND std.isCurrent = 1 AND r.isActive = 1
						AND YEAR(std.promotionDate) = YEAR('".$year."') 
						ORDER BY n.RollNumber ASC";
	//echo($sqlSearch);
	if(!$crud->search($sqlSearch)){
		?>
        <tr>
        	<td colspan="9" style="background-color:#ffffff; height:60px; padding:3px;">
            	<?php echo($crud->errorMsg("اس درجہ میں کوئی بھی طالب العلم داخل نہیں ہوا ہے۔","غلطی")); ?>
            </td>
        </tr>
        <?php
	}else{
		$result = mysql_query($sqlSearch,$crud->con);
		while($row = mysql_fetch_assoc($result)){ 
		$sno +=1;
		$snoNum +=1;
   ?>
    <tr style="font-size:20px;">
    	<td width="43" style="height:60px; text-align:center"> <?php echo($snoNum); ?> </td>
    	<td width="191" align="center"><a href="pages/attendShetSnglStdSave.php?darjaSno=<?php echo($row['darjaSno']); ?>&stdSno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=350&width=650" class="thickbox" style="font-size:23px;" title="<?php echo($row['stdName']); ?>  ولدِ <?php echo($row['fatherName']); ?> کی حاضری لگائیں"> <?php echo($row['stdName']); ?>  ولدِ <?php echo($row['fatherName']); ?> </a> </td>
        <td width="160" align="center"><a href="?cmd=registrationUpdateForm&registrationNoSearch=<?php echo($row['registrationNo']); ?>&&darjaS=<?php echo($row['darjaSno']);?>&btnSearch=true" title="یہاں سے طالب العلم کی رجسٹریشن تبدیل کر سکتے ہیں۔"> <?php echo($row['registrationNo']); ?> </a> </td>
        <td width="115" align="center"> <?php echo($row['dob']); ?> </td>
        <td width="74" align="center"> <a href="pages/updateRollNumber.php?sno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=350&width=600" class="thickbox" style="font-size:30px;" title="رول نمبر کو تبدیل کریں"><?php echo($row['RollNumber']); ?> </a> </td>
        <td width="180"> <span style="position:relative; right:5px;"> <?php echo($row['permanentAddress']); ?> </span> </td>
        <td width="85" align="center"> <a href="pages/updateDarjaFrm.php?sno=<?php echo($row['sno']); ?>&KeepThis=true&TB_iframe=true&height=433&width=620" class="thickbox" style="font-size:30px;" title="درجہ کو تبدیل کریں"><?php echo($row['darja']); ?> </a> </td>
    </tr>
    <?php }//end while loop
	}//end of else
	 ?>
</table>
    <?php
	}
else{
	echo('لسٹ کھول کر کسی بھی طالب العلم کی حاضری لگائیں۔');
	}
?>
</span>
</div>