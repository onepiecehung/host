<?php
/* Developed by Vy Nghia */
session_start();
require_once '../config.php';
require_once '../encode/PseudoCrypt.php';

switch ($_GET['action']) {
	case 'create':
		if(isset($_SESSION['admin']) && isset($_SESSION['facebook_access_token'])){
			if(isset($_POST['link'])){

			function userID($Token){
				$ProfileApi = 'https://graph.facebook.com/me?access_token='.$Token;
				$user = json_decode(file_get_contents($ProfileApi, true));
				return $user->id;
			}

			$EncodeLink = PseudoCrypt::hash(time(), 10);
			$LockedLink = WEBURL.'/x/'.$EncodeLink;
			$HashLink = '#protect@'.$EncodeLink.'@';

			$longUrl = $LockedLink;
			$apiKey  = $GoogleApiKey;

			$postData = array('longUrl' => $longUrl);
			$jsonData = json_encode($postData);

			$curlObj = curl_init();

			curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
			curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlObj, CURLOPT_HEADER, 0);
			curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
			curl_setopt($curlObj, CURLOPT_POST, 1);
			curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

			$reply = curl_exec($curlObj);

			$json = json_decode($reply);

			curl_close($curlObj);

			if(isset($json->error)){
			echo $json->error->message;
			}else{
				$GoogleShortUrl = $json->id;
			}

			mysql_query("INSERT INTO `link`(`id`, `FBID`, `PostID`, `Hash`, `Password`, `Url`, `SUrl`, `Time`) VALUES ('', '".userID($_SESSION['facebook_access_token'])."', '', '$EncodeLink', '{$_POST['pass']}', '{$_POST['link']}', '$GoogleShortUrl', '".date("Y-m-d H:i:s")."')");
			}
		}
		break;

		case 'delete':
		if(isset($_POST['id'])){
			mysql_query("DELETE FROM `link` WHERE `id` = '{$_POST['id']}'");
		}
		break;
}

?>
<div class="alert alert-info" style="color:blue" role="alert">
<strong>*Lưu ý:</strong><br>
- Khi post bài trong Group bạn phải kèm theo <span class="label label-danger">Hash của bài viết</span> Có thể để ở bất cứ đâu trong bài viết để tool có thể tự cập nhật link bài viết cho bạn.<br>
- Nếu link của bài viết không tự cập nhật. Bạn vui lòng vào mục <a href="catnhat.html" <span="" class="label label-danger">Cập nhật link</a>
- Nếu link bài viết không được cập nhật thì ngoài chức năng khóa mật khẩu các chức năng khác sẽ không hoạt động.
</div>
<strong>Link khóa &amp; Hash của bài viết:</strong>
<br/>
<div class="input-group">
<input id="linktonghop" class="form-control" value="<?php echo $GoogleShortUrl.' | '.$HashLink; ?> " style="width: 100%"><br>
<span class="input-group-btn">
<button id="copyLink" type="button" class="btn btn-info btn-fill" data-clipboard-target="#linktonghop">Copy</button>
</span>
</div>
