<?php

class Hotel extends Controller
{
   private $data = [];
   private $CategoryModel;
   private $LocationModel;
   private $HotelModel;
   private $HotelAmenityModel;
   private $HotelImageModel;

   
   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->HotelModel = $this->model("HotelModel");
      $this->HotelAmenityModel = $this->model("HotelAmenityModel");
      $this->HotelImageModel = $this->model("HotelImageModel");
   }
   public function index()
   {
      $this->HotelModel->setBaseModel();
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $hotels =$this->HotelModel->getHotels();
      $hotelImages = $this->HotelImageModel->all();
      $hotelAmenities = $this->HotelAmenityModel->getAmenities();
      $dataHotels = [];
      foreach($hotels as $key => $hotel) {
         $dataHotels[$hotel['id']] = $hotel;
         $dataImages = [];
         foreach($hotelImages as $hotelImage) {
            if($hotel['id'] !== $hotelImage['hotel_id']) {
               continue;
            }
            $dataImages[] = $hotelImage;
         }
         $dataHotelAmenities = [];
         foreach($hotelAmenities as $hotelAmenity) {
            if($hotel['id'] !== $hotelAmenity['hotel_id']) {
               continue;
            }
            $dataHotelAmenities[] = $hotelAmenity;
         }
         $dataHotels[$hotel['id']]['images'] = $dataImages;
         $dataHotels[$hotel['id']]['amenities'] = $dataHotelAmenities;
      }
      $breadcrumbs = [
         ['name' => "Đặt phòng khách sạn", "link" => "dat-phong-khach-san"],
      ];
      $this->data["title"] = "Đặt phòng khách sạn";
      $this->data['heading'] = "Đặt phòng khách sạn";
      $this->data["page"] = "hotel/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['hotels'] = $dataHotels;
      $this->render("layouts/client_layout", $this->data);
   }
   public function detail($slug) {
      $hotel  = $this->HotelModel->find(htmlspecialchars($slug), "slug");
      if(!$hotel) {
         Util::loadError("404");
      }
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $res = $this->HotelAmenityModel->getHotelAmenityCategoryNames($hotel["id"]);
      $breadcrumbs = [
         ['name' => "Khách sạn", "link" => "khach-san"],
         ['name' => $hotel["name"], "link" => "khach-san/".$hotel["slug"]],
      ];
      $this->data['page'] ="hotel/detail";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data['title'] = $hotel['name'];
      $this->data['heading'] = $hotel['name'];
      $this->render('layouts/client_layout', $this->data);
   }
}
