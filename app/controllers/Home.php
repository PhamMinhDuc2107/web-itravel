<?php
   class Home extends Controller {
      private $data = [];
      private $CategoryModel;
      private $LocationModel;
      public function __construct() {
         $this->CategoryModel = $this->Model("CategoryModel");
         $this->LocationModel =$this->model("LocationModel");
      }
      public function index() {
         $categories = $this->CategoryModel->all();
         $locations = $this->LocationModel->where(1,"is_destination");
         $this->data["categories"] = $categories;
         $this->data["page"] = "home/index";
         $this->data["locations"] = $locations;
         $this->render("layouts/client_layout",$this->data);
      }
   }