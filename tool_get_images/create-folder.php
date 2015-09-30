<?php
for($i=0;$i< 1000; $i++) {
	$j = $i + 1;
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
	$dirPath = "images/shin/chap_".$folder_no;
	$result = mkdir($dirPath, 0755);
	if ($result == 1) {
	    echo $dirPath . " has been created";
	} else {
	  echo $dirPath . " has NOT been created";
	}
}
?>