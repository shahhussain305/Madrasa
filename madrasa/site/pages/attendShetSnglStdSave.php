<?php ob_start(); session_start();
require_once('../classes/classes.php'); ?>
<?php require_once('../classes/Hijri_GregorianConvert.php'); ?>
<?php $hijri = new Hijri_GregorianConvert(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>حاضری برائے ایک طالب العلم</title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
body {
	 font-family:'Jameel Noori Nastaleeq';
	 font-size:25px;
	}
</style>
<?php /*?> Calendar <?php */?>
<script language="javascript" type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style type="text/css">
@import "../js/jquery.datepick.css";
</style>
<?php /*?>End of Calendar <?php */?>

<script type="text/javascript">
$(function() {
	$('#dateAtt').datepick();
});
</script>    
<style>
.errFonts{
	font-size:23px;
	}
</style>
</head>
<body style="background-image:none; background-color:#ffffff; direction:rtl;" dir="rtl">
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
<?php 
$crud = new CRUD();
	if(isset($_REQUEST['stdSno']) && !empty($_REQUEST['stdSno']) && isset($_REQUEST['darjaSno']) && !empty($_REQUEST['darjaSno'])){ 
		$stdSno = $_REQUEST['stdSno'];
		$darjaSno = $_REQUEST['darjaSno'];
		?>
                <?php echo($crud->getValue("SELECT CONCAT('<div style=','\"text-align:center;','background-color:#FFFFCC; color:#003366;\"',' title=','\"طالب العلم کا نام بمعہ والد نام\"','>',' طالب العلم ',stdName,' ولدِ ',fatherName,' کی حاضری لگائیں </div>') as stdName FROM registrationinfo WHERE sno = ".$stdSno,"stdName")); ?>
                <form method="post" action="attendShetSnglStdSave.php?stdSno=<?php echo($stdSno); ?>&darjaSno=<?php echo($darjaSno); ?>">
                <table width="100%" border="0" cellspacing="4" cellpadding="5" style="position:relative; padding-right:10px;">
                    <tr>
                        <td width="35%"> حاضری کی تاریخ منتخب کریں </td>
                        <td width="65%"> <input type="text" name="dateAtt" id="dateAtt" value="<?php if(isset($_REQUEST['dateAtt']) && !empty($_REQUEST['datAtt'])){echo($_REQUEST['datAtt']);}else{ echo($promotionDt);} ?>" class="frmInputTxt" style="width:130px;" /> </td>
                     </tr>
                    <tr>
                        <td style="vertical-align:top;"> کسی ایک کا انتخاب کریں </td>
                        <td>
                             <input type="radio" checked="checked" name="attendence" id="attendence2" value="غ" />  غیر حاضر <br />
                             <input type="radio" name="attendence" id="attendence3" value="ر" /> رخصت <br />
                             <input type="radio" name="attendence" id="attendence4" value="ب" /> بیمار 
                        </td>
                     </tr>     
                     <tr>
                        <td colspan="2" align="center"> <input type="submit" name="saveBtn" id="saveBtn" class="btnSave" value="محفوظ کریں" /></td>
                     </tr>
                </table>  
                </form>
                <?php if(isset($_REQUEST['saveBtn'])){
							if(isset($_REQUEST['dateAtt']) && !empty($_REQUEST['dateAtt'])){
								$dateAtt = $_REQUEST['dateAtt'];
								$sql = "SELECT * FROM attendence WHERE darjaSno = ".$darjaSno." AND attendanceDate = '".$dateAtt."' AND regSno = ".$stdSno;
									//echo($sql);
									if(!$crud->search($sql)){
										$sqlInsert = "INSERT INTO attendence (stdStatus,darjaSno,attendanceDate,regSno) VALUES('".$_REQUEST['attendence']."',".$darjaSno.",'".$dateAtt."',".$stdSno.")";
											//echo($sqlInsert);
											if($crud->insert($sqlInsert)){
												echo($crud->sucMsg("حاضری محفوظ ہو گئی","معلومات","../images"));
												}
											else{
												echo($crud->errorMsg("کمپیوٹر میں غلطی آنے کی وجہ سے حاضری محفوظ نہ ہوسکی","غلطی","../images"));
												}
										}
									else {
										 echo($crud->errorMsg("اس تاریخ میں اس طالب العلم کے لئے حاضری پہلے ہی سے لگائی گئی ہے","غلطی","../images"));
										}
								}//end if for dateAtt check
							else{
									echo($crud->errorMsg("برائے مہربانی تاریخ منتخب کیجئے","غلطی","../images"));
								}//end else for dateAtt check			
							}//end if for isset(saveBtn) ?>
                <?php }//end if for first load page check  ?>
</body>
</html>
<?php ob_flush(); ?>