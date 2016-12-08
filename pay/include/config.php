<?php

	//DATABASE
	$db_name='parpero1_ibnSinaPay';
	$db_user='parpero1_sina';
	$db_pass='7f@rvardin';
	
	$cn=mysql_connect('localhost',$db_user,$db_pass);
	
	if ($cn){
		mysql_select_db($db_name,$cn);
		mysql_query("SET NAMES utf8;");
		error_reporting ( E_ALL & ~E_NOTICE );
		//error_reporting ( 0 );
	}else{
		echo "Problem In Connection TO DATABASE";
	}

	
?>