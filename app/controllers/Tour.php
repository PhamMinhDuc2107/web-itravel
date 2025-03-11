<?php

class Tour extends Controller {
   private $data;
   private $TourModel;
   private $CategoryModel;
   private $LocationModel;
   private $TourImgModel;
   private $TourPriceCalendarModel;
   public function __construct() 
   {
      $this->TourModel = $this->model("TourModel"); 
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->TourImgModel = $this->model("TourImgModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
   }
   public function index() {
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination'=>1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $this->TourModel->setLimit(9);
      $this->TourModel->setBaseModel();
      $totalPages = $this->TourModel->getTotalPages();
      $tours = $this->TourModel->getTours();
      $breadcrumbs =[
         ['name'=> "Tất cả tour", "link"=>"collections/all"],
      ];
      $this->data["title"] = "Tất cả tour";
      $this->data['heading'] = "Tất cả tour";
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['totalPages'] = $totalPages;
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data['tours'] = $tours;
      $this->data["page"] = "tour/index";
      $this->render("layouts/client_layout",$this->data);
   }
   public function detail($slug) {
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination'=>1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);

      $condition = ['slug'=> htmlspecialchars($slug)];
      $tour = $this->TourModel->getTour($condition);
      $breadcrumbs =[
         ['name'=> $tour['name'], "link"=>"/chuong-tring/".$tour['slug']],
      ];
      if(empty($tour) && !is_array($tour)) {
         Util::loadError();
      }
      $relatedTour  =$this->TourModel->getTours(['category_id'=>$tour['category_id']], true);
      $listImg  = $this->TourImgModel->where(['tour_id'=>$tour["id"]]);
      $listPriceCalendar = $this->TourPriceCalendarModel->where(['tour_id'=>$tour["id"]]);
      $this->data["title"] = $tour['name'];
      $this->data['heading'] = $tour['name'];
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['categories'] = $categories;
      $this->data['locations'] = $locations;
      $this->data['tour'] = $tour;
      $this->data['listImg'] = $listImg;
      $this->data['listPriceCalendar'] = $listPriceCalendar;
      $this->data['relatedTour'] = $relatedTour;
      $this->data["page"] = "tour/detail";
      $this->render("layouts/client_layout",$this->data);
   }
   public function getPrice() {
      $tourId = $_GET['tour_id'];
      $date = DateTime::createFromFormat('d-m-Y', $_GET['date'])->format('Y-m-d');
      $price = $this->TourPriceCalendarModel->where(['tour_id'=>$tourId, 'date'=>$date]);

      if ($price) {
         echo json_encode(['success' => true, 'adult_price' => number_format($price[0]['adult_price'], 0, ",", ".")."đ"]);
      } else {
         echo json_encode(['success' => false, 'message' => 'Không tìm thấy giá.']);
      }
   }
   public function findTourByCategory($slug) {

   }
}