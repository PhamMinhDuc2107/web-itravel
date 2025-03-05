<?php
class Introduce extends Controller {
   private $data;
   private $CategoryModel;
   public function __construct() {
      $this->CategoryModel= $this->model("CategoryModel");
   }
   public function index() {
      $category = $this->CategoryModel->where(0, "parent_id");
      $breadcrumbs =[
         ['name'=> "Giới thiệu", "link"=>"gioi-thieu"],
      ];
      $this->data['categories'] = $category;
      $this->data["title"] = "Thông tin về công ty";
      $this->data['heading'] = "Giới thiệu";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["page"] = "introduce/index";
      $this->render("layouts/client_layout", $this->data);
   }
}