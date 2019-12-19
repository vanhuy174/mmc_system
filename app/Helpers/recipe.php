<?php

if (! function_exists('test')) {
    function tinhsotiet($lt, $th)
    {
    	$sotietlythuyet = 15;
    	$sotietlythuchanh = 30;

        return (($lt*$sotietlythuyet) + ($th*$sotietlythuchanh));
    }

    function tinhdiemTB($mmc_theory, $mmc_practice, $point_ratio, $diligentpoint, $point1, $point2, $point3, $point4, $testscore)
    {
    	if(strlen($testscore) != 0 && strlen($mmc_theory) != 0 && strlen($mmc_practice) != 0 && strlen($point_ratio) != 0){
	    	$mmc_theory = is_numeric($mmc_theory) ? $mmc_theory : 0;
	    	$mmc_practice = is_numeric($mmc_practice) ? $mmc_practice : 0;
	    	$point_ratio = is_numeric($point_ratio) ? $point_ratio : 0;
	    	$diligentpoint = is_numeric((float)$diligentpoint) ? (float)$diligentpoint : 0;
	    	$point1 = is_numeric((float)$point1) ? (float)$point1 : 0;
	    	$point2 = is_numeric((float)$point2) ? (float)$point2 : 0;
	    	$point3 = is_numeric((float)$point3) ? (float)$point3 : 0;
	    	$point4 = is_numeric((float)$point4) ? (float)$point4 : 0;
	    	$testscore = is_numeric((float)$testscore) ? (float)$testscore : 0;

	    	$tinchi= $mmc_theory + $mmc_practice;
	    	$cc= ($diligentpoint + $point1 + $point2 + $point3 + (float)$point4) / $tinchi;
		    $cc= number_format((float)$cc, 1, '.', '');
		    $hp= $cc*($point_ratio/10);
		    $thi= $testscore * ((10 - $point_ratio) / 10);
		    $tongket= $hp + $thi;
            $tongket= number_format((float)$tongket, 1, '.', '');
		    return $tongket;
    	}else{
    		return "";
    	}
    }
}
