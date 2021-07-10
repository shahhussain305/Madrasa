<script type="text/javascript">
$(function() {
	$('#dat').datepick();
	$('#promotionDate').datepick();
	$('#dateEnd').datepick();
});
$(function(){
	$("#singleStd").css({"color":"blue","font-size":"23","text-decoration":"none"});
	});
$(document).ready(function(){
	$("#dLink").css({"color":"#03C"}).css({"fontSize":"25px"});
	});
</script>
<div class="headingTxtDiv" id="dLink">
کشف الحضور || <a href="?cmd=attendenceSheetSingleStd" id="singleStd" title="علحٰیدہ طالب العلم کی حاضری لگائیں"> علحٰیدہ طالب علم کی حاضری لگائیں</a>
 || <a href="?cmd=updateAttendence" style="text-decoration:none; color:#03C;" id="singleStd" title="کشف الحضور میں تبدیلی کریں"> تبدیلی کریں </a>
</div>
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
<form method="post" action="?cmd=attendenceSheet" class="generalTextFonts">
  <table width="1090" border="0" cellpadding="0" cellspacing="0" bgcolor="#006633" height="100">
    <tr>
      <td><table width="92%" align="center" border="0" cellpadding="3" cellspacing="6">
        <tr>
          <td width="15%"><font color="#FFFFFF" style="font-size:23px;"> درجہ منتخب کریں </font></td>
          <td width="24%">
          		<?php $css = 'style="width:140px;position:relative;top:1px;"';		
          			  $crud->darjaatCmb('darja',$css); ?>
          </td>
          <td width="18%" style="color:#ffffff; font-size:23px;">تاریخ ابتداء</td>
          <td width="23%"> 
          		<input type="text" name="promotionDate" id="promotionDate" class="frmInputTxt" style="width:130px;" value="<?php if(isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate'])) {echo($_REQUEST['promotionDate']);}else{ echo($promotionDt);} ?>" />
          </td>
          <td width="18%" style="color:#ffffff; font-size:23px;">تاریخ انتہاء</td>
          <td width="23%"> 
          		<input type="text" name="dateEnd" id="dateEnd" class="frmInputTxt" style="width:130px;" value="<?php if(isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])) {echo($_REQUEST['dateEnd']);}else{ echo($dateEd);} ?>" />
          </td>
          <td width="20%"><input type="submit" name="btnSearch" id="btnSearch" value="تلاش کریں" class="btnSave" style="height:43px;" /></td>
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
								?>
                                <br />
                                <?php 								
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
		if(isset($_REQUEST['darja']) && !empty($_REQUEST['darja']) && isset($_REQUEST['promotionDate']) && !empty($_REQUEST['promotionDate']) && isset($_REQUEST['dateEnd']) && !empty($_REQUEST['dateEnd'])){
			$darja = addslashes($_REQUEST['darja']);
			$promotionDate = $_REQUEST['promotionDate'];
			$dateEnd = $_REQUEST['dateEnd'];
				$sql=" SELECT rg.sno,rg.fatherName,rg.stdName,r.registrationNo,r.RollNumber,std.promotionDate
					   FROM registrationinfo rg,stdDarjaat std ,regnumbers r 
					   where std.darja=".$darja." AND std.stdSno = rg.sno AND std.isCurrent = 1 
					   AND rg.sno = r.regSno AND rg.isActive = 1 AND YEAR(std.promotionDate) BETWEEN YEAR('".$promotionDate."') AND YEAR('".$dateEnd."')";
				//echo($sql);
				if($crud->search($sql)){
					$result=mysql_query($sql,$crud->con);
					$k=1;
					$numIncrement = 0;
					?>
                    
                   <form method="post" action="?cmd=attendenceSheet&btnSearch=1&darja=<?php echo($darja); ?>&btnSave=1&loopNum=0" name="attendanceFrm" id="attendanceFrm">
                    <div class="titleFont" style="text-align:center; font-size:23px;"> 
                   حاضری رجسٹر برائے درجہ <?php echo($crud->getValue('SELECT darja FROM darjaat WHERE derjaCode = '.$darja,'darja')); ?>
                    	<div style="margin:0px; padding:0px; float:left; position:relative; left:20px; font-size:23px; background-color:transparent;"> 
                    	     <input type="text" name="dat" id="dat" value="<?php if(isset($_REQUEST['dat']) && !empty($_REQUEST['dat'])){echo($_REQUEST['dat']);}else{ echo($promotionDt);} ?>" style="width:120px; height:26px; padding:2px; border-radius:5px;border:1px solid #e5e5e5;" /> 
                             <span style="padding:0 0 0 10px;">&nbsp;</span> تاریخ منتخب کریں 
                        </div>
                     </div>
				  <table align="center" width="1090" cellspacing="0" cellpadding="0" border="1" style="font-size:23px;">
                       <?php while($row=mysql_fetch_assoc($result)) { $totalStudentsAttendence +=1; $numIncrement +=1; ?><tr>
                        <td width="65"><?php echo $k++;?></td>
                    <td width="235"><?php echo($row['stdName']);?> <strong> ولد </strong><?php echo($row['fatherName']); ?> </td>
                    <td width="581">
                    	<input type="hidden" name="darja<?php echo($numIncrement); ?>" id="darja<?php echo($numIncrement); ?>" value="<?php echo($_REQUEST['darja']); ?>" />
                    	<input type="hidden" value="<?php echo($totalStudentsAttendence); ?>" id="loopNum" name="loopNum" />
                    	<input type="hidden" name="regInoSno<?php echo($numIncrement); ?>" id="regInoSno<?php echo($numIncrement); ?>" value="<?php echo($row['sno']); ?>" />
                  		<?php /*?><input  type="radio" name="attendence<?php echo($numIncrement); ?>" id="attendence<?php echo($numIncrement); ?>" checked="checked" value="ح" /> حاضر<?php */?>                                                                       
                        <input type="radio" checked="checked" name="attendence<?php echo($numIncrement); ?>" id="attendence<?php echo($numIncrement); ?>" value="غ" />  غیر حاضر                      
                        <input type="radio" name="attendence<?php echo($numIncrement); ?>" id="attendence<?php echo($numIncrement); ?>" value="ر" /> رخصت                     
                        <input type="radio" name="attendence<?php echo($numIncrement); ?>" id="attendence<?php echo($numIncrement); ?>" value="ب" /> بیمار                      	
                      </td>                     
                   </tr>
                   <?php } ?>
                   <tr>
                    <td colspan="3" align="center">
                    	 <input type="submit" value="محفوظ کریں"  id="btnSave" name="btnSave" class="btnSave" />  
                         </td>
                   </tr>
                     </table>
					</form>
                    <?php
					
					
				}
				else {
					?>
                    	<?php echo($crud->errorMsg("متعلقہ درجہ کا رجسٹر ابھی نہیں دیکھایا جا سکتا کیونکہ اس درجہ میں کوئی بھی طالب العلم نے داخلہ نہیں لیا ہے۔","غلطی")); ?>
                    <?php
					}		
			}	
	}
?>
