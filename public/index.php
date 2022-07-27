<?php
 use Src\Http\Route;
 use Src\Http\Response;
 use Src\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';


$route= new Route(new Request,new Response);

echo $route->resolve();