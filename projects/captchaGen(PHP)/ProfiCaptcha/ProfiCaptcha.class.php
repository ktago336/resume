<?php

class ProfiCaptcha
{
	
	private $ImageBgDir;
	private $Code;
	private $Alphabet; 
	private $FontsDir;
	private $Length;
	private $Correction;
	

	public function __construct($alphabet, $imageBgDir = 'backgroungs/', $fontsDir = 'fonts/', $length = 5, array $correction = array())
	{
		$this->Code = '';
		$this->Alphabet = $alphabet;
		$this->ImageBgDir = $imageBgDir;
		$this->Length = $length;
		$this->FontsDir = $fontsDir;
		$this->Correction = $correction;
	}
	
	/**
	 * Ãåíåðèðóåì ðàíäîìíîå ÷èñëî
	 * Random number generation
	 */
	public function Generate()
	{
		$this->Code = '';
		for ( $i=0; $i < $this->Length; $i++ )
			$this->Code .= substr($this->Alphabet, rand(0, strlen($this->Alphabet)-1), 1);
	}
	
	/**
	 * Ïîëó÷èòü ñãåíåðèðîâàííîå êîä â âèäå ñòðîêè
	 * Get the generated code as string
	 *
	 * @return string
	 */
	public function GetGeneratedCode()
	{
		return $this->Code;
	}
	
