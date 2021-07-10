<script type="text/javascript">
$(function() {
	$('#fromDat').datepick();
	$('#toDate').datepick();
});
$(document).ready(function(){
	$("#printLink").click(function(){
	$("#printFrm").submit();	
	});
});

</script>  
<style>
table {
	direction:rtl;
	font-size:14px;
	}
</style>
<?php 
	$rollNumberStd="";
	$format="DD/MM/YYYY";
	$date=date("d/m/Y");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	//$dateAdmitionAry = explode('-',$yearHijri);
	$dateAdmitionAry = explode('-',$_SESSION["hijri"]);
	//$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];
	$dateAdmition = $dateAdmitionAry[2].'-10-15';
?>

<form method="post" id="fr" action="?cmd=idCardStd" class="generalTextFonts">
 	<table width="1090" align="center" border="0" cellpadding="7" cellspacing="0" style="background-color:#999">
		  <tr>
          	<td colspan="7" class="headingTxtDiv" style="background-color:#000000; color:#ffffff; text-decoration:none;"> طالب العلم کارڈ </td>
          </tr>
          <tr>
         	<td style="font-size:25px; padding:5px;"> درجہ منتخب کریں </td>
			<td style="padding:5px;">
            <?php 
				$css = 'style="width:180px; position:relative;top:3px;"';
				$crud->darjaatCmb('darja',$css); ?>
            <?php /*?><select type="text" name="darja" id="darja" class="frmSelect" style="width:120px; position:relative;top:3px;">
                <option value=""></option>
                <?php echo($crud->fillCombo("SELECT derjaCode,darja FROM darjaat ORDER BY preority ASC","derjaCode","darja")); ?>
                </select> <?php */?>
   		    </td>
        	<td style="font-size:25px; padding:5px;"> <strong>سے</strong></td>
	        <td style="font-size:25px; padding:5px;"> <input type="text" name="fromDat" id="fromDat" value="<?php if(isset($_POST['fromDat']) && !empty($_POST['fromDat'])) {echo($_POST['fromDat']);}else{ echo($dateAdmition);} ?>" class="frmInputTxt" style="width:120px; height:35px;" /> </td>
    	    <td style="font-size:25px; padding:5px;"> <strong>تک</strong></td>
            <td style="padding:5px;"> <input type="text" name="toDate" id="toDate" value="<?php if(isset($_POST['toDate']) && !empty($_POST['toDate'])) {echo($_POST['toDate']);}else{ $hijriYerAry = explode("-",$_SESSION["hijri"]); echo(($hijriYerAry[2]+1).'-10-15');} ?>" class="frmInputTxt" style="width:120px; height:35px;" /> </td>
            <td style="padding:5px;"> <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" /> </td>
          </tr>
        </table>
