<?php
namespace app\core;

class Controller{
  public function render($views, $params = []){
  return Application::$app->router->renderView($views, $params);
  }
}
