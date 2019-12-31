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
    function tinhhocluc($point){
        if($point < 2.0){
            return 'yeu';
        }elseif ($point >= 2.0 && $point < 2.5 ){
            return 'tb';
        }elseif ($point >= 2.5 && $point < 3.2 ){
            return 'kha';
        }elseif ($point >= 3.2 && $point < 3.6 ){
            return 'gioi';
        }else{
            return 'xs';
        }
    }
    function hocluc($point){
        if($point < 2.0){
            return 'Yếu';
        }elseif ($point >= 2.0 && $point < 2.5 ){
            return 'Trung bình';
        }elseif ($point >= 2.5 && $point < 3.2 ){
            return 'Khá';
        }elseif ($point >= 3.2 && $point < 3.6 ){
            return 'Giỏi';
        }else{
            return 'Xuất sắc';
        }
    }
    function semester(){
        $date= date("Y");
        $i=0; $j=0; $semester= [];
        while($i<10){
            $semester[$i]= "".($date-$j)."_".(($date+1)-$j)."_2";
            $semester[$i+1]= "".($date-$j)."_".(($date+1)-$j)."_1";
            $i= $i + 2;
            $j++;
        }
        return $semester;
    }
    function diemhockyhs4($mmc_studentid, $semester){
        $tongtinchi= 0;
        $diem= 0;
        $point= \App\mmc_studentpoint::where('mmc_studentid', '=', $mmc_studentid)->get();
        foreach ($point as $key){
            if (count($key->subjectclass)>0)
            if ($key->subjectclass[0]->mmc_semester == $semester){
                $tinchi = ($key->subject->mmc_theory + $key->subject->mmc_practice);
                $tongtinchi += $tinchi;
                $diem += ($key->mmc_4grade * $tinchi);
            }
        }
        if($tongtinchi != 0 && $diem !=0){
            $hs4= number_format((float)($diem/$tongtinchi), 1, '.', '');
        }else{
            $hs4="";
        }
        return $hs4;
    }
    function diemhockyhs10($mmc_studentid, $semester){
        $tongtinchi= 0;
        $diem= 0;
        $point= \App\mmc_studentpoint::where('mmc_studentid', '=', $mmc_studentid)->get();
        foreach ($point as $key){
            if (count($key->subjectclass)>0)
            if ($key->subjectclass[0]->mmc_semester == $semester){
                $tinchi = ($key->subject->mmc_theory + $key->subject->mmc_practice);
                $tongtinchi += $tinchi;
                $diem += ($key->mmc_10grade * $tinchi);
            }
        }
        if($tongtinchi != 0 && $diem !=0){
            $hs10= number_format((float)($diem/$tongtinchi), 1, '.', '');
        }else{
            $hs10="";
        }
        return $hs10;
    }

}
