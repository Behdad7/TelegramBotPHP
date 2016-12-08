<?php

	//DATABASE
	$db_name='d8uafk8v93apgk';
	$db_user='uibgrlfkadyofb';
	$db_pass='o9pdrpe_9PDkjUZigoNsuPfc7e';
	
	$cn=mysql_connect('ec2-107-21-248-129.compute-1.amazonaws.com',$db_user,$db_pass);
	
	if ($cn){
		mysql_select_db($db_name,$cn);
		mysql_query("SET NAMES utf8;");
		error_reporting ( E_ALL & ~E_NOTICE );
		//error_reporting ( 0 );
	}else{
		echo "Problem In Connection TO DATABASE";
	}

	
?>