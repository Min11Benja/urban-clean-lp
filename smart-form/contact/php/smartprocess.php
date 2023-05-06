<?php 

	if (!isset($_SESSION)) session_start(); 
	if(!$_POST) exit;
	
	include dirname(__FILE__).'/settings/settings.php';
	include dirname(__FILE__).'/functions/emailValidation.php';
	
	
	/* Current Date Year
	------------------------------- */		
	$currYear = date("Y");		
	
/*	---------------------------------------------------------------------------
	: Register all form field variables here
	--------------------------------------------------------------------------- */
	$sendername = strip_tags(trim($_POST["sendername"]));	
	$emailaddress = strip_tags(trim($_POST["emailaddress"]));
	$senderservice = strip_tags(trim($_POST["sendersubject"]));
    $sendercp = strip_tags(trim($_POST["cp"]));
	$sendermessage = strip_tags(trim($_POST["sendermessage"]));
    
//    $captcha = strtoupper(strip_tags(trim($_POST["captcha"])));
	
/*	----------------------------------------------------------------------
	: Prepare form field variables for CSV export
	----------------------------------------------------------------------- */	
	if($generateCSV == true){
		$csvFile = $csvFileName;	
		$csvData = array(
			"$sendername",
			"$emailaddress",
			"$sendersubject",
            "$sendercp"
		);
	}

/*	-------------------------------------------------------------------------
	: Prepare serverside validation 
	------------------------------------------------------------------------- */ 
	$errors = array();
	 //validate name
	if(isset($_POST["sendername"])){
	 
			if (!$sendername) {
				$errors[] = "Debe introducir nombre.";
			} elseif(strlen($sendername) < 2)  {
				$errors[] = "Nombre de al menos 2 letras.";
			}
	 
	}
	//validate email address
	if(isset($_POST["emailaddress"])){
		if (!$emailaddress) {
			$errors[] = "Debe Introducir correo.";
		} else if (!validEmail($emailaddress)) {
			$errors[] = "Debe ser un correo valido.";
		}
	}
	
	//validate subject
	if(isset($_POST["sendersubject"])){
			if (!$sendersubject) {
				$errors[] = "Debe escojer un Servicio.";
			} 
	}
		//validate cp
	if(isset($_POST["cp"])){
			if (!$sendercp) {
				$errors[] = "Debe introducir un Codigo Postal.";
			} 
	}
	//validate message / comment
	if(isset($_POST["sendermessage"])){
		if (strlen($sendermessage) < 5) {
			if (!$sendermessage) {
				$errors[] = "Debe introducir un mensaje.";
			} else {
				$errors[] = "El mensaje debe de tener unos 5 caracteres como minimo.";
			}
		}
	}
	
////	 validate security captcha 
//	if(isset($_POST["captcha"])){
//		if (!$captcha) {
//			$errors[] = "Debe introduzir el código captcha";
//		} else if (($captcha) != $_SESSION['gfm_captcha']) {
//			$errors[] = "Código incorecto!";
//		}
//	}
	
	if ($errors) {
		//Output errors in a list
		$errortext = "";
		foreach ($errors as $error) {
			$errortext .= '<li>'. $error . "</li>";
		}
	
		echo '<div class="alert notification alert-error">Los siguientes errores:<br><ul>'. $errortext .'</ul></div>';
	
	} else{
	
		include dirname(__FILE__).'/phpmailer/PHPMailerAutoload.php';
		include dirname(__FILE__).'/templates/smartmessage.php';
			
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->setFrom($emailaddress,$sendername);
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "base64";
		$mail->Timeout = 200;
		$mail->ContentType = "text/html";
		$mail->addAddress($receiver_email, $receiver_name);
		$mail->Subject = $receiver_subject;
		$mail->Body = $message;
		$mail->AltBody = "Use an HTML compatible email client";
				
		// For multiple email recepients from the form 
		// Simply change recepients from false to true
		// Then enter the recipients email addresses
		// echo $message;
		$recipients = false;
		if($recipients == true){
			$recipients = array(
				"address@example.com" => "Recipient Name",
				"address@example.com" => "Recipient Name"
			);
			
			foreach($recipients as $email => $name){
				$mail->AddBCC($email, $name);
			}	
		}
		
		if($mail->Send()) {
			/*	-----------------------------------------------------------------
				: Generate the CSV file and post values if its true
				----------------------------------------------------------------- */		
				if($generateCSV == true){	
					if (file_exists($csvFile)) {
						$csvFileData = fopen($csvFile, 'a');
						fputcsv($csvFileData, $csvData );
					} else {
						$csvFileData = fopen($csvFile, 'a'); 
						$headerRowFields = array(
							"Nombre",
							"Correo",
							"Servicio", 
                            "Codigo Postal"
						);
						fputcsv($csvFileData,$headerRowFields);
						fputcsv($csvFileData, $csvData );
					}
					fclose($csvFileData);
				}	
				
			/*	---------------------------------------------------------------------
				: Send the auto responder message if its true
				--------------------------------------------------------------------- */
				if($autoResponder == true){
				
					include dirname(__FILE__).'/templates/autoresponder.php';
					
					$automail = new PHPMailer();
					$automail->setFrom($receiver_email,$receiver_name);
					$automail->isHTML(true);                                 
					$automail->CharSet = "UTF-8";
					$automail->Encoding = "base64";
					$automail->Timeout = 200;
					$automail->ContentType = "text/html";
					$automail->AddAddress($emailaddress, $sendername);
					$automail->Subject = "Gracias por ponerte en contacto con nosotros!";
					$automail->Body = $automessage;
					$automail->AltBody = "Use un correo compatible con HTML.";
					$automail->Send();	 
				}
				
				if($redirectForm == true){
					echo '<script>setTimeout(function () { window.location.replace("'.$redirectForm_url.'") }, 8000); </script>';
				}
							
			  	echo '<div class="alert notification alert-success">Mensaje enviado con exito!</div>';
				} 
				else {
				  echo '<div class="alert notification alert-error">Mensaje no enviado - error en el servidor!</div>';	
				}
	}
?>
