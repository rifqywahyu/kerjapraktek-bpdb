<?php
date_default_timezone_set('Asia/Jakarta');
header("Content-type: text/plain");
#include('kernel.php');

$auth = getAuthorizationHeader();
$auth2 = "uKcG3Q92FgX5yVEmBXq8mpxMsBVWFmC723XES59YkTpRD5k2LZ9vNCM2ydYrnRUS9VbhTpHRsEF3ywZu69HkUG9ZEFtne2FrhDH9K82sAzUvy6Z6yXeD8wHK";
// echo $auth;
// echo "|------|";
// echo $auth2 ;
if ($auth != $auth2){
	// echo "das";
	die;
}

if (isset($_POST['uplname'])){
  $uplname=trim($_POST['uplname']);
} else {
  $uplname="";
}

if (isset($_POST['action'])){
  $action=trim($_POST['action']);
} else {
  $action="";
}
$appresult = array();
if (isset($_REQUEST['DeviceID'])){$DeviceID=trim($_REQUEST['DeviceID']);} else {$DeviceID="";}
if (isset($_REQUEST['SimSerialNumber'])){$SimSerialNumber=trim($_REQUEST['SimSerialNumber']);} else {$SimSerialNumber="";}
if (isset($_REQUEST['SubscriberID'])){$SubscriberID=trim($_REQUEST['SubscriberID']);} else {$SubscriberID="";}

// $file_handle = fopen('./multipartpost.log', 'a+');
// fwrite($file_handle, "======================================"."\r\n");
// foreach($_REQUEST as $name => $value){
	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": ".$name."=".$value."\r\n");
// }
// fwrite($file_handle, "======================================"."\r\n");

function GetWebname($name){
	$name=str_replace("Ä", "Ae", $name);
	$name=str_replace("Ö", "Oe", $name);
	$name=str_replace("Ü", "Ue", $name);
	$name=str_replace("ä", "ae", $name);
	$name=str_replace("ö", "oe", $name);
	$name=str_replace("ü", "ue", $name);
	$name=str_replace("ß", "ss", $name);
	$name=str_replace(" ", "_", $name);
	$name=str_replace("'", "", $name);
	$name=str_replace("´", "", $name);
	$name=str_replace("&", "and", $name);
	$name=str_replace("/", "", $name);
	$name=str_replace("\\", "", $name);
	$name=str_replace("`", "", $name);
	return strtolower($name);
}
function rand_string($lng=8) {
	mt_srand((double)microtime()*1000000);
	$charset = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
	$length  = strlen($charset)-1;
	$code    = '';
	for($i=0;$i < $lng;$i++) {
	  $code .= $charset{mt_rand(0, $length)};
	}
	return $code;
}

#echo "Akt ST: ".$akt_spieltag."<br />";
#if (isset($_REQUEST['spieltag'])){$spieltag=intval($_REQUEST['spieltag']);} else {$spieltag=$akt_spieltag;}

if($action==""){
	$action = "overview";
}



if ($action == "overview"){
  #
  
}elseif($action == "upload"){
	
  $uploads[] = array(); 
  // fwrite($file_handle, "======= FILES ========================"."\r\n");
  foreach($_FILES as $name => $value){ 
  
    $uploads[$name] = $value;
    foreach($value as $fname => $fvalue){
    	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": ".$fname."=".$fvalue."\r\n");
    }
  	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": Upload of \"".$name."\"\r\n");
	
    if($name==$uplname){
		 
      $uploaddir = './kejadian/';
      $uploadfile = $uploaddir . basename($_FILES[$name]['name']);
     	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": MoveUploadedFile(".$_FILES[$name]['name'].")\r\n");
		try{
      if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)) {
		
        $uploads[$name]["status"] = $_FILES[$name]['name']." saved successfull";
      	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": ->moving ".$_FILES[$name]['name']." successfull\r\n");
          #echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
      } else {
        $uploads[$name]["status"] = $_FILES[$name]['name']." failed to save!";
      	// fwrite($file_handle, date("d.m.Y H:i:s", time()).":->moving ".$_FILES[$name]['name']." NOT successfull\r\n");
          #echo "Möglicherweise eine Dateiupload-Attacke!\n";
      }
		} catch(Exception $e){
					echo $e->getMesage();
					die();
		}
    } 
   
	
	
    // foreach($value as $fname => $fvalue){
    	// fwrite($file_handle, date("d.m.Y H:i:s", time()).": ".$fname."=".$fvalue."\r\n");
    // }
  }
  // fwrite($file_handle, "======================================"."\r\n");
	#print_r($uploads);
  $appresult["uploads"] = $uploads; 
  
  echo json_encode($appresult);
  #
}else{
}
// fclose($file_handle);


function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

?>