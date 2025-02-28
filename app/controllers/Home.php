<?php
   class Home extends Controller {
      private $data = [];
      private $home_model;
      private $LocationModel;
      public function __construct() {
         $this->home_model =$this->model("HomeModel") ;
         $this->LocationModel =$this->model("LocationModel");
      }
      public function index() {
         $locations = $this->LocationModel->where(1,"is_destination");
         $this->data["data"] = "okw";
         $this->data["page"] = "home/index";
         $this->data["locations"] = $locations;
         $this->render("layouts/client_layout",$this->data);
      }
   }