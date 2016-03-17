<?php
// Routes
$app->get('/status', function ($request, $response, $args) {
    return $response->withStatus(201);
});

$app->get('/texto', function ($request, $response, $args) {
	$textp=file_get_contents("https://s3.amazonaws.com/files.principal/texto.txt");//"http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
	$hash1 = hash("sha256", $texto);
	echo json_encode(array("texto"=>$texto, "hash" => $hash1));

	if(!isset(hash("sha256", $texto))){
    	return $response->withStatus(500);
	}
});


$app->post('/validarFirma', function ($request, $response, $args) {
	$mensajeAValidar = $_POST['mensaje'];
	$hashAValidar = $_POST['hash'];
	$hash = hash("sha256", $mensajeAValidar);

	if(!isset($_POST['mensaje']) || !isset($_POST['hash'])){
		return $response->withStatus(400);
	}
	$comparacion = false;
	if(strtolower($hashAValidar) == strtolower($hash)){
		$comparacion = true;
	}
    echo json_encode(array("mensaje"=>$mensajeAValidar, "valido"=>$comparacion));
});
	
?>