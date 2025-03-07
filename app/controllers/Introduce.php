<?php
class Introduce extends Controller {
   private $data;
   private $CategoryModel;
   private $LocationModel;
   public function __construct() {
      $this->CategoryModel= $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
   }
   public function index() {
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(1,"is_destination");
      $breadcrumbs =[
         ['name'=> "Giới thiệu", "link"=>"gioi-thieu"],
      ];
      $this->data['categories'] = $categories;
      $this->data["title"] = "Thông tin về công ty";
      $this->data['heading'] = "Giới thiệu";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["page"] = "introduce/index";
      $this->data["locations"] = $locations;
      $this->render("layouts/client_layout", $this->data);
   }
}