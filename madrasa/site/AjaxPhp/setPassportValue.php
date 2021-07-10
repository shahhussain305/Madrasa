<?php
session_start();
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
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
      	if(move_uploaded_file($_FILES["photoBrowser"]["tmp_name"],"../takephoto/uploads/original/".$newImg)){
			copy("../takephoto/uploads/original/".$newImg, "../takephoto/uploads/thumbs/".$newImg);
 	  		$_SESSION['photo'] = 'uploads/original/'.$newImg;
 			header("Location: ../index.php?cmd=registrationForm");
			}
  }
}
?>