<?php

require __DIR__ . '/../vendor/autoload.php';

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$jsonFinder= new Model\JsonFinder();
$jsonWriter= new Model\JsonWriter();

//get the index
$app->get('/', function (Http\Request $request) use ($app) {
    return $app->render('index.php');
});

//get all statuses
$app->get('/statuses', function (Http\Request $request) use ($app,$jsonFinder) {
	$elements= $jsonFinder->findall();
	if($elements==null){
		throw new Exception\HttpException(404,"Not found");
	}
    return $app->render('allStatuses.php', $elements);
});

// get a status
$app->get('/statuses/(\d+)', function (Http\Request $request, $id) use ($app,$jsonFinder) {
	$element= $jsonFinder->findOneById($id);
	if($element==null){                
		throw new Exception\HttpException(404,"Not found");
	}
    return $app->render('Status.php', array($element));
});

// post a status
$app->post('/statuses', function (Http\Request $request) use ($app,$jsonWriter,$jsonFinder) {
	echo 'post called! <br/>';
	$jsonWriter->postOneComment($request);
	$elements= $jsonFinder->findall();
	if($elements==null){
		throw new Exception\HttpException(404,"Not found");
	}
    return $app->render('allStatuses.php', $elements);
});

/*
//delete
$app->delete('/satuses/(\d+)', function () use ($app) {
	$elements= $imf->findAll();
	if($elements==null){
		throw new Exception\HttpException(404,"Not found");
	}
    return $app->render('allStatuses.php', $elements);
});*/



return $app;