</form>
<br /><br /><!--a href="#" id="printLink" onclick="return false;" title="print">Print</a -->
<?php if(isset($_POST['btnSearch'])) {
			if(isset($_POST['darja']) && !empty($_POST['darja']) && 
			   isset($_POST['fromDat']) && !empty($_POST['fromDat']) && 
			   isset($_POST['toDate']) && !empty($_POST['toDate'])){
				$fromDat = addslashes($_POST['fromDat']);
				$todate = addslashes($_POST['toDate']);   
				$darja = addslashes($_POST['darja']);
								
				$sql = "SELECT DISTINCT r.stdName,reg.RollNumber,r.fatherName,std.darja,r.presentAddress,r.permanentAddress,r.stdNic,r.guirdianNic,std.promotionDate,std.dateEnd,
							   r.admissionNo,reg.registrationNo,r.formB,r.guirdianNic,r.dob,r.signNazim,r.stdPhoto,r.stdName
							FROM registrationinfo r,regnumbers reg,stdDarjaat std
							WHERE r.sno = reg.regSno
								AND YEAR(std.promotionDate) BETWEEN YEAR('".$fromDat."') AND YEAR('".$todate."')
								AND std.darja = ".$darja. " AND r.isActive = 1 AND std.isCurrent = 1 AND std.stdSno = r.sno";
							//echo($sql);
							if($crud->search($sql)){
								$rslt = mysql_query($sql,$crud->con);
								while($row = mysql_fetch_assoc($rslt)){
								$rollNumberStd=$row['RollNumber'];
								?>

                             <div id="cardwraper" class="cardwraper">   
                                <table width="1090" border="1" align="center" cellspacing="0" id="crdTbl">
								  <tr>
                                  <td style="width:344px;"> 
                                  	<div id="pic" class="pic">
                                    
                                    <div style="position:absolute; top:79px; left:19px; background:url(images/stamp.png) no-repeat; width:90px; height:58px;">&nbsp;</div>
                                    	<img src="takephoto/<?php echo($row['stdPhoto']); ?>" alt="" name="image" width="105" height="95" id="image" align="left" vspace="5" hspace="5" /> 
                                    </div>
                                    <div id="stdName" class="stdName"> نام 
									<font style="padding-right:108px;"><?php echo($row['stdName']); ?> </font>
                                    </div>
                                    <div id="stdFatherName" class="stdFatherName"> ولدیت  
									<font style="padding-right:83px;"><?php echo($row['fatherName']); ?></font>	 
                                    </div>
									<span id="regNo" class="regNo">رجسٹریشن نمبر 
                                    <font style="padding-right:3px; font-size:17px;"> 
									<?php if(isset($row['registrationNo']) && !empty($row['registrationNo'])){ 
										$regNum = explode("-",$row['registrationNo']); 
										if(isset($regNum[2])){
										$rNum = intval($regNum[2]);
										echo($rNum);
										}
										}
									?>
                                    </font>
                            		</span>
                                    <div id="dob" class="dob">تاریخِ پیدائش 
									<font style="padding-right:30px; font-size:17px;position:relative;top:3px;">
									<?php $dbr = new DateTime($row['dob']); $dbrt = $dbr->format("Y-m-d");
									  	  echo($dbrt); ?>
                                          </font>	 
                                    </div>	
                                    <div id="signNazim" class="signNazim">
                                    <span style="padding:0 0 0 40px;">دستخط ناظم </span>
									<span id="sign" class="sign">
									<img src="images/Signature.png" alt="" /></span>
                                    </div>
                                  </td>
								  
								  
                                  <td style="width:344px;"> 
                                  	<div id="idN" class="idN">
                                              <?php //echo('<font style="font-size:17px;">شناختی کارڈ نمبر &nbsp;&nbsp;&nbsp;</font> ');
												$whichNIC = "";$lbl = "";
													if($row['stdNic'] != "0"){ 
                                                      $lbl = ('شناختی کارڈ نمبر &nbsp;&nbsp;&nbsp; '); 
													  $whichNIC =($row['stdNic']); 
                                                      }
                                                    else if($row['guirdianNic'] != "0"){ 
													   $lbl = ('سرپرست کارڈ&nbsp;&nbsp;&nbsp; '); 
                                                      $whichNIC =($row['guirdianNic']);
                                                      }
                                                    if($row['formB'] != "0") {
													   $lbl = ('فارم ب  &nbsp;&nbsp;&nbsp; '); 
                                                      $whichNIC =($row['formB']); 
                                                      } 
													  echo($lbl);
											  ?>
                                              <span style="left: 20px;position: relative;">
	                                              <input type="text" readonly="readonly" style="width:157px; background-color:transparent;border-width:0px;font-size:18px;" value="<?php echo($whichNIC);  ?>" />
                                    		  </span>          
                                    </div>
                                    <div id="pAddr" class="pAddr">
                                    <span style="padding:0 0 0 29px;">مستقل پتہ</span>
											<?php echo($row['permanentAddress']); ?>
                                    </div>
                                    <div id="preAddr" class="preAddr">
                                    <span style="padding:0 0 0 20px;">موجودہ پتہ </span>
											<?php echo($row['presentAddress']); ?>	
                                    </div>
									<div id="pic2" class="pic2">
                                    	<img src="takephoto/<?php echo($row['stdPhoto']); ?>" alt="" name="image" width="73" height="68" id="image3" align="left" />
                                    </div>
                                    <div id="darjaLbl" class="darjaLbl">
                                        <span style="padding:0 0 0 43px;">الدرجہ</span>
                                        <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode=".$row['darja'],"darja")); ?>	
                                        <div id="rollNumber" class="rollNumber"> رول نمبر 
										<font style="font-size:17px;"><?php echo($rollNumberStd); ?></font></div>
                                 	</div>                                    
                                    <div id="dateIssued" class="dateIssued"> 
                                    <span style="padding:0 0 0 10px;font-size: 27px;">تاریخِ اجراء</span>
									 <span style="padding:0 0 0 10px;position:relative;top:4px;">
									 <?php 
									 if(isset($row['promotionDate']) && !empty($row['promotionDate'])){
											$formatStart="YYYY-MM-DD";
											$startDate = $hijri->HijriToGregorian($row['promotionDate'],$formatStart);
											echo('<font color="#F00">'.$startDate.'</font>');
										}
										?>
                                     </span>
                                     <span style="padding:0 0 0 10px;font-size: 27px;">تاریخِ تنسیخ</span>
									 <span style="padding:0 0 0 10px;position:relative;top:4px;">
									 <?php 
									 	if(isset($row['dateEnd']) && !empty($row['dateEnd'])){
											$formatEnd="YYYY-MM-DD";
											$endDate = $hijri->HijriToGregorian($row['dateEnd'],$formatEnd);
											echo('<font color="#F00">'.$endDate.'</font>');
										}										
										?>
                                        </span>
                                 </div> 
                                 <div id="addressEng" class="addressEng">
                                 <?php echo(E_Address); ?>
                                 </div>
                                  </td>
                                  </tr>
                                </table>
                             </div>
                                
					<?php 
								}//end for while loop
						}//end if for search method
						else{
							echo($crud->errorMsg("اس درجہ میں کوئی طالب علم ابھی تک رجسٹر نہ ہونے کیوجہ سے کوئی کارڈ موجود نہ ہے"," غلطی"));
							}//end else for search method
					}//end if for not empty text field in search engine
				else {
					echo($crud->errorMsg("مہربانی کر کے طالب العلم کا رجسٹریشن نمبر مہیاں کریں۔","غلطی"));
					}//end if for the inner if condition 
				}//end if for first if
			?>