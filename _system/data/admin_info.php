<?php
if(mysql_error()){
  die('Không thể kết nối với máy chủ SQL, vui lòng cấu hình lại nó!');
}
if(isset($_SESSION['admin'])){
  $checkAdminUser = mysql_query("SELECT * FROM `manager` WHERE `username` = '{$_SESSION['admin']}'");
  if($checkAdminUser === false){
      throw new Exception(mysql_error($con));
  }
  while($ADMIN = mysql_fetch_array($checkAdminUser)){
  	$Name = $ADMIN['name'];
  }
}
