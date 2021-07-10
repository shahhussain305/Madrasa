<script type="text/javascript">
$(function() {
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
});
	$(function(){
		$("#singleStd").css({"color":"blue","font-size":"23","text-decoration":"none"});
		});
	$(document).ready(function(){
		$("#dLink").css({"color":"#03C"}).css({"fontSize":"25px"});
		});
	$(document).ready(function() {
        $("#btnUpdate").click(function(){
			$("#msg").html('<img src="images/loading/loader.gif" alt="Loading" />');
			if($("#edu_year_remarks").val() != ""){
				var url = "AjaxPhp/update_edu_remarks.php";
				$.post(url,{edu_remarks: $("#edu_year_remarks").val(), resultTrm: $("#resultTrm").val(), yr:$("#yr").val() ,darj:$("#darj").val()},function(result){
					$("#msg").html(result);
					});
				}
			else{
					$("#msg").html('مہربانی کر کے اس باکس میں کچھ ریمارکس لکھیں');
				}
			});
    });
	</script>
	<style>
	#aTbl a{ text-decoration:none; font-size:20px; color:#03C; }
	#aTbl a:hover{ text-decoration:underline; font-size:20px; color:#C00; }
	#btnUpdate { height:60px; cursor:hand; width:100px; background:#ffffff; color:#039; border:1px solid #000; }
	</style>
    <?php 
	if(isset($_SESSION["hijri"]) && !empty($_SESSION["hijri"])){ 
	$sessionDate = new DateTime($_SESSION["hijri"]);
	$sessionDate = $sessionDate->format('Y-m-d');
	$dtAry= explode("-",$sessionDate);
	$dateEnding = $dtAry[0]+1;
	$dateEnding = $dateEnding.'-'.$dtAry[1].'-'.$dtAry[2];	
	}
	?>
	<div class="headingTxtDiv" id="dLink">
	نتیجہ میں تبدیلی یہاں سے کریں || 
    <a href="?cmd=resultFrm" id="singleStd" title="نتیجہ بنائیں"> نتیجہ بنائیں </a>
	</div>
	<?php
	$format="YYYY/MM/DD";
	$date=date("Y/m/d");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	$dateAdmitionAry = explode('-',$yearHijri);
	$dateAdmition = $dateAdmitionAry[2];
	$yearHijri = $dateAdmition;
	?>
        <form method="post" action="?cmd=updtaeResult" class="generalTextFonts">
          <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100" style="margin:0 auto;">
            <tr>
              <td><table width="1090" align="center" border="0" cellpadding="3" cellspacing="6">
                <tr>
                  <td width="11%"><font color="#FFFFFF"> درجہ منتخب کریں </font></td>
                  <td width="16%"><?php $css = 'style="width:140px; position:relative; top:1px;"';		
						$crud->darjaatCmb('darja',$css); ?>                        
                  </td>
                  <td width="8%" style="color:#ffffff;">تاریخ ابتداء </td>
                  <td width="13%"> 
                        <input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($sessionDate);} ?>" />
                  </td>
                  <td width="7%" style="color:#ffffff;">تاریخ انتہا </td>
                  <td width="13%"> 
                        <input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:110px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEnding);} ?>" />
                  </td>
                  <td width="6%" style="color:#ffffff;"> امتحان </td>
                  <td width="11%"> <select name="resultTerm" id="resultTerm" class="frmSelect" style="width:90px; height:44px;">
                  		<option value="1"> سہ ماہی </option>
                        <option value="2"> شش ماہی </option>
                        <option value="3"> سالانہ </option>
                        </select>
                        </td>
                  <td width="15%"><input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="border:1px solid #ffffff; border-radius:4px;height:44px;" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </form>
 		     <?php		  $k=0;
			 			  $rNum = 0;
                          if(isset($_REQUEST['btnSearch'])){
                            if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && 
							   isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && 
							   isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd']) && 
							   isset($_REQUEST['resultTerm']) && !empty($_REQUEST['resultTerm'])){
                                $darja = addslashes($_REQUEST['darja']);
                                $promotionDate = addslashes($_REQUEST['promotionDate']);
								$dateEnd = addslashes($_REQUEST['dateEnd']);
								$resultTerm = addslashes($_REQUEST['resultTerm']);
                                    $sql="SELECT DISTINCT
											  rs.stdSno
										  FROM result rs,registrationinfo r
										  WHERE rs.promotionDate = '".$promotionDate."'
										  	    AND rs.dateEnd = '".$dateEnd."'
											    AND rs.resultTerm = ".$resultTerm." AND 
										  		rs.darjasno = ".$darja." AND r.sno = rs.stdSno";
                                    /*echo($sql);
									exit();*/
                                    if($crud->search($sql)){
                                        $result=mysql_query($sql,$crud->con);
                                        ?>
                                      <div class="titleFont" style="text-align:center;"> 
                                      نتیجہ برائے درجہ <?php echo($crud->getValue('SELECT darja FROM darjaat WHERE derjaCode = '.$darja,'darja')); ?>
                                      (امتحان <?php if($resultTerm == 1){echo('سہ ماہی');}else if($resultTerm == 2){echo('شش ماہی');}else{echo('سالانہ');} ?>)
                                      </div>
                                      <table align="center" width="1090" cellspacing="0" cellpadding="0" id="aTbl" border="1" style="margin:0 auto;">
                                           <?php while($row=mysql_fetch_assoc($result)){ $k +=1; $rNum += 1; ?>
                                        <tr id="trId<?php echo($rNum);?>">
                                            <td width="48" style="padding:3px;"><?php echo($k);?></td>
                                            <td width="185" style="padding:3px;">
   											   <?php echo($crud->getValue("SELECT stdName FROM registrationinfo where sno = ".$row['stdSno'],"stdName")); ?> 
                                               <strong> ولد </strong>
                                               <?php echo($crud->getValue("SELECT fatherName FROM registrationinfo where sno = ".$row['stdSno'],"fatherName")); ?>
                                            </td>
                                            <td width="56" style="padding:3px;">
                                            <a href="#" onClick="if(confirm('کیا آپ واقعی اس نتیجہ کو مکمل طور پر ختم کرنا چاہتے ہیں؟')){ deleteResult(<?php echo($row['stdSno']); ?>,'<?php echo($resultTerm); ?>','<?php echo($promotionDate); ?>','<?php echo($dateEnd); ?>','trId<?php echo($rNum);?>');}else{return false;}" title="یہ نتیجہ مکمل طور پر مٹا دیں"> مٹادیں </a>
                                            </td>
                                            <td width="621">
                                            <?php  											    
												$sqlResult = "SELECT  rs.sno,rs.obtmarks,rs.subjectsno 
															  FROM result rs
										  					  WHERE rs.promotionDate = '".$promotionDate."' AND 
															        rs.dateEnd = '".$dateEnd."' AND
																	rs.resultTerm = ".$resultTerm." AND
																	rs.stdSno = ".$row['stdSno']." AND 
																	rs.darjasno = ".$darja;
                                            		//echo($sqlResult);
													$crud->connect();
													$result2 = mysql_query($sqlResult,$crud->con);
													if(mysql_num_rows($result2)){														
														?>
                                                        <table width="100%" border="1" cellspacing="0" cellpadding="4" style="border-width:0px; font-size:25px;">
                                                        <tr>
                                                        <?php while($rw = mysql_fetch_assoc($result2)){  ?>
                                                            <th>
                                                            	<?php $sqlSubjects = "SELECT s.subjectName FROM subjects s WHERE s.sno = ".$rw['subjectsno'];
																echo($crud->getValue($sqlSubjects,"subjectName")); ?>
                                                                <hr />
																<a href="pages/updateWindowForResult.php?sno=<?php echo($rw['sno']); ?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="یہ نمبر تبدیل کریں۔">
																	<?php echo($rw['obtmarks']); ?>
                                                                </a>
                                                            </th>
                                                            <?php }//end while loop ?>
                                                        </tr>
                                                        </table>
														<?php }//end if result2 ?>
                                            </td>                                                            
                                       </tr>
                                       <?php } ?>
                                       <tr>                   
                                         </table>
                                         <?php
										 	$sql_edu_year_remarks= "SELECT rs.edu_year_remarks
															  FROM result rs
										  					  WHERE rs.resultYear = '".$year."' AND 
																	rs.resultTerm = ".$resultTerm." AND
																	rs.edu_year_remarks != '' AND 
																	rs.darjasno = ".$darja;
										 ?>
                                         <br />
                                         <table width="100%" border="0" cellspacing="0" cellpadding="4" style="border-width:0px; font-size:25px;">
											<tr>
                                            	<td width="41%" valign="top">
                                                <input type="hidden" name="yr" id="yr" value="<?php echo($year); ?>" />
                                                <input type="hidden" name="resultTrm" id="resultTrm" value="<?php echo($resultTerm); ?>" />
                                                <input type="hidden" name="darj" id="darj" value="<?php echo($darja); ?>" />
                                                 <textarea name="edu_year_remarks" id="edu_year_remarks" rows="3" cols="40"><?php echo($crud->getValue($sql_edu_year_remarks,"edu_year_remarks")); ?></textarea>
                                               	</td>
                                                <td width="59%">
                                                <input type="button" value="اپڈیٹ کریں" id="btnUpdate" name="btnUpdate" />&nbsp;&nbsp;
                                                <br />
                                                 <span style="vertical-align:middle; height:120px;" id="msg"></span>                                                  
                                                </td>
                                            </tr>
                                         </table>
									  <?php
                                        }
                                    else {
                                        ?>
                                            <br />
                                            <?php echo($crud->errorMsg("نتیجہ برائے منتخب کردہ سال ابھی نہیں بنایا گیا ہے۔","غلطی","../images")); ?>
                                        <?php
                                        }
                                }
                        }
                    ?>
