<?php
   class Home extends Controller {
      private $data = [];
      private $CategoryModel;
      private $LocationModel;
      private $BannerModel;
      private $BlogModel;
      private $TourModel;
      public function __construct() {
         $this->CategoryModel = $this->Model("CategoryModel");
         $this->LocationModel =$this->model("LocationModel");
         $this->BannerModel = $this->model("BannerModel");
         $this->BlogModel = $this->model("BlogModel");
         $this->TourModel = $this->model("TourModel");
      }
      public function index() {
         $categories = $this->CategoryModel->all();
         $banners  = $this->BannerModel->where(['status'=>1]);
         $locations = $this->LocationModel->where(['is_destination'=>1]);
         $listTourHot = $this->TourModel->getTours(['status_hot'=>1],true);
         $tours = $this->TourModel->getTours();

         $this->CategoryModel->setColOrderBy("display_home");
         $listCategoryHot = $this->CategoryModel->where(["display_home"=>1]);
         $listLocationDisplayHome = $this->LocationModel->where(["display_home"=>1]);
         $listTourCate = [];

         foreach ($tours as $tour) {
            foreach ($listCategoryHot as $category) {
               if($tour['category_id'] == $category['id']) {
                  $listTourCate[$category['name']]["tours"][] = $tour;
               }
            }
         }
         foreach ($listLocationDisplayHome as $location) {
            foreach ($listCategoryHot as $category) {
               if($location['category'] == $category['id']) {
                  $listTourCate[$category['name']]["locations"][] = $location;
               }
            }
         }
         $listTourCate = array_reverse($listTourCate);
         $listLocationHot  =$this->LocationModel->where(['hot'=>1]);
         $listLocationCate = [];
         foreach ($listLocationHot as $location) {
            foreach ($listCategoryHot as $category) {
               if($location['category'] == $category['id']) {
                  $listLocationCate[$category['name']][] = $location;
               }
            }
         }
         $listLocationCate = array_reverse($listLocationCate);
         $firstLocationCate = reset($listLocationCate);
         $lastLocationCate = end($listLocationCate);
         $listBlogHot = $this->BlogModel->where(['status'=>1,'status' => "published"]);
         $this->data["firstLocationCate"] = $firstLocationCate;
         $this->data["lastLocationCate"] = $lastLocationCate;
         $this->data["page"] = "home/index";
         $this->data["banners"] = $banners;
         $this->data["locations"] = $locations;
         $this->data["categories"] = $categories;
         $this->data["tourHot"] = $listTourHot;
         $this->data["listCategoryHot"] = $listCategoryHot;
         $this->data["listLocationHot"] = $listLocationHot;
         $this->data["listTourCate"] = $listTourCate;
         $this->data["listLocationCate"] = $listLocationCate;
         $this->data["listBlogHot"] = $listBlogHot;
         $this->render("layouts/client_layout",$this->data);
      }
   }