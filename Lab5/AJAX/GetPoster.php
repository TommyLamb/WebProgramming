<?php
if (empty($_POST['MovieTitle'])){
	http_response_code(400);
	die();
}

$query = 'https://www.omdbapi.com/?t='.urlencode($_POST['MovieTitle']).'&r=json&type=movie';
$response = file_get_contents($query);
if (!$response){
	http_response_code(418);
	die();
}

$response = json_decode($response, true);

$image = $response['Poster'];

echo '<img src="'.$image.'" alt="'.$_POST['MovieTitle'].' Poster"/>';

?>