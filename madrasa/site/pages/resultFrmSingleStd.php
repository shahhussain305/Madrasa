<style>
#regFrm td {
	direction:rtl;
	text-align:right;
	vertical-align:top;
}
#passport a{ color:#039; text-decoration:none; position:relative; top:40%;}
#resultAllStd a {
	font-size:20px;
	}
#resultAllStd a:hover {
	color:#036;
	}
</style>

<div class="headingTxtDiv" style="text-decoration:none; font-size:23px;">
رزلٹ تیار کرنے کے لئے پہلے طالب العلم کو تلاش کریں 
 || <span id="resultAllStd"> <a href="?cmd=resultFrm" title="کسی بھی درجہ کے مکمل طلباء کا نتیجہ تیار کیجئے"> مکمل طلباء کا نتیجہ بنائیں </a> </span>
</div>
<form method="post" action="?cmd=resultFrmSingleStd" class="generalTextFonts" style="color:#ffffff;">
  <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100" align="center">
  <tr>
  	<td>
    	<table width="1090" align="center" border="0" cellpadding="0" cellspacing="0">
		  <tr>
            <td width="100">&nbsp;</td>
        	<td> <font style="color:#ffffff; font-size:24px;"> طالب العلم کا رجسٹریشن نمبر لکھیں </font> </td>
	        <td> <input type="text" value="<?php if(isset($_REQUEST["registrationNo"]) && !empty($_REQUEST["registrationNo"])){ echo(addslashes($_REQUEST["registrationNo"])); } ?>" name="registrationNo" style="width:180px;" id="registrationNo" class="frmInputTxt" /> </td>
            <td> <font style="color:#ffffff; font-size:24px;"> درجہ منتخب کریں </font> </td>
            <td><?php 	$css = 'style="width:150px; position:relative; top:2px;"';		
						$crud->darjaatCmb('darja',$css); ?> 
            </td>
    	    <td> <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" /> </td>
            <td width="150">&nbsp;</td>
          </tr>
        </table>
  	</td>
  </tr>
</table>
</form>


