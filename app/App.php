<?php
   class App {
      private $__controller, $__action,$__params, $__routes;

      public function __construct() {
         global $routes;
         $this->__routes = new Route();
         if(isset($routes["default_controller"])) {
            $this->__controller = $routes["default_controller"];
         }
         $this->__action = "index";
         $this->__params = [];
         $this->processUrl();
      }
      public function processUrl( ) {

         $url = $this->getUrl();

         $url = $this->__routes->handleRoute($url);

         $urlArr = array_filter(explode("/", $url));
         $urlArr = array_values($urlArr);
         $urlCheck = "";
         if(!empty($urlArr)) {
            foreach($urlArr as $key => $value) {
               $urlCheck .= $value."/";
               $filterCheck = rtrim($urlCheck,"/");
               $filterArr = explode("/", $filterCheck);
               $filterArr[count($filterArr) -1] = ucfirst($filterArr[count($filterArr) -1]);
               $filterArr = implode("/", $filterArr);

               if(!empty($urlArr[$key-1])) {
                  unset($urlArr[$key-1]);
               }
               if(file_exists("app/controllers/".$filterCheck.".php")) {
                  $urlCheck = $filterCheck;
                  break;
               }
            }
         }
         $urlArr = array_values($urlArr);
         if(!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
         }else{
            $this->__controller = ucfirst($this->__controller);
         }

         if(empty(($urlCheck))) {
            $urlCheck = $this->__controller;
         }
         $pathController = "app/controllers/".$urlCheck.".php";
         if (file_exists($pathController)) {
            require_once($pathController);
            if (class_exists($this->__controller)) {
               $this->__controller = new $this->__controller();
               unset($urlArr[0]);
            } else {
                $this->loadError();
            }
        } else {
            $this->loadError();
        }
         if(!empty($urlArr[1])){
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
         }

         $this->__params = array_values($urlArr);
         if(method_exists($this->__controller, $this->__action)) {
            call_user_func_array([ $this->__controller, $this->__action ], $this->__params);
         }else {
            $this->loadError();
         }
      }
      public function getUrl():string {
         if (!empty($_SERVER["PATH_INFO"])) {
            $url = $_SERVER["PATH_INFO"];
         }else {
            $url = "/";
         }
         return $url;
      }
      public function loadError($name ="404") {
         require_once "app/errors/".$name.".php";
      }
   }
?>