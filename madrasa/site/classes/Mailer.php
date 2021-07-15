<?php 
class Communicator{	
	//phpmailer var to send emails
	private $host="smtp.gmail.com";
	private $userName="md1@gmail.com";
        private $robots = array(
                                    'md0@gmail.com',
                                    'md1@gmail.com',
                                    'md2@gmail.com',
                                    'md3@gmail.com',
                                    'md4@gmail.com',
                                    'md5@gmail.com'
                                    );
	private $password="password_for_the_above_emails";
	public $replyTo="thefire305@gmail.com";
	var $tempVar;
        public $from_email = 'thefire305@gmail.com';
        public $from_name = 'Madrasa Management System';
        public $charSet = "CharSet = 'UTF-8'";
        public $charSetOpt = 0;
	//function to send email simple and with attachements
	public function sendEmail($to,$from,$sender_name="",$subject,$body,$attachement_path="",$cc="",$bcc=""){ 
			require("PHPMailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();            // set mailer to use SMTP i.e. smtp1.example.com;smtp2.example.com
			$mail->Host = $this->host;  // specify main and backup server
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = $this->userName;  // SMTP username i.e email id of an email address
			$mail->Password = $this->password; // SMTP password for the specified email address			
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
                        if($this->charSetOpt != 0){
                           $mail->CharSet = $this->charSet;
                        }
			$mail->From = $from;
			$mail->FromName = $sender_name;
			$mail->addAddress($to);   //mail,name
			if(isset($cc) && !empty($cc)){
				$mail->addBCC($bcc);
				}
			if(isset($cc) && !empty($cc)){
				$mail->addCC($cc);
				}
			//$mail->AddAddress("ellen@example.com");                  // name is optional
			$mail->addReplyTo($this->replyTo);//to, name			
			$mail->WordWrap = 50; 
			if(isset($attachement_path) && !empty($attachement_path)){                                // set word wrap to 50 characters
					$mail->AddAttachment($attachement_path);         // add attachments
					//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
					}
			$mail->isHTML(true);                                  // set email format to HTML			
			$mail->Subject = $subject;
			$mail->Body = $body;
			//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";			
			if(!$mail->send()){
				$this->tempVar = $mail->ErrorInfo;
			   return false;
				}
			else{
				return true;
				}
			}
        //for multiple recipients                
        public function sendEmails($to=array(),$from,$sender_name="",$subject,$body,$attachement_path="",$cc="",$bcc=""){ 
			//return $to;exit();
			require("PHPMailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();            // set mailer to use SMTP i.e. smtp1.example.com;smtp2.example.com
			$mail->Host = $this->host;  // specify main and backup server
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = $this->userName;  // SMTP username i.e email id of an email address
			$mail->Password = $this->password; // SMTP password for the specified email address
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
                        if($this->charSetOpt != 0){
                           $mail->CharSet = $this->charSet;
                        }
			$mail->From = $from;
			$mail->FromName = $sender_name;
			//$mail->addAddress($to[0]);   //mail,name
			foreach($to as $value){
				$mail->addAddress($value); 
				}
			if(isset($bcc) && !empty($bcc)){
				$mail->addBCC($bcc);
				}
			if(isset($cc) && !empty($cc)){
					$mail->addCC($cc);
				}
			//$mail->AddAddress("ellen@example.com");                  // name is optional
			$mail->addReplyTo($this->replyTo);//to, name			
			$mail->WordWrap = 50; 
			if(isset($attachement_path) && !empty($attachement_path)){                                // set word wrap to 50 characters
					$mail->AddAttachment($attachement_path);         // add attachments
					//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
					}
			$mail->isHTML(true);                                  // set email format to HTML			
			$mail->Subject = $subject;
			$mail->Body = $body;
			//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";			
			if(!$mail->send()){
				$this->tempVar = $mail->ErrorInfo;
			    return false;
				}
			else{
				return true;
				}
			}

                //for multiple/single recipient(s) and from random robots
           public function sendEmailRnd($to=array(),$sender_name="",$subject,$body,$attachement_path="",$cc="",$bcc=""){ 
			//return $to;exit();
            $sender_robot = $this->robots[array_rand($this->robots,1)];
			require("PHPMailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();            // set mailer to use SMTP i.e. smtp1.example.com;smtp2.example.com
			$mail->Host = $this->host;  // specify main and backup server
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = $sender_robot;  // SMTP username i.e email id of an email address
			$mail->Password = $this->password; // SMTP password for the specified email address
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
                        if($this->charSetOpt != 0){
                           $mail->CharSet = $this->charSet;
                        }
			$mail->From = $sender_robot;
			$mail->FromName = $sender_name;
			//$mail->addAddress($to[0]);   //mail,name
			foreach($to as $value){
				$mail->addAddress($value); 
				}
			if(isset($bcc) && !empty($bcc)){
				$mail->addBCC($bcc);
				}
			if(isset($cc) && !empty($cc)){
					$mail->addCC($cc);
				}
			//$mail->AddAddress("ellen@example.com");                  // name is optional
			$mail->addReplyTo($this->replyTo);//to, name			
			$mail->WordWrap = 50; 
			if(isset($attachement_path) && !empty($attachement_path)){                                // set word wrap to 50 characters
					$mail->AddAttachment($attachement_path);         // add attachments
					//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
					}
			$mail->isHTML(true);                                  // set email format to HTML			
			$mail->Subject = $subject;
			$mail->Body = $body;
			//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";			
			if(!$mail->send()){
				$this->tempVar = $mail->ErrorInfo;
                                return false;
				}
			else{
				return true;
                                $this->tempVar = $from;
				}
			}                       
		
	 
	}
?>
