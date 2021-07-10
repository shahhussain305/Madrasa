<?php // Lightbox css ?>
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
$("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>
<?php // End Lightbox Completed ?>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
//to refresh the passport photo
refreshPhoto();//functions.js
});
</script> 
<script type="text/javascript">
$(function() {
	$('#dob').datepick();
	$('#admissionDate').datepick();
});
</script>    
<?php 
$searchStd = "";
$stdPhoto = "";
$stdName = "";$fatherName = "";$nationality = "";$dob = "";$qualification = "";$guirdianName = "";$darja = "";$cellNo = "";$gurdianCellNo = "";
$permanentAddress = "";$presentAddress = "";$guirdianNameAuth = "";$guirdianFNameAuth = "";$stdNameAuth = "";$stdNameFatherNameAuth = "";
$guirdianSign = "";$stdNic = "";$guirdianNic = "";$formB = "";$relationShipWithGuirdian = "";$signNazim = "";$admissionDate = "";$dateEnd = "";
$admissionNo = "";$registrationNo = "";$RollNumber="";$isLocal = "";$fatherProfession = "";
	$format="DD/MM/YYYY";
	$date=date("d/m/Y");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	//$dateAdmitionAry = explode('-',$yearHijri);
	$dateAdmitionAry = explode('-',$_SESSION["hijri"]);
	$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];
	//echo($dateAdmition);
?>
<div class="headingTxtDiv">
 <?php echo(M_Name);?> فارم داخلہ </div>
 <?php 
$NicOption = '';
$optionNIC1 = '';
$optionNIC2 = '';
$optionNIC3 = '';
 ?>
 <div style="width:230px; position:relative; left:80px; top:300px; float:left; margin:0 auto; direction:ltr !important">
	<form method="post" action="AjaxPhp/setPassportValue.php" id="frmUpload" enctype="multipart/form-data">      
   		 <input type="file" name="photoBrowser" id="photoBrowser" size="15" onchange="setPassportValue()" />
    </form>
 </div>
 <span style="clear:left;">&nbsp;</span>

