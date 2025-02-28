<?php

class TourItinerary extends Controller
{
   private $jwt;
   private $data;
   private $TourItineraryModel;
   private $TourModel;
   public function __construct()
   {
      $this->TourItineraryModel = $this->model("TourItineraryModel");
      $this->TourModel = $this->model("TourModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if(!$checkAuth['success']) {
         Util::redirect("dashboard/login",Response::unauthorized($checkAuth['msg']));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("dashboard/tourItinerary",Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      Util::setBaseModel($this->TourItineraryModel);
      $totalPages =$this->TourItineraryModel->getTotalPages();
      $tourItineraries = $this->TourItineraryModel->get();
      $tours = $this->TourModel->getNameTours();
      $this->data['totalPages'] = $totalPages;
      $this->data['title'] = "Quản lý hành trình các tour";
      $this->data['page'] ="itineraries/index";
      $this->data['tourItineraries'] = $tourItineraries;
      $this->data['tours'] = $tours;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if(!Request::isMethod("post")) {
         Util::redirect("dashboard/tourItinerary", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $tourId = htmlspecialchars(Request::input('tour_id') ?? '');
      $dayNumber = htmlspecialchars(Request::input('day_number') ?? "");
      $title = htmlspecialchars(Request::input('title') ?? "");
      $content = Request::input('content') ?? '';
      $data = ["tour_id"=>$tourId, "day_number"=>$dayNumber, "title"=>$title, "content"=>$content];
      if($tourId === "" || $dayNumber === "" || $title === "" || $content === "") {
         Util::redirect("dashboard/tourItinerary", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $res = $this->TourItineraryModel->insert($data);
      if(!$res) {
         Util::redirect("dashboard/tourItinerary", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/tourItinerary", Response::success("Taạo thành công"));
   }
   public function update($id) {
      if($id <= 0 || !is_numeric($id)) {
         Util::redirect("dashboard/tourItinerary", Response::badRequest("Id không hợp lệ"));
      }
      $tourItinerary = $this->TourItineraryModel->find($id);
      $tourItineraries = $this->TourItineraryModel->get();
      $tours = $this->TourModel->getNameTours();
      $this->data['title'] = "Chỉnh sửa hành trình các tour";
      $this->data['page'] ="itineraries/form";
      $this->data['tourItineraries'] = $tourItineraries;
      $this->data['tours'] = $tours;
      $this->data['tourItinerary'] = $tourItinerary;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      $id = (Request::input('id') ?? 0);
      if($id <= 0 || !is_numeric($id) ) {
         Util::redirect("dashboard/tourItinerary", Response::badRequest("Id không hợp lệ"));
      }
      $tourItinerary = $this->TourItineraryModel->find($id);
      if(!$tourItinerary) {
         Util::redirect("dashboard/tourItinerary", Response::notFound("Không tìm thấy"));
      }
      $tourId = htmlspecialchars(Request::input('tour_id') ?? "");
      $dayNumber = htmlspecialchars(Request::input('day_number') ?? "");
      $title = htmlspecialchars(Request::input('title') ?? "");
      $content = Request::input('content') ?? "";
      if($tourId === "" && $dayNumber === "" && $title === "" && $content === "") {
         Util::redirect('dashboard/tourItinerary', Response::badRequest("không có sự thay đổi nào"));
      }
      $data = ['tour_id'=>$tourId, "day_number"=>$dayNumber, "title"=>$title, "content"=>$content];
      $data = Util::removeEmptyValues($data);
      var_dump($data);
      $res = $this->TourItineraryModel->update($data, $id);
      if(!$res) {
         Util::redirect("dashboard/tourItinerary", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/tourItinerary", Response::success("Cập nhật thành công"));
   }
   public function delete()
   {
      if(!Request::isMethod("post")) {
         Util::redirect("dashboard/tourItinerary", Response::methodNotAllowed("Phương thức không được chấp nhận"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/tourItinerary", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/tourItinerary", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->TourItineraryModel->delete($id);
      }
      Util::redirect('dashboard/tourItinerary',Response::success("Xóa thành công"));
   }
}