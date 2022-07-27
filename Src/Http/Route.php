<?php

 namespace Src\Http;
 use Response;
 use Request;

 class Route {

    public $request;
    protected $response;


    public static array $routes=[]; 

    public function __construct($request,$response)
    {
        $this->request=$request;
        $this->response=$response;
    }

    public static function get($route,$action)
    {
        Self::$routes['get'][$route]=$action;
    }

    public static function post($route,$action)
    {
        Self::$routes['post'][$route]=$action;
    }
    

    public function resolve()
    {
        $path=$this->request->path();
        $method=$this->request->method();
        $action=self::$routes[$method][$path] ?? false;

        if(!$action){
            return;
        }
        

        //404        
        if($action instanceof \Closure){
           
            call_user_func_array($action,[]);
        }

        if(is_array($action)){
           return call_user_func_array([new $action[0],$action[1]],[]);
        }
    }   
 }