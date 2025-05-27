<?php

class Home extends Controller
{
   private $data = [];
   private $CategoryModel;
   private $LocationModel;
   private $BannerModel;
   private $BlogModel;
   private $TourModel;

   public function __construct()
   {
      $this->CategoryModel = $this->Model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->BannerModel = $this->model("BannerModel");
      $this->BlogModel = $this->model("BlogModel");
      $this->TourModel = $this->model("TourModel");
   }

   public function index()
   {
      $banners = $this->BannerModel->where(['status' => 1]);
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $listTourHot = $this->TourModel->getTours(['status_hot' => 1, "status" => "active"], true);
      $tours = $this->TourModel->getTours();
      $this->CategoryModel->setOrder("display_home");
      $listCategoryHot = $this->CategoryModel->where(["display_home" => 1]);
      $listLocationDisplayHome = $this->LocationModel->where(["display_home" => 1]);
      $listTourCate = [];

      foreach ($tours as $tour) {
         foreach ($listCategoryHot as $category) {
            if ($tour['category_id'] == $category['id']) {
               $listTourCate[$category['name']]["tours"][] = $tour;
            }
         }
      }
      foreach ($listLocationDisplayHome as $location) {
         foreach ($listCategoryHot as $category) {
            if ($location['category'] == $category['id']) {
               $listTourCate[$category['name']]["locations"][] = $location;
            }
         }
      }
      $listTourCate = array_reverse($listTourCate);
      $listLocationHot = $this->LocationModel->where(['hot' => 1]);
      $listLocationCate = [];
      foreach ($listLocationHot as $location) {
         foreach ($listCategoryHot as $category) {
            if ($location['category'] == $category['id']) {
               $listLocationCate[$category['name']][] = $location;
            }
         }
      }
      $listLocationCate = array_reverse($listLocationCate);
      $firstLocationCate = reset($listLocationCate);
      $lastLocationCate = end($listLocationCate);
      $listBlogHot = $this->BlogModel->where(['status_hot' => 1, 'status' => "published"]);
      $this->data["firstLocationCate"] = $firstLocationCate;
      $this->data["lastLocationCate"] = $lastLocationCate;
      $this->data["page"] = "home/index";
      $this->data["tours"] = $tours;
      $this->data["banners"] = $banners;
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data["tourHot"] = $listTourHot;
      $this->data["listCategoryHot"] = $listCategoryHot;
      $this->data["listLocationHot"] = $listLocationHot;
      $this->data["listTourCate"] = $listTourCate;
      $this->data["listLocationCate"] = $listLocationCate;
      $this->data["listBlogHot"] = $listBlogHot;
      $this->data["js"] = "home";
      $this->render("layouts/client_layout", $this->data);
   }
}
