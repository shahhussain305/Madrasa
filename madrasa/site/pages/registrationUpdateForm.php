<style>
#regFrm td {
	direction:rtl;
	text-align:right;
	vertical-align:top;
}
#errorDiv {	position:relative; top:20px; height:70px; padding-bottom:0px; width:900px; }
#passport a{ color:#039; text-decoration:none; position:relative; top:40%; }
#photoChangeLink { position:relative; top:0px; left:50px; float:left; background-color:#036; text-decoration:none; padding:10px; color:#FFF; }
</style>
<?php // Lightbox css ?>
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>
<?php // End Lightbox Completed ?>
<script type="text/javascript">
$(function() {
	$('#dob').datepick();
	$('#admissionDate').datepick();
});
$(document).ready(function(){
	$("#containerMain").css("width","920px");
	});
$(document).ready(function(){
$("#errorDiv").hide(3000);
});
</script>    
<?php 
$NicOption = '';
$optionNIC1 = '';
$optionNIC2 = '';
$optionNIC3 = '';
$updateFlg = 0;
$searchStd = "";$sno = "";$registrationNoSrch="";
$stdName = "";$fatherName = "";$nationality = "";$dob = "";$qualification = "";$guirdianName = "";$darja = "";$cellNo = "";$gurdianCellNo = "";
$permanentAddress = "";$presentAddress = "";$guirdianNameAuth = "";$guirdianFNameAuth = "";$stdNameAuth = "";$stdNameFatherNameAuth = "";
$guirdianSign = "";$stdNic = "";$guirdianNic = "";$formB = "";$relationShipWithGuirdian = "";$signNazim = "";$admissionDate = "";$dateEnd="";$admissionNo = "";
$registrationNo = "";$RollNumber="";$isLocal = "";$fatherProfession = "";$darjaS= "";$darjaSu= "";
?>
<div id="containerMain">
<?php 
	$queryStr = "";
	//&registrationNoSearch=1433-01-000018&btnSearch=true
	if(isset($_REQUEST['registrationNoSearch']) && !empty($_REQUEST['registrationNoSearch']) && isset($_REQUEST['btnSearch']) && !empty($_REQUEST['btnSearch'])) {
		$queryStr = '&registrationNoSearch='.$_REQUEST['registrationNoSearch'].'&btnSearch='.$_REQUEST['btnSearch'];
		}
 ?>
<form method="post" action="?cmd=registrationUpdateForm">
<table width="900" cellspacing="0" cellpadding="4" border="0">
	<tr>
    	<td width="228" style="text-align:left; font-size:23px;">  رجسٹریشن نمبر   &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width="177" style="text-align:right;"> <input type="text" name="registrationNoSearch" id="registrationNoSearch" value="<?php if(isset($_REQUEST['registrationNoSearch']) && !empty($_REQUEST['registrationNoSearch'])){echo($_REQUEST['registrationNoSearch']);} ?>" class="frmInputTxt" style="width:150px;" /> </td>
        <td width="122" style="text-align:left; font-size:23px;"> حالیہ درجہ  &nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width="195" style="text-align:right;"> 
        <?php 
			$css = 'style="width:180px;"';
			$crud->darjaatCmb('darjaS',$css); ?>
        </td>
        <td width="138" style="text-align:right;"> <input type="submit" name="btnSearch" id="btnSearch" class="btnSave" value="تلاش کریں" /></td>
    </tr>
