<?php ob_start();session_start();
require_once('../classes/classes.php'); ?>
<?php $crud = new CRUD(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>داخل شدہ طلباء کی تفصیلی رپورٹ </title>
<link rel="stylesheet" type="text/css" href="../css/default.css"/>
<style>
td{
	text-align:center;
	font-weight:normal;
	font-size:17px;
	font-family:"jameel Noori Nastaleeq";
	}
</style>
</head>
<body style="background-image:none; background-color:#ffffff;">
<div id="printerArea" style="width:700px; margin:0 auto;" title="رپورٹ">
<table width="698" border="1" cellspacing="0" cellpadding="3">
	<tr>
    	<th width="72"> نمبر شمار </th>
        <th width="168"> شعبہ </th>
        <th width="168"> درجہ </th>
        <th width="121"> تاریخ داخلہ </th>
        <th width="127"> تاریخ انتہاء </th>
    </tr>
    <?php
	$sql = "SELECT distinct darja,promotionDate,dateEnd,shoba_sno FROM stddarjaat ORDER BY darja ASC";
	if($crud->search($sql)){ $counter = 0;
		foreach($crud->getRecordSet($sql) as $row){ $counter +=1;
			?>
            <tr>
            	<td> <?php echo($counter); ?> </td>
                <td> <?php echo($crud->getValue("SELECT shoba FROM shobajaat WHERE sno = ".$row['shoba_sno'],"shoba")); ?> </td>
                <td> <?php echo($crud->getValue("SELECT darja FROM darjaat WHERE derjaCode = ".$row['darja'],"darja")); ?> </td>
                <td> <?php echo($row['promotionDate']); ?> </td>
                <td> <?php echo($row['dateEnd']); ?> </td>
            </tr>
            <?php
			}//foreach()
		}//search()
	 ?>
</table>
</div>
</center>
</body>
</html>
<?php ob_flush(); ?>