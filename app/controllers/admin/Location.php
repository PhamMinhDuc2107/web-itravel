<?php
class Location  extends Controller{
   private $data;
   private $LocationModel;
   private $jwt;
   public function __construct(){
      $this->LocationModel = $this->model("LocationModel");
      $this->jwt = new JwtUtil();
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",ErrorResponse::unauthorized("Vui lòng đăng nhập lại"));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category",ErrorResponse::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index() {
    Util::setBaseModel($this->LocationModel);
    $totalPages =$this->LocationModel->getTotalPages();
    $locations = $this->LocationModel->get();
    $this->data['totalPages'] = $totalPages;
    $this->data['page']= 'index';
    $this->data['title'] = "Quản lý địa điểm tour";
    $this->data['page'] ="location/index";
    $this->data['locations'] = $locations;
    $this->render("layouts/admin_layout", $this->data);
   }
   public function create()
   {
      if (!Request::isMethod("post")) {
         Util::Redirect("cpanel/location", ErrorResponse::methodNotAllowed("Phương thức khoogn được phép"));
      }
      if(!Request::file("image") && empty(Request::file("image")['name'])) {
         Util::redirect("cpanel/location",ErrorResponse::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $pathAsset = '/public/uploads/location/';
      $checkCreateImgPath = Util::createImagePath("image", $pathAsset);
      if (!$checkCreateImgPath["success"]) {
         Util::redirect('cpanel/location', ErrorResponse::badRequest($checkCreateImgPath['msg']));
      }
      $thumb = $checkCreateImgPath['name'];
      $data = $this->prepareLocationData();
      $data['image'] = $thumb;
      $res = $this->LocationModel->insert($data);
      $id = $this->LocationModel->getLastInsertId();
      if (!$res) {
         Util::redirect("cpanel/location", ErrorResponse::internalServerError("Thêm không thanhf công"));
      }
      $checkUpload = Util::uploadImage("image", $thumb);
      if (!$checkUpload["success"]) {
         $this->LocationModel->delete($id);
         Util::redirect('cpanel/location', ErrorResponse::badRequest($checkUpload['msg']));
      }
      Util::redirect('cpanel/location', ['msg' => "Thêm thành công " , 'type' => "success"]);
   }
   public function update($id): void
   {
      $id = (int)$id;
      $location = $this->LocationModel->find($id);
      if(empty($location)) {
         Util::redirect("cpanel/blog",ErrorResponse::notFound("Không tìm thấy địa điểm để cập nhật"));
      }
      $this->data['page']= 'index';
      $this->data['title'] = "Sửa thông tin địa điểm của tour";
      $this->data['page'] ="location/form";
      $this->data['location'] = $location;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
       if(!Request::isMethod("POST")) {
          Util::Redirect("cpanel/location", ErrorResponse::methodNotAllowed("Phương thức không được phép"));
       }

       $id =(int)(Request::input("id")??0);
       $location = $this->LocationModel->find($id);
       if(!$location) {
         Util::redirect("cpanel/location",ErrorResponse::badRequest("Không tìm thất địa điểm"));
       }
       $data = $this->prepareLocationData();
       $img = Request::file("image");
       $oldImagePath = $location['image'];

       $newImagePath = null;
      if ($img && !empty($img['name'])) {
         $pathAsset = '/public/uploads/location/';
         $checkCreateImgPath = Util::createImagePath("image", $pathAsset);

         if (!$checkCreateImgPath["success"]) {
            Util::redirect('cpanel/location', ErrorResponse::badRequest($checkCreateImgPath['msg']));
         }
         $newImagePath = $checkCreateImgPath['name'];

         $data['image'] = $newImagePath;
      }
      $res = $this->LocationModel->update($data, $id);
      if (!$res) {
         Util::redirect("cpanel/location", ErrorResponse::internalServerError("Cập nhật không thành công"));
      }
      if($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage("image", $newImagePath);
         if (!$uploadSuccess["success"]) {
            Util::redirect('cpanel/location', ErrorResponse::badRequest($uploadSuccess['msg']));
         }
         $checkDeleteImg = Util::deleteImage(_DIR_ROOT.$oldImagePath);
         if (!$checkDeleteImg["success"]) {
            Util::redirect('cpanel/location',ErrorResponse::badRequest($checkDeleteImg['msg']));
         }
      }
      Util::redirect("cpanel/location", ["msg" => "Cập nhật thành công", "type" => "success"]);
   }
   public function delete(): void
   {
      if(Request::isMethod("POST")) {
         Util::redirect("cpanel/location",ErrorResponse::methodNotAllowed("Phương thức không được phép"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("cpanel/location", ErrorResponse::badRequest("Id không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("cpanel/location", ErrorResponse::badRequest("Id không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $blog = $this->BlogModel->find($id);
         $pathImg = _DIR_ROOT.'/'.$blog["image"];
         $checkDeleteImg = Util::deleteImage($pathImg);
         if(!$checkDeleteImg['success']) {
            Util::redirect("cpanel/location",ErrorResponse::badRequest($checkDeleteImg['message']));
         }
         $this->BlogModel->delete($id);
      }
      Util::redirect("cpanel/location", ["msg"=>"Xóa  thành công", "type" => "success"]);
   }
   private function prepareLocationData():array {
      $name = htmlspecialchars(Request::input("title")) ?? "";
      if ($name === "") {
          Util::Redirect("cpanel/location", ErrorResponse::badRequest("vui lòng điền đầy đủ thông tin"));
      }
      $slug = Util::generateSlug($name);
      $desc = htmlspecialchars(Request::input("description")) ?? "";
      $isDeparture = Request::input("is_departure") ? 1 : 0;
      $isDestination = Request::input("is_destination") ? 1 : 0;
      $data = [
        "name" => $name, "slug"=>$slug, "is_departure"=>$isDeparture, "is_destination"=>$isDestination, "description" => $desc
      ];
      return $data;
   }
}
