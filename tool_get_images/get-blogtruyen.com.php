<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Optional theme -->
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container bs-docs-container">
  <div class="bs-docs-header">
    <h1>Tool download hình ảnh</h1>
    <h2>Pattern 2: Lấy hình hàng loạt</h2>
  </div>
  <div class="row">
    <div class="col-md-8">
      <p>Chờ sau khi load xong kiểm tra thư mục dưới máy</p>
      <p>Trang: Blogtruyen.com</p>
      <p>Ví dụ định dạng http://blogtruyen.com/truyen/hiep-khach-giang-ho/vol1-chap-010-remake/</p>
    </div>
  </div>

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

  //array URL
  $arrURL = array(
    "http://blogtruyen.com/truyen/hiep-khach-giang-ho/vol1-chap-1-remake",
    "http://blogtruyen.com/truyen/hiep-khach-giang-ho/vol1-chap-2-remake",
    "http://blogtruyen.com/truyen/hiep-khach-giang-ho/vol1-chap-3-remake"
  );
  
  for($i = 1; $i < count($arrURL)-1 ; $i++) {
    
    //check: number of chapter
    if($i < 100) {
      if($i < 10) {
        $folder_no = '00'.$i;
      } else {
        $folder_no = '0'.$i;
      }
    } else {
      $folder_no = $i;
    }
    //end check: number of chapter

    echo $arrURL[$i];
    $html = file_get_html($arrURL[$i]);
    foreach($html->find('#content img') as $e) {
      $src = $e->src;
      
      //Replace các trường hợp đặc biệt
      $src = str_replace("?imgmax=0", "", $src);
      $src = str_replace("?imgmax=3000", "", $src);
      
      $dirimg = 'images/hiep-khach-giang-ho/chap_'.$folder_no."/"; 
      $localfile = $dirimg. basename($src); 
      file_put_contents($localfile, getContentUrl($src));
      
      // Test, show the saved image
      echo '<img src="'. $localfile .'" />';
    } 

  }

?>
</div>
</body>
</html>