<form method="post" action="?cmd=registrationForm">
<table width="1060" id="regFrm" cellspacing="2" cellpadding="5" border="1" style="margin:0 auto; border:1px solid #FFF">
<?php if(isset($_REQUEST['btnSave'])){ ?> 
<tr>
<td colspan="3">
<?php
$photoStd = false; //if photo was not attached then here it will save the false in the photo field in table
	 if(isset($_REQUEST['stdName']) && !empty($_REQUEST['stdName']) && 
		isset($_REQUEST['fatherName']) && !empty($_REQUEST['fatherName']) &&
		isset($_REQUEST['nationality']) && !empty($_REQUEST['nationality']) && 
		isset($_REQUEST['dob']) && !empty($_REQUEST['dob']) &&
		isset($_REQUEST['qualification']) && !empty($_REQUEST['qualification']) &&  
	    isset($_REQUEST['guirdianName']) && !empty($_REQUEST['guirdianName']) && 
		isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
		isset($_REQUEST['cellNo']) && !empty($_REQUEST['cellNo']) && 
		isset($_REQUEST['fatherProfession']) && !empty($_REQUEST['fatherProfession']) && 
		isset($_REQUEST['gurdianCellNo']) && !empty($_REQUEST['gurdianCellNo']) && 
		isset($_REQUEST['permanentAddress']) && !empty($_REQUEST['permanentAddress']) &&  
	    isset($_REQUEST['presentAddress']) && !empty($_REQUEST['presentAddress']) && 
		isset($_REQUEST['guirdianNameAuth']) && !empty($_REQUEST['guirdianNameAuth']) && 
		isset($_REQUEST['guirdianFNameAuth']) && !empty($_REQUEST['guirdianFNameAuth'])  &&	
		isset($_REQUEST['relationShipWithGuirdian']) && !empty($_REQUEST['relationShipWithGuirdian']) &&
		isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) &&
	    isset($_REQUEST['admissionDate']) && !empty($_REQUEST['admissionDate']) && 
		isset($_REQUEST['admissionNo']) && !empty($_REQUEST['admissionNo'])  && 
	    isset($_REQUEST['registrationNo']) && !empty($_REQUEST['registrationNo'])){
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
			if(isset($_REQUEST['stdPhoto']) && !empty($_REQUEST['stdPhoto'])) {
				$photoStd = $_REQUEST['stdPhoto'];
				}
		   	  $stdPhoto = addslashes($photoStd);
			  $stdName = addslashes($_REQUEST['stdName']);
			  $fatherName = addslashes($_REQUEST['fatherName']);
			  $nationality = addslashes($_REQUEST['nationality']);
			  $dob = addslashes($_REQUEST['dob']);
			  $qualification = addslashes($_REQUEST['qualification']);
			  $guirdianName = addslashes($_REQUEST['guirdianName']);
			  $darja = addslashes($_REQUEST['darja']);
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
			  $admissionNo = addslashes($_REQUEST['admissionNo']);
			  // $RollNumber  = addslashes($_REQUEST['RollNumber']);
			  $registrationNo = addslashes($_REQUEST['registrationNo']);
			  
			  //check registration no in regNumbers table if already exists then do not save record
			  if($crud->search("SELECT registrationNo FROM regnumbers WHERE registrationNo = '".$registrationNo."'")) { 
			  	echo($crud->errorMsg("مہربانی کر کے رجسٹریشن نمبر تبدیل کرلیں کیونکہ یہ رجسٹریشن نمبر پہلے ہی سے موجود ہے۔","غلطی"));
			  	?>
                <script language="javascript">
				$(document).ready(function() {
					$("#frmUpload").css("position","relative").css("top","60px");                    
                	});
				</script>
                <?php
				}
			  else{
				  $sqlSave = "INSERT INTO registrationinfo (stdName,fatherName,nationality,dob,qualification,guirdianName,cellNo,fatherProfession,gurdianCellNo,
			  								permanentAddress,presentAddress,guirdianNameAuth,guirdianFNameAuth,guirdianSign,stdNic,guirdianNic,formB,
											relationShipWithGuirdian,signNazim,admissionNo,stdPhoto,isLocal,isActive)
								 VALUES('".$stdName."','".$fatherName."','".$nationality."','".$dob."','".$qualification."','".$guirdianName."','".$cellNo."',
								 '".$fatherProfession."','".$gurdianCellNo."','".$permanentAddress."','".$presentAddress."','".$guirdianNameAuth."','".$guirdianFNameAuth."'
								 ,'".$guirdianSign."','".$optionNIC1."','".$optionNIC2."','".$optionNIC3."','".$relationShipWithGuirdian."',
								 '".$signNazim."','".$admissionNo."','".$stdPhoto."','".$isLocal."',1)";								 
								 //echo($sqlSave);
								 $searchStd = "SELECT * FROM registrationinfo WHERE stdName = '".$stdName."' 
								 			   AND fatherName = '".$fatherName."' AND nationality = '".$nationality."'
											   AND dob = '".$dob."'";
											  // echo($searchStd);
								if(!$crud->search($searchStd)){
											  if($crud->insert($sqlSave)){
												  $regSno = $crud->getValue("SELECT sno FROM registrationinfo ORDER BY sno DESC limit 1","sno");
													$sqlRegNo = "INSERT INTO regnumbers (registrationNo,RollNumber,regSno) VALUES('".$registrationNo."','".$admissionNo."','".$regSno."')";
													//echo($sqlRegNo);
													 if($crud->insert($sqlRegNo)){
														 $shoba_sno = $crud->getValue("SELECT shoba_sno FROM darjaat WHERE derjaCode = ".$darja,"shoba_sno");
														 $sqlStdDrjat = "INSERT INTO stddarjaat(stdSno,darja,isCurrent,promotionDate,dateEnd,shoba_sno) VALUES(".$regSno.",".$darja.",1,'".$admissionDate."','".$dateEnd."',".$shoba_sno.")";
														 	//echo $sqlStdDrjat;
															if($crud->insert($sqlStdDrjat)){
																echo($crud->sucMsg("آپ نے رجسٹریشن کے عمل کو کامیابی سے مکمل کر لیا ہے","شکریہ"));
												 			 	$_SESSION['photo'] = "";
																?>
																<script language="javascript">
                                                                $(document).ready(function() {
                                                                    $("#frmUpload").css("position","relative").css("top","60px");                    
                                                                    });
                                                                </script>
                                                                <?php
																}//end if for insert most inner 
														   else{
																//failed to save in stdDarjaat table
															 	echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے ڈیٹا محفوظ نہ ہوسکا۔","غلطی"));
																?>
																<script language="javascript">
                                                                $(document).ready(function() {
                                                                    $("#frmUpload").css("position","relative").css("top","60px");                    
                                                                    });
                                                                </script>
                                                                <?php
												  		}	
															 }//end if for second insert()
													 else{
												 		 //failed to save
												 		 echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے ڈیٹا محفوظ نہ ہوسکا۔","غلطی"));
												  		?>
														<script language="javascript">
                                                        $(document).ready(function() {
                                                            $("#frmUpload").css("position","relative").css("top","60px");                    
                                                            });
                                                        </script>
                                                        <?php
														}//end inner else
												  }
											  else{
												  //failed to save
												  echo($crud->errorMsg("کمپیوٹر میں غلطی کی وجہ سے ڈیٹا محفوظ نہ ہوسکا۔","غلطی"));
												  ?>
												<script language="javascript">
                                                $(document).ready(function() {
                                                    $("#frmUpload").css("position","relative").css("top","60px");                    
                                                    });
                                                </script>
                                                <?php
												  }
								}
								else{
									echo($crud->errorMsg("یہ طالب العلم پہلے ہی سے داخل شدہ ہے","غلطی"));
									?>
								<script language="javascript">
                                $(document).ready(function() {
                                    $("#frmUpload").css("position","relative").css("top","60px");                    
                                    });
                                </script>
                <?php
									}
			  }//end else for checking registationNo in regNumbers table
			}//END IF FOR isOk()
			else{
				echo($crud->errorMsg(" مہربانی کرکے پورے فارم کو احتیاط سے پُر کریں","غلطی"));
				?>
                <script language="javascript">
				$(document).ready(function() {
					$("#frmUpload").css("position","relative").css("top","60px");                    
                	});
				</script>
                <?php
				}
 ?>
