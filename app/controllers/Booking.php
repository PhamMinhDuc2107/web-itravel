<?php
class Booking extends Controller {
   private $data;
   private $TourModel;
   private $LocationModel;
   private $CategoryModel;
   private $TourPriceCalendarModel;
   private $BookingModel;
   private $jwt;
   public function __construct()
   {
      $this->jwt = new JwtUtil();
      $this->TourModel = $this->model("TourModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->CategoryModel = $this->model("CategoryModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
      $this->BookingModel = $this->model("BookingModel");
   }
   public function index($code) {
      $code_tour  = htmlspecialchars($code);
      $tour = $this->TourModel->getTour(['code_tour'=>$code_tour]);
      if(empty($tour)) {
         Util::loadError();
      }
      $date = htmlspecialchars(Request::input('date'));
      $date = date("Y-m-d", strtotime($date));
      $params = ["tour_id"=>$tour['id'],'date'=>$date];
      $priceTour = $this->TourPriceCalendarModel->where($params);
      if(empty($priceTour)) {
         Util::loadError();
      }
      $this->data['priceTour'] = $priceTour[0];
      $categories = $this->CategoryModel->all();
      $locations = $this->LocationModel->where(['is_destination'=>1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $breadcrumbs =[
         ['name'=> $tour['name'], "link"=>"du-lich/".$tour['slug']],
         ['name'=>'Booking', "link" => "order-booking/".$code_tour.'/#'],
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
      $bookingCode = Util::generateBookingCode();
      $tourId = htmlspecialchars(Request::input("tour_id",""));
      $name = htmlspecialchars(Request::input("name", ""));
      $email = htmlspecialchars(Request::input("email", ""));
      $phone = htmlspecialchars(Request::input("phone",""));
      $quantityAdult = (int)htmlspecialchars(Request::input("adult", 0));
      $quantityChildren = (int)htmlspecialchars(Request::input("children",0) );
      $quantityInfant = (int)htmlspecialchars(Request::input("baby" , 0));
      $note = htmlspecialchars(Request::input("notes"));
      $totalPrice = htmlspecialchars(Request::input("totalPrice",0));
      $departure_date = htmlspecialchars(Request::input("departure_date",""));
      $departure_date =DateTime::createFromFormat("d-m-Y", $departure_date);
      $departure_date = $departure_date->format("Y-m-d");
      $data = ['booking_code'=>$bookingCode,'tour_id'=>$tourId, "customer_name" => $name, "customer_email" => $email, "customer_phone"=>$phone,
      "num_adults" => $quantityAdult, "num_children" =>$quantityChildren, "num_infants" =>$quantityInfant,"notes"=>$note,'total_price'=>$totalPrice,
         "departure_date"=>$departure_date
      ];
      $res = $this->BookingModel->insert($data);
      if(!$res) {
         Util::redirect("", Response::internalServerError("Thất bại"));
      }
      $id = $this->BookingModel->lastInsertId();
      $booking = $this->BookingModel->getBookingById($id);
      $payload = $this->jwt->generatePayload($booking,0);
      $token = $this->jwt->encode($payload);
      Util::redirect("checkout/thankyou", Response::success("Thành công", ["token"=>$token,'title'=>"Cảm ơn bạn đã đặt tour!","content"=>"Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhât"]));
   }

}