<form method="post" action="?cmd=resultFrmSingleStd&btnSearch=1<?php if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja'])){ ?>&darja=<?php echo($_REQUEST['darja']);}?>">
  <?php
  $darjasno= '';
	$registrationNo = '';
	$subjectsno =  '';
	$obtMarks = '';
  	$id = 0;
	$stdSno = "";
	$resultYear = "";
	$msg = 0;
  	 if(isset($_REQUEST['btnSearch'])) {
			if(isset($_REQUEST['registrationNo']) && !empty($_REQUEST['registrationNo']) && 
			   isset($_REQUEST['darja']) && !empty($_REQUEST['darja'])){
				$registrationNo = addslashes($_REQUEST['registrationNo']);
				$darja = addslashes($_REQUEST['darja']);
				$stdSnoSql = "SELECT r.regSno FROM regnumbers r,stdDarjaat st WHERE st.darja = ".$darja." AND r.registrationNo='".$registrationNo."' AND st.stdSno = r.regSno";
				$stdSno = $crud->getValue($stdSnoSql,"regSno");
				//echo('Std Sno = '.$stdSno);
				//exit();
				//$registrationNo = mysql_real_escape_string($registrationNo);
				$sql="SELECT
						  reg.registrationNo, r.stdName, r.fatherName, st.darja
						FROM registrationinfo r, stddarjaat st, regnumbers reg
						WHERE r.sno = reg.regSno
							AND reg.registrationNo = '".$registrationNo."' AND st.darja = ".$darja." AND 
							st.stdSno = r.sno AND st.isCurrent = 1 AND r.isActive = 1";
				     // echo($sql);
							if($crud->search($sql)){
								$rslt = mysql_query($sql,$crud->con);
								$row = mysql_fetch_assoc($rslt);
								?>
                                
                                   طالب العلم کا رجسٹر یشن نمبر = 
								   <span style="direction:ltr !important;"> 
                                   	<input type="text" disabled="disabled" style="background-color:transparent;text-align:right;border:0px; font-size:15px; font-weight:bold;" readonly="readonly" value="<?php echo($row['registrationNo']);?>" />
                                    </span><br />
                                    طالب العلم کا نام = <?php echo ($row['stdName']);?><br />
                                    طالب العلم کے والد کا نام = <?php echo ($row['fatherName']);?></br>
                                    درجہ = <?php
										 $sqlDarja = "SELECT darja FROM darjaat WHERE derjaCode = ". $darja;
											//echo($sqlDarja);
											echo($crud->getValue($sqlDarja,"darja")); 
											?>
                                    
                                <?php
								 //$q2="select subjectName from subjects ";
								 $sqlSubject = "SELECT
												  s.sno,s.subjectName,s.totalMarks
												FROM subjects s, registrationinfo r,regnumbers reg, stdDarjaat st 
												WHERE st.darja = s.darjaSno
												AND s.darjaSno = ".$darja." 
												AND st.stdSno = r.sno 
												AND reg.registrationNo = '".$registrationNo."' AND 
												reg.regSno = r.sno AND st.isCurrent = 1 AND r.isActive = 1";
												//echo($sqlSubject);
												// exit();
									
											 $rs1=mysql_query($sqlSubject,$crud->con);
											 ?>
                                             <table  align="center" width="1090" cellpadding="0" cellspacing="0" border="1">
                                             <tr>
                                             <td width="27%" style="background-color:#F90; font-size:23px;"> المادۃ</td> 
                                             <td width="21%" style="background-color:#F90; font-size:23px;"> کل نمبرات</td> 
                                             <td style="background-color:#F90; font-size:23px;"> حاصل کردہ نمبرات</td>
                                             </tr>
                                             <tr>
                                             	<td style="background-color:#F90; font-size:23px;"> نتیجہ برائے  </td>
                                                <td> <select name="resultTerm" id="resultTerm" class="frmSelect" style="width:150px;"> 
													<?php if(isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm']) && $_REQUEST['resultTerm'] == 1){ ?> 
                                                    <option value="1" selected="selected"> سہ ماہی </option>
                                                    <?php } 
                                                    else if(isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm']) && $_REQUEST['resultTerm'] == 2){ ?> 
                                                    <option value="2" selected="selected"> شش ماہی </option>
                                                    <?php }
                                                    else if(isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm']) && $_REQUEST['resultTerm'] == 3){ ?> 
                                                    <option value="3" selected="selected"> سالانہ </option>
                                                    <?php } ?>
                                                    <option value="1"> سہ ماہی </option>
                                                    <option value="2"> شش ماہی </option>
                                                    <option value="3"> سالانہ </option>
                                                 </select>
                                                </td>
                                                <td width="52%"> <font class="titleFont" style="font-size:20px; position:relative; top:6px;"> تاریخ ابتداء</font> &nbsp;&nbsp;&nbsp; 
                                                 <input type="text" maxlength="4" id="promotionDate" name="promotionDate" value="<?php echo($crud->getValue("SELECT promotionDate FROM stddarjaat WHERE stdSno = ".$stdSno." AND isCurrent = 1","promotionDate")); ?>" class="frmInputTxt" style="width:150px;" />
                                                 <font class="titleFont" style="font-size:20px; position:relative; top:6px;"> تاریخ انتہا </font>
                                                 <input type="text" maxlength="4" id="dateEnd" name="dateEnd" value="<?php echo($crud->getValue("SELECT dateEnd FROM stddarjaat WHERE stdSno = ".$stdSno." AND isCurrent = 1","dateEnd")); ?>"" class="frmInputTxt" style="width:150px;" />
                                                </td>
                                             </tr>
											 <?php foreach($crud->getRecordSet($sqlSubject) as $rw1){
											//while($rw1=mysql_fetch_assoc($rs1)) { 
												$id +=1;  ?>
                                            	<tr>
                                            		<td style="font-size:23px; padding:2px;"><?php echo($rw1['subjectName']); ?></td>
                                                    <td style="padding:2px;"><?php echo ($rw1['totalMarks']); ?> </td>
                                               		<td style="padding:2px;"> 
                                                    	 <input type="text" maxlength="3" onblur="if(this.value > 100 || this.value < 0 || isNaN(this.value)){ this.value = '0'; alert('مہربانی کرکے حاصل کردہ نمبر 100 یا 100 سے کم دیں۔'); }" value="<?php if(isset($_REQUEST['obtMarks'.$id]) && !empty($_REQUEST['obtMarks'.$id])) echo($_REQUEST['obtMarks'.$id]);?>" id="obtMarks<?php echo($id); ?>" name="obtMarks<?php echo($id); ?>" style="height:30px; width:70px;" />
                                                      	 <input type="hidden" name="subjectsno<?php echo($id); ?>" value="<?php echo ($rw1['sno']); ?>" />
                                                       </td>
                                                    
												</tr>
                                         
                                                  <?php }	?>
                                                  <tr>
                                                  	<td> تعلیمی سال </td>
                                                  	<td colspan="2">
                                                    <textarea name="edu_year_remarks" id="edu_year_remarks" cols="35" rows="2"></textarea>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                  <td colspan="3" align="center">                                                                                                    
                                                  	    <input type="hidden" name="counter" value="<?php echo($id); ?>" />
                                                  		<input type="hidden" name="darjasno" value="<?php echo ($darja); ?>" />
                                                        <input type="hidden" name="darja" value="<?php echo ($darja); ?>" />
                                                    	<input type="hidden" name="stdSno" value="<?php echo ($stdSno); ?>" />
                                                        <input type="hidden" name="registrationNo" value="<?php echo($registrationNo);?>" />
                                                      	<input type="hidden" name="btnSearch" id="btnSearch" value="1" class="btnSave" />
                                                   		<input type="submit" value="محفوظ کریں" name="btnSave" id="btnSave" class="btnSave" /> <div></div>
                                                 
                                                  </td>
                                                    
                                                  </tr>
                                                  </table> 
                                                  <?php
													
								}
			}
}// end if button pressed
?>
    </form>  
    
											<?php 
											 $msg = 2; //false
											 if(isset($_REQUEST['btnSave'])){
											 	if(isset($_REQUEST['counter']) && !empty($_REQUEST['counter']) && 
													isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm'])){
														$stdSno = addslashes($_REQUEST['stdSno']);
											 			$numLoop = addslashes($_REQUEST['counter']);
														$promotionDate = addslashes($_REQUEST['promotionDate']);
														$dateEnd = addslashes($_REQUEST['dateEnd']);
														$edu_year_remarks = isset($_REQUEST['edu_year_remarks']) && !empty($_REQUEST['edu_year_remarks']) ? addslashes($_REQUEST['edu_year_remarks']) : "";
															for($i=1; $i<=$numLoop; $i++){
																//echo($i);
																$darjasno= addslashes($_REQUEST['darjasno']);
																$resultTerm = addslashes($_REQUEST['resultTerm']);
																$subjectsno = addslashes($_REQUEST['subjectsno'.$i]);
																$obtMarks = addslashes($_REQUEST['obtMarks'.$i]);
																
																$sqlsrch = "SELECT stdSno FROM result where 
																				subjectsno = ".$subjectsno." AND resultTerm = ".$resultTerm." 
																				AND promotionDate = '".$promotionDate."' AND dateEnd = '".$dateEnd."'  
																				AND stdSno = ".$stdSno;
																			//echo($sqlsrch);
																			if(!$crud->search($sqlsrch)){
																					$sqlInsertFinal = "INSERT INTO 
																										result(darjasno,stdSno,subjectsno,obtmarks,promotionDate,dateEnd,resultTerm,edu_year_remarks) 
																										VALUES(".$darjasno.",".$stdSno.",".$subjectsno.",".$obtMarks.",'".$promotionDate."','".$dateEnd."',
																											   ".$resultTerm.",'".$edu_year_remarks."')";												
																					//echo($sqlInsertFinal);
																					//exit();
																					if($crud->insert($sqlInsertFinal)){
																						$msg = 1;
																						}
																					else{
																							$msg = 2;
																						 }
																				}
																			else{
																					$msg = 3; // duplicate value already exists
																				}
																				
																				}//end of for loop
																				?>	
                                                                                <br />
                                                                                <?php if($msg == 1) { 
																					echo($crud->sucMsg('نتیجہ کامیابی کے ساتھ محفوظ ہو گیا۔','معلومات')); 
																					}
																				else if($msg == 2) { 
																					echo($crud->errorMsg("کمپوٹر میں غلطی کی بناء پر نتیجہ محفوظ نہ ہوسکا۔","غلطی"));
																					} 	
																				 else if($msg == 3) { 
																					echo($crud->errorMsg("اس طالب کا نتیجہ پہلے ہی سے موجود ہے۔","غلطی"));
																					} 
																				 ?>  																			 
													 <?php
																
												}//end if for counter
											 }//btnsave check if											 
											  ?>