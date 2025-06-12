<?php

class Home extends Controller
{
   private array $data = [];
   private $CategoryModel;
   private $LocationModel;
   private $BannerModel;
   private $BlogModel;
   private $TourModel;
   private array $categoryMap = [];
   private array $seoData = [
      'seo_desc' => "Hệ thống đặt tour du lịch, khách sạn online, visa,hộ chiếu",
      "seo_kw" => "Itravel, Du lịch, Tour du lịch, Khách sạn, Combo, Itravel.io.vn, Đặt tour du lịch, Đặt khách sạn, visa, hộ chiếu",
      'seo_og_title' => "Hệ thống bán tour hàng đầu Việt Nam | Du lịch Itravel",
      "seo_og_desc" => "Khám phá hàng trăm tour du lịch hấp dẫn, đặt khách sạn giá tốt, làm visa - hộ chiếu tiện lợi chỉ với vài bước tại Itravel."
   ];

   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->BannerModel = $this->model("BannerModel");
      $this->BlogModel = $this->model("BlogModel");
      $this->TourModel = $this->model("TourModel");
   }

   public function index()
   {
      $this->fetchHomeData();
      $this->buildCategoryMap();
      $this->processAllCategories();
      $this->setViewData();
      $this->render("layouts/client_layout", $this->data);
   }

   private function fetchHomeData(): void
   {
      $this->CategoryModel->setOrderBy("display_home");
      
      $this->data = [
         "banners" => $this->BannerModel->where(['status' => 1]),
         "categories" => $this->CategoryModel->all(),
         "destination" => $this->LocationModel->where(['is_destination' => 1]),
         "departure" => $this->LocationModel->where(['is_departure' => 1]),
         "tourHot" => $this->TourModel->getTours(['status_hot' => 1, "status" => "active"], true),
         "tours" => $this->TourModel->getTours(),
         "listCategoryHot" => $this->CategoryModel->where(["display_home" => 1]),
         "listLocationDisplayHome" => $this->LocationModel->where(["display_home" => 1]),
         "listLocationHot" => $this->LocationModel->where(['hot' => 1]),
         "listBlogHot" => $this->BlogModel->where(['status_hot' => 1, 'status' => "published"])
      ];
   }

   private function buildCategoryMap(): void
   {
      $this->categoryMap = array_column($this->data["listCategoryHot"], 'name', 'id');
   }

   private function processAllCategories(): void
   {
      $listTourCate = [];
      $listLocationCate = [];
      
      foreach ($this->data["tours"] as $tour) {
         $categoryName = $this->categoryMap[$tour['category_id']] ?? null;
         if ($categoryName) {
            $listTourCate[$categoryName]["tours"][] = $tour;
         }
      }
      
      foreach ($this->data["listLocationDisplayHome"] as $location) {
         $categoryName = $this->categoryMap[$location['category']] ?? null;
         if ($categoryName) {
            $listTourCate[$categoryName]["locations"][] = $location;
         }
      }
      
      foreach ($this->data["listLocationHot"] as $location) {
         $categoryName = $this->categoryMap[$location['category']] ?? null;
         if ($categoryName) {
            $listLocationCate[$categoryName][] = $location;
         }
      }
      
      $this->data["listTourCate"] = array_reverse($listTourCate);
      $this->data["listLocationCate"] = array_reverse($listLocationCate);
      $this->data["firstLocationCate"] = reset($listLocationCate) ?: [];
      $this->data["lastLocationCate"] = end($listLocationCate) ?: [];
   }

   private function setViewData(): void
   {
      $this->data = array_merge($this->data, [
         "page" => "home/index",
         "js" => "home"
      ], $this->seoData);
   }
}
