<?php
require_once('../classes/classes.php');
$crud = new CRUD();
session_start();
$sno = "";
$sqlUpdate = "";
$flag = false;
$oldImage = "";
$imgPathToDelOr = "";
$imgPathToDelTh = "";
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
	if(isset($_REQUEST['sno']) && !empty($_REQUEST['sno'])){
		$sno = $_REQUEST['sno'];
		$oldImage = $crud->getValue("SELECT stdPhoto FROM registrationinfo WHERE sno=".$sno,"stdPhoto");
		$imgPathToDelOr = "../takephoto/uploads/original/".$oldImage;
		$imgPathToDelTh = "../takephoto/uploads/thumbs/".$oldImage;				 
		if(isset($_FILES['photoBrowser']['name']) && !empty($_FILES['photoBrowser']['name'])){
		$imge = $_FILES["photoBrowser"]["name"];
		$type = $_FILES["photoBrowser"]["type"];
		$filename = stripslashes($imge);
				$ext = getExtension($filename);
				$ext = strtolower($ext);
				$newImg = md5(rand().'_'.$imge);
				$newImg .= '.'.$ext;
		//if ($type == "image/gif" || $type == "image/jpeg" || $type == "image/pjpeg" || $type == "image/png"){		 
		if (($ext == "jpg") || ($ext == "jpeg") || ($ext == "png") || ($ext == "gif")){
				if(move_uploaded_file($_FILES["photoBrowser"]["tmp_name"],"../takephoto/uploads/original/" . $newImg)){
					copy("../takephoto/uploads/original/".$newImg, "../takephoto/uploads/thumbs/" . $newImg);
					//delete the old file associated with this record (sno)
					$sqlUpdate = "UPDATE registrationinfo SET stdPhoto = 'uploads/original/".$newImg."' WHERE sno = ".$sno;
					$flag = $crud->update($sqlUpdate);
					//delete the photo file from the folder (takephoto\uploads\original && takephoto\uploads\thumbs)
					if(file_exists($imgPathToDelOr)){
						unlink($imgPathToDelOr);
						}
					if(file_exists($imgPathToDelTh)){
						unlink($imgPathToDelTh);
						}
					header("Location: ../pages/changeStdPhoto.php?sno=".$sno."&flag=".$flag);
					}
		  }
		}
		}//end if for non-empty sno request field
 ?>