	/**
	 * Ñîçäàòü èçîáðàæåíèå è îòïðàâèòü åãî â áðàóçåð
	 * Create the picture and send it to browser
	 */
	public function PrintPicture($width=null,$height=null, $path=null)
	{

		echo"BAR\n";

		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));
		if ( !is_null($width) && !is_null($height) )
			$image = $this->CreateEmptyImage($width, $height);
		else
			$image = $this->CreateImageFromBg();
		
		// { fonts
		if ( !is_dir($this->FontsDir) )
			throw new Exception('Fonts directory does not exists', 1);
		
		$fontsFiles = array();
		$dh = opendir($this->FontsDir);
		while ( false !== ($filename = readdir($dh)) )
		    if ( substr($filename, 0, 1) != '.' )
				$fontsFiles[] = strtoupper($filename);
		
		if ( count($fontsFiles) < 1 )
			throw new Exception('Fonts directory is empty', 2);
		// } fonts
		
		// { Define coords & sizes
		$w = imagesx($image);
		$h = imagesy($image);
		$crd = array();
		$crd['x_start'] = ceil($w/10);
		$crd['y_start'] = ceil(10+$h/3);
		$crd['x_step'] = ceil(($w-$w/8)/$this->Length);
		$crd['x_rand'] = ceil($w/30);
		$crd['y_rand'] = ceil($h/10);
		$crd['size_from'] = ceil($crd['x_step']-$w/25);
		$crd['size_to'] = ceil($crd['x_step']-$w/17);
		// } Define coords & sizes
		
		// New image for symbols, used if waves enabled
		if ( ProfiCaptchaOptions::WAVES )
		{
			$image2 = imagecreatetruecolor($w, $h);
			imagefilledrectangle($image2, 0, 0, $w, $h, imagecolorallocate($image, 255, 255, 255));
		}
		else
			$image2 = $image;
		
		// symbols draw circle
		for ( $i=0; $i < $this->Length; $i++ )
		{
			$symbol = $this->Code[$i];
			$size = rand($crd['size_from'], $crd['size_to']);
			$angle = rand(ProfiCaptchaOptions::$AngleLimits['from'], ProfiCaptchaOptions::$AngleLimits['to']);
			
			$randomFontFileName = $fontsFiles[rand(0, count($fontsFiles)-1)];
			$randomFont = $this->FontsDir . $randomFontFileName;
			
			$r = (string) rand(50, 150);
			$g = (string) rand(50, 150);
			$b = (string) rand(50, 150);
			
			// make the symbols visible on background (always light background, dark foreground)
			if ( $r > 120 && $g > 120 && $b > 120 )
			{
				$r -= 30;
				$g -= 10;
				$b -= 38;
			}
			
			// correct "bad font symbols" by setting other font
			if ( isset($this->Correction[$randomFontFileName]) &&
				isset($this->Correction[$randomFontFileName][$symbol]) &&
				file_exists($this->FontsDir . $this->Correction[$randomFontFileName][$symbol])
			)
				$randomFont = $this->FontsDir . $this->Correction[$randomFontFileName][$symbol];
			
			$color = imagecolorallocate($image2, $r, $g, $b);
			// write a symbol
			imagettftext($image2, $size, $angle,
				$crd['x_start']+$crd['x_step']*$i+rand(0, $crd['x_rand']),
				$crd['y_start']+$h/10+rand(0, $crd['y_rand']),
				$color, $randomFont, $symbol
			);
		
		}
		
		if ( ProfiCaptchaOptions::WAVES )
		{
			$image3 = imagecreatetruecolor($w, $h);
			imagefilledrectangle($image3, 0, 0, $w, $h, imagecolorallocate($image3, 255, 255, 255));
			// random parameters:
			// frequency
			$rand1 = mt_rand(800000, 900000) / 15000000;
			$rand2 = mt_rand(800000, 900000) / 15000000;
			$rand3 = mt_rand(800000, 900000) / 15000000;
			$rand4 = mt_rand(800000, 900000) / 15000000;
			// phase
			$rand5 = mt_rand(0, 2141592) / 1000000;
			$rand6 = mt_rand(0, 2141592) / 1000000;
			$rand7 = mt_rand(0, 2141592) / 1000000;
			$rand8 = mt_rand(0, 2141592) / 1000000;
			// amplitude
			$rand9 = mt_rand(300, 400) / 100;
			$rand10 = mt_rand(300, 400) / 100;
	 
			for($x = 0; $x < $w; $x++)
			{
				for($y = 0; $y < $h; $y++)
				{
					// coordinates of prototype pixel.
					$sx = $x + ( sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6) ) * $rand9;
					$sy = $y + ( sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8) ) * $rand10;
					
					// if prototype out of image size
					if($sx < 0 || $sy < 0 || $sx >= $w - 1 || $sy >= $h - 1)
						$newcolor = 255;
					else // color of prototype
						$newcolor = imagecolorat($image2, $sx, $sy);
					
					// draw the pixel to new canvas
					if ((($newcolor >> 0) & 0xFF) < 230 && (($newcolor >> 8) & 0xFF) < 230 && (($newcolor >> 16) & 0xFF) < 230 )
						imagesetpixel($image, $x, $y, imagecolorallocate($image, ($newcolor >> 16) & 0xFF, ($newcolor >> 8) & 0xFF, ($newcolor >> 0) & 0xFF));
				}
			}
		}
		
		if ( ProfiCaptchaOptions::DRAW_NOISE == true )
		{
			$colors = array();
			for ( $i=0; $i < 2*ProfiCaptchaOptions::DRAW_NOISE_POWER; $i++)
				$colors[] = imagecolorallocate($image, rand(100,220), rand(100,220), rand(100,220));
			for ( $i=0; $i < 8*ProfiCaptchaOptions::DRAW_NOISE_POWER; $i++ )
			{
				$x=rand(0, $w);
				$y=rand(0, $h);
				imageline($image, $x, $y, $x+rand(-5,5),$y+rand(-5,5), $colors[array_rand($colors)]);
				$x=rand(0, $w);
				$y=rand(0, $h);			
				imageline($image, $x, $y, $x+rand(-5,5),$y+rand(-5,5), $colors[array_rand($colors)]);
			}
			
			for ( $i=0; $i < 20*ProfiCaptchaOptions::DRAW_NOISE_POWER; $i++ )
			{
				$px = rand(2, $w-2);
				$py = rand(2, $h-2);
				//imagesetpixel($image, $px, $py, array_rand($colors));
				//imagesetpixel($image, $px, $py, array_rand($colors));
				$pcolor2 = imagecolorat($image, ($px2 = ($px+rand(0,1)*2-1)), ($py2 = ($py+rand(0,1)*2-1)));
				$pcolor = imagecolorat($image, $px, $py);
				imagesetpixel($image, $px, $py, $pcolor2);
				imagesetpixel($image, $px2, $py2, $pcolor);
			}
		}
		
		if ( ProfiCaptchaOptions::BLUR == true )
		{
			//imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
			if ( !function_exists('imageconvolution') )
				require_once('imageconvolution.function.php');
			$gaussian = array(array(1.0, 2.0, 1.0), array(2.0, 4.0, 2.0), array(1.0, 2.0, 1.0));
			imageconvolution($image, $gaussian, 14, 0);
		}

		//Header("Content-type: image/png");
		// create and output the image
		imagePng($image, '/py/python_bot/captchaGen/ProfiCaptcha/'.$path.'.png');
		// clear mwmory
		//imageDestroy($image);
	}
	
	/**
	 * Ñîçäàåò ðåñóðñ èçîáðàæåíèÿ è ãåíåðèðóåò ñëó÷àéíûé ôîí
	 * Creates image resource and generates random background
	 */
	private function CreateEmptyImage($w, $h)
	{
		$image = imagecreatetruecolor($w, $h);
		imagefilledrectangle($image, 0, 0, $w, $h, imagecolorallocate($image, 255, 255, 255));
		$colors = array();
		for ( $i=0; $i<30; $i++ )
			$colors[] = imagecolorallocate($image, rand(150,240), rand(150,245), rand(180,235));
		for ( $i=0; $i<80; $i++ )
			rand(0,1) ?
			imagefilledellipse($image, $tw=rand(0,$w), $th=rand(0,$h), rand(10,50), rand(10,50), $colors[array_rand($colors)]):
			imagefilledrectangle($image, $tw=rand(0,$w), $th=rand(0,$h), $tw+rand(5,30), $th+rand(5,30), $colors[array_rand($colors)]);
		return $image;
	}
	
	/**
	 * Ñîçäàåò ðåñóðñ èçîáðàæåíèÿ ñ ôîíîì èç ãîòîâîé êàðòèíêè
	 * Creates image resource with prepared picture background
	 */
	private function CreateImageFromBg()
	{
		if ( !is_dir($this->ImageBgDir) )
			throw new Exception('Background directory does not exists', 1);
		
		$bgFiles = array();
		$dh  = opendir($this->ImageBgDir);
		while ( false !== ($filename = readdir($dh)) )
		    if ( $filename != '.' && $filename != '..' )
				$bgFiles[] = $filename;
		
		if ( count($bgFiles) < 1 )
			throw new Exception('Background directory is empty', 1);
		
		$randomBackground = $this->ImageBgDir . $bgFiles[rand(0, count($bgFiles)-1)];
		$ext = substr($randomBackground, strrpos($randomBackground, '.')+1);
		$image = null;
		switch ( $ext )
		{
			case 'gif':
				$image = imagecreatefromgif($randomBackground);
				break;
			case 'jpeg':
			case 'jpg':
				$image = imagecreatefromjpeg($randomBackground);
				break;
			case 'png':
			default:
				$image = imagecreatefrompng($randomBackground);
		}
		
		return $image;
	}
	
}

echo "string\n";
if (imagetypes() & IMG_PNG) {
    print "PNG Support is enabled\n";
}

require_once('Settings.php');
$img=new ProfiCaptcha(
	ProfiCaptchaOptions::$Alphabet,
	ProfiCaptchaOptions::BACKGROUNDS_PATH,
	ProfiCaptchaOptions::FONTS_PATH,
	ProfiCaptchaOptions::SYMBOLS_COUNT,
	ProfiCaptchaOptions::$Correction
);





?>