</td>
</tr>
<?php } ?>
<tr>
	<td width="243"> نام طالب العلم </td>
	<td width="471"> 
    <input type="text" name="stdName" id="stdName" value="<?php if(isset($_REQUEST['stdName']) && !empty($_REQUEST['stdName'])){ echo($_REQUEST['stdName']); }else{ echo($stdName); } ?>" class="frmInputTxt" style="background:#ffffff;	position:relative; width:256px; right:1px;	top:1px; font-size: 18px !important; font-family: 'Jameel Noori Nastaleeq' !important;" />     
    <input type="hidden" name="stdPhoto" id="stdPhoto" value="<?php if(isset($_SESSION['photo']) && !empty($_SESSION['photo'])) { echo($_SESSION['photo']); } ?>" />
    </td>
    <td rowspan="33" valign="top" align="center">
     <div id="passport" style="width:210px; height:210px; margin:5px auto; background-color:#CCC; vertical-align:top; text-align:center;">
     <span id="msg">
   	 <span id="stdPhto">
       <?php if(isset($_SESSION['photo']) && !empty($_SESSION['photo'])){  ?>      		
                <img name="passportSizePhoto" id="passportSizePhoto" src="takephoto/<?php echo($_SESSION['photo']); ?>" alt="طالب العلم" width="200" height="200" hspace="5" vspace="5" />
                <div style="clear:left; position:relative; top:-0px;"> 
                	<a href="#" onclick="deletePhoto('<?php echo($_SESSION['photo']); ?>'); return false;" style="color:#F00" title="اس فوٹو کو ہٹا دو"> ہٹادو </a> 
                </div>
    	   
      <?php	} ?>
      </span>
          <span id="linkToTakePhoto">
          <?php if(!isset($_SESSION['photo']) || empty($_SESSION['photo'])){ ?>
                <a href="takephoto/index.php?iframe=true&width=750&height=530" rel="prettyPhoto" title="طالب العلم کی فوٹو یہاں چسپان کریں۔"> فوٹو یہاں لگالیں </a>
          <?php } ?>  
          </span>
      </span>
 	 </div>
    </td>
</tr>
<tr>
	<td> ولدیت </td>
	<td> <input type="text" name="fatherName" id="fatherName" value="<?php if(isset($_REQUEST['fatherName']) && !empty($_REQUEST['fatherName'])){echo($_REQUEST['fatherName']);}else{echo($fatherName);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> شہریت </td>
	<td> <input type="text" name="nationality" id="nationality" value="<?php if(isset($nationality) && !empty($nationality)){ echo($nationality); }else{ echo('پاکستانی'); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> تاریخِ پیدائش </td>
	<td> <input type="text" name="dob" id="dob" value="<?php if(isset($_REQUEST['dob']) && !empty($_REQUEST['dob'])){ echo($_REQUEST['dob']);}else{ echo($dob); } ?>" class="frmInputTxt" style="background:#ffffff;position:relative; width:256px; right:1px;top:1px; font-size: 16px !important;padding: 9px 4px !important;" /> </td>
