<?php

class Contact extends Controller
{
   private $data;
   private $CategoryModel;
   private $ConsultationModel;
   private $LocationModel;
   public function __construct() {
      $this->CategoryModel = $this->model('CategoryModel');
      $this->ConsultationModel = $this->model('ConsultationModel');
      $this->LocationModel = $this->model("LocationModel");

   }
   public function index(){
      $categories = $this->CategoryModel->all();
      $destination = $this->LocationModel->where(['is_destination' => 1]);
      $departure = $this->LocationModel->where(['is_departure'=>1]);
      $breadcrumbs =[
         ['name'=> "Liên hệ", "link"=>"lien-he"],
      ];
      $this->data["title"] = "Thông tin liên hệ";
      $this->data['heading'] = "Liên hệ";
      $this->data['locations'] = $destination;
      $this->data['categories'] = $categories;
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["page"] = "contact/index";
      $this->data['js'] ='contact';
      $this->render("layouts/client_layout", $this->data);
   }
   public function handleContactForm() {
      if(!Request::isMethod("POST")) {
         Util::redirect("lien-he", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("lien-he", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
      $customer_name= htmlspecialchars(Request::input("name"));
      $customer_email = htmlspecialchars(Request::input("email"));
      $tour_preference = htmlspecialchars(Request::input("reference"));
      $customer_phone = htmlspecialchars(Request::input("phone"));
      $message = htmlspecialchars(Request::input("content"));
      $data = ['customer_name'=>$customer_name, 'customer_email'=>$customer_email, 'tour_preference'=>$tour_preference, 'customer_phone'=>$customer_phone, 'message'=>$message];
      $res = $this->ConsultationModel->insert($data);
      if (!$res) {
         Util::redirect("lien-he", Response::internalServerError("Gửi yêu cầu thaats bại"));
      }
      Util::redirect("checkout/thankyou", Response::success("Thành công",  ['title'=>"Cảm ơn bạn đã quan tâm đến sản phẩm của chúng tôi!","content"=>"Chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất"]));
   }
}