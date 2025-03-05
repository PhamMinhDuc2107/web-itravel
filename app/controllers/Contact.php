<?php

class Contact extends Controller
{
   private $data;
   private $CategoryModel;
   private $ConsultationModel;
   public function __construct() {
      $this->CategoryModel = $this->model('CategoryModel');
      $this->ConsultationModel = $this->model('ConsultationModel');
   }
   public function index(){
      $category = $this->CategoryModel->where(0, "parent_id");
      $breadcrumbs =[
         ['name'=> "Liên hệ", "link"=>"lien-he"],
      ];
      $this->data['categories'] = $category;
      $this->data["title"] = "Thông tin liên hệ";
      $this->data['heading'] = "Liên hệ";
      $this->data['breadcrumbs'] = $breadcrumbs;
      $this->data["page"] = "contact/index";
      $this->data['js'] ='contact.js';
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
      $tour_reference = htmlspecialchars(Request::input("reference"));
      $customer_phone = htmlspecialchars(Request::input("phone"));
      $message = htmlspecialchars(Request::input("content"));
      $data = ['customer_name'=>$customer_name, 'customer_email'=>$customer_email, 'tour_reference'=>$tour_reference, 'customer_phone'=>$customer_phone, 'message'=>$message];
      $res = $this->ConsultationModel->insert($data);
      if (!$res) {
         Util::redirect("lien-he", Response::internalServerError("Gửi yêu cầu thaats bại"));
      }
      Util::redirect("lien-he", Response::success("Gửi yêu cầu thành công"));
   }
}