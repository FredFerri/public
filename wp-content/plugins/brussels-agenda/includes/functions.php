<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : functions.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 09 January 2020
 *   Don't edit this code without authorization
 *********************************************/
ini_set('error_reporting', E_ALL);

function savePhoto($remoteImage, $newname, $size) {
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $remoteImage);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);
	$fileContents = curl_exec($ch);
	curl_close($ch);
	$newImg = imagecreatefromstring($fileContents);
	if (!empty($size))
		{
			$newImg = imagescale($newImg,$size);
		}
	return imagejpeg($newImg, "../cache/img/{$newname}",100);

}
function callAPI($method, $url, $data, $zone, $cache=false, $timeout=3600){
	$curl = curl_init();
	switch ($method){
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "CRED":
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
			break;
		default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
	}
	// OPTIONS:
	curl_setopt($curl, CURLOPT_URL, $url);
	if ($method == "CRED")
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Basic cXEyQmxqVThOa0lqZjF1SGhOT2NJQ29DSmVBYTpSR0w0d0JSQzFtSEVvS0FsbVgzVHBYYzE5dU1h',
			));
		}
	else
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Authorization: Basic cXEyQmxqVThOa0lqZjF1SGhOT2NJQ29DSmVBYTpSR0w0d0JSQzFtSEVvS0FsbVgzVHBYYzE5dU1h',
				'Accept: application/json',
			));
		}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	// EXECUTE:
	$result = curl_exec($curl);
	if(!$result){die("Connection Failure");}
	curl_close($curl);
	if ($cache == true && $method == "GET")
		{
			$zone = strtolower($zone);
			$filename	=	"../cache/cache." . $zone . ".json";
			$now = time();
			$filetime = filemtime($filename);
			if(($now - $filetime) >= $timeout){
				@unlink($filename);
			}
			if(!file_exists($filename))
			{
				$writejson = fopen($filename, "w");
				fwrite($writejson, $result);
				fclose($writejson);
			}
			$files = glob('../cache/img/*'); // get all file names
			foreach($files as $file){ // iterate files
				if(is_file($file))
					//echo $file;
					unlink($file); // delete file
			}
			$json_file 		= file_get_contents( "../cache/cache.calendar.cur.json");
			$response       = json_decode($json_file, true);
			$data = $response['data'];
			foreach ($data as $item)
				{
					$link   =   $item['media'][0]["link"];
					if (empty($link))
					{
						continue;
					}
					else
					{
						$mediacount = 0;
						foreach ($item['media'] as $media){
							if ($media["type"] == "photo" || $media["type"] == "poster")
							{
								$imagename = str_replace("https://agendabrussels.imgix.net/","",$media["link"]);
								$imagename = str_replace("https://media02.cdn.agenda.be/","",$imagename);
								savePhoto($media["link"], $imagename,400);
								$mediacount++;
								break;
							}
						}
					}
				}
		}
	return $result;
}

