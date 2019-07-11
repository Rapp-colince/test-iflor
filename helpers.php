<?php

function d($var){
	$type = gettype($var);
	echo "\r\n";
	echo '('.$type.') ';
	if(in_array($type, array('boolean', 'integer', 'double', 'NULL', 'unknown type'))){
		var_dump($var);
	}else{
		echo "\r\n<pre>";
		print_r($var);
		echo "</pre>\r\n";
	}
}

function dd($var){
	d($var);
	die();
}
