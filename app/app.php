<?php

require __DIR__ . '/../vendor/autoload.php';

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);



//DB config

$connexion='mysql:host=127.0.0.1;dbname=uframework;port=32768';
$user = 'uframework';
$password= 'p4ssw0rd';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

//opening db connexion
try{
	$con = new Model\Connexion($connexion, $user, $password, $options);
}
catch(Exception $e){
	echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
}

$statusFinder= new Model\StatusFinder($con);
$statusMapper= new Model\StatusMapper($con);



//get the index
$app->get('/', function (\Http\Request $request, \Http\Response $response = null) use ($app) {
    return $app->render('index.php',array());
});



//get all statuses
$app->get('/statuses', function (\Http\Request $request, \Http\Response $response = null) use ($app,$statusFinder) {
	//if requestAccept is HTML
	if($request->getRequestAccept() == 'text/html; charset=UTF-8'){
		$statusList=array();
		$statusList= $statusFinder->findAll();
		$statusArray=array();
		forEach($statusList as $row){
			$status= $row->toArray();
			array_push($statusArray,$status);
		}
		return $app->render('allStatuses.php', $statusArray);
	}
	//if requestAccept is JSON
	else if($request->getRequestAccept() == 'application/json'){
		$response= new Http\JSONResponse(json_encode($statusFinder->findAll()), 200);
		return $response->getContent();
	}
	//if requestAccept is null 
	else{
		throw new Exception\HttpException(404,"Not found");
	}
});



// get a status
$app->get('/statuses/(\d+)', function (\Http\Request $request,\Http\Response $response = null, $id) use ($app,$statusFinder) {
	//if requestAccept is HTML
	if($request->getRequestAccept() == 'text/html; charset=UTF-8'){
		$status= $statusFinder->findOneById($id);
		if($status==null){                
			throw new Exception\HttpException(404,"Not found");
		}
		return $app->render('Status.php', array('status' => $status->toArray()));
	}
	//if requestAccept is JSON
	else if($request->getRequestAccept() == 'application/json'){
		$status= $statusFinder->findOneById($id);
		if($status==null){                
			throw new Exception\HttpException(404,"Not found");
		}
		$response= new Http\JSONResponse(json_encode($status), 200);
		if($response != null){
			return $response->getContent();
		}
		throw new Exception\HttpException(404,"Not found");
	}
	//if requestAccept is null 
	else{
		
		throw new Exception\HttpException(404,"Not found");
	}
	
});



// post a status
$app->post('/statuses', function (\Http\Request $request) use ($app,$statusMapper,$statusFinder) {
		$status= new Model\Status($request->getParameter('username'),$request->getParameter('title'),$request->getParameter('message'));
		$last_id=$statusMapper->persist($status);
		$status->setId($last_id);
		$app->redirect('/statuses');
});




//delete
$app->delete('/statuses/(\d+)', function (\Http\Request $request,$id) use ($app,$statusMapper,$statusFinder) {
	$status= $statusFinder->findOneById($id);
	var_dump($status);
	if($status==null){                
		throw new Exception\HttpException(404,"Not found");
	}
	$deleted= $statusMapper->remove($status);
	if(!$deleted){                
		throw new Exception\HttpException(500,"Internal server error");
	}
	$app->redirect('/statuses');
});



return $app;
