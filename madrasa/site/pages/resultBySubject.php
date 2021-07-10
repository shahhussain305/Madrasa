<script type="text/javascript">
$(function() {
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
	});
$(document).ready(function() {
	if($("#subjects").val() == ""){
		$("#btnSave").attr("disabled","disabled");
	}
    $("#subjects").bind("change",function(){
		getSubNum($(this).val());
		if($(this).val() == ""){
			$("#btnSave").attr("disabled","disabled");
			}
		else{
			$("#btnSave").removeAttr("disabled");
			}
		});//bind
	});//ready
function getSubNum(sno){
	var subject_sno = sno;
		//alert(subject_sno);
		$(".num_subject").html('<img src="images/loading/loader.gif" />');
			var urlGetNumbers = "AjaxPhp/getSubjectNumbers.php";
			$.post(urlGetNumbers,{subject_sno:subject_sno},function(n){
				$(".num_subject").html(n);
			});//post
	}	
</script> 
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
.bdr{
	 border:1px solid #e4e4e4;
	}
.bdr td{
	 border:1px solid #e4e4e4;
	}		
</style>
<?php 
	$promotionDt = "";
	$dateEd = "";
	if(isset($_SESSION['hijri'])){
		$dt = new DateTime($_SESSION['hijri']);
		$promotionDt = $dt->format('Y-m-d');
		$y = explode("-",$promotionDt);
		$y = $y[0] + 1;
		$dateEd = $dt->format($y.'-m-d');
	}
	?>
<div class="headingTxtDiv" style="text-decoration:none; font-size:23px;"></div>
<form method="post" action="?cmd=resultBySubject" class="generalTextFonts" style="color:#ffffff;">
  <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100" align="center">
  <tr>
  	<td>
    	<table width="1090" align="center" border="0" cellpadding="0" cellspacing="0">
		  <tr>
          <td width="50">&nbsp;</td>
            <td width="161" style="text-align:center;"> <font style="color:#ffffff; font-size:24px;"> درجہ منتخب کریں </font> </td>
            <td width="138" style="text-align:center;"> 
			<?php $css = 'style="width:150px; position:relative; top:2px;"'; $crud->darjaatCmb('darja',$css); ?> 
            </td>
             <td width="124" style="text-align:center;"> <font class="titleFont" style="color:#ffffff; font-size:25px;"> تاریخِ داخلہ </font> </td>
	        <td width="189" style="text-align:center;"> 
            	<input type="text" value="<?php if(isset($_POST['promotionDate']) && !empty($_POST['promotionDate'])){echo($_POST['promotionDate']);}else{echo($promotionDt);} ?>" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:150px;" />
            </td>
            <td width="117" style="text-align:center;"> <font class="titleFont" style="color:#ffffff; font-size:25px;"> تاریخِ انتہا </font> </td>
	        <td width="170" style="text-align:center;"> <input type="text" value="<?php if(isset($_POST['dateEnd']) && !empty($_POST['dateEnd'])){echo($_POST['dateEnd']);}else{echo($dateEd);} ?>" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:150px;" />  </td>
    	    <td width="90" style="text-align:center;"> <input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:1px solid #e3e3e3;" /> </td>
            <td width="51">&nbsp;</td>
          </tr>
        </table>
  	</td>
  </tr>
