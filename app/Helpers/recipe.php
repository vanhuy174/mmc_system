<?php

if (! function_exists('test')) {
    function tinhsotiet($lt, $th)
    {
    	$sotietlythuyet = 15;
    	$sotietlythuchanh = 30;

        return (($lt*$sotietlythuyet) + ($th*$sotietlythuchanh));
    }
}
