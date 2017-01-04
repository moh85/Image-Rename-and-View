<?php error_reporting(E_ERROR | E_PARSE); ?>
<?php
/* لإضافة أسماء الصور إلى قاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "any";
$conn = new mysqli($servername, $username, $password, $dbname);
// connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/

if (isset($_POST['go'])) {
$file_type = $_FILES['photo']['type'];
$allowed = array("image/jpeg", "image/jpg", "image/png", "image/gif", "image/jpg", "image/bitmap"); // صيغ الصور المتاحة
if(!in_array($file_type, $allowed)) {
/* 
header('Location: error.php'); // في حال كان الملف غير متاح, تحويل إلى صفحة أخرى مثلاً
exit;
*/
}
else {
// إذا كان الملف متاح قم بالرفع
$target = "./".$_POST['directory']."/";
$newpic = $_POST['picname'] . $_POST['pictype'];
$target = $target . basename($newpic);
$pic=($_FILES['photo']['name']);
$imgurl = $target;
/* لإضافة أسماء الصور إلى قاعدة البيانات
mysql_connect($servername, $username, $password) or die(mysql_error()) ;
mysql_select_db($dbname) or die(mysql_error()) ;
mysql_query("INSERT INTO uploads (image) VALUES ('imgurl')"); // إضافة الإسم إلى قاعدة بيانات
*/

if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
{
/*
header('Location: index.php?success=1'); // في حال نجح الرفع
exit;
*/
}
else {
/*
$error = "Error!"; // طباعة خطأ
*/ 
} 

  }
  
}

else {
/*
$error = "Error!"; // طباعة خطأ
*/		
}
?>
<html>
<head>
  <title>Upload Modal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
                    <a class="navbar-brand" href="#">AnyName</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
						<a target="_blank" href="#" data-toggle="modal" data-target="#upload">Upload</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<div id="upload" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Image Upload (Get Name + View Image)</h4>
                </div>
                <div class="modal-body">
	<form action="" method="post" enctype="multipart/form-data">
	<input name="photo" onchange="putfilename();result(this);" style="padding: 11px;width: 100%;cursor: pointer;background: white;color: black;" id="newfile" type="file">
	<img class="img-responsive" id="viewimg" style="" src="">
	<input class="form-control" style="margin-top: 10px" placeholder="myimage" name="picname" id="putname" style="margin-top: 10px" type="text">
	<input class="form-control" style="margin-top: 10px" placeholder="optional (if empty: same dir)" name="directory" style="margin-top: 10px" type="text">
    <!-- في حال أردت تغيير الصيغة قبل الرفع النهائي -->
	<!--
	<select name="pictype" style="width: 100%; height: 33px;margin-top: 12px;text-align:center">
	<option value=""> Choose ...</option>
	<option value=".jpg"> JPG</option>
	<option value=".png"> PNG</option>
	<option value=".gif"> GIF</option>
	<option value=".bmp"> BITMAP</option>
	</select>
	-->
	<button class="btn btn-primary" name="go" type="submit" style="width: 100%;margin-top: 10px">Upload</button>
	</form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
	<!-- By Mohammad: http://fb.com/martin.atwi.85 -->
	<script type="text/javascript">
            function putfilename() // وضع اسم الملف في الخانة عند التغيّر
            {
                var filename = document.getElementById('newfile'); 
				document.getElementById("putname").value = filename.value;
            }
			
            function result(input) { // لعرضها قبل الرفع Base64 تحويل الصورة إلى
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#viewimg')
                        .attr('src', e.target.result);
					$("#viewimg").attr({
                    "style" : "padding: 13px; margin: 0 auto;"
                        });
                };
				
                reader.readAsDataURL(input.files[0]);
               }
            }
           </script>
</body>
</html>	        
