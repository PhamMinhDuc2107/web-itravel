<?php

class Banner extends Controller
{
   private $data;
   private $BannerModel;
   private $jwt;

   public function __construct()
   {
      $this->BannerModel  = $this->model("BannerModel");
      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if (!$checkAuth['success']) {
         Util::redirect("dashboard/login", Response::unauthorized($checkAuth['msg']));
      }
      if (!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category", Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }

   public function index()
   {
      $this->BannerModel->setBaseModel();

      $data = $this->BannerModel->get();
      $totalPages = $this->BannerModel->getTotalPages();
      $this->data['data'] = $data;
      $this->data['totalPages'] = $totalPages;
      $this->data['page'] = 'index';
      $this->data['title'] = "Quản lý banner";
      $this->data['page'] = "banner/index";
      $this->render("layouts/admin_layout", $this->data);
   }

   public function create()
   {
      if (!Request::isMethod("post")) {
         Util::Redirect("dashboard/banner", Response::methodNotAllowed("Phương thức khoogn được phép"));
      }
      $file = Request::file("image") ?? [];
      if (!$file && empty($file['name'])) {
         Util::redirect("dashboard/banner", Response::badRequest("Vui lòng điền đầy đủ thông tin"));
      }
      $pathAsset = '/public/uploads/banner/';
      $checkCreateImgPath = Util::createImagePath($file, $pathAsset);
      if (!$checkCreateImgPath["success"]) {
         Util::redirect('dashboard/banner', Response::badRequest($checkCreateImgPath['msg']));
      }

      $thumb = $checkCreateImgPath['name'];
      $title = htmlspecialchars(Request::input("title") ?? "");
      $status = (int)htmlspecialchars(Request::input("status") === "1" ? 1 : 0);
      $order = (int)htmlspecialchars(Request::input("order")?? "");
      $data =["image" => $thumb, "title" => $title, "status" => $status, "sort_order" => $order];
      $res = $this->BannerModel->insert($data);
      if (!$res) {
         Util::redirect("dashboard/banner", Response::internalServerError("Thêm không thành công"));
      }
      $id = $this->BannerModel->getLastInsertId();
      $checkUpload = Util::uploadImage($file, $thumb);
      if (!$checkUpload["success"]) {
         $this->BannerModel->delete($id);
         Util::redirect('dashboard/banner', Response::badRequest($checkUpload['msg']));
      }
      Util::redirect('dashboard/banner', Response::success("Tạo thành công"));
   }

   public function update($id): void
   {
      $id = (int)$id;
      $banner = $this->BannerModel->find($id);
      if (empty($banner)) {
         Util::redirect("dashboard/banner", Response::notFound("Không tìm thấy Id"));
      }
      $this->data['page'] = 'index';
      $this->data['title'] = "Sửa thông tin của banner";
      $this->data['page'] = "banner/form";
      $this->data['banner'] = $banner;
      $this->render("layouts/admin_layout", $this->data);
   }

   public function updatePost()
   {
      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/banner", Response::methodNotAllowed("Phương thức không được phép"));
      }

      $id = (int)(Request::input("id") ?? 0);
      $banner = $this->BannerModel->find($id);
      if (!$banner) {
         Util::redirect("dashboard/banner", Response::badRequest("Không tìm thấy ID"));
      }
      $title = htmlspecialchars(Request::input("title") ?? "");
      $status = (int)htmlspecialchars(Request::input("status") === "1" ? 1 : 0);
      $order = (int)htmlspecialchars(Request::input("sort_order")?? "");
      $data =["title" => $title, "status" => $status, "sort_order" => $order];
      $data = Util::removeEmptyValues($data);

      $img = Request::file("image");
      $oldImagePath = $banner['image'];
      $newImagePath = null;
      if ($img && !empty($img['name'])) {
         $pathAsset = '/public/uploads/banner/';
         $checkCreateImgPath = Util::createImagePath($img, $pathAsset);

         if (!$checkCreateImgPath["success"]) {
            Util::redirect('dashboard/banner', Response::badRequest($checkCreateImgPath['msg']));
         }
         $newImagePath = $checkCreateImgPath['name'];

         $data['image'] = $newImagePath;
      }
      $res = $this->BannerModel->update($data, $id);
      if (!$res) {
         Util::redirect("dashboard/banner", Response::internalServerError("Cập nhật không thành công"));
      }
      if ($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage($img, $newImagePath);
         if (!$uploadSuccess["success"]) {
            Util::redirect('dashboard/banner', Response::badRequest($uploadSuccess['msg']));
         }
         $checkDeleteImg = Util::deleteImage(_DIR_ROOT . $oldImagePath);
         if (!$checkDeleteImg["success"]) {
            Util::redirect('dashboard/banner', Response::badRequest($checkDeleteImg['msg']));
         }
      }
      Util::redirect("dashboard/banner", Response::success("Cập nhật thành công"));
   }

   public function delete(): void
   {
      if (!Request::isMethod("POST")) {
         Util::redirect("dashboard/banner", Response::methodNotAllowed("Phương thức không được phép"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/banner", Response::badRequest("Id không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/banner", Response::badRequest("Id không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $blog = $this->BannerModel->find($id);
         $pathImg = _DIR_ROOT  . $blog["image"];
         $checkDeleteImg = Util::deleteImage($pathImg);
         if (!$checkDeleteImg['success']) {
            Util::redirect("dashboard/banner", Response::badRequest($checkDeleteImg['message']));
         }
         $this->BannerModel->delete($id);
      }
      Util::redirect("dashboard/banner", Response::success("Xóa thành công"));
   }

}
