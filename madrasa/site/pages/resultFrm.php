<script type="text/javascript">
$(function() {
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
	$('#promotionDaTe').datepick();
	$('.dtCls').datepick();
	
});
</script>  
<style>
#regFrm td {
	direction:rtl;
	text-align:right;
	vertical-align:top;
}
#passport a{ color:#039; text-decoration:none; position:relative; top:40%;}
#stdResult {color:#036; font-size:24px; }
#stdResultEdit {color:#036; font-size:24px; }
</style> 
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
?>

<div class="headingTxtDiv" style="text-decoration:none; font-size:25px;">
<a href="?cmd=resultBySubject" id="stdResult" title="ایک مضمون کی لحاظ سے علٰحیدہ نتیجہ بنائیں"> 
علٰحیدہ مضمون کی رزلٹ بنائیں
</a>
&nbsp;&nbsp; || 
<a href="?cmd=resultFrmSingleStd" id="stdResult" title="ایک طالب العلم کے لئے علٰحیدہ نتیجہ بنائیں"> علٰحیدہ رزلٹ بنائیں </a>
&nbsp;&nbsp; || 
<a href="?cmd=updtaeResult" id="stdResultEdit" title="نتیجہ میں تبدیلی کریں"> تبدیلی کریں </a>
</div>

<form method="post" action="?cmd=resultFrm" class="generalTextFonts" style="color:#ffffff;">
  <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100">
  <tr>
  	<td>
    	<table width="1090" align="center" border="0" cellpadding="0" cellspacing="0">
		  <tr>
        	<td> <font class="titleFont" style="color:#ffffff; font-size:25px;"> درجہ منتخب کریں </font> </td>
	        <td> 
				<?php 	$css = 'style="width:150px; position:relative; top:2px;"';		
						$crud->darjaatCmb('darja',$css); ?>
             </td>
            <td> <font class="titleFont" style="color:#ffffff; font-size:25px;"> تاریخِ داخلہ </font> </td>
	        <td> 
            	<input type="text" value="<?php echo($promotionDt); ?>" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:150px;" />
            </td>
            <td> <font class="titleFont" style="color:#ffffff; font-size:25px;"> تاریخِ انتہا </font> </td>
	        <td> <input type="text" value="<?php echo($dateEd); ?>" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:150px;" />  </td>
    	    <td> <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" /> </td>
          </tr>
        </table>
  	</td>
  </tr>
</table>
</form>
<br />
<?php $promotionDate = ""; $dateEnd = "";
	 if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
		 isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
		 isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
			 $promotionDate = addslashes($_REQUEST['promotionDate']);
			 $dateEnd =  addslashes($_REQUEST['dateEnd']);			 
			echo('رزلٹ برائے درجہ ');
			echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = {$_REQUEST['darja']}","darja"));
			echo('<span style="padding:10px 0 0 10px;">&nbsp;</span> ( داخلہ ابتداء <span style="padding:0 0 0 10px;">&nbsp;</span> '.$promotionDate.'<span style="padding:0 0 0 10px;">&nbsp;</span> انتہا <span style="padding:0 0 0 10px;">&nbsp;</span>'. $dateEnd.')');
		} 
	?>
