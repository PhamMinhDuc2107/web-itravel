<?php

class Visa extends Controller
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
         ['name'=> "Visa", "link"=>"Visa"],
      ];
      $this->data["title"] = "Thông tin đăng ký visa";
      $this->data['heading'] = "Visa";
      $this->data["page"] = "visa/index";
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}