</tr>
<tr>
	<td> تعلیمی قابلیت</td>
	<td> <input type="text" name="qualification" id="qualification" value="<?php if(isset($_REQUEST['qualification']) && !empty($_REQUEST['qualification'])){ echo($_REQUEST['qualification']);}else{ echo($qualification);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
  <td>&nbsp;</td> 
  <td> 
  <input type="radio" id="isLocal1" name="isLocal" <?php if(isset($_REQUEST['isLocal']) && !empty($_REQUEST['isLocal']) && $_REQUEST['isLocal'] == '1'){?> checked="checked" <?php } ?>  value="1" /> رہائشی
  <input type="radio" id="isLocal2" name="isLocal" <?php if(isset($_REQUEST['isLocal']) && !empty($_REQUEST['isLocal']) && $_REQUEST['isLocal'] == '0'){?> checked="checked" <?php }else{ echo('checked="checked"'); } ?> value="0" /> غیر رہائشی 
  </td>
</tr>
<tr>
	<td>ضامن/سر پرست کا نام</td>
	<td> <input type="text" name="guirdianName" id="guirdianName"  value="<?php if(isset($_REQUEST['guirdianName']) && !empty($_REQUEST['guirdianName'])){echo($_REQUEST['guirdianName']);}else{ echo($guirdianName);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> درجہ </td>														
	<td> <?php 
	$css = 'style="background:#ffffff; position:relative; width:270px; right:1px; top:1px;"';
	//$java = 'onchange="getValue(document.getElementById(\'darja\').value,\'darjaat\',\'derjaCode\',\'registrationNo\',\'darjaidWait\',document.getElementById(\'registrationNoForReset\').value); countRegNum(document.getElementById(\'darja\').value)"';
	$java = 'onchange="countRegNum(document.getElementById(\'darja\').value)"';
	$crud->darjaatCmb('darja',$css.' '.$java); ?>
    <?php /*?><select type="text" name="darja" id="darja" class="frmSelect" style="background:#ffffff; position:relative; width:270px; right:1px; top:1px;" onchange="getValue(document.getElementById('darja').value,'darjaat','derjaCode','registrationNo','darjaidWait',document.getElementById('registrationNoForReset').value);">
    <option value=""></option>
    <?php echo($crud->fillCombo("SELECT sno,darja FROM darjaat ORDER BY preority ASC","sno","darja")); ?>
    </select> <?php */?>
    <span id="darjaidWait"></span>
    </td>
</tr>
<tr>
	<td>  رجسٹریشن نمبر  </td>
	<td> <a href="#" style="text-decoration:none;" onclick="checkLastNum($('#registrationNo').val()); return false;">چیک کریں</a>
	<?php $regNo = $crud->getValue("SELECT COUNT(sno) as regSnos From regnumbers ORDER BY registrationNo","regSnos"); ?>
    <input type="hidden" name="registrationNoForReset" id="registrationNoForReset" value="<?php if(isset($regNo) && !empty($regNo)){ 
					   			echo($crud->changeNumberFormate($regNo+ 1)); 
								}else{  
								echo("000001"); } ?>" />
	<input type="text" name="registrationNo" id="registrationNo"   
    				   value="<?php if(isset($_REQUEST['registrationNo']) && !empty($_REQUEST['registrationNo'])){echo($_REQUEST['registrationNo']);}else if(isset($regNo) && !empty($regNo)){ 
					   			echo($crud->changeNumberFormate($regNo+ 1)); 
								}else{  
								echo("000001"); } ?>" class="frmInputTxt" style="width:182px;" />
                                <font style="font-size:15px; font-weight:normal;" id="showTotal"></font>
                                &nbsp;&nbsp;
                                <span id="msgCheck" onclick="hideDiv('msgCheck');"></span>
                                </td>
