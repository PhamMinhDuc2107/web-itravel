<?php

class BookingVehicle extends Controller
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
         ['name' => "Thuê xe du lịch", "link" => "thue-xe-du-lich"],
      ];
      $this->data["title"] = "Thuê xe du lịch";
      $this->data['heading'] = "Thuê xe du lịch";
      $this->data["page"] = "bookingVehicle/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
       $this->data['seo_title'] = "Thuê Xe Du Lịch Giá Rẻ, Đưa Đón Sân Bay | Itravel";
       $this->data['seo_desc'] = "Cho thuê xe du lịch 4-45 chỗ, xe tự lái, xe đưa đón sân bay, hợp đồng dài hạn. Giá cạnh tranh, tài xế chuyên nghiệp.";
       $this->data['seo_og_title'] = "Thuê Xe Du Lịch Uy Tín - Itravel";
       $this->data['seo_og_desc'] = "Thuê xe tiện lợi, đặt xe nhanh, đa dạng dòng xe, phục vụ 24/7.";
       $this->data['seo_kw'] = "thuê xe du lịch, thuê xe giá rẻ, xe đưa đón sân bay, thuê xe tự lái, xe 7 chỗ, xe 16 chỗ";

       $this->render("layouts/client_layout", $this->data);
   }
}
