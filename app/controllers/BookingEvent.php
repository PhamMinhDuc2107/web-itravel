<?php

class BookingEvent extends Controller
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
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $breadcrumbs =[
         ['name'=> "Tổ chức sự kiện", "link"=>"to-chuc-su-kien"],
      ];
      $this->data["title"] = "Tổ chức sự kiện";
      $this->data['heading'] = "Tổ chức sự kiện";
      $this->data["page"] = "bookingHotel/index";
      $this->data['categories'] = $categories;
      $this->data['destination'] = $destination;
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}