</tr>
<tr>
	<td> رابطہ نمبر </td>
	<td> <input type="text" name="cellNo" id="cellNo" value="<?php if(isset($_REQUEST['cellNo']) && !empty($_REQUEST['cellNo'])){echo($_REQUEST['cellNo']);}else{echo($cellNo);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> والد/سرپرست کے موبائل کا نمبر </td>
	<td> <input type="text" name="gurdianCellNo" id="gurdianCellNo" value="<?php if(isset($_REQUEST['gurdianCellNo']) && !empty($_REQUEST['gurdianCellNo'])){echo($_REQUEST['gurdianCellNo']); }else{echo($gurdianCellNo); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> مستقل پتہ </td>
	<td> <textarea name="permanentAddress" id="permanentAddress" rows="1" cols="30" class="frmTxtArea" style="height:40px; width:250px;"><?php if(isset($_REQUEST['permanentAddress']) && !empty($_REQUEST['permanentAddress'])){echo($_REQUEST['permanentAddress']);}else{echo($permanentAddress); } ?></textarea> </td>
</tr>
<tr>
	<td> موجودہ پتہ </td>
	<td> <textarea name="presentAddress" id="presentAddress" rows="1" cols="30" class="frmTxtArea" style="height:40px; width:250px;"><?php if(isset($_REQUEST['presentAddress']) && !empty($_REQUEST['presentAddress'])){echo($_REQUEST['presentAddress']);}else{echo($presentAddress); } ?></textarea></td>
</tr>
<tr>
  <td> والد کا پیشہ </td>
  <td> <input type="text" name="fatherProfession" id="fatherProfession" value="<?php if(isset($_REQUEST['fatherProfession']) && !empty($_REQUEST['fatherProfession'])){echo($_REQUEST['fatherProfession']);}else{echo($fatherProfession); } ?>" class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2" align="center" class="headingTxtDiv"> حلف نامہ </td>
</tr><?php */?>
<tr>
<td> نام گواہ </td>
<td> <input type="text" name="guirdianNameAuth" id="guirdianNameAuth" value="<?php if(isset($_REQUEST['guirdianNameAuth']) && !empty($_REQUEST['guirdianNameAuth'])){echo($_REQUEST['guirdianNameAuth']);}else{echo($guirdianNameAuth);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
<td> بن  </td>
<td> <input type="text" name="guirdianFNameAuth" id="guirdianFNameAuth" value="<?php if(isset($_REQUEST['guirdianFNameAuth']) && !empty($_REQUEST['guirdianFNameAuth'])){echo($_REQUEST['guirdianFNameAuth']);}else{echo($guirdianFNameAuth); } ?>" class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2"> یہ بات اچھی طرح چانتے ہوئے کہ جان بوجھ کر جھوٹا حلف اٹھانے والا
 دنیا و آخرت میں سخت عذاب کا مستحق ہوتا ہے اس بات کی حلفیہ تصدیق کرتا ہوں کہ </td>
</tr>
<tr>
<td> مسمی </td>
<td> <input type="text" name="stdNameAuth" id="stdNameAuth" value="<?php if(isset($_REQUEST['stdNameAuth']) && !empty($_REQUEST['stdNameAuth'])){echo($_REQUEST['stdNameAuth']);}else{echo($stdNameAuth);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
<td> بن  </td>
<td> <input type="text" name="stdNameFatherNameAuth" id="stdNameFatherNameAuth" value="<?php if(isset($_REQUEST['stdNameFatherNameAuth']) && !empty($_REQUEST['stdNameFatherNameAuth'])){echo($_REQUEST['stdNameFatherNameAuth']);}else{echo($stdNameFatherNameAuth);} ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
<td colspan="2"> کے داخلہ فارم میں اس کی تاریخ پیدائیش اور عمر سمیت جو دیگر 
 کوائف درج کئے گئے ہیں وہ میرے علم کے مطابق بالکل درست ہیں اور اس میں کوئی غلط بیانی نہیں کی گئی
 </td>
</tr><?php */?>
<tr>
	<td> دستخط سرپرست </td>
	<td> <input type="text" name="guirdianSign" id="guirdianSign" value="<?php if(isset($_REQUEST['guirdianSign']) && !empty($_REQUEST['guirdianSign'])){echo($_REQUEST['guirdianSign']);}else{echo($guirdianSign); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td> طالب علم کا قومی شناختی کارڈ نمبر  </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:40px; border-radius:0px 6px 6px 0px">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" value="1" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 1) { echo('checked="checked"'); } ?> 
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
    <input type="text" name="stdNic" id="stdNic" value="<?php if(isset($_REQUEST['stdNic']) && !empty($_REQUEST['stdNic'])){echo($_REQUEST['stdNic']);}else{echo($stdNic); } ?>" class="frmInputTxt" style="width:210px; border-radius:6px 0px 0px 6px" /> </td>
