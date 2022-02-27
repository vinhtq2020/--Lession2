<?php

namespace App\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->addRouter('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRouter('POST', $path, $callback);
    }

    public function addRouter($method, $url, $action)
    {
        $this->routes[] = [$method, $url, $action];
    }

    public function resolve()
    {
        
        $requestUrl = $this->request->getPath();
        $params = [];
        $requestMethod = $this->request->getMethod();
        $routes = $this->routes;
        $checkRoute = false;
        
        foreach ($routes as $route) {
            list($method, $url, $callback) = $route;
            if (strpos($method, $requestMethod) !== false) {
                
                if (strpos($url, '{') !== false && strpos($url, '}') !== false) {
                    $routeParams = explode('/', $url);
                    $requestParams = explode('/', $requestUrl);
                    if (count($routeParams) === count($requestParams)) {
                       
                        if ($routeParams[1] === $requestParams[1]) {
                           
                            foreach ($routeParams as $k => $rp) {
                                
                                if (preg_match('/^{\w+}$/', $rp)) {
                                    $params[] = $requestParams[$k];
                                }
                            }
                        
                            $checkRoute = true;
                            break;
                        } else {
                            continue;
                        }
                    } else {
                        continue;
                    }
                }
                
                if (strcmp(strtolower($url), strtolower($requestUrl)) === 0) {
                    
                    $checkRoute = true;
                    break;
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        
        if ($checkRoute == true) {
            
            if (is_string($callback)) {
                return $this->renderView($callback);
            }
            if (is_array($callback)) {
                $callback[0] = new $callback[0]();
            }
         
            return call_user_func($callback, $this->request, $params);
        }
        
        $this->response->setStatusCode(404);
        return $this->renderContent("not found");
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{content}}', $viewContent, $layoutContent);

        include_once Application::$ROOT_DIR . "../views/$view.php";
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "../views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "../views/$view.php";
        return ob_get_clean();
    }
}
