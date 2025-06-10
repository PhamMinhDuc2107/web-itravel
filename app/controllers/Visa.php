<?php

class Visa extends Controller
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
         ['name' => "Visa", "link" => "Visa"],
      ];
      $this->data["title"] = "Thông tin đăng ký visa";
      $this->data['heading'] = "Visa";
      $this->data["page"] = "visa/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
       $this->data['seo_title'] = "Dịch Vụ Làm Visa Nhanh, Uy Tín | Itravel.com";
       $this->data['seo_desc'] = "Cung cấp dịch vụ làm visa đi du lịch, công tác, thăm thân cho các quốc gia trên toàn thế giới. Thủ tục đơn giản, hỗ trợ tận tình.";
       $this->data['seo_og_title'] = "Làm Visa Du Lịch Uy Tín - Itravel";
       $this->data['seo_og_desc'] = "Đặt lịch làm visa nhanh chóng, tỷ lệ đậu cao, hỗ trợ 1:1, giá cả hợp lý.";
       $this->data['seo_kw'] = "làm visa, dịch vụ visa uy tín, visa du lịch, visa đi Mỹ, visa đi Hàn Quốc, visa Châu Âu, visa Châu Á";

       $this->render("layouts/client_layout", $this->data);
   }
}