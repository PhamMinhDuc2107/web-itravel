<?php

class BookingFilght extends Controller
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
         ['name'=> "Vé máy bay", "link"=>"ve-may-bay"],
      ];
      $this->data["title"] = "Vé máy bay";
      $this->data['heading'] = "Vé máy bay";
      $this->data["page"] = "bookingFilght/index";
      $this->data['categories'] = $categories;
      $this->data['destination'] = $destination;
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}