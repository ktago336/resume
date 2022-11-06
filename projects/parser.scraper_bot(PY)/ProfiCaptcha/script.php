<?php

include(ProfiCaptchaOptions::CLASS_FILE_PATH.'ProfiCaptcha.class.php');

for ($i=0; $i < 500; $i++) { 
	$img->Generate();
	$img->PrintPicture(22,35, '0/'.$i);
}

?>