<?php
class Router {
    private $url;
    private $baseUrl;
    private $apiUrl;

    function __construct() {
        $this->url = $_SERVER["REQUEST_URI"];
        $this->baseUrl = $_ENV['BASE_URL'] ?? '';
        $this->apiUrl = $_ENV['API_URL'] ?? $this->baseUrl;
    }

    function pathWeb($url, $routes){
        $url = explode('?',$url);
        unset($url[1]);
        $url = implode('',$url);

        $file = $_SERVER['PROJECT_ROOT'] . '/' . $url;

        if(is_file($file)){
            return $file;
        }

        $url = '/'.$url;

        foreach($routes as $route){
            $RoutePath = $route[0];
            $RouteWeb = $_SERVER['PROJECT_ROOT'] . '/public/view' . $route[1];

            if ($url == $RoutePath) {
                if(is_file($RouteWeb)){
                    return $RouteWeb;
                }
            }
        }

        return $_SERVER['PROJECT_ROOT'] . '/public/view/404.html';
    }

    function runWeb($routes){
        $uri = $this->url;
        $parametros = explode('/',$uri);
        unset($parametros[0]);
        $parametros = array_values($parametros);
        $url = implode('/',$parametros);

        $path = $this->pathWeb($url, $routes);

        if(isset($path)){
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $mimeTypes = [
                'png'   => 'image/png',
                'jpg'   => 'image/jpeg',
                'jpeg'  => 'image/jpeg',
                'gif'   => 'image/gif',
                'svg'   => 'image/svg+xml',
                'ico'   => 'image/x-icon',
                'webp'  => 'image/webp',
                'css'   => 'text/css',
                'js'    => 'text/javascript',
                'pdf'   => 'application/pdf',
                'woff'  => 'font/woff',
                'woff2' => 'font/woff2',
                'ttf'   => 'font/ttf',
                'otf'   => 'font/otf',
                'eot'   => 'application/vnd.ms-fontobject',
            ];

            if (isset($mimeTypes[$extension])){
                $c = file_get_contents($path);
                $size = filesize($path);
                header('Content-Type: ' . $mimeTypes[$extension]);
                header("Content-length: $size");
                if ($extension === 'pdf') {
                    header('Content-Disposition: inline; filename="' . basename($path) . '"');
                }
                echo $c;
            }else{
                if(is_file($path)){
                    echo "<script>var basePath = '" . $this->baseUrl . "'</script>";
                    echo "<script>var apiUrl = '" . $this->apiUrl . "'</script>";
                    echo "<script src='" . $this->baseUrl . "/core/js/jquery-1.11.1.min.js'></script>";
                    echo "<script src='" . $this->baseUrl . "/core/js/api.js'></script>";
                    include_once $path;
                }
            }
        }
    }
}
?>