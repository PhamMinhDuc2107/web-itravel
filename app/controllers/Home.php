<?php
   class Home extends Controller {
      private $data = [];
      private $home_model;
      public function __construct() {
         $this->home_model =$this->model("HomeModel") ;
      }
      public function index() {
         $this->data["data"] = "okw";
         $this->data["view"] = "home/index";
         $this->render("layouts/client_layout",$this->data);
      }
    
   }