</table>
</form>
<?php 
if(isset($_REQUEST['btnSearch'])){
	if(isset($_REQUEST['registrationNoSearch']) && !empty($_REQUEST['registrationNoSearch']) && 
       isset($_REQUEST['darjaS']) && !empty($_REQUEST['darjaS'])){
		$registrationNoSrch = $_REQUEST['registrationNoSearch'];
		$darjaS = $_REQUEST['darjaS'];
		$sqlSearchRec = "SELECT r.sno,r.stdName,r.fatherName,r.nationality,r.dob,r.qualification,r.guirdianName,std.darja,r.cellNo,r.fatherProfession,r.gurdianCellNo,
						   r.permanentAddress,r.presentAddress,r.guirdianNameAuth,r.guirdianFNameAuth,r.guirdianSign,r.stdNic,r.guirdianNic,r.formB,r.relationShipWithGuirdian,
					 	   r.signNazim,std.promotionDate,std.dateEnd,r.admissionNo,r.isLocal,reg.registrationNo 
					   FROM registrationinfo r,regnumbers reg,stddarjaat std 
					   WHERE r.sno = reg.regSno AND reg.registrationNo = '".$registrationNoSrch."' AND 
					   std.stdSno = r.sno AND r.isActive = 1 AND std.darja = ".$darjaS;
		//echo($sqlSearchRec);
		$crud->connect();
		$result = mysql_query($sqlSearchRec,$crud->con);
		if(mysql_num_rows($result) > 0) {
			$ros = mysql_fetch_assoc($result);
			$sno = $ros['sno'];
			$registrationNo = $ros['registrationNo'];
			$stdName = $ros['stdName'];
			$fatherName = $ros['fatherName'];
			$nationality = $ros['nationality'];
			$dob = $ros['dob'];
			$qualification = $ros['qualification'];
			$guirdianName = $ros['guirdianName'];
			$darja = $ros['darja'];
			$cellNo = $ros['cellNo'];
			$gurdianCellNo = $ros['gurdianCellNo'];
			$permanentAddress = $ros['permanentAddress'];
			$presentAddress = $ros['presentAddress'];
			$guirdianNameAuth = $ros['guirdianNameAuth'];
			$guirdianFNameAuth = $ros['guirdianFNameAuth'];	
			$guirdianSign = $ros['guirdianSign'];
			$stdNic = $ros['stdNic'];
			$guirdianNic = $ros['guirdianNic'];
			$formB = $ros['formB'];
			$relationShipWithGuirdian = $ros['relationShipWithGuirdian'];
			$signNazim = $ros['signNazim'];
			$admissionDate = $ros['promotionDate'];
			$dateEnd = $ros['dateEnd'];
			$admissionNo = $ros['admissionNo'];
			$isLocal = $ros['isLocal'];
			$fatherProfession = $ros['fatherProfession'];
		}//mysql_num_rows()
	}//end if for field
	else{
		echo('<div id="errorDiv">'.$crud->errorMsg("مہربانی کر کے فارم احتیاط کے ساتھ پر کریں","غلطی").'</div>');
		}
}//end if for button pressed event
?>
<br />
<hr style="border-width:2px; border-style:groove; width:100%;" align="center" />
<div class="headingTxtDiv" style="font-size:30px;">
<?php if(isset($_REQUEST['darjaS']) && !empty($_REQUEST['darjaS'])) {$darjaD = $_REQUEST['darjaS']; }else{$darjaD = isset($_REQUEST['darjaSu']) && !empty($_REQUEST['darjaSu']) ? $_REQUEST['darjaSu'] : "";} ?>
 <?php echo(M_Name); ?> داخلہ فارم  <?php if(!empty($darjaD)){ ?><span style="padding:0 0 0 10px;"> منتخب کردہ  درجہ </span> <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$darjaD,"darja")); } ?>
 <br /><br />
 </div>

 <?php  if(isset($sno) && !empty($sno)) { ?>
 <div id="photoChangeLink">
 <a href="pages/changeStdPhoto.php?sno=<?php echo($sno);?>&iframe=true&width=550&height=320" rel="prettyPhoto" style="text-decoration:none; color:#ffffff;" title="طالب العلم <?php echo($crud->getValue("SELECT stdName FROM registrationInfo WHERE sno = ".$sno,"stdName")); ?>  کی فوٹو یہاں سے تبدیل کریں"> فوٹو تبدیل کریں</a>
 </div>
 <?php } ?>
