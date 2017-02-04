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
	$statusList= $jsonFinder->findall();
	/*if($statusList==null){
		throw new Exception\HttpException(404,"Not found");
	}*/
    return $app->render('allStatuses.php', ['statuses' => $statusList]);
});

// get a status
$app->get('/statuses/(\d+)', function (Http\Request $request, $id) use ($app,$jsonFinder) {
	$status= $jsonFinder->findOneById($id);
	if($status==null){                
		throw new Exception\HttpException(404,"Not found");
	}
    return $app->render('Status.php', array('status' => $status));
});

// post a status
$app->post('/statuses', function (Http\Request $request) use ($app,$jsonWriter,$jsonFinder) {
	$created=$jsonWriter->write($request);
	if(!$created){
		throw new Exception\HttpException(500,"Internal Server Error");
	}
    $app->redirect('/statuses');
});


//delete
$app->delete('/satuses/(\d+)', function ($id) use ($app,$jsonWriter) {
	$deleted= $JsonWriter->delete($id);
	if(!$deleted){
		throw new Exception\HttpException(500,"Internal Server Error");
	}
	$app->redirect('/statuses');
});



return $app;
