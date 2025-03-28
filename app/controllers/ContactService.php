<?php

class ContactService extends Controller
{
   private $data;
   private $CategoryModel;
   private $LocationModel;
   public function __construct()
   {
      $this->CategoryModel= $this->model("CategoryModel");
      $this->LocationModel= $this->model("LocationModel");
   }
   public function index(string $title = "")
   {
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $breadcrumbs =[
         ['name'=> "Liên hệ tư vấn ".$title, "link"=>"lien-he-tu-van-".$title],
      ];
      $this->data["title"] = "Liên hệ tư vấn ".$title;
      $this->data['heading'] = "Liên hệ tư vấn ".$title;
      $this->data["page"] = "contactService/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] =$breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}