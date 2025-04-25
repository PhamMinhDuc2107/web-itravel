<?php

class IdentityCard extends Controller
{
   private $data;
   private $CategoryModel;
   private $LocationModel;
   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
   }
   public function index()
   {
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $breadcrumbs = [
         ['name' => "Căn cước công dân", "link" => "can-cuoc-cong-dan"],
      ];
      $this->data["title"] = "Căn cước công dân";
      $this->data["page"] = "identityCard/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
}
