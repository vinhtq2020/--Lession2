<?php
namespace App\core;
use App\core\Application;
class Controller
{
    public function render($view, $params = []){
        return Application::$app->router->renderView($view,$params);
    }

    public function redirect($url, $isEnd = true, $resSponseCode = 302){
        header('Location:'.$url, true, $resSponseCode);
        if($isEnd){
            exit;
        }
    }
}