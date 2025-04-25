<?php

class ContactService extends Controller
{
   private $data;
   private $CategoryModel;
   private $LocationModel;
   public function __construct()
   {
      $this->CategoryModel = $this->model("CategoryModel");
      $this->LocationModel = $this->model("LocationModel");
   }
   public function index(string $title = "")
   {
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure' => 1]);
      $breadcrumbs = [
         ['name' => "Liên hệ tư vấn " . $this->slugToTitle($title), "link" => "lien-he-tu-van-" . $title],
      ];
      $this->data["title"] = "Liên hệ tư vấn " . $this->slugToTitle($title);
      $this->data['formField'] = $title;
      $this->data["page"] = "contactService/index";
      $this->data["destination"] = $destination;
      $this->data["departure"] = $departure;
      $this->data["categories"] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->render("layouts/client_layout", $this->data);
   }
   private function slugToTitle($slug)
   {
      $map = [
         "ve-may-bay" => "vé máy bay",
         "visa" => "visa",
         "ho-chieu" => "hộ chiếu",
         "dat-phong-khach-san" => "đặt phòng khách sạn",
         "thue-xe-du-lich" => "thuê xe du lịch",
         "to-chuc-su-kien" => "tổ chức sự kiện",
         "the-tam-tru-cho-nguoi-nuoc-ngoai" => "thẻ tạm trú cho người nước ngoài",
         "giay-phep-lao-dong-cho-nguoi-nuoc-ngoai" => "giấy phép lao động cho người nước ngoài",
         "can-cuoc-cong-dan" => "căn cước công dân",
      ];

      return $map[$slug] ?? ucfirst(str_replace('-', ' ', $slug)); // fallback
   }
}