<form method="post" action="?cmd=registrationUpdateForm<?php if(!empty($queryStr)){echo($queryStr);} ?>">
<table width="735" id="regFrm" cellspacing="5" cellpadding="5" border="0">
<?php if(isset($_REQUEST['btnSave'])){ ?> 
<tr>
<td colspan="2">
<?php
$photoStd = false; //if photo was not attached then here it will save the false in the photo field in table
	 if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno']) &&
		isset($_REQUEST['darjaSu']) && !empty($_REQUEST['darjaSu']) &&
	 	isset($_REQUEST['stdName']) && !empty($_REQUEST['stdName']) && 
		isset($_REQUEST['fatherName']) && !empty($_REQUEST['fatherName']) &&
		isset($_REQUEST['nationality']) && !empty($_REQUEST['nationality']) && 
		isset($_REQUEST['dob']) && !empty($_REQUEST['dob']) &&
		isset($_REQUEST['qualification']) && !empty($_REQUEST['qualification']) &&  
	    isset($_REQUEST['guirdianName']) && !empty($_REQUEST['guirdianName']) && 		 
		isset($_REQUEST['cellNo']) && !empty($_REQUEST['cellNo']) && 
		isset($_REQUEST['fatherProfession']) && !empty($_REQUEST['fatherProfession']) && 
		isset($_REQUEST['gurdianCellNo']) && !empty($_REQUEST['gurdianCellNo']) && 
		isset($_REQUEST['permanentAddress']) && !empty($_REQUEST['permanentAddress']) &&  
	    isset($_REQUEST['presentAddress']) && !empty($_REQUEST['presentAddress']) && 
		isset($_REQUEST['guirdianNameAuth']) && !empty($_REQUEST['guirdianNameAuth']) && 
		isset($_REQUEST['guirdianFNameAuth']) && !empty($_REQUEST['guirdianFNameAuth'])  && 
		isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) && 
		isset($_REQUEST['registrationNo']) && !empty($_REQUEST['registrationNo']) &&
		isset($_REQUEST['relationShipWithGuirdian']) && !empty($_REQUEST['relationShipWithGuirdian']) &&
	    isset($_REQUEST['admissionDate']) && !empty($_REQUEST['admissionDate'])){
			if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt']== 1){
					$optionNIC1 = $_REQUEST['stdNic'];
					$optionNIC2 = '0';
					$optionNIC3 = '0';
				}
			else if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt']== 2){
					$optionNIC2 = $_REQUEST['guirdianNic'];
					$optionNIC1 = '0';
					$optionNIC3 = '0';
				}
		   else if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 3){
					$optionNIC3 = $_REQUEST['formB'];
					$optionNIC2 = '0';
					$optionNIC1 = '0';
				}
			  $isLocal = $_REQUEST['isLocal'];							  
			  $sno = addslashes($_REQUEST['sno']); 
			  $stdName = addslashes($_REQUEST['stdName']);
			  $fatherName = addslashes($_REQUEST['fatherName']);
			  $nationality = addslashes($_REQUEST['nationality']);
			  $dob = addslashes($_REQUEST['dob']);
			  $qualification = addslashes($_REQUEST['qualification']);
			  $guirdianName = addslashes($_REQUEST['guirdianName']);
			  $cellNo = addslashes($_REQUEST['cellNo']);
			  $fatherProfession = addslashes($_REQUEST['fatherProfession']);
			  $gurdianCellNo = addslashes($_REQUEST['gurdianCellNo']);
			  $permanentAddress = addslashes($_REQUEST['permanentAddress']);
			  $presentAddress = addslashes($_REQUEST['presentAddress']);
			  $guirdianNameAuth = addslashes($_REQUEST['guirdianNameAuth']);
			  $guirdianFNameAuth = addslashes($_REQUEST['guirdianFNameAuth']);
			  $guirdianSign = addslashes($_REQUEST['guirdianSign']);
			  $optionNIC1 = addslashes($optionNIC1);
			  $optionNIC2 = addslashes($optionNIC2);
			  $optionNIC3 = addslashes($optionNIC3);
			  $relationShipWithGuirdian = addslashes($_REQUEST['relationShipWithGuirdian']);
			  $signNazim = addslashes($_REQUEST['signNazim']);
			  $admissionDate = addslashes($_REQUEST['admissionDate']);
			  $dateEnd = addslashes($_REQUEST['dateEnd']);
			  $darjaSu = addslashes($_REQUEST['darjaSu']);
			  $registrationNo = addslashes($_REQUEST['registrationNo']);
			  
			  
			  $sqlSave = "UPDATE registrationinfo SET stdName = '".$stdName."',fatherName='".$fatherName."',nationality='".$nationality."',dob='".$dob."',qualification='".$qualification."',
			  										  guirdianName = '".$guirdianName."',cellNo='".$cellNo."',fatherProfession='".$fatherProfession."',
													  gurdianCellNo='".$gurdianCellNo."',permanentAddress='".$permanentAddress."',presentAddress='".$presentAddress."',
													  guirdianNameAuth='".$guirdianNameAuth."',guirdianFNameAuth='".$guirdianFNameAuth."',guirdianSign='".$guirdianSign."',
													  stdNic='".$optionNIC1."',guirdianNic='".$optionNIC2."',formB='".$optionNIC3."',relationShipWithGuirdian='".$relationShipWithGuirdian."',
													  signNazim='".$signNazim."',isLocal='".$isLocal."' WHERE sno = ".$sno." AND isActive = 1";
				$sqlUpateRegNo = "UPDATE regnumbers SET registrationNo = '".$registrationNo."' WHERE regSno = ".$sno;
								 //echo($sqlSave);
								 $searchStd = "SELECT * FROM registrationinfo WHERE sno = ".$sno." AND isActive = 1";
											  // echo($searchStd);
								if($crud->search($searchStd)){
											  if($crud->update($sqlSave)){	
											  			$updateFlg = 1;	
															 //keeping $sno = "" will help us to consider the form must be researched for any other or the first registrationNo
															// $sno = "";
													 }//end if for update first
											  else{
												  //failed to save
												  
												  }
												  if($crud->update($sqlUpateRegNo)){
														//registrationNo has also updated if any change made
														$updateFlg = 1;
														}
												  //second table update
										      	$sqlRegNo = "UPDATE stdDarjaat SET promotionDate='".$admissionDate."',dateEnd='".$dateEnd."' WHERE stdSno=".$sno." AND darja = ".$darjaSu;
											 if($crud->update($sqlRegNo)){
												 $updateFlg = 1;	
												//do nothing , because some time when the second query not gona update and the same value updated by the same value 
												//it means there is no update has been occured therefore, here it is no need to display any message for the second update
												 }//end if for second insert()
												 
											if($updateFlg == 1){
												echo($crud->sucMsg("آپ نے رجسٹریشن فارم کو کامیابی سے تبدیل کر لیا ہے","شکریہ"));
												}
											elseif($updateFlg == 0){
												echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے تبدیلی محفوظ نہ ہوسکی۔","غلطی"));
												}
											
								}
								else{
									echo($crud->errorMsg("ہمارے پاس مطلوبہ رجسٹریشن نمبر محفوظ نہیں ہے","غلطی"));
									}
												  
			}//END IF FOR isOk()
			else{
				echo($crud->errorMsg(" مہربانی کرکے پورے فارم کو احتیاط سے پُر کریں","غلطی"));
				}
 ?>
