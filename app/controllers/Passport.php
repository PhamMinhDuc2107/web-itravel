<?php

class Passport extends Controller
{
   private $data;
   private $CategoryModel;
   private $LocationModel;
   public function __construct()
   {
      $this->CategoryModel= $this->model("CategoryModel");
      $this->LocationModel= $this->model("LocationModel");
   }
   public function index()
   {
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination'=>1]);
      $breadcrumbs =[
         ['name'=> "Hộ chiếu", "link"=>"ho-chieu"],
      ];
      $this->data["title"] = "Thông tin đăng ký hộ chiếu";
      $this->data['heading'] = "Hộ chiếu";
      $this->data["page"] = "passport/index";
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}