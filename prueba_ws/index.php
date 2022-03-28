<?php

// # use Namespaces for HTTP request
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Slim\Factory\AppFactory;
use Slim\Routing\RouteContext;
use Slim\Exception\NotFoundException;

use Location\Coordinate;
use Location\Polygon;

require __DIR__ . '/vendor/autoload.php';

// # include DB connection file
require 'dbconn.php';
  
date_default_timezone_set('America/Mexico_City');

$app = AppFactory::create(); 
$app->addErrorMiddleware(true, true, true);

$basePath = str_replace('/' . basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);

# url base path for WS
$app = $app->setBasePath($basePath);

date_default_timezone_set('America/Mexico_City');


/**
 * @OA\Server(url="https://domain/folder_name/")
 * @OA\Info(title="PHP SLIM 4 Template", version="1.0")
 */

#main route
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("prueba APP API v1.0 2022");

    $routeContext = RouteContext::fromRequest($request);
    $basePath = $routeContext->getBasePath();

    return $response;
});


$app->GET('/wsGetUser', function (Request $request, Response $response, array $args) {


    $db = getDB();
    $sql = " CALL strGetUser()";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $mainCount = $stmt->rowCount();
    if ($mainCount > 0) {
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $status = "OK";
        $message = "User system found";
    } else {
        $userData = "";
        $status = "Error";
        $message = "Error!, there are not user system in the database";
    }

    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $userData
    );

    $response->getBody()->write(json_encode($return));
    return $response;
});

$app->POST('/wsLogin', function (Request $request, Response $response, array $args) {
    $password = $_POST['password'];
    $pass = hash('sha512',$password);
    $email = $_POST['email'];
    $db = getDB();

     $stmt = $db->prepare("CALL strLoginUser(?,?);");
    $stmt->execute([$email, $pass ]);
    $mainCount = $stmt->rowCount();
  
    if($mainCount > 0) {
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $status = "OK";
         $message = "User system found";
    
        }else{
            $status = "Error";
            $message = "Error!, there are not user system in the database";
            $userData=[''];
        }
   
    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $userData
    );

    $response->getBody()->write(json_encode($return));
    return $response;
});

$app->POST('/wsAddUser', function (Request $request, Response $response, array $args) {
    
    $password = $_POST['password'];
    $pass = hash('sha512',$password);
    $email = $_POST['mail'];
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telephone'];
    $rfc=$_POST['rfc'];
    $notas=$_POST['notas'];

    $db = getDB();

     $stmt = $db->prepare("CALL strCreateUser(?,?,?,?,?,?);");
    $stmt->execute([$nombre, $telefono, $email, $pass, $rfc, $notas]);
    $mainCount = $stmt->rowCount();
  
    if($mainCount > 0) {
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $status = "OK";
         $message = "User system found";
    
        }else{
            $status = "Error";
            $message = "Error!, there are not user system in the database";
            $userData=[''];
        }
   
    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $userData
    );

    $response->getBody()->write(json_encode($return));
    return $response;
});
$app->POST('/wsGetUserInfo', function (Request $request, Response $response, array $args) {
   
    $id = $_POST['id'];
    $db = getDB();

     $stmt = $db->prepare("CALL strGetUserinfo(?);");
    $stmt->execute([$id ]);
    $mainCount = $stmt->rowCount();
  
    if($mainCount > 0) {
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $status = "OK";
         $message = "User system found";
    
        }else{
            $status = "Error";
            $message = "Error!, there are not user system in the database";
            $userData=[''];
        }
   
    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $userData
    );

    $response->getBody()->write(json_encode($return));
    return $response;
});

$app->POST('/wsUpdateUser', function (Request $request, Response $response, array $args) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $pass = hash('sha512',$password);
    $email = $_POST['mail'];
    $nombre=$_POST['nombre'];
    $telefono=$_POST['telephone'];
    $rfc=$_POST['rfc'];
    $notas=$_POST['notas'];

    $db = getDB();

     $stmt = $db->prepare("CALL strUpdateUser(?,?,?,?,?,?,?);");
    $stmt->execute([$id,$nombre, $telefono, $email, $pass, $rfc, $notas]);
    $mainCount = $stmt->rowCount();
  
    if($mainCount > 0) {
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $status = "OK";
         $message = "User system found";
    
        }else{
            $status = "Error";
            $message = "Error!, there are not user system in the database";
            $userData=[''];
        }
   
    $return = array(
        'status' => $status,
        'message' => $message,
        'data' => $userData
    );

    $response->getBody()->write(json_encode($return));
    return $response;
});


// let's go!!
     
$app->run(); 
