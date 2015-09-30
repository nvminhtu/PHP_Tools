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
	
	//reference
	//rename old folder to new folder
	//rename(realpath(dirname(__FILE__)).'/images/rename/chap1',realpath(dirname(__FILE__)).'/images/rename/chap2');
	
	
	//1. get all sub folder under a folder
	function rename_folder(){
		$folder_name = $_POST['web_local']; // required

		if(isset($folder_name)||$folder_name!=null) {
			$file_dir = $folder_name."*";
			$dirs = array_filter(glob($file_dir), 'is_dir');
			$reverse_arr = array_reverse($dirs);

			//2.Đổi tên trung gian tạm
			for ($i=0; $i < count($reverse_arr) ; $i++) { 
				$str_name = $reverse_arr[$i]; 
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
				rename(realpath(dirname(__FILE__)).'/'.$reverse_arr[$i],realpath(dirname(__FILE__)).'/'.$folder_name.'chap_temp'.$folder_no);
			}

			//3.Sau khi đổi tên trung gian thì gán lại tên mới
			$temp_dirs = array_filter(glob($file_dir), 'is_dir');
			for ($i=0; $i < count($temp_dirs) ; $i++) { 
				$str_name = $temp_dirs[$i];
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
		    
				rename(realpath(dirname(__FILE__)).'/'.$temp_dirs[$i],realpath(dirname(__FILE__)).'/'.$folder_name.'chap_'.$folder_no);
			}	
		}
	}
	rename_folder();
?>
<div class="container bs-docs-container">
    <div class="bs-docs-header">
        <h1>Đã tải về xong - kiểm tra folder dưới máy nhé ^^!</h1>
        <a href='doi-ten.php'>Quay lại trang đổi tên folder</a>
    </div>
</div>