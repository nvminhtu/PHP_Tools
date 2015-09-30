<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get images form URL</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
include_once('simple_html_dom.php');

function getContentUrl($url) {
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
   curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/21.0 (compatible; MSIE 8.01; Windows NT
  5.0)');
   curl_setopt($ch, CURLOPT_TIMEOUT, 200);
   curl_setopt($ch, CURLOPT_AUTOREFERER, false);
   //curl_setopt($ch, CURLOPT_REFERER, 'http://google.com');
   curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // Follows redirect responses
   // gets the file content, trigger error if false
   $file = curl_exec($ch);
     if($file === false) trigger_error(curl_error($ch));
     curl_close ($ch);
     return $file;
}

    // validation expected data exists
    if(!isset($_POST['web_url']) ||
    !isset($_POST['web_attribute']) ||
    !isset($_POST['web_local']) ||
    !isset($_POST['web_div'])) {
        //died('We are sorry, but there appears to be a problem with the form you submitted.');
    }
    //declare varibles to get data from FORM
    $web_url = $_POST['web_url']; // required
    $web_attribute = $_POST['web_attribute']; // required
    $web_local = $_POST['web_local']; // required
    $web_div = $_POST['web_div']; // not required

    //Code: get image
    $html = file_get_html($web_url);
    $image_div = ".".$web_div." img";
    $image_class = "?imgmax=2048";
    $image_local = $web_local;

    foreach($html->find($image_div) as $e) {
      $src = $e->src;
        
      $dirimg = 'images/'.$dir_arr.'/chap_'.$folder_no."/"; 
      $basename = basename($src); 

      //Replace các trường hợp đặc biệt
      $basename = str_replace("?imgmax=0", "", $basename);
      $basename = str_replace("?imgmax=3000", "", $basename);
      $basename = str_replace("?imgmax=2000", "", $basename);
      $basename = str_replace("?imgmax=2048", "", $basename);
      $basename = str_replace("&amp;fix=.webp", "", $basename);
      $basename = str_replace("%3Fimgmax%3D2048", "", $basename);

      $localfile = $dirimg. $basename; 
      file_put_contents($localfile, getContentUrl($src));
    }
?>
<div class="container bs-docs-container">
    <div class="bs-docs-header">
        <h1>Đã tải về xong - kiểm tra folder dưới máy nhé ^^!</h1>
        <a href='lay-hinh.php'>Quay lại trang lấy hình tiếp tục</a>
    </div>
</div>
</body>
</html>