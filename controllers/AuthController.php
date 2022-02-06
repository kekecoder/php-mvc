<?php

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;
use app\core\Model;

class AuthController extends Controller{
  public function login(){
    $this->setLayout('auth');
    return $this->render("login");
  }
  public function register(Request $request){
    $registerModel = new RegisterModel();
    if($request->isPost()){
      $registerModel->loadData($request->getBody());
      if($registerModel->validate() && $registerModel->register()){
        return "Success";
      }
      echo "<pre>";
      var_dump($registerModel->errors);
      echo "<pre>";
      exit();
      return $this->render("register", ["models" => $registerModel]);
    }
    $this->setLayout('auth');
    return $this->render("register");
  }
}