</tr>
<tr>
	<td> والد یا سرپرست کی قومی شناختی کارڈ نمبر </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:40px; border-radius:0px 6px 6px 0px">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" value="2" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 2) { echo('checked="checked"'); } ?>
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
    <input type="text" name="guirdianNic" readonly="readonly" id="guirdianNic" value="<?php if(isset($_REQUEST['guirdianNic']) && !empty($_REQUEST['guirdianNic'])){echo($_REQUEST['guirdianNic']);}else{echo($guirdianNic);} ?>" class="frmInputTxt" style="width:210px; border-radius:6px 0px 0px 6px" /> 
   
    </td>
</tr>
<tr>
    <td> فارم "ب" </td>
	<td> <div style="background-color:#096; width:10%; float:right; height:40px; border-radius:0px 6px 6px 0px">
    <input style="position:relative; top:13px; left:-7px;" type="radio" name="nicOpt" value="3" <?php if(isset($_REQUEST['nicOpt']) && $_REQUEST['nicOpt'] == 3) { echo('checked="checked" '); } ?>
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
         <input type="text" name="formB" id="formB" readonly="readonly" value="<?php if(isset($_REQUEST['formB']) && !empty($_REQUEST['formB'])){echo($_REQUEST['formB']);}else{echo($formB);} ?>" class="frmInputTxt" style="width:210px; border-radius:6px 0px 0px 6px" /> </td>
</tr>
<tr>
	<td>  سرپرست سے رشتہ </td>
	<td> <input type="text" name="relationShipWithGuirdian" id="relationShipWithGuirdian" value="<?php if(isset($_REQUEST['relationShipWithGuirdian']) && !empty($_REQUEST['relationShipWithGuirdian'])){echo($_REQUEST['relationShipWithGuirdian']);}else{echo($relationShipWithGuirdian);} ?>" class="frmInputTxt" /> </td>
</tr>
<?php /*?><tr>
<td colspan="2" class="headingTxtDiv"> دفتری استعمال کے لئے</td>
</tr><?php */?>
<tr>
	<td> دستخط ناظم </td>
	<td> <input type="text" name="signNazim" id="signNazim" value="<?php if(isset($_REQUEST['signNazim']) && !empty($_REQUEST['signNazim'])){echo($_REQUEST['signNazim']);}else{echo($signNazim);} ?>" class="frmInputTxt" style="background:#ffffff; position:relative; width:256px; right:1px; top:1px; font-size: 16px !important;padding: 6px 3px !important; font-family:'jameel Noori Nastaleeq' !important;" /> </td>
</tr>
<tr>
	<td> تاریخِ داخلہ </td>
	<td> <input type="text" name="admissionDate" id="admissionDate" value="<?php if(isset($admissionDate) && !empty($admissionDate)){ echo($admissionDate); }else{ echo($dateAdmition); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td>  اختتامِ داخلہ  </td>
	<td>     
    <input type="text" name="dateEnd" id="dateEnd" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){echo($_REQUEST['dateEnd']);}else if(isset($dateEnd) && !empty($dateEnd)){ echo($dateEnd); }else{ $hijriAry = explode("-",$_SESSION["hijri"]); echo(($hijriAry[2]+1).'-'.$hijriAry[1].'-'.$hijriAry[0]); } ?>" class="frmInputTxt" /> </td>
</tr>
<tr>
	<td>  داخلہ نمبر  </td>
	<td> 
		<input type="text" name="admissionNo" id="admissionNo" value="<?php if(isset($_REQUEST['admissionNo']) && !empty($_REQUEST['admissionNo'])){echo($_REQUEST['admissionNo']);} ?>" class="frmInputTxt" /> </td>
</tr>

<tr>
    <td colspan="2" align="center">   
    <input type="reset" name="clrBtn" id="clrBtn" value="دوبارہ لکھیں" class="btnClr" />
    &nbsp;&nbsp;
    <input type="submit" name="btnSave" id="btnSave" value="محفوظ کیجیئے" class="btnSave" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    [کل طلباء: <span id="tStds"></span>] 
    </td>
</tr>
<?php /*?><tr>
    <td colspan="2">
    <br /> <span id="msgCheck" onclick="hideDiv('msgCheck');"></span>
    </td>
</tr><?php */?>
</table>
</form>
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