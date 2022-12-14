<?php

/* http://www.php.net/manual/ru/function.imageconvolution.php */

if ( !function_exists('imageconvolution') )
{
	function imageconvolution($src, $filter, $filter_div, $offset)
	{
	    if ($src==NULL) {
	        return 0;
	    }
	    
	    $sx = imagesx($src);
	    $sy = imagesy($src);
	    $srcback = ImageCreateTrueColor ($sx, $sy);
	    ImageCopy($srcback, $src,0,0,0,0,$sx,$sy);
	    
	    if($srcback==NULL){
	        return 0;
	    }
	        
	    #FIX HERE
	    #$pxl array was the problem so simply set it with very low values
	    $pxl = array(1,1);
	    #this little fix worked for me as the undefined array threw out errors
	
	    for ($y=0; $y<$sy; ++$y){
	        for($x=0; $x<$sx; ++$x){
	            $new_r = $new_g = $new_b = 0;
	            $alpha = imagecolorat($srcback, $pxl[0], $pxl[1]);
	            $new_a = $alpha >> 24;
	            
	            for ($j=0; $j<3; ++$j) {
	                $yv = min(max($y - 1 + $j, 0), $sy - 1);
	                for ($i=0; $i<3; ++$i) {
	                        $pxl = array(min(max($x - 1 + $i, 0), $sx - 1), $yv);
	                    $rgb = imagecolorat($srcback, $pxl[0], $pxl[1]);
	                    $new_r += (($rgb >> 16) & 0xFF) * $filter[$j][$i];
	                    $new_g += (($rgb >> 8) & 0xFF) * $filter[$j][$i];
	                    $new_b += ($rgb & 0xFF) * $filter[$j][$i];
	                }
	            }
	
	            $new_r = ($new_r/$filter_div)+$offset;
	            $new_g = ($new_g/$filter_div)+$offset;
	            $new_b = ($new_b/$filter_div)+$offset;
	
	            $new_r = ($new_r > 255)? 255 : (($new_r < 0)? 0:$new_r);
	            $new_g = ($new_g > 255)? 255 : (($new_g < 0)? 0:$new_g);
	            $new_b = ($new_b > 255)? 255 : (($new_b < 0)? 0:$new_b);
	
	            $new_pxl = ImageColorAllocateAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
	            if ($new_pxl == -1) {
	                $new_pxl = ImageColorClosestAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
	            }
	            if (($y >= 0) && ($y < $sy)) {
	                imagesetpixel($src, $x, $y, $new_pxl);
	            }
	        }
	    }
	    imagedestroy($srcback);
	    return 1;
	}
}

?>