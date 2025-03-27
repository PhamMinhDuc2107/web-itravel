<?php

class BookingHotel extends Controller
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
         ['name'=> "Đặt phòng khách sạn", "link"=>"dat-phong-khach-san"],
      ];
      $this->data["title"] = "Đặt phòng khách sạn";
      $this->data['heading'] = "Đặt phòng khách sạn";
      $this->data["page"] = "bookingHotel/index";
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}