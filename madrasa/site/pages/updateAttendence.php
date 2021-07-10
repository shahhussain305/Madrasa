<script type="text/javascript">
$(function() {
	$('#dat').datepick();
	$('#year').datepick();
	});
	$(function(){
		$("#singleStd").css({"color":"blue","font-size":"23","text-decoration":"none"});
		});
	$(document).ready(function(){
		$("#dLink").css({"color":"#03C"}).css({"fontSize":"25px"});
		});
	</script>
	<style>
	#aTbl a{ text-decoration:none; font-size:20px; color:#03C; }
	#aTbl a:hover{ text-decoration:underline; font-size:20px; color:#C00; }
	.errFonts{ font-size:23px;}
	</style>
	<div class="headingTxtDiv" id="dLink">
	کشف الحضور میں تبدیلی کریں || <a href="?cmd=attendenceSheetSingleStd" id="singleStd" title="علحٰیدہ طالب العلم کی حاضری لگائیں"> علحٰیدہ طالب علم کی حاضری لگائیں</a>
	</div>
	<?php
	$format="YYYY/MM/DD";
	$date=date("Y/m/d");
	$yearHijri = $hijri->GregorianToHijri($date,$format);
	$HijriYr = explode('-',$yearHijri); //we have added one year to this because it will be considered as the end of admission year
	$dateAdmitionAry = explode('-',$yearHijri);
	$dateAdmition = $dateAdmitionAry[2].'-'.$dateAdmitionAry[1].'-'.$dateAdmitionAry[0];
	$yearHijri = $dateAdmition;
	?>
        <form method="post" action="?cmd=updateAttendence" class="generalTextFonts">
          <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100" style="margin:0 auto;">
            <tr>
              <td align="center"><table width="850" align="center" border="0" cellpadding="3" cellspacing="6">
                <tr>
                  <td width="19%"><font color="#FFFFFF" style="font-size:23px;"> درجہ منتخب کریں </font></td>
                  <td width="21%"><?php $css = 'style="width:140px;position:relative; top:1px;"';		
          			  $crud->darjaatCmb('darja',$css); ?>
                  </td>
                  <td width="26%" style="color:#ffffff; font-size:23px;">حاضری کی تاریخ منتخب کریں</td>
                  <td width="21%"> 
                        <input type="text" name="year" id="year" class="frmInputTxt" style="width:130px;" value="<?php if(isset($_REQUEST['year']) && !empty($_REQUEST['year'])) {echo($_REQUEST['year']);}else{ $yr = explode("-",$_SESSION["hijri"]); echo($yr[2]."-".$yr[1]."-".$yr[0]);} ?>" />
                  </td>
                  <td width="13%"><input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" /></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </form>
 		<?php 
          $flg = false;
          $i = 1;
          $num = 0;
          $sqlSave = '';
          $isCurrent = 1;
          $dat = '';
					if(isset($_REQUEST['btnSave'])){						
						if(isset($_REQUEST['dat']) && !empty($_REQUEST['dat'])){
							$dat = $_REQUEST['dat'];						
							//foreach ($_POST as $key => $value) {
								$numLop = $_REQUEST['loopNum'];
								//echo($numLop);
								for($i=0; $i<$numLop; $i++){	
									$num +=1;		
									$stdStatus = $_REQUEST["attendence".$num];
									$darjaSno = $_REQUEST['darja'.$num];
									$regSno = $_REQUEST['regInoSno'.$num];
									
									//$attendanceDate = $_REQUEST['date'.$num];
									//echo('registrationNo'.$num.'='."stdStatus".$num.'='.'darjaSno'.$num.'='.'attendanceDate'.$num);
									$sqlSearchAttendenceDate = "SELECT * FROM attendence 
																WHERE darjaSno = ".$darjaSno." AND attendanceDate = '".$dat."' AND regSno=".$regSno;
															//	echo($sqlSearchAttendenceDate);
											if(!$crud->search($sqlSearchAttendenceDate)){
												
											$sqlSave = "INSERT INTO attendence (stdStatus,darjaSno,attendanceDate,regSno) 
														VALUES('".$stdStatus."','".$darjaSno."','".$dat."',".$regSno.")";
											//echo($sqlSave);
											// echo ($key."=".$value);
													if($crud->insert($sqlSave)){
															$flg = true;
															}
													else{
															$flg = false;
															}
												}//end if for search()
								}//end if for loop									
							if($flg) { 
									echo($crud->sucMsg("حاضری رجسٹر میں محفوظ ہوگئی","معلومات"));
								}
							else{
									echo($crud->errorMsg('حاضری رجسٹر میں محفوظ نہ ہوسکی','غلطی')); 
								}
								}//end if date field check
							else{
									echo($crud->errorMsg("مہربانی کر کے تاریخ منتخب کریں","غلطی"));
									}//end else for date check
						}//end if for btn click check
					?>
                    <p>
                      <?php
                        $totalStudentsAttendence = 0;
                         if(isset($_REQUEST['btnSearch'])){
                            if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && isset($_REQUEST['year']) && !empty($_REQUEST['year'])){
                                $darja = addslashes($_REQUEST['darja']);
                                $year = $_REQUEST['year'];
                                    $sql="SELECT sno,stdStatus, darjaSno,attendanceDate,regSno 
                                          FROM attendence 
                                          WHERE darjaSno = ".$darja." AND attendanceDate = '".$year."'";
                                    //echo($sql);
                                    if($crud->search($sql)){
                                        $result=mysql_query($sql,$crud->con);
                                        $k=1;
                                        $numIncrement = 0;
                                        ?>
                                      <div class="titleFont" style="text-align:center; font-size:25px;"> 
                                      رجسٹر برائے درجہ <?php echo($crud->getValue('SELECT darja FROM darjaat WHERE derjaCode = '.$darja,'darja')); ?>
                                      </div>
                                      <table align="center" width="1090" cellspacing="0" cellpadding="0" id="aTbl" border="1" style="margin:0 auto">
                                           <?php while($row=mysql_fetch_assoc($result)) { $totalStudentsAttendence +=1; $numIncrement +=1; ?>
                                        <tr id="trId<?php echo($row['sno']);?>">
                                            <td width="75"><?php echo $k++;?></td>
                                            <td width="354" style="font-size:23px;"><?php echo($crud->getValue("SELECT stdName FROM registrationinfo where sno = ".$row['regSno'],"stdName")); ?> 
                                                            <strong> ولد </strong>
                                                           <?php echo($crud->getValue("SELECT fatherName FROM registrationinfo where sno = ".$row['regSno'],"fatherName")); ?>
                                            </td>
                                            <td width="189" style="font-size:23px;">
                                            <?php if($row['stdStatus'] == 'غ'){
                                                    echo('غیر حاضر');
                                                        }
                                                  else if($row['stdStatus'] == 'ح'){
                                                        echo('حاضر'); 
                                                        }
                                                  else if($row['stdStatus'] == 'ر'){
                                                        echo('رخصت'); 
                                                        }
                                                  else{
                                                        echo('بیمار');
                                                      }
                                            ?>
                                          </td>
                                          <td width="253">
                                          <a href="pages/updateAttendanceWindow.php?sno=<?php echo($row['regSno']); ?>&date=<?php echo($year);?>&KeepThis=true&TB_iframe=true&height=400&width=600" class="thickbox" title="حاضری میں تبدیلی کریں <?php echo($year); ?>">تبدیل کریں</a>
                                          </td>  
                                          <td width="207">
                                           <a href="#" onclick="deleteAttendance(<?php echo($row['sno']); ?>,'trId<?php echo($row['sno']);?>');return false;" title="حاضری میں مٹا دیں">ہٹادیں</a>
                                          </td>                   
                                       </tr>
                                       <?php } ?>
                                       <tr>                   
                                         </table>
                                      <?php
                                        }
                                    else {
                                        ?>
                                           <br /> <?php echo($crud->errorMsg("متعلقہ درجہ کا رجسٹر ابھی نہیں دیکھایا جا سکتا کیونکہ اس درجہ میں کوئی بھی طالب العلم نے داخلہ نہیں لیا ہے۔ یا کسی طالب علم کی ابھی تک کوئ حاضری نہیں لگائی گئی ہے","غلطی")); ?>
                                        <?php
                                        }
                                
                                
                                
                                }
                        
                        
                        }
                    ?>
