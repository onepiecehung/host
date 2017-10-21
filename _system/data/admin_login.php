<?php
/* Developed by Vy Nghia */
session_start();
require '../config.php';

if(isset($_POST['user']) && isset($_POST['pass'])){
	$checkUser = mysql_query("SELECT * FROM `manager` WHERE `username` = '{$_POST['user']}'");
	if(mysql_fetch_array($checkUser) === false){
		echo (2);
		} else {
		$checkUserPass = mysql_query("SELECT * FROM `manager` WHERE `username` = '{$_POST['user']}' AND `password` = '{$_POST['pass']}'");
		if(mysql_fetch_array($checkUserPass) === false){
			echo (3);
		} else {
			echo (1);
			$_SESSION['admin'] = $_POST['user'];
		}
	}
}
