<?php

namespace app\controllers;
use app\core\Application;
use app\core\Controller;

class siteController extends Controller{
  public function home(){
    $params = [
        'name' => "Kekecoder"
      ];
    return $this->render("home", $params);
  }
  public function contact(){
    return $this->render("contact");
  }
  public function handleContact(){
    return "Handling submitted contact";
  }
}