</table>
</form>

  <?php
  	$darjasno= '';
	$registrationNo = '';
	$subjectsno =  '';
	$obtMarks = '';
  	$id = 0;
	$stdSno = "";
	$resultYear = "";
	$msg = 0;
	$counterFldId = 0;
	$saveMsg = "";
	$saveCounter = 0;
  	 if(isset($_POST['btnSearch'])) {
			if( isset($_POST['darja']) && !empty($_POST['darja']) && 
				isset($_POST['promotionDate']) && !empty($_POST['promotionDate']) && 
				isset($_POST['dateEnd']) && !empty($_POST['dateEnd'])){
				$promotionDate = addslashes($_POST['promotionDate']);
				$dateEnd = addslashes($_POST['dateEnd']);
				$darja = addslashes($_POST['darja']);
				$stdSql = "SELECT sno,stdSno,darja,promotionDate,dateEnd FROM stddarjaat 
							  WHERE isCurrent = 1 AND promotionDate = '$promotionDate' AND dateEnd = '$dateEnd' AND darja = $darja ORDER BY sno ASC";
				?>
                <form method="post" action="?cmd=resultBySubject">
                 <table  align="center" width="1090" cellpadding="0" cellspacing="0" border="1" class="bdr">
                   <tr>
                    <td width="162" align="center"> نتیجہ برائے  </td>
                    <td width="161" align="center"> <select name="resultTerm" id="resultTerm" class="frmSelect" style="width:150px;"> 
                        <?php if(isset($_POST['resultTerm']) && !empty($_POST['resultTerm']) && $_POST['resultTerm'] == 1){ ?> 
                        <option value="1" selected="selected"> سہ ماہی </option>
                        <?php } 
                        else if(isset($_POST['resultTerm']) && !empty($_POST['resultTerm']) && $_POST['resultTerm'] == 2){ ?> 
                        <option value="2" selected="selected"> شش ماہی </option>
                        <?php }
                        else if(isset($_POST['resultTerm']) && !empty($_POST['resultTerm']) && $_POST['resultTerm'] == 3){ ?> 
                        <option value="3" selected="selected"> سالانہ </option>
                        <?php } ?>
                        <option value="1"> سہ ماہی </option>
                        <option value="2"> شش ماہی </option>
                        <option value="3"> سالانہ </option>
                     </select>
                    </td>
                    <td width="152" align="center"> مضمون منتخب کریں </td>
                    <td width="203" align="center">
                        <select name="subjects" id="subjects" class="frmSelect" style="width:150px;">
                        <option value=""></option>
                        <?php if(isset($_POST['subjects']) && !empty($_POST['subjects'])){ ?> 
                        	<script language="javascript">
								$(document).ready(function() {
                                   	getSubNum('<?php echo($_POST['subjects']); ?>');
	                                });
							</script>
							<option value="<?php echo($_POST['subjects']); ?>" selected="selected">
                            	<?php echo($crud->getValue("SELECT subjectName FROM subjects WHERE sno = ".addslashes($_POST['subjects']),"subjectName")); ?>
                            </option>
						<?php } ?>
                        <?php echo($crud->fillCombo("SELECT s.sno,s.subjectName FROM subjects s WHERE s.darjaSno = ".$darja,"sno","subjectName")); ?>
                        </select>
                    </td>                
                    <td width="400">&nbsp; </td>
                   </tr>
                   </table>
                                        
                  <table width="100%" border="1" cellpadding="2" cellspacing="0" class="bdr">  
                  	<tr style="background:#999; color:#009;">
                    	<td align="center"> سیریل نمبر </td>
                        <td align="center"> نام طالب علم بمعہ ولدیت </td>
                        <td align="center"> حاصل کردہ نمبرات </td>
                        <td align="center"> مضمون نمبرات </td>
                        <td width="14%" align="center">تاریخ داخلہ <br /> <?php echo($_POST['promotionDate']); ?> </td>
                        <td width="13%" align="center"> تاریخ انتہا <br /> <?php echo($_POST['dateEnd']); ?></td>
                        <td width="15%">&nbsp;</td>
                    </tr>    
                 <?php foreach($crud->getRecordSet($stdSql) as $rowStd){ $id +=1; $counterFldId +=1;  ?>
                    <tr>
                        <td width="10%" align="center"> <?php echo($id); ?> </td>
                        <td width="23%" align="center" style="font-size:23px; padding:2px;">
                        <?php echo($crud->getValue("SELECT stdName FROM registrationinfo WHERE sno = ".$rowStd['stdSno'],"stdName")); ?>
                        <strong style="color:#009; padding:10px 2px;"> ولد </strong>
                        <?php echo($crud->getValue("SELECT fatherName FROM registrationinfo WHERE sno = ".$rowStd['stdSno'],"fatherName")); ?>
                        <input type="hidden" id="std_sno_<?php echo($counterFldId); ?>" name="std_sno_<?php echo($counterFldId); ?>" value="<?php echo($rowStd['stdSno']); ?>" />
                        </td>
                        <td width="13%" align="center"> <input onblur="if($('#marks_<?php echo($counterFldId); ?>').val() > 100){$('#marks_<?php echo($counterFldId); ?>').val('0'); alert('آپ 100 سے زیادہ نمبر کسی بھی مضمون کے لئے نہیں دے سکتے');}" type="text" name="marks_<?php echo($counterFldId); ?>" id="marks_<?php echo($counterFldId); ?>" value="<?php if(isset($_POST['marks_'.$counterFldId]) && !empty($_POST['marks_'.$counterFldId])){echo($_POST['marks_'.$counterFldId]);}else{echo('0');} ?>" style="width:60px; height:24px; border-radius:4px; padding:2px; border:1px solid #e4e4e4;" /> </td>
                        <td width="12%" align="center"> <span class="num_subject"></span> </td>
                        <td colspan="3"></td>
                    </tr>
                      <?php }	?>
                    <tr>
                    	<td>&nbsp;</td>
                    	<td align="center"> تعلیمی سال </td>
               			<td colspan="3">
                        <textarea name="edu_year_remarks" id="edu_year_remarks" rows="3" cols="45" style="resize:none;"><?php if(isset($_POST['edu_year_remarks']) && !empty($_POST['edu_year_remarks'])){echo($_POST['edu_year_remarks']);} ?></textarea>
                        </td>     
                    </tr>
                    <tr>
                    	<td colspan="5">
                        <input type="hidden" name="countMrkFlds" id="countMrkFlds" value="<?php echo($counterFldId);?>" />
                        <input type="hidden" name="darja" id="darja" value="<?php echo($_POST['darja']); ?>" />
                        <input type="hidden" name="promotionDate" id="promotionDate" value="<?php echo($_POST['promotionDate']); ?>" />
                        <input type="hidden" name="dateEnd" id="dateEd" value="<?php echo($_POST['dateEnd']); ?>" />
						<?php //these will repaint the same form ?>
                        <input type="hidden" name="btnSearch" value="1" />
                        <?php //End ?>
                        <input type="submit" name="btnSave" id="btnSave" value="محفوظ کریں" class="btnSave" style="border:0px; border-radius:5px 5px 0 0;" />
                        <?php 
						if(isset($_POST['btnSave'])){
							if(isset($_POST['darja']) && !empty($_POST['darja']) &&
							   isset($_POST['subjects']) && !empty($_POST['subjects']) &&
							   isset($_POST['promotionDate']) && !empty($_POST['promotionDate']) &&
							   isset($_POST['dateEnd']) && !empty($_POST['dateEnd']) &&
							   isset($_POST['countMrkFlds']) && !empty($_POST['countMrkFlds']) &&
							   isset($_POST['resultTerm']) && !empty($_POST['resultTerm']) &&
							   isset($_POST['edu_year_remarks']) && !empty($_POST['edu_year_remarks'])){
								   $darja_sno = addslashes($_POST['darja']);
								   $subject_sno = addslashes($_POST['subjects']);
								   $promoteDat = addslashes($_POST['promotionDate']);
								   $endDate = addslashes($_POST['dateEnd']);
								   $edu_remarks = addslashes($_POST['edu_year_remarks']);
								   $resultTerm = addslashes($_POST['resultTerm']);
								   $countMrkFlds = addslashes($_POST['countMrkFlds']);//marks fields total count
								   for($i=1; $i <= $countMrkFlds; $i++){
								   //echo('std_sno : '.$_POST['std_sno_'.$i]);exit();
								   if(isset($_POST['std_sno_'.$i]) && !empty($_POST['std_sno_'.$i])){
									$std_sno = addslashes($_POST['std_sno_'.$i]);
									$marks = isset($_POST['marks_'.$i]) && !empty($_POST['marks_'.$i]) ? addslashes($_POST['marks_'.$i]) : 0;
								   		$sqlSearch = "SELECT * FROM result 
								   					  WHERE 
												 		darjasno = $darja_sno AND
														stdSno = $std_sno AND
														subjectsno = $subject_sno AND
														promotionDate = '$promoteDat' AND
														dateEnd = '$endDate' AND
														resultTerm = $resultTerm";
												if(!$crud->search($sqlSearch)){ 
													$sqlSave = "INSERT INTO result(
																darjasno,stdSno,subjectsno,obtmarks,promotionDate,dateEnd,resultTerm,edu_year_remarks
																) 
																VALUES(
																$darja_sno,$std_sno,$subject_sno,$marks,'$promoteDat','$endDate',$resultTerm,'$edu_remarks'
																)";
																//echo($sqlSave);
															if($crud->insert($sqlSave)){
																$saveCounter +=1;
																$saveMsg = $crud->sucMsg("نتیجہ محفوظ ہوچکا ہے","معلومات");
																}
															else{
																$saveMsg = $crud->errorMsg("کمپیوٹر میں خرابی کی وجہ سے ریکارڈ محفوظ نہ ہوسکا","مسلہ");
																}
													}	
												else{
													//echo('Existing Record: '.$sqlSearch);
													$saveMsg = $crud->errorMsg("یہ نتیجہ پہلے ہی سے محفوظ ہوچکا ہے");
													}
											//echo('<textarea cols="50" rows="6">'.$sqlSearch.'</textarea>');
										   }//std_sno should not be empty
									   }//for loop
									   if(isset($saveMsg) && !empty($saveMsg)){
										   echo($saveMsg);
										   }
								   }//filled fields
							else{
								echo('<br /><br />');
								echo($crud->errorMsg("خالی فارم محفوظ نہیں ہوسکتی","غلطی"));
								}//empty fields
							}
						?>
                        </td>
                    </tr>
				</table>  
                </form>                  						                      
					  <?php
				}//empty fields
		}// end if button pressed
?>   
											