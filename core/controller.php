<?php
namespace app\core;

class Controller{
  public string $layout = 'main';
  public function setLayout($layout){
    $this->layout = $layout;
  }
  public function render($views, $params = []){
  return Application::$app->router->renderView($views, $params);
  }
}
