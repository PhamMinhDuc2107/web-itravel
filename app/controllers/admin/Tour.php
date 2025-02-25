<?php
class Tour  extends Controller{
   private $data;
   private $TourModel;
   private $LocationModel;
   private $TourLocationModel;
   private $TourImgModel;
   private $TourPriceCalendarModel;
   private $CategoryModel;
   private $jwt;
   public function __construct(){
      $this->TourModel = $this->model("TourModel");
      $this->LocationModel = $this->model("LocationModel");
      $this->TourLocationModel = $this->model("TourLocationModel");
      $this->TourImgModel = $this->model("TourImgModel");
      $this->TourPriceCalendarModel = $this->model("TourPriceCalendarModel");
      $this->CategoryModel = $this->model("CategoryModel");
      $this->jwt = new JwtUtil();
      if(!$this->jwt->checkAuth("token_auth")) {
         Util::redirect("cpanel/login",ErrorResponse::unauthorized("Vui lòng đăng nhập lại"));
      }
      if(!Util::checkCsrfToken()) {
         Util::redirect("cpanel/category",ErrorResponse::forbidden("Thất bại! Token không hợp lệ"));
      }
   }
   public function index() {
      Util::setBaseModel($this->TourModel);
      $totalPages =$this->TourModel->getTotalPages();
      $tours = $this->TourModel->get();
      $departures = $this->LocationModel->where(1, "is_departure");
      $destinations = $this->LocationModel->where(1, "is_destination");
      $categories = $this->CategoryModel->where(0, "parent_id");
      $this->data['totalPages'] = $totalPages;
      $this->data['page']= 'index';
      $this->data['title'] = "Quản lý Tour";
      $this->data['page'] ="tour/index";
      $this->data['tours'] = $tours;
      $this->data['destinations'] = $destinations;
      $this->data['departures'] = $departures;
      $this->data['categories'] = $categories;
      $this->render("layouts/admin_layout", $this->data);
   }
   public function create() {
      if(!Request::isMethod("POST")) {
         Util::Redirect("cpanel/tour", ErrorResponse::methodNotAllowed("Phương thức khoogn được phép"));
      }
      $name = htmlspecialchars(Request::input("name")) ?? "";
      $slug = htmlspecialchars(Request::input("slug")) ?? "";
      $slug = Util::generateSlug($slug);
      $duration = htmlspecialchars(Request::input("duration")) ?? "";
      $description = htmlspecialchars(Request::input("desc")) ?? "";
      $status = htmlspecialchars(Request::input("status")) ?? "";
      $status = $this->getStatus($status);
      $statusHot = htmlspecialchars(Request::input("status_hot")) ? 1 : 0;
      $category = Request::input("category")?? 0;

      $date =Request::input("date")?? [];
      $priceAdult = Request::input("price_adult") ?? [];
      $priceChildren = Request::input("price_children") ?? [];
      $priceBaby = Request::input("price_baby") ?? [];
      $departure = htmlspecialchars(Request::input("departure")) ?? "";
      $destination = htmlspecialchars(Request::input("destination")) ?? "";

//      if(empty($date) || empty($priceBaby) || empty($priceChildren) || empty($priceAdult) || empty($destination) || empty($destination) || empty($status) || empty($name)
//         || empty($slug) || empty($duration) || empty($description ||empty($category))
//      ) {
//         Util::redirect("cpanel/tour", ErrorResponse::badRequest("Vui lòng điền đầy đủ thông tin"));
//      }

      $dataTour = [
         "name" => $name,
         "slug" => $slug,
         "duration" => $duration,
         "description" => $description,
         "category_id" => $category,
         "status" => $status,
         "status_hot" => $statusHot,
      ];
      $res = $this->TourModel->insert($dataTour);
      $id = $this->TourModel->getLastInsertId();
      if (!$res) {
         Util::redirect("cpanel/tour", ErrorResponse::internalServerError("Thêm không thành công"));
      }
      $dataThumb = [
         "tour_id" => $id,
      ];
//      Util::redirect('cpanel/tour', ['msg' => "Thêm thành công " , 'type' => "success"]);
   }
   private function insertTourPrice($id) {

      $arr = [];

      for($i = 0; $i < count($date); $i++) {
         $arr[$i]["date"] = $date[$i];
         $arr[$i]["price_adult"] = $priceAdult[$i];
         $arr[$i]["price_children"] = $priceChildren[$i];
         $arr[$i]["price_baby"] = $priceBaby[$i];
      }
   }
   private function prepareTourData($isUpdate=false):array {


   }
   private function getStatus($status): string {
      return match ($status) {
         "2" => "active",
         "1" => "inactive",
         default => "draft"
      };
   }
}
