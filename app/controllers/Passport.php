<?php

class Passport extends Controller
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
         ['name' => "Hộ chiếu", "link" => "ho-chieu"],
      ];
      $this->data["title"] = "Thông tin đăng ký hộ chiếu";
      $this->data['heading'] = "Hộ chiếu";
      $this->data["page"] = "passport/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
       $this->data['seo_title'] = "Hướng Dẫn Làm Hộ Chiếu Nhanh, Đơn Giản | Itravel";
       $this->data['seo_desc'] = "Hướng dẫn và hỗ trợ làm hộ chiếu nhanh, chuẩn bị hồ sơ, đặt lịch hẹn, nhận kết quả tại nhà.";
       $this->data['seo_og_title'] = "Dịch Vụ Làm Hộ Chiếu Uy Tín | Itravel";
       $this->data['seo_og_desc'] = "Làm hộ chiếu dễ dàng, thủ tục rõ ràng, tư vấn miễn phí, hỗ trợ tận nơi.";
       $this->data['seo_kw'] = "làm hộ chiếu, dịch vụ hộ chiếu, thủ tục hộ chiếu, đặt lịch hộ chiếu";

       $this->render("layouts/client_layout", $this->data);
   }
}