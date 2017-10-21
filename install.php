<?php
/* Developed by Vy Nghiz */
session_start();
require '_system/config.php';
if(isset($_SESSION['install']) && isset($_POST['web']) && isset($_POST['page']) && isset($_POST['dbhost']) && isset($_POST['dbuser']) && isset($_POST['dbpass']) && isset($_POST['dbname'])){
  echo 'ok';
  $ConfigFile = fopen("_system/config.php", "w") or die("Không thể khởi tạo file này!");
  $ConfigContent = '<?php
/* >_ Developed by Vy Nghĩa */

//default config
define(\'PAGEID\', \''.$_POST['page'].'\');
define(\'WEBURL\', \''.$_POST['web'].'\');

//mysql info
$dbhost = \''.$_POST['dbhost'].'\';
$dbuser = \''.$_POST['dbuser'].'\';
$dbpass = \''.$_POST['dbpass'].'\';
$dbname = \''.$_POST['dbname'].'\';

//Facebook App
$FacebookAppID = \''.$_POST['FBAID'].'\';
$FacebookAppSecret = \''.$_POST['FBASecret'].'\';

//Google Api
$GoogleApiKey = \''.$_POST['GGKey'].'\';

//connect mysql
$con = @mysql_connect($dbhost, $dbuser, $dbpass);
@mysql_select_db($dbname, $con);
';
  fwrite($ConfigFile, $ConfigContent);
  fclose($ConfigFile);
  exit;
}

if(isset($_POST['password'])){
  $Password = 'Dung Ki Thi Gay'; //option password
  if($_POST['password'] == $Password){
    echo (01);
    $_SESSION['install'] = true;
    exit;
  } else {
    echo (02);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Link Protect</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap3/css/bootstrap.css?v=1.2" rel="stylesheet" />
<link href="assets/css/gsdk.css?v=1.2" rel="stylesheet" />
<link href="assets/css/styles.css" rel="stylesheet" />
<link href="assets/css/bttn.min.css?v=1.2" rel="stylesheet" />
<link href="css/css.css?v=1.5" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-wysihtml5.css"></link>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
</div><div class="container">
<div class="row">
</div>
<div class="panel panel-primary">
<div class="panel-heading">Cấu hình</div>
<div class="panel-body">
<div class="row">
  <?php if(mysql_error()): ?>
    <div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Chưa thể kết nối!</strong> Chưa thể kết nối với MySQL của bạn ....</div>
  <?php else: ?>
    <div class="alert alert-success"><strong><i class="fa fa-check" aria-hidden="true"></i> Đã kết nối!</strong> Đã kết nối với MySQL của bạn ....</div>
  <?php endif; ?>
  <?php if(isset($_SESSION['install'])): ?>
  <form class="form-horizontal" method="POST">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="2"><center>Các điều kiện về PHP</center></th>
      </tr>
      <tr>
        <th>Điều kiện</th>
        <th width="180px">Phiên bản</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Yêu cầu tối thiểu</td>
        <td>5.x.x</td>
      </tr>
      <tr>
        <td>Yêu cầu tiêu chuẩn</td>
        <td>5.6.x</td>
      </tr>
      <tr>
        <td>Phiên bản PHP trên server của bạn</td>
        <td><?php echo phpversion() ?> (<a href="php/version" target="_blank">Xem chi tiết</a>)</td>
      </tr>
    </tbody>
  </table>
  <h3>Định dạng cùng hệ thống</h3>
  <div class="form-group">
  <label for="title" class="col-sm-2 control-label">Website</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="web" name="web" placeholder="http://domain.com" value="<?php echo WEBURL ?>">
  <small>*Ghi tên miền bao gồm http:// ở cuối tên miền cũng có thể không để dấu / (VD: http://domain.com, http://domain.com/) </small>
  </div>
  </div>

  <div class="form-group">
  <label for="title" class="col-sm-2 control-label">Page ID</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="page" name="page" placeholder="http://domain.com" value="<?php echo PAGEID ?>">
  <small>*Chỉ hổ trợ ID của Page/Fanpage trên Facebook</small>
  </div>
  </div>

  <h3>Cơ sở dữ liệu (MySQL)</h3>
  <div class="form-group">
  <label for="title" class="col-sm-2 control-label">DB Host</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="dbhost" name="dbhost" placeholder="Default localhost" value="<?php echo $dbhost ?>">
  </div>
  </div>

  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">DB Username</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="dbuser" name="dbuser" placeholder="MySQL server username" value="<?php echo $dbuser ?>">
  </div>
  </div>

  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">DB Password</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="dbpass" name="dbpass" placeholder="MySQL server password" value="<?php echo $dbpass ?>">
  </div>
  </div>

  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">DB Name</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="dbname" name="dbname" placeholder="MySQL server databse name" value="<?php echo $dbname ?>">
  </div>
  </div>

  <h3>Dữ liệu tương tác Api</h3>
  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">Google Api Key</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="GGKey" name="GGkey" placeholder="Google Short URL Api Key" value="<?php echo $GoogleApiKey ?>">
  </div>
  </div>

  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">Facebook App ID</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="FBAID" name="FBAID" placeholder="Facebook App ID" value="<?php echo $FacebookAppID ?>">
  </div>
  </div>

  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">Facebook App Secret</label>
  <div class="col-sm-10">
  <input type="text" class="form-control" id="FBASecret" name="FBASecret" placeholder="Facebook App Secret" value="<?php echo $FacebookAppSecret ?>">
  </div>
  </div>
  <div class="col-xs-12" style="text-align: center;">
  <button id="install" type="button" class="btn btn-warning btn-fill">Cập nhật cấu hình</button>
  </div>
  </form>
<?php else: ?>
  <form class="form-horizontal" method="POST">
  <div class="form-group">
  <label for="description" class="col-sm-2 control-label">Mật khẩu truy cập</label>
  <div class="col-sm-10">
  <input type="password" class="form-control" id="PasswordAccess" name="PasswordAccess" placeholder="Mật khẩu truy cập File này" value="">
  </div>
  </div>
  <div class="col-xs-12" style="text-align: center;">
  <button id="login" type="button" class="btn btn-warning btn-fill">Truy Cập</button>
  </div>
  </form>
  <div id="loginStatus"></div>
<?php endif ?>
</div>
</div>
</div>
<footer class="footer" style="font-size:12px;">
<p style="font-size:13px;">&copy; <?php echo date('Y') ?> Vy Nghia</p>
</footer>
<div id="loading">
<img src="assets/img/load2.gif" /><br />
<strong>Loading...</strong>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="assets/js/gsdk-checkbox.js"></script>
<script src="assets/js/gsdk-radio.js"></script>
<script src="assets/js/gsdk-bootstrapswitch.js"></script>
<script src="assets/js/get-shit-done.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="assets/js/wysihtml5-0.3.0.js"></script>
<script src="assets/js/bootstrap-wysihtml5.js?v=1508435276"></script>
<script src="assets/js/clipboard.min.js"></script>
<script>
<?php if(isset($_SESSION['install'])): ?>
$( "#install" ).on( "click", function() {
  var web = $('#web').val()
  var page = $('#page').val()
  var GGKey = $('#GGKey').val()
  var FBAID = $('#FBAID').val()
  var FBASecret = $('#FBASecret').val()
  var dbhost = $('#dbhost').val()
  var dbuser = $('#dbuser').val()
  var dbpass = $('#dbpass').val()
  var dbname = $('#dbname').val()
  $.ajax({
  method: 'POST',
  url: 'install.php',
  data: { web: web, page: page, GGKey: GGKey, FBAID: FBAID, FBASecret: FBASecret, dbhost: dbhost, dbuser: dbuser, dbpass: dbpass, dbname: dbname },
  beforeSend: function () {
    $("#loading").show()
  },
  success: function (data) {
      $("#loading").hide()
      if(data == 'ok'){
        location.reload();
      }
    }
  });
});
<?php else: ?>
$( "#login" ).on( "click", function() {
  var password = $('#PasswordAccess').val()
  if(!password){
    $('#loginStatus').html('<br /><div class="alert alert-warning"><strong>Cân nhắc!</strong> Vui lòng không để trống mật khẩu!</div>')
  } else {
    $.ajax({
    method: 'POST',
    url: 'install.php',
    data: { password: password },
    beforeSend: function () {
      $("#loading").show()
    },
    success: function (data) {
        $("#loading").hide()
        if(data == 01){
          $('#loginStatus').html('<br /><div class="alert alert-success"><strong>Đăng nhập thành công!</strong> Đâng thực thi đăng nhập ....</div>')
          location.reload();
        } else {
          $('#loginStatus').html('<br /><div class="alert alert-danger"><strong>Đăng nhập thất bại!</strong> Có thể bạn đã nhập thông tin sai, cố gắng thử lại!</div>')
        }
      }
    });
  }
});
<?php endif; ?>
</script>
</body>
</html>
