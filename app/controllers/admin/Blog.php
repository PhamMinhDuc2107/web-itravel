<?php
class Blog extends Controller
{
   private $data;
   private $BlogModel;
   private $AdminModel;
   private$BlogCategoryModel;
   private $jwt;
   function __construct()
   {
      $this->BlogModel = $this->model("BlogModel");
      $this->AdminModel = $this->model("AdminModel");
      $this->BlogCategoryModel = $this->model("BlogCategoryModel");

      $this->jwt = new JwtUtil();
      $checkAuth = $this->jwt->checkAuth("token_auth");
      if(!$checkAuth['success']) {
         Util::redirect("dashboard/login",Response::unauthorized($checkAuth['msg']));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("dashboard/category",Response::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index() {
      $this->BlogModel->setBaseModel();
      $data = $this->BlogModel->getBlogs();
      $totalPages = $this->BlogModel->getTotalPages();
      $blogCategories = $this->BlogCategoryModel->all();
      $admins = $this->AdminModel->all();
      $this->data['title'] = "Quản lý tin tức";
      $this->data['totalPages'] = $totalPages;
      $this->data['blogs'] = $data;
      $this->data['page'] ="blog/index";
      $this->data['admins'] = $admins;
      $this->data['blogCategories'] = $blogCategories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (!Request::isMethod("post")) {
         Util::redirect("dashboard/location",Response::methodNotAllowed("Phương thức không hợp lệ"));

      }
      if(!Request::file("image") && empty(Request::file("image")['name'])) {
         Util::redirect("dashboard/location",Response::badRequest("Vui lòng chọn ảnh"));
      }
      $pathAsset = '/public/uploads/blog/';
      $file = Request::file("image");
      $check = Util::createImagePath($file, $pathAsset);
      if (!$check["success"]) {
         Util::redirect('dashboard/blog', Response::badRequest($check["msg"]));
      }
      $thumb = $check['name'];
      $data = $this->prepareBlogData();
      $data['thumbnail'] = $thumb;
      $res = $this->BlogModel->insert($data);
      $id = $this->BlogModel->getLastInsertId();
      if (!$res) {
         Util::redirect("dashboard/blog", Response::internalServerError("Thêm không thành công"));
      }
      $checkUpload = Util::uploadImage($file, $thumb);
      if (!$checkUpload["success"]) {
         $this->BlogModel->delete($id);
         Util::redirect('dashboard/blog', Response::badRequest("Thêm thành công, nhưng tải ảnh thất bại: " . $checkUpload["msg"]));
      }
      Util::redirect('dashboard/blog', Response::success("Thêm thành công "));
   }

   public function update($id): void
   {
      $id = (int)htmlspecialchars($id);
      $blog = $this->BlogModel->find($id);
      $blogCategories = $this->BlogCategoryModel->all();
      $admins = $this->AdminModel->all();
      $categoryName  = $this->BlogCategoryModel->find($blog['category_id'])['name'];
      $authorName = $this->AdminModel->find($blog['author_id'])["username"];
      if(empty($blog)) {
         Util::redirect("dashboard/blog",Response::notFound("không tìm thấy tin tức"));
      }
      $this->data['title'] = "Sửa thông tin tin tức";
      $this->data['page'] ="blog/form";
      $this->data['blog'] = $blog;
      $this->data['admins'] = $admins;
      $this->data['blogCategories'] = $blogCategories;
      $this->data['categoryName'] = $categoryName;
      $this->data['authorName'] = $authorName;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function updatePost() {
      if (!Request::isMethod("POST")) {
         Util::Redirect("dashboard/location", Response::methodNotAllowed("Phương thức không được phép"));
      }
      $id = (int)(Request::input("id") ?? 0);
      $blog = $this->BlogModel->find($id);
      if (!$blog) {
          Util::redirect("dashboard/blog", Response::notFound("Không tìm thấy blog"));
      }
      $data = $this->prepareBlogData(true);
      $thumb = Request::file("image");
      $oldImagePath = $blog["thumbnail"];
      $newImagePath = null;
      if ($thumb && !empty($thumb['name'])) {
          $pathAsset = '/public/uploads/blog/';
          
          $checkCreateImgPath = Util::createImagePath($thumb, $pathAsset);
  
          if (!$checkCreateImgPath["success"]) {
              Util::redirect('dashboard/blog', ['msg' => $checkCreateImgPath["msg"], 'type' => "error"]);
          }
  
          $newImagePath = $checkCreateImgPath['name'];

          $data['thumbnail'] = $newImagePath;
      }

      $res = $this->BlogModel->update($data, $id);
      if (!$res) {
          Util::redirect("dashboard/blog", Response::internalServerError("Cập nhật không thành công"));
      }
      if($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage($thumb, $newImagePath);
         if (!$uploadSuccess["success"]) {
            $this->BlogModel->update(["thumbnail" => $oldImagePath], $id);
            Util::redirect('dashboard/blog', Response::badRequest($uploadSuccess["msg"]));
         }
         $checkDeleteImg = Util::deleteImage(_DIR_ROOT.$oldImagePath);
         if (!$checkDeleteImg["success"]) {
            Util::redirect('dashboard/location',Response::badRequest($checkDeleteImg['msg']));
         }
      }
      Util::redirect("dashboard/blog", Response::success("Cập nhật thành công"));
  }
  

   public function delete(): void
   {
      if(!Request::isMethod("POST")) {
         Util::redirect("dashboard/blog", Response::methodNotAllowed("Phương thức không hợp lệ"));
      }
      $listID = Request::input("id") ?? [];
      if (empty($listID)) {
         Util::redirect("dashboard/blog", Response::badRequest("ID không hợp lệ"));
      }
      foreach ($listID as $id) {
         if (!is_numeric($id) || $id < 0) {
            Util::redirect("dashboard/blog", Response::badRequest("ID không hợp lệ"));
         }
      }
      foreach ($listID as $id) {
         $blog = $this->BlogModel->find($id);
         $pathImg = _DIR_ROOT.'/'.$blog["thumbnail"];
         $checkDeleteImg = Util::deleteImage($pathImg);
         if(!$checkDeleteImg['success']) {
            Util::redirect("dashboard/blog", Response::badRequest($checkDeleteImg['msg']));
         }
         $this->BlogModel->delete($id);
      }
      Util::redirect("dashboard/blog", Response::success("Xóa thành công"));
   }
   private function prepareBlogData($isUpdate = false): array
   {
      $title = htmlspecialchars(Request::input("title")) ?? "";
      $slug = htmlspecialchars(Request::input("slug")) ?? "";
      $checkSlug = $this->BlogModel->find($slug ."slug");
      $slug = Util::generateSlug($slug,$checkSlug);
      $content = Request::input("content");
      $status_hot = Request::input("hot") ? 1 : 0;
      $category_id = (int)htmlspecialchars(Request::input("category_id")) ?? "";
      $author_id =(int)htmlspecialchars(Request::input("author_id")) ?? "";
      $status = htmlspecialchars(Request::input("status")) ?? "";
      $status = $this->getStatus($status);
      $data =  [
         "title" => $title,
         "slug" => $slug,
         "category_id" => $category_id,
         "author_id" => $author_id,
         "status" => $status,
         "content" => $content,
         "status_hot" => $status_hot
      ];
      if ($isUpdate) {
         $data = Util::removeEmptyValues($data);
      }
      return $data;
   }
   private function getStatus($status): string {
      return match ($status) {
         "1" => "published",
         "2" => "archived",
         default => "draft"
      };
   }
}
