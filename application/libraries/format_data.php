<?php if(!defined('BASEPATH'))exit('No direct script access allowed');

class format_data {
	function string($huruf)
	{
     	$ok = mysql_real_escape_string(stripslashes($huruf));
    	return $ok;
	}
	function textarea($huruf)
	{
     	$ok = trim(stripslashes($huruf));
    	return $ok;
	}
	function angka($angka)
	{
	    $jadi = number_format($angka , 0 , "" , '');
	    return $jadi;
	}
}



 