<?php
/* >_ Developed by Vy Nghĩa */

//default config
define('PAGEID', '1651406645106961');
define('WEBURL', 'http://360anime.xyz');

//mysql info
$dbhost = 'https://databases.000webhost.com';
$dbuser = 'id2101149_pagebyds';
$dbpass = '01684657540';
$dbname = 'id2101149_pagebyds';

//Facebook App
$FacebookAppID = '496298947402103';
$FacebookAppSecret = 'bf1ba70e89143328288972a5b02ee58b';

//Google Api
$GoogleApiKey = 'AIzaSyBYFTbEl-YiR_7NSfS4mOXRjiaNgUeG4qY';

//connect mysql
$con = @mysql_connect($dbhost, $dbuser, $dbpass);
@mysql_select_db($dbname, $con);