</td>
</tr>
<?php } ?>
<tr>
	<td width="297"> نام طالب العلم </td>
	<td width="318"> <input type="text" name="stdName" id="stdName" <?php if(isset($stdName)){ ?> value="<?php echo($stdName); ?>" <?php } ?> onkeyup="getAndPut('stdName','stdNameAuth');" class="frmInputTxt" style="background:#ffffff;	position:relative; width:256px; right:1px;	top:1px; font-size: 18px !important; font-family: 'Jameel Noori Nastaleeq' !important;" /> 
    <input type="hidden" name="sno" id="sno" value="<?php if(isset($sno) && !empty($sno)){ echo($sno); } ?>" />
    <input type="hidden" name="darjaSu" id="darjaSu" value="<?php echo($darjaS); ?>" />
    </td>
</tr>
<tr>
	<td> ولدیت </td>
	<td> <input type="text" name="fatherName" id="fatherName" <?php if(isset($fatherName)){ ?> value="<?php echo($fatherName); ?>" <?php } ?> onkeyup="getAndPut('fatherName','stdNameFatherNameAuth');" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> شہریت </td>
	<td> <input type="text" name="nationality" id="nationality" <?php if(isset($nationality)){ ?> value="<?php echo($nationality); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> تاریخِ پیدائش </td>
	<td> <input type="text" name="dob" id="dob" <?php if(isset($dob)){ ?> value="<?php echo($dob); ?>" <?php } ?> class="frmInputTxt" style="background:#ffffff;position:relative; width:256px; right:1px;top:1px; font-size: 16px !important;padding: 9px 4px !important;" /> </td>
</tr>
<tr>
	<td> تعلیمی قابلیت</td>
	<td> <input type="text" name="qualification" id="qualification" <?php if(isset($qualification)){ ?> value="<?php echo($qualification); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td> 
  <input type="radio" id="isLocal1" name="isLocal" <?php if(isset($isLocal) && $isLocal == '1') { echo(' checked="checked" ');} ?> value="1" /> رہائشی
  <input type="radio" id="isLocal2" name="isLocal" <?php if(isset($isLocal) && $isLocal == '0') { echo(' checked="checked" ');} ?>  value="0" /> غیر رہائشی 
  </td>
</tr>
<tr>
	<td>ضامن/سر پرست کا نام</td>
	<td> <input type="text" name="guirdianName" id="guirdianName" <?php if(isset($guirdianName)){ ?> value="<?php echo($guirdianName); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> رابطہ نمبر </td>
	<td> <input type="text" name="cellNo" id="cellNo" <?php if(isset($cellNo)){ ?> value="<?php echo($cellNo); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> والد/سرپرست کے موبائل کا نمبر </td>
	<td> <input type="text" name="gurdianCellNo" id="gurdianCellNo" <?php if(isset($gurdianCellNo)){ ?> value="<?php echo($gurdianCellNo); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> مستقل پتہ </td>
	<td> <textarea name="permanentAddress" id="permanentAddress" rows="2" cols="30" class="frmTxtArea" style="width:250px;"><?php if(isset($permanentAddress)){ echo($permanentAddress); } ?></textarea> </td>
</tr>
<tr>
	<td> موجودہ پتہ </td>
	<td> <textarea name="presentAddress" id="presentAddress" rows="2" cols="30" class="frmTxtArea" style="width:250px;"><?php if(isset($presentAddress)){ echo($presentAddress); } ?></textarea></td>
</tr>
<tr>
  <td> والد کا پیشہ </td>
  <td> <input type="text" name="fatherProfession" id="fatherProfession" <?php if(isset($fatherProfession)){ ?> value="<?php echo($fatherProfession); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2" align="center" class="headingTxtDiv"> حلف نامہ </td>
</tr><?php */?>
<tr>
<td> نام گواہ </td>
<td> <input type="text" name="guirdianNameAuth" id="guirdianNameAuth" <?php if(isset($guirdianNameAuth)){ ?> value="<?php echo($guirdianNameAuth); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
<td> بن  </td>
<td> <input type="text" name="guirdianFNameAuth" id="guirdianFNameAuth" <?php if(isset($guirdianFNameAuth)){ ?> value="<?php echo($guirdianFNameAuth); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2"> یہ بات اچھی طرح چانتے ہوئے کہ جان بوجھ کر جھوٹا حلف اٹھانے والا
 دنیا و آخرت میں سخت عذاب کا مستحق ہوتا ہے اس بات کی حلفیہ تصدیق کرتا ہوں کہ </td>
</tr>
<tr>
<td> مسمی </td>
<td> <input type="text" name="stdNameAuth" id="stdNameAuth" <?php if(isset($stdName)){ ?> value="<?php echo($stdName); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
<td> بن  </td>
<td> <input type="text" name="stdNameFatherNameAuth" id="stdNameFatherNameAuth" <?php if(isset($fatherName)){ ?> value="<?php echo($fatherName); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
<td colspan="2"> کے داخلہ فارم میں اس کی تاریخ پیدائیش اور عمر سمیت جو دیگر 
 کوائف درج کئے گئے ہیں وہ میرے علم کے مطابق بالکل درست ہیں اور اس میں کوئی غلط بیانی نہیں کی کئی
 </td>
</tr><?php */?>
<tr>
	<td> دستخط سرپرست </td>
	<td> <input type="text" name="guirdianSign" id="guirdianSign" <?php if(isset($guirdianSign)){ ?> value="<?php echo($guirdianSign); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> طالب علم کا قومی شناختی کارڈ نمبر  
    <script language="javascript" type="text/javascript">
    $(document).ready(function(){
		if($("#stdNic").val() > 0 || $("#stdNic").val().length > 1){
			$('input[id="nicOpt1"]').attr('checked', true);
			}
		else if($("#guirdianNic").val() > 0 || $("#guirdianNic").val().length > 1){
			$('input[id="nicOpt2"]').attr('checked', true);
			}
		else{
			$('input[id="nicOpt3"]').attr('checked', true);
			}
		});
    </script>
    </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:47px;">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" id="nicOpt1" value="1" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 1) { echo('checked="checked"'); } ?> 
                                          onchange="if(this.checked == true) { 
                                                  document.getElementById('stdNic').readOnly = false;  
                                                  document.getElementById('stdNic').value = '<?php echo($optionNIC1); ?>';
                                                  document.getElementById('guirdianNic').value = '0'; 
                                                  document.getElementById('formB').value = '0';                                                
                                                  document.getElementById('guirdianNic').readOnly = true; 
                                                  document.getElementById('formB').readOnly = true;                                                   
                                                  }"
                                          onclick="if(this.checked == true) { 
                                                  document.getElementById('stdNic').readOnly = false;  
                                                  document.getElementById('stdNic').value = '<?php echo($optionNIC1); ?>';
                                                  document.getElementById('guirdianNic').value = '0'; 
                                                  document.getElementById('formB').value = '0';                                                
                                                  document.getElementById('guirdianNic').readOnly = true; 
                                                  document.getElementById('formB').readOnly = true;                                                   
                                                  }" /> 
                                                   </div>
    <input type="text" name="stdNic" id="stdNic" value="<?php if(isset($stdNic)){ echo($stdNic); } ?>" class="frmInputTxt" style="width:220px;" /> </td>
</tr>
<tr>
	<td> والد یا سرپرست کی قومی شناختی کارڈ نمبر </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:47px;">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" id="nicOpt2" value="2" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 2) { echo('checked="checked"'); } ?>
    										onchange="if(this.checked == true) { 
                                                  document.getElementById('guirdianNic').readOnly = false;
                                                  document.getElementById('guirdianNic').value = '<?php echo($optionNIC2); ?>';                                                   
                                                  document.getElementById('stdNic').value = '0'; 
                                                  document.getElementById('formB').value = '0';
                                                  document.getElementById('stdNic').readOnly = true; 
                                                  document.getElementById('formB').readOnly = true;
                                                  }"
                                            onclick="if(this.checked == true) { 
                                                  document.getElementById('guirdianNic').readOnly = false;
                                                  document.getElementById('guirdianNic').value = '<?php echo($optionNIC2); ?>';                                                   
                                                  document.getElementById('stdNic').value = '0'; 
                                                  document.getElementById('formB').value = '0';
                                                  document.getElementById('stdNic').readOnly = true; 
                                                  document.getElementById('formB').readOnly = true;
                                                  }" />  </div>
    <input type="text" name="guirdianNic" readonly="readonly" id="guirdianNic" value="<?php if(isset($guirdianNic)){ echo($guirdianNic); } ?>" class="frmInputTxt" style="width:220px;" /> 
   
    </td>
</tr>
<tr>
    <td> فارم "ب" </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:47px;">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" id="nicOpt3" value="3" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 3) { echo('checked="checked" '); } ?>
    										onchange="if(this.checked == true) { 
                                                  document.getElementById('formB').readOnly = false;
                                                  document.getElementById('formB').value = '<?php echo($optionNIC3); ?>';                                                   
                                                  document.getElementById('stdNic').value = '0'; 
                                                  document.getElementById('guirdianNic').value = '0';
                                                  document.getElementById('stdNic').readOnly = true; 
                                                  document.getElementById('guirdianNic').readOnly = true;
                                                  }"
                                           onclick="if(this.checked == true) { 
                                                  document.getElementById('formB').readOnly = false;
                                                  document.getElementById('formB').value = '<?php echo($optionNIC3); ?>';                                                   
                                                  document.getElementById('stdNic').value = '0'; 
                                                  document.getElementById('guirdianNic').value = '0';
                                                  document.getElementById('stdNic').readOnly = true; 
                                                  document.getElementById('guirdianNic').readOnly = true;
                                                  }" />
                                                  </div>
         <input type="text" name="formB" id="formB" readonly="readonly" value="<?php if(isset($formB)){ ?> <?php echo($formB); } ?>" class="frmInputTxt" style="width:220px;" /> </td>
</tr>
<tr>
	<td>  سرپرست سے رشتہ </td>
	<td> <input type="text" name="relationShipWithGuirdian" id="relationShipWithGuirdian" <?php if(isset($relationShipWithGuirdian)){ ?> value="<?php echo($relationShipWithGuirdian); ?>" <?php } ?> class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2" class="headingTxtDiv"> دفتری استعمال کے لئے</td>
</tr><?php */?>
<tr>
	<td> دستخط ناظم </td>
	<td> <input type="text" name="signNazim" id="signNazim" <?php if(isset($signNazim)){ ?> value="<?php echo($signNazim); ?>" <?php } ?> class="frmInputTxt" style="background:#ffffff; position:relative; width:256px; right:1px; top:1px;" /> </td>
</tr>
<tr>
	<td> تاریخِ داخلہ </td>
	<td> <input type="text" name="admissionDate" id="admissionDate" value="<?php if(isset($admissionDate)){ echo($admissionDate); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> تاریخِ اختتام </td>
	<td> <input type="text" name="dateEnd" id="dateEnd" value="<?php if(isset($dateEnd) && !empty($dateEnd)){ echo($dateEnd); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> رجسٹریشن نمبر </td>
	<td> <input type="text" name="registrationNo" id="registrationNo" value="<?php if(isset($registrationNo) && !empty($registrationNo)){ echo($registrationNo); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
    <td colspan="2" align="center">  
    <?php
		if(isset($sno) && !empty($sno)){ ?> 
		<input type="button" name="btnDel" id="btnDel" value="طالب العلم کو مٹاؤ" class="btnDel" onclick="delStd(<?php echo($sno);?>)" />
	    <input type="button" name="btnKharij" id="btnKharij" value="طالب العلم کو خارج کریں" class="btnDel" onclick="stuctOff(<?php echo($sno);?>)" />
	<?php } ?>  
    <input type="reset" name="clrBtn" id="clrBtn" value="دوبارہ لکھیں" class="btnClr" />
    &nbsp;&nbsp;
    <input type="submit" name="btnSave" id="btnSave" value="محفوظ کیجیئے" class="btnSave" />
    &nbsp;&nbsp;<br />
    <span id="msg"></span>
    </td>
</tr>
<tr>
    <td colspan="2">
    <br />
    </td>
</tr>
</table>
</form>
</div>
<script language="javascript">
var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var broName  = navigator.appName;
/*var fullVersion  = ''+parseFloat(navigator.appVersion); 
var majorVersion = parseInt(navigator.appVersion,10);*/
var nameOffset,verOffset,ix;

// In Chrome, the true version is after "Chrome" 
if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 broName = "Chrome";
	if(broName == "Chrome"){
	$("#darja").css("width","256px");
	$("#presentAddress").css("width","256px");
	$("#permanentAddress").css("width","256px");		 
	}
}
</script>