<?php
class Booking extends Controller {
   private $data;
   private $TourModel;
   private $LocationModel;
   private $CategoryModel;
   private $TourPriceCalendarModel;

   public function __construct()
   {
      $this->TourModel = $this->model("TourModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->CategoryModel = $this->model("CategoryModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
   }
   public function index($code) {
      $code_tour  = htmlspecialchars($code);
      $tour = $this->TourModel->getTour(['code_tour'=>$code_tour]);
      if(empty($tour)) {
         Util::loadError();
      }
      if(Request::has('date', "get")) {
         $date = htmlspecialchars(Request::input('date'));
         $date = date("Y-m-d", strtotime($date));
         $params = ["tour_id"=>$tour['id'],'date'=>$date];
         $priceTour = $this->TourPriceCalendarModel->where($params);
         $this->data['priceTour'] = $priceTour[0];
      }
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination'=>1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $breadcrumbs =[
         ['name'=> $tour['name'], "link"=>"chuong-trinh/".$tour['slug']],
         ['name'=>'Booking', "link" => "order-booking/".$code_tour],
      ];
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["title"] = "Đặt tour | ".$tour['name'];
      $this->data['heading'] = "Đặt tour";
      $this->data["page"] = "booking/index";
      $this->data["locations"] = $locations;
      $this->data["categories"] = $categories;
      $this->data['departure'] = $departure;
      $this->data['tour'] = $tour;
      $this->render("layouts/client_layout",$this->data);
   }
   public function checkout() {
      if(!Request::isMethod("post")) {
         Util::redirect("/");
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("/",Response::forbidden("Thất bại! Token không hợp lệ"));
      }
      $tourId = htmlspecialchars(Request::input("tour_id",""));
      $name = htmlspecialchars(Request::input("name", ""));
      $email = htmlspecialchars(Request::input("email", ""));
      $phone = htmlspecialchars(Request::input("phone",""));
      $address = htmlspecialchars(Request::input("address", ""));
      $quantityAdult = (int)htmlspecialchars(Request::input("adult", 0));
      $quantityChildren = (int)htmlspecialchars(Request::input("children",0) );
      $quantityInfant = (int)htmlspecialchars(Request::input("baby" , 0));
      $note = htmlspecialchars(Request::input("notes"));
      $totalPrice = htmlspecialchars(Request::input("totalPrice",0));
      $departure_date = htmlspecialchars(Request::input("departure_date",""));
      $data = ['tour_id'=>$tourId, "customer_name" => $name, "customer_email" => $email, "customer_phone"=>$phone, "customer_address" => $address,
      "num_adults" => $quantityAdult, "num_children" =>$quantityChildren, "num_infants" =>$quantityInfant,"note"=>$note,'total_price'=>$totalPrice,
         "departure_date"=>$departure_date
      ];
      Util::printArr($data);
   }
}
