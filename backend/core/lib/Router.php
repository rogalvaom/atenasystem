<?php
class Router {
    private $url;
    private $method;
    private $data;
    private $token;

    function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->url = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->data = $this->getData();
        $this->token = $this->getToken();
    }

    function checkApi(){
        $uri = $this->url;
        if (strpos($uri, '/api/') === false) {
            return false;
        }
        return true;
    }

    function getToken(){
        $header = getallheaders();
        return isset($header['token']) ? $header['token'] : null;
    }

    function getData(){
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $input = [];
        if (strpos($contentType, 'multipart/form-data') !== false) {
            $input = $_POST;
            if (!empty($_FILES)) {
                $input['_files'] = $_FILES;
            }
        } else {
            $contents = file_get_contents('php://input');
            if (isset($contents)){
                $input = (array) json_decode($contents);
            }
        }
        return $input;
    }

    function pathApi(){
        $url = $this->url;
        $apiPart = substr($url, strpos($url, '/api/') + 5);
        $apiPart = explode('?', $apiPart);
        $endpoint = $apiPart[0];
        $queryString = isset($apiPart[1]) ? $apiPart[1] : "";

        if ($queryString != "") {
            $paramsArray = explode('&', $queryString);
            $params = [];
            foreach ($paramsArray as $param) {
                $param = explode('=', $param);
                $params[$param[0]] = $param[1];
            }
            $this->data = array_merge($this->data, $params);
        }

        return '/'.$endpoint;
    }

    function runApi($routes){
        if ($this->method == 'OPTIONS') {
            http_response_code(200);
            return;
        }
        $path = $this->pathApi();

        foreach($routes as $route){
            $RouteMethod = $route[0];
            $RoutePath = $route[1];
            $RouteClass = $route[2];
            $RouteFunction = $route[3];
            if ($RouteMethod == $this->method && $RoutePath == $path){
                $Class = new $RouteClass();
                if (method_exists($Class, $RouteFunction)){
                    http_response_code(200);
                    $response = $Class->$RouteFunction($this->data, $this->token);
                    if (is_array($response) || is_object($response)) {
                        echo json_encode($response);
                    } else {
                        echo $response;
                    }
                    return;
                } else {
                    http_response_code(405);
                    return;
                }
            }
        }
        http_response_code(405);
    }
}
?>