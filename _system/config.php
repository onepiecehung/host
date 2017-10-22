<?php
/* >_ Developed by Vy Nghĩa */

//default config
define('PAGEID', '1651406645106961');
define('WEBURL', 'https://webhost360anime.herokuapp.com/');

//mysql info
$dbhost = 'sql11.freemysqlhosting.net';
$dbuser = 'sql11200726';
$dbpass = 'KgMr6PFwrW';
$dbname = 'sql11200726';

//Facebook App
$FacebookAppID = '287870548384316';
$FacebookAppSecret = 'd7d376c694997280792554f9ab3ccd6f';

//Google Api
$GoogleApiKey = 'AIzaSyBYFTbEl-YiR_7NSfS4mOXRjiaNgUeG4qY';

//connect mysql
$con = @mysql_connect($dbhost, $dbuser, $dbpass);
@mysql_select_db($dbname, $con);
