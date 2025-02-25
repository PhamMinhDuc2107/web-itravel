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
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",ErrorResponse::unauthorized("Vui lòng đăng nhập lại"));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category",ErrorResponse::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index() {
      Util::setBaseModel($this->BlogModel);
      $totalPages =$this->BlogModel->getTotalPages();
      $blogs = $this->BlogModel->getBlogs();
      $blogCategories = $this->BlogCategoryModel->all();
      $admins = $this->AdminModel->all();
      $this->data['totalPages'] = $totalPages;
      $this->data['page']= 'index';
      $this->data['title'] = "Quản lý tin tức";
      $this->data['page'] ="blog/index";
      $this->data['blogs'] = $blogs;
      $this->data['admins'] = $admins;
      $this->data['blogCategories'] = $blogCategories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create(): void
   {
      if (!Request::isMethod("post")) {
         Util::redirect("cpanel/location",['msg' => "Lỗi khng thể tạo", "type" => "error"]);

      }
      if(!Request::file("image") && empty(Request::file("image")['name'])) {
         Util::redirect("cpanel/location",['msg' => "Vui lòng chọn ảnh", "type" => "error"]);
      }
      $pathAsset = '/public/uploads/blog/';
      $check = Util::createImagePath("image", $pathAsset);
      if (!$check["success"]) {
         Util::redirect('cpanel/blog', ['msg' => $check["msg"], 'type' => "error"]);
      }
      $thumb = $check['name'];
      $data = $this->prepareBlogData();
      $data['thumbnail'] = $thumb;
      $res = $this->BlogModel->insert($data);
      $id = $this->BlogModel->getLastInsertId();
      if (!$res) {
         Util::redirect("cpanel/blog", ['msg' => "Thêm không thành công", "type" => "error"]);
      }
      $checkUpload = Util::uploadImage("image", $thumb);
      if (!$checkUpload["success"]) {
         $this->BlogModel->delete($id);
         Util::redirect('cpanel/blog', ['msg' => "Thêm thành công, nhưng tải ảnh thất bại: " . $checkUpload["msg"], 'type' => "warning"]);
      }
      Util::redirect('cpanel/blog', ['msg' => "Thêm thành công " , 'type' => "success"]);
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
         Util::redirect("cpanel/blog",['msg'=>"không tìm thấy tin tức", "type"=>"error"]);
      }
      $this->data['page']= 'index';
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
         Util::Redirect("cpanel/location", ErrorResponse::methodNotAllowed("Phương thức không được phép"));
      }
      $id = (int)(Request::input("id") ?? 0);
      $blog = $this->BlogModel->find($id);
  
      if (!$blog) {
          Util::redirect("cpanel/blog", ['msg' => "Không tìm thấy blog", "type" => "error"]);
      }
  
      $data = $this->prepareBlogData(true);
      $thumb = Request::file("image");
      $oldImagePath = $blog["thumbnail"];
      $newImagePath = null;
      if ($thumb && !empty($thumb['name'])) {
          $pathAsset = '/public/uploads/blog/';
          $checkCreateImgPath = Util::createImagePath("image", $pathAsset);
  
          if (!$checkCreateImgPath["success"]) {
              Util::redirect('cpanel/blog', ['msg' => $checkCreateImgPath["msg"], 'type' => "error"]);
          }
  
          $newImagePath = $checkCreateImgPath['name'];

          $data['thumbnail'] = $newImagePath;
      }

      $res = $this->BlogModel->update($data, $id);
      if (!$res) {
          Util::redirect("cpanel/blog", ['msg' => "Cập nhật không thành công", "type" => "error"]);
      }
      if($newImagePath !== null) {
         $uploadSuccess = Util::uploadImage("image", $newImagePath);
         if (!$uploadSuccess["success"]) {
            $this->BlogModel->update(["thumbnail" => $oldImagePath], $id);
            Util::redirect('cpanel/blog', ['msg' => $uploadSuccess["msg"], 'type' => "error"]);
         }
         $checkDeleteImg = Util::deleteImage(_DIR_ROOT.$oldImagePath);
         if (!$checkDeleteImg["success"]) {
            Util::redirect('cpanel/location',ErrorResponse::badRequest($checkDeleteImg['msg']));
         }
      }
      Util::redirect("cpanel/blog", ["msg" => "Cập nhật thành công", "type" => "success"]);
  }
  

   public function delete(): void
   {
      if(Request::isMethod("POST")) {
         $listID = Request::input("id") ?? [];
         if (empty($listID)) {
            Util::redirect("cpanel/blog", ['msg'=> "ID không hợp lệ", "type" => "error"]);
         }
         foreach ($listID as $id) {
            if (!is_numeric($id) || $id < 0) {
               Util::redirect("cpanel/blog", ['msg'=> "ID không hợp lệ", "type" => "error"]);
            }
         }
         foreach ($listID as $id) {
            $blog = $this->BlogModel->find($id);
            $pathImg = _DIR_ROOT.'/'.$blog["thumbnail"];
            $checkDeleteImg = Util::deleteImage($pathImg);
            if(!$checkDeleteImg['success']) {
               Util::redirect("cpanel/blog",['msg'=>$checkDeleteImg['msg'], "type" => "error"]);
            }
            $this->BlogModel->delete($id);
         }
         Util::redirect("cpanel/blog", ["msg"=>"Xóa  thành công", "type" => "success"]);
      }
   }
   private function prepareBlogData($isUpdate = false): array
   {
      $title = htmlspecialchars(Request::input("title")) ?? "";
      $slug = htmlspecialchars(Request::input("slug")) ?? "";
      $slug = Util::generateSlug($slug);
      $content = Request::input("content");
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
         "content" => $content
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
