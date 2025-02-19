<?php
   class Controller {
      protected function model(string $model) {
         $pathModel = _DIR_ROOT.'/app/models/'.$model.'.php';
         if (file_exists($pathModel)) {
            require_once $pathModel;
            if (class_exists($model)) {
               $model = new $model();
               return $model;
            }
         }            
         return false;
      } 
      protected function render(string $view, array $data = []) {
         $pathView  = _DIR_ROOT."/app/views/".$view.".php";
         if (file_exists($pathView)) {
            require_once $pathView;
         }
      }
   }