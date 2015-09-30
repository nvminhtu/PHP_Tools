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
      <p>Trang: Mangak.net</p>
      <p>Ví dụ định dạng http://blogtruyen.com/truyen/hiep-khach-giang-ho/vol1-chap-10-remake/</p>
    </div>
  </div>

<?php
include_once('simple_html_dom.php');
include_once('data/mangak.net.php');

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

  
  
  $arrURL = $arr_naruto_gaiden;
  $dir_arr = "conan";

  $arrLength = count($arrURL);
  //Load content
  for($i = 0; $i < 3; $i++) {
    $j = $i + 1;
    //check: number of chapter
    if($j < 100) {
      if($j < 10) {
        $folder_no = '00'.$j;
      } else {
        $folder_no = '0'.$j;
      }
    } else {
      $folder_no = $j;
    }
    //end check: number of chapter

    $html = file_get_html($arrURL[$i]);
    $order = 0;

    foreach($html->find('.vung_doc img') as $e) {
      $order++;
      $src = $e->src;
      

      $dirimg = 'images/'.$dir_arr.'/chap_'.$folder_no."/"; 

      $basename = basename($src); 
      echo $basename."<br>";

      //Replace special extension after images
      $basename = str_replace("?imgmax=0", "", $basename);
      $basename = str_replace("?imgmax=3000", "", $basename);
      $basename = str_replace("?imgmax=2000", "", $basename);
      $basename = str_replace("?imgmax=2048", "", $basename);
      $basename = str_replace("&amp;fix=.webp", "", $basename);
      $basename = str_replace("%3Fimgmax%3D2048", "", $basename);

      //filter special case: dont download these images;
      $unused_pics = array("vcrehtxj.jpg");
      if (!in_array($basename, $unused_pics)) {
        //save file to local - rename file
        $file_ext = pathinfo($basename, PATHINFO_EXTENSION);
        $new_name = $dir_arr.'-chuong-'.$folder_no.'-'.$order.'.'.$file_ext;
        $localfile = $dirimg.$new_name; 
        file_put_contents($localfile, getContentUrl($src));
      }
      
    } 

  }

?>
</div>
</body>
</html>