<form method="post" action="?cmd=resultFrm<?php if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){ echo('&darja='.$_REQUEST['darja'].'&promotionDate='.$_REQUEST['promotionDate'].'&dateEnd='.$_REQUEST['dateEnd']); } ?>">
  <?php
    $darjasno= '';
    $stdCounter =0;
	$registrationNo = '';
	$subjectsno =  '';
	$obtMarks = '';
	$subjectTable = "";
  	$id = 0;
	$columnsTotal = 0;
	$rowsTotal = 0;
	$msg = 0; //0 means no need to show any message
  	 if(isset($_REQUEST['btnSearch'])) {
			if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
			   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
			   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
				   $promotionDate = addslashes($_REQUEST['promotionDate']);
				   $dateEnd =  addslashes($_REQUEST['dateEnd']);
				   $darja = addslashes($_REQUEST['darja']);
								
				   $sqlSubject = "SELECT
								  s.sno,s.subjectName
								  FROM subjects s 
								  WHERE s.darjaSno = ".$darja;
				       //echo($sqlSubject);
							if($crud->search($sqlSubject)){
								$rslt = mysql_query($sqlSubject,$crud->con);
								?>
                                <table width="1090" border="1" cellspacing="0" cellpadding="4" bgcolor="#FF6633">   
                                <tr>
                                	<td width="20%" style="text-align:center;"> <font class="titleFont" style="font-size:20px;"> امتحان منتخب کریں </font> </td>
                                 	<td width="18%" style="text-align:right;">
                                     <select name="resultTerm" id="resultTerm" class="frmSelect" style="width:150px;"> 
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
                                    <td width="62%" style="text-align:center;"> <font class="titleFont" style="font-size:20px;"> تاریخ ابتداء </font>
                                     <input type="text" maxlength="4" id="promotionDaTe" name="promotionDaTe" value="<?php echo($promotionDate); ?>" class="frmInputTxt" style="width:150px;" />
                                     <font class="titleFont" style="font-size:20px;"> تاریخ انتہا </font>
                                     <input type="text" maxlength="4" id="dateEnd" name="dateEnd" value="<?php echo($dateEnd); ?>" class="frmInputTxt dtCls" style="width:150px;" />
                                    </td>
                                 </tr>
                                 </table>
                                 <table width="1090" border="1" cellspacing="0" cellpadding="4" align="center">                                 
                                 <tr bgcolor="#CCCCCC">
                                 <td width="20"> # </td>
                                 <td width="120" style="text-align:center; font-size:20px;"> طالب علم </td>
                                <?php								 
								while($row = mysql_fetch_assoc($rslt)){	
									$columnsTotal +=1;
									$subjectTable .= ' <td width="100" style="font-size:20px; text-align:center;"> '. $row['subjectName']. '</td>';									
								}//end of while loop
								echo($subjectTable);
								?>
                                </tr>
                                <?php 
								$counter = 0;
								$counterInner = 0;
								$sqlStd = "SELECT r.sno, CONCAT(r.stdName,'<font style=','color:darkblue;','> ','  <strong>ولد</strong> ',' </font>',
												r.fatherName) stdName 
											FROM registrationinfo r,stdDarjaat std where std.darja = ".$darja." AND 
												 std.promotionDate = '".$promotionDate."' AND std.dateEnd = '".$dateEnd."' AND std.stdSno = r.sno AND std.isCurrent = 1";
								//echo($sqlStd);
								$result = mysql_query($sqlStd,$crud->con);
								if(mysql_num_rows($result) > 0){
									while($rowStd = mysql_fetch_assoc($result)){
										$rowsTotal +=1;
										$counter +=1;
										$stdCounter += 1;
										$sqlSubjectForStd = "SELECT s.sno, s.subjectName FROM subjects s WHERE s.darjaSno = '".$darja."'";
										$resultSubjects = mysql_query($sqlSubjectForStd,$crud->con);
										?>
      								  <tr>
                                      	<td style="font-size:14px;"> <?php echo($stdCounter); ?> </td>
                                      	<td style="font-size:16px; text-align:center;"> <?php echo($rowStd['stdName']); ?> </td>
                                        <?php 
											while($subject = mysql_fetch_assoc($resultSubjects)){
												$counterInner +=1;
												?>
                                                <td style="text-align:center;">
                                                	<table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tr>
                                                        <td title="<?php echo($subject['subjectName']); ?>">
                                                        <input type="hidden" name="btnSearch" value="1" /> <?php //this field will fill the fields with the submitted values; ?>
                                                        <input size="1" type="hidden" name="sujectSno<?php echo($counterInner); ?>" id="sujectSno<?php echo($counterInner); ?>" value="<?php echo($subject['sno']); ?>" />
                                                        <input size="3" type="hidden" name="stdSno<?php echo($counterInner); ?>" id="stdSno<?php echo($counterInner); ?>" value="<?php echo($rowStd['sno']); ?>" />
                                                        <input type="text" size="8" maxlength="3" onblur="if(this.value > 100 || this.value < 0 || isNaN(this.value)){ this.value = '0'; alert('مہربانی کرکے حاصل کردہ نمبر 100 یا 100 سے کم دیں۔'); this.focus(); }" name="marks<?php echo($counterInner); ?>" id="marks<?php echo($counterInner); ?>" value="<?php if(isset($_REQUEST['marks'.$counterInner]) && !empty($_REQUEST['marks'.$counterInner])) { echo($_REQUEST['marks'.$counterInner]);}else{ echo('0'); } ?>" />
                                                        </td>
                                                     </tr>
                                                     </table>
                                                </td>
                                                <?php
												}//end while for inner loop
										 ?>
                                      </tr>                       
	                                <?php
									}//end while loop
									}//end if mysql_num_rows() > 0
								?>
                                 </table>
				<br /><table width="910" cellspacing="0" cellpadding="0">
					<tr>
						<td> تعلیمی سال </td>
						<td> <textarea rows="3" cols="50" name="edu_year_remarks" id="edu_year_remarks"><?php if(isset($_REQUEST["edu_year_remarks"]) && !empty($_REQUEST["edu_year_remarks"])){echo(addslashes($_REQUEST["edu_year_remarks"]));} ?></textarea> </td>
					</tr>
				</table>
                                <?php
							}//end if for search method							
			}//end if for isset() method	
			else{echo($crud->errorMsg("مہربانی کرکے درجہ اور سال منتخب کریں","غلطی"));}
			?>
            <table width="910" cellspacing="0" cellpadding="4" border="0">
            <tr>
            	<td>
                	<input type="hidden" name="darja" id="darja" value="<?php echo($darja); ?>" />
                    <input type="hidden" size="5" name="columnsTotal" id="columnsTotal" value="<?php echo($columnsTotal); ?>" />
                    <input type="hidden" size="5" name="rowsTotal" id="rowsTotal" value="<?php echo($rowsTotal); ?>" />
                    <?php if(isset($rowsTotal) && !empty($rowsTotal) && $rowsTotal > 0){ ?>
                    <input type="submit" value="محفوظ کیجیے" name="btnSave" id="btnSave" class="btnSave" />
                    <?php } ?>
                </td>
            </tr>
            </table>
           <?php  }//end if for btnSearch pressed ?>
            <?php if(isset($_REQUEST['btnSave'])){ ?>
            <table width="910" cellspacing="0" cellpadding="4" border="0">
            <?php
							$sqlSearch = "SELECT promotionDate,dateEnd,resultTerm, darjaSno FROM result
										  WHERE promotionDate = '".addslashes($_REQUEST['promotionDate'])."' 
										  AND dateEnd = '".addslashes($_REQUEST['dateEnd'])."'
										  AND resultTerm = ".addslashes($_REQUEST['resultTerm'])." 
										  AND darjaSno = ".addslashes($_REQUEST['darja']);
										  //echo($sqlSearch);
				//restrict to save data if it has already saved for the spefsified year , darja and term
				if($crud->search($sqlSearch)){
					$msg = 3;// 3 means that all the data has already been saved successfully.
					}
				else{
						$colTotal = $_REQUEST['columnsTotal'];
						$rwTotal = $_REQUEST['rowsTotal'];
						$totalCells = $colTotal * $rwTotal;  //to get the total cell available in the form
					for($rec = 1; $rec <= $totalCells; $rec++){ //run this loop on the total rows and columns of the form
								//all the fields are mandatory, therefore, all the fields must be contained some values
								// to save all the fields in the table for the selected year and term
								$sqlInsert = "INSERT INTO result(darjasno,stdSno,subjectsno,obtmarks,promotionDate,dateEnd,resultTerm,edu_year_remarks) 
										VALUES(".$_REQUEST['darja'].",".$_REQUEST['stdSno'.$rec].",".$_REQUEST['sujectSno'.$rec].",
												".$_REQUEST['marks'.$rec].",'".$_REQUEST['promotionDate']."','".$_REQUEST['dateEnd']."',".$_REQUEST['resultTerm'].",'".$_REQUEST['edu_year_remarks']."')";
								//echo($sqlInsert);
								//save sql now
								if($crud->insert($sqlInsert)){
									$msg = 1;// 1 means for successfully saved data
									}
								else{
									$msg = 2; //2 means that the data did not save in the database
									}//end else for insert method					
						}//end of for loop
				}//end else for search methos
				 ?>            	
            <?php }//end if for btnSave pressed event ?>
            <?php if(isset($msg) && ($msg != 0)){ ?>
            <tr>
            	<td colspan=""> 
                <?php if($msg == 1) {
						echo($crud->sucMsg(" نتیجہ کامیابی کے ساتھ محفوظ ہوگیا۔","معلومات"));
						}
					else if($msg == 2){
						echo($crud->errorMsg("نتیجہ محفوظ نہ ہوسکا","غلطی"));
						}
					else if($msg == 3){
						echo($crud->errorMsg("اس سال میں اسی درجہ کیلے یہی نتیجہ پہلے ہی سے محفوظ کیا گیا ہے۔","غلطی"));
						}
					?>
                </td>
            </tr>            	
            <?php } ?>
            </table>
     </form>
