<?php
class HotelAmenity extends Controller
{
   private $data;
   private $AmenityModel;
   private $AmenityCategoryModel;
   private $jwt;
   public function __construct()
   {
      $this->AmenityModel = $this->model("AmenityModel");
      $this->AmenityCategoryModel = $this->model("AmenityCategoryModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/amenityCategory", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index()
   {
      $this->AmenityModel->setBaseModel();
      $totalPages = $this->AmenityModel->getTotalPages();
      $amenities = $this->AmenityModel->get();
      $amenityCategories  = $this->AmenityCategoryModel->all();
      $this->data['amenityCategories'] = $amenityCategories;
      $this->data['amenities'] = $amenities;
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = "amenity/index";
      $this->data['title'] = "Tiện ích khách sạn";
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelAmenity", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title")) ?? "";
      $category_id = (int)htmlspecialchars(Request::input("createdParentId")) ?? "";
      if ($name === "") {
         Util::Redirect("dashboard/hotelAmenity", Response::badRequest("Vui lòng điền đẩy đủ thông tin"));
      }
      $data = ["name" => $name, "category_id" => $category_id];
      $res =  $this->AmenityModel->insert($data);
      if (!$res) {
         Util::Redirect("dashboard/hotelAmenity", Response::internalServerError("Tạo không thành công"));
      }
      Util::redirect("dashboard/hotelAmenity", Response::success("Tạo thành công"));
   }
   public function update($id)
   {
      $amenity = $this->AmenityModel->find(htmlspecialchars($id));
      if (empty($amenity)) {
         Util::redirect("dashboard/hotelAmenity", Response::notFound("Không tìm thấy"));
      }
      $amenityCategories  = $this->AmenityCategoryModel->get();
      foreach ($amenityCategories as $item) {
         if ($item['id'] === $amenity['category_id']) {
            $this->data['parent'] = $item['name'];
         }
      }
      $this->data['amenityCategories'] = $amenityCategories;
      $this->data['page'] = 'index';
      $this->data['title'] = "Chỉnh sửa tiện ích khách sạn";
      $this->data['page'] = "amenity/form";
      $this->data['amenity'] = $amenity;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelAmenity", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $id = htmlspecialchars(Request::input("id"));
      if ($id <= 0 || !is_numeric($id)) {
         Util::Redirect("dashboard/hotelAmenity", Response::badRequest("Id không hợp lệ"));
      }
      $name = htmlspecialchars(Request::input("title"));
      if ($name === "") {
         Util::redirect('cpanel/hotelAmenity', Response::badRequest("vui lòng điền đẩy đủ thông tin"));
      }
      $category_id = (int)htmlspecialchars(Request::input("parent"));
      $data = ["name" => $name];
      if ($category_id) {
         $data['category_id'] = $category_id;
      }
      $res = $this->AmenityModel->update($data, $id);
      if (!$res) {
         Util::Redirect("dashboard/hotelAmenity", Response::internalServerError("Cập nhật không thành công"));
      }
      Util::redirect("dashboard/hotelAmenity", Response::success("cập nhật thành cồng"));
   }
   public function delete(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelAmenity", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/hotelAmenity", Response::notFound("Không tìm thấy ID"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/hotelAmenity", Response::badRequest("ID Không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $this->AmenityModel->delete($id);
      }
      Util::redirect("dashboard/hotelAmenity", Response::success("Xóa thành công"));
   }
   public function getHotelAmenityAjax()
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/hotelAmenity", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $amenityCategoryId = (int)htmlspecialchars(Request::input("amenityCategoryId", 0));
      $dataHotelAmenities  = $this->AmenityModel->where(['category_id' => $amenityCategoryId]);
      if (isset($data[0]) && empty($data[0])) {
         echo json_encode(Response::success("NotFound"));
         exit();
      }
      echo json_encode(Response::success("Oke", $dataHotelAmenities));
   }
}
