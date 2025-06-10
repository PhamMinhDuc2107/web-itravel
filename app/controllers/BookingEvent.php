<?php

class BookingEvent extends Controller
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
         ['name' => "Tổ chức sự kiện", "link" => "to-chuc-su-kien"],
      ];
      $this->data["title"] = "Tổ chức sự kiện";
      $this->data['heading'] = "Tổ chức sự kiện";
      $this->data["page"] = "event/index";
      $this->data['categories'] = $categories;
      $this->data['destination'] = $destination;
      $this->data['departure'] = $departure;
      $this->data['breadcrumbs'] = $breadcrumbs;
       $this->data['seo_title'] = "Tổ Chức Sự Kiện Chuyên Nghiệp | Hội Nghị - Hội Thảo - Du Lịch Teambuilding | Itravel";

       $this->data['seo_desc'] = "Itravel cung cấp dịch vụ tổ chức sự kiện trọn gói: hội nghị khách hàng, hội thảo, gala dinner, team building, sự kiện doanh nghiệp... với ekip chuyên nghiệp, chi phí hợp lý.";

       $this->data['seo_og_title'] = "Dịch Vụ Tổ Chức Sự Kiện Trọn Gói - Itravel";

       $this->data['seo_og_desc'] = "Tư vấn, lên ý tưởng, thực hiện sự kiện chuyên nghiệp cho doanh nghiệp, cá nhân. Dẫn chương trình, âm thanh ánh sáng, quay phim chụp hình đầy đủ.";

       $this->data['seo_kw'] = "tổ chức sự kiện, tổ chức hội nghị, gala dinner, tổ chức hội thảo, team building, sự kiện doanh nghiệp";

       $this->render("layouts/client_layout", $this->data);
   }
}
