<?php
	$arrImage  =   array('img-countdown038.jpg', 'img-countdown038_sp.jpg');
	function showAll($path, &$newString, $arrImage){
		$data	= scandir($path);
		
		$newString .= '<ul>';
		foreach($data as $key => $value){
			if($value != '.' && $value != '..'){
				$dir	= $path . '/' . $value;
				if(is_dir($dir)){
					$newString .= '<li>D: ' . $value;
					showAll($dir, $newString, $arrImage);
					$newString .= '</li>';
				}else{
				    foreach($arrImage as $img) {
				        if($value == $img) {
				            unlink($path . '/' . $img);
				        }
				    }
					$newString .= '<li>F: ' . $value . '</li>';
				}
			}
		}
		$newString .= '</ul>';		
	}
	
	showAll('.', $newString, $arrImage);
	echo $newString;
	
	
	
	
	
	
	

	
