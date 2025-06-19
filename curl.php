<?php

function fetch_url($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$response = curl_exec($ch);
	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	return array('response' => $response, 'http_code' => $http_code);
}

$file_exist = "https://bx1.be/videofiles/00100906_INT_MICROTROT.mp4";
$file_doesnt_exist = "https://bx1.be/videofiles/00100906_INT_MICROTROT_failed.mp4";

$response_exist = fetch_url($file_exist);
$response_doesnt_exist = fetch_url($file_doesnt_exist);

echo "HTTP Code for existing file: " . $response_exist['http_code'] . "\n\n<br />";
echo "HTTP Code for non-existing file: " . $response_doesnt_exist['http_code'] . "\n";

// If file exists (test.txt), delete it
$file_txt = 'test.txt';
if (file_exists($file_txt)) {
	unlink($file_txt);
	echo "File '$file_txt' deleted successfully.\n";
} else {
	echo "File '$file_txt' does not exist.\n";
}
